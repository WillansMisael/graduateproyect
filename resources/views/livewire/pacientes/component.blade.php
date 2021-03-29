<div class="row layout-top-spacing">
    <div class="div col-sm-12 col-md-12 col-lg-12 layout-spacing">
        @if ($action == 1)
            <div class="widget-content-area br-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5><b>Pacientes Registrados</b></h5>
                        </div>
                    </div>
                </div>
                @include('common.search',['crear' => 'pacientes_crear']) <!-- búsqueda y botón para nuevos registros -->
                <!-- tabla -->
                <button class="btn color-lab" onclick="PDF()">PDF</button>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>CI</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Sexo</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Celular</th>
                                <th>Estado</th>
                                <th>institución</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($info as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->name }}</td>
                                    <td>{{ $r->last_name }}</td>
                                    <td>{{ $r->nro_ci }}</td>
                                    <td>{{ $r->date_nac }}</td>
                                    <td>{{ $r->sex }}</td>
                                    <td>{{ $r->direction }}</td>
                                    <td>{{ $r->telephone }}</td>
                                    <td>{{ $r->cel }}</td>
                                    <td>{{ $r->state }}</td>
                                    <td>{{ $r->cod_inst }}</td>
                                    <td class="text-center">
                                        @include('common.actions',['editar' => 'pacientes_editar','eliminar' => 'pacientes_eliminar']) <!-- botons editar y eliminar -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $info->links() }}
                </div>
            </div>
        @elseif($action == 2)
        @include('livewire.pacientes.form')
        @endif
    </div>
</div>
<script>
    function Confirm(id) {
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
                swal.close()   //cerramos la modal
            })

    }
    function PDF() {
        let me = this
            swal({
                title: 'CONFIRMAR',
                text: '¿DESEAS GENERAR PDF DE LOS REGISTROS?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('PDF')    //emitimos evento deleteRow
                swal.close()   //cerramos la modal
            })

    }
</script>