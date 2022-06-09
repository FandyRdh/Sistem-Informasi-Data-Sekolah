<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// ------------------------Landing Page-------------------------------------------
// Landing Page
$routes->get('/', 'C_Landing_Page::Login');
$routes->get('/Login', 'C_Landing_Page::Login');
$routes->get('/Logout', 'C_Landing_Page::Logout');
$routes->get('/About', 'C_Landing_Page::About');
$routes->get('/Login/Logic_Login', 'C_Landing_Page::Logic_Login');

// -------------------------Fandy Routs-----------------------------------------
// Admin
// $routes->get('/adm', 'C_Admin::indexku');
$routes->get('/adm', 'C_Admin::Dashboard');
$routes->get('/adm/dashboard', 'C_Admin::Dashboard');

// Karyawan
$routes->get('/adm/kry', 'C_Admin::karyawan/$1');
$routes->get('/adm/kry/add', 'C_Admin::addKry');
$routes->get('/adm/kry/add/save', 'C_Admin::saveKry');
$routes->get('/adm/kry/(:segment)', 'C_Admin::karyawan2/$1');
$routes->get('/adm/kry/all', 'C_Admin::karyawan');
$routes->get('/adm/kry/guru', 'C_Admin::karyawan');
$routes->get('/adm/kry/kepala sekolah', 'C_Admin::karyawan');
$routes->get('/adm/kry/admin', 'C_Admin::karyawan');
$routes->get('/adm/kry/detail/(:segment)', 'C_Admin::detailKry/$1');
$routes->get('/adm/kry/add/(:segment)', 'C_Admin::addKry/$1');
$routes->get('/adm/kry/hapus/(:segment)', 'C_Admin::HapusKry/$1');


// Nilai
$routes->get('/adm/nilai/(:segment)/(:segment)', 'C_Admin::Nilai/$1/$2');

// Siswa & Kelas
$routes->get('/adm/snk', 'C_Admin::SiswaDanKelas');
$routes->get('/adm/snk/save', 'C_Admin::SaveKelas');
$routes->get('/adm/snk/(:segment)', 'C_Admin::DetailKelas/$1');
$routes->get('/adm/snk/del/(:segment)', 'C_Admin::delKelas/$1');
$routes->get('/adm/snk/detail/(:segment)', 'C_Admin::DetailSiswa/$1'); // Identitas
$routes->get('/adm/snk/detailNilai/(:segment)/(:segment)', 'C_Admin::DetailSiswa_Nilai/$1/$2'); // Nilai // -> NISN/SEMESTER
$routes->get('/adm/snk/eksul/(:segment)/(:segment)', 'C_Admin::DetailSiswa_Eksul/$1/$2'); // Identitas // -> NISN/Semester
$routes->get('/adm/snk/kepribadian/(:segment)', 'C_Admin::DetailSiswa_Kepribadian/$1/$2'); // Identitas // -> NISN/Semester
$routes->get('/adm/snk/absensi/(:segment)', 'C_Admin::DetailSiswa_absensi/$1/$2'); // Identitas // -> NISN/Semester
$routes->get('/adm/snk/keshatan/(:segment)', 'C_Admin::DetailSiswa_keshatan/$1/$2'); // Identitas // -> NISN/Semester
$routes->get('/adm/snk/hapussiswa/(:segment)', 'C_Admin::HapusSiswa/$1'); // Identitas // -> NISN/Semester
$routes->get('/adm/snk/updatesiswa/(:segment)', 'C_Admin::UpdtSiswa/$1'); // Identitas // -> NISN/Semester

// adm/snk/subkelas/mp/smst/aktiv
$routes->get('/adm/snk/(:segment)/mp/(:segment)/(:segment)', 'C_Admin::DetailKelas/$1/$2');
$routes->get('/adm/snk/(:segment)/(:segment)/(:segment)/(:segment)', 'C_Admin::DataMapel/$1/$2/$3/$4');
$routes->get('/adm/snk/(:segment)/mp/(:segment)/(:segment)', 'C_Admin::DetailKelas/$1/$2');
$routes->get('/adm/snk/(:segment)/mp/(:segment)/(:segment)', 'C_Admin::DetailKelas/$1/$2');
$routes->get('/adm/snk/(:segment)/mp/(:segment)/(:segment)', 'C_Admin::DetailKelas/$1/$2');

$routes->get('/adm/siswa/Save', 'C_Admin::addSiswa/$1');
$routes->get('/adm/siswa/add/(:segment)', 'C_Admin::addSiswa/$1');


// Master
$routes->get('/adm/master', 'C_Admin::Master');
$routes->get('/adm/master/save/(:segment)', 'C_Admin::Master_Save/$1');
$routes->get('/adm/master/updt/(:segment)', 'C_Admin::Master_Update/$1');
$routes->get('/adm/master/del/(:segment)/(:segment)', 'C_Admin::Master_Del/$1/$2');


// Cetak
$routes->get('/adm/cetak/BukuInduk/(:segment)', 'C_Admin::CetakSoal/$1');
$routes->get('/adm/cetak/CetakNIlai/(:segment)/(:segment)', 'C_Admin::CetakNIlai/$1/$2');
$routes->get('/adm/cetak/CetakDataKelas/(:segment)', 'C_Admin::CetakDataKelas/$1');



// -------------------------HASAN ROUTS-------------------------------------------

//Wali Kelas_Baru
$routes->get('/wk/dashboard', 'C_wali_kelas::dashboard');
$routes->get('/wk/data_siswa', 'C_wali_kelas::dataSiswa');
$routes->get('/wk/data_siswa/ins_naik', 'C_wali_kelas::dataSiswa_insNaik');
$routes->get('/wk/absensi', 'C_wali_kelas::absensi');
$routes->get('/wk/nilai_kesehatan', 'C_wali_kelas::nilaiKesehatan');
// $routes->get('/wk/nilai_ekskul', 'C_wali_kelas::nilaiEkskul');
$routes->get('/wk/nilai_ekskul/detail/(:segment)', 'C_wali_kelas::nilaiEkskul_detail/$1');
$routes->get('/wk/nilai_kepribadian', 'C_wali_kelas::nilaiKepribadian');
$routes->get('/wk/laporan', 'C_wali_kelas::laporan');
$routes->get('/wk/nilai_mapel/(:segment)/(:segment)', 'C_wali_kelas::nilaiMapel/$1/$2');

// wali kelas detail siswa
$routes->get('/wk/data_siswa/ortu/(:segment)', 'C_wali_kelas::dataSiswa_ortu/$1');
$routes->get('/wk/data_siswa/mbaru/(:segment)', 'C_wali_kelas::dataSiswa_mbaru/$1');
$routes->get('/wk/data_siswa/mpindahan/(:segment)', 'C_wali_kelas::dataSiswa_mpindahan/$1');
$routes->get('/wk/data_siswa/tamat/(:segment)', 'C_wali_kelas::dataSiswa_tamat/$1');

// wali kelas dengan segment
$routes->get('/wk/laporan/(:segment)/(:segment)', 'C_wali_kelas::laporan_param/$1/$2');
$routes->get('/wk/data_siswa/(:segment)', 'C_wali_kelas::dataSiswa_param/$1');
$routes->get('/wk/nilai_kepribadian/(:segment)', 'C_wali_kelas::nilaiKepribadian_param/$1');
$routes->get('/wk/nilai_kesehatan/(:segment)', 'C_wali_kelas::nilaiKesehatan/$1');
$routes->get('/wk/nilai_ekskul/(:segment)', 'C_wali_kelas::nilaiEkskul_param/$1');
$routes->get('/wk/absensi/(:segment)', 'C_wali_kelas::absensi_param/$1');

//Wali_kelas Update 
$routes->get('/wk/nilai_kesehatan/data/update', 'C_wali_kelas::nilaiKesehatanUpdate');
$routes->get('/wk/absensi/data/update', 'C_wali_kelas::nilaiAbsensiUpdate');
$routes->get('/wk/nilai_ekskul/data/update', 'C_wali_kelas::nilaiEkskulUpdate');
$routes->get('/wk/nilai_ekskul/data_detil/update', 'C_wali_kelas::D_nilaiEkskulUpdate');
$routes->get('/wk/nilai_ekskul/data_detil/insert', 'C_wali_kelas::D_nilaiEkskulInsert');
$routes->get('/wk/nilai_ekskul/data_detil/delete', 'C_wali_kelas::D_nilaiEkskulDelete');
$routes->get('/wk/nilai_kepribadian/data/update', 'C_wali_kelas::nilaiKepribadianUpdate');
$routes->get('/wk/nilai_kepribadian/data/delete', 'C_wali_kelas::nilaiKepribadianDelete');
$routes->get('/wk/nilai_mapel/nm_mapel/smt/update', 'C_wali_kelas::nilaiMapelUpdate');
$routes->get('/wk/absensi/update', 'C_wali_kelas::absensiUpdate');


$routes->get('/wk/nilai/data_detil/(:segment)', 'C_wali_kelas::nilaiIns/$1');




/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
