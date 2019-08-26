<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><h4> REKAPITULASI REGISTER <?=$waktu;?></h4></div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped tbl-ga tablesorter table-responsive" id="myTable">
						<thead>
							<tr>
								<th class="text-center">NO</th>
								<th class="text-center">NAMA PEGAWAI</th>
								<th class="text-center">1771</th>
								<th class="text-center">1770</th>
								<th class="text-center">1770 S</th>
								<th class="text-center">1770 SS</th>
								<th class="text-center">PPh 21</th>
								<th class="text-center">PPN DM</th>
								<th class="text-center">PPh 23</th>
								<th class="text-center">1771 CPT</th>
								<th class="text-center">1770 CPT</th>
								<th class="text-center">1770S CPT</th>
								<th class="text-center">1770SS CPT</th>
								<th class="text-center">JML SPT</th>
								<th class="text-center">JML REG</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							$tot1771 = 0;
							$tot1770 = 0;
							foreach($reg_hari_ini as $r){
								echo "<tr>";
								echo "<td class='text-center'>".$no."</td>";
								echo "<td align='nowrap text-left'>".$r->nm_pegawai."</td>";
								echo "<td align='center'>".$r->S1771."</td>";
								echo "<td align='center'>".$r->S1770."</td>";
								echo "<td align='center'>".$r->S1770S."</td>";
								echo "<td align='center'>".$r->S1770SS."</td>";
								echo "<td align='center'>".$r->S21."</td>";
								echo "<td align='center'>".$r->SPPN."</td>";
								echo "<td align='center'>".$r->S23."</td>";
								echo "<td align='center'>".$r->S1771CPT."</td>";
								echo "<td align='center'>".$r->S1770CPT."</td>";
								echo "<td align='center'>".$r->S1770SCPT."</td>";
								echo "<td align='center'>".$r->S1770SSCPT."</td>";
								echo "<td align='center'>".$r->JML."</td>";
								echo "<td align='center'>".$r->JML_REG."</td>";
								echo "</tr>";
								$no++;
								$tot_1771 += $r->S1771;
								$tot_1770 += $r->S1770;
								$tot_1770S += $r->S1770S;
								$tot_1770SS += $r->S1770SS;
								$tot_21 += $r->S21;
								$tot_PPN += $r->SPPN;
								$tot_23 += $r->S23;
								$tot_1771CPT += $r->S1771CPT;
								$tot_1770CPT += $r->S1770CPT;
								$tot_1770SCPT += $r->S1770SCPT;
								$tot_1770SSCPT += $r->S1770SSCPT;
								$tot_all += $r->JML;
								$tot_reg_all += $r->JML_REG;
							}
							?>
						</tbody>
						<?php
						echo "<tr class='text-bold'>";
						echo "<td align='center'></td>";
						echo "<td align='center'>TOTAL</td>";
						echo "<td align='center'>".$tot_1771."</td>";
						echo "<td align='center'>".$tot_1770."</td>";
						echo "<td align='center'>".$tot_1770S."</td>";
						echo "<td align='center'>".$tot_1770SS."</td>";
						echo "<td align='center'>".$tot_21."</td>";
						echo "<td align='center'>".$tot_PPN."</td>";
						echo "<td align='center'>".$tot_23."</td>";
						echo "<td align='center'>".$tot_1771CPT."</td>";
						echo "<td align='center'>".$tot_1770CPT."</td>";
						echo "<td align='center'>".$tot_1770SCPT."</td>";
						echo "<td align='center'>".$tot_1770SSCPT."</td>";
						echo "<td align='center'>".$tot_all."</td>";
						echo "<td align='center'>".$tot_reg_all."</td>";
						echo "</tr>";
						?>
					</table>
				</div>
			</div>
		</div>	
	</div>
</div>

<script>
$(function(){
	$("#myTable").tablesorter();
});
</script>