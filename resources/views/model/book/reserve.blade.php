<x-splade-modal>
<div class="p-4">
    <strong>Reservar</strong>
    <x-splade-form method="put" :action="route('book.reserve', $model->id)" class="mt-6 space-y-6" preserve-scroll>
        <x-splade-input id="name" name="name" type="text" :label="__('Nome')" required />

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Reservar')" />
        </div>
    </x-splade-form>
</div>
</x-splade-modal>