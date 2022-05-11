<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <div class="px-6 pb-4 sm:px-20 bg-white border-b border-gray-200">
                

                    <div class="mt-8 text-2xl">
                    <h2>Reporte estrategico 1</h2>
                    </div>
                    <h6>Cantidad de servicios sociales que han sido finalizados ordenados por su tipo mostrando la cantidad de alumnos que participaron en el servicio social. 
                    </h6>
                      <div class="card card-body">
                       <div class="row">
                             <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_inicio" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Fecha Fin</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_fin" aria-describedby="emailHelp">
                                </div>
                            </div>
                          
                             <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Tipo servicio</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="tipo_servicio">
                                        <option value=0 selected>Seleccione un tipo de servicio</option>
                                        @foreach ($tipos as $tipo)
                                            <option value={{$tipo->id}}>{{$tipo->nombre_tipo_servicio}}</option>
                                        @endforeach
                                       
                                    </select>
                                </div>
                            </div>
                            <div>
                                <a class="btn btn-primary" onclick="actualizarfiltros()">Aplicar filtro</a>
                                   <a class="btn btn-info" onclick="limpiarfiltros()">limpiar Filtros</a>
                            </div>
                       </div>
                    </div>
                  

                    {{--aqui se muestra la tabla---}}
                    <div class="my-4" id="tablita" name="tablita">
                    </div>

                    <div class="text-right">
                        <a class="btn btn-success">Descargar PDF</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    $( document ).ready(function() {
        actualizarfiltros();
    });

    function actualizarfiltros(){
        fecha_inicio = document.getElementById("fecha_inicio").value;
        fecha_fin = document.getElementById("fecha_fin").value;
        tipo_servicio = document.getElementById("tipo_servicio").value;
   
        var url = '{{ route("filtrar.e.uno", ['fecha_inicio'=>"afecha_inicio",'fecha_fin'=>"afecha_fin",'tipo_servicio'=>"atipo_servicio"]) }}';
        url = url.replace('afecha_inicio', fecha_inicio);
        url = url.replace('afecha_fin', fecha_fin);
        url = url.replace('atipo_servicio', tipo_servicio);
        url = url.replace(/&amp;/g, '&');
      
        $.get(url,{},function(data,status){
            $("#tablita").html(data); 
        });

    }
    function limpiarfiltros(){
        document.getElementById("fecha_inicio").value="";
        document.getElementById("fecha_fin").value="";
        document.getElementById("tipo_servicio").value=0;
        actualizarfiltros();
    }
</script>  

