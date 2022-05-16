<title>Issued Uncleared</title>
<style>
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}
table tbody th, table.dataTable tbody td {
    text-align: center !important;
}
table thead th, table.dataTable thead td {
    text-align: center !important;
}
    .msgTd {
        font-size: 10px;
        background: #F2F892;
        padding: 0px 9px !important;
     }
     table.dataTable.display tbody .trhoverclaass:hover
        {
           background-color: #F2E1FD !important;
        }
</style>
<div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Issued Uncleared</h3>
                    </div>
                    <div class="title_right">
                        <!--<a class="btn btn-primary btn-round pull-right" href="<?php echo site_url(''); ?>">Create Follow Up</a>-->
                    </div> 
                </div>
                <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 8px;">
                            <!-- <label><span style="height: 20px; width: 20px;background: #FA9E87;display: inline-block;">&nbsp;</span> = Close Traveling Date &nbsp;&nbsp; | &nbsp;</label>
                            <label> --><!-- <span style="height: 20px; width: 20px;background: red;display: inline-block;">&nbsp;</span> --> 
                              <!-- <img src="lib/images/fare-expired.gif" width="12" height="12" border="0"> = Expiring PNRs or Fares &nbsp;&nbsp; | &nbsp;</label>
                            <label><span style="height: 20px; width: 20px;background: blue;display: inline-block;">&nbsp;</span>&nbsp;<img src="lib/images/info.gif" width="20" height="20" border="0"> = Customer Paid Full</label> -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right formarea">
                            <form method="post" action="<?php echo site_url('issued-bookings'); ?>" id="fliterFormData" class="form-inline">
                                <label for="">Select Brand:</label>
                                <select name="brand_fliter" onchange="fliterRecord()" class="form-control">
                                   <option value="">All Brands</option>
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
                                <label for="">Sort By:</label>
                                <select onchange="fliterRecord()" name="sort_fliter" class="form-control"> 
                                   <option <?php if(!empty($sortOrder) && $sortOrder=='b_date'){ ?> selected="selected" <?php } ?>  value="b_date">Booking Date</option>
                                    <option <?php if(!empty($sortOrder) && $sortOrder=='t_date'){ ?> selected="selected" <?php } ?> value="t_date">Traveling Date</option>
                                    <option <?php if(!empty($sortOrder) && $sortOrder=='b_no'){ ?> selected="selected" <?php } ?> value="b_no">Booking Ref No</option>
                                    <option <?php if(!empty($sortOrder) && $sortOrder=='c_name'){ ?> selected="selected" <?php } ?> value="c_name">Customer Name</option>
                                    <option <?php if(!empty($sortOrder) && $sortOrder=='b_agent'){ ?> selected="selected" <?php } ?> value="b_agent">Agent</option>
                                </select>    
                            </form>
                        </div>
                    </div> <br>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="example" class="display nowrap tablColor" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>File No.</th>
                                    <th>Booking Date</th>
                                    <th>Traveling Date</th>
                                    <th>Return Date</th>
                                    <th>Sup.Ref#</th>
                                    <th>Customer Name</th>
                                    <th>Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($IssuedBookingData)){ $j=0; 
                                $currentDate=date('Y-m-d');
                                foreach($IssuedBookingData as $obj){ 
                                     $encodeData=idencode($obj->id);
                                     $trclass='';
                                      $trhoverclass='';
                                      $tatalreceived=0;
                                      $dueAmountYet=0;
                                      $cardAmount=sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$obj->id));
                                      $bankAmount=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj->id));
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
                                           $trclass=' style="background: blue;" ';
                                        }
                                    $j++  ?>
                                <tr>
                                    <td><?php echo $j; ?></td>
                                    <td align="center"> 
                                      <a class="anchorCustm" target="_blank" href="<?php echo base_url('BookingDetailBox/'.$encodeData.'/'.idencode(2)); ?>"><?php echo idToName('company','id',$obj->company,'company_Code').'-'.$obj->id; ?></a>
                                        <?php if($currentDate > $obj->pnrExpiryDate || $currentDate > $obj->fareExpiryDate){ ?>
                                        <!--<img src="lib/images/fare-expired.gif" width="12" height="12" border="0">-->
                                        <?php } ?>
                                        &nbsp;
                                         <?php if($dueAmountYet<=0){ ?>
                                        <!--<img src="lib/images/info.gif" width="20" height="20" border="0">-->
                                         <?php } ?>
                                    </td>
                                    <td><?php echo $obj->booking_date; ?></td>
                                    <td><?php echo $obj->departure_date; ?></td>
                                    <td><?php echo $obj->returnDate; ?></td>
                                    
                                    <td><?php echo $obj->supplier_ref; ?></td>
                                    <td><?php echo substr($obj->fullname,0,20); ?></td>
                                    <td><?php echo idToName('admin','id',$obj->booked_agent_id,'login_name'); ?></td>
                                </tr>
                                 <tr style="display: none;">
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
                                    <td colspan="9" class="msgTd"><strong><?php echo $logPerson; ?></strong> <span>(<?php echo $dateTimeLog; ?>)</span>: <span>(<?php echo $logType; ?>)</span> <span><?php echo $log; ?></span>  </td>
                                    <?php
                                    }
                                    ?>
                                    <!--- <span>TEST</span>-->
                                </tr>
                                <?php } } else{ ?>
                                <tr>
                                    <td colspan="7"><p style="color: red;">Sorry ! There is No File ..................</p></td>
                                </tr>
                                <?php } ?>
                            </tbody>
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