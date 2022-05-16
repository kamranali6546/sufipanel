<title>Booking Follow Ups</title><!-- page content -->
<style>
.label {
	color: #038269 !important;
    font-size: 100%;
}
.table-condensed>tbody>tr>td {
	text-align: left !important;
}
.table>thead>tr>th {
		padding: 1px !important;
}
.adminClass {
	color: red !important;
}
.agentClass {
	color: green !important; 
}
	table.tablColor tbody tr td a {
		color: #009fff;
		text-decoration: none !important;
		font-weight: bold !important;
	}
	 table.tablColor tbody tr td a:hover {
		text-decoration: underline !important;
	}
	table.display td {
		padding: 5px 2px !important;
		color: black;
		border-bottom: 0px solid #e1e2e2;
	}
	table.dataTable tbody th, table.dataTable tbody td {
		padding: 5px 2px !important;
	}
	a {
		color: #337ab7;
		text-decoration: none;
	}
	a:hover {
		text-decoration: none;
	}
</style>
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Booking Follow Ups</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table  class="table display table-hover tablColor" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Sr.#</th>
						<th style="width: 8%;">File No#</th>
						<th>File Status</th>
						<th>Book Date</th>
						<th>Pay Date</th>
						<th>Travel Date</th>
						<th style="width: 5%;">Airline</th>
						<th>Price</th>
						<th>Total Paid</th>
						<th>PNRS</th>
						<th>Comment Date</th>
						<th>Agents</th>
						<th style="width: 8%;">What is reason & date of changes in files?</th>
					</tr>
				</thead>
				<tbody>
                                    <?php
                                    if(!empty($bookingData))
                                    {
                                        $sr=1;
                                        foreach($bookingData as $obj){
                                            $bookingAgentID=$obj->booked_agent_id;
                                             $ary="select * from event_history where booking_id='$obj->id' order by id desc  limit 1 ";
                                             $array=commentGet($ary);
                                             $adminCommentQry=" select * from event_history where booking_id='$obj->id' and agent_id!='$bookingAgentID' order by id desc  limit 1 ";
                                             $adminCommentD=commentGet($adminCommentQry);
                                             $agentCommentQry=" select * from event_history where booking_id='$obj->id' and agent_id='$bookingAgentID' order by id desc  limit 1 ";
                                             $agentCommentD=commentGet($agentCommentQry);
                                                $logPerson='';
                                                $dateTimeLog='';
                                                $logType='';
                                                $log='';
                                                $tatalreceived=0;
                                                $paymentDueDate='';
                                                $paymentDueDate=idToNameOrderAndLimit('customer_receipt_details','booking_id',$obj->id,'paymentDue_date','Desc','1');
                                                
                                                $cardAmount=sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$obj->id));
                                                $bankAmount=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj->id))+sumOfAmount('payment','amount',array('pay_to'=>'Travel Pack','pay_type'=>'Dr','booking_ref'=>$obj->id));
                                                $tatalreceived=($cardAmount+$bankAmount);
                                    ?>
					<tr>
						<td><?php echo $sr; ?></td>
						<td><a target="_blank" href="<?php echo site_url('BookingDetailBox/'.idencode($obj->id).'/'.idencode(1)) ?>" class='anchorCustm' data="<?php echo $obj->id; ?>"><?php echo idToName('company','id',$obj->company,'company_Code').'-'.$obj->id; ?></a></td>
						<td><?php echo $obj->file_status; ?></td>
                                                <td><?php echo date('d-M-y',  strtotime($obj->booking_date)); ?></td>
						<td><?php echo date('d-M-y',  strtotime($paymentDueDate)); ?></td>
						<td><?php echo date('d-M-y',  strtotime($obj->departure_date)); ?></td>
                                                <td><?php  $arline=explode('-',$obj->airline); if(!empty($arline)){ echo $arline[0]; } ?></td>
						<td><?php echo salePrice($obj->id); ?></td>
                                                <td><?php echo number_format($tatalreceived,2); ?></td>
						<td><?php echo $obj->pnr; ?></td>
						<td>
                                                    <?php  if(count($array)>0){ $commentStamp= explode(' ', $array['date']); echo date('dM',  strtotime($commentStamp[0])); } ?>
                                                </td>
						<td><?php echo idToName('admin','id',$obj->booked_agent_id,'login_name');  ?></td>
						<td>
                                                    <button onclick="getBookingCommentModel(<?php echo $obj->id; ?>)"   title="View All Comments" data-toggle="tooltip" type="button" class="btn btn-xs btn-primary btn-round">View All Comments</button>
                                                   <!--data-toggle="modal" data-target="#commentall"-->
                                                    <!-- <small class="text-muted" style="display: block;">Text Line</small> -->
                                                <td>
					</tr>	
					<tr style="background-color: #ffcd36bf;">
                                            <?php 
                                                if(count($adminCommentD>0))
                                                {
                                                    $logPerson=idToName('admin','id',$adminCommentD['agent_id'],'login_name');
                                                    $dateArray=  explode(' ', $adminCommentD['date']);
                                                    $logType=$adminCommentD['event_type'];
                                                    $log=$adminCommentD['event'];
                                                    $dateTimeLog=date('d-M-y',  strtotime($dateArray[0])).' '.date('h:m:i:a',  strtotime($dateArray[1]));
                                                    ?>
                                                <td colspan="13" style="text-indent: initial;text-orientation: mixed;-webkit-column-break-after: auto;overflow-wrap:break-word;width: 150px !important;padding: 0px 9px !important;border-top:0px;text-align: left !important;font-size:10px !important;"><strong class="adminClass"><?php echo $logPerson; ?></strong> <span>(<?php echo $dateTimeLog; ?>)</span>: <span>(<?php echo $logType; ?>)</span> <span><?php echo $log; ?></span>  </td>
                                                <?php
                                                } 
                                                ?>
					</tr>
					<tr style="background-color: #ffcd36bf;">
                                            <?php 
                                                if(count($agentCommentD>0))
                                                {
                                                    $logPerson=idToName('admin','id',$agentCommentD['agent_id'],'login_name');
                                                    $dateArray=  explode(' ', $agentCommentD['date']);
                                                    $logType=$agentCommentD['event_type'];
                                                    $log=$agentCommentD['event'];
                                                    $dateTimeLog=date('d-M-y',  strtotime($dateArray[0])).' '.date('h:m:i:a',  strtotime($dateArray[1]));
                                                    ?>
                                            <td colspan="13" style="text-indent: initial;text-orientation: mixed;-webkit-column-break-after: auto;overflow-wrap:break-word;width: 150px !important;padding: 0px 9px !important;border-top:0px;text-align: left !important;font-size: 10px !important;"><strong class="agentClass"><?php echo $logPerson; ?></strong> <span>(<?php echo $dateTimeLog; ?>)</span>: <span>(<?php echo $logType; ?>)</span> <span><?php echo $log; ?></span>  </td>
                                                <?php
                                                } 
                                                ?>
					</tr>
                                    <?php $sr++; } } ?>
													 
				</tbody>
			</table>
		</div>
	</div>               
</div>
<div class="modal fade" id="commentall" role="dialog">
	<div class="modal-dialog modal-lg"> 
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">View All Comments</h4>
			</div>
			<div class="modal-body">
				
			</div>	
                </div>
	</div>
</div>
 </div>