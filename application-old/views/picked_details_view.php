<title><?php if(!empty($pageTitle)){ echo $pageTitle; } ?></title>
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
                      <h3>Picked Inquiry Details</h3>
                    </div>
                    <div class="title_right">
                        <a class="btn btn-danger btn-round pull-right" href="<?php echo site_url('picked'); ?>">Back</a>
                    </div>
                </div>
                <div class="page-header"></div>
                <div class="clearfix"></div>
                <?php if(!empty($record)){ 
                    //print_r($record);
                    $obj=$record[0];
                    } ?>
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
                <div class="row colorr">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="">
                             <h4>Customer Inquiry</h4>
                             <table id="bsc" class="table-striped" width="100%">
                                <tr>
                                    <th>Inquiry ID:&nbsp;</th>
                                    <td>&nbsp;<?php echo $obj->id; ?></td>
                                    <th>Time Received:&nbsp;</th>
                                    <td>&nbsp;<?php echo $obj->enquiry_date; ?></td>
                                </tr>
                                <tr>
                                    <th>Picked BY:&nbsp;</th>
                                    <td id="agnt">&nbsp;<?php echo idToName('admin','id',$obj->picked_by,'login_name'); ?></td>
                                    <th>Time Pick :&nbsp;</th>
                                    <td>&nbsp;<?php echo $obj->picked_time; ?></td>
                                </tr>
                            </table>
                             <br>
                             <div class="row">
                                <form method="post">  
                                <div class="col-md-8">
                                    <textarea style="margin-left: 1%;" rows="1" name="comments" required id="msg" class="form-control" placeholder="Comments"></textarea>
                                    <input type="hidden" id="inquiryID" name="in_id" value="<?php echo $obj->id;  ?>" >
                                </div>
                                    <div class="col-md-2 offset-2">
                                        <button style="margin-left: 7px;" type="button"  name="save" id="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                               </div>
                             <div class="row">
                                <div id="commentsDiv" class="col-md-8 offset-4" style="margin-left:1%;">
                                    <?php if(!empty($commentData))
                                        {
                                            foreach($commentData as $comObj)
                                            {
                                                ?>
                                            <label style='margin-left:1%;'><b>(<?php echo idToName('admin','id',$comObj->agent_id,'login_name'); ?>)&nbsp;</b><?php echo $comObj->remakts; ?>&nbsp;<b><?php echo '('.$comObj->remarks_time.')'; ?></b></label><br>
                                                <?php 
                                            }
                                        } 
                                        ?>
                                </div>
                             </div>
                             <div class="page-header"></div>
                        </div>
                        <h5 style="margin-left: 1%;"><u><b>Inquiry Detail</b></u></h5>
                        <br>
                        Flight Search <small>()</small>
                        <br>
                        <table class="table-striped" width="100%">
                            <tr>
                                <td colspan="2"><u><b>Flight Detail</b></u></td>
                            </tr>
                            <tr>
                                <td>Departure Airport &nbsp;&nbsp; :&nbsp;&nbsp;</td>
                                <td><?php echo $obj->flight_from; ?></td>
                            </tr>
                            <tr>
                                <td>Destination &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                <td><?php echo $obj->destination; ?></td>
                            </tr>
                            
                            <tr>
                                <td>Departure Date &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                <td><?php echo $obj->departure_date; ?></td>
                            </tr>
                            <tr>
                                <td>Return Date &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                <td><?php echo $obj->return_date; ?></td>
                            </tr>
                            <br>
                            <tr>
                             <td colspan="2"><u><b>Contact Detail</b></u></td>
                            </tr>
                             <tr>
                                <td>Name:</td>
                                <td><?php echo $obj->name; ?></td>
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
                                <td>Customer Instruction :</td>
                                <td><?php echo $obj->customer_instr; ?></td>
                            </tr>
                              <tr>
                                <td colspan="2"><u><b>Preference</b></u></td>
                            </tr>
                            <tr>
                                 <td>Prefered Airline &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                <td><?php echo $obj->prefered_airline; ?></td>
                            </tr>
                            <tr>
                                <td>Ticket Type &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                <td><?php echo $obj->ticket_type; ?></td>
                            </tr>
                             <tr>
                                <td>Ticket Class &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                <td><?php echo $obj->ticket_class; ?></td>
                            </tr>
                              <tr>
                                <td>Fare &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                <td><?php echo $obj->fare; ?></td>
                            </tr>
                             <tr>
                                <td colspan="2"><u><b>Passenger Detail</b></u></td>
                            </tr>
                             <tr>
                                 <td>Adult &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                 <td><?php echo $obj->adult; ?></td>
                             </tr>
                              <tr>
                                 <td>Child &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                 <td><?php echo $obj->child; ?></td>
                             </tr>
                              <tr>
                                 <td>Infant &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                 <td><?php echo $obj->infaunt; ?></td>
                             </tr>
                            <tr>
                                <td>Inquiry Status:</td>
                                <td><?php echo $obj->status; ?></td>
                            </tr>
                        </table>
                        <br>
                    </div> 
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-danger btn-round" onclick="javascript:window.location='<?php echo site_url('picked') ?>'">Back</button> 
                            &nbsp;&nbsp;
                            <?php if($this->session->userdata('flag')==1){ ?>
                            <button type="button" class="btn btn-danger btn-round" onclick="inquiryDelete(<?php echo $obj->id ?>)">Delete</button> &nbsp;&nbsp;
                            <button type="button" class="btn btn-primary btn-round" onclick="inquiryAssignModal(<?php echo $obj->id ?>)" title="Assign To" data-toggle="tooltip">Assign To</button>
                            <?php } ?>
                            <br>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
<!-- /page content -->
