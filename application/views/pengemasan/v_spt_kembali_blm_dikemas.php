<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DAFTAR SPT BELUM DIKEMAS ULANG</strong></h4></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tbl-ga" id="myTable">
				<thead>
					<tr>
						<th class="text-center">NO.</th>
						<th class="text-center">NO SP</th>
						<th class="text-center">TGL SP</th>
						<th class="text-center">JENIS SPT</th>
						<th class="text-center">NO BPS AWAL</th>
						<th class="text-center">NPWP</th>
						<th class="text-center">ALASAN KEMBALI</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$theSite = site_url();
					$no = 1;
					foreach($datanya as $q){
						echo "<tr>";
						echo "<td align='center'>".$no."</td>";
						echo "<td align='left'>".$q->no_surat."</td>";
						echo "<td align='center'>".$q->tgl_terima_sp."</td>";
						echo "<td align='left'>".noBPS2SPT($q->no_lpad)."</td>";
						echo "<td align='left'>".$q->no_lpad."</td>";
						echo "<td align='left'>".kasih_titik($q->npwp)."</td>";
						echo "<td align='left'>".$q->alasan."&nbsp;<i class = 'glyphicon glyphicon-info-sign'></i></td>";
						echo "</tr>";
						$no++;
					}					
					?>
				</tbody>
			</table>
			<span><i class="glyphicon glyphicon-print"></i>&nbsp;<a href="<?php echo site_url();?>/pengemasan/cetak_pengembalian_blm_kemas/" target="_blank">Cetak lembar checklist</a></span>
		</div>
	</div>
</div>
<script>
$(function(){
	$("#myTable").tablesorter();
});
</script>