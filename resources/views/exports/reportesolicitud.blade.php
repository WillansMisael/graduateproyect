<table>
    <thead>
    <tr>
        <th><strong>NS.</strong></th>
        <th><strong>PACIENTE</strong></th>
        <th><strong>MÉDICO</strong></th>
        <th><strong>ATENCIÓN</strong></th>
        <th><strong>TOTAL(Bs.)</strong></th>
        <th><strong>PAGO(Bs.)</strong></th>
        <th><strong>DESCUENTO(Bs.)</strong></th>
        <th><strong>ESTADO</strong></th>
        <th><strong>FECHA</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($solicitud as $s)
        <tr>
            <td >{{$s->id}}</td>
            <td >{{$s->paciente}}</td>
            <td >{{$s->medico}}</td>
            <td >{{$s->attention}}</td>
            <td >{{$s->total}}</td>
            <td >{{$s->pago}}</td>
            <td >{{$s->discount}}</td>
            <td >{{$s->state_result}}</td>
            <td >{{$s->solicitud_date}}</td> 
        </tr>
    @endforeach
    </tbody>
</table>