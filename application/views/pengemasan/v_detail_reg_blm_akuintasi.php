<?php error_reporting(E_ERROR | E_PARSE);
if($this->uri->segment(3) == "SPT01"){
	$nama_spt = "SPT Tahunan PPh BADAN";
}elseif($this->uri->segment(3) == "SPT02"){
	$nama_spt = "SPT Tahunan PPh OP 1770";
}elseif($this->uri->segment(3) == "SPT03"){
	$nama_spt = "SPT Tahunan PPh OP 1770 S";
}elseif($this->uri->segment(3) == "SPT04"){
	$nama_spt = "SPT Tahunan PPh OP 1770 SS";
}elseif($this->uri->segment(3) == "SPT05"){
	$nama_spt = "SPT Masa PPh Pasal 21";
}elseif($this->uri->segment(3) == "SPT06"){
	$nama_spt = "SPT Masa PPN Pedangan Eceran";
}elseif($this->uri->segment(3) == "SPT11"){
	$nama_spt = "SPT Masa PPh Pasal 23";
}else{
	$nama_spt = "unknown";
}
?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>REGISTER BELUM AKUINTASI&nbsp;<?=$nama_spt;?></strong></h4></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tbl-ga" id="myTable">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">NAMA PENERIMA SPT</th>
						<th class="text-center">NOMOR REGISTER</th>
						<th class="text-center">JUMLAH SPT</th>
						<th class="text-center">TGL TERIMA</th>
						<th class="text-center">UMUR</th>
						<th class="text-center"></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$jumlah = 0;
					foreach($datanya as $r){
						echo "<tr>";
						echo "<td class='text-center'>".$no."</td>";
						echo "<td align='left'>".$r->nm_pegawai."</td>";
						echo "<td align='left'>".$r->no_reg."</td>";
						echo "<td align='center'>".$r->jml_spt."</td>";
						echo "<td align='center'>".$r->TGLREG."</td>";
						
						if($r->UMUREG >= 30){ 
							echo "<td align='center' class='text-danger'>".$r->UMUREG."&nbsp;Hari</td>"; 
						}elseif($r->UMUREG < 30 && $r->UMUREG >= 20){
							echo "<td align='center' class='text-warning'>".$r->UMUREG."&nbsp;Hari</td>"; 
						}else{
							echo "<td align='center' class='text-info'>".$r->UMUREG."&nbsp;Hari</td>";
						}
						
						echo "<td align='center'><a href='javascript:void()' class='tmb_modal text-danger' data-id-reg='".$r->id."' data-no-reg='".$r->no_reg."' data-jum-reg='".$r->jml_spt."'>Hapus !</span></a></td>";
						echo "</tr>";
						$no++;
						$totSPT += $r->jml_spt;
						$jumlah++; 
					}
					?>
				</tbody>
					<tr>
						<td></td>
						<td><strong><?=$jumlah;?>&nbsp;Register dengan&nbsp;<?=$totSPT;?>&nbsp;berkas SPT</strong></td>
						<td></td>
						<td align="center"><strong><?=$totSPT;?></strong></td>
					</tr>
			</table>
		</div>
	</div>
</div>
<!-- modal_edit-->
<div class="modal_edit modal fade" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">HAPUS REGISTER</h4>
			</div>
			
			<div class="modal-body">
				<div role="form">
					<div class="row">
						<div class="form-group col-lg-3">
							<label for="id">ID Register</label> 
							<input type="text" class="form-control text-center" id="id" readonly> 
						</div>
					</div>
					<div class="row">
						<div class="form-group col-lg-6">
							<label for="no_reg">Nomor Register</label> 
							<input type="text" class="form-control col-lg-4" id="no_reg" readonly> 
						</div>
					</div>
					<div class="row">
						<div class="form-group col-lg-3">
							<label for="jum_spt">Jumlah SPT</label> 
							<input type="text" class="form-control col-lg-1 text-right" id="jum_spt" readonly> 
						</div>
					</div>
					<div class="checkbox form-group">
						<label><input type="checkbox" id="batal"><strong> Hapus! </strong></label> 
					</div>
					<div class="row">
						<div class="form-group col-lg-12">
							<label for="alasan">Alasan Penghapusan Register</label> 
							<textarea class="form-control" rows="3" id="alasan" readonly></textarea> 
						</div>
					</div>
					
				</div>
				
			</div>
			
			<div class="modal-footer">
				<button class="btn btn-success" id="tmb_simpan_perubahan"><span>Simpan</span></button>
				<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$("#tmb_simpan_perubahan").hide();
	
	$(".tmb_modal").click(function(){
		var id_register = $(this).attr("data-id-reg");
		var no_register = $(this).attr("data-no-reg");
		var jum_spt     = $(this).attr("data-jum-reg");
		
		$("#id").val(id_register);
		$("#no_reg").val(no_register);
		$("#jum_spt").val(jum_spt);
		$(".modal_edit").modal("show");
	});
	
	$("#batal").click(function(){
		if($(this).prop("checked")){
			$("#alasan").removeAttr("readonly");
			$("#alasan").focus();
			$("#tmb_simpan_perubahan").show();
		}else{
			$("#alasan").attr("readonly", "readonly");
			$("#tmb_simpan_perubahan").hide();
		}
	});
	
	$("#tmb_simpan_perubahan").click(function(){
		if(confirm("Anda yakin ?")){
			var theSite     = "<?php echo site_url();?>";
			var id_register = $("#id").val();
			var alasan      = $("#alasan").val();

			$.ajax({
				type : "post",
				url  : theSite + "/pengemasan/simpanUbahanStatusRegister/",
				data : "id_register=" + id_register + "&alasan=" + alasan,
				success : function(respon){
					if(respon == "1"){
						alert("Data berhasil disimpan!");
					}else{
						alert("Gagal!!!!");
					}
				}
			});
		}
	});
});
</script>