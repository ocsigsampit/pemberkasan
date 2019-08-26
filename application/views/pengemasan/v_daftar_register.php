<?php error_reporting(E_ERROR | E_PARSE);?>

<?php
//print_r($datanya);

//membuat serial jumlah spt
$ere_spt = array();

foreach($datanya as $key=>$value){
	$ere_spt['spt_tahunan'][] = (int)$value->JMLSPTTHN;
	$ere_spt['spt_masa'][]    = (int)$value->JMLSPTMASA;
}


//membuat serial tgl
$ere_tgl = array();

foreach($datanya as $key=>$value){
	$ere_tgl[] = $value->TGL;
}
?>
<div class="panel panel-default">
	<div class="panel-heading"><h4>DATA PEREKAMAN REGISTER</h4></div>
	<div class="box-body">
		<div class="chart" id="grafik">
		<br>
		<div id="legend" class="ct-chart text-center"></div>
		</div>
	</div>
	<div class="panel-body">
		<table id="table_register" class="table table-bordered table-condensed table-striped tablesorter table-responsive tbl-qa">
			<thead>
				<tr>
					<th class="text-center">NO</th>
					<th class="text-center">NAMA PEGAWAI</th>
					<th class="text-center">NO REGISTER</th>
					<th class="text-center">JENIS SPT</th>
					<th class="text-center">JML SPT</th>
					<th class="text-center">TGL TERIMA</th>
					<th class="text-center">ID PENGEMASAN</th>
				</tr>
			</thead>
			<tbody id="table-body">
			<?php
			$no=1;
			foreach($semua as $r){
				echo "<tr>";
				echo "<td class='text-center'>".$no."</td>";
				echo "<td class='text-left nowrap'>".$r->nm_pegawai."</td>";
				echo "<td class='text-left'>".$r->no_reg."</td>";
				echo "<td class='text-left nowrap'>".$r->nm_spt."</td>";
				echo "<td class='text-center'>".$r->jml_spt."</td>";
				echo "<td class='text-center'>".$r->tglterima."</td>";
				echo "<td class='text-center'>".$r->id_pengemasan."</td>";
				echo "</tr>";
				$no++;
			}
			?>
			</tbody>
		</table>
	</div>
</div>

<script>
$(document).ready(function(){
	var ere_spt_tahunan 	= '<?php print json_encode($ere_spt['spt_tahunan']);?>';
	var ere_spt_masa    	= '<?php print json_encode($ere_spt['spt_masa']);?>';
	var ere_tgl    	        = '<?php print json_encode($ere_tgl);?>';
	//alert("ere_spt_tahunan : " + ere_spt_tahunan);
	//alert("ere_spt_masa : " + ere_spt_masa);
	//alert("ere_tgl : " + ere_tgl);
	
	var parseEreSPTTahunan = JSON.parse(ere_spt_tahunan);
	var parseEreSPTMasa    = JSON.parse(ere_spt_masa);
	var parseEreTgl        = JSON.parse(ere_tgl);
	
	/* TES ! 
	alert("parseEreSPTTahunan : " + parseEreSPTTahunan);
	alert("parseEreSPTMasa : " + parseEreSPTMasa);
	alert("parseEreTgl : " + parseEreTgl);
	*/
	new Highcharts.Chart({
		chart: {
			renderTo: 'grafik',
			type: 'areaspline',
		},
		title: {
			text: 'Penerimaan SPT',
			x: -20
		},
		subtitle: {
			text: 'berdasarkan jumlah pada lembar register',
			x: -20
		},
		xAxis: {
			categories: parseEreTgl
		},
		yAxis: {
			title: {
				text: 'Jumlah SPT'
			}
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: false
			}
		},
		series: [{
			 name: 'SPT Tahunan',
			 data: parseEreSPTTahunan
		 },{
			 name: 'SPT Masa',
			 data: parseEreSPTMasa
		 }]
	});
	
	$("#table_register").DataTable();
});
</script>
	