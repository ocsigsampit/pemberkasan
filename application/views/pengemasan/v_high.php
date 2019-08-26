<?php error_reporting(E_ERROR | E_PARSE);?>
<style>
body{width:550px;}
.chart-filter{    border-bottom: #CCC 1px solid;padding: 20px;}
.btn-input {background: #333;color: #FFF;border: 0;padding: 8px 20px;border-radius: 4px;}
.chart-item-title {padding:25px 0px;}
.chart-item-option {margin-left: 20px;}
</style>

<div class="chart-filter">
	<div class="chart-item-title">
		<input type="checkbox" name="kode_spt" value="Badan" checked /> SPT Tahunan Badan
		<input type="checkbox" name="kode_spt" value="OP" class="chart-item-option" checked /> SPT Tahunan OP
		<input type="checkbox" name="kode_spt" value="OPS" class="chart-item-option" checked /> SPT Tahunan OP S
		<input type="checkbox" name="kode_spt" value="OPSS" class="chart-item-option" checked /> SPT Tahunan OP SS
		<input type="checkbox" name="kode_spt" value="PPh21" class="chart-item-option" checked /> SPT Masa PPh 21
		<input type="checkbox" name="kode_spt" value="PPNDM" class="chart-item-option" checked /> SPT Masa PPN DM
	</div>
	<input type="button" id="compare" value="Bandingkan" class="btn-input" />
</div>

<div id="chart"></div>

<script src="<?php echo base_url();?>jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>highcharts/modules/exporting.js"></script>
<script src="<?php echo base_url();?>highcharts/themes/gray.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>highcharts/css/highcharts.css">

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script>
$(function () {
	var nilai = "<?php echo $nilai;?>";
	$(document).ready(function() {
		//Default Options
		var options = {
			chart: {
				renderTo: 'chart',
				type: 'spline',
				height: 500,
				width:1200
			},
			title: {
				text: 'Penerimaan SPT'
			},
			xAxis: {
				//categories: [ '1','2','3','4' ,'5','6','7','8','9','10','11','12'],
				categories: [ 'JAN','FEB','MAR','APR' ,'MEI','JUN','JUL','AGT','SEP','OKT','NOV','DES'],
				title: { text: 'Bulan Terima' }
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Berkas',
					align: 'middle'
				}
			},
			plotOptions: {
				column: {
					dataLabels: {
						enabled: true
					}
				},
				spline: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
			series: [{},{},{},{},{},{}]
		};
		
		
		// On click event handler to compare data
		$("#compare").on("click",function(){
			var nilai_baru = JSON.parse(nilai);
			var kode_spt   = ["Badan","OP","OPS","OPSS","PPh21","PPNDM"];
			//var data = [[12,16,17],[10,12,25],[11,36,22],[24,15,18],[28,30,14],[11,15,21]];
			//var data = [[0,83,158,472,260,0,0,0,0,0,0,0],[0,341,2669,1129,69,0,0,0,0,0,0,0],[0,101,232,205,12,0,0,0,0,0,0,0],[0,510,547,317,15,0,0,0,0,0,0,0],[0,66,197,125,52,0,0,0,0,0,0,0],[0,6,18,28,16,0,0,0,0,0,0,0]];
			var data       = nilai_baru;
			
			//alert(data);
			//console.log(data);
			
			//var color = ["#10c0d2","#f1e019","#a2d210","#10c0d2","#f1e019","#a2d210"];
			var color = ["blue","yellow","red","green","violet","grey"];
			var selected_kode_spt,j;

			// Clear previous data and reset series data
			for (i=0;i<data.length;i++) {
				options.series[i].name  = "";
				options.series[i].data  = "";
				options.series[i].color = "";
			}

			// Intializeseries data based on selected countries
			var i = 0;
			$("input[name='kode_spt']:checked").each(function() {	
				selected_kode_spt = $(this).val();
				j = jQuery.inArray(selected_kode_spt,kode_spt)
				if(j >= 0){
				options.series[i].name = kode_spt[j];
				options.series[i].data = data[j];
				options.series[i].color = color[j];
				i++;	
				}
				
			});
			
			// Draw chart with options
			var chart = new Highcharts.Chart(options);

			// Display legend only for visible data.
			var item;
			for (k=i;k<=data.length;k++) {
				item= chart.series[k];				
				if(item) {
					item.options.showInLegend = false;
					item.legendItem = null;
					chart.legend.destroyItem(item);
					chart.legend.render();
				}
			}
		
		});
		
	});
});
</script>