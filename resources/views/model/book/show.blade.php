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
                    {{ $model->situation }}
                </div>
                <div class="mt-3 flex justify-start items-center">
                    @if($model->itsAvailable())
                        <Link modal href="{{ route('book.rent.create', $model->id) }}" class="text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                            <span>Alugar</span>
                        </Link>
                    @else
                        <Link
                                href="{{ route('book.return', $model->id) }}"
                                confirm="Você tem certeza disso?"
                                confirm-text="Deseja devolver o livro à biblioteca?"
                                confirm-button="Sim"
                                cancel-button="Não"
                                method="PUT"
                                class="text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                            Devolver
                        </Link>
                    @endif

                    <Link
                            href="{{ route('book.destroy', $model->id) }}"
                            confirm="Você tem certeza disso?"
                            confirm-text="Deseja apagar esse registro da plataforma?"
                            confirm-button="Sim"
                            cancel-button="Não"
                            method="DELETE"
                            class="text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                        Apagar
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="p-4 mt-5 bg-white shadow rounded-md">
            <strong>Editar</strong>
            <x-splade-form method="put" :action="route('book.update', $model->id)"  :default="$model" class="mt-6 space-y-6" preserve-scroll>
                <x-splade-input id="name" name="name" type="text" :label="__('Nome')" v-model="form.name" required autofocus />
                <x-splade-checkbox name="enabled" value="1" false-value="0" v-model="form.enabled" label="Ativado?" />

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