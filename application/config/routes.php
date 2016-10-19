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
$route['default_controller'] = 'User_controller';
/* User */
$route['admin'] = "Auth";
$route['user'] = 'User_controller/index';
$route['Logout'] = 'User_controller/logout';
$route['registerme/(:any)/(:any)'] = 'User_controller/registerme/$1/$2';
$route['fblogin'] = 'User_controller/fblogin';
$route['resetpassword/(:any)/(:any)'] = 'User_controller/resetpassword/$1/$2';
$route['resetp'] = 'User_controller/resetp';
$route['admin/dashboard'] = "admin/Admin_controller/dashboard";
$route['admin/Groups'] = "admin/System_user_controller/groups";
$route['admin/Groups-add'] = "admin/System_user_controller/group_add";
$route['admin/Groups-save'] = "admin/System_user_controller/group_save";
$route['admin/Groups_view/(:any)'] = "admin/System_user_controller/group_view/$1";
$route['admin/Groups-edit/(:any)'] = "admin/System_user_controller/group_edit/$1";
$route['admin/Groups-update/(:any)'] = "admin/System_user_controller/group_update/$1";
$route['admin/Groups-menu-alloc/(:any)'] = "admin/System_user_controller/group_menu_alloc/$1";
$route['admin/Group-menu-alloc-save/(:any)'] = "admin/System_user_controller/group_menu_alloc_save/$1";
$route['admin/Menus'] = "admin/System_user_controller/menus";
$route['admin/Menus-add'] = "admin/System_user_controller/menus_add";
$route['admin/Menus-edit/(:any)'] = "admin/System_user_controller/menus_edit/$1";
$route['admin/Menus-save'] = "admin/System_user_controller/menus_save";
$route['admin/Menus-update/(:any)'] = "admin/System_user_controller/menus_update/$1";
$route['admin/Users'] = "admin/System_user_controller/system_users";
$route['admin/Users-add'] = "admin/System_user_controller/system_user_add";
$route['admin/Users-edit/(:any)'] = "admin/System_user_controller/system_user_edit/$1";
$route['admin/user_view/(:any)'] = "admin/System_user_controller/user_view/$1";
$route['admin/User-save'] = "admin/System_user_controller/system_user_save";
$route['admin/User-update/(:any)'] = "admin/System_user_controller/system_user_update/$1";
$route['admin/Users-menu-alloc/(:any)'] = "admin/System_user_controller/users_menu_alloc/$1";
$route['admin/User-menu-alloc-save/(:any)'] = "admin/System_user_controller/user_menu_alloc_save/$1";
$route['admin/KeyConcepts'] = "admin/Admin_controller/key_concepts_list";
$route['admin/KeyConcepts-add'] = "admin/Admin_controller/key_concepts";
$route['admin/KC-save'] = "admin/Admin_controller/save_key_concepts";
$route['admin/KC-edit/(:any)'] = "admin/Admin_controller/key_concept_edit/$1";
$route['admin/KC-update/(:any)'] = "admin/Admin_controller/key_concept_update/$1";
$route['admin/view/(:any)'] = "admin/Admin_controller/view/$1";
$route['admin/Exercise'] = "admin/Admin_controller/exercise";
$route['admin/Exercise-add'] = "admin/Admin_controller/exercise_add";
$route['admin/Exercise_edit/(:any)'] = "admin/Admin_controller/exercise_edit/$1";
$route['admin/Exercise-update/(:any)'] = "admin/Admin_controller/exercise_update/$1";
$route['admin/Exercise-view/(:any)'] = "admin/Admin_controller/exercise_view/$1";
$route['admin/Track'] = "admin/Admin_controller/track_user_list";
$route['admin/Company-edit/(:any)'] = "admin/System_user_controller/company_edit/$1";
$route['admin/Company-view/(:any)'] = "admin/System_user_controller/company_details/$1";
$route['admin/Company-update/(:any)'] = "admin/System_user_controller/company_update/$1";
$route['admin/Company'] = "admin/System_user_controller/company";
$route['admin/Exercise-save'] = "admin/Admin_controller/save_exercise";
$route['admin/Job/job-add'] = "admin/System_user_controller/create_job";
$route['admin/Job/job'] = "admin/System_user_controller/job";
$route['admin/Job/job-save'] = "admin/System_user_controller/job_save";
$route['admin/Job/Job-view/(:any)'] = "admin/System_user_controller/job_details/$1";
$route['admin/Job/Job-edit/(:any)'] = "admin/System_user_controller/job_edit/$1";
$route['admin/Job/Job-update/(:any)'] = "admin/System_user_controller/job_update/$1";

$route['admin/Qtype-add'] = "admin/System_user_controller/questionType_add";
$route['admin/Qtype'] = "admin/System_user_controller/question_type";
$route['admin/Qtype-save'] = "admin/System_user_controller/questionType_save";
$route['admin/Qtype-view/(:any)'] = "admin/System_user_controller/questionType_details/$1";
$route['admin/Qtype-edit/(:any)'] = "admin/System_user_controller/questionType_edit/$1";
$route['admin/Qtype-update/(:any)'] = "admin/System_user_controller/questionType_update/$1";
$route['admin/Rank/studentRank'] = "admin/Rank_controller/rank";
$route['admin/Rank/show-Rank'] = "admin/Rank_controller/show_rank";
$route['admin/Rank/show-profile/(:any)'] = "admin/Rank_controller/show_user_profile/$1";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
