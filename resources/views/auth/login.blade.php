<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
           
        </style>
    </head>
    <body class="bg-primary">

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://cdn.pixabay.com/photo/2017/06/07/18/35/design-2381160_640.png"
                    class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label class="form-label" for="email" :value="__('Email')">Email</label>
                            <input class="form-control form-control-lg" id="email"
                                            type="email" 
                                            name="email" :value="old('email')" 
                                            required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label class="form-label" for="password" :value="__('Password')">Senha</label>
                            <input class="form-control form-control-lg" id="password" 
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <br>

                        <!-- Remember Me -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check mb-0">
                                <label class="form-check-label" for="remember_me">
                                    <input class="form-check-input me-2" id="remember_me" type="checkbox" name="remember">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <a class="btn btn-primary btn-lg" href="{{ route('register') }}">
                                {{ __('Ainda não possui cadastro?') }}
                            </a>
                            @if (Route::has('password.request'))
                                <a class="btn btn-primary btn-lg" href="{{ route('password.request') }}">
                                    {{ __('Esqueceu sua senha?') }}
                                </a>
                            @endif
                            <br>
                            <hr>
                            <x-primary-button class="btn btn-success ml-3">
                                {{ __('Login') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
            
            <!-- Right -->
        </div>
    </section>
                <!-- Footer-->
                <footer class="py-5 bg-dark">
                    <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; SuperMercMais! 2023</p></div>
                    <div
                        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5">

                        <!-- Right -->
                        <div>
                        <a href="#!" class="text-white me-4">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#!" class="text-white me-4">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#!" class="text-white me-4">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#!" class="text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>         
                </footer>
                <!-- Bootstrap core JS-->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
                <!-- Core theme JS-->
                <script src="js/scripts.js"></script>
                <script src="https://kit.fontawesome.com/15d55aa13b.js" crossorigin="anonymous"></script>

            
        
        


        
    </body>
</html>
