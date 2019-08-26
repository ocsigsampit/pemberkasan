<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default">
	<div class="panel-heading"><h2>DAFTAR PENGEMASAN <?=$waktu;?></h2></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tablesorter table-responsive tbl-qa" id="myTable">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">TGL KEMAS</th>
						<th class="text-center">JENIS SPT</th>
						<th class="text-center">KODE BARCODE</th>
						<th class="text-center">KODE SEGEL</th>
						<th class="text-center">JML SPT</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach($semua as $r){
						echo "<tr>";
						echo "<td class='text-center'>".$no."</td>";
						echo "<td align='center'>".$r->tgl_kemas."</td>";
						echo "<td align='left'>".$r->nm_spt."</td>";
						echo "<td align='center'>".$r->bc_kemasan."</td>";
						echo "<td align='center'>".$r->segel_kemasan."</td>";
						echo "<td align='right'>".$r->jml_spt."</td>";
						echo "</tr>";
						$no++;
						$totalSPT += $r->jml_spt;
					}
					?>
					echo "<tr>";
						echo "<td class='text-center'></td>";
						echo "<td align='center'></td>";
						echo "<td align='left'></td>";
						echo "<td align='center'></td>";
						echo "<td align='center'></td>";
						echo "<td align='right'>".$totalSPT."</td>";
						echo "</tr>";
				</tbody>
			</table>
		</div>
	</div>
</div>	