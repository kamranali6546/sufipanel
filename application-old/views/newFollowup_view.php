<title>Create Follow Up</title><!-- page content -->
<style>
    .error
    {
        color:red !important;
    }
    @media screen and (max-width: 425px) {
    body .container.body .right_col {
        padding: 10px 13px !important;
    }
}
</style>
            <div class="right_col" role="main">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <h3>Create Follow Up</h3>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <a class="btn btn-primary btn-round pull-right" href="<?php echo site_url('followup'); ?>">Back</a>
                    </div>
                </div>
               <br><br>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <?php if(!empty($errormessage)){ ?>
                        <div class="alert alert-danger alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><?php if(!empty($errormessage)){ echo $errormessage; } ?></strong>
                        </div>
                        <?php } ?>
                    </div>
                </div> 
                <style type="text/css">
                    
                </style>
                <form method="post" action="<?php echo site_url('FollowupSave'); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                   <div class="form-group PR">
                                        <span class='blocking-span'> 
                                            <input type="text" id="departairport" class="form-control input-lg" value="<?php echo set_value('depart_form'); ?>" name="depart_form" tabindex="1" required autofocus="">
                                            <span class="floating-label">Flight From:</span>
                                            <span class="error"><?php echo form_error('depart_form'); ?></span>
                                        </span>
                                    </div> 
                                    <div class="form-group PR">
                                        <span class='blocking-span'> 
                                            <input type="text" id="deptDate"  class="form-control input-lg" name="departt_date" value="<?php echo set_value('departt_date') ?>" tabindex="3" required>
                                            <span class="floating-label">Depart Date:</span>
                                            <span class="error"><?php echo form_error('departt_date'); ?></span>
                                        </span>
                                    </div>
                                    <div class="form-group PR">
                                        <span class='blocking-span'> 
                                            <input type="text" name="airline" id="airline" value="<?php echo set_value('airline'); ?>" class="form-control input-lg" tabindex="10" required>
                                            <span class="floating-label">Prefered Airline:</span>
                                            <span class="error"></span>
                                        </span>
                                    </div>
                                    <div class="form-group" style="margin-top:10px !important">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group PR">
                                                    <span class='blocking-span'> 
                                                        <input type="text" id="" class="form-control input-lg" name="cost_price" value="<?php echo set_value('cost_price');  ?>" tabindex="11" required>
                                                        <span class="floating-label">Cost Price:</SPAN>
                                                        <span class="error"><?php echo form_error('cost_price'); ?></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group PR">
                                                    <span class='blocking-span'>  
                                                        <input type="text" id="" class="form-control input-lg" name="sale_price" value="<?php echo set_value('sale_price'); ?>" tabindex="12" required>
                                                        <span class="floating-label">Sale Price:</SPAN>
                                                        <span class="error"><?php echo form_error('sale_price'); ?></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group PR">
                                        <span class='blocking-span'>  
                                            <input type="text" name="customer_name" id="customer_name" value="<?php echo set_value('customer_name'); ?>" class="form-control input-lg MT-10" tabindex="13" required>
                                            <span class="floating-label">Customer Name:</span>
                                            <span class="error"><?php echo form_error('customer_name'); ?></span>
                                        </span>
                                    </div>
                                    <div class="form-group PR">
                                        <span class='blocking-span'>  
                                            <input type="text" id="" class="form-control input-lg" name="contact_number2" value="" tabindex="6" required>
                                            <span class="floating-label">Secondary Phone:</span>
                                            <span class="error"></span>
                                        </span>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4 col-xs-12">
                                                <div class="form-group PR">
                                                    <span class='blocking-span'> 
                                                        <input type="text" id="adult" name="adult" class="form-control input-lg" value="<?php echo set_value('adult'); ?>" tabindex="7" required>
                                                        <span class="floating-label">Adult:</span>
                                                        <span class="error"><?php echo form_error('adult'); ?></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                               <div class="form-group PR">
                                                    <span class='blocking-span'>  
                                                         <input type="text" id="child" name="child" class="form-control input-lg" value="<?php echo set_value('child'); ?>" tabindex="8" >
                                                         <span class="floating-label">Child:</span>
                                                        <span class="error"><?php echo form_error('child'); ?></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                                <div class="form-group PR">
                                                    <span class='blocking-span'>  
                                                        <input type="text" id="infant" name="infant" value="<?php echo set_value('infant'); ?>" class="form-control input-lg" tabindex="9" >
                                                        <span class="floating-label">Infant:</span>
                                                        <span class="error"><?php echo form_error('infant'); ?></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group PR">
                                        <span class='blocking-span'>   
                                            <input type="text" id="destiairport" class="form-control input-lg" name="destination" value="<?php echo set_value('destination'); ?>" tabindex="2" required>
                                            <span class="floating-label">Flight To:</span>
                                            <span class="error"><?php echo form_error('destination'); ?></span>
                                        </span>
                                    </div>
                                    <div class="form-group PR">
                                        <span class='blocking-span'>
                                            <input type="text" id="returnDate"  name="return_date" value="<?php echo set_value('return_date'); ?>" class="form-control input-lg" tabindex="4" required>
                                            <span class="floating-label">Return Date:</span>
                                            <span class="error"><?php echo form_error('return_date'); ?></span>
                                        </span>
                                    </div>
                                    <div class="form-group PR">
                                        <span class='blocking-span'>  
                                            <input type="text" id="pnr" class="form-control input-lg" name="pnr" value="<?php echo set_value('pnr'); ?>" tabindex="14" required>
                                            <span class="floating-label">PNR:</SPAN>
                                            <span class="error"></span>
                                        </span>
                                    </div> 
                                    <div class="form-group PR">
                                        <span class='blocking-span'>  
                                            <input type="text" id="" class="form-control input-lg" name="passanger" value="" tabindex="6" required>
                                            <span class="floating-label">Passangers:</span>
                                            <span class="error"></span>
                                        </span>
                                    </div>
                                    <div class="form-group PR">
                                        <span class='blocking-span'>  
                                            <input type="text" id="contact_number" class="form-control input-lg" name="contact_number" value="<?php echo set_value('contact_number'); ?>" tabindex="6" required>
                                            <span class="floating-label">Primary Phone:</span>
                                            <span class="error"><?php echo form_error('contact_number'); ?></span>
                                        </span>
                                    </div>


                                    
                                    <div class="form-group PR">
                                        <span class='blocking-span'>  
                                            <input type="email" id="" class="form-control input-lg" name="email" value="<?php echo set_value('email'); ?>" tabindex="5" required>
                                            <span class="floating-label">Customer Email:</span>
                                            <span class="error"><?php echo form_error('email'); ?></span>
                                        </span>
                                    </div>
                                    <div class="form-group PR">
                                        <span class='blocking-span'>   
                                            <textarea id="comments" class="form-control MT-10" style="margin-top: 0px !important" name="comments" tabindex="15" required><?php echo set_value('comments') ?></textarea>
                                            <span class="floating-label">Comments:</span>
                                            <span class="error"></span>
                                        </span>
                                    </div>
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" name="" class="btn btn-primary btn-round pull-right">Save</button> 
                                    &nbsp;&nbsp;
                                    <button type="button" onclick="javascript:window.location='<?php echo site_url('followup'); ?>'" class="btn btn-danger btn-round pull-right">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                </form>
            </div>
<!-- /page content -->
<!-- <script type="text/javascript">
    $(document).ready(function) { 
        
    });
</script> -->