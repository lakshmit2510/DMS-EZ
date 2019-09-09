<?php $this->load->view('template/header'); ?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider"><?PHP echo $Title;?></div>
                <div class="panel-body">
                  <?php if($this->session->flashdata('done')) { ?>
                  <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                    <div class="icon"><span class="mdi mdi-check"></span></div>
                    <div class="message">
                      <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> <?php echo $this->session->flashdata('done'); ?>.
                    </div>
                  </div>
                  <?php } ?>
                  <div class="text-right">
                    <a href="<?php echo base_url('Vehicles/add')?>" class="btn btn-space btn-success"> Add Vehicle</a>
                  </div>
                  <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>Vehicle No</th>
                        <th>Vehicle Type</th>
                        <th>Driver Name</th>
                        <th>Driver No</th>
                        <th>Drivers NRIC/FIN</th>
                        <th>CreateOn</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if($vehicles!=0)
                      {
                        $i=1;
                        foreach($vehicles as $row)
                        {
                          echo '<tr>
                            <td>'.$row->VehicleNo.'</td>
                            <td>'.$row->Type.'</td>
                            <td>'.$row->DriverName.'</td>
                            <td>'.$row->DriverNumber.'</td>
                            <td>'.$row->DriverNRIC.'</td>
                            <td class="center">'.date('d/m/Y h:i A',strtotime($row->CreatedOn)).'</td>'; ?>
                            <td><a href="<?php echo base_url('Vehicles/')?>edit/<?php echo $row->ID?>" class="btn btn-space btn-warning">Edit</a>
                            <a href="<?php echo base_url('Vehicles/')?>delete/<?php echo $row->ID?>" onclick="return confirm('Are you sure to delete')" class="btn btn-space btn-danger">Delete</a></td>
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
          dom:"Bfrtip"
        });

        $('.buttons-html5').addClass('btn btn-default');
      });
    </script>