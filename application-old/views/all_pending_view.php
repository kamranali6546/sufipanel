<title>Pending Bookings</title>

<style type='text/css'>
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}

table.dataTable tbody th, table.dataTable tbody td {
    padding: 0px 2px !important;
    text-align: center !important;
}
table.display td {
        padding: 2px 2px;
    color: black;
            border-bottom: 0px dashed #abafaf !important;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 0px 2px !important;
    border-bottom: 1px solid #111;
    text-align: center !important;
}
 #example1 thead tr th {   }
 .BNMain {
    display: inline-flex; 
    position: absolute;
    z-index: 9999999;
    left: 328px;
    top: 18px;
 }
 .BNMain form {
    display: inherit;
 }
 .msgTd {
    font-size: 10px;
    background-color: #ffcd36bf;
    padding: 0px 9px !important;
 }
 table.dataTable.display tbody .trhoverclaass:hover
 {
         background-color: #FA9E87 !important;
 }
 .adminClass {
	color: red !important;
}
.agentClass {
	color: green !important; 
}
</style>
<div class="right_col" role="main">

                <div class="page-title">
                    <div class="title_left">
                      <h3>Pending Bookings</h3>
                    </div>
                    <div class="title_right">
                        <!--<a class="btn btn-primary btn-round pull-right" href="<?php echo site_url(''); ?>">Create Follow Up</a>-->
                    </div>
                </div>
                <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8" style="margin-top: 8px;">
                            <label style="font-size: 10px;"><span style="height: 20px; width: 20px;background: #FA9E87;display: inline-block;">&nbsp;</span> = Close Traveling Date &nbsp;|&nbsp;</label>
                            <label style="font-size: 10px;"><!-- <span style="height: 20px; width: 20px;background: red;display: inline-block;">&nbsp;</span> -->
                            <img src="lib/images/fare-expired.gif" width="12" height="12" border="0"> = Expiring PNRs or Fares &nbsp;|&nbsp;</label>
                            <label style="font-size: 10px;"><span style="height: 20px; width: 20px;background: #CCC;display: inline-block;">&nbsp;</span>&nbsp;<img src="lib/images/info.gif" width="12" height="12" border="0"> = Customer Paid Full / Nill</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 formarea text-right">
                            <form id="fliterFormData" action="<?php echo base_url('pending-bookings'); ?>" method="post" class="">
                              <div class="row">
                               <div class="col-lg-6 col-md-6 col-sm-6">
                                <!-- <label for="">Select Brand:</label> -->
                                <select name="brand_fliter" onchange="fliterRecord()" class="form-control">
                                    <option value="">Select Brands</option>
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
                                  <option value="">Select Sort By</option>
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
                        <?php
                        ?>
                        <table id="example" class="display tablColor" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th rowspan="2">Sr.#</th>
                                    <th rowspan="2" style="min-width: 60px;">File</th>
                                    <th rowspan="2" style="min-width: 70px;">Booking Date</th>
                                    <th rowspan="2" style="min-width: 70px;">Traveling Date</th>
                                    <th rowspan="2">Ref No#</th>
                                    <th rowspan="2" style="min-width: 70px;">Payment Date</th> 
                                    <th rowspan="2" style="min-width: 70px;">File Status</th>
                                    <th rowspan="2" style="min-width: 150px;max-width: 150px;">Customer Name</th>
                                    <th colspan="4" class="text-center">Amount Received</th>
                                    <th rowspan="2">Due Amount</th>
                                    <th rowspan="2">Agent</th> 
                                </tr>
                                <tr>
                                    <th>Card</th>
                                    <th>Bank</th>
                                    <th>Cash</th>
                                    <th>Cheque</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php 
                               
                                if(!empty($bookingData)){
                                    
                                    $bankTotal1=0;
                                    $TcardAmount1=0;
                                    $bankAmount1=0;
                                    $tatalreceived1=0;
                                     foreach($bookingData as $obj1){
                                         $bankAmount1=0;
                                         $cardTotal1=0;
                                         $cardAmount1=sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj1->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj1->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$obj1->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$obj1->id));
                                         $bankAmount1=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$obj1->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$obj1->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$obj1->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$obj1->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj1->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj1->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Travel Pack','pay_type'=>'Dr','booking_ref'=>$obj1->id));
                                      $bankTotal1=$bankTotal1+$bankAmount1;
                                      $TcardAmount1=$TcardAmount1+$cardAmount1;
                                     }
                                }
                                ?>
                                <tr style="background-color: #ffe2e2;padding:10px !important;">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center text-red"><b>Total</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b class="text-red"><?php echo $TcardAmount1; ?></b></td>
                                    <td><b class="text-red"><?php echo $bankTotal1; ?></b></td>
                                    <td><b class="text-red">0</b></td>
                                    <td><b class="text-red">0</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php if(!empty($bookingData)){
                                    $sr=0;
                                    $cardTotal=0;
                                    $bankTotal=0;
                                    $cardAmount=0;
                                    $bankAmount=0;
                                    $tatalreceived=0;
                                    $currentDate=date('Y-m-d');
                                   foreach($bookingData as $obj){
                                      $sr++; 
                                      $trclass='';
                                      $trhoverclass='';
                                      $tatalreceived=0;
                                      $dueAmountYet=0;
                                      $paymentDueDate='';
                                      $paymentClass='';
                                      $paymentDueDate=idToNameOrderAndLimit('customer_receipt_details','booking_id',$obj->id,'paymentDue_date','Desc','1');
                                      $cardAmount=sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$obj->id));
                                     // $bankAmount=bankPayment($obj->id);
                                      $bankAmount=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj->id))+sumOfAmount('payment','amount',array('pay_to'=>'Travel Pack','pay_type'=>'Dr','booking_ref'=>$obj->id));
                                      $tatalreceived=($cardAmount+$bankAmount);
                                      if($currentDate >$paymentDueDate)
                                       {
                                          $paymentClass="style='color:red'";
                                       }
                                      if($currentDate >$obj->departure_date)
                                       {
                                          $trclass=' style="background: #FA9E87;" ';
                                          $trhoverclass=' class="trhoverclaass" ';
                                       }
                                       else
                                       {
                                         $trclass=''; 
                                         $trhoverclass='';
//                                         if($currentDate > $obj->fareExpiryDate)
//                                             {
//                                              $trclass=' style="background: #CCC;" ';
//                                             }
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
                                    <!--<td><?php echo $obj->id; ?></td>-->
                                    <td align="center">
                                        <?php if($currentDate > $obj->pnrExpiryDate || $currentDate > $obj->fareExpiryDate){ ?>
                                        <a href="javascript:void(0)" title="Expiring PNRs or Fares" data-toggle="tooltip"><img src="lib/images/fare-expired.gif" width="12" height="12" border="0"></a>
                                        <?php } ?>
                                        &nbsp;
                                        <?php if($dueAmountYet<=0){ ?>
                                        <a href="javascript:void(0)" title="All Moneny Recevied From Customer." data-toggle="tooltip"><img src="lib/images/info.gif" width="12" height="12" border="0"></a>
                                        <?php } else{
                                            if($tatalreceived==0)
                                            {
                                                ?>
                                         <a href="javascript:void(0)" title="No Moneny Recevied From Customer." data-toggle="tooltip"><img src="lib/images/info.gif" width="12" height="12" border="0"></a>
                                                <?php
                                            }
                                        } ?>
                                    </td>
                                    <td><?php echo $obj->booking_date; ?></td>
                                    <td><?php echo $obj->departure_date; ?></td>
                                    <td><a target="_blank" href="<?php echo site_url('BookingDetailBox/'.idencode($obj->id).'/'.idencode(1)) ?>" class='anchorCustm' data="<?php echo $obj->id; ?>"><?php echo idToName('company','id',$obj->company,'company_Code').'-'.$obj->id; ?></a></td>
                                    <td><p <?php echo $paymentClass ?> ><?php echo $paymentDueDate; ?></p></td> 
                                    <td><?php echo $obj->file_status; ?></td>
                                    <td><?php  echo substr($obj->fullname,0,20); ?></td>
                                    <td><?php $cardTotal=$cardTotal+$cardAmount; echo $cardAmount;  ?></td>
                                    <td><?php $bankTotal=$bankTotal+$bankAmount; echo $bankAmount; ?></td>
                                    <td><?php echo sumOfAmount('customer_recepet_history','amount',array('receipt_via'=>3,'booking_id'=>$obj->id)); ?></td>
                                    <td><?php echo sumOfAmount('customer_recepet_history','amount',array('receipt_via'=>4,'booking_id'=>$obj->id)); ?></td>
                                    <td><?php echo round(salePrice($obj->id)-$tatalreceived,2); ?></td> 
                                    <td><?php echo idToName('admin','id',$obj->booked_agent_id,'login_name');  ?></td>
                                    <!--<td></td>-->
                                </tr>
                                <tr>
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
                                        $flagCom=idToName('admin','id',$array['agent_id'],'flag');
                                        $dateArray=  explode(' ', $array['date']);
                                        $logType=$array['event_type'];
                                        $log=$array['event'];
                                        $dateTimeLog=date('d-M-y',  strtotime($dateArray[0])).' '.date('h:m:i:a',  strtotime($dateArray[1]));
                                        ?>
                                   <td style="text-align: left !important;border-top:none !important;" colspan="14" class="msgTd"><strong class="<?php if($flagCom==1 || $flagCom==2) { ?> adminClass <?php } else { ?> agentClass <?php } ?>"><?php echo $logPerson; ?></strong> <span>(<?php echo $dateTimeLog; ?>)</span>: <span>(<?php echo $logType; ?>)</span> <span><?php echo $log; ?></span>  </td>
                                    <?php
                                    } 
                                    ?>
                                    <!--- <span>TEST</span>-->
                                </tr>
                                   <?php } } ?>
                            </tbody>
                            <tfoot>
                                <tr style="background-color: #ffe2e2;padding:2px;"> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center text-red"><b>Total</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b class="text-red text-center"><?php echo $cardTotal; ?></b></td>
                                    <td><b class="text-red text-center"><?php echo $bankTotal; ?></b></td>
                                    <td><b class="text-red text-center">0</b></td>
                                    <td><b class="text-red text-center">0</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>               
            </div>
<script>
function fliterRecord()
{
    $('#fliterFormData').submit();
}
</script>