<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <div class="px-6 pb-4 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        <h2>Reporte táctico 1</h2>
                    </div>
                    <h6>Cantidad de alumnos que están realizando su servicio social por facultad. (Detalle de los servicios, carrera y cantidad de alumnos por servicio) 
                    </h6>
                    <div class="card card-body">
                       <div class="row">
                             <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">Es importante que tome en cuenta la fecha de creacion de la Petición.</div>
                                </div>
                            </div>
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Fecha Fin</label>
                                    <input type="date" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Facultad</label>
                                    <select class="form-select form-select-sm" aria-label="Default select example">
  <option selected>Seleccione una facultad</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
                                </div>
                            </div>
                           
                             
                            <div>
                                <a class="btn btn-primary">Aplicar filtro</a>
                            </div>
                       </div>
                    </div>
                    <h4 class="mt-3">Total de estudiantes con servicio activo: <b>{{$consulta}}</b></h4>
                    <table class="table table-striped">
                        <thead class="table-dark "> 
                            <tr>
                            <th scope="col">Facultad </th>
                            <th scope="col">Cantidad de estudiantes</th>
                          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consulta2 as $record )
                            <tr>
                                <td>{{$record->nombre_facultad}}</td>
                            <td>{{$record->estudiantes}}</td>
                            </tr>
                            @endforeach         
                        </tbody>
                    </table>
                    <div class="text-right">
                        <a class="btn btn-success">Descargar PDF</a>
                    </div>
                </div>     
            </div>
        </div>
    </div>
   
</x-app-layout>


