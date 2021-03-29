<div class="row layout-top-spacing">    
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
    @if($action == 1)                

        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5><b>Familias</b></h5>
                    </div> 
                </div>
            </div>
            @include('common.search',['crear' => 'familias_crear']) <!-- búsqueda y botón para nuevos registros -->
            @include('common.alerts') <!-- mensajes -->
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <tr>                                                   
                            <th class="">ID</th>
                            <th class="">NOMBRE</th>
                            <th class="">DESCRIPCIóN</th>
                            <th class="">ESTADO</th>
                            <th class="">FECHA DE CREACIóN</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $r) <!-- iteración para llenar la tabla-->
                        <tr>

                            <td><p class="mb-0">{{$r->id}}</p></td>
                            <td>{{$r->name}}</td>
                            <td>{{$r->description}}</td>
                            <td>{{$r->state}}</td>
                            <td>{{$r->created_at}}</td>
                            <td class="text-center">
                                @include('common.actions',['editar' => 'familias_editar','eliminar' => 'familias_eliminar']) <!-- botons editar y eliminar -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$info->links()}} <!--paginado de tabla -->
            </div>

        </div>     

    @elseif($action == 2)
    @include('livewire.familias.form')		
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
                swal.close()   //cerramos la modal
            })




        }
       


    </script>
    