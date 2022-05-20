<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-1 lg:px-1">
            <div class="overflow-hidden  sm:rounded-lg">
               <div class="pb-4 pt-4 sm:px-20  border-gray-200 ">
                
                 <h2>Reportes Tacticos</h2>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                   <span>Cantidad de alumnos que están realizando su servicio social por facultad. (Detalle de los servicios, carrera y cantidad de alumnos por servicio).</span>
                                   <br><a href="{{route('tacticos.uno')}}">Ver reporte</a>
                                    <div class="text-center">
                                    <img  class="mx-auto" src="{{asset('iconos/crecimiento (2).png')}}" style="height:200px;">
                                </div>
                            </div>
                        </div>
                     
                    </div>
                      <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <span>Reporte que muestre las instituciones que tienen servicios sociales activos o inactivos en un periodo determinado.</span>
                                <br><a href="{{route('tacticos.dos')}}">Ver reporte</a>
                                <div class="text-center">
                                    <img  class="mx-auto" src="{{asset('iconos/crecimiento.png')}}" style="height:200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col">
                        <div class="card">
                            <div class="card-body">
                                   <span>Cantidad de servicios sociales que han sido finalizados ordenados por su tipo mostrando la cantidad de alumnos que participaron en el servicio social.</span>
                                   <br><a href="{{route('tacticos.tres')}}">Ver reporte</a>
                                    <div class="text-center">
                                    <img  class="mx-auto" src="{{asset('iconos/crecimiento (2).png')}}" style="height:200px;">
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


