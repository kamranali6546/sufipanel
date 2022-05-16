<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo LINK ?>css/bootstrap.min.css" rel="stylesheet"> 
    <link href="<?php echo LINK ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link href="<?php echo LINK ?>css/animate.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo LINK ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo LINK ?>css/alertify.core.css" rel="stylesheet">
    <link href="<?php echo LINK ?>css/alertify.default.css" rel="stylesheet">
    <link href="<?php echo LINK ?>css/jquery-ui.css" rel="stylesheet">
    <!-- <link href="<?php echo LINK ?>css/bootstrap-timepicker.css" rel="stylesheet"> -->
    <link href="<?php echo LINK ?>js/DatetimePick/jquery-ui-timepicker-addon.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="<?php echo LINK ?>css/select2-bootstrap.css" />-->
    <link rel="stylesheet" type="text/css" href="<?php echo LINK ?>css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo LINK ?>css/richtext.min.css" />
    <!--<link rel="stylesheet" type="text/css" href="<?php echo LINK ?>css/maps/jquery-jvectormap-2.0.1.css" />-->
    <!--<link href="<?php echo LINK ?>css/icheck/flat/green.css" rel="stylesheet" />-->
    <!-- <link href="<?php echo LINK ?>css/floatexamples.css" rel="stylesheet" type="text/css" />--> 
    <script src="<?php echo LINK ?>js/jquery.min.js"></script>
    <script src="<?php echo LINK ?>js/jquery-ui.min.js"></script>
    <!-- <script src="<?php echo LINK ?>js/bootstrap-timepicker.js"></script> -->
     <script src="<?php echo LINK ?>js/bootstrap.min.js"></script>
    <!--<script src="<?php echo LINK ?>js/select2.full.js"></script>-->
    <script src="<?php echo LINK ?>js/select2.js"></script>
    <script src="<?php echo LINK ?>js/progressbar.min.js"></script>
   
<!--    <script type="text/javascript" async="false" >
    document.onkeydown = function(e) {
        if(e.keyCode === 123)
        {
            return false;
        }
        else if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117  ) ) {
            return false;
        }
        else {
            return true;
        }
};
    </script>-->
    
    <script>
    $(document).ready( function() { $(".select2").select2(); });
    </script>
    <script src="<?php echo LINK ?>js/alertify.min.js"></script>
    <script>
        function date_time(id) 
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var month=today.getMonth();
    var d= today.getDate();
    var  year = today.getFullYear();
   var  monthsArray = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('checkin').innerHTML =d+'-'+monthsArray[month]+'-'+year +' <br><span class="timeStyle">'+ h + ":" + m + ":" + s+'</span>';
    var t = setTimeout(startTime, 500);
}
function checkoutTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var month=today.getMonth();
    var d= today.getDate(); 
    var  year = today.getFullYear();
   var  monthsArray = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    m = checkTime2(m);
    s = checkTime2(s);
    document.getElementById('checkout').innerHTML =d+'-'+monthsArray[month]+'-'+year +' <br><span class="timeStyle">'+ h + ":" + m + ":" + s+'</span>';
    var t = setTimeout(checkoutTime, 500);
}
function welTimeShow() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var month=today.getMonth();
    var d= today.getDate(); 
    var  year = today.getFullYear();
   var  monthsArray = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    m = welTime(m);
    s = welTime(s);
    document.getElementById('WelTimeplace').innerHTML =h + ":" + m + ":" + s;
    var t = setTimeout(welTimeShow, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
function checkTime2(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
function welTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
       // NProgress.start();
        $(document).load(function(){
            $("#wait").show();
//    $(document).ajaxStart(function(){
//        $("#wait").css("display", "block");
//    });
//    $(document).ajaxComplete(function(){
//        $("#wait").css("display", "none");
//    });
//    $("button").click(function(){
//        $("#txt").load("demo_ajax_load.asp");
//    });
});
$(document).ready(function(){
            $("#wait").hide();
//    $(document).ajaxStart(function(){
//        $("#wait").css("display", "block");
//    });
//    $(document).ajaxComplete(function(){
//        $("#wait").css("display", "none");
//    });
//    $("button").click(function(){
//        $("#txt").load("demo_ajax_load.asp");
//    });
});
function showLoder()
{
    $('.loader').show();
}
function hideLoder()
{
    $('.loader').hide();
}
// document.getElementById("bookingVia").onblur = function() { myFunction()};
 var ajaxUrl='<?php echo base_url() ?>';
// $(document).ready(
        $(function() {
        $(document).on('focus',function()
        {
            $("#supplierBank").select2();
        }
    )} );
</script>
<script src="<?php echo LINK ?>js/jquery.richtext.js"></script>

<style>
.page-title h3 {
 color: darkcyan;
}
.timeStyle {
    font-size: 18px !important;
    color: chartreuse !important;
    font-weight: bold !important;
}
.alertify {
    border: 4px solid rgba(0, 0, 0, 0.7) !important;
    border-radius: 19px !important;
    left: 65% !important;
    margin-left: -272px !important;
    top: 103px !important;
    width: 329px !important;
}
.loader { 
   background: #1d1d1d70;
   position: absolute;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   height: 200% !important;
   z-index: 9;
   display:none;
}
.loader h3 {
	position: fixed !important;
    top: 45%;
    left: 5%;
    width: 100%;
    height: 50px;
    color: black;
    text-align: center; 
}
.loaderChild { 
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  border-left: 16px solid pink;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  position: fixed !important;
  top:50%;
  left:50%;
  padding:2px; 
  z-index: 9;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.side-menu h3,.menu_section h3
{
    padding: 18px 0px 0px 37px;
    background-color: #000000;
    height: 50px;
    cursor: none;
}
.top_nav .navbar-right {
    width: 25%;
}
.nav.toggle {
    width: 40%;
    
}
.nav.toggle form {
    display: inline-flex;
}
.nav.toggle a {
    margin-top: -10px;
}
.right_col {
    background: #ececece8 !important;
}

table tr td a:visited {
    color: #0d7cbf !important;
}
table.tablColor tbody tr td:last-child a {
    color: white !important;
    text-decoration: none !important;
}
input:focus, select:focus {
    border: 1px solid #1b4e82 !important;
}
#cke_editor > .cke_inner cke_reset > #cke_1_contents >iframe > html {
    background-color:  #ececece8 !important;
}
.ui-widget-header {
    background: #2a3f54;
    color: white;
}
.ui-datepicker .ui-datepicker-prev span {
    margin-left: -12px;
    margin-top: -10px;
    color: white;
    width: 40px;
}
.ui-datepicker .ui-datepicker-next span {
    margin-left: -28px;
    margin-top: -10px;
    color: white;
    width: 40px;
}
.ui-datepicker-next .ui-icon, .ui-datepicker-prev .ui-icon {
    text-indent: 1px !important;
}
.ui_tpicker_hour_slider .ui-slider-handle, .ui_tpicker_minute_slider .ui-slider-handle {
    background: #2a3f54;
}
.ui_tpicker_hour .ui_tpicker_hour_slider, .ui_tpicker_minute .ui_tpicker_minute_slider {
    background: #05acff;
}
button.ui-datepicker-close {
    background: #2a3f54 !important;
    color: white !important;
    font-weight: normal !important;
}
.adonIcon {
    padding: 0px;
}
.adonIcon button {
    padding: 0px;margin: 0px;
}
.adonIcon button i {
    height: 28px; width: 28px; line-height: 28px;
}
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #dcdcdc !important;
}
.right_col {
    min-height: 1150px;
    margin-bottom: -20px;
}
table.tablColor tbody tr td .anchorCustm {
    text-decoration: none !important;
}
table.tablColor tbody tr td .anchorCustm:hover {
    text-decoration: underline !important;
}
.profile .profile_pic img {
    margin-top: 35px;
}
.profile_info { 
    margin-top: 2px;
}
.profile_info span:nth-child(1) {
    float: left;
}
.profile_info h2 {
    float: right;
    margin-top: 8px;
}
.profile_info div {
    position: relative; 
    /*top: -6px;*/
}
.profile_info div, .profile_info div span {
    color:  white;
}
.profile_info div b {
    font-size: 12px;
}
.NumLabel {
    color: white;
    font-size: 11px;
    background: #d9534f;
    float: right;
    margin-top: 1px;
    padding: 2px 5px;
    border-radius: 8px;
} 
@media screen and (max-width: 640px) {
    .page-title .title_left {
        width: 100% !important;
    }
    .page-title .title_right {
        width: 65% !important;
    }
    #sidebar-menu .menu_section:nth-child(2) .side-menu li:nth-child(1) {
        margin-top: 20px !important;
    }
    #sidebar-menu .menu_section:nth-child(2) .side-menu {
        margin-top: 25px !important;
    }
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
</head>
<!--<body class="nav-md" oncontextmenu="return false">-->
<body class="nav-md">
    <div id="wait" class="" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
        <img src='<?php echo base_url(); ?>lib/images/demo_wait.gif' width="64" height="64" />
        <br>Loading..
    </div>
    <div class="loader">
    	<h3>Request processing...</h3>
    	<div class="loaderChild"></div>
    </div>
    <?php  $array_inquiryAllowCompany=array('1','2'); ?>
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="" style="    overflow: unset !important;">
<!--                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo site_url('dashboard/index'); ?>" class="site_title">
                            <img src="<?php echo LINK ?>images/sufiLogo.jpg" style="height: 60px;width: 170px;" /> 
                            <span><?php echo idToName('company','id',$this->session->userdata('company'),'company_Code');  ?></span> 
                        </a>
                    </div>
                    <div class="clearfix"></div>-->
                    <!-- menu prile quick info -->
                    <div class="profile" style="font-family: 'Lobster', cursive !important; font-weight: 100 !important">
                        <div class="profile_pic">
                            <?php $comLog=idToName('company','id',$this->session->userdata('company'),'company_logo'); ?>
                            <img src="<?php echo base_url() ?>upload/<?php echo $comLog; ?>" alt="<?php echo $comLog; ?>" class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome to &nbsp;&nbsp;</span>
                            <h2><?php echo $this->session->userdata('loginName'); ?></h2>
                            <div style="clear: both"></div>
                            <a href="<?php echo site_url('logs'); ?>" style="color: #1abb9c; font-weight: bolder; font-size: 12px;">Login History</a>
                            <div class="uktimes" style="color:#fff !important;"><i>Uk Time: </i> <span id="WelTimeplace" style="color:#fff !important;"><script>window.load=welTimeShow()</script></span></div>
                            
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <!-- <br />
                    <br /> -->
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <?php  if($this->session->userdata('company')==1 && $this->session->userdata('flag')==1){ ?>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Booking Panel</h3>
                            <!-- <br>
                            <br> -->
                            <div class="formofnav">
                                <form action="<?php echo base_url('search-result'); ?>" method="post" style="    padding: 0px 0px 0px 9px;">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <input type="text" name="meg_serch_id" class="form-control" placeholder="Booking No">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-info">Go</button>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab==''){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Booking'); ?>"><i class="fa fa-ticket" aria-hidden="true"></i>New Booking 
                                <span class="NumLabel"><?php echo countTotal('booking_details',array('booking_date'=>date('Y-m-d'))); ?></span
                                ></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='pending'){ echo "current-page"; } } ?>">
                                    <a href="<?php echo site_url('pending-bookings'); ?>">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>Pending Bookings
                                        <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1','canceled_stat'=>'')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="<?php if(!empty($tab)){ if($tab=='fourtypercent'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-fourty-percent-or-above'); ?>"><i class="fa fa-percent" aria-hidden="true"></i>Paid 40% Or Above
                                <span class="NumLabel"><?php echo paidFortyPerCount($this->session->userdata('flag'),$this->session->userdata('userId')); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='redFlag'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-red-flag'); ?>"><i class="fa fa-flag-checkered" aria-hidden="true"></i>Red Flag Bookings
                                <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('red_flag'=>'1')); } else{ echo countTotal('booking_details',array('red_flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='issued'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-bookings'); ?>"><i class="fa fa-check" aria-hidden="true"></i>Issued Uncleared
                                <span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'0')); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cleared'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-cleared-bookings'); ?>"><i class="fa fa-check" aria-hidden="true"></i>Issued Cleared
                                <span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'1')); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cancel'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Canceled'); ?>"><i class="fa fa-times" aria-hidden="true"></i>Cancelled Bookings
                                <span class="NumLabel"><?php echo countTotal('booking_details',array('canceled_stat'=>'1')); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='search'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('search-booking'); ?>"><i class="fa fa-search" aria-hidden="true"></i>Search Booking<span class="NumLabel">new</span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='pendingTask'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-task'); ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Pending Task
                                <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo (countTotal('paymentRequest',array('isRead'=>0))+ countTotal('ticketOrderRequest',array('isRead'=>0))); }  ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='activies'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-activities'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Customers  Activities
                                <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='bfollowup'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('booking-follow-ups'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Booking Follow-ups
                                <span class="NumLabel"><?php echo followUpBookingCount(); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='updatecustomer'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-update'); ?>"><i class="fa fa-file-o" aria-hidden="true"></i>Update Customers
                                <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span>
                                </a></li>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Customer Inquiries</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo site_url('new-customers-inquiries'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> New Inquiries 
                                <span class="NumLabel"><?php echo countTotal('inquiry',array('status'=>'1')) ?></span>
                                </a>
                                <li><a href="<?php echo site_url('followup'); ?>"><i class="fa fa-arrow-up"></i>Inquiry Follow Up 
                                <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo  countTotal('inquiry',array('status'=>'2'));  } else{  echo countTotal('inquiry',array('status'=>'2','picked_by'=>$this->session->userdata('userId'))); } ?></span>
                                </a>
                                <li><a href="<?php echo site_url('picked'); ?>"><i class="fa fa-truck" aria-hidden="true"></i> Day wise Summary 
                                <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo  todayFollowUpDayWiseCount(); } ?></span>
                                </a>
                                <li><a href="<?php echo site_url('Receival-Summary'); ?>"><i class="fa fa-truck" aria-hidden="true"></i> Receival Summary 
                                <span class="NumLabel"><?php echo receivalCount(); ?></span>
                                </a>
                                <li><a href="<?php echo site_url('NewFollowUP'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i>Create Follow-up 
                                <span class="NumLabel"><?php echo todayFollowUpCount(); ?></span>
                                </a>
                                <li><a href="<?php //echo site_url('closed'); ?>"><i class="fa fa-question-circle"></i>Closed Inquiries <span class="NumLabel">123</span></a>
                                <li><a href="<?php echo site_url('emailBackup'); ?>"><i class="fa fa-hdd-o" aria-hidden="true"></i>Email Backup 
                                <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo  countTotal('inquiry',array('status'=>'2'));  } else{  echo countTotal('inquiry',array('status'=>'2','picked_by'=>$this->session->userdata('userId'))); } ?></span>
                                </a>
                                <li><a href="<?php echo site_url('converstion'); ?>"><i class="fa fa-exchange"></i>Sale Conversion 
                                <span class="NumLabel"><?php echo bookingConversionCount($this->session->userdata('flag'),''); ?></span>
                                </a>
                            </ul>
                        </div>
<!--                        <div class="menu_section">
                           <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">SMS To Customer</h3>
                           <ul class="nav side-menu">
                               <li><a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>Send Single SMS<span class="NumLabel"><?php echo countTotal('inquiry',array('status'=>'1')) ?></span></a></li>
                               <li><a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i>Send Bulk SMS<span class="NumLabel"><?php echo countTotal('inquiry',array('status'=>'1')) ?></span></a></li>
                           </ul>
                        </div>-->
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Accounts</h3>
                            <ul class="nav side-menu">
                                 <li class="<?php if(!empty($tab)){ if($tab=='bankCashBook'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('bank-cash-book'); ?>"><i class="fa fa-book" aria-hidden="true"></i>UK Cash Books<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='expense'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('uk-Expenditures'); ?>"><i class="fa fa-money" aria-hidden="true"></i>UK Expenditures
                                 <!--<span class="NumLabel"><?php echo expenditureCount(); ?></span>-->
                                 </a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='UkOtherIncome'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('uk-income'); ?>"><i class="fa fa-money" aria-hidden="true"></i>UK Income<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='PkOtherIncome'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('pk-income'); ?>"><i class="fa fa-money" aria-hidden="true"></i>PK Income<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='ledgure'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('suplier-ledgers-accounts'); ?>"><i class="fa fa-book" aria-hidden="true"></i>UK Supplier<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='accounts'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('suspense-account'); ?>"><i class="fa fa-user-secret" aria-hidden="true"></i>Suspense Account<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='trialBalance'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('trial-balance'); ?>"><i class="fa fa-balance-scale" aria-hidden="true"></i>UK Trial Balance<span class="NumLabel">0</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='accountsFinal'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('final-accounts'); ?>"><i class="fa fa-terminal" aria-hidden="true"></i>Final Accounts<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='transection'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('TransectionBox'); ?>"><i class="fa fa-exchange" aria-hidden="true"></i>Uk New Transaction<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='Pktransection'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('TransectionBoxPk'); ?>"><i class="fa fa-exchange" aria-hidden="true"></i>Pk New Transaction<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='pkBankBook'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('pk-bank-book'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i>PK Bank Book<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='officeExpensePk'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('pk-office-expenditures'); ?>"><i class="fa fa-money" aria-hidden="true"></i>PK Expenditures<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='pkTrialBalance'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('pk-trial-balance'); ?>"><i class="fa fa-balance-scale" aria-hidden="true"></i>PK Trial Balance<span class="NumLabel">new</span></a></li> 
                            </ul>
                        </div>
                         <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Reportings</h3>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab=='reports'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('GeneralReportBox'); ?>"><i class="fa fa-file" aria-hidden="true"></i>General Reports
                                <span class="NumLabel"><?php echo generalReportCount(); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='progressSheet'){ echo "current-page"; } } ?>" ><a href="<?php echo base_url('Home/index'); ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Progress Sheet
                                <span class="NumLabel"><?php echo progressSheetCount(); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='attendance'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Attendance'); ?>"><i class="fa fa-calendar"></i>Attendence Sheet<span class="NumLabel">0</span></a></li>
                            </ul>
                         </div>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Admin</h3>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab=='agents'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('User'); ?>"><i class="fa fa-user"></i>Logins 
                                <span class="NumLabel"><?php echo countLoginArea(); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='company'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Agencies'); ?>"><i class="fa fa-building"></i>Brands
                                <span class="NumLabel"><?php echo countTotal('company',array('flag'=>'1')) ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='bank'){ echo "current-page"; }} ?>"><a href="<?php echo site_url('BankBoxAll'); ?>"><i class="fa fa-institution"></i>Assets
                                <span class="NumLabel"><?php echo countTotal('bank',array('flag'=>'1'))+countTotal('bank',array('flag'=>'0')); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='expenditure'){ echo "current-page"; }} ?>"><a href="<?php echo site_url('ExpenseBox'); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Expenses
                                <span class="NumLabel"><?php echo countTotal('expense_head',array('flag'=>1)) + countTotal('expense_head',array('flag'=>0)); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='supplier'){ echo "current-page"; }} ?>"><a href="<?php echo site_url('SupplierBox'); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Liabilities
                                <span class="NumLabel"><?php echo countTotal('suppliers',array('flag'=>'1'))+countTotal('suppliers',array('flag'=>'0')) ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='income'){ echo "current-page"; }} ?>"><a href="<?php echo site_url('IncomeBox'); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Income/Revenue
                                <span class="NumLabel"><?php echo countTotal('income_head',array('flag'=>'1')); ?></span>
                                </a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='deletefile'){ echo "current-page"; }} ?>"><a href="<?php echo site_url('DeleteBoxes'); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete Files<span class="NumLabel">01</span></a></li>
                            </ul>
                        </div>
                    <?php } 
                    else if($this->session->userdata('company')==2 && $this->session->userdata('flag')==2)
                    {
                        ?>
                         <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Booking Panel</h3>
<!--                            <br>
                            <br>-->
                            <div class="">
                                <form action="<?php echo base_url('search-result'); ?>" method="post" style="    padding: 0px 0px 0px 9px;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" name="meg_serch_id" class="form-control" placeholder="Booking No">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-info">Go</button>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab=='pending'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Pending Bookings<span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'1','canceled_stat'=>''));  ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='fourtypercent'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-fourty-percent-or-above'); ?>"><i class="fa fa-percent" aria-hidden="true"></i>Paid 40% Or Above<span class="NumLabel"><?php echo paidFortyPerCount($this->session->userdata('flag'),$this->session->userdata('userId')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='redFlag'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-red-flag'); ?>" ><i class="fa fa-flag-checkered" aria-hidden="true"></i>Red Flag Bookings<span class="NumLabel"><?php  echo countTotal('booking_details',array('red_flag'=>'1'));  ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='issued'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-bookings'); ?>"><i class="fa fa-check" aria-hidden="true"></i>Issued Uncleared<span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'0')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cleared'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-cleared-bookings'); ?>"><i class="fa fa-check" aria-hidden="true"></i>Issued Cleared<span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'1')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cancel'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Canceled'); ?>"><i class="fa fa-times" aria-hidden="true"></i>Cancelled Bookings<span class="NumLabel"><?php echo countTotal('booking_details',array('canceled_stat'=>'1')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='search'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('search-booking'); ?>"><i class="fa fa-search" aria-hidden="true"></i>Search Booking<span class="NumLabel">new</span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='pendingTask'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-task'); ?>" ><i class="fa fa-tasks" aria-hidden="true"></i>Pending Task<span class="NumLabel"><?php if($this->session->userdata('flag')==2){ echo (countTotal('paymentRequest',array('isRead'=>'0'))+countTotal('ticketOrderRequest',array('isRead'=>'0'))); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='activies'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-activities'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Customers Activities<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='bfollowup'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('booking-follow-ups'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Booking Follow-ups<span class="NumLabel"><?php echo followUpBookingCount(); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='updatecustomer'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-update'); ?>"><i class="fa fa-file-o" aria-hidden="true"></i>Update Customers<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Accounts</h3>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab=='bankCashBook'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('bank-cash-book'); ?>"><i class="fa fa-book" aria-hidden="true"></i>UK Cash Books<span class="NumLabel">new</span></a></li> 
                                <li class="<?php if(!empty($tab)){ if($tab=='expense'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('uk-Expenditures'); ?>"><i class="fa fa-money" aria-hidden="true"></i>UK Expenditures<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='UkOtherIncome'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('uk-other-income'); ?>"><i class="fa fa-money" aria-hidden="true"></i>UK Other Income<span class="NumLabel">new</span></a></li> 
                                 <li class="<?php if(!empty($tab)){ if($tab=='PkOtherIncome'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('pk-other-income'); ?>"><i class="fa fa-money" aria-hidden="true"></i>PK Other Income<span class="NumLabel">new</span></a></li> 
                                <li class="<?php if(!empty($tab)){ if($tab=='ledgure'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('suplier-ledgers-accounts'); ?>"><i class="fa fa-book" aria-hidden="true"></i>UK Supplier<span class="NumLabel">new</span></a></li> 
                                <li class="<?php if(!empty($tab)){ if($tab=='accounts'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('suspense-account'); ?>"><i class="fa fa-user-secret" aria-hidden="true"></i>Suspense Account<span class="NumLabel">new</span></a></li> 
                                <li class="<?php if(!empty($tab)){ if($tab=='trialBalance'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('trial-balance'); ?>"><i class="fa fa-balance-scale" aria-hidden="true"></i>UK Trial Balance<span class="NumLabel">0</span></a></li> 
                                <li class="<?php if(!empty($tab)){ if($tab=='accountsFinal'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('final-accounts'); ?>"><i class="fa fa-terminal" aria-hidden="true"></i>Final Accounts<span class="NumLabel">new</span></a></li> 
                                <li class="<?php if(!empty($tab)){ if($tab=='transection'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('TransectionBox'); ?>"><i class="fa fa-exchange" aria-hidden="true"></i>New Transaction<span class="NumLabel">new</span></a></li> 
                            </ul>
                        </div>
                         <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Reportings</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo site_url('GeneralReportBox'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i>General Reports<span class="NumLabel"><?php echo generalReportCount(); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='attendance'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Attendance'); ?>"><i class="fa fa-calendar"></i>Attendence Sheet<span class="NumLabel">0</span></a></li>
                            </ul>
                         </div>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Admin</h3>
                            <ul class="nav side-menu">
                                <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i>Assets<span class="NumLabel">new</span></a></li>
                                <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i>Supliers's Area<span class="NumLabel">new</span></a></li>
                            </ul>
                        </div>
                        <?php
                    }
                    else if($this->session->userdata('flag')==3)
                    {
                        ?>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Booking Panel</h3>
<!--                            <br>
                            <br>-->
                            <div class="">
                                <form action="<?php echo base_url('search-result'); ?>" method="post" style="    padding: 0px 0px 0px 9px;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" name="meg_serch_id" class="form-control" placeholder="Booking No">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-info">Go</button>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab==''){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Booking'); ?>"><i class="fa fa-ticket" aria-hidden="true"></i>New Booking <span class="NumLabel"><?php echo countTotal('booking_details',array('booking_date'=>date('Y-m-d'),'booking_under_brand'=>$this->session->userdata('company'))); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='pending'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Pending Bookings<span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'1','canceled_stat'=>'','booking_under_brand'=>$this->session->userdata('company')));  ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='fourtypercent'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-fourty-percent-or-above'); ?>"><i class="fa fa-percent" aria-hidden="true"></i>Paid 40% Or Above<span class="NumLabel"><?php echo paidFortyPerCount($this->session->userdata('flag'),$this->session->userdata('userId')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='redFlag'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-red-flag'); ?>" ><i class="fa fa-flag-checkered" aria-hidden="true"></i>Red Flag Bookings<span class="NumLabel"><?php  echo countTotal('booking_details',array('red_flag'=>'1'));  ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='issued'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Issued Uncleared<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'0')); } else{ echo countTotal('booking_details',array('flag'=>'2','booking_under_brand'=>$this->session->userdata('company'),'cleared_stat'=>'0')); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cleared'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-cleared-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Issued Cleared<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'2','booking_under_brand'=>$this->session->userdata('company'),'cleared_stat'=>'1')); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='canceled'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Canceled'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Cancelled Bookings<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','canceled_stat'=>'1','booking_under_brand'=>$this->session->userdata('company'))); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='search'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('search-booking'); ?>"><i class="fa fa-search" aria-hidden="true"></i>Search Booking<span class="NumLabel">new</span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='pendingTask'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-task'); ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Pending Task<span class="NumLabel"><?php if($this->session->userdata('flag')==3){ echo (countTotal('paymentRequest',array('isRead'=>0,'brand'=>$this->session->userdata('company')))+ countTotal('ticketOrderRequest',array('isRead'=>0,'brand'=>$this->session->userdata('company')))); }  ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='activies'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-activities'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Customers Activities<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                                <!--<li class="<?php if(!empty($tab)){ if($tab=='bfollowup'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('booking-follow-ups'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Booking Follow-ups<span class="NumLabel">new</span></a></li>-->
                                <li class="<?php if(!empty($tab)){ if($tab=='updatecustomer'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-update'); ?>"><i class="fa fa-file-o" aria-hidden="true"></i>Update Customers<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                            </ul>
                        </div>
                         <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Reportings</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo site_url('GeneralReportBox'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i>General Reports<span class="NumLabel"><?php echo generalReportCount('',$this->session->userdata('company')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='progressSheet'){ echo "current-page"; } } ?>" ><a href="<?php echo base_url('Home/index'); ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Progress Sheet<span class="NumLabel"><?php echo progressSheetCount(0,$this->session->userdata('company')); ?></span></a></li>
                            </ul>
                         </div>
                          <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Admin</h3>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab=='agents'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('User'); ?>"><i class="fa fa-user"></i>Logins <span class="NumLabel"><?php echo countLoginArea($this->session->userdata('company')); ?></span></a></li>
                            </ul>
                        </div>
                        <?php 
                    }
                    else if($this->session->userdata('company')==1 && $this->session->userdata('flag')==4)
                    {
                        ?>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Booking Panel</h3>
<!--                            <br>
                            <br>-->
                            <div class="">
                                <form action="<?php echo base_url('search-result'); ?>" method="post" style="    padding: 0px 0px 0px 9px;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" name="meg_serch_id" class="form-control" placeholder="Booking No">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-info">Go</button>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab=='pending'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Pending Bookings<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='fourtypercent'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-fourty-percent-or-above'); ?>"><i class="fa fa-percent" aria-hidden="true"></i>Paid 40% Or Above<span class="NumLabel"><?php echo paidFortyPerCount($this->session->userdata('flag'),$this->session->userdata('userId')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='redFlag'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-red-flag'); ?>" ><i class="fa fa-flag-checkered" aria-hidden="true"></i>Red Flag Bookings<span class="NumLabel"><?php echo countTotal('booking_details',array('red_flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='issued'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-bookings'); ?>"><i class="fa fa-check" aria-hidden="true"></i>Issued Uncleared<span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'0')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cleared'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-cleared-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Issued Cleared<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'2','booked_agent_id'=>$this->session->userdata('userId'),'cleared_stat'=>'1')); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cancel'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Canceled'); ?>"><i class="fa fa-times" aria-hidden="true"></i>Cancelled Bookings<span class="NumLabel"><?php echo countTotal('booking_details',array('canceled_stat'=>'1')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='search'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('search-booking'); ?>"><i class="fa fa-search" aria-hidden="true"></i>Search Booking<span class="NumLabel">new</span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='pendingTask'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-task'); ?>" ><i class="fa fa-tasks" aria-hidden="true"></i>Pending Task<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='activies'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-activities'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Customers Activities<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                                <!--<li class="<?php if(!empty($tab)){ if($tab=='bfollowup'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('booking-follow-ups'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Booking Follow-ups<span class="NumLabel">new</span></a></li>-->
                                <li class="<?php if(!empty($tab)){ if($tab=='updatecustomer'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-update'); ?>"><i class="fa fa-file-o" aria-hidden="true"></i>Update Customers<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Customer Inquiries</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo site_url('new-customers-inquiries'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> New Inquiries <span class="NumLabel"><?php echo countTotal('inquiry',array('status'=>'1')) ?></span></a>
                                    <li><a href="<?php echo site_url('followup'); ?>"><i class="fa fa-arrow-up"></i>Inquiry Follow Up <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo  countTotal('inquiry',array('status'=>'2'));  } else{  echo countTotal('inquiry',array('status'=>'2','picked_by'=>$this->session->userdata('userId'))); } ?></span></a>
                                <li><a href="<?php echo site_url('picked'); ?>"><i class="fa fa-truck" aria-hidden="true"></i> Day wise Summary <span class="NumLabel"><?php echo todayFollowUpDayWiseCount($this->session->userdata('userId')); ?></span></a>
                               <!--<li><a href="<?php echo site_url('Receival-Summary'); ?>"><i class="fa fa-truck" aria-hidden="true"></i> Receival Summary <span class="NumLabel"><?php echo receivalCount($this->session->userdata('userId'));  ?></span></a>-->
                                <li><a href="<?php echo site_url('NewFollowUP'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i>Create Follow-up <span class="NumLabel"><?php echo todayFollowUpCount($this->session->userdata('userId')); ?></span></a>
                                <!--<li><a href="<?php //echo site_url('closed'); ?>"><i class="fa fa-question-circle"></i>Closed Inquiries <span class="NumLabel">123</span></a>-->
                                <li><a href="<?php echo site_url('emailBackup'); ?>"><i class="fa fa-hdd-o" aria-hidden="true"></i>Email Backup <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo  countTotal('inquiry',array('status'=>'2'));  } else{  echo countTotal('inquiry',array('status'=>'2','picked_by'=>$this->session->userdata('userId'))); } ?></span></a>
                                <li><a href="<?php echo site_url('converstion'); ?>"><i class="fa fa-exchange"></i>Sale Conversion <span class="NumLabel"><?php echo bookingConversionCount($this->session->userdata('flag'),$this->session->userdata('userId')); ?></span></a>
                            </ul>
                        </div>
<!--                        <div class="menu_section">
                           <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">SMS To Customer</h3>
                           <ul class="nav side-menu">
                               <li><a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>Send Single SMS<span class="NumLabel"><?php echo countTotal('inquiry',array('status'=>'1')) ?></span></a></li>
                               <li><a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i>Send Bulk SMS<span class="NumLabel"><?php echo countTotal('inquiry',array('status'=>'1')) ?></span></a></li>
                           </ul>
                        </div>-->
                         <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Reportings</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo site_url('GeneralReportBox'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i>General Reports<span class="NumLabel"><?php echo generalReportCount($this->session->userdata('userId')); ?></span></a></li>
                                <li><a href="<?php echo base_url('Home/index'); ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Progress Sheet<span class="NumLabel">new</span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='attendance'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Attendance'); ?>"><i class="fa fa-calendar"></i>Attendence Sheet<span class="NumLabel">0</span></a></li>
                            </ul>
                         </div>
                        <?php
                    }
                    else if($this->session->userdata('company')==1 && $this->session->userdata('flag')==5)
                    {
                        ?>
                         <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Booking Panel</h3>
<!--                            <br>
                            <br>-->
                            <div class="">
                                <form action="<?php echo base_url('search-result'); ?>" method="post" style="    padding: 0px 0px 0px 9px;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" name="meg_serch_id" class="form-control" placeholder="Booking No">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-info">Go</button>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab==''){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Booking'); ?>"><i class="fa fa-ticket" aria-hidden="true"></i>New Booking <span class="NumLabel"><?php echo countTotal('booking_details',array('booking_date'=>date('Y-m-d'),'booked_agent_id'=>$this->session->userdata('userId'))); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='pending'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Pending Bookings<span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'),'canceled_stat'=>''));  ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='fourtypercent'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-fourty-percent-or-above'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Paid 40% Or Above<span class="NumLabel"><?php echo paidFortyPerCount($this->session->userdata('flag'),$this->session->userdata('userId')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='redFlag'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-red-flag'); ?>" ><i class="fa fa-flag-checkered" aria-hidden="true"></i>Red Flag Bookings<span class="NumLabel"><?php echo countTotal('booking_details',array('red_flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='issued'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-bookings'); ?>"><i class="fa fa-check" aria-hidden="true"></i>Issued Uncleared<span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'2','booked_agent_id'=>$this->session->userdata('userId'),'cleared_stat'=>'0')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cleared'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-cleared-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Issued Cleared<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'2','booked_agent_id'=>$this->session->userdata('userId'),'cleared_stat'=>'1')); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cancel'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Canceled'); ?>"><i class="fa fa-times" aria-hidden="true"></i>Cancelled Bookings<span class="NumLabel"><?php echo countTotal('booking_details',array('canceled_stat'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='search'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('search-booking'); ?>"><i class="fa fa-search" aria-hidden="true"></i>Search Booking<span class="NumLabel">new</span></a></li>
                                <!--<li class="<?php if(!empty($tab)){ if($tab=='pendingTask'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-task'); ?>" ><i class="fa fa-tasks" aria-hidden="true"></i>Pending Task<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>-->
                                <li class="<?php if(!empty($tab)){ if($tab=='activies'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-activities'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Customers  Activities<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                                <!--<li class="<?php if(!empty($tab)){ if($tab=='bfollowup'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('booking-follow-ups'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Booking Follow-ups<span class="NumLabel">new</span></a></li>-->
                                <li class="<?php if(!empty($tab)){ if($tab=='updatecustomer'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-update'); ?>"><i class="fa fa-file-o" aria-hidden="true"></i>Update Customers<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Customer Inquiries</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo site_url('new-customers-inquiries'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> New Inquiries <span class="NumLabel"><?php echo countTotal('inquiry',array('status'=>'1')) ?></span></a>
                                <li><a href="<?php echo site_url('followup'); ?>"><i class="fa fa-arrow-up"></i>Inquiry Follow Up <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo  countTotal('inquiry',array('status'=>'2'));  } else{  echo countTotal('inquiry',array('status'=>'2','picked_by'=>$this->session->userdata('userId'))); } ?></span></a>
                                <li><a href="<?php echo site_url('picked'); ?>"><i class="fa fa-truck" aria-hidden="true"></i> Day wise Summary <span class="NumLabel"><?php echo todayFollowUpDayWiseCount($this->session->userdata('userId')); ?></span></a>
                                <!--<li><a href="<?php echo site_url('Receival-Summary'); ?>"><i class="fa fa-truck" aria-hidden="true"></i> Receival Summary <span class="NumLabel"><?php echo receivalCount($this->session->userdata('userId'));  ?></span></a>-->
                                <li><a href="<?php echo site_url('NewFollowUP'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i>Create Follow-up <span class="NumLabel"><?php echo todayFollowUpCount($this->session->userdata('userId')) ?></span></a>
                                <!--<li><a href="<?php //echo site_url('closed'); ?>"><i class="fa fa-question-circle"></i>Closed Inquiries <span class="NumLabel">123</span></a>-->
                                <li><a href="<?php echo site_url('emailBackup'); ?>"><i class="fa fa-hdd-o" aria-hidden="true"></i>Email Backup <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo  countTotal('inquiry',array('status'=>'2'));  } else{  echo countTotal('inquiry',array('status'=>'2','picked_by'=>$this->session->userdata('userId'))); } ?></span></a>
                                <li><a href="<?php echo site_url('converstion'); ?>"><i class="fa fa-exchange"></i>Sale Conversion <span class="NumLabel"><?php echo bookingConversionCount($this->session->userdata('flag'),$this->session->userdata('userId')); ?></span></a>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Reportings</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo site_url('GeneralReportBox'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i>General Reports<span class="NumLabel"><?php echo generalReportCount($this->session->userdata('userId')); ?></span></a></li>
                                <li><a href="<?php echo base_url('Home/index'); ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Progress Sheet<span class="NumLabel"><?php echo progressSheetCount($this->session->userdata('userId')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='attendance'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Attendance'); ?>"><i class="fa fa-calendar"></i>Attendence Sheet<span class="NumLabel">0</span></a></li>
                            </ul>
                        </div>
                        <?php 
                    }
                    else if($this->session->userdata('company')!=1 && $this->session->userdata('flag')==5)
                    {
                       ?>
                       <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Booking Panel</h3>
<!--                            <br>
                            <br>-->
                            <div class="">
                                <form action="<?php echo base_url('search-result'); ?>" method="post" style="    padding: 0px 0px 0px 9px;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" name="meg_serch_id" class="form-control" placeholder="Booking No">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-info">Go</button>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                            <ul class="nav side-menu">
                                <li class="<?php if(!empty($tab)){ if($tab==''){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Booking'); ?>"><i class="fa fa-ticket" aria-hidden="true"></i>New Booking <span class="NumLabel"><?php echo countTotal('booking_details',array('booking_date'=>date('Y-m-d'),'booked_agent_id'=>$this->session->userdata('userId'))); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='pending'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Pending Bookings<span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'),'canceled_stat'=>''));  ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='fourtypercent'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-fourty-percent-or-above'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Paid 40% Or Above<span class="NumLabel"><?php echo paidFortyPerCount($this->session->userdata('flag'),$this->session->userdata('userId')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='redFlag'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-bookings-red-flag'); ?>" ><i class="fa fa-flag-checkered" aria-hidden="true"></i>Red Flag Bookings<span class="NumLabel"><?php  echo countTotal('booking_details',array('red_flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='issued'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-bookings'); ?>"><i class="fa fa-check" aria-hidden="true"></i>Issued Uncleared<span class="NumLabel"><?php  echo countTotal('booking_details',array('flag'=>'2','booked_agent_id'=>$this->session->userdata('userId'),'cleared_stat'=>'0')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cleared'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('issued-cleared-bookings'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Issued Cleared<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'2','booked_agent_id'=>$this->session->userdata('userId'),'cleared_stat'=>'1')); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cancel'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Canceled'); ?>"><i class="fa fa-times" aria-hidden="true"></i>Cancelled Bookings<span class="NumLabel"><?php echo countTotal('booking_details',array('canceled_stat'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='search'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('search-booking'); ?>"><i class="fa fa-search" aria-hidden="true"></i>Search Booking<span class="NumLabel">new</span></a></li>
                                <!--<li class="<?php if(!empty($tab)){ if($tab=='pendingTask'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('pending-task'); ?>" ><i class="fa fa-tasks" aria-hidden="true"></i>Pending Task<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>-->
                                <li class="<?php if(!empty($tab)){ if($tab=='activies'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-activities'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Customers Activities<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                                <!--<li class="<?php if(!empty($tab)){ if($tab=='bfollowup'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('booking-follow-ups'); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>Booking Follow-ups<span class="NumLabel">new</span></a></li>-->
                                <li class="<?php if(!empty($tab)){ if($tab=='updatecustomer'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('customer-update'); ?>"><i class="fa fa-file-o" aria-hidden="true"></i>Update Customers<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                            </ul>
                        </div>
                        <?php if(in_array($this->session->userdata('company'), $array_inquiryAllowCompany)){ ?>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Customer Inquiries</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo site_url('new-customers-inquiries'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> New Inquiries <span class="NumLabel"><?php echo countTotal('inquiry',array('status'=>'1')) ?></span></a>
                                <li><a href="<?php echo site_url('followup'); ?>"><i class="fa fa-arrow-up"></i>Inquiry Follow Up <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo  countTotal('inquiry',array('status'=>'2'));  } else{  echo countTotal('inquiry',array('status'=>'2','picked_by'=>$this->session->userdata('userId'))); } ?></span></a>
                                <li><a href="<?php echo site_url('picked'); ?>"><i class="fa fa-truck" aria-hidden="true"></i> Day wise Summary <span class="NumLabel"><?php echo todayFollowUpDayWiseCount($this->session->userdata('userId')); ?></span></a>
                                <!--<li><a href="<?php echo site_url('Receival-Summary'); ?>"><i class="fa fa-truck" aria-hidden="true"></i> Receival Summary <span class="NumLabel"><?php echo receivalCount($this->session->userdata('userId'));  ?></span></a>-->
                                <li><a href="<?php echo site_url('NewFollowUP'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i>Create Follow-up <span class="NumLabel"><?php echo todayFollowUpCount($this->session->userdata('userId')) ?></span></a>
                                <!--<li><a href="<?php //echo site_url('closed'); ?>"><i class="fa fa-question-circle"></i>Closed Inquiries <span class="NumLabel">123</span></a>-->
                                <li><a href="<?php echo site_url('emailBackup'); ?>"><i class="fa fa-hdd-o" aria-hidden="true"></i>Email Backup <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo  countTotal('inquiry',array('status'=>'2'));  } else{  echo countTotal('inquiry',array('status'=>'2','picked_by'=>$this->session->userdata('userId'))); } ?></span></a>
                                <li><a href="<?php echo site_url('converstion'); ?>"><i class="fa fa-exchange"></i>Sale Conversion <span class="NumLabel"><?php echo bookingConversionCount($this->session->userdata('flag'),$this->session->userdata('userId')); ?></span></a>
                            </ul>
                        </div>
                        <?php } ?>
                        <div class="menu_section">
                            <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Reportings</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo site_url('GeneralReportBox'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i>General Reports<span class="NumLabel"><?php echo generalReportCount($this->session->userdata('userId')); ?></span></a></li>
                                <li><a href="<?php echo base_url('Home/index'); ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Progress Sheet<span class="NumLabel"><?php echo progressSheetCount($this->session->userdata('userId')); ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='attendance'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Attendance'); ?>"><i class="fa fa-calendar"></i>Attendence Sheet<span class="NumLabel">0</span></a></li>
                            </ul>
                        </div> 
                       <?php
                    }
                    ?>
                    </div>
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="display: none;">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <!-- <br> 
                                <h3>Attendance Panel</h3>
                                <br> -->
                                <h3 style="text-transform: capitalize;font-size: 20px;padding-top: 12px;">Booking Panel</h3>
                               
                                <?php if($this->session->userdata('flag')!=1){ ?>
                                <li class="<?php if(!empty($tab)){ if($tab==''){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Booking'); ?>"><i class="fa fa-ticket" aria-hidden="true"></i>New Booking <span class="NumLabel">new</span></a></li>
                                <?php } ?>
                                <li class="<?php if(!empty($tab)){ if($tab=='pending'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Pending'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>Pending Bookings <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'1')); } else{ echo countTotal('booking_details',array('flag'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='issued'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Issued'); ?>"><i class="fa fa-check" aria-hidden="true"></i>Issued Uncleared<span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('flag'=>'2','cleared_stat'=>'0')); } else{ echo countTotal('booking_details',array('flag'=>'2','booked_agent_id'=>$this->session->userdata('userId'),'cleared_stat'=>'0')); } ?></span></a></li>
                                <li class="<?php if(!empty($tab)){ if($tab=='cancel'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('Canceled'); ?>"><i class="fa fa-times" aria-hidden="true"></i>Cancelled Bookings <span class="NumLabel"><?php if($this->session->userdata('flag')==1){ echo countTotal('booking_details',array('canceled_stat'=>'1')); } else{ echo countTotal('booking_details',array('canceled_stat'=>'1','booked_agent_id'=>$this->session->userdata('userId'))); } ?></span></a></li>
                                 <?php if($this->session->userdata('flag')==1) { ?>
                                 <li><a href="<?php echo site_url('PendingTask'); ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Pending Tasks <span class="NumLabel"><?php echo countTotal('paymentRequest',array('isRead'=>0))+countTotal('ticketOrderRequest',array('isRead'=>0)); ?></span></a></li><?php } ?>
                                <li><a href="<?php echo site_url('SearchBox'); ?>"><i class="fa fa-search" aria-hidden="true"></i>Search Bookings <span class="NumLabel">new</span></a></li>
                                 <?php if($this->session->userdata('flag')==1){ ?>
                                <li class="<?php if(!empty($tab)){ if($tab=='cardBalance'){ echo "current-page"; } } ?>"><a href="<?php echo site_url('CardBoxBalance'); ?>"><i class="fa fa-money" aria-hidden="true"></i>Card Balance Status <span class="NumLabel">new</span></a></li> 
                                 <?php } ?>
                                <li class="<?php if(!empty($tab)){ if($tab=='reports'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('GeneralReportBox'); ?>"><i class="fa fa-file" aria-hidden="true"></i>General Reports <span class="NumLabel">new</span></a></li>
                                <?php if($this->session->userdata('flag')==1){ ?>
                                <li class="<?php if(!empty($tab)){ if($tab=='transection'){ echo "current-page"; } } ?>" ><a href="<?php echo site_url('TransectionBox'); ?>"><i class="fa fa-exchange" aria-hidden="true"></i>New Transaction<span class="NumLabel">new</span></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <form action="">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a> 
                                <!-- <label for="" style="width: 150px;margin-top: 8px;">Booking No. </label>
                                <input type="text" class="form-control">
                                <button class="btn btn-info">Go</button> -->
                            </form>
                        </div> 
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo base_url() ?>upload/<?php echo $comLog; ?>" alt=""><?php echo $this->session->userdata('loginName'); ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?php echo site_url('UserBox'); ?>">  Profile</a>
                                    </li>
                                    <li><a href="<?php echo base_url('Home/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out <span><?php echo $this->session->userdata('loginName'); ?></span></a>
                                    </li>
                                </ul>
                            </li>
<!--                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo LINK ?>images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo LINK ?>images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo LINK ?>images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo LINK ?>images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.html">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>-->

                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->