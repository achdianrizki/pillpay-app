$(document).ready(function () {
    $('#search-produk').on('keyup', function () {
        const keyword = $(this).val().toLowerCase();
        let found = false;

        $('.grid > div[data-produk]').each(function () {
            const namaProduk = $(this).data('produk').toLowerCase();
            const match = namaProduk.includes(keyword);
            $(this).toggle(match);
            if (match) found = true;
        });

        if ($('#not-found-message').length) {
            $('#not-found-message').remove();
        }

        if (!found) {
            $('.grid').append(`<div id="not-found-message" class="col-span-3 text-center text-gray-500 py-8">${$(this).val()} tidak ditemukan</div>`);
        }

        $('#reset-search').on('click', function () {
            $('#search-produk').val('');
            $('.grid > div[data-produk]').show();
            $('#not-found-message').remove();
        }
        );
    });
})