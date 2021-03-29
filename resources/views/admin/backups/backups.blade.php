@extends('admin.backups.crud')

@section('content')
<div class="row layout-top-spacing">
    <div class="col-sm-12 col-md-12 col-lg-12 layout-spacing">
            <div class="widget-content-area br-4">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                        <strong>{!! session('flash_message') !!}</strong></button>
                    </div> 
                    @endif
                <h3 class="text-center">Respaldos del Sistema</h3>
                <div class="col-md-3 col-sm-12 offset-md-2 mt-2 mb-2 text-center">
                    @can('backup_crear')
                        <a class="nav-link" href="{{url('backup/create')}}">
                        <span class="btn color-lab">Realizar copia de seguridad</span>
                        </a>
                    @endcan
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 offset-md-2">
                    @include('admin.backups.backups-table')
                </div>
            </div>
    </div>
</div>
@endsection