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
    <script>
         // load untuk data wilayah
    $(document).ready(function(){
        $("#provinsi").change(function (){
            var url = "<?php echo site_url('wilayah/add_ajax_kab');?>/"+$(this).val();
            $('#kabupaten').prop('disabled', false)
            $('#kabupaten').load(url);
            return false;
        })

           $("#kabupaten").change(function (){
            var url = "<?php echo site_url('wilayah/add_ajax_kec');?>/"+$(this).val();
            $('#kecamatan').prop('disabled', false)
            $('#kecamatan').load(url);
            return false;
        })

           $("#kecamatan").change(function (){
            var url = "<?php echo site_url('wilayah/add_ajax_des');?>/"+$(this).val();
            $('#desa').prop('disabled', false)
            $('#desa').load(url);
            return false;
        })
    });
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

    <?=$this->session->userdata('daftar_dulu'); ?>

<section>
    <div class="container-fluid" id="content">
        <form action="<?=base_url()?>home/insert" method="post" id="form-santri">
        <div class="card">
            <div class="card-header text-muted" style="font-size: 30px">
                <i class="fa fa-address-card-o" aria-hidden="true"></i> Biodata Santri
            </div>
            <div class="card-body">

                  
                     
                            <input type="hidden" readonly name="no_reg" value="<?=$no_reg?>" class="form-control" aria-describedby="helpId">
                                
                    
                
                    <!-- kk -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Nomor KK (Kartu Keluarga)</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="number" required name="kk" id="kk" class="form-control" placeholder="Nomer Kartu Keluarga" aria-describedby="helpId">
                                <small id="small-kk" class="merah"></small>
                        </div>
                    </div>
                    <!-- Nik -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">NIK</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="number" required name="nik" id="nik" class="form-control" placeholder="Nomer Induk Keluarga" aria-describedby="helpId">
                                <small id="small-nik" class="merah"></small>
                        </div>
                    </div>
                    <!-- nama Lengkap -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Nama Lengkap</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" required name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" aria-describedby="helpId">
                                <small id="small-nama" class="merah"></small>
                        </div>
                    </div>
                    <!-- jenis kelamin -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Jenis Kelamin</label>
                        </div>
                        <div class="col-12 col-sm-9">
                           
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="gender" name="gender" class="custom-control-input" required value="perempuan">
                                    <label class="custom-control-label" for="gender">Perempuan</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="gender1" name="gender" class="custom-control-input" required value="laki-laki">
                                    <label class="custom-control-label" for="gender1">Laki-laki</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tempat lahir -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Tempat Lahir</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" required name="tempat" id="tempat" class="form-control" placeholder="Tempat Lahir" aria-describedby="helpId">
                                <small id="small-tempat" class="merah"></small>
                        </div>
                    </div>

                    <!-- Tanggal lahir -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Tanggal Lahir</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" required id="tanggal" data-format="DD-MM-YYYY"  data-template="D MMM YYYY" name="date">
                            <script>
                            $(function(){
                                $('#tanggal').combodate({
                                    minYear: 1975,
                                    maxYear: 2019,
                                    minuteStep: 10,
                                    
                                });    
                            });
                            </script>
                        </div>
                    </div>
                    <!-- Tanggal lahir -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Anak Ke -</label>
                        </div>
                        <div class="col-12 col-sm-9">
                           <input type="number" required name="anak" id="anak" class="ke form-control" placeholder="" aria-describedby="helpId"> Dari <input type="number" name="dari_anak" id="anak1" required class="ke form-control" placeholder="" aria-describedby="helpId"> Saudara
                           <small id="small-anak" class="merah"></small>
                        </div>
                    </div>

                    <hr class="my-3">
                    <!-- tinggal Bersama -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Tinggal Bersama</label>
                        </div>
                        <div class="col-12 col-sm-9">
                           <input type="text" required name="tinggal" id="tinggal" class="form-control" placeholder="Tinggal Bersama" aria-describedby="helpId">
                           <small id="small-tinggal" class="merah"></small>
                        </div>
                    </div>

                     <!-- Pendidikan Terakhir -->
                     <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Pendidikan Terakhir</label>
                        </div>
                        <div class="col-12 col-sm-9">
                           <input type="text" required name="pendidikan" id="pendidikan" class="form-control" placeholder="Pendidikan Terakhir" aria-describedby="helpId">
                           <small id="small-pendidikan" class="merah"></small>
                        </div>
                    </div>

                    <hr class="my-3">
                    <!-- Tempat Provinsi, kabupaten, kec, desa -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Provinsi</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <select required name="prov" class="form-control" id="provinsi" >
                                <option value="">- Select Provinsi -</option>
                                <?php 
                                    foreach($provinsi as $prov)
                                    {
                                        echo '<option value="'.$prov->id.'">'.$prov->nama.'</option>';
                                    }
                                ?>
                            </select>
                           <small id="small-provinsi" class="merah"></small>
                        </div>
                    </div>
                    <!-- kabupaten -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Kabupaten</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <select required name="kab" class="form-control" id="kabupaten"  disabled>
                                <option value=''>Select Kabupaten</option>
                               
                            </select>
                           <small id="small-kabupaten" class="merah"></small>
                        </div>
                    </div>
                     <!-- kecamatan -->
                     <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Kecamatan</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <select required name="kec" class="form-control" id="kecamatan"  disabled>
                                <option  value="">Select Kecamatan</option>
                               
                            </select>
                           <small id="small-kecamatan" class="merah"></small>
                        </div>
                    </div>
                     <!-- Desa -->
                     <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Desa</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <select required name="des" class="form-control" id="desa"  disabled>
                                <option  value="">Select Desa</option>
                               
                            </select>
                            <small id="small-desa" class="merah"></small>
                        </div>
                    </div>

                    <!-- jalan -->
                    <hr class="my-3">
                     <!-- jalan -->
                     <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Jalan atau Detail Alamat</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" name="jalan" id="jalan" required class="form-control" placeholder="Jalan atau Detail Alamat" aria-describedby="helpId">
                                <small id="small-jalan" class="merah"></small>
                        </div>
                    </div>
                    <!-- jalan -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-3">
                            <label for="">Kode Pos</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="number" name="pos" id="pos" required class="form-control" placeholder="Nomer kode pos" aria-describedby="helpId">
                                <small id="small-pos" class="merah"></small>
                        </div>
                    </div>

                
            </div>
            <!-- rencana sekolah -->
            <div class="card-header text-muted" style="font-size: 30px">
                <i class="fa fa-pencil" aria-hidden="true"></i> Rencana Sekolah
            </div>
            <div class="card-body">
                 <!-- Mondok -->
                 <div class="row mt-3">
                    <div class="col-12 col-sm-3">
                        <label for="">Mondok</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        
                        <select name="mondok" class="form-control" id="">
                            <option selected disabled>--Pilih Satu--</option>
                            <option value="Pondok Putra">Pondok Putra</option>
                            <option value="Banat 1">Banat 1</option>
                            <option value="Banat 2">Banat 2</option>
                            <option value="Pondok Anak-anak">Pondok Anak-anak</option>
                            <option value="Dhalem atau lainnya">Dhalem atau lainnya</option>
                        </select>
                    </div>
                </div>
                
                <!-- jenis pendaftaran -->
                <div class="row mt-3">
                    <div class="col-12 col-sm-3">
                        <label for="">Jenis Pendaftaran</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <div class="form-group">
                            
                            <select class="custom-select" name="jenis_pendaftaran" required id="jenis-pendaftaran">
                                <option value="" selected disabled>-- Pilih jenis pendaftaran --</option>
                                <option value="baru">Baru</option>
                                <option value="mutasi">Mutasi</option>
                                
                            </select>
                        </div>
                        <small id="small-jenis-pendaftaran" class="merah"></small>
                    </div>
                </div>
                <!-- Lembaga -->
                <div class="row mt-3">
                    <div class="col-12 col-sm-3">
                        <label for="">Pendidikan Formal *) </label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <div class="form-group">
                            
                            <select class="custom-select" name="lembaga" id="lembaga">
                                <option value="" selected>-- Pilih Pendidikan Formal --</option>
                                <option value="PAUD Raudlatul Ulum">PAUD Raudlatul Ulum</option>
                                <option value="TK Raudlatul Ulum">TK Raudlatul Ulum</option>
                                <option value="MI Raudlatul Ulum">MI Raudlatul Ulum</option>
                                <option value="MTS Raudlatul Ulum">MTS Raudlatul Ulum</option>
                                <option value="MA Raudlatul Ulum">MA Raudlatul Ulum</option>
                               
                               
                                
                            </select>
                        </div>
                        <small id="small-lembaga" class="merah"></small>
                    </div>
                </div>

                 <!-- Status -->
                 <div class="row mt-3">
                    <div class="col-12 col-sm-3">
                        <label for="">Pendidikan Salaf</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <div class="form-group">
                            
                            <select class="custom-select" name="status" required>
                                <option value="" selected disabled>-- Pilih Pendidikan Salaf --</option>
                                <option value="Madrasah I'dadiyah Raudlatul Ulum">Madrasah I'dadiyah Raudlatul Ulum</option>
                                <option value="Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Wustho">Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Wustho </option>
                                <option value="Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Ulya">Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Ulya </option>
                                <option value="Ma'had Aly Raudlatul Ulum">Ma'had Aly Raudlatul Ulum</option>
                                            
                            </select>
                        </div>
                        
                    </div>
                </div>

                
                <hr class="my-3">    
                  <!-- Ukuran Seragam -->
                  <div class="row mt-3">
                    <div class="col-12 col-sm-3">
                        <label for="">Ukuran Seragam</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam" required name="ukuran_seragam" class="custom-control-input" value="XXS">
                                <label class="custom-control-label" for="ukuran-seragam">XXS</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam1" required name="ukuran_seragam" class="custom-control-input" value="XS">
                                <label class="custom-control-label" for="ukuran-seragam1">XS</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam2" required name="ukuran_seragam" class="custom-control-input" value="S">
                                <label class="custom-control-label" for="ukuran-seragam2">S</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam3" required name="ukuran_seragam" class="custom-control-input" value="M">
                                <label class="custom-control-label" for="ukuran-seragam3">M</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam4" required name="ukuran_seragam" class="custom-control-input" value="L">
                                <label class="custom-control-label" for="ukuran-seragam4">L</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam5" required name="ukuran_seragam" class="custom-control-input" value="XL">
                                <label class="custom-control-label" for="ukuran-seragam5">XL</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam6" required name="ukuran_seragam" class="custom-control-input" value="XXL">
                                <label class="custom-control-label" for="ukuran-seragam6">XXL</label>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row mt-3">
                    <div class="col-12 col-sm-9">
                        <label for="">*) Keterangan Pendidikan Formal Tidak wajib dipilih</label>
                    </div>
                </div>                 

            </div>
            <!-- Akun Pendaftaran -->
            <div class="card-header text-muted" style="font-size: 30px">
                <i class="fa fa-user" aria-hidden="true"></i> Akun Pendaftaran
            </div>
            <div class="card-body">
                 <!-- Email -->
                <div class="row mt-3">
                    <div class="col-12 col-sm-3">
                        <label for="">E-Mail</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <input type="email" name="email" required id="email" class="form-control" placeholder="Masukan E-Mail" aria-describedby="helpId">
                        <small id="small-email" class="merah"></small> <br>
                        <small id="small-email" style="color: blue"><i>Email harus valid karena informasi pendaftaran akan dikirim kepada akun yang anda daftarkan.</i></small> 
                    </div>
                </div>
                 <!-- No. TElp -->
                 <div class="row mt-3">
                    <div class="col-12 col-sm-3">
                        <label for="">No. Telp</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <input type="number" required name="telp" id="telp" class="form-control" placeholder="+62xxxxxxxxxx" aria-describedby="helpId">
                        <small id="small-telp" class="merah"></small> <br>
                        <small id="small-telp" style="color: blue"><i>No. Telephon harus valid karena nomer tersebut akan dihubungi oleh kami terkaik Pendaftaran.</i></small> 
                    </div>
                </div>
                <hr class="my-3">
             <!-- Kata sandi -->
             <div class="row mt-3">
                <div class="col-12 col-sm-3">
                    <label for="">Kata Sandi</label>
                </div>
                <div class="col-12 col-sm-9">
                    <input type="password" required name="sandi" id="sandi" class="form-control" placeholder="Masukan kata sandi" aria-describedby="helpId">
                    <small id="small-sandi" class="merah"></small> <br>
                   
                </div>
            </div>
             <!-- Kata Ulang sandi -->
             <div class="row mt-3">
                <div class="col-12 col-sm-3">
                    <label for="">Ketik Ulang Kata Sandi</label>
                </div>
                <div class="col-12 col-sm-9">
                    <input type="password" required name="ulang_sandi" id="ulang-sandi" class="form-control" placeholder="Masukan ulang Sandi" aria-describedby="helpId">
                    <small id="small-ulang-sandi" class="merah"></small> <br>
                   
                </div>
            </div>
                    <button type="submit" class="btn btn-lg bg-dark text-light" style="border-radius: 5px;padding:10px 60px">
                        Daftar
                    </button>
            </div>
            
                            
        </div>
                   
        </form>    
    </div>
</section>