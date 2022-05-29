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
		return "{$y} tahun {$m} bulan {$d} hari";
	}
}
