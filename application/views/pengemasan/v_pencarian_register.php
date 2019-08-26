<style>
#load_diplay{
	top : 50px;
	right : 0px;
	position : fixed;
	width : 150px;
	background : #57B847;
}
</style>

<div class="container">
	<div class="row>">
		<div id="load_diplay"></div>
		<div class="panel panel-default">
			<div class="panel-heading"><h4><strong>PENCARIAN REGISTER</strong></h4></div>
			<div class="panel-body">
				<div class="form-horizontal col-sm-12 col-lg-12">
					
					<div class="form-group">
						<label  class="col-sm-4 control-label">PETUGAS PENERIMA SPT</label>
						<div class="col-sm-6">
							<select class="form-control cari_register" id="id_pegawai2">
								<option value="">--PENERIMA SPT--</option>
								<?php
								foreach($pegawai as $r){
									echo "<option value='".$r->id_pegawai."'>".$r->nm_pegawai."</option>";
								}
								?>
							</select>
						</div>
						<div class="col-sm-2">
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-4 control-label">PILIH JENIS SPT</label>
						<div class="col-sm-6">
							<select class="form-control cari_register" id="id_spt2">
								<option value="">--JENIS SPT--</option>
								<?php
								foreach($daftar_spt as $r){
									echo "<option value='".$r->id_spt."'>".$r->nm_spt."</option>";
								}
								?>
							</select>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"><h4><strong>DATA REGISTER</strong></h4></div>
			<div class="panel-body">
				<div id="wadah2"></div>
			</div>
		</div>
		
		<!-- Modal Edit-->
		<div class="modal1 modal fade" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">EDIT DATA REGISTER</h4>
					</div>
					<div class="modal-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-lg-3">ID REGISTER</label>
								<div class="col-lg-2">
									<input type="text" id="id_on_modal" class="form-control text-center" readonly/>
								</div>
							</div>
						</div>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-lg-3">NO REGISTER</label>
								<div class="col-lg-5">
									<input type="text" id="no_reg_on_modal" class="form-control text-center dapatDiUbah" nama_kolom="no_reg"/>
								</div>
							</div>
						</div>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-lg-3">JUMLAH SPT</label>
								<div class="col-lg-2">
									<input type="text" id="jml_spt_on_modal" class="form-control text-right dapatDiUbah" nama_kolom="jml_spt"/>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" id="tmb_simpan_modal"><span class="glyphicon glyphicon-ok"></span></button>
						<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
					&nbsp;
					</div>
				</div>
			</div>
		</div>
		<!--End of Modal Edit -->
		
		<script>
		$(document).ready(function(){
			var site = "<?php echo site_url();?>";
		
			//TRIGGER MODAL EDIT DATA
			$("body").on('click','.klik',function(){
				var id_register = $(this).attr("id-data");
				
				$.ajax({
					url      : site + "/pengemasan/detail_register/",
					data     : "id_register=" + id_register,
					datatype : "json"
				}).success(function(hasil){
						var J = JSON.parse(hasil);
						
						if(J.length > 0){
							var id_nya      = J[0].id;
							var no_reg_nya  = J[0].no_reg;
							var jml_spt_nya = J[0].jml_spt;
							
							$("#id_on_modal").val(id_nya);
							$("#no_reg_on_modal").val(no_reg_nya);
							$("#jml_spt_on_modal").val(jml_spt_nya);
							
						}else{
							alert("Tidak ada data!");
						}
					});
				
				$(".modal1").modal("show");
			});
			
			//PERUBAHAN DATA REGISTER dengan trigger on change
			$("body").on('change','.dapatDiUbah',function(){
				var id    = $("#id_on_modal").val();
				var kolom = $(this).attr("nama_kolom");
				var nilai = $(this).val();
							
				if(confirm("Simpan perubahan data?")){
					//alert("Yakin dong!");
					$.ajax({
						url  : site + "/pengemasan/simpan_edit_register/",
						data : "id=" + id + "&kolom=" + kolom + "&nilai=" + nilai,
						type : "post",
						success : function(res){
							//alert(res);
							if (res == "1"){
								alert("Edit data berhasil !");
								$(".modal1").modal("hide");
							}else{
								alert("Gagal!");
							}
						}
					});
				}else{
					alert("Ga jadi ding..");
				}
			});
			
			//Update register yang ternyata eSPT
			$("body").on('click','.espt',function(){
				var id_register = $(this).attr("id-data");
				var baris       = "baris" + id_register;
				
				if(confirm("Anda yakin?")){
					$.ajax({
						url  : site + "/pengemasan/ubahKesSPT/",
						data : "id_register=" + id_register,
						type : "post",
						success : function(hasil){
							if (hasil == "1"){
								alert("Ubah ke e-SPT Sukses!");
								$("#" + baris).hide("slow");
							}else{
								alert("Gagal!");
							}
						}
					});
				}else{
					alert("Proses dibatalkan!");
				}
			});
			
		});
		</script>
	</div>
</div>
