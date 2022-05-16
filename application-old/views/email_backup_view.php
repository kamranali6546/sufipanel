<title>Email Back Up</title>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <form method="Post" action="<?php echo base_url('Inquery/OtherDownloadBoxSheet') ?>"><input type="hidden" name="startDate" value="<?php echo date('Y-m-01'); ?>"><input type="hidden" name="endDate" value="<?php echo date('Y-m-31'); ?>"> <button type="submit" name="" class="btn btn-primary btn-round" >Start Download <?php echo date('M'); ?></button></form>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary btn-round" onclick="javascript:window.location='<?php echo site_url('Inquery/OtherDownloadBox'); ?>'">For other Month Select Date</button>
                                </div>
                                <?php if($this->session->userdata('flag')==1){ ?>
                                <div class="col-md-4">
                                    <button type="button" onclick="javascript:window.location='<?php echo site_url('OtherDeleteBox'); ?>'" class="btn btn-danger btn-round">Delete For Other Month Select Date</button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- /page content -->
