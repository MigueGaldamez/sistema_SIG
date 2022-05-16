 <h4 class="mt-3">Total de instituciones con servicio activo: <b>{{$consulta2}}</b></h4>

<table class="table table-striped">
    <thead class="table-dark "> 
        <tr>
        <th scope="col">Nombre Institución </th>
        <th scope="col">Petición</th>
            <th scope="col">Cantidad de Estudiantes</th>
            <th scope="col">Estado</th>
            <th scope="col">Tipo</th>
        
        </tr>
    </thead>
    <tbody>
        @foreach ($consulta as $record )
        <tr>
            <td>{{$record->nombre_institucion}}</td>
            <td>{{$record->nombre_peticion}}</td>
            <td>{{$record->cantidad_estudiantes}}</td>
            <td>{{$record->estado_proyecto_social}}</td>
            <td>{{$record->nombre_tipo_servicio}}</td>
        </tr>
        @endforeach         
    </tbody>
</table>