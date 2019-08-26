<?php error_reporting(E_ERROR | E_PARSE);?>
<style>
#load_diplay{
	top : 50px;
	right : 0px;
	position : fixed;
	width : 150px;
	background : #57B847;
}
</style>
<div class="panel panel-default">
	<div class="panel-heading"><h4>REKAP PENGIRIM SPT</h4></div>
	<div class="panel-body">
		<table id="table-data" class="table table-bordered table-striped">
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
					<th class="text-center">JUMLAH</th>
				</tr>
			</thead>
			<tbody id="table-body">
			<?php
			$no=1;
			foreach($semua as $r){
				echo "<tr>";
				echo "<td class='text-center'>".$no."</td>";
				echo "<td class='text-left nowrap'>".$r->nm_pegawai."</td>";
				echo "<td class='text-right'>".$r->S1771."</td>";
				echo "<td class='text-right'>".$r->S1770."</td>";
				echo "<td class='text-right'>".$r->S1770S."</td>";
				echo "<td class='text-right'>".$r->S1770SS."</td>";
				echo "<td class='text-right'>".$r->S21."</td>";
				echo "<td class='text-right'>".$r->SPPN."</td>";
				echo "<td class='text-right'>".$r->JML."</td>";
				echo "</tr>";
				$no++;
				$tot_a += $r->JML;
			}
			?>
			</tbody>
			<tfoot>
			<?php
			echo "<tr>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-left'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-right'></td>";
			echo "</tr>";
			/*membuat jeda*/
			echo "<tr>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-left'>T O T A L</td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-right'><b>".$tot_a."</b></td>";
			echo "</tr>";
			?>
			</tfoot>
		</table>
	</div>
</div>
<script>
$(function(){
	$("#table-data").tablesorter();
});
</script>