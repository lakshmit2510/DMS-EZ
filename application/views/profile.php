  <?php $this->load->view('template/header'); ?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-9">
              <?php if($this->session->flashdata('type') == 'done') { ?>
                <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                  <div class="icon"><span class="mdi mdi-check"></span></div>
                  <div class="message">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>.
                  </div>
                </div>
              <?php } else if($this->session->flashdata('type') == 'error') { ?>
              <div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message">
                  <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Error!</strong> <?php echo $this->session->flashdata('msg'); ?>.
                </div>
              </div>
              <?php } ?>  
              <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
                <div class="panel-heading panel-heading-divider"><i class="icon mdi mdi-face"></i> <?php echo $Title;?></div>
                <div class="panel-body">
                  
                    <div class="form-group">
                      <label class="col-sm-3 control-label"><b>Company Name</b></label>
                      <?php echo $Profile->CompanyName; ?>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label"><b>ACRA / UN Reg.No</b></label>
                      <?php echo $Profile->UAN; ?>
                    </div>
                  
              </div>
              <div class="be-spinner">
                <svg width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                  <circle fill="none" stroke-width="5" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                </svg>
              </div>
            </div>
          </div>
    
    <?php $this->load->view('template/footer'); ?>
    <script src="<?php echo base_url();?>assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){ 
        $('form').parsley();

        $('select').select2();

        $('form').submit(function(){
          $('.be-loading').addClass('be-loading-active');
        }); 

       });
    </script>