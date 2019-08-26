<div class="panel panel-default">
	<div class="panel-heading"><h4>DAFTAR PERMOHONAN PEMINJAMAN BERKAS</h4></div>
	<div class="panel-body">
		<table id="table-data" class='table display compact table-bordered table-condensed table-striped tbl-ga tablesorter'>
			<thead>
				<tr>
					<th class="text-center">NO</th>
					<th class="text-center">NAMA PEGAWAI</th>
					<th class="text-center">NO NOTA DINAS</th>
					<th class="text-center">TGL ND</th>
					<th class="text-center">TGL ENTRY</th>
					<th class="text-center"></th>
				</tr>
			</thead>
			<tbody id="table-body">
			<?php
			$no=1;
			//print_r($semua);
			foreach($semua as $r){
				echo "<tr>";
				echo "<td class='text-center'>".$no."</td>";
				echo "<td class='text-left nowrap'>".$r->nama."</td>";
				echo "<td class='text-left'><a href='".base_url()."pemberkasan/detail/".$r->id_peminjaman."' onClick='confirm(\'Yakin?\')'>".$r->no_nd."</a></td>";
				echo "<td class='text-center'>".$r->tgl_nd."</td>";
				echo "<td class='text-center'>".$r->tgl_pinjam."</td>";
				
				if($r->tgl_selesai == '0000-00-00 00:00:00' || $r->tgl_selesai == null){
					echo "<td class='text-center'><button class='btn btn-info btn-xs tmb_selesai' data-id_peminjaman='".$r->id_peminjaman."'>Siap !</button></td>";
				}else{
					echo "<td class='text-center'>Selesai</td>";
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