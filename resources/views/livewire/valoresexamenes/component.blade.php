<div class="row layout-top-spacing">
    <div class="div col-sm-12 col-md-12 col-lg-12 layout-spacing">
        @if ($action == 1)
            <div class="widget-content-area br-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5><b>Valores de Exámenes Registrados</b></h5>
                        </div>
                    </div>
                </div>
                @include('common.search',['crear' => 'valoresexamenes_crear']) <!-- búsqueda y botón para nuevos registros -->
                <!-- tabla -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sub Grupo de Examen</th>
                                <th>Valor</th>
                                <th>Unidad</th>
                                <th>Rango normal</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($info as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->subgrupoexamen }}</td>
                                    <td>{{ $r->name }}</td>
                                    <td>{{ $r->unidad }}</td>
                                    <td>{{ $r->rango_normal }}</td>
                                    <td>{{ $r->state }}</td>
                                    <td class="text-center">
                                        @include('common.actions',['editar' => 'valoresexamenes_editar','eliminar' => 'valoresexamenes_eliminar']) <!-- botons editar y eliminar -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $info->links() }}
                </div>
            </div>
        @elseif($action == 2)
        @include('livewire.valoresexamenes.form')
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
</script>