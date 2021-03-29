@section('STYLES')
    <link href="{{ asset('assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
@endsection   
<div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        <div class="widget-content-area br-4">
                            <div class="widget-one">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3 col-lg-3"><b>Paciente</b>                                            
                                            <div class="form-group" wire:ignore>
                                                <select wire:model.lazy="pacienteselected" class="form-control searchselect" >
                                                    <option value="Buscar">Buscar...</option>
                                                    @foreach($pacientes as $p)
                                                    <option value="{{$p->id}}">{{$p->name}} {{ $p->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3"><b>Fecha inicial</b>
                                            <div class="form-group" >           
                                                <input wire:model.lazy="fecha_ini" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Haz click">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 text-left">
                                            <div class="form-group" ><b>Fecha final</b>
                                                <input wire:model.lazy="fecha_fin" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Haz click">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-1 text-left">
                                            <button type="button" wire:click.prevent="Consulta()" class="btn color-lab mt-4 ">Consultar</button>
                                            
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-1 text-left">
                                            <button type="button" wire:click.prevent="Detalle()" class="btn color-lab mt-4 ">Detallado</button>
                                            
                                        </div>
                                        <div class="col-sm-12 col-md-1 col-lg-1 mt-4 text-left">
                                                <button class="btn color-lab" onclick="PDF_Normal()">PDF</button>
                                        </div>
                                    </div><hr class="color-lab"> 
                                    <div id="ct" class="">
                                        <div class="row">
                                            @if ($vista == 0 || $vista == 1)                                            
                                                <h3 class="col-12 text-center mb-3">Reporte de solicitudes por Paciente</h3><hr class="color-lab">
                                            @endif
                                            @if ($vista == 2)                                            
                                                <h3 class="col-12 text-center mb-3">Reporte de solicitudes detallado por Paciente</h3>
                                            @endif
                                            <hr class="color-lab">
                                            <div class="col-sm-12 col-md-4 col-lg-4 offset-md-3">
                                                <b>Fecha de Consulta :</b> {{\Carbon\Carbon::now()->format('d-m-Y')}}
                                                <br>
                                                <b>Cantidad Solicitudes :</b> {{ count($solicitudes) }} 
                                                <br>
                                                <b>Total Ingresos :</b> {{ number_format($total,2) }} Bs.
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <b>Paciente :</b> {{$nombre}}
                                                <br>
                                                <b>CI :</b>{{ $ci }} 
                                                <br>
                                                <b>Edad :</b> {{ $edad }} años.
                                            </div>
                                            <hr class="color-lab">
                                            @if ($vista == 0)
                                            <div class="col-sm-12 mt-5   text-center">
                                                Realice una consulta
                                            </div>    
                                            @endif
                                            @if ($vista == 1)
                                                
                                            <div class="table-responsive mt-3">
                                                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                                    <thead>
                                                        <tr>                                                   
                                                            <th class="text-center">#Solcitud</th>                 
                                                            <th class="text-center">Fecha</th>
                                                            <th class="text-center">Código Paciente</th>
                                                            <th class="text-center">Nombre Paciente</th>
                                                            <th class="text-center">Atención</th>
                                                            <th class="text-center">Costo total (Bs.)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($solicitudes))
                                                        @foreach($solicitudes as $r)
                                                        <tr>
                                                            <td class="text-center">{{ $r->id}}</td>
                                                            <td class="text-center">{{$r->created_at}}</td>
                                                            <td class="text-center">COD-{{$r->pacient}}</td>
                                                            <td class="text-center">{{$nombre}}</td>
                                                            <td class="text-center">{{$r->attention}}</td>
                                                            <td class="text-center">{{$r->total}}</td>                                                
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <p>Sin Datos</p>
                                                        @endif
                                                    </tbody>                  
                                                </table>
                                            </div>
        
                                            @endif
                                            @if ($vista == 2)                                            
                                                
                                               <div class="col-12 mt-1">
                                                   <hr class="color-lab">
                                                   <div class="row">
                                                    <div class="col-12 col-md-6 offset-md-3 ">

                                                    
                                                    @foreach ($detalleSolicitud as $s)
                                                    <p class="mb-0"><strong>Número de Solicitud: </strong> {{$s->id }}</p> 
                                                    <p class="mb-0"><strong>Fecha: </strong>{{ $s->created_at }}</p>  
                                                    <p><strong>Tipo de atención:</strong> {{ $s->attention }}</p>  
                                                    <div class="table-responsive table-sm mt-3">
                                                        <table class="table table-bordered table-hover  table-highlight-head mb-4">
                                                            <thead>
                                                                <tr>                                                   
                                                                    <th class="text-center">Exámen</th>                 
                                                                    <th class="text-center">Precio (Bs.)</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($s->solicitud_details as $item)
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center">{{ $item->name}}</td>
                                                                    <td class="text-center">{{ $item->price }}</td>                                              
                                                                </tr>
                                                            </tbody>
                                                            @endforeach
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="1"></td>
                                                                    <td class="text-center" colspan="1">Total: {{ $s->total }} Bs.</td>
                                                                </tr>
                                                            </tfoot>                  
                                                        </table>
                                                    </div>
                                                    <hr class="color-lab">

                                                    @endforeach

                                                   </div>
                                                </div>
                                            @endif
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 
                <!-- CONTENT AREA -->

            </div>
           
        </div>
        <!--  END CONTENT AREA  -->
<script>
       function PDF_Normal() {
        let me = this
            swal({
                title: 'CONFIRMAR',
                text: '¿Quiere descargar pdf?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#e7515a',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('PDF_Normal')    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                swal.close()   //cerramos la modal
            })
        }
        function PDF_Detallado() {
        let me = this
            swal({
                title: 'CONFIRMAR',
                text: '¿Quiere descargar pdf detallado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#725298',
                cancelButtonColor: '#e7515a',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('PDF_Detallado')    //emitimos evento deleteRow                swal.close()   //cerramos la modal
                swal.close()   //cerramos la modal
            })

     }
</script>
@section('scripts')
        <script src="{{ asset('assets/js/apps/invoice.js') }}"></script>
        <script>
            //hacemos que el select2 no se recarge y envie el valor 
            $(document).ready(function() {
                $('.searchselect').select2(); 
                $('.searchselect').on('change', function (e) {
                var data = $('.searchselect').select2("val");
                @this.set('pacienteselected', data);
                });
            });
            
        </script>     
@endsection