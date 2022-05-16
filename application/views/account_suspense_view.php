<title>Suspense Account</title> 
<style>
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}
    table.display tbody tr td, table.display tfoot tr td{
        /*border: 1px solid #b7b7b7;*/
        padding: 5px;
        text-align: center !important;
    } 
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>Suspense Account</h3>
        </div>
        <div class="title_right">
           
        </div>
    </div>
    <div class="clearfix"></div> 
    <div class="row">
        <div class="col-md-12 table-responsive"> 
            <table class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr> 
                        <th>Date</th>
                        <th>By/To</th>
                        <th>Transaction Note</th>  
                        <th>Debit (&pound;)</th>
                        <th>Credit (&pound;)</th>
                        <th>End Bal (&pound;)</th>
                        <th style="width: 100px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php  //echo "<pre>"; print_r($resultSuspense); echo "</pre>";
                    if(!empty($resultSuspense)){ $dr=0;$cr=0; $startBalance=0; $endBalance=-0; foreach($resultSuspense as $obj){  
                    ?>
                    <tr>
                        <td><?php echo $obj->pay_date; ?></td>
                        <td><?php echo $obj->pay_by; ?></td>
                        <td><?php echo $obj->description; ?></td>
                        <td><?php if($obj->pay_type=='Dr'){ $dr=$dr+$obj->amount; $endBalance=$endBalance+$obj->amount; echo $obj->amount; } ?></td>
                        <td><?php if($obj->pay_type=='Cr'){ $cr=$cr+$obj->amount; $endBalance=$endBalance-$obj->amount; echo $obj->amount; } ?></td>
                        <td> <?php echo $endBalance; ?></td> 
                        <td class="text-center">
                            <button type="button" class="btn btn-info btn-sm" title="Edit Transaction" onclick="editTransectionModalPrepare(<?php echo $obj->transectionId; ?>)"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-round" onclick="paymentDelete(<?php echo $obj->transectionId; ?>)" title="Delete Transaction"><i class="fa fa-trash"></i></button>
                        </td> 
                    </tr> 
                    <?php } } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right text-red"><b>Total</b></td>
                        <td class="text-red"><b><?php echo $dr; ?></b></td>
                        <td class="text-red"><b><?php echo $cr; ?></b></td>
                        <td class="text-red"><b><?php echo $endBalance; ?></b></td>
                        <td class="text-red"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>  
</div>
<!-- /page content --> 