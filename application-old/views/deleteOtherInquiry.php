
<!-- page content -->
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Delete Inquiry</h3>
                    </div>
                    <div class="title_right">
                        <!--<a class="btn btn-primary btn-round pull-right" href="#">Create Follow Up</a>-->
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="well">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date:</label>
                                        <input type="text" name="startDate" readonly="" id="startDate" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date:</label>
                                        <input type="text" name="endDate" readonly="" id="endDate" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <button id="delButton" type="button" onclick="getinquiryForDelete()" class="btn btn-primary btn-round">Get Inquiry Selected Date</button> &nbsp;
                                    <button type="button" class="btn btn-danger btn-round" onclick="javascript:window.location='<?php echo site_url("emailBackup"); ?>'">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post">
                            <div id="responsiveDiv">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div id="deleteButtonDiv">
                            <button style="display: none" type="button" class="btn btn-danger btn-round" id="btnDeleteConfirm" onclick="confirmDeleteinquiry()">Delete Now</button>
                        </div>
                    </div>
                </div>
            </div>
<!-- /page content -->
