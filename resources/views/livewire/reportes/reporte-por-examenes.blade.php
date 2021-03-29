@section('STYLES')
    <link href="{{ asset('assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
@endsection   
<div id="content" class="main-content">
            <div class="layout-px-spacing">

                
                <!-- CONTENT AREA -->
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        <div class="widget-content-area br-4">
                            <div class="widget-one">
                                
                                
                                <div class="row">
                                    
                                    <div class="col-sm-12 offset-md-1 col-md-2 col-lg-2"><b>Fecha inicial</b>
                                        <div class="form-group">           
                                            <input wire:model.lazy="fecha_ini" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Haz click">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-2 col-lg-2 text-left">
                                        <div class="form-group"><b>Fecha final</b>
                                            <input wire:model.lazy="fecha_fin" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Haz click">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2 text-left">
                                        <button type="button" wire:click.prevent="Cantidad()" class="btn color-lab mt-4 ">Exámenes Realizados</button>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2 text-left">
                                        <button type="button" wire:click.prevent="Ingresos()" class="btn color-lab mt-4 ">Ingresos por examen</button>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2 mt-4 text-left">
                                        <div class="btn-group dropright mr-2" role="group">
                                            <button id="btnDropRight" type="button" class="btn color-lab dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></button>
                                            <div class="dropdown-menu" aria-labelledby="btnDropRight">
                                                <a href="javascript:void(0);" class="dropdown-item" onclick="PDF()">Descargar exámenes realizados</a>
                                                <a href="javascript:void(0);" class="dropdown-item" onclick="PDF_DETALLE()">Descargar ingresos por exámenes</a>
                                                <a href="javascript:void(0);" class="dropdown-item" onclick="EXPORT_EXCEL()">Descargar reporte en excel</a>
                                                <a href="javascript:void(0);" class="dropdown-item" onclick="GUARDAR()">Guardar reporte</a>
                                                <a href="javascript:void(0);" class="dropdown-item"data-toggle="modal" data-target="#exampleModal">Archivos guardados</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ct" class="">
                                    <div class="row">
                                        @if ($vista == 0)                                            
                                            <h3 class="col-12 text-center mb-3">Cantidad de estudios realizados</h3>
                                        @endif
                                        @if ($vista == 1)                                            
                                            <h3 class="col-12 text-center mb-3">Ingresos por examen</h3>
                                        @endif
                                        @if ($vista==0)
                                        <div class="col-12 mt-1">
                                            <div class="row">
                                            <div class="col-12 col-md-6 offset-md-3 ">
                                                <p class="mb-0"><strong>Fecha de Consulta:  </strong>{{\Carbon\Carbon::now()->format('d-m-Y')}}</p> 
                                            <div class="table-responsive table-sm mt-3">
                                                 <table class="table table-bordered table-hover  table-highlight-head mb-4">
                                                     <thead>
                                                         <tr>                                                   
                                                             <th class="text-center">Examen</th>                 
                                                             <th class="text-center">Tipo de atención</th>
                                                             <th class="text-center">Precio</th>
                                                             <th class="text-center">Cantidad</th>
                                                         </tr>
                                                     </thead>
                                                     @foreach ($examenes as $e)
                                                     <tbody>
                                                         <tr>
                                                             <td class="pl-2">{{ $e->examen}}</td>
                                                             <td class="text-center">{{ $e->attention}}</td>
                                                             <td class="text-center">{{ $e->price }}</td>                                              
                                                             <td class="text-center">{{ $e->cantidad }}</td>                                              
                                                        
                                                         </tr>
                                                     </tbody>
                                                     @endforeach             
                                                 </table>
                                             </div>

                                            </div>
                                         </div>
                                     </div>
                                        @endif
                                        @if ($vista == 1)                                            
                                                
                                               <div class="col-12 mt-1">
                                                 
                                                   <div class="row">
                                                    <div class="col-12 col-md-6 offset-md-3 ">

                                                        <p class="mb-0"><strong>Fecha de Consulta:  </strong>{{\Carbon\Carbon::now()->format('d-m-Y')}}</p> 
                                                        <p class="mb-0"><strong>Total ingresos: </strong> {{ $total }} Bs.</p>
                                                        
                                                    <div class="table-responsive table-sm mt-3">
                                                        <table class="table table-bordered table-hover  table-highlight-head mb-4">
                                                            <thead>
                                                                <tr>                                                   
                                                                    <th class="text-center">Examen</th>                 
                                                                    <th class="text-center">Precio</th>
                                                                    <th class="text-center">Cantidad</th>
                                                                    <th class="text-center">Total</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($examenes as $e)
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pl-2">{{ $e->examen}}</td>
                                                                    <td class="text-center">{{ $e->price }}</td>                                              
                                                                    <td class="text-center">{{ $e->cantidad }}</td>                                              
                                                                    <td class="text-center">{{ number_format($e->cantidad * $e->price,2) }}</td>                                              
                                                                </tr>
                                                            </tbody>
                                                            @endforeach             
                                                        </table>
                                                    </div>

                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                            </div>
                        </div>
                    </div>
                </div>

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reportes guardados</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
            @foreach ($archivos as $a)
                <div class="col-11">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <a style="cursor: pointer;"onclick="DESCARGAR('{{$a}}')">{{ $a }}</a>
                </div>
                <div class="col-1">
                    <a href="javascript:void(0);"          		
                    onclick="ELIMINAR('{{$a}}')"
                    data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>    
                </div>
            @endforeach
            </div>
            
        </div>
      </div>
    </div>
  </div>

                <!-- CONTENT AREA -->

            </div>
           
        </div>
        <!--  END CONTENT AREA  -->
<script>
            function PDF() {
                let me = this
                    swal({
                        title: 'CONFIRMAR',
                        text: '¿Quiere descargar el reporte en formato PDF?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#725298',
                        cancelButtonColor: '#e7515a',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: false
                    },
                    function() {
                        window.livewire.emit('PDF_EXAMEN')    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                        swal.close()   //cerramos la modal
                    })
        
            }
            function PDF_DETALLE() {
                let me = this
                    swal({
                        title: 'CONFIRMAR',
                        text: '¿Quiere descargar el reporte en formato PDF?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#725298',
                        cancelButtonColor: '#e7515a',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: false
                    },
                    function() {
                        window.livewire.emit('PDF_EXAMEN_DETALLE')    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                        swal.close()   //cerramos la modal
                    })
        
            }
            function EXPORT_EXCEL() {
                let me = this
                    swal({
                        title: 'CONFIRMAR',
                        text: '¿Quiere descargar el reporte en formato EXCEL?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#725298',
                        cancelButtonColor: '#e7515a',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: false
                    },
                    function() {
                        window.livewire.emit('EXPORT_EXCEL')    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                        swal.close()   //cerramos la modal
                    })
        
            }
        function GUARDAR() {
        let me = this
            swal({
                title: 'CONFIRMAR',
                text: '¿Quiere guardar el reporte?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#e7515a',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('GUARDAR')    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                swal.close()   //cerramos la modal
                $('#exampleModal').modal('hide')
            })

    }
    function ELIMINAR(name) {
                let me = this
                    swal({
                        title: 'CONFIRMAR',
                        text: '¿Quiere ELIMINAR el reporte?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#725298',
                        cancelButtonColor: '#e7515a',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: false
                    },
                    function() {
                        window.livewire.emit('eliminar',name)    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                        swal.close()   //cerramos la modal
                        $('#exampleModal').modal('hide')
                    })
        
            }
            function DESCARGAR(name) {
                let me = this
                    swal({
                        title: 'CONFIRMAR',
                        text: '¿Quiere descargar el reporte en formato PDF?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#725298',
                        cancelButtonColor: '#e7515a',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: false
                    },
                    function() {
                        window.livewire.emit('descargar',name)    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                        swal.close()
                        $('#exampleModal').modal('hide')   //cerramos la modal
                    })
        
            }
        </script>
@section('scripts')
        <script src="{{ asset('assets/js/apps/invoice.js') }}"></script>
@endsection