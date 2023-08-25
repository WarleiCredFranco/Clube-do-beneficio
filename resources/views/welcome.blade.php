<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
           
        </style>
    </head>
    <body class="bg-primary">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Clube do Benefício</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            @if (Route::has('login'))
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Home<span class="sr-only">(current)</span></a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Cadastre-se</a>
                        </li>
                        @endif
                    @endauth
                </ul>
            @endif
            </div>
        </nav>

            <div class="container-fluid">
                <header class="bg-primary text-white pt-0">
                    <div class="container px-4 text-center mb-5">
                        <h1 class="text-center fw-bolder" style="font-size: 5em;">Bem-vindo ao SuperMercMais!</h1>
                        <p class="lead" style="font-size: 2em;">🛒 Faça suas compras com vantagens exclusivas! 🛒</p>
                        <a class="btn btn-lg btn-light mb-5" href="{{ route('login') }}">Acesse sua Pagina</a>
                    </div>

                </header>
                <!-- About section-->
                <section class="bg-primary text-white pt-0">
                    <div class="container px-4">
                        <div class="row gx-4 justify-content-center">
                            <div class="col-lg-8">
                                <h1 class="text-center fw-bolder">🎊Prezado Cliente:</h1>
                                <p class="lead text-justify">Você está convidado a descobrir um mundo de economia e vantagens no SuperMercMais! Nosso Clube de Benefícios foi especialmente criado para recompensar você, nosso cliente especial, com ofertas descontos, descontos exclusivos e ofertas exclusivas em cada compra que você fizer.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <br>
                <!-- Services section-->
                <section class="bg-primary text-white pt-0">
                    <div class="container px-4">
                        <div class="row gx-4 justify-content-center">
                            <div class="col-lg-8">
                                <h1 class="text-center fw-bolder">🎁 Brindes Surpreendentes:</h1>
                                <p class="lead">Adoramos mimar nossos membros! Fique atento às nossas ofertas de brindes exclusivos. De amostras gratuitas a presentes especiais, temos sempre algo emocionante reservado para você.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <br>
                <!-- Contact section-->
                <section class="bg-primary text-white pt-0">
                    <div class="container px-4">
                        <div class="row gx-4 justify-content-center">
                            <div class="col-lg-8">
                                <h1 class="text-center fw-bolder">🏆 Programa de Fidelidade:</h1>
                                <p class="lead">Quanto mais você compra, mais você ganha! Nosso programa de fidelidade oferece recompensas exclusivas, cupons adicionais e benefícios especiais para os membros mais fiéis.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <br>                
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
