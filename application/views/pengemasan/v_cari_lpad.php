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
			<div class="panel-heading"><h4><strong>PENCARIAN LPAD/BPS</strong></h4></div>
			<div class="panel-body">
				<div class="form-inline">
					<div class="form-group">
						<label for="no_lpad">NO.LPAD/BPS</label>
						<input class="form-control kapital" id="no_lpad"/>
						<button class="btn btn-primary" id="tmb_cari"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Cari</button>
					</div>
					<!--<div class="form-group">
						<label class="sr-only" for="name">Name</label>
						<input type="text" class="form-control col-lg-5" id="name" placeholder="Enter Name"> 
					</div> 
					<div class="form-group"> 
						<label class="sr-only" for="inputfile">File input</label> 
						<input type="file" id="inputfile"> 
					</div> 
					<div class="checkbox"> 
						<label><input type="checkbox"> Check me out </label> 
					</div> 
						<button type="submit" class="btn btn-default">Submit</button>
					</div>-->
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"><h4><strong>HASIL PENCARIAN LPAD/BPS</strong></h4></div>
			<div class="panel-body">
				<div>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>NO</th>
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