<!-- 
=======================================================================================================================
=======================================================================================================================
=========================================== S E L A M A T  D A T A N G ================================================
=================================== S E M O G A  K E R A S A N  M O N D O K  Y A :) ===================================
=======================================================================================================================
=======================================================================================================================
 -->
 <?php
     $no_reg =$this->session->userdata('no_reg');
     $sql = "SELECT * FROM tb_santri WHERE no_reg = '$no_reg' ";
     $semua = $this->db->query($sql)->row_array();
?>

 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?=base_url('assets/img/gambar2.png')?>">
    <title>Pondok Pesantren Raudaltul Ulum</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/nurul.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/sweetalert.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/font-awesome.min.css">
    <script type="text/javascript" src="<?=base_url('assets/')?>js/jquery.min.js"></script>
    
    <script type="text/javascript" src="<?=base_url('assets/')?>js/jquery.easing.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/moment.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/combodate.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/popper.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/sweetalert.min.js"></script>
    <style>
        .btn-outline-primary{
            border:none;
        }
    </style>
    <script>
         // load untuk data wilayah
    
    </script>
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
                        <a class="login txt-shadow" href="<?=base_url('home/logout')?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Keluar </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
        echo $this->session->flashdata('gambar_berhasil');
        echo $this->session->flashdata('error_gambar');
        echo $this->session->flashdata('berhasil');
        echo $this->session->flashdata('email_berhasil');
        echo $this->session->flashdata('sandi_salah');
        echo $this->session->flashdata('hapus_berhasil');
        echo $this->session->flashdata('insert');
    ?>

    

    <div class="container-fluid p-5" style="background: #eee">
          <div class="row justify-content-center">
              <div class="col-sm-3">
                  <div class="col-12" style="background: white;padding: 0px;box-shadow: 1px 1px 5px #ddd">
                        <?php if($semua['foto_diri'] != ''){
                            ?>
                                <img src="<?=base_url('upload/')?>user/<?=$semua['foto_diri']?>" class="img-fluid" alt="">

                            <?php
                        }else{
                            ?>
                                <img src="<?=base_url('upload/')?>user/fotokosong.gif" width="100%" class="img-fluid" alt="">
                            <?php
                        }?>
                        
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#upload" style="position: absolute;bottom: 20px; right: 20px"><i class="fa fa-upload" aria-hidden="true"></i> Upload Foto</button>
                            <!-- Modal -->
                            <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background: rgba(51, 51, 51, 0.8);">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <form action="<?=base_url()?>home/upload_foto" method="post" enctype="multipart/form-data">

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="kolo_ada" value="<?=$semua['foto_diri']?>">
                                                <input type="hidden" name="id" value="<?=$this->session->userdata('no_reg')?>">
                                              <label for=""><i class="fa fa-file-image-o" aria-hidden="true"></i> Pilih Gambar </label>
                                              <input type="file" name="diri_sendiri"  class="form-control" placeholder="Pilih Gambar Diri Sendiri" aria-describedby="helpId">
                                              
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Upload Foto</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                  </div>
                  <div class="col-12 text-center bg-warning mt-3"  style="padding: 10px;box-shadow: 1px 1px 5px #ddd;color: white">
                  No. Registrasi <?=$semua['no_reg']?>
                    </div>
                    <div class="col-12 text-left mt-3"  style="background: white;padding: 10px;padding-bottom: 200px;box-shadow: 1px 1px 5px #ddd">
                   
                        <p class=" text-left">
                            <a href="<?php echo base_url('profil'); ?>" class="btn btn-outline-primary" style="text-align:left;display:block"><i class="fa fa-user-circle" aria-hidden="true"></i> Identitas Peserta Didik</a>
                        </p>    
                        <p class=" text-left">
                            <a href="<?php echo base_url('orangtua'); ?>" class="btn btn-outline-primary" style="text-align:left;display:block"><i class="fa fa-users" aria-hidden="true"></i> Orang Tua / Wali</a>
                        </p>    
                        <p class=" text-left">
                            <a href="<?php echo base_url('bayar'); ?>"  class="btn btn-outline-primary" style="text-align:left;display:block"><i class="fa fa-money" aria-hidden="true"></i> Pembayaran</a>
                        </p>    
                        <p class=" text-left">
                            <a href="<?php echo base_url('berkas'); ?>"  class="btn btn-outline-primary" style="text-align:left;display:block"><i class="fa fa-file-image-o" aria-hidden="true"></i> Upload Berkas</a>
                        </p>    
                    
                        <p class=" text-left">
                            <a href="<?php echo base_url('akun'); ?>" class="btn btn-outline-primary" style="text-align:left;display:block"><i class="fa fa-key" aria-hidden="true"></i> Pengaturan Akun</a>
                        </p>

                        <p class=" text-left">
                        <a href="<?php echo base_url('cetak'); ?>"  class="btn btn-outline-primary" style="text-align:left;display:block"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                            <!-- <a href="alamat" id="cetak" class="btn btn-outline-primary" style="text-align:left;display:block"><i class="fa fa-print" aria-hidden="true"></i> Cetak Pendaftaran</a> -->
                        </p>    
                          
                    </div>
              </div>