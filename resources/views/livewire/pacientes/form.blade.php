<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">
                <h5>
                    <b>  @if($selected_id ==0)    	Agregar nuevo Paciente    @else      	Editar Paciente   @endif  </b>
                </h5>
                <div class="row">                               
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label >Nombres</label>
                        <input wire:model.lazy="name" type="text" class="form-control text-left" >	
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror  			 
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label >Apellidos</label>
                        <input wire:model.lazy="last_name" type="text" class="form-control text-left" >	
                        @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror  			 
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Carnet de Identidad</label>
                        <input wire:model.lazy="nro_ci" type="text" class="form-control text-center"  >
                        @error('nro_ci') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Fecha de nacimiento</label>
                        <input  wire:model.lazy="date_nac" id="basicFlatpickr" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Haz click">
                        @error('date_nac') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Sexo</label>
                        <select wire:model="sex" class="form-control text-center">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                        @error('sex') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Dirección</label>
                        <input wire:model.lazy="direction" type="text" class="form-control text-left"  >
                        @error('direction') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Teléfono</label>
                        <input wire:model.lazy="telephone"type="text" class="form-control text-center"  >
                        @error('telephone') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Celular</label>
                        <input wire:model.lazy="cel"type="text" class="form-control text-center"  >
                        @error('cel') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Institución</label>
                        <select name="" id="" wire:model="cod_inst"class="form-control text-center" >
                            <option value="Elegir" disabled>Elegir</option>
                            @foreach ($instituciones as $i)
                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($selected_id == 0)
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Email</label>
                        <input wire:model.lazy="email" name="email" type="email" class="form-control"  >
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
                    @endif
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label  for="Estado">Estado</label>
                        <select wire:model="state" class="form-control text-center">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                    
                </div>
                <button type="button" wire:click="doAction(1)" class="btn btn-dark mr-1">
                    <i class="mbri-left"></i> Regresar
                </button>
                <button type="button" wire:click.prevent="StoreOrUpdate() " class="btn color-lab">
                    <i class="mbri-success"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    var f1 = flatpickr(document.getElementById('basicFlatpickr'));
    $(".flatpickr").flatpickr({
                    'locale': 'es'
                });
</script>