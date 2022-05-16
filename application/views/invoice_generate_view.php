<title><?php if(!empty($pageTitle)){ echo $pageTitle;  } ?></title>
<div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>Invoice Generate</h3>
                      <!--<h3>Booking Details <?php //echo $companyCode; ?></h3>-->
                    </div>
                    <div class="title_right hidden-xs">
                        <a class="btn btn-danger btn-round pull-right" href="<?php echo site_url('Pending'); ?>">Back</a>
                    </div>
                </div>
    <div class="row">
        <form method="post" action="<?php echo base_url() ?>Invoice/pdf_invoice">
            <input type="hidden" name="booing" value="<?php echo $bookingId; ?>">
            <table class="table table-condensed" width="100%" >
                <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Airline</th>
                        <th>Flight No</th>
                        <th>Dept Date</th>
                        <th>Dept Time</th>
                        <th>Arr Date</th>
                        <th>Arr Time</th>
                    </tr>
                </thead>
                <tbody id="segContainer">
                    
                </tbody>
                <button type="button" class="btn btn-primary pull-right btn-round" onclick="addSegment()">Add Segment</button>
            </table>
            
            <button type="submit" class="btn btn-primary">Generate</button>
        </form>
    </div>
</div>
<script>
    $(function()
    {
        
        
    });
//    $(document).on('load','.airline',function(ev){
//    $( ".airline" ).autocomplete({
//           source: '<?php echo base_url() ?>Ajax/airlinetypeHead'
//        });
//    });
function addSegment()
{
    var seg_tr=document.getElementById('segContainer');
    var tr = document.createElement("tr");
     showLoder();
    tr.innerHTML='<td><input type="text" class="form-control from" name="seg_from[]"></td><td><input type="text" class="form-control to" name="seg_to[]"></td>\n\
     <td><input type="text" class="form-control airline" name="seg_airline[]"></td><td><input type="text" class="form-control" name="seg_flightNo[]"></td>   \n\
    <td><input type="text" class="form-control nextDueDate  " name="seg_dep_Date[]"></td> <td><input type="text" class="form-control timeClass" name="seg_dep_time[]"></td>\n\
    <td><input type="text" class="form-control nextDueDate  " name="seg_arr_Date[]"></td><td><input type="text" class="form-control timeClass" name="seg_arr_time[]"></td>';
     
        seg_tr.appendChild(tr);
        $( ".airline" ).autocomplete({
           source: '<?php echo base_url() ?>Ajax/airlinetypeHead'
        });
        $( ".from" ).autocomplete({
             source: '<?php echo base_url() ?>Ajax/departTypehead'
        });
        $( ".to" ).autocomplete({
            source: '<?php echo base_url() ?>Ajax/destiTypeHead'
        });
        $('.nextDueDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
        $('.timeClass').timepicker({
                 showMeridian:false
             });
    hideLoder();
}
</script>