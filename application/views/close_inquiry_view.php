<title>Closed Inquiries</title>
<!-- page content -->
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Closed Inquiries</h3>
                    </div>
                    <div class="title_right">
                        <!--<a class="btn btn-primary btn-round pull-right" href="#">Create Follow Up</a>-->
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example" class="display nowrap" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr.#</th>
                                    <th>Inquiry Date</th>
                                    <th>Inquiry ID</th>
                                    <th>Inquiry Title</th>
                                    <th>Comments</th>
                                    <th>Contact No</th>
                                    <th>Picked By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
<!--                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot>-->
                            <tbody>
                                <?php if(!empty($records)){ $j=1;foreach($records as $obj){?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php $j++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>               
            </div>
<!-- /page content -->
