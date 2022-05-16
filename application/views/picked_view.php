<title>Day Wise Summary</title>
<style>
    table tbody tr td {
        text-align: center !important;
    }
    * {
        font-family: Verdana,Arial,sans-serif;
    }
    .main{
    	position: relative;
    	top: -15px;
    	left: 7px;
    }
    .panel-info>.panel-heading {
    border-color: #cecece !important;
}
    table {
            background-color: #f9f9f9 !important;
    }
    .panel-body {
        border: 1px solid #b1afaf;
        padding:27px;
    }
    .panel {
            border: 0px solid transparent !important;
    }
    .panel-info {
            border-color: #e6e6e6 !important;
    }
    .panel-heading {
        border: 1px solid #d3d3d3;
    background: #e6e6e6 url(../images/yu.png) 50% 50% repeat-x !important; 
    font-weight: normal;
    color: #555555 !important; 
    }
    table tbody tr td:nth-child(3){
        text-align: right;
    }
    .panel-info:nth-child(n+1) {
        margin-top: -16px;
    }
    .panel-info:nth-child(1) {
        margin-top: 0px !important;
    }

@media screen and (max-width: 425px) {
    body .container.body .right_col {
        padding: 10px 13px !important;
    }
    .mbmob {
        margin-bottom: 17px;
    }
    .panel-body {
        padding:5px !important;
    }
    .panel-title {
            font-size: 14px;
    }
    .panel-heading {
            padding: 10px 8px;
    }
    .btn-refine {
        margin-top: 10px;
    }
}
</style> 
<!-- page content -->
<div class="right_col table-responsive" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>Day Wise Summary</h3>
        </div>
        <div class="title_right">
            <!--<a class="btn btn-primary btn-round pull-right" href="<?php echo site_url('NewFollowUP'); ?>">Create Follow Up</a>-->
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <form method="post" action="<?php echo site_url('picked'); ?>">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mbmob">
                        <select class="form-control" name="companyFliter">
                            <option value="">--Select Company--</option>
                            <?php if(!empty($companyList)){ foreach($companyList as $company){ ?>
                            <option value="<?php echo $company->company_name;  ?>" <?php if(!empty($companyFliterApply) && $companyFliterApply==$company->company_name){ ?> selected="" <?php } ?> ><?php echo $company->company_name;  ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mbmob">
                        <select class="form-control" name="agentFliter">
                            <option value="">All Agent</option>
                            <?php
                            if(!empty($agentDropDown))
                            {
                                foreach($agentDropDown as $agent)
                                { ?>
                            <option value="<?php echo $agent->id ?>" <?php if(!empty($agentFliterApply) && $agentFliterApply==$agent->id){ ?> selected="" <?php } ?> ><?php echo $agent->full_name; ?></option>
                               <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 mbmob">
                        <input type="text" class="form-control" name="inquiry" <?php if(!empty($inquiryFliterApply)){ ?> value="<?php echo $inquiryFliterApply; ?>"<?php } ?> >
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                        <button type="submit" class="btn btn-primary btn-refine">Refine</button>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div style="float:left;width:100%;text-align:right;padding:10px 0;font-size:17px;color:#2F6A03;">
                            <strong>Pending Enquires: 0</strong>
                      </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php echo $output; ?>
<!--                        <div class="panel panel-info" style="margin-bottom: 2px;">
    		    <div class="panel-heading">
                    <h3 class="panel-title">22-Jul-2017<span style="margin-left: 66%;">Total Received Inquiries=00</span></h3>
                       
    			<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
        		</div>
                    <div class="panel-body">
                        <span class=""></span>
                        <table class="table-striped" width="100%">
                            <tr>
                                <th>Agent</th>
                                <th style="text-align:center;">Total Picked</th>
                                <th>Picked Inquiries</th>
                            </tr>
                            <tr>
                                           <td>Admin  </td>
                                                    <td style="text-align:center;">0</td>
                                <td>
                                
                                </td>
                            </tr>
                                                    <td>Max  </td>
                                                    <td style="text-align:center;">0</td>
                                <td>
                                
                                </td>
                            </tr>
                                                    <td>Adem  </td>
                                                    <td style="text-align:center;">0</td>
                                <td>
                                
                                </td>
                            </tr>
                                                    <td>Peter  </td>
                                                    <td style="text-align:center;">1</td>
                                <td>
                               <a href='home.php?module=picked_summry&func=details&id=395'>395</a> 
                                </td>
                            </tr>
                                                    <td>Kevin  </td>
                                                    <td style="text-align:center;">0</td>
                                <td>
                                
                                </td>
                            </tr>
                                                    <td>Admin  M T</td>
                                                    <td style="text-align:center;">0</td>
                                <td>
                                
                                </td>
                            </tr>
                                                    <td>Chris  Malick</td>
                                                    <td style="text-align:center;">0</td>
                                <td>
                                
                                </td>
                            </tr>
                                                    <td>James  Anderson</td>
                                                    <td style="text-align:center;">0</td>
                                <td>
                                
                                </td>
                            </tr>
                                                    <td>Test  user</td>
                                                    <td style="text-align:center;">0</td>
                                <td>
                                
                                </td>
                            </tr>
                                 
                            <tr>
                                <td colspan="3" style="border-bottom:  1px solid;"></td> 
                            </tr>
                            <tr style="background-color:#D9EDF7;">
                                <td></td>
                                <td style="text-align:center;">1</td>
                                <td style="text-align:center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Still Total Pending = 0</td>
                            </tr>   
                        </table>
                    </div>
        	</div>-->
        </div>
    </div>               
</div>
<!-- /page content -->
