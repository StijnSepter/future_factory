@extends('layouts.layout')
@section('title', 'Dashboard')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-6 text-gray-800">Welcome, {{ Auth::user()->name }}!</h1>
    
    <div class="bg-white p-6 rounded-lg shadow-lg">
        
        {{-- ---------------------------------------------------------------- --}}
        {{-- PRIMARY CONTENT SWITCHING --}}
        {{-- ---------------------------------------------------------------- --}}

        @if (Auth::user()->isAdmin())
            {{-- Load the full administrative control panel --}}
            <p class="text-xl text-indigo-600 mb-4">You have full Administrative privileges.</p>
            @include('dashboards.admin')

        @elseif (Auth::user()->isPlanner())
            {{-- Load content specific to the Planner role (Editor) --}}
            <p class="text-xl text-green-600 mb-4">Welcome to the Planning interface.</p>
            @include('dashboards.planner')

        @elseif (Auth::user()->isMechanic())
            {{-- Load content specific to the Mechanic role (Author) --}}
            <p class="text-xl text-yellow-600 mb-4">Welcome to your task assignment view.</p>
            @include('dashboards.mechanic')

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