<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DAFTAR REGISTER BELUM KEMAS</strong></h4></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tablesorter table-responsive tbl-qa" id="myTable">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">JENIS SPT</th>
						<th class="text-center">JUMLAH REGISTER</th>
						<th class="text-center">JUMLAH SPT</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$theSite = site_url();
					$no = 1;
					foreach($datanya as $r){
						echo "<tr>";
						echo "<td class='text-center'>".$no."</td>";
						echo "<td align='left'>".$r->nm_spt."</td>";
						echo "<td align='center'><a href='".$theSite."/pengemasan/detailRegBlmKms/".$r->jns_spt."'>".$r->JML_REG."</a></td>";
						echo "<td align='center'>".$r->JML_SPT."</td>";
						echo "</tr>";
						$no++;
						$totalREG += $r->JML_REG;
						$totalSPT += $r->JML_SPT;
					}
					?>
				</tbody>
			</table>
			<table class="table table-bordered table-condensed table-striped table-responsive">
			<?php
			echo "<tr><td></td><td></td><td></td><td></td></tr>";
			echo "<tr>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'>TOTAL</td>";
			echo "<td align='center'><strong>".$totalREG."</strong></td>";
			echo "<td align='center'><strong>".$totalSPT."</strong></td>";
			echo "</tr>";
			?>
			</table>
		</div>
	</div>
</div>
<script>
$(function(){
	$("#myTable").tablesorter();
});
</script>