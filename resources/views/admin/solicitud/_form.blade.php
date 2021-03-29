<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <hr>
        <div class="form-group">
            <label for="paciente_id">Paciente</label>
            <select class="form-control searchselect" name="paciente_id" id="paciente_id">
                <option value="" disabled selected>Selecccione un paciente</option>
                @foreach ($pacientes as $pacient)
                <option value="{{$pacient->id}}">{{$pacient->name}} {{$pacient->last_name}} - {{$pacient->nro_ci}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="medico_id">Médico</label>
            <select class="form-control searchselect" name="medico_id" id="medico_id">
                <option value="" disabled selected>Selecccione un médico</option>
                @foreach ($medicos as $medic)
                <option value="{{$medic->id}}">{{$medic->name}} {{$medic->last_name}} : {{$medic->speciality}}</option>
                @endforeach
            </select>  
        </div>
        <hr>
        
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <hr>
        <div class="row">
            <div class="col-8">
                <div class="form-group ">
                    <label for="examen">Examen</label>
                    <select class="form-control searchselect" id="examen">
                        <option value="" disabled selected>Selecccione un examen</option>
                        @foreach ($examenes as $item)
                        <option  value="{{$item->id}}_{{$item->name}}_{{$item->method}}_{{$item->price_normal}}_{{$item->price_emergency}}_{{$item->state}}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4 mt-4">
                <button type="button" id="agregar" class="btn color-lab btn-sm float-left">Agregar examen</button>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="table-responsive col-md-12">
                        <table id="detalles" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Examen</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Borrar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12"><label><b>Total a pagar:</b></label>
                <input type="text" class="form-control" readonly id="total_pagar" value="0.00 Bs." name="total_pagar"></div>
            <div class="col-lg-3 col-md-3 col-sm-12"><label><b>Efectivo pago:</b></label>
                <input type="number" class="form-control" required id="efectivo_pago" name="efectivo_pago" step=".01"></div>
            <div class="col-lg-3 col-md-3 col-sm-12"><label><b>Debe:</b></label>
                <input type="text" min="0" readonly class="form-control" id="efectivo_cambio" value="0.00 Bs." ></div>
            <div class="col-lg-3 col-md-3 col-sm-12"></div>
        </div>
        
    </div>
</div>
