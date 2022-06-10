
	<!-- Component Start -->
	<div class="barralateral w-60 overflow-hidden mt-3 rounded position-fixed shadow-lg">
        <div class="flex flex-col items-center w-full border-gray-300">
            <a class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-300" href="/dashboard">
            
                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                <span class="ml-2 text-sm font-bold">Incio</span>
            </a>
        </div>
		<div class="w-full px-2">
            <h5 class="mt-3 mb-0"><a href="{{route('menu.e')}}">Reportes Estrategicos<a></h5>
			<div class="flex flex-col items-center w-full mt-2 border-t border-gray-300">
				<a class="{{(request()->routeIs('estrategicos.uno'))? 'activo ':''}}flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-300" href="{{route('estrategicos.uno')}}">
                    <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                    </svg>
					<span class="ml-2 text-sm font-medium">Reporte Estrategico 1</span>
				</a>
				<a class="{{(request()->routeIs('estrategicos.dos'))? 'activo ':''}}flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-300" href="{{route('estrategicos.dos')}}">
					<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
					</svg>
					<span class="ml-2 text-sm font-medium">Reporte Estrategico 2</span>
				</a>
				
			
			</div>
            <h5 class="mt-3 mb-0"><a href="{{route('menu.t')}}">Reportes Tacticos<a></h5>

			<div class="flex flex-col items-center w-full mt-2 border-t border-gray-300">
				<a class="{{(request()->routeIs('tacticos.uno'))? 'activo ':''}}flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-300" href="{{route('tacticos.uno')}}">
				<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
					</svg>
					<span class="ml-2 text-sm font-medium">Reporte Tactico 1</span>
				</a>
				
				<a  class="{{(request()->routeIs('tacticos.dos'))? 'activo ':''}}flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-300 " href="{{route('tacticos.dos')}}">
					<svg class="w-6 h-6 stroke-current"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
					</svg>
					<span class="ml-2 text-sm font-medium">Reporte Tactico 2</span>
				</a>
				<a class="{{(request()->routeIs('tacticos.tres'))? 'activo ':''}}flex items-center w-full h-12 px-3 mt-2 mb-2 rounded hover:bg-gray-300" href="{{route('tacticos.tres')}}">
					<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
					</svg>
					<span class="ml-2 text-sm font-medium">Reporte Tactico 3</span>
					<span class="absolute top-0 left-0 w-2 h-2 mt-2 ml-2 bg-indigo-500 rounded-full"></span>
				</a>

                
			</div>
           <h5 class="text-center mb-0"><a href="{{route('admin.bitacora')}}">Bitacora<a></h5>

		</div>
		  <a class="flex items-center justify-center w-full h-16 mt-auto perfilsidebar" href="#">
			<svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
			</svg>
			<span class="ml-2 text-sm font-medium">Perfil</span>
		</a>
        
	</div>
	<!-- Component End  -->
	
	
	


