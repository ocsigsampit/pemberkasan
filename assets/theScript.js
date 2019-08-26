$(document).ready(function(){
	var total = 0;
	
	$('input').iCheck({
		checkboxClass: 'icheckbox_square',
		radioClass: 'iradio_square',
		increaseArea: '20%'
	});
	
	//Pencarian dengan Kata Kunci
	$("#tmb_cari").click(function(){
		var pilihanKatakunci = $("input[name=pilihan_katakunci]:checked").val();
		//alert(pilihanKatakunci);
		var katakunci = $("#katakunci").val();
		
		if(katakunci == ""){
			alert("Kolom Pencarian harus diisi!");
			return false;
		}else{
			$("#load_diplay").html("    processsssing...");
			
			$.ajax({
				type : "post",
				url  : theSite + "/pemberkasan/cari",
				data : "katakunci=" + katakunci + "&kolom=" + pilihanKatakunci,
				success  : function(data){
					var Jason = JSON.parse(data);
					
					if(Jason.length > 0){					
						var nomer   	  = 1;
						var isi           = "<table class='table display compact table-bordered table-condensed table-striped tbl-ga tablesorter' id='tablenya'><thead><tr><th class='text-center'>No</th><th class='text-center'>N P W P</th><th class='text-center'>NAMA WP</th><th class='text-center'>JENIS BERKAS</th><th class='text-center'>MS/THN PJK</th><th class='text-center'>PBT</th><th class='text-center'>PILIH</th></tr></thead><tbody>";
						
						$.each(Jason,function(i){
							isi = isi + "<tr><td class='text-center'>" + nomer + "</td><td class='text-center'>" + npwpBerTB(Jason[i].npwp) + "</td><td>" + Jason[i].nama_wp + "</td><td class='text-center'>" + Jason[i].jenis_berkas + "</td><td class='text-center'>" + teks(Jason[i].msthn) + "</td><td class='text-center'>" + teks(Jason[i].pembetulan) + "</td><td class='text-center'><input type='checkbox' class='pilihan' name='terpilih' value='" + Jason[i].id_berkas + "' konter=1></td></tr>";
							nomer = nomer + 1;
						});
						
						isi += "</tbody>";
						
						$("#wadah").html(isi);
						$("#tablenya").DataTable({
							"order": [[ 0, "asc" ]],
							"fnDrawCallback": function() {
								/*----Supaya icheck diterapkan di semua paging----*/
								$(document).trigger('icheck');
							}
						});
						$("#load_diplay").html("Done !");
						
						//----This is THE KEY of icheck in table rows-----!
						$(document).trigger('icheck');
						//-----------------------------------------------//
					}else{
						$("#wadah").html("DATA TIDAK DITEMUKAN !");
						$("#load_diplay").html("Done !");
					}
				}
			});
		}
	});
	
	function npwpBerTB(teks){
		var hasil = teks.substr(0,2) + "." + teks.substr(2,3) + "." + teks.substr(5,3) + "." + teks.substr(8,1) + "-" + teks.substr(9,3) + "." + teks.substr(12,3);
		
		return hasil;
	}
	
	function teks(text){
		var hasil = (text == null) ? '' : text;
		
		return hasil;
	}
	
	//---Hitung jumlah baris yang dipilih---//
	$("body").on("ifChecked",".pilihan",function(){
		var jumlah   = parseInt($(this).attr("konter"));
		
		total += jumlah;
	
		$("#total_item").html("Jumlah item yang Anda pilih : <b>" + total + "</b>");
		$("#tmb_form_peminjaman").removeClass("hidden");
	});
	
	$("body").on("ifUnchecked",".pilihan",function(){
		var jumlah   = parseInt($(this).attr("konter"));
		
		total -= jumlah;
		$("#total_item").html("Jumlah item yang Anda pilih : <b>" + total + "</b>");
		if(total == 0) $("#tmb_form_peminjaman").addClass("hidden");
	});
	
	//Trigger Modal Formulir Peminjaman Berkas//
	$("body").on("click","#tmb_form_peminjaman",function(){
		var arrPilihan = [];
		
		$("input[name='terpilih']:checked").each(function(){
			arrPilihan.push(this.value);
		});
		
		//alert(arrPilihan);
		$("#wadah_id_berkas").val(arrPilihan);
		$("#modal_form_peminjaman").modal("show");
	});
	
	/*
	$("#tmb_simpan_formulir").click(function(){
		var ids_berkas = $("#wadah_id_berkas").val();
		var no_nd      = $("#no_nd").val();
		var tgl_nd     = $("#tgl_nd").val();
		
		if(confirm("Yakin ?")){
			$.ajax({
				type : "POST",
				url  : theSite + "/pemberkasan/simpan_formulir",
				data : "no_nd=" + no_nd + "&tgl_nd=" + tgl_nd + "&ids_berkas=" + ids_berkas,
				success : function(hasil){
					var pesan = "";
					if(hasil.substr(0,1) == "1"){
						pesan += "Data Induk berhasil disimpan\n";
						if(hasil.substr(1,1) == "1"){
							pesan += "Data Detail berhasil disimpan";
						}
					}
					
					alert(pesan);
					$(document).ajaxStop(function() { location.reload(true); });
				}
			});
		}
	});
	*/
	
	$("#tmb_simpan_formulir").click(function(e){
		e.preventDefault();
		
		var ids_berkas = $("#wadah_id_berkas").val();
		var no_nd      = $("#no_nd").val();
		var tgl_nd     = $("#tgl_nd").val();
		
		if(confirm("Yakin ?")){
			$("#no_nd_error").html('');
			$("#tgl_nd_error").html('');
			$.ajax({
				type : "POST",
				url  : theSite + "/pemberkasan/simpan_formulir",
				data : "no_nd=" + no_nd + "&tgl_nd=" + tgl_nd + "&ids_berkas=" + ids_berkas,
				success : function(data){
					data2 = JSON.parse(data);
					
					if(data2.error){
						if(data2.no_nd_error !== ''){
							$("#no_nd_error").html(data2.no_nd_error);
						}
						
						if(data2.tgl_nd_error !== ''){
							$("#tgl_nd_error").html(data2.tgl_nd_error);
						}
					}
					
					if(data2.success){
						$("#success_message").html(data2.success);
					}
					
				}
			});
		}
	});
	
	$(".tmb_selesai").click(function(){
		var id_peminjaman = $(this).attr("data-id_peminjaman");
		
		if(confirm("Yakin berkas ini telah selesai?")){
			$.ajax({
				type : "POST",
				url  : theSite + "/pemberkasan/selesai",
				data : "id_peminjaman=" + id_peminjaman,
				success : function(hasil){
					if(hasil == "11"){
						alert("Peminjaman berkas " + id_peminjaman + " telah selesai!");
						$(document).ajaxStop(function() { location.reload(true); });
					}else{
						alert("Gagal!");
					}
				}
			});
		}
	});
	
});