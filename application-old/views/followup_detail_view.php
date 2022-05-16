<!-- page content -->
<style>
    .error
    {
        color:red !important;
    }
    .colorr
    {
           color: #9400d3;
    }
    table > tbody > tr > td
    {
        padding: 5px;
    }
</style>
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Follow Up Details</h3>
                    </div>
                    <div class="title_right">
                        <a class="btn btn-danger btn-round pull-right" href="<?php echo site_url('followup'); ?>">Back</a>
                    </div>
                </div>
                <div class="page-header"></div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <?php
                        if(!empty($record))
                            {
                                $obj=$record[0];
                            }
                        ?>
                        <?php if(!empty($errormessage)){ ?>
                        <div class="alert alert-danger alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><?php if(!empty($errormessage)){ echo $errormessage; } ?></strong>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row colorr">
                    <div class="col-md-10 col-md-offset-1">
                        <h4 style="text-align: center;">Customer Inquiry</h4>
                        <table class="table-striped" width="100%">
                            <tr>
                                <th>Inquiry ID:</th>
                                <td><?php echo $obj->id; ?></td>
                                <th>Time Received:</th>
                                <td><?php echo $obj->enquiry_date; ?></td>
                            </tr>
                            <tr>
                                <th>Picked BY:</th>
                                <td><?php  echo idToName('admin','id',$obj->picked_by,'login_name'); ?></td>
                                <th>Time Pick :</th>
                                <td><?php echo $obj->picked_time; ?></td>
                            </tr>
                        </table>
                        <br>
                        <h4 style="text-align: center;">Inquiry Details:</h4>
                         <table class="table-striped" width="100%">
                                <tr>
                                    <td colspan="2" style="text-align: center;">Flight Search <small>()</small></td>
                                </tr>
                                <br>
                                <tr>
                                    <td colspan="2"><b>Flight Details:</b></td>
                                </tr>
                                <tr>
                                    <td>Destination :</td>
                                    <td><?php echo $obj->destination; ?></td>
                                </tr>
                                <tr>
                                    <td>Departure Airport :</td>
                                    <td><?php echo $obj->flight_from; ?></td>
                                </tr>
                                <tr>
                                    <td>Departure Date:</td>
                                    <td><?php echo $obj->departure_date; ?></td>
                                </tr>
                                <tr>
                                    <td>Return Date:</td>
                                    <td><?php echo $obj->return_date; ?></td>
                                </tr>
                                <br>
                                <tr>
                                    <td style="text-align: center;" colspan="2">Contact Details:</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><?php echo $obj->customer_email; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone #:</td>
                                    <td><?php echo $obj->customer_phone; ?></td>
                                </tr>
                                <tr>
                                    <td>Inquiry Title:</td>
                                    <td><?php echo $obj->enquiry_title; ?></td>
                                </tr>
                                <tr>
                                    <td>Customer Message:</td>
                                    <td><?php echo $obj->customer_instr; ?></td>
                                </tr>

                                <tr>
                                    <td>Inquiry Status:</td>
                                    <td></td>
                                </tr>
                        </table>
                    </div> 
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                           <!-- <button type="button" class="btn btn-primary btn-round">Close</button>-->
                        </div>
                    </div>
                </div>
                
            </div>
<!-- /page content -->
