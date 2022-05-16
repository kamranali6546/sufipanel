<title>Expenses</title>
<!-- page content -->
<style>
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}
    table.display tbody tr td, table.display tfoot tr td{
        /*border: 1px solid #b7b7b7;*/
        padding: 5px;
        text-align: center !important;
    }
    @media screen and (max-width: 425px) {
    body .container.body .right_col {
        padding: 10px 13px !important;
    }
}
</style>
            <div class="right_col" role="main">
                <div class="row">
                    <div class="col-lg-10 col-sm-10 col-xs-12">
                      <h3>Expenses</h3>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-xs-12">
                        <a class="btn btn-primary btn-round" href="javascript:void(0)" onclick="expenseModalShow()">Add New Expense</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="example" class="table display nowrap" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr.#</th>
                                    <th>Brand</th>
                                    <th>Heads of Expenses</th>
                                    <th>Country of Expense</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($allExpenseHead)){ $j=1; foreach($allExpenseHead as $obj){ ?>
                                <tr id="exp<?php echo $obj->id; ?>">
                                    <td><?php echo $j; ?></td>
                                    <td><?php echo idToName('company','id',$obj->brand,'company_name'); ?></td>
                                    <td><?php echo $obj->expense_name; ?></td>
                                    <td><?php if($obj->expense_type=='local'){ echo "PK"; } else { echo $obj->expense_type; } ?></td>
                                    <td>
                                        <?php 
                            if($obj->flag==1){  $supplierFlag="Hide"; $btnColor='btn-primary'; } else{  $supplierFlag="Show"; $btnColor='btn-info'; }
                            ?>
                                        <button type="button" onclick="onOffExpense(<?php echo $obj->id; ?>,'<?php echo $obj->expense_name ?>','<?php echo $supplierFlag ?>','<?php echo $obj->flag ?>')" class="btn btn-sm <?php echo $btnColor; ?>" title="<?php if($obj->flag==1){ echo "Hide"; } else{ echo "Show"; } ?>" data-toggle="tooltip"><?php if($obj->flag==1){ echo "Hide"; } else{ echo "Show"; } ?></button>
                                        <!--<button type="button" class="btn btn-round btn-primary" onclick="editExpenseHead(<?php echo $obj->id  ?>)" title="Edit" data-toggle="tooltip"><span class="fa fa-edit"></span></button>-->
                                        <button type="button" class="btn btn-round btn-danger" onclick="deleteExpenseHead(<?php echo $obj->id ?>)" title="Delete" data-toggle="tooltip"><span class="fa fa-trash"></span></button>
                                    </td>
                                </tr>
                                <?php $j++; } } ?>
                            </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>               
            </div>
<!-- /page content -->
