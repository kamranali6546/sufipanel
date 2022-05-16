<title>Attendance Sheet</title>
<?php error_reporting(0); ?>
<!-- page content -->
<style>
 table.display tbody tr td, table.display tfoot tr td{
        text-align: center !important;
    }
    .trStyle
    {
        color: white;
        font-size: 22px;
        background-color: #1ABB9C !important;
        padding: 35px !important;
       
    }
    .trStyle .hedingTd
    {
        text-align: left !important;
    }
    .labelHeading
    {
        text-align: left !important;
        margin-left: -50% !important;
        
    }
    .text-left {
        text-align: left !important;
    }
    .label
    {
        color: midnightblue !important;
        font-weight: bold !important;
        font-size: 100%;
    }
    table tbody tr td, table thead tr th {
    	border: 1px solid #00000073 !important;
    }
    .custmBTN {
    	padding: 0px 10px !important;
    }
    .tablColor th, .tablColor td {
    	border: 1px solid gray;
    }
    @media screen and (max-width: 425px) {
    body .container.body .right_col {
        padding: 10px 13px !important;
    }
}
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width: 100%">
        	<div class="row">
        		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        			<h3>Attendance Sheet</h3>
        		</div>
                <!-- <div class="col-md-2">
                    <input type="hidden" id="agentId" value="<?php echo $this->session->userdata('userId'); ?>">
                    <input type="hidden" id="LogFlag" value="<?php echo $this->session->userdata('flag'); ?>">
                    <button type="button" id="checkinBtn"  class="btn btn-lg btn-primary custmBTN" onclick="markAttendance()">Checkin <br> <span id="checkin" style="font-size: 14px;"><script>window.load=startTime()</script></span></button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-lg btn-primary custmBTN" onclick="markCheckOut()">Checkout <br><span id="checkout" style="font-size: 14px;"><script>window.load=checkoutTime()</script></span> </button>
                </div> -->
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12"> 
                  	<a class="btn btn-primary btn-round" href="<?php echo site_url('Home/index'); ?>">Back</a> 
                </div> 
            </div> 
        </div> 
    </div>
    <div class="clearfix"></div>
    <form  >
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary" style="border-radius: 15px;border-color: #2a3f54">
                        <!-- <div class="panel-heading">Attendance Record</div> -->
                        <?php //echo date('H:i:s'); ?>
                        <div class="panel-body"> 
                        	<div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" id="attendanceFilterStartDate" onclick="removeerror('attendanceFilterStartDateError',this.id)" readonly="" class="form-control" placeholder="Start Date">
                                                            <span id="attendanceFilterStartDateError"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" id="attendanceFilterEndDate" onclick="removeerror('attendanceFilterEndDateError',this.id)" readonly="" class="form-control" placeholder="End Date">
                                                            <span id="attendanceFilterEndDateError"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                        <!-- <label>Agent:</label>-->
                                                        <select class="form-control" id="agentListAttendance" <?php if($this->session->userdata('flag')!=1){ ?>disabled="disabled"<?php } ?> >
                                                                <option value="">--Select Agent--</option>
                                                                <?php if(!empty($filterAgents)){ foreach($filterAgents as $objFilter){ ?>
                                                                <option value="<?php echo $objFilter->id; ?>"><?php echo $objFilter->login_name; ?></option>
                                                                <?php } } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-primary btn-round" onclick="fliterAttendance()">Filter</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        		<div class="col-md-3" style="display: inline-flex;">
                                            <div>
                                                <input type="hidden" id="agentId" value="<?php echo $this->session->userdata('userId'); ?>">
                                                <input type="hidden" id="LogFlag" value="<?php echo $this->session->userdata('flag'); ?>">
                                                <button type="button" id="checkinBtn" style="display: none;"  class="btn btn-lg btn-primary custmBTN" onclick="markAttendance()">Checkin <br> <span id="checkin" style="font-size: 14px;"><script>window.load=startTime()</script></span></button>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-lg btn-primary custmBTN" onclick="markCheckOut()">Checkout <br><span id="checkout" style="font-size: 14px;"><script>window.load=checkoutTime()</script></span> </button>
                                            </div>
                        		</div>
                        		<div class="col-md-6 table-responsive">
                                            <table id="" class="tablColor table-hover" width="100%" cellspacing="0">
                                                <?php //print_r($agents); ?>
                                                <thead> 
                                                    <tr>
                                                        <th class="text-center">Agent Name</th>
                                                        <th class="text-center">Used Leaves</th>
                                                        <th class="text-center">Left Leaves</th>
                                                        <th class="text-center">Late Hours</th>
                                                    </tr> 
                                                </thead> 
                                                <tbody>
                                                <?php  foreach($agents as $agentObj){
                                                    //echo $absent=$agentObj['totalAbsent'];
                                                    $aId=$agentObj['idA'];
                                                   // print_r($agentObj);
                                                    $late=0;
                                                    foreach($attendanceRecord as $lateObj)
                                                    {
                                                        if($lateObj->agent_id==$aId)
                                                        {
                                                            $checkinarray_late='';
                                                            if(!empty($lateObj->chekinTime))
                                                                {
                                                                    $checkinarray_late= explode(':',$lateObj->chekinTime);
                                                                    $checkinhour_late=$checkinarray_late[0];
                                                                    $chekinSec_late=$checkinarray_late[2];
                                                                }

                                                                if($checkinarray_late){
                                                                 $checkinMint_late=$checkinarray_late[1];
                                                                } 
                                                                if($checkinhour_late==9 || $checkinhour_late > 9 && $chekinSec_late >= 10 && $checkinMint_late > 0)
                                                                {
                                                                    $sssTime='09:10:01';
                                                                    if($lateObj->chekinTime > $sssTime)
                                                                    {
                                                                        $lateCount=lateTimeCalculation($sssTime,$lateObj->chekinTime);
                                                                        $late=$late+$lateCount;
                                                                    }
                                                                }
                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <th class="text-center" style="background-color: #2a3f54;color: #ffff;"><?php echo idToName('admin','id',$aId,'login_name');  ?></th>
                                                        <td class="text-center"><?php echo $agentObj['totalAbsent']; ?></td>
                                                        <td class="text-center"><?php echo 12-$agentObj['totalAbsent']; ?></td>
                                                        <td class="text-center" style="color:red"><?php echo secToHR($late);  ?></td>
                                                    </tr>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                            <br>
                                        </div>
                        	</div>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table id="" class="display tablColor table-hover" width="100%" cellspacing="0">
                                        <thead> 
                                            <tr>
                                                <th>Sr.#</th>
                                                <th style="width:100px;">Date</th>
                                                <th>Check In Time</th>
                                                <th>Check Out Time</th>
                                                <th>Total Shift Time</th>
                                                <th>A.Status</th> 
                                                <th>T.Status</th>
                                                <th>Agent</th> 
                                            </tr> 
                                        </thead>
                                        <tbody id="filterResponse"> 
                                            <?php $i=0;  if(!empty($attendanceRecord)){ foreach($attendanceRecord as $objA){ $i++;
                                            $timeDate1=$objA->checkinYear.'-'.$objA->checkinMonth.'-'.$objA->checkinDay.' '.$objA->chekinTime;
                                            $timeDate2='';
                                            if(!empty($objA->checkOutTime))
                                                {
                                                $timeDate2=$objA->checkinYear.'-'.$objA->checkinMonth.'-'.$objA->checkinDay.' '.$objA->checkOutTime;
                                                }
                                                 $checkOutShitTime=  explode('%',shiftTimeCulcate($timeDate1,$timeDate2));
                                                    $checkinarray='';
                                                    $checkOutArray='';
                                                    if(!empty($objA->chekinTime))
                                                        {
                                                            $checkinarray= explode(':',$objA->chekinTime);
                                                            $checkinhour=$checkinarray[0];
                                                            $chekinSec=$checkinarray[2];
                                                        }
                                                        if(!empty($objA->checkOutTime))
                                                        {
                                                            $checkOutArray=  explode(':',$objA->checkOutTime);
                                                        }
                                                        if($checkinarray){
                                                         $checkinMint=$checkinarray[1];
                                                        }
                                            ?>
                                            <tr <?php if($objA->attendanceStatus=='Sun'){ ?><?php } else if($objA->attendanceStatus=='A' || (($checkinhour==9 || $checkinhour > 9) && $checkinMint >= 10 && $chekinSec > 0 && $objA->attendanceStatus=='P')){ ?> style="background-color: #f70072;color: #ffffff;" <?php } else if($checkinhour > 9 && $objA->attendanceStatus=='P'){?> style="background-color: #f70072;color: #ffffff;" <?php } else if((($checkinhour < 9) && $objA->attendanceStatus=='P') || (($checkinhour <=9) && $checkinMint <= 10  && $objA->attendanceStatus=='P')){ ?> style="background-color: #1ABB9C;color: #ffffff;"<?php } ?> >
                                                <td><?php echo $i; ?></td>
                                                <td><?php  echo $objA->checkinYear.'-'.$objA->checkinDay.'-'.$objA->checkinMonth;  ?></td>
                                                <td><?php if($objA->attendanceStatus=='Sun'){ echo $objA->attendanceStatus; }else{ echo $objA->chekinTime; } ?></td>
                                                <td><?php if($objA->attendanceStatus=='Sun'){ echo $objA->attendanceStatus; } else if($objA->attendanceStatus=='A'){ echo $objA->attendanceStatus; }  else{ echo $objA->checkOutTime; } ?></td>
                                                <td><?php if($objA->attendanceStatus=='Sun'){ echo $objA->attendanceStatus; } else if($objA->attendanceStatus=='A'){ echo $objA->attendanceStatus; } else{ if(!empty($timeDate2)){ echo  timeDifferenceCalculate($timeDate1,$timeDate2); } } ?></td>
                                                <td><?php echo $objA->attendanceStatus; ?></td>
                                                <td>
                                                    <?php
                                                        if($objA->attendanceStatus=='Sun'){ echo $objA->attendanceStatus; }
                                                        else if($objA->attendanceStatus=='A'){ echo 'Absent'; }
                                                        else if(($checkinhour==9 || $checkinhour > 9) && $checkinMint >= 10 && $chekinSec > 0 && $objA->attendanceStatus=='P' ){ echo "Late"; }
                                                        else if(($checkinhour > 9) && $objA->attendanceStatus=='P' ){ echo "Late"; }
                                                        else if(($checkinhour==9 || $checkinhour < 9) && $checkinMint <= 10 && $chekinSec==0 && $objA->attendanceStatus=='P' && ($checkinhour >=9 && $checkOutShitTime[1] >0)){ echo "Extra Time"; }
                                                        else if($objA->attendanceStatus=='P' && ($checkOutShitTime[0] < 9 )&& !(empty($objA->checkOutTime))){ echo "Less Time"; }
                                                        else if(($checkinhour <=9) && $checkinMint <= 10  && $objA->attendanceStatus=='P' ){ echo "On Time"; }
                                                        else if(($checkinhour < 9) && $objA->attendanceStatus=='P' ){ echo "On Time"; }
                                                    ?>
                                                </td>
                                                <td><?php echo idToName('admin','id',$objA->agent_id,'login_name'); ?></td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="btn btn-primary pull-right" onclick="attendanceModelOpen()">Export</button>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
    </div>   
    </form>
</div>
<!-- /page content -->
