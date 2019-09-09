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
                       <div class="col-sm-12" id="printview">
                        <div class="col-sm-6">
                          <p>Dear <b><?php echo $UserName;?>,</b></p>
                          <p>We are pleased to inform that your registration with our system is successful.<br><br> Please go to: <b><a href="<?php echo $url;?>" target="_blank"><?php echo $url;?></a></b> with the following details to login our system.</p>
                          <h3><b><u>  Login Information</u></b></h3>
                          <table class="table">
                           <tr>
                             <td><b>Login ID</b></td>
                             <td width="20"><b>:</b></td>
                             <td>
                              <?php 
                              $ids[] = $UniqueID;
                              $ids[] = $UserName;
                              $ids[] = $EmailAddress1;
                              $login = array_filter($ids);
                              echo implode(' <b>(or)</b> ', $login);
                              ?>
                              </td>
                           </tr>
                           <tr>
                             <td><b>Password</b></td>
                             <td width="20"><b>:</b></td>
                             <td><?php echo $Password;?></td>
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
