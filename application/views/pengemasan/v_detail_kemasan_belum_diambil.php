<div class="panel panel-default">
	<div class="panel-heading">
	<h3><strong>KEMASAN BELUM DIAMBIL PPDDP</strong></h3>
	<h4><strong><?php echo $nama_spt;?></strong></h4>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tbl-ga" id="myTable">
				<thead>
					<tr>
						<th class="text-center">NO.</th>
						<th class="text-center">BARCODE KEMASAN</th>
						<th class="text-center">SEGEL KEMASAN</th>
						<th class="text-center">JML SPT</th>
						<th class="text-center">AMBIL BERKAS</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$theSite = site_url();
					$no = 1;
					foreach($kemasan as $q){
						echo "<tr>";
						echo "<td align='center'>".$no."</td>";
						echo "<td align='center'>".$q->bc_kemasan."</td>";
						echo "<td align='center'>".$q->segel_kemasan."</td>";
						echo "<td align='center'>".$q->jml_spt."</td>";
						echo "<td align='center'><input type='checkbox' class='chk_ambil' name='ambil' value='".$q->id_pengemasan."'/></td>";
						echo "</tr>";
						$no++;
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td align='center'><input type='button' class='btn btn-danger btn-xs' id='tombol_ambil' value='Diambil!'/></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

<!-- modal_pengambilan-->
<div class="modal_pengambilan modal fade" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">PENGAMBILAN KEMASAN OLEH PPDDP</h4>
			</div>
			
			<div class="modal-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label  class="col-lg-4">TANGGAL DIAMBIL</label>
						<div class="col-lg-3">
							<input class="form-control text-center datepicker" id="tgl_diambil"/>
						</div>
					</div>
				</div>
			</div>
			
			<div class="modal-footer">
				<button class="btn btn-success" id="tmb_diambil_on_modal"><span class="glyphicon glyphicon-floppy-disk"></span></button>
				<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
			&nbsp;
			</div>
		</div>
	</div>
</div>
<!--End of Modal Pengambilan -->

<script>
$(document).on('icheck', function(){
  $('input[type=checkbox], input[type=radio]').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue'
  });
}).trigger('icheck');

$('.chk_ambil').iCheck({
	checkboxClass: 'icheckbox_square-green',
});

$(document).trigger('icheck');

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
	autoclose: true,
    todayHighlight: true
});
</script>