<?php $this->load->view('template/header'); ?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading"><?PHP echo $Title;?></div>
                <div class="panel-body">
                  
                  <table id="table3" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <?php 
                        $fld = array();
                        $field = $this->Booking_model->getFields(4);
                        foreach ($field as $value) 
                        {
                          $fld[] = $value->FieldUID;
                          echo '<th>'.$value->Label.'</th>';  
                        } 
                        ?>
                        <th>Categroy</th>
                        <th>Created On</th>
                        <th width="140">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
                     $field = $this->Booking_model->getValues($fld);
                     foreach ($field as $value) 
                     {
                        echo '<tr id="'.$value->SubmitUID.'">
                         <td>'.$value->FieldValue.'</td>
                         <td>'.$value->CategoryUID.'</td>
                         <td></td>  
                         <td></td>
                         <td></td>
                         <td class="center">'.date('d/m/Y h:i A',strtotime($value->CreatedOn)).'</td> 
                            <td class="center">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view'.$value->SubmitUID.'" class="btn btn-space btn-success"><i class="icon icon-left mdi mdi-eye"></i> View</a>
                            <a href="'.base_url('Users/edit/'.$value->SubmitUID).'" class="btn btn-space btn-warning"><i class="icon icon-left mdi mdi-edit"></i> Edit</a>
                          </td>
                        </tr>';  
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
    <script src="<?php echo base_url();?>assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/plugins/buttons/js/buttons.html5.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/plugins/buttons/js/buttons.flash.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/plugins/buttons/js/buttons.print.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/plugins/buttons/js/buttons.colVis.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        App.dataTables();

        $('#field_sort tbody').sortable({
          axis: 'y',
          stop: function (event, ui) {
            var data = $(this).sortable('serialize',{ attribute: 'id'});
            $('span').text(data);
            /*$.ajax({
                    data: oData,
                type: 'POST',
                url: '/your/url/here'
              });*/
            }
          });
      });
    </script>