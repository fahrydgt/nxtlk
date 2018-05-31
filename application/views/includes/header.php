<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<!DOCTYPE html>
<html lang="en">
    
<head>
  <!--<meta charset="utf-8">-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo SYSTEM_NAME; ?></title>

<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(SAMPLE_PIC.'favicon.ico');?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('templates/bootstrap/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/font-awesome/css/font-awesome.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/ionicons/css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('templates/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('templates/dist/css/skins/_all-skins.min.css');?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/morris/morris.css');?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/jvectormap/jquery-jvectormap-1.2.2.css');?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/datepicker/datepicker3.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/datetimepicker/bootstrap-datetimepicker.min.css');?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/daterangepicker/daterangepicker.css');?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
  <!-- bootstrap Select 2 - text editor -->
  <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url('templates/plugins/select2/select2.min.css'); ?>"/>
  <!--Data Table-->
  <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url('templates/plugins/datatables/dataTables.bootstrap.css'); ?>"/>
  <!--File  upload-->
  <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url('templates/plugins/file-upload/fileinput.css'); ?>"/>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/online/css/font_1.css');?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">

  
<!-- jQuery 3.1.1 -->
<script src="<?php echo base_url('templates/plugins/jQuery/jquery-3.1.1.min.js');?>"></script>
<!--<script src="<?php // echo base_url('templates/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>-->
<!-- Drag Table-->
<script src="<?php echo base_url('templates/plugins/table_row_drag/tbl_row_drager.js')?>"></script>
    
<!--file uploader-->
<link href="<?php echo base_url('templates/plugins/file_upload2/jquery.fileuploader.css')?>" media="all" rel="stylesheet">
<link href="<?php echo base_url('templates/plugins/file_upload2/jquery.fileuploader-theme-thumbnails.css')?>" media="all" rel="stylesheet">
<!--end file uploader-->
</head>
 

<body class="hold-transition fixed skin-blue sidebar-mini sidebar-mini-expand-feature sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
      <?php // echo '<pre>';      print_r($_SESSION);?>
    <!-- Logo -->
    <a href="<?php echo base_url('dashboard');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo SYSTEM_SHOTR_NAME;?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo SYSTEM_NAME;?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top ">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav"> 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(USER_PROFILE_PIC.$_SESSION[SYSTEM_CODE]['user_name'].'/'.$_SESSION[SYSTEM_CODE]['profile_pix'])?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION[SYSTEM_CODE]['user_first_name'].' '.$_SESSION[SYSTEM_CODE]['user_last_name'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  <img src="<?php echo base_url(USER_PROFILE_PIC.$_SESSION[SYSTEM_CODE]['user_name'].'/'.$_SESSION[SYSTEM_CODE]['profile_pix'])?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION[SYSTEM_CODE]['user_first_name'].' '.$_SESSION[SYSTEM_CODE]['user_last_name'].' - '.$_SESSION[SYSTEM_CODE]['user_role'];?>
                    <small>-<?php echo $_SESSION[SYSTEM_CODE]['user_name'];?>-</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a href="<?php echo base_url('logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>