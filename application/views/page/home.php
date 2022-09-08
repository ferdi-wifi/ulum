<!-- 
=======================================================================================================================
=======================================================================================================================
=========================================== S E L A M A T  D A T A N G ================================================
=================================== S E M O G A  K E R A S A N  M O N D O K  Y A :) ===================================
=======================================================================================================================
=======================================================================================================================
 -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?=base_url('assets/img/gambar2.png')?>">
    <title>Pondok Pesantren Raudlatul Ulum</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/nurul.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/sweetalert.min.css">
    <script type="text/javascript" src="<?=base_url('assets/')?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/jquery.easing.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/popper.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/sweetalert.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light" id="navbar">
        <a class="navbar-brand" href="#">
            <img src="<?=base_url('assets')?>/img/psb/gambar1.png" class="img-fluid logo" alt=""> &nbsp; <h3 class="h3-title" style='color: #333;transition: .4s;opacity: 0'>Pondok Pesantren Raudlatul Ulum</h3>
        </a>
       
        <div class="navbar-collapse text-right">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                   
            </ul>
            <div>

                <ul class="navbar-nav">
                    <li class="nav-item text-light">
                          <a class="login txt-shadow" href="#" data-toggle="modal" data-target="#modelId"><i class="fa fa-sign-in" aria-hidden="true"></i> Login </a>

                                                
                        <!-- Modal -->
                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="z-index: 100;background: rgba(51, 51, 51, 0.8); ">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark">Login Akun</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?=base_url()?>home/cek_login" method="post">
                                            <div class="input-group">
                                            
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                            </div>
                                            <input type="text" name="reg" id="reg" class="form-control" placeholder="No. Registrasi" aria-describedby="helpId">
                                            
                                            </div>
                                            <br>
                                            <div class="input-group">
                                            
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                                            </div>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="helpId">
                                            
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary" style="padding: 5px 30px;">Login</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
     echo $this->session->flashdata('login_gagal');
     echo $this->session->flashdata('login_dulu');
    ?>

    <div class="container-fluid" id="foto" style="background: url('<?=base_url('assets/img/psb/gambar.jpg')?>');background-size: cover;">
        <div class="container">

            <div class="row">
                
                    <div class="col-sm-20">
                        <div class="jumbotron">
                            <h1 class="display-2 title txt-shadow"><b>Pendaftaran Santri Baru</b></h1>
                            <p class="lead text-light">
                            <?php
                                $thn=date('Y');
                                $berikut= $thn + 1;
                            ?>
                                <h5 class="text-light nurul" style="background: red;padding:10px">
                                <i>Pondok Pesantren Raudlatul Ulum  Tahun <?=date('Y')?>-<?=$berikut?></i>
                                    
                                </h5 >
                            </p>
                            <hr class="my-2">
                            
                            <p class="lead">
                                <a class="btn btn-primary btn-lg" style="padding: 20px 50px;border-radius: 5px;" href="<?=base_url()?>home/daftar" role="button">Daftar</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="container-fluid" id="seluruh">

        <div class="mt-5" id="alur">
            <div class="row justify-content-center">
                <div class="col-sm-12 text-center">
                    <h1 class="title-alur">Alur Pendaftaran Online</h1>
                    <h3 class="mb-5 "><i class="fa fa-angle-double-down " aria-hidden="true"></i></h3>
                </div>
                
            </div>
            <div class="container mt-5">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-5 col-md-6 col-sm-12 item-alur">
                        <h1>-1-</h1>   
                        
                        <h3>Pengisian Data Santri Baru</h3>
                        <hr>
                        <p>
                            Mengisi Identitas calon santri / peserta didik baru, sekaligus pembuatan akun untuk mendapatkan Nomor Registrasi.
                        </p>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 item-alur">
                        <h1>-2-</h1>  
                        <h3>Login & Melengkapi Data</h3>
                        <hr>
                        <p>
                            Melengkapi data peserta santri / peserta didik baru, data orang tua / wali atau mahrom khusus santri putri.
                        </p>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 item-alur">
                        <h1>-3-</h1>  
                        <h3>Mengunggah Berkas</h3>
                        <hr>
                        <p>
                            Mengunggah berkas persyaratan dan berkas pendukung lainnya yang berupa gambar / foto.
                        </p>  
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 item-alur">
                        <h1>-4-</h1>   
                        <h3>Cetak Pendaftaran Online</h3>
                        <hr>
                        <p>
                        Cetak atau simpan Nomor Registrasi sebagai bukti pendaftaran online dan nantinya diserahkan ke panitia.
                        </p>   
                    </div>
                    
                </div>
            </div>

            <div class="container text-center mt-5">
                <a href="<?=base_url()?>home/daftar" class="btn btn-outline-primary btn-lg">
                    <h3 class="daftar">Daftar</h3>
                </a> &nbsp; <b> atau </b> &nbsp; <a href="#" data-toggle="modal" data-target="#modelId" class="btn btn-outline-primary btn-lg">
                    <h3  class="log">Login</h3>
                </a>
            </div>
        </div>

        <div class="container text-center" id="daftar-ulang">
            <h1 class="title-alur"><b>Syarat Pendaftaraan Ulang</b></h1>
            <h3 class="mb-5 "><i class="fa fa-angle-double-down " aria-hidden="true"></i></h3>
            <div class="row justify-content-center text-left">
                <ul>
                    <li>
                        <b>Photo Copy KTP</b> salah satu orang tua/wali sebanyak 4 lembar
                    </li>
                    <li>
                        <b>Photo Copy Akta Kelahiran</b> dan <b>Kartu Keluarga</b> sebanyak 4 lembar
                    </li>
                    <li>
                        <b>Photo Copy Ijazah</b> terakhir dan SHUN sebanyak 4 lembar
                    </li>
                    <li>
                        <b>Pas Photo 3x4</b> Berkopyah untuk putra / berjilbab untuk putri 4 Lembar
                    </li>

                </ul>
            </div>
        </div>

        
        
    </div>
    <div class="container-fluid">
        <div class="text-center" id="pendaftaran-ulang">
            <h1 class="title-alur"><b>Pendaftaran Ulang</b></h1>
            <h3 class="mb-5 "><i class="fa fa-angle-double-down " aria-hidden="true"></i></h3>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-4 col-sm-6 item-ulang">
                    <h1>1</h1>
                    
                    <h3><b>Konfirmasi Nomor Registrasi</b></h3>
                    <hr class="my-2">
                    <p>
                         Menyerahkan Nomor Registrasi dan bukti pendaftaran online kepada panitia penerimaan.
                    </p>
                    <span class='lanjut'>
                        <img src="<?=base_url('assets/img/web/hold.png')?>" alt="">
                    </span>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 item-ulang">
                    <h1>2</h1>
                    
                    <h3><b>Ikrar Santri</b></h3>
                    <hr class="my-2">
                    <p>
                        Melakukan Ikrar Santri dan kesediaan mengikuti aturan yang ditetapkan oleh Pondok Pesantren Raudlatul Ulum.
                    </p>
                    <span class='lanjut'>
                        <img src="<?=base_url('assets/img/web/checked.png')?>" alt="">
                    </span>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 item-ulang">
                    <h1>3</h1>
                    
                    <h3><b>Pengambilan Seragam</b></h3>
                    <hr class="my-2">
                    <p>
                        Menyesuaikan ketentuan Pesantren Raudlatul Ulum
                    </p>
                    <span class='lanjut'>
                        <img src="<?=base_url('assets/img/web/baseball-jersey.png')?>" alt="">
                    </span>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 item-ulang">
                    <h1>4</h1>
                    
                    <h3><b>Checkup / Periksa Kesehatan</b></h3>
                    <hr class="my-2">
                    <p>
                        Menyesuaikan ketentuan Pesantren Raudlatul Ulum
                    </p>
                    <span class='lanjut'>
                        <img src="<?=base_url('assets/img/web/heartbeat.png')?>" alt="">
                    </span>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6 item-ulang">
                    <h1>5</h1>
                    
                    <h3><b>Asrama Santri</b></h3>
                    <hr class="my-2">
                    <p>
                        Santri baru menempati asrama yang telah ditetepkan oleh pengurus.
                    </p>
                    <span class='lanjut'>
                        <img src="<?=base_url('assets/img/web/house.png')?>" alt="">
                    </span>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 item-ulang">
                    <h1>6</h1>
                    
                    <h3><b>Sowan Pengasuh</b></h3>
                    <hr class="my-2">
                    <p>
                        Penyerahan calon peserta didik oleh orangtua / wali
                    </p>
                    <span class='lanjut'>
                        <img src="<?=base_url('assets/img/web/clap.png')?>" alt="">
                    </span>
                </div>
            </div>
        </div>
    </div>

    <section id="informasi">
        <div class="container-fluid text-center informasi">
            <h1 class="title-alur"><b>Informasi Pelayanan Pendaftaran</b></h1>
            <h3 class="mb-5 "><i class="fa fa-angle-double-down " aria-hidden="true"></i></h3>
        </div>
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <h4><b><i class="fa fa-id-card" aria-hidden="true"></i> Pembukaan Pendaftaran & Kantor Layanan :</b></h4>
                    <hr class="my-3">
                    <ul>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> Tanggal :
                            <br>
                            <b>(15 April s.d. 15 Juli 2022)</b>
                        </li><br>
                        <li><i class="fa fa-male" aria-hidden="true"></i></i> Tempat Pendataran Putra :
                            <br>
                            <b>Kantor Pesantren Raudlatul Ulum</b>
                        </li><br>
                        <li><i class="fa fa-home" aria-hidden="true"></i></i> Tempat Pendataran Putri :
                            <br>
                            <b>Kantor Pesantren Raudlatul Ulum (Kondisional)</b>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h4><b><i class="fa fa-clock-o" aria-hidden="true"></i> Waktu Pelayanan :</b></h4>
                    <hr class="my-3">
                    <ul>
                        <li>Pagi : 
                            <br>
                            <b>08.30 ~ 12.00 WIB</b>
                        </li><br>
                        <li>Siang :
                            <br>
                            <b>13.00 ~ 16.00 WIB</b>
                        </li><br>
                        <li>Malam :
                            <br>
                            <b>18.00 ~ 21.00 WIB</b>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <h4><b><i class="fa fa-address-book" aria-hidden="true"></i> Pendaftaran Ulang & Pembayaran :</b></h4>
                    <hr class="my-3">
                    <ul>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> Tanggal :
                            <br>
                            <b>(06 Juni s.d. 15 Juli 2022)</b>
                        </li><br>
                        <li><i class="fa fa-male" aria-hidden="true"></i></i> Tempat Penerimaan Putra :
                            <br>
                            <b>Aula Pondok Pesantren Raudlatul Ulum (Kondisional)</b>
                        </li><br>
                        <li><i class="fa fa-home" aria-hidden="true"></i></i> Tempat Penerimaan Putri :
                            <br>
                            <b>Aula Pondok Pesantren Raudlatul Ulum (Kondisional)</b>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

 <?php $this->load->view('page/footer')?>