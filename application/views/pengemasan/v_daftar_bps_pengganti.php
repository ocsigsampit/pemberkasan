<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DAFTAR BPS PENGGANTI</strong></h4></div>
	<div class="panel-body">
		<?php
		foreach($daftar_tgl_tinjut as $b){
		?>
		<div class="checkbox-inline"> 
			<label><input type="checkbox" name="tgl_tinjut" value="'<?=$b->DAF_TGL_TINJUT;?>'"><?=$b->DAF_TGL_TINJUT;?></label> 
		</div>
		<?php
		}
		?>
		&nbsp;
		&nbsp;
		<button type="button" class="btn btn-default" id="tmb_load">Load</button>
		<div class="btn-group pull-left" style=" padding: 10px; margin-right:140px">
			<div class="dropdown open">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<span class="glyphicon glyphicon-th-list"></span> Export
				</button>
				
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<!--<li><a href="#" onclick="$('table').tableExport({type:'json',escape:'false'});"> <img src="<?php// echo base_url();?>tableExport/img/json.jpg" width="24px"> JSON</a></li>
					<li><a href="#" onclick="$('table').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src="<?php// echo base_url();?>tableExport/img/json.jpg" width="24px">JSON (ignoreColumn)</a></li>
					<li><a href="#" onclick="$('table').tableExport({type:'json',escape:'true'});"> <img src="<?php// echo base_url();?>tableExport/img/json.jpg" width="24px"> JSON (with Escape)</a></li>
					<li class="divider"></li>-->
					<li><a href="#" onclick="$('table').tableExport({type:'xml',escape:'false'});">XML</a></li>
					<li><a href="#" onclick="$('table').tableExport({type:'sql'});">SQL</a></li>
					<li class="divider"></li>
					<li><a href="#" onclick="$('table').tableExport({type:'csv',escape:'false'});">CSV</a></li>
					<li><a href="#" onclick="$('table').tableExport({type:'txt',escape:'false'});">TXT</a></li>
					<li class="divider"></li>				
					<li><a href="#" onclick="$('table').tableExport({type:'excel',escape:'false'});">XLS</a></li>
					<li><a href="#" onclick="$('table').tableExport({type:'doc',escape:'false'});">Word</a></li>
					<!--<li><a href="#" onclick="$('table').tableExport({type:'powerpoint',escape:'false'});"> <img src="<?php// echo base_url();?>tableExport/img/ppt.png" width="24px"> PowerPoint</a></li>-->
					<li class="divider"></li>
					<li><a href="#" onclick="$('table').tableExport({type:'png',escape:'false'});">PNG</a></li>
					<li><a href="#" onclick="$('table').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">PDF</a></li>
				</ul>
		
			</div>
		</div>
		<br/>
		<br/>
		<div id="wadah"></div>
		<!--<span><i class="glyphicon glyphicon-print"></i>&nbsp;<a href="<?php// echo site_url();?>/pengemasan/buat_excel_bps/" target="_blank">Export to Excel</a></span>-->
		
		<button type="button" class="btn btn-default" id="tmb_export3313">Export to Excel</button>
		
	</div>
</div>
<script>
$(document).ready(function(){
	
	$("table").tableExport({
		headers: true,                              // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
		footers: true,                              // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
		formats: ['xlsx', 'csv', 'txt'],            // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
		filename: 'id',                             // (id, String), filename for the downloaded file, (default: 'id')
		bootstrap: false,                           // (Boolean), style buttons using bootstrap, (default: true)
		exportButtons: true,                        // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
		position: 'bottom',                         // (top, bottom), position of the caption element relative to table, (default: 'bottom')
		ignoreRows: null,                           // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
		ignoreCols: null,                           // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
		trimWhitespace: true                        // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
	});
	
	
	$("#tmb_load").click(function(){
		var arrPilihan = [];
		var isi = "<table class='table table-bordered table-condensed table-striped tbl-ga'><tr><th class='text-center'>No</th><th class='text-left'>NO LPAD LAMA</th><th class='text-left'>NO LPAD BARU</th><th class='text-center'>KODE KPP</th><th class='text-left'>KETERANGAN</th></tr>";
		var no = 1;
		
		$("input[name='tgl_tinjut']:checked").each(function(){
			arrPilihan.push(this.value);
		});
			
		//alert("Nilai arrPilihan : " + arrPilihan);
		
		strArrPilihan = arrPilihan.toString();
		
		$.ajax({
			type : "post",
			url  : theSite + "/pengemasan/load_daftar_bps_pengganti/",
			data : "tgl_tinjut=" + strArrPilihan,
			success : function(hasil){
				//alert("Hasil : " + hasil);
				var Jason = JSON.parse(hasil);

				if(Jason.length > 0){
					$.each(Jason,function(i) {
						isi = isi + "<tr><td class='text-center'>" + no + "</td><td class='text-left'>" + Jason[i].NO_LPAD_LAMA + "</td><td class='text-left'>" + Jason[i].NO_LPAD_BARU + "</td><td class='text-center'>" + Jason[i].KODE_KPP + "</td><td class='text-left'>" + Jason[i].KETERANGAN + "</td><tr>";
						no = no + 1;
					});
					
					$("#wadah").html(isi + "</table>");
				}else{
					alert("Tidak ada data !")
				}	
			}	
		});
	});
	
	$("#tmb_export3313").click(function(){
		$("table").tableExport({
			type:"excel",
			headers: true,
			bootstrap: true,
			exportButtons: true,
			trimWhitespace: false
		});
	});
	
});

</script>