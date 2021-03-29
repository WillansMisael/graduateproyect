<div class="row layout-top-spacing">
    <div class="div col-sm-12 col-md-12 col-lg-12 layout-spacing">
        @if ($action == 1)
            <div class="widget-content-area br-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5><b>Solicitudes y llenado de Resultados</b></h5>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mb-4 mt-3">
                    <div class="col-md-4 col-sm-12">
                        <div class="input-group ">
                               <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                                </div>
                                    <input type="text" wire:model="search" class="form-control" placeholder="Buscar.." aria-label="notification" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12  mt-2 mb-2 text-right">
                        @can('solicitudes_crear')
                        <a class="nav-link" href="{{route('solicitud.create')}}">
                            <span class="btn color-lab">+ Nueva solicitud</span>
                        </a>
                        @endcan
                        <a href="javascript:void(0);" class="dropdown-item"data-toggle="modal" data-target="#exampleModal"><span class="btn color-lab">Solicitudes Archivadas</span></a>
                    </div>
                </div>
                <!-- tabla -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Paciente</th>
                                <th>Médico</th>
                                <th>Costo total (Bs.)</th>
                                <th>A Cuenta (Bs.)</th>       
                                <th>Descuento (Bs.)</th>       
                                <th>Estado Pago</th>
                                <th>Estado Resultados</th>
                                <th class="pr-0">Tipo de Atención</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($info as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->paciente }}</td>
                                    <td>{{ $r->medico }}</td>
                                    <td>{{ $r->total }}</td>
                                    <td>{{ $r->pago }}</td>
                                    <td>{{ $r->discount }}</td> 
                                    @if ($r->state_pago == "DEBE")
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a data-toggle="modal" data-target="#exampleModal">
                                            
                                            <span style="cursor:pointer;" class="badge badge-danger">{{ $r->state_pago }}</span></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Descuento</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="input-group mb-4">
                                                        <input id="descuento" type="text" class="form-control" value="0.00">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Bs.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-Danger" data-dismiss="modal">Cancelar</button>
                                                    @can('saldar_cuenta_solicitud')
                                                    <button type="button" onclick="change_state_pago('{{$r->id}}')" class="btn color-lab">Seguir</button>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                    @else
                                    <td><span style="cursor:default;" class="badge outline-badge-success">{{ $r->state_pago }}</span></td>
                                    @endif
                                    @if ($r->state_result == "RECEPCIONADO")
                                        <td><a onclick="change_state_result('{{$r->id}}')"><span style="cursor:pointer;" class="badge outline-badge-danger">{{ $r->state_result}}</span></a></td>
                                    @endif
                                    @if ($r->state_result == "TRANSCRITO")
                                        <td><a onclick="change_state_result('{{$r->id}}')"><span style="cursor:pointer;" class="badge outline-badge-warning">{{ $r->state_result}}</span></a></td>
                                    @endif
                                    @if ($r->state_result == "ENTREGADO")
                                        <td><a onclick="change_state_result('{{$r->id}}')"><span style="cursor:pointer;" class="badge outline-badge-success">{{ $r->state_result}}</span></a></td>
                                    @endif
                                    <td class="pr-0">{{ $r->attention }}</td>
                                    <td>{{ $r->solicitud_date }}</td>
                                    <td class="text-center px-0">
                                        <ul class="table-controls">
                                            @can('imprimir_proforma')
                                                <li>
                                                    <a href="javascript:void(0);" onclick="Imprimir('{{$r->id}}')" data-toggle="tooltip" data-placement="top" title="Imprimir proforma"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file text-info"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></a>
                                                </li>
                                                @if ($r->state_pago=="CANCELADO" && ($r->state_result=="TRANSCRITO" || $r->state_result=="ENTREGADO"))
                                            <li>
                                                <a href="javascript:void(0);" onclick="ImprimirResultados('{{$r->id}}')" data-toggle="tooltip" data-placement="top" title="Imprimir resultados"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text text-primary"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></a>
                                            </li>
                                            @endif
                                            @endcan
                                            @can('llenado_resultados')
                                            @if ($r->state_result == "TRANSCRITO")
                                            
                                            <li>
                                                <a href="javascript:void(0);" wire:click="edit({{$r->id}})" data-toggle="tooltip" data-placement="top" title="Agregar resultados"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 text-success"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                            </li>
                                            @endif
                                            @endcan
                                            
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $info->links() }}
                </div>
            </div>
        @elseif($action == 2)
        @include('livewire.resultados.form')
        @endif
    </div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Respaldo de exámenes realizados</h5>
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
<script>


    function AsignarResultados(){

    var resultadosList = [];
    $('#tblResultados').find('.res').each(function () {  
        var valor = $(this).val();
        var id = $(this).attr("data-name");
        resultadosList.push([id, valor]);  
    });
    var obslist = [];
    $('#tblResultados').find('.obs').each(function () {  
        var obs=$(this).val();
        obslist.push(obs);
    });
    console.log(obslist);
    var n = resultadosList.length;
    console.log(n);
    console.log(resultadosList);

    let re = this
            swal({
                title: 'CONFIRMAR',
                text: '¿DESEA CONFIRMAR LOS RESULTADOS?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#e7515a',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('AsignarResultados', resultadosList, obslist) //*
                swal.close()   //cerramos la modal
            })
}



    function change_state_pago(id) {
        $('#exampleModal').modal('hide');
        let me = this
            swal({
                title: 'CONFIRMAR',
                text: '¿DESEA SALDAR LA CUENTA?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#e7515a',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('change_state_pago', id, document.getElementById('descuento').value)    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                swal.close()   //cerramos la modal
            })

    }
    function change_state_result(id) {
        $('#exampleModal').modal('hide');
        let me = this
            swal({
                title: 'CONFIRMAR',
                text: '¿DESEA CAMBIAR EL ESTADO DE LOS RESULTADOS?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#e7515a',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('change_state_result', id)    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                swal.close()   //cerramos la modal
            })

    }
    function Imprimir(id) {
        let me = this
            swal({
                title: 'CONFIRMAR',
                text: '¿Quiere descargar la proforma de solicitud?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#e7515a',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('Pdf', id)    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                swal.close()   //cerramos la modal
            })

    }
    function ImprimirResultados(id) {
        let me = this
            swal({
                title: '¿Quiere descargar los resultados?',
                text: 'Aviso* el archivo que intenta descargar será guardo como respaldo del resultado entregado al paciente.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#e7515a',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('ResultadosPdf', id)    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                swal.close()   //cerramos la modal
            })

    }
    function ELIMINAR(name) {
                let me = this
                    swal({
                        title: 'CONFIRMAR',
                        text: '¿Quiere ELIMINAR el pdf?',
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
                        swal.close()
                        $('#exampleModal').modal('hide')   //cerramos la modal
                    })
        
            } 
            function DESCARGAR(name) {
                let me = this
                    swal({
                        title: 'CONFIRMAR',
                        text: '¿Quiere descargar el pdf?',
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