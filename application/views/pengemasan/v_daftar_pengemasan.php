<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DAFTAR PENGEMASAN</strong></h4></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tablesorter table-responsive tbl-qa" id="table_pengemasan">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">ID PENGEMASAN</th>
						<th class="text-center">TGL KEMAS</th>
						<th class="text-center">JENIS SPT</th>
						<th class="text-center">KODE BARCODE</th>
						<th class="text-center">KODE SEGEL</th>
						<th class="text-center">JML SPT</th>
						<th class="text-center">TGL AMBIL</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$theSite = site_url();
					$no = 1;
					foreach($semua as $r){
						echo "<tr>";
						echo "<td class='text-center'>".$no."</td>";
						echo "<td align='center'>".$r->id_pengemasan."</td>";
						echo "<td align='center'>".$r->ftgl_kemas."</td>";
						echo "<td align='left'>".$r->nm_spt."</td>";
						echo "<td align='center'>".$r->bc_kemasan."</td>";
						echo "<td align='center'>".$r->segel_kemasan."</td>";
						if($r->JML_LPAD == 0){
							echo "<td align='right'>".$r->jml_spt."</td>";
						}else{
							echo "<td align='right'><a href=".$theSite."/pengemasan/isiKemasan/".$r->bc_kemasan.">".$r->jml_spt."</a></td>";
						}
						echo "<td align='center'>".$r->ftgl_diambil."</td>";
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