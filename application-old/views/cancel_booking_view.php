<title>Cancelled Bookings</title>
<style>
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
    background-color: #F2E1FD !important;
}
    table tbody th, table.dataTable tbody td {
    text-align: center !important;
}
table thead th, table.dataTable thead td {
    text-align: center !important;
}
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>Cancelled Bookings</h3>
        </div>
        <div class="title_right">
            <!--<a class="btn btn-primary btn-round pull-right" href="<?php echo site_url(''); ?>">Create Follow Up</a>-->
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table id="example" class="display nowrap tablColor dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>File No.</th>
                        <th>Booking Date</th>
                        <th>Traveling Date</th>
                        <th>Return Date</th>
                        
                        <th>Sup.Ref#</th>
                        <th>Customer Name</th>
                        <th>Agent</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php $sr=0;  if(!empty($cancelledBooking)){ foreach($cancelledBooking as $obj){  $sr++;  ?>
                    <tr>
                        <td><?php echo $sr; ?></td>
                        <td><a target="_blank" href="<?php echo site_url('BookingDetailBox/'.idencode($obj->id).'/'.idencode($obj->flag)) ?>" class='anchorCustm' data="<?php echo $obj->id; ?>"><?php echo idToName('company','id',$obj->company,'company_Code').'-'.$obj->id; ?></a></td>
                        <td><?php echo $obj->booking_date; ?></td>
                        <td><?php echo $obj->departure_date; ?></td>
                        <td><?php echo $obj->returnDate; ?></td>
                        
                        <td><?php echo $obj->supplier_ref; ?></td>
                        <td><?php  echo substr($obj->fullname,0,10); ?></td>
                        <td><?php echo idToName('admin','id',$obj->booked_agent_id,'login_name');  ?></td>
                    </tr>
                    <?php } } else{ ?>
                     <tr>
                        <td>No data.....</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>               
</div>