<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>DAFTAR ISI KEMASAN </strong></h4>
		<table>
			<tr>
				<td>Barcode Kemasan</td>
				<td>&nbsp;:&nbsp;</td>
				<td><strong><?=$barcode;?></strong></td>
			</tr>
			<tr>
				<td>Segel Kemasan</td>
				<td>&nbsp;:&nbsp;</td>
				<td><?=$segel;?></td>
			</tr>
			<tr>
				<td>Tanggal Kemas</td>
				<td>&nbsp;:&nbsp;</td>
				<td><?=$tgl_kemas;?></td>
			</tr>
		</table>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tablesorter table-responsive tbl-qa" id="isi_kemasan">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">NO LPAD</th>
						<th class="text-center">NPWP</th>
						<th class="text-center">NAMA WAJIB PAJAK</th>
						<th class="text-center">BARCODE</th>
						<th class="text-center">JML</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$theSite = site_url();
					$no = 1;
					foreach($isi as $r){
						echo "<tr>";
						echo "<td class='text-center'>".$no."</td>";
						echo "<td align='center'>".$r->no_lpad."</td>";
						echo "<td align='center'>".$r->npwp."</td>";
						echo "<td align='left'>".$r->nama_wp."</td>";
						echo "<td align='center'>".$r->bc_berkas."</td>";
						echo "<td align='center'>".$r->jml_lembar."</td>";
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
	$("#isi_kemasan").DataTable();
});
</script>