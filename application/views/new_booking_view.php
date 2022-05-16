<!-- page content -->
<title>New Booking</title>
<?php  $trigger_date_time = date("Y-m-d H:i", mktime(11,00,0, date('n'), date('j')+1, date('Y'))); ?>
<style>
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    cursor: not-allowed;
    background-color: #fff !important;
    opacity: 1;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    padding: 4px !important;
    border-top: 1px solid #e5e5e5;
}
.form-control {
    border-radius: 0;
    line-height: 30px;
    width: 100%;
    background-color: #fff;
}
    .trStyle {
        color: white;
        font-size: 22px;
        /*background-color: #1ABB9C !important;*/
        padding: 35px !important;
    }

    .trStyle .hedingTd {
        text-align: left !important;
    }
    .labelHeading {
        text-align: left !important;
        margin-left: -50% !important;
    }
    .text-left {
        text-align: left !important;
    }
    .label {
        color: #000 !important;
        font-weight: bold !important;
        font-size: 100%;
        position: relative;
        top: 6px;
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
    .right-addon input { padding-right: 30px; } 
    .vertical-align-bottom { vertical-align: bottom !important; }
    .txtRed {
        color: red !important;
    }
    .input-group input {
        width: 100% !important
    }
    .input-group {
        display: initial !important;
    }
    .text-right {
        text-align: right !important;
    }
</style>
<script>
$('.content').richText({
  // text formatting
  bold: true,
  italic: true,
  underline: true,
  // text alignment
  leftAlign: true,
  centerAlign: true,
  rightAlign: true,
  // lists
  ol: true,
  ul: true,
  // title
  heading: true,
  // fonts
  fonts: true,
  fontList: ["Arial",
    "Arial Black",
    "Comic Sans MS",
    "Courier New",
    "Geneva",
    "Georgia",
    "Helvetica",
    "Impact",
    "Lucida Console",
    "Tahoma",
    "Times New Roman",
    "Verdana"
    ],
  fontColor: true,
  fontSize: true,
  // uploads
  imageUpload: true,
  fileUpload: true,
 Embed: true,
  // link
  urls: true,
  // tables
  table: true,
  // code
  removeStyles: true,
  code: false,
  // colors
  colors: [],
  // dropdowns
  fileHTML: '',
  imageHTML: '',
  // translations
  translations: {
    'title': 'Title',
    'white': 'White',
    'black': 'Black',
    'brown': 'Brown',
    'beige': 'Beige',
    'darkBlue': 'Dark Blue',
    'blue': 'Blue',
    'lightBlue': 'Light Blue',
    'darkRed': 'Dark Red',
    'red': 'Red',
    'darkGreen': 'Dark Green',
    'green': 'Green',
    'purple': 'Purple',
    'darkTurquois': 'Dark Turquois',
    'turquois': 'Turquois',
    'darkOrange': 'Dark Orange',
    'orange': 'Orange',
    'yellow': 'Yellow',
    'imageURL': 'Image URL',
    'fileURL': 'File URL',
    'linkText': 'Link text',
    'url': 'URL',
    'size': 'Size',
    'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsive</a>',
    'text': 'Text',
    'openIn': 'Open in',
    'sameTab': 'Same tab',
    'newTab': 'New tab',
    'align': 'Align',
    'left': 'Left',
    'center': 'Center',
    'right': 'Right',
    'rows': 'Rows',
    'columns': 'Columns',
    'add': 'Add',
    'pleaseEnterURL': 'Please enter an URL',
    'videoURLnotSupported': 'Video URL not supported',
    'pleaseSelectImage': 'Please select an image',
    'pleaseSelectFile': 'Please select a file',
    'bold': 'Bold',
    'italic': 'Italic',
    'underline': 'Underline',
    'alignLeft': 'Align left',
    'alignCenter': 'Align centered',
    'alignRight': 'Align right',
    'addOrderedList': 'Add ordered list',
    'addUnorderedList': 'Add unordered list',
    'addHeading': 'Add Heading/title',
    'addFont': 'Add font',
    'addFontColor': 'Add font color',
    'addFontSize' : 'Add font size',
    'addImage': 'Add image',
    'addVideo': 'Add video',
    'addFile': 'Add file',
    'addURL': 'Add URL',
    'addTable': 'Add table',
    'removeStyles': 'Remove styles',
    'code': 'Show HTML code',
    'undo': 'Undo',
    'redo': 'Redo',
    'close': 'Close'
  },
  // dev settings
  useSingleQuotes: false,
  height: 0,
  heightPercentage: 0,
  id: "",
  class: "",
  useParagraph: true

});
</script>
<script type="text/javascript">
$(document).ready(function() {
           // $('#editor').richText();
            $('.content').richText();
        });
</script>
<script>
    // $(document).ready(function() {  
//         if(CKEDITOR.instances['ticket_details'])
//         {
//            CKEDITOR.instances['ticket_details'].destroy();
//            
//         }
    //initSample();
   // }); 
</script>
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>New Booking</h3>
                    </div>
                    <div class="title_right">
                        <a class="btn btn-info btn-round pull-right" href="<?php echo site_url('Home/index'); ?>">Back</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <form name="frm" method="post" id="BookingFormSaveNew"  onsubmit="return saveform('BookingFormSaveNew');" >
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-condensed" width="100%">
                            <tr class="trStyle" style="background-color: #e5e5e5;">
                                <td colspan="12" class="hedingTd"><label><u>Booking Details:</u></label></td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Booking Reference No.</label>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label>Will be generated by system.</label>
                                </td>
                                <td colspan="3" class="text-left"> </td>
                                <td colspan="3"> </td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Booking Date:</label>
                                </td>
                                <td colspan="3">
                                    <!-- <div class="input-group" style="margin-bottom: 0px;"> 
                                        
                                        <span class="input-group-addon" id=""><i class="fa fa-calendar"></i></span>
                                    </div> -->
                                    <div class="input-group"> 
                                        <div class="inner-addon right-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                                <input type="text" name="bookingDateC" id="bookingDateC" value="<?php echo date('Y-m-d'); ?>" class="form-control nextDueDate "  >
                                            <span id="paymentDueDateError"></span>
                                        </div>
                                    </div>  
                                   
                                </td>
                                <td colspan="3" class="text-left"><label class="label">Booking Agent:</label></td>
                                <td colspan="3"><input type="hidden" name="bookingAgentID" id="" value="<?php echo $this->session->userdata("userId"); ?>"><input type="text" value="<?php echo idToName('admin','id',$this->session->userdata("userId"),'login_name'); ?>" name="booking_agent" id="" class="form-control" readonly=""></td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Supplier Name:</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" name="supplier_name">
                                        <option value="">--Select One--</option>
                                        <?php if(!empty($supplierData)){ foreach($supplierData as $spObj){ if($spObj->supplier_name!='Customer'){ ?>
                                            <option  value="<?php echo $spObj->supplier_name; ?>"><?php echo $spObj->supplier_name; ?></option>
                                        <?php } } } ?>
<!--                                        <option selected="selected" value="Brightsun Travel">Brightsun Travel</option>
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
                                        <option value="The Holiday Team">The Holiday Team</option>
                                        <option value="Airline">Airline</option>-->
                                    </select>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Supplier's Agent's Email:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="supplierAgent" class="form-control" onkeypress="removeerror('supplier_agentError',this.id);"  id="supplierAgent" placeholder="Please Put Supplier Agent Email ">
                                    <span id="supplier_agentError" ></span>
                                </td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Supplier Reference:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="ibe" id="ibe" class="form-control" placeholder="Put supplier reference" > 
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Booking Under Brand:</label>
                                </td>
                                <td colspan="3">
                                    <select name="booking_brand" class="form-control" onchange="removeerror('bookingbrandError',this.id)" id="booking_brand">
                                        <?php if($this->session->userdata('flag')==1 && $this->session->userdata('company')==1){ ?>
                                        <!--<option value=""  disabled>--Select One--</option>-->
                                        <?php foreach($copany as $ourComy){ ?>
                                        <option value="<?php echo $ourComy->id; ?>" <?php if($ourComy->id === 1) echo 'selected="selected"' ?> <?php if($this->session->userdata('company')==$ourComy->id){ ?>  <?php } ?> ><?php echo $ourComy->company_name; ?></option>
                                        <?php } ?>
                                        <?php }
                                        else{
                                            ?>
                                        <!--<option value="" selected="selected" disabled>--Select One--</option>-->
                                            <?php 
                                          foreach($copany as $otherCompObj)
                                          {
                                             ?>
                                                <option value="<?php echo $otherCompObj->id ?>"  <?php if($otherCompObj->id === 1) echo 'selected="selected"' ?> ><?php echo $otherCompObj->company_name; ?></option>
                                            <?php 
                                          } 
                                        } ?>
                                        
                                    </select>
                                    <span id="bookingbrandError"></span>
                                </td>
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Receipt Details:</u></label></td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Paying By:</label>
                                </td>
                                <td colspan="3">
                                	<div class="row">
                                		<div class="col-md-12">
                                			<select class="form-control" name="paying_method" required="" id="payingMethod" onchange="payingMethodCheck(this.value);removeerror('payingError',this.id);">
		                                        <option value="">--Select One--</option>
		                                        <option value="Bank">Bank</option>
		                                        <option value="Card">Card</option>
		                                    </select>
		                                    <span id="payingError"></span>
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
                                                <input type="text" name="paymentDueDate" value="<?php echo $trigger_date_time; ?>" readonly="" onclick="removeerror('paymentDueDateError',this.id)" class="form-control" id="paymentDueDate" placeholder="Payment due Date & Time">
                                    		<span id="paymentDueDateError"></span>
                                        </div>
                                    </div>  
                                </td><!-- 
                                <td class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" name="paymentDueTime" readonly="" class="form-control" id="timepicker1" placeholder="">
                                       <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                </td> -->
                            </tr> 
                            <tr style="background-color: #e5e5e5; display: none;" id="bookingChargeFor">
                                <td colspan="3" class="text-left">
                                     <label id="amountConfirmOrCharge" class="label txtRed">New Booking Charge:</label> 
                                </td>
                                 <td colspan="3">
                                    <input type="text" name="amountCharged" class="form-control" onkeypress="removeerror('amountChargeError',this.id);" id="amountCharged" placeholder="Deposit amount">
                                                 <span id="amountChargeError"></span>
                                </td>
                                <td colspan="3">
                                    
                                </td>
                                <td colspan="3">
                                    
                                </td>
                               
                            </tr>
                            <tr id="cardRow" style="display: none;">
                                <td colspan="3" class="text-left">
                                    <label class="label txtRed">Card Number:</label>
                                </td>
                                <td colspan="3">
                                     <input type="text" name="cardNumber"  class="form-control" maxlength="16" onkeypress="return isNumberKey(event);removeerror('cardNumberError',this.id);" id="cardNumber" placeholder="Can I have sixteenth digits of your card?" >
                                     <span id="cardNumberError"></span>
                                </td>
                                <td id="issuingBankNa" colspan="3" class="text-right" style="display: none;">
                                    <label class="label txtRed">Issuing Bank:</label>
                                </td>
                                <td colspan="3" id="issuningBnakname" style="display: none;">
                                    <input type="text" class="form-control" name="issuingBank" id="issuingBank" readonly="" placeholder="Issuing Bank"> 
                                </td> 
                            </tr>
                            <tr id="cardRow2" style="display: none;">
                                <td colspan="3" class="text-left">
                                    <label class="label txtRed">Cardholder Name:</label>
                                </td>
                                 <td colspan="3">
                                    
                                    <div class="row">
                                        <div class="col-md-7">
                                            <input type="text" name="cardHolderName" onkeypress="removeerror('cardHolderError',this.id);" onkeyup="onlyletterWithSpace('cardHolderError',this.id)" class="form-control" id="cardHolderName" placeholder="What is cardholder name?">
                                            <span id="cardHolderError"></span>
                                        </div>
                                        <div class="col-md-5" style="display: inline-flex;padding-left: 0px;">
                                            <label class="label txtRed">CVV:</label>
                                            <input type="text" name="cvvNumber" onkeypress="return isNumberKey(event);removeerror('securityCodeError',this.id);" onblur="cardValidCheck('cardNumber')" style="padding-right: 0px;" class="form-control" id="securityCode" maxlength="4" placeholder="CVV">
                                            <span id="securityCodeError"></span>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="3" class="text-right">
                                    <label class="label txtRed">Valid From:</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" name="validFrom" class="form-control" onkeypress="removeerror('validFromError',this.id);" maxlength="5" id="validFrom" placeholder="mm/yy">
                                            <span id="validFromError"></span>
                                        </div>
                                        
                                    </div> 
                                </td>
                            </tr>
                            <tr id="cardRow3" style="display: none">
                                <td colspan="3" class="text-left">
                                    
                                            <label class="label txtRed">Expiry Date:</label>
                                            
                                       
                                </td>
                                <td>
                                    <input type="text" name="cardExpiryDate" maxlength="5" class="form-control" onkeypress="removeerror('expiryDateError',this.id);" id="cardExpiry"  placeholder="mm/yy">
                                            <span id="expiryDateError"></span>
                                </td>
                                <td colspan="3" class="text-right">
                                    <label class="label txtRed">Postal Address:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="postalAddress" id="postalAddress" onkeypress="removeerror('postalError',this.id);" class="form-control"  placeholder="Can I have Card registered postal address?
">
                                    <span id="postalError"></span>
                                </td>
                            </tr>
                            <tr  style="display: none">
                                <td colspan="3" id="cardBrandLabel" class="text-left" style="display: none">
                                    <label class="label txtRed">Card Brand:</label>
                                </td>
                                <td colspan="3" id="cardBrandInput" style="display: none">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="cardBrand" id="cardBrand" readonly="" placeholder="Card Brand">
                                        </div>
                                        <div class="col-md-7" style="display: inline-flex;">
                                            <label class="txtRed">Card Type: </label>
                                            <input type="text" name="cardType"  class="form-control" id="cardType" readonly="" placeholder="Card Type" >
                                        </div>
                                    </div>  
                                </td>
                                
                            </tr>
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Customer Contacts:</u></label></td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Full Name:</label>
                                </td>
                                 <td colspan="3">
                                     <input type="text" name="name"  class="form-control" onkeypress="removeerror('customerNameError',this.id);" onkeyup="onlyletterWithSpace('customerNameError',this.id)" id="customerName" placeholder="Full Name">
                                    <span id="customerNameError"></span>
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Customer's Email:</label>
                                </td>
                                <td colspan="3">
                                    <input type="email" name="customerEmail" class="form-control" onkeypress="removeerror('customerEmailError',this.id);" id="customerEmail" placeholder="Enter email">
                                    <span id="customerEmailError"></span>
                                </td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Line Number:</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" name="lineNumber" class="form-control" id="lineNumber" onkeypress="return isNumberKey(event);removeerror('lineError',this.id);"  maxlength="11" placeholder="Enter Line No.">
                                            <span id="lineError"></span>
                                        </div>
                                    </div> 
                                </td>    
                                <td colspan="3" class="text-left"> 
                                    <label class="label">Booking Source:</label>
                                </td>
                                <td colspan="3">  
                                    <select class="form-control" name="source_booking" id="sourceBooking" onchange="removeerror('sourceBookingError',this.id);">
                                         <option value="">Select One</option>
                                         <option value="newsletter" selected="selected">Newsletter</option>
                                         <option value="google">Google</option>
                                         <option value="bing">Bing</option>
                                         <option value="sms">SMS</option>
                                         <option value="friend">Friend</option>
                                         <option value="repeat">Repeat</option> 
                                    </select>
                                    <span id="sourceBookingError"></span>
                                 
                                    <!-- <label class="label"></label> -->
                                             
                                </td>
                            </tr> 
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Mobile:</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-12" style="display: inline-flex;">
                                            <input type="text" name="mobileNumber" class="form-control" id="mobileNumber" onkeypress="return isNumberKey(event);removeerror('mobileError',this.id);"  maxlength="11"  placeholder="Enter Mobile No.">
                                            <span id="mobileError"></span>
                                        </div>
                                    </div> 
                                </td>    
                            </tr> 
                            <!-- <tr id="cardRow4" style="display: none">
                                <td colspan="3" class="text-left">
                                    <label class="label">Issuing Bank:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" class="form-control" name="issuingBank" id="issuingBank" readonly="" placeholder="Issuing Bank">
                                       
                                </td>
                                <td colspan="3" class="text-left"> 
                                </td>
                                <td colspan="3">
                                    
                                </td>
                            </tr> --> 
                            <tr class="trStyle" style="background-color: #e5e5e5;">
                                <td colspan="12" class="hedingTd"><label><u>Flight Details:</u></label></td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Departure Airport:</label>
                                </td>
                                <td colspan="3">  
                                    <input type="text" name="bookingDeparture" class="form-control" onkeypress="removeerror('departureAirportError',this.id);" onkeyup="onlyletterWithSpaceWithDash('departureAirportError',this.id)" id="bookingDeparture" placeholder="Departure Airport">
                                    <span id="departureAirportError"></span>
                                          
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Destination airport:</label>
                                </td>
                                <td colspan="3"> 
                                    <input type="text" name="bookingDestination" class="form-control" onkeypress="removeerror('destinationError',this.id);" onkeyup="onlyletterWithSpaceWithDash('destinationError',this.id)"  id="bookingDestination" placeholder="Destination airport">
                                    <span id="destinationError"></span>  
                                </td> 
                            </tr> 
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Flight Type:</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-control" name="flightType" id="flightType" onchange="removeerror('flightTypeError',this.id);stopCountCheck(this.value);">
                                                <option value="">Select Flight Type </option>
                                                <option value="Return" selected="selected">Return</option>
                                                <option value="One Way">One Way</option>
                                            </select>
                                            <span id="flightTypeError"></span>
                                        </div>
                                    </div>
                                    
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">GDS:</label> 
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select name="gds" onclick="removeerror('gdsError',this.id)" onkeyup="onlyAlphabet('gdsError',this.id)" class="form-control" id="gds" >
                                                 <option value="World-Span" >World Span</option>
                                                 <option selected="selected" value="Galileo">Galileo</option>
                                                 <option value="Sabre">Sabre</option>
                                                 <option value="Amadeus">Amadeus</option>
                                                 <option value="Web">Web</option>
                                            </select>
                                            <span id="gdsError"></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Flight Class:</label>
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-control" name="flightClass" onchange="removeerror('flightClassError',this.id);" id="flightClass">
                                                <option value="">Select Flight Class</option>
                                                <option value="Economy" selected="selected">Economy</option>
                                                <option value="Premium Economy" >Premium Economy</option>
                                                <option value="First Class">First Class</option>
                                                <option value="Bunsiness Class">Business Class</option>
                                            </select>
                                            <span id="flightClassError"></span>
                                        </div>
                                    </div>
                                    
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Segments:</label> 
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-12" style="display: inline-flex;">
                                            
                                            <input type="number" min="0" name="noOfSegments" value="0" onkeypress="removeerror('noOfSegmentsError',this.id);" onkeyup="onlyNumber('noOfSegmentsError',this.id)" class="form-control" readonly="" id="noOfSegmentsw" placeholder="Total Segments">
                                            <span id="noOfSegmentsError"></span>  
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Going stopover:</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" id="bookingVia" name="bookingVia[]" onkeypress="removeerror('viaError',this.id);" onkeyup="onlyletterWithSpaceWithDash('viaError',this.id)" class="form-control" placeholder="Going Stopover">
<!--                                     <select id="bookingVia" name="bookingVia[]" onkeypress="removeerror('viaError',this.id);" class="form-control select2-allow-clear" multiple>
                                        <?php if(!empty($via)){ foreach($via as $viaObj){ ?>
                                        <option value="<?php echo $viaObj->airport_code.'-'.$viaObj->airport_name; ?>"><?php echo $viaObj->airport_code.'-'.$viaObj->airport_name; ?></option>
                                        <?php } } ?>
                                    </select>-->
                                    <!--<input type="text" name="bookingVia" onkeypress="removeerror('viaError',this.id);" onkeyup="onlyletterWithSpace('viaError',this.id)"  class="form-control" id="bookingVia" placeholder="Via">-->
                                    <span id="viaError"></span>
                                </td>
                                <td id="returnngStopLabel" colspan="3" class="text-left">
                                    <label class="label">Returning stopover:</label>
                                </td>
                                <td colspan="3" id="returnngStopCount">
<!--                                    <select id="bookingViaReturning" name="bookingViaReturn[]" onkeypress="removeerror('viaErrorReturn',this.id);" class="form-control select2-allow-clear" multiple>
                                        <?php if(!empty($via)){ foreach($via as $viaObj2){ ?>
                                        <option value="<?php echo $viaObj2->airport_code.'-'.$viaObj2->airport_name; ?>"><?php echo $viaObj2->airport_code.'-'.$viaObj2->airport_name; ?></option>
                                        <?php } } ?>
                                    </select>-->
                                    <input type="text" name="bookingViaReturn[]" onkeypress="removeerror('viaErrorReturn',this.id);" onkeyup="onlyletterWithSpaceWithDash('viaErrorReturn',this.id)"  class="form-control" id="bookingViaReturning" placeholder="Returning  Stopover">
                                    <span id="viaErrorReturn"></span>
                                </td>
                            </tr> 
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Departure Date & Time:</label>
                                </td>
                                <td colspan="3">
                                	<div class="input-group"> 
                                        <div class="inner-addon right-addon">
	                                        <i class="glyphicon glyphicon-calendar"></i>
	                                        <input type="text" name="departureDate" readonly="" onclick="removeerror('DepartureDateError',this.id);" class="form-control" id="departureDate" placeholder="Departure Date & Time">
                                    		<span id="DepartureDateError"></span>
                                        </div>
                                    </div>   
                                </td>
                                <td colspan="3" class="text-left">
                                    <label class="label">Returning Date & Time:</label>
                                </td>
                                <td colspan="3" id="reDateOnOnyWey">
                                	<div class="input-group"> 
                                       	<div class="inner-addon right-addon">
	                                        <i class="glyphicon glyphicon-calendar"></i>
	                                        <input type="text" name="returnDate" readonly="" onclick="removeerror('returnDateError',this.id);" class="form-control" id="returnBookingDate" placeholder="Returning Date & Time">
                                    		<span id="returnDateError"></span>
                                        </div>
                                    </div>
                                </td> 
                            </tr> 
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label">Airline:</label>
                                </td>
                                <td colspan="3"> 
                                    <input type="text" name="bookingAirline" class="form-control" onkeypress="removeerror('airlineError',this.id);" onkeyup="alphaNumericWithDash('airlineError',this.id)" id="bookingAirline" placeholder="Airline">
                                    <span id="airlineError"></span> 
                                </td>
                                <td colspan="3" class="text-left"> 
                                    <!-- <label class="label">Flight No:</label> -->
                                    <label class="label">PNR:</label>
                                    
                                </td>
                                <td colspan="3">  
                                    <!-- <input type="text" name="flightNo" onkeypress="removeerror('flightNoError',this.id);" onkeyup="alphaNumeric('flightNoError',this.id)" id="flightNo" class="form-control"  placeholder="Enter Flight No">
                                    <span id="flightNoError"></span>  -->   
                                         
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" name="pnr" class="form-control" onkeypress="removeerror('pnrError',this.id);" onkeyup="alphaNumeric('pnrError',this.id)" id="pnr" placeholder="PNR">
                                            <span id="pnrError"></span>   
                                        </div>
                                    </div>
                                </td> 
                            </tr>  
                            <tr style="background-color: #e5e5e5;"> 
                                <td colspan="3" class="text-left">
                                    <label class="label">PNR Expiry Date & Time:</label>
                                </td>
                                <td colspan="3">
                                	<div class="input-group"> 
                                        <div class="inner-addon right-addon">
	                                        <i class="glyphicon glyphicon-calendar"></i>
	                                        <input type="text" name="pnrExpireDate" readonly="" onclick="removeerror('pnrExpiryDateError',this.id)" class="form-control" id="pnrExpireDate" placeholder="PNR Expiry Date & Time">
                                    		<span id="pnrExpiryDateError"></span>
                                        </div>
                                    </div> 
                                </td> 
                                <td colspan="3" class="text-left">
                                    <label class="label">Fare Expiry Date & Time:</label>
                                </td> 
                                <td colspan="3">
                                    <div class="input-group"> 
                                         <!--  <input type='text' name="fareExpireDate" onclick="removeerror('fareExpiryError',this.id)"  class="form-control" readonly="" id='fareExpireDate' placeholder="Fare Expiry Date & Time" />
                                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                          <span id="fareExpiryError"></span> --> 
                                          <div class="inner-addon right-addon">
	                                          <i class="glyphicon glyphicon-calendar"></i>
	                                          <input type='text' name="fareExpireDate" onclick="removeerror('fareExpiryError',this.id)"  class="form-control" readonly="" id='fareExpireDate' placeholder="Fare Expiry Date & Time" />
	                                          <span id="fareExpiryError"></span>
                                        </div>
                                    </div>  
                                </td>  
                            </tr> 
                            <tr style="background-color: #e5e5e5;"> 
                                 <td colspan="3" class="text-left">
                                    <label class="label">Airline Locator:</label>
                                </td> 
                                <td colspan="3">
                                    <div class="input-group"> 
                                         <input type="text" name="airlineLocatore" class="form-control" placeholder="Airline Locator">
                                    </div>  
                                </td> 
                                <td colspan="3" class="text-left">
                                    <label class="label"></label>
                                </td>
                                <td colspan="3">
                                    
                                </td> 
                                
                            </tr> 
                            



 


                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label"><u>Flight Details for Customer:</u></label>
                                </td>
                            </tr>
                            <tr>
                                 <td colspan="12" style="border:none !important;">
                                     <textarea   class="form-control content"  name="ticket_details" rows="5" cols="80"></textarea>
                                </td>
                            </tr> 
                            <tr>
                                <td colspan="12" class="text-left">
                                    <label class="label"><u>Flight Details for System:</u></label>
                                </td>
                            </tr>
                            <tr>
                                 <td colspan="12" style="border:none !important;">
                                     <textarea id="editor2"  class="form-control"  name="systemFlightDetails" rows="5" cols="80" ></textarea>
                                     <span id="systemFlightDetailsError"></span>
                                </td>
                            </tr>
                            <tr> 
                                <td colspan="1" class="text-left" style="border:none !important;">
                                    <label class="label">Booking Note:</label> 
                                </td>
                                <td colspan="3" style="border:none !important;">
                                    <textarea class="form-control" name="bookingNote" rows="4" id="bookingNote"></textarea>
                                </td> 
                                <td colspan="2" class="text-right" style="border:none !important;">
                                    <label class="label">Quote Type:</label><br><br><br><br><br>
                                    <label class="label">Payment Plan:</label>
                                </td> 
                                <td colspan="4" class="text-left" style="border:none !important;"> 
                                    <input type="hidden" name="quote_value" id="quote_value">
                                    <input type="hidden" name="paymentNoteValue" id="paymentNoteValue">
                                    <input type="radio" name="quoteType" id="notunderq" onclick="bookingQuote(this.id)">
                                    <label id="labelnotunderq" for="notunderq">Not under quoted</label><br>
                                    <input type="radio" name="quoteType" id="underq" onclick="bookingQuote(this.id)">
                                    <label id="labelunderq" for="underq">Under quoted with availability</label><br>
                                    <input type="radio" name="quoteType" id="underqna" onclick="bookingQuote(this.id)" >
                                    <label id="labelunderqna" for="underqna">Under quoted with non availability</label> <br><br>
                                    <input type="radio" name="paymentPlan" id="fullpayment" onclick="paymentNote(this.id)">
                                    <label id="labelfullpayment" for="fullpayment">Full payment</label> &nbsp;&nbsp;
                                    <input type="radio" name="paymentPlan" id="onInstallment" onclick="paymentNote(this.id)">
                                    <label id="labelonInstallment" for="onInstallment">On installment</label>
                                </td>  
                            </tr> 

                            <tr class="trStyle" >
                                <td colspan="12" class="hedingTd"><label><u>Ticket Cost:</u></label></td>
                            </tr>
                            <tr>
                                <td colspan="12" class="text-left" style="border:none !important;">
                                    <label class="label" style="font-size: 18px; text-decoration: underline;">I) Payable Supplier:</label>
                                </td>
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left"><label class="label" style="position: relative;left: 80px;">Basic Fare(£):</label></td>
                                <td colspan="3" >
                                    <input type="text" name="basicFare" class="form-control" value="0" onkeypress="removeerror('basicFareError',this.id)" onkeyup="numberWithDeceimal('basicFareError',this.id)" id="basicFare" placeholder="Basic Fare">
                                            <span id="basicFareError"></span>
                                </td>
                                <td colspan="3" class="text-right">
                                    <label class="label">Tax(£):</label>
                                    
                                </td>
                                <td colspan="3"> 
                                    <input type="text" name="tax" onkeypress="removeerror('taxError',this.id)" value="0"  onkeyup="numberWithDeceimal('taxError',this.id)" class="form-control" id="tax" placeholder="Tax">
                                            <span id="taxError"></span>
                                </td>  
                            </tr>
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label" style="position: relative;left: 120px;">APC(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="apc" class="form-control" onkeypress="removeerror('apcError',this.id)" onkeyup="numberWithDeceimal('apcError',this.id)" value="0" id="apc" placeholder="APC">
                                            <span id="apcError"></span> 
                                </td>
                                <td colspan="3" class="text-right"> 
                                    <label class="label">SAFI(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="safi" onkeypress="removeerror('safiError',this.id)" onkeyup="numberWithDeceimal('safiError',this.id)" id="safi" class="form-control" placeholder="">
                                            <span id="safiError"></span>
                                </td>
                                
                            </tr> 
                            <tr style="background-color: #e5e5e5;">
                                <td colspan="3" class="text-left">
                                    <label class="label" style="position: relative;left: 120px;">Misc(£):</label> 
                                </td>
                                <td colspan="3" class="text-left">
                                    <input type="text" name="misc" onkeypress="removeerror('miscError',this.id)" onkeyup="numberWithDeceimal('miscError',this.id)" id="misc" class="form-control" placeholder=""> 
                                            <span id="miscError"></span> 
                                </td>
                                <td colspan="3">
                                
                                        <label class="label" style="position: relative;color:black !important;">Admin charges etc.</label>
                                   
                                </td>
                                    
                                    <!--<div class="row">
                                        <div class="" >
                                            <label class="label">File Status:</label>-->
<!--                                            <select class="form-control" name="fileStatus" style="position:absolute;left: 90px;width: 200px;">
                                                <option value="">--Select--</option>
                                                <option value="1" selected="selected">Pending Booking</option>
                                                <option value="2">Issued Booking</option>
                                                <option value="3">Card Cancellation</option>
                                                <option value="4">Cash Cancellation</option>
                                                <option value="5">Refund</option>
                                                <option value="6">Chargeback</option> 
                                            </select>
                                        </div>
                                    </div>-->
                                </td>
                                <td colspan="3"></td>
                            </tr> 
                            <tr>
                                <td colspan="6" class="text-left"></td>
                                <td colspan="6"></td>
                                
                            </tr>
                            
                            <!--                            
                            <tr>
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
                            <tr style="display: none;">
                                <td colspan="12" class="text-left">
                                    <label class="label">II) Additional Expenses(&pound;):</label>
                                </td> 
                            </tr> 
                            <tr style="display: none;">
                                <!-- <td colspan="3" class="text-left">
                                    <label class="label">Bank Charges(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="bankCharge" value="0" onkeypress="removeerror('bankChargesError',this.id)" onkeyup="numberWithDeceimal('bankChargesError',this.id)" class="form-control" id="bankCharge" placeholder="Bank Charges">
                                    <span id="bankChargesError"></span>
                                </td> -->
                                <td colspan="3" class="text-left">
                                    <label class="label">Transaction Charges(£):</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="transectionCharges" value="0" onkeypress="removeerror('transectionChargesError',this.id)" onkeyup="numberWithDeceimal('transectionChargesError',this.id)" class="form-control" id="transectionCharges" placeholder="Transaction Charges">
                                    <span id="transectionChargesError"></span>
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
                            </tr>
                            <tr>
                                <td colspan="12" class="text-left" style="padding-bottom: 15px;display: none;">
                                    <label class="label">Total Cost(£):</label>
                                </td> 
                            </tr> 
                            <tr class="trStyle">
                                <td colspan="12" class="hedingTd"><label><u>Passenger Details:</u></label></td>
                            </tr> 
                            <tr style="background-color: #e5e5e5;">
                                <table class="table table-condensed" width="100%" >
                                    <tr>
                                        <th style="border-top:none;"><label class="label">Category</label></th>
                                        <th style="border-top:none;"><label class="label">Title</label></th>
                                        <th style="border-top:none;"><label class="label">First Name</label></th>
                                        <th style="border-top:none;"><label class="label">Mid Name</label></th>
                                        <th style="border-top:none;"><label class="label" >Sur Name</label></th>
                                        <th style="width: 100px;border-top:none !important;"><label class="label">Age <sup>(yrs)</sup></label></th>
                                        <th style="width: 100px;border-top:none !important;"><label class="label">Sale Price(£)</label></th>
                                        <th style="width: 100px;border-top:none !important;"><label class="label">Admin Fee(£)</label></th>
                                        <th style="width: 100px;border-top:none !important;"><label class="label">E-Ticket No.</label></th>
                                    </tr>
                                    <tbody id="passangerMore">
                                    <input type="hidden" name="" id="countrPassenger" value="0">
                                        <tr style="background-color: #e5e5e5;">
                                            <td>
                                                <select class="form-control" name="category[]">
                                                    <option value="">--Select--</option>
                                                    <option value="Adult">Adult</option>
                                                    <option value="Youth">Youth</option>
                                                    <option value="Child">Child</option>
                                                    <option value="Infant">Infant</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="passangerTitle[]">
                                                    <option value="">--Select--</option>
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
                                                <input type="text" name="sir_name[]" onkeypress="removeerror('surNameError0',this.id)" class="form-control" id="surName0"  placeholder="Sur Name">
                                                <span id="surNameError0"></span>
                                            </td>
                                            <td>
                                                <input type="text"  name="age[]" class="form-control" id="" placeholder="dd/mm/yy">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="salePrice[]" onkeypress="removeerror('salePriceError0',this.id)" value="0"  onkeyup="numberWithDeceimal('salePriceError0',this.id)" id="salePrice0" placeholder="Sale Price">
                                                <span id="salePriceError0"></span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="booking_fee[]" onkeypress="removeerror('bookingFeeError0',this.id)" onkeyup="numberWithDeceimal('bookingFeeError0',this.id)" id="bookingFee0" placeholder="Admin Fee">
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
                                    <button class="btn btn-primary pull-right btn-round" type="button" onclick="addMore()">Add More Passenger</button>
                                </td>
                            </tr>
                            <!-- <tr style="display: none;">
                                <td colspan="6" class="text-left">
                                    <label class="label" style="font-size: 18px; text-decoration: underline;display: none;">Total Sale Price(£):</label>
                                </td> 
                                <td colspan="6" class="text-left">
                                    <label class="label" style="font-size: 18px; text-decoration: underline;margin-left: 30%;display: none;">Profit(£):</label>
                                </td>
                                <td colspan="3">
                                    &nbsp;
                                </td> 
                            </tr>  -->
                            <tr> 
                                <td colspan="12" style="text-align: center;">
                                                                        <div class="form-group text-center">
                                        <button type="button" class="btn btn-danger btn-round" onclick="javascript:window.location='<?php echo site_url("Home/index") ?>'">Back</button> 
                                        &nbsp;&nbsp;
                                        <button class="btn btn-primary btn-round" type="button" onclick="saveform('BookingFormSaveNew')" name="save">Save</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                </div>   
                </form>
            </div>
<!-- /page content --> 