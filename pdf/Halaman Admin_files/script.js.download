$(document).ready(function () {

    // var keyword = document.getElementById('keyword');
    // keyword.addEventListener('keyup', function () {
    //     consol.log('ok');
    // });

    // hilangkan tombol cari
    $('#tombol-cari').hide();


    // event ketika keyword di tulis
    $('#keyword').on('keyup', function () {
        // munculkan icon loading
        $('.loader').show();

        // ajax menggunakan load
        // $('container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());


        //  $.get()
        $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function (data) {


            $('#container').html(data);
            $('.loader').hide();

        });

    });


});