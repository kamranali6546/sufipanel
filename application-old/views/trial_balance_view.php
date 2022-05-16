<title>UK Trial Balance</title>
<!-- Internal Css of Page -->
<style>
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}
    table.display tbody tr td, table.display tfoot tr td{
        /*border: 1px solid #b7b7b7;*/
        padding: 5px;
    }
    table.display tfoot tr td {
        color: black;
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
    .input-group input { width: 100% !important; }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-9">
             <div class="page-title">
        <div class="title_left">
          <h3>UK Trial Balance &nbsp; <span style="font-size: 14px;color: gray;">As On:<?php if(!empty($fDate)){ echo date('d-M-Y',strtotime($fDate)); } else{ echo date('d-M-Y'); } ?></span></h3>
        </div>
        <div class="title_right">
           
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="<?php echo site_url('trial-balance');  ?>" method="post" class="form-inline">
                <label for="">Opening Date:</label>
                <div class="input-group"> 
                    <div class="inner-addon right-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input type="text" readonly="" name="dateFliter" <?php if(!empty($fDate)){ ?> value="<?php echo date('d-M-Y',strtotime($fDate)); ?>" <?php } else{ ?> value="<?php echo date('d-M-Y'); ?>" <?php } ?> class="form-control" id="Odate"> 
                    </div>
                </div>   
                <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 7px;margin-left: 10px;">Submit</button> 
            </form>
        </div>
    </div> 
    <div class="clearfix"></div><br>
        </div>
        <div class="col-md-3">
            <table class="table table-bordered" style="position: relative;top:20px;">
                <thead class="text-center">
                    <tr >
                        <th class="text-center">Debit</th>
                        <th class="text-center">Credit</th>
                    </tr>
                </thead>
                <tbody class="text-center"> 
                    <tr>
                        <td style="background: #cdff00;"><b>Assets</b></td>
                        <td style="background: #ffcc33;"><b>Liabilities</b></td>
                    </tr>
                    <tr>
                        <td style="background: #ff6632;"><b>Expenses</b></td>
                        <td style="background: #99ffff;"><b>Income</b></td>
                    </tr>
                    <tr>
                        <td style="background: #646061;"></td>
                        <td style="background: #ff334b;"><b>Equity/Capitals</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
   
    <br>
    <div class="row" style="display: none !important;">
        <div class="col-md-12 table-responsive">
            <table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr> 
                        <th>Sr No.</th>
                        <th class="text-left">Head</th> 
                        <th class="text-center">Debit (&pound;)</th>
                        <th class="text-center">Credit (&pound;)</th>  
                    </tr>
                </thead>
                <tbody> 
                    <?php $drTotal=0;$crTotal=0; if(!empty($trialBalance)){ $sr=1; foreach($trialBalance as $obj){ ?>
                    <tr>
                        <td><?php echo $sr; ?></td>
                        <td class="text-left"><?php echo $obj->pay_to; ?></td>
                        <td class="text-center"><?php if($obj->pay_type=='Dr'){ $drTotal=$drTotal+$obj->amount; echo $obj->amount; } else{ echo "-"; } ?></td>
                        <td class="text-center"><?php if($obj->pay_type=='Cr'){ $crTotal=$crTotal+$obj->amount; echo $obj->amount; } else{ echo "-"; } ?></td>
                    </tr> 
                    <?php $sr++; } } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td class="text-left text-red"><b>Total</b></td>
                        <td class="text-center text-red"><b><?php echo $drTotal; ?></b></td>
                        <td class="text-center text-red"><b><?php echo $crTotal; ?></b></td> 
                    </tr>
                </tfoot>
            </table>
        </div>
    </div> 
    <br><br><br><br>
    <div class="row">
        <div class="col-md-12">
            <table class="display nowrap tablColor dataTable">
                <thead>
                    <tr>
                        <th colspan="7">TRIAL BALANCE AS ON : <?php if(!empty($fDate)){ echo date('d-M-Y',strtotime($fDate)); } else{ echo date('d-M-Y'); } ?></th>
                    </tr>
                    <tr class="text-red">
                        <th>Account Type</th>
                        <th>Total</th>
                        <th>Sr No</th>
                        <th>heads of Particulars</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Detailed Account Types</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //echo "<pre>"; print_r($newTrialBalance); echo "</pre>";
                    if(!empty($newTrialBalance))
                    {
                        foreach($newTrialBalance as $keyT => $objT)
                        {
                            $trSpan=count($objT);
                            ?>
                            <?php if(!empty($objT))
                            { $sr=1; 
                            foreach($objT as $innerKey=>$innerObj)
                            { 
                                if($innerKey!='total')
                                {
                                    if($sr==1)
                                    { ?>
                                         <tr>
                                            <td rowspan="<?php echo $trSpan-1; ?>"><b><?php echo $keyT; ?>:</b></td>
                                            <td rowspan="<?php echo $trSpan-1; ?>"><?php echo $objT['total']; ?></td>
                                            <td><?php echo $sr; ?></td>
                                            <td><?php echo $innerKey; ?></td>
                                            <td class="text-right"><?php if($keyT=='Assets' || $keyT=='Expense' ){ echo $objT[$innerKey]; } else{ echo "-"; } ?></td>
                                            <td><?php if($keyT=='Libilities' || $keyT=='Income' ){ echo $objT[$innerKey]; } else{ echo "-"; } ?></td>
                                            <td class="text-center"><?php echo $keyT; ?></td>
                                        </tr>
                                    <?php 

                                    }
                                    else
                                    {
                                    ?>
                                <tr>
                                    <td><?php echo $sr; ?></td>
                                    <td><?php echo $innerKey; ?></td>
                                     <td class="text-right"><?php if($keyT=='Assets' || $keyT=='Expense' ){ echo $objT[$innerKey]; } else{ echo "-"; } ?></td>
                                     <td><?php if($keyT=='Libilities' || $keyT=='Income' ){ echo $objT[$innerKey]; } else{ echo "-"; }  ?></td>
                                    <td class="text-center"><?php echo $keyT; ?></td>
                                </tr>
                                <?php
                                    }
                                    $sr++; 
                                
                                }
                            }
                                 ?>
                            <tr style="background-color: #F2E1FD !important;">
                                <td colspan="7"></td>
                            </tr>
                            <?php 
                            
                            }
                        } ?>
                        <tr style="background-color: #F2E1FD !important;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b class="text-red text-right"><?php echo $newTrialBalance['Assets']['total']+$newTrialBalance['Expense']['total'] ?></b></td>
                            <td><b class="text-red text-right"><?php echo $newTrialBalance['Libilities']['total']+$newTrialBalance['Income']['total'] ?></b></td>
                            <td></td>
                        </tr>
                       <?php
                    }
                    ?>
<!--                    <tr>
                        <td rowspan="8"><b>Assets:</b></td>
                        <td rowspan="8">30,110.16</td>
                        <td>1</td>
                        <td>Card Charge - BH Squareup</td>
                        <td class="text-right">180</td>
                        <td>-</td>
                        <td class="text-center">Current Asset</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Bank - Transfer Wise</td>
                        <td class="text-right">1,549.15</td>
                        <td>-</td>
                        <td class="text-center">Current Asset</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Bank - Arro Money</td>
                        <td class="text-right">1,549.15</td>
                        <td>-</td>
                        <td class="text-center">Current Asset</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Bank - Barclays</td>
                        <td class="text-right">8,600.80</td>
                        <td>-</td>
                        <td class="text-center">Current Asset</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Card Charge - Reliance Travels</td>
                        <td class="text-right">2,425.00</td>
                        <td>-</td>
                        <td class="text-center">Current Asset</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Account Receivable</td>
                        <td class="text-right">926.08</td>
                        <td>-</td>
                        <td class="text-center">Current Asset</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Credit Card Charge - Global Travel</td>
                        <td class="text-right">4,791.00</td>
                        <td>-</td>
                        <td class="text-center">Current Asset</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Debit Card Charge - Global Travel</td>
                        <td class="text-right">11,324.00</td>
                        <td>-</td>
                        <td class="text-center">Current Asset</td>
                    </tr>
                    <tr style="background-color: #F2E1FD !important;">
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td rowspan="18"><b>Expenses:</b></td>
                        <td rowspan="18">66,007.42</td>
                        <td>1</td>
                        <td>The Holiday Team</td>
                        <td class="text-right">3,597.44</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Bank Charges - Arro Money</td>
                        <td class="text-right">200.65</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Card Charges - Global</td>
                        <td class="text-right">1,301.74</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Vonage - Bright Holiday</td>
                        <td class="text-right">1,268.82</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Card Charges - BH Squareup</td>
                        <td class="text-right">777.94</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Bank Charges - Transfer Wise</td>
                        <td class="text-right">26</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>General Expenditures - Bright Holiday</td>
                        <td class="text-right">1,285.27</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Call Center Charges - Bright Holiday</td>
                        <td class="text-right">61,147.00</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Bing - Master Travels</td>
                        <td class="text-right">2,374.16</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Vonage - Master Travels</td>
                        <td class="text-right">1,519.53</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Soho - Master Travels</td>
                        <td class="text-right">395.4</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Adwords - Master Travels</td>
                        <td class="text-right">2,222.00</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>Bing - Bright Holiday</td>
                        <td class="text-right">3,890.98</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>GDS - Master Travels</td>
                        <td class="text-right">110.44</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>Vonage - Sufi Travels</td>
                        <td class="text-right">386.07</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>Email Marketing - Master Travels</td>
                        <td class="text-right">115.21</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>Air Ticket Purchases</td>
                        <td class="text-right">233,363.53</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Profit Drawings - UK</td>
                        <td class="text-right">3,598.25</td>
                        <td>-</td>
                        <td class="text-center">Expense</td>
                    </tr>
                    <tr style="background-color: #F2E1FD !important;">
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td><b>Liabilities:</b></td>
                        <td>6,045.15</td>
                        <td>1</td>
                        <td>Customer</td>
                        <td>-</td>
                        <td class="text-right">6,045.15</td>
                        <td class="text-center">Current Liability</td>
                    </tr>
                    <tr style="background-color: #F2E1FD !important;">
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td rowspan="4"><b>Revenue / Income:</b></td>
                        <td rowspan="4">23,050.91</td>
                        <td>1</td>
                        <td>Profit on Cancellations</td>
                        <td>-</td>
                        <td class="text-right">23,050.91</td>
                        <td class="text-center">Income</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Other Incomes</td>
                        <td>-</td>
                        <td class="text-right">417.68</td>
                        <td class="text-center">Income</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Profit & Loss on Cancellations</td>
                        <td>-</td>
                        <td class="text-right">1,201.19</td>
                        <td class="text-center">Income</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Air Ticket Sales</td>
                        <td>-</td>
                        <td class="text-right">269,082.25</td>
                        <td class="text-center">Income</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Adjustment Balance</td>
                        <td>-</td>
                        <td class="text-right">18,080.42</td>
                        <td></td>
                    </tr>
                    <tr style="background-color: #F2E1FD !important;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b class="text-red text-right">351,579.11</b></td>
                        <td><b class="text-red text-right">370,544.10</b></td>
                        <td></td>
                    </tr>-->
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /page content --> 