<?php $this->load->view('page/header')?>
<?php
     $no_reg =$this->session->userdata('no_reg');
     $sql = "SELECT * FROM tb_santri WHERE no_reg = '$no_reg' ";
     $semua = $this->db->query($sql)->row_array();
?>
              <!-- id identitas -->
              <div  class="col-sm-9">
                    <div class="card shadow-sm" >
                        <div class="card-header">
                            <h3><i class="fa fa-user" aria-hidden="true"></i> Biodata Santri</h3>
                            <a href="" id="btn-input" class="btn btn-primary" style="position: absolute;top: 15px;right: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i> Ubah</a>
                        </div>
                        <div class="card-body" id="input-read">

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    No. KK
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['nomer_kk']?>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    N I K
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['nik']?>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Nama Lengkap
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['nama_lengkap']?>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                <?php
                                function tgl_indo($tanggal){
                                    $bulan = array (
                                        1 =>   'Januari',
                                        'Februari',
                                        'Maret',
                                        'April',
                                        'Mei',
                                        'Juni',
                                        'Juli',
                                        'Agustus',
                                        'September',
                                        'Oktober',
                                        'November',
                                        'Desember'
                                    );
                                    $pecahkan = explode('-', $tanggal);
                                    
                                    // variabel pecahkan 0 = tanggal
                                    // variabel pecahkan 1 = bulan
                                    // variabel pecahkan 2 = tahun
                                
                                    return $pecahkan[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[2];
                                }
                            ?>
                                    Tempat, Tanggal Lahir
                                </div>
                                <div class="col-sm-9">
                                <?=$semua['tempat_lahir']?>, <?php echo tgl_indo($semua['tanggal_lahir'])?>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Jenis Kelamin
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['jenis_kelamin']?>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Anak Ke
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['anak_ke']?> Dari <?=$semua['dari_saudara']?> Bersaudara
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Tinggal Bersama
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['tinggal_bersama']?>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Pendidikan Terakhir
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['pendidikan_terakhir']?>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Phone 1
                                </div>
                                <div class="col-sm-9">
                                    -
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Phone 2
                                </div>
                                <div class="col-sm-9">
                                    -
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Alamat
                                </div>
                                <?php
                                
                                $prov = $this->db->query("SELECT * FROM wilayah_provinsi WHERE id = '$semua[provinsi]' ")->row_array();
                                $kab = $this->db->query("SELECT * FROM wilayah_kabupaten WHERE id = '$semua[kabupaten]' ")->row_array();
                                $kec = $this->db->query("SELECT * FROM wilayah_kecamatan WHERE id = '$semua[kecamatan]' ")->row_array();
                                $ds = $this->db->query("SELECT * FROM wilayah_desa WHERE id = '$semua[desa]' ")->row_array();
                                
                                ?>
                                <div class="col-sm-9">
                                    <?=$prov['nama']?> <br>
                                    <?=$kab['nama']?> <br>
                                    <?=$kec['nama']?> <br>
                                    <?=$ds['nama']?> 
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Alamat
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['alamat_detail']?>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Kode Pos
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['kode_pos']?>
                                </div>
                            </div>

                           

                        </div>
                        <div class="card-body" id="input">

                            <form action="<?=base_url()?>home/profil_masuk" method="post">
                            
                           

                            <div class="row mt-2">
                              <div class="col-3"><label for=""> No. KK </label></div>
                              <div class="col-9">
                                <input type="text" name="kk" value="<?=$semua['nomer_kk']?>" class="form-control" required placeholder="" aria-describedby="helpId">
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-3"><label for=""> N I K </label></div>
                              <div class="col-9">
                                <input type="text" name="nik" value="<?=$semua['nik']?>" class="form-control" required placeholder="" aria-describedby="helpId">
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-3"><label for=""> Nama Lengkap </label></div>
                              <div class="col-9">
                                <input type="text" name="nama" value="<?=$semua['nama_lengkap']?>" class="form-control" required placeholder="" aria-describedby="helpId">
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-3"><label for=""> Tempat Lahir </label></div>
                              <div class="col-9">
                                <input type="text" name="tempat" value="<?=$semua['tempat_lahir']?>" class="form-control" required placeholder="" aria-describedby="helpId">
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-3"><label for=""> Tanggal Lahir </label></div>
                              <div class="col-9">
                                <input type="date" name="tanggal" value="<?=$semua['tanggal_lahir']?>" class="form-control" required placeholder="" aria-describedby="helpId">
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-3"><label for=""> Jenis Kelamin </label></div>
                              <div class="col-9">
                                <input type="radio" name="gender" required value="perempuan" <?php echo $semua['jenis_kelamin']=='perempuan' ? 'checked' : '' ?>> Perempuan <br>
                                <input type="radio" name="gender" required value="laki-laki" <?php echo $semua['jenis_kelamin']=='laki-laki' ? 'checked' : '' ?>> Laki-laki
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-3"><label for=""> Tinggal Bersama </label></div>
                              <div class="col-9">
                                <input type="text" name="tinggal" value="<?=$semua['tinggal_bersama']?>" required class="form-control" placeholder="" aria-describedby="helpId">
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-3"><label for=""> Pendidikan Terakhir </label></div>
                              <div class="col-9">
                                <input type="text" name="pendidikan" value="<?=$semua['pendidikan_terakhir']?>" class="form-control" required placeholder="" aria-describedby="helpId">
                              </div>
                            </div>
                           
                            <div class="row mt-2">
                              <div class="col-3"><label for=""> Alamat </label></div>
                              <div class="col-9">
                                <input type="text" name="alamat" value="<?=$semua['alamat_detail']?>" class="form-control" required placeholder="" aria-describedby="helpId">
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-3"><label for=""> Kode Pos </label></div>
                              <div class="col-9">
                                <input type="text" name="kodepos" value="<?=$semua['kode_pos']?>" class="form-control" required placeholder="" aria-describedby="helpId">
                              </div>
                            </div>

                                   
                           

                        </div>

                        <div class="card-header">
                            <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i> Rencana Pendidikan</h3>
                            
                        </div>
                        <div class="card-body" id="bio-read">

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Mondok
                                </div>
                                <div class="col-sm-9">
                                <?=$semua['mondok']?>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Jenis Daftar
                                </div>
                                <div class="col-sm-9">
                                <?=$semua['jenis_pendaftaran']?>
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Lembaga Formal
                                </div>
                                <div class="col-sm-9">
                                <?=$semua['lembaga_pendidikan']?>
                                </div>
                            </div>

                            
                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Lembaga Salaf
                                </div>
                                <div class="col-sm-9">
                                <?=$semua['status_pendidikan']?>
                                </div>
                            </div>

                            

                            <hr class="my-3">

                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    Ukuran Seragam
                                </div>
                                <div class="col-sm-9">
                                    <?=$semua['ukuran_seragam']?>
                                </div>
                            </div>

                           

                        </div>

                        <!-- hidden dibawah -->

                        
                        <div class="card-body" id="bio">
                            
                                <div class="row mt-2">
                                    <div class="col-3"><label for=""> Mondok </label></div>
                                    <div class="col-9">
                                    <select name="mondok" class="form-control" id="">
                                        <option selected disabled>--Pilih Satu--</option>
                                        <option value="Pondok Putra" <?php echo $semua['mondok']=='Pondok Putra' ? 'selected' : '' ?>>Pondok Putra</option>
                                        <option value="Banat 1" <?php echo $semua['mondok']=='Banat 1' ? 'selected' : '' ?>>Banat 1</option>
                                        <option value="Banat 2" <?php echo $semua['mondok']=='Banat 2' ? 'selected' : '' ?>>Banat 2</option>
                                        <option value="Pondok Anak-anak" <?php echo $semua['mondok']=='Pondok Anak-anak' ? 'selected' : '' ?>>Pondok Anak-anak</option>
                                        <option value="Dhalem atau lainnya" <?php echo $semua['mondok']=='Dhalem atau lainnya' ? 'selected' : '' ?>>Dhalem atau lainnya</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3"><label for=""> Jenis Pendaftaran </label></div>
                                    <div class="col-9">
                                    <select class="custom-select" name="jenis" required id="jenis-pendaftaran">
                                        <option value="" selected disabled>-- Pilih jenis pendaftaran --</option>
                                        <option value="baru" <?php echo $semua['jenis_pendaftaran']=='baru' ? 'selected' : '' ?>>Baru</option>
                                        <option value="mutasi" <?php echo $semua['jenis_pendaftaran']=='mutasi' ? 'selected' : '' ?>>Mutasi</option>
                                        
                                    </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                <div class="col-3"><label for=""> Lembaga Formal </label></div>
                                    <div class="col-9">
                                    <select class="custom-select" name="formal" required id="lembaga">
                                            <option value="" selected disabled>-- Pilih Pendidikan Formal --</option>
                                            <option value="PAUD Raudlatul Ulum" <?php echo $semua['lembaga_pendidikan']=='PAUD Raudlatul Ulum' ? 'selected' : '' ?>>PAUD Raudlatul Ulum</option>
                                            <option value="TK Raudlatul Ulum" <?php echo $semua['lembaga_pendidikan']=='TK Raudlatul Ulum' ? 'selected' : '' ?>>TK Raudlatul Ulum</option>
                                            <option value="MI Raudlatul Ulum" <?php echo $semua['lembaga_pendidikan']=='MI Raudlatul Ulum"' ? 'selected' : '' ?>>MI Raudlatul Ulum</option>
                                            <option value="MTS Raudlatul Ulum" <?php echo $semua['lembaga_pendidikan']=='MTS Raudlatul Ulum' ? 'selected' : '' ?>>MTS Raudlatul Ulum</option>
                                            <option value="MA Raudlatul Ulum" <?php echo $semua['lembaga_pendidikan']=='MA Raudlatul Ulum' ? 'selected' : '' ?>>MA Raudlatul Ulum</option>
                                            <option value="Ma'had Aly Raudlatul Ulum" <?php echo $semua['lembaga_pendidikan']=='Ma\'had Aly Raudlatul Ulum' ? 'selected' : '' ?>>Ma'had Aly Raudlatul Ulum</option>
                                        
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3"><label for=""> Lembaga Salaf </label></div>
                                    <div class="col-9">
                                    <select class="custom-select" name="status" required>
                                        <option value="" selected disabled>-- Pilih Pendidikan Salaf --</option>
                                        <option value="Madrasah I'dadiyah Raudlatul Ulum" <?php echo $semua['status_pendidikan']=='Madrasah I\'dadiyah Raudlatul Ulum' ? 'selected' : '' ?>>Madrasah I'dadiyah Raudlatul Ulum</option>
                                        <option value="Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Wustho" <?php echo $semua['status_pendidikan']=='Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Wustho' ? 'selected' : '' ?>>Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Wustho </option>
                                        <option value="Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Ulya" <?php echo $semua['status_pendidikan']=='Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Ulya' ? 'selected' : '' ?>>Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Ulya </option>
                                        <option value="Ma'had Aly Raudlatul Ulum" <?php echo $semua['status_pendidikan']=='Ma\'had Aly Raudlatul Ulum' ? 'selected' : '' ?>>Ma'had Aly Raudlatul Ulum</option>
                                                    
                                    </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3"><label for=""> Ukuran Seragam </label></div>
                                    <div class="col-9">
                                    <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam" required name="ukuran_seragam" class="custom-control-input" value="XXS" <?= $semua['ukuran_seragam']=='XXS' ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="ukuran-seragam">XXS</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam1" required name="ukuran_seragam" class="custom-control-input" value="XS" <?= $semua['ukuran_seragam']=='XS' ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="ukuran-seragam1">XS</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam2" required name="ukuran_seragam" class="custom-control-input" value="S" <?= $semua['ukuran_seragam']=='S' ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="ukuran-seragam2">S</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam3" required name="ukuran_seragam" class="custom-control-input" value="M" <?= $semua['ukuran_seragam']=='M' ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="ukuran-seragam3">M</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam4" required name="ukuran_seragam" class="custom-control-input" value="L" <?= $semua['ukuran_seragam']=='L' ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="ukuran-seragam4">L</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam5" required name="ukuran_seragam" class="custom-control-input" value="XL" <?= $semua['ukuran_seragam']=='XL' ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="ukuran-seragam5">XL</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="ukuran-seragam6" required name="ukuran_seragam" class="custom-control-input" value="XXL" <?= $semua['ukuran_seragam']=='XXL' ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="ukuran-seragam6">XXL</label>
                            </div>
                        </div>
                                    </div>
                                </div>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="" id="batal-bio" class="btn btn-danger">Batal</a>
                            </form>

                        </div>

                    </div>
                    


              </div>
             <!-- akhir identitas  -->



           


          </div>
    </div>