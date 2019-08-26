<?php error_reporting(E_ERROR | E_PARSE);?>
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><h2>DATA REGISTER</h2></div>
			<div class="panel-body">
				<table id="table-data" class="table table-striped">
					<thead>
						<tr>
							<th class="text-center">NO</th>
							<th class="text-center">NAMA PEGAWAI</th>
							<th class="text-center">NO REGISTER</th>
							<th class="text-center">JENIS SPT</th>
							<th class="text-center">JML SPT</th>
							<th class="text-center">TGL TERIMA</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody id="table-body">
					<?php
					$no=1;
					foreach($semua as $r){
						echo "<tr>";
						echo "<td class='text-center'>".$no."</td>";
						echo "<td class='text-left nowrap'>".$r->nm_pegawai."</td>";
						echo "<td class='text-center'>".$r->no_reg."</td>";
						echo "<td class='text-left'>".$r->nm_spt."</td>";
						echo "<td class='text-center'>".$r->jml_spt."</a></td>";
						echo "<td class='text-center'>".$r->tgl_terima."</td>";
						echo "<td class='text-center'>
							<a href='' class='trg_edit'><i class='glyphicon glyphicon-pencil'></i></a>
							<span><span/>
							<a href='' class='trg_hapus'><i class='glyphicon glyphicon-trash'></i></a>
							</td>";
						echo "</tr>";
						$no++;
						$tot_a += $r->jml_spt;
					}
					echo "<tr>";
					echo "<td class='text-center'></td>";
					echo "<td class='text-left'>T O T A L</td>";
					echo "<td class='text-center'></td>";
					echo "<td class='text-left'></td>";
					echo "<td class='text-center'>".$tot_a."</td>";
					echo "<td class='text-center'></td>";
					echo "</tr>";
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
