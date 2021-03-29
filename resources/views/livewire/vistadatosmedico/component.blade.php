<div class="row layout-top-spacing">
    <div class="div col-sm-12 col-md-12 col-lg-12 layout-spacing">
        @if ($action == 1)
            <div class="widget-content-area br-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 text-center my-3">
                            <h5><b>Exámenes solicitados</b></h5>
                            <hr>
                        </div>
                        @foreach ($medico as $p)
                        <div class="col-sm-12 col-md-6 offset-md-3">
                            <div class="row">
                                <div class="col-lg-6  col-sm-12">
                                    <b>Nombres:</b> {{ $p->name }} {{ $p->last_name }}. <br>
                                    <b>Celular:</b> {{ $p->cel }} <br>
                                    <b>Especialidad:</b> {{ $p->speciality }} <br>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                   
                                    <b>Fecha de Registro:</b> {{ $p->created_at }}<br>
                                    <b>Estado:</b> 
                                    @if ($p->state == 'Activo')
                                    <strong class="text-success">{{ $p->state }}<br></strong>
                                    @else
                                    <strong class="text-danger">{{ $p->state }}<br></strong>
                                    @endif
                                    <b>Exámenes solicitados: </b>{{ $numero_de_solicitudes}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <hr>
                </div>
                <!-- tabla -->
                <div class="row">
                    <div class="col-lg-8 offset-md-2">
                        @include('common.search',['crear' => 'solicitudes_crear']) <!-- búsqueda y botón para nuevos registros -->
                    </div>
                    
                    <div class="col-lg-8 offset-md-2 col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                <thead>
                                    <tr>
                                        <th>N.S.</th>
                                        <th>Paciente</th>
                                        <th class="pr-0">Tipo de Atención</th>
                                        <th>Fecha solicitud</th>
                                        <th>Resultados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $r)
                                        <tr>
                                            <td>{{ $r->num_solicitud }}</td>
                                            <td>{{ $r->name }} {{ $r->last_name }}</td>
                                            <td class="pr-0">{{ $r->attention }}</td>
                                            <td>{{ $r->solicitud_date }}</td>
                                            <td class="text-center">
                                                @if ($r->state_pago == "CANCELADO")
                                                <a href="javascript:void(0);" onclick="Imprimir('{{$r->num_solicitud}}')" data-toggle="tooltip"data-placement="top" style="cursor:pointer;" title="Imprimir resultados"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text text-secondary"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $solicitudes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @elseif($action == 2)
        @include('livewire.resultados.form')
        @endif
    </div>
</div>
<script>
    function Imprimir(id) {
        let me = this
            swal({
                title: 'CONFIRMAR',
                text: '¿Quiere descargar los resultados?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('Pdf', id)    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                swal.close()   //cerramos la modal
            })

    }
</script>