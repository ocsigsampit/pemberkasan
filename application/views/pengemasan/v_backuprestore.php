<?php ob_start();?>
<form action="<?php echo base_url();?>index.php/pengemasan/act_backup_table/" method="post">
	<label for="tabel">Pilih table</label>
    <!--
	<select required="" name="tabel">
        <?php
		/*
		foreach ($tabel as $baris){ ?>
            <option value="<?php echo $baris->Tables_in_pengemasan; ?>"><?php echo $baris->Tables_in_pengemasan; ?></option>
        <?php } */?>
    </select>
	-->
	<table>
		<?php
		foreach($tabel as $baris){ ?>
			<tr>
				<td><input type="checkbox" name="tabel" value="<?=$baris->Tables_in_pengemasan;?>" id-chk="<?php echo $baris->Tables_in_pengemasan;?>">&nbsp;&nbsp;<?=$baris->Tables_in_pengemasan;?></input></td>
				<td>&nbsp;&nbsp;<button type="submit" onclick="return confirm('Backup table ini?')" class="btn btn-success btn-xs" id="<?php echo 'btn_'.$baris->Tables_in_pengemasan;?>">Backup</button></td>
			</tr>
		<?php } ?>
	</table>
</form>
<script>
$(function(){
	$(".btn").hide();
	
	$("input[name='tabel'").change(function(){
		if(this.checked == true){
			var id_chk = $(this).attr("id-chk");
			var id_button = "#btn_" + id_chk;
			//console.log(id_button);
			
			$(id_button).show();
			//alert("UNCHECKED!!");
		}else{
			var id_chk = $(this).attr("id-chk");
			var id_button = "#btn_" + id_chk;
			//console.log(id_button);
			
			$(id_button).hide();
		}
	});
	
});
</script>
<?php ob_end_flush();?>