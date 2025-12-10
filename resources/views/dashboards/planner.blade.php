{{-- resources/views/dashboards/planner_content.blade.php --}}
<div class="space-y-6">
    <h3 class="text-2xl font-semibold text-gray-800 border-b pb-2">Planner: Productiebeheer</h3>
    <p class="text-gray-600">Beheer de productietaken en volg de voortgang van assemblage.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Left: Planning Actions --}}
        <div class="bg-blue-50 p-6 rounded-lg shadow-md border border-blue-200 space-y-4">
            <h4 class="text-lg font-bold text-blue-700">Planningstools</h4>
            {{-- 🚨 Updated Link to the New Vehicle Creation Form --}}
            <a href="{{ route('planner.create_vehicle') }}" class="w-full inline-block text-center py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Nieuwe Productietaak Aanmaken
            </a>
            <button class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">Taken Herindelen</button>
        </div>

        {{-- Right: Progress View --}}
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 space-y-4">
            <h4 class="text-lg font-bold text-gray-700">Voortgang Overzicht</h4>
            <ul class="text-sm space-y-2">
                <li class="flex justify-between">Vrachtwagen (ID: 101) <span class="font-medium text-yellow-500">In Assemblage (45%)</span></li>
                <li class="flex justify-between">Scooter (ID: 215) <span class="font-medium text-green-500">Voltooid (100%)</span></li>
                <li class="flex justify-between">Bus (ID: 308) <span class="font-medium text-gray-500">Wacht op Onderdelen</span></li>
            </ul>
            <a href="#" class="text-indigo-600 hover:underline text-sm block mt-2">Bekijk Volledige Planning</a>
        </div>
    </div>
</div>