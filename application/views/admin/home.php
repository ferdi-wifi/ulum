<?php $this->load->view('admin/header') ?>

<!-- /top tiles -->
<br><br><br><br><br><br><br><br>
<?php echo $this->session->flashdata('succ') ?>
<div class="row">
	<!-- tulis disini -->

  <div class="jumbotron">
    <h1 class="display-3">Selamat Datang <i class="fa fa-coffee" aria-hidden="true"></i> </h1>
    <p class="lead"><?=$this->session->userdata('nama')?></p>
    <hr class="my-2">
    <p>Gunakan Semua ini dengan bijak <i class="fa fa-smile-o" aria-hidden="true"></i></p>
    <p class="lead">
        
    </p>
  </div>

  




</div>
<br />
<?php $this->load->view('admin/footer') ?>
