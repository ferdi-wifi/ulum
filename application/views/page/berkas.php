<?php $this->load->view('page/header')?>
            <!-- id upload berkas -->
            <?=$this->session->flashdata('berkas_berhasil')?>
            <?=$this->session->flashdata('error_berkas')?>
            <div class="col-sm-9" >
                <div class="card shadow-sm" >
                    <div class="card-header bg-dark">
                        <h3 class="text-light"> <i class="fa fa-archive" aria-hidden="true"></i> Berkas </h3>
                     
                            <a href="#" data-toggle="modal" data-target="#upload_berkas" class="btn btn-primary" style="position: absolute;top: 15px;right: 10px;"><i class="fa fa-upload" aria-hidden="true"></i> Upload</a>
                     
                     
                        
                        <!-- Modal -->
                        <div class="modal fade" id="upload_berkas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="z-index: 100;background: rgba(51, 51, 51, 0.8); ">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="<?=base_url()?>Home/upload_berkas" enctype="multipart/form-data" method="post">
                                        <input type="hidden" name="no_reg" value="<?=$this->session->userdata('no_reg')?>">
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
                                          <textarea name="ket"   required cols="30" rows="7" class="form-control"></textarea>
                                          
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
            
                       
                    </div>

                    <div class="card-header">
                        
                        <i style="font-size: 14px;">
                            *berkas berupa ekstensi gambar (JPG / PNG) Minimal berukuran 800x800, yang memuat lembar scan KK, KTP, Ijazah, Sertifikat, dll
                        </i>
                    </div>
                    <div class="card-body">
                        <div class="row">

                        <?php
                         
                        
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
                                        <a href="<?=base_url('Home')?>/hapus_berkas/<?=$b->id_gambar?>" style="position: absolute; bottom: 10px; right: 5px;" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit_berkas<?=$b->id_gambar?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="z-index: 100;background: rgba(51, 51, 51, 0.8); ">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="<?=base_url()?>home/edit_berkas" enctype="multipart/form-data" method="post">
                                                        <input type="hidden" name="no_reg" value="<?=$this->session->userdata('no_reg')?>">
                                                        <div class="form-group">
                                                        <label for="">Pilih Berkas</label>
                                                        <img src="<?=base_url('upload')?>/berkas/<?=$b->url_gambar?>" class="img-fluid" alt="">
                                                        <input type="hidden" name="berkas_lama" value="<?=$b->url_gambar?>" required     class="form-control">
                                                        <input type="file" name="berkas"     class="form-control">
                                                        <input type="hidden" name="id" value="<?=$b->id_gambar?>">
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
                        
                            ?>
                        </div>
                    </div>
                  
                </div>

               

            </div>
            <!-- akhir upload berkas  -->

            


          </div>
    </div>