<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <title> @yield('title') </title>
        <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">

        <!-- recaptcha-->
        {!! htmlScriptTagJsApi([
            'action' => 'homepage',
            
        ]) !!}
         <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- recaptcha-->
    </head>

<body class="form">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 style="color:#0095A9;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" viewBox="0 0 368 365.5"><defs><style>.cls-1{fill:#725298;}.cls-2{fill:#fff;}</style></defs><title>Recurso 2</title><g id="Capa_2" data-name="Capa 2"><g id="logo"><rect class="cls-1" width="368" height="365" rx="35.72"/><path class="cls-2" d="M328.34,224.11H229.55a10.16,10.16,0,0,0-10.16,10.16v8.07a10.16,10.16,0,0,0,10.16,10.16h39.52l2.12,2.94c-.12.38-.25.76-.38,1.14s-.31.89-.48,1.33-.28.76-.43,1.14c-.21.55-.43,1.1-.66,1.64-.16.39-.33.77-.5,1.15-.56,1.29-1.17,2.57-1.82,3.81-.21.42-.43.83-.66,1.24a66.56,66.56,0,0,1-3.92,6.36c-.28.4-.56.8-.85,1.19s-.66.9-1,1.34c-.68.9-1.39,1.79-2.12,2.65-.34.41-.7.81-1.06,1.22-.7.8-1.43,1.58-2.17,2.34-.42.44-.85.87-1.29,1.3s-.8.78-1.21,1.16l-1.24,1.13c-.41.37-.84.73-1.26,1.09s-1,.81-1.45,1.2-.77.61-1.15.9l-1.45,1.09c-.42.31-.85.61-1.28.91s-.92.64-1.39,1l-1.42.91c-.48.3-1,.6-1.44.88s-.77.46-1.16.67c-.65.38-1.3.73-2,1.08-.44.24-.89.47-1.34.69-.81.41-1.63.8-2.46,1.18l-.95.42-1.41.6c-1,.41-2,.8-3,1.16l-1,.36-1.06.35c-.94.31-1.9.6-2.86.86l-1.38.37-.55.14c-.48.12-1,.24-1.45.34s-1,.22-1.5.32l-.4.09-1.43.26-.82.14-1.28.2c-1.78.26-3.58.46-5.41.58l-1.3.08h-.24l-1.08,0-.94,0-1.52,0c-38.94,0-70.5-30.89-70.5-69,0-1.16,0-2.31.09-3.46,0-.49,0-1,.09-1.45,0-.66.1-1.31.17-2,0-.44.09-.89.15-1.32.14-1.25.33-2.49.55-3.72.07-.39.14-.78.22-1.16.16-.84.34-1.67.54-2.5.12-.54.25-1.07.39-1.6s.23-.85.35-1.27.26-.89.4-1.34c.19-.65.4-1.29.61-1.92.16-.47.33-.94.5-1.41a.42.42,0,0,1,0-.1c.09-.27.19-.54.29-.8.76-2,1.63-4,2.57-5.89.23-.48.46-1,.7-1.41l.1-.19c.22-.41.44-.82.67-1.23,1-1.76,2-3.47,3.14-5.13.21-.33.44-.66.67-1,.58-.83,1.17-1.65,1.79-2.45.28-.37.56-.73.86-1.09.41-.53.83-1,1.27-1.56.23-.27.45-.54.69-.8.63-.73,1.28-1.44,2-2.14l.92-1c.38-.39.76-.77,1.16-1.15l1.18-1.12a70.6,70.6,0,0,1,13.23-9.66c.41-.24.84-.47,1.26-.69,1-.57,2.09-1.1,3.15-1.6l1.5-.7,1.53-.66q2.33-1,4.73-1.79c.52-.18,1-.35,1.57-.51l1.08-.33,1-.27c.4-.12.81-.23,1.22-.33s1.07-.28,1.61-.4l.09,0c.53-.13,1.07-.25,1.61-.36l1.28-.26.88-.16c.4-.08.81-.15,1.22-.21.56-.09,1.13-.18,1.7-.25l1.45-.19.84-.09c.48,0,1-.1,1.44-.13l1.41-.11a.65.65,0,0,1,.14,0l.95-.06,1.07.62,9.39,17.64a13.79,13.79,0,0,0,18.64,5.69l5.19-2.76a8.94,8.94,0,0,0,1,3l1.67,3.15a9,9,0,0,0,12.18,3.71l12.62-6.71,3.27-1.74A9,9,0,0,0,269.12,176l-1.68-3.15a8.78,8.78,0,0,0-1.94-2.47l1-.51a13.79,13.79,0,0,0,5.7-18.64l-14.6-27.45L204.21,23.52a13.78,13.78,0,0,0-18.64-5.69l-3.91,2.08A1.17,1.17,0,0,1,180,18.44a8.92,8.92,0,0,0-.51-7.3L177.86,8a9,9,0,0,0-12.17-3.72L149.8,12.73a9,9,0,0,0-3.72,12.17L147.75,28a9,9,0,0,0,5.78,4.51,1.16,1.16,0,0,1,.31,2.16l-5.22,2.78a13.78,13.78,0,0,0-5.7,18.63l28.94,54.39a1.15,1.15,0,0,1-.77,1.67C116.05,124.94,75,174.63,75,234a125.14,125.14,0,0,0,52.31,102,1.13,1.13,0,0,1,.22,1.66,95.63,95.63,0,0,0-15.17,26.26l1.1,1.58H284.08a1.17,1.17,0,0,0,1.09-1.58l-.21-.54a95.68,95.68,0,0,0-14.8-25.5,1.14,1.14,0,0,1,.23-1.66,125.14,125.14,0,0,0,51.11-82.74,1.16,1.16,0,0,1,1.14-1h5.7a10.16,10.16,0,0,0,10.16-10.16v-8.07A10.16,10.16,0,0,0,328.34,224.11Zm-127.14,134a17.32,17.32,0,1,1,17.7-17.32A17.51,17.51,0,0,1,201.2,358.14Z"/></g></g></svg>
                            Acceso al Sistema</h1>                      
                        
                        <form class="text-left" action="{{ route('login') }}" method="POST">
                              @csrf
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USUARIO</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input  id="text" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">CONTRASEÑA</label>                                       
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn color-lab" value="">Ingresar</button>
                                    </div>
                                </div>
                                    @if (Route::has('password.request'))
                                    <a class="text-center mt-2"  style="color:#0095A9;" href="{{ route('password.request') }}">
                                        <span> {{ __('Forgot Your Password?') }}</span>
                                    </a>
                                    @endif
                                    <p class="text-center mt-2" style="color:#0095A9;"><strong>Si no cuenta con credenciales de ingreso al sistema porfavor contactese con el Laboratorio</strong> </p>   
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>

    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/authentication/form-2.js') }}"></script>
</body>
</html>
