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
<p>Bulan :&nbsp;</p>
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

<script>
$(function(){
	$("#pilihan_bulan").change(function(){
		var bulan = $(this).val();
		
		//alert("Anda memilih bulan berkode : " + bulan);
		$.ajax({
			url  : theSite + "/pengemasan/ajax_grafik_register_bulanan2/",
			type : "post",
			data : "kode_bulan=" + bulan,
			success : function(hasil){
				//alert("hasil : \n" + hasil + "\n" + typeof hasil);

				var JSONhasil           = JSON.parse(hasil);
				var JSONhasil_tanggal   = JSONhasil.tanggal;
				var JSONhasil_jumlah1	= JSONhasil.jumlah['SPT1'];
				var JSONhasil_jumlah2	= JSONhasil.jumlah['SPT2'];
				var JSONhasil_jumlah3	= JSONhasil.jumlah['SPT3'];
				var JSONhasil_jumlah4	= JSONhasil.jumlah['SPT4'];
				var JSONhasil_jumlah5	= JSONhasil.jumlah['SPT5'];
				var JSONhasil_jumlah6	= JSONhasil.jumlah['SPT6'];
				var JSONhasil_jumlah7	= JSONhasil.jumlah['SPT7'];
				/*
				alert("JSONhasil_tanggal \n: " + JSONhasil_tanggal);
				alert("JSONhasil_jumlah1 : \n" + JSONhasil_jumlah1);
				alert("JSONhasil_jumlah2 : \n" + JSONhasil_jumlah2);
				*/
				new Highcharts.Chart({
					chart: {
						renderTo: 'grafik',
						//type: 'spline',
					},
					tooltip: {
					   shared: true
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
					  name: 'Badan',
					  type : 'spline',
					  data: JSONhasil_jumlah1
					
					 }, {
					  name: 'OP',
					  type : 'spline',
					  data: JSONhasil_jumlah2
					
					 }, {
					  name: 'OPS',
					  type : 'spline',
					  dashStyle: 'shortdot',
					  data: JSONhasil_jumlah3
					
					 }, {
					  name: 'OPSS',
					  type : 'spline',
					  data: JSONhasil_jumlah4
					
					 }, {
					  name: 'Ps.21',
					  type : 'spline',
					  data: JSONhasil_jumlah5
					
					 }, {
					  name: 'PPNDM',
					  type : 'spline',
					  data: JSONhasil_jumlah6
					
					 }, {
					  name: 'Ps.23',
					  type : 'spline',
					  data: JSONhasil_jumlah7
					 }]
				});
			}
		});
	});
	
});
</script>