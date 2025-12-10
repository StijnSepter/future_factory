@extends('layouts.layout')
@section('title', 'Taak Aanmaken')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-2xl">
        <h2 class="text-3xl font-bold text-indigo-700 mb-6 border-b pb-3">Nieuwe Assemblagetaak Plannen</h2>
        
        <form action="{{ route('planner.store_vehicle') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Vehicle Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Voertuig Naam (Model)</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border"
                       value="{{ old('name') }}">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Module Select Fields --}}
            @php
                $moduleTypes = ['chassis', 'drive', 'wheels', 'steering', 'seats'];
                $required = ['chassis', 'drive', 'wheels', 'steering'];
            @endphp

            @foreach ($moduleTypes as $type)
            <div class="p-4 border rounded-lg {{ in_array($type, $required) ? 'border-indigo-300 bg-indigo-50' : 'border-gray-300 bg-white' }}">
                <label for="{{ $type }}_module_id" class="block text-lg font-semibold text-gray-700 mb-2">
                    {{ ucfirst($type) }} Module {{ in_array($type, $required) ? '*' : '(Optioneel)' }}
                </label>
                
                <select name="{{ $type }}_module_id" id="{{ $type }}_module_id" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border">
                    
                    @if (!in_array($type, $required))
                        <option value="">-- Geen {{ ucfirst($type) }} (Indien Optioneel) --</option>
                    @endif

                    @if (isset($modules[$type]))
                        @foreach ($modules[$type] as $module)
                            <option value="{{ $module->id }}" @selected(old("{$type}_module_id") == $module->id)>
                                {{ $module->name }} (&euro;{{ number_format($module->cost, 0, ',', '.') }})
                            </option>
                        @endforeach
                    @else
                        <option value="" disabled>Geen {{ $type }} modules gevonden</option>
                    @endif
                </select>
                @error("{$type}_module_id")<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            @endforeach

            {{-- Submit Button --}}
            <div class="pt-4 border-t mt-6">
                <button type="submit" class="w-full py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition">
                    Taak Plannen en naar Assemblage Sturen
                </button>
            </div>
        </form>
    </div>
</div>
@endsection