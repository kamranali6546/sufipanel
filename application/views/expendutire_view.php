<title>UK Expenditures</title>
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
    .input-group input { width: 100% !important; }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>UK Expenditures</h3>
        </div>
        <div class="title_right">
           
        </div>
    </div>
    <div class="clearfix"></div><br>
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo site_url('uk-Expenditures'); ?>" method="POST" class="form-inline">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="">Opening Date:</label>
                            <div class="input-group"> 
                                <div class="inner-addon right-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                    <input style="width:100% !important;" type="text" name="opningDate" value="<?php if($openning){ echo $openning; } else{ echo date('Y-m-d'); } ?>" readonly="" class="form-control" id="Odate"> 
                                </div>
                            </div> 
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="">Closing Date:</label>
                <div class="input-group"> 
                    <div class="inner-addon right-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input type="text" style="width:100% !important;" name="closingDate" readonly="" value="<?php if($closing){ echo $closing; } else{ echo date('Y-m-d'); } ?>" class="form-control" id="Cdate"> 
                    </div>
                </div>
                <?php //print_r($expenseHeads); ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label for="">Expenditure Ledger Head:</label>
                
                <select name="expenseFliter" class="form-control">
                    <option value="">Select</option>
                    <?php if(!empty($expenseHeads)){ foreach($expenseHeads as $headObj){ ?>
                    <option value="<?php echo $headObj->expense_name; ?>" <?php if($ExpendHead){ if($ExpendHead==$headObj->expense_name){ ?>selected="selected" <?php } } ?> ><?php echo $headObj->expense_name; ?></option>
                    <?php } } ?>
                    <option value="netExp" <?php if($ExpendHead){ if($ExpendHead=='netExp'){ ?>selected="selected" <?php } } ?> >Expenditures In Net Profit</option>
                </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label style="color:#fff;">.</label>
                        <div>
                             <button type="submit" class="btn btn-primary btn-sm">Submit</button>   
                        </div>
                         
                    </div>
                </div>
                
                
                
               
            </form>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <h4 style="color:darkcyan;"><?php echo $ExpendHead; ?></h4>
            <table id='example' class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr> 
                        <th style="min-width:100px;">Date</th>
                        <th style="min-width:120px;">Ref.</th> 
                        <th style="min-width:120px;">Head</th>
                        <th style="min-width:160px;">By/To</th>
                        <th style="min-width:120px;">Transaction Note</th>
                        <th>Debit (&pound;)</th>
                        <th>Credit (&pound;)</th>
                        <th>Total Paid (&pound;)</th>
                        <th style="min-width: 125px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                         $drTotal=0;
                         $crTotal=0;
                         $balance=$openingBalance;
                    ?>
                    <tr>
                        <td><?php echo date('d-M-y',strtotime($openingBalanceDate)); ?></td>
                        <td>Opening Balance</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo round($balance,2); ?></td>
                        <td></td>
                        
                    </tr>
                     <?php
                        if(!empty($ExpendatureResult)){
                            foreach($ExpendatureResult as $obj){
                                $flag=idToName('booking_details','id',$obj->booking_ref,'flag');
                        ?>
                        <tr>
                            <td><?php echo date('d-M-y',strtotime($obj->pay_date)); ?></td>
                            <td><a target="_blank" href="<?php echo site_url('BookingDetailBox/'.idencode($obj->booking_ref).'/'.idencode($flag)) ?>"><?php if($obj->booking_ref){ $companyCode=idToName('booking_details','id',$obj->booking_ref,'company'); echo idToName('company','id',$companyCode,'company_Code').'-'.$obj->booking_ref; } else{ } ?></a></td>
                            <td><?php echo $obj->pay_by; ?></td>
                            <td><?php echo $obj->pay_to; ?></td>
                            <td><span style="font-size:10px; color:#666;background-color:#F4F4F4;"><?php echo $obj->description; ?></span></td> 
                            <td><?php if($obj->pay_type=='Dr'){ $drTotal=$drTotal+$obj->amount;$balance=$balance+$obj->amount; echo $obj->amount; } ?></td>
                            <td><?php if($obj->pay_type=='Cr'){ $crTotal=$crTotal+$obj->amount; $balance=$balance-$obj->amount; echo $obj->amount; } ?></td>
                            <td><?php echo round($balance,2); ?></td>    
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm" onclick="editTransectionModalPrepare(<?php echo $obj->transectionId; ?>)" title="Edit"><i class="fa fa-edit"></i></button>  
                                 <button type="button" onclick="paymentDelete(<?php echo $obj->transectionId; ?>)" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></button> 
                            </td> 
                        </tr> 
                        <?php }  } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right text-red"><b>Total</b></td>
                        <td class="text-red"><b><?php echo round($drTotal,2); ?></b></td>
                        <td class="text-red"><b><?php echo round($crTotal,2); ?></b></td>
                        <td class="text-red"><b><?php echo round($balance,2); ?></b></td>
                        <td class="text-red"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>  
</div>
<!-- /page content --> 