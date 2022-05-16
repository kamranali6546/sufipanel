<title>Brands</title>
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
                <div class="row">
                    <div class="col-lg-10 col-sm-10 col-xs-12">
                      <h3>Brands</h3>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-xs-12">
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addbrand">Add New Brand</button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="example" class="display nowrap tablColor" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr.#</th>
                                    <th>Brand Name</th>
                                    <th>Brand Code</th>
                                    <th>Contact Number</th>
                                    <th>Logo</th>
                                    <th class="text-center" style="width: 100px !important;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($company)){ $j=1;foreach($company as $obj){?>
                                <tr id="removeRow<?php echo $obj->id;  ?>">
                                    <td><?php echo $j; ?></td>
                                    <td><?php echo $obj->company_name; ?></td>
                                    <td><?php echo $obj->company_Code; ?></td>
                                    <td><?php echo $obj->phone; ?></td>
                                    <td><img width="40" src="<?php echo base_url() ?>/upload/<?php echo $obj->company_logo; ?>"></td>
                                    <td class="text-center">
                                        <?php 
                                        if($obj->status==1){  $supplierFlag="Hide"; $btnColor='btn-primary'; } else{  $supplierFlag="Show"; $btnColor='btn-info'; }
                                        ?>
                                        <button type="button" onclick="onOffCompany(<?php echo $obj->id; ?>,'<?php echo $obj->company_name ?>','<?php echo $supplierFlag ?>','<?php echo $obj->status ?>')" class="btn btn-sm <?php echo $btnColor; ?>" title="<?php if($obj->status==1){ echo "Hide"; } else{ echo "Show"; } ?>" data-toggle="tooltip"><?php if($obj->status==1){ echo "Hide"; } else{ echo "Show"; } ?></button>
                                        <!--<button type="button" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button> &nbsp; &nbsp;-->
                                        <!--<button type="button" data-container="<?php echo $obj->id; ?>" onclick="removeCompany(<?php echo $obj->id; ?>)" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></button>-->
                                    </td>
                                    
                                </tr>
                                <?php  $j++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>               
            </div>


<!-- Modal -->
<div id="addbrand" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add New Brand</h4>
                        </div>
                        <div class="modal-body">
        
                <?php if(!empty($error)){ echo $error; } ?>
                <form method="post" enctype="multipart/form-data" action="<?php echo site_url('AgencySave'); ?>" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Brand Name:</label>
                                    <input type="text" id="company_name" name="company_name" value="<?php echo set_value('company_name') ?>" class="form-control" tabindex="1" autofocus="">
                                    <span class="error"><?php echo form_error('company_name'); ?></span>
                                </div>
<!--                                <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" name="company_pass" id="company_pass" value="<?php echo set_value('company_pass') ?>" class="form-control" tabindex="3">
                                     <span class="error"><?php echo form_error('company_pass'); ?></span>
                                </div>-->
                                <div class="form-group">
                                    <label>Brand Contact Number:</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone') ?>" tabindex="5" >
                                     <span class="error"><?php echo form_error('phone'); ?></span>
                                </div>
<!--                                <div class="form-group">
                                    <label>Select Account Type:</label>
                                    <select name="brandHeadType" required="" class="form-control" id="brandHeadType">
                                        <option value="">--Select Head Type--</option>
                                        <option value="Assets">Assets</option>
                                        <option value="Expenses">Expenses</option>
                                        <option value="Liabilities">Liabilities</option>
                                        <option value="Income">Income</option>
                                        <option value="Capitals">Capitals</option>
                                    </select>
                                    <span id="brandAccountTypeError"></span>
                                </div>-->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Brand Code:</label>
                                    <input type="text" name="companyCode"  class="form-control" maxlength="2" value="<?php echo set_value('companyCode') ?>">
                                    <span class="error"><?php echo form_error('companyCode'); ?></span>
                                </div>
<!--                                <div class="form-group">
                                    <label>Login Name:</label>
                                    <input type="text" id="company_login" name="company_login" value="<?php echo set_value('company_login'); ?>" class="form-control" tabindex="2">
                                     <span class="error"><?php echo form_error('company_login') ?></span>
                                </div>-->
                                <div class="form-group">
                                    <label>Brand Logo:</label>
                                    <input type="file" name="companylogo" id="companylogo" accept="image/*" class="" tabindex="4">
                                     <span class="error"><?php if(!empty($imgerror)){ echo $imgerror; } ?></span>
                                </div>
                                <div class="form-group">
                                    <div style="width:150px !important;height: 150px !important;">
                                        <img src="" id="prew" style="width:150px !important;height: 100px !important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-right">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" name="saveCompany" class="btn btn-primary">Save</button> 
                                    <button type="button" class="btn btn-danger" onclick="javascript:window.location='<?php echo site_url('Agencies'); ?>'">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
              </form>
                        </div>  
                    </div>

  </div>
</div>
<!-- /page content -->
