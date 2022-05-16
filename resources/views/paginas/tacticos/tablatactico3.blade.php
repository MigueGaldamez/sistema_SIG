<h4 class="mt-3">Total de servicios activos: <b>{{$consulta2}}</b></h4>
<table class="table table-striped">
    <thead class="table-dark "> 
        <tr>
            <th scope="col">Tipo Servicio</th>
            <th scope="col">Carrera</th>
            <th scope="col">Facultad</th>
            <th scope="col">Cantidad de Servicios</th>    
        </tr>
    </thead>
    <tbody>
        @foreach ($consulta as $record )
        <tr>
            <td><span class="badge bg-success p-2">{{$record->nombre_tipo_servicio}}</span></td>
            <td>{{$record->nombre_carrera}}</td>
            <td>{{$record->nombre_facultad}}</td>
            <td>{{$record->servicios}}</td>
        </tr>
        @endforeach         
    </tbody>
</table>