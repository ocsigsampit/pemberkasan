<div class="container">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-blue">
				<div class="inner">
					<h3><?php echo number_format($jml_pengemasan,0,'0','.');?></h3>
					<p>Pengemasan</p>
				</div>
				<div class="icon">
					<!--<i class="ion ion-alert-circled"></i>-->
					<i class="ion ion-briefcase"></i>
				</div>
				<a href="<?=site_url('/pengemasan/daftar_pengemasan');?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h3><?php echo number_format($jml_register,0,'0','.');?></h3>
					<p>Register/ND</p>
				</div>
				<div class="icon">
					<i class="ion ion-document"></i>
				</div>
				<a href="<?=site_url('/pengemasan/daftar_register');?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo number_format($jml_pengembalian,0,'0','.');?></h3>
					<p>Pengembalian SPT (SP)</p>
				</div>
				<div class="icon">
					<i class="ion ion-arrow-left-c"></i>
				</div>
				<a href="<?=site_url('/pengemasan/daftar_pengembalian');?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?php echo number_format($jml_no_lpad,0,'0','.');?></h3>
					<p>SPT pada Daftar Isi Kemasan</p>
				</div>
				<div class="icon">
					<i class="ion ion-document"></i>
				</div>
				<div class="small-box-footer"><i>.</i></div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Penerimaan Berkas <span id="nama_spt">SPT Tahunan PPh Badan</span></h3>
						<div class="box-tools pull-right">
							<form class="form-inline">
								<div class="form-group">
									<label>Jenis SPT : </label>
									<select class="form-control input-sm" id="select_spt">
										<option value='-'>--Pilih Jenis SPT--</option>
									<?php
									foreach($daftar_spt as $z){
										echo "<option value='".$z->id_spt."' ".$selected.">".$z->nm_spt."</option>";
									}
									?>
									</select>
								</div>
							</form>
						</div>
					</div>
					<div class="box-body">
						<div class="chart" id="grafik">
							<br>
							<div id="legend" class="ct-chart text-center"></div>
						</div>
						<h1 id="tes"></h1>
					</div>
				</div>
			</div>
		</div>
		<!--Grafik Penerimaan SPT per Jenis SPT berdasar jumlah pada Register/ND-->
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">JUMLAH SPT PER JENIS SPT BERDASAR Register/ND</span></h3>
					</div>
					<div class="box-body">
						<div class="chart" id="grafik2">
							<br>
							<div id="legend" class="ct-chart text-center"></div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!--End of Grafik Penerimaan SPT per Jenis SPT berdasar jumlah pada Register/ND-->
	</div>
</div>

<?php
$bulan = array();
		
$bulan['1']  = 'JAN';
$bulan['2']  = 'FEB';
$bulan['3']  = 'MAR';
$bulan['4']  = 'APR';
$bulan['5']  = 'MEI';
$bulan['6']  = 'JUN';
$bulan['7']  = 'JUL';
$bulan['8']  = 'AGT';
$bulan['9']  = 'SEP';
$bulan['10'] = 'OKT';
$bulan['11'] = 'NOV';
$bulan['12'] = 'DES';

foreach($grafik_semua as $key=>$v){
	$konvert[] = $bulan[$v->BULAN];	
}

//print_r($konvert);
$convBulan = json_encode($konvert);
//echo $convBulan;	
?>

<script>
$(function(){

	var chart;
	var theBulan = '<?php echo $convBulan;?>';
	var undian = [];
	
	undian[1] = "SPT01";
	undian[2] = "SPT02";
	undian[3] = "SPT03";
	undian[4] = "SPT04";
	undian[5] = "SPT05";
	undian[6] = "SPT06";
	undian[7] = "SPT11";
	
	//acak jenis SPT yang akan ditampilkan
	hasilUndian = Math.floor(Math.random() * 7) + 1  
	hasilUndian = undian[hasilUndian];
	
	var nama = [];
		
	nama['SPT01'] = 'SPT Tahunan PPh Badan';
	nama['SPT02'] = 'SPT Tahunan PPh Orang Pribadi 1770';
	nama['SPT03'] = 'SPT Tahunan PPh Orang Pribadi 1770 S';
	nama['SPT04'] = 'SPT Tahunan PPh Orang Pribadi 1770 SS';
	nama['SPT05'] = 'SPT Masa PPh 21';
	nama['SPT06'] = 'SPT Masa PPN Pedagang Eceran';
	nama['SPT11'] = 'SPT Masa PPh 23';

	getAjaxData(hasilUndian);
	$("#nama_spt").html(nama[hasilUndian]);
	
	getAjaxData2();
	
	$("#select_spt").change(function(){
		var jenis_spt = $("#select_spt").val();
		var kode_spt;
		
		$("#nama_spt").html(nama[jenis_spt]);
		
		getAjaxData(jenis_spt);		
	});
	
	function getAjaxData(kode_spt){
		var tanggal   = new Date();
		var tahun     = tanggal.getFullYear();
		var tahunLalu = tahun - 1;

		$.ajax({
			url  : theSite + "/pengemasan/gra_banding_spt/",
			type : "POST",
			data : "kode_spt=" + kode_spt,
			success : function(hasil){
				var jason = JSON.parse(hasil);
				//alert("jason : " + jason);
				var now = jason['NOW'];
				//alert("NOW : " + now);
				var past = jason['PAST'];
				//alert("PAST : " + past);
				
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
						categories: ['JAN','FEB','MAR','APR','MEI','JUN','JUL','AGT','SEP','OKT','NOV','DES']
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
						 name: tahunLalu,
						 data: past
					 },{
						 name: tahun,
						 data: now
					 }]
				});
			}
		})
	}
	
	
	function getAjaxData2(){
		var tanggal2   = new Date();
		var tahun2     = tanggal2.getFullYear();
		var tahunLalu2 = tahun2 - 1;

		$.ajax({
			url  : theSite + "/pengemasan/masaTahunanDi2Tahun/",
			type : "POST",
			success : function(hasil2){
				var jason2 = JSON.parse(hasil2);
				//alert("jason : " + jason);
				var MASA = jason2['MASA'];
				//alert("MASA : " + MASA);
				var TAHUNAN = jason2['TAHUNAN'];
				//alert("TAHUNAN : " + TAHUNAN);
				
				new Highcharts.Chart({
					chart: {
						renderTo: 'grafik2',
						type: 'bar',
					},
					title: {
						text: 'Penerimaan SPT per Jenis SPT Tahunan/Masa',
						x: -20
					},
					subtitle: {
						text: 'berdasarkan jumlah pada lembar register',
						x: -20
					},
					xAxis: {
						categories: ['SPT MASA','SPT TAHUNAN']
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
						 name: tahun2,
						 data: TAHUNAN
					 },{
						 name: tahunLalu2,
						 data: MASA
					 }]
				});
			}
		})
	}
});
</script>