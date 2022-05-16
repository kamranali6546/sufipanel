<!DOCTYPE html>
<html>
    <head>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <style>
            .margin-zero
            {
                margin-bottom: 0px;
            }
            .margin-top
            {
                margin-top: 0px;
            }
        </style>
    </head>
    <body>
        <table width="100%" border="0"  cellpadding="0" cellspacing="0" >
<!--            <tr>
                <td>
                    <img width="200" height="150"   src="<?php echo base_url(); ?>/upload/Untitled-2_copy2.jpg" alt="Untitled-2_copy2.jpg" >
                </td>
                <td valign="top">
                    <p style="font-size: 20px; font-weight: bold;color: blue">Booking Confirmation Invoice</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="margin-zero" style="font-size: 20px; font-weight: bold;color:blue;line-height: 1;">Sufi Travel and Tours</p>
                    <p class="margin-zero margin-top" style="line-height: 1;">85 Great Portland Street, London, England,W1W7LT</p>
                    <b>Invoice Date:</b> <?php echo date('d-M-Y'); ?><br>
                    <b>Invoice No:</b> <?php echo $fileN; ?>
                </td>
                <td>
                    
                </td>
            </tr>-->
            
            <tr style="background-color: #4d4d4d;">
                <td  colspan="2" style="text-align: center;">
                    <img src="<?php echo base_url(); ?>/lib/images/logo.png" height="90" width="100">
                </td>
            </tr>

            <tr>
                    <td colspan="2" style="text-align: center;">
                            <h2 style="color: #ed8323;">
                                    Sufi Travel and Tours
                            </h2>
                    </td>
            </tr>

            <tr>
                    <td colspan="2" style="text-align: center; ">
                            <h3 style="color: #0000ff; margin-top: -5px;">85 Great Portland Street, London, England,W1W7LT</h3>
                    </td>
            </tr>
            <tr>
                <td colspan="2"> </td>
            </tr>
            <tr>
                <td colspan="2">
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
                 <td colspan="2">
                    Flights:
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <th></th>
                            <th>From-To</th>
                            <th>Dep Time</th>
                            <th>Arr Time</th>
                        </tr>
                        <?php echo $flightIt; ?>
                    </table>
                </td>
            </tr>
             <tr>
                 <td colspan="2" height="2"></td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="font-size: 20px; font-weight: bold;">Booking Terms &amp; Conditions</td>
            </tr>
            <tr>
                <td height="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 11px;">
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
        </table>
    </body>
</html>