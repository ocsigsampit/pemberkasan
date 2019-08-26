<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DAFTAR BERKAS KEMBALI<span class='text-info'>&nbsp;<?=$no_sp;?>&nbsp;</span></strong></h4></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tablesorter table-responsive tbl-qa" id="table_detail_pengembalian">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">NO LPAD</th>
						<th class="text-center">NPWP</th>
						<th class="text-center">NO LPAD BARU</th>
						<th class="text-center">NO SURAT</th>
						<th class="text-center">ALASAN</th>
						<th class="text-center">KODE BARCODE</th>
						<th class="text-center">TGL KEMAS</th>
						<th class="text-center">KETERANGAN</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach($semua as $r){
						echo "<tr>";
						echo "<td class='text-center'>".$no."</td>";
						echo "<td align='left'>".$r->no_lpad."</td>";
						echo "<td align='left'>".$r->npwp."</td>";
						echo "<td align='left'>".$r->no_lpad_baru."</td>";
						if($this->session->userdata('role') == '1') {
							echo "<td align='left'><a href='".site_url()."/pengemasan/manage_data_pengembalian/".$r->id_pengembalian."'>".$r->no_surat."</a></td>";
						}else{
							echo "<td align='left'>".$r->no_surat."</td>";
						}
						echo "<td align='left'>".$r->alasan."</td>";
						echo "<td align='center'>".$r->barcode_kemasan."</td>";
						echo "<td align='center'>".$r->tglkemas."</td>";
						echo "<td align='left'>".$r->catatan."</td>";
						echo "</tr>";
						$no++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$("#table_detail_pengembalian").DataTable();
});
</script>