<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login';
$route['Docks'] = 'Slots';
$route['Docks/add'] = 'Slots/add';
$route['Docks/addSlotsPost'] = 'Slots/addSlotsPost';
$route['Docks/editSlots/(:any)'] = 'Slots/editSlots/$1';
$route['Docks/editSlotsPost'] = 'Slots/editSlotsPost';
$route['Docks/deleteSlots/(:any)'] = 'Slots/deleteSlots/$1';

$route['Supplier'] = 'Users';
$route['Supplier/Add'] = 'Users/Add';
$route['Supplier/edit/(:any)'] = 'Users/Edit/$1';

$route['Subcontractor'] = 'Users';
$route['Subcontractor/Add'] = 'Users/Add';
$route['Subcontractor/edit/(:any)'] = 'Users/Edit/$1';

$route['404_override'] = 'Login/error_404';
$route['translate_uri_dashes'] = FALSE;
