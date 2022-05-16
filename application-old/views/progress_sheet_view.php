<title>Progress Sheet</title>
<style>
table.tablColor tbody tr td a {
    color: #009fff !important;
    text-decoration: none !important; 
    
    font-weight: bold !important;
}
table.tablColor tbody tr td a:hover {
    color: #009fff !important;
    text-decoration: underline !important; 
    font-weight: bold !important;
} 
    table.display tbody tr td{
        border-left: 0px !important;
        border-right: 0px !important;
            border-bottom: 1px solid #ebebeb;

        padding:0px  5px;
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
    .tabe-progress tbody tr:nth-child(odd) {
        background-color: #fff;
    }
    .tabe-progress tbody tr:nth-child(even) {
        background-color: #f7f7f7 !important;
        height: 40px !important;
    }
    .left-addon .glyphicon  { left:  0px;}
    .right-addon .glyphicon { right: 0px;} 
    .left-addon input  { padding-left:  30px; }
    .right-addon input { padding-right: 30px; cursor: pointer !important; } 
    .vertical-align-bottom { vertical-align: bottom !important; }
    .input-group {margin-bottom: 0px;}
    .input-group input { width: 135px !important; }
</style>
<?php
$getReportsart=$fliterYear.'-'.$fliterMonth.'-01';
$lastDay= date("t", strtotime($getReportsart));
$getReportEndDate=$fliterYear.'-'.$fliterMonth.'-'.$lastDay;

?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>Progress Sheet</h3>
        </div>
        <!-- <div class="title_right">
            <a class="btn btn-primary pull-right" href="<?php // echo site_url('Newuser'); ?>">Add New Agent</a>
        </div> -->
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="<?php echo base_url('Home/index'); ?>" method="post" class="form-inline formarea">
<!--                 <label for="">Month:</label>
                <div class="input-group"> 
                    <div class="inner-addon right-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input type="text" class="form-control" id="progressDateFliter"> 
                    </div>
                </div>   -->
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                        <select name="month" class="form-control" style="width: 100%;">
                            <option value="01" <?php if(!empty($fliterMonth) && $fliterMonth==01){ ?> selected="selected" <?php } ?> >Jan</option>
                            <option value="02" <?php if(!empty($fliterMonth) && $fliterMonth==02){ ?> selected="selected" <?php } ?> >Feb</option>
                            <option value="03" <?php if(!empty($fliterMonth) && $fliterMonth==03){ ?> selected="selected" <?php } ?>>Mar</option>
                            <option value="04" <?php if(!empty($fliterMonth) && $fliterMonth==04){ ?> selected="selected" <?php } ?>>Apr</option>
                            <option value="05" <?php if(!empty($fliterMonth) && $fliterMonth==05){ ?> selected="selected" <?php } ?> >May</option>
                            <option value="06" <?php if(!empty($fliterMonth) && $fliterMonth==06){ ?> selected="selected" <?php } ?> >Jun</option>
                            <option value="07" <?php if(!empty($fliterMonth) && $fliterMonth==07){ ?> selected="selected" <?php } ?> >Jul</option>
                            <option value="08" <?php if(!empty($fliterMonth) && $fliterMonth==08){ ?> selected="selected" <?php } ?> >Aug</option>
                            <option value="09" <?php if(!empty($fliterMonth) && $fliterMonth==09){ ?> selected="selected" <?php } ?> >Sep</option>
                            <option value="10" <?php if(!empty($fliterMonth) && $fliterMonth==10){ ?> selected="selected" <?php } ?> >Oct</option>
                            <option value="11" <?php if(!empty($fliterMonth) && $fliterMonth==11){ ?> selected="selected" <?php } ?> >Nov</option>
                            <option value="12" <?php if(!empty($fliterMonth) && $fliterMonth==12){ ?> selected="selected" <?php } ?>>Dec</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                        <select name="year" class="form-control" style="width: 100%;">
                            <option value="2017" <?php if(!empty($fliterYear) && $fliterYear==2017){ ?> selected="selected" <?php } ?> >2017</option>
                            <option value="2018" <?php if(!empty($fliterYear) && $fliterYear==2018){ ?> selected="selected" <?php } ?>>2018</option>
                            <option value="2019" <?php if(!empty($fliterYear) && $fliterYear==2019){ ?> selected="selected" <?php } ?>>2019</option>
                            <option value="2020" <?php if(!empty($fliterYear) && $fliterYear==2020){ ?> selected="selected" <?php } ?>>2020</option>
                            <option value="2021" <?php if(!empty($fliterYear) && $fliterYear==2021){ ?> selected="selected" <?php } ?>>2021</option>
                            <option value="2022" <?php if(!empty($fliterYear) && $fliterYear==2022){ ?> selected="selected" <?php } ?>>2022</option>
                            <option value="2023" <?php if(!empty($fliterYear) && $fliterYear==2023){ ?> selected="selected" <?php } ?>>2023</option>
                            <option value="2024" <?php if(!empty($fliterYear) && $fliterYear==2024){ ?> selected="selected" <?php } ?>>2024</option>
                            <option value="2025" <?php if(!empty($fliterYear) && $fliterYear==2025){ ?> selected="selected" <?php } ?>>2025</option>
                            <option value="2026" <?php if(!empty($fliterYear) && $fliterYear==2026){ ?> selected="selected" <?php } ?>>2026</option>
                            <option value="2027" <?php if(!empty($fliterYear) && $fliterYear==2027){ ?> selected="selected" <?php } ?>>2027</option>
                            <option value="2028" <?php if(!empty($fliterYear) && $fliterYear==2028){ ?> selected="selected" <?php } ?>>2028</option>
                            <option value="2029" <?php if(!empty($fliterYear) && $fliterYear==2029){ ?> selected="selected" <?php } ?>>2029</option>
                            <option value="2030" <?php if(!empty($fliterYear) && $fliterYear==2030){ ?> selected="selected" <?php } ?>>2030</option>
                            <option value="2031" <?php if(!empty($fliterYear) && $fliterYear==2031){ ?> selected="selected" <?php } ?>>2031</option>
                            <option value="2032" <?php if(!empty($fliterYear) && $fliterYear==2032){ ?> selected="selected" <?php } ?>>2032</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <select name="brand" class="form-control" style="width: 100%;">
                            <option value="">All Brands</option>
                            <?php
                            if(!empty($copany))
                            {
                                foreach($copany as $cObj)
                                {
                                    ?>
                            <option <?php if(!empty($brandFliter) && $cObj->id==$brandFliter){ ?> selected="selected" <?php } ?> value="<?php echo $cObj->id; ?>"><?php echo $cObj->company_name; ?></option>
                                    <?php 
                                }
                            }
                            ?>
                        </select>  
                    </div>  
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                        <button type="submit" class="btn btn-primary btnmargin-mob">Submit</button> 
                    </div>
                    
                    
                </div>     
            </form>
        </div>
        
    </div><br>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table id="" class="display nowrap tablColor table-hover tabe-progress" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                        <th class="text-center">Progress Rank</th>
                        <th class="text-center">Agent Name</th>
                        <th class="text-center">Total Pending Bookings</th>
                        <th class="text-center">Todays Bookings</th> 
                        <th class="text-center" style="min-width: 100px;">New Booking in <?php echo date("M", mktime(null, null, null, $fliterMonth)).'-'.$fliterYear; ?></th>
                        <th class="text-center">Issued Booking in <?php echo date("M", mktime(null, null, null, $fliterMonth)).'-'.$fliterYear; ?></th>
                        <th class="text-center">Cancelled Booking in <?php echo date("M", mktime(null, null, null, $fliterMonth)).'-'.$fliterYear; ?></th>
                        <th class="text-center">Issuance Profit in <?php echo date("M", mktime(null, null, null, $fliterMonth)).'-'.$fliterYear; ?> (&pound;)</th>
                        <th class="text-center">Cancellation Profit in <?php echo date("M", mktime(null, null, null, $fliterMonth)).'-'.$fliterYear; ?> (&pound;)</th>
                        <th style="    min-width: 190px;" class="text-center">Total Profit in <?php echo date("M", mktime(null, null, null, $fliterMonth)).'-'.$fliterYear; ?> (&pound;)</th>
                        <th class="text-center">Average Profit in <?php echo date("M", mktime(null, null, null, $fliterMonth)).'-'.$fliterYear; ?> (&pound;)</th> 
                    </tr>
                </thead> 
                <tbody>
                    <?php 
//                    echo "<pre>";
//                    print_r($agentData);
//                    echo "</pre>";
                   $sortData=array();
                    $ser=1;
                    $totalPendingBooking=0;
                    $totalTodayBooking=0;
                    $newBooking=0;
                    $totalNewBooking=0;
                    $totalIssued=0;
                    $cancelBookingTotal=0;
                    $totalIssuedProfit=0;
                    $totalAgentBookingTarget=0;
                    $totalAgentSalesTarget=0;
                    $totalCanceledBookingProfit=0;
                    $allAgentProfit=0;
                    $allagentsAverage=0;
                    foreach($agentData as $key=> $obj){
                        
                        $agentNetProfit=0;
                        $agentNetProfitPercantage=0;
                        $pendingBooking=$obj['pendingBooking'];
                        $issuedBooking=$obj['issuedBooking'];
                        $todayBookingCount=$obj['todayBooking'];
                        $cancelBookingCount=$obj['cancelBooking'];
                        $canceledBookingProfit=$obj['canceledBookingProfit'];
                        $newBooking=$obj['currentMonthBooking'];
                        $totalNewBooking=$totalNewBooking+$newBooking;
                        $issuedProfit=0;
                        $agentBookingTarget=0;
                        $agentBookingTarget=idToName('admin','id',$key,'sales_target');
                        $agentSalesTarget=idToName('admin','id',$key,'profitTarget');
                        $totalAgentBookingTarget=$totalAgentBookingTarget+$agentBookingTarget;
                        $totalAgentSalesTarget=$totalAgentSalesTarget+$agentSalesTarget;
                        $totalCanceledBookingProfit=$totalCanceledBookingProfit+$canceledBookingProfit;
                        foreach($obj as $innerObj)
                        {
                            $ticketCost=0;
                            $salePrice=0;
                            $profit=0;
                            if($innerObj->flag==2)
                            {
                               $ticketCost=(ticketCost($innerObj->id)+ticketCharges($innerObj->id)+ticketChargesAditional($innerObj->id));
                               $salePrice=salePrice($innerObj->id);
                               $profit=$salePrice-$ticketCost;
                               $issuedProfit=$issuedProfit+$profit;
                               
                            }
                        }
                        $totalPendingBooking=$totalPendingBooking+$pendingBooking;
                        $totalTodayBooking=$totalTodayBooking+$todayBookingCount;
                        $totalIssued=$totalIssued+$issuedBooking;
                        $cancelBookingTotal=$cancelBookingTotal+$cancelBookingCount;
                        $totalIssuedProfit=$totalIssuedProfit+$issuedProfit;
                        $agentNetProfit=$issuedProfit+$canceledBookingProfit;
                        $allAgentProfit=$allAgentProfit+$agentNetProfit;
                        $profitAverage=round($agentNetProfit/( $issuedBooking+$cancelBookingCount),2);
                        
                        $agentNetProfitPercantage=round($agentNetProfit / $agentSalesTarget,2);
                        $allagentsAverage=$allagentsAverage+$profitAverage;
//                         echo "<pre>";
//                    print_r($obj);
//                    echo "</pre>";
                    ?>
                    <tr>
                        <td style="" width="7%" height="20" align="center"><?php echo $ser; ?></td>
                        <td style="" width="10%" align="left"> 
                                <a target="_blank"  href="<?php echo site_url('agent-progress-graphs/'.$key); ?>" > <?php echo idToName('admin','id',$key,'login_name'); //echo $obj->login_name; ?>  </a>
                                <!--<a target="_blank" href="agent-progress-graphs.php?agent=James"> <?php //echo $obj->login_name; ?>  </a>-->
                        </td>
                        <td width="7%" align="center" style="">
                            <a href="<?php echo site_url('pending-bookings/'.idencode($key)) ?>"  target="_blank" style="font-size:18px; font-weight:bold;"><?php echo $pendingBooking; ?></a> 
                        </td>
                        <td width="7%" align="center" bgcolor="#FFFFAE" style=""><?php echo $todayBookingCount; ?></td>
                        <td width="11%" align="center" style="">
                            <div style="font-size:18px; font-weight:bold; float:left">
                                <?php echo $newBooking; ?><span style="font-size:10px; color:#999;">/ <?php echo $agentBookingTarget; ?></span>
                            </div>  
                            <div id="container<?php echo $key; ?>" style="margin: 0px 0px 0px 5px; width: 40px; height: 13px; float: right; position: relative;">
<!--                                <svg viewBox="0 0 100 50">
                                    <path d="M 50,50 m -45,0 a 45,45 0 1 1 90,0" stroke="#000" stroke-width="1" fill-opacity="0"></path>
                                    <path d="M 50,50 m -45,0 a 45,45 0 1 1 90,0" stroke="rgb(254,0,0)" stroke-width="10" fill-opacity="0" style="stroke-dasharray: 141.392, 141.392; stroke-dashoffset: 135.736;"></path>
                                </svg>
                                <div class="progressbar-text" style="position: absolute; left: 50%; top: auto; padding: 0px; margin: 0px; transform: translate(-50%, 50%); color: rgb(254, 0, 0); bottom: 0px; font-family: Raleway, Helvetica, sans-serif; font-size: 10px;">
                                    4%
                                </div>-->
                                <?php $percentageOfBookingTarget=round($newBooking / $agentBookingTarget,2); ?>
                                 <script language="javascript" type="text/javascript">
                                    $(function() {
                                                var bar = new ProgressBar.SemiCircle(container<?php echo $key ?>, {
                                        strokeWidth: 10,
                                        easing: 'easeInOut',
                                        duration: 1400,
                                        color: '#FFEA82',
                                        trailColor: '#000',
                                        trailWidth: 1,
                                        svgStyle: null,
                                        text: {
                                        value: '',
                                        alignToBottom: false
                                        },
                                        from: {color: '#ff0000'},
                                        to: {color: '#00ff00'},
                                        // Set default step function for all animate calls
                                        step: function(state, bar) {
                                        bar.path.setAttribute('stroke', state.color);
                                        var value = Math.round(bar.value() * 100);
                                        if (value === 0) {
                                          bar.setText('0%');
                                        } else {
                                           bar.setText(value + '%');
                                        }

                                        bar.text.style.color = state.color;
                                        }
                                        });
                                        bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
                                        bar.text.style.fontSize = '10px'; 
                                        bar.animate(<?php echo $percentageOfBookingTarget; ?>);  // Number from 0.0 to 1.0
                                                });
                                </script>  
                            </div>
                        </td>
                        <td width="7%" align="center" style="border-bottom: thin solid #EBEBEB;"><?php echo $issuedBooking; ?></td>
                        <td style="border-bottom: thin solid #EBEBEB;" align="center"><?php echo $cancelBookingCount; ?></td>
                        <td style="border-bottom: thin solid #EBEBEB;" align="center"><?php echo $issuedProfit; ?></td>
                        <td style="border-bottom: thin solid #EBEBEB;" align="center"><?php echo $canceledBookingProfit; ?></td>
                        <td style="border-bottom: thin solid #EBEBEB;" align="center"> 
                            <div style="float:left;">
                                <a target="_blank" href="javascript:requestToGetEarnedProfit('<?php echo idencode($key) ?>');" style="font-size:18px; font-weight:bold;"> <?php echo $agentNetProfit; ?></a> 
                              <span style="font-size:10px; color:#999;">/ <?php echo $agentSalesTarget; ?></span>
                            </div> 
                            <div id="containerNet<?php echo $key; ?>" style="margin: 0px 0px 0px 5px; width: 40px; height: 13px; float: right; position: relative;">
                            <script language="javascript" type="text/javascript">
                            $(function() {
                                   var bar = new ProgressBar.SemiCircle(containerNet<?php echo $key ?>, {
                                strokeWidth: 10,
                                easing: 'easeInOut',
                                duration: 1400,
                                color: '#FFEA82',
                                trailColor: '#000',
                                trailWidth: 1,
                                svgStyle: null,
                                text: {
                                value: '',
                                alignToBottom: false
                                },
                                from: {color: '#ff0000'},
                                to: {color: '#00ff00'},
                                // Set default step function for all animate calls
                                step: function(state, bar) {
                                bar.path.setAttribute('stroke', state.color);
                                var value = Math.round(bar.value() * 100);
                                if (value === 0) {
                                  bar.setText('0%');
                                } else {
                                  bar.setText(value + '%');
                                }
                                
                                bar.text.style.color = state.color;
                                }
                                });
                                bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
                                bar.text.style.fontSize = '10px'; 
                                bar.animate(<?php echo $agentNetProfitPercantage ?>);  // Number from 0.0 to 1.0
                                        });
                            </script> 
                            </div>
                            <div style="float:left; margin-left:5px;"></div> 
                        </td>
                        <td align="center" style="border-bottom: thin solid #EBEBEB;"><?php echo $profitAverage; ?></td>
                    </tr>
                    <?php $ser++; } ?>
<!--                    <tr>
                        <td style="border-bottom: thin solid #EBEBEB;" width="7%" height="20" align="center">1</td>
                        <td style="border-bottom: thin solid #EBEBEB;" width="10%" align="left"> 
                                <a target="_blank" href="agent-progress-graphs.php?agent=James"> James  </a> </td>
                        <td width="7%" align="center" style="border-bottom: thin solid #EBEBEB;">
                            <a href="javascript:report('pending-bookings','James');" style="font-size:18px; font-weight:bold;">3</a> 
                        </td>
                        <td width="7%" align="center" bgcolor="#FFFFAE" style="border-bottom: thin solid #EBEBEB;">0</td>
                        <td width="11%" align="center" style="border-bottom: thin solid #EBEBEB;"><div style="font-size:18px; font-weight:bold; float:left">1 <span style="font-size:10px; color:#999;">/ 25</span></div>  
                          <div id="container1" style="margin: 0px 0px 0px 5px; width: 40px; height: 13px; float: left; position: relative;"><svg viewBox="0 0 100 50"><path d="M 50,50 m -45,0 a 45,45 0 1 1 90,0" stroke="#000" stroke-width="1" fill-opacity="0"></path><path d="M 50,50 m -45,0 a 45,45 0 1 1 90,0" stroke="rgb(254,0,0)" stroke-width="10" fill-opacity="0" style="stroke-dasharray: 141.392, 141.392; stroke-dashoffset: 135.736;"></path></svg><div class="progressbar-text" style="position: absolute; left: 50%; top: auto; padding: 0px; margin: 0px; transform: translate(-50%, 50%); color: rgb(254, 0, 0); bottom: 0px; font-family: Raleway, Helvetica, sans-serif; font-size: 10px;">4%</div></div>
                             <script language="javascript" type="text/javascript">
                            $(function() {
                                        var bar = new ProgressBar.SemiCircle(container1, {
                                strokeWidth: 10,
                                easing: 'easeInOut',
                                duration: 1400,
                                color: '#FFEA82',
                                trailColor: '#000',
                                trailWidth: 1,
                                svgStyle: null,
                                text: {
                                value: '',
                                alignToBottom: false
                                },
                                from: {color: '#ff0000'},
                                to: {color: '#00ff00'},
                                // Set default step function for all animate calls
                                step: function(state, bar) {
                                bar.path.setAttribute('stroke', state.color);
                                var value = Math.round(bar.value() * 100);
                                if (value === 0) {
                                  bar.setText('0%');
                                } else {
                                   bar.setText(value + '%');
                                }
                                
                                bar.text.style.color = state.color;
                                }
                                });
                                bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
                                bar.text.style.fontSize = '10px'; 
                                bar.animate(0.04);  // Number from 0.0 to 1.0
                                        });
                            </script>  
                        </td>
                        <td width="7%" align="center" style="border-bottom: thin solid #EBEBEB;">2</td>
                        <td style="border-bottom: thin solid #EBEBEB;" align="center">0</td>
                        <td style="border-bottom: thin solid #EBEBEB;" align="center">197.66</td>
                        <td style="border-bottom: thin solid #EBEBEB;" align="center">0</td>
                        <td style="border-bottom: thin solid #EBEBEB;" align="center"> 
                        <div style="float:left;">
                                <a href="javascript:report('profit-earned','James');" style="font-size:18px; font-weight:bold;"> 197.66</a> 
                          <span style="font-size:10px; color:#999;">/ 2500</span>
                        </div> 
                        <div id="container21" style="margin: 0px 0px 0px 5px; width: 40px; height: 13px; float: left; position: relative;"><svg viewBox="0 0 100 50"><path d="M 50,50 m -45,0 a 45,45 0 1 1 90,0" stroke="#000" stroke-width="1" fill-opacity="0"></path><path d="M 50,50 m -45,0 a 45,45 0 1 1 90,0" stroke="rgb(254,0,0)" stroke-width="10" fill-opacity="0" style="stroke-dasharray: 141.392, 141.392; stroke-dashoffset: 130.213;"></path></svg><div class="progressbar-text" style="position: absolute; left: 50%; top: auto; padding: 0px; margin: 0px; transform: translate(-50%, 50%); color: rgb(254, 0, 0); bottom: 0px; font-family: Raleway, Helvetica, sans-serif; font-size: 10px;">8%</div></div>
                             <script language="javascript" type="text/javascript">
                            $(function() {
                                        var bar = new ProgressBar.SemiCircle(container21, {
                                strokeWidth: 10,
                                easing: 'easeInOut',
                                duration: 1400,
                                color: '#FFEA82',
                                trailColor: '#000',
                                trailWidth: 1,
                                svgStyle: null,
                                text: {
                                value: '',
                                alignToBottom: false
                                },
                                from: {color: '#ff0000'},
                                to: {color: '#00ff00'},
                                // Set default step function for all animate calls
                                step: function(state, bar) {
                                bar.path.setAttribute('stroke', state.color);
                                var value = Math.round(bar.value() * 100);
                                if (value === 0) {
                                  bar.setText('0%');
                                } else {
                                  bar.setText(value + '%');
                                }
                                
                                bar.text.style.color = state.color;
                                }
                                });
                                bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
                                bar.text.style.fontSize = '10px'; 
                                bar.animate(0.079064);  // Number from 0.0 to 1.0
                                        });
                            </script> 
                        
                        <div style="float:left; margin-left:5px;"> 
                        </div> 
                        </td>
                        <td align="center" style="border-bottom: thin solid #EBEBEB;">98.83</td>
                    </tr>-->
                </tbody>
                <tfoot>
                    <tr>
                        <td align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;">&nbsp;</td>
                        <td align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;">&nbsp;</td>
                        <td align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;"><?php echo $totalPendingBooking; ?></td>
                        <td align="center" bgcolor="#FFFFAE" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;"><span style="border-bottom: thin solid #EBEBEB;"><?php echo $totalTodayBooking; ?></span></td>
                        <td align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;"><?php echo $totalNewBooking; ?> <span style="font-size:10px; color:#999;">/ <?php echo $totalAgentBookingTarget; ?> </span></td>
                        <td align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;"><?php echo $totalIssued; ?></td>
                        <td align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;"><?php echo $cancelBookingTotal; ?></td>
                        <td align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;"><?php echo $totalIssuedProfit; ?></td>
                        <td align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;"><?php echo $totalCanceledBookingProfit; ?></td>
                        <td align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;">
                            <!--<a href="javascript:report('net-profit-earned','All');" style="font-size:18px; font-weight:bold;">-->
                          <a target="_blank" href="javascript:requestToGetEarnedProfit('s');" style="font-size:18px; font-weight:bold;"> <?php echo $allAgentProfit; ?>
                           </a>
                            <span style="font-size:10px; color:#999;">/ <?php echo $totalAgentSalesTarget; ?></span></td>
                        <td height="30" align="center" style="font-weight: bold; border-bottom: 2px solid #EBEBEB;"><?php echo $allagentsAverage; ?></td>
                        </tr>
                </tfoot>
            </table>
        </div>
    </div>               
</div>
<!-- /page content -->

<form method="post" target="_blank" action="<?php echo base_url('report-gross-profit-earned') ?>" id="getAgentReport">
    <input type="hidden" value="<?php echo $getReportsart; ?>" name="reportStartDate" id="reportStartDate">
    <input type="hidden" value="<?php echo $getReportEndDate; ?>" name="endDate" id="reportEndDate">
    <input type="hidden" id="brandForReport"  name="brandForReport" value="">
    <input type="hidden" id="supplierForReport" name="supplierForReport" value="">
    <input type="hidden" id="agentForReport" name="agentForReport" >
</form>
<script>
function requestToGetEarnedProfit(agentId)
{
    //alert(agentId);
   var removesS=agentId.split('s');
   var decodeedval=atob(removesS[0]);
   $('#agentForReport').val(decodeedval);
    $('#getAgentReport').submit();
}
</script>