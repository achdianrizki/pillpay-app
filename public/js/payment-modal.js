$(document).ready(function () {

    $('#bayar-button').on('click', function () {
        const nama = $(this).data('nama');
        const list = $('#list-product');
        let existing = list.find(`li[data-nama="${nama}"]`);

        console.log('diklik bayar button', nama);


        if (existing.length > 0) {
            let jumlah = parseInt(existing.attr('data-jumlah-product'));
            jumlah++;
            existing.attr('data-jumlah', jumlah);
            existing.find('.jumlah-product').val(jumlah);
        } else {
            list.append(`
                    <li class="p-2 bg-gray-200 rounded flex justify-between items-center" data-nama="${nama}" data-jumlah-product="1">
                        <span>${nama}</span>
                        <div class="flex items-center space-x-2">
                        <input class="jumlah-product font-bold w-10 text-center p-1 rounded" value="1">
                        </div>
                    </li>
                `);
        }
    });
});