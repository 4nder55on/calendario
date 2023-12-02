<div>

    <div>
        <x-button wire:click="$set('openModal', true)">Ver Todo</x-button>
    </div>

    <x-modal wire:model="openModal">
        <section>
            <div class="bg-green-500 p-2 rounded h-10 text-center border-2 sticky top-0 z-10">
                {{ $day }}
            </div>
        </section>
    </x-modal>

</div>
