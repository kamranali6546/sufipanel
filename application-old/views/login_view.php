<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
	<title>Travel Agency Invoicing</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo LINK ?>css/bootstrap.min.css" rel="stylesheet"> 
    <script src="<?php echo LINK ?>js/jquery.min.js"></script>
    <script src="<?php echo LINK ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo LINK ?>js/bootstrap.min.js"></script>
    <style>
    .main {
    	/*background: #5c19e0;
	  	background: -webkit-linear-gradient(left, #5c19e0 , #505002);
	  	background: -o-linear-gradient(right, #5c19e0, #505002); 
	  	background: -moz-linear-gradient(right, #5c19e0, #505002); 
	  	background: linear-gradient(to right, #5c19e0 , #505002); */
	    position: absolute;
	    top: 0;
	    bottom: 0;
	    right: 0;
	    left: 0;
	    height: 100%; 
    }  
    .left {

    	text-align: center;
    	margin-top: 15%;
    }
    h2, h3, h4, h5, h6, label {
    	color: black;
    }
    .left img {
    	width: 250px;
    	margin-bottom: 20px;
    }

    .right {
    	border-left: 1px solid #717065;
    }
    .right p {
    	color: black;
    }
    .right .AYD {
		color: #2af32a;
		text-decoration: underline;
    }
    .right input {
    	height: 50px !important;
    	border-radius: 0px !important;
    } 
    .right button {
    	height: 50px;
    	border-radius: 0px;
    	background: #379537;
    	border: 0px;
    	color: white;
    }
    .list-inline li, .list-inline li i {
        color: black !important
    }
    .m-0 {
    	margin: 0px;
    }
    .timeStyle {
	    font-size: 18px !important;
	    color: chartreuse !important;
	    font-weight: bold !important;
	}
 
	</style>
        <script>
        function checkoutTime3() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var month=today.getMonth();
    var d= today.getDate();
    var  year = today.getFullYear();
   var  monthsArray = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    m = checkTime3(m);
    s = checkTime3(s);
    document.getElementById('timerDis').innerHTML ='&nbsp;&nbsp;<span class="timeStyle">'+ h + ":" + m + ":" + s+'</span>';
    var t = setTimeout(checkoutTime3, 500);
}
function checkTime3(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
        </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 main"> 
        	<div class="row">
        		<div class="col-lg-4 left">
        			<img src="<?php echo LINK ?>images/sufiLogo.jpg">
        			<h2 class="text-center">Agents Panel</h2>
        			<h4 class="text-center">Sufi Travels and tours Ltd. | All right reversed</h4>
        		</div>
        		<div class="col-lg-8 right" style="background: white;">
        			<div class="row">
                                     <?php
//                                     echo "<pre>";
//                                     print_r($weather);
//                                    $main= $weather['weather'][0]['main'];
                                     if(!empty($weather)){
                                    $main= $weather['weather'][0]['description'];
                                    $temparture= $weather['main']['temp'];
                                    $mintemparture=$weather['main']['temp_min'];
                                    $maxtemparture=$weather['main']['temp_max'];
                                    $icone=$weather['weather'][0]['icon'];
                                    $name=$weather['name'];
                                     }
                                     ?>
        				<div class="col-lg-12">
        					<p class="text-center" style="margin-top: 25px;">In the name of ALLAH, the most Beneficient & the most Merciful.</p>
        					<h4 class="AYD">Ayat of the Day.</h4>
        					<P>Chapter AL-ANFAL (SPOILS OF WAR). Verse 27</P>
        					<p>ﭥ ﭦ ﭧ ﭨ ﭩ ﭪ ﭫ ﭬ ﭭ ﭮ ﭯ ﭰ</p>
        					<p>Believers. do not betray ALLAH and the Messenger. nor knowingly betray your trust.</p>
           				</div>
        			</div><br>
        			<div class="row"> 
                        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">    
        				<div class="col-lg-4 col-xs-12"> 
                            <div class="row">
                                <div class="col-lg-2 col-xs-3 text-right">
                                    <h1 style="margin-top: 0px;"><span class="badge badge-secondary" style="font-size: 24px;"><?php echo date('d'); ?></span></h1>
                                    <h3 style="margin-top: 5px;"><?php echo date('M'); ?></h3>
                                </div>
                                <div class="col-lg-10 col-xs-9">
                                    <ul class="list-inline" style="margin-left: 10px;"><br>
                                        <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo date('D'); ?></li><br>
                                        <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i><span id="timerDis"><script>window.load=checkoutTime3()</script></span></li> 
                                    </ul>
                                     
                                </div>
                            </div>  
        				</div>
        				<div class="col-lg-2 col-xs-6">
                                            <img style="height: 150px;" src="<?php echo LINK ?>images/<?php echo $icone; ?>.png">
        				</div>
        				<div class="col-lg-3 col-xs-6">
        					<h3 style="margin-top: 0px;"><?php echo $name; ?></h3>
        					<H5 class="m-0">United Kingdom</h5>
                                                <h2 class="m-0"><?php echo $temparture; ?>&deg;C</h2>
        					<h5 class="m-0"><?php echo $main; ?></h5>
        					<p class="m-0">High: <?php echo $maxtemparture; ?>&deg;C &nbsp;&nbsp; Low:<?php echo $mintemparture; ?>&deg;C</p>
        				</div>
        			</div> 
        			<div class="row ">
        				<div class="col-lg-12">
        					<h4 class="AYD">Welcome to your account!</h4>
        				</div>
        			</div>
        			<div class="row ">
        				<div class="col-lg-12">
        					<form id="login-form" class="col-lg-12" action="<?php echo site_url('Login/login'); ?>" method="post">
								<div class="form-group">
									<div class="row ">
										<div class="col-lg-5" style="padding-left: 0px;">
											<label for="userName">Username:</label>
                                                                                        <input type="text" name="userName" class="form-control"  id="userName" required=""> <br>
                                                                                        <label for="password">Password:</label>
                                                                                        <input type="password" name="password" class="form-control" id="password" required>
                                                                                        <label>&nbsp;</label>
                                                                                        <button type="submit" class="btn btn-default pull-right" style="margin-top: 6px;">Login</button>
										</div>  
<!--										<div class="col-lg-12">
											
										</div>-->
									</div>
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
											<?php if(!empty($loginError)){ ?>
                                                                                        <div class="alert alert-danger alert-dismissable fade in">
                                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                                            <strong style="color: white;"><?php echo $loginError; ?></strong>
                                                                                        </div>
                                                                                        <?php } ?>
                                                                        </div>
                                                                    </div>
								</div>
							</form>
        				</div>
        			</div>
        		</div>
        	</div>
        </div> 
    </div>
</div>
<!-- Kapsayıcı -->
<!-- <div class="container" >
    <div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12  login-card"> 
		    <form id="login-form" class="col-lg-12" action="<?php echo site_url('Login/login'); ?>" method="post">
		        <div class="col-lg-12 logo-kapsul">
		            <img width="100" class="logo" src="https://selimdoyranli.com/cdn/material-form/img/logo.png" alt="Logo" />
		        </div> 
		        <div style="clear:both;"></div> 
		        <div class="group">
		            <input type="text" name="userName" required>
		            <span class="highlight"></span>
		            <span class="bar"></span>
		            <label><i class="material-icons input-ikon">person_outline</i><span class="span-input">User Name</span></label>
		        </div> 
		        <div class="group">
		            <input type="password" name="password" required>
		            <span class="highlight"></span>
		            <span class="bar"></span>
		            <label><i class="material-icons input-sifre-ikon">lock</i><span class="span-input">Password</span></label>
		        </div> 
		        <button type="submit"  class="btn btn-lg pull-right giris-yap-buton">Login</button>
		    </form>
		</div> 
    </div>
</div> -->
<script>
$(document).ready(function(){
$(document).ready(function(){
$("#kayit-form").hide();
$("#sifre-hatirlat-form").hide();	
$(".hesap-olustur-link").click(function(e){
$("#login-form").slideUp(0);	
$("#kayit-form").fadeIn(300);	
});
$(".zaten-hesap-var-link").click(function(e){
$("#kayit-form").slideUp(0);
$("#sifre-hatirlat-form").slideUp(0);	
$("#login-form").fadeIn(300);	 
});
$(".sifre-hatirlat-link").click(function(e){
$("#login-form").slideUp(0);	
$("#sifre-hatirlat-form").fadeIn(300);	
});
}); 
});
</script>
</body>
</html>