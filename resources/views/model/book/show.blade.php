<x-layout>
<div class="p-4">
    <div class="p-4 bg-white shadow rounded-md">
        <div class="flex justify-start items-center">
            <div class="w-full flex flex-col">
                <div class="">
                    <span class="text-lg font-bold text-gray-800">
                        {{ $model->name }} -
                        {{ $model->brand->name }} -
                        {{ $model->gender->name }}
                    </span><br>
                    {{ $model->situation }}<br>
                    @if(!is_null($model->reserved_for))
                        Para: {{ $model->reserved_for }}
                    @endif
                    @if($model->itsRented())
                        Para: {{ $model->bookLastOutput->name }} - {{ $model->bookLastOutput->identification }}
                    @endif
                </div>
                <div class="mt-3 flex justify-start items-center">
                    @if($model->itsAvailable())
                        <Link modal href="{{ route('book.rent.create', $model->id) }}" class="flex flex-col items-center justify-center text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            <span>Alugar</span>
                        </Link>
                        <Link modal href="{{ route('book.reserve.create', $model->id) }}" class="flex flex-col items-center justify-center text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            <span>Reservar</span>
                        </Link>
                    @endif

                    @if($model->itsRented())
                        <Link
                                href="{{ route('book.return', $model->id) }}"
                                confirm="Você tem certeza disso?"
                                confirm-text="Deseja devolver o livro à biblioteca?"
                                confirm-button="Sim"
                                cancel-button="Não"
                                method="PUT"
                                class="flex flex-col items-center justify-center text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                            <span>Devolver</span>
                        </Link>
                    @endif

                    @if($model->itsReserved())
                        <Link
                                href="{{ route('book.unreserve', $model->id) }}"
                                confirm="Você tem certeza disso?"
                                confirm-text="Deseja devolver o livro à biblioteca?"
                                confirm-button="Sim"
                                cancel-button="Não"
                                method="PUT"
                                class="flex flex-col items-center justify-center text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                            <span>Remover reserva</span>
                        </Link>
                    @endif
                    <Link
                            href="{{ route('book.destroy', $model->id) }}"
                            confirm="Você tem certeza disso?"
                            confirm-text="Deseja apagar esse registro da plataforma?"
                            confirm-button="Sim"
                            cancel-button="Não"
                            method="DELETE"
                            class="flex flex-col items-center justify-center text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        <span>Apagar</span>
                    </Link>

                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="p-4 mt-5 bg-white shadow rounded-md">
            <strong>Editar</strong>

            <x-splade-form method="put" :action="route('book.update', $model->id)"  :default="$model" class="mt-6 space-y-6" preserve-scroll>
                <x-splade-input id="name" name="name" type="text" :label="__('Nome')" v-model="form.name" required />
                <x-splade-input id="year" name="year" type="number" :label="__('Ano')" v-model="form.year" required />
                <x-splade-select select id="brand_id" name="brand_id" :label="__('Editora')" :options="$brands" option-label="name" v-model="form.brand_id" option-value="id" />
                <x-splade-select select id="gender_id" name="gender_id" :label="__('Gênero')" :options="$genders" option-label="name" v-model="form.gender_id" option-value="id" />

                <div class="flex items-center gap-4">
                    <x-splade-submit :label="__('Atualizar')" />
                </div>
            </x-splade-form>
        </div>


        <div class="p-4 mt-5 bg-white shadow rounded-md">
            <strong>Alugueis</strong>
            <div class="max-w-xxl">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Matrícula
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Data de Devolução
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model->bookOutputs as $output)
                            <tr @class([
                                    "border-b dark:border-gray-700",
                                    "bg-red-50" => is_null($output->returned_at),
                                    "bg-green-50" => !is_null($output->returned_at)
                                ])>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $output->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $output->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $output->identification }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $output->return_date }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>