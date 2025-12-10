@extends('layouts.layout')
@section('title', 'Dashboard')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-6 text-gray-800">Welcome, {{ Auth::user()->name }}!</h1>
    
    <div class="bg-white p-6 rounded-lg shadow-lg">
        
        {{-- ---------------------------------------------------------------- --}}
        {{-- PRIMARY CONTENT SWITCHING --}}
        {{-- ---------------------------------------------------------------- --}}

        @if (Auth::user()->isPurchaser())
            {{-- Load the full administrative control panel --}}
            <p class="text-xl text-indigo-600 mb-4">You have full purchaser privileges.</p>
            @include('dashboards.purchaser')

        @elseif (Auth::user()->isPlanner())
            {{-- Load content specific to the Planner role (Editor) --}}
            <p class="text-xl text-green-600 mb-4">Welcome to the Planning interface.</p>
            @include('dashboards.planner')

        @elseif (Auth::user()->isMechanic())
            <p class="text-xl text-yellow-600 mb-4">Welkom bij uw taaktoewijzingsview.</p>
            {{-- 🚨 Use the null coalescing operator to provide an empty collection as fallback --}}
            @include('dashboards.mechanic', ['vehicles' => $assemblyVehicles ?? collect()])

        @else 
            {{-- Default view for Viewer/General User --}}
            <p class="text-xl text-gray-600 mb-4">This is the general user dashboard.</p>
            @include('dashboards.viewer')

        @endif
        
        {{-- ---------------------------------------------------------------- --}}
        {{-- END PRIMARY CONTENT SWITCHING --}}
        {{-- ---------------------------------------------------------------- --}}

    </div>
</div>

@endsection