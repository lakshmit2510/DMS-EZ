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
                  <div class="text-right">
                    <a href="<?php echo base_url('Docks/add')?>" class="btn btn-space btn-success"> Add Docks</a>
                  </div>
                  <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr> 
                        <th>Dock Number</th>
                        <th>Building Name</th>
                        <th>Mode</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach($slotss as $slots) { ?>
                      <tr>
                        <td> <a href="<?php echo base_url('Docks/')?>editSlots/<?php echo $slots->SlotID?>" > <?php echo $slots->SlotName ?> </a> </td>
                        <td><?php echo $slots->DBuildingName;?></td>
                        <td><?php echo $slots->Mode;?></td>
                        <td><?php echo $slots->DockType;?></td>
                        <td><?php echo '$ '.$slots->Price;?></td>
                        <td><?php if($slots->Active == 1) { 
                          echo "<span class='text-success'>Open</span>"; 
                          $btn = '<i class="icon icon-left mdi mdi-close"></i> Close';
                          $btncls = 'btn-danger';
                        } else { 
                          echo "<span class='text-danger'>Close</span>"; 
                          $btn = '<i class="icon icon-left mdi mdi-check"></i> Open';
                          $btncls = 'btn-success';
                        } ?></td>
                        <td>
                          <a href="<?php echo base_url('Docks/')?>editSlots/<?php echo $slots->SlotID?>" class="btn btn-warning"><i class="icon icon-left mdi mdi-edit"></i> Edit</a>
                          <!-- <a href="<?php echo base_url('Docks/')?>deleteSlots/<?php echo $slots->SlotID?>" class="btn btn-danger" onclick="return confirm('are you sure to delete')"><i class="icon icon-left mdi mdi-delete"></i> Close</a> -->
                          <a href="<?php echo base_url('Slots/')?>changeStatus/<?php echo $slots->SlotID?>" class="btn <?php echo $btncls;?>"><?php echo $btn;?></a>
                        </td>
                      </tr>
                      <?php $i++; } ?>
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