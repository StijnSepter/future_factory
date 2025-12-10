{{-- resources/views/dashboards/viewer_content.blade.php --}}
<div class="space-y-6">
    <h3 class="text-2xl font-semibold text-gray-800 border-b pb-2">Klant: Voertuig Volgen</h3>
    <p class="text-gray-600">Volg de actuele status en verwachte leverdatum van uw voertuigen.</p>

    <div class="bg-green-50 p-6 rounded-lg shadow-md border border-green-200 space-y-4">
        <h4 class="text-lg font-bold text-green-700">Uw Bestellingen</h4>
        <ul class="text-sm space-y-3">
            {{-- Example vehicle 1 --}}
            <li class="border-b pb-2">
                <p class="font-semibold">Bestelling #A987 - Personenauto</p>
                <div class="flex justify-between text-gray-600">
                    <span>Status: <span class="text-yellow-600 font-medium">Assemblage Bezig</span></span>
                    <span>Voortgang: <span class="font-medium">65%</span></span>
                </div>
            </li>
            {{-- Example vehicle 2 --}}
            <li class="border-b pb-2">
                <p class="font-semibold">Bestelling #B123 - Step</p>
                <div class="flex justify-between text-gray-600">
                    <span>Status: <span class="text-green-600 font-medium">Kwaliteitscontrole</span></span>
                    <span>Voortgang: <span class="font-medium">95%</span></span>
                </div>
            </li>
        </ul>
    </div>
</div>