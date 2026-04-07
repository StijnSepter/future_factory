<div class="flex h-[80vh]">

    {{-- 🔹 Sidebar --}}
    <div class="w-1/4 bg-gray-100 p-4 border-r space-y-4">
        <h3 class="text-xl font-bold">Planner Tools</h3>

        <a href="{{ route('planner.add_to_agenda') }}"
           class="block bg-blue-600 text-white p-2 rounded text-center">
            + Nieuwe Taak
        </a>
        <button class="w-full bg-gray-300 p-2 rounded">
            Filter op Robot
        </button>
    </div> {{-- ✅ CLOSED SIDEBAR --}}


    {{-- 🔹 Calendar --}}
    <div class="flex-1 p-6 overflow-auto">

        <h2 class="text-2xl font-bold mb-4">Planning</h2>

        <div class="flex space-x-2 mb-4">
            <a href="{{ route('dashboard', ['view' => 'day']) }}" 
            class="px-4 py-2 rounded {{ ($currentView ?? '') == 'day' ? 'bg-indigo-600 text-white' : 'bg-gray-200' }}">
                Dag
            </a>

            <a href="{{ route('dashboard', ['view' => 'week']) }}" 
            class="px-4 py-2 rounded {{ ($currentView ?? 'week') == 'week' ? 'bg-indigo-600 text-white' : 'bg-gray-200' }}">
                Week
            </a>

            <a href="{{ route('dashboard', ['view' => 'month']) }}" 
            class="px-4 py-2 rounded {{ ($currentView ?? '') == 'month' ? 'bg-indigo-600 text-white' : 'bg-gray-200' }}">
                Maand
            </a>
        </div>

        @php
            $timeSlots = [
                1 => '08:00 - 10:00',
                2 => '10:00 - 12:00',
                3 => '12:00 - 14:00',
                4 => '14:00 - 16:00',
            ];
        @endphp

                {{-- Wrapper with overflow-x-auto allows scrolling on 'Month' view --}}
        <div class="overflow-x-auto">
            <div class="inline-flex space-x-4 min-w-full pb-4">

                {{-- ⏰ Time column --}}
                <div class="flex-shrink-0 w-32">
                    <h4 class="font-bold mb-2">Tijd</h4>
                    @foreach($timeSlots as $slot)
                        <div class="h-24 border p-2 text-sm bg-gray-50">
                            {{ $slot }}
                        </div>
                    @endforeach
                </div>

                {{-- 📅 Days --}}
                @foreach($days ?? [] as $day)
                    <div class="flex-shrink-0 w-48"> {{-- Fixed width keeps columns readable --}}
                        <h4 class="font-bold mb-2">{{ $day->format('D d-m') }}</h4>

                        @foreach($timeSlots as $slotNumber => $slot)
                            <div class="h-24 border p-2 slot"
                                data-date="{{ $day->toDateString() }}"
                                data-slot="{{ $slotNumber }}">
                                
                                @foreach($tasks as $task)
                                    @if($task->planned_date == $day->toDateString() && $task->time_slot == $slotNumber)
                                        <div class="bg-blue-200 p-2 rounded text-xs">
                                            {{ $task->name }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>

    </div> {{-- ✅ END CALENDAR --}}

</div>