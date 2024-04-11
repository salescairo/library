<x-layout>
    <div class="p-4">
        <div class="p-4 bg-white shadow rounded-md">
            <div class="flex justify-between items-center">
                <div class="w-full flex justify-start items-center">
                    <div class="pl-3">
                        <span class="text-xl font-bold text-gray-800">Livros</span>
                        <small class="text-gray-400">
                        {{ $models->firstItem() < 10 ? '0'.$models->firstItem() : $models->firstItem() }}-{{ $models->lastItem() < 10 ? '0'.$models->lastItem() : $models->lastItem() }} de {{ $models->total() }}
                        </small>
                    </div>
                        <div>
                            <x-splade-form method="get" :action="route('book.index')" :default="request()->all()" class="flex justify-start me-2 px-2">
                                <x-splade-input v-model="form.name" class="me-2 w-36" id="name" name="name" placeholder="Pesquisar :.." autofocus type="text" />

                                <button type="button" @click.prevent="form.submit" class="text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </button>
                                <button type="button" @click.prevent="form.reset" class="text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </x-splade-form>
                        </div>
                    </div>
                <div class="flex justify-end items-center">
                    @if($models->hasPages())
                        <Link href="{{ $models->previousPageUrl() }}" class="text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </Link>
                        <Link href="{{ $models->nextPageUrl() }}" class="text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </Link>
                    @endif
                    <Link modal href="{{ route('book.create') }}" class="text-gray-600 bg-white hover:bg-gray-200 hover:text-gray-600 border border-gray-300 font-medium rounded-lg text-sm px-2 py-2 me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </Link>
                </div>
            </div>
        </div>


        <div class="p-4 mt-5 bg-white shadow rounded-md">
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
                                Ano
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Editora
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Gênero
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Situação
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex justify-end">
                                    <span class="">...</span>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $model)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $model->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $model->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $model->year }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $model->brand->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $model->gender->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $model->situation }}
                                </td>
                                <td>
                                    <div class="flex justify-end">
                                        <Link href="{{ route('book.show', $model->id) }}" class="text-blue-700 bg-blue-100 hover:bg-blue-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg p-2 me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                            </svg>
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>