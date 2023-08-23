<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Página Principal do Cliente</title>
    <!-- Seus estilos CSS aqui -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="#">Clube do Benefício</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard_cliente') }}">Home <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('meus_vouchers') }}">Meus Vouchers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Sair</a>
            </li>
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
        <div class="col-md-12 centered-div">
            <form class="form-control" action="">

                <h1 class="text-center text-info">Bem-vindo, {{ Auth::user()->name }}!</h1>
                <br>
                <div class="form-group" style="text-align: center; font-size: 3rem">
                    <!-- Exibir a quantidade de pontos do cliente -->
                    <p>Você possui {{ $pontosCliente }} pontos.</p>

                </div>
            </form>

            <br>

             <!-- Formulário para Trocar Pontos por Produtos -->

            <p>Quantidade de Pontos: {{ $pontosCliente }}</p>

            <h2 class="text-center text-info">Lista de Produtos Disponíveis para troca</h2><br>
            <div class="container" style="display: flex; align-items: center; justify-content: center;">
                <div class="row">
                    <!-- Exibir os produtos de troca -->
                    @foreach ($produtosTroca as $produtoTroca)
                        <div class="col-md-2 d-flex mb-4">
                            <div class="card flex-fill d-flex flex-column">
                                <img src="{{ asset('storage/images/produtos/' . basename($produtoTroca->imagem)) }}" class="card-img-top" alt="Imagem do Produto de Troca">
                                <div class="card-body d-flex flex-column justify-content-end">
                                    <h5 class="card-title">{{ $produtoTroca->nome }}</h5>
                                    <p class="card-text">Pontuação: {{ $produtoTroca->pontuacao }}</p>
                                    @if ($pontosCliente >= $produtoTroca->pontuacao)
                                        <form action="{{ route('gerar.voucher') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_produto" value="{{ $produtoTroca->id }}">
                                            <button type="submit" class="btn btn-primary">Gerar Voucher</button>
                                        </form>
                                    @else
                                        <p class="text-danger">Você não possui pontos suficientes para trocar por este produto.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                   @endforeach
                </div>
            </div>

            @if (session('success') === 'pontos_trocados')
                <p>Você trocou seus pontos por este produto. Seu voucher está disponível!</p>
            @endif

            @if (session('error') === 'pontos_insuficientes')
                <p>Você não possui pontos suficientes para trocar por este produto.</p>
            @endif
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
