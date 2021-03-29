<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">
                <h5>
                    <b>  @if($selected_id ==0)    	Agregar nueva Sub Grupo de exámenes    @else      	Editar Sub Grupo de exámenes   @endif  </b>
                </h5>
                {{-- @include('common.messages') --}}
                <div class="row">                               
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label >Nombre</label>
                        <input wire:model.lazy="name" type="text" class="form-control text-left" >	
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror  			 
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12" wire:ignore>
                        <label >Examen</label>
                        <select name="" id="" wire:model="examen"class="form-control text-center searchselect" >
                            <option value="Elegir" disabled>Elegir</option>
                            @foreach ($examenes as $i)
                            <option value="{{ $i->id }}">{{ $i->examen }} - {{ $i->grupo }}</option>
                            @endforeach
                        </select>
                        @error('examen') <span class="text-danger">{{ $message }}</span> @enderror  			 
                    </div>
                    <div class="form-group col-md-6 col-lg-4 col-sm-12">
                        <label  for="Estado">Estado</label>
                        <select wire:model="state" class="form-control text-center">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                        @error('state') <span class="text-danger">{{ $message }}</span> @enderror  			 
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
    //hacemos que el select2 no se recarge y envie el valor 
    $(document).ready(function() {
        $('.searchselect').select2(); 
        $('.searchselect').on('change', function (e) {
        var data = $('.searchselect').select2("val");
        @this.set('examen', data);
        });
    });
    
</script>     