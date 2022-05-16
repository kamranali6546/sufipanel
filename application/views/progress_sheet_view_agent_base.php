<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/pareto.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width: 100%;">
         <h3 class="text-center">Agent Progress</h3>
        </div>
        <div class="title_right">
        </div> 
    </div>
    <div class="clearfix"></div>
    <div class="row">
	<div class="col-md-12">
	</div>
    </div>
    <div class="row">
            <div class="col-md-10 col-md-offset-1">
                   <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>	
            </div>
    </div>
    
    <br>
    <br>
    <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>	    
            </div>
    </div>
</div>
<script type="text/javascript">
// Create the chart
Highcharts.setOptions({
    colors: ['#058DC7']
});
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo $titleAgentProfitGraph; ?>'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: ''
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}£</b> <br/>'
    },

    series: [
        {
            name: "Profit",
            colorByPoint: false,
            data: <?php echo $agentProfit; ?>
        }
    ],
    drilldown: {
        
    }
});
Highcharts.setOptions({
    colors: ['#ff0000']
    
});
Highcharts.chart('container2', {
    chart: {
        type: 'column'
        
    },
    title: {
        text: '<?php echo $titleAgentSaleGraph; ?>'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
        
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: ''
        
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Booking<br/>'
    },

    series: [
        {
            name: "",
            colorByPoint: false,
            data: 
                <?php echo $agentBookings; ?> 
        }
    ],
    drilldown: {
        
    }
});
</script>
   
