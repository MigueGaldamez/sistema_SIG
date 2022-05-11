<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <div class="px-6 pb-4 sm:px-20 bg-white border-b border-gray-200">
                

                    <div class="mt-8 text-2xl">
                    <h2>Reporte tactico 2</h2>
                    </div>
                    <h6>Reporte que muestre las instituciones que tienen servicios sociales activos o inactivos en un periodo determinado. 
                    </h6>
                      <div class="card card-body">
                       <div class="row">
                             <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">Well never share your email with anyone else.</div>
                                </div>
                            </div>
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Fecha Fin</label>
                                    <input type="date" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">Well never share your email with anyone else.</div>
                                </div>
                            </div>
                            <div>
                                <a class="btn btn-primary">Aplicar filtro</a>
                            </div>
                       </div>
                    </div>
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
                    <div class="text-right">
                        <a class="btn btn-success">Descargar PDF</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


