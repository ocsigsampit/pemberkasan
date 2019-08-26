<?php
if (!defined('BASEPATH')) exit ('BIG NO for direct access!!!');

if (!function_exists('titik_buat_npwp')){
	
	function kasih_titik($npwp){
		$hasil = substr($npwp,0,2).".".substr($npwp,2,3).".".substr($npwp,5,3).".".substr($npwp,8,1)."-".substr($npwp,9,3).".".substr($npwp,12,3);
		
		return $hasil;
	}
}