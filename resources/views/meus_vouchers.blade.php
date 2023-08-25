<!-- meus_vouchers.php -->


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Meus Vouchers - Cliente</title>
    <style>
        /* Estilo para os cards */
        .voucher-card {
            height: 400px; /* Altura fixa para os cards */
        }

        /* Alinhar o conteúdo verticalmente no centro */
        .voucher-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Ajustar a imagem dentro do card */
        .voucher-card img {
            max-height: 200px; /* Altura máxima para a imagem */
            max-width: 100%; /* Largura máxima para a imagem */
            object-fit: contain; /* Ajustar a imagem mantendo a proporção */
            margin-bottom: 15px; /* Espaçamento entre a imagem e o texto */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Clube do Benefício</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard_cliente.php">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
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

    <a href="{{ route('dashboard_cliente') }}"><button class="btn btn-primary">Voltar</button></a>

    <br>



    <div class="container">
        <h1 class="text-center mt-5 text-info">Meus Vouchers</h1><br>
        <div class="row mt-4">
            @foreach ($vouchers as $voucher)
                <div class="col-md-4 mb-4">
                    <div class="card voucher-card">
                        <img src="{{ asset('storage/images/produtos/' . basename($voucher->produto->imagem)) }}" class="card-img-top" alt="Imagem do Produto">
                        <div class="card-body">
                            <h5 class="card-title">{{ $voucher->produto->nome }}</h5>
                            <p class="card-text">Pontos Utilizados: {{ $voucher->pontos_utilizados }}</p>
                            <div class="card-footer">
                                <p class="card-text">Código do Voucher: {{ $voucher->codigo_voucher }}</p>
                            </div>
                            <div class="card-footer">
                                @if ($voucher['trocado'] == 0)
                                    <p class="card-text">Status: Não Trocado</p>
                                @else
                                    <p class="card-text">Status: Trocado</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

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