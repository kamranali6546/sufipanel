<title>Inquiry Follow Up</title>
<!-- page content -->
<style>
table tbody th, table.dataTable tbody td {
	text-align: center !important;
}
.input-group .form-control {
    position: relative;
    z-index: 2;
    float: left;
    width: 100% !important;
    margin-bottom: 0;
}
table thead th, table.dataTable thead td {
	text-align: center !important;
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
	padding: 2px 10px;
	color: black;
	border-bottom: 0px solid #e1e2e2;
}
#msgComment {
    height: 37px !important;
    margin-top: 6px;
}
.adminClass {
    color: red !important;
}
.agentClass {
    color: green !important; 
}
table.dataTable tbody th, table.dataTable tbody td {
	padding: 2px 10px;
}
	a 
	{
	   color: #337ab7;
	   text-decoration: none;
	}
	a:hover
	{
		text-decoration: none;
	}
	ul.tsc_pagination li a
{
border:solid 1px;
border-radius:3px;
-moz-border-radius:3px;
-webkit-border-radius:3px;
padding:6px 9px 6px 9px;
}
ul.tsc_pagination li
{
padding-bottom:1px;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
color:#FFFFFF;
box-shadow:0px 1px #EDEDED;
-moz-box-shadow:0px 1px #EDEDED;
-webkit-box-shadow:0px 1px #EDEDED;
}
ul.tsc_pagination
{
margin:4px 0;
padding:0px;
height:100%;
overflow:inherit;
font:12px 'Tahoma';
list-style-type:none;
}
ul.tsc_pagination li
{
float:left;
margin:0px;
padding:0px;
margin-left:5px;
}
ul.tsc_pagination li a
{
color:black;
display:inline-block;
text-decoration:none;
padding:7px 10px 7px 10px;
}
ul.tsc_pagination li a img
{
border:none;
}
ul.tsc_pagination li a
{
color:#0A7EC5;
border-color:#8DC5E6;
background:#F8FCFF;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
text-shadow:0px 1px #388DBE;
border-color:#3390CA;
background:#58B0E7;
background:-moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
}
</style>
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Inquiry Follow Up</h3>
		</div>
		<div class="title_right">
			<!--<a class="btn btn-primary btn-round pull-right" href="<?php echo site_url('NewFollowUP'); ?>">Create Follow Up</a>-->
		</div>
	</div>
	<div class="clearfix"></div>
        <form action="<?php echo site_url('followup'); ?>" method="post" id="inquiryFliterForm" class="">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label >From :</label>
                <div class="input-group"> 
                            <div class="inner-addon right-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                                <input type="text" class="form-control nextDueDate" readonly="" style="background:#fff !important;" value="<?php echo date('Y-m-01'); ?>" name="startDate" > 
                            </div>
                        </div> 
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label>To :</label>
                <div class="input-group"> 
                            <div class="inner-addon right-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                                <input type="text" class="form-control nextDueDate" readonly="" style="background:#fff !important;" value="<?php echo date('Y-m-d'); ?>" name="endDate"> 
                            </div> 
                        </div> 
            </div>
            <?php if($this->session->userdata('flag')==1 || $this->session->userdata('flag')==2){ ?>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
               <label>Agents :</label>
               <select class="form-control" name="agentId" onchange="fliterApply()">
                    <option value="">Select Agents</option>
                    <?php
                    if(!empty($agents))
                    {
                        foreach($agents as $agent)
                        {
                            ?>
                    <option value="<?php echo $agent->id; ?>" <?php if(!empty($fliterAgent)){ if($fliterAgent==$agent->id){ ?> selected="" <?php } } ?> ><?php echo $agent->login_name; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select> 
            </div>
            <?php } else{ ?>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
               <label>Agents :</label>
               <select class="form-control" name="agentId" onchange="fliterApply()">
                    <option value="">Select Agents</option>
                    <?php
                    if(!empty($agents))
                    {
                        foreach($agents as $agent)
                        {
                            if($agent->id==$this->session->userdata('userId')){
                            ?>
                    <option value="<?php echo $agent->id; ?>" <?php if(!empty($fliterAgent)){ if($fliterAgent==$agent->id){ ?> selected="" <?php } } ?> ><?php echo $agent->login_name; ?></option>
                            <?php
                        } }
                    }
                    ?>
                </select> 
            </div>
            <?php } ?>
        </div>
            </form>
            <br>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="display table-hover tablColor" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Sr.#</th>
						<th style="min-width: 110px;">Inquiry Date</th>
						<th style="min-width: 82px;">Inquiry<br>ID</th>
						<th style=" min-width: 330px;">Inquiry Title</th>
						<th>Primary<br>Phone</th>
						<th style="min-width: 90px;">Secondary<br>Phone</th>
						<th style="min-width: 60px;">Picket By</th>
                        <th>Set Reminder</th>
						<th style="min-width:140px;text-align: center !important;">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($result)){ $j=1; foreach($result as $obj){
						$idInq=$obj->iid;
                                                $inquiryAgentId=$obj->picked_by;
						$qry=" Select * from  agent_comments where inquiry_id='$idInq' And agent_id='$inquiryAgentId'  Order by id Desc limit 1 ";
                                                $qry3=" Select * from  agent_comments where inquiry_id='$idInq' And agent_id!='$inquiryAgentId'  Order by id Desc limit 1 ";
						$qry2=" Select * from  agent_comments where inquiry_id='$idInq'  Order by id Desc  ";
						$comment=commentGet($qry);
						$commentAdmin=commentGet($qry3);
                                                
						$commentData=commentAllGet($qry2);
						$phoneArray=  explode(',', $obj->customer_phone);
					?>
					<tr>
						<td><?php echo $j; ?></td>
                                                <td><?php $splitDate= explode(' ', $obj->enquiry_date); echo $splitDate[0]; ?></td>
						<td><a data-toggle="modal" data-target="#inquirydetails<?php echo $obj->iid; ?>" href="<?php //echo base_url('details/'.idencode($obj->iid)) ?>" title="<?php //echo $obj->customer_email ?>"><?php echo $obj->iid; ?></a></td>
						<td><span style="font-weight: 600;">Flight Search :</span> <?php echo $obj->destination; ?> <small class="text-muted" style="font-size:10px;"><?php echo $obj->brand_code; ?>:<?php echo originInquiry($obj->inquiry_regin); ?>,  <?php echo $obj->device.' : '.$obj->os; ?></small></td>			
						<td><?php if(array_key_exists(0, $phoneArray)){ echo $phoneArray[0]; } ?></td>
						<td><?php if(array_key_exists(1, $phoneArray)){ echo $phoneArray[1]; } ?></td>
						<td><span><?php echo $obj->login_name; ?></span></td>
                        <td>
                            <div class="input-group"> 
                                        <div class="inner-addon right-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                                <input type="text" name="paymentDueDate"  onclick="removeerror('paymentDueDateError',this.id)" class="form-control" id="paymentDueDate">
                                            <span id="paymentDueDateError"></span>
                                        </div>
                                    </div> 
                        </td>
						<td style="text-align:center !important;">
							<!--<a href="javascript:void(0)" title="Comment" data-toggle="modal" data-target="#mymodel" type="button" class="btn btn-xs btn-primary btn-round"><i class="fa fa-edit"></i></a>-->
                            
                                                    <a href="javascript:void(0)" title="Comment" data-toggle="tooltip" onclick="getCommentModel(<?php echo $obj->iid; ?>)" type="button" class="btn btn-xs btn-primary btn-round"><i class="fa fa-edit"></i></a>
							<?php if($this->session->userdata('flag')=='1' || $this->session->userdata('flag')=='2'){ ?>
							<a href="javascript:void(0)" onclick="inquiryDelete(<?php echo $obj->iid ?>)" title="Delete" data-toggle="tooltip" type="button" class="btn btn-xs btn-danger btn-round"><i class="fa fa-trash-o"></i></a>
                            <a type="button" class="btn btn-xs btn-info btn-round" onclick="inquiryAssignModal(<?php echo $obj->iid ?>)" title="Assign To" data-toggle="tooltip"><i class="fa fa-share"></i></a>
							<?php } ?>
						</td>
					</tr>
					<tr style="background-color: #ffcd36bf;">
                                            <td colspan="8" style="text-indent: initial;text-orientation: mixed;-webkit-column-break-after: auto;overflow-wrap:break-word;width: 150px !important;padding: 0px 9px;border-top:0px;text-align: left !important;font-size: 10px !important;"><b></b><?php if(!empty($obj->customer_instr) && $comment==0){ echo $obj->customer_instr; } else{  if($comment!=0){ $flagOfAgenCom=idToName('admin','id',$comment['agent_id'],'flag'); $class=''; if($flagOfAgenCom==1 || $flagOfAgenCom==2){ $class='adminClass'; } else{ $class='agentClass'; } echo "<b class='$class'>(". idToName('admin','id',$comment['agent_id'],'login_name').")&nbsp;(".date('d-M-y h:m:i A',strtotime($comment['remarks_time'])).") </b>". $comment['remakts']; }  } ?>
						</td>
					</tr>
                                        <?php if(!empty($commentAdmin)){ ?>
                                        <tr style="background-color: #ffcd36bf;">
                                            <td colspan="9" style="text-indent: initial;text-orientation: mixed;-webkit-column-break-after: auto;overflow-wrap:break-word;width: 150px !important;padding: 0px 9px;border-top:0px;text-align: left !important;font-size: 10px !important;">
                                                <?php
                                                if($commentAdmin!=0){ $flagOfAdminCom=idToName('admin','id',$commentAdmin['agent_id'],'flag'); $class=''; if($flagOfAdminCom==1 || $flagOfAdminCom==2){ $class='adminClass'; } else{ $class='agentClass'; } echo "<b class='$class'>(". idToName('admin','id',$commentAdmin['agent_id'],'login_name').")&nbsp;(".date('d-M-y h:m:i A',strtotime($commentAdmin['remarks_time'])).") </b>". $commentAdmin['remakts']; } 
                                                ?>
                                                <!--<b>Admin</b>-->
                                            </td>
                                        </tr>
                                        <?php } ?>
					<?php $j++;
                                        ?>
                                        <div class="modal fade" id="inquirydetails<?php echo $obj->iid; ?>" role="dialog">
                                            <div class="modal-dialog  modal-lg">
                                              <!-- Modal content-->
                                              <form method="post" action="<?php echo site_url('FlowupUpdaeBox'); ?>">
                                                  <input type="hidden" name="id" value="<?php echo $obj->iid; ?>">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Picked Inquiry Detail</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <u><b>Customer Inquiry Details</b></u>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label>Inquiry ID:&nbsp;</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label style="font-weight:normal !important;"><?php echo $obj->iid; ?></label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Time Received:&nbsp;</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label style="font-weight:normal !important;"><?php echo $obj->enquiry_date; ?></label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label>Picked BY:&nbsp;</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label style="font-weight:normal !important;"><?php echo idToName('admin','id',$obj->picked_by,'login_name'); ?></label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Time Pick :</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label style="font-weight:normal !important;"><?php echo $obj->picked_time; ?></label>
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="row">
                                                            <div id="commentsDiv" class="col-md-8 offset-4" style="margin-left:1%;">
                                                                <?php
                                                                if(!empty($commentData))
                                                                {
                                                                        foreach($commentData as $comObj)
                                                                        { 
                                                                            $flagOfAgenComs=idToName('admin','id',$comObj['agent_id'],'flag'); $classAdd=''; if($flagOfAgenComs==1 || $flagOfAgenComs==2){ $classAdd='adminClass'; } else{ $classAdd='agentClass'; } 
                                                                                ?>
                                                                <label style='margin-left:1%;'><b class="<?php echo $classAdd; ?>">(<?php echo idToName('admin','id',$comObj['agent_id'],'login_name'); ?>)&nbsp;</b><?php echo $comObj['remakts']; ?>&nbsp;<b><?php echo '('.$comObj['remarks_time'].')'; ?></b></label><br>
                                                                                <?php 
                                                                        }
                                                                } 
                                                            ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h5 style=""><u><b>Inquiry Detail</b></u></h5>
                                                        <br>
                                                        Flight Search <small>()</small>
                                                         <br>
                                                    </div>
                                                    <div class="row">
                                                        <u><b>Flight Detail</b></u>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Departure Airport</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->flight_from; ?>" name="depart_form"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Destination</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->destination; ?>" name="destination"></label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Departure Date</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->departure_date; ?>" name="departt_date"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Return Date</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->return_date; ?>" name="return_date"></label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <h5 style=""><u><b>Contact Detail</b></u></h5>
                                                        <br>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Name:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->name; ?>" name="customer_name"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Email:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="email" class="form-control input-sm" value="<?php echo $obj->customer_email; ?>" name="email"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Phone #:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->customer_phone; ?>" name="contact_number"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Customer Instruction :</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->customer_instr; ?>" name="comments"></label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <h5 style=""><u><b>Preference</b></u></h5>
                                                        <br>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Prefered Airline:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->prefered_airline; ?>" name="airline"></label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Ticket Type:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->ticket_type; ?>" name="ticket_type"></label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Ticket Class:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->ticket_class; ?>" name="ticket_class"></label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Fare:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->fare; ?>" name="cost_price"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h5 style=""><u><b>Passenger Detail</b></u></h5>
                                                        <br>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Adult:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->adult; ?>" name="adult"></label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Child:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->child; ?>" name="child"></label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Infant:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->infaunt; ?>" name="infant"></label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Inquiry Status:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><input type="text" class="form-control input-sm" value="<?php echo $obj->status; ?>"  ></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary" data-dismiss="modal">update</button>
                                                </div>
                                              </div>
                                              </form>

                                            </div>
                                        </div>
                                        
                                         <?php       } } ?>
				</tbody>
			</table>
		</div>
           
	</div> 
        <div class="row">
            <div id="pagination">
                <ul class="tsc_pagination">
                <br>
           <?php  foreach ($links as $link)
               {
                echo "<li>". $link."</li>";
               } ?>
                </ul>
            </div>
        </div>
</div>

 <!-- model picked details and comments -->

 <!-- model picked details and comments -->


<div class="modal fade" id="mymodel" role="dialog">
	<div class="modal-dialog modal-lg"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Picked Inquiry Detail</h4>
			</div>
			<div class="modal-body">
				<?php if(!empty($record)){ 
				//print_r($record);
				$obj=$record[0];
				} ?>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<?php if(!empty($errormessage)){ ?>
						<div class="alert alert-danger alert-dismissable fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong><?php if(!empty($errormessage)){ echo $errormessage; } ?></strong>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="row colorr">
					<div class="col-md-12">
						<div class="">
							<u><b>Customer Inquiry Details</b></u>
                            
							<table id="bsc" class="table" width="100%">
								<tr>
                                    <td>
                                        <div class="row">
                                <div class="col-lg-3 text-left">
                                    Inquiry ID:
                                </div>
                                 <div class="col-lg-3 text-left">
                                    <b><?php echo $obj->id; ?></b>
                                </div>
                                 <div class="col-lg-3 text-left">
                                    Time Received:
                                </div>
                                 <div class="col-lg-3 text-left">
                                    <b><?php echo $obj->enquiry_date; ?></b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 text-left">
                                    Picked BY:
                                </div>
                                <div class="col-lg-3 text-left">
                                    <b id="agnt"><?php echo idToName('admin','id',$obj->picked_by,'login_name'); ?></b>
                                </div>
                                <div class="col-lg-3 text-left">
                                    Time Pick :
                                </div>
                                <div class="col-lg-3 text-left">
                                    <b><?php echo $obj->picked_time; ?></b>
                                </div>
                            </div>
                                    </td>                        
                                </tr>
							</table>
							<br>
							<div class="row">
								<form method="post">  
									<div class="col-md-8">
										<textarea style="margin-left: 1%;" rows="0" name="comments" required id="msg" class="form-control" placeholder="Comments"></textarea>
										<input type="hidden" id="inquiryID" name="in_id" value="<?php echo $obj->id;  ?>" >
									</div>
									<div class="col-md-2 offset-2">
										<button style="margin-left: 7px;margin-top:5px;" type="button"  name="save" id="save" class="btn btn-primary">Submit</button>
									</div>
								</form>
							</div>
							<div class="row">
								<div id="commentsDiv" class="col-md-8 offset-4" style="margin-left:1%;">
									<?php if(!empty($commentData))
										{
											foreach($commentData as $comObj)
											{
												?>
											<label style='margin-left:1%;'><b>(<?php echo idToName('admin','id',$comObj->agent_id,'login_name'); ?>)&nbsp;</b><?php echo $comObj->remakts; ?>&nbsp;<b><?php echo '('.$comObj->remarks_time.')'; ?></b></label><br>
												<?php 
											}
										} 
										?>
								</div>
							</div>
							<!-- <div class="page-header"></div> -->
						</div>
						<h5 style=""><u><b>Inquiry Detail</b></u></h5>
						<br>
						Flight Search <small>()</small>
						<table class="table" width="100%">
							<tr style="background: #ffeb3b75;">
								<td colspan="4"><u><b>Flight Detail</b></u></td>
							</tr>
							<tr>
                                <td><b>Departure Airport</b></td> 
                                <td><?php echo $obj->flight_from; ?></td>
								<td><b>Destination</b></td>
								<td><?php echo $obj->destination; ?></td>
								
							</tr>
							<tr>
								<td><b>Departure Date</b></td>
								<td><?php echo $obj->departure_date; ?></td>
								<td><b>Return Date</b></td>
								<td><?php echo $obj->return_date; ?></td>
							</tr>
							<tr style="background: #ffeb3b75;">
							 	<td colspan="4"><u><b>Contact Detail</b></u></td>
							</tr>
							<tr>
								<td><b>Name</b></td>
								<td><?php echo $obj->name; ?></td>
								<td><b>Email</b></td>
								<td><?php echo $obj->customer_email; ?></td>
							</tr>
							<tr>
								<td><b>Phone #</b></td>
								<td><?php echo $obj->customer_phone; ?></td>
								<td><b>Customer Instruction</b></td>
								<td><?php echo $obj->customer_instr; ?></td>
							</tr>
							<tr style="background: #ffeb3b75;">
								<td colspan="4"><u><b>Preference</b></u></td>
							</tr>
							<tr>
								<td><b>Prefered Airline</b></td>
								<td><?php echo $obj->prefered_airline; ?></td>
								<td><b>Ticket Type</b></td>
								<td><?php echo $obj->ticket_type; ?></td>
							</tr>
							<tr>
								<td><b>Ticket Class</b></td>
								<td><?php echo $obj->ticket_class; ?></td>
								<td><b>Fare</b></td>
								<td><?php echo $obj->fare; ?></td>
							</tr>
							<tr style="background: #ffeb3b75;">
								<td colspan="4"><u><b>Passenger Detail</b></u></td>
							</tr>
							<tr>
								<td><b>Adult</b></td>
								<td><?php echo $obj->adult; ?></td>
								<td><b>Child</b></td>
								<td><?php echo $obj->child; ?></td>
							</tr>
							<tr>
								<td><b>Infant</b>nbsp;</td>
								<td><?php echo $obj->infaunt; ?></td>
								<td><b>Inquiry Status</b></td>
								<td><?php echo $obj->status; ?></td>
							</tr>
						</table><br>
					</div> 
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-round" onclick="javascript:window.location='<?php echo site_url('picked') ?>'">Back</button> 
				<?php if($this->session->userdata('flag')==1){ ?>
				<button type="button" class="btn btn-danger btn-round" onclick="inquiryDelete(<?php echo $obj->id ?>)">Delete</button>
				
				<?php } ?>  
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div>
<div class="modal fade" id="mymodel2" role="dialog">
	<div class="modal-dialog"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Picked Inquiry Detail</h4>
			</div>
			<div class="modal-body">
				<?php if(!empty($record)){ 
				//print_r($record);
				$obj=$record[0];
				} ?>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<?php if(!empty($errormessage)){ ?>
						<div class="alert alert-danger alert-dismissable fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong><?php if(!empty($errormessage)){ echo $errormessage; } ?></strong>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="row colorr">
					<div class="col-md-12">
						<div class="">
							<u><b>Customer Inquiry Details</b></u>
							<table id="bsc" class="table" width="100%">
								<tr>
									<th>Inquiry ID:&nbsp;</th>
									<td>&nbsp;<?php echo $obj->id; ?></td>
									<th>Time Received:&nbsp;</th>
									<td>&nbsp;<?php echo $obj->enquiry_date; ?></td>
									<th>Picked BY:&nbsp;</th>
									<td id="agnt">&nbsp;<?php echo idToName('admin','id',$obj->picked_by,'login_name'); ?></td>
									<th>Time Pick :&nbsp;</th>
									<td>&nbsp;<?php echo $obj->picked_time; ?></td>
                                    <th>Trans ID :&nbsp;</th>
                                    <td>&nbsp;1315</td> 
								</tr>
							</table>
							<!-- <div class="row">
								<form method="post">  
									<div class="col-md-8">
										<textarea style="margin-left: 1%;" rows="1" name="comments" required id="msg" class="form-control" placeholder="Comments"></textarea>
										<input type="hidden" id="inquiryID" name="in_id" value="<?php //echo $obj->id;  ?>" >
									</div>
									<div class="col-md-2 offset-2">
										<button style="margin-left: 7px;margin-top:5px;" type="button"  name="save" id="save" class="btn btn-primary">Submit</button>
									</div>
								</form>
							</div> -->
							<div class="row">
								<div id="commentsDiv" class="col-md-8 offset-4" style="margin-left:1%;">
									<?php if(!empty($commentData))
										{
											foreach($commentData as $comObj)
											{
												?>
											<label style='margin-left:1%;'><b>(<?php echo idToName('admin','id',$comObj->agent_id,'login_name'); ?>)&nbsp;</b><?php echo $comObj->remakts; ?>&nbsp;<b><?php echo '('.$comObj->remarks_time.')'; ?></b></label><br>
												<?php 
											}
										} 
										?>
								</div>
							</div>
							<!-- <div class="page-header"></div> -->
						</div>
						<h5 style=""><u><b>Inquiry Detail</b></u></h5>
						<br>
						Flight Search <small>()</small>
						<table class="table" width="100%">
							<tr style="background: #ffeb3b75;">
								<td colspan="4"><u><b>Flight Detail</b></u></td>
							</tr>
							<tr>
                                <td><b>Departure Airport</b></td>
                                <td><?php echo $obj->flight_from; ?></td>
								<td><b>Destination</b></td>
								<td><?php echo $obj->destination; ?></td>
								
							</tr>
							<tr>
								<td><b>Departure Date</b></td>
								<td><?php echo $obj->departure_date; ?></td>
								<td><b>Return Date</b></td>
								<td><?php echo $obj->return_date; ?></td>
							</tr>
							<tr style="background: #ffeb3b75;">
							 	<td colspan="4"><u><b>Contact Detail</b></u></td>
							</tr>
							<tr>
								<td><b>Name</b></td>
								<td><?php echo $obj->name; ?></td>
								<td><b>Email</b></td>
								<td><?php echo $obj->customer_email; ?></td>
							</tr>
							<tr>
								<td><b>Phone #</b></td>
								<td><?php echo $obj->customer_phone; ?></td>
								<td><b>Customer Instruction</b></td>
								<td><?php echo $obj->customer_instr; ?></td>
							</tr>
							<tr style="background: #ffeb3b75;">
								<td colspan="4"><u><b>Preference</b></u></td>
							</tr>
							<tr>
								<td><b>Prefered Airline</b></td>
								<td><?php echo $obj->prefered_airline; ?></td>
								<td><b>Ticket Type</b></td>
								<td><?php echo $obj->ticket_type; ?></td>
							</tr>
							<tr>
								<td><b>Ticket Class</b></td>
								<td><?php echo $obj->ticket_class; ?></td>
								<td><b>Fare</b></td>
								<td><?php echo $obj->fare; ?></td>
							</tr>
							<tr style="background: #ffeb3b75;">
								<td colspan="4"><u><b>Passenger Detail</b></u></td>
							</tr>
							<tr>
								<td><b>Adult</b></td>
								<td><?php echo $obj->adult; ?></td>
								<td><b>Child</b></td>
								<td><?php echo $obj->child; ?></td>
							</tr>
							<tr>
								<td><b>Infant</b>nbsp;</td>
								<td><?php echo $obj->infaunt; ?></td>
								<td><b>Inquiry Status</b></td>
								<td><?php echo $obj->status; ?></td>
							</tr>
						</table><br>
					</div> 
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-round" onclick="javascript:window.location='<?php echo site_url('picked') ?>'">Back</button> 
				<?php if($this->session->userdata('flag')==1){ ?>
				<button type="button" class="btn btn-danger btn-round" onclick="inquiryDelete(<?php echo $obj->id ?>)">Delete</button>
				<button type="button" class="btn btn-primary btn-round" onclick="inquiryAssignModal(<?php echo $obj->id ?>)" title="Assign To" data-toggle="tooltip">Assign To</button>
				<?php } ?>  
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div>
<div class="modal fade" id="inquiryModelAndComments" role="dialog">
	<div class="modal-dialog modal-lg"> 
		<!-- Modal content-->
		<div class="modal-content">
			
		</div> 
	</div>
</div>
<!-- /page content -->

<script>
    function fliterApply()
    {
        $('#inquiryFliterForm').submit();
    }
function getCommentModel(inquiryId)
  {
     if(inquiryId >0)
     {
         $.ajax({
             type:'post',
             url:ajaxUrl+'commentModal',
             data:{inquiryId:inquiryId},
             cache:false,
             success:function(resp)
             {
                 $('#inquiryModelAndComments .modal-content').html(resp);
                 $('#inquiryModelAndComments').modal('show');
             }
         });
     } 
     else
     {
        alertify.alert('No data'); 
     }
  }
</script>


