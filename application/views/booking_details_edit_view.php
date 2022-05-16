<!-- page content -->
<style>
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
</style>
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Booking Details Edit <?php echo $id; ?></h3>
                    </div>
                    <div class="title_right">
                        <a class="btn btn-danger btn-round pull-right" href="<?php echo site_url('Pending'); ?>">Back</a>
                    </div>
                </div>
                <div class="clearfix"></div>       
                <form name="frm" method="post" id="BookingFormSaveNew"  onsubmit="return saveform('BookingFormSaveNew');" >
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-condensed" width="100%">
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Booking Details:</u></label></td>
                            </tr>
                            <tr style="background-color: whitesmoke;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Booking Dates:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="bookingDate" id="bookingDate" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly="">
                                </td>
                                <td colspan="3" class="text-left"><label class="label">Booking Agent:</label></td>
                                <td colspan="3"><input type="hidden" name="bookingAgentID" id="" value="<?php echo $this->session->userdata("userId"); ?>"><input type="text" value="<?php echo idToName('admin','id',$this->session->userdata("userId"),'login_name'); ?>" name="booking_agent" id="" class="form-control" readonly=""></td>
                            </tr>
                            <tr style="background-color: whitesmoke;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Supplier Name:</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" name="supplier_name">
                                        <option>--Select One--</option>
                                        <option selected="selected" value="Brightsun Travel">Brightsun Travel</option>
                                        <option value="Travel Pack">Travel Pack</option>
                                        <option value="Skylords Travels">Skylords Travels</option>
                                        <option value="Crystal Travels">Crystal Travels</option>
                                        <option value="Citibond Travels">Citibond Travels</option>
                                        <option value="Greaves Travels">Greaves Travels</option>
                                        <option value="Euro Africa Travels">Euro Africa Travels</option>
                                        <option value="Kevin McPhillips">Kevin McPhillips</option>
                                        <option value="Master Fare">Master Fare</option>
                                        <option value="Med View Airline">Med View Airline</option>
                                        <option value="Global Travel">Global Travel</option>
                                        <option value="Reliance Travels">Reliance Travels</option>
                                        <option value="Southall Travel">Southall Travel</option>
                                        <option value="Airline">Airline</option>
                                    </select>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Supplier's Agent Name:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="supplierAgent" class="form-control" onkeypress="removeerror('supplier_agentError',this.id);" onkeyup="onlyletterWithSpace('supplier_agentError',this.id)" id="supplierAgent" placeholder="Please Put Supplier Agent Signal Name ">
                                    <span id="supplier_agentError" ></span>
                                </td>
                            </tr>
                            <tr style="background-color: whitesmoke;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Supplier Reference:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="ibe" id="ibe" class="form-control" placeholder="All sup ref must start by IBE" > 
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Booking Under Brand:</label>
                                </td>
                                <td colspan="3">
                                    <select name="booking_brand" class="form-control" onchange="removeerror('bookingbrandError',this.id)" id="booking_brand">
                                        <option value="">--Select One--</option>
                                        <option value="1" selected="selected">Bright Holiday</option>
                                    </select>
                                    <span id="bookingbrandError"></span>
                                </td>
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Customer Contacts:</u></label></td>
                            </tr>
                            <tr style="background-color: whitesmoke;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Full Name:</label>
                                </td>
                                 <td colspan="3">
                                     <input type="text" name="name"  class="form-control" onkeypress="removeerror('customerNameError',this.id);" onkeyup="onlyletterWithSpace('customerNameError',this.id)" id="customerName" placeholder="Full Name">
                                    <span id="customerNameError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Line Number:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="lineNumber" class="form-control" id="lineNumber" onkeypress="removeerror('lineError',this.id);" onkeyup="onlyDigits('lineError')" maxlength="11" placeholder="Enter 11 digits Line Number">
                                    <span id="lineError"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Postal Address:</label>
                                </td>
                                 <td colspan="3">
                                     <input type="text" name="postalAddress" id="postalAddress" onkeypress="removeerror('postalError',this.id);" class="form-control" id="" placeholder="Postal Address">
                                     <span id="postalError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Mobile Number:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="mobileNumber" class="form-control" id="mobileNumber" onkeypress="removeerror('mobileError',this.id);" onkeyup="onlyDigits2('mobileError')"  placeholder="Enter 11 digits Mobile Number">
                                    <span id="mobileError"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Email:</label>
                                </td>
                                 <td colspan="3">
                                     <input type="email" name="customerEmail" class="form-control" onkeypress="removeerror('customerEmailError',this.id);" id="customerEmail" placeholder="Email">
                                     <span id="customerEmailError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Source Of Booking:</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" name="source_booking" id="sourceBooking" onchange="removeerror('sourceBookingError',this.id);">
                                         <option value="">--Select One--</option>
                                         <option value="new" selected="selected">New</option>
                                         <option value="repeat">Repeat</option>
                                         <option value="reference">Reference</option>
                                    </select>
                                    <span id="sourceBookingError"></span>
                                </td>
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Receipt Details:</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Paying By:</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" name="paying_method" required="" id="payingMethod" onchange="payingMethodCheck(this.value);removeerror('payingError',this.id);">
                                        <option value="">--Select One--</option>
                                        <option value="Bank" selected="selected">Bank</option>
                                        <option value="Card">Card</option>
                                    </select>
                                    <span id="payingError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Payment due Date & Time:</label>
                                </td>
                                <td colspan="2">
                                    <input type="text" name="paymentDueDate" readonly="" onclick="removeerror('paymentDueDateError',this.id)" class="form-control" id="paymentDueDate" placeholder="Enter The Date">
                                    <span id="paymentDueDateError"></span>
                                </td>
                                <td class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" name="paymentDueTime" readonly="" class="form-control" id="timepicker1" placeholder="">
                                       <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                </td>
                            </tr> 
                            <tr id="cardRow" style="display: none;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Card Number:</label>
                                </td>
                                 <td colspan="3">
                                     <input type="text" name="cardNumber"  class="form-control" maxlength="16" onkeypress="return isNumberKey(event);removeerror('cardNumberError',this.id);" id="cardNumber" placeholder="Just Card Numbers" onblur="cardValidCheck(this.value)">
                                     <span id="cardNumberError"></span>
                                 </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Valid From:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="validFrom" class="form-control" onkeypress="removeerror('validFromError',this.id);" id="validFrom" placeholder="mm/yy">
                                    <span id="validFromError"></span>
                                </td>
                            </tr>
                            <tr id="cardRow2" style="display: none;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Card Holder Name:</label>
                                </td>
                                 <td colspan="3">
                                    <input type="text" name="cardHolderName" onkeypress="removeerror('cardHolderError',this.id);" onkeyup="onlyletterWithSpace('cardHolderError',this.id)" class="form-control" id="cardHolderName" placeholder="Card Holder Name">
                                    <span id="cardHolderError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Expiry Date:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="cardExpiryDate" class="form-control" onkeypress="removeerror('expiryDateError',this.id);" id="cardExpiry"  placeholder="mm/yy">
                                    <span id="expiryDateError"></span>
                                </td>
                            </tr>
                            <tr id="cardRow3" style="display: none">
                                <td colspan="3" id="cardBrandLabel" class="text-left" style="display: none">
                                    <label class="label">Card Brand:</label>
                                </td>
                                <td colspan="3" id="cardBrandInput" style="display: none">
                                    <input type="text" class="form-control" name="cardBrand" id="cardBrand" readonly="" placeholder="Card Brand">
                                        
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Security Code:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="cvvNumber" onkeypress="return isNumberKey(event);removeerror('securityCodeError',this.id);" class="form-control" id="securityCode" maxlength="3" placeholder="CVV Number">
                                    <span id="securityCodeError"></span>
                                </td>
                            </tr>
                            <tr id="cardRow4" style="display: none">
                                 <td colspan="3" class="text-left">
                                    <label class="label">Issuing Bank:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" class="form-control" name="issuingBank" id="issuingBank" readonly="" placeholder="Issuing Bank">
                                       
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Card Type:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="cardType"  class="form-control" id="cardType" readonly="" placeholder="Card Type" >
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">New Booking Charge for:</label>
                                </td>
                                 <td colspan="3">
                                     <input type="text" name="amountCharged" class="form-control" onkeypress="return isNumberKey(event);removeerror('amountChargeError',this.id);" id="amountCharged" placeholder="Put Amount Number Without &pound; or GBP">
                                     <span id="amountChargeError"></span>
                                </td> 
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Flight Details:</u></label></td>
                            </tr>
                            <tr style="background-color: whitesmoke;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Departure Airport:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="bookingDeparture" class="form-control" onkeypress="removeerror('departureAirportError',this.id);" onkeyup="onlyletterWithSpace('departureAirportError',this.id)" id="bookingDeparture" placeholder="Departure Airport">
                                    <span id="departureAirportError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Destination airport:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="bookingDestination" class="form-control" onkeypress="removeerror('destinationError',this.id);" onkeyup="onlyletterWithSpace('destinationError',this.id)"  id="bookingDestination" placeholder="Destination airport">
                                    <span id="destinationError"></span>
                                </td> 
                            </tr> 
                            <tr style="background-color: whitesmoke;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Via:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="bookingVia" onkeypress="removeerror('viaError',this.id);" onkeyup="onlyletterWithSpace('viaError',this.id)"  class="form-control" id="bookingVia" placeholder="Via">
                                    <span id="viaError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Flight Type:</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" name="flightType" id="flightType" onchange="removeerror('flightTypeError',this.id);">
                                        <option value="">--Select One--</option>
                                        <option value="Return" selected="selected">Return</option>
                                        <option value="One Way">One Way</option>
                                    </select>
                                    <span id="flightTypeError"></span>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Departure Date:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="departureDate" readonly="" onclick="removeerror('DepartureDateError',this.id);" class="form-control" id="departureDate" placeholder="Departure Date">
                                    <span id="DepartureDateError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Returning Date:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="returnDate" readonly="" onclick="removeerror('returnDateError',this.id);" class="form-control" id="returnBookingDate" placeholder="Returning Date">
                                    <span id="returnDateError"></span>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Airline:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="bookingAirline" class="form-control" onkeypress="removeerror('airlineError',this.id);" onkeyup="onlyletterWithSpace('airlineError',this.id)" id="bookingAirline" placeholder="Airline">
                                    <span id="airlineError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Flight No.</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="flightNo" onkeypress="removeerror('flightNoError',this.id);" onkeyup="alphaNumeric('flightNoError',this.id)" id="flightNo" class="form-control"  placeholder="">
                                    <span id="flightNoError"></span>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Flight Class:</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" name="flightClass" onchange="removeerror('flightClassError',this.id);" id="flightClass">
                                        <option value="">--Select One--</option>
                                        <option value="Economy" selected="selected">Economy</option>
                                        <option value="First Class">First Class</option>
                                        <option value="Bunsiness Class">Business Class</option>
                                    </select>
                                    <span id="flightClassError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">No of Segments:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="noOfSegments" onkeypress="removeerror('noOfSegmentsError',this.id);" onkeyup="onlyNumber('noOfSegmentsError',this.id)" class="form-control" id="noOfSegments" placeholder="">
                                    <span id="noOfSegmentsError"></span>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">PNR:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="pnr" class="form-control" onkeypress="removeerror('pnrError',this.id);" onkeyup="alphaNumeric('pnrError',this.id)" id="pnr" placeholder="PNR">
                                    <span id="pnrError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">PNR Expiry Date & Time:</label>
                                </td>
                                <td colspan="2">
                                    <input type="text" name="pnrExpireDate" readonly="" onclick="removeerror('pnrExpiryDateError',this.id)" class="form-control" id="pnrExpireDate" placeholder="PNR Expiry Date">
                                    <span id="pnrExpiryDateError"></span>
                                </td> 
                                <td  class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" name="pnrExpireTime" readonly="" class="form-control" id="timepicker2" placeholder="">
                                       <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">GDS:</label>
                                </td>
                                <td colspan="3">
                                    <select name="gds" onclick="removeerror('gdsError',this.id)" class="form-control" id="gds" >
                                        <option value="World-Span" >World Span</option>
                                        <option selected="selected" value="Galileo">Galileo</option>
                                        <option value="Sabre">Sabre</option>
                                        <option value="Amadeus">Amadeus</option>
                                        <option value="Web">Web</option>
                                    </select>
                                    <span id="gdsError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Fare Expiry Date & Time:</label>
                                </td>
                                <td colspan="2">
                                    <input type="text" name="fareExpireDate" onclick="removeerror('fareExpiryError',this.id)" class="form-control" readonly="" id="fareExpireDate" placeholder="Fare Expiry Date">
                                    <span id="fareExpiryError"></span>
                                </td> 
                                <td  class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" name="fareExpireTime" readonly="" class="form-control" id="timepicker3" placeholder="">
                                       <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">File Status:</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" name="">
                                        <option value="">--Select One--</option>
                                        <option value="Follow Up" selected="selected">Follow Up</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    <span id="flightClassError"></span>
                                </td>
                                <td colspan="6"> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label">Ticket Details:</label>
                                </td>
                            </tr>
                            <tr>
                                 <td colspan="12">
                                     <textarea id="editor"  class="form-control"  name="ticket_details" rows="20" cols="80"></textarea>
                                </td>
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Ticket Cost:</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label">I) Payable Supplier:</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Basic Fare(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="basicFare" class="form-control" value="0" onkeypress="removeerror('basicFareError',this.id)" onkeyup="numberWithDeceimal('basicFareError',this.id)" id="basicFare" placeholder="Basic Fare">
                                    <span id="basicFareError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Tax(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="tax" onkeypress="removeerror('taxError',this.id)" value="0"  onkeyup="numberWithDeceimal('taxError',this.id)" class="form-control" id="tax" placeholder="Tax">
                                    <span id="taxError"></span>
                                </td> 
                            </tr> 
<!--                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">APC(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="supplier_agent" class="form-control" id="" placeholder="">
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">SAFI(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="supplier_agent" class="form-control" id="" placeholder="">
                                </td> 
                            </tr> -->
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">APC(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="apc" class="form-control" value="0" id="apc" placeholder="APC">
                                    <span id="apcError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">File Status:</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" name="fileStatus">
                                        <option value="">--Select--</option>
                                        <option value="1" selected="selected">Pending Booking</option>
                                        <option value="2">Issued Booking</option>
                                        <option value="3">Card Cancellation</option>
                                        <option value="4">Cash Cancellation</option>
                                        <option value="5">Refund</option>
                                        <option value="6">Chargeback</option>
                                        
                                    </select>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label">II) Additional Expenses(£):</label>
                                </td> 
                            </tr> 
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Bank Charges(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="bankCharge" value="0" onkeypress="removeerror('bankChargesError',this.id)" onkeyup="numberWithDeceimal('bankChargesError',this.id)" class="form-control" id="bankCharge" placeholder="Bank Charges">
                                    <span id="bankChargesError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Card Charges(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="cardCharges" value="0" onkeypress="removeerror('cardChargesError',this.id)" onkeyup="numberWithDeceimal('cardChargesError',this.id)" class="form-control" id="cardCharges" placeholder="Card Charges">
                                    <span id="cardChargesError"></span>
                                </td> 
                            </tr>
                            <tr>
<!--                                <td colspan="3" class="text-left">
                                    <label class="label">APC Payable(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="" class="form-control" id="" placeholder="">
                                </td>-->
                                <td colspan="3" class="text-left">
                                    <label class="label">Transaction Charges(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="transectionCharges" value="0" onkeypress="removeerror('transectionChargesError',this.id)" onkeyup="numberWithDeceimal('transectionChargesError',this.id)" class="form-control" id="transectionCharges" placeholder="Transaction Charges">
                                    <span id="transectionChargesError"></span>
                                </td> 
                            </tr>
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label">Total Cost(£):</label>
                                </td> 
                            </tr> 
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Passenger Details:</u></label></td>
                            </tr> 
                            <tr>
                                <table class="table table-condensed" width="100%" >
                                    <tr>
                                        <th><label class="label">Category</label></th>
                                        <th><label class="label">Title</label></th>
                                        <th><label class="label">First Name</label></th>
                                        <th><label class="label">Mid Name</label></th>
                                        <th><label class="label" >Sur Name</label></th>
                                        <th><label class="label">Age <sup>(yrs)</sup></label></th>
                                        <th><label class="label">Sale Price(£)</label></th>
                                        <th><label class="label">Booking Fee(£)</label></th>
                                        <th><label class="label">E-Ticket No.</label></th>
                                    </tr>
                                    <tbody id="passangerMore">
                                    <input type="hidden" name="" id="countrPassenger" value="0">
                                        <tr>
                                            <td>
                                                <select class="form-control" name="category[]">
                                                    <option value="">--Select one--</option>
                                                    <option value="Adult">Adult</option>
                                                    <option value="Child">Child</option>
                                                    <option value="Infant">Infant</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="passangerTitle[]">
                                                    <option value="">--Select one--</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Miss">Miss</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Mstr">Mstr</option>
                                                    <option value="Lord">Lord</option>
                                                    <option value="Dr">Dr</option>
                                                    <option value="Rev">Rev</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" onkeypress="removeerror('firstNameError0',this.id)" onkeyup="onlyletterWithSpace('firstNameError0',this.id)" id="firstName0" name="firstName[]" placeholder="First Name">
                                                <span id="firstNameError0"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="middle_name[]" class="form-control" id="" placeholder="Middle Name">
                                            </td>
                                            <td>
                                                <input type="text" name="sir_name[]" class="form-control" id="" placeholder="Sur Name">
                                            </td>
                                            <td>
                                                <input type="text"  name="age[]" class="form-control" id="" placeholder="Date Of Birth">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="salePrice[]" onkeypress="removeerror('salePriceError0',this.id)" value="0"  onkeyup="numberWithDeceimal('salePriceError0',this.id)" id="salePrice0" placeholder="Sale Price">
                                                <span id="salePriceError0"></span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="booking_fee[]" onkeypress="removeerror('bookingFeeError0',this.id)" onkeyup="numberWithDeceimal('bookingFeeError0',this.id)" id="bookingFee0" placeholder="Booking Fee">
                                                <span id="bookingFeeError0"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="eticket[]" class="form-control" id="" readonly="" placeholder="Eticket Number">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <button class="btn btn-info pull-right btn-round" type="button" onclick="addMore()">Add More Passenger</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left">
                                    <label class="label">Total Sale Price(£):</label>
                                </td>
                                <td colspan="3">
                                    
                                </td> 
                                <td colspan="3" class="text-left">
                                    <label class="label">Profit(£):</label>
                                </td>
                                <td colspan="3">
                                    
                                </td> 
                            </tr>
                            <tr> 
                                <td colspan="12" style="text-align: center;">
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-lg btn-round" onclick="javascript:window.location='<?php echo site_url("Home/index") ?>'">Back</button> 
                                        &nbsp;&nbsp;
                                        <button class="btn btn-primary btn-lg btn-round" type="button" onclick="saveform('BookingFormSaveNew')" name="save">Save</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                </div>   
                </form>
            </div>
<!-- /page content -->
