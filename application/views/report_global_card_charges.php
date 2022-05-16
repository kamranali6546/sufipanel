<html xmlns="http://www.w3.org/1999/xhtml">
   <script type="text/javascript" charset="utf-8" id="zm-extension" src="chrome-extension://fdcgdnkidjaadafnichfpabhfomcebme/scripts/webrtc-patch.js" async=""></script>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Global Card Charges</title>
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
      color: #009fff !important;
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
               <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
               <td width="75%" style="font-size: 24px; font-weight: bold;">Global Card Charges</td>
               <td width="25%" align="right" style="font-weight: bold;"><b>
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
                <td>Start Date:&nbsp;<b><?php echo date('F,d,Y',strtotime($reportCondition['startDate'])); ?> </b></td>
               <td colspan="2" align="right"><?php echo date('F,d,Y'); ?></td>
            </tr>
            <tr>
                <td>End Date:&nbsp;<b><?php echo date('F,d,Y',strtotime($reportCondition['endDate'])); ?></b></td>
               <td align="right">&nbsp;</td>
            </tr>
            <tr>
               <td colspan="2" style="font-weight: bold; padding-top:20px;">&nbsp;</td>
            </tr>
            <tr>
               <td colspan="2">
                   <?php //print_r($globlCardReport); ?>
                  <table class="table tablColor table-hover" width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px;">
                      <thead>
                        <tr>
                           <th class="text-center" width="4%">Sr.#</th>
                           <th class="text-center" width="7%">Date</th>
                           <th class="text-center" width="10%">Bkg Ref.</th>
                           <th class="text-center" width="10%">Trans. Head</th>
                           <th class="text-center" width="20%">Note</th>
                           <th class="text-center" width="8%">Type</th>
                           <th class="text-center" width="12%">Amount (£)</th>
                           <th class="text-center" width="8%">Charges (£)</th>
                           <th class="text-center" width="40%">Receivable (£)</th>
                        </tr>
                       </thead>
                       <tbody>
                           <?php if(!empty($globlCardReport)){ 
//                               echo "<pre>";
//                               print_r($globlCardReport);
//                               echo "</pre>";
                               $sr=1;
                               $totalAmount=0;
                               $totalCharges=0;
                               $totalReceivable=0;
                               $refundedAmount=0;
                               
                               foreach($globlCardReport as $obj){
                                   $totalAmount=($totalAmount+$obj->amount);
                                   $totalCharges=($totalCharges+$obj->card_charges);
                                   
                                    $encodeData=idencode($obj->id);
                                    if($obj->pay_type=='Cr'){
                                       $refundedAmount=($refundedAmount+ $obj->amount);
                                    }
                                    else
                                    {
                                        $totalReceivable=($totalReceivable + ( ($obj->amount - $obj->card_charges)));
                                    }
                               ?>
                           
                                <tr>
                                   <td height="20" align="center">
                                      <?php echo $sr++; ?>
                                   </td>
                                   <td align="center">
                                      <?php echo date('F,d,Y',strtotime($obj->pay_date)); ?>
                                   </td>
                                   <td align="center">
                                      <a  target="_blank" href="<?php echo base_url('BookingDetailBox/'.$encodeData.'/'.idencode($obj->flag)); ?>"><?php echo idToName('company','id',$obj->company,'company_Code').'-'.$obj->id ?></a>
                                   </td>
                                   <td align="center">
                                       Global Card Charges
                                       <?php //echo $obj->pay_to; ?>
                                   </td>
                                   <td align="left">
                                      <?php echo $obj->description; ?>
                                   </td>
                                   <td align="center">
                                      <?php if($obj->pay_type=='Dr'){ ?> Receipt <?php } else{ ?> Refund <?php }?>
                                   </td>
                                   <td align="center">
                                      <?php echo $obj->amount; ?>
                                   </td>
                                   <td align="center">
                                       <?php echo $obj->card_charges; ?>
                                   </td>
                                   <td align="center">
                                       <?php
                                         if($obj->pay_type=='Dr'){  echo number_format(($obj->amount -$obj->card_charges),2); } else{ echo '-'.number_format(($obj->amount -$obj->card_charges),2);  }  
                                      ?>
                                   </td>
                                </tr>
                           <?php } } ?>
                        <tr>
                           <td height="3" colspan="9" style="border-bottom: 2px solid #EBEBEB;"></td>
                        </tr>
                        <tr>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;">Total:</td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;"><b><span>Amount-Refund=Receipt</span> <br><?php echo '('.$totalAmount.'-'.$refundedAmount.')'; ?></b>=<?php echo $afterRefundDetuct=number_format($totalAmount-$refundedAmount,2); ?></td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;"><b><span>Charges</span> <br><?php echo number_format($totalCharges,2); ?></b></td>
                           <td align="center" class="text-red font-weight-bold" style="font-size: 14px;"><b><span>Receipt-Charges-Refund=Receivable</span> <br><?php echo '('.$afterRefundDetuct.'-'.number_format($totalCharges,2).'-'.$refundedAmount.')'; ?>=<?php echo number_format(($afterRefundDetuct - $totalCharges -$refundedAmount),2); ?></b></td>
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