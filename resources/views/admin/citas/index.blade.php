@extends('layouts.template')
@section('title','Registro de Solicitudes')

<!-- Styles -->
@section('STYLES')
    <link rel="stylesheet" href="{{ asset('fullcalendar/core/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/daygrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/list/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/timegrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/bootstrap/main.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
    <style>
    	.fc-event-container a,
    	.fc-list-table .fc-list-item {
    		cursor: pointer;
    	}
</style>
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
  <div class="row mt-3 ">
      <div class="widget-content-area col-lg-10 offset-md-1 col-sm-12">
          <div class="widget-one" id="calendar"></div>
      </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Informacion de la cita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
	</h4>

        <div class="modal-body">
			<meta name="csrf-token" content="{{ csrf_token() }}" />
			<input type="hidden" name="id" id="id">
			<p id="user"></p>
      <h4 class="text-info text-center" id="title"></h4>
      <p class="my-3 text-center" id="description"></p>
      <hr>
			<div class="form-row ">
				<div class="form-group col-md-6">
					<label for="start_date">Fecha de la cita</label>
					<input class="form-control" disabled type="date" name="start_date" id="start_date" required>
				</div>

				<div class="form-group col-md-6">
					<label for="start_time">Hora de la cita</label>
            		<input class="form-control" type="time" min="09:00 a.m." max="20:00 p.m." step="600" name="start_time" id="start_time" required>
				</div>

				

				<div class="form-group col-md-12">
					<label for="color">Color</label>
            		<input class="form-control" type="color" name="color" id="color">
				</div>

				

			</div>
        </div>

        <div class="modal-footer">
            <button id="confirbtnAdd"class="btn btn-success" onclick=confirmar() >Confirmar</button>
            <button id="btnAdd" style="display:none;">Generer scita</button>
            @if ($citas_usuario == auth()->user()->id)
            <button id="btnEdit" class="btn btn-warning">Editar</button>
            @endif
            <button id="btnCancel" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('fullcalendar/core/main.js') }}"></script>
<script src="{{ asset('fullcalendar/interaction/main.js') }}"></script>
<script src="{{ asset('fullcalendar/daygrid/main.js') }}"></script>
<script src="{{ asset('fullcalendar/list/main.js') }}"></script>
<script src="{{ asset('fullcalendar/timegrid/main.js') }}"></script>
<script src="{{ asset('fullcalendar/bootstrap/main.js') }}"></script>

<script>

	var url_ = "{{ route('citas.index') }}";
  var url_show = "{{ route('citas.show', 0) }}";
  const user = {!! json_encode($citas_usuario) !!};
  function confirmar(){
            swal({
            title: "¿Esta seguro de generar la cita?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: 'blue',
            confirmButtonText: 'Si, estoy seguro!',
            cancelButtonText: "No, cancelar!"
            },
            function() {
                $('#btnAdd').click();
                swal.close()   //cerramos la modal
              });
  }
</script>

<script src="{{ asset('js/main.js') }}"></script>

@endsection