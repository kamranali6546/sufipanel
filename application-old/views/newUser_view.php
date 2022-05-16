<title>New Agents</title><style>
    .error
    {
        color:#ff0000;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>New Agents</h3>
        </div>
        <div class="title_right">
            <a class="btn btn-danger pull-right" href="<?php echo site_url('User'); ?>">Back</a>
        </div>
    </div>
     <div class="page-header"></div>
    <div class="clearfix"></div>
    <?php if(!empty($errorSave)){ echo $errorSave; } ?>
    <form method="post" action="<?php echo site_url('UserSave'); ?>" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name:</label>
                        <input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control" tabindex="1" autofocus="">
                        <span class="error"><?php echo form_error('first_name'); ?></span>
                    </div>
                     <div class="form-group">
                         <label>Email:</label>
                         <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control" tabindex="3" >
                         <span class="error"><?php echo form_error('email'); ?></span>
                    </div>
                     <div class="form-group">
                         <label>CNIC#:</label>
                         <input type="text" id="cnic" name="cnic" value="<?php echo set_value('cnic'); ?>" class="form-control" tabindex="5" >
                         <span class="error"><?php echo form_error('cnic'); ?></span>
                    </div>
                     <div class="form-group">
                         <label>Password:</label>
                         <input type="password" id="password"  name="password" value="<?php echo set_value('password'); ?>" class="form-control" tabindex="7">
                         <span class="error"><?php echo form_error('password'); ?></span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Shift Time Start :</label>
                                <input type="text" name="shift_time_start" readonly="" class="form-control" id="agentShiftTimeStart">
                            </div>
                            <div class="col-md-6">
                                <label>Shift Time End :</label>
                                <input type="text" name="shift_time_end" class="form-control" readonly="" id="agentShiftTimeEnd">
                            </div>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label>Access Level:</label>
                        <select class="form-control" name="access_Level" id="" required="">
                            <option value="">--Select One--</option>
                            <option value="2">Account</option>
                            <option value="3">Sub-Company Admin</option>
                            <option value="4">Manger</option>
                            <option value="5">Agent</option>
                        </select>
                        <span class="error"><?php echo form_error('access_Level'); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                         <label>Last Name:</label>
                         <input type="text" id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control" tabindex="2" >
                         <span class="error"><?php echo form_error('last_name'); ?></span>
                    </div>
                     <div class="form-group">
                         <label>Phone:</label>
                         <input type="text" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control" tabindex="4" >
                          <span class="error"><?php echo form_error('phone'); ?></span>
                    </div>
                     <div class="form-group">
                         <label>Login Name:</label>
                         <input type="text" name="loginName" id="loginName" value="<?php echo set_value('loginName'); ?>" class="form-control" tabindex="6">
                          <span class="error"><?php echo form_error('loginName'); ?></span>
                    </div>
                     <div class="form-group">
                        <label>Company:</label>
                        <select name="company" id="company" class="form-control" tabindex="9" required="">
                            <option value="">--Select Company--</option>
                            <?php if(!empty($company)){ foreach($company as $obj){ ?>
                            <option value="<?php echo $obj->id; ?>"><?php echo $obj->company_name; ?></option>
                            <?php } } ?>
                            
                        </select>
                        <span class="error"><?php echo form_error('company'); ?></span>
                    </div>
                    <div class="form-group">
                         <label>Profile Pic:</label>
                         <input type="file" name="profilepic_agent" id="profiePic" class="form-control" tabindex="8">
                    </div>
                    <div class="form-group">
                        <div style="width:150px !important;height: 150px !important;">
                            <img src="" id="prewAgent" style="width:150px !important;height: 100px !important;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary" tabindex="10">Save</button> &nbsp; &nbsp;
                        <button type="button" class="btn btn-danger" tabindex="11" onclick="javascript:window.location='<?php echo site_url('User'); ?>'">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
  </form>
</div>
<!-- /page content -->
