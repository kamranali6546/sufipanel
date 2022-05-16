<style type="text/css">
table tbody th, table.dataTable tbody td {
    text-align: center !important;
}
table thead th, table.dataTable thead td {
    text-align: center !important;
}
    .left_col, .nav_menu {
        display: none !important;
    }
   table.tablColor tbody tr td a:hover {
      text-decoration: underline !important;
  }
    .right_col {
        margin-left: 0 !important;
        background: #fff !important;
    }
    body {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    }
    table tr td a:visited {
    color: #0d7cbf !important;
}
</style>
<title>Gross Profit Report</title>
<div class="" role="main" style="padding: 10px;">
    <div class="page-title">
        <div class="title_left">
          <h3>Gross Profit Sheet</h3>
        </div>
        <div class="title_right"> 
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-10">
            <p class="text-black" style="font-size:15px;">From: &nbsp;&nbsp;<b><?php echo date('F ,d ,Y',  strtotime($reportCondition['startDate'])); ?></b>&nbsp;&nbsp;&nbsp; To:&nbsp;&nbsp;<b><?php echo date('F ,d ,Y',  strtotime($reportCondition['endDate'])); ?></b></p>
        </div>
        <div class="col-md-2 text-right">
          <span class="text-black" style="font-size:15px;">
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
          </span>
        </div>
    </div>
    <div class="row text-black">
        <div class="col-md-10">
            <span style="font-size:15px;">Brand Name:  <b><span style="font-weight: 700;"><?php if(!empty($reportCondition['brand'])){ echo  idToName('company','id',$reportCondition['brand'],'company_name'); } else{ echo "All"; } ?></span></b></span>
        </div>
        <div class="col-md-2 text-right">
          <span style="font-size:15px;"><?php echo date('F, d , Y '); ?></span>
        </div>
    </div>
    <div class="row text-black">
        <div class="col-md-10">
            <span style="font-size:15px;">Agent Name: <span style="font-weight: 700;"><?php if(!empty($reportCondition['agentId'])){ echo  idToName('admin','id',$reportCondition['agentId'],'login_name'); } else{ echo 'All'; } ?></span></span>
        </div>
    </div>
    <div class="row text-black">
        <div class="col-md-10">
            <span style="font-size:15px;">Supplier Name: <span style="font-weight: 700;"><?php if( !empty($reportCondition['supplier'])){ echo $reportCondition['supplier']; } else{ echo "All"; } ?></span></span>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <h3>Issued Bookings:</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 table-responsive"> 
            <table id="example" class="display tablColor table text-center table-hover" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr class="text-center">
                        <th rowspan="2">Sr.#</th>
                        <th rowspan="2">Issue Date</th>
                        <th rowspan="2">File No.</th>
                        <th rowspan="2">Sup.Ref#</th>
                        <th rowspan="2">Customer Name</th>
                        <th rowspan="2">Dest.</th>
                        <th rowspan="2">Pax</th>
                        <th rowspan="2">GDS</th>
                        <th rowspan="2">Airline</th>
                        
                        <th rowspan="2">Segt.</th>
                        <th rowspan="2">Sale Price</th>
                        <th colspan="3" class="text-center"><?php echo idToName('company','id',$this->session->userdata('company'),'company_name'); ?> Own Cost</th>
                        <th rowspan="2" width="2%">Profit</th> 
                        <th rowspan="2">Agent</th> 
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <th>Additional</th>
                        <th>Total</th> 
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    $total_segments=0;
                    $customersReceives=0;
                    $totalPayableSullpier=0;
                    $totalAdditionalCharges=0;
                    $toCost_grand=0;
                    $issuedTotal=0;
                    $totalPriceSale=0;
                     $passgerCount=0;
                           $segmentCoun=0;
                           $receiveCount=0;
                           $payableSupplier=0;
                           $additionalCharges=0.0;
                          
                           $total_ticket_cost=0;
                           $salePrice=0;
                           $profit_gross=0;
                    if(!empty($reportData))
                    {
                        $sr=0;
                        foreach($reportData as $objissuedObj)
                        {
                           $passgerCount=0;
                           $segmentCoun=0;
                           $receiveCount=0;
                           $payableSupplier=0;
                           $additionalCharges=0.0;
                          
                           $total_ticket_cost=0;
                           $salePrice=0;
                           $profit_gross=0;
                           $additionalCharges=  floatval(ticketChargesAditional($objissuedObj->id));
                          
                          $payableSupplier=ticketCost($objissuedObj->id);
                        //  echo  $additionalCharges.'              supplier===='.$payableSupplier.'     <br>';
//                           $receiveCount=round(totalreceivedAmount($objissuedObj->id),2);
                           //$receiveCount=sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$objissuedObj->id));
                           $receiveCount=paymentReceived($objissuedObj->id);
                           $passgerCount=countTotal('passanger_details',array('booking_id'=>$objissuedObj->id));
                           $segmentCoun=($objissuedObj->number_Of_segment*$passgerCount);
                           $total_segments=$total_segments+$segmentCoun;
                           $customersReceives=$customersReceives+$receiveCount;
                           $totalPayableSullpier=$totalPayableSullpier+$payableSupplier;
                           $totalAdditionalCharges=$totalAdditionalCharges+$additionalCharges;
                           $total_ticket_cost=  ($payableSupplier) + ($additionalCharges);
                          // echo  number_format($total_ticket_cost,2).'       <br>';
//                         echo round($total_ticket_cost,2);
                           $toCost_grand=$toCost_grand+$total_ticket_cost;
                            $salePrice= salePrice($objissuedObj->id);
                           $totalPriceSale=$totalPriceSale+$salePrice;
                           $profit_gross=($salePrice-$total_ticket_cost);
                           $issuedTotal=$issuedTotal+$profit_gross;
                           
                            ?>
                            <tr>
                                <td><?php echo ++$sr; ?></td>
                                <td><?php echo date('F,d,Y',  strtotime($objissuedObj->issue_date)); ?></td>
                                <td><a target="_blank" href="<?php echo site_url('BookingDetailBox/'.idencode($objissuedObj->id).'/'.idencode($objissuedObj->flag)) ?>"><?php echo idToName('company','id',$objissuedObj->company,'company_Code').'-'.$objissuedObj->id ?></a></td>
                                <td><?php echo substr($objissuedObj->supplier_ref,0,10); ?></td>
                                <td><?php echo substr($objissuedObj->fullname,0,10); ?></td>
                                <td><?php echo substr($objissuedObj->destination,0,3); ?></td>
                                <td><?php echo countTotal('passanger_details',array('booking_id'=>$objissuedObj->id)); ?></td>
                                <td><?php echo $objissuedObj->gds; ?></td>
                                <td><?php echo substr($objissuedObj->airline,0,2); ?></td>
                                
                                <td><?php echo $segmentCoun; ?></td>
                                <td><?php echo $salePrice; ?></td>
                                <td><?php echo number_format($payableSupplier,2); ?></td>
                                <td><?php echo number_format($additionalCharges,2); ?></td>
                                <td><?php echo number_format($total_ticket_cost,2);  ?></td>
                                <td><?php echo number_format($profit_gross,2); ?></td>
                                <td><?php echo idToName('admin','id',$objissuedObj->booked_agent_id,'login_name'); ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <tr>
                            <td colspan="5"></td>
                            <td style="color: red;font-size: 14px;font-weight: 600;">Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo $total_segments; ?></td>
                            <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo number_format($totalPriceSale,2); ?></td>
                            <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo number_format($totalPayableSullpier,2); ?></td>
                            <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo number_format($totalAdditionalCharges,2);  ?></td>
                            <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo number_format($toCost_grand,2); ?></td>
                            <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo number_format($issuedTotal,2); ?></td>
                            <td></td>
                        </tr>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div><br><br>
    <div class="row">
        <div class="col-md-12">
            <h3>Canceled Bookings:</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 table-responsive"> 
            <table id="example" class="display tablColor text-center table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="2">Sr.#</th>
                        <th rowspan="2">Cancel Date</th>
                        <th rowspan="2">File No.</th>
                        <th rowspan="2">File Status</th>
                        <th rowspan="2">Customer Name</th>
                        <th rowspan="2">Dest.</th>
                        <th rowspan="2" class="text-center">Pax</th>
                        <th rowspan="2">Rcved. From Customer</th>
                        <th colspan="4" class="text-center"><?php echo idToName('company','id',$this->session->userdata('company'),'company_name'); ?>  Own Cost</th>
                        <th rowspan="2">Profit</th> 
                        <th rowspan="2">Agent</th> 
                    </tr>
                    <tr>
                        <th>Rfd to cust.</th>
                        <th>CHBK+PK cost</th>
                        <th>Additional</th> 
                        <th>Total</th>
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
                           $amountGotoCustomer=0;
//                           $amountGotoCustomer=getQueryRes('payment','amount',array('pay_to'=>'Customer','pay_type'=>'Dr','booking_ref'=>$cancleObj->id));
                           $amountGotoCustomer=getQueryRes('select  sum(amount) as total  from payment  where booking_ref='.$cancleObj->id.' AND pay_type="Dr" AND pay_to="Customer" AND payment_nature!="expense"  AND payment_nature!="supplier" AND pay_by!="Profit & Loss on Cancellations-UK" ');
//                           $receiveCount_cancel=totalreceivedAmount($cancleObj->id);
                           //$receiveCount_cancel=(sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$cancleObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$cancleObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) +sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$cancleObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$cancleObj->id)));
                           $receiveCount_cancel=paymentReceived($cancleObj->id)+cardPaymentSum($cancleObj->id);
                           $passgerCount_cancel=countTotal('passanger_details',array('booking_id'=>$cancleObj->id));
                           $segmentCoun_cancel=($cancleObj->number_Of_segment*$passgerCount_cancel);
                           $refendAmount=$amountGotoCustomer;
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
                        <td><?php echo date('F,m,Y', strtotime($cancleObj->cancel_date)); ?></td>
                        <td><a target="_blank" href="<?php echo site_url('BookingDetailBox/'.idencode($cancleObj->id).'/'.idencode($cancleObj->flag)) ?>"><?php echo idToName('company','id',$cancleObj->company,'company_Code').'-'.$cancleObj->id; ?></a></td>
                        <td><?php echo fileStatus($cancleObj->file_status); ?></td>
                        <td><?php echo substr($cancleObj->fullname,0,10); ?></td>
                        <td><?php echo substr($cancleObj->destination,0,3); ?></td>
                        <td><?php echo $passgerCount_cancel;  ?></td>
                        <td><?php echo $receiveCount_cancel;  ?></td>
                        <td><?php echo $refendAmount; ?></td>
                        <td><?php echo $chargeBackAndPlenty;  ?></td>
                        <td><?php echo $additionalCharges_cancel;  ?></td>
                        <td><?php echo $total_ticket_cost_cancel;  ?></td>
                        <td><?php echo $profit_gross_cancel; ?></td>
                        <td><?php echo idToName('admin','id',$cancleObj->booked_agent_id,'login_name');  ?></td>
                    </tr>
                            <?php 
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                        <td style="color: red;font-size: 14px;font-weight: 600;">Total</td>
                        <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo $total_segments_cancel; ?></td>
                        <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo $customersReceives_cancel; ?></td>
                        <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo $refendAmount_total; ?></td>
                        <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo $chargeBackAndPlenty_total; ?></td>
                        <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo number_format($totalAdditionalCharges_cancel,2); ?></td>
                        <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo number_format($toCost_grand_cancel,2); ?></td>
                        <td style="color: red;font-size: 14px;font-weight: 600;"><?php echo number_format($cancelTotal,2); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="10"></td>
                        <td style="color: green;font-size: 14px;font-weight: 600;">Grand Total</td>
                        <td style="color: green;font-size: 14px;font-weight: 600;"><?php  ?></td> 
                        <td style="color: green;font-size: 14px;font-weight: 600;"><?php  echo number_format(($issuedTotal+$cancelTotal),2); ?></td> 
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<!--    <div class="row">
        <div class="col-md-12">
            <form id="ReportForm" method="post" onsubmit="return marginSheetGet()">
                <input type="hidden" name="issuedData" value="<?php print base64_encode(serialize($reportData)); ?>" >
                <input type="hidden" name="cancelData" value="<?php print base64_encode(serialize($reportDataCancelData)); ?>" >
                <input type="hidden" name="reportCondation" value="<?php print base64_encode(serialize($reportCondition)); ?>">
                <button type="button" onclick="marginSheetGet()" class="btn btn-primary btn-round pull-right">Download</button>
            </form>
        </div>
    </div>-->
</div>