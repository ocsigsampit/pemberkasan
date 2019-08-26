<?php
$title = "BPS_Pengganti_".date("dmY");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1" width="100%">
	<thead>
		<tr>
			<th>NO</th>
			<th>NO LPAD LAMA</th>
			<th>NO LPAD BARU</th>
			<th>KODE KPP</th>
			<th>KETERANGAN</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 1; 
		foreach($daftar as $baris){ 
		?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $baris->NO_LPAD_LAMA; ?></td>
			<td><?php echo $baris->NO_LPAD_BARU; ?></td>
			<td><?php echo $baris->KODE_KPP; ?></td>
			<td><?php echo $baris->KETERANGAN; ?></td>
		</tr>
		<?php 
		$no++; 
		}?>
	</tbody>
</table>