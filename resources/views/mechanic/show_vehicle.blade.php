@extends('layouts.layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-xl">

    <h2 class="text-2xl font-bold text-indigo-700 mb-4">
        {{ $vehicle->name }}
    </h2>

    <div class="space-y-4">

       @php
    $assemblyOrder = [
        'chassis' => $vehicle->chassis,
        'drive' => $vehicle->drive,
        'wheels' => $vehicle->wheels,
        'steering' => $vehicle->steering,
        'seats' => $vehicle->seats,
    ];
@endphp

@foreach ($assemblyOrder as $type => $module)
    @if ($module)
        <div class="border p-4 rounded bg-gray-50">
            <h4 class="font-bold">
                Stap: {{ ucfirst($type) }}
            </h4>

            <p class="text-lg">{{ $module->name }}</p>

            {{-- Dependencies --}}
            @if(!empty($module->properties['depends_on']))
                <p class="text-sm text-orange-600">
                    Vereist:
                    {{ implode(', ', $module->properties['depends_on']) }}
                </p>
            @endif

            <p class="text-green-600 font-semibold">
                €{{ number_format($module->cost, 2, ',', '.') }}
            </p>
        </div>
    @endif
@endforeach

    </div>

    <div class="mt-6 border-t pt-4 text-right">
        <h3 class="text-xl font-bold">
            Totale prijs: €{{ number_format($vehicle->total_cost, 2, ',', '.') }}
        </h3>
    </div>

</div>
@endsection