<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>PENCARIAN PADA DAFTAR DETAIL KEMASAN</strong></h4><br><h5>Hanya pada kemasan berformat baru</h5></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tablesorter table-responsive tbl-qa" id="table_pengemasan">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">NAMA WAJIB PAJAK</th>
						<th class="text-center">N P W P</th>
						<th class="text-center">NO BPS</th>
						<th class="text-center">KODE BARCODE</th>
						<th class="text-center">KODE SEGEL</th>
						<th class="text-center">TGL KEMAS</th>
						<th class="text-center">TGL AMBIL</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach($semua as $r){
						echo "<tr>";
						echo "<td class='text-center'>".$no."</td>";
						echo "<td align='left'>".$r->nama_wp."</td>";
						echo "<td align='center'>".$r->npwp."</td>";
						echo "<td align='left'>".$r->no_lpad."</td>";
						echo "<td align='center'>".$r->bc_kemasan."</td>";
						echo "<td align='center'>".$r->segel_kemasan."</td>";
						echo "<td align='center'>".$r->tgl_kemas."</td>";
						echo "<td align='center'>".$r->tgl_diambil."</td>";
						echo "</tr>";
						$no++;
						//$totalSPT += $r->jml_spt;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$("#table_pengemasan").DataTable();
});
</script>