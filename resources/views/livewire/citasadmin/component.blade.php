<div class="row layout-top-spacing">
    <div class="div col-sm-12 col-md-12 col-lg-12 layout-spacing">
        @if ($action == 1)
            <div class="widget-content-area br-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5><b>Confirmación de Citas</b></h5>
                        </div>
                 
                    </div>
                </div>
                @include('common.search2') <!-- búsqueda y botón para nuevos registros -->
                <!-- tabla -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Paciente</th>
                                <th>Motivo</th>
                                <th>Nro. Ci</th>
                                <th>Estado</th>       
                                <th>Fecha de cita</th>
                                <th>Fecha solicitud</th>
                                <th>Acciones</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($info as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->name }} {{ $r->last_name }}</td>
                                    <td>{{ $r->title }}</td>
                                    <td>{{ $r->nro_ci }}</td>
                                    @if ($r->state == "SINCONFIRMAR")
                                    <td>
                                        @can('confirmar_citas')
                                        <a href="javascript:void(0);"onclick="Confirm('{{$r->id}}')">
                                        @endcan
                                            <span style="cursor:pointer;" class="badge badge-danger">{{ $r->state }}</span>
                                        </a>
                                    </td>
                                    @else
                                    <td>
                                        @can('confirmar_citas')
                                        <a href="javascript:void(0);"onclick="Confirm('{{$r->id}}')">
                                        @endcan
                                            <span style="cursor:pointer;" class="badge outline-badge-success">{{ $r->state }}</span>
                                        </a>
                                    </td>
                                    @endif
                                    <td class="pr-0">{{ $r->start }}</td>
                                    <td>{{ $r->created_at }}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li>
                                                <a href="javascript:void(0);"          		
                                                onclick="eliminar('{{$r->id}}')"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                            </li>
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
<script>

    function Confirm(id) {
        let me = this
            swal({
                title: 'CAMBIAR DE ESTADO LA CITA',
                text: '¿DESEA CONFIRMAR EL CAMBIO?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#e7515a',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('change_state', id)    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                swal.close()   //cerramos la modal
            })

    }
    function eliminar(id) {
        let me = this
            swal({
                title: 'CONFIRMAR',
                text: '¿DESEAS ELIMINAR EL REGISTRO?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                console.log('ID', id);
                window.livewire.emit('deleteRow', id)    //emitimos evento deleteRow
                toastr.success('info', 'Cita eliminada con éxito') //mostramos mensaje de confirmación 
                swal.close()   //cerramos la modal
            })

    }
</script>