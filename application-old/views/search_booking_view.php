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
                <form class="form-inline">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Value:</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Start Date:</label>
                                <input type="text" style="background:#fff !important;" name="startDate" style="cursor: pointer;" readonly="" id="startDate" class="form-control" placeholder="yyyy-mm-dd" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>End Date:</label>
                                <input type="text" style="background:#fff !important;" name="endDate" readonly="" style="cursor: pointer;" id="endDate" class="form-control" placeholder="yyyy-mm-dd" />
                            </div>
                        </div>
                    </div>
                </form>
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
                            <label><input type="radio" name="optradio">1) Booking Date <span class="blue">(Start & End Date)</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">2) Traveling Date <span class="blue">(Start & End Date)</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">3) Ticket Issuance Date <span class="blue">(Start & End Date)</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">4) Cancellation Date <span class="blue">(Start & End Date)</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">5) Booking Reference No <span class="blue">(Value - Without prefix or Postfix)</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">6) Passenger SurName <span class="blue">(value)</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="radio">
                            <label><input type="radio" name="optradio">7) Passenger First Name <span class="blue">(Value)</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">8) PNR <span class="blue">(Value)</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">9) eTicket Number <span class="blue">(Value)</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">10) GDS  <span class="blue">(Value , Start & End Traveling Date )</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">11) Airline  <span class="blue">(Value , Start & End Traveling Date)</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio">12) Supplier Reference <span class="blue">(Value)</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <br>
                        <a href="javascript:void(0);" class="btn btn-primary btn-block">Search</a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- /page content -->
