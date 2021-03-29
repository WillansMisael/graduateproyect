
@if (count($backups))
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
        <thead>
            <tr>
                <th>BACKUP</th>
                <th>TAMAÑO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $backup)
                <tr>
                    <td>{{ $backup['file_name'] }}</td>
                    <td>{{ $backup['file_size'] }}</td>
                    
                    <td class="text-LEFT">
                        @can('backup_descargar')
                            <a class="btn color-lab" href="{{ url('backup/download/'.$backup['file_name']) }}">
                            <i class="fas fa-cloud-download"></i>Descargar</a>
                        @endcan
                        @can('backup_eliminar')
                        <a class="btn btn-xs btn-danger" data-button-type="delete" href="{{ url('backup/delete/'.$backup['file_name']) }}">
                            <i class="fal fa-trash"></i>
                            Eliminar
                        </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center py-5">
        <h1 class="text-muted">No existen backups</h1>
    </div>
@endif