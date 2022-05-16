<style type="text/css">
	.modal-header {
		background: #26b99a;
		color: white;
	}
	.formInlineFlex .row .col-md-3 label, .formInlineFlex .row .col-md-6 label, .formInlineFlex .row .col-md-12 label {
    /*width: 160px;
    position: relative;
    top: 10px;*/
    font-size: 10px;
}
#debitEntryModel .row, #crEntryModel .row {
	margin-bottom: 10px;
}
.bdrBtm a {
    color: #0a7ff7;
    font-size: 15px;
}
#transectionFormEdit label {
	font-size: 10px;
}
	#ui-datepicker-div {
		z-index: 9999 !important
	}
	.input-group {
		display: inherit;
	}
	hr {
		    margin-top: 6px !important;
    margin-bottom: 10px !important;
    border: 0 !important;
    border-top: 3px solid #eee !important;
	}
	.modal-body .form-group a {
		    color: #2196F3 !important;
	}
	.inner-addon { position: relative; }  
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
	}
	#cke_richText-moowvw {
		width: 867px !important
	}
	.richText {
		max-height: 300px;
		overflow-y: scroll;
		border: 1px solid #dde2e8;
		padding: 10px;
	}
</style>
<!-- Inquiry Assign Modal Start -->
<div class="modal fade success" id="inquiryAssign" role="dialog">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h5 class="modal-title">Assign To</h5>
		</div>
		<form method="post">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Select Agent</label>
							<select id="agentsId" class="form-control">
								<option value="">--Select Agent--</option>
							</select>
							<input type="hidden" name="" id="inqId">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="assign" onclick="inquiryAssign()" class="btn btn-round btn-primary">Assign Now</button>
				<button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
			</div>
		</form>
	  </div>
	</div>
</div>
<!-- Inquiry Assign Modal End -->

<!-- New Inquiry Assign Modal Start -->
<div class="modal fade success" id="inquiryAssignNew" role="dialog">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h5 class="modal-title">Assign To</h5>
		</div>
		<form method="post">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Select Agent</label>
							<select id="agentsIdNew" class="form-control">
								<option value="">--Select Agent--</option>
							</select>
							<input type="hidden" name="" id="inqIdNew">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="assignNew" onclick="inquiryAssignNew()" class="btn btn-round btn-primary">Assign Now</button>
				<button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
			</div>
		</form>
	  </div>
	</div>
</div>
<!-- New Inquiry Assign Modal End -->

<!-- Attendance Export Sheet Start -->
<div class="modal fade success" id="attendanceExport" role="dialog">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h5 class="modal-title">Attendance Export</h5>
		</div>
		  <form method="post" id="AttForm" onsubmit="return exportAttConfirm() ">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Select Start Date</label>
							<input type="text" id="attendanceStartDate" onclick="removeerror('attendanceStartDateError',this.id)" name="attendanceStartDate" class="form-control" readonly="">
							<span id="attendanceStartDateError"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Select End Date</label>
							<input type="text" id="attendanceEndDate" name="attendanceEndDate" onclick="removeerror('attendanceEndDateError',this.id)" class="form-control" readonly="">
							<span id="attendanceEndDateError"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Select Agent</label>
							<select id="agentsAttB" name="agentsList" class="form-control" <?php if($this->session->userdata('flag')!=1){?> disabled="disabled" <?php } ?> >
								<option value="">--Select Agent--</option>
							</select>         
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="exportAttBtn" onclick="exportAttConfirm()"  class="btn btn-round btn-primary">Export</button>
				<button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
			</div>
		</form>
	  </div>
	</div>
</div>
<!-- Attendance Export Sheet End -->

<!-- Booking Assign To -->
<div class="modal fade success" id="bookingAssignModel" role="dialog">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h5 class="modal-title">Assign To</h5>
		</div>
		<form method="post">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Select Agent</label>
							<select id="agentList" class="form-control">
								<option value="">--Select Agent--</option>
							</select>
							<input type="hidden" name="" id="assignBookingId">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="bookAssign" onclick="assignBookingDone(this.id)" class="btn btn-round btn-primary">Assign Now</button>
				<button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
			</div>
		</form>
	  </div>
	</div>
</div>

<!-- Send Payment & Other Request -->
<div id="sendPayment" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Send payment & other request  <small>(for new bank option talk to accounts)</small></h4>
			</div>
			<div class="modal-body">
				<form method="post">
					<input type="hidden" id="requestBooking">
                                        <input type="hidden" value="<?php echo $this->session->userdata('company') ?>" id="requestBrand">
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label for="">Request</label>
								<select id="resuestType" class="form-control" onchange="referenceFieldCondition(this.value)" style="padding-right: 0px !important">
									<option value="">--Select One--</option>
									<option value="Bank Payment">Check Bank Payment</option>
									<option value="Card Payment">Charge Card</option>
									<option value="Invoice">Send Invoice</option>
									<option value="Cancel File">Cancel File</option>
									<option value="Refund To Customer">Refund To Customer</option>
									<option value="Airline Refund">Apply For Airline Refund</option>
									<option value="Other">Other Request</option> 
								</select>
							</div>
							<div class="col-md-4"> 
								<div id="onlyBankPay" style="display: none;">
								<label for="">Bank</label>
								<select id="bankList" class="form-control" style="padding-right: 0px !important">
									<option value="">--Select Reveiver Bank--</option>
								</select>  
								</div>
							</div>  
							<div class="col-md-2">
								<label for="">Amount</label>
								<input type="text" name="" onkeypress="return isNumberKey(event);numberWithDeceimal('payRequestAmountError',this.id)" id="requestAmount" class="form-control" placeholder="Amount">
								<span id="payRequestAmountError"></span>
							</div>
							<div class="col-md-2">
								<label for="">Date</label>
								<input type="text" name="" style="cursor: pointer;" id="paymentAndRequest" class="form-control" placeholder="Payment Date">
								<input type="hidden" value="<?php echo $this->session->userdata('userId') ?>" id="agentRequestId" >
							</div>
<!--                            <div class="col-md-3" id="refDiv" style="display: none">
								<input type="text" name="" id="requestReference" class="form-control" placeholder="Payment Ref.OR Card Note">
							</div> -->
							<div class="col-md-12">
								<br />
								<label id="paymetRequestLabel" for="">Request Description (Or Payment Reference)</label>
								<textarea name="" id="requestReference" class="form-control"></textarea>
							</div>
						</div> 
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="makeRequest()">Submit</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div> 

<!-- Bank Popup -->
<div id="addBank" class="modal fade" role="dialog">
	<div class="modal-dialog"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Asset</h4>
			</div>
			<form method="post">
				<div class="modal-body"> 
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6">
								<label>Asset Name:</label>
								<input type="text" name="bankName" onkeypress="removeerror('bankError',this.id);" id="bankName" class="form-control" placeholder="Create Asset Name">
								<span id="bankError"></span>
							</div>
							<div class="col-lg-5">
								<label>Country of Asset:</label>
								<select class="form-control" name="bank_type" id="bankType">
									<option value="">Select One</option>
									<option value="Uk">UK</option>
									<option value="Pk">PK</option>
								</select>
								<span id="bankTypeError"></span>
							</div>
						</div>
					</div>
                                        <div class="form-group">
						<div class="row">  
							<div class="col-md-6">
                                                            <label>Select Brand:</label>
                                                            <select name="bankBrand" class="form-control" id="bankBrand">
                                                                <option value="">--Select Brand--</option>
                                                                
                                                            </select>
                                                            <span id="bankAccountBrandError"></span>	
							</div> 
							
						</div> 
					</div> 
					
				</div>
			</form>
			<div class="modal-footer"> 
				
				<button type="button" id="BankBtn" onclick="bankSave()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div> 
 
<!-- Ticket Order Popup -->
<div id="ticketOrder" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Send Ticket Order</h4>
			</div>
				<div class="modal-body"> 
					<input type="hidden" id="ticketorderBookingId" value="<?php echo $id; ?>">
                                        <input type="hidden" value="<?php echo $this->session->userdata('company') ?>" id="ticketorderBrand">
					<div class="form-group">
						<div class="row">  
							<div class="col-md-2">
								<label>Priority</label>
										<select id="ticketOrderPriorty" class="form-control">
											<option value="Normal">Normal</option>
											<option value="High">High</option>
								</select>
							</div> 
							<div class="col-md-2">
								<label>Supplier Name</label>
								 <input class="form-control" id="ticketOrderSupplierName" readonly="">
							</div> 
							<div class="col-md-2">
								<label>Supplier Ref.</label>
								<input type="text"  id="ticketOrderSupplierRef" class="form-control" placeholder="" readonly=""> 
							</div> 
							<div class="col-md-2" style="width: 200px;">
								<label>Supplier's Agent's Email</label>
								<input type="text"  id="ticketOrderSupplierEmail" class="form-control" placeholder="" readonly=""> 
							</div> 
							<div class="col-md-2" style="width: 100px;">
								<label>GDS</label>
								<input id="ticketOrderGDS" class="form-control" readonly="">
							</div>
							<div class="col-md-2" style="width: 140px;">
								<label>PNR</label>
								<input type="text" name="" id="ticketOrderPnr" class="form-control" placeholder="" readonly="">
							</div>
							
						</div> <br>
						<div class="row">
							<div class="col-md-2">
								<label>Issue Cost</label>
								<input type="text" name="" id="ticketorderissueCost" class="form-control" placeholder="" style="padding-left: 5px; padding-right: 0px; " readonly=""> 
							</div> 
							<div class="col-md-7">
								<label>Message</label>
								<input type="text" name="" id="ticketorderAgentmessage" class="form-control" placeholder="Ticket Description ( if any )"> 
							</div>  
						</div> 
					</div> 
				</div>
			<div class="modal-footer"> 
				<button type="button" class="btn btn-success" id="sendticketOrderbtn" onclick="sendTicketOrder(this.id)">Submit</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div> 

<!--Remaing Balance -->
<div id="remaingBalance" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agent note about left balance?</h4>
			</div>
				<div class="modal-body"> 
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="hidden" id="leftBalanceAgentIdremarks" value="<?php echo $this->session->userdata('userId'); ?>">
								<input type="hidden" value="<?php if(isset($id)){ echo $id; } ?>" id="LeftBalanceBookingId">
								<label><p style="color: red;">Is this refundable ticket?</p></label>
								<select id="isRefundsAbleTicket"  class="form-control">
									<option value="">--Select One--</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
								<span id="isRefundsAbleTicketError"></span>
							</div>
							<div class="form-group">
								<label><p style="color: red;">Do you have customer's E-mail reply on our terms & conditions of prior issuance?</p></label>
								<select id="leftBalanceCustomerReply"  class="form-control" onchange="leftEmailReply(this.value)">
									<option value="">--Select One--</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
							<div class="form-group" id="leftRemaksSaveError" style="display: none;">
								
							</div>
							<div class="form-group" style="display: none" id="leftDateDiv">
								<label>Select left balance due date</label>
								<input type="text" class="form-control" name="" readonly="" id="leftBalaceDateRemarks">
							</div>
							<div class="form-group" style="display: none" id="latePaymentDiv">
								<label>Reason of late payment?</label>
								<input type="text" class="form-control" name="" id="noteAboutLeftBalance">
							</div>
						</div>
					</div>
				</div>
			<div class="modal-footer" style="text-align: center;"> 
				<button class="btn btn-success" id="leftbalnceRe" onclick="remaingBalanceMsgSave(this.id)">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div> 
<!-- Remaing Balance End Model-- >

<!-- Negative profit Model -->
<div id="negativeModel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Negative profit note by agent?</h4>
			</div>
				<div class="modal-body"> 
					<div class="row">
						<div class="col-md-12">
<!--                            <div class="form-group">
								<label>When will it be positive?</label>
								<input type="text" class="form-control" name="" id="positiveOnDate">
								<span id="positiveOnDateError"></span>
							</div>-->
<!--                            <div class="form-group">
								<label>Explain ticket refundability & customer reply?</label>
								<input type="text" class="form-control" name="" id="agentRemarks">
								<span id="agentRemarksError"></span>
							</div>-->
							 <input type="hidden" id="negativeAgentId" value="<?php echo $this->session->userdata('userId'); ?>">
							 <input type="hidden" value="<?php if(isset($id)){ echo $id; } ?>" id="negativeBookingId">
							<div class="form-group">
								<label><p style="color: red;">Will this customer change your negative profit into positive profit?</p></label>
								<select id="isreplyNeg" class="form-control" onchange="isReplayDone(this.value)">
									<option value="">--Select One--</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
								<span id="isreplyNegError"></span>
							</div> 
							<div class="form-group" id="replayDivShow" style="display: none;">
								<label>Then select left balance date</label>
								<input type="text" class="form-control" name="" readonly="" id="datePositive">
							</div> 
						</div>
					</div>
				</div>
			<div class="modal-footer" style="text-align: center;"> 
				<button id="btnNegative" class="btn btn-success" onclick="negativeMessageSave(this.id)">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div> 

<!-- Negative profit Model End  --> 
<div id="cardCancellationModel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agent note about card cancellation?</h4>
			</div>
				<div class="modal-body"> 
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="hidden" id="cardCancellationAgentId"  value="<?php echo $this->session->userdata('userId'); ?>">
								<input type="hidden" id="cardcancellationBookingId" value="<?php if(isset($id)){ echo $id; } ?>" >
								<div class="form-group">
									<label><p style="color: red;">Bypassed popup files will not be entertained !</p></label> 
								</div> 
								<div class="form-group">
									<label><p style="color: red;">Have you Cancelled all PNRS & supplier references from this file?</p></label>
									<select class="form-control" id="pnrCancelledForCardCancellation">
										<option value="">--Select One--</option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<span id="pnrCancelledForCardCancellationError"></span>
								</div> 
								<div class="form-group">
									<label><p style="color: red;">What is card cancellation reason?</p></label>
									<input type="text" name="" class="form-control" id="cardCancellationReason">
									<span id="cardCancellationReasonError"></span>
								</div> 
								
							</div>
						</div>
					</div>
				</div>
			<div class="modal-footer" style="text-align: center;"> 
				<button class="btn btn-success" onclick="cardCancellationRemarks(this.id)" id="cardCancellationBtn">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div> 

<!-- Cash Cancellation model -->
<div id="cashCancellationModel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agent note about cash cancellation?</h4>
			</div>
				<div class="modal-body"> 
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="hidden" id="cashCancellationAgentId"  value="<?php echo $this->session->userdata('userId'); ?>">
								<input type="hidden" id="cashcancellationBookingId" value="<?php if(isset($id)){ echo $id; } ?>" >
								<div class="form-group">
									<label><p style="color: red;">Bypassed popup files will not be entertained !</p></label> 
								</div> 
								<div class="form-group">
									<label><p style="color: red;">Have you cancelled all PNRS & supplier references from this file?</p></label>
									<select id="pnrCancelledForCashCancellation" class="form-control">
										<option value="">--Select One--</option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									 <span id="pnrCancelledForCashCancellationError"></span>
								</div> 
								<div class="form-group">
									<label><p style="color: red;">What is cash cancellation reason?</p></label>
									<input type="text" name="" class="form-control" id="cashCancellationReason">
									 <span id="cashCancellationReasonError"></span>
								</div> 
								
							</div>
						</div>
					</div>
				</div>
			<div class="modal-footer" style="text-align: center;"> 
				<button class="btn btn-success" onclick="cashCancellationRemarks(this.id)" id="cashCancellationBtn">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div> 

<!-- Refund -->
<div id="refundModel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agent note about Refund?</h4>
			</div>
				<div class="modal-body"> 
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="hidden" id="refundAgentId"  value="<?php echo $this->session->userdata('userId'); ?>">
								<input type="hidden" id="refundBookingId" value="<?php if(isset($id)){ echo $id; } ?>" >
								<div class="form-group">
									<label><p style="color: red;">Bypassed popup files will not be entertained !</p></label> 
								</div> 
								<div class="form-group">
									<label><p style="color: red;">Have you cancelled all PNRS & supplier references from this file?</p></label>
									<select id="pnrCancelledForrefund" class="form-control">
										<option value="">--Select One--</option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									 <span id="pnrCancelledForrefundError"></span>
								</div> 
								<div class="form-group">
									<label><p style="color: red;">Why did passenger go for Refund?</p></label>
									<input type="text" name="" class="form-control" id="refundReason">
									 <span id="refundReasonError"></span>
								</div> 
								
							</div>
						</div>
					</div>
				</div>
			<div class="modal-footer" style="text-align: center;"> 
				<button class="btn btn-success" onclick="refundRemarksAgent(this.id)" id="refundBtn">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div> 

<!-- Charge Back Model -->
<div id="chargeBackModel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm"> 
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agent note about charge back?</h4>
			</div>
				<div class="modal-body"> 
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="hidden" id="chargeBackAgentId"  value="<?php echo $this->session->userdata('userId'); ?>">
								<input type="hidden" id="chargeBackBookingId" value="<?php if(isset($id)){ echo $id; } ?>" >
								<div class="form-group">
									<label><p style="color: red;">Bypassed popup files will not be entertained !</p></label> 
								</div> 
								<div class="form-group">
									<label><p style="color: red;">Will you cancel all PNRS & supplier references from this file?</p></label>
									<select id="pnrCancelledForchargeBack" class="form-control">
										<option value="">--Select One--</option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									 <span id="pnrCancelledForchargeBackError"></span>
								</div> 
								<div class="form-group">
									<label><p style="color: red;">Why did passenger Take Charge back?</p></label>
									<input type="text" name="" class="form-control" id="chargeBackReason">
									 <span id="chargeBackError"></span>
								</div> 
								
							</div>
						</div>
					</div>
				</div>
			<div class="modal-footer" style="text-align: center;"> 
				<button class="btn btn-success" onclick="agentsChargeBackRemarks(this.id)" id="chargeBackBtn">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> 
	</div>
</div> 

<!-- Pending Booking Popup -->
<div class="modal fade success" id="pendingBok" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title">Mark as Pending</h5>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Date of Pending?</label>
								<input type="text" class="form-control" readonly="" id="PendingDate" />
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-round btn-primary">Save</button>
					<button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Issued Booking Popup -->
<div class="modal fade success" id="issuedBokmodal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Mark as Issued</h5>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Date of Issued?</label>
								<input type="hidden" name="issue" id="issuedBookingIdconfirm">
								<input type="text" class="form-control" readonly="" id="IssuedDate" />
								<span id="IssuedDateError"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="button" onclick="markAsIssued()" class="btn btn-round btn-primary">Save</button>
					<button type="button" class="btn btn-round btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Card Cancellation Popup -->
<div class="modal fade success" id="cardCancellationModal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Mark as Card Cancellation</h5>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Date of Card Cancellation?</label>
								<input type="hidden" id="cardCancelBookingId">
								<input type="text" class="form-control" readonly="" id="cardCanDate" />
								<span id="cardCanDateDateError"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="button" onclick="markAsCardCancellation()" class="btn btn-round btn-primary">Save</button>
					<button type="button" class="btn btn-danger btn-round" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Cash Cancellation Popup -->
<div class="modal fade success" id="cashCancellationModal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Mark as Cash Cancellation</h5>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Date of Cash Cancellation?</label>
								<input type="hidden" id="cashCancelBookingId">
								<input type="text" class="form-control" readonly="" id="cashCanDate" />
								<span id="cashCanDateErrorModal"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="button" onclick="markAsCashCancellation()" class="btn btn-round btn-primary">Save</button>
					<button type="button" class="btn btn-danger btn-round" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Refund Popup -->
<div class="modal fade success" id="RefundModalS" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Mark as Refund</h5>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Date of Refund?</label>
								<input type="hidden" id="refundBookingId">
								<input type="text" class="form-control" readonly="" id="refundDate" />
								<span id="refundDateErrorModal"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="button" onclick="marksAsRefundBooking()" class="btn btn-round btn-primary">Save</button>
					<button type="button" class="btn btn-danger btn-round" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Chargeback Popup -->
<div class="modal fade success" id="ChargeBackDateModal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Mark as Chargeback</h5>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Date of Chargeback?</label>
								<input type="hidden" id="markChargeBackBookingId">
								<input type="text" class="form-control" readonly="" id="chargeBackDate" />
								<span id="chargeBackDateError"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="button" onclick="markAsChargeBack()" class="btn btn-round btn-primary">Save</button>
					<button type="button" class="btn btn-danger btn-round" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- ChargeBack popup end -->

<!--Supplier modal start-->
<div class="modal fade success" id="supplierModel" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <form id="supplierForm">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Add New Liability</h4>
		</div>
		<div class="modal-body">
		  <div class="form-group">
			<div class="row">  
				<div class="col-md-6">
					<label>Liability Name:</label>
					<input type="text" name="" onkeypress="removeerror('supplierNameError',this.id);" id="supplierName" class="form-control" placeholder="Enter Liability Name">
					<span id="supplierNameError"></span>
				</div> 
				<div class="col-md-6">
					<div class="form-group">
						<label>Bank of Liability:</label>
						<input type="text" name="supplierBank" id="supplierBank" placeholder="Enter Bank of Liabilities" class="form-control" >
						<span id="supplierBankError"></span>
					</div>
				</div>
			</div> <br>
			<div class="row">  
				<div class="col-md-6">
					<label>Email:To </label>
					<input type="email" name="" id="supplierEmailTO" class="form-control" placeholder="abc@gmail.com">
					<span id="supplierEmailTOError"></span>
				</div> 
				<div class="col-md-6">
					<label>Email:Cc</label>
					<input type="email" name="" id="supplierEmailcc" class="form-control" placeholder="abc@gmail.com">
					<span id="supplierEmailccError"></span>
				</div>
			</div> 
			<br>
			<div class="row">
				<div class="col-md-6">
					<label>Liability Type:</label><br>
					<input type="radio" name="supplierType"  value="deposit">Indirect Supplier <br>
					<input type="radio" name="supplierType"  value="full_pay">Direct Supplier <br>
					<input type="radio" name="supplierType"  value="ticket_ticker">Ticket Taker
				</div>
                            <div class="col-md-6">
                                <label>Select Country</label>
                                <select name="supplierCountry" id="supplierCountry" class="form-control">
                                    <option value="">--Select Country</option>
                                    <option value="Uk">Uk</option>
                                    <option value="Pk">Pk</option>
                                </select>
                                <span id="supplierCountryError"></span>
                            </div>
			</div>
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <label>Select Account Type:</label>
                                <select name="supplierHeadType" class="form-control" id="supplierHeadType">
                                    <option value="">--Select Head Type--</option>
                                    <option value="Assets">Assets</option>
                                    <option value="Expenses">Expenses</option>
                                    <option value="Liabilities">Liabilities</option>
                                    <option value="Income">Income</option>
                                    <option value="Capitals">Capitals</option>
                                </select>
                                <span id="supplierAccountTypeError"></span>
                            </div>
                            <div class="col-md-6"></div>
                        </div> -->
		  </div> 
		</div>
		<div class="modal-footer">
			<button type="button" id="supplierBtn" onclick="supplierSave()" style="position: relative;top: 3px;" class="btn btn-primary">Save</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	  </div> 
	  </form>
	</div>
</div>
<!--Supplier modal End-->
<!--Supplier modal start-->
<div class="modal fade success" id="EditsupplierModel" role="dialog">
	<div class="modal-dialog">
	  <form id="supplierFormEdit">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Edit Supplier</h4>
		</div>
		<div class="modal-body">
		  <div class="form-group">
			<div class="row">  
				<div class="col-md-6">
					<label>Supplier Name</label>
					<input type="hidden" name="" id="supplierIdHi">
					<input type="text" name="" onkeypress="removeerror('supplierNameError',this.id);" id="supplierNameEdit" class="form-control" placeholder="Create Supplier Name">
					<span id="supplierNameEditError"></span>
				</div> 
				<div class="col-md-6">
					<div class="form-group">
						<label>Supplier Bank</label>
						<input type="text" name="supplierBank" id="supplierBankEdit" placeholder="Supplier Bank Name" class="form-control" >
<!--                            <option value="">--Select One--</option>
						</select>-->
						<span id="supplierBankEditError"></span>
					</div>
				</div>
			</div> <br>
			<div class="row">  
				<div class="col-md-6">
					<label>Email:To </label>
					<input type="email" name="" id="supplierEmailTOEdit" class="form-control" placeholder="abc@gmail.com">
					<span id="supplierEmailTOErrorEdit"></span>
				</div> 
				<div class="col-md-6">
					<label>Email:Cc</label>
					<input type="email" name="" id="supplierEmailccEdit" class="form-control" placeholder="abc@gmail.com">
					<span id="supplierEmailccError"></span>
				</div>
			</div> 
		  </div> 
		</div>
		<div class="modal-footer">
			<button type="button" id="supplierBtnEdit" onclick="updateSupplier()" style="position: relative;top: 3px;" class="btn btn-success">Update</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div> 
	  </form>
	</div>
</div>
<!--Supplier modal End-->

<!-- Add Transaction Modal Payments to Supplier Start -->
	<div class="modal fade" id="supplierPatModal" role="dialog">
		<div class="modal-dialog modal-lg"> 
		  <!-- Modal content-->
		   <form  class="formInlineFlex" method="post"  id="transectionSupplierForm" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Transaction</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-10">
							<div class="row">
								<div class="col-md-4"> 
									<!--<form action="" class="form-inline">-->
										<label for="">Transaction Date: &nbsp;</label> 
										<input type="text" class="form-control nextDueDate" readonly="" style="width: 100% !important" name="transectionDate" id="TransactionDateSup"> 
										<div class="input-group"> 
											<div class="inner-addon right-addon">
												<i class="glyphicon glyphicon-calendar" style="top:-35px;"></i> 
											</div>
										</div> 
									<!--</form>--> 
								</div>
							</div> <br>
								<div class="row bdrBtm">
									<div class="col-md-8">
										<a href="javascript:void(0);" onclick="addDebit()">(+) Add One More Debit Entry</a>
									</div>
									<div class="col-md-4">
										<a href="javascript:void(0);" onclick="decrementDebit()">(-) Remove Last Debit Entry</a>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<table style="width: 100%;margin-top: 10px;">
											<tbody>
												<tr>
													<td>
															<input type="hidden" id="drCountSup" value="1">
															<div id="debitEntry">
																<div class="row" id="dr1">
																	<div class="col-md-6"> 
																		<label for="">To (Dr.): &nbsp;</label>
																		<select name="dr_pay_to"  class="form-control">
																			<option value="">--Select One--</option>
																			 <?php if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ ?>
																			<option value="<?php echo $supplierObjDr->supplier_name.'-supplier'; ?>"><?php echo $supplierObjDr->supplier_name.'  -  '. idToName('bank','id',$supplierObjDr->BankId,'bank_name'); ?></option>
																			 <?php } } ?>
																			<?php if(!empty($BankData)){ foreach ($BankData as $bankObj){ ?>
																			<option value="<?php echo $bankObj->bank_name.'-bank'; ?>"><?php echo $bankObj->bank_name; ?></option>
																			<?php } } ?>
																			<?php if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ ?>
																			<option value="<?php echo $expObj->expense_name.'-expense'; ?>"><?php echo $expObj->expense_name; ?></option>
																			<?php } } ?>
																		</select>
																	</div>
																	<div class="col-md-3"> 
																		<label for="">Amount (&pound;): &nbsp;</label>
																		<input type="text" name="dr_amount" id="supplierDrAmount" onkeyup="drTotalCount(this.value,'supTrsDrSum')" class="form-control"> 
																	</div>
																	<div class="col-md-3"> 
																		<label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
																		<input type="text" name="dr_booking_ref" id="supplierRefDr"  class="form-control"> 
																	</div>
																</div> 
															</div>
													</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td>
													   
															<div class="row">
																<div class="col-md-3 col-md-offset-6"> 
																	<label for="">Dr. Total &nbsp;</label>
																	<label for="" class="text-right" id="supTrsDrSum">0</label> 
																</div> 
															</div> 
													   
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div> <br>
								<div class="row bdrBtm">
									<div class="col-md-8">
										<a href="javascript:void(0);" onclick="addCredit()">(+) Add One More Credit Entry</a>
									</div>
									<div class="col-md-4">
										<a href="javascript:void(0);" onclick="decrementCredit()">(-) Remove Last Credit Entry</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table style="width: 100%;margin-top: 10px;">
											<tbody>
												<tr>
													<td>
														<!--<form action="" class="formInlineFlex">-->
															<input type="hidden" id="crCountSup" value="1">
															<div id="crEntry">
																<div class="row" id="cr1">
																	<div class="col-md-6"> 
																		<label for="">By (Cr.): &nbsp;</label>
																		<select name="cr_pay_by" class="form-control">
																			<option value="">--Select One--</option>
																			<?php if(!empty($supplierData)){ foreach($supplierData as $supplierObjCr){ ?>
																			<option value="<?php echo $supplierObjCr->supplier_name.'-supplier'; ?>"><?php echo $supplierObjCr->supplier_name.'  -  '. idToName('bank','id',$supplierObjCr->BankId,'bank_name'); ?></option>
																			 <?php } } ?>
																			<?php if(!empty($BankData)){ foreach ($BankData as $bankObj){ ?>
																			<option value="<?php echo $bankObj->bank_name.'-bank'; ?>"><?php echo $bankObj->bank_name; ?></option>
																			<?php } } ?>
																			<?php if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ ?>
																			<option value="<?php echo $expObj->expense_name.'-expense'; ?>"><?php echo $expObj->expense_name; ?></option>
																			<?php } } ?>
																		</select>
																	</div>
																	<div class="col-md-3"> 
																		<label for="">Amount (&pound;): &nbsp;</label>
																		<input type="text" name="cr_amount" id="supplierCrAmount" onkeyup="crTotalCount(this.value,'supTrsCrSum')" class="form-control"> 
																	</div>
																	<div class="col-md-3"> 
																		<label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
																		<input type="text" name="cr_booking_ref" id="supplierRefCr"  class="form-control"> 
																	</div>
																</div> 
															</div>
														<!--</form>-->
													</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td>
															<div class="row">
																<div class="col-md-3 col-md-offset-6"> 
																	<label for="">Cr. Total &nbsp;</label>
																	<label for="" class="text-right" id="supTrsCrSum">0</label>
																</div> 
															</div> 
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div><br>
								<div class="row">
									<table style="width: 100%;margin-top: 10px;">
										<tr>
											<td>
												<!--<form action="" class="formInlineFlex">-->
													<div class="row">  
														<div class="col-md-12"> 
															<label for="" style="width: 120px;">Description: &nbsp;</label>
															<input type="text" name="tr_description"  class="form-control"> 
														</div>
													</div> <br>
													<div class="row">  
														<div class="col-md-6"> 
															<label for="">Card No: &nbsp;</label>
															<input type="text" name="card_number"  class="form-control"> 
														</div>
														<div class="col-md-6"> 
															<label for="">Next Due Date: &nbsp;</label>
															<input type="text" name="next_due_Date" readonly=""  class="form-control nextDueDate"> 
															<i class="glyphicon glyphicon-calendar" style="top: 8px;right: 25px;font-size: 18px;"></i> 
														</div>
													</div> 
												<!--</form>-->
											</td>
										</tr>
									</table> 
								</div>  
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-round" >Save</button> 
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div> 
		   </form>
		</div>
	</div>
<!-- Add Transaction Modal Payments to Supplier End -->

<!-- Add Transaction Modal Receipts from Customer Start -->
	<div class="modal fade" id="transectionModalForCustomer" role="dialog">
		<div class="modal-dialog modal-lg">
		  <!-- Modal content-->
			<div class="modal-content">
				<form  class="formInlineFlex" method="post"  id="transectionCustomerForm" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Transaction</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-10">
							<div class="row">
								<div class="col-md-4">
									<input type="hidden" id="reloadField" name="reloadField">
									<input type="hidden" id="requestConfirmData" name="requestConfirmData">
									<input type="hidden" id="notifyType" name="notifyType">
									<!--<form action="" class="form-inline">-->
										<label for="">Transaction Date: &nbsp;</label> 
										<input type="text" class="form-control nextDueDate" readonly="" value="<?php echo date('Y-m-d'); ?>" style="width: 100% !important" name="transectionDate"> 
										<div class="input-group"> 
											<div class="inner-addon right-addon">
												<i class="glyphicon glyphicon-calendar" style="top:-35px;"></i> 
											</div>
										</div> 
									<!--</form>-->
								</div>
							</div> <br>
								<div class="row bdrBtm">
									<div class="col-md-8">
										<a href="javascript:void(0);" onclick="addDebitModel()">(+) Add One More Debit Entry</a>
									</div>
									<div class="col-md-4">
										<a href="javascript:void(0);" onclick="decrementDebitModel()">(-) Remove Last Debit Entry</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table style="width: 100%;margin-top: 10px;">
											<tbody>
												<tr>
													<td>
															<input type="hidden" id="drCountModel" value="1">
															<div id="debitEntryModel">
																<div class="row" id="drModel1">
																	<div class="col-md-6"> 
																		<label for="">To (Dr.): &nbsp;</label>
                                                                                                                                                <select name="dr_pay_to[]" id="drDropDownId" required=""  class="form-control">
																			<option value="">--Select One--</option>
																			<?php if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ ?>
																			<option value="<?php echo $supplierObjDr->supplier_name.'%supplier'; ?>"><?php echo $supplierObjDr->supplier_name.'-'.$supplierObjDr->BankId; ?></option>
																			 <?php } } ?>
																			<?php if(!empty($BankData)){ foreach ($BankData as $bankObj){ ?>
																			<option value="<?php echo $bankObj->bank_name.'%bank'; ?>"><?php echo $bankObj->bank_name; ?></option>
																			<?php } } ?>
																			<?php if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ ?>
																			<option value="<?php echo $expObj->expense_name.'%expense'; ?>"><?php echo $expObj->expense_name; ?></option>
																			<?php } } ?>
                                                                                                                                                        <?php if(!empty($IncomData)){ foreach($IncomData as $imcomeObj){ ?>
                                                                                                                                                        <option value="<?php echo $imcomeObj->head_name.'%income'; ?>"><?php echo $imcomeObj->head_name; ?></option>
                                                                                                                                                        <?php } } ?>
																		</select>
																	</div>
																	<div class="col-md-3"> 
																		<label for="">Amount (&pound;): &nbsp;</label>
																		<input type="text" name="dr_amount[]" id="drAmountPopCus" onblur="drTotalCount(this.value,'drSum')"  class="form-control"> 
																	</div>
																	<div class="col-md-3"> 
																		<label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
																		<input type="text" name="dr_booking_ref[]" id="customerDrRef"  class="form-control"> 
																	</div>
																</div> 
															</div>
													</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td>
														<div class="row">
															<div class="col-md-3 col-md-offset-6"> 
																<label for="">Dr. Total &nbsp;</label>
																<label for="" class="text-right" id="drSum">0</label> 
															</div> 
														</div> 
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div> <br>
								<div class="row bdrBtm">
									<div class="col-md-8">
										<a href="javascript:void(0);" onclick="addCreditModel()">(+) Add One More Credit Entry</a>
									</div>
									<div class="col-md-4">
										<a href="javascript:void(0);" onclick="decrementCreditModel()">(-) Remove Last Credit Entry</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table style="width: 100%;margin-top: 10px;">
											<tbody>
												<tr>
													<td>
														<input type="hidden" id="crCountModel" value="1">
															<div id="crEntryModel">
																<div class="row" id="crModel1">
																	<div class="col-md-6"> 
																		<label for="">By (Cr.): &nbsp;</label>
																		<select name="cr_pay_by[]" id="crDropDownId" required="" class="form-control">
																			<option value="">--Select One--</option>
																			<?php if(!empty($supplierData)){ foreach($supplierData as $supplierObjCr){ ?>
																			<option value="<?php echo $supplierObjCr->supplier_name.'%supplier'; ?>"><?php echo $supplierObjCr->supplier_name.'-'.$supplierObjCr->BankId; ?></option>
																			 <?php } } ?>
																			<?php if(!empty($BankData)){ foreach ($BankData as $bankObj){ ?>
																			<option value="<?php echo $bankObj->bank_name.'%bank'; ?>"><?php echo $bankObj->bank_name; ?></option>
																			<?php } } ?>
																			<?php if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ ?>
																			<option value="<?php echo $expObj->expense_name.'%expense'; ?>"><?php echo $expObj->expense_name; ?></option>
																			<?php } } ?>
                                                                                                                                                        <?php if(!empty($IncomData)){ foreach($IncomData as $imcomeObj){ ?>
                                                                                                                                                        <option value="<?php echo $imcomeObj->head_name.'%income'; ?>"><?php echo $imcomeObj->head_name; ?></option>
                                                                                                                                                        <?php } } ?>
																		</select>
																	</div>
																	<div class="col-md-3"> 
																		<label for="">Amount (&pound;): &nbsp;</label>
																		<input type="text" name="cr_amount[]" id="crAmountPopCus" onblur="crTotalCount(this.value,'crSum')" class="form-control"> 
																	</div>
																	<div class="col-md-3"> 
																		<label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
																		<input type="text" name="cr_booking_ref[]" id="customerCrRef"  class="form-control"> 
																	</div>
																</div> 
															</div>
													</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td>
													   <div class="row">
																<div class="col-md-3 col-md-offset-6"> 
																	<label for="">Cr. Total &nbsp;</label>
																	<label for="" class="text-right" id="crSum">0</label>
																</div> 
														</div>
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div><br>
								<div class="row">
									<table style="width: 100%;margin-top: 10px;">
										<tr>
											<td>
											   <div class="row">  
														<div class="col-md-12"> 
															<label for="" style="width: 120px;">Description: &nbsp;</label>
															<input type="text" name="tr_description"  class="form-control"> 
														</div>
													</div> <br>
													<div class="row">  
														<div class="col-md-6" style="display: inline-flex;"> 
															<label for="" style="width: 150px">Card No: &nbsp;</label>
															<input type="text" name="card_number"  class="form-control"> 
														</div>
														<div class="col-md-6" style="display: inline-flex;"> 
															<label for="" style="width: 150px">Next Due Date: &nbsp;</label>
															<input type="text" name="next_due_Date" id="" readonly="" class="form-control nextDueDate"> 
															<i class="glyphicon glyphicon-calendar" style="top: 8px;right: 25px;font-size: 18px;position: absolute;"></i>   
														</div>
													</div> 
											</td>
										</tr>
									</table> 
								</div>  
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-round">Save</button> 
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
				</form>
			</div> 
		</div>
	</div>
<!-- Add Transaction Modal Receipts from Customer End -->

<!-- Expense Modal -->
<div class="modal fade success" id="expenseModal" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <form id="expenseHeadForm">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Add New Expense</h4>
		</div>
		<div class="modal-body">
		  <div class="form-group">
			<div class="row">  
				<div class="col-md-6">
					<label>Expense Name:</label>
					<input type="text" name="" onkeypress="removeerror('expenseHeadNameError',this.id);" id="expenseHeadName" class="form-control" placeholder="Create Expense Head">
					<span id="expenseHeadNameError"></span>
				</div> 
				<div class="col-md-6">
					<label>Country of Expense:</label>
					<select name="" id="expenseType"  onchange="removeerror('expenseTypeError',this.id);" class="form-control">
						<option value="">--Select One--</option>
						<option value="uk">Uk</option>
						<option value="local">PK</option>
					</select>
					<span id="expenseTypeError"></span>
				</div>
			</div> 
                      <div class="row">
                          <div class="col-md-6">
                              <label>Brand:</label>
                              <select name="brandName" id="expenseBrand" class="form-control">
                                  <option value="">--Select Brand--</option>
                              </select>
                              <span id="expenseBrandError"></span>
                          </div>
                          <div class="col-md-6"></div>
                      </div>
		  </div> 
		</div>
		<div class="modal-footer">
			<button type="button" id="expenseBtnSave" onclick="expenseHeadSave()" style="position: relative;top: 3px;" class="btn btn-primary">Save</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	  </div> 
	  </form>
	</div>
</div>
<!-- Expense Modal End -->
<!-- Expense Edit Modal -->
<div class="modal fade success" id="expenseEditModal" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <form id="expenseHeadEditForm">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Expense Head Edit</h4>
		</div>
		<div class="modal-body">
		  <div class="form-group">
			<div class="row">  
				<div class="col-md-6">
					<label>Head Name</label>
					<input type="hidden" id="expenseUpdateId" >
					<input type="text" name="" onkeypress="removeerror('expenseHeadNameEditError',this.id);" id="expenseHeadEditName" class="form-control" placeholder="Create Expense Head">
					<span id="expenseHeadNameEditError"></span>
				</div> 
			</div> 
		  </div> 
		</div>
		<div class="modal-footer">
			<button type="button" id="expenseBtnUpdate" onclick="expenseHeadUpdate()" style="position: relative;top: 3px;" class="btn btn-success">Update</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div> 
	  </form>
	</div>
</div>
<!-- Expense Modal End -->

<!-- Delete Transaction Modal Receipts from Customer Start -->
	<div class="modal fade" id="DeleteTransaction" role="dialog">
		<div class="modal-dialog modal-lg"> 
		  <!-- Modal content-->
			<div class="modal-content">
				<form action="" class="formInlineFlex" method="post" id="transectionDeleteForm" >
					<input type="hidden" id="transectionNumberDelete">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete Transaction</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-10">
							<div class="row">
								<div class="col-md-3">
										<label for="">Transaction Date: &nbsp;</label> 
										<label id="transectiondate"></label>
								</div>
								<div class="col-md-9">
									<label for="">Trans. ID: &nbsp;</label>
									<label id="tranIdShow"></label>
								</div>
							</div> <br>
								<div class="row bdrBtm">
									<div class="col-md-8">
										<a href="javascript:void(0);" onclick="addDebit()">(+) Add One More Debit Entry</a>
									</div>
									<div class="col-md-4">
										<a href="javascript:void(0);" onclick="decrementDebit()">(-) Remove Last Debit Entry</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table style="width: 100%;margin-top: 10px;">
											<tbody>
												<tr>
													<td>
															<div id="debitEntry">
																<div class="row" id="dr1">
																	<div class="col-md-6"> 
																		<label for="">To (Dr.): &nbsp;</label>
																		<label id="drto"></label>
																	</div>
																	<div class="col-md-3"> 
																		<label for="">Amount (&pound;): &nbsp;</label>
																		<label id="dramount"></label>
																	</div>
																	<div class="col-md-3"> 
																		<label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
																		<label id="drbookingRef"></label>
																	</div>
																</div> 
															</div>
														</form>
													</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td>
														<div class="row">
																<div class="col-md-3 col-md-offset-6"> 
																	<label for="">Dr. Total &nbsp;</label>
																	<label for="" id="drtotal" class="text-right">0</label> 
																</div> 
															</div> 
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div> <br>
								<div class="row bdrBtm">
									<div class="col-md-8">
										<a href="javascript:void(0);" onclick="addCredit()">(+) Add One More Credit Entry</a>
									</div>
									<div class="col-md-4">
										<a href="javascript:void(0);" onclick="decrementCredit()">(-) Remove Last Credit Entry</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table style="width: 100%;margin-top: 10px;">
											<tbody>
												<tr>
													<td>
														<div>
																<div class="row">
																	<div class="col-md-6"> 
																		<label for="">By (Cr.): &nbsp;</label>
																		<label id="crby"></label>
																	</div>
																	<div class="col-md-3"> 
																		<label for="">Amount (&pound;): &nbsp;</label>
																		<label id="cramount"></label>
																	</div>
																	<div class="col-md-3"> 
																		<label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
																		<label id="crbookingref"></label>
																	</div>
																</div> 
														</div>
													</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td>
													   <div class="row">
																<div class="col-md-3 col-md-offset-6"> 
																	<label for="">Cr. Total &nbsp;</label>
																	<label for="" id="crtotal" class="text-right">0</label>
																</div> 
														</div>  
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div><br>
								<div class="row">
									<table style="width: 100%;margin-top: 10px;">
										<tr>
											<td>
												<div class="row">  
														<div class="col-md-12"> 
															<label for="" style="width: 120px;">Description: &nbsp;</label>
															<label id="description"></label> 
														</div>
													</div> <br>
													<div class="row">  
														<div class="col-md-6"> 
															<label for="">Card No: &nbsp;</label>
															<label id="transectionCard"></label>
														</div>
														<div class="col-md-6"> 
															<label for="">Next Due Date: &nbsp;</label>
															<label id="nextdatepay"></label> 
														</div>
													</div>
											</td>
										</tr>
									</table> 
								</div>  
							 </form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="deleteConfirmPayment()" class="btn btn-danger btn-round">Delete</button> 
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
				</form>
			</div> 
		</div>
	</div>
<!-- Edit Transaction Modal Receipts from Customer End -->

<!-- Edit Transaction Modal Receipts from Customer Start -->
	<div class="modal fade" id="EditTransaction" role="dialog">
		<div class="modal-dialog modal-lg"> 
		  <!-- Modal content-->
			<div class="modal-content">
				<form action="" class="formInlineFlex" method="post" id="transectionFormEdit" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Transaction</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
						<div class="row">    
							<div class="col-lg-3">
								<label for="">Transaction Date: &nbsp;</label>
								<input type="text" class="form-control nextDueDate"  style="width: 100% !important;cursor: pointer;" name="paymentDate" id="TransactionDateEditPopUp"> 
								<div class="input-group"> 
									<div class="inner-addon right-addon">
										<i class="glyphicon glyphicon-calendar" style="top:-35px;"></i> 
									</div>
								</div> 
							</div>
							<div class="col-lg-2" style="margin-top: 35px;">
								<label for="">Trans. ID: &nbsp;</label>
								<label id="tranIdShow"></label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<a href="javascript:void(0);" onclick="addDebitEditModel()">(+) Add One More Debit Entry</a>
							</div>
							<div class="col-md-6">
								<a href="javascript:void(0);" onclick="decrementDebitEditModel()">(-) Remove Last Debit Entry</a>
							</div>
						</div>
						<hr>
					</div>
					<input type="hidden" id="transectionEditId" name="editTransectionId[]" >
                                        <input type="hidden" id="drCountEditModel" value="1">
                                        <div id="drEntryModelEdit">
                                            <div class="row" id="drModel1">
							<div class="col-md-6">
								<label for="">To (Dr.): &nbsp;</label><br>

								<?php //print_r($supplierData);  ?>
                                                                <select name="dr_pay_to_Edit[]" id="dr_pay_to_Edit" required=""  class="form-control">
									<option value="">--Select One--</option>
									<?php if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ ?>
										<option value="<?php echo $supplierObjDr->supplier_name.'%supplier'; ?>"><?php echo $supplierObjDr->supplier_name.'-'.$supplierObjDr->BankId; ?></option>
									<?php } } ?>
									<?php if(!empty($BankData)){ foreach ($BankData as $bankObj){ ?>
										<option value="<?php echo $bankObj->bank_name.'%bank'; ?>"><?php echo $bankObj->bank_name; ?></option>
									<?php } } ?>
									<?php if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ ?>
										<option value="<?php echo $expObj->expense_name.'%expense'; ?>"><?php echo $expObj->expense_name; ?></option>
									<?php } } ?>
                                                                        <?php if(!empty($IncomData)){ foreach($IncomData as $imcomeObj){ ?>
                                                                        <option value="<?php echo $imcomeObj->head_name.'%income'; ?>"><?php echo $imcomeObj->head_name; ?></option>
                                                                        <?php } } ?>
								</select>
							</div>
							<div class="col-md-3">
								<label for="">Amount (&pound;): &nbsp;</label>
								<input type="text" name="dr_amountEdit[]" onblur="drTotalCount(this.value,'edittrsDrSum')" id="drAmountEdit"   class="form-control"> 
							</div>
							<div class="col-md-3">
								<label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
								<input type="text" name="dr_booking_refEdit[]" id="drBookingRefEdit"  class="form-control"> 
							</div>
							
						</div>
					</div>
                                        <div class="row" style="margin-top:8px;">
							<div class="col-md-3 col-md-offset-6">
								<label for="" class="text-muted">Dr. Total &nbsp;</label>
								<label for="" class="text-right text-muted" id="edittrsDrSum"></label> 
							</div>
                                        </div>
					<div class="form-group" style="margin-top: 20px;">
						<div class="row">
							<div class="col-md-6">
								<a href="javascript:void(0);" onclick="addCreditEditModel()">(+) Add One More Credit Entry</a>
							</div>
							<div class="col-md-6">
								<a href="javascript:void(0);" onclick="decrementCreditEditModel()">(-) Remove Last Credit Entry</a>
							</div>
						</div>
						<hr>
					</div>
                                        <input type="hidden" id="crCountEditModel" value="1">
					<div  id="crEntryEditModel">
						<div class="row" id="crEditModel1">
							<div class="col-md-6"> 
								<label for="">By (Cr.): &nbsp;</label>
                                                                <select name="cr_pay_by_Edit[]" id="cr_pay_to_Edit" required="" class="form-control">
									<option value="">--Select One--</option>
									<?php if(!empty($supplierData)){ foreach($supplierData as $supplierObjCr){ ?>
										<option value="<?php echo $supplierObjCr->supplier_name.'%supplier'; ?>"><?php echo $supplierObjCr->supplier_name.'-'.$supplierObjCr->BankId; ?></option>
									<?php } } ?>
									<?php if(!empty($BankData)){ foreach ($BankData as $bankObj){ ?>
										<option value="<?php echo $bankObj->bank_name.'%bank'; ?>"><?php echo $bankObj->bank_name; ?></option>
									<?php } } ?>
									<?php if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ ?>
										<option value="<?php echo $expObj->expense_name.'%expense'; ?>"><?php echo $expObj->expense_name; ?></option>
									<?php } } ?>
                                                                        <?php if(!empty($IncomData)){ foreach($IncomData as $imcomeObj){ ?>
                                                                        <option value="<?php echo $imcomeObj->head_name.'%income'; ?>"><?php echo $imcomeObj->head_name; ?></option>
                                                                        <?php } } ?> 
								</select>
							</div>
							<div class="col-md-3"> 
								<label for="">Amount (&pound;): &nbsp;</label>
								<input type="text" name="cr_amountEdit[]" onblur="crTotalCount(this.value,'editTrsCrSum')" id="crAmountEdit"  class="form-control"> 
							</div>
							<div class="col-md-3"> 
								<label for="">Booking Ref: &nbsp;</label>
								<input type="text" name="cr_booking_refEdit[]" id="bookingRefCrEdit" class="form-control"> 
							</div>
							
						</div>
						
					</div>
                                        <div class="row" style="margin-top:8px;">
                                            <div class="col-md-3 col-md-offset-6"> 
                                                    <label for="" class="text-muted">Cr. Total &nbsp;</label>
                                                    <label for="" class="text-right text-muted" id="editTrsCrSum">0</label>
                                            </div> 
                                        </div>
					<div class="form-group">
						<div class="row"> 
							<div class="col-lg-6">
								<label for="">Description: &nbsp;</label>
								<input type="text" name="tr_description" id="trasectionEditDescription"  class="form-control"> 
							</div>
							<div class="col-lg-3">
								<label for="">Card No: &nbsp;</label>
								<input type="text" name="card_number"  class="form-control">
							</div>
							<div class="col-lg-3">
								<label for="">Due Date:</label>
								<input type="text" name="next_due_Date" id="nextDueDate" style="cursor: pointer;"  class="form-control">
								<!-- <i class="glyphicon glyphicon-calendar" style="top: 8px;right: 25px;font-size: 18px;"></i>  -->
							</div>
						</div>
					</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-round">Update</button> 
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
				</form>
			</div> 
		</div>
	</div>
<!-- Edit Transaction Modal Receipts from Customer End -->



<!-- Resend Schedule Popup -->
<div class="modal fade" id="resendSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Resend Schedule</h4>
			</div>
			<form method="post" id="resendDataBooking" enctype="multipart/form-data" >
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>To</label>
									<input type="email" id="resendTo" name="resendTo" class="form-control"> 
									<input type="hidden" name="hiddenBooking" id="hiddenBookin" >
								</div>
								<div class="form-group">
									<label>From</label>
									<input type="email" id="resendFrom" name="resendFrom" class="form-control"> 
								</div>
								<div class="form-group">
									<label>Subject</label>
									<input type="text" id="resendScheduleSubject" name="resendSubject" class="form-control"> 
								</div>
								<div class="form-group">
									<label>Message</label>
									<input type="hidden" id="resendMessage" name="resendMessage"> 
									<!-- <textarea id="preMessage" name="resendMessage" rows="10" cols="30" class="form-control" ></textarea> -->
									<div class="richText"> 
									   <div class="richText-editor" id="richText-lkys15" contenteditable="true">
										   
										  </div>
									</div>
								</div>
								<div class="form-group">
									<label>Attachment</label>
									<input type="file" name="attachment" class="form-control"> 
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Send</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
					</div>
			</form>
		</div>
	</div>
</div>
<!-- Resend Schedule END -->


<!-- Payments Requests Delete Model Start -->
<div class="modal fade" id="TicketOrderRemoveModal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Ticket Order</h5>
			</div>
			<form method="post" id="RequestDeleteFormId">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<p style="font-size: 16px">From panels.sufitravelandtours.co.uk</p>
							</div>
							<div class="form-group">
								<label>Please enter reason to delete:</label> 
								<input type="text" class="form-control" id="whyRequestRemove" /> 
								<span id="requestRemoveError"></span>
								<input type="hidden" id="requestType">
								<input type="hidden" id="requtsBookingIdDelete">
								<input type="hidden" id="reqstIdDeletReqst">
								<input type="hidden" id="reqstAgentId">
								
							</div> 
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="button" class="btn btn-primary" onclick="doDeleteRequstDone()">Ok</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Payments Requests Delete Model End -->

<!-- Ticket Order Requests Delete Model Start -->
<div class="modal fade" id="TicketOrderRemoveModalTwo" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Ticket Order</h5>
			</div>
			<form method="post" id="RequestDeleteFormId2">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<p style="font-size: 16px">From panels.sufitravelandtours.co.uk</p>
							</div>
							<div class="form-group">
								<label>Please enter reason to delete:</label> 
								<input type="text" class="form-control" id="whyRequestRemove2" /> 
								<span id="requestRemoveError2"></span>
<!--                                <input type="hidden" id="requestType2">-->
								<input type="hidden" id="requtsBookingIdDelete2">
								<input type="hidden" id="reqstIdDeletReqst2">
								<input type="hidden" id="reqstAgentId2">
							</div> 
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="button" class="btn btn-primary" onclick="doDeleteRequstDone2()">Ok</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Ticket Order Requests Delete Model End -->


<!-- Ticket Send Receipt Popup -->
<div class="modal fade" id="SendReceipt" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Send Receipt</h5>
			</div>
			<form method="post" id="receiptSendForm" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12"> 
							<div class="form-group">
								<label>From:</label> 
								<input type="hidden" name="bookingIdhidenSendReceipt" id="bookingIdhidenSendReceipt">
								<input type="text" name="sendReceiptFrom" class="form-control"  id="sendReceiptFrom" /> 
							</div>
							<div class="form-group">
								<label>To:</label> 
								<input type="text" name="sendReceiptTo" class="form-control"  id="sendReceiptTo" /> 
							</div>
							<div class="form-group">
								<label>CC:</label> 
								<input type="text" name="sendReceiptCc" class="form-control"  id="sendReceiptCc" /> 
							</div>
							<div class="form-group">
								<label>Subject:</label> 
								<input type="text" name="sendReceiptSubject" class="form-control"  id="sendReceiptSubject" /> 
							</div>
							<div class="form-group">
								<label>Message:</label> 
								 <input type="hidden" id="receiptSendMessage" name="receiptSendMessage1"> 
								<!-- <textarea id="editor" name="sendReceipt" class="form-control"> -->
									<div class="row">
										<div class="col-md-12">
                                                                                    <textarea  name="receiptSendMessage" class="form-control content2" id="richText-moowvw"></textarea>
<!--											<div class="content" id="richText-moowvw" contenteditable="true" style="width:100%;height: 300px;overflow-y: scroll; border: 1px solid #d2d2d2;border-left: 3px solid blue;padding: 10px;">
									   
												  
											</div>-->
										</div>
									</div>
								<!-- </textarea> -->
							</div>
							<div class="form-group">
								<label>Attachment:</label> 
								<input type="file" name="attachment" class="form-control"  /> 
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="submit" class="btn btn-primary">Send</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Ticket Send Receipt Popup -->
<!-- Ticket Send Receipt Popup -->
<div class="modal fade" id="SendReceiptAgentSide" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Payment Receipt</h5>
			</div>
			<form method="post" id="receiptSendFormAgent" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12"> 
							<div class="form-group">
								<label>From:</label> 
								<input type="hidden" name="bookingIdhidenSendReceipt" id="bookingIdhidenSendReceiptAgent">
								<input type="text" name="sendReceiptFrom" class="form-control"  id="sendReceiptFromAgent" /> 
							</div>
							<div class="form-group">
								<label>To:</label> 
								<input type="text" name="sendReceiptTo" class="form-control"  id="sendReceiptToAgent" /> 
							</div>
<!--                            <div class="form-group">
								<label>CC:</label> 
								<input type="text" name="sendReceiptCc" class="form-control"  id="sendReceiptCcAgent" /> 
							</div>-->
							<div class="form-group">
								<label>Subject:</label> 
								<input type="text" name="sendReceiptSubject" class="form-control"  id="sendReceiptSubjectAgent" /> 
							</div>
							<div class="form-group">
								<label>Message:</label> 
								 <input type="hidden" id="receiptSendMessageAgent" name="receiptSendMessage"> 
								<!-- <textarea id="editor" name="sendReceipt" class="form-control"> -->
									<div class="row">
										<div class="col-md-12">
<!--                                                                                    <textarea class="richText-editor" id="richText-moowvw-Agent"></textarea>-->
											<div class="richText-editor" id="richText-moowvw-Agent" style="width:100%;height: 300px;overflow-y: scroll; border: 1px solid #d2d2d2;border-left: 3px solid blue;padding: 10px;">
									   
												  
											</div>
										</div>
									</div>
								<!-- </textarea> -->
							</div>
							<div class="form-group">
								<label>Attachment:</label> 
								<input type="file" name="attachment" class="form-control"  /> 
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="submit" class="btn btn-primary">Send</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Ticket Send Receipt Popup -->

<!-- Ticket Issuance Details Popup -->
<div class="modal fade" id="TicketIssuanceDetail" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Ticket Issuance Details <span style="color: red" id="ticketIsssenceTitle"></span></h5>
			</div>
			<form method="post" id="issueTicketForm">
				<div class="modal-body">
					<h4 style="color:darkcyan;">Issuance Details</h4>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Issuance Date:</label> 
								<input type="hidden" name="totalPassanerIssue" id="totalPassanerIssue">
								<input type="hidden" name="issueBookingId" id="issueBookingId">
								<!-- <div class="input-group"> 
									<div class="inner-addon right-addon">
										<i class="glyphicon glyphicon-calendar"></i> -->
								<input type="text" name="issueDate" readonly="" class="form-control" id="IssuanceDate" placeholder="YYYY-MM-DD"> 
									<!-- </div>
								</div>   -->
							</div> 
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Ticket Supplier:</label>  
								<input type="text" name="ticketSuplier" id="ticketSuplier" class="form-control">
<!--                                <select class="form-control"> 
									<option value="Travel Pack">Travel Pack</option>
									<option selected="selected" value="The Holiday Team">The Holiday Team</option>
									<option value="Global Travel">Global Travel</option>
									<option value="Ace Rooms">Ace Rooms</option>
								</select>-->
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Supplier Reference:</label> 
								<input type="text" name="supplierRefIssue" id="supplierRefIssue" class="form-control"  /> 
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>GDS:</label> 
								<input type="text" name="gdsIssue" id="gdsIssue" class="form-control">
<!--                                <select class="form-control">
									<option value="World-Span">World Span</option>
									<option selected="selected" value="Galileo">Galileo</option>
									<option value="Sabre">Sabre</option>
									<option value="Amadeus">Amadeus</option>
									<option value="Web">Web</option>
								</select>-->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>PNR:</label> 
								<input type="text" name="issuePnr" class="form-control" id="issuePnr" /> 
							</div> 
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Brand Name:</label> 
								<input type="text" name="issueBrand" class="form-control"  id="issueBrand" /> 
							</div> 
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Booking Note:</label> 
								<textarea name="" class="form-control" rows="1" ></textarea>
							</div> 
						</div>
					</div> 
					<div class="row">
						<div class="col-md-12 table-responsive">
							<h4 style="color:darkcyan;">Passengers List</h4>
							<table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
								<thead>
									 <tr>
										<th>Title</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Sur Name</th> 
										<th>Age (yrs)</th> 
										<th>Catagory</th>
										<th>eTicket No.</th> 
									</tr>
								</thead>
								<tbody id="passenderIssue"> 
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="submit" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Ticket Issuance Details Popup -->

<!--Edit Ticket Issuance Details Popup -->
<div class="modal fade" id="editTicketIssuanceDetail" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-center">Ticket Issuance Details <span style="color: red" id="ticketIsssenceTitleEdit"></span></h5>
			</div>
			<form method="post" id="issueTicketFormEdit">
				<div class="modal-body">
					<h4 style="color:darkcyan;">Issuance Details</h4>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Issuance Date:</label> 
								<input type="hidden" name="totalPassanerIssueEdit" id="totalPassanerIssueEdit">
								<input type="hidden" name="issueBookingIdEdit" id="issueBookingIdEdit">
								<!-- <div class="input-group"> 
									<div class="inner-addon right-addon">
										<i class="glyphicon glyphicon-calendar"></i> -->
								<input type="text" name="issueDateEdit" readonly="" class="form-control nextDueDate " id="IssuanceDateEdit" placeholder="YYYY-MM-DD"> 
									<!-- </div>
								</div>   -->
							</div> 
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Ticket Supplier:</label>  
								<input type="text" name="ticketSuplierEdit" id="ticketSuplierEdit" class="form-control">
<!--                                <select class="form-control"> 
									<option value="Travel Pack">Travel Pack</option>
									<option selected="selected" value="The Holiday Team">The Holiday Team</option>
									<option value="Global Travel">Global Travel</option>
									<option value="Ace Rooms">Ace Rooms</option>
								</select>-->
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Supplier Reference:</label> 
								<input type="text" name="supplierRefIssueEdit" id="supplierRefIssueEdit" class="form-control"  /> 
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>GDS:</label> 
								<input type="text" name="gdsIssueEdit" id="gdsIssueEdit" class="form-control">
<!--                                <select class="form-control">
									<option value="World-Span">World Span</option>
									<option selected="selected" value="Galileo">Galileo</option>
									<option value="Sabre">Sabre</option>
									<option value="Amadeus">Amadeus</option>
									<option value="Web">Web</option>
								</select>-->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>PNR:</label> 
								<input type="text" name="issuePnrEdit" class="form-control" id="issuePnrEdit" /> 
							</div> 
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Brand Name:</label> 
								<input type="text" name="issueBrandEdit" class="form-control"  id="issueBrandEdit" /> 
							</div> 
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Booking Note:</label> 
								<textarea name="" class="form-control" rows="1" ></textarea>
							</div> 
						</div>
					</div> 
					<div class="row">
						<div class="col-md-12 table-responsive">
							<h4 style="color:darkcyan;">Passengers List</h4>
							<table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
								<thead>
									 <tr>
										<th>Title</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Sur Name</th> 
										<th>Age (yrs)</th> 
										<th>Catagory</th>
										<th>eTicket No.</th> 
									</tr>
								</thead>
								<tbody id="passenderIssueEdit"> 
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="submit" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--Edit Ticket Issuance Details Popup -->

<!-- Cancel Booking Popup -->
<div class="modal fade success" id="cancelBooking" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-left">Cancel Booking&nbsp; <span style="color: red"  id="cancelMarkHeding"></span></h5>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>What is Cancellation Date?</label> 
								<input type="hidden" id="cacelBookId" >
								<div class="input-group"> 
									<div class="inner-addon right-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										<input type="text" class="form-control" readonly="" id="cancelationDate" placeholder="yyyy/mm/dd">
									</div>
								</div>  
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label for="">What is Reason of Cancellation?</label>
							<textarea  id="reasonCancel" rows="4" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: center;">
					<button type="button" class="btn btn-round btn-primary" onclick="doCancelBooking()" >Save</button>
					<button type="button" class="btn btn-round btn-danger" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-round btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Cancel Booking Popup -->

<!--Inquiry View Model -->
<div class="modal fade success" id="inquiryViewModel" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title text-left">Inquiry Details&nbsp; <span style="color: red" ></span></h5>
			</div>
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>
<!--Inquiry View Model -->

<!-- Income Model Start here -->
<div class="modal fade" id="incomeModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="incomeHeadForm">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabelIncome">Add New Income / Revenue</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Head of Income</label>
                                      <input type="text" class="form-control" name="incomeHead" id="incomeHead">
                                  </div>
                                  <div class="col-md-6">
                                      <label>Country of Income</label>
                                      <select class="form-control" name="incomeCountry" id="incomeCountry">
                                          <option value="">Select Country of Income</option>
                                          <option value="Uk">UK</option>
                                          <option value="Pk">PK</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Brand</label>
                                      <select class="form-control" name="incomeBrand" id="incomeBrand">
                                          <option value="">--Select Brand--</option>
                                      </select>
                                  </div>
                                  <div class="col-md-6"></div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="saveIncome()" class="btn btn-primary">Save</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
        </form>
    </div>
  </div>
</div>
<!-- Income Model end here -->