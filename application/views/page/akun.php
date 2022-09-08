<?php $this->load->view('page/header')?>
             <!-- id pengeturan akun -->
             <div  class="col-sm-9">
                <div class="card shadow-sm" >
                    <div class="card-header">
                        <h3><i class="fa fa-key" aria-hidden="true"></i> Pengaturan Akun</h3>
                        
                    </div>
                    <div class="card-body ">
                        <form action="<?=base_url()?>Home/simpan_akun" method="post">
                            <div class="form-group">
                              <label for="">Nomor Registrasi</label>
                              <input type="text" readonly value="<?=$this->session->userdata('no_reg') ?>" name="no_reg" required class="form-control" placeholder="" aria-describedby="helpId">
                              
                            </div>

                            <div class="form-group">
                              <label for=""><b><i class="fa fa-envelope" aria-hidden="true"></i> E-Mail </b></label><br>
                              <input type="email" name="email" class="form-control" value="<?=$profil['email']?>" required>
                              
                            </div>

                            <div class="form-group">
                              <label for=""><i class="fa fa-phone" aria-hidden="true"></i> Phone</label>
                              <input type="text" name="nomor" required class="form-control" placeholder="" value="<?=$profil['no_telp']?>" aria-describedby="helpId">
                              
                            </div>

                            <hr>

                            <div class="form-group">
                              <label for="">Kata Sandi</label>
                              <input type="password" name="kata_sandi" class="form-control" placeholder="Masukan Kata Sandi" aria-describedby="helpId">
                              
                            </div>

                            <div class="form-group">
                              <label for="">Konfirmasi Kata Sandi</label>
                              <input type="password" name="konfirmasi" class="form-control" placeholder="Konfirmasi Kata Sandi" aria-describedby="helpId">
                              
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

                            
                            
                        </form>
                    </div>  
                  
                </div>

                
            </div>
            <!-- akhir pengeturan akun  -->

            


          </div>
    </div>