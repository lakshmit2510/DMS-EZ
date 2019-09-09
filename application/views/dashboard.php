<?php $this->load->view('template/header'); 
$Activeusr = $this->Dashboard_model->GetUserCount('Active');
$InActiveusr = $this->Dashboard_model->GetUserCount('In-Active');
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <!-- <div class="row">
      <div class="col-xs-12 col-md-4 col-lg-4">
        <div class="be-booking-promo be-booking-promo-success  be-booking-promo-big">
          <div class="be-booking-desc">
            <h4 class="be-booking-desc-title">Active Users</h4>
          </div>
          <div class="be-booking-promo-price" style="margin-right: 10px;">
            <div class="be-booking-promo-amount" style="margin: 0px;"><span class="price"><?php echo $Activeusr;?></span></div>
          </div>
          <span class="be-promo-big-title icon mdi mdi-account"></span>
        </div>
      </div>
      <div class="col-xs-12 col-md-4 col-lg-4">
        <div class="be-booking-promo be-booking-promo-warning be-booking-promo-big">
          <div class="be-booking-desc">
            <h4 class="be-booking-desc-title">In Active Users</h4>
          </div>
          <div class="be-booking-promo-price" style="margin-right: 10px;">
            <div class="be-booking-promo-amount" style="margin: 0px;"><span class="price"><?php echo $InActiveusr;?></span></div>
          </div>
          <span class="be-promo-big-title icon mdi mdi-eye-off"></span>
        </div>
      </div>
      <div class="col-xs-12 col-md-4 col-lg-4">
        <div class="be-booking-promo be-booking-promo-primary be-booking-promo-big">
          <div class="be-booking-desc">
            <h4 class="be-booking-desc-title">Total Slots</h4>
          </div>
          <div class="be-booking-promo-price" style="margin-right: 10px;">
            <div class="be-booking-promo-amount" style="margin: 0px;"><span class="price"><?php echo $Activeusr;?></span></div>
          </div>
          <span class="be-promo-big-title icon mdi mdi-email"></span>
        </div>
      </div>
      
      <div class="col-xs-12 col-md-4 col-lg-4">
        <div class="be-booking-promo be-booking-promo-primary be-booking-promo-big">
          <div class="be-booking-desc">
            <h4 class="be-booking-desc-title">Total Booking</h4>
          </div>
          <div class="be-booking-promo-price" style="margin-right: 10px;">
            <div class="be-booking-promo-amount" style="margin: 0px;"><span class="price">20</span></div>
          </div>
          <span class="be-promo-big-title icon mdi mdi-storage"></span>
        </div>
      </div>
    </div> -->

    <div class="row">
      <div class="col-md-12">
        <div class="widget be-loading">
          <div class="widget-head">
            <span class="title"><strong>Welcome to Dock Management System</strong></span>
          </div>
          <div class="row">
          <div class="col-md-12">
            <p>Dock Management System will help you to reserve your docks in advance with required selections like type of dock and priority of booking. Also this system will show you the currently availability of docks.<br>  Click here to reserve your docks. &nbsp;&nbsp; <?php if(!in_array($this->session->userdata('Role'), array(5,6))) { ?><a href="<?php echo base_url('Booking/Add');?>" class="btn btn-md btn-success">Start New Booking</a><?php } ?></p>
            <hr>
            <div class="row">
              <div class="col-md-6">
               <img src="<?php echo base_url('assets/img/pic1.jpg');?>" style="width: 100%; height: 315px;" class="img-responsive">
              </div>
              <div class="col-md-6">
               <img src="<?php echo base_url('assets/img/pic2.jpg');?>" style="width: 100%;" class="img-responsive">
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>


  </div>
</div>  
<?php $this->load->view('template/footer'); ?>

<script type="text/javascript">
 $(document).ready(function()
 {


 }); 
</script>
