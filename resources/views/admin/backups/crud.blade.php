
    <script>
        window.AppRootData = {!! json_encode([
            'csrfToken' => csrf_token(),
            'state' => ['user' => Auth::user()]
        ]) !!};
    </script>
    @extends('layouts.template')
    @section('title','Registro de Solicitudes')
    @section('options')
@endsection
@section('preference')
@endsection
@section('content')
    <div id="app" class="boxx-wrapper">
        
        <div class="album py-5 bg-light">
        
            @yield('content')
        </div>
        @stack('modals')
    </div>
    <!-- Scripts -->
    @stack('scripts')
    @endsection