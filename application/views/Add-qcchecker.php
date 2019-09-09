<?php $this->load->view('template/header'); ?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
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
                <div class="panel-heading panel-heading-divider"><i class="icon mdi mdi-account"></i> <?php echo $Title;?></div>
                <div class="panel-body">
                  <form action="<?php echo base_url('Users/save_security');?>" class="form-horizontal" method="post">
                    <input type="hidden" name="UserType" value="Internal">
                    <input type="hidden" name="Role" value="6">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Company</label>
                      <div class="col-sm-6">
                        <select class="form-control" required="true" name="Company">
                          <option value="">--- Choose Company ----</option>
                          <?php 
                          foreach ($company as $key => $value) {
                            echo '<option value="'.$value->CompanyUID.'">'.$value->CompanyName.'</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">ACRA / UN Reg. No </label>
                      <div class="col-sm-6">
                        <input type="text" required="" placeholder="ACRA / UN Reg. No" name="UAN" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">QC Checker Name</label>
                      <div class="col-sm-6">
                        <input type="text" required="" placeholder="QC Checker Name" name="UserName" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">E-Mail Address 1</label>
                      <div class="col-sm-6">
                        <input type="email" parsley-type="email" placeholder="E-mail address 1" name="EmailAddress1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">E-Mail Address 2</label>
                      <div class="col-sm-6">
                        <input type="email" parsley-type="email" placeholder="E-mail address 2" name="EmailAddress2" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Phone Number</label>
                      <div class="col-sm-6">
                        <input data-parsley-type="number" name="PhoneNumber" maxlength="15" type="text" placeholder="Phone Number" class="form-control">
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label class="col-sm-3 control-label">QC Checker Name</label>
                      <div class="col-sm-6">
                        <input type="text" name="Security" placeholder="QC Checker Name" class="form-control">
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Password</label>
                      <div class="col-sm-3">
                        <input id="pass2" type="password" name="Password" required="" placeholder="New Password" class="form-control">
                      </div>
                      <div class="col-sm-3">
                        <input type="password" name="Password" required="" data-parsley-equalto="#pass2" placeholder="Re-Type Password" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-space btn-primary">Submit</button>
                        <a href="<?php echo base_url('Users/QC');?>" class="btn btn-space btn-default">Cancel</a>
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