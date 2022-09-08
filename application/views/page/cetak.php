<?php $this->load->view('page/header')?>
            
            <!-- id pengeturan cetak -->
            <div  class="col-sm-9">
                <div class="card shadow-sm" >
                    <div class="card-header">
                        <h3><i class="fa fa-print" aria-hidden="true"></i> Silakan Cetak Semua Formulirnya</h3>
                        
                    </div>
                </div>
                <!--  -->
                <div class="card shadow-sm mt-4">
                    <embed src="<?=base_url('pondok')?>" type="application/pdf" width="100%" height="800px"/>
                </div>
    
                <div class="card shadow-sm mt-4">
                    <embed src="<?=base_url('salaf')?>" type="application/pdf" width="100%" height="800px"/>
                </div>
                <?php
                    if ($profil['lembaga_pendidikan']=="") {
                        
                    } else {
                       ?>
                       <div class="card shadow-sm mt-4">
                    <embed src="<?=base_url('formal')?>" type="application/pdf" width="100%" height="800px"/>
                </div>
                       <?php
                    }
                    
                ?>
                

                <!--  -->
            </div>
            <!-- akhir cetak  -->


          </div>
    </div>