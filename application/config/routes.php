<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$pre = '';
// $route[$pre. '([a-zA-Z\-_0-9.]+)/([a-zA-Z\-_0-9.]+).html'] 		= 'DetailController/index/$1/$2';

$route[$pre. 'formulir/([a-zA-Z\-_0-9.]+)']    = 'FormulirController/index/$1';
$route[$pre. 'absensi/([a-zA-Z\-_0-9.]+)']     = 'FormulirController/absensi/$1';

$route[$pre.'validasi-sertifikat/export/([a-zA-Z\-_0-9.]+)']	   = 'ValidasiController/export/$1';
$route[$pre.'validasi-sertifikat/remote']	   = 'ValidasiController/remote';
$route[$pre.'validasi-sertifikat/search']	   = 'ValidasiController/search';
$route[$pre.'validasi-sertifikat/detail/([a-zA-Z\-_0-9.]+)']	= 'ValidasiController/detail/$1';
$route[$pre.'validasi-sertifikat']	           = 'ValidasiController/index';

$route[$pre.'hasil-sertifikasi/remote']	= 'SertifikasiController/remote';
$route[$pre.'hasil-sertifikasi/search']	= 'SertifikasiController/search';
$route[$pre.'hasil-sertifikasi']	    = 'SertifikasiController/index';

$route[$pre.'rekap-asesmen/search']	= 'RekapController/search';
$route[$pre.'rekap-asesmen/remote']	= 'RekapController/remote';
$route[$pre.'rekap-asesmen']	    = 'RekapController/index';

$route[$pre.'penjadwalan/search']	= 'PenjadwalanController/search';
$route[$pre.'penjadwalan/delete']	= 'PenjadwalanController/delete';
$route[$pre.'penjadwalan/remote']	= 'PenjadwalanController/remote';
$route[$pre.'penjadwalan/add']	    = 'PenjadwalanController/detail';
$route[$pre.'penjadwalan/surat/([a-zA-Z\-_0-9.]+)/([a-zA-Z\-_0-9.]+)']	= 'PenjadwalanController/suratTugas/$1/$2';
$route[$pre.'penjadwalan']		    = 'PenjadwalanController/index';

$route[$pre.'pembayaran/delete']	= 'PembayaranController/delete';
$route[$pre.'pembayaran/search']	= 'PembayaranController/search';
$route[$pre.'pembayaran/remote']	= 'PembayaranController/remote';
$route[$pre.'pembayaran']	        = 'PembayaranController/index';

$route[$pre. 'pendaftaran/remote']	= 'PendaftaranController/remote'; 
$route[$pre. 'pendaftaran']	        = 'PendaftaranController/index'; 

$route[$pre. 'berita-acara/search']               = 'BeritaAcaraController/search';
$route[$pre. 'berita-acara/([a-zA-Z\-_0-9.]+)']   = 'BeritaAcaraController/export/$1';
$route[$pre. 'berita-acara']                      = 'BeritaAcaraController/index';

//group report data
$route[$pre. 'report/asesor/search']      = 'ReportController/search/asesor';
$route[$pre. 'report/asesor']             = 'ReportController/asesor';
$route[$pre. 'report/tuk/search']         = 'ReportController/search/tuk';
$route[$pre. 'report/tuk']                = 'ReportController/tuk';
$route[$pre. 'report/sertifikasi/search'] = 'ReportController/search/sertifikasi';
$route[$pre. 'report/sertifikasi']        = 'ReportController/sertifikasi';
$route[$pre. 'report/asesmen/search']     = 'ReportController/search/asesmen';
$route[$pre. 'report/asesmen']            = 'ReportController/asesmen';
$route[$pre. 'report/jadwal/search']      = 'ReportController/search/jadwal';
$route[$pre. 'report/jadwal']             = 'ReportController/jadwal';
$route[$pre. 'report/pembayaran/search']  = 'ReportController/search/pembayaran';
$route[$pre. 'report/pembayaran']         = 'ReportController/pembayaran';
$route[$pre. 'report/peserta/search']     = 'ReportController/search/peserta';
$route[$pre. 'report/peserta']            = 'ReportController/peserta';

//group master data
$route[$pre. 'setting/mahasiswa/search']	= 'MasterController/search/mahasiswa'; 
$route[$pre. 'setting/mahasiswa/delete']	= 'MasterController/delete/mahasiswa'; 
$route[$pre. 'setting/mahasiswa']			= 'MasterController/mahasiswa'; 
$route[$pre. 'setting/mitra/search']	    = 'MasterController/search/mitra'; 
$route[$pre. 'setting/mitra/delete']	    = 'MasterController/delete/mitra'; 
$route[$pre. 'setting/mitra']			    = 'MasterController/mitra'; 
$route[$pre. 'setting/asesor/search']		= 'MasterController/search/asesor'; 
$route[$pre. 'setting/asesor/delete']		= 'MasterController/delete/asesor'; 
$route[$pre. 'setting/asesor']				= 'MasterController/asesor'; 
$route[$pre. 'setting/tuk/search']          = 'MasterController/search/tuk'; 
$route[$pre. 'setting/tuk/delete']          = 'MasterController/delete/tuk'; 
$route[$pre. 'setting/tuk']                 = 'MasterController/tuk';
$route[$pre. 'setting/skema/remote']		= 'MasterController/remote'; 
$route[$pre. 'setting/skema/search']		= 'MasterController/search/skema'; 
$route[$pre. 'setting/skema/delete']		= 'MasterController/delete/skema'; 
$route[$pre. 'setting/skema']				= 'MasterController/skema';
$route[$pre. 'setting/biaya-pendaftaran']   = 'MasterController/biaya';

//group profile
$route[$pre. 'daftar']          = 'PesertaController/daftar';
$route[$pre. 'profile/edit']    = 'PesertaController/index';
$route[$pre. 'profile']         = 'PesertaController/index';

$route[$pre. 'logout'] 			= 'LoginController/logout';
$route[$pre. 'login'] 			= 'LoginController/login';
$route[$pre. '/'] 				= 'HomeController/index';

$route['default_controller'] = 'HomeController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
