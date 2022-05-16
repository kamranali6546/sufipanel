<title>Search Booking</title><!-- page content -->
<style type="text/css">
    .form-inline .form-group {
        display: inline-flex;
        margin-bottom: 5px;
        width: 100%; 
    }
    .form-inline .form-group input {
        width: -webkit-fill-available;
    }
    .form-inline .form-group label {
        width: 150px;
        color: black;
    }
    .radio label {
        color: black;
    } 
    input[type="radio"] {
        zoom: 1.3 !important;
        margin-top: 2px !important;
    }
    .btn-block:hover {
        color: black !important
    }

    @media screen and (max-width: 425px) {
        body .container.body .right_col {
            padding: 10px 13px !important;
        }
    }
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width: 100%;"> 
            <h3>Search Bookings</h3> 
        </div>
        <div class="title_right">
            <!--<a class="btn btn-primary btn-round pull-right" href="#">Create Follow Up</a>-->
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="well" style="background-color: #d2d2d2; border: 1px solid #636363;">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12"> 
                <form class="form-inline" id="searchForm" action="<?php echo base_url(); ?>search-result-booking" method="post">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Value:</label>
                                <input type="text" name="search_param" id="searchParam" class="form-control" />
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Start Date:</label>
                                <input type="text" name="startDate" style="cursor: pointer;" readonly="" id="startDate" class="form-control" placeholder="yyyy-mm-dd" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>End Date:</label>
                                <input type="text" name="endDate" readonly="" style="cursor: pointer;" id="endDate" class="form-control" placeholder="yyyy-mm-dd" />
                            </div>
                        </div>
                    </div>
               
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="text-decoration: underline;color: black">Search By</label> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                        <div class="radio">
                            <label><input type="radio" value="booking_date" name="optradio">1) Booking Date <span class="blue">(Start & End Date)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="travel_date" name="optradio">2) Traveling Date <span class="blue">(Start & End Date)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="ticket_issue_date" name="optradio">3) Ticket Issuance Date <span class="blue">(Start & End Date)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="cancel_date" name="optradio">4) Cancellation Date <span class="blue">(Start & End Date)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="booking_ref" name="optradio">5) Booking Reference No <span class="blue">(Value - Without prefix or Postfix)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="passenger_surname" name="optradio">6) Passenger SurName <span class="blue">(value)</span></label>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="radio">
                            <label><input type="radio" value="passenger_firstname" name="optradio">7) Passenger First Name <span class="blue">(Value)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="pnr" name="optradio">8) PNR <span class="blue">(Value)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="eticket" name="optradio">9) eTicket Number <span class="blue">(Value)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="gds" name="optradio">10) GDS  <span class="blue">(Value , Start & End Traveling Date )</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="airline" name="optradio">11) Airline  <span class="blue">(Value , Start & End Traveling Date)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="supplier_ref" name="optradio">12) Supplier Reference <span class="blue">(Value)</span></label>
                        </div><br>
                        <div class="radio">
                            <label><input type="radio" value="phone_search" name="optradio">13) Phone Number <span class="blue">(Value)</span></label>
                        </div>
                        <br>
                        <div class="radio">
                            <label><input type="radio" value="source_search" name="optradio">14) Source Of Booking <span class="blue">(Value)</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <br>
                        <button type="button" onclick="prepareSearch()"  class="btn btn-primary btn-block">Search</button>
                    </div>
                </div>
               </form>
            </div> 
        </div>
    </div>
</div>
<script>
function prepareSearch()
{
   // alert('testing');
    var searchParam=$('#searchParam').val();
    var startDate=$('#startDate').val();
    var endDate=$('#endDate').val();
    var optionSelect=$("input[name=optradio]:checked").val();
    if(optionSelect=='')
    {
        alertify.alert('Please select the search parameter');
    }
    else if(optionSelect=='booking_date')
    {
        if(startDate=='' || endDate=='')
        {
             alertify.alert('Please select Date Range');
        }
        else if(startDate!='' && endDate!='')
        {
            $('#searchForm').submit();
            //sendSearchRequest(optionSelect,startDate,endDate,searchParam);
        }
    }
    else if(optionSelect=='ticket_issue_date')
    {
        if(startDate=='' || endDate=='')
        {
             alertify.alert('Please select Date Range');
        }
        else if(startDate!='' && endDate!='')
        {
            $('#searchForm').submit();
            //sendSearchRequest(optionSelect,startDate,endDate,searchParam);
        }
    }
    else if(optionSelect=='travel_date')
    {
       if(startDate=='' || endDate=='')
        {
             alertify.alert('Please select Date Range');
        }
        else if(startDate!='' && endDate!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='cancel_date')
    {
       if(startDate=='' || endDate=='')
        {
             alertify.alert('Please select Date Range');
        }
        else if(startDate!='' && endDate!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='booking_ref')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        else if(searchParam!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='passenger_surname')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        else if(searchParam!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='passenger_firstname')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        else if(searchParam!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='pnr')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        else if(searchParam!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='source_search')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        else if(searchParam!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='phone_search')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        if(searchParam!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='supplier_ref')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        if(searchParam!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='airline')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        if(startDate=='' || endDate=='')
        {
             alertify.alert('Please select Date Range');
        }
        if(searchParam!='' && startDate!='' && endDate!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='gds')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        if(startDate=='' || endDate=='')
        {
             alertify.alert('Please select Date Range');
        }
        if(searchParam!='' && startDate!='' && endDate!='')
        {
            $('#searchForm').submit();
          
        } 
    }
    else if(optionSelect=='eticket')
    {
        if(searchParam=='')
        {
            alertify.alert('Enter the value for search');
        }
        if(searchParam!='')
        {
            $('#searchForm').submit();
          
        } 
    }
//    alert('you select Option'+optionSelect);
}
function sendSearchRequest(param1,param2,param3,param4)
{
    $.ajax({
        type:'post',
        url:'',
        data:{},
        cache:false,
        success:function()
        {
            
        }
    });
}
</script>
<!-- /page content -->
