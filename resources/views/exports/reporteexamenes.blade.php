<table>
    <thead>
    <tr>
        <th><strong>EXAMEN</strong></th>
        <th><strong>PRECIO</strong></th>
        <th><strong>CANTIDAD</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($examenes as $e)
        <tr>
            <td>{{ $e->name }}</td>
            <td>{{ $e->price }}</td>
            <td>{{ $e->cantidad }}</td>
        </tr>
    @endforeach
    </tbody>
</table>