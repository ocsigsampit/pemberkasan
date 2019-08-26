<?php
//membuat daftar bulan
$bulan = array();

$bulan['01'] = "JANUARI";
$bulan['02'] = "FEBRUARI";
$bulan['03'] = "MARET";
$bulan['04'] = "APRIL";
$bulan['05'] = "MEI";
$bulan['06'] = "JUNI";
$bulan['07'] = "JULI";
$bulan['08'] = "AGUSTUS";
$bulan['09'] = "SEPTEMBER";
$bulan['10'] = "OKTOBER";
$bulan['11'] = "NOVEMBER";
$bulan['12'] = "DESEMBER";
?>
<select id="pilihan_bulan">
	<?php
	foreach($bulan as $key=>$val){
		echo "<option value='".$key."'>".$val."</option>";
	}
	?>
</select>
<div class="box-body">
	<div class="chart" id="grafik">
	<br>
	<div id="legend" class="ct-chart text-center"></div>
	</div>
</div>

<?php
//membuat serial jumlah SPT
//$ere = array();

//foreach($datanya as $key=>$value){
//	$ere[] = (int)$value->JML_REG;
//}


//membuat serial tgl
//$ere_tgl = array();

//foreach($datanya as $key=>$value){
//	$ere_tgl[] = $value->TGL;
//}
?>

<script>
$(function(){
	$("#pilihan_bulan").change(function(){
		var bulan = $(this).val();
		//alert("Anda memilih bulan berkode : " + bulan);
		$.ajax({
			url  : theSite + "/pengemasan/ajax_grafik_register_bulanan/",
			type : "post",
			data : "kode_bulan=" + bulan,
			success : function(hasil){
				//alert("hasil : " + hasil);
				var JSONhasil         = JSON.parse(hasil);
				var JSONhasil_jumlah  = JSONhasil.jumlah;
				var JSONhasil_tanggal = JSONhasil.tanggal;
				//alert("JSONhasil_jumlah : " + JSONhasil_jumlah);
				//alert("JSONhasil_tanggal : " + JSONhasil_tanggal);
				
				/* TES !
				alert("hasil : " + hasil);
				alert("jason : " + jason);
				alert("tanggal : " + tanggal);
				alert("jason_tgl : " + jason_tgl);
				*/
				new Highcharts.Chart({
					chart: {
						renderTo: 'grafik',
						type: 'spline',
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
						//categories: ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGT', 'SEP', 'OKT','NOV', 'DES'],
						categories: JSONhasil_tanggal
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
						 name: 'Jumlah',
						 data: JSONhasil_jumlah
					 }]
				});
			}
		});
	});
	
});
</script>