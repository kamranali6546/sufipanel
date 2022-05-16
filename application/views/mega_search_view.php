<!-- page content -->
<style>
    .trStyle
    {
        color: white;
        font-size: 22px; 
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
        color: #111 !important;
        font-weight: bold !important;
        font-size: 100%;
        
    }
    .consentNEW td label {
        font-weight: normal ;
    }
     td.label {
        font-weight: bold !important;
    }
    #editable .label {
        position: relative;
        top: 6px;
    }
    label, td {
        text-align: left !important;
    }
    table.tablColor tbody tr th label {
        color: #000 !important;
    }
    .consentNEW > tbody > tr:nth-child(n+2) > td:nth-child(1) {
        width: 20% !important
    }
    .consentNEW > tbody > tr:nth-child(n+2) > td:nth-child(2) {
        width: 30% !important
    }
    .input-group {
        width: 100%;
    }  
     
    /* Calendar Input Css */
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
    .right-addon input { padding-right: 30px;} 
    .vertical-align-bottom { vertical-align: bottom !important; } 
    .input-group {margin-bottom: 0px;}
    .input-group input { width: 100% !important; }
    .bdrBtm {
        border-bottom: 3px solid #b9b8b8;
    }
    .bdrBtm a{
        color: #0a7ff7;
        font-size: 15px;
    }
    .formInlineFlex .row .col-md-3, .formInlineFlex .row .col-md-6, .formInlineFlex .row .col-md-12 {
        display: inline-flex;
    }
    .formInlineFlex .row .col-md-3 label, .formInlineFlex .row .col-md-6 label, .formInlineFlex .row .col-md-12  label {
        width: 160px;
        position: relative;
        top: 10px;
    } 
    .adminClass
    {
      color:red !important;  
    }
    .agentClass
    {
        color:green !important;
    }
</style>
<script>
     $(document).ready(function() {  
//         if(CKEDITOR.instances['ticket_details'])
//         {
//            CKEDITOR.instances['ticket_details'].destroy();
//            
//         }
         //initSample();
    checkingFileStatusForPopUp();
    });
    function checkingFileStatusForPopUp()
    {
//        alert('sjh');
       var status= parseInt($('#bookingFileStatus').val());
       var vFlag=parseInt($('#vistorFlag').val());
       var cardCancellationCount=parseInt($('#countCardCancellationRemarks').val());
       var cashCancellationCount=parseInt($('#countCashCancellationRemarks').val());
       var refundCounV=parseInt($('#countRefundRemarks').val());
       var cahargeBackC=parseInt($('#countChargebackRemarks').val());
//       alert(status);
       if(status==3 && vFlag!=1 && (cardCancellationCount==0 || cardCancellationCount==''))
       {
           $('#cardCancellationModel').modal('show');
       }
       if(status==4 && vFlag!=1 && (cashCancellationCount==0 || cashCancellationCount==''))
       {
           $('#cashCancellationModel').modal('show');
       }
       if(status==5 && vFlag!=1 && (refundCounV==0 || refundCounV==''))
       {
           $('#refundModel').modal('show');
       }
       if(status==6 && vFlag!=1 && (cahargeBackC==0 || cahargeBackC==''))
       {
           $('#chargeBackModel').modal('show');
       }
       
    }
</script>
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Booking Details <?php echo $companyCode; ?></h3>
                    </div>
                    <div class="title_right">
                        <a class="btn btn-danger btn-round pull-right" href="<?php echo site_url('Pending'); ?>">Back</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row" id="TicketOrderError" style="display: none;">
                    <div class="col-md-8 col-md-offset-2">
                        <div id="putMess" class="alert alert-danger alert-dismissable" style="color:#fff;font-size: 16px;font-weight: bold;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            
                        </div>
                    </div>
                </div>
                <?php
                //print_r($pendingBookingData);
                $obj=$pendingBookingData[0];
                ?>
                <input type="hidden" value="<?php echo $obj->file_status; ?>" id="bookingFileStatus" >
                <input type="hidden" value="<?php  echo $this->session->userdata('flag') ?>" id="vistorFlag">
                <input type="hidden" value="<?php echo $this->session->userdata('userId') ?>" id="vistorId">
                <input type="hidden" value="<?php if(isset($countcardCanelRemarks)){ echo $countcardCanelRemarks; } ?>" id="countCardCancellationRemarks" >
                <input type="hidden" value="<?php if(isset($countcashCanelRemarks)){ echo $countcashCanelRemarks; } ?>" id="countCashCancellationRemarks" >
                <input type="hidden" value="<?php if(isset($refundRemarksCount)){ echo $refundRemarksCount; } ?>" id="countRefundRemarks" >
                <input type="hidden" value="<?php if(isset($chargeBackCount)){ echo $chargeBackCount ; } ?>" id="countChargebackRemarks" >
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-condensed consentNEW" width="100%">
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><?php if(!empty($pendingTask) || !empty($ticketorder)){ ?><label><u>Pending Tasks:</u></label><?php } ?></td>
                            </tr> 
                            <?php  if(!empty($pendingTask)){ ?>
                            <tr>
                                <td colspan="12">
                                    <p>I) Payments & Others</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <table class="table">
                                        <tr>
                                            <th width="8%" scope="col">S.No</th>
                                            <th width="24%" scope="col">Payment Date</th>
                                            <th width="25%" scope="col">Payment Type</th>
                                            <th width="15%" scope="col">Amount</th>
                                            <th width="28%" scope="col">Ref</th>
                                        </tr>
                                        <?php $srNo=1; foreach($pendingTask as $pendingTaskObj){ ?>
                                        <tr>
                                            <td><?php echo $srNo; ?></td>
                                            <td><?php echo $pendingTaskObj->requestDate; ?></td>
                                            <td><?php echo $pendingTaskObj->requestType;  ?></td>
                                            <td><?php echo $pendingTaskObj->requestAmount; ?></td>
                                            <td><?php echo $pendingTaskObj->requestReference; ?></td>
                                        </tr>
                                        <?php $srNo++; } ?>
                                    </table>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php if(!empty($ticketorder)){ ?>
                            <tr>
                                <td colspan="12">
                                    <p>II) Tickets</p>
                                </td>
                            </tr>
                            <tr>
                                
                                <table class="table tablColor table-condensed consentNEW" width="100%" style="margin-top: -25px;">
                                    <tr>
                                        <th style="max-width: 105px;min-width: 102px;text-align: left;padding-left: 0px;"><label class="label">S.No</label></th>
                                        <th style="min-width: 120px;text-align: left;padding-left: 0px;"><label class="label">Priority</label></th>
                                        <th style="min-width: 120px;text-align: left;padding-left: 0px;"><label class="label">Supplier</label></th>
                                        <th style="min-width: 120px;text-align: left;padding-left: 0px;"><label class="label">Supplier Ref</label></th>
                                        <th style="min-width: 120px;text-align: left;padding-left: 0px;"><label class="label" >GDS</label></th>
                                        <th style="min-width: 100px;text-align: left;padding-left: 0px;"><label class="label">PNR</label></th>
                                        <th style="min-width: 180px;text-align: left;padding-left: 0px;"><label class="label">Message</label></th>
                                        <th style="min-width: 100px;text-align: left;padding-left: 0px;"><label class="label">Ticket Cost</label></th> 
                                    </tr> 
                                   <?php if (!empty($ticketorder)){ $tivketSr=1; foreach($ticketorder as $ticketOrerObj){  ?>
                                    <tr>
                                        <td><?php echo $tivketSr; ?></td>
                                        <td><?php echo $ticketOrerObj->priorty; ?></td>
                                        <td><?php echo $ticketOrerObj->supplierName; ?></td>
                                        <td><?php echo $ticketOrerObj->supplierReference; ?></td>
                                        <td><?php echo $ticketOrerObj->gds; ?></td>
                                        <td><?php echo $ticketOrerObj->pnr; ?></td>
                                        <td><?php echo $ticketOrerObj->message; ?></td>
                                        <td><?php echo $ticketOrerObj->issueCost; ?></td>
                                    </tr>
                                   <?php } } ?>
                                </table>
                            </tr>
                            <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-condensed consentNEW" width="100%">
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label style="font-size:14px;"><u>Booking Log:</u></label></td>
                            </tr>  
                           
                            <tr>
                                <td colspan="12">
                                    <div id="bookingnotes">
                                        <?php if(!empty($bookingEvents)){
                                            foreach ($bookingEvents as $eventObj)
                                            {
                                                $dateArray=  explode(' ', $eventObj->date);
                                                $flag=idToName('admin','id',$eventObj->agent_id,'flag');
                                                $class='';
                                                if($flag==1)
                                                {
                                                    $class='adminClass';
                                                }
                                                else
                                                {
                                                    $class='agentClass';
                                                }
                                                echo '<p class="'.$class.'"><strong>'.idToName('admin','id',$eventObj->agent_id,'login_name').'</strong> ('.date('d-M-y',  strtotime($dateArray[0])).'  '.date('h:m:i:a',  strtotime($dateArray[1])).' ): ('.$eventObj->event_type.')   '.$eventObj->event.'</p>';
                                            }
                                            
                                        } ?>                                    
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <div id="readonlyView">
                        <table class="table table-condensed consentNEW" width="100%">
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label style="font-size:14px;"><u><b>Booking Details:</b></u></label></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Booking Date:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->booking_date.' '.$obj->bookingTime; ?></label>
                                    <!--<input type="text" name="bookingDate" id="bookingDate" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly="">-->
                                </td>
                                <td colspan="3" class="text-left"><label class="label">Booking Agent:</label></td>
                                <td colspan="3">
                                    <label><?php echo idToName('admin','id',$obj->booked_agent_id,'login_name'); ?></label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Supplier Name:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->supplier_name; ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Supplier's Agent's Email:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->supplier_agent_name; ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Supplier Reference:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->supplier_ref; ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Booking Under Brand:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo idToName('company','id',$obj->company,'company_name'); ?></label>
                                </td>
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label style="font-size:14px;"><u><b>Customer Contacts:</b></u></label></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Full Name:</label>
                                </td>
                                 <td colspan="3">
                                     <label><?php echo $obj->fullname; ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Customer Email:</label>
                                </td>
                                 <td colspan="3">
                                     <label><?php echo $obj->email; ?></label>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Line Number:</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><?php echo $obj->line_number; ?></label>
                                        </div>
                                        <div class="col-md-8" style="display: inline-flex;">
                                            <label class="label">Mobile:</label>
                                            <label><?php echo $obj->mobile; ?></label>
                                        </div>
                                    </div>
                                    
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Booking Source:</label>
                                </td>
                                <td colspan="3"> 
                                    <label><?php echo $obj->source_of_booking; ?></label>  
                                </td>
                            </tr> 
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label style="font-size:14px;"><u><b>Flight Details:</b></u></label></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Departure Airport:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->departure; ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Destination airport:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->destination; ?></label>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Flight Type:</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label><?php echo $obj->flight_type; ?></label>
                                        </div>
                                        <div class="col-md-6" style="display: inline-flex;">
                                            <label class="label">GDS:</label>
                                            <label><?php echo $obj->gds; ?></label>
                                        </div>
                                    </div> 
                                </td> 
                                <td colspan="3" class="text-left">
                                    <label class="label">Flight Class:</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label><?php echo $obj->flight_class; ?></label>
                                        </div>
                                        <div class="col-md-7" style="display: inline-flex;">
                                            <label class="label">Segments:</label>
                                            <label><?php echo $obj->number_Of_segment; ?></label> 
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Going stopover:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->via; ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Returning stopover:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->returningVia; ?></label>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Departure Date & Time:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->departure_date.' '.$obj->departedTime; ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Returning Date & Time:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->returnDate.' '.$obj->returnTime; ?></label>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Airline:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->airline; ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <!-- <label class="label">Flight No.</label> -->
                                    <label class="label">PNR:</label>
                                </td>
                                <td colspan="3">
                                    <!-- <div class="row">
                                        <div class="col-md-5">
                                            <label><?php echo $obj->flight_number; ?></label>
                                        </div>
                                        <div class="col-md-7" style="display: inline-flex;">
                                            
                                        </div>
                                    </div> -->
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><?php echo $obj->pnr; ?></label>
                                        </div>
                                        <div class="col-md-8" style="display: inline-flex;">
                                            <label class="label">Airline Locator:</label>
                                            <label><?php echo $obj->airlineLocatore;  ?></label>
                                        </div>
                                    </div>
                                </td> 
                            </tr>  
                            <tr>
                                 
                                <td colspan="3" class="text-left">
                                    <label class="label">PNR Expiry Date & Time:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->pnrExpiryDate.' '.$obj->pnrExpiryTime; ?></label>
                                </td> 
                                <!-- <td>
                                    <label><?php //echo $obj->pnrExpiryTime; ?></label>
                                </td> -->
                                <td colspan="3" class="text-left">
                                    <label class="label">Fare Expiry Date & Time:</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->fareExpiryDate.' '.$obj->fareExpiryTime; ?></label>
                                </td> 
                                <!-- <td>
                                    <label><?php //echo $obj->fareExpiryTime; ?></label>
                                </td> -->
                            </tr> 
                            
                            
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label">Flight Details for Customer:</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <div style="color: black;margin-left: 22%;" >
                                          <?php echo '<pre style="padding: 0px;background: none;">'; echo $obj->ticketDetails;  echo '</pre>'; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                    <td colspan="12" class="text-right">
                                       
                                    </td>
                                </tr>
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label">Flight Details for System:</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <div style="color: black;margin-left: 22%;" class="">
                                        <?php echo '<pre style="padding: 0px;background: none;">';
                                           echo $obj->systemFlightDetails;
                                            echo '</pre>';
                                            ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="trStyle text-left">
                                <td colspan="12" class="hedingTd text-left"><label style="font-size:14px;"><u>Ticket Cost:</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label" style="font-size: 14px;">I) Payable to Supplier (&pound;):&nbsp;<label style="font-size: 14px;color: red;"><?php echo round(ticketCost($id),2); ?></label></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label" style="position: relative;right: -175px; float: right;">Basic Fare(&pound;):</label>
                                </td>
                                <td colspan="3"> 
                                    <label style="position: relative;float: right;"><?php echo $obj->basic_fare; ?></label> 
                                </td>   
                                <td colspan="3">
                                    <label class="label">Tax(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->tax; ?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left"> 
                                    <label class="label" style="position: relative;right: -175px; float: right;">APC(&pound;):</label> 
                                </td>
                                <td colspan="3">
                                    <label style="position: relative;float: right;"><?php echo $obj->apc; ?></label> 
                                </td>
                                <td colspan="3">
                                    <label class="label">SAFI(&pound;):</label>
                                </td>
                                <td colspan="3"> 
                                    <label><?php echo $obj->sufi; ?></label> 
                                </td> 
                                
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left"> 
                                    <label class="label" style="position: relative;right: -175px; float: right;">Misc(&pound;):</label>
                                </td>
                                <td colspan="3" class="text-left"> 
                                    <label style="position: relative;float: right;"><?php echo $obj->misc; ?></label>
                                    <span style="font-size: 12px; position: relative;top: 15px;">Admin charges etc.</span>
                                </td> 
                                <td colspan="3" class="text-left">
                                    <!--<label class="label">File Status:</label>-->
                                </td>
                                <td colspan="3">
                                    <!--<label><?php //echo fileStatus($obj->file_status); ?></label>-->
                                </td>
                                
                            </tr>
<!--                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">APC(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="supplier_agent" class="form-control" id="" placeholder="">
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">SAFI(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="supplier_agent" class="form-control" id="" placeholder="">
                                </td> 
                            </tr> -->  
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label" style="font-size: 14px;">II) Additional Expenses(&pound;):&nbsp;<label style="font-size: 14px;color: red;"><?php echo (ticketCharges($id)+ticketChargesAditional($id)); ?></label></label>
                                </td> 
                            </tr> 
                            <tr>
<!--                            <td colspan="3" class="text-left">
                                    <label class="label">Bank Charges(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <label><?php if(!empty($bankCharges)){ echo $bankCharges[0]->bankCharges;} ?></label>
                                </td>-->
                                <td colspan="3" class="text-left" <?php if(!empty($transectionCharges)){ if($transectionCharges[0]->transectionCharges==''){ ?>style="display: none" <?php } } ?> >
                                    <label class="label" style="position: relative;right: -175px; float: right;">Transaction Charges(&pound;):</label>
                                </td>
                                <td colspan="3" <?php if(!empty($transectionCharges)){ if($transectionCharges[0]->transectionCharges==''){ ?>style="display: none" <?php } } ?> >
                                    <label style="position: relative;float: right;"><?php if(!empty($transectionCharges)){ echo $transectionCharges[0]->transectionCharges; } ?></label>
                                </td> 
                                <td colspan="3" class="text-left" <?php if(!empty($cardCharges)){ if($cardCharges[0]->card_charges==''){ ?>style="display: none" <?php }  } ?>>
                                    <label class="label">Card Charges(&pound;):</label>
                                </td>
                                <td colspan="3" <?php if(!empty($cardCharges)){ if($cardCharges[0]->card_charges==''){ ?>style="display: none" <?php }} ?> >
                                    <label><?php if(!empty($cardCharges)){  echo $cardCharges[0]->card_charges; }  ?></label>
                                </td> 
                            </tr>
                            <tr> 
                                <td colspan="3" class="text-left">
                                    <label class="label" style="position: relative;right: -175px; float: right;">Bank Charges(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <label style="position: relative;float: right;"><?php echo $obj->bank_charges; ?></label>
                                </td> 
                                <td colspan="3" class="text-left">
                                    <label class="label">Misc.(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->addit_misc; ?></label>
                                </td> 
                            </tr>
                            <tr> 
                                <td colspan="3" class="text-left">
                                    <label class="label" style="position: relative;right: -175px; float: right;">Postage(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <label style="position: relative;float: right;"><?php echo $obj->postage; ?></label>
                                </td> 
                                <td colspan="3" class="text-left">
                                    <label class="label">Card Charges(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <label><?php echo $obj->card_charges; ?></label>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="3">
                                
                                </td>
                                <td colspan="3" <?php if($obj->cardRefund!=0 && $obj->file_status==5){ ?> style=""<?php }else{ ?> style="display: none;" <?php } ?> >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="label">Card Refund (&pound;):</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label"><?php echo $obj->cardRefund; ?></label>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="3" <?php if($obj->againTransection!=0 && $obj->file_status==5){ ?> style=""<?php }else{ ?> style="display: none;" <?php } ?>>
                                    <label class="label">Again Transaction Charges (&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-4" <?php if($obj->againTransection!=0 && $obj->file_status==5){ ?> style=""<?php }else{ ?> style="display: none;" <?php } ?> >
                                            <label class="label"><?php echo $obj->againTransection; ?></label>
                                        </div>
                                        <div class="col-md-8" <?php if($obj->cashRefund!=0 && $obj->file_status==5){ ?> style="display: inline-flex;" <?php }else{ ?> style="display: none;" <?php } ?> >
                                            <label class="label">Cash Refund (&pound;):</label>
                                            <label class="label"><?php echo $obj->cashRefund; ?></label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr <?php if($obj->file_status==6){ ?> style="" <?php }else{ ?> style="display: none" <?php } ?> >
                                <td colspan="3">
                                
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="label">Charged Back Amount (&pound;):</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label"><?php echo $obj->chargebackAmount; ?></label>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="3">
                                    <label class="label">Plenty(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="label"><?php echo $obj->chargeback_plenty; ?></label>
                                        </div> 
                                    </div>
                                </td>
                            </tr>
                            <tr>
<!--                                <td colspan="3" class="text-left">
                                    <label class="label">APC Payable(&pound;):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="" class="form-control" id="" placeholder="">
                                </td>-->
                               
                            </tr>
                            <?php if($this->session->userdata('flag')!=1){ 
                                ?>
                                <tr>
                                    <td colspan="12" class="text-left">
                                        <label class="label" style="font-size: 14px;">Total Cost(&pound;)</label>:<label style="font-size: 14px;color: red;"><?php echo (ticketCost($id)+ticketCharges($id)+ticketChargesAditional($id)); ?></label>
                                       
                                    </td> 
                                </tr>
                                <?php 
                                
                            } else{ ?>
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label" style="font-size: 14px;">Total Cost(&pound;)</label>:<label style="font-size: 14px;color: red;"><?php echo (ticketCost($id)+ticketCharges($id)+ticketChargesAditional($id)); ?></label>
                                   
                                </td> 
                            </tr>
                            <?php } ?>
                        </table>
                        </div>
                        <div id="editable" style="display: none">
                            <form method="post" name="frmUpdate"  id="BookingFormUpdate"  onsubmit="return updateBooking('BookingFormUpdate')">
                                <input type="hidden" name="bookingID" value="<?php echo $id; ?>">
                                <table class="table table-condensed consentNEW" width="100%">
                                     <tr class="trStyle">
                                        <td colspan="12" class="hedingTd"><label><u>Booking Details:</u></label></td>
                                     </tr>
                                        <tr>
                                            <td colspan="3" class="text-left">
                                                <label class="label">Booking Date:</label>
                                            </td>
                                            <td colspan="3">
                                                <input type="text" name="bookingDate" id="bookingDate" value="<?php echo $obj->booking_date.' '.$obj->bookingTime; ?>" class="form-control" readonly="" disabled="disabled">
                                            </td>
                                            <td colspan="3" class="text-left"><label class="label">Booking Agent:</label></td>
                                            <td colspan="3"><input type="hidden" name="bookingAgentID"  value="<?php echo $obj->booked_agent_id; ?>"><input type="text" value="<?php echo idToName('admin','id',$obj->booked_agent_id,'login_name'); ?>" name="booking_agent" class="form-control" readonly=""></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-left">
                                                <label class="label">Supplier Name:</label>
                                            </td>
                                            <td colspan="3">
                                                <select class="form-control" name="supplier_name">
                                                    <option value="">--Select One--</option>
                                                     <?php if(!empty($supplierData)){ foreach($supplierData as $spObj){ if($spObj->supplier_name!='Customer'){ ?>
                                                        <option  value="<?php echo $spObj->supplier_name; ?>" <?php if($obj->supplier_name==$spObj->supplier_name){ ?> selected="selected" <?php } ?> ><?php echo $spObj->supplier_name; ?></option>
                                                    <?php } } } ?>
<!--                                                    <option <?php if($obj->supplier_name=="Brightsun Travel"){ ?> selected="selected" <?php } ?> value="Brightsun Travel">Brightsun Travel</option>
                                                    <option <?php if($obj->supplier_name=="Travel Pack"){ ?> selected="selected" <?php } ?> value="Travel Pack">Travel Pack</option>
                                                    <option <?php if($obj->supplier_name=="Skylords Travels"){ ?> selected="selected" <?php } ?> value="Skylords Travels">Skylords Travels</option>
                                                    <option <?php if($obj->supplier_name=="Crystal Travels"){ ?> selected="selected" <?php } ?> value="Crystal Travels">Crystal Travels</option>
                                                    <option <?php if($obj->supplier_name=="Citibond Travels"){ ?> selected="selected" <?php } ?> value="Citibond Travels">Citibond Travels</option>
                                                    <option <?php if($obj->supplier_name=="Greaves Travels"){ ?> selected="selected" <?php } ?> value="Greaves Travels">Greaves Travels</option>
                                                    <option <?php if($obj->supplier_name=="Euro Africa Travels"){ ?> selected="selected" <?php } ?> value="Euro Africa Travels">Euro Africa Travels</option>
                                                    <option <?php if($obj->supplier_name=="Kevin McPhillips"){ ?> selected="selected" <?php } ?> value="Kevin McPhillips">Kevin McPhillips</option>
                                                    <option <?php if($obj->supplier_name=="Master Fare"){ ?> selected="selected" <?php } ?> value="Master Fare">Master Fare</option>
                                                    <option <?php if($obj->supplier_name=="Med View Airline"){ ?> selected="selected" <?php } ?> value="Med View Airline">Med View Airline</option>
                                                    <option <?php if($obj->supplier_name=="Global Travel"){ ?> selected="selected" <?php } ?> value="Global Travel">Global Travel</option>
                                                    <option <?php if($obj->supplier_name=="Reliance Travels"){ ?> selected="selected" <?php } ?> value="Reliance Travels">Reliance Travels</option>
                                                    <option <?php if($obj->supplier_name=="The Holiday Team"){ ?> selected="selected" <?php } ?> value="The Holiday Team">The Holiday Team</option>
                                                    <option <?php if($obj->supplier_name=="Airline"){ ?> selected="selected" <?php } ?> value="Airline">Airline</option>-->
                                                </select>
                                            </td>
                                            <td colspan="3" class="text-left">
                                                <label class="label">Supplier's Agent's Email:</label>
                                            </td>
                                            <td colspan="3">
                                                <input type="text" name="supplierAgent" value="<?php echo $obj->supplier_agent_name; ?>" class="form-control" onkeypress="removeerror('supplier_agentError',this.id);"  id="supplierAgent" placeholder="Please Put Supplier Agent Email">
                                                <span id="supplier_agentError" ></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-left">
                                                <label class="label">Supplier Reference:</label>
                                            </td>
                                            <td colspan="3">
                                                <input type="text" name="ibe" value="<?php echo $obj->supplier_ref; ?>" onkeypress="removeerror('ibeError',this.id);" onkeyup="alphaNumeric('ibeError',this.id)" id="ibe" class="form-control" placeholder="Put supplier reference" > 
                                                <span id="ibeError"></span>
                                            </td>
                                            <td colspan="3" class="text-left">
                                                <label class="label">Booking Under Brand:</label>
                                            </td>
                                            <td colspan="3">
                                                <select name="booking_brand" class="form-control" onchange="removeerror('bookingbrandError',this.id)" id="booking_brand">
                                                     <?php if($this->session->userdata('flag')==1 && $this->session->userdata('company')==1){ ?>
                                                        <option value="">--Select One--</option>
                                                        <?php foreach($copany as $ourComy){ ?>
                                                        <option value="<?php echo $ourComy->id; ?>" <?php if($obj->company==$ourComy->id){ ?> selected="selected" <?php } ?> ><?php echo $ourComy->company_name; ?></option>
                                                        <?php } ?>
                                                        <?php }
                                                        else{
                                                            ?>
                                                        <option value="">--Select One--</option>
                                                            <?php 
                                                          foreach($copany as $otherCompObj)
                                                          {
                                                             ?>
                                                                <option value="<?php echo $otherCompObj->id ?>" <?php if($otherCompObj->id==$obj->company){ ?> selected="selected" <?php } ?> ><?php echo $otherCompObj->company_name; ?></option>
                                                            <?php 
                                                          } 
                                                        } ?>
                                                </select>
                                                <span id="bookingbrandError"></span>
                                            </td>
                                        </tr>
<!--                                        <tr class="trStyle">
                                    <td colspan="12" class="hedingTd"><label><u>Receipt Details:</u></label></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Paying By:</label>
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select class="form-control" name="paying_method" required="" id="payingMethod" onchange="payingMethodCheckUpdate(this.value);removeerror('payingError',this.id);">
                                                    <option value="">--Select One--</option>
                                                    <option value="Bank" <?php if($obj->paying_by=="Bank"){ ?> selected="selected" <?php } ?> >Bank</option>
                                                    <option value="Card" <?php if($obj->paying_by=="Card"){ ?> selected="selected" <?php } ?>>Card</option>
                                                </select>
                                                <span id="payingError"></span>
                                            </div>
                                            <div class="col-md-8" style="display: inline-flex;"> 
                                                    <label class="label">New Booking Charge:</label> 
                                                    <input type="text" name="amountCharged" value="<?php echo $obj->newbookingChargeAmount; ?>" class="form-control" onkeypress="return isNumberKey(event);removeerror('amountChargeError',this.id);" id="amountCharged" placeholder="Put Amount Number Without &pound; or GBP">
                                                     <span id="amountChargeError"></span> 
                                            </div>
                                        </div> 
                                    </td>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Payment due Date & Time:</label>
                                    </td>
                                    <td colspan="3">
                                    	<div class="input-group"> 
	                                          <div class="inner-addon right-addon">
		                                          <i class="glyphicon glyphicon-calendar"></i>
		                                          <input type="text" name="paymentDueDate" value="<?php echo $obj->paymentDue_date.' '.$obj->paymentDueTime; ?>" readonly="" onclick="removeerror('paymentDueDateError',this.id)" class="form-control" id="paymentDueDate" placeholder="Enter The Date & Time">
                                        		<span id="paymentDueDateError"></span>
	                                        </div>
	                                    </div>   
                                    </td>
                                    <td class="input-group bootstrap-timepicker timepicker">
                                        <input type="text" name="paymentDueTime" <?php echo $obj->paymentDueTime; ?> readonly="" class="form-control" id="timepicker1" placeholder="">
                                           <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                    </td>
                                </tr> 
                                <tr id="cardRowedit" <?php if($obj->paying_by=="Bank"){ ?> style="display:none;"<?php } else{ ?> <?php } ?> >
                                    <td colspan="3" class="text-left">
                                        <label class="label">Card Number:</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="password" name="cardNumber" value="<?php echo $obj->card_number; ?>" class="form-control" maxlength="16" onkeypress="return isNumberKey(event);removeerror('cardNumberError',this.id);" id="cardNumber" placeholder="Just Card Numbers" onblur="cardValidCheck(this.value)">
                                         <span id="cardNumberError"></span>
                                    </td>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Issuing Bank:</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" value="<?php echo $obj->cardIssuingBank ?>" class="form-control" name="issuingBank" id="issuingBank" readonly="" placeholder="Issuing Bank">

                                    </td>
                                </tr>
                                <tr id="cardRow2edit" <?php if($obj->paying_by=="Bank"){ ?> style="display: none;"<?php } else{ ?> <?php } ?> >
                                    <td colspan="3" class="text-left">
                                        <label class="label">Card Holder Name:</label>
                                    </td>
                                     <td colspan="3">
                                         <input type="text" name="cardHolderName" value="<?php echo $obj->cardHolderName; ?>" onkeypress="removeerror('cardHolderError',this.id);" onkeyup="onlyletterWithSpace('cardHolderError',this.id)" class="form-control" id="cardHolderName" placeholder="Card Holder Name">
                                        <span id="cardHolderError"></span>
                                    </td>
                                    <td colspan="3" class="text-left">
                                    <label class="label">Valid From:</label>
                                        
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="text" maxlength="5" value="<?php echo $obj->validFrom; ?>" name="validFrom" class="form-control" onkeypress="removeerror('validFromError',this.id);" id="validFrom" placeholder="mm/yy">
                                                <span id="validFromError"></span>
                                                
                                            </div>
                                            <div class="col-md-7" style="display: inline-flex;">
                                                <label class="label">Expiry Date:</label>
                                                <input type="text" maxlength="5" name="cardExpiryDate" value="<?php echo $obj->expiryDate; ?>" class="form-control" onkeypress="removeerror('expiryDateError',this.id);" id="cardExpiry"  placeholder="mm/yy">
                                                <span id="expiryDateError"></span>
                                            </div>
                                        </div> 
                                    </td>
                                </tr>
                                <tr id="cardRow3edit" <?php if($obj->paying_by=="Bank"){ ?> style="display: none;"<?php } else{ ?> <?php } ?> >
                                    <td colspan="3" id="cardBrandLabel" class="text-left">
                                        <label class="label">Card Brand:</label>
                                    </td>
                                    <td colspan="3" id="cardBrandInput">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" value="<?php echo $obj->cardBrand; ?>" name="cardBrand" id="cardBrand" readonly="" placeholder="Card Brand">
                                            </div>
                                            <div class="col-md-7" style="display: inline-flex;"> 
                                                <label class="label">Card Type:</label>
                                                <input type="text" name="cardType"  value="<?php echo $obj->cardType; ?>" class="form-control" id="cardType" readonly="" placeholder="Card Type" >
                                            </div>
                                        </div> 
                                    </td>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Security Code:</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="password" name="cvvNumber" value="<?php echo $obj->cvv; ?>" onkeypress="return isNumberKey(event);removeerror('securityCodeError',this.id);" class="form-control" id="securityCode" maxlength="3" placeholder="CVV Number">
                                        <span id="securityCodeError"></span>
                                    </td>
                                </tr>-->
                                        <tr class="trStyle">
                                            <td colspan="12" class="hedingTd"><label><u>Customer Contacts:</u></label></td>
                                        </tr>
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Full Name:</label>
                                    </td>
                                     <td colspan="3">
                                         <input type="text" name="name" value="<?php echo $obj->fullname;  ?>" class="form-control" onkeypress="removeerror('customerNameError',this.id);" onkeyup="onlyletterWithSpace('customerNameError',this.id)" id="customerName" placeholder="Full Name">
                                        <span id="customerNameError"></span>
                                    </td>
                                    <td colspan="3" class="text-left">
                                        <!-- <label class="label">Postal Address:</label> -->
                                        <label class="label">Customer Email</label>
                                    </td>
                                     <td colspan="3">
                                         <!-- <input type="text" name="postalAddress" value="<?php echo $obj->postal_address; ?>" id="postalAddress" onkeypress="removeerror('postalError',this.id);" class="form-control" placeholder="Postal Address">
                                         <span id="postalError"></span> -->
                                         <input type="email" name="customerEmail" value="<?php echo $obj->email; ?>" class="form-control" onkeypress="removeerror('customerEmailError',this.id);" id="customerEmail" placeholder="Enter Email">
                                        <span id="customerEmailError"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Line Number:</label>
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="text" name="lineNumber" value="<?php echo $obj->line_number; ?>" class="form-control" id="lineNumber" onkeypress="return isNumberKey(event);removeerror('lineError',this.id);"  maxlength="11" placeholder="Enter 11 digits Line Number">
                                                <span id="lineError"></span>
                                            </div>
                                            <div class="col-md-7" style="display: inline-flex;">
                                                <label class="label">Mobile:</label>
                                                <input type="text" name="mobileNumber" value="<?php echo $obj->mobile; ?>" class="form-control" id="mobileNumber" onkeypress="return isNumberKey(event);removeerror('mobileError',this.id);" maxlength="11"  placeholder="Enter Mobile No">
                                                <span id="mobileError"></span>
                                            </div>
                                        </div> 
                                    </td> 
                                    <td colspan="3" class="text-left">
                                        <label class="label">Booking Source:</label>
                                    </td>
                                    <td colspan="3"> 
                                        <select class="form-control" name="source_booking" id="sourceBooking" onchange="removeerror('sourceBookingError',this.id);">
                                             <option value="">--Select One--</option>
                                              <option value="newsletter" <?php if($obj->source_of_booking=="newsletter"){ ?> selected="selected" <?php }?> >Newsletter</option>
                                                <option value="google" <?php if($obj->source_of_booking=="google"){ ?> selected="selected" <?php }?>>Google</option>
                                                <option value="bing" <?php if($obj->source_of_booking=="bing"){ ?> selected="selected" <?php }?> >Bing</option>
                                                <option value="sms" <?php if($obj->source_of_booking=="sms"){ ?> selected="selected" <?php }?> >SMS</option>
                                                <option value="friend" <?php if($obj->source_of_booking=="friend"){ ?> selected="selected" <?php }?> >Friend</option>
                                                <option value="repeat" <?php if($obj->source_of_booking=="repeat"){ ?> selected="selected" <?php }?> >Repeat</option> 
<!--                                                     <option value="new" <?php if($obj->source_of_booking=="new"){ ?> selected="selected" <?php }?> >New</option>
                                             <option value="repeat" <?php if($obj->source_of_booking=="repeat"){ ?> selected="selected" <?php }?>>Repeat</option>
                                             <option value="reference" <?php if($obj->source_of_booking=="reference"){ ?> selected="selected" <?php }?>>Reference</option>-->
                                        </select>
                                        <span id="sourceBookingError"></span>  
                                    </td>
                                </tr> 
                               <!--  <tr id="cardRow4edit" <?php if($obj->paying_by=="Bank"){ ?> style="display: none;"<?php } else{ ?> <?php } ?> >
                                    <td colspan="3" class="text-left">
                                        <label class="label">Security Code:</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="password" name="cvvNumber" value="<?php echo $obj->cvv; ?>" onkeypress="return isNumberKey(event);removeerror('securityCodeError',this.id);" class="form-control" id="securityCode" maxlength="3" placeholder="CVV Number">
                                        <span id="securityCodeError"></span>
                                    </td>
                                </tr> --> 
                                <tr class="trStyle">
                                    <td colspan="12" class="hedingTd"><label><u>Flight Details:</u></label></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Departure Airport:</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" name="bookingDeparture" value="<?php echo $obj->departure; ?>" class="form-control" onkeypress="removeerror('departureAirportError',this.id);" onkeyup="onlyletterWithSpaceWithDash('departureAirportError',this.id)" id="bookingDeparture" placeholder="Departure Airport">
                                        <span id="departureAirportError"></span>
                                    </td>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Destination Airport:</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" name="bookingDestination" value="<?php echo $obj->destination; ?>" class="form-control" onkeypress="removeerror('destinationError',this.id);" onkeyup="onlyletterWithSpaceWithDash('destinationError',this.id)"  id="bookingDestination" placeholder="Destination airport">
                                        <span id="destinationError"></span>
                                    </td> 
                                </tr> 
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Flight Type:</label> 
                                    </td>
                                    <td colspan="3"> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select class="form-control" name="flightType" id="flightType" onchange="removeerror('flightTypeError',this.id);stopCountCheck(this.value);">
                                                    <option value="">Select Flight Type </option>
                                                    <option value="Return" <?php if($obj->flight_type=='Return'){ ?> selected="selected" <?php } ?> >Return</option>
                                                    <option value="One Way" <?php if($obj->flight_type=='One Way'){ ?> selected="selected" <?php } ?> >One Way</option>
                                                </select>
                                                <span id="flightTypeError"></span> 
                                            </div>
                                            <div class="col-md-6" style="display: inline-flex;">
                                                <label class="label">GDS:</label>
                                                <select name="gds" onclick="removeerror('gdsError',this.id)" onkeyup="onlyAlphabet('gdsError',this.id)" class="form-control" id="gds" >
                                                     <option value="World-Span" <?php if($obj->gds=="World-Span") { ?> selected="selected" <?php } ?> >World Span</option>
                                                     <option <?php if($obj->gds=="Galileo") { ?> selected="selected" <?php } ?>  value="Galileo">Galileo</option>
                                                     <option  <?php if($obj->gds=="Sabre") { ?> selected="selected" <?php } ?> value="Sabre">Sabre</option>
                                                     <option  <?php if($obj->gds=="Amadeus") { ?> selected="selected" <?php } ?> value="Amadeus">Amadeus</option>
                                                     <option  <?php if($obj->gds=="Web") { ?> selected="selected" <?php } ?> value="Web">Web</option>
                                                </select>
                                                <span id="gdsError"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Flight Class:</label>
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select class="form-control" name="flightClass" onchange="removeerror('flightClassError',this.id);" id="flightClass">
                                                    <option value="">--Select One--</option>
                                                    <option value="Economy" <?php if($obj->flight_class=='Economy'){ ?> selected="selected" <?php } ?> >Economy</option>
                                                    <option value="Premium Economy" <?php if($obj->flight_class=='Premium Economy'){ ?> selected="selected" <?php } ?> >Premium Economy</option>
                                                    <option value="First Class" <?php if($obj->flight_class=='First Class'){ ?> selected="selected" <?php } ?> >First Class</option>
                                                    <option value="Bunsiness Class" <?php if($obj->flight_class=='Bunsiness Class'){ ?> selected="selected" <?php } ?> >Business Class</option>
                                                </select>
                                                <span id="flightClassError"></span>
                                            </div>
                                            <div class="col-md-6" style="display: inline-flex;">
                                                <label class="label">Segments:</label>
                                                <input type="number" name="noOfSegments" value="<?php echo $obj->number_Of_segment; ?>" onkeypress="removeerror('noOfSegmentsError',this.id);" onkeyup="onlyNumber('noOfSegmentsError',this.id)" class="form-control" id="noOfSegments" placeholder="" readonly="">
                                                <span id="noOfSegmentsError"></span>

                                            </div>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Going stopover:</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" id="bookingVia" name="bookingVia[]" onkeypress="removeerror('viaError',this.id);" onkeyup="onlyletterWithSpaceWithDash('viaError',this.id)" value="<?php echo $obj->via; ?>" class="form-control" placeholder="Going Stopover">
<!--                                         <select style="width: 100%; height: 35px;" id="bookingVia" name="bookingVia[]" onkeypress="removeerror('viaError',this.id);" class="form-control select2-allow-clear" multiple>
                                            <?php $viaArray=  explode(',', $obj->via); if(!empty($via)){ foreach($via as $viaObj){ ?>
                                             <option <?php if(in_array($viaObj->airport_code.'-'.$viaObj->airport_name,$viaArray)){ ?> selected="selected" <?php } ?> value="<?php echo $viaObj->airport_code.'-'.$viaObj->airport_name; ?>"><?php echo $viaObj->airport_code.'-'.$viaObj->airport_name; ?></option>
                                            <?php } } ?>
                                        </select>-->
                                        <span id="viaError"></span>
                                    </td>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Returning stopover:</label>
                                    </td>
                                    <td colspan="3">
<!--                                        <select style="width: 100%; height: 35px;" id="bookingViaReturning" name="bookingViaReturn[]" onkeypress="removeerror('viaErrorReturn',this.id);" class="form-control select2-allow-clear" multiple>
                                            <?php $returningVia=  explode(',', $obj->returningVia); if(!empty($via)){ foreach($via as $viaObj2){ ?>
                                            <option <?php if(in_array($viaObj2->airport_code.'-'.$viaObj2->airport_name,$returningVia)){ ?> selected="selected" <?php } ?> value="<?php echo $viaObj2->airport_code.'-'.$viaObj2->airport_name; ?>"><?php echo $viaObj2->airport_code.'-'.$viaObj2->airport_name; ?></option>
                                            <?php } } ?>
                                        </select>-->
                                        <input type="text" name="bookingViaReturn[]" onkeypress="removeerror('viaErrorReturn',this.id);" onkeyup="onlyletterWithSpaceWithDash('viaErrorReturn',this.id)" value="<?php echo $obj->returningVia; ?>"  class="form-control" id="bookingViaReturning" placeholder="Returning  Stopover">
                                        <span id="viaErrorReturn"></span>
                                    </td> 
                                </tr> 
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Departure Date & Time:</label>
                                    </td>
                                    <td colspan="3">
                                    	<div class="input-group"> 
                                          <div class="inner-addon right-addon">
	                                          <i class="glyphicon glyphicon-calendar"></i>
	                                          <input type="text" name="departureDate" value="<?php echo $obj->departure_date.' '.$obj->departedTime; ?>" readonly="" onclick="removeerror('DepartureDateError',this.id);" class="form-control" id="departureDate" placeholder="Departure Date & Time">
                                        <span id="DepartureDateError"></span>
                                        </div>
                                    </div>  
                                        
                                    </td>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Returning Date & Time:</label>
                                    </td>
                                    <td colspan="3" id="reDateOnOnyWey" >
                                    	<div class="input-group"> 
                                          <div class="inner-addon right-addon">
	                                          <i class="glyphicon glyphicon-calendar"></i>
	                                          <input type="text" name="returnDate" value="<?php echo $obj->returnDate.' '.$obj->returnTime; ?>" readonly="" onclick="removeerror('returnDateError',this.id);" class="form-control" id="returnBookingDate" placeholder="Returning Date & Time">
                                        <span id="returnDateError"></span>
                                        </div>
                                    </div>  
                                        
                                    </td> 
                                </tr> 
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">Airline:</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" name="bookingAirline" value="<?php echo $obj->airline; ?>" class="form-control" onkeypress="removeerror('airlineError',this.id);" onkeyup="alphaNumericWithDash('airlineError',this.id)" id="bookingAirline" placeholder="Airline">
                                        <span id="airlineError"></span>
                                    </td>
                                    <td colspan="3" class="text-left">
                                       <!--  <label class="label">Flight No.</label> -->
                                        <label class="label">PNR:</label>
                                    </td>
                                    <td colspan="3"> 
                                          
                                         <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" name="pnr" value="<?php echo $obj->pnr; ?>" class="form-control" max="6" onkeypress="removeerror('pnrError',this.id);" onkeyup="alphaNumeric('pnrError',this.id)" id="pnr" placeholder="PNR">
                                                <span id="pnrError"></span>  
                                            </div>
                                            <div class="col-md-8" style="display: inline-flex;">
                                                <label class="label">Airline Locator:</label>
                                                <input type="text" name="airlineLocatore" id="airlineLocatore" maxlength="6" onkeypress="removeerror('airlineLocatoreError',this.id);" onblur="checkPnrAndAirlineLoctor()" onkeyup="alphaNumeric('airlineLocatoreError',this.id)" class="form-control" placeholder="Airline Locator">
                                                <span id="airlineLocatoreError"></span>
                                            </div>
                                        </div>
                                    </td> 
                                </tr> 

                                <!-- <tr> 


                                  <td  class="input-group bootstrap-timepicker timepicker">
                                        <input type="text" name="pnrExpireTime" value="<?php //echo $obj->pnrExpiryTime; ?>" readonly="" class="form-control" id="timepicker2" placeholder="">
                                           <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">PNR Expiry Date & Time:</label>
                                    </td>
                                    <td colspan="3">
                                    	<div class="input-group"> 
	                                          <div class="inner-addon right-addon">
		                                          <i class="glyphicon glyphicon-calendar"></i>
		                                          <input type="text" name="pnrExpireDate" value="<?php echo $obj->pnrExpiryDate.' '.$obj->pnrExpiryTime; ?>" readonly="" onclick="removeerror('pnrExpiryDateError',this.id)" class="form-control" id="pnrExpireDate" placeholder="PNR Expiry Date & Time">
                                        <span id="pnrExpiryDateError"></span>
	                                        </div>
	                                    </div>  
                                        
                                    </td> 
                                    <td colspan="3" class="text-left">
                                        <label class="label">Fare Expiry Date & Time:</label>
                                    </td>
                                    <td colspan="3">
                                    	<div class="input-group"> 
                                          <div class="inner-addon right-addon">
	                                          <i class="glyphicon glyphicon-calendar"></i>
	                                          <input type="text" name="fareExpireDate" value="<?php echo $obj->fareExpiryDate.' '.$obj->fareExpiryTime; ?>" onclick="removeerror('fareExpiryError',this.id)" class="form-control" readonly="" id="fareExpireDate" placeholder="Fare Expiry Date & Time">
                                        <span id="fareExpiryError"></span>
                                        </div>
                                    </div>  
                                        
                                    </td> 
    <!--                                <td  class="input-group bootstrap-timepicker timepicker">
                                        <input type="text" name="fareExpireTime" value="<?php //echo $obj->fareExpiryTime; ?>" readonly="" class="form-control" id="timepicker3" placeholder="">
                                           <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                    </td>--> 
                                </tr>
                                
                                
                                <tr>
                                    <td colspan="12" class="text-left">
                                        <label class="label">Flight Details for Customer:</label>
                                    </td>
                                </tr>
                                <tr>
                                     <td colspan="12">
                                         <textarea id="editor1"  class="form-control" onclick="removeerror('customerFlightDetailsError',this.id)" onkeypress="removeerror('customerFlightDetailsError',this.id)"  name="ticket_details" rows="5" cols="80"><?php echo $obj->ticketDetails; ?></textarea>
                                         <span id="customerFlightDetailsError"></span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="12" class="text-left">
                                        <label class="label">Flight Details for System:</label>
                                    </td>
                                </tr>
                                <tr>
                                     <td colspan="12">
                                         <textarea id="editor2" class="form-control" name="systemFlightDetails" rows="5" cols="80" onblur="calculateSigment(this.value)" ><?php  echo $obj->systemFlightDetails; ?></textarea>
                                         <span id="systemFlightDetailsError"></span>
                                    </td>
                                </tr>
                                <tr class="trStyle">
                                    <td colspan="12" class="hedingTd"><label><u>Ticket Cost:</u></label></td>
                                </tr>
                                <tr>
                                    <td colspan="12" class="text-left">
                                        <label class="label" style="font-size: 18px; text-decoration: underline;">I) Payable to Supplier (&pound;):&nbsp;<label style="font-size: 18px;color: red;"><?php echo ticketCost($id); ?></label></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="3" class="text-left">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label">Basic Fare(&pound;):</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="basicFare" class="form-control" value="<?php if(!empty($obj->basic_fare)){ echo $obj->basic_fare; } else { echo 0; } ?>" onkeypress="removeerror('basicFareError',this.id)" onkeyup="numberWithDeceimal('basicFareError',this.id)" id="basicFare" placeholder="Basic Fare">
                                                <span id="basicFareError"></span>
                                            </div>
                                        </div>
                                        
                                    </td>
                                    <td colspan="3" class="text-left" style="padding-left: 50px;"> 
                                        <label class="label">Tax(&pound;):</label> 
                                    </td> 
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="tax" onkeypress="removeerror('taxError',this.id)" value="<?php if(!empty($obj->tax)){ echo $obj->tax; }else{ echo 0; } ?>"  onkeyup="numberWithDeceimal('taxError',this.id)" class="form-control" id="tax" placeholder="Tax">
                                                <span id="taxError"></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-left">  
                                    </td>
                                    <td colspan="3" class="text-left"> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label">APC(&pound;):</label> 
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="apc" class="form-control" value="<?php if(!empty($obj->apc)){ echo $obj->apc; }else{ echo 0; }  ?>" id="apc" onkeypress="removeerror('apcError',this.id)" onkeyup="numberWithDeceimal('apcError',this.id)" placeholder="APC">
                                                    <span id="apcError"></span>
                                            </div>
                                        </div> 
                                    </td>  
                                    <td colspan="3" class="text-left" style="padding-left: 50px;"> 
                                        <label class="label">SAFI(&pound;):</label> 
                                    </td> 
                                    <td colspan="3"> 
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <input type="text" name="safi" value="<?php echo $obj->sufi; ?>" onkeypress="removeerror('safiError',this.id)" onkeyup="numberWithDeceimal('safiError',this.id)" class="form-control" id="safi" placeholder="SAFI">
                                                <span id="safiError"></span>
                                            </div>
                                        </div> 
                                    </td>
                                    
                                </tr>  
                                
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="3" class="text-left"> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label">Misc.(&pound;):</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="misc" value="<?php echo $obj->misc; ?>" onkeypress="removeerror('miscError',this.id)" onkeyup="numberWithDeceimal('miscError',this.id)" class="form-control" id="misc" placeholder="Misc">
                                                <span id="miscError"></span> 
                                            </div>
                                        </div>
                                         
                                    </td> 
                                    <td colspan="3" class="text-left" style="padding-left: 50px;"> 
                                        <!--<label class="label">File Status:</label>-->
                                    </td> 
                                    <td colspan="3">
                                        <div class="row"> 
                                            <div class="col-md-6">
<!--                                                <select class="form-control" name="fileStatus" onchange="loadExtraField(this.value)">
                                                    <option value="">--Select--</option>
                                                    <option value="1" <?php if($obj->file_status==1){ ?> selected="selected" <?php } ?> >Pending Booking</option>
                                                    <option value="2" <?php if($obj->file_status==2){ ?> selected="selected" <?php } ?> >Issued Booking</option>
                                                     <?php if($this->session->userdata('flag')==1) { ?>  
                                                    <option value="3" <?php if($obj->file_status==3){ ?> selected="selected" <?php } ?> >Card Cancellation</option>
                                                    <option value="4" <?php if($obj->file_status==4){ ?> selected="selected" <?php } ?> >Cash Cancellation</option>
                                                    <option value="5" <?php if($obj->file_status==5){ ?> selected="selected" <?php } ?> >Refund</option>
                                                    <option value="6" <?php if($obj->file_status==6){ ?> selected="selected" <?php } ?> >Chargeback</option>
                                                     <?php } ?>

                                                </select>-->
                                            </div>
                                        </div>
                                        
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="6"><span style="font-size: 12px;float: right;">Admin charges etc.</span></td>
                                </tr>
                                <!--                            
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label class="label">APC(&pound;):</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" name="supplier_agent" class="form-control" id="" placeholder="">
                                    </td>
                                    <td colspan="3" class="text-left">
                                        <label class="label">SAFI(&pound;):</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" name="supplier_agent" class="form-control" id="" placeholder="">
                                    </td> 
                                </tr> --> 
                                <tr>
                                    <td colspan="12" class="text-left">
                                        <label class="label" style="font-size: 18px; text-decoration: underline;">II) Additional Expenses(&pound;):&nbsp;<label style="font-size: 18px;color: red;"><?php echo (ticketCharges($id)+ticketChargesAditional($id)); ?></label></label>
                                    </td> 
                                </tr> 
                                <tr <?php if(!empty($transectionCharges)&& !empty($cardCharges)){ if($transectionCharges[0]->transectionCharges=='' && $cardCharges[0]->card_charges==''){ ?>style="display: none" <?php } } ?> > 
                                    <td colspan="3" class="text-left">
                                        <!-- <label class="label" style="position: relative;left: 80px;">Transaction Charges(&pound;):</label>  -->
                                        
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label">Transaction Charges(&pound;):</label> 
                                            </div>
                                            <div class="col-md-6">
                                                <label style="position: relative;left: 80px;top: 5px;"><?php if(!empty($transectionCharges)){ echo $transectionCharges[0]->transectionCharges; }  ?></label>
                                            </div>
                                        </div> 
                                    </td>
                                    <td colspan="3" class="text-left" style="padding-left: 50px;">
                                        <label class="label">Card Charges(&pound;):</label>
                                    </td>
                                    <td colspan="3">
                                        <label style="position: relative;top: 5px;"><?php if(!empty($cardCharges)){ echo $cardCharges[0]->card_charges; } ?></label>
                                    </td> 
                                </tr>
                                <tr> 
                                    <td colspan="3" class="text-left">  
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label">Bank Charges(&pound;):</label> 
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bankCharges" value="<?php echo $obj->bank_charges; ?>" onkeypress="removeerror('bankChargesError',this.id)" onkeyup="numberWithDeceimal('bankChargesError',this.id)" id="bankCharges" class="form-control" placeholder="Bank Charges">
                                                <span id="bankChargesError"></span>
                                            </div>
                                        </div> 
                                    </td>
                                    <td colspan="3" class="text-left" style="padding-left: 50px;">
                                        <label class="label">Misc.(&pound;):</label>
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="addmisc" value="<?php echo $obj->addit_misc; ?>" onkeypress="removeerror('addmiscError',this.id)" onkeyup="numberWithDeceimal('addmiscError',this.id)" id="addmisc" class="form-control" placeholder=""> 
                                                 <span id="addmiscError"></span>
                                            </div>
                                        </div>    
                                    </td> 
                                </tr>
                                <tr> 
                                    <td colspan="3" class="text-left">  
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label">Postage(&pound;):</label> 
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="postage" id="postage" value="<?php echo $obj->postage; ?>" onkeypress="removeerror('postageError',this.id)" onkeyup="numberWithDeceimal('postageError',this.id)"  class="form-control" placeholder="Postage">
                                                <span id="postageError"></span>
                                            </div>
                                        </div> 
                                    </td>
                                    <td colspan="3" class="text-left" style="padding-left: 50px;">
                                        <label class="label">Card Charges.(&pound;):</label>
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="cardCharges" value="<?php echo $obj->card_charges; ?>" onkeypress="removeerror('cardChargesError',this.id)" onkeyup="numberWithDeceimal('cardChargesError',this.id)" id="cardCharges" class="form-control" placeholder="Card Charges">
                                                <span id="cardChargesError"></span>
                                            </div>
                                        </div>
                                    </td> 
                                </tr>
                                <tr id="refundRow" <?php if($obj->file_status==5){ ?><?php } else{?>style="display: none"<?php }?> >
                                    <td colspan="3"></td> 
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label class="label">Card Refund (&pound;):</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" id="cardRefund" name="cardRefund" value="<?php echo $obj->cardRefund; ?>" class="form-control">
                                            </div>
                                        </div> 
                                    </td>
                                    <td colspan="3">
                                        <label class="label">Again Transaction Charges (&pound;):</label> 
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" id="againTransection" value="<?php echo $obj->againTransection; ?>" class="form-control" name="againTransection">
                                                
                                            </div>
                                            <div class="col-md-8" style="display: inline-flex;">
                                                <label class="label">Cash Refund (&pound;):</label>
                                                <input type="text" id="cashRefund" name="cashRefund" value="<?php echo $obj->cashRefund; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td colspan="2"></td>
                                    <td colspan="2"></td> -->
                                </tr>
                                <tr id="chargeBackAndPlanty" <?php if($obj->file_status==6){ ?> style="" <?php }else{ ?> style="display: none" <?php } ?> >
                                    <td colspan="3">
                                        
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label class="label">Charged Back Amount (&pound;):</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="chargebackAmount" value="<?php echo $obj->chargebackAmount; ?>" class="form-control">
                                            </div>
                                        </div> 
                                    </td>
                                    <td colspan="3">
                                        <label class="label">Plenty(&pound;):</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" name="chargeback_plenty" value="<?php echo $obj->chargeback_plenty; ?>" class="form-control" style="width: 30%">
                                    </td>
                                </tr>
                                <tr>
    <!--                                <td colspan="3" class="text-left">
                                        <label class="label">APC Payable(&pound;):</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" name="" class="form-control" id="" placeholder="">
                                    </td>-->
<!--                                    <td colspan="3" class="text-left">
                                        <label class="label">Transaction Charges(&pound;):</label>
                                    </td>
                                    <td colspan="3">
                                        <label><?php if(!empty($transectionCharges)){ echo $transectionCharges[0]->transectionCharges; }  ?></label>
                                    </td> -->
                                </tr>
                                <tr>
                                    <td colspan="12"></td>
                                </tr>
                                        <tr <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> >
                                            <td colspan="12" style="text-align: right !important;">
                                               
                                            </td>
                                        </tr>
                                </table>    
                            </form>
                        </div>
                        <table class="table table-condensed consentNEW" width="100%">
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label style="font-size:14px;"><u>Passenger Details:</u></label></td>
                            </tr> 
                            <tr style="background: white">
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="max-width: 105px;min-width: 102px;text-align: left;padding-left: 0px;"><label class="label">Category</label></th>
                                            <th style="max-width: 80px;text-align: left;padding-left: 0px;"><label class="label">Title</label></th>
                                            <th style="min-width: 150px;text-align: left;padding-left: 0px;"><label class="label">First Name</label></th>
                                            <th style="max-width: 100px;text-align: left;padding-left: 0px;"><label class="label">Mid Name</label></th>
                                            <th style="min-width: 150px;text-align: left;padding-left: 0px;"><label class="label" >Sur Name</label></th>
                                            <th style="max-width: 110px;min-width:110px;text-align: left;padding-left: 0px;"><label class="label">Age <sup>(yrs)</sup></label></th>
                                            <th style="max-width: 110px;text-align: left;padding-left: 0px;"><label class="label">Sale Price(&pound;)</label></th>
                                            <th style="max-width: 100px;text-align: left;padding-left: 0px;"><label class="label">Admin Fee(&pound;)</label></th>
                                            <th style="max-width: 180px;min-width: 180px;text-align: left;padding-left: 0px;"><label class="label">E-Ticket No.</label></th>
                                            <th <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> style="max-width: 120px;min-width: 110px;text-align: center;padding-left: 0px;" <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> ><label class="label">Actions</label></th>
                                        </tr>
                                        <tbody id="passangerMore">
                                        <input type="hidden" name="" id="countrPassenger" value="<?php if(!empty($passengerCount)){ echo $passengerCount; } else{ echo 0; }?>">
                                        <?php if(!empty($passengerDetails)){
                                            foreach($passengerDetails as $passObj){
                                            ?>
                                            <tr id="passRow<?php echo $passObj->passenger_Id; ?>">
                                                <td>
                                                    <label><?php echo $passObj->category; ?></label>
                                                </td>
                                                <td>
                                                    <label><?php echo $passObj->title; ?></label>
                                                </td>
                                                <td>
                                                    <label><?php echo $passObj->firstName;  ?></label>
                                                </td>
                                                <td>
                                                    <label><?php echo $passObj->midle_name; ?></label>
                                                </td>
                                                <td>
                                                     <label><?php echo $passObj->sur_name; ?></label>
                                                </td>
                                                <td>
                                                    <label><?php echo $passObj->age; ?></label>
                                                </td>
                                                <td>
                                                     <label><?php echo $passObj->salePrice; ?></label>
                                                </td>
                                                <td>
                                                    <label><?php echo $passObj->booking_fee; ?></label>
                                                </td>
                                                <td>
                                                     <label><?php echo $passObj->eticket; ?></label>
                                                </td>
                                                <td <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php }?> >
                                                    
                                                </td>
                                            </tr>
                                            <tr id="passRowEdit<?php echo $passObj->passenger_Id; ?>" style="display: none">
                                               <td>
                                                   <select class="form-control" id="category<?php echo $passObj->passenger_Id; ?>" name="category">
                                                    <option value="">Select</option>
                                                    <option value="Adult" <?php if($passObj->category=='Adult'){ ?>selected="selected" <?php } ?> >Adult</option>
                                                    <option value="Youth" <?php if($passObj->category=='Youth'){ ?>selected="selected" <?php } ?> >Youth</option>
                                                    <option value="Child" <?php if($passObj->category=='Child'){ ?>selected="selected" <?php } ?>>Child</option>
                                                    <option value="Infant" <?php if($passObj->category=='Infant'){ ?>selected="selected" <?php } ?>>Infant</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" id="passangerTitle<?php echo $passObj->passenger_Id; ?>" name="passangerTitle">
                                                    <option value="">Select</option>
                                                    <option value="Mr" <?php if($passObj->title=='Mr'){?>selected="selected" <?php } ?>>Mr</option>
                                                    <option value="Mrs" <?php if($passObj->title=='Mrs'){?>selected="selected" <?php } ?>>Mrs</option>
                                                    <option value="Miss" <?php if($passObj->title=='Miss'){?>selected="selected" <?php } ?>>Miss</option>
                                                    <option value="Ms" <?php if($passObj->title=='Ms'){?>selected="selected" <?php } ?>>Ms</option>
                                                    <option value="Mstr" <?php if($passObj->title=='Mstr'){?>selected="selected" <?php } ?>>Mstr</option>
                                                    <option value="Lord" <?php if($passObj->title=='Lord'){?>selected="selected" <?php } ?>>Lord</option>
                                                    <option value="Dr" <?php if($passObj->title=='Dr'){?>selected="selected" <?php } ?>>Dr</option>
                                                    <option value="Rev" <?php if($passObj->title=='Rev'){?>selected="selected" <?php } ?>>Rev</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" onkeypress="removeerror('firstNameError0',this.id)" onkeyup="onlyletterWithSpace('firstNameError0',this.id)" id="firstName<?php echo $passObj->passenger_Id; ?>" value="<?php if(!empty($passObj->firstName)){ echo $passObj->firstName; } ?>" name="firstName" placeholder="First Name">
                                                <span id="firstNameError<?php echo $passObj->passenger_Id; ?>"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="middle_name" value="<?php if(!empty($passObj->midle_name)){ echo $passObj->midle_name; } ?>" class="form-control" id="middle_name<?php echo $passObj->passenger_Id; ?>" placeholder="Middle Name">
                                            </td>
                                            <td>
                                                <input type="text" name="sir_name" class="form-control" id="sir_name<?php echo $passObj->passenger_Id; ?>" placeholder="Sur Name" value="<?php if(!empty($passObj->sur_name)){ echo $passObj->sur_name;} ?>">
                                            </td>
                                            <td>
                                                <input type="text"  name="age" class="form-control" id="age<?php echo $passObj->passenger_Id; ?>" placeholder="Date Of Birth" value="<?php if(!empty($passObj->age)){ echo $passObj->age; } ?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="salePrice" onkeypress="removeerror('salePriceError0',this.id)" value="<?php echo $passObj->salePrice; ?>"  onkeyup="numberWithDeceimal('salePriceError0',this.id)" id="salePrice<?php echo $passObj->passenger_Id; ?>" placeholder="Sale Price">
                                                <span id="salePriceError<?php echo $passObj->passenger_Id; ?>"></span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="booking_fee" onkeypress="removeerror('bookingFeeError0',this.id)" onkeyup="numberWithDeceimal('bookingFeeError0',this.id)" value="<?php echo $passObj->booking_fee; ?>" id="bookingFee<?php echo $passObj->passenger_Id; ?>" placeholder="Booking Fee">
                                                <span id="bookingFeeError<?php echo $passObj->passenger_Id; ?>"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="eticket" class="form-control" id="eticlet<?php echo $passObj->passenger_Id; ?>" <?php if($this->session->userdata('flag')!=1){ ?> readonly="" <?php } ?> placeholder="Eticket Number" value="<?php echo $passObj->eticket; ?>">
                                            </td>
                                                <td <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> >
                                                    
                                                    
                                                </td>
                                            </tr>
                                            <?php } } ?>
                                            <tr id="updatePassMore" style="display: none;">
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="background: white">
                                <td colspan="6" class="text-left">
                                    <label class="label" style="font-size: 14px;">Total Sale Price(&pound;)</label>:<label style="font-size: 14px;color: red;"><?php echo salePrice($id); ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label" style="font-size: 14px;">Profit(&pound;)</label>:<label style="font-size: 14px;color: red;"><?php echo (salePrice($id)-((ticketCost($id)+ticketCharges($id)+ticketChargesAditional($id)))); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="hidden" id="pIdBookingId" value="<?php echo $id; ?>" >
                                    
                                </td>
                            </tr>
                            <?php if($this->session->userdata('flag')!=1){ ?>
                            <tr>
                                <td colspan="12">
                                    
                                </td>
                            </tr>
                            <?php } ?>
                            
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label style="font-size:14px;"><u>Receipt Details:</u></label></td>
                            </tr>
                            <?php
                            $cardSet=0;
                            $lastCardId=0;
                                foreach($cardData as $card)
                                {
                                    if($card->paying_by=='Card')
                                    {
                                        $cardSet++;
                                        $lastCardId=$card->id;
                                        ?>
                                           <tr style="border-top: 4px solid white;">
                                                <td colspan="3" class="text-left">
                                                    <label class="label">Paying By:</label>
                                                </td>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label><?php echo $card->paying_by; ?></label>
                                                        </div>
                                                        <div class="col-md-8" style="display: inline-flex;"> 
                                                            <label class="label"><?php if($card->paying_by=='Card'){ ?> New Booking Charge: <?php  }else{ ?> New Booking Confirm:<?php } ?></label> 
                                                            <label><?php echo $card->newbookingChargeAmount; ?></label>  
                                                        </div>
                                                    </div>

                                                </td>
                                                <td colspan="3" class="text-left">
                                                    <label class="label">Payment due Date & Time:</label>
                                                </td>
                                                <td colspan="3">
                                                    <label><?php echo $card->paymentDue_date; ?></label>
                                                    <label><?php echo $card->paymentDueTime; ?></label>
                                                </td> 
                                        </tr> 
                                         <tr id="cardRow">
                                                <td colspan="3" class="text-left">
                                                    <label class="label">Card Number:</label>
                                                </td>
                                                 <td colspan="3">
                                                     <label><?php if($this->session->userdata('flag')==5){ echo str_repeat("*", strlen($card->card_number)-4).  substr($card->card_number, 12, 4); } else{ echo $card->card_number; } ?></label>
                                                 </td>
                                                <td colspan="3" class="text-left">
                                                    <label class="label">Issuing Bank:</label>
                                                </td>
                                                <td colspan="3">
                                                    <label><?php echo $card->cardIssuingBank; ?></label> 
                                                </td>
                                        </tr>
                                        <tr id="cardRow2">
                                                <td colspan="3" class="text-left">
                                                    <label class="label">Cardholder Name:</label>
                                                </td>
                                                 <td colspan="3">
                                                     <label><?php echo $card->cardHolderName; ?></label>
                                                </td>
                                                <td colspan="3" class="text-left">
                                                    <label class="label">Valid From:</label>
                                                </td>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label><?php echo $card->validFrom; ?></label>
                                                        </div>
                                                        <div class="col-md-8" style="display: inline-flex;">
                                                            <label class="label">Expiry Date:</label>
                                                            <label><?php echo $card->expiryDate; ?></label>
                                                        </div>
                                                    </div> 
                                                </td> 
                                          </tr>
                                         <tr id="cardRow3">
                                                <td colspan="3" id="cardBrandLabel" class="text-left">
                                                    <label class="label">Card Brand:</label>
                                                </td>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <div class="col-md-6" id="cardBrandInput">
                                                            <label><?php echo $card->cardBrand; ?></label>
                                                        </div>
                                                        <div class="col-md-6" style="display: inline-flex;">
                                                            <label class="label">Card Type:</label>
                                                            <label><?php echo $card->cardType; ?></label>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td colspan="3" class="text-left">
                                                    <label class="label">Security Code:</label>
                                                </td>
                                                <td colspan="3">
                                                    <label><?php echo $card->cvv; ?></label>
                                                </td>
                                            </tr>
                                            <tr id="cardRow3">
                                                <td colspan="3" id="cardBrandLabel" class="text-left">
                                                    <label class="label">Postal Address:</label>
                                                </td>
                                                <td colspan="3">
                                                      <label><?php echo $card->postal_address; ?></label>
                                                </td> 
                                            </tr>
                                            <br>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                                <td colspan="3" class="text-left">
                                                    <label class="label">Paying By:</label>
                                                </td>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label><?php echo $card->paying_by; ?></label>
                                                        </div>
                                                        <div class="col-md-8" style="display: inline-flex;"> 
                                                            <label class="label"><?php if($card->paying_by=='Card'){ ?> New Booking Charge: <?php  }else{ ?> New Booking Confirm:<?php } ?></label> 
                                                            <label><?php echo $card->newbookingChargeAmount; ?></label>  
                                                        </div>
                                                    </div>

                                                </td>
                                                <td colspan="3" class="text-left">
                                                    <label class="label">Payment due Date & Time:</label>
                                                </td>
                                                <td colspan="3">
                                                    <label><?php echo $card->paymentDue_date; ?></label>
                                                    <label><?php echo $card->paymentDueTime; ?></label>
                                                </td> 
                                        </tr> 
                                        <br>
                                        
                                        <?php
                                    }
                                }
                                ?>
                            
                            <?php if($cardSet!=0){ ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="9">
                                   
                                   <?php if($lastCardId >0){ ?>  <?php } ?>
                                </td> 
                            </tr>
                            <?php } 
                              else{ ?> 
                           
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="9">
                                    
<!--                                    <button type="button" class="btn btn-primary pull-right" onclick="editOldCard(<?php echo $cardData->id ?>)" >Edit Old Card</button> -->
                                </td> 
                           </tr> <?php } ?>
                           <!--  <tr id="cardRow4">
                                 
                            </tr> -->
                           
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label style="font-size:14px;"><u>Receipts From Customer:</u></label></td>
                            </tr> 
                            <tr style="background: white">
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="max-width: 125px;width: 125px;text-align: left;padding-left: 0px;"><label class="label">Trans. ID</label></th>
                                            <th style="text-align: left;padding-left: 0px;"><label class="label">Receipt in Via</label></th>
                                            <th style="max-width: 100px;width: 100px;text-align: left;padding-left: 0px;"><label class="label">Receipt Date</label></th> 
                                            <th style="max-width: 130px;width: 130px;text-align: left;padding-left: 0px;"><label class="label">Card Last four nos</label></th> 
                                            <th style="min-width: 140px;width: 140px;text-align: left;padding-left: 0px;"><label class="label">Amount Received (&pound;) </label></th>
                                            <?php if($this->session->userdata('flag')==1){ ?>
                                            <th <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?>  style="max-width: 115px;width: 115px;text-align: center;padding-left: 0px;" class="text-center"><label class="label">Actions</label></th> <?php } ?>
                                        </tr>
                                        <?php $customerReceivedTotal=0; if(!empty($PaymentRecivedFromCustomer)){ foreach($PaymentRecivedFromCustomer as $paymentObj){ $customerReceivedTotal=$customerReceivedTotal+$paymentObj->amount; ?>
                                        <tr id="paymentRecord<?php echo $paymentObj->id; ?>">
                                            <td style="max-width: 70px;min-width: 70px;"><?php echo $paymentObj->transectionId; ?></td>
                                            <td style="max-width: 70px;min-width: 70px;"><?php echo $paymentObj->pay_by; //echo idToName('suppliers','id',$paymentObj->pay_to,'supplier_name'); ?></td>
                                            <td style="max-width: 70px;min-width: 70px;"><?php echo $paymentObj->pay_date; ?></td> 
                                            <td style="max-width: 80px;min-width: 80px;">
                                                <?php 
                                                    $cars_numb=$paymentObj->card_no;
                                                    $j=0;
                                                    for ($i = 0; $i < strlen($cars_numb); ++$i)
                                                    {
                                                       $j++;
                                                    }
                                                    if($j!=0)
                                                        {
                                                            $sgtr=  substr($cars_numb, 0, 12);
                                                            $last= substr($cars_numb, 12, $j);
                                                            echo "************".$last;
                                                        }
                                                 ?>
                                            </td>
                                            <td style="max-width: 50px;min-width: 50px;"><?php echo $paymentObj->amount; ?></td>
                                          
                                          <?php   if($this->session->userdata('flag')==1){ ?>
                                            <td <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> style="max-width: 100px;min-width: 100px;text-align: center;">
                                                <!-- <button <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> type="button" class="btn btn-primary btn-round" onclick="paymentEditRowShow(<?php echo $paymentObj->transectionId; ?>)" id="" title="Edit"><i class="fa fa-edit"></i></button> -->
                                                
                                                 
                                                
                                                <!--<button <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> type="button" class="btn btn-danger btn-round" title="Delete Transaction" data-toggle="modal" data-target="#DeleteTransaction"><i class="fa fa-trash"></i></button>-->
                                            </td>
                                          <?php } ?>
                                        </tr>
                                        <tr>
                                            <td style="border-top: 0px solid #ddd;"><b>Transaction Ref:</b></td>
                                            <td colspan="5" style="max-width: 100px;min-width: 100px;border-top: 0px solid #ddd;"><?php echo $paymentObj->description; ?></td>
                                        </tr>
<!--                                        <tr style="display: none;" id="paymentEditRow<?php echo $paymentObj->id; ?>">
                                            <td style="max-width: 70px;min-width: 70px;">
                                                <select class="form-control" id="receiverName<?php echo $paymentObj->id; ?>">
                                                    <option value="">--Select Receiver--</option>
                                                    <?php if(!empty($bankData)){ foreach($bankData as $bankObj){  ?>
                                                    <option value="<?php echo $bankObj->id; ?>" <?php if($paymentObj->receiverName==$bankObj->id){?>selected="selected"<?php } ?> ><?php echo $bankObj->bank_name; ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </td> 
                                            <td style="max-width: 70px;min-width: 70px;"><label><?php echo $paymentObj->paymentDate; ?></label></td> 
                                            <td style="max-width: 70px;min-width: 70px;">
                                                <select id="receipt_via<?php echo $paymentObj->id; ?>" class="form-control" name="receipt_via<?php echo $paymentObj->id; ?>" required="" onchange="">
                                                   <option value="">--Select One--</option>
                                                   <option value="1" <?php if($paymentObj->receipt_via==1){ ?>selected="selected"<?php } ?> >Card</option>
                                                   <option value="2" <?php if($paymentObj->receipt_via==2){ ?>selected="selected"<?php } ?>>Online</option>
                                                   <option value="3" <?php if($paymentObj->receipt_via==3){ ?>selected="selected"<?php } ?>>Cash</option>
                                                   <option value="4" <?php if($paymentObj->receipt_via==4){ ?>selected="selected"<?php } ?>>Cheque</option>
                                                   <option value="5" <?php if($paymentObj->receipt_via==5){ ?>selected="selected"<?php } ?> >Card Declined</option>
                                                </select>
                                            </td> 
                                            <td style="max-width: 100px;min-width: 100px;">
                                                <select class="form-control" name="card_type" id="card_type<?php echo $paymentObj->id; ?>">
                                                   <option value="">--Select One--</option>
                                                   <option value="1" <?php if($paymentObj->card_type==1){?>selected="selected"<?php } ?> >CR Telephonic</option>
                                                   <option value="2" <?php if($paymentObj->card_type==2){?>selected="selected"<?php } ?>>DR Telephonic</option>
                                                   <option value="2" <?php if($paymentObj->card_type==3){?>selected="selected"<?php } ?>>BH Self CR 3D</option>
                                                   <option value="2" <?php if($paymentObj->card_type==4){?>selected="selected"<?php } ?>>TP Self CR 3D</option>
                                                   <option value="2" <?php if($paymentObj->card_type==5){?>selected="selected"<?php } ?>>BH Self DR 3D</option>
                                                   <option value="2" <?php if($paymentObj->card_type==6){?>selected="selected"<?php } ?>>TP Self DR 3D</option>
                                                   <option value="2" <?php if($paymentObj->card_type==7){?>selected="selected"<?php } ?>>TP 3<sub>Party</sub> DR 3D</option>
                                                   <option value="2" <?php if($paymentObj->card_type==8){?>selected="selected"<?php } ?>>TP 3<sub>Party</sub> CR 3D</option>
                                                </select>
                                            </td> 
                                            <td style="max-width: 80px;min-width: 80px;"><input class="form-control" id="authorizedCode<?php echo $paymentObj->id; ?>" value="<?php echo $paymentObj->authorizedCode; ?>" ></td> 
                                            <td style="max-width: 50px;min-width: 50px;"><input class="form-control" id="amount<?php echo $paymentObj->id; ?>" onkeypress="removeerror('amountError<?php echo $paymentObj->id; ?>',this.id)" onkeyup="numberWithDeceimal('amountError<?php echo $paymentObj->id; ?>',this.id)" value="<?php echo $paymentObj->amount; ?>" ><span id="amountError<?php echo $paymentObj->id; ?>"></span></td> 
                                            <td style="max-width: 100px;min-width: 100px;"><input class="form-control" id="paymentReference<?php echo $paymentObj->id; ?>" value="<?php echo $paymentObj->paymentReference; ?>"></td> 
                                            <td <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> style="max-width: 100px;min-width: 100px;">
                                                <button <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> type="button" class="btn btn-primary btn-round" onclick="paymentUpdate(<?php echo $paymentObj->id; ?>)">Save</button>
                                                <button <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> type="button" class="btn btn-danger btn-round" onclick="paymentEditCancel(<?php echo $paymentObj->id; ?>)">Cancel</button>
                                            </td> 
                                        </tr>-->
                                        <?php } } ?>
                                        <?php 
                                        $refunndTotal=0;
                                        if(!empty($CustomerRefund))
                                        {
                                            foreach($CustomerRefund as $refundObj)
                                            {
                                                ?>
                                        <tr>
                                            <td><?php echo $refundObj->transectionId; ?></td>
                                            <td><?php echo $refundObj->pay_by;  ?></td>
                                            <td><?php echo $refundObj->pay_date; ?></td>
                                            <td></td>
                                            <td><?php echo '-'.$refundObj->amount; $refunndTotal=$refunndTotal+$refundObj->amount;  ?></td>
                                            <td><?php echo $refundObj->description; ?></td>
                                            <?php   if($this->session->userdata('flag')==1){ ?>
                                            <td <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> style="max-width: 100px;min-width: 100px;text-align: center;">
                                                <!-- <button <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> type="button" class="btn btn-primary btn-round" onclick="paymentEditRowShow(<?php echo $paymentObj->transectionId; ?>)" id="" title="Edit"><i class="fa fa-edit"></i></button> -->
                                                
                                                 
                                                
                                                <!--<button <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> type="button" class="btn btn-danger btn-round" title="Delete Transaction" data-toggle="modal" data-target="#DeleteTransaction"><i class="fa fa-trash"></i></button>-->
                                            </td>
                                          <?php } ?>
                                        </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        
                                        
<!--                                        <tr id="paymentNew" style="display: none;">
                                            <td style="max-width: 70px;min-width: 70px;">
                                                <select class="form-control" id="receiverName" >
                                                    <option value="">--Select Receiver--</option>
                                                    <?php if(!empty($bankData)){ foreach($bankData as $bankObj2){  ?>
                                                    <option value="<?php echo $bankObj2->id; ?>" ><?php echo $bankObj2->bank_name; ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </td>
                                            <td style="max-width: 70px;min-width: 70px;"><input class="form-control" id="paymentAddDate" onclick="removeerror('paymentDateError',this.id)" readonly=""><span id="paymentDateError"></span></td>
                                            <td style="max-width: 70px;min-width: 70px;">
                                                <select id="receipt_via" class="form-control" name="receipt_via" required="" onchange="removeerror('receipt_viaError',this.id)">
                                                   <option value="">--Select One--</option>
                                                   <option value="1">Card</option>
                                                   <option value="2">Online</option>
                                                   <option value="3">Cash</option>
                                                   <option value="4">Cheque</option>
                                                   <option value="5">Card Declined</option>
                                                </select>
                                                <span id="receipt_viaError"></span>
                                            </td>
                                            <td style="max-width: 100px;min-width: 100px;">
                                                <select class="form-control" name="card_type" id="card_type" onchange="removeerror('card_typeError',this.id)">
                                                   <option value="">--Select One--</option>
                                                   <option value="1">CR Telephonic</option>
                                                   <option value="2">DR Telephonic</option>
                                                   <option value="3">BH Self CR 3D</option>
                                                   <option value="4">TP Self CR 3D</option>
                                                   <option value="5">BH Self DR 3D</option>
                                                   <option value="6">TP Self DR 3D</option>
                                                   <option value="7">TP 3<sub>Party</sub> DR 3D</option>
                                                   <option value="8">TP 3<sub>Party</sub> CR 3D</option>
                                                   
                                                </select>
                                                <span id="card_typeError"></span>
                                            </td> 
                                            <td style="max-width: 80px;min-width: 80px;"><input class="form-control" id="authorizedCode" ></td>
                                            <td style="max-width: 50px;min-width: 50px;"><input class="form-control" id="amount" onkeypress="removeerror('amountError',this.id)" onkeyup="numberWithDeceimal('amountError',this.id)" ><span id="amountError"></span></td>
                                            <td style="max-width: 100px;min-width: 100px;"><input class="form-control" id="paymentReference"></td>
                                            <td style="max-width: 100px;min-width: 100px;">
                                                <button id="paymentSaveBtn" type="button" class="btn btn-primary btn-round" onclick="savePayment(<?php echo $id; ?>)" title="Save"><i class="fa fa-save"></i></button>
                                                <button type="button" class="btn btn-danger btn-round" onclick="cancelPayment()" title="Cancel"><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>-->
                                    </table>
                                </td>
                            </tr>
                            <!-- <tr style="background: white;">
                                
                                <td colspan="6" class="text-left">
                                   <label class="label" style="font-size: 18px; text-decoration: underline;"></label>:<label style="font-size: 18px;color: red;"></label> 
                                </td>
                            </tr> -->
                            <tr style="background: white;">
                                <td colspan="3" class="text-left">
                                    <label class="label" style="font-size: 14px;">Total Receivable(&pound;)</label>:<label style="font-size: 14px;color: red;"><?php echo salePrice($id); ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label" style="font-size: 14px;">Amount Received(&pound;)</label>:<label style="font-size: 14px;color: red;"><?php echo $customerReceivedTotal-$refunndTotal; ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                   <label class="label" style="font-size: 14px;">Pending Amount(&pound;)</label>:<label style="font-size: 14px;color: red;"><?php echo (salePrice($id)-$customerReceivedTotal); ?></label> 
                                </td>
                                <td colspan="3" class="text-left">
                                   <label class="label" style="font-size: 14px; text-decoration: underline;"></label>:<label style="font-size: 14px;color: red;"></label> 
                                </td>
<!--                                <td colspan="1">
                                    
                                </td> -->
                            </tr>
                            
                             

                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label style="font-size:14px;"><u>Payments to Supplier:</u></label></td>
                            </tr> 
                            <tr style="background: white">
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="max-width: 70px;width: 70px;text-align: left;padding-left: 0px;"><label class="label">Trans. ID</label></th>
                                            <th style="text-align: left;padding-left: 0px;"><label class="label">Payment Out Via</label></th>
                                            <th style="max-width: 100px;width: 100px;text-align: left;padding-left: 0px;"><label class="label">Payment Date</label></th> 
                                            <th style="max-width: 130px;width: 130px;text-align: left;padding-left: 0px;"><label class="label">Card Last four nos</label></th> 
                                            <th style="min-width: 120px;width: 120px;text-align: left;padding-left: 0px;"><label class="label">Amount Paid (&pound;) </label></th>
                                            
                                            <?php if($this->session->userdata('flag')==1){ ?>
                                            <th <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?>  style="max-width: 115px;width:115px;text-align: center;padding-left: 0px;" class="text-center"><label class="label">Actions</label></th> <?php } ?>
                                        </tr>
                                        <?php $amountPayedSupplier=0; if(!empty($supplierPayment)){ foreach($supplierPayment as $supplierObj){ $amountPayedSupplier=$amountPayedSupplier+$supplierObj->amount; ?>
                                        <tr id="supplierRecord<?php echo $supplierObj->id; ?>">
                                            <td style="max-width: 70px;min-width: 70px;"><?php  echo $supplierObj->transectionId; ?></td>
                                            <td style="max-width: 70px;min-width: 70px;"><?php echo $supplierObj->pay_by; //idToName('suppliers','id',$supplierObj->pay_to,'supplier_name'); ?></td>
                                            <td style="max-width: 70px;min-width: 70px;"><?php echo $supplierObj->pay_date;  ?></td> 
                                            <td style="max-width: 80px;min-width: 80px;"><?php ?>
                                            <?php 
                                            $cars_numb=$supplierObj->card_no;
                                            $j=0;
                                            for ($i = 0; $i < strlen($cars_numb); ++$i)
                                            {
                                               $j++;
                                            }
                                            if($j!=0)
                                                {
                                                    $sgtr=  substr($cars_numb, 0, 12);
                                                    $last= substr($cars_numb, 12, $j);
                                                    echo "************".$last;
                                                }
                                ?>
                                            </td>
                                            <td style="max-width: 50px;min-width: 50px;"><?php echo $supplierObj->amount; ?></td>
                                            
                                          <?php   if($this->session->userdata('flag')==1){ ?>
                                            <td <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> style="max-width: 100px;min-width: 100px;">
                                                <!-- <button <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> type="button" class="btn btn-primary btn-round" onclick="paymentEditRowShow(<?php echo $paymentObj->id; ?>)" id="" title="Edit"><i class="fa fa-edit"></i></button> -->
                                                
                                                 
                                                
                                            </td>
                                          <?php } ?>
                                        </tr> 
                                        <tr>
                                            <td><b>Transaction Ref:</b></td>
                                            <td colspan="5" style="max-width: 100px;min-width: 100px;"><?php echo $supplierObj->description; ?></td>
                                        </tr>
                                        <?php } } ?> 
                                    </table>
                                </td>
                            </tr>
                            <tr style="background: white;">
                                <td colspan="3" class="text-left">
                                    <label class="label" style="font-size: 14px;">Total Payable(&pound;):</label>:<label style="font-size: 14px;color: red;"><?php echo round(ticketCost($id),2); ?></label>
                                </td>
                                <td colspan="3" class="text-left">
                                   <label class="label" style="font-size: 14px;">Amount Paid (&pound;):</label>:<label style="font-size: 14px;color: red;"><?php echo $amountPayedSupplier; ?></label> 
                                </td>
                                <td colspan="3" class="text-left">
                                   <label class="label" style="font-size: 14px;">Pending Amount(&pound;):</label>:<label style="font-size: 14px;color: red;"><?php $supplierAccount=(round(ticketCost($id),2)-$amountPayedSupplier); echo (round(ticketCost($id),2)-$amountPayedSupplier); ?></label> 
                                </td>
                                <td colspan="3" class="text-left">
                                   <label class="label" style="font-size: 14px; text-decoration: underline;"></label>:<label style="font-size: 14px;color: red;"></label> 
                                </td>
<!--                                <td colspan="1">
                                    
                                </td> -->
                            </tr>
                            
                             <?php if($this->session->userdata('flag')==1){ ?>
                            <tr <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php } ?> >
                                <td colspan="12">
                                    <!-- <button type="button" class="btn btn-primary btn-round pull-right" id="paymentRowAdd">Add Payment</button> -->
                                    <!--<button type="button" <?php if($supplierAccount!=0){ } else{?>style="display: none;" <?php } ?> class="btn btn-primary btn-round pull-right" onclick="payToSupplierModal(<?php echo $id ?>)" >Add Transaction</button>-->
                                </td>
                            </tr>
                            <?php } ?>
                            <?php if($obj->flag==1 && $obj->file_status==3){ ?>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Issue:</u></label></td>
                            </tr> 
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;padding-left: 0px;"><label class="label">Issuance Date</label></th> 
                                        </tr> 
                                        <tr>
                                            <td><?php echo $obj->issue_date; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php  if($obj->flag==2) { ?>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Titcket(s) Issuance Details:</u></label></td>
                            </tr> 
                            <tr style="background: white">
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="min-width: 70px;text-align: left;padding-left: 0px;"><label class="label">Issuance Date</label></th>
                                            <th style="min-width: 70px;text-align: left;padding-left: 0px;"><label class="label">Supplier Name</label></th>
                                            <th style="min-width: 70px;text-align: left;padding-left: 0px;"><label class="label">Booking Under Brand</label></th> 
                                            <th style="min-width: 70px;text-align: left;padding-left: 0px;"><label class="label">Supplier Reference </label></th>  
                                            <th style="min-width: 70px;text-align: left;padding-left: 0px;"><label class="label">Action</label></th>  
                                        </tr>
                                        <tr>
                                            <td><?php echo $obj->issue_date; ?></td>
                                            <td><?php echo $obj->supplier_name; ?></td>
                                            <td><?php echo idToName('company','id',$obj->company,'company_Code'); ?></td>
                                            <td><?php echo $obj->supplier_ref; ?></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php if($obj->canceled_stat==1){ ?>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Cancellation Details:</u></label></td>
                            </tr> 
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;padding-left: 0px;"><label class="label">Cancellation Date</label></th> 
                                            <th style="text-align: left;padding-left: 0px;"><label class="label">What is reason of Cancellation?</label></th> 
                                        </tr> 
                                        <tr>
                                            <td><?php echo $obj->cancel_date; ?></td>
                                            <td><?php if(!empty($cancelRemarks)){ echo $cancelRemarks[0]->remarks; } ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php } ?>
<!--                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Card Cancel:</u></label></td>
                            </tr> 
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;padding-left: 0px;"><label class="label">Card Cancellation Date</label></th> 
                                        </tr> 
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Cash Cancel:</u></label></td>
                            </tr> 
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;padding-left: 0px;"><label class="label">Cash Cancellation Date</label></th> 
                                        </tr> 
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Refund:</u></label></td>
                            </tr> 
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;padding-left: 0px;"><label class="label">Refund Date:</label></th> 
                                        </tr> 
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Chargeback:</u></label></td>
                            </tr> 
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;padding-left: 0px;"><label class="label">Chargeback Date:</label></th> 
                                        </tr> 
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>-->
                            <?php
                            if(!empty($negativeRemarks)){
                            ?>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label style="font-size:14px;"><u>What is Agent Note About Negative Profit?</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;">Have chance for being Positive?</th>
                                            <?php if($negativeRemarks[0]->dateRemaingAmount!='0000-00-00'){ ?>
                                            <th style="text-align: left;">Left Balance Date?</th>
                                            <?php } ?>
                                             <?php   if($this->session->userdata('flag')==1){?>
                                             <th>Action</th><?php } ?>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo $negativeRemarks[0]->isGetReplay; ?>
                                            </td>
                                             <?php if($negativeRemarks[0]->dateRemaingAmount!='0000-00-00'){ ?>
                                            <td>
                                                 <?php echo $negativeRemarks[0]->dateRemaingAmount; ?>
                                            </td>
                                             <?php } ?>
                                             <?php   if($this->session->userdata('flag')==1){?>
                                            <td></td>
                                             <?php } ?>
                                        </tr>
                                    </table>
                                </td> 
                            </tr>
                            <?php 
                            }
                            ?>
                            <?php  if(!empty($remaingBalanceRemark)){  ?>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>What is agent note about left balance?</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;">Refundable ticket?</th>
                                            <th style="text-align: left;">Got customer's e-mail reply?</th> 
                                             <?php if($remaingBalanceRemark[0]->isGetReplay=='Yes'){ ?>
                                            <th style="text-align: left;">Left balance date?</th>
                                            <th style="text-align: left;">Reason of late payment?</th>
                                             <?php } ?>
                                            <?php if($remaingBalanceRemark[0]->isGetReplay=='No'){ ?>
                                            <th>Will this be issued?</th><?php } ?>
                                             <?php   if($this->session->userdata('flag')==1){?>
                                             <th <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php }?> >Action</th><?php } ?>
                                        </tr>
                                        <tr>
                                            <td><?php echo $remaingBalanceRemark[0]->refundable; ?></td> 
                                            <td><?php echo $remaingBalanceRemark[0]->isGetReplay; ?></td> 
                                             <?php if($remaingBalanceRemark[0]->isGetReplay=='Yes'){ ?>
                                            <td><?php echo $remaingBalanceRemark[0]->dateRemaingAmount;  ?></td>
                                            <td><?php echo $remaingBalanceRemark[0]->note;  ?></td> 
                                             <?php } ?>
                                            <?php if($remaingBalanceRemark[0]->isGetReplay=='No'){ ?>
                                            <td>Sorry agent !this file cannot be issued. Contact to Admin.</td>
                                            <?php } ?>
                                             <?php   if($this->session->userdata('flag')==1){?>
                                            <td <?php if($obj->flag==1){ } else{ ?> style="display: none" <?php }?> ></td>
                                             <?php } ?>
                                        </tr>  
                                    </table>
                                </td> 
                            </tr>
                            <?php } ?>
                            <?php if(!empty($cardCancelledRemarks)){ $cardremarksObj=$cardCancelledRemarks[0];  ?>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>What is agent note about card cancellation?</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;">Have you cancelled all PNRS & supplier references?</th>
                                            <th style="text-align: left;">What is card cancellation reason?</th>   
                                        </tr>   
                                        <tr>
                                            <td><?php echo $cardremarksObj->pnrTicketOrderCancelled; ?></td>
                                            <td><?php echo $cardremarksObj->remarks_details; ?></td>
                                        </tr>
                                    </table>
                                </td> 
                            </tr>
                            <?php } ?>
                            <?php if(!empty($cashCancelledRemarks)){ $cashRemarksObj=$cashCancelledRemarks[0]; ?>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>What is agent note about cash cancellation?</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;">Have you cancelled all PNRS & supplier references?</th>
                                            <th style="text-align: left;">What is cash cancellation reason?</th>   
                                        </tr>   
                                        <tr>
                                            <td><?php echo $cashRemarksObj->pnrTicketOrderCancelled; ?></td>
                                            <td><?php echo $cashRemarksObj->remarks_details; ?></td>
                                        </tr>
                                    </table>
                                </td> 
                            </tr>
                            <?php } ?>
                            <?php if($obj->canceled_stat==1){ if(!empty($refundRemarks)){ $refundRemarksObj=$refundRemarks[0]; ?>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>What is agent note about refund?</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;">Have you cancelled all PNRS & supplier references?</th>
                                            <th style="text-align: left;">Why did passenger go for refund ?</th>
                                        </tr>   
                                        <tr>
                                            <td><?php echo $refundRemarksObj->pnrTicketOrderCancelled; ?></td>
                                            <td><?php echo $refundRemarksObj->remarks_details; ?></td>
                                        </tr>
                                    </table>
                                </td> 
                            </tr>
                            <?php } } ?>
                            <?php if($obj->canceled_stat==1){ if(!empty($chargebackremarks)){ $chargebackremarkObj=$chargebackremarks[0]; ?>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>What is agent note about charge back?</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <table class="table tablColor table-condensed" width="100%" >
                                        <tr>
                                            <th style="text-align: left;">Will you cancel all PNRS & supplier references?</th>
                                            <th style="text-align: left;">Why did passenger take chargeback?</th>
                                        </tr>   
                                        <tr>
                                            <td><?php echo $chargebackremarkObj->pnrTicketOrderCancelled; ?></td>
                                            <td><?php echo $chargebackremarkObj->remarks_details; ?></td>
                                        </tr>
                                    </table>
                                </td> 
                            </tr>
                            <?php } } ?>
                            <tr>  
                                <td colspan="12" style="text-align: center;">
                                    <br>
                                    <br>
                                    
                                </td> 
                            </tr> 

                        </table>

                        

                    </div>
                </div> 
            </div>
<!-- /page content -->
<!-- Confirmation Email Modal Start -->
    <div class="modal fade" id="ConfirmationEmail" role="dialog">
        <div class="modal-dialog"> 
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirmation Email</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>To:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>From:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Subject:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Message:</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div> 
        </div>
    </div>
<!-- Confirmation Email Modal End -->


<!-- Add New Card Modal Start -->
    <div class="modal fade success" id="AddNewCard" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add New Card</h5>
                </div>
                <form method="post" id="addCardForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Card Number:</label>
                                            <input type="text" name="cardNumberNew" placeholder="Can I have sixteenth digits of your card?" maxlength="16" id="newCardNumber"  onkeypress="return isNumberKey(event);removeerror('cardNumberErrorModal',this.id);"  class="form-control">
                                            <span id="cardNumberErrorModal"></span>
                                            <input type="hidden" name="bookingNumber" value="<?php echo $id ?>" id="forCardBooking">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Cardholder Name:</label>
                                            <input type="text" name="cardHolderNew" id="cardHolderNew" placeholder="What is cardholder name?" class="form-control">
                                        </div> 
                                         
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                       
                                        <div class="col-md-3">
                                            <label>Valid From:</label>
                                            <input type="text" class="form-control" name="validFromNew" id="validFromNew" maxlength="5" placeholder="mm/yy">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Expiry Date:</label>
                                            <input type="text" class="form-control" name="expiryDateNew" onblur="cardValidCheck2('newCardNumber')" id="expiryDateNew" maxlength="5" placeholder="mm/yy"> 
                                        </div>
                                        <div class="col-md-6">
                                            <label>Payment due Date & Time:</label>
                                            <div class="input-group"> 
                                                <div class="inner-addon right-addon">
                                                    <i class="glyphicon glyphicon-calendar"></i>
                                                    <input type="text" class="form-control" id="paymentDueDate">
                                                </div>
                                            </div> 
                                        </div>
                                        
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Security Code:</label>
                                            <input type="text" name="cvvNew" id="cvvNew" class="form-control" maxlength="3" >
                                        </div>
                                        <div class="col-md-6">
                                            <label>Issuing Bank Name:</label>
                                            <input type="text" name="issuingBankNew" readonly="" id="cardIssueBank" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Card Brand:</label>
                                            <input type="text" name="cardBrandNew" id="cardBandModal" readonly="" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Card Type:</label>
                                            <input type="text" name="cardTypeNew" id="cardTypeModal" class="form-control" readonly="">
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Address:</label>
                                        </div>
                                        <div class="col-md-3"> 
                                            <select name="cardAddressNewType" onchange="addressVaid(this.value)" id="cardAddressNewType" class="form-control">
                                                <option value="">Select Address</option>
                                                <option value="same">Same Address</option>
                                                <option value="different">Different Address</option>
                                            </select>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" name="cardAddressNew" id="cardAddressNew" placeholder="Can I have Card registered postal address?" class="form-control">
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="saveNewCardData()" class="btn btn-round btn-primary">Save</button>
                        <button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Add New Card Modal End -->
<!-- Add New Card Modal Start -->
    <div class="modal fade success" id="EditOldCard" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Old Card</h5>
                </div>
                <form method="post" id="editOldCardForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Card Number:</label>
                                            <input type="hidden" id="cardIdEdit">
                                            <input type="text" name="" maxlength="16" onkeypress="return isNumberKey(event);removeerror('cardNumberErrorEditModal',this.id);" id="editCardNumber"  class="form-control">
                                            <span id="cardNumberErrorEditModal"></span>
                                            <input type="hidden" name="bookingNumber" value="<?php echo $id ?>" id="forCardBookingEdit">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Cardholder Name:</label>
                                            <input type="text" id="cardHolderEditName" class="form-control">
                                        </div> 
                                         
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                       
                                        <div class="col-md-3">
                                            <label>Valid From:</label>
                                            <input type="text" class="form-control" id="vaildFromEdit" maxlength="5" placeholder="mm/yy">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Expiry Date:</label>
                                            <input type="text" class="form-control" id="expiryDateEdit" onblur="cardValidCheck3('editCardNumber')" placeholder="mm/yy" maxlength="5">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Payment due Date & Time:</label>
                                            <div class="input-group"> 
                                                <div class="inner-addon right-addon">
                                                    <i class="glyphicon glyphicon-calendar"></i>
                                                    <input type="text" class="form-control" id="paymentDueDate1">
                                                </div>
                                            </div> 
                                        </div>
                                        
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Security Code:</label>
                                            <input type="text"id="editCvv"  maxlength="3"  class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Issuing Bank Name:</label>
                                            <input type="text"  readonly="" id="cardIssueBankEdit" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Card Brand:</label>
                                            <input type="text"  id="cardBandModalEdit" readonly="" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Card Type:</label>
                                            <input type="text"  id="cardTypeModalEdit" class="form-control" readonly="">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
<!--                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Address:</label>
                                        </div>
                                        <div class="col-md-6"> 
                                            <select name="" id="" class="form-control">
                                                <option value="">Select Address</option>
                                                <option value="">Same Address</option>
                                                <option value="">Different Address</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6"> 
                                            <input type="text"  id="cardAddressEdit" class="form-control">
                                        </div> 
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="updateCardData()" class="btn btn-round btn-primary">Save</button>
                        <button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Add New Card Modal End -->
<!-- Ticket issurance Detail Popup -->
<div class="modal fade success" id="ticketIssuranceDetail" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5 class="modal-title text-left">Ticket Issuance Details &nbsp; <span style="color: red">BH-212</span></h5>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="row">
                        <h3>Issuance Details</h3>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Issuance Date</label> 
                                        <div class="input-group"> 
                                            <div class="inner-addon right-addon">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                                <input type="text" class="form-control" id="issuranceDate" placeholder="yyyy/mm/dd">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Ticket Supplier</label>
                                        <select class="form-control"> 
                                            <option value="Travel Pack">Travel Pack</option>
                                            <option selected="selected" value="The Holiday Team">The Holiday Team</option>
                                            <option value="Global Travel">Global Travel</option>
                                            <option value="Ace Rooms">Ace Rooms</option>
                                            <option value="Brightsun">Brightsun</option>
                                            <option value="Sufi Travels">Sufi Travels</option>
                                            <option value="Reliance Travels">Reliance Travels</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Supplier Reference</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>GDS</label> 
                                        <select class="form-control">
                                            <option value="World-Span">World Span</option>
                                            <option selected="selected" value="Galileo">Galileo</option>
                                            <option value="Sabre">Sabre</option>
                                            <option value="Amadeus">Amadeus</option>
                                            <option value="Web">Web</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">PNR</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Brand Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group">
                                <div class="row">   
                                    <div class="col-md-12"> 
                                        <label for="">
                                            Booking Note
                                        </label>
                                        <textarea name="" id="" class="form-control" rows="2">&lt;strong&gt;Admin&lt;/strong&gt; (27-Jun-18   10:58:39 AM): (Auto) Request for refund to customer declined - TEST&lt;br&gt;&lt;br&gt;&lt;strong&gt;Admin&lt;/strong&gt; (27-Jun-18   10:58:17 AM): (Auto) Request to refund to customer - 60 - TEST&lt;br&gt;&lt;br&gt;&lt;strong&gt;Admin&lt;/strong&gt; (23-Jun-18   09:00:18 AM): (Auto) Request for ticket issuance declined - test&lt;br&gt;&lt;br&gt;&lt;strong&gt;Admin&lt;/strong&gt; (23-Jun-18   08:59:41 AM): (Auto) Ticket Issuance Sent - The Holiday Team - ABC - £1906.5 - test&lt;br&gt;&lt;br&gt;&lt;strong&gt;Admin&lt;/strong&gt; (23-Jun-18   08:58:39 AM): (Auto) No payment reveived in bank - test&lt;br&gt;&lt;br&gt;&lt;strong&gt;Admin&lt;/strong&gt; (23-Jun-18   08:58:15 AM): (Auto) Payment receipt sent to the customer.&lt;br&gt;&lt;br&gt;&lt;strong&gt;Admin&lt;/strong&gt; (23-Jun-18   08:57:59 AM): (Auto) Request to confirm bank payment received - 347.00 - test&lt;br&gt;&lt;br&gt;&lt;strong&gt;Admin&lt;/strong&gt; (22-Jun-18   05:14:41 PM): FILE ST-493 RECEIVED CARD PAYMENT 300GBP And 450gbp online payment but we put 300gbp card payment in apral cancelation of file st-493 and cash move in this BH-212 for ticket isseuance&lt;br&gt;&lt;br&gt;&lt;strong&gt;Max&lt;/strong&gt; (22-Jun-18   04:38:02 PM): Not under quoted.
                                        On installment payment
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table tablColor table-condensed" width="100%">
                                <tbody>
                                    <tr>
                                        <th width="43" height="23" align="center" bgcolor="#DADADA" style="font-weight: bold">Title</th>
                                        <th width="173" align="center" bgcolor="#DADADA" style="font-weight: bold">&nbsp;First Name</th>
                                        <th width="109" align="center" bgcolor="#DADADA" style="font-weight: bold">&nbsp;Middle Name</th>
                                        <th width="156" align="center" bgcolor="#DADADA" style="font-weight: bold">&nbsp;Sur Name</th>
                                        <th width="78" align="center" bgcolor="#DADADA" style="font-weight: bold">Age (yrs)</th>
                                        <th width="121" align="center" bgcolor="#DADADA" style="font-weight: bold">Catagory</th>
                                        <th width="227" align="center" bgcolor="#DADADA" style="font-weight: bold">eTicket No.</th>
                                    </tr>        
                                    <tr>
                                        <td height="30" align="center"></td>
                                        <td height="30" align="center"></td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                        <td align="center"> 
                                          <input type="text">
                                        </td>
                                    </tr>
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-round btn-primary">Save</button>
                    <button type="button" class="btn btn-round btn-danger">Cancel</button>
                    <button type="button" class="btn btn-round btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updateBooking(formUpdateId)
 {
     //alert('jgfsdlh ');
    //BookingUpdateBox url
    //alert('SHAHID');
    var supplierAgent =$('#supplierAgent').val();
    var customerName=$('#customerName').val();
    var customerEmail=$('#customerEmail').val();
    if(supplierAgent=='')
    {
        $('#supplierAgent').attr('style','border: 1px solid red');
        $('#supplier_agentError').attr('style','color:red');
        $('#supplier_agentError').text('Please Fill the Supplier Agent Name!');
        return false;
    }
//    else if(supplierAgent!='')
//    {
//        if(!supplierAgent.match(/^[a-zA-Z\s]+$/) && supplierAgent !="")
//        {
//            $('#supplierAgent').attr('style','color:red');
//            $('#supplier_agentError').text('No Digits No Special Character');
//            return false;
//        }
//    }
    if($('#ibe').val()=='')
    {
        //supplierAgent
        $('#ibe').attr('style','border: 1px solid red');
        $('#ibeError').attr('style','color:red');
        $('#ibeError').text('Please Fill the Supplier Reference ');
        return false;
    }
    else
    {
        if(!$('#ibe').val().match(/^[a-zA-Z0-9]+$/))
        {
            $('#ibe').attr('style','border: 1px solid red');
            $('#ibeError').attr('style','color:red');
            $('#ibeError').text('Please Fill the Supplier Reference ');
            return false; 
        }
    }
    if($('#booking_brand option:selected').val()=="")
    {
       $('#booking_brand').attr('style','border: 1px solid red');
       $('#bookingbrandError').attr('style','color:red');
       $('#bookingbrandError').text('Please Select the Booking Under Brand');
       return false; 
    }
    if(customerName=="")
    {
        $('#customerName').attr('style','border: 1px solid red');
        $('#customerNameError').attr('style','color: red');
        $('#customerNameError').text('Please Fill the Customer Full name');
        return false;  
    }
    else
    {
        if(!customerName.match(/^[a-zA-Z\s]+$/) && customerName !="")
        {
            $('#customerName').attr('style','color:red');
            $('#customerNameError').text('No Digits No Special Character');
            return false;
        }
    }
    if($('#lineNumber').val()=='')
    {
       $('#lineNumber').attr('style','border: 1px solid red');
        $('#lineError').attr('style','color: red');
        $('#lineError').text('Please Fill the Line Number');
        return false;   
    }
    else
    {
        if(!$('#lineNumber').val().match(/^[0-9]+$/))
        {
            $('#lineNumber').attr('style','border: 1px solid red');
            $('#lineError').attr('style','color: red');
            $('#lineError').text('Please Fill the Line Number only Digit');
            return false; 
        }
    }
    if($('#mobileNumber').val()=='')
    {
        $('#mobileNumber').attr('style','border: 1px solid red');
        $('#mobileError').attr('style','color: red');
        $('#mobileError').text('Please Fill the Mobile Number');
        return false;   
    }
    else
    {
        if(!$('#mobileNumber').val().match(/^[0-9]+$/))
        {
           $('#mobileNumber').attr('style','border: 1px solid red');
           $('#mobileError').attr('style','color: red');
           $('#mobileError').text('Please Fill the Mobile Number only Digit');
           return false;  
        }
    }
    if(customerEmail=='')
    {
        $('#customerEmail').attr('style','border: 1px solid red');
        $('#customerEmailError').attr('style','color: red');
        $('#customerEmailError').text('Please Fill the Customer Email');
        return false;  
    }
    if($('#sourceBooking option:selected').val()=='')
    {
        $('#sourceBooking').attr('style','border: 1px solid red');
        $('#sourceBookingError').attr('style','color: red');
        $('#sourceBookingError').text('Please Select The Source Of Booking');
        return false; 
    }
//    if($('#payingMethod option:selected').val()=="")
//    {
//        $('#payingMethod').attr('style','border: 1px solid red');
//        $('#payingError').attr('style','color: red');
//        $('#payingError').text('Please Select The Paying Method');
//        return false; 
//    }
//    if($('#payingMethod option:selected').val()=="Card")
//    {
//        if($('#postalAddress').val()=='')
//        {
//            $('#postalAddress').attr('style','border: 1px solid red');
//            $('#postalError').attr('style','color: red');
//            $('#postalError').text('Please Fill the Postal Address');
//            return false;   
//        }
//        if($('#cardNumber').val()=='')
//        {
//            $('#cardNumber').attr('style','border: 1px solid red');
//            $('#cardNumberError').attr('style','color: red');
//            $('#cardNumberError').text('Please Enter the 16 Digit Card Number');
//            return false; 
//        }
//        else
//        {
//             if(!$('#cardNumber').val().match(/^[0-9]+$/))
//             {
//               $('#cardNumber').attr('style','border: 1px solid red');
//               $('#cardNumberError').attr('style','color: red');
//               $('#cardNumberError').text('Please Enter the 16 Digit Card Number');
//               return false;  
//             }
//        }
//        if($('#validFrom').val()=="")
//        {
//            $('#validFrom').attr('style','border: 1px solid red');
//            $('#validFromError').attr('style','color: red');
//            $('#validFromError').text('Please Enter the Valid From Date');
//            return false; 
//        }
//        if($('#cardHolderName').val()=="")
//        {
//            $('#cardHolderName').attr('style','border: 1px solid red');
//            $('#cardHolderError').attr('style','color: red');
//            $('#cardHolderError').text('Please Enter the Card Holder Name');
//            return false; 
//        }
//        if($('#cardExpiry').val()=="")
//        {
//            $('#cardExpiry').attr('style','border: 1px solid red');
//            $('#expiryDateError').attr('style','color: red');
//            $('#expiryDateError').text('Please Enter the Card Expiry Date');
//            return false; 
//        }
//        if($('#securityCode').val()=="")
//        {
//            $('#securityCode').attr('style','border: 1px solid red');
//            $('#securityCodeError').attr('style','color: red');
//            $('#securityCodeError').text('Please Enter 3 Digit CVV');
//            return false; 
//        }
//        //var cardHolderName=$('#cardHolderName').val();
////       for(var k=0;k<=passCount;k++)
////        {
////             var surName=$('#surName'+k).val();
////             if(cardHolderName.includes(surName)==true)
////           {
////             // return true;
////              break;
////           }
////           else
////           {
////               alertify.alert('Talk To Account Department ');
////               return false; 
////           }
////        }
//    }
//    if($('#paymentDueDate').val()=="")
//    {
//        $('#paymentDueDate').attr('style','border: 1px solid red');
//        $('#paymentDueDateError').attr('style','color: red');
//        $('#paymentDueDateError').text('Please Select The Payment Due Date');
//        return false; 
//    }
//    if($('#amountCharged').val()=="")
//    {
//        $('#amountCharged').attr('style','border: 1px solid red');
//        $('#amountChargeError').attr('style','color: red');
//        $('#amountChargeError').text('Please Enter Amount For New Booking');
//        return false;  
//    }
    if($('#bookingDeparture').val()=="")
    {
       $('#bookingDeparture').attr('style','border: 1px solid red');
       $('#departureAirportError').attr('style','color: red');
       $('#departureAirportError').text('Please Enter The Departure Airport');
       return false;   
    }
    if($('#bookingDestination').val()=="")
    {
      $('#bookingDestination').attr('style','border: 1px solid red');
      $('#destinationError').attr('style','color: red');
      $('#destinationError').text('Please Enter The Destination Airport');
      return false;
    }
    if($('#bookingVia').val()=="")
    {
      $('#bookingVia').attr('style','border: 1px solid red');
      $('#viaError').attr('style','color: red');
      $('#viaError').text('Please Enter the Via');
      return false;
    }
    if($('#flightType option:selected').val()=="")
    {
      $('#flightType').attr('style','border: 1px solid red');
      $('#flightTypeError').attr('style','color: red');
      $('#flightTypeError').text('Please Select the Flight Type');
      return false;
    }
    if($('#flightType option:selected').val()=='Return')
    {
        if($('#bookingVia').val()=='')
        {
            $('#bookingVia').attr('style','border: 1px solid red');
            $('#viaError').attr('style','color: red');
            $('#viaError').text('Please Enter the Going Via');
            return false;
        }
        if($('#bookingViaReturning').val()=='')
        {
            $('#bookingViaReturning').attr('style','border: 1px solid red');
            $('#viaErrorReturn').attr('style','color: red');
            $('#viaErrorReturn').text('Please Enter the Returing Via');
            return false;
        }
        if($('#returnBookingDate').val()=="")
        {
          $('#returnBookingDate').attr('style','border: 1px solid red');
          $('#returnDateError').attr('style','color: red');
          $('#returnDateError').text('Please Select the Returning Date');
          return false;
        }
    }
    if($('#flightType option:selected').val()=='One Way')
    {
        if($('#bookingVia').val()=='')
        {
            $('#bookingVia').attr('style','border: 1px solid red');
            $('#viaError').attr('style','color: red');
            $('#viaError').text('Please Enter the Going Via');
            return false;
        }
    }
    if($('#departureDate').val()=="")
    {
      $('#departureDate').attr('style','border: 1px solid red');
      $('#DepartureDateError').attr('style','color: red');
      $('#DepartureDateError').text('Please Select the Departure Date');
      return false;
    }
    
    if($('#bookingAirline').val()=="")
    {
      $('#bookingAirline').attr('style','border: 1px solid red');
      $('#airlineError').attr('style','color: red');
      $('#airlineError').text('Please Enter the Booking Airline');
      return false; 
    }
    if($('#flightNo').val()=="")
    {
      $('#flightNo').attr('style','border: 1px solid red');
      $('#flightNoError').attr('style','color: red');
      $('#flightNoError').text('Please Enter the Flight Number');
      return false; 
    }
    if($('#flightClass option:selected').val()=="")
    {
      $('#flightClass').attr('style','border: 1px solid red');
      $('#flightClassError').attr('style','color: red');
      $('#flightClassError').text('Please Select the Flight Class');
      return false; 
    }
//    if($('#noOfSegments').val()=="")
//    {
//      $('#noOfSegments').attr('style','border: 1px solid red');
//      $('#noOfSegmentsError').attr('style','color: red');
//      $('#noOfSegmentsError').text('Please Enter the Number Of Segments');
//      return false;  
//    }
    if($('#pnr').val()=='')
    {
      $('#pnr').attr('style','border: 1px solid red');
      $('#pnrError').attr('style','color: red');
      $('#pnrError').text('Please Enter the PNR');
      return false;   
    }
    else
    {
        if(!$('#pnr').val().match(/^[a-zA-Z0-9]+$/))
        {
          $('#pnr').attr('style','border: 1px solid red');
          $('#pnrError').attr('style','color: red');
          $('#pnrError').text('Please Enter the PNR No Special Character');
          return false;  
        }
    }
    if($('#pnrExpireDate').val()=="")
    {
      $('#pnrExpireDate').attr('style','border: 1px solid red');
      $('#pnrExpiryDateError').attr('style','color: red');
      $('#pnrExpiryDateError').text('Please Select The PNR Expiry Date');
      return false;  
    }
    if($('#gds option:selected').val()=="")
    {
      $('#gds').attr('style','border: 1px solid red');
      $('#gdsError').attr('style','color: red');
      $('#gdsError').text('Please Enter The GDS');
      return false;  
    }
    if($('#fareExpireDate').val()=="")
    {
      $('#fareExpireDate').attr('style','border: 1px solid red');
      $('#fareExpiryError').attr('style','color: red');
      $('#fareExpiryError').text('Please Enter The GDS');
      return false; 
    }
//    if($('#editor2').val()=='')
//    {
//         $('#editor2').attr('style','border: 1px solid red');
//         $('#systemFlightDetailsError').attr('style','color: red');
//         $('#systemFlightDetailsError').text('Please Paste The System Flight Details');
//         return false;
//    }
//    if($('#noOfSegments').val()==0)
//    {
//      $('#basicFare').attr('style','border: 1px solid red');
//      $('#basicFareError').attr('style','color: red');
//      $('#basicFareError').text('Your System Flight Details are not confirm .Please Conform Them');
//      return false;
//    }
    if($('#basicFare').val()=="" && $('#basicFare').val()=="0")
    {
      $('#basicFare').attr('style','border: 1px solid red');
      $('#basicFareError').attr('style','color: red');
      $('#basicFareError').text('Please Enter The Basic Fare');
      return false;
    }
    else
    {
        if(!$('#basicFare').val().match(/^[0-9.]+$/))
        {
           $('#basicFare').attr('style','border: 1px solid red');
           $('#basicFareError').attr('style','color: red');
           $('#basicFareError').text('Please Enter The Basic Fare');
           return false; 
        }
    }
    if($('#tax').val()=="" && $('#tax').val()=="0")
    {
      $('#tax').attr('style','border: 1px solid red');
      $('#taxError').attr('style','color: red');
      $('#taxError').text('Please Enter The Tax');
      return false; 
    }
    else
    {
       if(!$('#tax').val().match(/^[0-9.]+$/))
        {
           $('#tax').attr('style','border: 1px solid red');
           $('#taxError').attr('style','color: red');
           $('#taxError').text('Please Enter The Tax');
           return false; 
        } 
    }
    if(!$('#apc').val().match(/^[0-9.]+$/))
    {
       $('#apc').attr('style','border: 1px solid red');
       $('#apcError').attr('style','color: red');
       $('#apcError').text('Please Enter The APC No Special Character');
       return false;  
    }
    //var passCount=parseInt($('#countrPassenger').val());
//    for(var j=0;j<=passCount;j++)
//    {
//       if($('#firstName'+j).val()=="")
//       {
//           $('#firstName'+j).attr('style','border: 1px solid red');
//           $('#firstNameError'+j).attr('style','color: red');
//           $('#firstNameError'+j).text('please Enter the First Name');
//           return false; 
//       }
//       if($('#salePrice'+j).val()==0 && $('#salePrice'+j).val()=="")
//       {
//          $('#salePrice'+j).attr('style','border: 1px solid red');
//          $('#salePriceError'+j).attr('style','color: red');
//          $('#salePriceError'+j).text('please Enter the Sale Price');
//          return false;  
//       }
//    }
var flightDetailsForPassanger=$('#editor1').val();
//console.log(flightDetailsForPassanger);
//return true;
var pnrc=$('#pnr').val();
$.ajax({
    type:'POST',
    url:ajaxUrl+'FlightDetailsCustomerCheck',
    cache:false,
    async: false,
    data:{ pnrc:pnrc,flightDetailsForPassanger:flightDetailsForPassanger },
    success:function(resp)
    {
        if(resp==1)
        {
            $('#cke_editor').attr('style','border: 1px solid red');
            $('#editor1').attr('style','border: 1px solid red');
            $('#customerFlightDetailsError').attr('style','color: red');
            $('#customerFlightDetailsError').text('Please put readable flight details for customer .');
            return false;  
        }
        else
        {
        showLoder();
            $("#"+formUpdateId).attr('action',ajaxUrl+'BookingUpdateBox');
            $("#"+formUpdateId).removeAttr('onsubmit');
            $("#"+formUpdateId).submit();
        }
    }
    
});
  
    
 } 
function payingMethodCheckUpdate(paymethod)
 {
     showLoder();
     if(paymethod=="Card")
     {
         $('#cardRowedit').show();
         $('#cardRow2edit').show();
         $('#cardRow3edit').show();
         $('#issuingBank').hide();
         $('#issuningBnakname').hide();
         $('#issuningBnakname').show();
         $('#cardBrandLabel').hide();
         $('#cardBrandInput').hide();
         $('#bookingChargeFor').attr('style','display:inline-flex');
         $('#amountConfirmOrCharge').text('New Booking Charge');
//         $('#cardRow4').show();
         $('#cardNumber').attr('required',true);
         $('#validFrom').attr('required',true);
         $('#cardHolderName').attr('required',true);
         $('#cardExpiry').attr('required',true);
         $('#receiptMode').attr('required',true);
         $('#securityCode').attr('required',true);
         $('#postalAddress').removeAttr('readonly');
         hideLoder();
     }
     else if(paymethod=="Bank")
     {
         $('#cardRowedit').hide();
         $('#cardRow2edit').hide();
         $('#cardRow3edit').hide();
         $('#cardRow4edit').hide();
         $('#issuingBank').hide();
         $('#issuningBnakname').hide();
         $('#issuningBnakname').hide();
         $('#cardBrandLabel').hide();
         $('#cardBrandInput').hide();
         $('#bookingChargeFor').attr('style','display:inline-flex');
         $('#amountConfirmOrCharge').text('New Booking Confirm');
//         $('#cardRow4').hide();
         $('#cardNumber').removeAttr('required');
         $('#validFrom').removeAttr('required');
         $('#cardHolderName').removeAttr('required');
         $('#cardExpiry').removeAttr('required');
//         $('#receiptMode').removeAttr('required');
         $('#securityCode').removeAttr('required');
         $('#postalAddress').attr('readonly',true);
         hideLoder();
     }
     else
     {
        $('#cardRowedit').hide();
         $('#cardRow2edit').hide();
         $('#issuningBnakname').hide();
         $('#cardRow3edit').hide();
         $('#cardRow4edit').hide();
         $('#cardBrandLabel').hide();
         $('#cardBrandInput').hide();
         $('#issuingBank').hide();
         $('#issuningBnakname').hide();
          $('#bookingChargeFor').hide();
         $('#amountConfirmOrCharge').text('New Booking Confirm');
//         $('#cardRow4').hide();
         $('#cardNumber').removeAttr('required');
         $('#validFrom').removeAttr('required');
         $('#cardHolderName').removeAttr('required');
         $('#cardExpiry').removeAttr('required');
//         $('#receiptMode').removeAttr('required');
         $('#securityCode').removeAttr('required');
         hideLoder();
     }
 }
 function loadExtraField(fileF)
 {
     if(fileF=='5')
     {
         $('#refundRow').show();
          $('#chargeBackAndPlanty').hide();
//         $('#').show();
//         $('#').show();
     }
     else if(fileF=='6')
     {
         $('#chargeBackAndPlanty').show();
         $('#refundRow').hide();
     }
     else
     {
         $('#refundRow').hide();
         $('#chargeBackAndPlanty').hide();
//         $('#').hide();
//         $('#').hide(); 
     }
 }
</script>