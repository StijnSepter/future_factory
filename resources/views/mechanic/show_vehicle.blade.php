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

    <div class="mt-6 border-t pt-4 flex justify-between items-center">
        <a href="/dashboard" 
        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-md transition duration-150 ease-in-out border border-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Terug naar Dashboard
        </a>

        <h3 class="text-xl font-bold text-gray-900">
            Totale prijs: <span class="text-indigo-600">€{{ number_format($vehicle->total_cost, 2, ',', '.') }}</span>
        </h3>
    </div>

</div>
@endsection