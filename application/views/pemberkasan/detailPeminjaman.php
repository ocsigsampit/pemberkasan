<div class="panel panel-default">
	<div class="panel-heading"><h4>Detail PERMOHONAN PEMINJAMAN BERKAS</h4></div>
	<div class="panel-body">
		<table id="table-data" class='table display compact table-bordered table-condensed table-striped tbl-ga tablesorter'>
			<thead>
				<tr>
					<th class="text-center">NO</th>
					<th class="text-center">N P W P</th>
					<th class="text-center">Nama Wajib Pajak</th>
					<th class="text-center">Jenis Berkas</th>
					<th class="text-center">MS/THN Pjk</th>
					<th class="text-center">Pbt</th>
					<th class="text-center">KD BOX</th>
					<th class="text-center">Ruangan</th>
				</tr>
			</thead>
			<tbody id="table-body">
			<?php
			$no=1;
			foreach($semua as $r){
				echo "<tr>";
				echo "<td class='text-center'>".$no."</td>";
				echo "<td class='text-center'>".kasih_titik($r->npwp)."</td>";
				echo "<td class='text-left nowrap'>".$r->nama_wp."</td>";
				echo "<td class='text-left'>".$r->jenis_berkas."</td>";
				echo "<td class='text-center'>".$r->msthn."</td>";
				echo "<td class='text-center'>".$r->pembetulan."</td>";
				echo "<td class='text-center'>".$r->id_box."</td>";
				echo "<td class='text-center'>".$r->ruangan."</td>";
				echo "</tr>";
				$no++;
			}
			?>
			</tbody>
		</table>
	</div>
</div>
<script>
$(function(){
	$("#table-data").tablesorter();
});
</script>