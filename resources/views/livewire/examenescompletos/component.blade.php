<div class="row layout-top-spacing">
    <div class="div col-sm-12 col-md-12 col-lg-12 layout-spacing">
            <div class="widget-content-area br-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5><b>Lista de exámenes registrados</b></h5>
                            <h6> Total: {{ $total }}</h6>
                        </div>
                    </div>
                </div>


                @include('common.search2',['crear' => 'valoresexamenes_crear']) <!-- búsqueda y botón para nuevos registros -->
                <!-- tabla -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th>Familia</th>
                                <th>Grupo de Examen</th>
                                <th>Examenes</th>
                                <th>Sub Grupo de exámenes</th>
                                <th>Valores</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($info as $r)
                                <tr>
                                    <td>{{ $r->familia }}</td>
                                    <td>{{ $r->grupos }}</td>
                                    <td>{{ $r->examenes }}</td>
                                    @if ($r->subgrupoexamen != $r->examenes)
                                        <td>{{ $r->subgrupoexamen }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td>{{ $r->valores }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $info->links() }}
                </div>
            </div>
    </div>
</div>