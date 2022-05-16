<html xmlns="http://www.w3.org/1999/xhtml">
   <script type="text/javascript" charset="utf-8" id="zm-extension" src="chrome-extension://fdcgdnkidjaadafnichfpabhfomcebme/scripts/webrtc-patch.js" async=""></script>
   <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Net Profit - Travelelink</title>
      <style type="text/css">
      .tablColor>thead>tr>th, .tablColor>tbody>tr>th, .tablColor>tfoot>tr>th, .tablColor>thead>tr>td, .tablColor>tbody>tr>td, .tablColor>tfoot>tr>td {
    text-align: -webkit-center;}


         body {
         margin-left: 20px;
         margin-top: 20px;
         margin-right: 20px;
         margin-bottom:20px;
         background: white;
         }
   table.tablColor tbody tr td a:hover {
      text-decoration: underline !important;
  }
         body,td,th {
         font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
         }
          .left_col, .nav_menu {
        display: none !important;
    }
    .right_col {
        margin-left: 0 !important;
    }
      </style>
   </head>
   <body>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 10px;font-size: 15px;">
         <tbody class="text-black">
            <tr>
               <td colspan="3" align="right">&nbsp;</td>
            </tr>
            <tr>
               <td width="67%" style="font-size: 24px; font-weight: bold;">Net Profit Sheet</td>
               <td colspan="2" align="right" style="font-weight: bold;"><b>
                    <?php
                    if (strpos(base_url(), 'sufi') !== false) 
                      {
                         echo 'Sufi Travels';
                      }
                      else if(strpos(base_url(), 'bright') !== false)
                      {
                         echo "Bright Holiday"; 
                      }
                ?>
                   </b></td>
            </tr>
            <tr>
                <td>From:&nbsp;<b><?php echo date('F,d,Y',strtotime($reportCondition['startDate'])); ?></b>&nbsp;&nbsp;&nbsp;To:&nbsp;<b><?php echo date('F,d,Y',strtotime($reportCondition['endDate'])); ?></b></td>
               <td colspan="2" align="right"><?php echo date('F,d,Y'); ?></td>
            </tr>
            <tr>
                <td>Brand Name:&nbsp;<b><?php if(!empty($reportCondition['brand'])){ echo  idToName('company','id',$reportCondition['brand'],'company_name'); } else { ?> All <?php } ?></b></td>
               <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td>Agent Name:&nbsp;<b><?php if(!empty($reportCondition['agentId'])){ echo  idToName('admin','id',$reportCondition['agentId'],'login_name'); } else{ ?> All <?php } ?></b></td>
               <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td>Supplier Name:&nbsp;<b><?php if(!empty($reportCondition['supplier'])){ echo $reportCondition['supplier']; } else{ ?> All <?php } ?></b></td>
               <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr> 
               <td colspan="3" style="font-weight: bold; padding-top:20px;"><h3>Issued Bookings</h3></td>
            </tr>
            <tr>
               <td colspan="3">
                  <table class="table tablColor table-hover" width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px;">
                     <thead>
                        <tr>
                           <th class="text-center" rowspan="2">Sr.No.</th>
                           <th class="text-center" width="8%" rowspan="2"> <span style="font-weight: bold">Issue Date</span></th>
                           <th class="text-center" width="9%" rowspan="2"><span style="font-weight: bold">Agent Name </span></th>
                           <th class="text-center" width="8%" rowspan="2">Booking Ref No.</th>
                           <th class="text-center" width="22%" rowspan="2">Customer Name</th>
                           <th class="text-center" width="4%" rowspan="2">Segt.</th>
                           <th class="text-center" width="4%" rowspan="2">GDS</th>
                           <th class="text-center" width="4%" rowspan="2"><span style="font-weight: bold">Dest.</span></th>
                           <th class="text-center" width="4%" rowspan="2"><span style="font-weight: bold">Pax</span></th>
                           <th class="text-center" width="5%" rowspan="2">Airline</th>
                           <th class="text-center" width="8%" rowspan="2"><span style="font-weight: bold">Sale</span> Price</th>
                           <th class="text-center" colspan="3"> Cost</th>
                           <th class="text-center" width="9%" rowspan="2">Profit</th>
                        </tr>
                        <tr>
                           <th class="text-center" width="7%">Supplier</th>
                           <th class="text-center" width="6%">Additional</th>
                           <th class="text-center" width="6%">Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php //print_r($reportData);
                       // print_r($reportDataCancelData);
                        $total_segments=0;
                        $customersReceives=0;
                        $totalPayableSullpier=0;
                        $totalAdditionalCharges=0;
                        $toCost_grand=0;
                        $issuedTotal=0;
                        $totalPriceSale=0;
                        if(!empty($reportData))
                    {
                        $sr=1;
                        foreach($reportData as $objissuedObj)
                        {
                           $passgerCount=0;
                           $segmentCoun=0;
                           $receiveCount=0;
                           $payableSupplier=0;
                           $additionalCharges=0;
                           $total_ticket_cost=0;
                           $salePrice=0;
                           $profit_gross=0;
                           $additionalCharges=(ticketCharges($objissuedObj->id)+ticketChargesAditional($objissuedObj->id));
                           $payableSupplier=ticketCost($objissuedObj->id);
//                           $receiveCount=round(totalreceivedAmount($objissuedObj->id),2);
                           $receiveCount=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id))+sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id));                         
                           $passgerCount=countTotal('passanger_details',array('booking_id'=>$objissuedObj->id));
                           $segmentCoun=($objissuedObj->number_Of_segment*$passgerCount);
                           $total_segments=$total_segments+$segmentCoun;
                           $customersReceives=$customersReceives+$receiveCount;
                           $totalPayableSullpier=$totalPayableSullpier+$payableSupplier;
                           $totalAdditionalCharges=$totalAdditionalCharges+$additionalCharges;
                           $total_ticket_cost=($additionalCharges + $payableSupplier);
//                         echo round($total_ticket_cost,2);
                           $toCost_grand=$toCost_grand+$total_ticket_cost;
                           $salePrice=salePrice($objissuedObj->id);
                           $totalPriceSale=$totalPriceSale+$salePrice;
                           $profit_gross=($salePrice-$total_ticket_cost);
                           $issuedTotal=$issuedTotal+$profit_gross;
                           
                        ?>
                        <tr>
                           <td width="4%" height="20"><?php echo $sr++; ?></td>
                           <td width="8%"><?php echo date('F,d,Y',strtotime($objissuedObj->issue_date)); ?></td>
                           <td width="9%"><?php echo idToName('admin','id',$objissuedObj->booked_agent_id,'login_name'); ?></td>
                           <td width="8%">
                               <a target="_blank" href="<?php echo site_url('BookingDetailBox/'.idencode($objissuedObj->id).'/'.idencode($objissuedObj->flag)) ?>"><?php echo idToName('company','id',$objissuedObj->company,'company_Code').'-'.$objissuedObj->id ?></a>
                           </td>
                           <td align="left"><?php echo substr($objissuedObj->fullname,0,10); ?></td>
                           <td><?php echo $segmentCoun; ?></td>
                           <td><?php echo $objissuedObj->gds; ?></td>
                           <td><?php echo substr($objissuedObj->destination,0,3); ?></td>
                           <td><?php echo countTotal('passanger_details',array('booking_id'=>$objissuedObj->id)); ?></td>
                           <td><?php echo substr($objissuedObj->airline,0,2); ?></td>
                           <td><?php echo $salePrice; ?></td>
                           <td><?php echo number_format($payableSupplier, 2); ?></td>
                           <td><?php echo number_format($additionalCharges,2); ?></td>
                           <td><?php echo number_format($total_ticket_cost,2);  ?></td>
                           <td width="9%"><?php echo number_format($profit_gross,2); ?></td>
                        </tr>
                    <?php }} ?>
                        <tr>
                           <td height="3" colspan="13" style="border-bottom: 2px solid #EBEBEB;"></td>
                        </tr>
                        <tr>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td style="color:red;"><b>Total</b>:</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td style="color:red;"><?php echo number_format($totalPriceSale,2); ?></td>
                           <td style="color:red;"><?php echo number_format($totalPayableSullpier,2); ?></td>
                           <td style="color:red;"><?php echo number_format($totalAdditionalCharges,2);  ?></td>
                           <td style="color:red;"><?php echo number_format($toCost_grand,2); ?></td>
                           <td style="color:red;" height="30"><?php echo number_format($issuedTotal,2); ?></td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td colspan="3" style="font-weight: bold; padding-top:20px;"><h3>Cancelled Bookings</h3> </td>
            </tr>
            <tr>
               <td colspan="3">
                  <table class="tablColor" width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px;">
                     <thead>
                        <tr>
                           <th class="text-center">Sr. No.</th>
                           <th class="text-center" width="8%"><span style="font-weight: bold">Cancellation Date</span></th>
                           <th class="text-center" width="9%"><span style="font-weight: bold">Agent Name </span></th>
                           <th class="text-center" width="8%"><span style="font-weight: bold">Booking Ref No.</span></th>
                           <th class="text-center" width="22%">Customer Name</th>
                           <th class="text-center" width="6%">Pax</th>
                           <th class="text-center" width="6%"><span style="font-weight: bold">Dest.</span></th>
<!--                           <th class="text-center" width="0%"></th>
                           <th class="text-center" width="0%"></th>-->
                           <th class="text-center" width="9%"> Rcved. From Customer</th>
                           <th class="text-center" width="10%"><span style="font-weight: bold">Refund To Customer</span></th>
                           <th class="text-center" width="8%">Supplier  Cost</th>
                           <th class="text-center" width="7%">Additional Exp.<span style="font-weight: bold"></span></th>
                           <th class="text-center" width="9%">Profit</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                    $total_segments_cancel=0;
                    $customersReceives_cancel=0;
                    $totalPayableSullpier_cancel=0;
                    $totalAdditionalCharges_cancel=0;
                    $toCost_grand_cancel=0;
                    $cancelTotal=0;
                    $refendAmount_total=0;
                    $chargeBackAndPlenty_total=0;
                    if(!empty($reportDataCancelData))
                    {
                        $can_sr=0;
                        foreach($reportDataCancelData as $cancleObj)
                        {
                           $passgerCount_cancel=0;
                           $segmentCoun_cancel=0;
                           $receiveCount_cancel=0;
                           $payableSupplier_cancel=0;
                           $additionalCharges_cancel=0;
                           $total_ticket_cost_cancel=0;
                           $profit_gross_cancel=0;
                           $refendAmount=0;
                           $chargeBackAndPlenty=0;
//                           if($cancleObj->file_status==6)
//                           {
//                              $additionalCharges_cancel=ticketChargesAditionalChargeBackOnly($cancleObj->id)+ticketCharges($cancleObj->id); 
//                           }
//                           else
//                           {
//                               $additionalCharges_cancel=ticketChargesAditionalChargeBack($cancleObj->id)+ticketCharges($cancleObj->id);
//                           }
                           
                               $additionalCharges_cancel=(ticketCharges($cancleObj->id)+ticketChargesAditional($cancleObj->id));
                         
                           $payableSupplier_cancel=ticketCost($cancleObj->id);
//                           $receiveCount_cancel=totalreceivedAmount($cancleObj->id);
                           $amountGotoCustomer=0;
                           $amountGotoCustomer=sumOfAmount('payment','amount',array('pay_to'=>'Customer','pay_type'=>'Dr','booking_ref'=>$cancleObj->id));
                           $receiveCount_cancel=(sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$cancleObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$cancleObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$cancleObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)));
                           $passgerCount_cancel=countTotal('passanger_details',array('booking_id'=>$cancleObj->id));
                           $segmentCoun_cancel=($cancleObj->number_Of_segment*$passgerCount_cancel);
                           $refendAmount=(refundSum($cancleObj->id)+$amountGotoCustomer);
                           $chargeBackAndPlenty=chargebackPlenty($cancleObj->id);
                           $refendAmount_total=$refendAmount_total+$refendAmount;
                           $total_segments_cancel=$total_segments_cancel+$passgerCount_cancel;
                           $customersReceives_cancel=$customersReceives_cancel+$receiveCount_cancel;
                           $totalPayableSullpier_cancel=$totalPayableSullpier_cancel+$payableSupplier_cancel;
                           $totalAdditionalCharges_cancel=$totalAdditionalCharges_cancel+$additionalCharges_cancel;
                           $total_ticket_cost_cancel=($additionalCharges_cancel+$chargeBackAndPlenty+$refendAmount);
                           $toCost_grand_cancel=$toCost_grand_cancel+$total_ticket_cost_cancel;
                           
                           $profit_gross_cancel=($receiveCount_cancel-$total_ticket_cost_cancel);
                           $cancelTotal=$cancelTotal+$profit_gross_cancel;
                           $chargeBackAndPlenty_total=$chargeBackAndPlenty_total+$chargeBackAndPlenty;
                            ?>
                    <tr>
                        <td><?php echo ++$can_sr; ?></td>
                        <td><?php echo $cancleObj->cancel_date; ?></td>
                        <td><?php echo idToName('admin','id',$cancleObj->booked_agent_id,'login_name');  ?></td>
                        <td><a target="_blank" href="<?php echo site_url('BookingDetailBox/'.idencode($cancleObj->id).'/'.idencode($cancleObj->flag)) ?>"><?php echo idToName('company','id',$cancleObj->company,'company_Code').'-'.$cancleObj->id; ?></a></td>
                        <td><?php echo substr($cancleObj->fullname,0,10); ?></td>
                        <td><?php echo countTotal('passanger_details',array('booking_id'=>$cancleObj->id)) ?></td>
                        <td><?php echo substr($cancleObj->destination,0,3); ?></td>
                        <td><?php echo $receiveCount_cancel;  ?></td>
                        <td><?php echo $refendAmount; ?></td>
                        <!--<td><?php echo $chargeBackAndPlenty;  ?></td>-->
                        <td><?php echo $additionalCharges_cancel;  ?></td>
                        <td><?php echo $total_ticket_cost_cancel;  ?></td>
                        <td><?php echo $profit_gross_cancel; ?></td>
                    </tr>
                            <?php 
                        }
                    }
                    ?>
                        <tr>
                           <td height="3" colspan="13" style="border-bottom: 2px solid #EBEBEB;"></td>
                        </tr>
                        <tr>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td style="color:red;">Total:</td>
                           <td></td>
                           <td></td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td style="color:red;" height="30"><?php  echo $cancelTotal; ?></td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
      <table class="text-black" align="center" width="95%" style="font-size: 14px !important;">
         <tbody>
            <tr>
               <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
               <td align="right" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td colspan="2" width="35%" align="left" style="font-weight:bold; font-size:16px;">Gross Profit:</td>
               <td width="9%" align="center" style="font-weight:bold; font-size:16px;"><?php  $grossP=$issuedTotal+$cancelTotal;  echo number_format($grossP, 2); ?></td>
            </tr>
            <tr>
               <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
               <td>&nbsp;</td>
               <td style="font-weight:bold; font-size:16px;">Less Expenditures:</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
            </tr>
            <tr>
               <td colspan="3">&nbsp;</td>
            </tr>
             <?php //print_r($monthlyExpenses); 
             if(!empty($monthlyExpenses))
            {
                 $expenseTotal=0;
                 foreach($monthlyExpenses as $expense){
                     $expenseTotal=$expenseTotal+$expense->amount;
             ?>
            <tr>
               <td>&nbsp;</td>
               <td style="font-weight:normal;"><?php echo $expense->pay_to; ?></td>
               <td align="center" style="font-weight:normal;">(<?php echo $expense->amount;  ?>)</td>
            </tr>
                 <?php } } ?>
           
            <tr>
               <td>&nbsp;</td>
               <td style="border-top: 1px solid;font-weight:bold; font-size:16px;color:red;">Total</td>
               <td align="center" style="border-top: 1px solid;font-weight:bold; font-size:16px;color:red;">- 
                 <?php echo number_format($expenseTotal,2);   ?>
               </td>
               <td>&nbsp;</td> 
            </tr>
            <tr>
               <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
               <td align="right" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td width="35%" colspan="2" align="left" style="font-weight:bold; font-size:16px;">Net Profit:</td>
               <td width="9%" align="center" style="font-weight:bold; font-size:16px;"><?php  $netPro=($grossP-$expenseTotal); echo number_format($netPro,2); ?></td>
            </tr>
            <tr>
               <td align="right" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td width="35%" colspan="2" align="left" style="font-weight:bold; font-size:16px;">Payable to Director</td>
               <td width="9%" align="center" style="font-weight:bold; font-size:16px;"><?php  $driectorAmount=(($netPro*10)/100); echo number_format($driectorAmount,2); ?></td>
            </tr>
            <tr>
               <td align="right" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td width="35%" colspan="2" align="left" style="font-weight:bold; font-size:16px;">Payable to Call Center</td>
               <td width="9%" align="center" style="font-weight:bold; font-size:16px;">
                  <?php echo '&pound;'.number_format(($netPro-$driectorAmount),2); ?>
               </td>
            </tr>
            <tr>
               <td align="right" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td width="35%" colspan="2" align="left" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td width="9%" align="center" style="font-weight:bold; font-size:16px;">&nbsp;</td>
            </tr>
            <tr>
               <td align="right" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td width="35%" colspan="2" align="left" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td width="9%" align="center" style="font-weight:bold; font-size:16px;">&nbsp;</td>
            </tr>
            
            <tr>
               <td align="right" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td width="35%" colspan="2" align="left" style="font-weight:bold; font-size:16px;">&nbsp;</td>
               <td width="9%" align="center" style="font-weight:bold; font-size:16px;">&nbsp;</td>
            </tr>
            <tr>
               <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
               <td colspan="3">&nbsp;</td>
            </tr>
         </tbody>
      </table>
   </body>
</html>