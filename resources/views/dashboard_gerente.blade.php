
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Página Principal do Gerente</title>
    <!-- Seus estilos CSS aqui -->
</head>

<style>
        .img-container{
            overflow: hidden;
        }

        .img-container img{
            -webkit-transition: -webkit-transform .3s ease;
            transition: transform .3s ease;
        }

        .img-container:hover img{
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }


</style>


<body class="">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Clube do Benefício</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('lista.vouchers.confirmados') }}">Lista de Vouchers Trocados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-primary" type="submit">Sair</button>
            </form>
        </ul>
    </div>
</nav>

<br>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<br>

<div class="container" style="display: flex; align-items: center; justify-content: center;">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center text-info">Bem-vindo, {{ Auth::user()->name }}!</h1><br>

            <!-- Lista de Clientes Cadastrados -->
            <!-- Lista de Clientes Cadastrados -->
            <h2 class="text-center text-info">Lista de Clientes Cadastrados</h2>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nome do Cliente</th>
                        <th scope="col">Pontuação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->name }}</td>
                        <td>{{ $cliente->pontuacao }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table><br>

            <hr>
            <br>

                <!-- Formulário para Cadastrar Produtos -->
                
                <form class="form-control" action="{{ route('cadastrar.produto') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center text-info">Cadastrar Novo Produto:</h2>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="nome">Nome do Produto:</label>
                            <input class="form-control" type="text" name="nome" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pontuacao">Pontuação:</label>
                            <input class="form-control" type="number" name="pontuacao" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="imagem">Imagem do Produto:</label>
                            <input class="form-control" type="file" name="imagem" accept="image/*"><br>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary col-md-12">Cadastrar Produto</button>
                        </div>
                    </div>
                </form>
                <br>
                <hr>
                <br>
                <!-- Lista de Produtos com Cards -->
                <h2 class="text-center text-info">Lista de Produtos</h2><br>
                <div class="container" style="display: flex; align-items: center; justify-content: center;">
                    <div class="row">
                        @foreach ($produtos as $produto)
                            @if ($produto->status == 1) <!-- Verificar o status do produto -->  
                                <div class="col-md-2 d-flex mb-4">
                                    <div class="card flex-fill d-flex flex-column rounded-card shadow overflow-hidden img-container" style="border-radius: 10px;">
                                        @if ($produto->imagem)
                                            <img src="{{ asset('storage/images/produtos/' . basename($produto->imagem)) }}" class="card-img-top img-fluid object-fit: cover; overflow: hidden;" alt="Imagem do Produto">
                                        @else
                                            <!-- Aqui você pode adicionar uma imagem padrão para casos sem imagem -->
                                            <img src="{{ asset('storage/images/produtos/imagem-padrao.jpg') }}" class="card-img-top img-fluid object-fit: cover; overflow: hidden;" alt="Imagem do Produto Padrão">
                                        @endif
                                        <div class="card-body bg-primary d-flex flex-column justify-content-end text-center text-light">
                                            <h5 class="card-title">{{ $produto->nome }}</h5>
                                            <p class="card-text">Pontuação: {{ $produto->pontuacao }}</p>
                                        </div>
                                        <!-- Botão para desativar o produto -->
                                        <form action="{{ route('desativar.produto') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_produto" value="{{ $produto->id }}">
                                            <button type="submit" class="btn btn-danger">Desativar</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>


                <br>
                <hr>
                <br>
                <!-- Lista de Produtos Desativados -->
                <h2 class="text-center text-info">Lista de Produtos Desativados</h2><br>
                <div class="container" style="display: flex; align-items: center; justify-content: center;">
                    <div class="row">
                        @foreach ($produtos_desativados as $produto)
                            <div class="col-md-2 d-flex mb-4">
                                <div class="card flex-fill d-flex flex-column rounded-card shadow overflow-hidden img-container" style="border-radius: 10px;">
                                    @if ($produto->imagem)
                                        <img src="{{ asset('storage/images/produtos/' . basename($produto->imagem)) }}" class="card-img-top img-fluid" alt="Imagem do Produto">
                                    @else
                                        <!-- Adicione a imagem padrão aqui -->
                                        <img src="{{ asset('storage/images/produtos/imagem-padrao.jpg') }}" class="card-img-top img-fluid" alt="Imagem do Produto Padrão">
                                    @endif
                                    <div class="card-body bg-primary d-flex flex-column justify-content-end text-center text-light">
                                        <h5 class="card-title">{{ $produto->nome }}</h5>
                                        <p class="card-text">Pontuação: {{ $produto->pontuacao }}</p>
                                    </div>
                                    <!-- Botão para reativar o produto -->
                                    <form action="{{ route('reativar.produto') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_produto" value="{{ $produto->id }}">
                                        <button type="submit" class="btn btn-success">Reativar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                

                <br>
                <hr>
                <br>

                <!-- Formulário para Marcar Produtos para Clientes -->
                
                <form action="{{ route('marcar.produtos') }}" method="POST">
                @csrf
                <h2 class="text-center text-info">Marcar Produtos para Clientes:</h2><br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="id_cliente">Selecione o Cliente:</label>
                        <select class="form-select" aria-label="Default select example" name="id_cliente" required>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <div class="form-group col-md-6">
                        <label for="id_produto">Selecione o Produto:</label>
                        <select class="form-select" aria-label="Default select example" name="id_produto" required>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }} - Pontuação: {{ $produto->pontuacao }}</option>
                            @endforeach
                        </select><br>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary col-md-12" type="submit">Marcar Produto</button>
                    </div>
                </div>
                </form>

                <br>
                <hr>
                <br>

                
                <form class="form-control" action="{{ route('definir.pontuacao') }}" method="POST">
                @csrf
                    <h2 class="text-center text-info">Definir Pontuação de Produtos:</h2><br>
                    <div class="row">
                        <?php foreach ($produtos as $produto) : ?>
                            <div class="form-group col-md-4">
                                <label class="form-group" for="pontuacao_<?php echo $produto['id']; ?>"><?php echo $produto['nome']; ?>:</label>
                                <input class="form-control text-center" type="number" name="pontuacao_<?php echo $produto['id']; ?>" value="<?php echo $produto['pontuacao']; ?>">
                                <br>
                            </div>
                        <?php endforeach; ?> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button class="btn btn-primary col-md-12" type="submit">Salvar Pontuações</button>  
                        </div>  
                    </div>                           
                </form>

                <br>
                <hr>
                <br>

                <!-- Formulário para Adicionar Novos Produtos de Troca -->
                
                <form class="form-control" action="{{ route('adicionar.produto.troca') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center text-info">Adicionar Novo Produto de Troca:</h2><br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="nome_produto_troca">Nome do Produto de Troca:</label>
                            <input class="form-control" type="text" name="nome_produto_troca" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pontuacao_produto_troca">Pontuação do Produto de Troca:</label>
                            <input class="form-control" type="number" name="pontuacao_produto_troca" required>
                        </div>
                        <div class="form-group col-md-4">
                            <!-- Novo campo para a imagem -->
                            <label for="imagem_produto_troca">Imagem do Produto de Troca:</label>
                            <input class="form-control" type="file" name="imagem_produto_troca" required accept="image/*"><br>
                        </div>
                        <div class="form-group">
                            <button class="col-md-12 btn btn-primary" type="submit">Adicionar Produto de Troca</button>
                        </div>
                        
                    </div>
                </form>

                <br>
                <hr>
                <br>


                <!-- Lista de Produtos para troca -->
                <h2 class="text-center text-info">Lista de Produtos para troca</h2><br>
                <div class="container" style="display: flex; align-items: center; justify-content: center;">
                    <div class="row">
                        @foreach ($produtos_troca as $produto_troca)
                            @if ($produto_troca->status == 1) <!-- Verificar o status do produto -->  
                                <div class="col-md-2 d-flex mb-4">
                                    <div class="card flex-fill d-flex flex-column rounded-card shadow overflow-hidden img-container" style="border-radius: 10px;">
                                        @if ($produto_troca->imagem)
                                            <img src="{{ asset('storage/images/produtos/' . basename($produto_troca->imagem)) }}" class="card-img-top img-fluid object-fit: cover; overflow: hidden;" alt="Imagem do Produto">
                                        @else
                                            <!-- Aqui você pode adicionar uma imagem padrão para casos sem imagem -->
                                            <img src="{{ asset('storage/images/produtos/imagem-padrao.jpg') }}" class="card-img-top img-fluid object-fit: cover; overflow: hidden;" alt="Imagem do Produto Padrão">
                                        @endif
                                        <div class="card-body bg-primary d-flex flex-column justify-content-end text-center text-light">
                                            <h5 class="card-title">{{ $produto_troca->nome }}</h5>
                                            <p class="card-text">Pontuação: {{ $produto_troca->pontuacao }}</p>
                                        </div>
                                        <!-- Botão para desativar o produto -->
                                        <form action="{{ route('desativar.produto.troca') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_produto" value="{{ $produto_troca->id }}">
                                            <button type="submit" class="btn btn-danger">Desativar</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>


                <br>
                <hr>
                <br>
                <!-- Lista de Produtos Desativados -->
                <h2 class="text-center text-info">Lista de Produtos Desativados</h2><br>
                <div class="container" style="display: flex; align-items: center; justify-content: center;">
                    <div class="row">
                        @foreach ($produtos_troca_desativados as $produto_troca)
                            <div class="col-md-2 d-flex mb-4">
                                <div class="card flex-fill d-flex flex-column rounded-card shadow overflow-hidden img-container" style="border-radius: 10px;">
                                    @if ($produto_troca->imagem)
                                        <img src="{{ asset('storage/images/produtos/' . basename($produto_troca->imagem)) }}" class="card-img-top img-fluid" alt="Imagem do Produto">
                                    @else
                                        <!-- Adicione a imagem padrão aqui -->
                                        <img src="{{ asset('storage/images/produtos/imagem-padrao.jpg') }}" class="card-img-top img-fluid" alt="Imagem do Produto Padrão">
                                    @endif
                                    <div class="card-body bg-primary d-flex flex-column justify-content-end text-center text-light">
                                        <h5 class="card-title">{{ $produto_troca->nome }}</h5>
                                        <p class="card-text">Pontuação: {{ $produto_troca->pontuacao }}</p>
                                    </div>
                                    <!-- Botão para reativar o produto -->
                                    <form action="{{ route('reativar.produto.troca') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_produto" value="{{ $produto_troca->id }}">
                                        <button type="submit" class="btn btn-success">Reativar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <br>
                <hr>
                <br>

                <!-- Definir Pontuação de Produtos para troca -->
                <form class="form-control" action="{{ route('definir.pontuacao.produtos.troca') }}" method="POST">
                @csrf
                    <h2 class="text-center text-info">Definir Pontuação de Produtos para troca:</h2><br>
                    <div class="row">
                        <?php foreach ($produtos_troca as $produto_troca) : ?>
                            <div class="form-group col-md-4">
                                <label class="form-group" for="pontuacao_produto_troca<?php echo $produto_troca['id']; ?>"><?php echo $produto_troca['nome']; ?>:</label>
                                <input class="form-control text-center" type="number" name="pontuacao_produto_troca<?php echo $produto_troca['id']; ?>" value="<?php echo $produto_troca['pontuacao']; ?>">
                                <br>
                            </div>
                        <?php endforeach; ?> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button class="btn btn-primary col-md-12" type="submit">Definir Pontuações</button>  
                        </div>  
                    </div>                           
                </form>

                <br>
                <hr>
                <br>

                <!-- Lista de Clientes com Vouchers não trocados -->
                <h2 class="text-center text-info">Lista de Clientes com Vouchers não trocados</h2>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID Cliente</th>
                            <th scope="col">Nome do Cliente</th>
                            <th scope="col">Código do Voucher</th>
                            <th scope="col">Data de Geração</th>
                            <th scope="col">Produto Trocado</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes_vouchers as $cv)
                            <tr>
                                <td>{{ $cv['id_cliente'] }}</td>
                                <td>{{ $cv['nome_cliente'] }}</td>
                                <td>{{ $cv['codigo_voucher'] }}</td>
                                <td>{{ $cv['data_geracao'] }}</td>
                                <td>{{ $cv['nome_produto'] }}</td>
                                <td>
                                    @if ($cv['trocado'] == 0)
                                    <form action="{{ route('confirmar.voucher', ['codigo_voucher' => $cv['codigo_voucher']]) }}" method="POST">
                                        @csrf <!-- Adicione o token CSRF para proteção -->
                                        <button type="submit" class="btn btn-success">Confirmar Voucher</button>
                                    </form>
                                    @else
                                        Voucher Confirmado
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <?php
                if (isset($_GET['success']) && $_GET['success'] === 'produto_marcardo') {
                echo "<p>Produto marcado para o cliente com sucesso!</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <br>
    <hr>
    <br>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; SuperMercMais! 2023</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>
</html>