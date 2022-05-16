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
                      <h3>Inquiry Detail</h3>
                    </div>
                    <div class="title_right">
                        <a class="btn btn-danger btn-round pull-right" href="#">Back</a>
                    </div>
                </div>
                <div class="page-header"></div>
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
                <div class="row">
                    <div class="col-md-12">
                                
                    </div>
                </div>  
            </div>
<!-- /page content -->
