<?php $this->load->view('template/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/lib/daterangepicker/css/daterangepicker.css"/>
<div class="be-content">
  <div class="main-content container-fluid be-loading">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-body">
            <div class="col-sm-3">
              <h4>Date Filter</h4>
              <input type="text" name="daterange" id="Date" value="<?php echo date('m/d/Y', strtotime('-7 days')).' - '.date('m/d/Y')?>" readonly="true" class="form-control daterange filter">
            </div>
            <div class="col-sm-2">
              <h4>Company</h4>
              <select class="form-control filter" required="true" id="company">
                <option value="">-- Choose Company --</option>
                <?php 
                foreach ($company as $key => $value) {
                  echo '<option value="'.$value->CompanyUID.'">'.$value->CompanyName.'</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-sm-3">
              <h4>Supplier</h4>
              <select class="form-control filter" required="true" id="Supplier">
                <option value="">-- Supplier --</option>
                <?php 
                foreach ($supplier as $key => $value) 
                {
                  echo '<option value="'.$value->UserUID.'">'.$value->UserName.'</option>';
                }
                ?>
              </select>
            </div>
          <div class="col-sm-3">
             <h4>Sub Contractor</h4>
             <select class="form-control filter" required="true" id="Sub">
                <option value="">-- Sub Contractor --</option>
                <?php 
                foreach ($subcontractor as $key => $value) 
                {
                  echo '<option value="'.$value->UserUID.'">'.$value->UserName.'</option>';
                }
                ?>
              </select>
           </div>
           <div class="col-sm-1" style="margin-top: 40px;">
            <a href="" class="btn btn-space btn-primary btn-xl"><i class="icon mdi mdi-refresh"></i> Reset</a>
           </div>
         </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">
            <span class="title">Number of Bookings By Date</span>
          </div>
          <div class="panel-body">
            <canvas id="bar-chart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">
            <span class="title">Overview of Past/Upcoming and Cancelled Bookings</span>
          </div>
          <div class="panel-body">
            <canvas id="doughnut" height="220"></canvas>
          </div>
        </div>
      </div>
      <div class="be-spinner">
        <svg width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
          <circle fill="none" stroke-width="5" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
        </svg>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-body">
            <div class="col-sm-3">
              <h4> Docks Date Filter</h4>
              <input type="text" name="daterange" id="dock-date" value="<?php echo date('m/d/Y', strtotime('-7 days')).' - '.date('m/d/Y')?>" readonly="true" class="form-control daterange docktype-filter">
            </div>
            <div class="col-sm-2">
              <h4>Dock Type</h4>
              <select class="form-control docktype-filter" required="true" id="dock-type">
                <option value="">-- Choose Dock Type --</option>
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
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-body">

            <table id="dock-type-table" class="table table-striped table-hover table-fw-widget">
              <thead>
              <tr>
                <th>Date</th>
                <th>Dock Type</th>
                <th>Available Docks</th>
                <th>Booked Docks</th>
                <th>Utilization(%)</th>
              </tr>
              </thead>
              <tbody>
              </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="panel panel-default panel-border-color panel-border-color-primary">
        <div class="panel-heading panel-heading-divider">
          <span class="title">Number of Dock Bookings By Date</span>
        </div>
        <div class="panel-body">
          <canvas id="line-chart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="panel panel-default panel-border-color panel-border-color-primary">
        <div class="panel-heading panel-heading-divider">
          <span class="title">Overview of Available and Booked Docks</span>
        </div>
        <div class="panel-body">
          <canvas id="docks-doughnut" height="220"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>  
<?php $this->load->view('template/footer'); ?>
<script src="<?php echo base_url()?>assets/lib/chartjs/Chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/lib/daterangepicker/js/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/datatable.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function()
  {

    $('select').select2();
    
    $(".daterange").daterangepicker();

    $('.filter').change(function()
    {
      load_chart();
   });
    $('.docktype-filter').change(function()
    {
      load_docktype_table();
      load_docktype_linechart();
    });


   load_chart();  

   function load_chart() 
   {
      var date = $('#Date').val();
      var company = $('#company').val();
      var supplier = $('#Supplier').val();
      var subcontractor = $('#Sub').val();

     return new Promise(function (resolve, reject) {  

      $.ajax ({
        type:'POST',
        url:'<?php echo base_url();?>Reports/FetchChartData/',
        dataType: 'JSON',
        data: {'date': date, 'company': company, 'supplier': supplier,'subcontractor': subcontractor},
        beforeSend: function() {
          // $('.be-loading').addClass('be-loading be-loading-active');
        },
        success:function(chartdata)
        { 
          $('.be-loading').removeClass('be-loading-active');   
          if(window.line != undefined)
            window.line.destroy();

          window.line = new Chart(document.getElementById("bar-chart"),
          {
            "type":"bar",
            "data":
            {
              "labels": chartdata.label,
              "datasets":[
              {
                "label": "Booking",
                "data": chartdata.booking,
                "backgroundColor": "rgba(66, 183, 244, 0.8)",
                "borderColor": "rgb(14, 79, 187,0.8)",
                "borderWidth": 1
              }
              ]
            },
            "options":{ 
              "scales": {
                "yAxes":[{"ticks":{"beginAtZero":true,callback: function(value) {if (value % 1   === 0) {return value;}}}}]
              }
            }
          });

          if(window.dough != undefined)
            window.dough.destroy();

          window.dough = new Chart(document.getElementById("doughnut"),
          {
            "type":"doughnut",
            "data":
            {
              "labels":["Past","Upcoming","Cancelled"],
              "datasets":[
              {
                "label":"Booking",
                "data": chartdata.Book,
                "backgroundColor":["#fac70b","#0047ab","#df0e62"]
              }
              ]
            },
            options: {
              animation: {
                animateScale: true,
                animateRotate: true
              },
              tooltips: {
                callbacks: {
                  label: function(tooltipItem, data) {
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                      return previousValue + currentValue;
                    });
                    var currentValue = dataset.data[tooltipItem.index];
                    var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                    return ''+ percentage + "%";
                  }
                }
              }
            }
          });
          resolve(chartdata);
        }, error: function(err){
          reject(err);
        }
      });
    });
   }
      var doughnutChart = new Chart(document.getElementById("docks-doughnut"),
          {
              "type":"doughnut",
              "data":{
                  "labels":[],
                  "datasets": [{
                      "label":"Available",
                      "data": [],
                      "backgroundColor":["#fac70b","#0047ab"]
                  }]
              },
              options: {
                  animation: {
                      animateScale: true,
                      animateRotate: true
                  },
                  tooltips: {
                      callbacks: {
                          label: function(tooltipItem, data) {
                              var dataset = data.datasets[tooltipItem.datasetIndex];
                              var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                  return previousValue + currentValue;
                              });
                              var currentValue = dataset.data[tooltipItem.index];
                              var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                              return ''+ percentage + "%";
                          }
                      }
                  }
              }
          });
   var dockTableInit =  $('#dock-type-table').DataTable( {
      data: [],
      columns: [
        { data: 'Date' },
        { data: 'DockType' },
        { data: 'AvailableDocks' },
        { data: 'BookedDocks' },
        { data: 'Utilization' }
      ]
    } );
    function load_docktype_table(){
      var date = $('#dock-date').val();
      var dockType = $('#dock-type').val();
      $.ajax ({
        type:'POST',
        url:'<?php echo base_url();?>Reports/FetchDockTypeTableData/',
        dataType: 'JSON',
        data: {'date': date, 'dockType': dockType},
        beforeSend: function() {
          // $('.be-loading').addClass('be-loading be-loading-active');
        },
        success:function(tableData)
        {
          dockTableInit.clear().rows.add(tableData).draw();
            var available = tableData.reduce(function(a, b) {
                return a + (b['AvailableDocks'] || 0);
            }, 0);
            var booked = tableData.reduce(function(a, b) {
                return a + (b['BookedDocks'] || 0);
            }, 0);

            var total = available + booked;
             var availablePer = Math.floor(((available/total) * 100)+0.5);
             var bookedPer = Math.floor(((booked/total) * 100)+0.5);
             doughnutChart.data.labels = ['Available('+availablePer+'%)','Booked('+bookedPer+'%)'];
            doughnutChart.data.datasets[0].data = [available, booked];
            doughnutChart.update();
        }
        });
    }
    // DockType changes
      var dockTypeChart = new Chart(document.getElementById("line-chart"),
          {
              "type":"line",
              options:{
                  tooltips : {
                      mode : 'label'
                  },
              },
              "data":{
                  labels: [],
                  datasets: [],
                  options: {

                      legend:{display:true},
                      responsive: true,
                      scales: {
                          xAxes: [{
                              type: 'time'
                          }]
                      }
                  }
              }
          });
      var dynamicColors = ["#023fa5", "#7d87b9", "#bec1d4", "#d6bcc0", "#bb7784", "#8e063b", "#4a6fe3",
          "#8595e1", "#b5bbe3", "#e6afb9", "#e07b91", "#d33f6a", "#11c638", "#8dd593", "#c6dec7",
          "#ead3c6", "#f0b98d", "#ef9708", "#0fcfc0", "#9cded6", "#d5eae7", "#f3e1eb", "#f6c4e1", "#f79cd4"];

    function load_docktype_linechart(){
        var date = $('#dock-date').val();
        var dockType = $('#dock-type').val();
        $.ajax ({
            type:'POST',
            url:'<?php echo base_url();?>Reports/FetchDockTypeChartData/',
            dataType: 'JSON',
            data: {'date': date, 'dockType': dockType},
            beforeSend: function() {
                // $('.be-loading').addClass('be-loading be-loading-active');
            },
            success:function(chartData)
            {
                var newDatasetArr = [];
                Object.keys(chartData.data).forEach(function(item,idx){
                    var dataset = chartData.data[item].sort(function(a, b) { return a.x < b.x });
                    var newDataset = {
                        label: item,
                        fill: false,
                        data: dataset,
                        backgroundColor : dynamicColors[idx],
                        borderColor : dynamicColors[idx],
                        borderWidth : 1
                    };
                    newDatasetArr.push(newDataset);
                });
                dockTypeChart.data.labels = chartData.labels;
                dockTypeChart.data.datasets = newDatasetArr;
                dockTypeChart.update();
            }
        });
    }
      load_docktype_table();
      load_docktype_linechart();
  });
</script>
