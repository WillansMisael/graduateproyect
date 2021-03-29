<div class="row layout-top-spacing">    
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
    @if($action == 1)                

        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5><b>Instituciones</b></h5>
                    </div> 
                </div>
            </div>
            @include('common.search',['crear' => 'instituciones_crear']) <!-- búsqueda y botón para nuevos registros -->
            @include('common.alerts') <!-- mensajes -->
            <button class="btn color-lab" onclick="PDF()">PDF</button>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <tr>                                                   
                            <th class="">ID</th>
                            <th class="">NOMBRE</th>
                            <th class="">TELÉFONO</th>
                            <th class="">EMAIL</th>
                            <th class="">DIRECCIÓN</th>
                            <th class="">ESTADO</th>
                            <th class="">FECHA DE CREACIÓN</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $r) <!-- iteración para llenar la tabla-->
                        <tr>

                            <td><p class="mb-0">{{$r->id}}</p></td>
                            <td>{{$r->name}}</td>
                            <td>{{$r->telephone}}</td>
                            <td>{{$r->email}}</td>
                            <td>{{$r->direction}}</td>
                            <td>{{$r->state}}</td>
                            <td>{{$r->created_at}}</td>
                            <td class="text-center">
                            @include('common.actions',['editar' => 'instituciones_editar','eliminar' => 'instituciones_eliminar']) <!-- botons editar y eliminar -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$info->links()}} <!--paginado de tabla -->
            </div>

        </div>     

    @elseif($action == 2)
    @include('livewire.instituciones.form')		
    @endif  
    </div>
    <script type="text/javascript">

        function Confirm(id)
        {

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
                toastr.success('info', 'Registro eliminado con éxito') //mostramos mensaje de confirmación 
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
    