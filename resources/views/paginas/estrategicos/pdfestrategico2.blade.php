<!DOCTYPE html>
<html>
<head>
    <title>Sistema SIG - Proyeccion Social</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lumen/bootstrap.min.css" integrity="sha384-GzaBcW6yPIfhF+6VpKMjxbTx6tvR/yRd/yJub90CqoIn2Tz4rRXlSpTFYMKHCifX" crossorigin="anonymous">
    
</head>
<body>

     <table class="table  table-borderless">
        <tr>
          <td>
            <img src="http://3.bp.blogspot.com/_xmMskQj2s-Q/TARQt2rN4mI/AAAAAAAACX8/nDbVl4LIoAc/s1600/minerva.jpg" class="" style="width:110px;">

           
          </td>
          <td colspan="4">
           <h3 class="">{{ $titulo }}</h3>
          </td>
         
        </tr>
     </table>
  
    <p>{{$descripcion}}</p>

      <h2>Total de alumnos con sus horas completas: <b></b></h2>                   
        <h5> 
            @foreach ($cuenta as $record )
                @if($record->sexo_estudiante=="Femenino")
                    <span class="badge ms-3 bg-danger p-2"> {{$record->sexo_estudiante}}</span>
                    : {{$record->total}}
                @endif
                    @if($record->sexo_estudiante=="Masculino")
                    <span class="badge  bg-primary p-2"> {{$record->sexo_estudiante}}</span>
                    : {{$record->total}}
                @endif
            @endforeach
        </h5>

    @if($fecha_fin!="" && $fecha_inicio!="")
    <span>Para el periodo: <b><span class="badge bg-success p-1">{{$fecha_inicio}}</span> - <span class="badge bg-success p-1">{{$fecha_fin}}</span></b></span>
    @endif

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
    <div class="text-end">
      <span><h6>Creado: <b>{{ $fecha }}</b></h6></span>
      <span> <h6>Por: <b>{{Auth::user()->name}}</b></h6></span>
    </div>
</body>
</html>
