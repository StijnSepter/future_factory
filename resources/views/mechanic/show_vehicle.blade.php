@extends('layouts.layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-xl">

    <h2 class="text-2xl font-bold text-indigo-700 mb-4">
        {{ $vehicle->name }}
    </h2>

    <div class="space-y-4">

        @php
            $modules = [
                $vehicle->chassis,
                $vehicle->drive,
                $vehicle->wheels,
                $vehicle->steering,
                $vehicle->seats,
            ];
        @endphp

        @foreach ($modules as $module)
            @if ($module)
                <div class="border p-4 rounded bg-gray-50">
                    <h4 class="font-bold">{{ $module->name }}</h4>
                    <p class="text-sm text-gray-500">{{ $module->type }}</p>

                    @foreach ($module->properties as $key => $value)
                        <p class="text-sm">
                            {{ ucfirst($key) }}:
                            {{ is_array($value) ? implode(', ', $value) : $value }}
                        </p>
                    @endforeach

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