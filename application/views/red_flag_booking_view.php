<title>Red Flag Bookins</title>
<style>
table tbody th, table.dataTable tbody td {
    text-align: center !important;
}
table thead th, table.dataTable thead td {
    text-align: center !important;
}
    table.display tbody tr td{
        border: 1px solid #b7b7b7;
        padding: 5px;
    }
    table.display tfoot tr td {
        color: black;
    }
    .msgTd {
        font-size: 10px;
        background: #F2F892;
        padding: 0px 9px !important;
     }
     table.dataTable.display tbody .trhoverclaass:hover
    {
        background-color: #FA9E87 !important;
    }
    /*.inner-addon { position: relative; }  
    .inner-addon .glyphicon { 
        position: absolute; 
        padding: 10px; 
        pointer-events: none;  
        z-index: 99;
        background: none;
        border: 0px;
        top: -2px;
        cursor: text;
        font-size: 17px;  
    }  
    .left-addon .glyphicon  { left:  0px;}
    .right-addon .glyphicon { right: 0px;} 
    .left-addon input  { padding-left:  30px; }
    .right-addon input { padding-right: 30px; cursor: pointer !important; } 
    .vertical-align-bottom { vertical-align: bottom !important; }
    .input-group {margin-bottom: 0px;}
    .input-group input { width: 135px !important; }
    .ui-datepicker {
        z-index: 999 !important;
    }*/
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>Red Flag Bookings</h3>
        </div>
        <div class="title_right">
           
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8" style="margin-top: 8px;">
            <label style="font-size:10px;"><span style="height: 12px; width: 12px;background: #FA9E87;display: inline-block;">&nbsp;</span> = Close Traveling Date &nbsp;&nbsp; | &nbsp;</label>
            <label style="font-size:10px;"><!-- <span style="height: 12px; width: 12px;background: red;display: inline-block;">&nbsp;</span> -->
            <img src="lib/images/fare-expired.gif" width="12" height="12" border="0"> = Expiring PNRs or Fares &nbsp;&nbsp; | &nbsp;</label>
            <label style="font-size:10px;"><span style="height: 12px; width: 12px;background: #CCC;display: inline-block;">&nbsp;</span>&nbsp;<img src="lib/images/info.gif" width="12" height="12" border="0"> = Customer Paid Full / Nill</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right formarea">
            <form id="fliterFormData" action="<?php echo site_url('pending-bookings-red-flag') ?>" method="post" class="">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <!-- <label for="">Select Brand:</label> -->
                <select name="brand_fliter" onchange="fliterRecord()" class="form-control">
                   <option value="">Select Brand</option>
                                    <?php
                                    if(!empty($copany))
                                    {
                                        foreach($copany as $cObj)
                                        {
                                           
                                            ?>
                                    <option <?php if(!empty($brandFliter) && $cObj->id==$brandFliter){ ?> selected="selected" <?php } ?> value="<?php echo $cObj->id; ?>"><?php echo $cObj->company_name; ?></option>
                                            <?php 
                                        }
                                    }
                                    ?>
                </select>         
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <!-- <label for="">Sort By:</label> -->
                <select onchange="fliterRecord()" name="sort_fliter" class="form-control">
                <option>Select Sort By</option> 
                    <option <?php if(!empty($sortOrder) && $sortOrder=='b_date'){ ?> selected="selected" <?php } ?>  value="b_date">Booking Date</option>
                    <option <?php if(!empty($sortOrder) && $sortOrder=='t_date'){ ?> selected="selected" <?php } ?> value="t_date">Traveling Date</option>
                    <option <?php if(!empty($sortOrder) && $sortOrder=='b_no'){ ?> selected="selected" <?php } ?> value="b_no">Booking Ref No</option>
                    <option <?php if(!empty($sortOrder) && $sortOrder=='c_name'){ ?> selected="selected" <?php } ?> value="c_name">Customer Name</option>
                    <option <?php if(!empty($sortOrder) && $sortOrder=='b_agent'){ ?> selected="selected" <?php } ?> value="b_agent">Agent</option>
                </select>         
                    </div>
                </div>
                
                   
            </form>
        </div>
    </div> <br> 
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table id="example" class="display tablColor" width="100%" cellspacing="0">
                <thead>
                     <tr> 
                        <th rowspan="2">Sr No.</th>
                        <th rowspan="2"></th>
                        <th rowspan="2">Booking Date</th>
                        <th rowspan="2">Traveling Date</th>
                        <th rowspan="2">Ref No.</th>
                        <th rowspan="2">Sup. Ref.</th>
                        <th rowspan="2">Customer Name</th>
                        <th colspan="4" style="text-align: center;border-bottom: 1px solid;">Amount Recevied</th>
                        <th rowspan="2">Amount Due</th>
                        <th rowspan="2">Brand</th>
                        <th rowspan="2">Agent</th> 
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <th>Card</th>
                        <th>Cash</th>
                        <th>Others</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php if(!empty($bookingDataRed)){
                        $sr=0;
                        $cardTotal=0;
                        $bankTotal=0;
                        $cardAmount=0;
                        $bankAmount=0;
                        $tatalreceived=0;
                        $currentDate=date('Y-m-d');
                        ?>
                    <?php
                    foreach($bookingDataRed as $obj){
                        $sr++; 
                        $tatalreceived=0;
                        $trclass='';
                        $trhoverclass='';
                        $dueAmountYet=0;
                        $cardAmount=cardPaymentSum($obj->id);
                        //$bankAmount=sumOfAmount('payment','amount',array('pay_to'=>'Usman Barclays','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bright Holiday Barclays','pay_type'=>'Dr','booking_ref'=>$obj->id))+sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj->id));
                        $bankAmount=paymentReceived($obj->id);
                        $tatalreceived=($cardAmount+$bankAmount);
                        if($currentDate >$obj->departure_date)
                        {
                           $trclass=' style="background: #FA9E87;" ';
                           $trhoverclass=' class="trhoverclaass" ';
                        }
                        else
                        {
                          $trclass=''; 
                          $trhoverclass='';
                        }
                        $dueAmountYet=salePrice($obj->id)-$tatalreceived;
                        if($dueAmountYet<=0)
                         {
                            //$trclass=' style="background: #CCC;" ';
                         }
                         else
                          {
                             if($tatalreceived<=0)
                               {
                                 $trclass=' style="background: #CCC;" ';
                               }
                          }
                    ?>
                    <tr <?php echo $trhoverclass; ?> <?php echo $trclass; ?> >
                        <td><?php echo $sr; ?></td>
                        <td align="center"> 
                            <?php if($currentDate > $obj->pnrExpiryDate || $currentDate > $obj->fareExpiryDate){ ?>
                           <a href="javascript:void(0)" title="Expiring PNRs or Fares" data-toggle="tooltip"><img src="lib/images/fare-expired.gif" width="12" height="12" border="0"></a>
                            <?php } ?>
                            &nbsp;
                             <?php if($dueAmountYet<=0){ ?>
                            <a href="javascript:void(0)" title="All Moneny Recevied From Customer." data-toggle="tooltip"><img src="lib/images/info.gif" width="12" height="12" border="0"></a>
                             <?php } else
                                 {
                                  if($currentDate > $obj->fareExpiryDate)
                                            {
                                                ?>
                                         <a href="javascript:void(0)" title="No Moneny Recevied From Customer." data-toggle="tooltip"><img src="lib/images/info.gif" width="12" height="12" border="0"></a>
                                                <?php
                                            }
                                 } ?>
                        </td>
                        <td><?php echo $obj->booking_date; ?></td>
                        <td><?php echo $obj->departure_date; ?></td>
                        <td><a href="<?php echo site_url('BookingDetailBox/'.idencode($obj->id).'/'.idencode(4)) ?>" class='anchorCustm' data="<?php echo $obj->id; ?>"><?php echo idToName('company','id',$obj->company,'company_Code').'-'.$obj->id; ?></a></td>
                        <td><?php echo $obj->supplier_ref; ?></td>
                        <td><?php  echo substr($obj->fullname,0,12); ?></td>
                        <td><?php $bankTotal=$bankTotal+$bankAmount; echo $bankAmount; ?></td>
                        <td><?php $cardTotal=$cardTotal+$cardAmount; echo $cardAmount;  ?></td>
                        <td>0</td>
                        <td>0</td>
                        <td><?php echo salePrice($obj->id)-$tatalreceived; ?></td>
                        <td><?php echo idToName('company','id',$obj->company,'company_Code'); ?></td>
                        <td><?php echo idToName('admin','id',$obj->booked_agent_id,'login_name');  ?></td>
                    </tr>
                    <?php 
                     $ary="select * from event_history where booking_id='$obj->id' order by id desc  limit 1 ";
                     $array=commentGet($ary);
                    $logPerson='';
                    $dateTimeLog='';
                    $logType='';
                    $log='';
                    if(count($array>0))
                    {
                    $logPerson=idToName('admin','id',$array['agent_id'],'login_name');
                    $dateArray=  explode(' ', $array['date']);
                    $logType=$array['event_type'];
                    $log=$array['event'];
                    $dateTimeLog=date('d-M-y',  strtotime($dateArray[0])).' '.date('h:m:i:a',  strtotime($dateArray[1]));
                    ?>
                    <td colspan="14" class="msgTd">
                        <strong><?php echo $logPerson; ?></strong> <span>(<?php echo $dateTimeLog; ?>)</span>: <span>(<?php echo $logType; ?>)</span> <span><?php echo $log; ?></span>  
                    </td>
                                    <?php } ?>
                    <?php } } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center text-red"><b>Total</b></td>
                        <td></td>
                        <td></td>
                        <td class="text-center text-red"><b><?php echo $bankTotal; ?></b></td>
                        <td class="text-center text-red"><b><?php echo $cardTotal; ?></b></td>
                        <td class="text-center text-red"><b>0</b></td> 
                        <td class="text-center text-red"><b>0</b></td> 
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>   
</div>
<!-- /page content --> 
<script>
function fliterRecord()
{
    $('#fliterFormData').submit();
}
</script>