<?php error_reporting(E_ERROR | E_PARSE);?>
<style>
table .ijo{
	color : red;
}
</style>
<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DAFTAR REGISTER BELUM AKUINTASI / BELUM DIKEMAS</strong></h4></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tbl-ga" id="myTable">
				<thead>
					<tr>
						<th class="text-center">NO.</th>
						<th class="text-center">JENIS SPT</th>
						<th class="text-center">TGL TERIMA*</th>
						<th class="text-center">TGL JATEM**</th>
						<th class="text-center">UMUR (Hari)</th>
						<th class="text-center">JML REG</th>
						<th class="text-center">JML SPT</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$theSite = site_url();
					$no = 1;
					foreach($datanya1 as $q){
						echo "<tr>";
						echo "<td align='center'>".$no."</td>";
						echo "<td align='left'>".$q->JNSSPT."</td>";
						echo "<td align='center'>".$q->TGLTERTUA."</td>";
						echo "<td align='center'>".$q->TIGAPLHHARI."</td>";
						if($q->SELISIH_HARI >= 30){ 
							echo "<td align='center' class='text-danger'>".$q->SELISIH_HARI."&nbsp;Hari&nbsp;<i class='glyphicon glyphicon-fire'></i></td>"; 
						}elseif($q->SELISIH_HARI < 30 && $q->SELISIH_HARI >= 20){
							echo "<td align='center' class='text-warning'>".$q->SELISIH_HARI."<i class='glyphicon glyphicon-exclamation-sign'></td>"; 
						}else{
							echo "<td align='center' class='text-info'>".$q->SELISIH_HARI."</td>";
						}
						echo "<td align='center'>".$q->JMLREG."</td>";
						
						if($q->JMLSPT >=30){
							echo "<td align='center'>".$q->JMLSPT."&nbsp;<i class='glyphicon glyphicon-star'></i></td>";
						}else{
							echo "<td align='center'>".$q->JMLSPT."</td>";
						}
						
						echo "</tr>";
						$no++;
						$totalREG1 += $q->JMLREG;
						$totalSPT1 += $q->JMLSPT;
					}
					?>
				</tbody>
			<?php
			echo "<tr>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'><strong>TOTAL :</strong></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td align='center'><strong>".$totalREG1."</strong></td>";
			echo "<td align='center'><strong>".$totalSPT1."</strong></td>";
			echo "</tr>";
			?>
			</table>
			<span><i class="glyphicon glyphicon-print"></i>&nbsp;<a href="<?php echo site_url();?>/pengemasan/cetak_checklist_register/" target="_blank">Cetak lembar checklist</a></span>
		</div>
		<br/>
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tbl-ga" id="myTable">
				<thead>
					<tr>
						<th class="text-center">BULAN TERIMA</th>
						<th class="text-center">JENIS SPT</th>
						<th class="text-center">JUMLAH REGISTER</th>
						<th class="text-center">JUMLAH SPT</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$theSite = site_url();
					foreach($datanya as $r){
						echo "<tr>";
						echo "<td align='left'>".strtoupper($r->nm_bulan)."</td>";
						echo "<td align='left'>".$r->JNSSPT."</td>";
						echo "<td align='center'><a href='".$theSite."/pengemasan/detail_reg_blm_akuintasi/".$r->KDSPT."/".$r->BLNTERIMA."'>".$r->JMLREG."</a></td>";
						echo "<td align='center'>".$r->JMLSPT."</td>";
						echo "</tr>";
						$totalREG += $r->JMLREG;
						$totalSPT += $r->JMLSPT;
					}
					?>
				</tbody>
			<?php
			echo "<tr>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'><strong>TOTAL :</strong></td>";
			echo "<td align='center'><strong>".$totalREG."</strong></td>";
			echo "<td align='center'><strong>".$totalSPT."</strong></td>";
			echo "</tr>";
			?>
			</table>
		</div>
		<br/>
		<p><i>*  : Tanggal paling awal dari : Tgl register SPT bagi SPT ber-Register atau Tgl terima berkas untuk SPT Non-Register.</i></p>
		<p><i>** : Tanggal Jatuh Tempo (30 Hari setelah tgl register/tgl terima).</i></p>
	</div>
</div>
<script>
$(function(){
	$("#myTable").tablesorter();
});
</script>