<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"> 
</head>

<body style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f7f0f0; margin: 0;" bgcolor="#f7f0f0">
<table class="body-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; width: 100%; background-color: #f7f0f0; margin: 0;" bgcolor="#f7f0f0">
	<tbody>
		<tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; margin: 0;">
			<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
			<td class="container" width="800" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; vertical-align: top; display: block !important; max-width: 800px !important; clear: both !important; margin: 0 auto;" valign="top">
				<div class="content" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; max-width: 800px; display: block; margin: 0 auto; padding: 20px;">
					<table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope="" itemtype="http://schema.org/ConfirmAction" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px;  margin: 0; border: none;">
						<tbody><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; margin: 0;">
							<td class="content-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; vertical-align: top; margin: 0;padding: 30px;border: 3px dashed #bbbcbf; background-color: #fff;" valign="top">
								<meta itemprop="name" content="Confirm Email" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; margin: 0;">
								<table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; margin: 0;">
									<tbody>
										<tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 18px; margin: 0;">
											<td class="content-block" style="text-align:center; vertical-align: top; margin: 0; padding: 0 0 5px;">
											  <h4 style="margin:0 0 15px 0; padding:0;"><?php if(isset($mail_title)){ echo $mail_title;} else { echo 'New Booking Details'; }?></h4> 
											  
											</td>
										</tr> 
										<tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; margin: 0;">
											<td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                       <?php $book = $this->Booking_model->getBookingDetailID($RefNo,'RefNo'); ?>
                       <div class="col-sm-12" id="printview">
                        <div class="col-sm-6">
                          <h3><b><u>  Booking Information</u></b></h3>
                          <table class="table">
                           <tr>
                             <td><b>Job Order No</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->BookingRefNo;?></td>
                           </tr>
                           <tr>
                             <td><b>Booked On</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo date('m/d/Y',strtotime($book->BookedOn));?></td>
                           </tr>
                           <tr>
                             <td><b>Booking Date</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo date('m/d/Y',strtotime($book->CheckIn));?></td>
                           </tr>
                           <tr>
                             <td><b>Check-In / Check-Out</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo date('h:i A',strtotime($book->CheckIn)).' <b>To</b> '.date('h:i A',strtotime($book->CheckOut));?></td>
                           </tr>
                           <tr>
                             <td><b>Booking Mode</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->BookMode?></td>
                           </tr>
                           <tr>
                             <td><b>Docks Type / Dock.No</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->DockType.' / '.$book->SlotName;?></td>
                           </tr>
                           <tr>
                             <td><b>P.o Number</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->PONumber;?></td>
                           </tr>
                           <tr>
                             <td><b>D.o Number</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->DONumber;?></td>
                           </tr>
                           <tr>
                             <td><b>Airway Bill.No</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->BillNo;?></td>
                           </tr>
                           <tr>
                             <td><b>B/L No</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->BLNo;?></td>
                           </tr>
                           <tr>
                             <td><b>Operation</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->Area;?></td>
                           </tr>
                         </table>
                       </div>
                       <div class="col-sm-6">
                         <h3><b><u>Vehicle Information</u></b></h3>
                         <table class="table">
                           <tr>
                             <td width="290"><b>Vehicle Number</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->VehicleNo?></td>
                           </tr>
                           <tr>
                             <td width="290"><b>Vehicle Type</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->Type?></td>
                           </tr>
                           <tr>
                             <td width="290"><b>Driver Name</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->DriverName?></td>
                           </tr>
                         </table>
                         <h3><b><u> Delivery Information</u></b></h3>
                         <table class="table">
                           <tr>
                             <td><b>Company (Delivery To)</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->CompanyName;?></td>
                           </tr>
                           <tr>
                             <td><b>Building Name</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->BuildingName;?></td>
                           </tr>
                           <tr>
                             <td><b>Building Address</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $book->BuildingAddress?></td>
                           </tr>
                           <tr>
                             <td colspan="2"><img src="<?php echo base_url($book->QRCode);?>" width="120"></td>
                           </tr>
                         </table>
                       </div>
                     </div>
											</td>
										</tr>  
									</tbody>
								</table>
							</td>
						</tr>
					</tbody></table> 
			</td> 
		</tr>
	</tbody>
</table>
</body>
