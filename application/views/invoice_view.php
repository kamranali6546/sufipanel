 <script src="<?php echo LINK ?>js/jquery.min.js"></script>
 <title><?php echo $FileNoSaveAble ?></title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	text-align: justify;
}
#download{
	background: #4D90FE;
	padding: 5px;
	border: thin solid black;
	color: #fff;
	cursor: pointer;
}
#download:hover{
	background: #fff;
	border: thin solid #4D90FE;
	color: #4D90FE;
}
</style>
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
		  	<!--<h3>Invoice</h3>-->
		</div>
		<div class="title_right">
			<!--<a class="btn btn-primary btn-round pull-right" href="<?php // echo site_url(''); ?>">Create Follow Up</a>-->
		</div>
	</div>
	<div class="clearfix"></div>
<!--	<div class="row">
		<div class="col-md-12">
			<form method="post" action="<?php echo site_url('Invoice'); ?>" target="_blank">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Customer Title And Name</label>
							<input type="text" name="customerTitle" class="form-control">
							<input type="hidden" name="bookingId" value="<?php echo $bookingId; ?>" >
						</div>
						<div class="col-md-6">
							<label>Short Message For Customer</label>
							<textarea rows="1" class="form-control" name="short_message"></textarea>
						</div>
					</div>
				</div> 
				<div class="form-group pull-right">
					<button class="btn btn-primary btn-round" type="submit">Next</button>
				</div>
			</form>
		</div>
	</div> -->
    <br><br><br>
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" >
            <tbody>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: -23px;">
                            <tbody>
                                <tr>
          <td width="70%" align="left" valign="top" style="padding-bottom:5px;">
              <img width="200" height="150" src="<?php echo base_url(); ?>/upload/Untitled-2_copy2.jpg" alt="Untitled-2_copy2.jpg" >
            <div style="font-size: 20px; font-weight: bold;color:blue;">Sufi Travel and Tours</div>
            <p>85 Great Portland Street, London, England,W1W7LT</p>
            <b>Agent Direct Line: </b><a href="tel:<?php echo $AgentLine; ?>"><?php echo $AgentLine ?></a><br>
            <b>Invoice Date:</b> <?php echo date('d-M-Y'); ?><br>
              <b>Invoice No:</b> <?php echo $FileNo ?> 
            <!--<b>Complain Line: </b><a href="tel:02079935050">0207 993 5050</a><br>-->
<!--            <b>Email: </b><a href="mailto:admin@sufitravelandtours.co.uk">admin@sufitravelandtours.co.uk</a><br>
            <b>Agent: </b><?php echo $agenetName; ?><br>
            <b>Agent Email: </b><a href="mailto:<?php echo $agentEmail ?>"><?php echo $agentEmail; ?></a>-->
        </td>
          <td valign="top">
              <div style="font-size: 20px; font-weight: bold;color: blue">Booking Confirmation Invoice</div><br>
                       </td>
        </tr>
                              <!--   <tr>
                                        <td align="right" style="font-size: 11px; font-weight: bold;">Main Line:</td>
                                        <td width="1%" style="font-size: 11px">&nbsp;</td>
                                        <td width="23%" align="right" style="font-size: 11px"><a href="tel:08000622599">08000622599</a></td>
                                </tr> -->
                                   <!--  <tr>
                                            <td align="right" style="font-size: 11px; font-weight: bold;">Email:</td>
                                            <td style="font-size: 11px">&nbsp;</td>
                                            <td align="right" style="font-size: 11px"><a href="mailto:admin@brightholiday.co.uk">admin@brightholiday.co.uk</a></td>
                                    </tr>
                                    <tr>
                                            <td align="right" style="font-size: 11px; font-weight: bold;">Website:</td>
                                            <td style="font-size: 11px">&nbsp;</td>
                                            <td align="right" style="font-size: 11px"><a href="https://www.brightholiday.co.uk">https://www.brightholiday.co.uk</a></td>
                                    </tr> -->
                            </tbody>
                        </table>
                    </td>
                </tr>
                    <tr>
                            <td>&nbsp;</td>
                    </tr>
                    <!-- <tr>
                            <td align="center" style="font-size: 20px; font-weight: bold;">Booking Confirmation Invoice</td>
                    </tr> -->
                    <tr>
                            <td height="5"></td>
                    </tr>
                    <tr>
                            <td>
                                    <table width="100%" cellspacing="0" cellpadding="0" style="border:3px #000 solid; font-size: 12px;">
                                            <tbody>
                                                    <tr>
                                                            <td>
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                    <tr>
                                                                                            <td width="2%">&nbsp;</td>
                                                                                            <td width="47%">&nbsp;</td>
                                                                                            <td width="2%">&nbsp;</td>
                                                                                            <td width="25%">&nbsp;</td>
                                                                                            <td width="2%">&nbsp;</td>
                                                                                            <td width="22%">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td style="font-size: 15px; font-weight: bold;">To,</td>
                                                                                            <td style="">&nbsp;</td>
                                                                                            <td height="18" style="font-weight: bold"><!-- Invoice No. --></td>
                                                                                            <td style="font-weight: bold"></td>
                                                                                            <td style="font-size: 12px"><!-- <?php //secho $FileNo ?> --></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td rowspan="3" valign="top" style="font-size: 15px; line-height:22px;"><strong><?php if(!empty($ContactDetails)){ echo $ContactDetails[0]->fullname; ?><?php } ?></strong><br></td>
                                                                                            <td style="">&nbsp;</td>
                                                                                            <td height="18" style="font-weight: bold"><!-- Invoice Date --></td>
                                                                                            <td style="font-weight: bold"></td>
                                                                                            <td style="font-size: 12px"><!-- <?php //echo date('d-M-Y'); ?> --></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td style="">&nbsp;</td>
                                                                                            <td height="18" style="font-weight: bold;    font-size: 12px;">Booking Confirmation No (PNR).</td>
                                                                                            <td style="font-weight: bold">:</td>
                                                                                            <td style="font-size: 12px"><?php if(!empty($flightDetails)){ echo $flightDetails[0]->pnr; } ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td style="">&nbsp;</td>
                                                                                            <td height="18" style="font-weight: bold;    font-size: 12px;">Airline Locator</td>
                                                                                            <td style="font-weight: bold">:</td>
                                                                                            <td style="font-size: 12px"><?php if(!empty($flightDetails)){ echo $flightDetails[0]->airlineLocatore; } ?></td>
                                                                                    </tr>      
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td style="">&nbsp;</td>
                                                                                            <td height="18" style="font-weight: bold;    font-size: 12px;">Agent Name</td>
                                                                                            <td style="font-weight: bold">:</td>
                                                                                            <td style="font-size: 12px"><?php echo $agenetName; ?></td>
                                                                                    </tr>
                                                                            </tbody>
                                                                    </table>
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                    <tr>
                                                                                            <td width="2%">&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td height="30" colspan="5"><hr noshade="noshade" style="color:#CCC;"></td>
                                                                                            <td width="22%">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td width="22%" style="font-size: 12px; font-weight: bold">Departing From</td>
                                                                                            <td width="2%" style="font-size: 12px; font-weight: bold">:</td>
                                                                                            <td width="23%" style="font-size: 12px"><?php if(!empty($flightDetails)){ echo $flightDetails[0]->departure; } ?></td>
                                                                                            <td>&nbsp;</td>
                                                                                            <?php if(!empty($flightDetails)){ if($flightDetails[0]->flight_type=='Return'){ ?>
                                                                                            <td height="18" style="font-size: 12px; font-weight: bold;">Returning From</td>
                                                                                            <td style="font-size: 12px; font-weight: bold;">:</td>
                                                                                            <td style="font-size: 12px"><?php if(!empty($flightDetails)){ echo $flightDetails[0]->destination; } ?></td>
                                                                                            <?php } } ?>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td valign="top" style="font-size: 12px; font-weight: bold">Departure Date</td>
                                                                                            <td style="font-size: 12px; font-weight: bold">:</td>
                                                                                            <td valign="top" style="font-size: 12px"><?php if(!empty($flightDetails)){ echo date('d-M-Y',strtotime($flightDetails[0]->departure_date)); } ?></td>
                                                                                            <td>&nbsp;</td>
                                                                                              <?php if(!empty($flightDetails)){ if($flightDetails[0]->flight_type=='Return'){ ?>
                                                                                            <td height="18" style="font-size: 12px; font-weight: bold;">Return Date</td>
                                                                                            <td style="font-size: 12px; font-weight: bold;">:</td>
                                                                                            <td style="font-size: 12px"><?php if(!empty($flightDetails)){ echo date('d-M-Y',strtotime($flightDetails[0]->returnDate)); } ?></td>
                                                                                            <?php } } ?>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td valign="top" style="font-size: 12px; font-weight: bold">Airline</td>
                                                                                            <td style="font-size: 12px; font-weight: bold">:</td>
                                                                                            <td valign="top" style="font-size: 12px"><?php if(!empty($flightDetails)){ echo $flightDetails[0]->airline; } ?></td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td height="18" style="font-size: 12px; font-weight: bold;">Via</td>
                                                                                            <td style="font-size: 12px; font-weight: bold;">:</td>
                                                                                            <td style="font-size: 12px"><?php if(!empty($flightDetails)){ echo $flightDetails[0]->via; } ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td width="2%">&nbsp;</td>
                                                                                            <td style="font-size: 12px; font-weight: bold">Booking Class</td>
                                                                                            <td style="font-size: 12px; font-weight: bold">:</td>
                                                                                            <td style="font-size: 12px"><?php if(!empty($flightDetails)){ echo $flightDetails[0]->flight_class; } ?></td>
                                                                                            <td width="2%">&nbsp;</td>
                                                                                            <td width="25%"><span style="font-size: 12px; font-weight: bold">Flight Type</span></td>
                                                                                            <td width="2%"><span style="font-size: 12px; font-weight: bold">:</span></td>
                                                                                            <td width="22%"><span style="font-size: 12px"><?php if(!empty($flightDetails)){ echo $flightDetails[0]->flight_type; } ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td colspan="3">&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                    </tr>
                                                                            </tbody>
                                                                    </table>
                                                            </td>
                                                    </tr>
                                            </tbody>
                                    </table>
                            </td>
                    </tr>
               <tr>
                            <td style="min-height:400px; vertical-align:top;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                    <tr>
                                                            <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                            <td>
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                    <tr>
                                                                                            <td width="1%" style="font-size: 12px; border-bottom:3px #000 solid;">&nbsp;</td>
                                                                                            <td colspan="3" style="font-size: 12px; font-weight: bold; border-bottom:3px #000 solid;">Passengers(s)</td>
                                                                                            <td  align="right" style="font-size: 12px; font-weight: bold; border-bottom:3px #000 solid;">Booking Fee(&pound;)</td>
                                                                                            <td width="9%" align="right" style="font-size: 12px; font-weight: bold; border-bottom:3px #000 solid;">Amount</td>
                                                                                            <td width="1%" style="font-size: 12px; border-bottom:3px #000 solid;">&nbsp;</td>
                                                                                    </tr>	
                                                                                    <?php $bookiingFee=0; $totalSalePrice=0; ?>
                                                                                    <?php if(!empty($passengerDetails)){ foreach($passengerDetails as $passObj){ ?>
                                                                                    <tr>
                                                                                            <td>&nbsp;</td>
                                                                                            <td colspan="3" style="font-size: 12px"><?php echo $passObj->title.' '.$passObj->firstName.' '.$passObj->midle_name.' '.$passObj->sur_name; ?></td>
                                                                                            <td  style="font-size: 12px"><?php echo $passObj->booking_fee; ?></td>
                                                                                            <td align="right" style="font-size: 12px"><?php echo '&pound;'.$passObj->salePrice; ?></td>
                                                                                            <td>&nbsp;</td>
                                                                                    </tr> 
                                                                                    <?php $bookiingFee=$bookiingFee+$passObj->booking_fee; $totalSalePrice=$totalSalePrice+$passObj->salePrice; } } ?>
                                                                                    <tr>
                                                                                            <td style="font-size: 12px; border-top:3px #000 solid;">&nbsp;</td>
                                                                                            <td height="25" colspan="2" style="font-size: 12px; border-top:3px #000 solid; font-weight: bold;border-bottom: thin dotted #eee;">Total </td>
                                                                                            <td></td>
                                                                                            <td width="2%" style="font-size: 12px; border-top:3px #000 solid;  font-weight: bold;border-bottom: thin dotted #eee;">:</td>
                                                                                            
                                                                                            <td align="right" style="font-size: 12px; border-top:3px #000 solid;border-bottom: thin dotted #eee;"><span style="font-size: 12px">£</span><?php echo $totalSalePrice; ?></td>
                                                                                            <td style="font-size: 12px; border-top:3px #000 solid;">&nbsp;</td>
                                                                                    </tr>
<!--                                                                                    <tr>
                                                                                            <td style="font-size: 12px; ">&nbsp;</td>
                                                                                            <td height="25" colspan="2" style="font-size: 12px;  font-weight: bold;border-bottom: thin dotted #eee;">Booking Fee </td>
                                                                                            <td width="2%" style="font-size: 12px;  font-weight: bold;border-bottom:3px #000 solid;">:</td>
                                                                                            <td align="right" style="font-size: 12px; border-bottom:3px #000 solid;"><span style="font-size: 12px;">£</span><?php //echo $bookiingFee; ?></td>
                                                                                            <td style="font-size: 12px; border-bottom:3px #000 solid; ">&nbsp;</td>
                                                                                    </tr>-->
                                                                                    <tr>
                                                                                            <td style="font-size: 12px; ">&nbsp;</td>
                                                                                            <td height="25" colspan="2" style="font-size: 12px;  font-weight: bold;border-bottom: thin dotted #eee;">Grand Total</td>
                                                                                            <td></td>
                                                                                            <td width="2%" style="font-size: 12px;  font-weight: bold;border-bottom: thin dotted #eee;">:</td>
                                                                                            <td align="right" style="font-size: 12px;border-bottom: thin dotted #eee; "><span style="font-size: 12px">£</span><?php echo $totalSalePrice+$bookiingFee; ?></td>
                                                                                            <td style="font-size: 12px; ">&nbsp;</td>
                                                                                    </tr>	
                                                                                    <?php
                                                                                     $cardAmount=cardPaymentSum($bookingId);
                                   
                                                                                    $bankAmount=paymentReceived($bookingId);
                                                                                    $tatalreceived=($cardAmount+$bankAmount);
                                                                                    $saleAt=$totalSalePrice+$bookiingFee;
                                                                                    ?>
                                                                                    <tr>
                                                                                            <td style="font-size: 12px">&nbsp;</td>
                                                                                            <td height="25" colspan="2" style="font-size: 12px; font-weight: bold;border-bottom: thin dotted #eee;">Paid</td>
                                                                                            <td></td>
                                                                                            <td style="font-size: 12px; font-weight: bold;border-bottom:3px #000 solid;">:</td>
                                                                                            <td align="right" style="font-size: 12px;border-bottom:3px #000 solid;">£<?php echo $tatalreceived; ?></td>
                                                                                            <td style="font-size: 12px;border-bottom:3px #000 solid;">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td style="font-size: 12px;">&nbsp;</td>
                                                                                            <td width="41%" height="25" style="font-size: 12px; font-weight: bold;border-bottom: thin dotted #eee;">Balance Due </td>
                                                                                            <td width="46%" style="font-size: 12px;border-bottom: thin dotted #eee;"></td>
                                                                                            <td></td>
                                                                                            <td style="font-size: 12px; font-weight: bold;border-bottom: thin dotted #eee;">:</td>
                                                                                            <td align="right" style="font-size: 12px;border-bottom: thin dotted #eee;">£<?php echo $saleAt-$tatalreceived; ?></td>
                                                                                            <td style="font-size: 12px;">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td style="font-size: 12px;">&nbsp;</td>
                                                                                            <td width="41%" height="25" style="font-size: 12px; font-weight: bold;border-bottom: thin dotted #eee;">Payment Due Date & Time </td>
                                                                                            <td width="46%" style="font-size: 12px;border-bottom: thin dotted #eee;"></td>
                                                                                            <td></td>
                                                                                            <td style="font-size: 12px; font-weight: bold;border-bottom: thin dotted #eee;">:</td>
                                                                                            <td align="right" style="font-size: 12px;border-bottom: thin dotted #eee;"><?php if(!empty($paymentDueDate)){ echo $paymentDueDate[0]->paymentDue_date.' '.$paymentDueDate[0]->paymentDueTime; } ?></td>
                                                                                            <td style="font-size: 12px;">&nbsp;</td>
                                                                                    </tr>
                                                                            </tbody>
                                                                    </table>
                                                            </td>
                                                    </tr>
                                                                                      <tr>
                                                                                    <td>&nbsp;</td>
                                                                              </tr>

<tr>
    <td><table width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
      <tbody>
          <tr>
            <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                        <th height="25" style="border-bottom:3px #000 solid;">Payment Date</th>
                        <th height="25" align="center" style="border-bottom:3px #000 solid;">Payment Mode</th>
                        <th height="25" align="right" style="border-bottom:3px #000 solid;">Amount</th>
                </tr>
                <?php if(!empty($PaymentRecivedFromCustomer)){ foreach($PaymentRecivedFromCustomer as $customerObj){ ?>
                <tr style="    text-align: -webkit-center;">
                    <td height="25" style="border-bottom: thin dotted #eee;"><?php echo date('d-M-Y',  strtotime($customerObj->pay_date)) ?></td>
                  <td height="25" style="border-bottom: thin dotted #eee;" align="center"><?php echo $customerObj->pay_by; ?></td>
                  <td height="25" style="border-bottom: thin dotted #eee;" align="right">£<?php echo $customerObj->amount; ?></td>
               </tr>
                <?php } } ?>
            </tbody>
    </table>
    </td>
    </tr>
    </tbody></table></td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td><span style="font-size: 12px; font-weight: bold;">Flight Itinerary</span></td>
</tr>
<tr>
    <td><table width="100%" cellspacing="0" cellpadding="0" style="border:3px #000 solid; font-size: 12px;">
      <tbody><tr>
            <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
            <td width="2%">&nbsp;</td>
            <td style="font-size: 12px;">
                <?php if(!empty($flightDetails)){  echo str_replace("highlighttext", "black",$flightDetails[0]->ticketDetails);   } ?>
            </td>
            <td width="2%">&nbsp;</td>
      </tr>
    </tbody></table>
    </td>
    </tr>
    </tbody></table></td>
</tr>
</tbody></table >

</td></tr>
    <tr>
    <td height="5" style="border-bottom:3px #000 solid;">&nbsp;</td>
</tr>
    <tr>
    <td align="center" style="font-size:9px;">&nbsp;</td>
</tr>

</tbody>
        </table>
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tbody><tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td align="center" style="font-size: 20px; font-weight: bold;">Booking Terms &amp; Conditions</td>
  </tr>
  <tr>
	<td height="10"></td>
  </tr>

  
  <tr>
	<td style="font-size: 11px;">
	   <p style="font-size:11px;">
Please read these carefully as the person making this booking (either for him selves or for any other passenger) accepts all the below terms and conditions.
<br><br>
<b>DEPOSITS AND TICKETS ARE NEITHER REFUNDABLE NOR CHANGEABLE (Terms &amp; Conditions May Apply).</b>
<br>
Unless Specified, All the deposits paid and tickets purchased / issued are non refundable in case of cancellation or no show (Failure to arrive at departure airport on time) and non changeable before or after departure (date change is not permitted). Once flights reserved, bookings / tickets are non-transferable to any other person means that name changes are not permitted. Issued Ticket are also not re-routable.
<br><br>
If you are reserving the flight by making the advance partial payment (Initial deposit) then please note that fare/taxes may increase at any time without the prior notice. Its means the price is not guaranteed unless ticket is issued because airline / consolidator has right to increase the price due to any reason. In that case we will not be liable and passenger has to pay the fare/tax difference. We always recommend you to pay ASAP and get issue your ticket to avoid this situation. Further more if you will cancel your reservation due to any reason, then the paid deposit(s) will not be refunded.
<br><br>
Regardless of any reason, 75GBP per person will be charged, if you will cancel your reservation before ticket issuance. After issuance all payments are non-refundable.
<br><br>
<b>CHECKING ALL FLIGHT DETAILS &amp; PASSENGER NAME(S)</b>
<br>
It is your responsibility to check all the details are correct i.e. Passenger names (are same as appearing on passport / travel docs), Travelling dates, Transit Time, Origin &amp; Destination, Stop Over, Baggage Allowance and other flight information. Once the ticket is issued then no changes can be made. 
<br><br>
<b>PASSPORT, VISA  AND IMMIGRATION REQUIREMENTS</b> 
<br>
You are responsible for checking all these items like Passport, Visa (including Transit Visa) and other immigration requirements. You must consult with the relevant Embassy / Consulate, well before the departure time for the up to date information as requirements may change time to time. We can not accept any liability of any transit visa and if you are refused the entry onto the flight or into any country due to failure on your part to carry the correct passport, visa or other documents required by any airline, authority or country. 
<br><br>
<b>RECONFIRMING RETURN/ONWARD FLIGHTS </b>
<br>
It is your responsibility to RECONFIRM your flights at least 72 hours before your departure time either with your travel agent or the relevant Airline directly. The company will not be liable for any additional costs due to your failure to reconfirm your flights.
<br><br>
<b>INSURANCE AND BAGGAGE LOSS</b>
<br>
We recommend that you purchase travel insurance. It is your responsibility to ensure you have valid travel insurance that covers your needs and also ensure that you have complied with all the health and vaccination requirements for the countries you are travelling. Advice can be obtained from your GP or travel clinic.  We don not accept any claim for the lost / Stolen / Damaged Baggage. you have to contact the relevant airline directly in that case. 
<br><br>
<b>SPECIAL REQUESTS AND MEDICAL PROBLEMS</b>
<br>
If you have any special requests like meal preference, Seat Allocation and wheel chair request etc, please advise us at time of issuance of ticket. We will try our best to fulfill these by passing this request to relevant airline but we cannot guarantee and failure to meet any special request will not held us liable for any claim.
<br><br>
<b>VERY IMPORTANT: </b>
<br>
We do not accept responsibility for any financial loss if the airline fail to operate. Passengers will be solely responsible for that so it is highly recommended that separate travel insurance must be arranged to protect yourself. 
<br><br>
We advise you to read our complete terms and conditions mentioned at on our website.
</p>
	</td>
  </tr>
	<tr height="20">
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td height="5">
		<table width="100%">
			<tbody><tr>
				<td style="width:2%" align="right">Date:</td>
				<td width="20%" style="border-bottom: thin solid black;width:30%">&nbsp;</td>
				<td width="1%">&nbsp;</td>
				<td width="6%" align="right">Name:</td>
				<td style="border-bottom: thin solid black;">&nbsp;</td>
				<td width="1%">&nbsp;</td>
				<td width="6%" align="right">Signature:</td>
				<td style="border-bottom: thin solid black;">&nbsp;</td>
			</tr>
		</tbody></table>
	</td>
  </tr>
	<tr>
	<td align="center" style="font-size:9px;">&nbsp;</td>
  </tr>
  
</tbody></table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody><tr>
	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tbody><tr>
		<td width="76%">&nbsp;</td>
		<td colspan="2" align="right" style="padding-bottom:5px;">
                    <!--<form method="post" action="<?php echo site_url('Invoice'); ?>" target="_blank">-->
				<!--<input type="hidden" name="bookingId" value="<?php echo $bookingId; ?>">-->
					<input type="button" id="download" name="print" value="Download Invoice">
			<!--</form>-->
		</td>
		</tr>
		</tbody></table>
	</td>
  </tr>
	</tbody></table>  
</div>
<script>
$(function(){
    
    $('#download').click(function () {
    $(this).hide()
    window.print();
});
});
    
    </script>