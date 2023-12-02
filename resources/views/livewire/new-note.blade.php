<div class="items-center h-[calc(100vh-4rem)] text-gray-200">
    <br>
    <br>
    <div class="max-w-md m-auto p-4 border-2 rounded-lg p-10">
        <div class="text-center pb-4">
            <h1 class="font-semibold text-3xl">Crear Evento</h1>
        </div>
        <hr>
        <form class="max-w-md mx-auto grid gap-2 pt-4" wire:submit="save">
            <div>
                <label for="fecha">Fecha:</label>
                <x-input type="date" class="w-full text-gray-800" name="fecha" wire:model="date"></x-input>
                <x-input-error for="fecha" />
            </div>
            <div>
                <label for="title">Titulo:</label>
                <x-input type="text" class="w-full text-gray-800" name="title" wire:model="title"></x-input>
                <x-input-error for="title" />
            </div>
            <div>
                <label for="description">Descripción:</label>
                <textarea type="text" wire:model="description" class="w-full text-gray-800 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="description" rows="6"></textarea>
                <x-input-error for="description" />
            </div>
            <hr>
            <div class="text-center">
                <x-button type="submit">Guardar</x-button>
            </div>
        </form>

    </div>

</div>
