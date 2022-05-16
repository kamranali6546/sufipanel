<title>Receival Summary</title>
<style>
.input-group input {
    width: 100% !important;
}
    .main{
    	position: relative;
    	top: -15px;
    	left: 7px;
    }
    .panel-info:nth-child(n+1) {
        margin-top: -16px;
    }
    .panel-info:nth-child(1) {
        margin-top: 0px !important;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    background-color: #afacac !important;
    border: 1px solid transparent;
    border-bottom-color: transparent;
    cursor: default;
    color:#000;
}
.tabsul {
    padding:20px 30px ;
    list-style-type: none;
}
.tabsul li {
    font-size: 14px;
    margin-top: 10px 0px 10px 0px;

}
.nav .nav-tabs {
    background: #fff !important;
        border: 1px solid #ccc !important;
}

@media screen and (max-width: 425px) {
    body .container.body .right_col {
        padding: 10px 13px !important;
    }
}
</style> 
<!-- page content -->
<div class="right_col table-responsive" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>Statistics Of Customer Enquiries</h3>
        </div>
        <div class="title_right">
            <!--<a class="btn btn-primary btn-round pull-right" href="<?php echo site_url('NewFollowUP'); ?>">Create Follow Up</a>-->
        </div>
    </div>
    <div class="clearfix"></div>
    <form action="<?php echo site_url('Receival-Summary'); ?>" method="post">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label >From :</label>
                <div class="input-group"> 
                            <div class="inner-addon right-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                                <input type="text" class="form-control nextDueDate" readonly="" value="<?php if(!empty($fliterStart)){ echo $fliterStart; } else{ echo date('Y-m-d'); } ?>" name="startDate" > 
                            </div>
                        </div> 
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label>To :</label>
                <div class="input-group"> 
                            <div class="inner-addon right-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                                <input type="text" class="form-control nextDueDate" readonly="" value="<?php if(!empty($fliterEnd)){ echo $fliterEnd; } else{ echo date('Y-m-d'); } ?>" name="endDate" > 
                            </div>
                        </div> 
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
               <label>Dest :</label>
               <input type="text" name="dest" id="bookingDeparture" value="<?php if(!empty($fliterDest)){ echo $fliterDest; } ?>" class="form-control" placeholder="Dest">  
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label style="color:#fff;">.</label>
                <input type="submit" class="btn btn-primary" title="Submit" name="" style="margin-top: 23px;">
            </div>
        </div>
            </form>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <h4>Total Enquiries : <?php  echo $totalInquiry; ?></h4>
                </div>
            </div>
            <div class="row">
              <?php echo $output; ?>
            </div>
</div>
<!-- /page content -->
