<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3><strong>CHECKLIST KEMASAN BELUM DIAMBIL PPDDP</strong></h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tbl-ga" id="myTable">
				<thead>
					<tr>
						<th class="text-center">NO.</th>
						<th class="text-center">JENIS SPT</th>
						<th class="text-center">BARCODE KEMASAN</th>
						<th class="text-center">SEGEL KEMASAN</th>
						<th class="text-center">JML SPT</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach($kemasan as $q){
						echo "<tr>";
						echo "<td align='center'>".$no."</td>";
						echo "<td align='left'>".$q->JNSSPT."</td>";
						echo "<td align='center'>".$q->bc_kemasan."</td>";
						echo "<td align='center'><strong>".$q->segel_kemasan."</strong></td>";
						echo "<td align='center'>".$q->jml_spt."</td>";
						echo "</tr>";
						$no++;
					}
					?>
				</tbody>
			</table>
		</div>
		<a href="<?php echo site_url();?>/pengemasan/cetak_checklist_kemasan/" target="_blank">Cetak lembar checklist</a>
	</div>
</div>
<script>
$(function(){
	$(".table").tablesorter();
});
</script>