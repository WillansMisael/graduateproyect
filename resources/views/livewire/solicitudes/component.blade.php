<section id="solicitudes">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing" x-data="{ isOpen: true }" @click.away="isOpen = false">
            <div class="widget-content-area br-4">
                <div class="widget-one">
                    <!-- titulo-->
                    <div class="row">
                        @include('common.messages')
                        <div class="col-12 text-center">
                            <h5 class="text-center">Solicitudes</h5>
                        </div>
                       
                    </div>



                <div class="row">
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12">
                                <h6>Datos del Paciente</h6>
                            </div>
                            <div class="form-group col-12" x-data="{ isOpen : true }" @click.away="isOpen = false">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="la la-search"></i></div>
                                        <input type="text" class="form-control" placeholder="buscar"
                                        wire:model="buscarPaciente" 
                                        @focus="isOpen = true"
                                        @keydown.escape.tab="isOpen = false"
                                        @keydown.shift.tab="isOpen = false">
                                    </div>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i wire:click.prevent ="limpiarCliente()" class="la la-trash la-lg"></i></div>
                                    </div>
                                </div>
                                <ul class="list-group" x-show.transition.opacity="isOpen" style="cursor:pointer;">
                                    @if($buscarPaciente != '')
                                        @foreach ($pacientes as $r)
                                            @if ($r->state == 'Activo')
                                                
                                            <li wire:click="mostrarPaciente('{{ $r }}')" class="list-group list-group-item-action">
                                                <h6>{{ $r->name.' '.$r->last_name }} | <b class="text-info">{{ $r->nro_ci }}</b></h6>
                                            </li>    
                                            @endif
                                        @endforeach
                                    @endif
                                </ul><hr>
                                <p class="text-info">Paciente: <strong class="text-dark">{{$name }} {{ $last_name }}</strong></p>
                                <p class="text-info">Ci: <strong class="text-dark">{{ $nro_ci }}</strong></p>
                            </div>
                        
                            <div class="col-12">
                                <h6>Datos del Medico</h6>
                            </div>
                            <div class="form-group col-12" x-data="{ isOpen : true }" @click.away="isOpen = false">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="la la-search"></i></div>
                                    <input type="text" class="form-control"  placeholder="buscar"
                                    wire:model="buscarMedico" 
                                    @focus="isOpen = true"
                                    @keydown.escape.tab="isOpen = false"
                                    @keydown.shift.tab="isOpen = false">
                                </div>
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i  wire:click.prevent ="limpiarCliente()" class="la la-trash la-lg"></i></div>
                                </div>
                            </div>
                            <ul class="list-group" x-show.transition.opacity="isOpen" style="cursor:pointer;">
                                @if($buscarMedico != '')
                                @foreach ($medicos as $r)
                                    @if ($r->state == 'Activo')
                                        <li wire:click="mostrarMedico('{{ $r }}')" class="list-group list-group-item-action">
                                            <h6>{{ $r->name.' '.$r->last_name }} | <b class="text-info">{{ $r->speciality}}</b></h6>
                                        </li>    
                                    @endif 
                                @endforeach
                                @endif
                            </ul><hr>
                            
                            <p class="text-info">Medico: <strong class="text-dark">{{$mname }} {{ $mlast_name }}</strong></p>
                            <p class="text-info">Especialidad: <strong class="text-dark">{{ $speciality }}</strong></p>
                            </div>
                        </div>
                </div>
                    <div class="col-9 align-justify">
                        <div class="row">
                            <div class="col-12">
                                <h5>Examenes</h5>
                            </div>
                            <div class="col-12">
                                <div class="row" >
                                    <div class="col-4">
                                        <select wire:model="selectedGrupo" class="form-control">
                                            <option value="" selected>Elegir grupo</option>
                                            @foreach($grupos as $g)
                                                <option id="#grupo" value="{{ $g->id }}">{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        
                                        <select wire:model="selectedExamen" class="form-control">
                                            <option value="" selected>Elegir examen</option>
                                            @foreach($examenes as $e)
                                            <option id="#examen" value="{{ $e->id }}">{{ $e->name }} - Precio: {{ $e->price_normal }}Bs.</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    @if ($id_sol=='' && $medicoSelected!='' && $pacienteSelected!='')
                                    <div class="col-2 mt-2">
                                        <button class="btn btn-primary btn-lg" wire:click="ns()"> + nuevo</button>
                                    </div>
                                    @endif
                                    @if ($id_sol != '')
                                        
                                    <div class="col-2 mt-2">
                                        <button class="btn btn-primary btn-lg" wire:click="add()"> + Agregar</button>
                                    </div>
                                    @endif
                                    </div>
                                   
                                    
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row inv--product-table-section">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="examen_data" class="table">
                                                        <thead class="">
                                                            <tr>
                                                                <th scope="col">Solicitud</th>
                                                                <th  class="text-right" scope="col">Grupo</th>
                                                                <th class="text-right" scope="col">Examen</th>
                                                                <th class="text-right" scope="col">Precio</th>
                                                                <th class="text-right" scope="col">Accion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($examsolicitados as $es)
                                                            <tr>
                                     
                                                                <td>{{ $es->id_sol }}</td>
                                                                <td class="text-right">{{ $es->grupo }}</td>
                                                                <td class="text-right">{{ $es->examen }}</td>
                                                                <td class="text-right">{{  $es->price_normal }}</td>
                                                                <td><button class="btn btn-danger mb-2 mr-2" wire:click="borrar({{ $es->id_ex }})">Borrar</button></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12 offset-5">
                                        <div class="inv--total-amounts text-sm-right">
                                            <div class="row">
                                                <hr>
                                                <div class="col-sm-8 col-7 grand-total-title">
                                                    <h4 class="">Total : </h4>
                                                </div>
                                                <div class="col-sm-4 col-5 grand-total-amount">
                                                    <h4 class="">{{ $total }}</h4>
                                                </div>
                                                <div class="col-sm-8 col-7">
                                                    <p class="">Numero de examenes: </p>
                                                </div>
                                                <div class="col-sm-4 col-5">
                                                    <p class="">{{ $examsolicitados->count()}}</p>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script>  
    $(document).ready(function(){ 
     
     var count = 0;
    
    
    
     $('#add').click(function(){
      var grupo = '';
      var examen = '';
      
       grupo = $('#grupo').val();
       examen = $('#examen').val();
        alert(grupo +examen);
       if($('#add').text() == 'Add')
       {
        count = count + 1;
        output = '<tr id="row_'+count+'">';
        output += '<td>'+grupo+' <input type="hidden" name="hidden_first_name[]" id="first_name'+count+'" class="first_name" value="'+first_name+'" /></td>';
        output += '<td>'+examen+' <input type="hidden" name="hidden_last_name[]" id="last_name'+count+'" value="'+last_name+'" /></td>';
        output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Remove</button></td>';
        output += '</tr>';
        $('#examen_data').append(output);
       }
       else
       {
        var row_id = $('#hidden_row_id').val();
        output = '<td>'+grupo+' <input type="hidden" name="hidden_grupo[]" id="grupo'+row_id+'" class="grupo" value="'+grupo+'" /></td>';
        output += '<td>'+examen+' <input type="hidden" name="hidden_examen[]" id="examen'+row_id+'" value="'+examen+'" /></td>';
        output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'">Remove</button></td>';
        $('#row_'+row_id+'').html(output);
       }

     });
    
    

     $('#user_form').on('submit', function(event){
      event.preventDefault();
      var count_data = 0;
      $('.first_name').each(function(){
       count_data = count_data + 1;
      });
      if(count_data > 0)
      {
       var form_data = $(this).serialize();
       $.ajax({
        url:"insert.php",
        method:"POST",
        data:form_data,
        success:function(data)
        {
         $('#user_data').find("tr:gt(0)").remove();
         $('#action_alert').html('<p>Data Inserted Successfully</p>');
         $('#action_alert').dialog('open');
        }
       })
      }
      else
      {
       $('#action_alert').html('<p>Please Add atleast one data</p>');
       $('#action_alert').dialog('open');
      }
     });
     
    });  
    </script>