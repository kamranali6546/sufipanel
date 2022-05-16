<style type='text/css'>
    table {
        border-collapse: collapse !important;
        border-spacing: 0 !important;
    }
    table td {
        border-collapse: collapse !important;
    }
    html, body, #wrappertable {
        line-height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }
    .invoice-detail td, .invoice-detail td strong {
        padding-bottom: 5px;
    }
    .invoice-detail td strong {
        display: block;
    }
    .pssgBorder { 
        background-color: #E6E6E6;
    }
    .pssgBorder tbody tr td, .pssgBorder thead tr th, .netPT tbody tr td, .netPT tbody tr th { 
        border: 1px solid #c1c0c0 !important;
    }
    .netPT tbody tr td {
        text-align: center;
    }
    .netPT tbody tr td, .netPT tbody tr th { padding: 2px 10px;}
    p {
        line-height: 18px;
        font-size: 13px;
    }
    .invoiceMain tbody tr:nth-child(2) td table {
        margin-bottom: -5px;
    }
    .invoiceMain tbody tr:nth-child(2) td table tbody tr td {
        border: 1px solid #c1c0c0 !important;
        padding: 3px 5px;
        padding-top: 5px !important;
    }
 
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>Invoice</h3>
        </div>
        <div class="title_right">
        </div>
    </div>
    <div class="clearfix"></div>
  <table id="wrappertable" width="100%" cellspacing="0" cellpadding="0" border="0" >
   <tbody>
      <tr>
         <td valign="top" align="center">
            <table style="background: #ffffff;" cellspacing="0" cellpadding="0" border="0" width="100%">
               <tbody>
                  <tr>
                     <td width="100%" class="invoice" valign="top" align="center">
                        <table width="90%" cellspacing="0" cellpadding="0" border="0">
                           <tr>
                              <td>
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 20px;">
                                    <tr>
                                       <td>
                                          <h3 style="text-transform: capitalize; margin: 0px 0px 10px;">Customer Name:&nbsp; <small><?php echo $customerTitle; ?></small></h3>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <p style="text-align: left; line-height: 1.4;"><b>Message:</b> &nbsp;<?php echo $shortMessage; ?></p>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td align="center" style="padding-bottom: 20px;">
                                          <a href="#" style="display: inline-block; width: 210px;"><img src="<?php echo base_url().'upload/'.idToName('company','id',$companyId,'company_logo') ?>" class="img-responsive"></a>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <?php
                           $passObj=$ContactDetails[0];
                           ?>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td width="50%" align="left" class="invoice-detail">
                                          <table  width="100%" style="border: none;">
                                             <tr>
                                                <td valign="top"><strong>Bill To:</strong></td>
                                                <td valign="top"> <?php echo $passObj->fullname; ?> </td>
                                             </tr>
                                             <tr>
                                                <td valign="top"><strong>Postal Address:</strong></td>
                                                <td valign="top"> <?php echo  $passObj->postal_address; ?> </td>
                                             </tr>
                                          </table>
                                       </td>
                                       <td width="30%" align="left" class="invoice-detail">
                                          <table width="100%" class='invoiceMain'>
                                             <tr>
                                                <td style="padding-bottom: 10px;">
                                                   <h3 style="margin: 0;">INVOICE</h3>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <table width="100%">
                                                      <tr>
                                                         <td valign="top"><strong>File No:</strong></td>
                                                         <td valign="top"><?php echo $FileNo; ?></td>
                                                      </tr>
                                                      <tr>
                                                         <td valign="top"><strong>Booking Date:</strong></td>
                                                         <td valign="top"> <?php echo $bookingDate; ?> </td>
                                                      </tr>
                                                      <tr>
                                                         <td valign="top"><strong>Booking Agent:</strong></td>
                                                         <td valign="top"> <?php  echo $agenetName; ?> </td>
                                                      </tr>
                                                   </table>
                                                </td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td>
                                          <h3 style='border-bottom: 1px solid rgba(128, 128, 128, 0.49);margin-top: 0px;'>Flight Details:</h3>
                                       </td>
                                       <td></td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <?php
                           $flightObj=$flightDetails[0];
                           ?>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td width="50%" align="left" class="invoice-detail" valign="top">
                                          <table width="100%">
                                             <tr>
                                                <td valign="top"><strong>Departure Airport:</strong></td>
                                                <td valign="top"><?php echo $flightObj->departure; ?></td>
                                             </tr>
                                             <tr>
                                                <td valign="top"><strong>Destination Airport:</strong></td>
                                                <td valign="top"><?php echo $flightObj->destination; ?></td>
                                             </tr>
                                             <tr>
                                                <td valign="top"><strong>Via:</strong></td>
                                                <td valign="top"><?php echo $flightObj->via; ?></td>
                                             </tr>
                                             <tr>
                                                <td valign="top"><strong>Airline:</strong></td>
                                                <td valign="top"><?php echo $flightObj->airline; ?></td>
                                             </tr>
                                          </table>
                                       </td>
                                       <td width="50%" align="left" class="invoice-detail" valign="top">
                                          <table width="100%">
                                             <tr>
                                                <td><strong>Departure Date:</strong></td>
                                                <td><?php echo date('d-M-Y',strtotime($flightObj->departure_date)); ?></td>
                                             </tr>
                                             <tr>
                                                <td><strong>Returning Date:</strong></td>
                                                <td><?php echo date('d-M-Y',strtotime($flightObj->returnDate)); ?></td>
                                             </tr>
                                             <tr>
                                                <td><strong>Flight Type:</strong></td>
                                                <td><?php echo $flightObj->flight_type; ?></td>
                                             </tr>
                                             <tr>
                                                <td><strong>GDS PNR:</strong></td>
                                                <td><?php echo $flightObj->pnr; ?></td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td class="invoice-detail" align="center" valign="top"><?php echo $flightObj->ticketDetails; ?></td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td class="invoice-detail" align="center" valign="top">
                                          <hr>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <?php if($companyId==1){ ?>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td class="invoice-detail" align="center" valign="top">
                                          <h4 style='font-weight: 600;'>Payment Note for customer</h4>
                                          <p>* Accounts department will recommend you to put your file no# as payment reference and inform to your agent after making the payment. Agent will always make this payment check out from accounts department on your information. Agent could not confirm or claim your payment into your file no# unless you inform to your relevant agent through telephone OR email. Agent will consider payment date & time when you inform him/her. Customer should inform with in the duty timings.</p>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td align="center">
                                          <p>We can take initial booking deposit by Debit or credit card and left balance customer should pay into our bank account.</p>
                                       </td>
                                    </tr> 
                                 </table>
                              </td>
                           </tr>
                           <?php } ?>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td>
                                          <table class="table table-condensed table-striped table-bordered pssgBorder" width="100%">
                                             <thead>
                                                <tr>
                                                   <th>Passenger(s)</th>
                                                   <th>Category</th>
                                                   <th>Sale Price (£)</th>
                                                   <th>Admin Fee (£)</th>
                                                   <th>Total (£)</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                   $total=0;
                                                   foreach($passengerDetails as $receiptObj)
                                                   {
                                                       $sub_total=0;
                                                       $sub_total=($receiptObj->salePrice + $receiptObj->booking_fee);
                                                   ?>
                                                <tr>
                                                   <td><?php echo $receiptObj->title.' '.$receiptObj->firstName.' '.$receiptObj->midle_name.' '.$receiptObj->sur_name; ?></td>
                                                   <td><?php echo $receiptObj->category; ?></td>
                                                   <td><?php echo $receiptObj->salePrice; ?></td>
                                                   <td><?php echo $receiptObj->booking_fee;  ?></td>
                                                   <td><?php echo $sub_total; ?></td>
                                                </tr>
                                                <?php 
                                                   $total=$total + $sub_total;
                                                   }
                                                   ?>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                               <?php $pay_total=totalreceivedAmount($bookingId); ?>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td class="invoice-detail" align="center" valign="top">
                                          <table class="netPT" width="100%">
                                             <tr>
                                                <th><label>Net Total(£)</label></th>
                                                <td width="10%"><?php echo $total; ?></td>
                                             </tr>
                                             <tr>
                                                <th><label>Payment Received (£)</label></th>
                                                <td width="10%"><?php echo $pay_total; ?></td>
                                             </tr>
                                             <tr>
                                                <th><label>Amount Due (£)</label></th>
                                                <td width="9%"><?php echo ($total - $pay_total) ; ?></td>
                                             </tr>
                                             <tr>
                                                <?php  $paymentTime=$paymentDueDateTime[0]; ?>
                                                <th colspan="2" style="text-align: center"><label >Payment Due Date & Time</label> : &nbsp;&nbsp; <?php echo date('d-M-Y',strtotime($paymentTime->paymentDue_date)).'      '.$paymentTime->paymentDueTime; ?></th>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td class="invoice-detail" align="left" valign="top">
                                          <table width="100%">
                                             <tr style="background-color: #E6E6E6;">
                                                <td style='    border: 1px solid rgba(62, 97, 167, 0.42);'>
                                                   <h4 style="color: #3A61B0;text-align: center;">BOOKING CONDITIONS</h4>
                                                </td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="invoice-detail" valign="top" align="left">
                                          <table width="100%">
                                             <tbody>
                                                <tr>
                                                   <td></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="invoice-detail" align="left" valign="top">
                                          <p>Please read these carefully as the person making this booking (either for him selves or for any other passenger) accepts all the below terms and conditions of <?php echo idToName('company','id',$companyId,'company_name'); ?>.</p>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="invoice-detail" align="left" valign="top">
                                          <h5 style="color: #3A61B0;">DEPOSITS & TICKETS ARE NEITHER REFUNDABLE NOR CHANGEABLE (Terms & Conditions May Apply).</h5>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="invoice-detail" align="left" valign="top">
                                          <p>
                                             Unless Specified, All the deposits paid and tickets purchased / issued are nonrefundable in case of cancellation or no show (Failure to arrive at departure airport on time) and non-changeable before or after departure (date change is not permitted). Once flights reserved, bookings / tickets are non?transferable to any other person means that name changes are not permitted. Issued Tickets are also not re?routable. If you are reserving the flight by making the advance partial payment (Initial deposit) then please note that fare/taxes may increase at any time without the prior notice. Its means the price is not guaranteed unless ticket is issued because airline / consolidator has right to increase the price due to any reason. In that case we will not be liable and passenger has to pay the fare/tax difference. We always recommend you to pay ASAP and get issue your ticket to avoid this situation. Furthermore if you will cancel your reservation due to any reason, then the paid deposit(s) will not be refunded.
                                          </p>
                                          <h5 style="color: #3A61B0;">CHECKING ALL FLIGTH DETIALS & PASSENGER NAME(S)</h5>
                                          <p>It is your responsibility to check all the details are correct i.e. Passenger names (are same as appearing on passport / travel docs), Travelling dates, Transit Time, Origin & Destination, Stop Over, Baggage Allowance and other flight information. Once the ticket is issued then no changes can be made.
                                          </p>
                                          <h5 style="color: #3A61B0;">PASSPORT, VISA & IMMIGRATION REQUIREMENTS</h5>
                                          <p>
                                             You are responsible for checking all these items like Passport, Visa (including Transit Visa) and other immigration requirements. You must consult with the relevant Embassy / Consulate, well before the departure time for the up to date information as requirements may change time to time. We regret, we can accept any liability of any transit visa and if you are refused the entry onto the flight or into any country due to failure on your part to carry the correct passport, visa or other documents required by any airline, authority or country.
                                          </p>
                                          <h5 style="color: #3A61B0;">RECONFIRMING RETURN/ONWARD FLIGHTS</h5>
                                          <p>It is your responsibility to RECONFIRM your flights at least 72 hours before your departure time either with your travel agent or the relevant Airline directly. The company will not be liable for any additional costs due to your failure to reconfirm your flights.</p>
                                          <h5 style="color: #3A61B0;">INSURANCE AND BAGGAGE LOSS</h5>
                                          <p>We recommend that you purchase travel insurance. It is your responsibility to ensure you have valid travel insurance that covers your needs and also ensure that you have complied with all the health and vaccination requirements for the countries you are travelling Advice can be obtained from your GP or travel clinic. We don't accept any claim for the lost / Stolen / Damaged Baggage. You have to contact the relevant airline directly in that case.</p>
                                          <h5 style="color: #3A61B0;">SPECIAL REQUESTS AND MEDICAL PROBLEMS</h5>
                                          <p>If you have any special requests like meal preference, Seat Allocation and wheel chair request etc, please advise us at time of issuance of ticket. We will try our best to fulfill these by passing this request to relevant airline but we cannot guarantee and failure to meet any special request will not held us liable for any claim.
                                          </p>
                                          <?php if($companyId==1){ ?>
                                          <h5 style="color: #3A61B0;">BOOKING CANCELLATION POLICY</h5>
                                          <p>If your plan has been cancelled due to some reasons then please send us on email with proper reason and also accept & Acknowledge liability for cancellation. A cancellation fee penalty is imposed by us which is 75 GBP.</p>
                                          <?php } ?>
                                          <h5 style="color: #3A61B0;">VERY IMPORTANT:</h5>
                                          <p><?php echo idToName('company','id',$companyId,'company_name'); ?>  do not accept responsibility for any financial loss if the airline fails to operate. Passengers will be solely responsible for that so it is highly recommended that separate travel insurance must be arranged to protect yourself.</p>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td class="invoice-detail" align="center" valign="top">
                                          <table width="100%">
                                             <tr>
                                                <td><label style="color:#003399;font-size: 20px;">Thanks & Regards,</label></td>
                                             </tr>
                                             <tr>
                                                <td class="invoice-detail"><br><br><br></td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <table style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#3399ff;font-size:16px;font-family:Arial;color:rgb(58,54,55);margin-bottom:5px" width="473" cellspacing="0" cellpadding="0">
                                                      <tbody>
                                                         <tr>
                                                            <td style="text-align:initial">
                                                               <span style="padding: 0px 15px 0px 5px; border-bottom: 3px solid #003399;">
                                                               <font size="6" color="#333333"><?php echo $agenetName; ?>
                                                               </font>
                                                               <font size="1">Travel Consultant,</font>
                                                               <span style="font-size:13px">&nbsp;<?php echo idToName('company','id',$companyId,'company_name'); ?></span> 
                                                               </span>
                                                            </td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <table width="473">
                                                      <tr>
                                                         <td width="20%" valign="top">
                                                         </td>
                                                         <td width="50%" valign="top">
                                                            <table width="100%">
                                                               <tr>
                                                                  <td valign="top">
                                                                     <strong style="color:#003399">
                                                                     <?php echo $agenetName; ?> Line:&nbsp;
                                                                     </strong>
                                                                  </td>
                                                                  <td valign="top">                
                                                                     <?php echo $AgentLine; ?>
                                                                  </td>
                                                               </tr>
                                                               <tr>
                                                                  <td valign="top"><strong style="color:#003399">Office Line:&nbsp;</strong></td>
                                                                  <td valign="top"><?php echo $directLineOffice; ?></td>
                                                               </tr>
                                                               <tr>
                                                                  <td valign="top"><strong style="color:#003399">Email:&nbsp;</strong></td>
                                                                  <td valign="top"><a href="mailto:<?php echo $agentEmail; ?>"><?php echo $agentEmail; ?></a></td>
                                                               </tr>
                                                               <tr>
                                                                  <td valign="top"><strong style="color:#003399">Website:&nbsp;</strong></td>
                                                                  <td valign="top"><a href="<?php echo $webSite; ?>" target="_blank"><?php echo $webSite; ?></a></td>
                                                               </tr>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                   </table>
                                                </td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td align="center" style="padding-bottom: 20px;">
                                 <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                       <td class="invoice-detail" align="center" valign="top">
                                          <table width="100%">
                                             <tr>
                                                <td>===============================================================================================
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <p>
                                                      The information contained in this email is intended for the named recipient only. It may contain confidential information. If you are not the intended recipient, you must not copy, distribute or take any action in reliance on it. Please note that neither <?php echo idToName('company','id',$companyId,'company_name'); ?> nor the sender accepts any responsibility for viruses and it is your Responsibility to scan attachments (if any).E-mail is an informal method of communication and is subject to possible data corruption, either accidentally or On purpose. <?php echo idToName('company','id',$companyId,'company_name'); ?> is unable to exercise control over the content of information contained in transmissions made via the internet. For these reasons it will normally be inappropriate to rely on information contained in transmissions made via the internet without obtaining written confirmation of it.  Copyright in this email and in any attachments to it that have been created by <?php echo idToName('company','id',$companyId,'company_name'); ?> exclusively, in respect of which all rights are expressly reserved.
                                                   </p>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>===============================================================================================
                                                </td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
</div>