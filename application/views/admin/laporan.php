<?php $this->load->view('admin/headerlaporan') ;

?>
<div class="right_col" role="main">
<h2>Silakan Klik untuk mencetak format Excel <i class="fa fa-smile-o" aria-hidden="true"></i></h2>
          <!-- top tiles -->
          <div class="row tile_count">

          <h4>Total Jumlah Mondok</h4>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <a href="<?=base_url()?>admin_control_panel/laporansantri">
              <span class="count_top"><i class="fa fa-user"></i> Pendaftar Pondok</span>
              <div class="count"><?=$jumlah_santri?></div>
              </a>
            </div>
            
            <p class="lead"></p>
            </div>
            <h4>Rincian Pendidikan Salaf</h4>
            <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <a href="<?=base_url('admin_control_panel/laporansalafdadi/')?>">
              <span class="count_top"><i class="fa fa-user"></i> Madrasah I'dadiyah</span>
              <div class="count"><?=$dadi?></div> 
              </a>
            </div>
          

            
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <a href="<?=base_url('admin_control_panel/laporansalafwustho/')?>">
              <span class="count_top"><i class="fa fa-male"></i> Tingkat Wustho</span>
              <div class="count"><?=$wustho?></div> 
              </a>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
            <a href="<?=base_url('admin_control_panel/laporansalafulya/')?>">
              <span class="count_top"><i class="fa fa-male"></i> Tingkat Ulya</span>
              <div class="count"><?=$ulya?></div> 
              </a>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
            <a href="<?=base_url('admin_control_panel/laporansalafmahad/')?>">
              <span class="count_top"><i class="fa fa-male"></i> Tingkat Ma'had Aly</span>
              <div class="count"><?=$madya?></div> 
              </a>
            </div>
            </div>
            <p class="lead"></p>
            <h4>Rincian Pendidian Formal</h4>
            <div class="col-md-12 col-sm-12 col-xs-12">
            
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
            <a href="<?=base_url('admin_control_panel/laporanformalma/')?>">
              <span class="count_top"><i class="fa fa-male"></i> Tingkat MA</span>
              <div class="count"><?=$ma?></div> 
              </a>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
            <a href="<?=base_url('admin_control_panel/laporanformalmts/')?>">
              <span class="count_top"><i class="fa fa-male"></i> Tingkat MTS</span>
              <div class="count"><?=$mts?></div> 
              </a>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
            <a href="<?=base_url('admin_control_panel/laporanformalmi/')?>">
              <span class="count_top"><i class="fa fa-male"></i> Tingkat MI</span>
              <div class="count"><?=$mi?></div> 
              </a>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
            <a href="<?=base_url('admin_control_panel/laporanformaltk/')?>">
              <span class="count_top"><i class="fa fa-male"></i> Tingkat TK</span>
              <div class="count"><?=$tk?></div> 
              </a>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
            <a href="<?=base_url('admin_control_panel/laporanformalpaud/')?>">
              <span class="count_top"><i class="fa fa-male"></i> Tingkat PAUD</span>
              <div class="count"><?=$paud?></div> 
              </a>
            </div>
            </div>
           
<!-- /top tiles -->
<br />
<?php $this->load->view('admin/footer') ?>
