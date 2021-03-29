@extends('layouts.template')
@section('title','Registro de Solicitudes')
@section('STYLES')
{!! Html::style('select/dist/css/bootstrap-select.min.css') !!}
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               
                {!! Form::open(['route'=>'solicitud.store', 'method'=>'POST']) !!}
                @if(Session::has('flash_message'))
                    <div class="alert alert-success mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                        <strong>{!! session('flash_message') !!}</strong></button>
                    </div> 
                    @endif
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <h4 class="card-title text-center">Nueva solicitud</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-12">
                            <label>Tipo </label>
                            <div class="n-chk">
                                <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                                  <input type="checkbox" id="registro" checked class="new-control-input">
                                  <span class="new-control-indicator"></span>Registro
                                </label>
                                <label class="new-control new-checkbox new-checkbox-rounded checkbox-info">
                                    <input type="checkbox" id="cotizacion" class="new-control-input">
                                    <span class="new-control-indicator"></span>Cotización
                                  </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <label>Horario de atención</label>
                            <div class="n-chk">
                                <label class="new-control new-checkbox new-checkbox-rounded checkbox-success">
                                <input type="checkbox" name="normal[]" id="normal" value="NORMAL" checked class="new-control-input form-check-input">
                                <span class="new-control-indicator"></span>Normal
                                </label>
                                <label class="new-control new-checkbox new-checkbox-rounded checkbox-danger">
                                    <input type="checkbox"name="emergencia[]" id="emergencia" value="EMERGENCIA" class="new-control-input form-check-input">
                                    <span class="new-control-indicator"></span>Emergencia
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Registro Rapido -->
                    <!-- Registro Medico -->
                    <button type="button" class="btn color-lab" data-toggle="modal" data-target="#agregar_medico">
                        Agregar Médico
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="agregar_medico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @livewire('medicos-controller',['action'=>2]) 
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Registro Medico -->
                    <button type="button" class="btn color-lab" data-toggle="modal" data-target="#agregar_paciente">
                        Agregar Paciente
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="agregar_paciente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @livewire('pacientes-controller',['action'=>2]) 
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Registro Rapido -->
                    @include('admin.solicitud._form')
                     
                     
                </div>
                <div class="card-footer text-muted">
                    <button type="submit" id="guardar" class="btn color-lab float-right">Registrar</button>
                     <a href="{{ url('/resultados') }}" class="btn btn-light">
                        Regresar
                     </a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! Html::script('js/alerts.js') !!}

{!! Html::script('select/dist/js/bootstrap-select.min.js') !!}
{!! Html::script('js/sweetalert2.all.min.js') !!}
<script>
    $(document).ready(function() {
        $('.searchselect').select2();
        $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
    });
   
    $(".close").click(function(){
      //Actualizamos la página
      location.reload();
    });
    //otra forma de refrescar la pagina
    /* $('#agregar_medico').on('hidden.bs.modal', function (event) {
        location.reload();
    })*/
    var idexamen='';
    var name;
    var method;
    var price_normal;
    var attention;
    var state;

    var existe;
    var cont = 0;
    subtotal =[];
    total = 0;
  
    $('#cotizacion').on('change',function () {
        $('#registro').prop("checked", false);
        $('#guardar').hide();
    });
    $('#registro').on('change',function () {
        $('#cotizacion').prop("checked", false);
        $('#guardar').show();
    });
    
    $('#normal').on('change',function () {
        $('#emergencia').prop("checked", false);
    });
    $('#emergencia').on('change',function () {
        $('#normal').prop("checked", false);
    });
    

    $('#examen').change(function(){
            var data_examen = $('#examen').val();
          
            var data = data_examen.split("_");
            idexamen = data[0];
            name = data[1];
            method = data[2];
            if ($('#normal').is(':checked')) {
                price_normal = data[3];
                attention = 'NORMAL';
                console.log(price_normal);
            }else{
                price_normal = data[4];
                attention = 'EMERGENCIA';
                console.log(price_normal);
            }
            state = data[5];
            $('#price').val(price_normal);
    });



    $('#agregar').click(function(){
        var data_paciente = $('#paciente_id').val();
        var data_medico = $('#medico_id').val();
            //console.log(data_paciente, data_medico);
        if(data_paciente == null || data_medico == null){
            Swal.fire({
                type: 'error',
                text: 'Seleccione un médico y paciente',
            });
        }else {
          agregar();
        }
    });

    function agregar() {
        //console.log(data);
        
            console.log(idexamen);
        if (idexamen != ""  ) {
            subtotal[cont]=parseFloat(price_normal);
            total = total+subtotal[cont];
            var row = "<tr class='text-center' id='fila"+cont+"'><td class='text-left'><input type='hidden' value='"+idexamen+"' name='idexamen[]'><input type='hidden' value='"+name+"' name='cantidad[]'>"+name+"</td><td class='text-center'><input type='hidden'value='"+price_normal+"' name='price_normal[]'>"+price_normal+" Bs.</td> <td><button class='btn btn-danger' onclick='eliminar("+cont+")'> <i class='fas fa-trash'></i> X </button> </td> </tr>";
            cont++;
            $('#detalles').append(row);
            $('#total').html(total.toFixed(2)+"Bs.");
            $('#total_pagar').val(total.toFixed(2));
        } else {
            Swal.fire({
                type: 'error',
                text: 'Elija un examen',
            })
        }
    }
    
    
    $('#efectivo_pago').keyup(function(){
            var total_pagar = $('#total_pagar').val();
            var efectivo_pago = $('#efectivo_pago').val();
            if (efectivo_pago>total_pagar) {
                var vuelto = 0;
            }else{
                var vuelto = efectivo_pago - total_pagar;
            }
            console.log(total_pagar, efectivo_pago)
            $('#efectivo_cambio').val(Math.abs(vuelto).toFixed(2)+"Bs.");

            if(efectivo_pago>total_pagar){
                $('#efectivo_pago').addClass('is-invalid');
                $('#guardar').hide();
            }else{
                $('#efectivo_pago').removeClass('is-invalid');
                $('#guardar').show();
            }
        });
    
    
    function eliminar(index) {
        total = total - subtotal[index];
        $('#total').html(total.toFixed(2)+"Bs.");
        $('#total_pagar').val(total.toFixed(2)+"Bs. ");
        $('#fila' + index).remove(); 
    }
  

</script>
@endsection
