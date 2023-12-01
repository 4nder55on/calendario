@php
    $faker = Faker\Factory::create();
@endphp
<div class="bg-green-900">
    <div class="grid grid-cols-2 gap-4 text-center p-4">
        <div>
            <label for="month" class="text-gray-200">Mes:</label>
            <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    wire:model="month" id="month" wire:change="loadWeeksMonth">
                @foreach($months as $key => $month)
                    <option value="{{ $key + 1 }}">{{ $month }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="year" class="text-gray-200">Año:</label>
            <x-input type="number" wire:model="year" id="year" min="1900" max="2100"  wire:change="loadWeeksMonth"></x-input>
        </div>
    </div>
    <section class="p-4 grid grid-cols-5 gap-2 h-full">
        @foreach($days_of_week_array as $days_of_week_array)
            <div class="bg-green-500 p-2 rounded h-10 text-center border-2 sticky top-0 z-10">
                {{ $days_of_week_array }}
            </div>
        @endforeach

        @foreach($weeks_for_month as $week)
                @for($i = 1; $i <= 5; $i++)
                    @if($week[$i] > 0)
                        <div class="max-w-sm rounded overflow-hidden shadow-lg border-2 bg-green-200/60">
                            <div class="px-6 py-4 h-40">
                                <div class="font-bold text-xl mb-2 flex justify-between">
                                    {{ $week[$i] }}
                                    <x-button>ver</x-button>
                                </div>
                                <hr>
                                <p class="text-gray-700 text-base pt-2">
                                    @for($iE = 1; $iE < rand(1, 5)+1; $iE++)
                                        <li class="text-green-950">
                                            {{ $faker->name }}
                                        </li>
                                    @endfor
                                </p>
                            </div>
                            <div class="px-6 pt-4 pb-2 text-end">

                            </div>
                        </div>
                    @endif

                @endfor
        @endforeach
    </section>
</div>
