<x-splade-modal>
<div class="p-4">
    <strong>Alugar</strong>
    <x-splade-form method="post" :action="route('book.rent.store', $model->id)" class="mt-6 space-y-6" preserve-scroll>
        <x-splade-input id="name" name="name" type="text" :label="__('Nome')" required />
        <x-splade-input id="identification" name="identification" type="text" :label="__('Matrícula')" required />
        <x-splade-input id="return_date" name="return_date" label="Data de Devolução?" date/>

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Alugar')" />
        </div>
    </x-splade-form>
</div>
</x-splade-modal>