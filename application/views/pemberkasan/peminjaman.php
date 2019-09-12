<script>
$(document).on('icheck', function(){
	$('input[type=checkbox], input[type=radio]').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue'
	});
}).trigger('icheck');

$('.pilihan').iCheck({
	checkboxClass: 'icheckbox_square-green',
});

$('.pilihan_radio').iCheck({
	radioClass: 'iradio_square-blue',
});

</script>

		<div class="panel panel-default">
			<div class="panel-heading"><h4><strong>PEMINJAMAN BERKAS</strong></h4></div>
			<div class="panel-body">
				<div class="form-horizontal col-sm-12 col-lg-12">
					<p>Pencarian berdasarkan : </p>
					<!-- icheck Horizontal-->
					<fieldset class="radio-strip">
						<label class="checked">
							<input type="radio" class="pilihan_radio" name="pilihan_katakunci" id="kk_npwp" value="kk_npwp" checked>
							<span class="label-text">N P W P</span>
						</label>
						&nbsp;
						&nbsp;
						<label>
							<input type="radio" class="pilihan_radio" name="pilihan_katakunci" id="kk_namawp" value="kk_namawp">
							<span class="label-text">Nama Wajib Pajak</span>
						</label>
					</fieldset>
					<br/>
					<p>dengan kata kunci/NPWP : </p>
					<div class="form-group">
						<input class="form-control kapital" id="katakunci"/>
						<!--<input class="form-control kapital" id="nama_wp"/>-->
						<button class="btn btn-primary" id="tmb_cari"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Cari</button>
					</div>

				</div>
			</div>
		</div>
		<div class="panel panel-default">	
			<div class="panel-heading"><h4><strong>HASIL PENCARIAN</strong></h4></div>
			<div class="panel-body">
				<div id="load_display"></div>
				<div class="form-group">
					<div class="cek col-sm-12" id="wadah"></div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<p id="total_item" class="text-left"></p>
						<button class="btn btn-primary hidden" id="tmb_form_peminjaman"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Isi Formulir Peminjaman</button>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal Formulir Peminjaman Berkas-->
		<div class="modal fade" tabindex="-1" id="modal_form_peminjaman" data-backdrop="false" role="dialog" aria-hidden="true">
			<div class="modal-dialog  modal-lg" role="document">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Formulir Peminjaman Berkas</h4>
					</div>
					
					<span id="success_message"></span>
					
					<div class="modal-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label  class="col-sm-4 col-lg-2 control-label">No. Nota Dinas</label>
								<div class="col-sm-4 col-lg-5">
									<input class="form-control text-center kapital" name="no_id" id="no_nd"/>
								</div>
								<span id="no_nd_error" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label  class="col-sm-4 col-lg-2 control-label">Tanggal Nota Dinas</label>
								<div class="col-sm-4 col-lg-2">
									<input class="form-control text-center datepicker" name="tgl_nd" id="tgl_nd" data-pmu-format="Y-m-d"/>
								</div>
								<span id="tgl_nd_error" class="text-danger"></span>
							</div>
							<input type="hidden" id="wadah_id_berkas"/>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-success" id="tmb_simpan_formulir"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Simpan</button>
						<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Batal</button>
					&nbsp;
					</div>
					
				</div>
			</div>
		</div>
		<!--End of Modal Formulir Peminjaman Berkas -->