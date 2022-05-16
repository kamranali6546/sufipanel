<title>Logins</title>
<style>
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}
table.dataTable.row-border tbody th, table.dataTable.row-border tbody td, table.dataTable.display tbody th, table.dataTable.display tbody td {
    border-bottom: :1px dashed #ddd !important;
    text-align: center !important;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 3px !important;
}
    table.display tbody tr td{
        border-left: 0px solid #b7b7b7 !important;
        border-right: 0px solid #b7b7b7 !important;
        border-top: 0px solid #b7b7b7 !important;
            padding: 0px;
    }
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    padding: 0px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    font-size: 11px !important;
}
.about ul.our-links li .detail {
    width: 60%;
    padding-left: 20px;
    float: left;
    color: #fff;
}
@media screen and (max-width: 425px) {
    body .container.body .right_col {
        padding: 10px 13px !important;
    }
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
                    <div class="col-lg-10 col-sm-10 col-xs-12">
                      <h3>Logins</h3>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-xs-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewAgent">Add New Login</button>
                    </div>
                </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="table-responsive">
                <table id="example" class="table display nowrap tablColor" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                        <th class="text-center">S.No</th>
                        <th width="10%" class="text-center">Login<br>Name</th>
                        <th width="10%" class="text-center">Password</th>
                        <th width="10%" class="text-center">Email</th> 
                        <th width="10%" class="text-center">Phone</th> 
                        <th width="10%" class="text-center">Brand<br>Code</th>
                        <th width="10%" class="text-center">Access<br>Level</th>
                        <th width="10%" class="text-center">Status</th>
                        <th width="10%" class="text-center">Sales<br>Target</th>
                        <th width="10%" class="text-center">Profit<br>Target</th>
                        <th width="10%" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php if(!empty($record)){
//                        print_r($record);
                        $sr=1;
                        foreach($record as $obj){
                        ?>
                    <tr>
                        <td class="text-center"><?php echo $sr; ?></td>
                        <td><?php echo $obj->login_name; ?></td>
                        <td><?php echo $obj->password; ?></td>
                        <td><?php echo $obj->email; ?></td>
                        <td><?php echo $obj->cell; ?></td>
                        <td><?php if($obj->flag!=1 && $obj->flag!=2){ echo idToName('company','id',$obj->companyId,'company_Code'); } ?></td>
                        <td><?php echo $obj->flag; ?></td>
                        <td><?php if($obj->agent_status==1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                        <td><?php echo $obj->sales_target; ?></td>
                        <td><?php echo $obj->profitTarget; ?></td>
                        <td class="text-center"> 
                            <!--data-toggle="modal" data-target="#editAgent"-->
                            <button type="button" class="btn btn-info btn-sm" onclick="editAgentModalShow(<?php echo $obj->adminId; ?>)" title="Edit" ><i class="fa fa-edit"></i></button>
                           <?php if($obj->flag!=1 && $obj->flag!=2){ ?> <button type="button" class="btn btn-danger btn-sm" onclick="agentRemove(<?php echo $obj->adminId;  ?>)" title="Delete"><i class="fa fa-trash"></i></button><?php } ?>
                            <!-- <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button> -->
                        </td> 
                    </tr> 
                        <?php $sr++; } } ?>
                </tbody>
            </table>
            </div>
            
        </div>
    </div>               
</div>
<!-- /page content -->


<!-- New Agent Modal -->
<div class="modal fade success" id="addNewAgent" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add New Login</h5>
            </div>
            <form autocomplete="off" id="agentAddForm" method="post" action="<?php echo site_url('UserSave'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name:</label>
                                        <input type="text" name="first_name" onkeypress="removeerror('firstNameError',this.id);" id="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control" tabindex="1" autofocus="">
                                        <span id="firstNameError" class="error"><?php echo form_error('first_name'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>Email:</label>
                                         <input type="text" name="email" onkeypress="removeerror('emailError',this.id);" autocomplete="off" id="email" value="<?php echo set_value('email'); ?>" class="form-control" tabindex="3" >
                                         <span class="error" id="emailError"><?php echo form_error('email'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>CNIC#:</label>
                                         <input type="text" id="cnic" onkeypress="removeerror('cnicError',this.id);" name="cnic" value="<?php echo set_value('cnic'); ?>" class="form-control" tabindex="5" >
                                         <span class="error" id="cnicError"><?php echo form_error('cnic'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>Password:</label>
                                         <input type="password" id="password" onkeypress="removeerror('passError',this.id);" autocomplete="off"  name="password" value="<?php echo set_value('password'); ?>" class="form-control" tabindex="7">
                                         <span class="error" id="passError"><?php echo form_error('password'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Shift Time Start :</label>
                                                <input type="text" name="shift_time_start"  readonly="" class="form-control" id="agentShiftTimeStart">
                                                <span class="error" id="shiftStartTimeError"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Shift Time End :</label>
                                                <input type="text" name="shift_time_end" class="form-control" readonly="" id="agentShiftTimeEnd">
                                                <span id="shiftEndTimeError" class="error"></span>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Access Level:</label>
                                                <select class="form-control" name="access_Level" id="agentRole" >
                                                    <?php if($this->session->userdata('flag')==3){ ?>
                                                    <option value="">--Select One--</option>                                               
                                                    <option value="5">Agent</option>
                                                    <?php } else if($this->session->userdata('flag')==1){ ?>
                                                    <option value="">--Select One--</option>
<!--                                                    <option value="1">Admin</option> 
                                                    <option value="2">Accounts</option> -->
                                                    <option value="3">Brand-Admin</option> 
                                                    <option value="4">Manger</option>
                                                    <option value="5">Agent</option>
                                                    <?php } ?>
                                                </select>
                                                <span class="error" id="accessLevelError"><?php echo form_error('access_Level'); ?></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Status:</label>
                                                <select class="form-control" name="agentStatus" id="agentStatus">
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                </select> 
                                            </div>
                                        </div> 
                                        
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Sales Target:</label>
                                                <input type="text" name="salesTarget" onkeypress="removeerror('salesTargetError',this.id);" id="targetSale" class="form-control">
                                                <span class="error" id="salesTargetError"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Profit Target:</label>
                                                <input type="text" name="profitTarget" onkeypress="removeerror('profitTargetError',this.id);" id="targetProfit" class="form-control">
                                                <span class="error" id="profitTargetError"></span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                         <label>Last Name:</label>
                                         <input type="text" id="last_name" name="last_name" onkeypress="removeerror('lastNameError',this.id);" value="<?php echo set_value('last_name'); ?>" class="form-control" tabindex="2" >
                                         <span class="error" id="lastNameError"><?php echo form_error('last_name'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>Phone:</label>
                                         <input type="text" id="phone" name="phone" onkeypress="removeerror('phoneError',this.id);" value="<?php echo set_value('phone'); ?>" class="form-control" tabindex="4" >
                                         <span class="error" id="phoneError"><?php echo form_error('phone'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>Login Name:</label>
                                         <input type="text" name="loginName" onkeypress="removeerror('loginNameError',this.id);" autocomplete="off" id="loginName" value="<?php echo set_value('loginName'); ?>" class="form-control" tabindex="6">
                                          <span class="error" id="loginNameError"><?php echo form_error('loginName'); ?></span>
                                    </div>
                                     <div class="form-group">
                                        <label>Brand:</label>
                                        <select name="company" id="company" class="form-control" tabindex="9" >
                                            <option value="">--Select Brand--</option>
                                            <?php if($this->session->userdata('flag')==3){  ?>
                                            <?php if(!empty($company)){ foreach($company as $obj){ if($this->session->userdata('company')==$obj->id){ ?>
                                            <option value="<?php echo $obj->id; ?>"><?php echo $obj->company_name; ?></option>
                                            <?php } } } ?>
                                            <?php } else if($this->session->userdata('flag')==1){ ?>
                                            <?php if(!empty($company)){ foreach($company as $obj){ ?>
                                            <option value="<?php echo $obj->id; ?>"><?php echo $obj->company_name; ?></option>
                                            <?php } } } ?>
                                            
                                        </select>
                                        <span class="error" id="companyError"><?php echo form_error('company'); ?></span>
                                    </div> 
                                    
<!--                                    <div class="form-group">
                                         <label>Profile Pic:</label>
                                         <input type="file" name="profilepic_agent" id="profiePic" class="form-control" tabindex="8">
                                    </div>
                                    <div class="form-group">
                                        <div style="width:150px !important;height: 150px !important;">
                                            <img src="" id="prewAgent" style="width:150px !important;height: 100px !important;">
                                        </div>
                                    </div>-->
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" tabindex="10" style="margin-top: 5px;">Save</button>
                    <button type="button" class="btn btn-warning" tabindex="11" onclick="formReset('agentAddForm')">Reset</button> 
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Agent Modal  -->
<div class="modal fade success" id="editAgent" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit Logins</h5>
            </div>
            <form id="agentEditForm" method="post" action="<?php echo site_url('AgentBoxUpdate'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name:</label>
                                        <input type="hidden" id="adminLevelsFlag" name="adminLevelsFlag">
                                        <input type="hidden" name="agentId" id="agentEditId" >
                                        <input type="text" name="first_name" id="first_nameEdit" value="<?php echo set_value('first_name'); ?>" class="form-control" tabindex="1" autofocus="">
                                        <span class="error" id="first_nameEditError"><?php echo form_error('first_name'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>Email:</label>
                                         <input type="text" name="email" id="emailEdit" value="<?php echo set_value('email'); ?>" class="form-control" tabindex="3" >
                                         <span class="error" id="emailEditError"><?php echo form_error('email'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>CNIC#:</label>
                                         <input type="text" id="cnicEdit" name="cnic" value="<?php echo set_value('cnic'); ?>" class="form-control" tabindex="5" >
                                         <span class="error" id="cnicEditError"><?php echo form_error('cnic'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>Password:</label>
                                         <input type="password" id="passwordEdit"  name="password" value="<?php echo set_value('password'); ?>" class="form-control" tabindex="7">
                                         <span class="error" id="passwordEditError"><?php echo form_error('password'); ?></span>
                                    </div>
                                    <div class="form-group" id="shiftBoxDiv">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Shift Time Start :</label>
                                                <input type="text" name="shift_time_start" readonly="" class="form-control" id="agentShiftTimeStartEdit">
                                                <span class="error" id="agentShiftTimeStartEditError"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Shift Time End :</label>
                                                <input type="text" name="shift_time_end" class="form-control" readonly="" id="agentShiftTimeEndEdit">
                                                <span id="agentShiftTimeEndEditError" class="error"></span>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6" id="accessLevelDiv">
                                                <label>Access Level:</label>
                                                <select class="form-control" name="access_Level" id="agentRoleEdit">
                                                    <?php if($this->session->userdata('flag')==3){ ?>
                                                    <option value="">--Select One--</option>
                                                    <option value="5">Agent</option>
                                                    <?php } else if($this->session->userdata('flag')==1){ ?>
                                                    <option value="">--Select One--</option>
<!--                                                    <option value="1">Admin </option> 
                                                    <option value="2">Accounts</option> -->
                                                    <option value="3">Brand-Admin</option>
                                                    <option value="4">Manger</option>
                                                    <option value="5">Agent</option>
                                                    <?php } ?>
                                                </select>
                                                <span class="error" id="agentRoleEditError"><?php echo form_error('access_Level'); ?></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Status:</label>
                                                <select class="form-control" name="agentStatus" id="agentStatusEdit" >
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                </select> 
                                                <span class="error" id="agentStatusEditError"></span>
                                            </div>
                                        </div> 
                                        
                                    </div> 
                                    <div class="form-group" id="salesAndProfitTrgetDiv">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Sales Target:</label>
                                                <input type="text" class="form-control" name="salesTarget" onkeypress="removeerror('salesTargetEditError',this.id);" id="targetSaleEdit">
                                                <span id="salesTargetEditError" class="error"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Profit Target:</label>
                                                <input type="text" class="form-control" name="profitTarget" onkeypress="removeerror('profitTargetEditError',this.id);" id="targetProfitEdit">
                                                <span class="error" id="profitTargetEditError"></span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                         <label>Last Name:</label>
                                         <input type="text" id="last_nameEdit" name="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control" tabindex="2" >
                                         <span class="error" id="last_nameEditError"><?php echo form_error('last_name'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>Phone:</label>
                                         <input type="text" id="phoneEdit" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control" tabindex="4" >
                                         <span class="error" id="phoneEditError"><?php echo form_error('phone'); ?></span>
                                    </div>
                                     <div class="form-group">
                                         <label>Login Name:</label>
                                         <input type="text" name="loginName" id="loginNameEdit" value="<?php echo set_value('loginName'); ?>" class="form-control" tabindex="6">
                                         <span class="error" id="loginNameEditError"><?php echo form_error('loginName'); ?></span>
                                    </div>
                                    <div class="form-group" id="companyDiv">
                                        <label>Company:</label>
                                        <select name="company" id="companyEdit" class="form-control" tabindex="9">
                                            <option value="">--Select Company--</option>
                                            <?php if($this->session->userdata('flag')==3){  ?>
                                            <?php if(!empty($company)){ foreach($company as $obj){ if($this->session->userdata('company')==$obj->id){ ?>
                                            <option value="<?php echo $obj->id; ?>"><?php echo $obj->company_name; ?></option>
                                            <?php } } } ?>
                                            <?php } else if($this->session->userdata('flag')==1){ ?>
                                            <?php if(!empty($company)){ foreach($company as $obj){ ?>
                                            <option value="<?php echo $obj->id; ?>"><?php echo $obj->company_name; ?></option>
                                            <?php } } } ?>
                                            
                                        </select>
                                        <span class="error" id="companyEditError"><?php echo form_error('company'); ?></span>
                                    </div> 
                                    
<!--                                    <div class="form-group">
                                         <label>Profile Pic:</label>
                                         <input type="file" name="profilepic_agent" id="profiePicEdit" class="form-control" tabindex="8">
                                    </div>
                                    <div class="form-group">
                                        <div style="width:150px !important;height: 150px !important;">
                                            <img src="" id="prewAgentEdit" style="width:150px !important;height: 100px !important;">
                                        </div>
                                    </div>-->
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" tabindex="10" style="margin-top: 5px;">Update</button>
                    <!-- <button type="button" class="btn btn-danger" tabindex="11" onclick="javascript:window.location='<?php  // echo site_url('User'); ?>'">Cancel</button> --> 
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function (e) {
	$("#agentAddForm").on('submit',(function(e) {
		e.preventDefault();
//                showLoder();
                var firstName = $.trim($('#first_name').val());
                var lastName = $.trim($('#last_name').val());
                var email = $('#email').val();
                var password = $('#password').val();
                var loginName = $.trim($('#loginName').val());
                var shiftStartTime = $('#agentShiftTimeStart').val();
                var shiftEndTime = $('#agentShiftTimeEnd').val();
                var role = $('#agentRole option:selected').val();
                var company = $('#company option:selected').val();
                var saleTarget = $.trim($('#targetSale').val());
                var profitTarget = $.trim($('#targetProfit').val());
                if(firstName=='')
                {
//                    alertify.alert('Enter The First Name');
                    $('#first_name').attr('style','border: 1px solid red');
                    $('#firstNameError').attr('style','color:red');
                    $('#firstNameError').text('Enter The First Name');
                    hideLoder();
                    return false;
                }
                if(lastName=='')
                {
                    $('#last_name').attr('style','border: 1px solid red');
                    $('#lastNameError').attr('style','color:red');
                    $('#lastNameError').text('Enter The Last Name');
                    hideLoder();
                    return false;
                }
                if(email=='')
                {
                   $('#email').attr('style','border: 1px solid red');
                    $('#emailError').attr('style','color:red');
                    $('#emailError').text('Enter The Email');
                    hideLoder();
                    return false; 
                }
                if(loginName=='')
                {
                   $('#loginName').attr('style','border: 1px solid red');
                   $('#loginNameError').attr('style','color:red');
                   $('#loginNameError').text('Enter The Login Name');
                   hideLoder();
                   return false;
                }
                if(password=='')
                {
                    $('#password').attr('style','border: 1px solid red');
                    $('#passError').attr('style','color:red');
                    $('#passError').text('Enter The Password');
                    hideLoder();
                    return false; 
                }
                if(shiftStartTime=='')
                {
                    $('#agentShiftTimeStart').attr('style','border: 1px solid red');
                    $('#shiftStartTimeError').attr('style','color:red');
                    $('#shiftStartTimeError').text('Select The Shift Start Time');
                    hideLoder();
                    return false; 
                }
                if(shiftEndTime=='')
                {
                   $('#agentShiftTimeEnd').attr('style','border: 1px solid red');
                   $('#shiftEndTimeError').attr('style','color:red');
                   $('#shiftEndTimeError').text('Select The Shift End Time');
                   hideLoder();
                   return false;  
                }
                if(role=='')
                {
                   $('#agentRole').attr('style','border: 1px solid red');
                   $('#accessLevelError').attr('style','color:red');
                   $('#accessLevelError').text('Select The Access Level');
                   hideLoder();
                   return false;
                }
                if(company=='')
                {
                   $('#company').attr('style','border: 1px solid red');
                   $('#companyError').attr('style','color:red');
                   $('#companyError').text('Select The Company Name');
                   hideLoder();
                   return false;
                }
                
                if(saleTarget=='')
                {
                   $('#saleTarget').attr('style','border: 1px solid red');
                   $('#salesTargetError').attr('style','color:red');
                   $('#salesTargetError').text('Enter The Sales Target');
                   hideLoder();
                   return false; 
                }
                if(profitTarget=='')
                {
                   $('#profitTarget').attr('style','border: 1px solid red');
                   $('#profitTargetError').attr('style','color:red');
                   $('#profitTargetError').text('Enter The Profit Target');
                   hideLoder();
                   return false; 
                }
                
		$.ajax({
        	url: ajaxUrl+'Agents/agentSave',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        $('#agentAddForm')[0].reset();
                        location.reload();
//			$("#targetLayer").html(data);
//			$("#targetLayer").css('opacity','1');
			setInterval(function() {$("#body-overlay").hide(); },500);
			},
		  	error: function() 
                        {
                            hideLoder();
                        } 	        
	   });
	}));
});
$(document).ready(function (e) {
	$("#agentEditForm").on('submit',(function(e) {
		e.preventDefault();
//                showLoder();
                var adminLevelsFlag=$('#adminLevelsFlag').val();
                var firstName = $.trim($('#first_nameEdit').val());
                var lastName = $.trim($('#last_nameEdit').val());
                var email = $('#emailEdit').val();
                var password = $('#passwordEdit').val();
                var loginName = $.trim($('#loginNameEdit').val());
                var shiftStartTime = $('#agentShiftTimeStartEdit').val();
                var shiftEndTime = $('#agentShiftTimeEndEdit').val();
                var role = $('#agentRoleEdit option:selected').val();
                var company = $('#companyEdit option:selected').val();
                var saleTarget = $.trim($('#targetSaleEdit').val());
                var profitTarget = $.trim($('#targetProfitEdit').val());
                if(firstName=='')
                {
//                    alertify.alert('Enter The First Name');
                    $('#first_name').attr('style','border: 1px solid red');
                    $('#firstNameError').attr('style','color:red');
                    $('#firstNameError').text('Enter The First Name');
                    hideLoder();
                    return false;
                }
                if(lastName=='')
                {
                    $('#last_name').attr('style','border: 1px solid red');
                    $('#lastNameError').attr('style','color:red');
                    $('#lastNameError').text('Enter The Last Name');
                    hideLoder();
                    return false;
                }
                if(email=='')
                {
                   $('#email').attr('style','border: 1px solid red');
                    $('#emailError').attr('style','color:red');
                    $('#emailError').text('Enter The Email');
                    hideLoder();
                    return false; 
                }
                if(loginName=='')
                {
                   $('#loginName').attr('style','border: 1px solid red');
                   $('#loginNameError').attr('style','color:red');
                   $('#loginNameError').text('Enter The Login Name');
                   hideLoder();
                   return false;
                }
                if(password=='')
                {
                    $('#password').attr('style','border: 1px solid red');
                    $('#passError').attr('style','color:red');
                    $('#passError').text('Enter The Password');
                    hideLoder();
                    return false; 
                }
                if(shiftStartTime=='' && adminLevelsFlag=='')
                {
                    $('#agentShiftTimeStart').attr('style','border: 1px solid red');
                    $('#shiftStartTimeError').attr('style','color:red');
                    $('#shiftStartTimeError').text('Select The Shift Start Time');
                    hideLoder();
                    return false; 
                }
                if(shiftEndTime=='' && adminLevelsFlag=='')
                {
                   $('#agentShiftTimeEnd').attr('style','border: 1px solid red');
                   $('#shiftEndTimeError').attr('style','color:red');
                   $('#shiftEndTimeError').text('Select The Shift End Time');
                   hideLoder();
                   return false;  
                }
                if(role=='' && adminLevelsFlag==' ')
                {
                   $('#agentRole').attr('style','border: 1px solid red');
                   $('#accessLevelError').attr('style','color:red');
                   $('#accessLevelError').text('Select The Access Level');
                   hideLoder();
                   return false;
                }
                if(company=='' && adminLevelsFlag=='')
                {
                   $('#company').attr('style','border: 1px solid red');
                   $('#companyError').attr('style','color:red');
                   $('#companyError').text('Select The Company Name');
                   hideLoder();
                   return false;
                }
                
                if(saleTarget=='' && adminLevelsFlag=='')
                {
                   $('#saleTarget').attr('style','border: 1px solid red');
                   $('#salesTargetError').attr('style','color:red');
                   $('#salesTargetError').text('Enter The Sales Target');
                   hideLoder();
                   return false; 
                }
                if(profitTarget=='' && adminLevelsFlag=='')
                {
                   $('#profitTarget').attr('style','border: 1px solid red');
                   $('#profitTargetError').attr('style','color:red');
                   $('#profitTargetError').text('Enter The Profit Target');
                   hideLoder();
                   return false; 
                }
                
		$.ajax({
        	url: ajaxUrl+'AgentBoxUpdate',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        //return false;
//                        $('#agentAddForm')[0].reset();
                        location.reload();
//			$("#targetLayer").html(data);
//			$("#targetLayer").css('opacity','1');
			setInterval(function() {$("#body-overlay").hide(); },500);
			},
		  	error: function() 
                        {
                            hideLoder();
                        } 	        
	   });
	}));
});
</script>