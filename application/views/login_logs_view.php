<title>Login History</title>
<style>
    table.display tbody tr td{
        border: 1px solid #b7b7b7;
        padding: 5px;
    }
    table.display tbody tr td, table.display tfoot tr td{
        border: 1px solid #b7b7b7;
        padding: 5px;
    }
    .inner-addon { position: relative; }  
    .inner-addon .glyphicon { 
        position: absolute; 
        padding: 10px; 
        pointer-events: none;  
        z-index: 99;
        background: none;
        border: 0px;
        top: -2px;
        cursor: text;
        font-size: 17px;  
    }  
    .left-addon .glyphicon  { left:  0px;}
    .right-addon .glyphicon { right: 0px;} 
    .left-addon input  { padding-left:  30px; }
    .right-addon input { padding-right: 30px; cursor: pointer !important; } 
    .vertical-align-bottom { vertical-align: bottom !important; }
    .input-group {margin-bottom: 0px;}
    .input-group input { width: 135px !important; }
    .ui-datepicker-month, .ui-datepicker-year {
        color: black;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>Login history</h3>
        </div>
        <div class="title_right">
<!--            <a class="btn btn-primary pull-right" href="<?php echo site_url('Newuser'); ?>">Add New Agent</a>-->
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <form action="" class="form-inline">
                <label for="">Month:</label>
                <div class="input-group"> 
                    <div class="inner-addon right-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input type="text" class="form-control monthPicker" id="Odate"> 
                    </div>
                </div> 
                 
                <label for="">&nbsp;&nbsp;&nbsp;User:</label>
                <select name="" id="" class="form-control">
                    <option selected="selected" value="select">Select from List</option> 
                    <option selected="" value="41">Admin</option>
                    <option value="42">Accounts</option>
                    <option value="43">Alex</option>
                    <option value="44">James</option>
                    <option value="45">Chris</option>
                    <option value="46">Shaw</option>
                    <option value="48">Max</option>
                    <option value="49">Peter</option>
                    <option value="50">Jason</option>
                </select>
                <button type="button" class="btn btn-info btn-sm" style="margin-top: 7px;margin-left: 10px;">Submit</button> 
            </form>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table id="example" class="display nowrap tablColor" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                        <th class="text-center">S.No</th>
                        <th class="text-center">Date Time</th>
                        <th class="text-center">Device</th>
                        <th width="150" class="text-center">Os</th> 
                        <th width="200" class="text-center">Browser</th>
                        <th class="text-center">Ip</th>
                        <th width="115" class="text-center">Agent</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    if(!empty($logData)){
                        $j=1;
                        foreach($logData as $log){
                    ?>
                    <tr>
                        <td><?php echo $j; ?></td>
                        <td><?php echo date('d-M h:m a',strtotime($log->logingTime)); ?></td>
                        <td><?php echo $log->device; ?></td>
                        <td><?php echo $log->os; ?></td>
                        <td><?php echo $log->broswer; ?></td>
                        <td><?php echo $log->ip; ?></td>
                        <td><?php echo idToName('admin','id',$log->agent_Id,'login_name'); ?></td>
                    </tr>
                    <?php $j++; } } ?>
                </tbody>
            </table>
        </div>
    </div>               
</div>
<!-- /page content -->
<script>
    $(document).ready(function() {
    //     $('#Odate').datepicker({
    //     viewMode: 'years',
    //      format: 'mm-yyyy'
    // });
     $(".monthPicker").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });

    $(".monthPicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    });
</script>