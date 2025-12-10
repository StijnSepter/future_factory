{{-- resources/views/dashboards/mechanic_content.blade.php --}}

<div class="space-y-8">
    <h3 class="text-2xl font-semibold text-gray-800 border-b pb-2">Monteur: Actieve Assemblagetaken</h3>
    
    @forelse ($vehicles as $vehicle)
        <div class="bg-white p-6 rounded-lg shadow-xl border border-indigo-200">
            
            <div class="flex justify-between items-center mb-4 border-b pb-3">
                <h4 class="text-xl font-bold text-indigo-700">{{ $vehicle->name }}</h4>
                <span class="text-sm font-medium px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full">Status: {{ ucfirst($vehicle->status) }}</span>
            </div>

            {{-- Robot Assignment --}}
            <div class="mb-4">
                <p class="text-base font-semibold text-gray-700">Robot Toewijzing:</p>
                {{-- Dynamic Robot Assignment Logic (Simplified) --}}
                <span class="text-lg font-extrabold text-blue-600">
                    @if ($vehicle->chassis->properties['wheels'] >= 4)
                        Heavy D
                    @else
                        Hydroboy / Twowheels
                    @endif
                </span>
            </div>

            {{-- Modules/Components List --}}
            <div class="space-y-4">
                <h5 class="text-lg font-semibold text-gray-700 mt-4">Benodigde Modules (Materialen):</h5>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    
                    @php
                        // Collect all required modules into an array for easy iteration
                        $requiredModules = [
                            $vehicle->chassis,
                            $vehicle->drive,
                            $vehicle->wheels,
                            $vehicle->steering,
                            $vehicle->seats, // can be null
                        ];
                    @endphp

                    @foreach ($requiredModules as $module)
                        {{-- Check if module exists (e.g., seats might be optional/null) --}}
                        @if ($module) 
                            <div class="border p-3 rounded-md bg-gray-50 hover:bg-gray-100 transition">
                                <p class="font-bold text-gray-900">{{ $module->name }}</p>
                                <p class="text-xs text-gray-500 uppercase">{{ $module->type }}</p>
                                
                                {{-- Display Specific Properties --}}
                                @foreach ($module->properties as $key => $value)
                                    <p class="text-sm text-gray-700 truncate">
                                        {{ ucfirst(str_replace('_', ' ', $key)) }}: 
                                        <span class="font-medium">
                                            @if(is_array($value))
                                                {{ implode(', ', $value) }}
                                            @else
                                                {{ $value }}
                                            @endif
                                        </span>
                                    </p>
                                @endforeach

                                <p class="text-sm mt-1 text-red-600">Tijd: {{ $module->assembly_time_blocks }} blokken</p>
                                <p class="text-sm text-green-600">Prijs: &euro;{{ number_format($module->cost, 2, ',', '.') }}</p>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>

            {{-- Final Assembly Cost/Time --}}
            <div class="mt-6 pt-4 border-t text-right">
                <p class="text-lg font-bold text-gray-800">Totale Kosten Samenstelling: &euro;{{ number_format($vehicle->total_cost, 2, ',', '.') }}</p>
                <button class="mt-3 py-2 px-6 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Taak Voltooien</button>
            </div>

        </div>
    @empty
        <div class="text-center py-8 text-gray-500">
            <p class="text-lg">Geen actieve assemblage taken toegewezen.</p>
        </div>
    @endforelse
</div>