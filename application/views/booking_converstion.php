<title>Sale Conversion</title>
<!-- page content -->
<style type="text/css">
	.input-group input {
		width:100% !important;
	}
	.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
		padding:11px;
	}
	thead{
		background: #f1f1f1;
	}
	@media screen and (max-width: 425px) {
	body .container.body .right_col {
		padding: 10px 13px !important;
	}
}
</style>
<div class="right_col" role="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3>Sale Conversion</h3>
			</div>
		</div>        
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo site_url('converstion') ?>"> 
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<label>Start Date:</label>
								<div class="input-group"> 
									<div class="inner-addon right-addon">
										<i class="glyphicon glyphicon-calendar"></i>
                                                                                <input style="width:100%;" type="text" name="startDate" readonly="" autocomplete="off" value="<?php if(!empty($startfliter)){ echo $startfliter; } else{ echo date('Y-m-01');  } ?>" id="startDate" class="form-control" >
										<span id="paymentDueDateError"></span>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<label>End Date:</label>
								<div class="input-group"> 
									<div class="inner-addon right-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										<input style="width:100%;" type="text" name="endDate" readonly="" value="<?php if(!empty($endfliter)){ echo $endfliter; } else{ echo date('Y-m-d'); } ?>" autocomplete="off" id="endDate" class="form-control">
										<span id="paymentDueDateError"></span>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<label style="color:#fff;">.</label>
								<div>
									<button type="submit" name="checkNow" class="btn btn-primary btn-round">Check Now</button> &nbsp;
									<button type="button" class="btn btn-danger btn-round">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form> 
			</div>
		</div>
		<?php  if(!empty($resp)){ ?>
			<?php   ?>
			<br><br>
			<div class="table-responsive">
				<table class="table  table-hover table-striped">
					<thead>
						<tr>
							<th style="text-align: center">Sr No.</th>
							<th style="text-align: center">Agent Name</th>
							<th style="text-align: center">Total Inquiries</th>
							<th style="text-align: center">Total Bookings</th>
							<th style="text-align: center">Conversion</th>
							<th style="text-align: center">Rating</th>
							<th style="text-align: center">Improvements</th>
						</tr>
					</thead>
					<tbody>
			   			<?php if(!empty($resp)){ $i=1; foreach($resp as $objRes){ ?>
						<tr>
							<td style="text-align: center"><?php echo $i; ?></td>
							<td style="text-align: center"><?php echo idToName('admin','id',$objRes['agentId'],'login_name'); ?></td>
							<td style="text-align: center"><?php if(!empty($objRes['totalInquery'])){ echo $objRes['totalInquery'];  } else { echo 0; } ?></td>
							<td style="text-align: center"><?php if(!empty($objRes['totalbooking'])){ echo $objRes['totalbooking'];} else{ echo 0; } ?></td>
							<td style="text-align: center"><?php echo $objRes['percentage'].'%'; ?></td>
							<td style="text-align: center">
							<?php 
						   		$percentage= $objRes['percentage'];
								if($percentage<=20)
									{
										echo "Bad";
									}
								else if(($percentage >20 && $percentage<=25))
									{
										echo "Good";
									}
								else if(($percentage >25 && $percentage <=30 ))
									{
										echo "Better";
									}
								else if($percentage >30 && $percentage<=50)
									{
										echo "Best";
									}
								else if($percentage >50 && $percentage<=100 && $objRes['totalbooking']<=3)
									{
										echo "Increase Sales";
									}
								?>
							</td>
							<td style="text-align: center">
								<?php if($percentage<=20){ echo "Check Suggestions"; } else{ echo "Keep it up"; } ?>
								<a  data-toggle="modal" data-target="#myModal" style="cursor: pointer;">
						  			Keep it Up
								</a>
							</td>
						</tr>
			   			<?php $i++; }  } ?>
					</tbody>
					<tfoot>
						<tr style="background-color: #3399FF;color: #fff;">
							<td style="text-align: center"></td>
							<td style="text-align: center"><b> <?php echo $totalAgents; ?> Agents </b></td>
							<td style="text-align: center"><b><?php echo $grandTotalInquery; ?></b></td>
							<td style="text-align: center"><b><?php echo $grandTotalbooking; ?></b></td>
							<td style="text-align: center"></td>
							<td style="text-align: center"></td>
							<td style="text-align: center"></td>
						</tr>
					</tfoot>
				</table>
			</div>
		<?php } ?>
		</div>
	</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Modal title</h4>
	  </div>
	  <div class="modal-body">
		...
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary">Save changes</button>
	  </div>
	</div>
  </div>
</div>
<!-- /page content -->
