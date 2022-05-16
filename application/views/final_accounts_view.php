<title>Final Accounts</title>
<!-- Internal Css of Page -->
<style>
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}
    table.display tbody tr td, table.display tfoot tr td{
        /*border: 1px solid #b7b7b7;*/
        padding: 5px;
        text-align: center !important;
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
    .input-group input { width: 135px !important; }
</style>
<!-- page content -->
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Final Accounts</h3>
                    </div>
                    <div class="title_right">
                       
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <h4 style="color:darkcyan;">Profit & Loss Account</h4>
                        <label>For The Period Of:</label>
                        <table id='example' class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                            <thead>
                                 <tr> 
                                    <th>Head</th>
                                    <th>Sub Total (&pound;)</th> 
                                    <th>Total (&pound;)</th>  
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td>Air Ticket Sales</td>
                                    <td></td>
                                    <td>122.206</td>  
                                </tr> 
                                <tr>
                                    <td>(-) Air Ticket Purchases</td>
                                    <td></td>
                                    <td>(104.947)</td>  
                                </tr> 
                                <tr style="border-top: 1px solid black !important;">
                                    <td>Gross Profit</td>
                                    <td></td>
                                    <td>17.260</td>  
                                </tr> 
                            </tbody> 
                        </table>
                    </div>
                </div>  <br>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <h4 style="color:darkcyan;">Balance Sheet</h4>
                        <label>For The Period Of:</label>
                        <table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                            <thead>
                                 <tr> 
                                    <th>Sr No.</th>
                                    <th>Head</th> 
                                    <th class="text-center">Assets (&pound;)</th>
                                    <th class="text-center">Liabilities (&pound;)</th>  
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td></td>  
                                    <td></td>  
                                    <td></td>  
                                    <td></td>  
                                </tr>   
                            </tbody> 
                            <tfoot>
                                <td colspan="2" class="text-right text-red"><b>Total</b></td>
                                <td class="text-center text-red"><b>12.552</b></td>
                                <td class="text-center text-red"><b>3.988</b></td>
                            </tfoot>
                        </table>
                    </div>
                </div> 
            </div>
<!-- /page content --> 