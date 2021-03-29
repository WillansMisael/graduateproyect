<style>
    .color-res{
        border-radius: 5px;
        border: 1px solid #725298;
    }
</style>
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">
                <h5 class="text-center">
                    <b>  @if($selected_id ==0)   Resultados de exámenes    @else      	Editar resultados de exámenes   @endif  </b><hr>
                </h5>
                @include('common.messages')
                <div class="row">
                  
                    <div class="col-10 offset-2">
                        <div class="row">
                            <div class="col-3">
                                <b># Solicitud: </b>{{ $selectesSolicitud }}<br>
                                
                            </div>
                            <div class="col-3">
                                <b>Paciente: </b>{{  $paciente_nombre }} <br>
                                <b>CI: </b>{{ $paciente_ci }} <br>
                                <b>Edad: </b>{{ $paciente_nacimiento }} años.
                            </div>
                            <div class="col-3">
                                <b>Médico: </b>{{  $medico_nombre }} <br>
                                <b>Especialidad: </b>{{ $medico_especialidad }} <br>
                            </div>
                        </div>
                        <hr>
                    </div>
                    


                    <div class="table-responsive">
                        <table id="tblResultados" class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>examen</th>
                                    <th>valores</th>
                                    <th>resultados</th>
                                    <th>Valores normales</th>
                                    <th>unidad</th>
                                    <th>Observaciones</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($info2 as $r)
                                    <tr>
                                        <td>{{ $r->solicitud }}</td>
                                        <td>{{ $r->examen }}</td>
                                        <td>{{ $r->valores }}</td>
                                        <td><input type="text" list="posibles_resultados" class="res color-res" data-name="{{ $r->id }}"  value="{{ $r->result }}"></td>
                                        <td>{{ $r->rango }}</td>
                                        <td>{{ $r->unidad }}</td>
                                        <td colspan="3"><input  style="width:100%"  type="text" class="obs color-res" value="{{ $r->observation }}"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <datalist id="posibles_resultados">
                        @foreach ($posibles_resultados as $pr)
                        <option value="{{ $pr->description }}">{{ $pr->description }}</option>
                        @endforeach
                    </datalist>
                </div>
                <button type="button" wire:click="doAction(1)" class="btn btn-dark mr-1">
                    <i class="mbri-left"></i> Regresar
                </button>
                <button type="button" onclick="AsignarResultados()"  class="btn color-lab">
                    <i class="mbri-success"></i> Asignar
                </button>
            </div>
        </div>
    </div>
</div>