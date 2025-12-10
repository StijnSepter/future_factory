{{-- resources/views/dashboards/mechanic_content.blade.php --}}
<div class="space-y-6">
    <h3 class="text-2xl font-semibold text-gray-800 border-b pb-2">Monteur: Voertuigassemblage</h3>
    <p class="text-gray-600">Als monteur heeft u toegang tot de volgende assemblagerobots en hun taken.</p>

    {{-- Robot Assembly List --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Robot 1: Heavy D --}}
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
            <h4 class="text-lg font-bold text-indigo-700 mb-2">Heavy D</h4>
            <ul class="space-y-1 text-sm text-gray-600">
                <li class="flex items-center"><span class="h-1.5 w-1.5 bg-indigo-500 rounded-full mr-2"></span>Vrachtwagen</li>
                <li class="flex items-center"><span class="h-1.5 w-1.5 bg-indigo-500 rounded-full mr-2"></span>Bus</li>
                <li class="flex items-center"><span class="h-1.5 w-1.5 bg-indigo-500 rounded-full mr-2"></span>Personenauto</li>
            </ul>
            <button class="mt-4 w-full py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Start Assemblage</button>
        </div>

        {{-- Robot 2: Hydroboy --}}
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
            <h4 class="text-lg font-bold text-indigo-700 mb-2">Hydroboy</h4>
            <ul class="space-y-1 text-sm text-gray-600">
                <li class="flex items-center"><span class="h-1.5 w-1.5 bg-indigo-500 rounded-full mr-2"></span>Step</li>
                <li class="flex items-center"><span class="h-1.5 w-1.5 bg-indigo-500 rounded-full mr-2"></span>Scooter</li>
                <li class="flex items-center"><span class="h-1.5 w-1.5 bg-indigo-500 rounded-full mr-2"></span>Fiets</li>
            </ul>
            <button class="mt-4 w-full py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Start Assemblage</button>
        </div>
        
        {{-- Robot 3: Twowheels --}}
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
            <h4 class="text-lg font-bold text-indigo-700 mb-2">Twowheels</h4>
            <ul class="space-y-1 text-sm text-gray-600">
                <li class="flex items-center"><span class="h-1.5 w-1.5 bg-indigo-500 rounded-full mr-2"></span>Fiets</li>
                <li class="flex items-center"><span class="h-1.5 w-1.5 bg-indigo-500 rounded-full mr-2"></span>Scooter</li>
            </ul>
            <button class="mt-4 w-full py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Start Assemblage</button>
        </div>
    </div>
</div> 