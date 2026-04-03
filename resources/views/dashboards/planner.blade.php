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

        {{-- View switch --}}
        <div class="flex space-x-2 mb-4">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Dag</button>
            <button class="px-4 py-2 bg-gray-200 rounded">Week</button>
            <button class="px-4 py-2 bg-gray-200 rounded">Maand</button>
        </div>

        @php
            $timeSlots = [
                1 => '08:00 - 10:00',
                2 => '10:00 - 12:00',
                3 => '12:00 - 14:00',
                4 => '14:00 - 16:00',
            ];
        @endphp

        <div class="grid grid-cols-5 gap-4">

            {{-- ⏰ Time column --}}
            <div>
                <h4 class="font-bold mb-2">Tijd</h4>
                @foreach($timeSlots as $slot)
                    <div class="h-24 border p-2 text-sm bg-gray-50">
                        {{ $slot }}
                    </div>
                @endforeach
            </div>

            {{-- 📅 Days --}}
            {{-- @foreach($days as $day)
                <div>
                    <h4 class="font-bold mb-2">{{ $day->format('D d-m') }}</h4>

                    @foreach($timeSlots as $slotNumber => $slot)
                        <div class="h-24 border p-2 slot"
                             data-date="{{ $day->toDateString() }}"
                             data-slot="{{ $slotNumber }}">

                            @foreach($tasks as $task)
                                @if($task->planned_date == $day->toDateString() && $task->time_slot == $slotNumber)
                                    <div class="bg-blue-200 p-2 rounded text-sm">
                                        {{ $task->name }}<br>
                                        🤖 {{ $task->robot }}
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    @endforeach
                </div>
            @endforeach --}}
        </div>

    </div> {{-- ✅ END CALENDAR --}}

</div>