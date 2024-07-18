<?php

/** @var \CodeIgniter\Router\RouteCollection $routes */
use App\Controllers\SuperAdmin\Superadmin_Controller;
use App\Controllers\SuperAdmin\Superadmin_action_Controller;

########################### DASHBOARD ############################
$routes->get('dashboard', 'Superadmin_Controller::index', ['as' => 'superadmin_dashboard']);
$routes->post('data-tables', 'Superadmin_action_Controller::datatables_users_dashboard', ['as' => 'datatables_dashboard']);

########################### ADD ACCOUNT ############################
$routes->get('add-account', 'Superadmin_Controller::add_account', ['as' => 'add_account']);
  
########################### MENU MANAGEMENT ############################
$routes->get('menu-management', 'Superadmin_Controller::v_menu_management', ['as' => 'menu-management']);
$routes->post('load-menu', 'Superadmin_action_Controller::load_menu', ['as' => 'load_menu']);
$routes->post('load-sub-menu', 'Superadmin_action_Controller::load_sub_menu', ['as' => 'load_sub_menu']);
$routes->post('add-menu-categories', 'Superadmin_action_Controller::add_new_menu_categories', ['as' => 'add_new_menu_categories']);
$routes->post('add-menu', 'Superadmin_action_Controller::add_new_menu', ['as' => 'add_new_menu']);
$routes->post('add-sub-menu', 'Superadmin_action_Controller::add_new_submenu', ['as' => 'add_new_submenu']);
$routes->post('move-menu', 'Superadmin_action_Controller::move_menu', ['as' => 'move_menu']);

########################### USERS ############################
$routes->get('view-users', 'Superadmin_Controller::view_users', ['as' => 'view-users']);
$routes->post('check-email', 'Superadmin_action_Controller::checkEmail');
$routes->post('check-username', 'Superadmin_action_Controller::checkUsername');
$routes->post('create-account', 'Superadmin_action_Controller::create_account', ['as' => 'create-account']);

########################### CALENDAR ############################
$routes->get('view-calendar', 'Superadmin_Controller::v_calendar', ['as => view-calendar']);
$routes->get('load-events-calendar', 'Superadmin_action_Controller::load_events_calendar', ['as' => 'load_events_calendar']);
$routes->post('save-events-calendar', 'Superadmin_action_Controller::save_event_calendar', ['as' => 'save_event_calendar']);
$routes->get('delete-event/(:any)', 'Superadmin_action_Controller::delete_event_calendar/$1', ['as' => 'delete_event']);
$routes->get('edit-event/(:any)', 'Superadmin_Controller::update_view_calendar/$1', ['as' => 'view_edit']);
$routes->post('update-events/(:any)', 'Superadmin_action_Controller::update_event_calendar/$1', ['as' => 'update-event']);

########################## LEARNING MATERIALS ############################
$routes->get('view-learning-materials', 'Superadmin_Controller::v_material', ['as' => 'view-learning-materials']);
$routes->post('save-materi', 'Superadmin_action_Controller::save_learning_material', ['as' => 'save-materi']);
$routes->post('publish-materi', 'Superadmin_action_Controller::publishMateri', ['as' => 'publish-materi']);
$routes->post('close-materi', 'Superadmin_action_Controller::closeMateri', ['as' => 'close-materi']);
$routes->post('delete-materi', 'Superadmin_action_Controller::deleteMateri', ['as' => 'delete-materi']);

############################### PROFILE ############################
$routes->get('my-profile', 'Superadmin_Controller::v_myprofile', ['as' => 'my-profile']);

########################### JOB #####################################
$routes->get('view-job', 'Superadmin_Controller::v_jobs', ['as' => 'view-job']);
$routes->post('post-a-job', 'Superadmin_action_Controller::posting_jobs', ['as' => 'post-a-job']);
$routes->post('data-tables-jobs', 'Superadmin_action_Controller::datatables_jobs_dashboard', ['as' => 'datatables_jobs']);
$routes->get('view-applied/(:any)', 'Superadmin_Controller::v_who_applied/$1', ['as' => 'view_applied']);
$routes->get('edit-job/(:any)', 'Superadmin_Controller::edit_job/$1', ['as' => 'edit_jobs']);
$routes->post('update-job/(:any)', 'Superadmin_action_Controller::update_jobs/$1', ['as' => 'update_job']);

################################# ROLE ############################
$routes->get('role', 'Superadmin_Controller::v_role', ['as' => 'role']);
$routes->post('datatables-role', 'Superadmin_action_Controller::datatables_role', ['as' => 'datatables_role']);


################################### job level ############################
$routes->get('job-level', 'Superadmin_Controller::v_level', ['as' => 'job-level']);
$routes->post('datatables-level', 'Superadmin_action_Controller::datatables_level', ['as' => 'datatables_level']);

############################## position ############################
$routes->get('position', 'Superadmin_Controller::v_position', ['as' => 'position']);
$routes->post('datatables-position', 'Superadmin_action_Controller::datatables_position', ['as' => 'datatables_position']);

############################## location ############################
$routes->get('location', 'Superadmin_Controller::v_location', ['as' => 'location']);
$routes->post('datatables-location', 'Superadmin_action_Controller::datatables_location', ['as' => 'datatables_location']);

############################## Department ############################
$routes->get('department', 'Superadmin_Controller::v_department', ['as' => 'department']);
$routes->post('datatables-department', 'Superadmin_action_Controller::datatables_department', ['as' => 'datatables_department']);

############################## Company ############################
$routes->get('company', 'Superadmin_Controller::v_company', ['as' => 'company']);
$routes->post('datatables-company', 'Superadmin_action_Controller::datatables_company', ['as' => 'datatables_company']);

############################### Contract ############################
$routes->get('contracts', 'Superadmin_Controller::v_contract', ['as' => 'contract']);
$routes->post('datatables-contract', 'Superadmin_action_Controller::datatables_contract', ['as' => 'datatables_contract']);

########################### Items data ############################
$routes->get('add-items', 'Superadmin_Controller::v_adding_items', ['as' => 'add-item']);
$routes->post('datatables-items', 'Superadmin_action_Controller::datatables_items', ['as' => 'datatables_items']);
$routes->post('add-item-stock', 'Superadmin_action_Controller::add_item_stock', ['as' => 'add_item_stock']);

$routes->get('edit-items/(:any)', 'Superadmin_Controller::v_edit_barang/$1', ['as' => 'edit_items']);
$routes->post('update-items/(:any)', 'Superadmin_action_Controller::update_items/$1', ['as' => 'update_items']);
$routes->get('delete-items/(:any)', 'Superadmin_action_Controller::delete_items/$1', ['as' => 'delete_items']);

########################### Items Type ############################
$routes->get('add-item-type', 'Superadmin_Controller::v_adding_type', ['as' => 'add-item-type']);
$routes->post('datatables-type', 'Superadmin_action_Controller::datatables_items_type', ['as' => 'datatables_type_items']);
$routes->post('add-item-type', 'Superadmin_action_Controller::add_item_type', ['as' => 'add_item_type']);
$routes->get('edit-item-type/(:any)', 'Superadmin_Controller::v_edit_type/$1', ['as' => 'edit_item_type']);
$routes->post('update-items-type/(:any)', 'Superadmin_action_Controller::update_items_type/$1', ['as' => 'update_items_type']);
$routes->get('delete-items-type/(:any)', 'Superadmin_action_Controller::delete_items_type/$1', ['as' => 'delete_items_type']);

###################### Item transaction ########################
$routes->get('item-transaction', 'Superadmin_Controller::v_item_transaction', ['as' => 'item_transaction']);
$routes->post('datatables-items-transaction', 'Superadmin_action_Controller::datatables_items_transaction', ['as' => 'datatables_items_transaction']);
$routes->post('take-item', 'Superadmin_action_Controller::takeItem', ['as'  => 'take_item']);