 <div class="widget-content-area ">
 	<div class="widget-one">
 		<form> 			   

 			<div class="row">
 				<h5 class="col-sm-12 text-center">Gestionar Usuario</h5>
 				<div class="form-group col-lg-4 col-md-4 col-sm-12"> 					
 					<label >Usuario</label>
 					<input wire:model.lazy="email" type="text" class="form-control"  placeholder="correo@gmail.com"> 	
 					@error('email') <span class="text-danger">{{ $message }}</span> @enderror		
 				</div>
 				<div class="form-group col-lg-4 col-md-4 col-sm-12"> 					
 					<label >Contraseña</label>
 					<input wire:model.lazy="password" type="password" class="form-control"  placeholder="contraseña"> 		
 					@error('password') <span class="text-danger">{{ $message }}</span> @enderror	
 				</div>
 				
 			</div>
 			<div class="row ">
 				<div class="col-lg-5 mt-2  text-left">
 					<button type="button" wire:click="doAction(1)" class="btn btn-dark mr-1">
 						<i class="mbri-left"></i> Regresar
 					</button>
 					<button type="button"
 					wire:click="StoreOrUpdate() " 
 					class="btn color-lab ml-2">
 					<i class="mbri-success"></i> Guardar
 				</button>
 			</div>
 		</div>
 	</form>
 </div>
</div>