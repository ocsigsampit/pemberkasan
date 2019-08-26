<script language = "JavaScript">
 $(document).ready(function() {  
	var chart = {
	   zoomType: 'xy'
	};
	var subtitle = {
	   text: 'Source: WorldClimate.com'   
	};
	var title = {
	   text: 'Average Monthly Weather Data for Tokyo'   
	};
	var xAxis = {
	   categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 
		  'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
	   crosshair: true
	};
	var yAxis = [
	   { // Primary yAxis
		  labels: {
			 format: '{value}\xB0C',
			 style: {
				color: Highcharts.getOptions().colors[2]
			 }
		  },
		  title: {
			 text: 'Temperature',
			 style: {
				color: Highcharts.getOptions().colors[2]
			 }
		  },
		  opposite: true
	   }, 
	   { // Secondary yAxis
		  title: {
			 text: 'Rainfall',
			 style: {
				color: Highcharts.getOptions().colors[0]
			 }
		  },
		  labels: {
			 format: '{value} mm',
			 style: {
				color: Highcharts.getOptions().colors[0]
			 }
		  }
	   }, 
	   { // Tertiary yAxis
		  gridLineWidth: 0,
		  title: {
			 text: 'Sea-Level Pressure',
			 style: {
				color: Highcharts.getOptions().colors[1]
			 }
		  },
		  labels: {
			 format: '{value} mb',
			 style: {
				color: Highcharts.getOptions().colors[1]
			 }
		  },
		  opposite:true  
	   }
	];
	var tooltip = {
	   shared: true
	};
	var legend = {
	   layout: 'vertical',
	   align: 'left',
	   x: 120,
	   verticalAlign: 'top',
	   y: 100,
	   floating: true,
	   
	   backgroundColor: (
		  Highcharts.theme && Highcharts.theme.legendBackgroundColor)
		  || '#FFFFFF'
	};
	var series = [
	   {
		  name: 'Rainfall',
		  type: 'column',
		  yAxis: 1,
		  
		  data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,
				194.1, 95.6, 54.4],
		  tooltip: {
			 valueSuffix: ' mm'
		  }
	   },
	   {
		  name: 'Sea-Level Pressure',
		  type: 'spline',
		  yAxis: 2,
		  data: [1016, 1016, 1015.9, 1015.5, 1012.3, 1009.5, 1009.6, 1010.2,
			 1013.1, 1016.9, 1018.2, 1016.7],
		  marker: {
			 enabled: false
		  },
		  dashStyle: 'shortdot',
		  tooltip: {
			 valueSuffix: ' mb'
		  }
	   },
	   {
		  name: 'Temperature',
		  type: 'spline',
		  data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 
			 18.3, 13.9, 9.6],
		  tooltip: {
			 valueSuffix: '\xB0C'
		  }
	   }
	];   

	var json = {};   
	json.chart = chart;   
	json.title = title;
	json.subtitle = subtitle;      
	json.xAxis = xAxis;
	json.yAxis = yAxis;
	json.tooltip = tooltip;  
	json.legend = legend;  
	json.series = series;
	$('#container').highcharts(json);  
 });
</script>