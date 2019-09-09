<?php 
$bookingct = $this->Common_model->getMax('booking') - 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo-fav.png">
    <title><?php echo $Title; ?> | Dock Management System</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/datatables/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/select2/css/select2.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" type="text/css"/>
    <style type="text/css">
      .parsley-errors-list.filled {
        padding: 3px 20px !important;
      }
      .modal-container, .modal-overlay {
        background: rgba(0,0,0,0.7);
      }
      body {
        background-color: #3C5A99;
      }
      .be-top-header .navbar-header .navbar-brand
      {
        background-size: 70%;
        font-size: 21px;
        height: 70px; 
      }
      .be-top-header .navbar-header {
        width: 90px;
      }
      .be-content {
        margin-left: 25px;
      }
      .c_active a {
        color: #4285f4 !important;
      }
      .form-horizontal .form-group {
        padding: 3px 0;
      }
      .be-top-header .navbar-nav>li>a {
        color: #b5121b;
        font-weight: 500;
        font-size: 17px;
        padding: 0px 14px;
      }
      .be-top-header .navbar-nav>li.dropdown .dropdown-menu>li>a {
        font-size: 16px;
      }
    </style>
  </head>
  <body>
    <div class="be-wrapper be-fixed-sidebar">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
          <div class="navbar-header"><a href="<?php echo base_url();?>" class="navbar-brand"><span style="color: #fff; opacity: 0;">Booking System</span></a>
          </div>
          <div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-user-nav">
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="<?php echo base_url();?>assets/img/avatar.png" alt="Avatar"><span class="user-name"><?php echo ucfirst($this->session->userdata('UserName'));?></span></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div class="user-info">
                      <div class="user-name">Welcome <?php echo ucfirst($this->session->userdata('UserName'));?></div>
                    </div>
                  </li>
                  <li><a href="<?php echo base_url('Dashboard/Profile');?>"><span class="icon mdi mdi-face"></span> My Profile</a></li>
                  <li><a href="<?php echo base_url('Users/Changepassword');?>"><span class="icon mdi mdi-key"></span> Change Password</a></li>
                  <li><a href="<?php echo base_url('Login/logout');?>"><span class="icon mdi mdi-power"></span> Logout</a></li>
                </ul>
              </li>
            </ul>
            <div class="page-title"><span>Dock Management System<?php // echo $Title; ?></span></div>
          </div>
          <div id="be-navbar-collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li <?php if($Title=='Dashboard') { echo 'class="c_active"';} ?>>
                <a href="<?php echo base_url('Dashboard');?>"><i class="icon mdi mdi-home"></i> <span>Home</span></a>
              </li>
              <?php if(in_array($this->session->userdata('Role'), array(1,2,3,4))){  ?>
              <li <?php if($Title=='Add New Booking') { echo 'class="c_active"';} ?>><a href="<?php echo base_url('Booking/Add');?>"><i class="icon mdi mdi-car"></i>  <span>Dock Booking</span></a></li>
              <?php } ?>
              <?php if($this->session->userdata('Role') == 5) { ?>
              <li><a href="<?php echo base_url('Booking/Security');?>"><i class="icon mdi mdi-shield-security"></i> Security Checking</a></li>
              <?php } if($this->session->userdata('Role') == 6) { ?>
              <li><a href="<?php echo base_url('Booking/QcCheck');?>"><i class="icon mdi mdi-shield-check"></i> QC Checking</a></li>
              <?php } if(in_array($this->session->userdata('Role'), array(1,2,3,4))){  ?>
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><i class="icon mdi mdi-account"></i> Dashboard <span class="mdi mdi-caret-down"></span></a>
                <ul role="menu" class="dropdown-menu">
                  <?php if(!in_array($this->session->userdata('Role'), array(5,6))) { ?>
                  <li><a href="<?php echo base_url('Vehicles');?>">My Vehicle List</a></li>
                  <?php } ?>
                  <?php if(in_array($this->session->userdata('Role'),array(1,3))) { ?>
                  <li><a href="<?php echo base_url('Supplier');?>">My Supplier List</a></li>
                  <?php } else if($this->session->userdata('Role') == 2){ ?>
                  <li><a href="<?php echo base_url('Subcontractor');?>">My Subcontractors List</a></li>
                  <?php } ?>
                  <li><a href="<?php echo base_url('Booking/Past');?>">Past Shipment</a></li>
                  <li><a href="<?php echo base_url('Booking/Today');?>">Today's Shipment</a></li>
                  <li><a href="<?php echo base_url('Booking/Upcoming');?>">Upcoming Shipment</a></li>
                </ul>
              </li>
              <?php } if(in_array($this->session->userdata('Role'),array(1,3))) { ?>
              <li><a href="<?php echo base_url('Booking/Realtime');?>"><i class="icon mdi mdi-time"></i>  <span>Real-Time Job Status</span></a></li>
              <?php }  if(in_array($this->session->userdata('Role'),array(5,6))) { ?>
              <li <?php if($Page=='Upcoming') { echo 'class="c_active"';} ?>><a href="<?php echo base_url('Booking/Upcoming');?>"><i class="icon mdi mdi-local-shipping"></i>  <span>Upcoming Shipment</span></a></li>
              <?php } if(!in_array($this->session->userdata('Role'),array(5,6))) { ?>
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><i class="icon mdi mdi-account"></i> Admin <span class="mdi mdi-caret-down"></span></a>
                <ul role="menu" class="dropdown-menu">
                  <?php if(in_array($this->session->userdata('Role'),array(1,3))) { ?>
                  <li><a href="<?php echo base_url('Company');?>">Update Company Details</a></li>
                  <li><a href="<?php echo base_url('Docks');?>">Update Dock Details</a></li>
                  <li><a href="<?php echo base_url('Users/update');?>">Update Suppliers Details</a></li>
                  <li><a href="<?php echo base_url('Users/Security');?>">Update Security Details</a></li>
                  <li><a href="<?php echo base_url('Users/QC');?>">Update QC Details</a></li>
                  <li><a href="<?php echo base_url('Users/Approval');?>">Approvals Pending</a></li>
                  <?php } ?>
                  <?php if($this->session->userdata('Role') == 2) { ?>
                  <li><a href="<?php echo base_url('Users/update');?>">Update Subcontractors Details</a></li> 
                  <?php } ?>
                  <li><a href="<?php echo base_url('Vehicles/update');?>">Update Vehicle Details</a></li>
                </ul>
              </li>
              <?php } if(in_array($this->session->userdata('Role'),array(5,6))){ ?>
                  <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><i class="icon mdi mdi-account"></i> Admin <span class="mdi mdi-caret-down"></span></a>
                      <ul role="menu" class="dropdown-menu">
                          <li><a href="<?php echo base_url('Users/Security');?>">Update Security Details</a></li>
                      </ul>
                  </li>
              <?php } if(in_array($this->session->userdata('Role'),array(1,3))) { ?>
              <li <?php if($Page=='Reports') { echo 'class="c_active"';} ?>><a href="<?php echo base_url('Reports');?>"><i class="icon mdi mdi-widgets"></i>  <span>Statistics & Reports</span></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>