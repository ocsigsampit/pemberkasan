<div class="panel panel-default">
	<div class="panel-heading"><h4>DAFTAR PERMOHONAN PEMINJAMAN BERKAS</h4></div>
	<div class="panel-body">
		<table id="table-data" class='table display compact table-bordered table-condensed table-striped tbl-ga tablesorter'>
			<thead>
				<tr>
					<th class="text-center">NO</th>
					<th class="text-center">NO NOTA DINAS</th>
					<th class="text-center">TGL ND</th>
					<th class="text-center">Cetak ND</th>
					<th class="text-center">STATUS</th>
				</tr>
			</thead>
			<tbody id="table-body">
			<?php
			$no=1;
			foreach($semua as $r){
				echo "<tr>";
				echo "<td class='text-center'>".$no."</td>";
				echo "<td class='text-left'>".$r->no_nd."</td>";
				echo "<td class='text-center'>".$r->tgl_nd."</td>";
				//echo "<td class='text-center'><buton class='btn btn-info btn-xs' id='tmb_cetak_nd' data-id_peminjaman='".$r->id_peminjaman."'>Cetak ND</button></td>";
				
				echo "<td class='text-center'><a href='".base_url('/pemberkasan/cetakND/')."/".$r->id_peminjaman."' class='btn btn-xs btn-info'>Cetak ND</a></td>";
				
				if($r->tgl_selesai == '0000-00-00 00:00:00' || $r->tgl_selesai == null){
					echo "<td class='text-center'>Proses</td>";
				}else{
					echo "<td class='text-center'>Berkas telah siap !</td>";
				}
				
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