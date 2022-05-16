<title>Assets</title>
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
                       <h3>Assets</h3>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-xs-12">
                        <button type="button" class="btn btn-primary" id="bankModalData" >Add New Asset</button>
                    </div>
                </div>
	<div class="clearfix"></div>
	<div class="row">
        <div class="col-md-12 table-responsive"> 
            <table id="example" class="display nowrap tablColor table" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th style="width: 100px;">Sr.#</th>
                        <th>Brand Name</th>
                        <th>Asset Name</th> 
                        <th>Country of Assets</th> 
                        <th style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($allBanks)){ $sr=1; foreach($allBanks as $obj){ ?>
                    <tr id="bankId<?php echo $obj->id; ?>">
                        <td><?php echo $sr; ?></td>
                        <td><?php echo idToName('company','id',$obj->brand,'company_name'); ?></td>
                        <td><?php echo $obj->bank_name; ?></td>
                        <td><?php echo $obj->bank_type; ?></td>
                        <td>
                            <?php 
                            if($obj->flag==1){  $supplierFlag="Hide"; $btnColor='btn-primary'; } else{  $supplierFlag="Show"; $btnColor='btn-info'; }
                            ?>
                            <button type="button" onclick="onOffBank(<?php echo $obj->id; ?>,'<?php echo $obj->bank_name ?>','<?php echo $supplierFlag ?>','<?php echo $obj->flag ?>')" class="btn btn-sm <?php echo $btnColor; ?>" title="<?php if($obj->flag==1){ echo "Hide"; } else{ echo "Show"; } ?>" data-toggle="tooltip"><?php if($obj->flag==1){ echo "Hide"; } else{ echo "Show"; } ?></button>
                            <!--<button class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></button>-->
                            <button class="btn btn-danger btn-sm" onclick="bankdelete(<?php echo $obj->id ?>)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php $sr++; } }else{ ?>
                    <tr>
                        <td colspan="3" style="text-align: center"><p style="color: red;font-weight: bold;">Sorry ! There is No Data ........... </p></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>