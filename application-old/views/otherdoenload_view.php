<!-- page content -->
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Email Back Up </h3>
                    </div>
                    <div class="title_right">
                        <!--<a class="btn btn-primary btn-round pull-right" href="#">Create Follow Up</a>-->
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="well">
                    <form method="Post" action="<?php echo base_url('Inquiry/otherDownloadSheet') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date:</label>
                                        <input type="text" id="startDate" readonly="" name="startDate" placeholder="" required="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date:</label>
                                        <input type="text" id="endDate" readonly="" name="endDate" placeholder="" required="" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="button" class="btn btn-danger btn-round pull-right" onclick="javascript:window.location='<?php echo site_url("emailBackup"); ?>'">Cancel</button>&nbsp;
                                    <button type="submit"  class="btn btn-primary btn-round pull-right">Start</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
<!-- /page content -->
