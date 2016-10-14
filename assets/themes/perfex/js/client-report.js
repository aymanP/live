	var salesChart;
	$(document).ready(function() {
		client_home_chart();
	    $('select[name="currency"],select[name="payments_years"]').on('change', function() {
	        client_home_chart();
	    });
	});
	function client_home_chart() {
		// Check if chart canvas exists.
		var chart = $('#client-home-chart');
	    if(chart.length == 0){
	    	return;
	    }
	    if (typeof(salesChart) !== 'undefined') {
	        salesChart.destroy();
	    }
	    var data = {};
	    var currency = $('#currency');
	    var year = $('#payments_year');
	    if (currency.length > 0) {
	        data.report_currency = $('select[name="currency"]').val();
	    }
	    if (year.length > 0) {
	        data.year = $('#payments_year').val();
	    }
	    $.post(site_url + 'clients/client_home_chart', data).success(function(response) {
	        response = $.parseJSON(response);
	        salesChart = new Chart(chart,{
	        	type:'line',
	        	data:response,
	        	options:{responsive:true}
	        });
	    });
	}


