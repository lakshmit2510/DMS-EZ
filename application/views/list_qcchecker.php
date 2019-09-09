<?php $this->load->view('template/header'); ?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider"><?PHP echo $Title;?></div>
                <div class="panel-body">
                  <div class="text-right">
                    <a href="<?php echo base_url('Users/AddQc')?>" class="btn btn-space btn-success"> Add Record</a>
                  </div>
                  <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th width="30">S.No</th>
                        <th>User Name</th>
                        <th>Email Address 1</th>
                        <th>ACRA / UN</th>
                        <th>CreateOn</th>
                        <th width="140">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if($Users!=0)
                      {
                        $i = 1;
                        foreach($Users as $row)
                        {
                          $logid = array();
                          $logid[] = $row->UserName;
                          $logid[] = $row->EmailAddress1;
                          $logid[] = $row->UniqueID;
                          $loginid = array_filter($logid);
                          $login = implode(" <b>(or)</b> ", $loginid);
                          echo '<tr>
                            <td>'.$i++.'</td>
                            <td>'.$row->UserName.'</td>
                            <td>'.$row->EmailAddress1.'</td>
                            <td>'.$row->UAN.'</td>
                            <td class="center">'.date('d/m/Y h:i A',strtotime($row->CreatedOn)).'</td> 
                            <td class="center">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view'.$row->UserUID.'" class="btn btn-space btn-info"><i class="icon icon-left mdi mdi-eye"></i> View</a>
                            <a href="'.base_url('Users/editQc/'.$row->UserUID).'" class="btn btn-space btn-warning"><i class="icon icon-left mdi mdi-edit"></i> Edit</a>
                          </td>
                          </tr>
                          <div id="view'.$row->UserUID.'" tabindex="-1" role="dialog" class="modal colored-header colored-header-primary fade">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                                <h3 class="modal-title"><span class="mdi mdi-assignment-account"></span> User Information details</h3>
                              </div>
                              <div class="modal-body">
                                <div class="col-md-12">  
                                 <div class="col-md-4">
                                   <h4><span class="mdi mdi-account"></span> &nbsp; Name </h4>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->UserName.'</h5>
                                 </div>
                                </div>
                                <div class="col-md-12">  
                                 <div class="col-md-4">
                                   <h4><span class="mdi mdi-email"></span> &nbsp; Email 1</h4>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->EmailAddress1.'</h5>
                                 </div>
                                </div>
                                <div class="col-md-12">  
                                 <div class="col-md-4">
                                   <h4><span class="mdi mdi-email"></span> &nbsp; Email 2</h4>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->EmailAddress2.'</h5>
                                 </div>
                                </div>
                                <div class="col-md-12">  
                                 <div class="col-md-4">
                                   <h4><span class="mdi mdi-phone"></span> &nbsp; Phone </h4>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->PhoneNumber.'</h5>
                                 </div>
                                </div>
                                <div class="col-md-12">  
                                 <div class="col-md-4">
                                   <h4><span class="mdi mdi-pin-account"></span> &nbsp; Login-ID </h4>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$login.'</h5>
                                 </div>
                                </div>
                                <div class="col-md-12">  
                                 <div class="col-md-4">
                                   <h4><span class="mdi mdi-key"></span> &nbsp; Password </h4>
                                 </div>
                                 <div class="col-md-8">
                                   <h5>'.$row->Password.'</h5>
                                 </div>
                                </div>
                                <div class="col-md-12">  
                                 <div class="col-md-4">
                                   <h4><span class="mdi mdi-calendar"></span> &nbsp; Created </h4>
                                 </div>
                                 <div class="col-md-5">
                                   <h5>'.date('d/m/Y h:i:s A',strtotime($row->CreatedOn)).'</h5>
                                 </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Close</button> 
                              </div>
                            </div>
                          </div>
                        </div>';
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