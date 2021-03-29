<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lab - San Gabriel</title>

        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Styles -->
        <style>
            html, body {
                background-color:#0095A9;
                color: #ffff;
                font-family: 'Nunito', sans-serif;
                font-weight: bolder;
                width: 100vw;
                height: 100vh;
                margin: 0;

            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .tiitle {
                font-size: 50px;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            @media (min-width: 769px) { 
                .lab{
                    display: flex;
                    flex-direction: column;
                    align-items: start;
                }
            }
            @media (max-width: 768px) { 
                .micro{
                    width: 20%;
                }
                .top-right {
                position: absolute;
                right: -10px;
                top: 8px;
            }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Ingresar</a>
                    @endauth
                </div>
            @endif
                <div class="row text-center">
                    <div class="col-12 col-md-2 col-lg-2  offset-lg-4 offset-md-4">
                        <svg class="micro" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 368 365.5"><defs><style>.cls-1{fill:#725298;}.cls-2{fill:#fff;}</style></defs><title>Recurso 2</title><g id="Capa_2" data-name="Capa 2"><g id="logo"><rect class="cls-1" width="368" height="365" rx="35.72"/><path class="cls-2" d="M328.34,224.11H229.55a10.16,10.16,0,0,0-10.16,10.16v8.07a10.16,10.16,0,0,0,10.16,10.16h39.52l2.12,2.94c-.12.38-.25.76-.38,1.14s-.31.89-.48,1.33-.28.76-.43,1.14c-.21.55-.43,1.1-.66,1.64-.16.39-.33.77-.5,1.15-.56,1.29-1.17,2.57-1.82,3.81-.21.42-.43.83-.66,1.24a66.56,66.56,0,0,1-3.92,6.36c-.28.4-.56.8-.85,1.19s-.66.9-1,1.34c-.68.9-1.39,1.79-2.12,2.65-.34.41-.7.81-1.06,1.22-.7.8-1.43,1.58-2.17,2.34-.42.44-.85.87-1.29,1.3s-.8.78-1.21,1.16l-1.24,1.13c-.41.37-.84.73-1.26,1.09s-1,.81-1.45,1.2-.77.61-1.15.9l-1.45,1.09c-.42.31-.85.61-1.28.91s-.92.64-1.39,1l-1.42.91c-.48.3-1,.6-1.44.88s-.77.46-1.16.67c-.65.38-1.3.73-2,1.08-.44.24-.89.47-1.34.69-.81.41-1.63.8-2.46,1.18l-.95.42-1.41.6c-1,.41-2,.8-3,1.16l-1,.36-1.06.35c-.94.31-1.9.6-2.86.86l-1.38.37-.55.14c-.48.12-1,.24-1.45.34s-1,.22-1.5.32l-.4.09-1.43.26-.82.14-1.28.2c-1.78.26-3.58.46-5.41.58l-1.3.08h-.24l-1.08,0-.94,0-1.52,0c-38.94,0-70.5-30.89-70.5-69,0-1.16,0-2.31.09-3.46,0-.49,0-1,.09-1.45,0-.66.1-1.31.17-2,0-.44.09-.89.15-1.32.14-1.25.33-2.49.55-3.72.07-.39.14-.78.22-1.16.16-.84.34-1.67.54-2.5.12-.54.25-1.07.39-1.6s.23-.85.35-1.27.26-.89.4-1.34c.19-.65.4-1.29.61-1.92.16-.47.33-.94.5-1.41a.42.42,0,0,1,0-.1c.09-.27.19-.54.29-.8.76-2,1.63-4,2.57-5.89.23-.48.46-1,.7-1.41l.1-.19c.22-.41.44-.82.67-1.23,1-1.76,2-3.47,3.14-5.13.21-.33.44-.66.67-1,.58-.83,1.17-1.65,1.79-2.45.28-.37.56-.73.86-1.09.41-.53.83-1,1.27-1.56.23-.27.45-.54.69-.8.63-.73,1.28-1.44,2-2.14l.92-1c.38-.39.76-.77,1.16-1.15l1.18-1.12a70.6,70.6,0,0,1,13.23-9.66c.41-.24.84-.47,1.26-.69,1-.57,2.09-1.1,3.15-1.6l1.5-.7,1.53-.66q2.33-1,4.73-1.79c.52-.18,1-.35,1.57-.51l1.08-.33,1-.27c.4-.12.81-.23,1.22-.33s1.07-.28,1.61-.4l.09,0c.53-.13,1.07-.25,1.61-.36l1.28-.26.88-.16c.4-.08.81-.15,1.22-.21.56-.09,1.13-.18,1.7-.25l1.45-.19.84-.09c.48,0,1-.1,1.44-.13l1.41-.11a.65.65,0,0,1,.14,0l.95-.06,1.07.62,9.39,17.64a13.79,13.79,0,0,0,18.64,5.69l5.19-2.76a8.94,8.94,0,0,0,1,3l1.67,3.15a9,9,0,0,0,12.18,3.71l12.62-6.71,3.27-1.74A9,9,0,0,0,269.12,176l-1.68-3.15a8.78,8.78,0,0,0-1.94-2.47l1-.51a13.79,13.79,0,0,0,5.7-18.64l-14.6-27.45L204.21,23.52a13.78,13.78,0,0,0-18.64-5.69l-3.91,2.08A1.17,1.17,0,0,1,180,18.44a8.92,8.92,0,0,0-.51-7.3L177.86,8a9,9,0,0,0-12.17-3.72L149.8,12.73a9,9,0,0,0-3.72,12.17L147.75,28a9,9,0,0,0,5.78,4.51,1.16,1.16,0,0,1,.31,2.16l-5.22,2.78a13.78,13.78,0,0,0-5.7,18.63l28.94,54.39a1.15,1.15,0,0,1-.77,1.67C116.05,124.94,75,174.63,75,234a125.14,125.14,0,0,0,52.31,102,1.13,1.13,0,0,1,.22,1.66,95.63,95.63,0,0,0-15.17,26.26l1.1,1.58H284.08a1.17,1.17,0,0,0,1.09-1.58l-.21-.54a95.68,95.68,0,0,0-14.8-25.5,1.14,1.14,0,0,1,.23-1.66,125.14,125.14,0,0,0,51.11-82.74,1.16,1.16,0,0,1,1.14-1h5.7a10.16,10.16,0,0,0,10.16-10.16v-8.07A10.16,10.16,0,0,0,328.34,224.11Zm-127.14,134a17.32,17.32,0,1,1,17.7-17.32A17.51,17.51,0,0,1,201.2,358.14Z"/></g></g></svg>
                    </div>
                    <div class="lab col-12 col-md-6 col-lg-6  mt-0">
                        <h1 class="" style="font-weight: 900">SAN</h1>
                        <h1 class="" style="font-weight: 900">GABRIEL</h1>
                        <h5 class="" style="font-weight: 900">Laboratorio Clínico</h5>
                    </div>
                    <div class="col-12 mt-5 text-center pr-0">
                        <h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> C/Vasquez Machicado #102.</h5>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center mt-4 pr-0">
                        <h6 class=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> 
                           <strong> Horario de Atención</strong></h6>
                        <h6 class="">de <strong>Lunes a Viernes</strong> de  07:00 a 19:00</h6>
                        <h6 class=""><strong>Sábados</strong> de 07:00 a 12:00</h6>
                        <h6 class=""><strong>DOMINGOS Y EMERGNECIAS</strong> LAS 24 HORAS</h6>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center mt-4 pr-0">
                        <h6 class=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> 
                           <strong> Oficina: </strong>73894545</h6>
                        <h6 class=""><strong> Emergencias:</strong> 73894545</h6>
                    </div>
                </div>
            {{--<div class="content">
                <div class="title m-b-md">
                    Lab. Clínico "San Gabriel"
                </div>
                <div class="links">
                    <strong>2020</strong>
                </div>
               
            </div>--}}
        </div>
    </body>
</html>
