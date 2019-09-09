<?php $this->load->view('template/header'); ?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider"><?php echo $Title;?></div>
                <div class="panel-body">
                  <?php if($this->session->flashdata('done')) { ?>
                  <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                    <div class="icon"><span class="mdi mdi-check"></span></div>
                    <div class="message">
                      <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> <?php echo $this->session->flashdata('done'); ?>.
                    </div>
                  </div>
                  <?php } ?>

                  <?php if($this->session->flashdata('error')) { ?>
                  <div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
                    <div class="icon"><span class="mdi mdi-close"></span></div>
                    <div class="message">
                      <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>.
                    </div>
                  </div>
                  <?php } ?>

                  <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th width="90"># Job Order No</th>
                        <th>Supplier Name</th> 
                        <th>Driver Name</th> 
                        <th>Vehicle Number</th>
                        <th>Building Name</th> 
                        <th>Dock Number</th>
                        <th>Booked On</th>
                        <th>Check-In Time</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if($booking!=0)
                      {
                        foreach($booking as $row)
                        {
                          echo '<tr>
                            <td>'.$row->BookingRefNo.'</td>
                            <td>'.$row->UserName.'</td>
                            <td>'.$row->DriverName.'</td> 
                            <td>'.$row->VehicleNo.'</td>
                            <td>'.$row->BuildingName.'</td>
                            <td>'.$row->SlotName.'</td>
                            <td class="center">'.date('m/d/Y',strtotime($row->BookedOn)).'</td>
                            <td class="center">'.date('m/d/Y h:i A',strtotime($row->CheckIn)).'</td> 
                            <td><span class="label label-warning" style="background-color: '.$row->StatusColor.'">'.$row->StatusName.'</span></td>'; ?>
                            <td class="center">
                              <a href="<?php echo base_url('Booking/QCApprove/'.$row->BookingID)?>" class="btn btn-space btn-success"><i class="icon icon-left mdi mdi-check"></i> Approve</a>
                              <a href="<?php echo base_url('Booking/QCReject/'.$row->BookingID)?>" class="btn btn-space btn-danger"><i class="icon icon-left mdi mdi-close"></i> Reject</a>
                           </td>
                          </tr>
                        <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    <?php $this->load->view('template/footer'); ?>
    <script src="<?php echo base_url();?>assets/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/datatable.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function(){

        $("#table3").dataTable({
          buttons:["copy", 
          {
            extend: 'excel',
            className: 'btn btn-default',
            exportOptions: {
              columns: ['th:not(:last-child)']
            }
          },"pdf"],
          lengthMenu:[[10,25,50,-1],[6,10,25,50,"All"]],
          dom:"Bfrtip",
          "order": [], //Initial no order.
          "bSorting": [],
          "pageLength": 20
        });
        $('.buttons-html5').addClass('btn btn-default');
      });
    </script>