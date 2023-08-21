<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Página Principal do Gerente</title>
    <!-- Seus estilos CSS aqui -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="#">Clube do Benefício</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
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

<a href="{{ route('dashboard_gerente') }}"><button class="btn btn-primary">Voltar</button></a>


<h2 class="text-center text-info">Lista de Vouchers Confirmados</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID Cliente</th>
                <th scope="col">Código do Voucher</th>
                <th scope="col">Data de Confirmação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vouchersConfirmados as $voucher)
                <tr>
                    <td>{{ $voucher->id_cliente }}</td>
                    <td>{{ $voucher->codigo_voucher }}</td>
                    <td>{{ $voucher->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



<br>
    <hr>
    <br>

    <!-- Seus outros conteúdos aqui -->
</body>
</html>