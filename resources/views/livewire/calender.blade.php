<div class="h-full">
    <div class="grid grid-cols-5 gap-4 text-center p-4">
        <div class="col-span-4 grid grid-cols-2 p-2">
            <div>
                <label for="month" class="text-gray-200">Mes:</label>
                <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        wire:model="month" id="month" wire:change="loadWeeksMonth">
                    @foreach($months as $key => $monthF)
                        <option value="{{ $key + 1 }}">{{ $monthF }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="year" class="text-gray-200">Año:</label>
                <x-input type="number" wire:model="year" id="year" min="1900" max="2100"  wire:change="loadWeeksMonth"></x-input>
            </div>
        </div>
        <div>
            <x-button class="w-auto h-full gap-2" wire:click="create">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Crear
            </x-button>
        </div>
    </div>
    <section class="p-4 grid grid-cols-5 gap-2 h-full">
        @foreach($days_of_week_array as $days_of_week_array)
            <div class="bg-blue-500 text-gray-200 p-2 rounded h-10 text-center border-2 sticky top-0 z-10">
                {{ $days_of_week_array }}
            </div>
        @endforeach

        @foreach($weeks_for_month as $key => $week)
                @for($i = 1; $i <= 5; $i++)
                    @if($week[$i] > 0)
                        <div>
                            <div class="max-w-sm rounded overflow-hidden shadow-lg border-2 bg-blue-200/60">
                                <div class="px-6 py-2 h-44">
                                    <div class="font-bold text-xl mb-2 flex justify-between">
                                        {{ $week[$i] }}
                                        <x-button wire:click="showDay({{$week[$i]}}, {{$key}})">ver</x-button>
                                    </div>
                                    <hr>
                                    <p class="text-gray-700 text-base pt-2">

                                            <?php
                                                $dayTemp = $week[$i];
                                                if ($week[$i] > 15 && $key == 0) {
                                                    $keyI = $this->month - 2;
                                                }elseif ($week[$i] < 15 && $key > 3) {
                                                    $keyI = $this->month;
                                                }
                                                else{
                                                    $keyI = $this->month - 1;
                                                }

                                                if ($keyI < 0) {
                                                    $keyI = 11;
                                                    $yearTemp = $this->year - 1;
                                                }
                                                else{
                                                    $yearTemp = $this->year;
                                                }
                                                $monthTemp = $keyI + 1;
                                                $dateFormat = date('Y-m-d', strtotime($yearTemp.'-'.$monthTemp.'-'.$dayTemp));
                                                $cantidad = \App\Models\Event::where('date', '=',$dateFormat)->count();
                                                $masEventos = false;
                                                if ($cantidad > 3) {
                                                    $eventsInt = \App\Models\Event::where('date', '=',$dateFormat)->take(3)->get();
                                                    $masEventos = true;
                                                }
                                                else{
                                                    $eventsInt = \App\Models\Event::where('date', '=',$dateFormat)->get();
                                                }
                                            ?>
{{--                                        {{$eventsInt}}--}}
                                            @foreach($eventsInt as $eventT)
                                                @if($eventT->date == $dateFormat)
                                                    <li>
                                                        {{ $eventT->title }}
                                                    </li>
                                                @endif
                                            @endforeach
                                            @if($masEventos)
                                                <div class="text-center pt-1.5 text-blue-950">
                                                    <p class="font-bold underline">Hay enventos sin mostrar</p>
                                                </div>
                                            @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                    @endif
                @endfor
        @endforeach
    </section>

    <x-modal wire:model="openModal">
        <section>
            <div class="text-center p-4">
                {{ $day_selected.' de '. $month_selected.' de '.$year_selected}}
            </div>
            <hr>
            <div class="grid grid-cols-1 gap-2 p-4">
                <div>
                    <label for="title">Titulo:</label>
                    <x-input class="w-full" type="text" wire:model="title"></x-input>
                </div>
                <div>
                    <label for="description">Descripción:</label>
                    <textarea class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" wire:model="description"></textarea>
                </div>
            </div>

            <hr>
            <div class="flex justify-between p-2">
                <x-danger-button  wire:click="$set('openModal', false)">Cerrar</x-danger-button>
                <x-button wire:click="save">Guardar</x-button>
            </div>
        </section>
    </x-modal>
</div>
