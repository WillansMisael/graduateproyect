@section('STYLES')
    <link href="{{ asset('assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
@endsection   
            <div class="layout-px-spacing">

                
                <!-- CONTENT AREA -->
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        <div class="widget-content-area br-4">
                            <div class="widget-one">
                                
                                <div id="ct" class="">
                                    <h3 class="text-center mb-3">Reporte de solicitudes por fechas</h3>
                                        <hr>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3 col-lg-3 ">
                                            <b>Fecha de Consulta</b>: {{\Carbon\Carbon::now()->format('d-m-Y')}}
                                            <br>
                                            <b>Cantidad Solicitudes</b>: {{ $info->count() }}
                                            <br>
                                            <b>Total Ingresos</b>: {{ number_format($sumaTotal,2) }} Bs.
                                        </div>
                                        <div class="col-sm-12 col-md-2 col-lg-2"><b>Fecha inicial</b>
                                            <div class="form-group">           
                                                <input wire:model="fecha_ini" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Haz click">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-2 col-lg-2 text-left">
                                            <div class="form-group"><b>Fecha final</b>
                                                <input wire:model.lazy="fecha_fin" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Haz click">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-2 col-lg-2 mt-4 text-left">
                                            <div class="btn-group dropright mr-2" role="group">
                                                <button id="btnDropRight" type="button" class="btn color-lab dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></button>
                                                <div class="dropdown-menu" aria-labelledby="btnDropRight">
                                                    <a href="javascript:void(0);" class="dropdown-item" onclick="PDF()">Descargar exámenes realizados</a>
                                                    <a href="javascript:void(0);" class="dropdown-item" onclick="EXPORT_EXCEL()">Descargar reporte en excel</a>
                                                    <a href="javascript:void(0);" class="dropdown-item" onclick="GUARDAR()">Guardar reporte</a>
                                                    <a href="javascript:void(0);" class="dropdown-item"data-toggle="modal" data-target="#exampleModal">Archivos guardados</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive mt-3">
                                            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                                <thead>
                                                    <tr>                                                   
                                                        <th class="text-center">#SolIcitud</th>                 
                                                        <th class="text-center">PACIENTE</th>
                                                        <th class="text-center">MÉDICO</th>
                                                        <th class="text-center">ATENCIÓN</th>
                                                        <th class="text-center">TOTAL (Bs.)</th>
                                                        <th class="text-center">PAGO (Bs.)</th>
                                                        <th class="text-center">ESTADO</th>
                                                        <th class="text-center">FECHA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($info as $r)
                                                    <tr>
                                                        <td class="text-center">{{$r->id}}</td>
                                                        <td class="text-center">{{$r->paciente}}</td>
                                                        <td class="text-center">{{$r->medico}}</td>
                                                        <td class="text-center">{{$r->attention}}</td>
                                                        <td class="text-center">{{$r->total}}</td>
                                                        <td class="text-center">{{$r->pago}}</td>
                                                        <td class="text-center">{{$r->state_result}}</td>
                                                        <td class="text-center">{{$r->solicitud_date}}</td>                                                    
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                        data-toggle="tooltip" data-placement="top" title="Eliminar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>    
                    </div>
                @endforeach
            </div>
        </div>
      </div>
    </div>
  </div>

                <!-- CONTENT AREA -->

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
                window.livewire.emit('PDF')    //emitimos evento deleteRow                swal.close()   //cerramos el modal
                swal.close()   //cerramos el modal
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
                window.livewire.emit('GUARDAR')    //emitimos evento deleteRow                swal.close()   //cerramos el modal
                swal.close()   //cerramos el modal
                $('#exampleModal').modal('hide')
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
                        window.livewire.emit('EXPORT_EXCEL')    //emitimos evento deleteRow                swal.close()   //cerramos el modal
                        swal.close()   //cerramos el modal
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
                        window.livewire.emit('eliminar',name)    //emitimos evento deleteRow                swal.close()   //cerramos el modal
                        swal.close()
                        $('#exampleModal').modal('hide')   //cerramos el modal
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
                        window.livewire.emit('descargar',name)    //emitimos evento deleteRow                swal.close()   //cerramos el modal
                        swal.close()
                        $('#exampleModal').modal('hide')   //cerramos el modal
                    })
        
            }
</script>