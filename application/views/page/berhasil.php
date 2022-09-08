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
    <title>Pondok Pesantren Raudlatul Ulum </title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/nurul.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/sweetalert.min.css">
    <script type="text/javascript" src="<?=base_url('assets/')?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/jquery.easing.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/moment.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/combodate.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/popper.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/sweetalert.min.js"></script>
    
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light" id="navbar-daftar">
        <a class="navbar-brand" href="#">
            <img src="<?=base_url('assets')?>/img/psb/gambar1.png" class="img-fluid logo" alt=""> &nbsp; <h3 class="h3-title" style='color: #333;transition: .4s;opacity: 0'>Pondok Pesantren Raudlatul Ulum</h3>
        </a>
       
        <div class="navbar-collapse text-right">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                   
            </ul>
            <div>

                <ul class="navbar-nav">
                    <li class="nav-item text-light ">
                        <a class="login txt-shadow" href="#" data-toggle="modal" data-target="#modelId"><i class="fa fa-sign-in" aria-hidden="true"></i> Login </a>

                        
                        <!-- Modal -->
                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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

    <div class="jumbotron text-center">
       
        <?php
            if($this->session->flashdata('berhasil') != ''){
                ?>
                <script>swal("Pendaftaran Sukses !", "Silahkan lanjukkan dengan Login.", "success")</script>
        
                    <div class="daftar1 text-center shadow">
                        <b>Pendaftaran Berhasil !</b>
                    </div>
                <?php
            }else{
                
            }
        ?>
        
                    <br>
        <small style="color:#333;font-size: 13px">No. Registrasi</small>
        <br>
        <br>
        <h1><?php
        $sql = $this->db->query("SELECT * FROM tb_santri ORDER BY no_reg DESC LIMIT 1")->row_array();
        echo $sql['no_reg'];
        ?></h1>
        <br>
        <p style="color:#999">
            Diharapkan untuk menyimpan kode pendaftaran diatas, karena nantinya akan digunakan untuk Login dan Validasi data.
        </p>
        <br>
        <p>
            <b>Langkah Selanjutnya :</b>
            <div class="row justify-content-center">

                <div class="col-sm-5">
                    <ol class="text-left">
                        <li>Masuk dengan Nomer Registrasi dan Password yang telah di daftarkan.</li>
                        <li>Validasi Data serta Pengisian identitas Orang tua / Wali</li>
                        <li>Upload Berkas-berkas Pendukung</li>
                    </ol>
                </div>
            </div>
        </p>
        <br>
        <p class="lead">
            <a href="<?=base_url()?>" class="btn btn-outline-primary btn-lg">Kembali Ke Halaman Utama</a>
        </p>
    </div>