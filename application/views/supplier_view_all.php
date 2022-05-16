<title>Liabilities</title>
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
                      <h3>Liabilities</h3>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-xs-12">
                         <button type="button" class="btn btn-primary" id="supplierModalData" >Add New Liability</button> 
                    </div>
                </div>
	<div class="clearfix"></div>
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
            <div class="table-responsive">
                <table id="example" class="table display nowrap tablColor table" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th style="width: 100px;">Sr.#</th>
                        <th>Liability Name</th> 
                        <th>Bank of Liability</th>
                        <th>Email:To</th>
                        <th>Email:Cc</th>
                        <th>Liability Type</th>
                        
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($allSupplier)){ $sr=1; foreach($allSupplier as $obj){
                        $supplierId=$obj->id;
//                        $banks=commentGetAll("Select BankId from supplierBank where supplierId='$supplierId' ");
//                        $bankNameArray=array();
//                        foreach($banks as $bankG)
//                        {
//                            $bankNameArray[]=idToName('bank','id',$obj['BankId'],'bank_name');
//                        }
//                        $bankName=idToName('bank','id',$obj->BankId,'bank_name');
                        ?>
                    <tr id="supplierId<?php echo $obj->id; ?>">
                        <td><?php echo $sr; ?></td>
                        <td><?php echo $obj->supplier_name; ?></td>
                        <td><?php echo $obj->BankId; ?></td>
                        <td><?php echo $obj->to_email; ?></td>
                        <td><?php echo $obj->cc_email; ?></td>
                        <td>
                            <?php if($obj->type=='deposit'){ echo "Indirect Supplier"; } else if($obj->type=='full_pay'){ echo "Direct Supplier"; } else if($obj->type=='ticket_ticker'){ echo "Ticket Taker"; } ?>
                        </td>
                        
                        <td>
                            <?php 
                            if($obj->flag==1){  $supplierFlag="Hide"; $btnColor='btn-primary'; } else{  $supplierFlag="Show"; $btnColor='btn-info'; }
                            ?>
                            <button type="button" onclick="onOffSupplier(<?php echo $obj->id; ?>,'<?php echo $obj->supplier_name ?>','<?php echo $supplierFlag ?>','<?php echo $obj->flag ?>')" class="btn btn-sm <?php echo $btnColor; ?>" title="<?php if($obj->flag==1){ echo "Hide"; } else{ echo "Show"; } ?>" data-toggle="tooltip"><?php if($obj->flag==1){ echo "Hide"; } else{ echo "Show"; } ?></button>
                            <!-- <button class="btn btn-primary btn-sm" onclick="editRowSupplier(<?php echo $obj->id ?>)" title="Edit"><i class="fa fa-edit"></i></button> -->
                            <!--<button class="btn btn-primary btn-sm" type="button" id="EditsupplierModel" onclick="loadModalSupplierEdit(<?php echo $obj->id ?>)" title="Edit"><i class="fa fa-edit"></i></button>-->
                            <button class="btn btn-danger btn-sm" onclick="sullpierDelete(<?php echo $obj->id ?>)" title="Delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr id="supplierEditId<?php echo $obj->id; ?>" style="display: none;">
                        <td><?php echo $obj->id; ?></td>
                        <td><input type="text" name="" class="form-control" id="supplierName<?php echo $obj->id; ?>" value="<?php echo $obj->supplier_name; ?>"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
<!--                            <button class="btn btn-primary" onclick="updateSupplier(<?php echo $obj->id ?>)" title="Update"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-danger" onclick="cancelSupplierEdit(<?php echo $obj->id ?>)" title="Cancel"><i class="fa fa-remove"></i></button>-->
                        </td>
                    </tr>
                    <?php $sr++; } }else{ ?>
                    <tr>
                        <td colspan="6" style="text-align: center"><p style="color: red;font-weight: bold;">Sorry ! There is No Data ........... </p></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
</div>
