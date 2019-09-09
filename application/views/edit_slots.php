<?php $this->load->view('template/header'); ?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
                <div class="panel-heading panel-heading-divider"><i class="icon mdi mdi-layers"></i> Edit Dock Details</div>
                <div class="panel-body">
                  <form action="<?php echo base_url('Docks/editSlotsPost');?>" class="form-horizontal" method="post">
                    <input type="hidden" name="ID" value="<?php echo $slots->SlotID;?>">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Building Name</label>
                      <div class="col-sm-6">
                        <select name="BuildingName" class="form-control">
                          <option value="">--- Choose Building ---</option>
                          <option value="ICC1 - Admin" <?php if($slots->DBuildingName == 'ICC1 - Admin'){ echo 'selected';}?>>ICC1 - Admin</option>
                          <option value="ICC1 - Production" <?php if($slots->DBuildingName == 'ICC1 - Production'){ echo 'selected';}?>>ICC1 - Production</option>
                          <option value="ICC2 - APS" <?php if($slots->DBuildingName == 'ICC2 - APS'){ echo 'selected';}?>>ICC2 - APS</option>
                          <option value="ICC2 - SATS CATERING" <?php if($slots->DBuildingName == 'ICC2 - SATS CATERING'){ echo 'selected';}?>>ICC2 - SATS CATERING</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Dock No</label>
                      <div class="col-sm-6">
                        <input type="text" required="" value="<?php echo $slots->SlotName; ?>" placeholder="Dock No" name="SlotName" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Price ($)</label>
                      <div class="col-sm-6">
                        <input type="text" placeholder="Enter Price" value="<?php echo $slots->Price;?>" name="Price" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Mode</label>
                      <div class="col-sm-6">
                        <select class="form-control" required="" name="Mode">
                          <option value="">--- Choose Mode ----</option>
                          <?php 
                          $doctype = $this->Common_model->getTableData('bookingmode','Active');
                          foreach ($doctype as $key => $value) 
                          {
                            if($slots->DMode == $value->ModeID)
                            {
                              echo '<option value="'.$value->ModeID.'" selected>'.$value->Mode.'</option>';  
                            } else {
                              echo '<option value="'.$value->ModeID.'">'.$value->Mode.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Dock Type</label>
                      <div class="col-sm-6">
                        <select class="form-control" required="true" name="SlotType" id="SlotType">
                          <option value="">--- Choose Dock Type ----</option>
                          <?php 
                          foreach ($slottype as $key => $value) {
                            if($slots->Type == $value->STypeID)
                            {
                              echo '<option value="'.$value->STypeID.'" selected>'.$value->Type.'</option>';
                            } else {
                              echo '<option value="'.$value->STypeID.'">'.$value->Type.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-space btn-primary">Submit</button>
                        <a href="<?php echo base_url('Docks');?>" class="btn btn-space btn-default">Cancel</a>
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