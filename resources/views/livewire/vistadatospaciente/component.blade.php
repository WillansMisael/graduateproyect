<div class="row layout-top-spacing">
    <div class="div col-sm-12 col-md-12 col-lg-12 layout-spacing">
        @if ($action == 1)
            <div class="widget-content-area br-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 text-center my-3">
                            <h5><b>Exámenes realizados</b></h5>
                            <hr>
                        </div>
                        @foreach ($paciente as $p)
                        <div class="col-sm-12 col-md-6 offset-md-3">
                            <div class="row">
                                <div class="col-lg-6  col-sm-12">
                                    <b>Nombres:</b> {{ $p->name }} {{ $p->last_name }}. <br>
                                    <b>Edad:</b> {{ Carbon\Carbon::parse($p->date_nac)->age }} años.
                                    <b>Ci:</b> {{ $p->nro_ci }}. <br>
                                    <b>Fecha Nacimiento:</b> {{ $p->date_nac }}<br>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <b>Celular:</b> {{ $p->cel }}
                                    <b>Teléfono:</b> {{ $p->telephone }} <br>
                                    <b>Fecha de Registro:</b> {{ $p->created_at }}<br>
                                    <b>Estado:</b> 
                                    @if ($p->state == 'Activo')
                                    <strong class="text-success">{{ $p->state }}<br></strong>
                                    @else
                                    <strong class="text-danger">{{ $p->state }}<br></strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <hr>
                </div>
                @include('common.search',['crear' => 'solicitudes_crear']) <!-- búsqueda y botón para nuevos registros -->
                <!-- tabla -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th>N.S.</th>
                                <th>Médico</th>
                                <th>Costo total (Bs.)</th>
                                <th>Pago (Bs.)</th>       
                                <th>Estado Pago</th>
                                <th>Estado Solicitud</th>
                                <th class="pr-0">Atención</th>
                                <th>Fecha</th>
                                <th>Resultados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solicitudes as $r)
                                <tr>
                                    <td>{{ $r->num_solicitud }}</td>
                                    <td>{{ $r->name }} {{ $r->last_name }}</td>
                                    <td>{{ $r->total }}</td>
                                    <td>{{ $r->pago }}</td>
                                    @if ($r->state_pago == "DEBE")
                                    <td><span class="badge badge-danger">{{ $r->state_pago }}</span></td>
                                    @else
                                    <td><span class="badge outline-badge-success">{{ $r->state_pago }}</span></td>
                                    @endif
                                    @if ($r->state_result == "RECEPCIONADO")
                                        <td><a onclick="change_state_result('{{$r->id}}')"><span class="badge outline-badge-danger">{{ $r->state_result}}</span></a></td>
                                    @endif
                                    @if ($r->state_result == "TRANSCRITO")
                                        <td><a onclick="change_state_result('{{$r->id}}')"><span class="badge outline-badge-warning">{{ $r->state_result}}</span></a></td>
                                    @endif
                                    @if ($r->state_result == "ENTREGADO")
                                        <td><a onclick="change_state_result('{{$r->id}}')"><span class="badge outline-badge-success">{{ $r->state_result}}</span></a></td>
                                    @endif
                                    <td class="pr-0">{{ $r->attention }}</td>
                                    <td>{{ $r->solicitud_date }}</td>
                                    <td class="text-center">
                                        @if ($r->state_result == "TRANSCRITO" || $r->state_result == "ENTREGADO")
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
