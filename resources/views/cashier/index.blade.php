<x-cashier.layout>
    <div class="grid grid-cols-3 gap-4  h-full">
        <div class="col-span-1 bg-white rounded shadow p-4 overflow-y-auto">
            <div class="overflow-y-auto" style="height: calc(90vh - 144px);">
                <h2 class="text-xl font-bold mb-4">Barang Ditambahkan</h2>
                <ul class="space-y-2" id="list-barang-ditambahkan">
                </ul>
            </div>

            <div class="mt-4">
                <!-- Tombol untuk membuka modal -->
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    x-on:click="$dispatch('open-modal', 'example-modal')">
                    Buka Modal
                </button>

                <button class="..."
                    x-on:click="
        console.log('dispatch modal...');
        $dispatch('open-modal', 'example-modal')">
                    Buka Modal
                </button>
                

                <x-modal name="example-modal" :show="false" maxWidth="lg">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-800">Judul Modal</h2>
                        <p class="mt-2 text-gray-600">
                            Ini adalah konten dari modal. Anda bisa menambahkan formulir, teks, atau elemen lain di
                            sini.
                        </p>

                        <div class="mt-4 flex justify-end">
                            <button class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 mr-2"
                                x-on:click="$dispatch('close-modal', 'example-modal')">
                                Tutup
                            </button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Simpan
                            </button>
                        </div>
                    </div>
                </x-modal>

            </div>
        </div>

        <div class="col-span-2 flex flex-col ">
            <div class="bg-white p-4 rounded shadow mb-4">
                <div class="flex items-center justify-between gap-1">
                    <input type="text" id="search-produk" class="w-full p-2 border border-gray-300 rounded"
                        placeholder="Cari produk...">
                    <button id="reset-search" class="p-2 border w-11 rounded bg-gray-100 hover:bg-gray-200 ml-2"
                        type="button">
                        <i class="fal fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="bg-white p-4 rounded shadow overflow-y-auto" style="height: calc(90vh - 144px);">
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($medicines as $item)
                        <div class="bg-gray-100 p-4 rounded shadow" data-produk="{{ $item->name }}">
                            <img src="{{ asset('product/' . $item->images) }}" alt="Produk A"
                                class="w-full h-48 object-cover rounded mb-2">
                            <h3 class="text-lg font-semibold mb-1">{{ $item->name }}</h3>
                            <h4 class="text-md font-medium mb-1">
                                {{ 'Rp ' . number_format($item->selling_price, 0, ',', '.') }}</h4>
                            <p class="text-gray-600 mb-2">{{ Str::limit($item->description, 20, '...') }}</p>
                            <div class="flex items-center space-x-2">
                                <button class="tambah-barang h-auto w-32 bg-blue-500 text-white px-2 py-1 rounded"
                                    data-nama="{{ $item->name }}">+
                                </button>
                                <!-- Trigger Button -->
                                <button
                                    x-on:click="
    console.log('Triggering modal: detail-modal-{{ $item->id }}');
    $dispatch('open-modal', 'detail-modal-{{ $item->id }}')">
                                    <i class="far fa-exclamation-circle"></i>
                                </button>


                                <!-- Modal Component -->
                                <x-modal name="detail-modal-{{ $item->id }}" :show="false" maxWidth="md">
                                    <div class="p-6">
                                        <h2 class="text-lg font-medium text-gray-900 mb-2">{{ $item->name }}</h2>
                                        <img src="{{ asset('product/' . $item->images) }}" alt="{{ $item->name }}"
                                            class="w-full h-48 object-cover rounded mb-2">
                                        <h4 class="text-md font-medium mb-1">
                                            {{ 'Rp ' . number_format($item->selling_price, 0, ',', '.') }}
                                        </h4>
                                        <p class="text-gray-600 mb-2">{{ $item->description }}</p>
                                        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded"
                                            x-on:click="$dispatch('close-modal', 'detail-modal-{{ $item->id }}')">Tutup</button>
                                    </div>
                                </x-modal>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="{{ asset('js/search-product.js') }}"></script>
        <script src="{{ asset('js/count-product.js') }}"></script>
    @endpush



</x-cashier.layout>
