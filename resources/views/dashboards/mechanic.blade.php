{{-- resources/views/dashboards/mechanic.blade.php --}}

<div class="space-y-8">
    <h3 class="text-2xl font-semibold text-gray-800 border-b pb-2">Monteur: Actieve Assemblagetaken</h3>
    <form method="POST" action="{{ route('vehicles.store') }}">
        @csrf

        <div class="space-y-6">

            {{-- Vehicle name --}}
            <input type="text" name="name" placeholder="Voertuignaam"
                class="w-full border rounded p-2">

            {{-- Chassis --}}
            <div>
                <h4 class="font-bold">Chassis</h4>
                <select name="chassis_module_id" class="w-full border p-2">
                    @foreach($modules['chassis'] ?? [] as $chassis)
                        <option value="{{ $chassis->id }}">
                            {{ $chassis->name }} (€{{ $chassis->cost }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Drive --}}
            <div>
                <h4 class="font-bold">Aandrijving</h4>
                <select name="drive_module_id" class="w-full border p-2">
                    @foreach($modules['drive'] ?? [] as $module)
                        <option value="{{ $module->id }}">
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Wheels --}}
            <div>
                <h4 class="font-bold">Wielen</h4>
                <select name="wheels_module_id" class="w-full border p-2">
                    @foreach($modules['wheels'] ?? [] as $module)
                        <option value="{{ $module->id }}">
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Steering --}}
            <div>
                <h4 class="font-bold">Stuur</h4>
                <select name="steering_module_id" class="w-full border p-2">
                    @foreach($modules['steering'] ?? [] as $module)
                        <option value="{{ $module->id }}">
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Seats (optional) --}}
            <div>
                <h4 class="font-bold">Stoelen (optioneel)</h4>
                <select name="seats_module_id" class="w-full border p-2">
                    <option value="">Geen</option>
                    @foreach($modules['seats'] ?? [] as $module)
                        <option value="{{ $module->id }}">
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded">
                Opslaan
            </button>
        </div>
    </form>
</div>