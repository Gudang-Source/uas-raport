<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
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
$routes->get('/', 'Login::index');
$routes->group('admin', function($routes) {
	$routes->add('/', 'Admin\Dashboard::index');
	$routes->add('dashboard', 'Admin\Dashboard::index');
	$routes->add('nilai', 'Admin\Nilai::index');
	$routes->add('raport',  'Admin\Raport::index');
	$routes->add('kbm',  'Admin\Kbm::index');
	$routes->add('mapel',  'Admin\Mapel::index');
	$routes->add('kelas',  'Admin\Kelas::index');
	$routes->add('guru','Admin\Guru::index');
	$routes->add('guru/keahlian','Admin\Guru::keahlian');
	$routes->add('siswa',  'Admin\Siswa::index');
});
$routes->group('guru', function($routes) {
	$routes->add('/', 'Guru\Dashboard::index');
	$routes->add('dashboard', 'Guru\Dashboard::index');
	$routes->add('nilai', 'Guru\Nilai::index');
	$routes->add('raport',  'Guru\Raport::index');
	$routes->add('mapel',  'Guru\Mapel::index');
	$routes->add('kelas',  'Guru\Kelas::index');
	$routes->add('profile','Guru\Guru::index');
	$routes->add('siswa',  'Guru\Siswa::index');
});
$routes->group('wali', function($routes) {
	$routes->add('/', 'Wali\Dashboard::index');
	$routes->add('dashboard', 'Wali\Dashboard::index');
	$routes->add('raport',  'Wali\Raport::index');
	$routes->add('siswa',  'Wali\Siswa::index');
});
$routes->group('siswa', function($routes) {
	$routes->add('/', 'Siswa\Dashboard::index');
	$routes->add('dashboard', 'Siswa\Dashboard::index');
	$routes->add('profile',  'Siswa\Siswa::index');
});
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
