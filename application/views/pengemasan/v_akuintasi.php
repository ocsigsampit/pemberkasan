<script>
$(document).on('icheck', function(){
  $('input[type=checkbox], input[type=radio]').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue'
  });
}).trigger('icheck');

$('.cek_akuin').iCheck({
	checkboxClass: 'icheckbox_square-green',
});
</script>
		<div class="panel panel-default">
			<div class="panel-heading"><h4><strong>AKUINTASI</strong></h4></div>
			<div class="panel-body">
				<div class="form-horizontal col-sm-12 col-lg-12">
				
					<div class="form-group">
						<label  class="col-sm-4 control-label">PILIH KODE SEGEL KEMASAN</label>
						<div class="col-sm-4">
							<select class="form-control" id="id_sptx">
								<option value="">--SEGEL KEMASAN--</option>
								<?php
								foreach($daf_pengemasan as $r){
									echo "<option value='".$r->id_spt."-".$r->id_pengemasan."'>".$r->segel_kemasan."</option>";
								}
								?>
							</select>
						</div>
						<div class="col-sm-4" id="hid_id_pengemasan"></div>
					</div>

				</div>
			</div>
		</div>
		<div class="panel panel-default">	
			<div class="panel-heading"><h4><strong>DAFTAR REGISTER</strong></h4></div>
			<div class="panel-body">
				<div class="form-group">
					<div class="cek col-sm-12" id="wadah"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label"></label>
					<div class="col-sm-4">
						<p id="total_spt_terpilih" class="text-left"></p>
					</div>
					<div class="col-sm-4">
						<button class="btn btn-primary" id="tmb_akuintasi"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Simpan akuintasi</button>
					</div>
				</div>
			</div>
		</div>