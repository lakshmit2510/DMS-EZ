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
                  <div class="text-right">
                    <a href="<?php echo base_url('Company/add');?>" class="btn btn-space btn-success"> Add Company</a>
                  </div>
                  <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Company Name</th>
                        <th>Building Name</th>
                        <th>Building Address</th>
                        <th width="130">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($company as $c){ ?>
                    <tr>
                      <td><?php echo $c['CompanyUID']; ?></td>
                      <td><?php echo $c['CompanyName']; ?></td>
                      <td><?php echo $c['BuildingName']; ?></td>
                      <td><?php echo $c['BuildingAddress']; ?></td>
                      <td class="center">
                        <a href="<?php echo base_url('Company/edit/'.$c['CompanyUID'])?>" class="btn btn-space btn-warning"><i class="icon icon-left mdi mdi-edit"></i> Edit</a>
                        <!-- <a href="<?php echo base_url('Company/remove/'.$c['CompanyUID'])?>" class="btn btn-space btn-danger"><i class="icon icon-left mdi mdi-delete"></i> Delete</a> -->
                      </td>
                    </tr>
                    <?php } ?>
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
