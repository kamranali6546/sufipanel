<title>Pending Tasks</title>
<style>
table tbody th, table.dataTable tbody td {
    text-align: center !important;
    font-size: 11px !important;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 4px 1px !important;
}
table.dataTable.nowrap th, table.dataTable.nowrap td {
    white-space: unset !important;
}
.form-control {
        padding: 2px 2px !important;
}
table thead th, table.dataTable thead td {
    text-align: center !important;
}
    table.display tbody tr td, table.display tfoot tr td{
        border: 1px solid #b7b7b7;
        padding: 0px 3px;
    }
    table.display tfoot tr td {
        color: black;
    }
    textarea.form-control {
    height: auto;
    font-size: 12px;
    line-height: 14px;
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
    .btnView {
        background: none;
        box-shadow: none;
        border: none;
        color: #009fff;
        font-weight: bold;
    }  
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width: 100%;">
          <?php if(!empty($paymentOtherRequest) || !empty($InvoiceDataRequest) || !empty($CanceledDataRequest) || !empty($RefundToCustomerRequest) || !empty($AirlineRefundRequest) || !empty($ticketorder)){ ?> <h3 class="text-center">Pending Tasks</h3> <?php } ?>
        </div>
        <div class="title_right">
            <!--<a class="btn btn-primary pull-right" href="<?php echo site_url(''); ?>">Create Follow Up</a>-->
        </div> 
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <?php if(!empty($paymentOtherRequest)){ ?>
        <div class="col-md-12 table-responsive">
            <h4 style="color:darkcyan;margin-bottom: 0px;">Payments & Others</h4>
            <table class="display nowrap tablColor" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th>S.No</th>
                        <th style="min-width:85px;">Requested<br>Date</th>
                        <th style="min-width: 80px;">Ref <br> No.</th>
                        <th>Request <br> By</th> 
                        <th style="min-width: 152px;">Payment <br> Type</th>
                        <th style="min-width: 120px;">Bank</th>
                        <th>Payment <br> Date</th>
                        <th>Amount</th>
                        <th style="min-width: 140px;">Ref</th>
                        <th style="min-width: 130px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php if(!empty($paymentOtherRequest)){ $paySr=1; foreach($paymentOtherRequest as $paymentObj){
                        if($paymentObj->requestType!='Invoice' && $paymentObj->requestType!='Cancel File' && $paymentObj->requestType!='Refund To Customer' && $paymentObj->requestType!='Airline Refund'){
//                            echo "<pre>";
//                            print_r($paymentObj);
//                            echo "</pre>";
                         $companyId=idToName('booking_details','id',$paymentObj->booking_id,'company');
                         $comCode=idToName('company','id',$companyId,'company_Code');
                         $ref=$comCode.'-'.$paymentObj->booking_id;
                         $bookingFlag=idToName('booking_details','id',$paymentObj->booking_id,'flag');
                        ?>
                    <tr>
                        <td><?php echo $paySr; ?></td>
                        <td><?php echo $paymentObj->entrydate; ?></td>
                        <td><a href="<?php echo site_url('BookingDetailBox/'.idencode($paymentObj->booking_id).'/'.idencode($bookingFlag)); ?>" target="_blank" class="text-blue"><?php echo $ref; ?></a></td>
                        <td><?php echo idToName('admin','id',$paymentObj->requestFrom,'login_name'); ?></td>
                        <td><?php if($paymentObj->requestType=='Card Payment'){ ?>
                            <?php echo $paymentObj->requestType; ?><button type="button" class="btnView" title="View Card" onclick="cardDataView(<?php echo $paymentObj->booking_id  ?>)">View</button>
                        <?php } else{ echo $paymentObj->requestType; } ?>
                        </td>
                        <td><?php if(!empty($paymentObj->requestBank)){ echo idToName('bank','id',$paymentObj->requestBank,'bank_name'); } ?></td>
                        <td>
                            <div class="input-group"> 
                                <div class="inner-addon right-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                    <input type="text" class="form-control nextDueDate" value="<?php echo $paymentObj->requestDate; ?>"  style="width: 115px !important;"> 
                                </div>
                            </div>   
                        </td>
                        <td>
                            <input type="text" class="form-control" style="width:70px !important;" value="<?php echo $paymentObj->requestAmount; ?>">
                        </td>
                        <td>
                            <textarea class="form-control" rows="2" ><?php echo $paymentObj->requestReference; ?></textarea>
                            
                        </td>
                        <td> 
                            <button type="button" class="btn btn-primary btn-sm" title="Send Receipt" onclick="openModalSendReceipt(<?php echo $paymentObj->booking_id ?>)"><i class="fa fa-share" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="addPaymentModelFromPendingTask(<?php echo $paymentObj->booking_id ?>,'true',<?php echo $paymentObj->id  ?>,<?php echo $paymentObj->requestAmount ?>,'<?php echo $paymentObj->requestType ?>')" title="Confirm Payment"><i class="fa fa-check-square-o" aria-hidden="true"></i>
</button>
                            <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="requestToDeletePaymentRequest(<?php echo $paymentObj->id ?>)" ><i class="fa fa-trash"></i></button>
                        </td> 
                    </tr> 
                    <?php $paySr++; } } } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php if(!empty($InvoiceDataRequest)){ ?>
        <div class="col-md-12 table-responsive">
            <h4 style="color:darkcyan;margin-bottom: 0px;margin-top: 30px;">Invoice Request</h4>
            <table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th >S.No</th>
                        <th style="min-width: 70px;">Requested<br>Date</th>
                        <th style="min-width: 70px;">Ref No.</th>
                        <th style="min-width: 100px;">Supplier Ref.</th> 
                        <th>Request <br> By</th> 
                        <th>Date</th>  
                        <th style="min-width: 50px;">Ref</th>
                        <th class="text-center" style="min-width: 130px;">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php if(!empty($InvoiceDataRequest)){
                        $insr=1;
                        foreach($InvoiceDataRequest as $invoiceObj){
                            if($invoiceObj->requestType=='Invoice'){
                                 $companyId=idToName('booking_details','id',$invoiceObj->booking_id,'company');
                                $comCode=idToName('company','id',$companyId,'company_Code');
                                $ref=$comCode.'-'.$invoiceObj->booking_id;
                                $bookingFlagInvoice=idToName('booking_details','id',$invoiceObj->booking_id,'flag');
                        ?>
                    <tr>
                        <td><?php echo $insr; ?></td>
                        <td><?php echo $invoiceObj->entrydate;  ?></td>
                        <td><a href="<?php echo site_url('BookingDetailBox/'.idencode($invoiceObj->booking_id).'/'.idencode($bookingFlagInvoice)); ?>" class="text-blue" target="_blank"><?php echo $ref; ?></a></td>
                        <td><?php echo idToName('booking_details','id',$invoiceObj->booking_id,'supplier_ref'); ?></td>
                        <td><?php echo idToName('admin','id',$invoiceObj->requestFrom,'login_name'); ?></td> 
                        <td>
                            <div class="input-group"> 
                                <div class="inner-addon right-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                    <input type="text" class="form-control nextDueDate" value="<?php echo $invoiceObj->requestDate; ?>"  style="width: 115px !important;"> 
                                </div>
                            </div>   
                        </td> 
                        <td>
                            <input type="text" class="form-control" value="<?php echo $invoiceObj->requestReference; ?>">
                        </td>
                        <td> 
                            <!-- <button type="button" class="btn btn-primary btn-sm">Send Receipt</button> --> 
                            <button type="button" class="btn btn-primary btn-sm" title="Confirm Payment"><i class="fa fa-check-square-o" aria-hidden="true"></i>
</button> 
                            <button type="button" class="btn btn-danger btn-sm" onclick="requestToDeletePaymentRequest(<?php echo $invoiceObj->id ?>)"><i class="fa fa-trash"></i></button>
                        </td> 
                    </tr> 
                    <?php $insr++; } } } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php if(!empty($CanceledDataRequest)){ ?>
        <div class="col-md-12 table-responsive">
            <h4 style="color:darkcyan;margin-bottom: 0px;margin-top: 30px;">Cancelled Files Request</h4>
            <table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th>S.No</th>
                        <th style="min-width: 70px;">Requested<br>Date</th>
                        <th style="min-width: 70px;">Ref No.</th>
                        <th style="min-width: 100px;">Supplier Ref.</th> 
                        <th>Request <br>By</th> 
                        <th>Cancel<br>Date</th>
                        <th>Amount</th>
                        <th>Reason of Cancellation?</th>
                        <th class="text-center" style="min-width: 85px;">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    if(!empty($CanceledDataRequest)){
                        $canclsr=1;
                        foreach($CanceledDataRequest as $cancelReq){
                        if($cancelReq->requestType=='Cancel File'){
                             $companyId=idToName('booking_details','id',$cancelReq->booking_id,'company');
                             $comCode=idToName('company','id',$companyId,'company_Code');
                             $ref=$comCode.'-'.$cancelReq->booking_id;
                             $bookingFlagcancel=idToName('booking_details','id',$cancelReq->booking_id,'flag');
                    ?>
                    <tr>
                        <td><?php echo $canclsr; ?></td>
                        <td><?php echo $cancelReq->entrydate;  ?></td>
                        <td><a href="<?php echo site_url('BookingDetailBox/'.idencode($cancelReq->booking_id).'/'.idencode($bookingFlagcancel)); ?>" class="text-blue" target="_blank"><?php echo $ref; ?></a></td>
                        <td><?php echo idToName('booking_details','id',$cancelReq->booking_id,'supplier_ref'); ?></td>
                        <td><?php echo idToName('admin','id',$cancelReq->requestFrom,'login_name'); ?></td> 
                        <td>
                            <div class="input-group"> 
                                <div class="inner-addon right-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                    <input type="text" class="form-control nextDueDate" value="<?php echo $cancelReq->requestDate; ?>" style="width: 115px !important;"> 
                                </div>
                            </div>   
                        </td>
                        <td>
                            <input type="text" class="form-control" style="width:70px !important;" value="<?php echo $cancelReq->requestAmount; ?>">
                        </td>
                        <td>

                            <textarea class="form-control" rows="2" ><?php echo $cancelReq->requestReference; ?></textarea>
                            
                        </td>
                        <td>
                            <!-- <button type="button" class="btn btn-primary btn-sm">Send Receipt</button> --> 
                            <button type="button" class="btn btn-primary btn-sm" title="Confirm Payment"><i class="fa fa-check-square-o" aria-hidden="true"></i>
</button> 
                            <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="requestToDeletePaymentRequest(<?php echo $cancelReq->id ?>)"><i class="fa fa-trash"></i></button>
                        </td> 
                    </tr>
                    <?php $canclsr++; } } } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php if(!empty($RefundToCustomerRequest)){ ?>
        <div class="col-md-12 table-responsive">
            <h4 style="color:darkcyan;margin-bottom: 0px;margin-top: 30px;">Refund to Customer Request</h4>
            <table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th>S.No</th>
                        <th style="min-width: 70px;">Requested<br>Date</th>
                        <th style="min-width: 70px;">Ref No.</th>
                        <th style="min-width: 100px;">Supplier Ref.</th> 
                        <th>Request <br>By</th> 
                        <th>Refund<br>Date</th>
                        <th>Amount</th>
                        <th>Reason of Refund?</th>
                        <th class='text-center' style="min-width: 130px;">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php if(!empty($RefundToCustomerRequest)){
                        $cusRefSr=1;
                        foreach($RefundToCustomerRequest as $customerRefObj){
                             if($customerRefObj->requestType=='Refund To Customer'){
                             $companyId=idToName('booking_details','id',$customerRefObj->booking_id,'company');
                             $comCode=idToName('company','id',$companyId,'company_Code');
                             $ref=$comCode.'-'.$customerRefObj->booking_id;
                              $bookingFlagRefund=idToName('booking_details','id',$customerRefObj->booking_id,'flag');
                     ?>
                    <tr>
                        <td><?php echo $cusRefSr;  ?></td>
                        <td><?php echo $customerRefObj->entrydate;  ?></td>
                        <td><a href="<?php echo site_url('BookingDetailBox/'.idencode($customerRefObj->booking_id).'/'.idencode($bookingFlagRefund)); ?>" class="text-blue" target="_blank"><?php echo $ref; ?></a></td>
                        <td><?php echo idToName('booking_details','id',$customerRefObj->booking_id,'supplier_ref'); ?></td>
                        <td><?php echo idToName('admin','id',$customerRefObj->requestFrom,'login_name'); ?></td> 
                        <td>
                            <div class="input-group"> 
                                <div class="inner-addon right-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                    <input type="text" class="form-control nextDueDate" value="<?php echo $customerRefObj->requestDate; ?>" style="width: 115px !important;"> 
                                </div>
                            </div>   
                        </td>
                        <td>
                            <input type="text" class="form-control" style="width:70px !important;" value="<?php echo $customerRefObj->requestAmount; ?>">
                        </td>
                        <td>
                            <textarea class="form-control" rows="2" ><?php echo $customerRefObj->requestReference; ?></textarea>
                            
                        </td>
                        <td>
                            <!-- <button type="button" class="btn btn-primary btn-sm">Send Receipt</button> -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" title="Send Notification" onclick="sendNotification(<?php echo $customerRefObj->booking_id;   ?>)"><i class="fa fa-bell"></i></button>
                            <button type="button" onclick="confirmRefundModal(<?php echo $customerRefObj->booking_id ?>,<?php echo $customerRefObj->requestAmount ?>,<?php echo $customerRefObj->id ?>,'true')" title="Confirm Payment" class="btn btn-primary btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i>
</button> 
                            <button type="button" class="btn btn-danger btn-sm"  title="Delete" onclick="requestToDeletePaymentRequest(<?php echo $customerRefObj->id ?>)"><i class="fa fa-trash"></i></button>
                        </td> 
                    </tr> 
                    <?php $cusRefSr++; } } } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php if(!empty($AirlineRefundRequest)){ ?>
        <div class="col-md-12 table-responsive">
            <h4 style="color:darkcyan;margin-bottom: 0px;margin-top: 30px;">Airline Refund Request</h4>
            <table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th>S.No</th>
                        <th style="min-width: 70px;">Requested<br>Date</th>
                        <th style="min-width: 70px;">Ref No.</th>
                        <th style="min-width: 100px;">Supplier Ref.</th> 
                        <th>Request <br>By</th> 
                        <th>Refund<br>Date</th>
                        <th>Amount</th>
                        <th style="min-width: 50px;">Ref</th>
                        <th class='text-center' style="min-width: 85px;">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php if(!empty($AirlineRefundRequest)){
                        $airlinrSr=1;
                        foreach($AirlineRefundRequest as $airlineRefObj){
                        if($airlineRefObj->requestType=='Airline Refund')
                        {
                         $companyId=idToName('booking_details','id',$airlineRefObj->booking_id,'company');
                         $comCode=idToName('company','id',$companyId,'company_Code');
                         $ref=$comCode.'-'.$airlineRefObj->booking_id;   
                         $bookingFlagrefundAirline=idToName('booking_details','id',$airlineRefObj->booking_id,'flag');
                        ?>
                    <tr>
                        <td><?php echo $airlinrSr; ?></td>
                        <td><?php echo $airlineRefObj->entrydate;  ?></td>
                        <td><a href="<?php echo site_url('BookingDetailBox/'.idencode($airlineRefObj->booking_id).'/'.idencode($bookingFlagrefundAirline)); ?>" class="text-blue" target="_blank"><?php echo $ref; ?></a></td>
                        <td><?php echo idToName('booking_details','id',$airlineRefObj->booking_id,'supplier_ref'); ?></td>
                        <td><?php echo idToName('admin','id',$airlineRefObj->requestFrom,'login_name'); ?></td> 
                        <td>
                            <div class="input-group"> 
                                <div class="inner-addon right-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                    <input type="text" class="form-control nextDueDate" value="<?php echo $airlineRefObj->requestDate; ?>"  style="width: 115px !important;"> 
                                </div>
                            </div>   
                        </td>
                        <td>
                            <input type="text" class="form-control" style="width:70px !important;" value="<?php echo $airlineRefObj->requestAmount; ?>">
                        </td>
                        <td>
                            <textarea class="form-control" rows="2"><?php echo $airlineRefObj->requestReference; ?></textarea>
                            
                        </td>
                        <td>
                            <!-- <button type="button" class="btn btn-primary btn-sm">Send Receipt</button> -->
                            <button type="button" class="btn btn-primary btn-sm" title="Confirm Payment"><i class="fa fa-check-square-o" aria-hidden="true"></i>
</button>
                            <button type="button" class="btn btn-danger btn-sm"  title="Delete" onclick="requestToDeletePaymentRequest(<?php echo $airlineRefObj->id ?>)"><i class="fa fa-trash"></i></button>
                        </td> 
                    </tr> 
                    <?php $airlinrSr++; } } }  ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div> 
<!--    <div class="row">
        <div class="col-md-12 table-responsive">
            <h4 style="color:darkcyan;">Issued Pending Files</h4>
            <table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Ref No.</th>
                        <th>Supplier Ref.</th> 
                        <th>Requested By</th> 
                        <th style="width: 115px">Date</th>
                        <th style="width: 90px;">Amount</th>
                        <th>Ref</th>
                        <th style="width: 130px;">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td> 
                        <td>
                            <div class="input-group"> 
                                <div class="inner-addon right-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                    <input type="text" class="form-control" id="Tdate" style="width: 115px !important;"> 
                                </div>
                            </div>   
                        </td>
                        <td>
                            <input type="text" class="form-control">
                        </td>
                        <td>
                            <input type="text" class="form-control">
                        </td>
                        <td>
                             <button type="button" class="btn btn-primary btn-sm">Send Receipt</button> 
                            <button type="button" class="btn btn-primary btn-sm">Confirm</button>
                            <button type="button" class="btn btn-danger btn-sm" title="Delete" data-toggle="modal" data-target="#TicketOrderRemove"><i class="fa fa-trash"></i></button>
                        </td> 
                    </tr> 
                </tbody>
            </table>
        </div>
    </div>   --> 
    <div class="row">
        <?php if(!empty($ticketorder)){ ?>
        <div class="col-md-12 table-responsive">
            <h4 style="color:darkcyan;margin-bottom: 0px;margin-top: 30px;">Tickets</h4>
            <table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th>S.No</th>
                        <th style="min-width: 70px;">Requested<br>Date</th>
                        <th>Priority</th>
                        <th style="min-width: 70px;">Ref No.</th>
                        <th style="min-width: 100px;">Supplier Agent</th>
                        <th style="min-width: 100px;">Supplier Email</th>
                        <th>Supplier Ref.</th> 
                        <th>GDS</th> 
                        <th>PNR</th>
                        <th style="width:10%;">Ticket Cost</th>
                        <th>Message</th>
                        
                        <th class='text-center' style="min-width: 130px;">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php if(!empty($ticketorder)){ $tickerOrdSr=1; foreach ($ticketorder as $ticketOrdObj){ 
                        $companyIdticketOrder=idToName('booking_details','id',$ticketOrdObj->booking_id,'company');
                         $comCodeTicket=idToName('company','id',$companyIdticketOrder,'company_Code');
                         $refTicket=$comCodeTicket.'-'.$ticketOrdObj->booking_id;   
                         $bookingFlagTicketOrder=idToName('booking_details','id',$ticketOrdObj->booking_id,'flag');
                        ?>
                    <tr>
                        <td><?php echo $tickerOrdSr; ?></td>
                        <td><?php echo $ticketOrdObj->DateReq; ?></td>
                        <td><?php echo $ticketOrdObj->priorty; ?></td>
                        <td><a href="<?php echo site_url('BookingDetailBox/'.idencode($ticketOrdObj->booking_id).'/'.idencode($bookingFlagTicketOrder)); ?>" class="text-blue" target="_blank"><?php echo $refTicket; ?></a></td>
                        <td><?php echo $ticketOrdObj->supplierName; ?></td>
                        <td><?php echo $ticketOrdObj->supplierEmail; ?></td>
                        <td><?php echo $ticketOrdObj->supplierReference; ?></td>
                        <td><?php echo $ticketOrdObj->gds; ?></td>  
                        <td><?php echo $ticketOrdObj->pnr; ?></td>
                        <td>
                            <input type="text" class="form-control" value="<?php echo $ticketOrdObj->issueCost; ?>">
                        </td>
                        <td><textarea class="form-control" rows="2" ><?php echo $ticketOrdObj->message; ?></textarea></td>
                        
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" title="Ticket Order" onclick="sendTicketOrderEmailReady(<?php echo $ticketOrdObj->booking_id ?>)" ><i class="fa fa-file-text-o" aria-hidden="true"></i>
</button> 
                            <button type="button" class="btn btn-primary btn-sm" title="Issue Ticket" onclick="issueBookingLoad(<?php echo $ticketOrdObj->booking_id ?>)"><i class="fa fa-check" aria-hidden="true"></i>
</button>  
                            <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="requestToDeleteTicketOrder(<?php echo $ticketOrdObj->id ?>,<?php echo $ticketOrdObj->booking_id ?>,<?php echo $ticketOrdObj->agentId ?>)"><i class="fa fa-trash"></i></button>
                        </td> 
                    </tr> 
                    <?php $tickerOrdSr++; } } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>         
</div>

<!-- Ticket Order Popup -->
<div class="modal fade" id="TicketOrderEmail" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5 class="modal-title text-center">Ticket Order Email</h5>
            </div>
            <form method="post" id="ticketOderEmailSendForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label>From:</label> 
                                <input type="hidden" name="ticketOrderEmailBookingId" id="ticketOrderEmailBookingId">
                                <input type="text" class="form-control" name="ticketOrderEmailFrom" id="ticketOrderEmailFrom" /> 
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email:To</label> 
                                        <input type="text" class="form-control" id="ticketOrderEmailTo" name="ticketOrderEmailTo" placeholder="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email:Cc</label> 
                                        <input type="text" class="form-control" id="ticketOrderEmailCc" name="ticketOrderEmailCc" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Subject:</label> 
                                <input type="text" class="form-control" name="ticketOrderEmailSubject"  id="ticketOrderEmailSubject" /> 
                            </div>
                            <div class="form-group">
                                <label>Message:</label> 
                                <input type="hidden" name="messageInn" id="messageInn">
                                <div style="height: 300px;overflow-y: scroll;border: 1px solid #d2d2d2;border-left: 3px solid blue;padding: 10px;">
	                                <div class="richText-editor"  id="richText-rpmdya" contenteditable="true">
		                                
	                                </div>
                                     
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Attachment:</label> 
                                <input type="File" class="form-control" name="emailFile" /> 
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



<!-- Customer Refund Request Popup -->
<div class="modal fade" id="SendNotification" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5 class="modal-title text-center">Notification</h5>
            </div>
            <form method="post" id="SendNotificationForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label>From:</label> 
                                <input type="hidden" name="bookingSendNotificationId" id="bookingSendNotificationId">
                                <input type="text" class="form-control" name="notificationFrom" id="notificationFrom" /> 
                            </div>
                            <div class="form-group">
                                <label>To:</label> 
                                <input type="text" class="form-control" name="notificationTo" id="notificationTo" /> 
                            </div>
                            <div class="form-group">
                                <label>Subject:</label> 
                                <input type="text" class="form-control" name="notificationSubject" id="notificationSubject" /> 
                            </div>
                            <div class="form-group">
                                <label>Message:</label> 
                                <input type="hidden" name="hideNotification" id="hideNotification">
                                <div class="richText-editor" id="richText-7a0q7h" contenteditable="true" style="max-height: 300px;overflow-y: scroll; border: 1px solid #d2d2d2;border-left: 3px solid blue;padding: 10px;">
                                  
                            
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Attachment:</label> 
                                <input type="file" name="attachment"  class="form-control"  /> 
                            </div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
                </div>
        </div>
    </div>
            </form>
        </div>
    </div>
</div>
<!-- Send Receipt -->


<!-- View Payment Type -->
<div class="modal fade" id="ViewPaymentType" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5 class="modal-title text-center">Card Details</h5>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive"> 
                            <table class="display  tablColor dataTable" width="100%" cellspacing="0">
                                <thead>
                                     <tr>
                                        <th>Holder Name</th>
                                        <th>Card#</th>
                                        <th>Card Type</th>
                                        <th>Expiry</th>
                                        <th>Security</th>
                                        <th>Address</th> 
                                        <th>Email</th> 
                                        <th>Mobile</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr id="cardDataAddInView">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td> 
                                        <td></td>   
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-primary">Ok</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-bottom: 5px;">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>