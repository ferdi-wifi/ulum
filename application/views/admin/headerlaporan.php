<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?=base_url('assets/img/logo.png')?>" type="image/ico" />

    <title>Control Panel Pendaftaran PP Raudlatul Ulum </title>

    <!-- Bootstrap -->
    <link href="<?=base_url('assets/admin/')?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('assets')?>/css/datatables.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/font-awesome.min.css">
    <!-- NProgress -->
    <link href="<?=base_url('assets/admin/')?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets')?>/css/sweetalert.min.css">
    <!-- bootstrap-progressbar -->
    <link href="<?=base_url('assets/admin/')?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
   
    <!-- Custom Theme Style -->
    <link href="<?=base_url('assets/admin/')?>/build/css/custom.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?=base_url('assets/admin/')?>/vendors/jquery/dist/jquery.min.js"></script>
    
    <script type="text/javascript" src="<?=base_url('assets/')?>js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/')?>js/jquery.easing.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url('assets/admin/')?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?=base_url('assets/admin/')?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?=base_url('assets/admin/')?>/vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?=base_url('assets/admin/')?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
     <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url('assets/admin/')?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?=base_url('assets/admin/')?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?=base_url('assets/admin/')?>/build/js/custom.min.js"></script>
	
 
    <script type="text/javascript" src="<?=base_url('assets/js')?>/datatables.min.js"></script>
    <style>
      body{
        font-family: 'Montserrat', sans-serif;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-home" aria-hidden="true"></i> <span> Control Panel !</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?=base_url('assets/img')?>/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>PP. Raudlatul Ulum</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Umum</h3>
                <ul class="nav side-menu">
                  <li>
                      <a href="<?=base_url()?>admin_control_panel"><i class="fa fa-home"></i> Home </span></a>
                    
                  </li>
                  <li>
                      <a href="<?=base_url()?>admin_control_panel/data_santri"><i class="fa fa-bar-chart" aria-hidden="true"></i> Data Santri </span></a>
                    
                  </li>
                  <li>
                      <a href="<?=base_url()?>admin_control_panel/data_users"><i class="fa fa-user" aria-hidden="true"></i> Users </span></a>
                    
                  </li>
                  <li>
                      <a href="<?=base_url()?>admin_control_panel/back_data"><i class="fa fa-database" aria-hidden="true"></i> Back UP Data </span></a>
                    
                  </li>
                  
                </ul>
              </div>
              <div class="menu_section">
                <h3>Berkas</h3>
                <ul class="nav side-menu">
                    <li>
                      <a href="<?=base_url()?>admin_control_panel/laporan"> <i class="fa fa-book aria-hidden="true"></i> Loporan </span></a>
                    
                  </li>
                    </ul>
                  </li>                  
                  
                </ul>
              </div>
              <div class="menu_section">
                <h3>Lainnya</h3>
                <ul class="nav side-menu">
                    <li>
                      <a href="<?=base_url()?>login_admin/logout"> <i class="fa fa-power-off" aria-hidden="true"></i> Keluar </span></a>
                    
                  </li>
                    </ul>
                  </li>                  
                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Twitter Raudlatul Ulum">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Facebook Raudlatul Ulum">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Youtube Raudlatul Ulum">
                <i class="fa fa-youtube" aria-hidden="true"></i>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Instagram Raudlatul Ulum">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   Administrator
            
                  </a>
                  
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        