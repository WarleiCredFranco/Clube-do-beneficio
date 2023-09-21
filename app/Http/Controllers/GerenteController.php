<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\ProdutosTroca;
use App\Models\Compra;
use App\Models\Voucher;

class GerenteController extends Controller
{
    public function dashboard()
    {
        $clientes = User::where('role', 'cliente')->get();
        $produtos = Produto::all(); // Carregando a lista de produtos
        $produtos_ativos = Produto::where('status', 1)->get();
        $produtos_desativados = Produto::where('status', 0)->get();
        $produtos_troca = ProdutosTroca::all();
        $clientes_vouchers = User::leftJoin('vouchers', 'users.id', '=', 'vouchers.id_cliente')
            ->leftJoin('produtos_troca', 'vouchers.id_produto', '=', 'produtos_troca.id')
            ->where('vouchers.trocado', 0)
            ->select('users.id AS id_cliente', 'users.name AS nome_cliente', 'vouchers.codigo_voucher', 'vouchers.data_geracao', 'produtos_troca.nome AS nome_produto')
            ->get();

        return view('dashboard_gerente', compact('clientes', 'produtos_ativos', 'produtos_desativados', 'produtos', 'produtos_troca', 'clientes_vouchers'));
    }


    public function cadastrarProduto(Request $request)
    {
        // Validar o formulário antes de salvar
        $request->validate([
            'nome' => 'required',
            'pontuacao' => 'required|numeric',
            'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload da imagem (caso seja fornecida)
        $imagemPath = null;
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('public/images/produtos');
        }


        // Criar o novo produto
        Produto::create([
            'nome' => $request->nome,
            'pontuacao' => $request->pontuacao,
            'imagem' => $imagemPath,
            'status' => 1, // Supondo que o status do novo produto seja ativo
        ]);

        return redirect()->route('dashboard_gerente')->with('success', 'Produto cadastrado com sucesso!');

    }


    public function desativarProduto(Request $request)
    {
        $produto = Produto::find($request->id_produto);

        if ($produto) {
            $produto->status = 0;
            $produto->save();
        }

        return redirect()->route('dashboard_gerente')->with('success', 'Produto desativado com sucesso!');
    }

    public function reativarProduto(Request $request)
    {
        $produto = Produto::find($request->id_produto);

        if ($produto) {
            $produto->status = 1; // Ativar o produto (alterar o status para 1)
            $produto->save();
        }

        return redirect()->route('dashboard_gerente')->with('success', 'Produto reativado com sucesso!');
    }



    public function marcarProdutos(Request $request)
    {
        // Lógica para marcar produtos para clientes
        $idCliente = $request->input('id_cliente');
        $idProduto = $request->input('id_produto');

        // Verifica se o cliente e o produto existem
        $cliente = User::find($idCliente);
        $produto = Produto::find($idProduto);

        if (!$cliente || !$produto) {
            return redirect()->route('dashboard_gerente')->with('error', 'Cliente ou produto não encontrado!');
        }

        $pontuacaoClienteAtual = $cliente->pontuacao; // Obtém a pontuação atual do cliente
        $pontuacaoProduto = $produto->pontuacao; // Obtém a pontuação do produto

        $novaPontuacaoCliente = $pontuacaoClienteAtual + $pontuacaoProduto; // Calcula a nova pontuação do cliente

        // Atualiza a pontuação do cliente na tabela users
        $cliente->pontuacao = $novaPontuacaoCliente;
        $cliente->save();

        // Cria o registro de compra
        $compra = new Compra();
        $compra->id_cliente = $cliente->id;
        $compra->id_produto = $produto->id;
        $compra->pontuacao = $pontuacaoProduto; // Define a pontuação do produto na compra
        $compra->data_geracao = now();
        $compra->save();

        return redirect()->route('dashboard_gerente')->with('success', 'Produto marcado para o cliente com sucesso!');

    }



    public function definirPontuacao(Request $request)
    {
        // Loop através dos produtos para atualizar as pontuações
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'pontuacao_') === 0) {
                $produtoId = str_replace('pontuacao_', '', $key);
                $produto = Produto::find($produtoId);
                
                if ($produto) {
                    $produto->pontuacao = $value;
                    $produto->save();
                }
            }
        }

        return redirect()->route('dashboard_gerente')->with('success', 'Pontuações de produtos atualizadas com sucesso!');
    }

    public function adicionarProdutoTroca(Request $request)
    {
        // Lógica para adicionar um novo produto de troca
        $nomeProdutoTroca = $request->input('nome_produto_troca');
        $pontuacaoProdutoTroca = $request->input('pontuacao_produto_troca');
        
        // Verificar se uma imagem foi enviada
        if ($request->hasFile('imagem_produto_troca')) {
            $imagemProdutoTroca = $request->file('imagem_produto_troca')->store('public/images/produtos');
        } else {
            // Caso contrário, defina um valor padrão para a imagem
            $imagemProdutoTroca = 'caminho/para/imagem/imagem-padrao.jpg';
        }

        // Crie um novo registro na tabela ProdutosTroca
        ProdutosTroca::create([
            'nome' => $nomeProdutoTroca,
            'pontuacao' => $pontuacaoProdutoTroca,
            'imagem' => $imagemProdutoTroca,
        ]);

        return redirect()->route('dashboard_gerente')->with('success', 'Novo produto de troca adicionado com sucesso!');
    }


    public function definirPontuacaoProdutosTroca(Request $request)
    {
        // Loop através dos produtos para atualizar as pontuações
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'pontuacao_produto_troca') === 0) {
                $produtos_trocaId = str_replace('pontuacao_produto_troca', '', $key);
                $produtos_troca = ProdutosTroca::find($produtos_trocaId);
                
                if ($produtos_troca) {
                    $produtos_troca->pontuacao = $value;
                    $produtos_troca->save();
                }
            }
        }

        return redirect()->route('dashboard_gerente')->with('success', 'Pontuações dos produtos de troca atualizadas com sucesso!');
    }



    public function confirmarVoucher($codigoVoucher)
    {
        $voucher = Voucher::where('codigo_voucher', $codigoVoucher)->first();

        if (!$voucher) {
            return redirect()->back()->with('error', 'Voucher não encontrado.');
        }

        // Atualizar o status do voucher para "trocado" (1)
        $voucher->trocado = 1;
        $voucher->save();

        return redirect()->route('lista.vouchers.confirmados')->with('success', 'Voucher confirmado com sucesso.');
    }

    public function listaVouchersConfirmados()
    {
        $vouchersConfirmados = Voucher::where('trocado', 1)
            ->orderByDesc('updated_at')
            ->get();
            

        return view('lista_vouchers_confirmados', compact('vouchersConfirmados'));
    }





}
