$(window).scroll(function(){
    let tinggi = $(window).scrollTop();
    if(tinggi > 20){
        $('#navbar').addClass('active');
        $('#navbar').addClass('shadow');
        $('.logo').addClass('active');
        $('.login').css('color', '#333')
        $('.login').removeClass('txt-shadow')
        $('.h3-title').css('opacity', 1)
    }else{
        $('#navbar').removeClass('active');
        $('#navbar').removeClass('shadow');
        $('.logo').removeClass('active');
        $('.login').css('color', 'white')
        $('.login').addClass('txt-shadow')
        $('.h3-title').css('opacity', 0)
    }
    if(tinggi > 200){
        $('#atas').addClass('active')
    }else{
        $('#atas').removeClass('active')
    }
})
$(document).ready(function(){
    $('#atas').click(function(){
        $('html, body').animate({ scrollTop: 0}, 1000, 'easeInOutExpo')
    })
})

$(document).ready(function(){

    // input edit profil
    $('#btn-input').click(function(e){
        e.preventDefault()
        $('#input-read').css('display', 'none')
        $('#bio-read').css('display', 'none')
        $('#input').css('display', 'block')
        $('#bio').css('display', 'block')
    })
    $('#batal-bio').click(function(e){
        e.preventDefault()
        $('#input-read').css('display', 'block')
        $('#bio-read').css('display', 'block')
        $('#input').css('display', 'none')
        $('#bio').css('display', 'none')
    })


    // link menu profil
    // $('#identitas').click(function(e){
    //     e.preventDefault();
    //     $('#item-orang').css('display', 'none');
    //     $('#item-upload').css('display', 'none');
    //     $('#item-akun').css('display', 'none');
    //     $('#item-pdf').css('display', 'none');
    //     $('#item-identitas').css('display', 'block');
    // })
    // $('#orang_tua').click(function(e){
    //     e.preventDefault();
    //     $('#item-identitas').css('display', 'none');
    //     $('#item-upload').css('display', 'none');
    //     $('#item-akun').css('display', 'none');
    //     $('#item-pdf').css('display', 'none');
    //     $('#item-orang').css('display', 'block');
    // })

    // $('#link-upload').click(function(e){
    //     e.preventDefault();
    //     $('#item-identitas').css('display', 'none');
    //     $('#item-orang').css('display', 'none');
    //     $('#item-akun').css('display', 'none');
    //     $('#item-pdf').css('display', 'none');
    //     $('#item-upload').css('display', 'block');
    // })

    // $('#pengaturan').click(function(e){
    //     e.preventDefault();
    //     $('#item-identitas').css('display', 'none');
    //     $('#item-orang').css('display', 'none');
    //     $('#item-upload').css('display', 'none');
    //     $('#item-pdf').css('display', 'none');
    //     $('#item-akun').css('display', 'block');
    // })

    // $('#cetakpdf').click(function(e){
    //     e.preventDefault();
    //     $('#item-identitas').css('display', 'none');
    //     $('#item-orang').css('display', 'none');
    //     $('#item-upload').css('display', 'none');
    //     $('#item-akun').css('display', 'none');
    //     $('#item-pdf').css('display', 'block');
    // })

    // wali

    $('#btn-wali').click(function(e){
        e.preventDefault();
        $('.insert-wali').toggleClass('active');
    })
    $('#wali-batal').click(function(e){
        e.preventDefault();
        $('.insert-wali').removeClass('active');
    })
    


    //untuk drop tanggal
    $('.day').before(`Hari `)
    $('.month').before(`Bulan `)
    $('.year').before(`Tahun `)

    $('#kk').keyup(function(){
        let kk = $(this).val()
        if( kk.length == ''){
            $('#small-kk').html('Nomer KK Harus diisi')
            $('#kk').addClass('is-invalid')
        }else if( kk.length > 16 ){
            $('#small-kk').html(`Nomer KK Maksimal 16 digit.`)
            $('#kk').addClass('is-invalid')
        }else if( kk.length < 16){
            $('#small-kk').html(`Nomer KK Minimal 16 digit.`)
            $('#kk').addClass('is-invalid')
        }else if (kk.length = 16){
            $('#small-kk').html(`<b style="color:green"><i class="fa fa-check" ></i> Nomer KK sesuai</b>`)
            $('#kk').removeClass('is-invalid')
        }
    })

    $("#kk").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $('#kk').addClass('is-invalid')
            $("#small-kk").html("Isi dengan kolom KK dengan Nomer.")
                return false;
        }
    });
    // nik
    $('#nik').keyup(function(){
        let nik = $(this).val()
        if( nik.length == ''){
            $('#small-nik').html('Nomer NIK Harus diisi')
            $('#nik').addClass('is-invalid')
        }else if( nik.length > 16 ){
            $('#small-nik').html(`Nomer NIK Maksimal 16 digit.`)
            $('#nik').addClass('is-invalid')
        }else if( nik.length < 16){
            $('#small-nik').html(`Nomer NIK Minimal 16 digit.`)
            $('#nik').addClass('is-invalid')
        }else if (nik.length = 16){
            $('#small-nik').html(`<b style="color:green"><i class="fa fa-check" ></i> Nomer NIK sesuai</b>`)
            $('#nik').removeClass('is-invalid')
        }
    })

    $("#nik").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $('#nik').addClass('is-invalid')
            $("#small-nik").html("Isi dengan kolom NIK dengan Nomer.")
                return false;
        }
    });
    // nama
    $('#nama').keyup(function(){
        let nama = $(this).val()
        if( nama.length == ''){
            $('#small-nama').html('Nama Lengkap Harus diisi')
            $('#nama').addClass('is-invalid')
        }else{
            $('#small-nama').html(`<b style="color:green"><i class="fa fa-check" ></i></b>`)
            $('#nama').removeClass('is-invalid')
        }
    })
    
    // tempat lahir
    $('#tempat').keyup(function(){
        let tempat = $(this).val()
        if( tempat.length == ''){
            $('#small-tempat').html('Tempat lahir harus diisi')
            $('#tempat').addClass('is-invalid')
        }else if( tempat.length < 3 ){
            $('#small-tempat').html(`Tempat Lahir minimal mengandung 3 karakter.`)
            $('#tempat').addClass('is-invalid')
        }else{
            $('#small-tempat').html(`<b style="color:green"><i class="fa fa-check" ></i> Tempat Lahir sesuai</b>`)
            $('#tempat').removeClass('is-invalid')
        }
    })

     // Tinggal Bersama
     $('#tinggal').keyup(function(){
        let tinggal = $(this).val()
        if( tinggal.length == ''){
            $('#small-tinggal').html('Tinggal Bersama Harus diisi !')
            $('#tinggal').addClass('is-invalid')
        }else{
            $('#small-tinggal').html(`<b style="color:green"><i class="fa fa-check" ></i></b>`)
            $('#tinggal').removeClass('is-invalid')
        }
    })
    // Pendidikan Terakhir
    $('#pendidikan').keyup(function(){
        let pendidikan = $(this).val()
        if( pendidikan.length == ''){
            $('#small-pendidikan').html('Pendidikan Terakhir harus diisi !')
            $('#pendidikan').addClass('is-invalid')
        }else{
            $('#small-pendidikan').html(`<b style="color:green"><i class="fa fa-check" ></i></b>`)
            $('#pendidikan').removeClass('is-invalid')
        }
    })

    // tempat lahir
    $('#jalan').keyup(function(){
        let jalan = $(this).val()
        if( jalan.length == ''){
            $('#small-jalan').html('jalan atau detail alamat harus diisi.')
            $('#jalan').addClass('is-invalid')
        }else if( jalan.length < 6 ){
            $('#small-jalan').html(`jalan atau detail alamat minimal mengandung 6 karakter.`)
            $('#jalan').addClass('is-invalid')
        }else{
            $('#small-jalan').html(`<b style="color:green"><i class="fa fa-check" ></i> alamat sesuai.</b>`)
            $('#jalan').removeClass('is-invalid')
        }
    })

     // Kode Post
     $('#pos').keyup(function(){
        let pos = $(this).val()
        if( pos.length == ''){
            $('#small-pos').html('pos harus diisi.')
            $('#pos').addClass('is-invalid')
        }else if( pos.length < 5 ){
            $('#small-pos').html(`pos minimal mengandung 5 karakter.`)
            $('#pos').addClass('is-invalid')
        }else{
            $('#small-pos').html(`<b style="color:green"><i class="fa fa-check" ></i> Kode pos sesuai.</b>`)
            $('#pos').removeClass('is-invalid')
        }
    })

    // Kode Post
    $('#email').keyup(function(){
        let email = $(this).val()
        if( email.length == ''){
            $('#small-email').html('email harus diisi.')
            $('#email').addClass('is-invalid')
        }else{
            $('#small-email').html(`<b style="color:green"><i class="fa fa-check" ></i> Alamat E-Mail Harus Sesuai dengan E-Mail anda.</b>`)
            $('#email').removeClass('is-invalid')
        }
    })
    // Kode Post
    $('#telp').keyup(function(){
        let telp = $(this).val()
        if( telp.length == ''){
            $('#small-telp').html('Nomer Telephon harus diisi.')
            $('#telp').addClass('is-invalid')
        }else{
            $('#small-telp').html(`<b style="color:green"><i class="fa fa-check" ></i> No. Telp harus valid.</b>`)
            $('#telp').removeClass('is-invalid')
        }
    })

    // Kata Sandi
    $('#sandi').keyup(function(){
        let sandi = $(this).val()
        if( sandi.length == ''){
            $('#small-sandi').html('Kata sandi harus diisi.')
            $('#sandi').addClass('is-invalid')
        }else if( sandi.length < 6 ){
            $('#small-sandi').html(`Kata sandi minimal mengandung 6 karakter.`)
            $('#sandi').addClass('is-invalid')
        }else{
            $('#small-sandi').html(`<b style="color:green"><i class="fa fa-check" ></i></b>`)
            $('#sandi').removeClass('is-invalid')
        }
    })
   
    $('#ulang-sandi').keyup(function(){
        let ulang_sandi = $(this).val()
        var sandi1 = $('#sandi').val()
        if( ulang_sandi.length == ''){
            $('#small-ulang-sandi').html('ketik ulang sandi harus diisi.')
            $('#ulang-sandi').addClass('is-invalid')
        }else{
            let ulang_sandi = $(this).val()
            if( sandi1 != ulang_sandi){
                $('#small-ulang-sandi').html('sandi tidak sesuai.')
                $('#ulang-sandi').addClass('is-invalid')
            }else{
                $('#small-ulang-sandi').html(`<b style="color:green"><i class="fa fa-check" ></i> Sandi sesuai.</b>`)
                $('#ulang-sandi').removeClass('is-invalid')
            }
        }
    })


   
})