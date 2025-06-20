<x-cashier.layout>
    <div class="grid grid-cols-3 gap-4 h-full">
        <!-- Sidebar Barang Ditambahkan -->
        <div class="col-span-1 bg-white rounded shadow p-4 overflow-y-auto">
            <div class="overflow-y-auto" style="height: calc(90vh - 144px);">
                <h2 class="text-xl font-bold mb-4">Barang Ditambahkan</h2>
                <ul class="space-y-2" id="list-barang-ditambahkan">
                    <li class="p-2 bg-gray-100 rounded text-center items-center" id="no-items">
                        <span>Belum ada barang</span>
                    </li>
                </ul>
            </div>

            <div class="mt-4">
                <div class="flex justify-between">

                    <button x-data x-on:click="$dispatch('open-modal', 'example-modal')"
                        class="px-4 py-2 text-white rounded bg-blue-600 disabled:cursor-not-allowed disabled:bg-blue-300"
                        id="bayar-button" disabled>
                        Bayar
                    </button>
                </div>


                <!-- MODAL PEMBAYARAN -->
                <x-modal name="example-modal" :show="false" maxWidth="2xl">
                    <div class="p-6">
                        <p class="mb-3">Barang Ditambahkan :</p>
                        <div class="max-h-52 overflow-y-auto">
                            <ul class="space-y-2" id="list-product"></ul>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran:</label>
                            <select id="metode-pembayaran" class="w-full p-2 border border-gray-300 rounded mb-3">
                                <option value="cash">Cash</option>
                                <option value="qris">QRIS</option>
                            </select>

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
                        <button disabled class="mt-4 ml-2 px-4 py-2 bg-green-600 text-white rounded" id="konfirmasi-pembayaran">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </x-modal>

                {{-- Modal Struk --}}
                <x-modal name="struk-modal" :show="false" maxWidth="2xl">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold mb-4">Struk Pembayaran</h2>
                        <iframe id="pdf-preview" class="w-full h-[500px] border" frameborder="0"></iframe>
                        <div class="mt-4 flex justify-end space-x-2">
                            <button class="px-4 py-2 bg-gray-300 rounded"
                                x-on:click="$dispatch('close-modal', 'struk-modal')">Tutup</button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded" id="download-struk">Download
                                Struk</button>
                        </div>
                    </div>
                </x-modal>

            </div>
        </div>

        <!-- Kolom Produk -->
        <div class="col-span-2 flex flex-col">
            <div class="bg-white p-4 rounded shadow mb-4">
                <div class="flex items-center justify-between gap-1">
                    <input type="text" id="search-produk" name="search"
                        class="w-full p-2 border border-gray-300 rounded" placeholder="Cari produk...">
                    <select id="filter-kategori" name="kategori"
                        class="p-2 border border-gray-300 rounded bg-white ml-2">
                        <option value="">Filter</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <button id="reset-search" class="p-2 border w-11 rounded bg-gray-100 hover:bg-gray-200 ml-2"
                        type="button">
                        <i class="fal fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="bg-white p-4 rounded shadow overflow-y-auto" style="height: calc(90vh - 144px);"
                id="scroll-container">
                <div class="grid grid-cols-3 gap-4" id="product-container"></div>
                <div id="loading" class="text-center text-gray-500 mt-4 hidden">Loading...</div>
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
                    const jumlah = parseInt($(this).find('.jumlah-span').val());
                    const harga = parseInt($(this).data('harga'));
                    total += harga * jumlah;
                });
                $('#total-bayar').val(formatRupiah(total));
                return total;
            }

            let page = 1;
            let loading = false;
            let finished = false;

            function loadProducts(keyword = '', kategori = '') {
                if (loading || finished) return;
                loading = true;
                $('#loading').removeClass('hidden');

                $.ajax({
                    url: `/api/load-products`,
                    method: 'GET',
                    data: {
                        page,
                        keyword,
                        kategori
                    },
                    success: function(data) {
                        setTimeout(() => {
                            if (data.trim() === '') {
                                finished = true;
                                if (page === 1) {
                                    $('#product-container').html(
                                        '<div class="col-span-3 text-center text-gray-500 py-8">Tidak ada produk ditemukan</div>'
                                    );
                                }
                            } else {
                                $('#product-container').append(data);
                                page++;
                            }
                            $('#loading').addClass('hidden');
                            loading = false;
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        console.error('Gagal memuat produk:', error);
                        $('#loading').addClass('hidden');
                        loading = false;
                    }
                });
            }

            function reloadProducts() {
                page = 1;
                finished = false;
                $('#product-container').empty();
                const search = $('#search-produk').val();
                const kategori = $('#filter-kategori').val();
                loadProducts(search, kategori);
            }

            $(document).ready(function() {
                loadProducts();

                $('#scroll-container').on('scroll', function() {
                    if (this.scrollTop + this.clientHeight >= this.scrollHeight - 10) {
                        const search = $('#search-produk').val();
                        const kategori = $('#filter-kategori').val();
                        loadProducts(search, kategori);
                    }
                });

                $('#search-produk').on('keyup', reloadProducts);
                $('#filter-kategori').on('change', reloadProducts);
                if ($('#search-produk').val() == null) {
                    reloadProducts
                }



                $('#reset-search').on('click', function() {
                    $('#search-produk').val('');
                    $('#filter-kategori').val('');
                    $('#product-container').empty();
                    page = 1;
                    finished = false;
                    loadProducts();
                });

                $('#product-container').on('click', '.tambah-barang', function() {
                    const nama = $(this).data('nama');
                    const parent = $(this).closest('[data-id]');
                    const id = parent.data('id');
                    const harga = parent.data('harga');

                    const list = $('#list-barang-ditambahkan');
                    let existing = list.find(`li[data-id="${id}"]`);
                    $('#no-items').remove();
                    $('#bayar-button').prop('disabled', false);

                    if (existing.length > 0) {
                        let jumlah = parseInt(existing.attr('data-jumlah')) + 1;
                        existing.attr('data-jumlah', jumlah);
                        existing.find('.jumlah-span').val(jumlah);
                    } else {
                        list.append(`
                    <li class="p-2 bg-gray-200 rounded flex justify-between items-center" 
                        data-id="${id}" 
                        data-nama="${nama}" 
                        data-harga="${harga}" 
                        data-jumlah="1">
                        <span>${nama}</span>
                        <div class="flex items-center space-x-2">
                            <button class="kurangi-barang bg-red-500 text-white px-2 py-1 rounded" data-id="${id}">-</button>
                            <input class="jumlah-span font-bold w-10 text-center p-1 rounded" value="1">
                            <button class="tambah-barang-daftar bg-blue-500 text-white px-2 py-1 rounded" data-id="${id}">+</button>
                        </div>
                    </li>
                `);
                    }
                });

                $('#list-barang-ditambahkan').on('click', '.tambah-barang-daftar', function() {
                    const id = $(this).data('id');
                    let item = $(`li[data-id="${id}"]`);
                    let jumlah = parseInt(item.attr('data-jumlah')) + 1;
                    item.attr('data-jumlah', jumlah);
                    item.find('.jumlah-span').val(jumlah);
                });

                $('#list-barang-ditambahkan').on('click', '.kurangi-barang', function() {
                    const id = $(this).data('id');
                    let item = $(`li[data-id="${id}"]`);
                    let jumlah = parseInt(item.attr('data-jumlah')) - 1;

                    if (jumlah <= 0) {
                        item.remove();
                        if ($('#list-barang-ditambahkan li').length === 0) {
                            $('#list-barang-ditambahkan').append(
                                '<li class="p-2 bg-gray-100 rounded text-center items-center" id="no-items"><span>Belum ada barang</span></li>'
                            );
                            $('#bayar-button').prop('disabled', true);
                        }
                    } else {
                        item.attr('data-jumlah', jumlah);
                        item.find('.jumlah-span').val(jumlah);
                    }
                });

                $('#bayar-button').on('click', function() {
                    const list = $('#list-product');
                    list.empty();

                    $('#list-barang-ditambahkan li').each(function() {
                        const nama = $(this).data('nama');
                        const jumlah = parseInt($(this).find('.jumlah-span').val());
                        list.append(`<li class="bg-gray-100 p-2 rounded">${nama} x ${jumlah}</li>`);
                    });

                    hitungTotal();
                    $('#uang-diberikan').val('');
                    $('#kembalian').val('Rp 0');
                });

                $('#uang-diberikan').on('input', function() {
                    const uang = parseInt($(this).val()) || 0;
                    const total = hitungTotal();
                    const kembali = uang - total;    

                    if (uang <= total) {
                        $('#konfirmasi-pembayaran').prop('disabled', false);
                        $('#kembalian').val('Uang tidak cukup');
                    } else {
                        $('#kembalian').val(formatRupiah(kembali));
                    }
                });

                $('#konfirmasi-pembayaran').on('click', function() {
                    const metode = $('#metode-pembayaran').val();
                    const uangDiberikan = parseInt($('#uang-diberikan').val()) || 0;
                    const total = hitungTotal();
                    const kembalian = uangDiberikan - total;

                    const items = [];
                    $('#list-barang-ditambahkan li').each(function() {
                        const nama = $(this).data('nama');
                        const jumlah = parseInt($(this).find('.jumlah-span').val());
                        const harga = parseInt($(this).data('harga'));

                        items.push({
                            nama: nama,
                            jumlah: jumlah,
                            harga: harga
                        });
                    });

                    $.ajax({
                        url: '/api/payment',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: 'application/json',
                        data: JSON.stringify({
                            items,
                            metode,
                            total,
                            uang_diberikan: uangDiberikan,
                            kembalian
                        }),
                        success: function(response) {
                            // 1. Tampilkan notifikasi sukses
                            window.notyf.success(response.success);

                            // 2. Ambil data item untuk struk
                            const items = [];
                            $('#list-barang-ditambahkan li').each(function() {
                                items.push({
                                    nama: $(this).data('nama'),
                                    jumlah: $(this).find('.jumlah-span').val(),
                                    harga: $(this).data('harga')
                                });
                            });

                            const total = hitungTotal();
                            const uang = parseInt($('#uang-diberikan').val());
                            const kembalian = uang - total;
                            const metode = $('#metode-pembayaran').val();

                            // 3. Generate PDF menggunakan jsPDF
                            const doc = new jsPDF();

                            let y = 10;
                            doc.setFontSize(14);
                            doc.text("Struk Pembayaran", 80, y);
                            y += 10;

                            doc.setFontSize(10);
                            items.forEach(item => {
                                doc.text(
                                    `${item.nama} x ${item.jumlah} = Rp ${(item.harga * item.jumlah).toLocaleString('id-ID')}`,
                                    10, y);
                                y += 6;
                            });

                            y += 4;
                            doc.text(`Total: Rp ${total.toLocaleString('id-ID')}`, 10, y);
                            y += 6;
                            doc.text(`Uang Diberikan: Rp ${uang.toLocaleString('id-ID')}`, 10, y);
                            y += 6;
                            doc.text(`Kembalian: Rp ${kembalian.toLocaleString('id-ID')}`, 10, y);
                            y += 6;
                            doc.text(`Metode: ${metode}`, 10, y);

                            // 4. Buat blob URL dan tampilkan di modal
                            const pdfBlob = doc.output('blob');
                            const pdfUrl = URL.createObjectURL(pdfBlob);
                            $('#pdf-preview').attr('src', pdfUrl);

                            // 5. Simpan untuk download
                            $('#download-struk').off('click').on('click', function() {
                                doc.save('struk-pembayaran.pdf');
                            });

                            // 6. Reset UI
                            $('#list-barang-ditambahkan').html(
                                `<li class="p-2 bg-gray-100 rounded text-center items-center" id="no-items"><span>Belum ada barang</span></li>`
                                );
                            $('#bayar-button').prop('disabled', true);
                            $('#list-product').empty();
                            $('#total-bayar').val('Rp 0');
                            $('#uang-diberikan').val('');
                            $('#kembalian').val('Rp 0');
                            $('#metode-pembayaran').val($('#metode-pembayaran option:first').val());
                            $('#search-produk').val('');
                            $('#filter-kategori').val('');
                            $('#product-container').empty();

                            // 7. Tutup modal pembayaran dan buka modal struk
                            window.dispatchEvent(new CustomEvent('close-modal', {
                                detail: 'example-modal'
                            }));
                            window.dispatchEvent(new CustomEvent('open-modal', {
                                detail: 'struk-modal'
                            }));

                            // 8. Reload produk
                            page = 1;
                            finished = false;
                            loadProducts();
                        },

                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('Terjadi kesalahan saat melakukan pembayaran.');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-cashier.layout>
