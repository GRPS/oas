<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['repair_slip/(:num)/(:num)'] = 'page/index/repair_slip/$1/$2';

$route['default_controller'] = "page/index/home";
$route['404_override'] = '';

//$route['admin'] = 'admin';

$route['product/get_no_family'] = 'product/get_no_family';
$route['product/po1_no_price'] = 'product/po1_no_price';
$route['product/saturno_no_show'] = 'product/saturno_no_show';
$route['product/check_po4_carat'] = 'product/check_po4_carat';
$route['product/kill_prodcalc'] = 'product/kill_prodcalc';

//Popular menu items. If you add here then make sure you add to the popular menu too.
$route['diamond-ring?([a-z]+)'] = 'product/index/rings/diamond';
$route['engagement-ring?([a-z]+)'] = 'product/index/rings/engagement';
$route['eternity-ring?([a-z]+)'] = 'product/index/rings/eternity';
$route['wedding-ring?([a-z]+)'] = 'product/index/rings/wedding';
$route['rolex-watch?([a-z]+)'] = 'product/index/watches/rolex';
$route['platinum'] = 'product/search/platinum';
$route['saturno'] = 'product/index/ornaments/saturno';

//Aditional misc items.
$route['repair?([a-z]+)'] = 'page/index/services';


$route['thanks'] = 'thanks/index';
$route['home'] = 'page/index/home';
$route['home_1page'] = 'page/index/home_1page';
$route['about-us'] = 'page/index/about-us';
$route['product'] = 'product/index/Special%20Offers';
$route['product/(:any)'] = 'product/index/$1';
$route['product/(:any)/(:any)'] = 'product/index/$1/$2';
$route['product/(:any)/(:any)/(:any)'] = 'product/index/$1/$2/$3';
$route['bespoke-jewellery/(:any)'] = 'page/index/bespoke-jewellery-$1';
//$route['bespoke-jewellery/design'] = 'page/index/bespoke-jewellery-design';
//$route['bespoke-jewellery/gallery'] = 'page/index/bespoke-jewellery-gallery';
//$route['bespoke-jewellery/testimonials'] = 'page/index/bespoke-jewellery-testimonials';
$route['old-gold'] = 'page/index/old-gold';
$route['services'] = 'page/index/services';
$route['valuations'] = 'page/index/valuations';
$route['jewellery-insurance'] = 'page/index/jewellery-insurance';
$route['anniversaries'] = 'page/index/anniversaries';
$route['birthstones'] = 'page/index/birthstones';
$route['zodiac-stones'] = 'page/index/zodiac-stones';
$route['diamonds'] = 'page/index/diamonds';
$route['pearls'] = 'page/index/pearls';
$route['special-offers'] = 'page/index/specialoffers';
$route['contact-us'] = 'page/index/contactus';
$route['terms-and-conditions'] = 'page/index/terms-and-conditions';
$route['terms-of-sale'] = 'page/index/terms-of-sale';
$route['linked-sites'] = 'page/index/linked-sites';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
