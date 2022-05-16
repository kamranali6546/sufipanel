 </div>
    </div>
    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    <!-- gauge js -->
<!--    <script type="text/javascript" src="<?php echo LINK ?>js/gauge/gauge.min.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/gauge/gauge_demo.js"></script>-->
    <!-- chart js -->
    <!--<script src="<?php echo LINK ?>js/chartjs/chart.min.js"></script>-->
    <!-- bootstrap progress js -->
    <script src="<?php echo LINK ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo LINK ?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo LINK ?>js/icheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?php echo LINK ?>js/moment.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo LINK ?>js/datepicker/daterangepicker.js"></script> -->
    <script src="<?php echo LINK ?>js/custom.js"></script>
    <script src="<?php echo LINK ?>js/sitejs.js"></script>
    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?php echo LINK ?>js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/flot/jquery.flot.time.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo LINK ?>js/flot/date.js"></script> -->
    <script type="text/javascript" src="<?php echo LINK ?>js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/flot/jquery.flot.stack.js"></script>
<!--    <script src="<?php echo LINK ?>ckeditor/ckeditor.js"></script>
    <script src="<?php echo LINK ?>ckeditor/samples/js/sample.js"></script>-->
    <script type="text/javascript" src="<?php echo LINK ?>js/DatetimePick/jquery-ui-timepicker-addon.js"></script>
    <!--<script type="text/javascript" src="<?php echo LINK ?>js/flot/curvedLines.js"></script>-->
    <!--<script type="text/javascript" src="<?php echo LINK ?>js/flot/jquery.flot.resize.js"></script>-->
    <?php
    if(!empty($page))
    {
    ?>
    <script type="text/javascript" src="<?php echo LINK ?>js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/jszip.min.js"></script>
<!--    <script type="text/javascript" src="<?php echo LINK ?>js/pdfmake.min.js"></script>-->
    <script type="text/javascript" src="<?php echo LINK ?>js/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/buttons.print.min.js"></script>
    <link type="text/css" href="<?php echo LINK ?>css/jquery-dataTables-min.css" rel="stylesheet" >
    <link type="text/css" href="<?php echo LINK ?>css/buttons-dataTables-min.css" rel="stylesheet" >
    <script>
          $(document).ready(function() {  
           
        $('#example').DataTable( {
            dom: 'Bfrtip',
            pageLength: 200,
            buttons: [
                  'excel','print'
            ]
        } );
        $('#example1').DataTable( {
            dom: 'Bfrtip',
            pageLength: 200,
            buttons: [
                  'excel','print'
            ]
        } );
        $('#example2').DataTable( {
            dom: 'Bfrtip',
            pageLength: 200,
            buttons: [
                  'excel','print'
            ]
        } );
    } );
    </script>
    <?php 
    }
    ?>
    <script>
        
    $(function()
    {
             $( "#airline" ).autocomplete({
                source: '<?php echo base_url() ?>Ajax/airlinetypeHead'
             });
             });
    $(function()
    {
             $( "#bookingAirline" ).autocomplete({
                source: '<?php echo base_url() ?>Ajax/airlinetypeHead'
             });
             });
    $(function() {
    $( "#departairport" ).autocomplete({
        source: '<?php echo base_url() ?>Ajax/departTypehead'
    });
   });
    $(function() {
        $( "#destiairport" ).autocomplete({
            source: '<?php echo base_url() ?>Ajax/destiTypeHead'
        });
    });
    $(function() {
        $( "#bookingDeparture" ).autocomplete({
            source: '<?php echo base_url() ?>Ajax/destiTypeHead'
        });
    });
    $(function() {
        $( "#bookingDestination" ).autocomplete({
            source: '<?php echo base_url() ?>Ajax/destiTypeHead'
        });
    });
    $(function() {
        $( "#bookingVia" ).autocomplete({
            source: '<?php echo base_url() ?>Ajax/destiTypeHead'
        });
    });
    $(function() {
        $( "#bookingViaReturning" ).autocomplete({
            source: '<?php echo base_url() ?>Ajax/destiTypeHead'
        });
    });
     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#prewAgentEdit').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#companylogo").change(function(){
        readURL(this);
    });
     function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#prewAgent').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#profiePic").change(function(){
        readURL2(this);
    });
    $("#profiePicEdit").change(function(){
        readURL(this);
    });
//$(document).ready(
//    function () {
//        $("#bookingViaReturning").select2();
//    }
//    
//);
$(document).ready(function() {
            $("#validFrom").keyup(function(){
                if ($(this).val().length == 2){
                    $(this).val($(this).val() + "/");
                }
//                else if ($(this).val().length == 5){
//                    $(this).val($(this).val() + "/");
//                }
            });    
});
$(document).ready(function() {
            $("#validFromNew").keyup(function(){
                if ($(this).val().length == 2){
                    $(this).val($(this).val() + "/");
                }
//                else if ($(this).val().length == 5){
//                    $(this).val($(this).val() + "/");
//                }
            });    
});
$(document).ready(function() {
            $("#expiryDateNew").keyup(function(){
                if ($(this).val().length == 2){
                    $(this).val($(this).val() + "/");
                }
//                else if ($(this).val().length == 5){
//                    $(this).val($(this).val() + "/");
//                }
            });    
});
$(document).ready(function() {
            $("#vaildFromEdit").keyup(function(){
                if ($(this).val().length == 2){
                    $(this).val($(this).val() + "/");
                }
//                else if ($(this).val().length == 5){
//                    $(this).val($(this).val() + "/");
//                }
            });    
});
$(document).ready(function() {
            $("#expiryDateEdit").keyup(function(){
                if ($(this).val().length == 2){
                    $(this).val($(this).val() + "/");
                }
//                else if ($(this).val().length == 5){
//                    $(this).val($(this).val() + "/");
//                }
            });    
});
$(document).ready(function() {
            $("#cardExpiry").keyup(function(){
                if ($(this).val().length == 2){
                    $(this).val($(this).val() + "/");
                }
//                else if ($(this).val().length == 5){
//                    $(this).val($(this).val() + "/");
//                }
            }); 
            // $('input.timepicker').timepicker({ timeFormat: 'h:mm:ss' });
            // $('input.timepicker').timepicker({
            //     timeFormat: 'HH:mm:ss',
            //     minTime: '11:45:00' // 11:45:00 AM,
            //     maxHour: 20,
            //     maxMinutes: 30,
            //     startTime: new Date(0,0,0,15,0,0) // 3:00:00 PM - noon
            //     interval: 15 // 15 minutes
            // }); 
            $('input.timepicker').timepicker({
                timeFormat: 'HH:mm:ss',
                change: function(time) {
                    // the input field
                    var element = $(this), text;
                    // get access to this Timepicker instance
                    var timepicker = element.timepicker();
                    text = 'Selected time is: ' + timepicker.format(time);
                    element.siblings('span.help-line').text(text);
                }
            });
            $('#agentShiftTimeStart').timepicker({
                timeFormat: 'HH:mm',
                change: function(time) {
                    // the input field
                    var element = $(this), text;
                    // get access to this Timepicker instance
                    var timepicker = element.timepicker();
                    text = 'Selected time is: ' + timepicker.format(time);
                    element.siblings('span.help-line').text(text);
                }
            });
            $('#agentShiftTimeEnd').timepicker({
                timeFormat: 'HH:mm',
                change: function(time) {
                    // the input field
                    var element = $(this), text;
                    // get access to this Timepicker instance
                    var timepicker = element.timepicker();
                    text = 'Selected time is: ' + timepicker.format(time);
                    element.siblings('span.help-line').text(text);
                }
            });
            $('#agentShiftTimeStartEdit').timepicker({
                timeFormat: 'HH:mm',
                change: function(time) {
                    // the input field
                    var element = $(this), text;
                    // get access to this Timepicker instance
                    var timepicker = element.timepicker();
                    text = 'Selected time is: ' + timepicker.format(time);
                    element.siblings('span.help-line').text(text);
                }
            });
            $('#agentShiftTimeEndEdit').timepicker({
                timeFormat: 'HH:mm',
                change: function(time) {
                    // the input field
                    var element = $(this), text;
                    // get access to this Timepicker instance
                    var timepicker = element.timepicker();
                    text = 'Selected time is: ' + timepicker.format(time);
                    element.siblings('span.help-line').text(text);
                }
            });
//            $('.select2').select2();
});
// $(document).ready(function(){
//     $('input.timepicker').timepicker({
//         timeFormat: 'HH:mm:ss',
//         minTime: '11:45:00' // 11:45:00 AM,
//         maxHour: 20,
//         maxMinutes: 30,
//         startTime: new Date(0,0,0,15,0,0) // 3:00:00 PM - noon
//         interval: 15 // 15 minutes
//     });
// });

//$(function(){
//	var availableTags = [
//	    "ActionScript",
//	    "AppleScript",
//	    "Asp",
//	    "BASIC",
//	    "C",
//	    "C++",
//	    "Clojure",
//	    "COBOL",
//	    "ColdFusion",
//	    "Erlang",
//	    "Fortran",
//	    "Groovy",
//	    "Haskell",
//	    "Java",
//	    "JavaScript",
//	    "Lisp",
//	    "Perl",
//	    "PHP",
//	    "Python",
//	    "Ruby",
//	    "Scala",
//	    "Scheme"
//	];
//	$('#bookingVia').autocomplete({
//        source: availableTags,
//        multiselect: true
//    });
//});

    </script>
<script>
$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
})

</script>
    <script>
        function isNumberKey(evt)
        {
	var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;

	return true;
            }
        $(document).ready(function () {
            // [17, 74, 6, 39, 20, 85, 7]
            //[82, 23, 66, 9, 99, 6, 2]
            var data1 = [[gd(2012, 1, 1), 17], [gd(2012, 1, 2), 74], [gd(2012, 1, 3), 6], [gd(2012, 1, 4), 39], [gd(2012, 1, 5), 20], [gd(2012, 1, 6), 85], [gd(2012, 1, 7), 7]];

            var data2 = [[gd(2012, 1, 1), 82], [gd(2012, 1, 2), 23], [gd(2012, 1, 3), 66], [gd(2012, 1, 4), 9], [gd(2012, 1, 5), 119], [gd(2012, 1, 6), 6], [gd(2012, 1, 7), 9]];
            $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                data1, data2
            ], {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    verticalLines: true,
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#fff'
                },
                colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                xaxis: {
                    tickColor: "rgba(51, 51, 51, 0.06)",
                    mode: "time",
                    tickSize: [1, "day"],
                    //tickLength: 10,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Verdana, Arial',
                    axisLabelPadding: 10
                        //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
                },
                yaxis: {
                    ticks: 8,
                    tickColor: "rgba(51, 51, 51, 0.06)",
                },
                tooltip: false
            });

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }
        });
    </script>

    <!-- worldmap -->
<!--    <script type="text/javascript" src="<?php echo LINK ?>js/maps/jquery-jvectormap-2.0.1.min.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/maps/gdp-data.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="<?php echo LINK ?>js/maps/jquery-jvectormap-us-aea-en.js"></script>-->
<!--    <script>
        $(function () {
            $('#world-map-gdp').vectorMap({
                map: 'world_mill_en',
                backgroundColor: 'transparent',
                zoomOnScroll: false,
                series: {
                    regions: [{
                        values: gdpData,
                        scale: ['#E6F2F0', '#149B7E'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionTipShow: function (e, el, code) {
                    el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                }
            });
        });
    </script>-->
    <!-- skycons -->
<!--    <script src="<?php echo LINK ?>js/skycons/skycons.js"></script>-->
<!--    <script>
        var icons = new Skycons({
                "color": "#73879C"
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);

        icons.play();
    </script>-->

    <!-- dashbord linegraph -->
<!--    <script>
        var doughnutData = [
            {
                value: 30,
                color: "#455C73"
            },
            {
                value: 30,
                color: "#9B59B6"
            },
            {
                value: 60,
                color: "#BDC3C7"
            },
            {
                value: 100,
                color: "#26B99A"
            },
            {
                value: 120,
                color: "#3498DB"
            }
    ];
        var myDoughnut = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(doughnutData);
    </script>-->
    <!-- /dashbord linegraph -->
    <!-- datepicker -->
<!--    <script type="text/javascript">
        $(document).ready(function () { 

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>-->
<!--    <script>
       // NProgress.done();
    </script>-->
    <!-- /datepicker -->
    <!-- /footer content -->
<!--<script type="text/javascript">
$(document).ready(function() {
            $('#editor').richText();
        });
</script>-->
    <script>
//    $(document).ready(
//    function () {
//        $("#supplierBank").select2();
//        alert('jdfhjhfg d ');
//    }
//    
//);

    </script>
</body>

</html>
