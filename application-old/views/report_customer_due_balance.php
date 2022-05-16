<html xmlns="http://www.w3.org/1999/xhtml">
   <script type="text/javascript" charset="utf-8" id="zm-extension" src="chrome-extension://fdcgdnkidjaadafnichfpabhfomcebme/scripts/webrtc-patch.js" async=""></script>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Customer Due Balance</title>
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
        .left_col, .nav_menu {
          display: none !important;
        }
        .right_col {
          margin-left: 0 !important;
        }
      </style>
   </head>
   <body>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tbody class="text-black">
            <tr>
               <th colspan="2" align="right">&nbsp;</th>
            </tr>
            <tr>
               <th style="font-weight: bold;"><h3><b>Customer Due Balance</b></h3></th>
               <th align="right" style="font-weight: bold;text-align: right;"><b>
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
                   </b></th>
            </tr>
             <tr>
                 <th class="text-black" style="font-size:15px;">From: &nbsp;&nbsp;<b><?php echo date('F,d,Y',strtotime($reportCondition['startDate'])); ?></b>&nbsp;&nbsp;&nbsp; To:&nbsp;&nbsp;<b><?php echo date('F,d,Y',strtotime($reportCondition['endDate'])); ?></b></th>
              <td align="right"><span style="font-size:15px;"><?php echo date('F,d,Y'); ?></span></td>
            </tr>
            <tr>
               <th style="font-size:15px;font-weight: normal;">Brand Name:&nbsp;<b> <?php if(!empty($reportCondition['brand'])){ echo  idToName('company','id',$reportCondition['brand'],'company_name'); } else{ echo "All"; } ?></b></th>
            </tr>
            <tr>
               <th style="font-size:15px;font-weight: normal;">Agent Name:&nbsp;<b><?php if(!empty($reportCondition['agentId'])){ echo  idToName('admin','id',$reportCondition['agentId'],'login_name'); } else{ echo 'All'; } ?></b></th>
               <th style="font-size:15px;" align="right"></th>
            </tr>
            <tr>
               <th style="font-size:15px;font-weight: normal;">Supplier Name:&nbsp;<b><?php if(!empty($reportCondition['supplier'])){ echo $reportCondition['supplier'];} else{ echo "All"; } ?></b></th>
               <th style="font-size:15px;" align="right"></th>
            </tr>
            <tr>
               <th colspan="2" style="font-weight: bold; padding-top:20px;"><h3>Issued Bookings</h3></th>
            </tr>
            <tr>
               <td colspan="2">
                  <table class="table tablColor table-hover" width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px;">
                      <thead>
                        <tr>
                           <th class="text-center" valign="middle">
                               Sr.<br>
                              No.
                           </th>
                           <th width="7%" class="text-center" valign="middle"> 
                               <span style="font-weight: bold">
                                   Issue<br>
                              Date</span>
                           </th>
                           <th width="9%" class="text-center" valign="middle"><span style="font-weight: bold">Agent<br>
                              Name
                              </span>
                           </th>
                           <th width="13%" class="text-center" valign="middle">
                               Brand
                           </th>
                           <th width="10%" class="text-center" valign="middle">
                               Booking<br>
                              Ref No.
                           </th>
                           <th width="9%" class="text-center" valign="middle">
                               Supplier Ref.
                           </th>
                           <th width="9%" class="text-center" valign="middle">
                               PNR
                           </th>
                           <th width="16%" class="text-center" valign="middle">
                               Customer Name
                           </th>
                           <th width="11%" class="text-center" valign="middle">
                               Balance Due
                           </th>
                           <th width="12%" class="text-center" valign="middle">
                               Profit
                           </th>
                        </tr>
                      </thead>
                       <tbody>
                            <?php  if(!empty($customerRemaingBalance)){
                                    $sr=0;
                                    $totalLeftBalance=0;
                                    foreach($customerRemaingBalance as $leftbalanceObj)
                                    {
                                        $saleprice=0;
                                        $amountRece=0;
                                        $ticketCost=0;
                                        $additionalCharges=0;
                                        $leftBalce=0;
                                        $additionalCharges=(round(ticketCharges($leftbalanceObj->id),2)+round(ticketChargesAditional($leftbalanceObj->id),2));
                                        $payableSupplier=round(ticketCost($leftbalanceObj->id),2);
                                        $ticketCost=($additionalCharges+$payableSupplier);
                                        $saleprice=salePrice($leftbalanceObj->id);
//                                        $amountRece=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$leftbalanceObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$leftbalanceObj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$leftbalanceObj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$leftbalanceObj->id));
                                         $amountRece=customerPayAmount($leftbalanceObj->id);
//                                        echo "shahid";
                                        $leftBalce=($saleprice-$amountRece);
                                        $passgerCount=countTotal('passanger_details',array('booking_id'=>$leftbalanceObj->id));
                                        if($leftBalce >0)
                                        {
                                         $totalLeftBalance=$totalLeftBalance+$leftBalce;
                                            $sr++;
                                            $encodeData=idencode($leftbalanceObj->id);
                                            ?>
                                            <tr>
                                               <td class="text-center" height="3" align="center">
                                                   <?php echo $sr; ?>
                                               </td>
                                               <td  class="text-center"height="3" align="center" >
                                                   <?php echo date('F,d,Y',strtotime($leftbalanceObj->issue_date)); ?>
                                               </td>
                                               <td  class="text-center"height="3" align="center" >
                                                  <?php echo  $agentName=idToName('admin','id',$leftbalanceObj->booked_agent_id,'login_name'); ?>
                                               </td>
                                               <td  class="text-center"height="3" align="center" >
                                                   <?php echo idToName('company','id',$leftbalanceObj->company,'company_name');?>
                                                   <?php //echo idToName('company','id',$leftbalanceObj->company,'company_Code');?>
                                               </td>
                                               <td  class="text-center"height="3" align="center" >
                                                   <a target="_blank" href="<?php echo base_url('BookingDetailBox/'.$encodeData.'/'.idencode($leftbalanceObj->flag)); ?>"><?php echo idToName('company','id',$leftbalanceObj->company,'company_Code').'-'.$leftbalanceObj->id ?></a>
                                               </td>
                                               <td  class="text-center"height="3" align="center" >
                                                  <?php echo substr($leftbalanceObj->supplier_ref,0,15); ?>
                                               </td>
                                               <td  class="text-center"height="3" align="center" >
                                                   <?php echo $leftbalanceObj->pnr; ?>
                                               </td>
                                               <td  class="text-center"height="3" align="center" >
                                                   <?php echo substr($leftbalanceObj->fullname,0,20); ?>
                                               </td>
                                               <td  class="text-center"height="3" align="center" >
                                                   <?php echo $leftBalce; ?>
                                               </td>
                                               <td  class="text-center"height="3" align="center" >
                                                  <?php echo number_format(($saleprice-$ticketCost),2); ?>
                                               </td>
                                            </tr>
                                    <?php 
                                        }
                                    }
                                } ?>
                        <tr>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;">Total:</td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;"><?php echo number_format($totalLeftBalance,2); ?></td>
                           <td height="30"  align="right"></td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td colspan="2">&nbsp;</td>
            </tr>
         </tbody>
      </table>
   </body>
</html>