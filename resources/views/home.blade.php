@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-12 text-center">
           
            <h5>Bienvenido/a: {{ $data->name }} {{ $data->last_name }}</h5>
            <p>Usted ingreso como: @foreach ($rol as $r) {{ $r }}@endforeach del Lab clínico "San Gabriel"</p>
                

        </div>
    </div>
</div>
@endsection
