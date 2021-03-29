    <div class="row layout-top-spacing">    
       <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
       @if($action == 1)                
          
        <div class="widget-content-area br-4">
           <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 text-center">
                    <h5><b>Usuarios del Sistema</b></h5>
                </div> 
            </div>
        </div>
      
            @include('common.search2',['crear' => 'usuarios_crear']) <!-- búsqueda y botón para nuevos registros -->
        
            @include('common.alerts') 
        
        <div class="widget-content widget-content-area animated-underline-content">
            <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> Pacientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg> Médicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="animated-underline-contact-tab" data-toggle="tab" href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg> Personal</a>
                </li>
            </ul>    
            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
 
                        @if ($recordspa > 0)                            
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                <thead>
                                    <tr>                                                                           
                                        <th class="">Usuario</th>
                                        <th class="">EMAIL</th>
                                        <th class="text-center">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($paciente as $r)
                                   <tr>
                                    <td>{{$r->npa.' '.$r->lnpa}}</td>
                                    <td>{{$r->email}}</td>
                                    <td class="text-center">
                                         @include('common.actions', ['editar' => 'usuarios_editar', 'eliminar'=> 'usuarios_eliminar'])
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$paciente->links()}}
                        </div>
                        @else
                            <p>{{ $paciente }}</p>
                        @endif
                </div>
                <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                    @if ($recordsme > 0 )
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                            <thead>
                                <tr>                                                                           
                                    <th class="">Usuario</th>
                                    <th class="">EMAIL</th>
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($medico as $r)
                               <tr>
                                <td>{{$r->nm.' '.$r->lnm}}</td>
                                <td>{{$r->email}}</td>
                                <td class="text-center">
                                     @include('common.actions', ['editar' => 'usuarios_editar', 'eliminar'=> 'usuarios_eliminar'])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$medico->links()}}
                    </div>
                    @else
                        <p>{{ $medico }}</p>
                    @endif
                </div>
                <div class="tab-pane fade active show" id="animated-underline-contact" role="tabpanel" aria-labelledby="animated-underline-contact-tab">
                    @if ($recordspe > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                            <thead>
                                <tr>                                                                           
                                    <th class="">Usuario</th>
                                    <th class="">EMAIL</th>
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($personal as $r)
                               <tr>
                                <td>{{$r->npe.' '.$r->lnpe}}</td>
                                <td>{{$r->email}}</td>
                                <td class="text-center">
                                    @include('common.actions',['editar' => 'usuarios_editar','eliminar' => 'usuarios_eliminar']) <!-- botons editar y eliminar -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$personal->links()}}
                    </div>
                    @else
                        <p>{{ $personal }}</p>
                    @endif
                </div>
            </div>                      
        </div>
</div>     

@elseif($action == 2)
@include('livewire.users.form')		
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
        window.livewire.emit('deleteRow', id)    
        swal.close()   
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