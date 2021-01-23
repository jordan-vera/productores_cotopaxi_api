<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'cities';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['canton']['get'] = 'canton/index';
$route['canton/(:any)']['get'] = 'canton/find/$1';

$route['productores']['get'] = 'productores/index';
$route['productores/(:num)']['get'] = 'productores/find/$1';
$route['productores']['post'] = 'productores/index';
$route['productores/(:num)']['delete'] = 'productores/index/$1';
$route['productores/(:any)']['put'] = 'productores/index/$1';

$route['actividades']['get'] = 'actividades/index';
$route['actividades/(:num)']['get'] = 'actividades/find/$1';
$route['actividades']['post'] = 'actividades/index';
$route['actividades/(:num)']['delete'] = 'actividades/index/$1';

$route['contacto/(:num)']['get'] = 'contacto/find/$1';
$route['contacto']['post'] = 'contacto/index';
$route['contacto']['put'] = 'contacto/index';
$route['contacto/(:num)']['delete'] = 'contacto/index/$1';

$route['galeria/(:num)']['get'] = 'galeria/find/$1';
$route['galeria']['post'] = 'galeria/index';
$route['galeria/(:num)/(:any)']['delete'] = 'galeria/index/$1/$2';

$route['login/(:any)/(:any)']['get'] = 'administrador/login/$1/$2';
$route['admin/(:num)']['get'] = 'usuarios/find/$1';


/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
//$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
//$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
