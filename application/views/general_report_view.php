<title>General Reports</title>
<!-- page content -->
<style type="text/css">
.input-group input {
    width: 100% !important;
}
 table tr td a:visited {
    color: #0d7cbf !important;
}
@media screen and (max-width: 425px) {
    body .container.body .right_col {
        padding: 10px 13px !important;
    }
}
</style>
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left" style="width: 100%;margin-top: 8px;"> 
                        <h3>General Reports</h3> 
                    </div>
                    <div class="title_right">
                        <!--<a class="btn btn-primary btn-round pull-right" href="#">Create Follow Up</a>-->
                    </div>
                </div>

                <div class="clearfix"></div>
                    <div class="well" style="background-color: #fff; border: 1px solid #636363;">
                        <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12" style="background-color: #f3f3f3;padding: 16px 20px;height: 520px;">
                                    <form method="post" target="_blank"  action="" id="reportForm" >
                                    <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <h4>Selection Criteria:</h4>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                            <label class="text-black">Start Date:</label>
                                            <div class="input-group"> 
                                              <div class="inner-addon right-addon">
                                                  <i class="glyphicon glyphicon-calendar"></i>
                                                  <input type="text" class="form-control nextDueDate" readonly="" value="<?php echo date('Y-m-01'); ?>" name="reportStartDate" id="reportStartDate"> 
                                              </div>
                                          </div> 
                                            
                                          </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                            <label class="text-black">End Date:</label>
                                            <div class="input-group"> 
                                            <div class="inner-addon right-addon">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                                <input type="text" class="form-control nextDueDate" readonly="" value="<?php echo date('Y-m-d'); ?>" name="endDate" id="reportEndDate"> 
                                            </div>
                                            </div> 
                                           
                                          </div>
                                        </div>
                                        <?php if($this->session->userdata('flag')==3){} else if($this->session->userdata('flag')==2 || $this->session->userdata('flag')==1){ ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="text-black">Brand:</label>
                                                <select class="form-control" id="brandForReport"  name="brandForReport">
                                                    <option value="">--Select Brand--</option>
                                                    <?php if(!empty($companyData)){
                                                        foreach($companyData as $companyObj){
                                                            ?>
                                                    <option value="<?php echo $companyObj->id; ?>"><?php echo $companyObj->company_name; ?></option>
                                                            <?php 
                                                            } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php } ?>
                                         <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="text-black">Supplier:</label>
                                                <select class="form-control" id="supplierForReport" name="supplierForReport">
                                                   <option value="">--Select One--</option>
                                                    <?php if(!empty($supplierData)){ foreach($supplierData as $spObj){ if($spObj->supplier_name!='Customer'){ ?>
                                                        <option  value="<?php echo $spObj->supplier_name; ?>"><?php echo $spObj->supplier_name; ?></option>
                                                    <?php } } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="text-black">Agent:</label>
                                                <select class="form-control" id="agentForReport" name="agentForReport">
                                                    <option value="">--- Select Agent ---</option>
                                                    <?php if(!empty($agentsData)){ foreach($agentsData as $agObj){ ?>
                                                    <option <?php if($this->session->userdata('userId')==$agObj->id){?>selected="selected" <?php } ?> value="<?php echo $agObj->id ?>"><?php echo $agObj->login_name; ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="text-black">GDS:</label>
                                                <select class="form-control" id="gdsForReport" name="gdsForReport">
                                                    <option value="">--- Select GDS ---</option> 
                                                    <option value="World-Span" >World Span</option>
                                                    <option value="Galileo">Galileo</option>
                                                    <option value="Sabre">Sabre</option>
                                                    <option value="Amadeus">Amadeus</option>
                                                    <option  value="Web">Web</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                    </div> 
                                     </form>
                                </div>
                            
                            <div class="col-md-8 col-sm-8 col-xs-12">
                            <table class="table-hover" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                               <tbody>
                                  <tr> 
                                     <td width="2%" rowspan="41" align="left">&nbsp;</td>
                                     <td height="12" colspan="3" align="left" style="font-weight: bold; padding-bottom:10px;">Reports</td>
                                  </tr>
                                  <tr>
                                     <td width="3%" height="13" align="center" style="font-size: 12px; font-weight: bold; border-bottom:dashed #CCC thin;">ID</td>
                                     <td colspan="2" align="left" style="font-size: 12px; font-weight: bold; border-bottom:dashed #CCC thin;">Report Name</td>
                                  </tr>
                                  <tr>
                                     <td colspan="3" align="left" style="text-align: left"></td>
                                  </tr>
                                  <tr>
                                     <td align="left" bgcolor="#a5a3a3" style="text-align: left">&nbsp;</td>
                                     <td height="30" colspan="2" align="left" bgcolor="#a5a3a3" style="font-weight: bold;color: #fff;">Profits</td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center;padding-top: 10px">⚫</td>
                                     <td align="left" style="padding-top: 10px;"><a  href="javascript:report('report-gross-profit-earned',1);" style="color: #0080FF;font-weight: bold;font-size:14px;" >Gross Profit Earned</a></td>
                                     <td width="17%" rowspan="2" align="left" style="padding-top: 10px"><a href="javascript:report('report-gross-profit-earned',2);" ><img src="lib/images/excel.png" width="32" height="32" border="0"></a></td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center">&nbsp;</td>
                                     <td align="left" style="font-size: 10px">Parameters: Start Date,  End Date, Brand, Agent &amp; Supplier</td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td>
                                  </tr>
                                  <?php if($this->session->userdata('flag')==1 || $this->session->userdata('flag')==2 || $this->session->userdata('flag')==3 ){ ?>
                                  
                                  <tr>
                                     <td align="left" style="text-align: center">⚫</td>
                                     <td align="left"><a  href="javascript:report('report-net-profit-earned',1);" style="color: #0080FF;font-weight: bold;font-size:14px;">Net Profit Earned</a></td>
                                     <td width="17%" rowspan="2" align="left"><a href="javascript:report('report-net-profit-earned',2);"><img src="lib/images/excel.png" width="32" height="32" border="0"></a></td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center">&nbsp;</td>
                                     <td align="left" style="font-size: 10px">Parameters: Start Date,  End Date &amp; Brand</td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td>
                                  </tr>
                                  <?php } ?>
                                  <?php if($this->session->userdata('flag')==1 || $this->session->userdata('flag')==2){ ?>
                                  <tr>
                                     <td align="left" style="text-align: center">⚫</td>
                                     <td align="left"><a  href="javascript:report('report-supplier-due-balance',1);" style="color: #0080FF;font-weight: bold;font-size:14px;" >Supplier Due Balance</a></td>
                                     <td width="17%" rowspan="2" align="left"><a href="javascript:report('report-supplier-due-balance',2);"><img src="lib/images/excel.png" width="32" height="32" border="0"></a></td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center">&nbsp;</td>
                                     <td align="left" style="font-size: 10px">Parameters:  Brand, Agent &amp; Supplier</td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td>
                                  </tr>
                                  <?php } ?>
                                  <tr>
                                     <td align="left" style="text-align: center">⚫</td>
                                     <td align="left"><a  href="javascript:report('report-customer-due-balance',1);" style="color: #0080FF;font-weight: bold;font-size:14px;" >Customer Due Balance</a></td>
                                     <td width="17%" rowspan="2" align="left"><a href="javascript:report('report-customer-due-balance',2);"><img src="lib/images/excel.png" width="32" height="32" border="0"></a></td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center">&nbsp;</td>
                                     <td align="left" style="font-size: 10px">Parameters:  Brand, Agent &amp; Supplier</td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td>
                                  </tr>
                                   <?php if($this->session->userdata('flag')==1 || $this->session->userdata('flag')==2){ ?>
                                  <tr>
                                     <td align="left" style="text-align: center">⚫</td>
                                     <td align="left"><a href="<?php echo base_url('PaypalReportBox'); ?>" style="color: #0080FF;font-weight: bold;font-size:14px;" >Paypal Sum Received - Pending Bookings</a></td>
                                     <td width="17%" rowspan="2" align="left"><img src="lib/images/excel.png" width="32" height="32" border="0"></td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center">&nbsp;</td>
                                     <td align="left" style="font-size: 10px">Parameters:  Brand, Agent &amp; Supplier</td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td> 
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center">⚫</td>
                                     <td align="left"><a  href="javascript:report('report-global-card-charges',1);" style="color: #0080FF;font-weight: bold;font-size:14px;" >Global Card Charges</a></td>
                                     <td width="17%" rowspan="2" align="left"><a href="javascript:report('report-global-card-charges',2);" ><img src="lib/images/excel.png" width="32" height="32" border="0"></a></td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center">&nbsp;</td>
                                     <td align="left" style="font-size: 10px">Parameters: Start Date,  End Date</td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center">⚫</td>
                                     <td align="left"><a  href="javascript:report('report-gds',1);" style="color: #0080FF;font-weight: bold;font-size:14px;" >GDS Report</a></td>
                                     <td width="17%" rowspan="2" align="left"><a href="javascript:report('report-gds',2);" ><img src="lib/images/excel.png" width="32" height="32" border="0"></a></td>
                                  </tr>
                                  <tr>
                                     <td align="left" style="text-align: center">&nbsp;</td>
                                     <td align="left" style="font-size: 10px">Parameters:  Start Date, End Date, Brand &amp; GDS</td>
                                  </tr>
                                  <!-- <tr>
                                     <td height="12" align="center">&nbsp;</td>
                                     <td width="45%" align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td>
                                  </tr>
                                  <tr>
                                     <td height="13" align="left">&nbsp;</td>
                                     <td width="45%" align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td>
                                  </tr>
                                  <tr>
                                     <td height="25" align="left">&nbsp;</td>
                                     <td width="45%" align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td>
                                  </tr>
                                  <tr>
                                     <td height="25" align="left">&nbsp;</td>
                                     <td width="45%" align="left" style="text-align: left">&nbsp;</td>
                                     <td colspan="2" align="left">&nbsp;</td>
                                  </tr> -->
                                   <?php } ?>
                               </tbody>
                            </table>
                                <!-- <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h4>Report By:</h4>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <div class="row">
                                            <div class="col-md-8 col-sm-8 col-xs-8"> 
                                                <ul>
                                                    <li>
                                                        <h5>Gross Profit Earned</h5>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4"> 
                                                <button type="button" onclick="grossProfitFormSubmit()"  class="btn btn-primary btn-sm btn-round" ><i class="fa fa-file-excel-o"></i></button> 
                                                <a  class="btn btn-primary btn-sm btn-round" href="<?php echo site_url('ProfitBox'); ?>"><i class="fa fa-file-excel-o"></i></a> 
                                            </div>

                                            <div class="col-md-8 col-sm-8 col-xs-8"> 
                                                <ul>
                                                    <li>
                                                        <h5>Customer Due Balance</h5>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4"> 
                                                <button type="button" onclick="customerleftBanlanceForm()" class="btn btn-primary btn-sm btn-round"><i class="fa fa-file-excel-o"></i></button> 
                                                <a href="<?php echo site_url('BalanceBox'); ?>" class="btn btn-primary btn-sm btn-round"><i class="fa fa-file-excel-o"></i></a>
                                            </div>
                                        </div> 
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
            </div>
<!-- /page content -->

<script>
    function report(param,param2)
    {
    var reportStartDate=$.trim($('#reportStartDate').val());
    var endDate=$.trim($('#reportEndDate').val());
    var brandForReport= $('#brandForReport option:selected').val();
    var agentForReport= $('#agentForReport option:selected').val();
    var gdsForReport= $('#gdsForReport option:selected').val();
    var supplierForReport= $('#supplierForReport option:selected').val();
    if(reportStartDate=='')
    {
        alertify.alert('Fil the Start date!');
        return false;
    }
    if(endDate=='')
    {
         alertify.alert('Fil the End date!');
        return false;
    }
        if(param=='report-gross-profit-earned' && param2=='1')
        {
            //$('#reportForm').attr('action','report-gross-profit-earned');
            //return false;
            document.forms['reportForm'].action='<?php echo site_url('report-gross-profit-earned'); ?>';
            document.forms['reportForm'].submit();
           // $('#reportForm').submit();
        }
        else if(param=='report-gross-profit-earned' && param2=='2')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-gross-profit-earned-sheet')?>");
            $('#reportForm').submit();
        }
        else if(param=='report-net-profit-earned' && param2=='1')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-net-profit-earned')?>");
             $('#reportForm').submit();
        }
        else if(param=='report-net-profit-earned' && param2=='2')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-net-profit-earned-sheet')?>");
             $('#reportForm').submit();
        }
        else if(param=='report-supplier-due-balance' && param2=='1')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-supplier-due-balance')?>");
            $('#reportForm').submit();
        }
        else if(param=='report-supplier-due-balance' && param2=='2')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-supplier-due-balance-sheet')?>");
            $('#reportForm').submit();
        }
        else if(param=='report-customer-due-balance' && param2=='1')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-customer-due-balance')?>");
            $('#reportForm').submit();
        }
        else if(param=='report-customer-due-balance' && param2=='2')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-customer-due-balance-sheet')?>");
            $('#reportForm').submit();
        }
        else if(param=='report-global-card-charges' && param2=='1')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-global-card-charges')?>");
            $('#reportForm').submit();
        }
        else if(param=='report-global-card-charges' && param2=='2')
        {
            
            $('#reportForm').attr('action',"<?php echo site_url('report-global-card-charges-sheet')?>");
            $('#reportForm').submit();
        }
        else if(param=='report-gds' && param2=='1')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-gds')?>");
            $('#reportForm').submit();
        }
        else if(param=='report-gds' && param2=='2')
        {
            $('#reportForm').attr('action',"<?php echo site_url('report-gds-sheet')?>");
            $('#reportForm').submit();  
        }
    }
//function grossProfitReport()
//{
//    //<?php echo base_url('GrossReportBox'); ?>
//    
//    var reportStartDate=$.trim($('#reportStartDate').val());
//    var endDate=$.trim($('#reportEndDate').val());
//    var brandForReport= $('#brandForReport option:selected').val();
//    var agentForReport= $('#agentForReport option:selected').val();
//    var gdsForReport= $('#gdsForReport option:selected').val();
//    var supplierForReport= $('#supplierForReport option:selected').val();
//    if(reportStartDate=='')
//    {
//        alertify.alert('Fil the Start date!');
//        return false;
//    }
//    if(endDate=='')
//    {
//         alertify.alert('Fil the End date!');
//        return false;
//    }
//     showLoder();
//     $.ajax({
//         type:'POST',
//         url:ajaxUrl+'ProfitBox',
//         cache:false,
//         data:{reportStartDate:reportStartDate,endDate:endDate,brandForReport:brandForReport,agentForReport:agentForReport,gdsForReport:gdsForReport,supplierForReport:supplierForReport},
//         success:function(resp)
//         {
//             hideLoder();
////              var w = window.open('<?php echo base_url('GrossReportBox'); ?>');
////                w.document.open();
////                w.document.write(resp);
////                w.document.close();
//         }
//         
//     });
//}
//function customerDueBalance()
//{
//    
//    var reportStartDate=$.trim($('#reportStartDate').val());
//    var endDate=$.trim($('#reportEndDate').val());
//    var brandForReport= $('#brandForReport option:selected').val();
//    var agentForReport= $('#agentForReport option:selected').val();
//    var gdsForReport= $('#gdsForReport option:selected').val();
//    var supplierForReport= $('#supplierForReport option:selected').val();
//    if(reportStartDate=='')
//    {
//        alertify.alert('Fil the Start date!');
//        return false;
//    }
//    if(endDate=='')
//    {
//         alertify.alert('Fil the End date!');
//        return false;
//    }
//     showLoder();
//     $.ajax({
//         type:'POST',
//         url:ajaxUrl+'CustomerReportBox',
//         cache:false,
//         data:{reportStartDate:reportStartDate,endDate:endDate,brandForReport:brandForReport,agentForReport:agentForReport,gdsForReport:gdsForReport,supplierForReport:supplierForReport},
//         success:function(resp)
//         {
//             hideLoder();
////              var w = window.open('<?php echo base_url('GrossReportBox'); ?>');
////                w.document.open();
////                w.document.write(resp);
////                w.document.close();
//         }
//         
//     });
//}
//function gdsReport()
//{
//    var reportStartDate=$.trim($('#reportStartDate').val());
//    var endDate=$.trim($('#reportEndDate').val());
//    var brandForReport= $('#brandForReport option:selected').val();
//    var agentForReport= $('#agentForReport option:selected').val();
//    var gdsForReport= $('#gdsForReport option:selected').val();
//    var supplierForReport= $('#supplierForReport option:selected').val();
//    if(reportStartDate=='')
//    {
//        alertify.alert('Fil the Start date!');
//        return false;
//    }
//    if(endDate=='')
//    {
//         alertify.alert('Fil the End date!');
//        return false;
//    }
//     showLoder();
//     $.ajax({
//         type:'POST',
//         url:ajaxUrl+'GDSReportBox',
//         cache:false,
//         data:{reportStartDate:reportStartDate,endDate:endDate,brandForReport:brandForReport,agentForReport:agentForReport,gdsForReport:gdsForReport,supplierForReport:supplierForReport},
//         success:function(resp)
//         {
//             hideLoder();
////              var w = window.open('<?php echo base_url('Reports/getGdsReport'); ?>');
////                w.document.open();
////                w.document.write(resp);
////                w.document.close();
//         }
//         
//     });
//}
//function globalCardReport()
//{
//     var reportStartDate=$.trim($('#reportStartDate').val());
//    var endDate=$.trim($('#reportEndDate').val());
//    var brandForReport= $('#brandForReport option:selected').val();
//    var agentForReport= $('#agentForReport option:selected').val();
//    var gdsForReport= $('#gdsForReport option:selected').val();
//    var supplierForReport= $('#supplierForReport option:selected').val();
//    if(reportStartDate=='')
//    {
//        alertify.alert('Fil the Start date!');
//        return false;
//    }
//    if(endDate=='')
//    {
//         alertify.alert('Fil the End date!');
//        return false;
//    }
//     showLoder();
//     $.ajax({
//         type:'POST',
//         url:ajaxUrl+'GlobalReportBox',
//         cache:false,
//         data:{reportStartDate:reportStartDate,endDate:endDate,brandForReport:brandForReport,agentForReport:agentForReport,gdsForReport:gdsForReport,supplierForReport:supplierForReport},
//         success:function(resp)
//         {
//             hideLoder();
////              var w = window.open('<?php echo base_url('Reports/getGlobalCardReport'); ?>');
////                w.document.open();
////                w.document.write(resp);
////                w.document.close();
//         }
//         
//     });
//}
//
//function supplierLeftBalance()
//{
//    var reportStartDate=$.trim($('#reportStartDate').val());
//    var endDate=$.trim($('#reportEndDate').val());
//    var brandForReport= $('#brandForReport option:selected').val();
//    var agentForReport= $('#agentForReport option:selected').val();
//    var gdsForReport= $('#gdsForReport option:selected').val();
//    var supplierForReport= $('#supplierForReport option:selected').val();
//    if(reportStartDate=='')
//    {
//        alertify.alert('Fil the Start date!');
//        return false;
//    }
//    if(endDate=='')
//    {
//         alertify.alert('Fil the End date!');
//        return false;
//    }
//     showLoder();
//     $.ajax({
//         type:'POST',
//         url:ajaxUrl+'SupplierReportBox',
//         cache:false,
//         data:{reportStartDate:reportStartDate,endDate:endDate,brandForReport:brandForReport,agentForReport:agentForReport,gdsForReport:gdsForReport,supplierForReport:supplierForReport},
//         success:function(resp)
//         {
//             hideLoder();
////              var w = window.open('<?php echo base_url('Reports/getSupplierLeftBalance'); ?>');
////                w.document.open();
////                w.document.write(resp);
////                w.document.close();
//         }
//         
//     });
//}
//function netProfitReport()
//{
//    var reportStartDate=$.trim($('#reportStartDate').val());
//    var endDate=$.trim($('#reportEndDate').val());
//    var brandForReport= $('#brandForReport option:selected').val();
//    var agentForReport= $('#agentForReport option:selected').val();
//    var gdsForReport= $('#gdsForReport option:selected').val();
//    var supplierForReport= $('#supplierForReport option:selected').val();
//    if(reportStartDate=='')
//    {
//        alertify.alert('Fil the Start date!');
//        return false;
//    }
//    if(endDate=='')
//    {
//         alertify.alert('Fil the End date!');
//        return false;
//    }
//     showLoder();
//     $.ajax({
//         type:'POST',
//         url:ajaxUrl+'NetReportBox',
//         cache:false,
//         data:{reportStartDate:reportStartDate,endDate:endDate,brandForReport:brandForReport,agentForReport:agentForReport,gdsForReport:gdsForReport,supplierForReport:supplierForReport},
//         success:function(resp)
//         {
//             hideLoder();
////              var w = window.open('<?php echo base_url('Reports/getNetProfitReport'); ?>');
////                w.document.open();
////                w.document.write(resp);
////                w.document.close();
//         }
//         
//     });
//}
</script>