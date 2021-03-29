<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">
                <h5 class="text-center">
                    <b>  @if($selected_id ==0)   Citas solicitadas    @else      	Editar cita   @endif  </b><hr>
                </h5>
                @include('common.messages')
                <div class="row">
                   
                    <div class="col-10 offset-2">
                        <div class="row">
                            <div class="col-3">
                                <b># Solicitud: </b>{{ $num_solicitud }}<br>
                                <b>Fecha: </b>{{ $fecha_solicitud }}<br>
                                <b> Pago a cuenta: </b>{{ $pago }}<br>
                            </div>
                            <div class="col-3">
                                <b>Paciente: </b>{{  $paciente_nombre }} <br>
                                <b>CI: </b>{{ $paciente_ci }} <br>
                                <b>Edad: </b>{{ $paciente_nacimiento }} años.
                            </div>
                        </div>
                        <hr>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="tblResultados"class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>grupo</th>
                                    <th>examen</th>
                                    <th>subgrupo</th>
                                    <th>valores</th>
                                    <th>resultados</th>
                                    <th>Valores normales</th>
                                    <th>unidad</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $c=0;    
                                @endphp
                                @foreach ($info2 as $r)
                                    <tr>
                                        <td>{{ $r->solicitud }}</td>
                                        <td>{{ $r->grupo }}</td>
                                        <td>{{ $r->examen }}</td>
                                        <td>{{ $r->subgrupo }}</td>
                                        <td>{{ $r->valores }}</td>
                                        <td><input type="text" class="res"data-name="{{ $r->id }}"  value="{{ $r->result }}"></td>
                                        <td>{{ $r->rango }}</td>
                                        <td>{{ $r->unidad }}</td>
                                        <td><input type="text" class="obs" value="{{ $r->observation }}"></td>
                                        @php
                                        $c++;    
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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