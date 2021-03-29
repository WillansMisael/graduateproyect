<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">
                <h5>
                    <b>  @if($selected_id ==0)    	Agregar nueva Institución    @else      	Editar Institución   @endif  </b>
                </h5>
                <div class="row">                               
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label >Nombre</label>
                        <input wire:model.lazy="name" type="text" class="form-control text-left" >	
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror  			 
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Teléfono</label>
                        <input wire:model.lazy="telephone"type="text" class="form-control text-center"  >
                        @error('telephone') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Email</label>
                        <input wire:model.lazy="email" maxlength="55" type="text" class="form-control text-center"  >
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label >Dirección</label>
                        <input wire:model.lazy="direction" type="text" class="form-control text-left"  >
                        @error('direction') <span class="text-danger">{{ $message }}</span> @enderror  
                    </div>
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
                <button type="button" wire:click="StoreOrUpdate() " class="btn color-lab">
                    <i class="mbri-success"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
