@extends('layouts.layout')
@section('title', 'Taak Aanmaken')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Nieuwe Productietaak
    </h2>

    <form method="POST" action="{{ route('planner.store') }}" class="space-y-4">
        @csrf
        {{-- Vehicle --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Voertuig
            </label>
            <select name="vehicle_id" class="w-full border rounded p-2">
                @if($unplannedVehicles->isEmpty())
                    <option>
                        <p>No vehicles found</p>
                    </option>
                @endif
                    @foreach($unplannedVehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->name }} (ID: {{ $vehicle->id }})
                        </option>
                    @endforeach
            </select>
            @error('vehicle_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Date --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Datum
            </label>
            <input type="date" name="planned_date"
                   class="w-full border rounded p-2"
                   value="{{ old('planned_date') }}">
            @error('planned_date')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Time Slot --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Tijdslot
            </label>
            <select name="time_slot" class="w-full border rounded p-2">
                <option value="">-- Kies tijdslot --</option>
                <option value="1">08:00 - 10:00</option>
                <option value="2">10:00 - 12:00</option>
                <option value="3">12:00 - 14:00</option>
                <option value="4">14:00 - 16:00</option>
            </select>
            @error('time_slot')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Robot --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Robot
            </label>
            <select name="robot" class="w-full border rounded p-2">
                @foreach($robots as $robot)
                    <option value="{{ $robot}}">
                        {{ $robot }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Plan taak
            </button>
        </div>

    </form>
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection