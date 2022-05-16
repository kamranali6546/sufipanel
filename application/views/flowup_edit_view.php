<!-- page content -->
<style>
    .error
    {
        color:red !important;
    }
    
</style>
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Edit Follow Up</h3>
                    </div>
                    <div class="title_right">
                        <a class="btn btn-danger btn-round pull-right" href="<?php echo site_url('followup'); ?>">Back</a>
                    </div>
                </div>
                <div class="page-header"></div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <?php if(!empty($record)){ $obj=$record[0]; }  if(!empty($errormessage)){ ?>
                        <div class="alert alert-danger alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><?php if(!empty($errormessage)){ echo $errormessage; } ?></strong>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <form method="post" action="<?php echo site_url('FlowupUpdaeBox'); ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <?php if($obj){
                        if(!empty($obj->customer_phone))
                        {
                            $phoneArray=  explode(',', $obj->customer_phone);
                        }
                    } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Flight From:</label>
                                        <input type="text" id="departairport" class="form-control" value="<?php if($obj){ echo $obj->flight_from; } ?>" name="depart_form" tabindex="1" autofocus="">
                                        <span class="error"><?php echo form_error('depart_form'); ?></span>
                                    </div> 
                                    <div class="form-group">
                                        <label>Return Date:</label>
                                        <input type="text" id="returnDate" name="return_date" value="<?php if($obj){ echo $obj->return_date; } ?>" class="form-control" tabindex="4">
                                        <span class="error"><?php echo form_error('return_date'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Cost Price:</label>
                                                    <input type="text" id="" class="form-control" name="cost_price" value="<?php if($obj){ echo $obj->cost_price; }  ?>" tabindex="11">
                                                    <span class="error"><?php echo form_error('cost_price'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sale Price:</label>
                                                    <input type="text" id="" class="form-control" name="sale_price" value="<?php if($obj){ echo $obj->sale_price; } ?>" tabindex="12">
                                                    <span class="error"><?php echo form_error('sale_price'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <label>Primary Phone:</label>
                                        <input type="text" id="contact_number" class="form-control" name="contact_number" value="<?php if(array_key_exists(0, $phoneArray)){ echo $phoneArray[0]; } ?>" tabindex="6">
                                        <span class="error"><?php echo form_error('contact_number'); ?></span>
                                    </div>
                                     
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Adult:</label>
                                                    <input type="text" id="adult" name="adult" class="form-control" value="<?php if($obj){ echo $obj->adult; } ?>" tabindex="7">
                                                    <span class="error"><?php echo form_error('adult'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                               <div class="form-group">
                                                     <label>Child:</label>
                                                     <input type="text" id="child" name="child" class="form-control" value="<?php if($obj){ echo $obj->child; } ?>" tabindex="8">
                                                    <span class="error"><?php echo form_error('child'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Infant:</label>
                                                    <input type="text" id="infant" name="infant" value="<?php if($obj){ echo $obj->infaunt; } ?>" class="form-control" tabindex="9">
                                                    <span class="error"><?php echo form_error('infant'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Flight To:</label>
                                        <input type="text" id="destiairport" class="form-control" name="destination" value="<?php if($obj){ echo $obj->destination; } ?>" tabindex="2">
                                        <span class="error"><?php echo form_error('destination'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Prefered Airline:</label>
                                        <input type="text" name="airline" id="airline" value="<?php if($obj){ echo $obj->prefered_airline; } ?>" class="form-control" tabindex="10">
                                        <span class="error"></span>
                                    </div>
                                     <div class="form-group">
                                        <label>Passangers:</label>
                                        <input type="text" id="" class="form-control" name="passanger" value="<?php if($obj){ echo $obj->number_of_passanger; } ?>" tabindex="5">
                                        <span class="error"><?php //echo form_error('email'); ?></span>
                                    </div>
                                   <div class="form-group">
                                        <label>Secondary Phone:</label>
                                        <input type="text" id="" class="form-control" name="contact_number2" value="<?php if(array_key_exists(1, $phoneArray)){ echo $phoneArray[1]; } ?>" tabindex="6">
                                        <span class="error"><?php //echo form_error('contact_number'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Comments:</label>
                                        <textarea id="comments" class="form-control" name="comments" tabindex="15"><?php if(!empty($lastComment)){ echo $lastComment[0]->remakts; } ?></textarea>
                                        <span class="error"><?php echo set_value('comments') ?></span>
                                    </div>
                                    <?php
                                    $lastcomentId='';
                                    if(!empty($lastComment))
                                    {
                                        $lastcomentId=$lastComment[0]->id;
                                        
                                    }
                                    ?>
                                    <input type="hidden" name="commentId" value="<?php echo $lastcomentId; ?>" >
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Departure Date:</label>
                                        <input type="text" id="deptDate" class="form-control" name="departt_date" value="<?php if($obj){ echo $obj->departure_date; } ?>" tabindex="3">
                                        <span class="error"><?php echo form_error('departt_date'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>PNR:</label>
                                        <input type="text" id="pnr" class="form-control" name="pnr" value="<?php if($obj){ echo $obj->pnr; } ?>" tabindex="14">
                                        <span class="error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Customer Name:</label>
                                        <input type="text" name="customer_name" id="customer_name" value="<?php if($obj){ echo $obj->name; } ?>" class="form-control" tabindex="13">
                                        <span class="error"><?php echo form_error('customer_name'); ?></span>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label>Customer Email:</label>
                                        <input type="email" id="" class="form-control" name="email" value="<?php if($obj){ echo $obj->customer_email; } ?>" tabindex="5">
                                        <span class="error"><?php echo form_error('email'); ?></span>
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