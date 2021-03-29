<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <title> @yield('title') </title>

        <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" />
        <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('assets/js/loader.js') }}"></script>

        <!-- STYLES GENERALES -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('fonts/line-awesome/css/line-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.css') }}">
        <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/elements/color_library.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}"/>
        
        <!--Jquery-->      
  <!--Jquery-->      
  <!-- SECCIÓN PARA INCLUÍR ESTILOS PERSONALIZADOS EN LOS MÓDULOS DEL SISTEMA -->
        @YIELD('STYLES')

        <!-- NECESARIO PARA EL FUNCIONAMIENTO DE LIVEWIRE -->
        <livewire:styles />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


    </head>

    <body class="alt-menu sidebar-noneoverflow">
        <!-- BEGIN LOADER -->
        <div id="load_screen">
            <div class="loader">
                <div class="loader-content">
                    <div class="spinner-grow align-self-center"></div>
                </div>
            </div>
        </div>
        <!-- END LOADER -->

        <!-- BEGIN NAVBAR -->
        <div class="header-container">
            <header class="header navbar navbar-expand-sm">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-menu">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </a>

                <div class="nav-logo align-self-center">
                        <a class="navbar-brand" href="{{ url('home') }}">
                            <!--svg del microscopio-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 368 365.5"><defs><style>.cls-1{fill:#725298;}.cls-2{fill:#fff;}</style></defs><title>Recurso 2</title><g id="Capa_2" data-name="Capa 2"><g id="logo"><rect class="cls-1" width="368" height="365" rx="35.72"/><path class="cls-2" d="M328.34,224.11H229.55a10.16,10.16,0,0,0-10.16,10.16v8.07a10.16,10.16,0,0,0,10.16,10.16h39.52l2.12,2.94c-.12.38-.25.76-.38,1.14s-.31.89-.48,1.33-.28.76-.43,1.14c-.21.55-.43,1.1-.66,1.64-.16.39-.33.77-.5,1.15-.56,1.29-1.17,2.57-1.82,3.81-.21.42-.43.83-.66,1.24a66.56,66.56,0,0,1-3.92,6.36c-.28.4-.56.8-.85,1.19s-.66.9-1,1.34c-.68.9-1.39,1.79-2.12,2.65-.34.41-.7.81-1.06,1.22-.7.8-1.43,1.58-2.17,2.34-.42.44-.85.87-1.29,1.3s-.8.78-1.21,1.16l-1.24,1.13c-.41.37-.84.73-1.26,1.09s-1,.81-1.45,1.2-.77.61-1.15.9l-1.45,1.09c-.42.31-.85.61-1.28.91s-.92.64-1.39,1l-1.42.91c-.48.3-1,.6-1.44.88s-.77.46-1.16.67c-.65.38-1.3.73-2,1.08-.44.24-.89.47-1.34.69-.81.41-1.63.8-2.46,1.18l-.95.42-1.41.6c-1,.41-2,.8-3,1.16l-1,.36-1.06.35c-.94.31-1.9.6-2.86.86l-1.38.37-.55.14c-.48.12-1,.24-1.45.34s-1,.22-1.5.32l-.4.09-1.43.26-.82.14-1.28.2c-1.78.26-3.58.46-5.41.58l-1.3.08h-.24l-1.08,0-.94,0-1.52,0c-38.94,0-70.5-30.89-70.5-69,0-1.16,0-2.31.09-3.46,0-.49,0-1,.09-1.45,0-.66.1-1.31.17-2,0-.44.09-.89.15-1.32.14-1.25.33-2.49.55-3.72.07-.39.14-.78.22-1.16.16-.84.34-1.67.54-2.5.12-.54.25-1.07.39-1.6s.23-.85.35-1.27.26-.89.4-1.34c.19-.65.4-1.29.61-1.92.16-.47.33-.94.5-1.41a.42.42,0,0,1,0-.1c.09-.27.19-.54.29-.8.76-2,1.63-4,2.57-5.89.23-.48.46-1,.7-1.41l.1-.19c.22-.41.44-.82.67-1.23,1-1.76,2-3.47,3.14-5.13.21-.33.44-.66.67-1,.58-.83,1.17-1.65,1.79-2.45.28-.37.56-.73.86-1.09.41-.53.83-1,1.27-1.56.23-.27.45-.54.69-.8.63-.73,1.28-1.44,2-2.14l.92-1c.38-.39.76-.77,1.16-1.15l1.18-1.12a70.6,70.6,0,0,1,13.23-9.66c.41-.24.84-.47,1.26-.69,1-.57,2.09-1.1,3.15-1.6l1.5-.7,1.53-.66q2.33-1,4.73-1.79c.52-.18,1-.35,1.57-.51l1.08-.33,1-.27c.4-.12.81-.23,1.22-.33s1.07-.28,1.61-.4l.09,0c.53-.13,1.07-.25,1.61-.36l1.28-.26.88-.16c.4-.08.81-.15,1.22-.21.56-.09,1.13-.18,1.7-.25l1.45-.19.84-.09c.48,0,1-.1,1.44-.13l1.41-.11a.65.65,0,0,1,.14,0l.95-.06,1.07.62,9.39,17.64a13.79,13.79,0,0,0,18.64,5.69l5.19-2.76a8.94,8.94,0,0,0,1,3l1.67,3.15a9,9,0,0,0,12.18,3.71l12.62-6.71,3.27-1.74A9,9,0,0,0,269.12,176l-1.68-3.15a8.78,8.78,0,0,0-1.94-2.47l1-.51a13.79,13.79,0,0,0,5.7-18.64l-14.6-27.45L204.21,23.52a13.78,13.78,0,0,0-18.64-5.69l-3.91,2.08A1.17,1.17,0,0,1,180,18.44a8.92,8.92,0,0,0-.51-7.3L177.86,8a9,9,0,0,0-12.17-3.72L149.8,12.73a9,9,0,0,0-3.72,12.17L147.75,28a9,9,0,0,0,5.78,4.51,1.16,1.16,0,0,1,.31,2.16l-5.22,2.78a13.78,13.78,0,0,0-5.7,18.63l28.94,54.39a1.15,1.15,0,0,1-.77,1.67C116.05,124.94,75,174.63,75,234a125.14,125.14,0,0,0,52.31,102,1.13,1.13,0,0,1,.22,1.66,95.63,95.63,0,0,0-15.17,26.26l1.1,1.58H284.08a1.17,1.17,0,0,0,1.09-1.58l-.21-.54a95.68,95.68,0,0,0-14.8-25.5,1.14,1.14,0,0,1,.23-1.66,125.14,125.14,0,0,0,51.11-82.74,1.16,1.16,0,0,1,1.14-1h5.7a10.16,10.16,0,0,0,10.16-10.16v-8.07A10.16,10.16,0,0,0,328.34,224.11Zm-127.14,134a17.32,17.32,0,1,1,17.7-17.32A17.51,17.51,0,0,1,201.2,358.14Z"/></g></g></svg>
                            <span class="navbar-brand-name">Laboratorio "San Gabriel"</span>
                    </a>
                </div>

                <ul class="navbar-item flex-row mr-auto">
                </ul>
                @hasanyrole('Paciente|Medico|Administrador|Personal')
                <ul class="navbar-item flex-row nav-dropdowns">
                    <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media">
                                <!--<img src="images/user.png" class="img-fluid" alt="admin-profile">-->
                                <div class="media-body align-self-center">
                                    <h6 style="color:#725298;">@guest sin user @else  {{ Auth::user()->email }}  @endguest</h6>
                                </div>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </a>

                        <div class="dropdown-menu position-absolute animated fadeInUp"
                            aria-labelledby="user-profile-dropdown">
                            <div class="">
                               

                                <div class="dropdown-item">
                                    <form id="form1" class="form-horizontal" method="POST" action="{{ route('logout') }}">
                                        {{ csrf_field() }}
                                    </form>

                                    <a class="" onclick="document.getElementById('form1').submit();"
                                        href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-log-out">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg> Salir</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                @endhasrole
            </header>
        </div>
        <!-- END NAVBAR -->

        <!-- BEGIN MAIN CONTAINER -->
        <div class="main-container" id="container">
            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!-- BEGIN TOPBAR -->
            <div class="topbar-nav header navbar " role="banner">
                <nav id="topbar">
                    <ul class="navbar-nav theme-brand flex-row  text-center">
                        <li class="nav-item theme-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" viewBox="0 0 368 365.5"><defs><style>.cls-1{fill:#725298;}.cls-2{fill:#fff;}</style></defs><title>Recurso 2</title><g id="Capa_2" data-name="Capa 2"><g id="logo"><rect class="cls-1" width="368" height="365" rx="35.72"/><path class="cls-2" d="M328.34,224.11H229.55a10.16,10.16,0,0,0-10.16,10.16v8.07a10.16,10.16,0,0,0,10.16,10.16h39.52l2.12,2.94c-.12.38-.25.76-.38,1.14s-.31.89-.48,1.33-.28.76-.43,1.14c-.21.55-.43,1.1-.66,1.64-.16.39-.33.77-.5,1.15-.56,1.29-1.17,2.57-1.82,3.81-.21.42-.43.83-.66,1.24a66.56,66.56,0,0,1-3.92,6.36c-.28.4-.56.8-.85,1.19s-.66.9-1,1.34c-.68.9-1.39,1.79-2.12,2.65-.34.41-.7.81-1.06,1.22-.7.8-1.43,1.58-2.17,2.34-.42.44-.85.87-1.29,1.3s-.8.78-1.21,1.16l-1.24,1.13c-.41.37-.84.73-1.26,1.09s-1,.81-1.45,1.2-.77.61-1.15.9l-1.45,1.09c-.42.31-.85.61-1.28.91s-.92.64-1.39,1l-1.42.91c-.48.3-1,.6-1.44.88s-.77.46-1.16.67c-.65.38-1.3.73-2,1.08-.44.24-.89.47-1.34.69-.81.41-1.63.8-2.46,1.18l-.95.42-1.41.6c-1,.41-2,.8-3,1.16l-1,.36-1.06.35c-.94.31-1.9.6-2.86.86l-1.38.37-.55.14c-.48.12-1,.24-1.45.34s-1,.22-1.5.32l-.4.09-1.43.26-.82.14-1.28.2c-1.78.26-3.58.46-5.41.58l-1.3.08h-.24l-1.08,0-.94,0-1.52,0c-38.94,0-70.5-30.89-70.5-69,0-1.16,0-2.31.09-3.46,0-.49,0-1,.09-1.45,0-.66.1-1.31.17-2,0-.44.09-.89.15-1.32.14-1.25.33-2.49.55-3.72.07-.39.14-.78.22-1.16.16-.84.34-1.67.54-2.5.12-.54.25-1.07.39-1.6s.23-.85.35-1.27.26-.89.4-1.34c.19-.65.4-1.29.61-1.92.16-.47.33-.94.5-1.41a.42.42,0,0,1,0-.1c.09-.27.19-.54.29-.8.76-2,1.63-4,2.57-5.89.23-.48.46-1,.7-1.41l.1-.19c.22-.41.44-.82.67-1.23,1-1.76,2-3.47,3.14-5.13.21-.33.44-.66.67-1,.58-.83,1.17-1.65,1.79-2.45.28-.37.56-.73.86-1.09.41-.53.83-1,1.27-1.56.23-.27.45-.54.69-.8.63-.73,1.28-1.44,2-2.14l.92-1c.38-.39.76-.77,1.16-1.15l1.18-1.12a70.6,70.6,0,0,1,13.23-9.66c.41-.24.84-.47,1.26-.69,1-.57,2.09-1.1,3.15-1.6l1.5-.7,1.53-.66q2.33-1,4.73-1.79c.52-.18,1-.35,1.57-.51l1.08-.33,1-.27c.4-.12.81-.23,1.22-.33s1.07-.28,1.61-.4l.09,0c.53-.13,1.07-.25,1.61-.36l1.28-.26.88-.16c.4-.08.81-.15,1.22-.21.56-.09,1.13-.18,1.7-.25l1.45-.19.84-.09c.48,0,1-.1,1.44-.13l1.41-.11a.65.65,0,0,1,.14,0l.95-.06,1.07.62,9.39,17.64a13.79,13.79,0,0,0,18.64,5.69l5.19-2.76a8.94,8.94,0,0,0,1,3l1.67,3.15a9,9,0,0,0,12.18,3.71l12.62-6.71,3.27-1.74A9,9,0,0,0,269.12,176l-1.68-3.15a8.78,8.78,0,0,0-1.94-2.47l1-.51a13.79,13.79,0,0,0,5.7-18.64l-14.6-27.45L204.21,23.52a13.78,13.78,0,0,0-18.64-5.69l-3.91,2.08A1.17,1.17,0,0,1,180,18.44a8.92,8.92,0,0,0-.51-7.3L177.86,8a9,9,0,0,0-12.17-3.72L149.8,12.73a9,9,0,0,0-3.72,12.17L147.75,28a9,9,0,0,0,5.78,4.51,1.16,1.16,0,0,1,.31,2.16l-5.22,2.78a13.78,13.78,0,0,0-5.7,18.63l28.94,54.39a1.15,1.15,0,0,1-.77,1.67C116.05,124.94,75,174.63,75,234a125.14,125.14,0,0,0,52.31,102,1.13,1.13,0,0,1,.22,1.66,95.63,95.63,0,0,0-15.17,26.26l1.1,1.58H284.08a1.17,1.17,0,0,0,1.09-1.58l-.21-.54a95.68,95.68,0,0,0-14.8-25.5,1.14,1.14,0,0,1,.23-1.66,125.14,125.14,0,0,0,51.11-82.74,1.16,1.16,0,0,1,1.14-1h5.7a10.16,10.16,0,0,0,10.16-10.16v-8.07A10.16,10.16,0,0,0,328.34,224.11Zm-127.14,134a17.32,17.32,0,1,1,17.7-17.32A17.51,17.51,0,0,1,201.2,358.14Z"/></g></g></svg>
                        </li>
                        <li class="nav-item theme-text">
                            <a href="{{ url('home') }}" class="nav-link">"San Gabriel" </a>
                        </li>
                    </ul>
                    
                    
                    <ul class="list-unstyled menu-categories" id="topAccordion">
                        @hasrole('Paciente')
                        <li class="menu single-menu ">
                            <a href="{{url('home')}}" >
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    <span>INICIO</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu single-menu">
                            <a href="#citaspaciente" data-toggle="collapse" aria-expanded="true"
                                class="dropdown-toggle autodroprown">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    <span>CITAS</span>
                                </div>

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>

                            <ul class="collapse submenu list-unstyled" id="citaspaciente" data-parent="#topAccordion">
                                <li>
                                    <a href="{{ url('citas') }}">Solicitar cita </a>
                                </li>
                                {{-- <li>
                                    <a href="#">Ver mis citas</a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="menu single-menu">
                            <a href="{{ url('vistadatospaciente') }}" >
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                    <span>EXÁMENES</span>
                                </div>
                            </a>
                        </li>
                        @endhasrole
                        @hasrole('Medico')
                        <li class="menu single-menu ">
                            <a href="{{url('home')}}" >
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    <span>INICIO</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu single-menu">
                            <a href="{{ url('vistadatosmedico') }}" >
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                    <span>EXÁMENES</span>
                                </div>
                            </a>
                        </li>
                        @endhasrole
                        @hasrole('Administrador|Personal')
                        @can('menu_inicio')                            
                        <li class="menu single-menu">
                            <a href="#dashboard" data-toggle="collapse" aria-expanded="true"
                                class="dropdown-toggle autodroprown">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-chart">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>

                                    <span>INICIO</span>
                                </div>

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>

                            <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#topAccordion">
                                <li>
                                    <a href="{{ url('home') }}"> Inicio </a>
                                </li>
                                @can('reportes_graficos')
                                <li>
                                    <a href="{{ url('dash') }}"> Dash </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan

                        @can('menu_solicitudes')  
                        <li class="menu single-menu">
                            <a href="#solicitudes" data-toggle="collapse" aria-expanded="true"
                                class="dropdown-toggle autodroprown">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg>

                                    <span>SOLICITUDES</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            </a>
                                <ul class="collapse submenu list-unstyled" id="solicitudes" data-parent="#topAccordion">
                                    @can('solicitudes_inicio')
                                    <li>
                                        <a href="{{ url('/resultados') }}"> Solicitudes de exámenes</a>
                                    </li>
                                    @endcan
                                    @can('citas_inicio')
                                    <li>
                                        <a href="{{ url('/citasadmin') }}"> Confirmación de Citas </a>
                                    </li>
                                    @endcan
                                </ul>
                        </li>
                        @endcan

                        @can('menu_examenes') 
                        <li class="menu single-menu">
                            <a href="#quotation" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-clipboard">
                                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                        </path>
                                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                    </svg>

                                    <span>EXÁMENES</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>

                            <ul class="collapse submenu list-unstyled" id="quotation" data-parent="#topAccordion">
                                <li class="sub-sub-submenu-list">
                                    <a href="#examenes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Configurar exámenes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                    <ul class="collapse list-unstyled sub-submenu" id="examenes" data-parent="#examenes">
                                        @can('unidades_inicio')                                          
                                        <li>
                                            <a href="{{url('unidades')}}"> UNIDADES </a>
                                        </li>
                                        @endcan
                                        @can('familias_inicio')                                          
                                        <li>
                                            <a href="{{url('familias')}}"> FAMILIAS </a>
                                        </li>
                                        @endcan
                                        @can('grupos_inicio')                                          
                                        <li>
                                            <a href="{{url('grupos')}}"> GRUPOS DE EXÁMENES</a>
                                        </li>
                                        @endcan
                                        @can('examenes_inicio')  
                                        <li>
                                            <a href="{{url('examenes')}}">EXÁMENES</a>
                                        </li>
                                        @endcan
                                        @can('subgrupoexamenes_inicio')  
                                        <li>
                                            <a href="{{url('subgrupoexamenes')}}"> SUB GRUPO DE EXÁMENES</a>
                                        </li>
                                        @endcan
                                        @can('valoresexamenes_inicio')  
                                        <li>
                                            <a href="{{url('valoresexamenes')}}"> VALORES DE EXÁMENES</a>
                                        </li>
                                        @endcan                                                
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{url('examenescompletos')}}">Ver exámenes</a>
                                </li>

                            </ul>
                        </li>
                        @endcan

                        @can('menu_reportes') 
                        <li class="menu single-menu">
                            <a href="#reportes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-bar-chart">
                                        <line x1="12" y1="20" x2="12" y2="10"></line>
                                        <line x1="18" y1="20" x2="18" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="16"></line>
                                    </svg>

                                    <span>REPORTES</span>
                                </div>

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>

                            <ul class="collapse submenu list-unstyled" id="reportes" data-parent="#topAccordion">
                                <li class="sub-sub-submenu-list">
                                    <a href="#repor-solicitud" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Solicitudes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                    <ul class="collapse list-unstyled sub-submenu" id="repor-solicitud" data-parent="#repor-solicitud">
                                        @can('reporte_solicitudes_diarias') 
                                        <li>
                                            <a href="{{url('solicitudesdiarias')}}">Solicitudes Diarias</a>
                                        </li>
                                        @endcan
                                        @can('reporte_solicitudes_por_fechas') 
                                        <li>
                                            <a href="{{url('solicitudesporfechas')}}">Solicitudes por Fecha</a>
                                        </li>
                                        @endcan
                                        @can('reporte_solicitudes_por_paciente') 
                                        <li>
                                            <a href="{{url('solicitudesporpacientes')}}">Solicitudes por Paciente</a>
                                        </li>
                                        @endcan
                                        @can('reporte_por_examenes') 
                                        <li>
                                            <a href="{{url('reporteporexamenes')}}">Reporte por exámenes</a>
                                        </li>
                                        @endcan
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('menu_usuarios') 
                        <li class="menu single-menu">
                            <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span>USUARIOS</span>
                                </div>

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>

                            <ul class="collapse submenu list-unstyled" id="users" data-parent="#topAccordion">
                                
                                <li class="sub-sub-submenu-list">
                                    <a href="#usuariosinternos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Usuarios internos <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                    <ul class="collapse list-unstyled sub-submenu eq-animated eq-fadeInUp" id="usuariosinternos" data-parent="#usuariosinternos">
                                        @can('personal_inicio') 
                                        <li>
                                            <a href="{{url('personal')}}"> PERSONAL</a>
                                        </li>
                                        @endcan
                                    </ul>
                                </li>
                                <li class="sub-sub-submenu-list">
                                    <a href="#usuariosexternos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Usuarios externos <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                    <ul class="collapse list-unstyled sub-submenu eq-animated eq-fadeInUp" id="usuariosexternos" data-parent="#usuariosexternos">
                                        @can('instituciones_inicio') 
                                        <li>
                                            <a href="{{url('instituciones')}}"> INSTITUCIONES </a>
                                        </li>
                                        @endcan
                                        @can('medicos_inicio') 
                                        <li>
                                            <a href="{{url('medicos')}}">  MÉDICOS </a>
                                        </li>
                                        @endcan
                                        @can('pacientes_inicio') 
                                        <li>
                                            <a href="{{url('pacientes')}}"> PACIENTES </a>
                                        </li>
                                        @endcan
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        
                        @can('menu_accesos') 
                        <li class="menu single-menu">
                            <a href="#configurations" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-settings">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                        </path>
                                    </svg>

                                    <span>ACCESOS</span>
                                </div>

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>

                            <ul class="collapse submenu list-unstyled" id="configurations" data-parent="#topAccordion">
                                @can('roles_permisos')
                                <li>
                                    <a href="{{url('permisos')}}">Roles y Permisos</a>
                                </li>
                                @endcan
                                @can('usuarios_inicio')
                                <li>
                                    <a href="{{url('usuarios')}}">Credenciales de Acceso</a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                        
                        @can('menu_respaldos') 
                        <li class="menu single-menu ">
                            <a href="{{url('backups')}}">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                                    <span>RESPALDOS DEL SISTEMA</span>
                                </div>
                            </a>
                        </li>
                        @endcan
                        @endhasrole
                    </ul>
                </nav>
            </div>
            <!-- END TOPBAR -->

            <!-- BEGIN CONTENT PART -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">
                    @yield('content')
                </div>

                <div class="ml-3 mr-3">
                    @include('footer.footer')
                </div>
            </div>
            <!-- END CONTENT PART -->
        </div>
        <!-- END MAIN CONTAINER -->

        <!-- SCRIPTS GENERALES -->
        <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>

        <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>

        
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr_es.js') }}"></script>
 
       
        
        <script>
            $(document).ready(function() {
                App.init();
                $('.searchselect').select2();
                $(".flatpickr").flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    'locale': 'es'
                });
                
            });
        </script>
        <!-- SECCIÓN PARA INCLUÍR SCRIPTS PERSONALIZADOS EN LOS MÓDULOS DEL SISTEMA -->
        @yield('scripts')
        <!-- SCRIPTS PARA LOS MENSAJES Y NOTIFICACIONES -->
        <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

        <!-- VALIDACIONES GLOBALES DEL SISTEMA -->


        <!-- NECESARIO PARA EL FUNCIONAMIENTO DE LIVEWIRE -->
        <livewire:scripts />
        <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/toast.js') }}"> </script>

        @if($institucion <= 0)
            <script type="text/javascript">
              toastr.warning("NINGUNA INSTITUCION REGISTRADA.")
            </script>
        @endif
         
        @if($paciente <= 0)
            <script type="text/javascript">
              toastr.warning("NINGUN PACIENTE REGISTRADO.")
            </script>
        @endif
        @if($medico <= 0)
            <script type="text/javascript">
              toastr.warning("NINGUN MEDICO REGISTRADO.")
            </script>
        @endif
        @if($unidad <= 0)
            <script type="text/javascript">
              toastr.warning("NINGUNA UNIDAD REGISTRADA.")
            </script>
        @endif
        <script>
            window.livewire.on('msgok', msgOK => {
                toastr.success(msgOK, "info");
            });
            window.livewire.on('msg-warning', msgWarning => {
                toastr.warning(msgWarning, "Aviso");
            });
            window.livewire.on('msg-error', msgError => {
                toastr.error(msgError, "error");
            });
        </script>
    </body>
</html>
