@extends('layouts.template')
@section('content')
<div id="content" class="main-content">
    

    <div class="row mt-4 text-center">
        <div class="col-lg-3 mb-4">
            <div class="layout-px">
                <div class="widget-content-area">
                    <div class="widget-one">
                        <h5 class="mr-5 text-info" style="display: inline;">PACIENTES</h5>
                        <h4 style="display: inline;">{{ $num_pacientes }}</h4>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="layout-px">
                <div class="widget-content-area">
                    <div class="widget-one">
                        <h5 class="mr-5 text-secondary" style="display: inline;">MÉDICOS</h5>
                        <h4 style="display: inline;">{{ $num_medicos }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="layout-px">
                <div class="widget-content-area">
                    <div class="widget-one">
                        <h5 class="mr-5 text-info" style="display: inline;">PERSONAL</h5>
                        <h4 style="display: inline;">{{ $num_personal }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="layout-px">
                <div class="widget-content-area">
                    <div class="widget-one">
                        <h5 class="mr-5 text-secondary" style="display: inline;">SOLICITUDES</h5>
                        <h4 style="display: inline;">{{ $num_solicitudes }}</h4>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="layout-px">
                <div class="widget-content-area">
                    <div class="widget-one">
                        <!-- Helper/Metodo  genera un DIV con un id unico y es donde se monta el gráfico   -->
                        {!! $chartIngresoxMes->container() !!}


                        <!-- Helper/Metodo incluye el javascript del package Larapex--> 							
                            <script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script> 

<!-- Helper/Metodo toma la información enviada desde el controlador en formato json y genera un script para renderizar el gráfico -->
                            {{ $chartIngresoxMes->script() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="layout-px">
                    <div class="widget-content-area">
                        <div class="widget-one">
                            {!! $chartIngresoSemanal->container() !!}

                            <script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script> 

                            {{ $chartIngresoSemanal->script() }}
                        </div>
                    </div>
                </div>
            </div>



            
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing mt-3">
                <div class="widget widget-activity-three">
        
                    <div class="widget-heading">
                        <h5>
                            @can('citas_inicio')
                            <a href="{{url('citasadmin')}}">
                            @endcan
                                CITAS</a>
                        </h5>
                        <p>{{ \Carbon\Carbon::now()->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}</p>
                    </div>
        
                    <div class="widget-content">
        
                        <div class="mt-container mx-auto ps ps--active-y">
                            <div class="timeline-line">
                                @foreach ($citas as $c)
                                    @if ($c->state == "CONFIRMADO")
                                    <div class="item-timeline timeline-new">
                                        <div class="t-dot" data-original-title="" title="">
                                            <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>{{ \Carbon\Carbon::parse($c->start)->format('H:i') }}</h5> 
                                                <span class="">{{ \Carbon\Carbon::parse($c->start)->format('d-m-Y') }}</span>
                                            </div>
                                            <p>{{ $c->title }}</p>
                                            <div class="tags">
                                                <div class="badge badge-success">{{ $c->state }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="item-timeline timeline-new">
                                        <div class="t-dot" data-original-title="" title="">
                                            <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>{{ \Carbon\Carbon::parse($c->start)->format('H:i') }}</h5>
                                                <span class="">{{ \Carbon\Carbon::parse($c->start)->format('d-m-Y') }}</span>
                                            </div>
                                            <p>{{ $c->title }}</p>
                                            <div class="tags">
                                                <div class="badge badge-warning">{{ $c->state }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>                                    
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 325px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 232px;"></div></div></div>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing mt-3">
                <div class="widget-four">
                <div class="widget-heading">
                    <h5>
                        @can('solicitudes_inicio')
                        <a href="{{url('resultados')}}">
                        @endcan
                            SOLICITUDES
                        </a>
                    </h5>
                    <hr>
                </div>
                <div class="widget-content">
                    <div class="vistorsBrowser">
                        <div class="browser-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg>
                            </div>
                            <div class="w-browser-details">
                                <div class="w-browser-info">
                                    <h6>Total solicitudes</h6>
                                    <p class="browser-count"><b>{{ $num_solicitudes }}</b></p>
                                </div>
                            </div>
                        </div>

                        <div class="browser-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                            </div>
                            <div class="w-browser-details">
                                
                                <div class="w-browser-info">
                                    <h6>Solictudes sin transcribir</h6>
                                    <p class="browser-count"><b>{{ $sol_sin_transcribir }}</b></p>
                                </div>
                            </div>

                        </div>

                        <div class="browser-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                            </div>
                            <div class="w-browser-details">
                                
                                <div class="w-browser-info">
                                    <h6>Solicitudes sin entregar</h6>
                                    <p class="browser-count"><b>{{ $sol_sin_entregar }}</b></p>
                                </div>
                            </div>

                        </div>
                        
                    </div>

                </div>
                </div>
            </div>



            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing mt-3">
                <div class="widget-four">
                    <div class="widget-heading">
                        <h5>INGRESOS</h5>
                        <hr>
                    </div>
                    <div class="widget-content">
                        <div class="vistorsBrowser">
                            <div class="browser-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                </div>
                                <div class="w-browser-details">
                                    <div class="w-browser-info">
                                        <h6>Total Ingresos</h6>
                                        <p class="browser-count"><b>{{ $total_ingresos }} Bs.</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="browser-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign color-lab-text2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                </div>
                                <div class="w-browser-details">
                                    
                                    <div class="w-browser-info">
                                        <h6>Ingresos semanales</h6>
                                        <p class="browser-count"><b>{{ $total_ingresos_semanales }} Bs.</b></p>
                                    </div>
                                </div>
    
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing mt-3">
                <div class="widget-four">
                    <div class="widget-heading">
                        <h5>SOLICITUDES POR MÉDICO</h5>
                        <hr>
                    </div>
                    <div class="widget-content text-left">
                        <div class="row">
                            @foreach ($solicitudes_medicos as $sm)
                            <div class="col-10">
                                <h6><strong><svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    {{ $sm->name }} {{ $sm->last_name }}:</strong></h6>
                                </div>
                                <div class="col-2">
                                    <strong>{{ $sm->num_sol }}</strong>
                                </div>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
@endsection
