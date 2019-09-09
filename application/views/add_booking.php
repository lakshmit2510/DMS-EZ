<?php $this->load->view('template/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/jquery.gritter/css/jquery.gritter.css"/>
<style type="text/css">
.dockslot{
  background-color: #0b53ca;
  display: inline-block;
  width: 10%;
  color: #fff;
  text-align: center;
  height: 60px;
  margin: 0 5px;
  border-radius: 8px;
  padding: 13px;
  cursor: pointer;
  border: 1px dashed #b5b5b5;
}
#dockslots-div input[type=checkbox]{
  display: none;
}
#dockslots-div input[type=checkbox]:checked + .dockslot{
  background-color: #11ca11;
  color: #fff;
  border: 1px dashed #333;
}
#dockslots-div input[type=checkbox]:disabled + .dockslot{
  background-color: #e60606;
  color: #fff;
  border: 1px dashed #333;
}
#dockslots-div input[type=checkbox]{
  display: none;
}
#dockslots-div input[type=checkbox]:checked + .dockslot_1{
  background-color: #11ca11;
  color: #fff;
  border: 1px dashed #333;
}
#dockslots-div input[type=checkbox]:disabled + .dockslot_1{
  background-color: #e60606 !important;
  color: #fff;
  border: 1px dashed #333;
}
#dockslots-div input[type=checkbox]{
  display: none;
}
#dockslots-div input[type=checkbox]:checked + .dockslot_2{
  background-color: #11ca11;
  color: #fff;
  border: 1px dashed #333;
}
#dockslots-div input[type=checkbox]:disabled + .dockslot_1{
  background-color: #e60606 !important;
  color: #fff;
  border: 1px dashed #333;
}
.border-dotted { 
  border: 2px dotted #ccc;
  padding: 20px 25px;
}  
h3.docleg > span::before{
  content: '';
  width: 20px;
  height: 20px;
  display: inline-block;
  background: #444;
}
.select2-container {
  width: 100% !important;
}
#AvailableDocks { position: relative; }
.docklegend {
  display: inline-block;
  width: 35%;
  position: absolute;
  right: 0;
  top: 0;
}
.docklegend > span {
  width: 115px;
  display: block;
  float: left;
  font-size: 15px;
}
.docklegend > span::before {
 content: '';
 width: 26px;
 display: block;
 height: 13px;
 float: left;
 margin: 4px 5px;
 padding: 0px;
}
.docklegend > span.free::before {
  background: #0b53ca;
}
.docklegend > span.booked::before {
  background: #e60606;
}
.docklegend > span.select::before {
  background: #11ca11;
}
</style>
<div class="be-content">
        <div class="main-content container-fluid">

          <div class="row wizard-row">
            <div class="col-md-12 fuelux">
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
              <div class="block-wizard panel panel-default panel-border-color panel-border-color-primary be-loading">
                <div id="wizard1" class="wizard wizard-ux no-steps-container">
                  <ul class="steps" style="margin-left: 0">
                    <li data-step="1" class="active">Booking Info<span class="chevron"></span></li>
                    <li data-step="2">Select Time & Dock Information<span class="chevron"></span></li>
                    <li data-step="3">Docks Selection<span class="chevron"></span></li>
                  </ul>
                  <form action="<?php echo base_url('Booking/save');?>" class="form-horizontal" method="post">
                  <div class="step-content">
                    <input type="hidden" name="VType" id="pVType">
                    <div data-step="1" class="step-pane active">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">P.o Number</label>
                        <div class="col-sm-6">
                          <input type="text" name="PONumber" placeholder="P.o Number" class="form-control">
                        </div> 
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">D.o Number <span style="color: #ff0000">*</span></label>
                        <div class="col-sm-6">
                          <input type="text" name="DONumber" data-parsley-trigger="keyup" required="true" placeholder="D.o Number" class="form-control required">
                        </div> 
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Airway Bill No</label>
                        <div class="col-sm-6">
                          <input type="text" name="BillNo" placeholder="Airway Bill No" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">B/L No</label>
                        <div class="col-sm-6">
                          <input type="text" name="BLNo" placeholder="B/L No" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Company (Delivery To) <span style="color: #ff0000">*</span></label>
                        <div class="col-sm-6">  
                          <select class="form-control required" required="true" name="DeliveryTo">
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
                          <label class="col-sm-3 control-label">Building Name <span style="color: #ff0000">*</span></label>
                          <div class="col-sm-6">
                            <select name="BuildingName" data-parsley-trigger="keyup" required="true" id="BuildingName" class="form-control dockselect required">
                              <option value="">--- Choose Building ---</option>
                              <option value="ICC1 - Admin">Inflight Catering  Centre 1 (ICC1) - Admin</option>
                              <option value="ICC1 - Production">Inflight Catering  Centre 2 (ICC2) - Production</option>
                              <option value="ICC2 - APS">Inflight Catering  Centre 2 (ICC2) - APS</option>
                              <option value="ICC2 - SATS CATERING">Inflight Catering  Centre 2 (ICC2) - SATS CATERING</option>
                            </select>
                          </div>
                        </div>
                      <!-- <div class="form-group">
                       <label class="col-sm-3 control-label">Operations</label>
                       <div class="col-sm-6">
                        <select class="form-control" required="true" name="Area">
                          <option value="">--- Choose Operations ----</option>
                          <?php 
                          foreach ($area as $key => $value) {
                            echo '<option value="'.$value->AreaID.'">'.$value->Area.'</option>';
                          }
                          ?>
                        </select>
                       </div>
                     </div> -->
                     <div class="form-group">
                      <label class="col-sm-3 control-label">Vehicle Number <span style="color: #ff0000">*</span></label>
                      <div class="col-sm-6">
                        <select class="form-control required" data-parsley-trigger="keyup" required="true" id="VNumber" name="VNumber">
                          <option value="">--- Choose Vehicle Number ----</option>
                          <?php 
                          foreach ($vnumber as $key => $value) {
                            echo '<option value="'.$value->ID.'">'.$value->VehicleNo.'</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Vehicle Type</label>
                      <div class="col-sm-6">
                        <input type="text" id="VType" class="form-control" readonly="true">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Driver Name <span style="color: #ff0000">*</span></label>
                      <div class="col-sm-6">
                        <select class="form-control required" required="true" id="Driver" name="Driver">
                          <option value="">--- Choose Driver ----</option>
                          <?php 
                          foreach ($vnumber as $key => $value) {
                            echo '<option value="'.$value->ID.'">'.$value->DriverName.'</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Driver NRIC/FIN</label>
                      <div class="col-sm-6">
                        <input type="text" name="NRIC" id="NRIC" readonly="true" class="form-control">
                      </div>
                    </div>
                    <?php if($this->session->userdata('Role') == 1) { ?>
                    <input type="hidden" value="Internal" name="UserType">
                    <!-- <div class="form-group">
                      <label class="col-sm-3 control-label">User Type</label>
                      <div class="col-sm-6">
                        <select class="form-control" required="true" name="UserType">
                          <option value="Internal">Internal</option>
                          <option value="External">External</option>
                        </select>
                      </div>
                    </div> -->
                    <?php } else { echo '<input type="hidden" name="UserType" value="'.$this->session->userdata('UserType').'">'; }?>
                    <div class="form-group">
                      <div class="col-sm-offset-5 col-sm-10" style="padding: 15px 0;">
                        <a href="<?php echo base_url('Booking');?>" class="btn btn-space btn-default">Cancel</a>
                        <button data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Next Step</button>
                      </div>
                    </div>
                    </div>
                    <div data-step="2" class="step-pane">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Chech-In & Check-Out Time <span style="color: #ff0000">*</span></label>
                          <div class="col-sm-3">
                            <div data-start-view="2" data-date-format="yyyy-mm-dd hh:ii" class="input-group date checkintime">
                              <input size="16" readonly="true" required="true" data-parsley-trigger="keyup" type="text" id="CheckIn" name="CheckInDate" placeholder="Check-In Time" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                             <input readonly="true" type="text" id="CheckOut" name="CheckOutDate" placeholder="Check-Out Time" class="form-control">
                          </div>
                        </div>
                        <!-- <div class="form-group">
                          <label class="col-sm-3 control-label">Building Address</label>
                          <div class="col-sm-6">
                            <textarea class="form-control" rows="3" name="Address" placeholder="Address here..."></textarea>
                          </div>
                        </div> -->
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Booking Mode</label>
                          <div class="col-sm-6">
                            <select class="form-control dockselect" name="Mode" id="Mode">
                             <option value="">--- Choose Mode ----</option>
                             <?php 
                             foreach ($mode as $key => $value) {
                              echo '<option value="'.$value->ModeID.'">'.$value->Mode.'</option>';
                            }
                            ?>
                          </select>   
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Docks Type <span style="color: #ff0000">*</span></label>
                        <div class="col-sm-3">
                          <select class="form-control" required="true" data-parsley-trigger="keyup" name="SlotType" id="SlotType">
                            <option value="">--- Choose Docks Type ----</option>
                            <?php 
                            foreach ($slottype as $key => $value) 
                            {
                              if(!in_array($this->session->userdata('Role'), array(1,3))) {                                   
                                if($value->Type == 'Parking') { continue; }
                              }
                              echo '<option value="'.$value->STypeID.'">'.$value->Type.'</option>';
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-sm-3">
                          <input type="hidden" id="SlotNos" name="SlotNos" value="1">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-10" style="padding: 15px 0;">
                          <button data-wizard="#wizard1" class="btn btn-default btn-space wizard-previous">Previous</button>
                          <button data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Next Step</button>
                        </div>
                      </div>
                    </div>
                    <div data-step="3" class="step-pane">
                        <div class="col-sm-12">
                          <div class="form-group" id="AvailableDocks"></div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-5 col-sm-10" style="padding: 15px 0;">
                            <button data-wizard="#wizard1" class="btn btn-default btn-space wizard-previous">Previous</button>
                            <button type="submit" class="btn btn-success btn-space">Proceed to Book</button>
                          </div>
                        </div>
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
           </div>

    
    <?php $this->load->view('template/footer'); ?>
    <script src="<?php echo base_url();?>assets/lib/fuelux/js/wizard.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/bootstrap-slider/js/bootstrap-slider.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/jquery.gritter/js/jquery.gritter.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){ 
        $('form').parsley();

        $(".wizard-ux").wizard(), $(".wizard-ux").on("changed.fu.wizard", function() {
          $(".bslider").slider()
        }), $(".wizard-next").click(function(e) {
          $('form').parsley().validate();
          var t = $(this).data("wizard");
          $fill = 0;
          $('.required').each(function() 
          {
            if(!$(this).val())
            {
              $fill = 0;
              return false;
            } else {
              $fill = 1;
            }
          });
          
          if($fill==1)
          {
            $(t).wizard("next");
          }

          e.preventDefault();
        }), $(".wizard-previous").click(function(e) {
          var t = $(this).data("wizard");
          $(t).wizard("previous"), e.preventDefault()
        });

        // $('select').select2();
        
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $(".checkintime").datetimepicker({
          startDate: new Date(),
          minTime: 0,
          autoclose:!0,
          pickSeconds: false,
          componentIcon:".mdi.mdi-calendar",
          navIcons:{
            rightIcon:"mdi mdi-chevron-right",
            leftIcon:"mdi mdi-chevron-left"
          }
        }).on('change',function(event, date) {
          checkin = event.delegateTarget.childNodes[1].value;
          timestamp = new Date(checkin);
          var chkdate = moment(timestamp).format("YYYY-MM-DD HH:mm");

          chkdate = new Date(chkdate);
          chkdate.setHours(chkdate.getHours()+1);
          checkout = moment(chkdate).format("YYYY-MM-DD HH:mm");
          $('#CheckOut').val(checkout);
          $('#SlotType').trigger('change');
        });

       Date.prototype.addHours = function(h){
         this.setHours(this.getHours()+h);
         return this;
       }  

      $('#SlotType').change(function()
      {
         CheckIn = $('#CheckIn').val();
         
         datas = new FormData();
         datas.append('SlotType', $('#SlotType').val());
         datas.append('Mode', $('#Mode').val());
         datas.append('BuildingName', $('#BuildingName').val());
         datas.append('CheckIn', CheckIn);
         
         $.ajax({
          type: 'POST',
          url: 'getAvailableDocks',
          data: datas,
          contentType: false,
          processData: false,
          beforeSend: function() {
           $('.be-loading').addClass('be-loading-active');
         },
         success: function(data)
         {
           $('#AvailableDocks').empty(); 
           $('.be-loading').removeClass('be-loading-active'); 
           $('#AvailableDocks').html(data); 
         }
       });
      }); 

      $('#VNumber').change(function()
      {
         datas = new FormData();
         datas.append('VNumber', $(this).val());
         $.ajax({
          type: 'POST',
          url: 'getVehicleInfo',
          data: datas,
          dataType: 'JSON',
          contentType: false,
          processData: false,
          beforeSend: function() {
           $('.be-loading').addClass('be-loading-active');
         },
         success: function(data)
         {
           $('.be-loading').removeClass('be-loading-active'); 
           $('#pVType').empty();
           $('#VType').empty();
           $('#pVType').val(data.VehicleTypeID);
           $('#VType').val(data.Type);
         }
       });
      });

      $('#Driver').change(function()
      {
         datas = new FormData();
         datas.append('Driver', $(this).val());
         $.ajax({
          type: 'POST',
          url: 'getDriverInfo',
          data: datas,
          dataType: 'JSON',
          contentType: false,
          processData: false,
          beforeSend: function() {
           $('.be-loading').addClass('be-loading-active');
         },
         success: function(data)
         {
           $('.be-loading').removeClass('be-loading-active'); 
           $('#NRIC').empty();
           $('#NRIC').val(data.DriverNRIC);
         }
       });
      }); 

      $(document).on('click','.freeslots', function(){
        var limit = 1; //$('#SlotNos').val();
        if(limit=='')
        {
          $.gritter.add({
            title:'Please choose Number of docs',
            time: 1000,
            class_name:"color danger"
          });
          return false;
        }

        if(limit==1)
        {
          $('.freeslots').not(this).prop('checked', false);
          return true;
        }

        if($(this).siblings(':checked').length >= limit) 
        {
          this.checked = false;
          $.gritter.add({
            title:'You have select Only : '+limit+' docks',
            time: 1000,
            class_name:"color danger"
          });
        }
      });
      

      $('form').submit(function(){
          $('.be-loading').addClass('be-loading-active');
      }); 

    });
    </script>