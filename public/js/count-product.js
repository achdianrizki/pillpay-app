$(document).ready(function () {

    $('.tambah-barang').on('click', function () {
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
                        <button class="kurangi-barang bg-red-500 text-white px-2 py-1 rounded" data-nama="${nama}">-</button>
                        <input class="jumlah-span font-bold w-10 text-center p-1 rounded" value="1">
                        <button class="tambah-barang-daftar bg-blue-500 text-white px-2 py-1 rounded" data-nama="${nama}">+</button>
                        </div>
                    </li>
                `);
        }
    });

    $('#list-barang-ditambahkan').on('click', '.tambah-barang-daftar', function () {
        const nama = $(this).data('nama');
        let item = $(`li[data-nama="${nama}"]`);
        let jumlah = parseInt(item.attr('data-jumlah'));
        jumlah++;
        item.attr('data-jumlah', jumlah);
        item.find('.jumlah-span').val(jumlah);
    });

    $('#list-barang-ditambahkan').on('click', '.kurangi-barang', function () {
        const nama = $(this).data('nama');
        let item = $(`li[data-nama="${nama}"]`);
        let jumlah = parseInt(item.attr('data-jumlah'));
        jumlah--;

        if (jumlah <= 0) {
            item.remove();
        } else {
            item.attr('data-jumlah', jumlah);
            item.find('.jumlah-span').val(jumlah);
        }
    });
});