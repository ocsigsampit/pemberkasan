<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DETAIL PENGEMBALIAN <span class='text-info'>&nbsp;<?=$no_sp.", TGL TERIMA : ".substr($tgl_terima,0,10);?>&nbsp;</span></strong></h4></div>
	<div class="panel-body">
		<table class='table table-bordered table-condensed table-striped tbl-ga' id="detail-pengembalian">
			<thead>
				<tr>
					<th class='text-center'>NO</th>
					<th class='text-center'>NO LPAD</th>
					<th class='text-center'>JNS SPT</th>
					<th class='text-center'>N P W P</th>
					<th class='text-center'>ALASAN</th>
					<th class='text-center'>TGL TERIMA</th>
					<th class='text-center'>NO LPAD BARU</th>
					<th class='text-center'>BARCODE KEMASAN</th>
					<th class='text-center'>CATATAN</th>
					<th class='text-center'>TGL EMAIL</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$nomer = 1;
			foreach($data_pengembalian as $v){
				$id    = $v->id_berkas;
			?>
				<tr>
					<td class='text-center'><?php echo $nomer;?></td>
					<td class='text-nowrap text-left'><?php echo $v->no_lpad;?></td>
					<td class='text-nowrap text-left'><?php echo $v->jns_spt;?></td>
					<td class='text-center'><?php echo kasih_titik($v->npwp);?></td>
					<td class='text-left'><?php echo $v->alasan;?></td>
					
					<?php if($v->selesai == 0){?>
					
					<td contenteditable='true' class='text-center' onBlur='simpanOnBlur(this,"<?php echo $id;?>","tgl_terima_tinjut");' onClick='showEdit(this);'><?php echo $v->tgl_terima_tinjut;?></td>
					<td contenteditable='true' class='text-left' onBlur='simpanOnBlur(this,"<?php echo $id;?>","no_lpad_baru");' onClick='showEdit(this);'><?php echo $v->no_lpad_baru;?></td>
					<td contenteditable='true' class='text-center' onBlur='simpanOnBlur(this,"<?php echo $id;?>","barcode_kemasan");' onClick='showEdit(this);'><?php echo $v->barcode_kemasan;?></td>
					<td contenteditable='true' class='text-left' onBlur='simpanOnBlur(this,"<?php echo $id;?>","catatan");' onClick='showEdit(this);'><?php echo $v->catatan;?></td>
					<td contenteditable='true' class='text-center' onBlur='simpanOnBlur(this,"<?php echo $id;?>","tgl_email");' onClick='showEdit(this);'><?php echo $v->tgl_email;?></td>
					<td><input type='checkbox' data-chk='<?=$id;?>' class='chk_bar' <?php if ($v->selesai == '1') {?> checked='checked' onclick='return false;' disabled/><?php } ?></td>
					
					<?php }else{ ?>
					
					<td class='text-center'><?php echo $v->tgl_terima_tinjut;?></td>
					<td class='text-left'><?php echo $v->no_lpad_baru;?></td>
					<td class='text-center'><?php echo $v->barcode_kemasan;?></td>
					<td class='text-left'><?php echo $v->catatan;?></td>
					<td class='text-center'><?php echo $v->tgl_email;?></td>
					<td><input type='checkbox' data-chk='<?=$id;?>' class='chk_bar' <?php if ($v->selesai == '1') {?> checked='checked' onclick='return false;' disabled/><?php } ?></td>
					
					<?php } ?>
				</tr>
			<?php
			$nomer++;
			}
			?>
			</tbody>
		</table>
		<!--<input type="button" class="btn btn-success" value="Simpan"/>-->
	</div>
</div>

<script>
$(function(){
	var theSite = "<?php echo site_url();?>";
	
	$("#detail-pengembalian").tablesorter();
	
	$(".chk_bar").click(function(){
		var nilai = $(this).attr("data-chk");
		
		if($(this).prop("checked")){
			//alert("Dari 0 menjadi 1\nDengan nilai :" + nilai);
			$.ajax({
				url  : theSite + "/pengemasan/ubah_selesai/",
				type : "post",
				data : "id_berkas=" + nilai,
				success : function(hasil){
					if(hasil == "1"){
						alert("Berkas telah selesai!");
					}else{
						alert("Gagal!");
					}
				}
			});
		}else{
			alert("Dari 1 menjadi 0\nDengan nilai :" + nilai);
		}
	});
});
</script>
