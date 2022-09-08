<?php $this->load->view('page/header')?>
            <!-- id orangtua -->
            <div  class="col-sm-9" >
                <div class="card shadow-sm" >
                    <div class="card-header">
                        <h3><i class="fa fa-users" aria-hidden="true"></i> Orang Tua / Wali</h3>
                        <a href="" id="btn-wali"  class="btn btn-primary" style="position: absolute;top: 15px;right: 10px;"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                    </div>
                  
                </div>

                <div class="alert alert-warning mt-3 mb-3" role="alert">
                    
                        <i>Lengkapi juga data mahrom, diperuntukkan jika keluarga mahrom ingin mengunjungi santriwati di ruang kunjungan mahrom di kemudian hari. Diantara keluarga mahrom seperti, saudara kandung/tiri, paman atau kakek dari pesertadidik.</i>
                </div>
                <div class="card shadow-sm insert-wali">
                    <div class="card-header">
                        <h3>Tambah Keluarga</h3>
                        <form action="<?=base_url()?>Home/simpan_wali" method="post">
                        <button type="submit" class="btn btn-primary" style="position: absolute;top: 15px;right: 10px;"><i class="fa fa-download" aria-hidden="true"></i> Simpan</button> <a href="" class="btn btn-danger" id="wali-batal" style="position: absolute;top: 15px;right: 130px;"><i class="fa fa-times" aria-hidden="true"></i> Batal</a>
                    </div>
                    <div class="card-body ">
                            <div class="form-group">
                              <label for="">Nama</label>
                              <input type="text" name="nama" required class="form-control" placeholder="" aria-describedby="helpId">
                              
                            </div>
                           
                            <div class="form-group">
                              <label for="">Agama</label>
                              <select name="agama" class="form-control">
                                <option selected disabled>Pilih Agama sebagai ...</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for=""><b> Jenis Kelamin </b></label><br>
                                <input type="radio" required name="jenis_kelamin" value="perempuan"> Perempuan <br>
                                <input type="radio" required name="jenis_kelamin" value="laki-laki"> Laki-laki
                              
                            </div>

                            <div class="form-group">
                              <label for="">Tempat Lahir</label>
                              <input type="text" name="tempat" required class="form-control" placeholder="" aria-describedby="helpId">
                              
                            </div>

                            <div class="form-group">
                              <label for="">Pendidikan Terakhir</label>
                              <input type="text" name="pendidikan" required class="form-control" placeholder="" aria-describedby="helpId">
                              
                            </div>

                            <div class="form-group">
                              <label for="">Nomer Telephon</label>
                              <input type="number" name="no" required class="form-control" placeholder="" aria-describedby="helpId">
                              
                            </div>

                            <div class="form-group">
                              <label for="">Perkerjaan</label>
                              <input type="text" name="kerja" required class="form-control" placeholder="" aria-describedby="helpId">
                              
                            </div>

                            <div class="form-group">
                              <label for="">Penghasilan Per Bulan</label>
                              <input type="number" name="hasil" required class="form-control" placeholder="" aria-describedby="helpId">
                              
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
                            
                        </form>
                    </div>  
                </div>

                <?php
                    $id = $this->session->userdata('no_reg');

                    
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
                                        <th>No Telephon</th>
                                        <th>Status</th>
                                        <th>Atur</th>
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
                                                <td><?=$n->no_tel?></td>
                                                <td><?=$n->status_wali?></td>
                                                <td>
                                                    <a href="<?=base_url('home')?>/hapus_wali/<?=$n->id_wali?>" class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Hapus</a>
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
            <!-- akhir orangtua  -->

            
           

             

            


          </div>
    </div>