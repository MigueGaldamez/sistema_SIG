  <h4 class="mt-3">Total de estudiantes con servicio activo: <b>{{$consulta}}</b></h4>
    <table class="table table-striped">
        <thead class="table-dark "> 
            <tr>
            <th scope="col">Facultad </th>
              <th scope="col">Carrera </th>
            <th scope="col">Cantidad de estudiantes</th>
            
            </tr>
        </thead>
        <tbody>
            @foreach ($consulta2 as $record )
            <tr>
                <td>{{$record->nombre_facultad}}</td>
                 <td>{{$record->nombre_carrera}}</td>
            <td>{{$record->estudiantes}}</td>
            </tr>
            @endforeach         
        </tbody>
    </table>