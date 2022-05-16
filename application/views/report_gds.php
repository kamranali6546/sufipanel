<html xmlns="http://www.w3.org/1999/xhtml">
   <script type="text/javascript" charset="utf-8" id="zm-extension" src="chrome-extension://fdcgdnkidjaadafnichfpabhfomcebme/scripts/webrtc-patch.js" async=""></script>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>GDS Report</title>
      <style type="text/css">
         body {
         margin-left: 20px;
         margin-top: 20px;
         margin-right: 20px;
         margin-bottom: 20px;
         background: white;
         }
         body,td,th {
         font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
         }
          table.tablColor tbody tr td a {
      
      text-decoration: none !important;
      font-weight: bold !important;
  }
   table.tablColor tbody tr td a:hover {
      text-decoration: underline !important;
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
               <td width="76%" style="font-size: 24px; font-weight: bold;">GDS Report</td>
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
                <td>From:&nbsp;<b><?php echo date('F,d,Y',  strtotime($reportCondition['startDate'])); ?></b>&nbsp;&nbsp;&nbsp;To:&nbsp;<b><?php echo date('F,d,Y',  strtotime($reportCondition['endDate'])); ?></b></td>
               <td colspan="2" align="right"><?php echo date('F,d,Y'); ?></td>
            </tr>
            <tr>
                <td>Brand Name:&nbsp;<b><?php if(!empty($reportCondition['brand'])){ echo  idToName('company','id',$reportCondition['brand'],'company_name'); } else{ echo "All"; } ?></b></td>
               <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td>GDS:&nbsp;<b><?php if(!empty($reportCondition['gds'])){ echo $reportCondition['gds']; } else{ echo "All"; } ?></b></td>
               <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
               <td colspan="3" style="font-weight: bold; padding-top:10px;" >&nbsp;</td>
            </tr>
            <tr>
               <td colspan="3">
                  <table class="table tablColor table-hover" width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px;">
                      <thead>
                        <tr>
                           <th class="text-center">Sr. No.</th>
                           <th class="text-center" width="8%"><span style="font-weight: bold">Issue Date</span></th>
                           <th class="text-center" width="12%"><span style="font-weight: bold">Brand Name</span></th>
                           <th class="text-center" width="8%">Booking Ref No.</th>
                           <th class="text-center" width="12%">Customer Name</th>
                           <th class="text-center" width="8%">GDS</th>
                           <th class="text-center" width="6%"><span style="font-weight: bold">Dest.</span></th>
                           <th class="text-center" width="6%">Airline</th>
                           <th class="text-center" width="7%"><span style="font-weight: bold">PNR</span></th>
                           <th class="text-center" width="4%"><span style="font-weight: bold">Pax</span></th>
                           <th class="text-center" width="3%">Seg.</th>
                           <th class="text-center" width="6%">Total Seg.</th>
                           <th class="text-center" width="9%">E-Ticket No.</th>
                           <th class="text-center" width="7%">Ticket Cost</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php  if(!empty($customerRemaingBalance)){
                                    $sr=0;
                                    $totalLeftBalance=0;
                                    $totalPax=0;
                                    $totalSegment=0;
                                    $perpassangerSeg=0;
                                    foreach($customerRemaingBalance as $leftbalanceObj)
                                    {
                                        $saleprice=0;
                                        $amountRece=0;
                                        $ticketCost=0;
                                        $additionalCharges=0;
                                        $leftBalce=0;
                                        $passgerCount=0;
                                        $additionalCharges=(round(ticketCharges($leftbalanceObj->id),2)+round(ticketChargesAditional($leftbalanceObj->id),2));
                                        $payableSupplier=round(ticketCost($leftbalanceObj->id),2);
                                        $ticketCost=($additionalCharges+$payableSupplier);
                                        $saleprice=salePrice($leftbalanceObj->id);
                                        $amountRece=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$leftbalanceObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$leftbalanceObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$leftbalanceObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$leftbalanceObj->id));
                                        $leftBalce=($saleprice-$amountRece);
                                        $passgerCount=countTotal('passanger_details',array('booking_id'=>$leftbalanceObj->id));
                                        $totalLeftBalance=$totalLeftBalance+$ticketCost;
                                         $sementCount=($leftbalanceObj->number_Of_segment*$passgerCount);
                                         $totalPax=$totalPax+$passgerCount;
                                         $totalSegment=$totalSegment+$sementCount;
                                         $perpassangerSeg=$perpassangerSeg+$leftbalanceObj->number_Of_segment;
                                         $encodeData=idencode($leftbalanceObj->id);
                                            
                                            ?>
                                        <tr>
                                           <td width="4%" height="20" align="center">
                                              <?php echo  $sr++; ?>
                                           </td>
                                           <td width="8%" align="center">
                                              <?php echo date('F,d,Y',($leftbalanceObj->issue_date)); ?>
                                           </td>
                                           <td width="12%" align="center">
                                               <?php echo idToName('company','id',$leftbalanceObj->company,'company_name');?>
                                           </td>
                                           <td align="center">
                                               <a target="_blank" href="<?php echo base_url('BookingDetailBox/'.$encodeData.'/'.idencode($leftbalanceObj->flag)); ?>"><?php echo idToName('company','id',$leftbalanceObj->company,'company_Code').'-'.$leftbalanceObj->id ?></a>
                                           </td>
                                           <td align="left">
                                               <?php echo substr($leftbalanceObj->fullname,0,20); ?>
                                           </td>
                                           <td align="center">
                                               <?php echo $leftbalanceObj->gds; ?>
                                           </td>
                                           <td align="center">
                                                 <?php echo substr($leftbalanceObj->destination,0,3); ?>
                                           </td>
                                           <td align="center">
                                                <?php echo substr($leftbalanceObj->airline,0,2); ?>
                                           </td>
                                           <td align="center">
                                              <?php echo $leftbalanceObj->pnr; ?>
                                           </td>
                                           <td align="center">
                                               <?php echo $passgerCount; ?>
                                           </td>
                                           <td align="center">
                                              <?php echo $leftbalanceObj->number_Of_segment; ?>
                                           </td>
                                           <td align="center">
                                               <?php echo $sementCount; ?>
                                           </td>
                                           <td align="center">
                                               <?php echo substr(eTickets($leftbalanceObj->id),0,20); ?>
                                           </td>
                                           <td align="center">
                                              <?php echo number_format($ticketCost,2); ?>
                                           </td>
                                        </tr>
                                    <?php 
                                        
                                     }
                                 } ?>
                         
                        <tr>
                           <td height="3" colspan="14" style="border-bottom: 2px solid #EBEBEB;"></td>
                        </tr>
                        <tr>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;">Total:</td>
                           <td align="center">&nbsp;</td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;"><?php echo $totalPax; ?></td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;"><?php echo $perpassangerSeg; ?></td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;"><?php echo $totalSegment; ?></td>
                           <td align="center">&nbsp;</td>
                           <td align="center" height="30" class="text-red font-weight-bold" style="font-size: 14px;"><?php echo number_format($totalLeftBalance,2); ?></td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td colspan="3">&nbsp;</td>
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