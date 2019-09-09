<?php $this->load->view('template/header');
  
$detail = $userdetail;
?>
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
                  <form action="<?php echo base_url('Users/update_user');?>" class="form-horizontal" method="post">
                    <input type="hidden" name="UserUID" value="<?php echo $detail->UserUID;?>">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">User Type</label>
                      <div class="col-sm-6">
                        <select class="form-control" required="true" name="UserType">
                          <option value="Internal" <?php if($detail->UserType == 'Internal'){ echo 'selected';}?>>Internal</option>
                          <option value="External" <?php if($detail->UserType == 'External'){ echo 'selected';}?>>External</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Company</label>
                      <div class="col-sm-6">
                        <select class="form-control" required="true" name="Company">
                          <option>--- Choose Company ----</option>
                          <?php 
                          foreach ($company as $key => $value) {
                            if($value->CompanyUID == $detail->CompanyUID)
                            {
                              echo '<option value="'.$value->CompanyUID.'" selected>'.$value->CompanyName.'</option>';
                            } else {
                              echo '<option value="'.$value->CompanyUID.'">'.$value->CompanyName.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">ACRA / UN Reg. No </label>
                      <div class="col-sm-6">
                        <input type="text" required="" placeholder="ACRA / UN Reg. No " value="<?php echo $detail->UAN;?>" name="UAN" class="form-control">
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label class="col-sm-3 control-label">Full Name</label>
                      <div class="col-sm-6">
                        <input type="text" required="" placeholder="Name" name="Name" class="form-control" value="<?php echo $detail->Name;?>">
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label class="col-sm-3 control-label">User Name</label>
                      <div class="col-sm-6">
                        <input type="text" required="" placeholder="User Name" name="UserName" class="form-control" value="<?php echo $detail->UserName;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">E-Mail Address 1</label>
                      <div class="col-sm-6">
                        <input type="email" parsley-type="email" placeholder="Email address 1" name="EmailAddress1" class="form-control" required="" value="<?php echo $detail->EmailAddress1;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">E-Mail Address 2</label>
                      <div class="col-sm-6">
                        <input type="email" parsley-type="email" placeholder="Email address 2" name="EmailAddress2" class="form-control" required="" value="<?php echo $detail->EmailAddress2;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Phone Number</label>
                      <div class="col-sm-6">
                        <input data-parsley-type="number" name="PhoneNumber" maxlength="10" type="text" placeholder="number" class="form-control" required="" value="<?php echo $detail->PhoneNumber;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Supplier Name</label>
                      <div class="col-sm-6">
                        <input type="text" name="Supplier" placeholder="Enter Supplier Name" class="form-control" value="<?php echo $detail->Supplier;?>">
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label class="col-sm-3 control-label">Vehicle Number</label>
                      <div class="col-sm-6">
                        <input type="text" required="" name="VNo" placeholder="Enter Vehicle Number" class="form-control" value="<?php echo $detail->VNo;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Vehicle Type</label>
                      <div class="col-sm-6">
                        <select class="form-control" required="true" name="VType">
                          <option>--- Choose Vehicle Type ----</option>
                          <?php 
                          foreach ($vtype as $key => $value) {
                            if($detail->VType == $value->TypeID)
                            {
                              echo '<option value="'.$value->TypeID.'" selected>'.$value->Type.'</option>';
                            } else {
                              echo '<option value="'.$value->TypeID.'">'.$value->Type.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div> -->
                    <!-- <div class="form-group">
                      <label class="col-sm-3 control-label">Password</label>
                      <div class="col-sm-5">
                        <input id="pass" type="password" name="Password" required="" placeholder="Enter New Password" class="form-control"
                        value="<?php echo $detail->Password;?>">
                      </div> 
                      <div class="col-sm-2" style="margin-top: 6px;">
                        <a href="#" class="btn btn-danger" id="show"><i class="icon icon-left mdi mdi-eye"></i> Show</a>
                      </div>
                    </div> -->
                    <?php if($this->session->userdata('Role') <> 2) {?>
                    <div class="form-group">
                      <label class="col-sm-3 control-label" required="true">Role</label>
                      <div class="col-sm-6">
                        <select class="form-control" name="Role">
                          <option value="">------ Choose Role ------</option>
                          <option value="1" <?php if($detail->Role == 1) { echo 'selected';}?>>Administrator</option>
                          <option value="2" <?php if($detail->Role == 2) { echo 'selected';}?>>Supplier</option>
                          <option value="2" <?php if($detail->Role == 3) { echo 'selected';}?>>Company</option>
                          <option value="2" <?php if($detail->Role == 4) { echo 'selected';}?>>Sup-Subcontractor</option>
                        </select>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-space btn-primary">Submit</button>
                        <a href="<?php echo base_url('Users/update');?>" class="btn btn-space btn-default">Cancel</a>
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
        
        $('form').submit(function(){
          $('.be-loading').addClass('be-loading-active');
        });

        $('select').select2();

        $('#show').click(function(){
          var pass = $('#pass').attr('type');
          if(pass=='password')
          {
            $('#pass').attr('type','text');
            $(this).html('<i class="icon icon-left mdi mdi-eye-off"></i> Hide');
          } else {
            $('#pass').attr('type','password');
            $(this).html('<i class="icon icon-left mdi mdi-eye"></i> Show');
          }
          return false;
        });

      });
    </script>