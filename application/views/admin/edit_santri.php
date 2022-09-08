<?php $this->load->view('admin/header') ?>

<!-- /top tiles -->
<br><br><br><br><br><br><br><br>
<?php echo $this->session->flashdata('succ') ?>
<div class="row" style="padding: 20px;">
	<!-- tulis disini -->
    <a href="<?=base_url()?>admin_control_panel/data_santri" class="btn btn-primary"> Kembali</a>

    <?php
        echo $this->session->flashdata('gambar_berhasil');
        echo $this->session->flashdata('error_gambar');
        echo $this->session->flashdata('update');
        echo $this->session->flashdata('berkas_berhasil');
        echo $this->session->flashdata('error_berkas');
        echo $this->session->flashdata('berhasil_wali');
        echo $this->session->flashdata('edit_wali');
        echo $this->session->flashdata('berkas_berhasil');
        echo $this->session->flashdata('error_berkas');
    ?>

	<div class="card">
		<div class="card-header">
			<h3>No. Registrasi <?=$santri['no_reg']?></h3>
		</div>
		<div class="card-body">
            <?php if($santri['foto_diri'] != ''){ ?>
                <div class="row">
                    <div class="col-sm-12">
                <img src="<?=base_url('upload')?>/user/<?=$santri['foto_diri']?>" class="img-fluid" width="200"
                    alt="Fotonya">
                    <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_foto" style="position: absolute; bottom: 10px; left: 20px;cursor: pointer">Ganti Foto</span>
                    
                    
                    
                    
                    <div class="modal fade" id="edit_foto" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Foto Diri</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="<?=base_url()?>admin_control_panel/foto_diri" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                      <label for="">Pilih Foto</label>
                                      <input type="hidden" name="id" value="<?=$santri['no_reg']?>">
                                      <input type="file" name="foto" class="form-control" placeholder="" aria-describedby="helpId">
                                      
                                    </div>
                               
                                    <button type="submit" class="btn btn-primary">O K </button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }else{ ?>
                    <img src="<?=base_url('upload')?>/user/fotokosong.gif" class="img-fluid" width="200"
                    alt="Fotonya">
            <?php } ?>
                    
                    </div>
                </div>
			<br><br>
			<div class="row mt-4">
            <form action="<?=base_url()?>admin_control_panel/update_san/<?=$santri['no_reg']?>" method="post">
            
				<div class="col-sm-3">
					Nomer KK
				</div>
				<div class="col-sm-8">
                    <input type="number" name="kk" class="form-control" value="<?=$santri['nomer_kk']?>">
					
				</div>
			</div>
            
			<div class="row mt-4">
				<div class="col-sm-3">
					N I K
				</div>
				<div class="col-sm-8">
                <input type="number" name="nik" class="form-control" value="<?=$santri['nik']?>">
					
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm-3">
					Nama Lengkap
				</div>
				<div class="col-sm-8">
                <input type="text" name="nama" class="form-control" value="<?=$santri['nama_lengkap']?>">
					
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm-3">
					Gender

				</div>
				<div class="col-sm-8">
                    <input type="radio" name="gender" value="perempuan" <?php echo $santri['jenis_kelamin']=='perempuan' ? 'checked' : '' ?>> Perempuan <br>
                    <input type="radio" name="gender" value="laki-laki" <?php echo $santri['jenis_kelamin']=='laki-laki' ? 'checked' : '' ?>> Laki-laki
					
				</div>
			</div>
            <div class="row mt-4">
				<div class="col-sm-3">
					Tempat Lahir
				</div>
				<div class="col-sm-8">
                <input type="text" name="tempat" class="form-control" value="<?=$santri['tempat_lahir']?>">
					
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm-3">
					Tanggal Lahir
				</div>
				<div class="col-sm-8">
                <input type="date" name="tanggal" class="form-control" value="<?=$santri['tanggal_lahir']?>" required>
					

				</div>
			</div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Anak Ke
                </div>
                <div class="col-sm-8">
                <input type="number" name="anak_ke" class="form-control" style="width:20%;display: inline" value="<?=$santri['anak_ke']?>"> Dari <input type="number" name="dari_saudara" class="form-control" style="width:20%;display: inline" value="<?=$santri['dari_saudara']?>"> Saudara
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Tinggal Bersama
                </div>
                <div class="col-sm-8">
                  <input type="text" name="tinggal_bersama" class="form-control" value="<?=$santri['tinggal_bersama']?>">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Pendidikan Terakhir
                </div>
                <div class="col-sm-8">
                    <input type="text" name="pendidikan" class="form-control" value="<?=$santri['pendidikan_terakhir']?>">
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Alamat  
                </div>
                <?php
                                
                $prov = $this->db->query("SELECT * FROM wilayah_provinsi WHERE id = '$santri[provinsi]' ")->row_array();
                $kab = $this->db->query("SELECT * FROM wilayah_kabupaten WHERE id = '$santri[kabupaten]' ")->row_array();
                $kec = $this->db->query("SELECT * FROM wilayah_kecamatan WHERE id = '$santri[kecamatan]' ")->row_array();
                $ds = $this->db->query("SELECT * FROM wilayah_desa WHERE id = '$santri[desa]' ")->row_array();
                
                ?>
                <div class="col-sm-8">
                   Provinsi <b><?=$prov['nama']?></b> <br>
                   Kabupaten <b><?=$kab['nama']?></b> <br>
                   Kecamatan <b><?=$kec['nama']?></b> <br>
                   Desa <b><?=$ds['nama']?></b> 
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Alamat Detail
                </div>
                <div class="col-sm-8">
                    <input type="text" name="alamat" class="form-control" value="<?=$santri['alamat_detail']?>">
                    
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-sm-3">
                    Kode Pos
                </div>
                <div class="col-sm-8">
                    <input type="text" name="kode_pos" class="form-control" value="<?=$santri['kode_pos']?>">
                    
                </div>
            </div>
            <hr>

            <div class="row mt-4">
                <div class="col-sm-3">
                    Tempat Mondok
                </div>
                <div class="col-sm-8">
                    <?=$santri['mondok']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Jenis Pendaftaran
                </div>
                <div class="col-sm-8">
                    <?=$santri['jenis_pendaftaran']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Lembaga Formal
                </div>
                <div class="col-sm-8">
                    <?=$santri['lembaga_pendidikan']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Lembaga Salaf
                </div>
                <div class="col-sm-8">
                    <?=$santri['status_pendidikan']?>
                </div>
            </div>
            <hr class="my-3">
            <div class="row mt-4">
                <div class="col-sm-3">
                    Ukuran Seragam
                </div>
                <div class="col-sm-8">
                    <?=$santri['ukuran_seragam']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    No. Telephon
                </div>
                <div class="col-sm-8">
                 <input type="text" name="no_tel" class="form-control" value="<?=$santri['no_telp']?>">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Kata Sandi
                </div>
                <div class="col-sm-8">
                    <?=$santri['kata_sandi']?>
                </div>
            </div>

<br>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>




		</div>

        <hr>
        <h1>Berkas - berkas</h1>


            <!-- awal berkas -->
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#berkas_tambah">Tambah</a>
            <div class="row" style="padding-left:17px;">
        
        <!-- Modal -->
        <div class="modal fade" id="berkas_tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Wali Santri</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form action="<?=base_url()?>admin_control_panel/upload_berkas" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="no_reg" value="<?=$santri['no_reg']?>">
                        <div class="form-group">
                            <label for="">Pilih Berkas</label>
                            <input type="file" name="berkas" required  class="form-control">
                            <small id="helpId" class="text-muted">Berkas berupa ekstensi gambar (JPG/PNG) Minimal berukuran 800x800</small>
                        </div>

                        <div class="form-group">
                            <label for="">Jenis Berkas : </label>
                            <select name="jenis" class="form-control" required    >
                            <option selected disabled> -- Jenis Berkas -- </option>
                            <option value="Kartu Keluarga (KK)">Kartu Keluarga (KK)</option>
                            <option value="Kartu Tanda Penduduk (KTP)">Kartu Tanda Penduduk (KTP)</option>
                            <option value="Akta Kelahiran">Akta Kelahiran</option>
                            <option value="Surat Hasil Ujian Nasional (SHUN)">Surat Hasil Ujian Nasional (SHUN)</option>
                            <option value="Ijazah">Ijazah</option>
                            <option value="Surat Izin Mengemudi (SIM)">Surat Izin Mengemudi (SIM)</option>
                            <option value="Formulir Pendaftaran">Formulir Pendaftaran</option>
                            <option value="Kartu Indonesia Pintar (KIP)">Kartu Indonesia Pintar (KIP)</option>
                            <option value="Foto Diri">Foto Diri</option>
                            <option value="Nomor Induk Siswa Nasional (NISN)">Nomor Induk Siswa Nasional (NISN)</option>
                            <option value="Sertifikat / Piagam Penghargaan">Sertifikat / Piagam Penghargaan</option>
                            
                            </select>
                            
                        </div>

                        <div class="form-group">
                            <label for="">Keterangan : </label>
                            <textarea name="ket" required cols="30" rows="7" class="form-control"></textarea>
                            
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
                        <?php
                            if($jumlah > 0){

                            
                            foreach ($berkas as $b) {
                                ?>
                                    <div class="col-sm-4 item">
                                        <img src="<?=base_url('upload')?>/berkas/<?=$b->url_gambar?>" class="img-fluid img-thumbnail" alt="">
                                        <span class="badge badge-success" style="position: absolute; top: 10px; left: 25px;"><?=$b->jenis_berkas?></span>
                                        <hr class="my-3">
                                        <small>
                                            Keterangan : <br>
                                            <?=$b->ket?>
                                        </small>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning btn-sm" style="position: absolute; bottom: 10px; right: 35px;" data-toggle="modal" data-target="#edit_berkas<?=$b->id_gambar?>">
                                         <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        <a href="<?=base_url('admin_control_panel')?>/hapus_berkas/<?=$b->id_gambar?>" style="position: absolute; bottom: 10px; right: 5px;" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit_berkas<?=$b->id_gambar?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" >
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Berkas</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="<?=base_url()?>admin_control_panel/edit_berkas" enctype="multipart/form-data" method="post">
                                                        <input type="hidden" name="no_reg" value="<?=$this->session->userdata('no_reg')?>">
                                                        <div class="form-group">
                                                        <label for="">Pilih Berkas</label>
                                                        <img src="<?=base_url('upload')?>/berkas/<?=$b->url_gambar?>" class="img-responsive" alt="">
                                                        <input type="hidden" name="berkas_lama" value="<?=$b->url_gambar?>" required     class="form-control">
                                                        <input type="file" name="berkas" class="form-control">
                                                        <input type="hidden" name="id" value="<?=$b->id_gambar?>">
                                                        <input type="hidden" name="id_santri" value="<?=$santri['no_reg']?>">
                                                        <small id="helpId" class="text-muted">Berkas berupa ekstensi gambar (JPG/PNG) Minimal berukuran 800x800</small><br>
                                                        <small class="text-danger">* jangan di isi bila foto tidak ingin diubah !</small>
                                                        </div>

                                                        <div class="form-group">
                                                        <label for="">Jenis Berkas : </label>
                                                        <select name="jenis" class="form-control" required  >
                                                            <option disabled> -- Jenis Berkas -- </option>
                                                            <option value="Kartu Keluarga (KK)" <?php echo $b->jenis_berkas == 'Kartu Keluarga (KK)' ? 'selected' : ''?>>Kartu Keluarga (KK)</option>
                                                            <option value="Kartu Tanda Penduduk (KTP)" <?php echo $b->jenis_berkas == 'Kartu Tanda Penduduk (KTP)' ? 'selected' : ''?>>Kartu Tanda Penduduk (KTP)</option>
                                                            <option value="Akta Kelahiran" <?php echo $b->jenis_berkas == 'Akta Kelahiran' ? 'selected' : ''?>>Akta Kelahiran</option>
                                                            <option value="Surat Hasil Ujian Nasional (SHUN)" <?php echo $b->jenis_berkas == 'Surat Hasil Ujian Nasional (SHNU)' ? 'selected' : ''?>>Surat Hasil Ujian Nasional (SHUN)</option>
                                                            <option value="Ijazah" <?php echo $b->jenis_berkas == 'Ijazah' ? 'selected' : ''?>>Ijazah</option>
                                                            <option value="Surat Izin Mengemudi (SIM)" <?php echo $b->jenis_berkas == 'Surat Izin Mengemudi (SIM)' ? 'selected' : ''?>>Surat Izin Mengemudi (SIM)</option>
                                                            <option value="Formulir Pendaftaran" <?php echo $b->jenis_berkas == 'Formulir Pendaftaran' ? 'selected' : ''?>>Formulir Pendaftaran</option>
                                                            <option value="Kartu Indonesia Pintar (KIP)" <?php echo $b->jenis_berkas == 'Kartu Indonesia Pintar (KIP)' ? 'selected' : ''?>>Kartu Indonesia Pintar (KIP)</option>
                                                            <option value="Foto Diri" <?php echo $b->jenis_berkas == 'Foto Diri' ? 'selected' : ''?>>Foto Diri</option>
                                                            <option value="Nomor Induk Siswa Nasional (NISN)" <?php echo $b->jenis_berkas == 'Nomor Induk Siswa Nasional (NISN)' ? 'selected' : ''?>>Nomor Induk Siswa Nasional (NISN)</option>
                                                            <option value="Sertifikat / Piagam Penghargaan" <?php echo $b->jenis_berkas == 'Sertifikat / Piagam Penghargaan' ? 'selected' : ''?>>Sertifikat / Piagam Penghargaan</option>
                                                            
                                                        </select>
                                                        
                                                        </div>

                                                        <div class="form-group">
                                                        <label for="">Keterangan : </label>
                                                        <textarea name="ket"     required cols="30" rows="7" class="form-control"><?=$b->ket?></textarea>
                                                        
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        }else{
                            echo '<h5>  Berkas masih <b>belum ada</b></h5>';
                        }
                            ?>
                        </div>
            <!-- akhir berkas -->

        <hr>
        <h1>Wali santri</h1>
        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#wali_tambah">Tambah</a>
        
        <!-- Modal -->
        <div class="modal fade" id="wali_tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Wali Santri</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form action="<?=base_url()?>admin_control_panel/tambah_wali/<?=$santri['no_reg']?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="">Nama</label>
                          <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" aria-describedby="helpId">
                          
                        </div>
                        <div class="form-group">
                          <label for="">Jenis Kelamin</label><br>
                          <input type="radio" name="gender" value="perempuan"> Perempuan <br>
                          <input type="radio" name="gender" value="laki-laki"> Laki-laki <br>
                        </div>
                        <div class="form-group">
                          <label for="">Tempat Lahir</label>
                          <input type="text" name="tempat" class="form-control" placeholder="Tempat Lahir" aria-describedby="helpId">
                          
                        </div>
                        <div class="form-group">
                          <label for="">Pendidikan Terakhir</label>
                          <input type="text" name="pendidikan" class="form-control" placeholder="Pendidikan Terakhir" aria-describedby="helpId">
                          
                        </div>
                        <div class="form-group">
                          <label for="">Nomor Telephon</label>
                          <input type="text" name="nomer" class="form-control" placeholder="No. Telephon" aria-describedby="helpId">
                          
                        </div>
                        <div class="form-group">
                          <label for="">Pekerjaan</label>
                          <input type="text" name="job" class="form-control" placeholder="Pekerjaan" aria-describedby="helpId">
                          
                        </div>
                        <div class="form-group">
                          <label for="">Penghasilan Per Bulan</label>
                          <input type="text" name="penghasilan" class="form-control" placeholder="Penghasilan" aria-describedby="helpId">
                          
                        </div>
                        <div class="form-group">
                              <label for="">Status Wali</label>
                              <select name="status" class="form-control">
                                <option selected disabled>Pilih status sebagai ...</option>
                                <option value="Ayah Kandung">Sebagai Ayah Kandung</option>
                                <option value="Ibu Kandung">Sebagai Ibu Kandung</option>
                                <option value="Nenek dari ayah">Sebagai Nenek dari ayah</option>
                                <option value="Nenek dari ibu">Sebagai Nenek dari ibu</option>
                                <option value="Nenek dari bibinya ayah">Sebagai Nenek dari bibinya ayah</option>
                                <option value="Nenek dari bibinya ibu">Sebagai Nenek dari bibinya ibu</option>
                                <option value="Ibu Tiri">Sebagai Ibu Tiri</option>
                                <option value="Ibu susuan">Sebagai Ibu susuan</option>
                                <option value="Bibi dari ayah">Sebagai Bibi dari ayah</option>
                                <option value="Bibi dari ibu">Sebagai Bibi dari ibu</option>
                                <option value="Saudara Kandung">Sebagai Saudara Kandung</option>
                                <option value="Saudara seayah">Sebagai Saudara seayah</option>
                                <option value="Saudara seibu">Sebagai Saudara seibu</option>
                                <option value="Saudara sesusuan">Sebagai Saudara sesusuan</option>
                                <option value="Cucu dari anak laki">Sebagai Cucu dari anak laki</option>
                                <option value="Cucu dari anak perempuan">Sebagai Cucu dari anak perempuan</option>
                                <option value="Cucu dari ponakan laki">Sebagai Cucu dari ponakan laki</option>
                                <option value="Cucu dari ponakan perempuan">Sebagai Cucu dari ponakan perempuan</option>
                                <option value="Anak Kandung">Sebagai Anak Kandung</option>
                                <option value="Anak Tiri">Sebagai Anak Tiri</option>

                              </select>
                              
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
                    $id = $santri['no_reg'];

                    
                    $sql  = $this->db->query("SELECT * FROM tb_wali WHERE id_santri = '$id' ");
                    $sql2  = $this->db->query("SELECT * FROM tb_wali WHERE id_santri = '$id' ")->result();
                    $tabel = $sql->num_rows();
                    if($tabel > 0){
                        ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Tempat Lahir</th>
                                        <th>Pendidikan</th>
                                        <th>Pekerjaan</th>
                                        <th>Penghasilan</th>
                                        <th>No Telephon</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no =1;
                                    foreach ($sql2 as $n) {
                                        ?>
                                            <tr>
                                                <td><?=$no?></td>
                                                <td><?=$n->nama?></td>
                                                <td><?=$n->tempat_lahir?></td>
                                                <td><?=$n->pendidikan_terakhir?></td>
                                                <td><?=$n->pekerjaan?></td>
                                                <td><?php
                                                    $hasil_rupiah = "Rp " . number_format($n->penghasilan,2,',','.');
	                                                echo $hasil_rupiah . " / bulan";
                                                ?></td>
                                                <td><?=$n->no_tel?></td>
                                                <td><?=$n->status_wali?></td>
                                                <td>
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit_wali<?=$n->id_wali?>">
                                                      <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    <a href="<?=base_url('admin_control_panel')?>/hapus_wali/<?=$n->id_wali?>/<?=$santri['no_reg']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    
                                                    
                                                    <div class="modal fade" id="edit_wali<?=$n->id_wali?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Wali Santri</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                </div>

                                                                <form action="<?=base_url()?>admin_control_panel/edit_wali/<?=$n->id_wali?>" method="post">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="no_reg" value="<?=$santri['no_reg']?>">
                                                                        <label for="">Nama</label>
                                                                        <input type="text" name="nama" value="<?=$n->nama?>" class="form-control" placeholder="Masukan Nama Lengkap" aria-describedby="helpId">
                                                                        
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Jenis Kelamin</label><br>
                                                                        <input type="radio" name="gender" value="perempuan" <?= $n->jenis_kelamin=='perempuan' ? 'checked' : '' ?>> Perempuan <br>
                                                                        <input type="radio" name="gender" value="laki-laki" <?= $n->jenis_kelamin=='laki-laki' ? 'checked' : '' ?>> Laki-laki <br>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Tempat Lahir</label>
                                                                        <input type="text" name="tempat" class="form-control" value="<?=$n->tempat_lahir?>" placeholder="Tempat Lahir" aria-describedby="helpId">
                                                                        
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Pendidikan Terakhir</label>
                                                                        <input type="text" name="pendidikan" class="form-control" value="<?=$n->pendidikan_terakhir?>" placeholder="Pendidikan Terakhir" aria-describedby="helpId">
                                                                        
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Nomor Telephon</label>
                                                                        <input type="number" name="nomer" class="form-control" value="<?=$n->no_tel?>" placeholder="No. Telephon" aria-describedby="helpId">
                                                                        
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Pekerjaan</label>
                                                                        <input type="text" name="job" class="form-control" value="<?=$n->pekerjaan?>" placeholder="Pekerjaan" aria-describedby="helpId">
                                                                        
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Penghasilan Per Bulan</label>
                                                                        <input type="number" name="penghasilan" class="form-control" value="<?=$n->penghasilan?>" placeholder="Penghasilan" aria-describedby="helpId">
                                                                        
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        <?php
                    }else{
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <i>Tidak ada wali</i>
                            </div>
                        <?php
                    }
                ?>


	</div>
</div>






</div>
<br />
<?php $this->load->view('admin/footer') ?>
