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
         ddddd
        </tr>
     </table>
  
    <p>{{$descripcion}}</p>

    <h2>Total de servicios activos: <b>{{$consulta2}}</b> </h2>
    @if($fecha_fin!="" && $fecha_inicio!="")
    <span>Para el periodo: <b><span class="badge bg-success p-1">{{$fecha_inicio}}</span> - <span class="badge bg-success p-1">{{$fecha_fin}}</span></b></span>
    @endif
    @if($servicio!="")
    <br><span>Para el tipo de servicio: <span class="badge bg-info text-dark p-1"><b>{{$servicio}}</b></span></span>
    @endif

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
    <div class="text-end">
      <span><h6>Creado: <b>{{ $fecha }}</b></h6></span>
      <span> <h6>Por: <b>{{Auth::user()->name}}</b></h6></span>
    </div>
</body>
</html>
