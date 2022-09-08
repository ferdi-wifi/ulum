<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url('assets/img/logo.png')?>" >  
    <title>Selamat Datang Silahkan Login ...</title>

    <!-- Bootstrap -->
    <link href="<?=base_url('assets/admin')?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url('assets/admin')?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url('assets/admin')?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?=base_url('assets/admin')?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url('assets/admin')?>/build/css/custom.min.css" rel="stylesheet">


    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/sweetalert.min.css">
    <script type="text/javascript" src="<?=base_url('assets/')?>js/sweetalert.min.js"></script>
    
  </head>

  <body class="login">

    <?php
        echo $this->session->flashdata('gagal');
        echo $this->session->flashdata('succ_log');
        echo $this->session->flashdata('login_dulu');
    ?>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?=base_url()?>login_admin/test" method="post">
                <h1> <i class="fa fa-sign-in" aria-hidden="true"></i> Log in </h1>
                <br>
                <img src="<?=base_url('assets/img/database.png')?>" width="250" alt="">
                <br><br>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Log in</button>
                <a class="reset_pass" href="#">Bagaimana kabar anda ?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Raudlatul Ulum
                  <a href="#" class="to_register"> Pondok Pesantren Raudlatul Ulum</a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <i class="fa fa-code" aria-hidden="false"></i>&nbsp; by <i>Imron</i>
                  <p>© <?=date('Y')?> All Rights Reserved <br> Pondok Pesantren Raudlatul Ulum. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      
            
        
      </div>
    </div>
  </body>
</html>
