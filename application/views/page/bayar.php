<?php $this->load->view('page/header')?>
            <!-- id upload bayar -->
            <?=$this->session->flashdata('bayar_berhasil')?>
            <?=$this->session->flashdata('error_bayar')?>
            <div class="col-sm-9" >
                <div class="card shadow-sm" >
                    <div class="card-header bg-dark">
                        <h3 class="text-light"> <i class="fa fa-money" aria-hidden="true"></i> Pembayaran </h3>
                     
                            <a href="#" data-toggle="modal" data-target="#upload_bayar" class="btn btn-primary" style="position: absolute;top: 15px;right: 10px;"><i class="fa fa-upload" aria-hidden="true"></i> Upload</a>
                     
                     
                        
                        <!-- Modal -->
                        <div class="modal fade" id="upload_bayar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="z-index: 100;background: rgba(51, 51, 51, 0.8); ">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="<?=base_url()?>Home/upload_bayar" enctype="multipart/form-data" method="post">
                                        <input type="hidden" name="no_reg" value="<?=$this->session->userdata('no_reg')?>">
                                        <div class="form-group">
                                          <label for="">Pilih Bayar</label>
                                          <input type="file" name="bayar" required  class="form-control">
                                          <small id="helpId" class="text-muted">Bukti Pembayaran berupa ekstensi gambar (JPG/PNG) Minimal berukuran 700x700</small>
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
                            *Silakan lakukan pembayaran pada rekining: BNI a/n: Raudaltul Ulum 064774508, BRI a/n:Raudaltul Ulum 02343232335364774508, upload pembayaran sejumlah Rp. 100.000   
                        </i>
                    </div>
                    <div class="card-body">
                        <div class="row">

                        <?php
                         
                        
                            foreach ($bayar as $b) {
                                ?>
                                    <div class="col-sm-4 item">
                                        <img src="<?=base_url('upload')?>/bayar/<?=$b->bukti_bayar?>" class="img-fluid img-thumbnail" alt="">
                                        <hr class="my-3">
                                        <small>
                                            Keterangan : <br>
                                           Bukti Pembayaran
                                        </small>
                                        <br>
                                        <small>
                                            Status Validasi: <br>
                                           <b><?=$b->status?></b>
                                        </small>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning btn-sm" style="position: absolute; bottom: 10px; right: 35px;" data-toggle="modal" data-target="#edit_bayar<?=$b->id_bayar?>">
                                         <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit_bayar<?=$b->id_bayar?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="z-index: 100;background: rgba(51, 51, 51, 0.8); ">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="<?=base_url()?>home/edit_bayar" enctype="multipart/form-data" method="post">
                                                        <input type="hidden" name="no_reg" value="<?=$this->session->userdata('no_reg')?>">
                                                        <div class="form-group">
                                                        <label for="">Pilih Bayar</label>
                                                        <img src="<?=base_url('upload')?>/bayar/<?=$b->bukti_bayar?>" class="img-fluid" alt="">
                                                        <input type="hidden" name="bayar_lama" value="<?=$b->bukti_bayar?>" required     class="form-control">
                                                        <input type="file" name="bayar"     class="form-control">
                                                        <input type="hidden" name="id" value="<?=$b->id_bayar?>">
                                                        <small id="helpId" class="text-muted">Bukti Pembayaran berupa ekstensi gambar (JPG/PNG) Minimal berukuran 700x700</small><br>
                                                        <small class="text-danger">* jangan di isi bila foto tidak ingin diubah !</small>
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
            <!-- akhir upload bayar  -->

            


          </div>
    </div>