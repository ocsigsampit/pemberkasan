<div ng-app="budi-app" ng-controller="budi-ctrl" ng-init="show_data()">
<div class="panel panel-default">
	<div class="panel-heading"><h2>REKAM REGISTER via ANGULAR</h2></div>
	<div class="panel-body">
		<div class="form-horizontal col-sm-12 col-lg-8">
		
			<div class="form-group">
				<label  class="col-sm-4 control-label">PILIH JENIS SPT</label>
				<div class="col-sm-6">
					<select class="form-control" ng-model="id_spt">
					<?php
					foreach($daftar_spt as $r){
						echo "<option value='".$r->id_spt."'>".$r->nm_spt."</option>";
					}
					?>
					</select>
				</div>
				<div class="col-sm-2">
					<input class="cek" type="checkbox" name="adj" ng-model="adj"/> Adj
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-sm-4 control-label">NAMA PEGAWAI</label>
				<div class="col-sm-6">
					<select class="form-control" ng-model="id_pegawai">
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
					<input class="form-control text-center" ng-model="no_reg"/>
				</div>
			</div>
			
			<div class="form-group">
			<!--<div class="form-group" id="div_tgl_manual" ng-if="adj">-->
				<label  class="col-sm-4 control-label">TANGGAL PENYESUAIAN</label>
				<div class="col-sm-4">
					<input class="form-control text-center" ng-model="tgl_manualx"/>
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-sm-4 control-label">JUMLAH SPT</label>
				<div class="col-sm-2">
					<input class="form-control text-right" ng-model="jml_spt"/>
				</div>
				<div class="col-sm-2">
				&nbsp;<span id="pesan"></span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4 control-label"></label>
				<div class="col-sm-4">
					<button class="btn btn-primary" ng-click="insert()"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;{{button_name}}</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><h2>DATA PEREKAMAN REGISTER</h2></div>
	<div class="panel-body">
		<table id="table-data" class="table table-striped">
			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th class="text-center">NAMA PEGAWAI</th>
					<th class="text-center">NO REGISTER</th>
					<th class="text-center">JENIS SPT</th>
					<th class="text-center">JML SPT</th>
					<th class="text-center">TGL TERIMA</th>
				</tr>
			</thead>
			<tbody id="table-body">
				<tr ng-repeat="x in semua">
				<td class='text-center'>{{x.id}}</td>
				<td class='text-left text-nowrap'>{{x.nm_pegawai}}</td>
				<td class='text-center'>{{x.no_reg}}</td>
				<td class='text-left text-nowrap'>{{x.nm_spt}}</td>
				<td class='text-center'>{{x.jml_spt}}</td>
				<td class='text-center text-nowrap'>{{x.tgl_terima}}</td>
				<td class='text-center'><button class='btn btn-success' ng-click='update_data(x.id,x.jns_spt,x.jml_spt,x.tgl_terima)'><span class='glyphicon glyphicon-edit'></span></button></td>
				<td class='text-center'><button class='btn btn-danger' ng-click='delete_data(x.id)'><span class='glyphicon glyphicon-trash'></span></button></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

</div>

<script>

var site = "<?php echo site_url();?>";
var app  = angular.module("budi-app",[]);

app.controller("budi-ctrl",function($scope,$http){
	$scope.button_name = "Simpan";
	
	$scope.insert = function(){
		// $http.post(
			// site + "/pengemasan/simpan_register",
			// {
				// "id_spt" : $scope.id_spt,
				// "no_reg" : $scope.no_reg,
				// "id_pegawai" : $scope.id_pegawai,
				// "jml_spt" : $scope.jml_spt,
				// "tgl_manual" : $scope.tgl_manual
			// }
		// ).then(function successCallback(data){
			// alert(data);
			// $scope.show_data();
		// });
		if($scope.adj){
			alert("dicek ! : " + $scope.tgl_manualx);
			// $http({
				// method : 'post',
				// url : site + "/pengemasan/simpan_register_ang",
				// data : {id_pegawai : $scope.id_pegawai,id_spt : $scope.id_spt, no_reg : $scope.no_reg, jml_spt : $scope.jml_spt, tgl_manual : $scope.tgl_manual}
			// }).then(function successCallback(data){
				// alert(data);
				// $scope.show_data();
			// });
		}else{
			alert("GA dicek ! " + $scope.tgl_manualx);
			// $http({
				// method : 'post',
				// url : site + "/pengemasan/simpan_register_ang",
				// data : {id_pegawai : $scope.id_pegawai,id_spt : $scope.id_spt, no_reg : $scope.no_reg, jml_spt : $scope.jml_spt}
			// }).then(function successCallback(data){
				// alert(data);
				// $scope.show_data();
			// });
		}
	}
	
	
	$scope.show_data = function(){
		$http({
			method:'get',
			url:site + "/pengemasan/daftar_register_ang"}).then(function successCallback(response){
			$scope.semua = response.data;
		});
	}
	
});

</script>

