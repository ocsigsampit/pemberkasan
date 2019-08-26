<?php
if (!defined('BASEPATH')) exit ('BIG NO for direct access!!!');

if (!function_exists('fungsi_budi')){
	
	function kasih_titik($npwp){
		$hasil = substr($npwp,0,2).".".substr($npwp,2,3).".".substr($npwp,5,3).".".substr($npwp,8,1)."-".substr($npwp,9,3).".".substr($npwp,12,3);
		
		return $hasil;
	}
	
	function namaSPT($kode){
		switch($kode){
			case "SPT01":
				$nama = "SPT Tahunan PPh Badan";
				break;
			case "SPT02":
				$nama = "SPT Tahunan PPh Orang Pribadi 1770";
				break;
			case "SPT03":
				$nama = "SPT Tahunan PPh Orang Pribadi 1770 S";
				break;
			case "SPT04":
				$nama = "SPT Tahunan PPh Orang Pribadi 1770 SS";
				break;
			case "SPT05":
				$nama = "SPT Masa PPh Pasal 21";
				break;
			case "SPT06":
				$nama = "SPT Masa PPN Pedagang Eceran";
				break;
			case "SPT011":
				$nama = "SPT Masa PPh Pasal 23";
				break;
			default :
				$nama = "Unknown";
		}
		
		return $nama;
	}
	
	function batasiTeks($teks,$jumlah){
		$hasil = strlen($teks) > 35 ? substr($teks,0,$jumlah)."..." : $teks;
		return $hasil;
	}
	
	function noBPS2SPT($noBPS){
		$teks1 = explode("/",$noBPS);
		$teks  = $teks1[1];
		
		if($teks == "PPWBIDR"){
			$JenisSPT = "SPT Badan";
		}elseIf ($teks == "PPTOP"){
			$JenisSPT = "SPT OP";
		}elseIf ($teks == "PPTOPS"){
			$JenisSPT = "SPT OP S";
		}elseIf ($teks == "PPTOPSS"){
			$JenisSPT = "SPT OP SS";
		}elseIf ($teks == "PPH2114"){
			$JenisSPT = "SPT Masa 21";
		}elseIf ($teks == "PPN1111DM"){
			$JenisSPT = "SPT PPN DM";
		}elseIf ($teks == "PPH23"){
			$JenisSPT = "SPT Masa 23";
		}else{
			$JenisSPT = "-";
		}

		return $JenisSPT;
	}
	
	function litMysql2Ina($teks){
		$xpl = explode("-",$teks);
		$tgl = $xpl[2];
		$bln = $xpl[1];
		$thn = $xpl[0];
		
		$bulan = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		
		$hasil = $tgl." ".$bulan[(int)$bln]." ".$thn;
		
		return $hasil;
	}
}