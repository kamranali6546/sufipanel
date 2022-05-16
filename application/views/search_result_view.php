<title>Search Result</title>

<style type='text/css'>
table.dataTable tfoot th, table.dataTable tfoot td {
    padding: 0px 2px 0px 2px;
    border-top: 1px solid #111;
    text-align: center;
}
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}
.tablColor th {
  background:#000 !important;
  color:#fff;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 0px 2px !important;
    text-align: center !important;
}
table.display td {
        padding: 2px 2px;
    color: black;
            border-bottom: 0px dashed #abafaf !important;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 0px 2px !important;
    border-bottom: 1px solid #111;
    text-align: center !important;
}
 
 .BNMain {
    display: inline-flex; 
    position: absolute;
    z-index: 9999999;
    left: 328px;
    top: 18px;
 }
 .BNMain form {
    display: inherit;
 }
 .msgTd {
    font-size: 10px;
    background-color: #F2F892;
    padding: 0px 9px !important;
 }
 table.dataTable.display tbody .trhoverclaass:hover
 {
         background-color: #FA9E87 !important;
 }
 .adminClass {
	color: red !important;
}
.agentClass {
	color: green !important; 
}

#header-fixed { 
    position: fixed; 
    top: 0px;
    display:none;
    background-color:white !important;
    padding-right: 20px;
}

#header-fixed thead th{
    padding: 3px;
}
#example1 thead tr th { 
     padding: 0 6px 0 7px !important;
     }

</style>
<div class="right_col" role="main">

                <div class="page-title">
                    <div class="title_left">
                      <h3>Search Result</h3>
                    </div>
                    <div class="title_right">
                        <!--<a class="btn btn-primary btn-round pull-right" href="<?php echo site_url(''); ?>">Create Follow Up</a>-->
                    </div>
                </div>
                <div class="clearfix"></div>
                    
                <div class="row">
                    <div class="col-md-12 table-responsive">
                      
                        <table id="example1" class="display tablColor" width="100%" cellspacing="0">
                            <thead id="header-fixed">
                                <tr>
                                    <th >Sr.#</th>
                                    <th>File</th>
                                    <th >Booking Date</th>
                                    <th>Traveling Date</th>
                                    <th>Ref No#</th>
                                    <th>Customer Name</th>
                                    <th >Agent</th> 
                                </tr>
                               
                            </thead> 
                            <thead id="tabl-header">
                               <tr>
                                    <th >Sr.#</th>
                                    <th>File</th>
                                    <th >Booking Date</th>
                                    <th>Traveling Date</th>
                                    <th>Ref No#</th>
                                    <th>Customer Name</th>
                                    <th >Agent</th> 
                                </tr>
                            </thead> 
                            <tbody>
                                <?php 
                                //echo "<pre>"; print_r($bookingData); echo "</pre>"; 
                                if(!empty($bookingData)){ 
                                    $sr=1;
                                    foreach ($bookingData as $obj){
                                    ?>
                                <tr>
                                    <td><?php echo $sr; ?></td>
                                    <td>
                                        <a target="_blank" href="<?php echo site_url('BookingDetailBox/'.idencode($obj->id).'/'.idencode($obj->flag)) ?>" class='anchorCustm' data="<?php echo $obj->id; ?>"><?php echo idToName('company','id',$obj->company,'company_Code').'-'.$obj->id; ?></a>
                                    </td>
                                    <td><?php echo date('d-M-y',strtotime($obj->booking_date)); ?></td>
                                    <td><?php echo date('d-M-y',strtotime($obj->departure_date)); ?></td>
                                    <td><?php echo $obj->supplier_ref; ?></td>
                                    <td><?php echo $obj->fullname; ?></td>
                                    <td>
                                        <?php echo idToName('admin','id',$obj->booked_agent_id,'login_name');  ?>
                                    </td>
                                </tr>
                                    <?php $sr++; } } else{ ?>
                                
                                <tr>
                                    <td colspan="7">There is no data </td>
                                </tr>
                                <?php } ?>
                                
                            </tbody>
                            
                        </table>
                    </div>
                </div>               
            </div>


<script type="text/javascript">
  var tableOffset = $("#example1").offset().top;
var $header = $("#example1 > thead").clone();
var $fixedHeader = $("#header-fixed").append($header);

$(window).bind("scroll", function() {
    var offset = $(this).scrollTop();
    
    if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
        $fixedHeader.show();
        $("#tabl-header").hide();
    }
    else if (offset < tableOffset) {
        $fixedHeader.hide();
    }
});
</script> 