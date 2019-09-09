<?php $this->load->view('template/header'); ?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
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
                <div class="panel-heading panel-heading-divider"><i class="icon mdi mdi-key"></i> <?php echo $Title;?></div>
                <div class="panel-body">
                  <form action="<?php echo base_url('Users/updatepassword');?>" class="form-horizontal" method="post">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Current Password </label>
                      <div class="col-sm-8">
                        <input type="password" required="" placeholder="Current Password" name="Current" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">New Password</label>
                      <div class="col-sm-8">
                        <input type="password" id="pass" required="" placeholder="New Password" name="Password" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Confirm Password</label>
                      <div class="col-sm-8">
                        <input type="password" required="" data-parsley-equalto="#pass" placeholder="Confirm Password" name="NPassword" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-space btn-primary">Submit</button>
                        <a href="<?php echo base_url();?>" class="btn btn-space btn-default">Cancel</a>
                      </div>
                    </div>
                  </form>
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