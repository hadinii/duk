<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('getMasaKerja')) {
	function getMasaKerja($then) {

		$tanggal = new DateTime($then);
                    // tanggal hari ini
		$today = new DateTime('today');
		// tahun
		$y = $today->diff($tanggal)->y;
		// bulan
		$m = $today->diff($tanggal)->m;
		// hari
		$d = $today->diff($tanggal)->d;

		if($y == 0 && $m == 0){
			return "{$d} hari";
		} elseif($y == 0){
			return "{$m} bulan {$d} hari";
		} elseif($m == 0){
			return "{$y} tahun {$d} hari";
		} else{
			return "{$y} tahun {$m} bulan {$d} hari";
		}
		//  return "{$y} tahun {$m} bulan {$d} hari;
	}
}

if (!function_exists('getTanggalNaikGaji')) {
	function getTanggalNaikGaji($date, $year) {
		$date = date('Y-m-d', strtotime("+{$year} years", strtotime($date)));
		return mediumdate_indo($date);
	}
}
