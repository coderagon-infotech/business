<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
 * Backend Folder
 */

/*
 * Admin Folder
 */

/* Login */
$route['backend'] = 'backend/admin/login';
$route['backend/login'] = 'backend/admin/login';
$route['backend/login-action'] = 'backend/admin/login/login_action';
$route['backend/logout'] = 'backend/admin/login/logout';
$route['backend/forgot-password'] = 'backend/admin/login/forgot_password';
$route['backend/forgot-action'] = 'backend/admin/login/forgot_action';
$route['backend/reset-password/(:any)/(:any)'] = 'backend/admin/login/reset_password/$1/$2';
$route['backend/reset-action'] = 'backend/admin/login/reset_action';

/* Dashboard */
$route['backend/dashboard'] = 'backend/admin/dashboard';

/* Client */
$route['backend/client'] = 'backend/client/index';
$route['backend/add-client'] = 'backend/client/add_client';
$route['backend/update-client/(:num)'] = 'backend/client/update_client/$1';
$route['backend/client-action'] = 'backend/client/client_action';

/* Team */
$route['backend/team'] = 'backend/team/index';
$route['backend/add-team'] = 'backend/team/add_team';
$route['backend/update-team/(:num)'] = 'backend/team/update_team/$1';
$route['backend/team-action'] = 'backend/team/team_action';

/* Service */
$route['backend/service'] = 'backend/service/index';
$route['backend/add-service'] = 'backend/service/add_service';
$route['backend/update-service/(:num)'] = 'backend/service/update_service/$1';
$route['backend/service-action'] = 'backend/service/service_action';

/* Testimonial */
$route['backend/testimonial'] = 'backend/testimonial/index';
$route['backend/add-testimonial'] = 'backend/testimonial/add_testimonial';
$route['backend/update-testimonial/(:num)'] = 'backend/testimonial/update_testimonial/$1';
$route['backend/testimonial-action'] = 'backend/testimonial/testimonial_action';

/* About */
$route['backend/about'] = 'backend/about/index';
$route['backend/add-about'] = 'backend/about/add_about';
$route['backend/update-about/(:num)'] = 'backend/about/update_about/$1';
$route['backend/about-action'] = 'backend/about/about_action';

/* Banner */
$route['backend/banner'] = 'backend/banner/index';
$route['backend/add-banner'] = 'backend/banner/add_banner';
$route['backend/update-banner/(:num)'] = 'backend/banner/update_banner/$1';
$route['backend/banner-action'] = 'backend/banner/banner_action';

/* Setting */
$route['backend/setting'] = 'backend/setting/index';
$route['backend/general'] = 'backend/setting/general';
$route['backend/general-action'] = 'backend/setting/general_action';

/* Contact */
$route['backend/contact'] = 'backend/contact/index';

/*
 * Front Controller
 */
$route['about'] = 'front/about';
$route['services'] = 'front/services';
$route['contact'] = 'front/contact';
$route['contact-action'] = 'front/contact_action';
