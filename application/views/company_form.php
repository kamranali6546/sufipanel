<title>New Company</title><!-- page content -->
<style>
    .error
    {
        color: #ff0000 !important;
    }
</style>
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>New Brand</h3>
                    </div>
                    <div class="title_right">
                        <a class="btn btn-danger pull-right" href="#" onclick="javascript:window.location='<?php echo site_url('Agencies'); ?>'">Back</a>
                    </div>
                </div>
                 <div class="page-header"></div>
                <div class="clearfix"></div>
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
                                    <label>Contact Number:</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone') ?>" tabindex="5" >
                                     <span class="error"><?php echo form_error('phone'); ?></span>
                                </div>
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
                                    <input type="file" name="companylogo" id="companylogo" accept="image/*" class="form-control" tabindex="4">
                                     <span class="error"><?php if(!empty($imgerror)){ echo $imgerror; } ?></span>
                                </div>
                                <div class="form-group">
                                    <div style="width:150px !important;height: 150px !important;">
                                        <img src="" id="prew" style="width:150px !important;height: 100px !important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group pull-left">
                                    <button type="submit" name="saveCompany" class="btn btn-primary">Save</button> &nbsp; &nbsp;
                                    <button type="button" class="btn btn-danger" onclick="javascript:window.location='<?php echo site_url('Agencies'); ?>'">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
              </form>
            </div>
<!-- /page content -->
