<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>TAMBAH PENGEMASAN</strong></h4></div>
	<div class="panel-body">
		<div class="form-horizontal col-sm-12 col-lg-8">
			<div class="form-group">
				<label  class="col-sm-4 control-label">PILIH JENIS SPT</label>
				<div class="col-sm-8">
					<select class="form-control" id="id_spt">
					<?php
					foreach($daftar_spt as $r){
						echo "<option value='".$r->id_spt."'>".$r->nm_spt."</option>";
					}
					?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-sm-4 control-label">BARCODE KEMASAN</label>
				<div class="col-sm-6">
					<input class="form-control text-center kapital" id="bc_kemasan"/>
				</div>
			</div>
		
			<div class="form-group">
				<label  class="col-sm-4 control-label">SEGEL KEMASAN</label>
				<div class="col-sm-6">
					<input class="form-control text-center" id="segel_kemasan"/>
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-sm-4 control-label">TANGGAL KEMAS</label>
				<div class="col-sm-4">
					<input class="form-control datepicker text-center" id="tgl_kemas" />
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-sm-4 control-label">JUMLAH SPT</label>
				<div class="col-sm-2">
					<input class="form-control text-right" id="jml_spt"/>
				</div>
				&nbsp;<span id="pesan"></span>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4 control-label"></label>
				<div class="col-sm-4">
					<button class="btn btn-primary" id="tmb_simpan"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;SIMPAN</button>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="panel panel-default">
	<div class="panel-heading"><h4><strong>DAFTAR PENGEMASAN&nbsp;<span id="jumlahe" class="pull-right"></span></strong></h4></div>
	<div class="panel-body">
			<div id ="tempat_data"></div> 
		</table>
	</div>
</div>

<script>
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
	autoclose: true,
    todayHighlight: true
});
</script>
