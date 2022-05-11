<h4>Detalle en el periodo establecido</h4>
  <table class="table table-striped">
    <thead class="table-dark "> 
        <tr>
        
        <th scope="col">Petición</th>
            <th scope="col">Cantidad de Estudiantes</th>
            <th scope="col">Estado</th>
            <th scope="col">Tipo</th>
        
            <th scope="col"><span class="badge bg-primary p-2">Masculino</span></th>
            <th scope="col"><span class="badge bg-danger p-2">Femenino</span></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($consulta as $record )
        <tr>
            
            <td>{{$record->nombre_peticion}}</td>
            <td>{{$record->masculino + $record->femenino}}</td>
            <td>{{$record->estado_proyecto_social}}</td>
            <td>{{$record->nombre_tipo_servicio}}</td>
            <td>{{$record->masculino}}</td>
            <td>{{$record->femenino}}</td>
        </tr>
        @endforeach         
    </tbody>
</table>