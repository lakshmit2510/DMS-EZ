<?php $this->load->view('template/header'); ?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
                <div class="panel-heading panel-heading-divider"><i class="icon mdi mdi-layers"></i> Add New Company</div>
                <div class="panel-body">
                  <form action="<?php echo base_url('Company/add');?>" class="form-horizontal" method="post">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Company Name</label>
                      <div class="col-sm-6">
                        <input type="text" required="" placeholder="Company Name" name="CompanyName" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Building Name</label>
                      <div class="col-sm-6">
                        <select name="BuildingName" id="BuildingName" class="form-control dockselect">
                          <option value="">--- Choose Building ---</option>
                          <option value="ICC1 - Admin">ICC1 - Admin</option>
                          <option value="ICC1 - Production">ICC1 - Production</option>
                          <option value="ICC2 - APS">ICC2 - APS</option>
                          <option value="ICC2 - SATS CATERING">ICC2 - SATS CATERING</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Building Address</label>
                      <div class="col-sm-6">
                        <textarea class="form-control" name="BuildingAddress" rows="4" required="" placeholder="Building Address"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6 m-2">
                        <button type="submit" class="btn btn-space btn-primary">Submit</button>
                        <a href="<?php echo base_url('Company');?>" class="btn btn-space btn-default">Cancel</a>
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
      $(document).ready(function()
      { 
      
        $('form').parsley();
        
        $('select').select2();

        $('form').submit(function(){
          $('.be-loading').addClass('be-loading-active');
        }); 

      });
    </script>