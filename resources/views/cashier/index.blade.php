<x-cashier.layout>
    <div class="grid grid-cols-3 gap-4 h-full">
        <!-- Sidebar Barang Ditambahkan -->
        <div class="col-span-1 bg-white rounded shadow p-4 overflow-y-auto">
            <div class="overflow-y-auto" style="height: calc(90vh - 144px);">
                <h2 class="text-xl font-bold mb-4">Barang Ditambahkan</h2>
                <ul class="space-y-2" id="list-barang-ditambahkan"></ul>
            </div>

            <div class="mt-4">
                <button x-data x-on:click="$dispatch('open-modal', 'example-modal')"
                    class="px-4 py-2 bg-blue-600 text-white rounded" id="bayar-button">
                    Bayar
                </button>

                <!-- MODAL PEMBAYARAN -->
                <x-modal name="example-modal" :show="false" maxWidth="lg">
                    <div class="p-6">
                        <ul class="space-y-2" id="list-product"></ul>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Bayar:</label>
                            <input type="text" id="total-bayar" readonly
                                class="w-full p-2 border border-gray-300 rounded bg-gray-100 font-semibold mb-3"
                                value="Rp 0">

                            <label class="block text-sm font-medium text-gray-700 mb-1">Uang Diberikan:</label>
                            <input type="number" id="uang-diberikan"
                                class="w-full p-2 border border-gray-300 rounded mb-3"
                                placeholder="Masukkan jumlah uang">

                            <label class="block text-sm font-medium text-gray-700 mb-1">Kembalian:</label>
                            <input type="text" id="kembalian" readonly
                                class="w-full p-2 border border-gray-300 rounded bg-gray-100" value="Rp 0">
                        </div>

                        <button class="mt-4 px-4 py-2 bg-gray-300 rounded"
                            x-on:click="$dispatch('close-modal', 'example-modal')">
                            Tutup
                        </button>
                    </div>
                </x-modal>
            </div>
        </div>

        <!-- Kolom Produk -->
        <div class="col-span-2 flex flex-col">
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
                            <img src="{{ asset('product/' . $item->images) }}" alt="{{ $item->name }}"
                                class="w-full h-48 object-cover rounded mb-2">
                            <h3 class="text-lg font-semibold mb-1">{{ $item->name }}</h3>
                            <h4 class="text-md font-medium mb-1">
                                {{ 'Rp ' . number_format($item->selling_price, 0, ',', '.') }}
                            </h4>
                            <p class="text-gray-600 mb-2">{{ Str::limit($item->description, 20, '...') }}</p>
                            <div class="flex items-center space-x-2">
                                <button class="tambah-barang h-auto w-32 bg-blue-500 text-white px-2 py-1 rounded"
                                    data-nama="{{ $item->name }}">
                                    +
                                </button>
                                <button x-data x-on:click="$dispatch('open-modal', 'detail-modal-{{ $item->id }}')">
                                    <i class="far fa-exclamation-circle"></i>
                                </button>

                                <!-- Detail Modal -->
                                <x-modal name="detail-modal-{{ $item->id }}" :show="false" maxWidth="sm">
                                    <div class="p-6">
                                        <h2 class="text-lg font-medium text-gray-900 mb-2">{{ $item->name }}</h2>
                                        <div class="space-y-1">
                                            <h5>Deskripsi</h5>
                                            <p class="text-gray-600 my-2">{{ $item->description }}</p>
                                        </div>
                                        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                                        <div class="space-y-1">
                                            <h5>Aturan Pakai</h5>
                                            <p class="text-gray-600 my-2">{{ $item->usage_instruction }}</p>
                                        </div>
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
        <script>
            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function hitungTotal() {
                let total = 0;
                $('#list-barang-ditambahkan li').each(function() {
                    const nama = $(this).data('nama');
                    const jumlah = parseInt($(this).data('jumlah'));
                    const hargaText = $(`[data-produk="${nama}"]`).find('h4').text().replace(/[^\d]/g, '');
                    const harga = parseInt(hargaText);
                    total += harga * jumlah;
                });
                $('#total-bayar').val(formatRupiah(total));
                return total;
            }

            $(document).ready(function() {
                // Tambah barang ke daftar
                $('.tambah-barang').on('click', function() {
                    const nama = $(this).data('nama');
                    const list = $('#list-barang-ditambahkan');
                    let existing = list.find(`li[data-nama="${nama}"]`);

                    if (existing.length > 0) {
                        let jumlah = parseInt(existing.attr('data-jumlah'));
                        jumlah++;
                        existing.attr('data-jumlah', jumlah);
                        existing.find('.jumlah-span').val(jumlah);
                    } else {
                        list.append(`
                            <li class="p-2 bg-gray-200 rounded flex justify-between items-center" data-nama="${nama}" data-jumlah="1">
                                <span>${nama}</span>
                                <div class="flex items-center space-x-2">
                                    <button class="kurangi-barang bg-blue-500 text-white px-2 py-1 rounded" data-nama="${nama}">-</button>
                                    <input class="jumlah-span font-bold w-10 text-center p-1 rounded" value="1" readonly>
                                    <button class="tambah-barang-daftar bg-blue-500 text-white px-2 py-1 rounded" data-nama="${nama}">+</button>
                                </div>
                            </li>
                        `);
                    }
                });

                // Tambah/Kurang item dari daftar
                $('#list-barang-ditambahkan').on('click', '.tambah-barang-daftar', function() {
                    const nama = $(this).data('nama');
                    let item = $(`li[data-nama="${nama}"]`);
                    let jumlah = parseInt(item.attr('data-jumlah')) + 1;
                    item.attr('data-jumlah', jumlah);
                    item.find('.jumlah-span').val(jumlah);
                });

                $('#list-barang-ditambahkan').on('click', '.kurangi-barang', function() {
                    const nama = $(this).data('nama');
                    let item = $(`li[data-nama="${nama}"]`);
                    let jumlah = parseInt(item.attr('data-jumlah')) - 1;
                    if (jumlah <= 0) {
                        item.remove();
                    } else {
                        item.attr('data-jumlah', jumlah);
                        item.find('.jumlah-span').val(jumlah);
                    }
                });

                // Saat tombol bayar diklik
                $('#bayar-button').on('click', function() {
                    const list = $('#list-product');
                    list.empty();

                    $('#list-barang-ditambahkan li').each(function() {
                        const nama = $(this).data('nama');
                        const jumlah = $(this).data('jumlah');
                        list.append(`<li class="bg-gray-100 p-2 rounded">${nama} x ${jumlah}</li>`);
                    });

                    hitungTotal();
                    $('#uang-diberikan').val('');
                    $('#kembalian').val('Rp 0');
                });

                // Hitung kembalian
                $('#uang-diberikan').on('input', function() {
                    const uang = parseInt($(this).val()) || 0;
                    const total = hitungTotal();
                    const kembali = uang - total;
                    $('#kembalian').val(formatRupiah(kembali > 0 ? kembali : 0));
                });
            });
        </script>
    @endpush
</x-cashier.layout>
