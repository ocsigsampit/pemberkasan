<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>REKAM PENERIMAAN SPT KEMBALI</strong></h4></div>
	<div class="panel-body">
		<!---isi--->
		<div class="form-horizontal col-sm-12 col-lg-12">
			
			<div class="form-group">
				<label  class="col-lg-2 control-label">NO SURAT</label>
				<div class="col-lg-4">
					<input class="form-control text-center kapital" id="no_surat"/>
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-lg-2 control-label">TANGGAL TERIMA</label>
				<div class="col-lg-2">
					<input class="form-control date text-center" id="tgl_terima"  data-pmu-format="Y-m-d"/>
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-lg-2 control-label">JUMLAH SPT</label>
				<div class="col-lg-1">
					<input class="form-control text-right" id="jml_spt"/>
				</div>
				<button class="btn btn-primary" id="btn_simpan"><span class="glyphicon glyphicon-floppy-disk">&nbsp;SIMPAN</span></button>
				&nbsp;<span id="pesan"></span>
			</div>
			
		

			<div id="div_detail" class="form-horizontal col-sm-12 col-lg-12">
				<div class="form-group">
					<div class="col-lg-1">NO</div>
					<div class="col-lg-4">NO LPAD</div>
					<div class="col-lg-2">NPWP</div>
					<div class="col-lg-2">ALASAN</div>
				</div>
				
				<form id="form_detail">
					<input type="hidden" id="id_induk" name="id_induk"/>
					<div id="wadah_detail">
						<div class="form-group">
							<div class="col-lg-1 col-md-1">
								<p>1</p>
							</div> 
							<div class="col-lg-4 col-md-4">
								<input class="form-control text-center kapital" name="no_lpad[]"/>
							</div>
							<div class="col-lg-2 col-md-2">
								<input class="form-control text-center" name="npwp[]"/>
							</div>
							<div class="col-lg-4 col-md-4">
								<input class="form-control text-center" name="alasan[]"/>
							</div>
							<div class="col-lg-1 col-md-1">
								<button class="btn btn-primary tmb-tambah" id="tambah_detail_data"><span class="glyphicon glyphicon-plus"></span></button>
							</div>
						</div>
					</div>
					<button class="btn btn-primary kirim" id="simpan_detail_data"><span class="glyphicon glyphicon-floppy-disk">&nbsp;DETAIL </span></button>
				</form>
			</div>
			
		</div>
		<!---isi-->
	</div>
</div>

<script>
$(document).ready(function(){
	var site = "<?php echo site_url();?>";
	var urut = 2;
	
	$("#div_detail").hide();
	
	//SIMPAN INDUK DATA
	$("body").on("click","#btn_simpan",function(y){
		y.preventDefault();
		
		var no_surat   = $("#no_surat").val();
		var tgl_terima = $("#tgl_terima").val();
		var jml_spt    = $("#jml_spt").val();
		
		if(confirm("Yakin simpan data ini?")){
			$.ajax({
				url     : site + "/pengemasan/simpan_induk_pengembalian/",
				type    : "post",
				data    : "no_surat=" + no_surat + "&tgl_terima=" + tgl_terima + "&jml_spt=" + jml_spt,
				success : function(res){
					//alert(res);
					var id_induk = res.split("|")[0];
					var status   = res.split("|")[1];
					//alert("status : " + status);
					
					if(status == "1"){
						alert("Data Induk berhasil disimpan\nLanjutkan dengan data detail.");
						$("#id_induk").val(id_induk);
						$("#btn_simpan").hide();
					}else{
						alert("Proses gagal!");
					}
				}
			});
			
			$("#div_detail").show();
		}
	});
	
	$("body").on("click",".tmb-tambah",function(e){
		e.preventDefault();
		var kerangka = '<div class="form-group"> \
					<div class="col-lg-1 col-md-1"> \
						<p>' + urut + '</p> \
					</div> \
					<div class="col-lg-4 col-md-4"> \
						<input class="form-control text-center kapital" name="no_lpad[]"/> \
					</div> \
					<div class="col-lg-2 col-md-2"> \
						<input class="form-control text-center" name="npwp[]"/> \
					</div> \
					<div class="col-lg-4 col-md-4"> \
						<input class="form-control text-center" name="alasan[]"/> \
					</div>';
				
		$("#wadah_detail").append(kerangka);
		urut ++;
	});
	
	//SIMPAN DETAIL DATA
	$("body").on('click','#simpan_detail_data',function(e){
		e.preventDefault();

		$.ajax({
			url     : site + "/pengemasan/simpan_detail_penerimaan",
			type    : "post",
			data    : $("#form_detail").serializeArray(),
			success : function(){
				tampilkanData("pengembalian");
				alert("Data berhasil disimpan!");
			}
		});
	});
	
	
});
</script>