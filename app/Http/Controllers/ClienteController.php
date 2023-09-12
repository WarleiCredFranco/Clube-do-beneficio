<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProdutosTroca;
use App\Models\Produto;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ClienteController extends Controller
{
    public function dashboardCliente()
    {
        $user = auth()->user();
        
        if ($user->role !== 'cliente') {
            return redirect()->route('dashboard_gerente')->with('error', 'Acesso não autorizado.');
        }

        $pontosCliente = $user->pontuacao;
        $produtosTroca = ProdutosTroca::all();
        $produtos = Produto::all();


        return view('dashboard_cliente', compact('pontosCliente', 'produtosTroca', 'produtos'));

         // Ou qualquer consulta que você precise fazer


    }


    public function meusVouchers()
    {
        $user = Auth::user();

        if ($user->role !== 'cliente') {
            return redirect()->route('dashboard_gerente')->with('error', 'Acesso não autorizado.');
        }

        $vouchers = Voucher::where('id_cliente', $user->id)
            ->where('trocado', 0) // Considerando que 'trocado' indica se o voucher foi trocado ou não
            ->orderByDesc('data_geracao') // Ordenar por data de geração decrescente
            ->with('produto') // Carregar a relação com o produto
            ->get();

        return view('meus_vouchers', compact('vouchers'));
    }

    public function gerarVoucher(Request $request)
    {
        $idProduto = $request->input('id_produto');

        // Encontre o produto pelo ID
        $produto = ProdutosTroca::find($idProduto);

        if (!$produto) {
            return redirect()->back()->with('error', 'Produto não encontrado!');
        }

        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'Usuário não autenticado!');
        }

        // Verificar se o usuário possui pontos suficientes
        if ($user->pontuacao < $produto->pontuacao) {
            return redirect()->back()->with('error', 'Pontos insuficientes para trocar por este produto!');
        }

        // Atualizar a pontuação do usuário
        $novaPontuacaoCliente = $user->pontuacao - $produto->pontuacao;

        User::where('id', $user->id)->update(['pontuacao' => $novaPontuacaoCliente]);

        // Criar um novo voucher
        
        $voucher = new Voucher([
            'id_cliente' => $user->id,
            'id_produto' => $produto->id,
            'pontos_utilizados' => $produto->pontuacao,
            'codigo_voucher' => Str::random(10),
            'data_geracao' => now(),
        ]);
        $voucher->save();

        return redirect()->route('meus_vouchers')->with('success', 'Pontos trocados com sucesso! Você recebeu um voucher.');
    }





}
