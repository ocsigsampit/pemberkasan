<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>REKAM REGISTER
		<button class="btn btn-sm btn-primary" id="tmb_spt_kembali">Load Data SPT Kembali</button></strong></h4>
	</div>
	<div class="panel-body">
		<div class="form-horizontal col-sm-12 col-lg-8">
		
			<div class="form-group">
				<label  class="col-sm-4 control-label">PILIH JENIS SPT</label>
				<div class="col-sm-6">
					<select class="form-control" id="id_spt">
					<?php
					foreach($daftar_spt as $r){
						echo "<option value='".$r->id_spt."'>".$r->nm_spt."</option>";
					}
					?>
					</select>
				</div>
				<div class="col-sm-2">
					<input class="cek" type="checkbox" id="adj" name="adj"/> Adj
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-sm-4 control-label">NAMA PEGAWAI</label>
				<div class="col-sm-6">
					<select class="form-control" id="id_pegawai">
					<?php
					foreach($daftar_pegawai as $r){
						echo "<option value='".$r->id_pegawai."'>".$r->nm_pegawai."</option>";
					}
					?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-sm-4 control-label">NO. REGISTER/ND</label>
				<div class="col-sm-4">
					<input class="form-control text-center kapital" id="no_reg"/>
				</div>
			</div>
			
			<div class="form-group" id="div_tgl_manual">
				<label  class="col-sm-4 control-label">TANGGAL PENYESUAIAN</label>
				<div class="col-sm-4">
					<input class="form-control text-center datepicker" id="tgl_manual"  data-pmu-format="Y-m-d"/>
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-sm-4 control-label">JUMLAH SPT</label>
				<div class="col-sm-2">
					<input class="form-control text-right" id="jml_spt"/>
				</div>
				<div class="col-sm-2">
				&nbsp;<span id="pesan"></span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4 control-label"></label>
				<div class="col-sm-4">
					<button class="btn btn-primary" id="tmb_simpan_register"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;SIMPAN</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DAFTAR REGISTER&nbsp;<span id="jumlahe" class="pull-right"></span></strong></h4></div>
	<div class="panel-body">
			<div id="tempat_data"></div> 
		</table>
	</div>
</div>

<!-- Modal Daftar SPT Kembali-->
<div class="modal fade" tabindex="-1" id="modal_spt_kembali" data-backdrop="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog  modal-lg" role="document">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">DAFTAR SPT KEMBALI</h4>
			</div>
			
			<div class="modal-body">
				<div class="form-horizontal">
					<div id="isi"></idiv>
				</div>
			</div>
			
			<div class="modal-footer">
				<!--<button class="btn btn-success" id="tmb_diambil_on_modal"><span class="glyphicon glyphicon-floppy-disk"></span></button>-->
				<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
			&nbsp;
			</div>
		</div>
	</div>
</div>
<!--End of MModal Daftar SPT Kembali -->


<script>

$('#adj').iCheck({
	checkboxClass: 'icheckbox_square-green',
});

$('#adj').iCheck('uncheck');

$('input').on('ifChecked', function(event){
	$("#div_tgl_manual").show();
});

$('input').on('ifUnchecked', function(event){
	$("#div_tgl_manual").hide();
});

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    //startDate: '-3d'
	autoclose: true,
    todayHighlight: true
});

function LoadSPTKembali(kode_spt){
	var kode_spt = $("#id_spt").val();
	
	$.ajax({
		url  : theSite + "/pengemasan/load_spt_kembali/",
		type : "post",
		data : "kode_spt=" + kode_spt,
		dataType : "json",
		success : function(data){
			//alert(data);
			var skrip = "<table class='table display compact table-bordered table-condensed table-striped tbl-ga tablesorter' id='list_reg' width='100%'><thead><tr><th>NO</th><th>NO LPAD</th><th>NO LPAD BARU</th><th>JNS SPT</th><th>NO SP</th><th>TGL TERIMA</th><th>+</th></tr></thead><tbody>";
			var i;
			var j = 1;
			var lpad_baru;
			
			for (i=0; i < data.length; i++){
				var lpad_baru = data[i].lpad_baru == null ? "-" : data[i].lpad_baru;

				skrip += "<tr><td>" + j + "</td>";
				skrip += "<td class='text-nowrap'>" + data[i].lpad + "</td>";
				skrip += "<td class='text-nowrap'>" + lpad_baru + "</td>";
				skrip += "<td class='text-nowrap'>" + data[i].jns_spt + "</td>";
				skrip += "<td class='text-nowrap'>" + data[i].no_surat + "</td>";
				skrip += "<td class='text-nowrap'>" + data[i].dtgl_terima + "</td>";
				skrip += "<td class='text-nowrap'><button class='btn-xs btn-info tombol_tambah' data-lpad='" + data[i].lpad + "' data-spk='" + data[i].no_surat + "' lpad-baru='" + data[i].lpad_baru + "'>+</td></tr>";
				j++;
			}
			
			skrip += "</tbody><tfoot></tfoot></table>";
			$("#isi").html(skrip);
			$("#list_reg").DataTable({
				"autoWidth": false,
				"responsive": true
			});
			$("#modal_spt_kembali").modal("show");
		}
	});
}

$(function(){
	$("#tmb_spt_kembali").click(function(){
		LoadSPTKembali()
	});
	
	$("body").on("click",".tombol_tambah",function(){
		var lpad 		= $(this).attr("data-lpad");
		var lpad_baru 	= $(this).attr("lpad-baru");
		var lpad_akhir  = lpad_baru == "null" ? lpad : lpad_baru;

		var spk1 		= $(this).attr("data-spk");
		var spk2 		= spk1.split("/");
		var spk 		= spk2[0];
		var id_spt 		= $("#id_spt").val();
		var id_pegawai 	= $("#id_pegawai").val();
		var no_reg 		= $("#no_reg").val();
		var tgl_manual	= $("#tgl_manual").val();
		var jml_spt 	= $("#jml_spt").val();
		
		var d = new Date();
		var tgl_ini = d.getFullYear() + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
		//alert(tgl_ini);
	
		//alert("id_pegawai : " + id_pegawai + "\nid_spt : " + id_spt + "\nLPAD : " + lpad + "\nLPAD Baru: " + lpad_baru +  "\nLPAD yg dipakai : " + lpad_akhir + "\nspk: " + spk);

		$.ajax({
			type :"post",
			url  : theSite + "/pengemasan/simpan_register",
			data : "id_pegawai=" + id_pegawai + "&id_spt=" + id_spt + "&no_reg=" + lpad_akhir + " (" + spk + ")" + "&jml_spt=1" 
		}).done(function(data){
			if(data == "1"){
				swal(
					'Berhasil!',
					'Data berhasil disimpan.',
					'success'
					)
			}else{
				alert("GAGAL !");
			}
		})

	});
})
</script>