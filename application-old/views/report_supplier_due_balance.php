<html xmlns="http://www.w3.org/1999/xhtml">
   <script type="text/javascript" charset="utf-8" id="zm-extension" src="chrome-extension://fdcgdnkidjaadafnichfpabhfomcebme/scripts/webrtc-patch.js" async=""></script>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Supplier Due Balance</title>
      <style type="text/css">
         body {
         margin-left: 20px;
         margin-top: 20px;
         margin-right: 20px;
         margin-bottom: 20px;
         background: white;
         }
          body {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
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
      <table class="" style="font-size: 15px;" width="100%" border="0" cellpadding="0" cellspacing="0">
         <tbody class="text-black">
            <tr>
               <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
               <td width="75%" style="font-weight: bold;"><h3 class="font-weight-bold">Supplier Due Balance - Issued By <?php if(!empty($reportCondition['supplier'])){ echo $reportCondition['supplier']; } else{ echo "All"; } ?></h3></td>
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
                <td class="text-black" style="font-size:15px;">From: &nbsp;&nbsp;<b><?php echo date('F,d,Y',  strtotime($reportCondition['startDate'])); ?></b>&nbsp;&nbsp;&nbsp; To:&nbsp;&nbsp;<b><?php echo date('F,d,Y', strtotime($reportCondition['endDate'])); ?></b></td>
              <td align="right"><span style="font-size:15px;"><?php echo date('F,d,Y'); ?></span></td>
            </tr>
            <tr>
                <td colspan="2">Brand Name:&nbsp;<b><?php if(!empty($reportCondition['brand'])){ echo  idToName('company','id',$reportCondition['brand'],'company_name'); } else{ echo "All"; } ?></b></td>
               
            </tr>
            <tr>
                <td>Agent Name:&nbsp;<b><?php if(!empty($reportCondition['agentId'])){ echo  idToName('admin','id',$reportCondition['agentId'],'login_name'); } else{ echo "All"; } ?></b></td>
               <td align="right">&nbsp;</td>
            </tr>
            <tr>
                <td>Supplier Name:&nbsp;<b><?php if(!empty($reportCondition['supplier'])){ echo $reportCondition['supplier']; } else{ echo "All"; } ?></b></td>
               <td align="right">&nbsp;</td>
            </tr>
            <tr>
               <td colspan="2" style="font-weight: bold; padding-top:20px;">&nbsp;</td>
            </tr>
            <tr>
               <td colspan="2">
                  <table class="table tablColor table-hover" width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px;">
                     <thead>
                        <tr>
                           <th class="text-center">Sr.<br>
                              No.
                           </th>
                           <th class="text-center" width="8%"> <span style="font-weight: bold">Date</span></th>
                           <th class="text-center" width="16%">Brand</th>
                           <th class="text-center" width="11%">Booking<br>
                              Status
                           </th>
                           <th class="text-center" width="9%">Booking<br>
                              Ref No.
                           </th>
                           <th class="text-center" width="9%">Supplier<br>
                              Ref.
                           </th>
                           <th class="text-center" width="27%">Supplier Name</th>
                           <th class="text-center" width="15%">Balance Due</th>
                        </tr>
                     </thead>
                     <tbody class="text-center">
                         <?php if(!empty($supplierRemaingBalance))
                           {
                             $sr=1;
                             $totalLeftBalance=0.0;
                             foreach($supplierRemaingBalance as $obj)
                             {
                                // echo '<br>'.$obj->id;
                                 $supplierReceived=0;
                                 $encodeData=idencode($obj->id);
                                 $ticketCost=0;
                                 $additionalCharges=0;
                                 $leftBalce=0;
                                 $adjustment=0;
                                 $additionalCharges=(round(ticketCharges($obj->id),2)+round(ticketChargesAditional($obj->id),2));
                                 $payableSupplier=round(ticketCost($obj->id),2);
                                $ticketCost=$payableSupplier;
                                $supplierReceived=round(supplierPayAmount($obj->id),2);
                                $adjustment=adjustmentPay($obj->id);
                                 $leftBalce=round(($supplierReceived-$ticketCost),2);
                                 $leftBalce=round($leftBalce+$adjustment,2);
                                 $totalLeftBalance=($totalLeftBalance+$leftBalce);
                                 if($leftBalce!=0)
                                 {
                             ?>
                        <tr>
                           <td width="5%" height="20"><?php echo $sr++; ?></td>
                           <td width="8%">
                           <?php echo date('F,d,Y', strtotime($obj->issue_date)); ?>
                           </td>
                           <td width="16%">
                            <?php echo idToName('company','id',$obj->company,'company_name');?>
                           </td>
                           <td width="11%"><?php if($obj->flag==2){ ?>Issued <?php } ?></td>
                           <td width="9%">
                               <a target="_blank" href="<?php echo base_url('BookingDetailBox/'.$encodeData.'/'.idencode(2)); ?>"><?php echo idToName('company','id',$obj->company,'company_Code').'-'.$obj->id ?></a>
                           </td>
                           <td width="9%"><?php echo $obj->supplier_ref; ?></td>
                           <td align="center"><?php echo $obj->supplier_name; ?></td>
                           <td align="center"><?php echo $leftBalce; ?></td>
                        </tr>
                        <tr>
                           <td height="3" colspan="8" style="border-bottom: 2px solid #EBEBEB;"></td>
                        </tr>
                           <?php } } } ?>
                        <tr>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td colspan="2">&nbsp;</td>
                           <td class="text-red font-weight-bold" style="font-size: 14px;">Total:</td>
                           <td class="text-red font-weight-bold" style="font-size: 14px;" height="30"><?php echo number_format($totalLeftBalance,2); ?></td>
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