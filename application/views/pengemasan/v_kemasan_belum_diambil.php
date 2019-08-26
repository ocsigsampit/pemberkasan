<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DAFTAR KEMASAN BELUM DIAMBIL PPDDP</strong></h4></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tbl-ga" id="myTable">
				<thead>
					<tr>
						<th class="text-center">NO.</th>
						<th class="text-center">JENIS SPT</th>
						<th class="text-center">JML KEMASAN</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$theSite = site_url();
					$no = 1;
					foreach($kemasan as $q){
						echo "<tr>";
						echo "<td align='center'>".$no."</td>";
						echo "<td align='left'>".$q->JNSSPT."</td>";
						echo "<td align='center'><a href='".site_url()."/pengemasan/detail_kemasan_belum_diambil/".$q->id_spt."/'>".$q->JMLKEMASAN."</td>";
						echo "</tr>";
						$no++;
						$totalKemasan += $q->JMLKEMASAN;
					}
					?>
				</tbody>
			<?php
			echo "<tr>";
			echo "<td class='text-center'></td>";
			echo "<td class='text-center'><strong>TOTAL </strong></td>";
			echo "<td align='center'><strong>".$totalKemasan."</strong></td>";
			echo "</tr>";
			?>
			</table>
		</div>
		<span><i class="glyphicon glyphicon-print"></i>&nbsp;<a href="<?php echo site_url();?>/pengemasan/cetak_checklist_kemasan/" target="_blank">Cetak PDF</a></span>
	</div>
</div>
<script>
$(function(){
	$(".table").tablesorter();
});
</script>