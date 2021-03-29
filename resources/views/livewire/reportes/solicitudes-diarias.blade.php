   
            <div class="layout-px-spacing">

                
                <!-- CONTENT AREA -->
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        <div class="widget-content-area br-4">
                            <div class="widget-one">
                                
                                <div id="ct" class="">
                                    <h3 class="text-center">Reporte de Solicitudes Diarias</h3>
                                        
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 text-left">
                                            <b>Fecha de Consulta</b>: {{\Carbon\Carbon::now()->format('d-m-Y')}}
                                            <br>
                                            <b>Cantidad Solicitudes</b>: {{ $info->count() }}
                                            <br>
                                            <b>Total Ingresos</b>: {{ number_format($sumaTotal,2) }} Bs.
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8 text-right">
                                            <button class="btn color-lab" onclick="PDF()">PDF</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive mt-3">
                                            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                                <thead>
                                                    <tr>                                                   
                                                        <th class="text-center">#Solicitud</th>                 
                                                        <th class="text-center">PACIENTE</th>
                                                        <th class="text-center">MÉDICO</th>
                                                        <th class="text-center">ATENCIÓN</th>
                                                        <th class="text-center">TOTAL (Bs.)</th>
                                                        <th class="text-center">PAGO (Bs.)</th>
                                                        <th class="text-center">ESTADO</th>
                                                        <th class="text-center">FECHA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($info as $r)
                                                    <tr>
                                                        <td class="text-center">{{$r->id}}</td>
                                                        <td class="text-center">{{$r->paciente}}</td>
                                                        <td class="text-center">{{$r->medico}}</td>
                                                        <td class="text-center">{{$r->attention}}</td>
                                                        <td class="text-center">{{$r->total}}</td>
                                                        <td class="text-center">{{$r->pago}}</td>
                                                        <td class="text-center">{{$r->state_result}}</td>
                                                        <td class="text-center">{{$r->solicitud_date}}</td>                                                    
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- CONTENT AREA -->

            </div>
           
        <!--  END CONTENT AREA  -->

 <script>
     function PDF() {
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
 </script>