<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default" onLoad="tanya()">
	<div class="panel-heading"><h4><strong>REGISTER BELUM KEMAS</strong></h4></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tablesorter table-responsive tbl-qa" id="myTable">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">NAMA PENERIMA SPT</th>
						<th class="text-center">NOMOR REGISTER</th>
						<th class="text-center">JUMLAH SPT</th>
						<th class="text-center">TGL TERIMA</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach($datanya as $r){
						echo "<tr>";
						echo "<td class='text-center'>".$no."</td>";
						echo "<td align='left'>".$r->nm_pegawai."</td>";
						echo "<td align='center'>".$r->no_reg."</td>";
						echo "<td align='center'>".$r->jml_spt."</td>";
						echo "<td align='center'>".$r->TGLTERIMA."</td>";
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
$(function(){
	
	function tanya(){
		var jawab = prompt("Tanggal kemas terakhir sebelum minggu ini");
		alert(jawab);
	}
	
	tanya();
});
</script>