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
	<div class="row">
	<div id="load_diplay"></div>
		<div class="panel panel-default">
			<div class="panel-heading"><h4><strong>PENCARIAN NAMA WAJIB PAJAK</strong></h4></div>
			<div class="panel-body">
				<div class="form-inline">
					<div class="form-group">
						<label for="nama_wp">NAMA WAJIB PAJAK</label>
						<input class="form-control kapital" id="nama_wp"/>
						<button class="btn btn-primary" id="tmb_cari_nama_wp"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Cari</button>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"><h4><strong>HASIL PENCARIAN NAMA WAJIB PAJAK</strong></h4></div>
			<div class="panel-body">
				<div>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>NO</th>
								<th>NAMA WAJIB PAJAK</th>
								<th>NO LPAD</th>
								<th>BARCODE KEMASAN</th>
								<th>SEGEL KEMASAN</th>
								<th>TGL KEMAS</th>
								<th>TGL AMBIL PPDDP</th>
							</tr>
						</thead>
						<tbody id="hasil_cari">
							<!--HASIL PENCARIAN ADA DI SINI-->
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</div>
</div>