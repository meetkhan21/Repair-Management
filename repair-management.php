<?php

/**
 * Plugin Name:       Mobile Repair Management
 * Plugin URI:        http://www.najamabbas.me/
 * Description:       Custom Mobile-Repair Order Management PLugin.
 * Version:           0.0.1
 * Author:            Najam Abbas Naqvi
 * Author URI:        http://www.najamabbas.me/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       repair-management-plugin
 * Domain Path:       /languages
 */


// Activation-------------------------------------------------------------------
function repair_plugin_activation()
{
    require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
    repairActivation();
}

register_activation_hook(__FILE__, 'repair_plugin_activation');



// Register Scripts and styles---------------------------------------------------
function repair_load_scripts()
{
//  Style
    wp_register_style('mainstyle',plugin_dir_url(__FILE__).'public/style/repairstyle.css',array(),false,'all');

//  Scripts
    wp_register_script('vue', plugin_dir_url(__FILE__) . 'public/vendors/vue.min.js',array(),'',false);
    wp_register_script('axios', plugin_dir_url(__FILE__) . 'public/vendors/axios.min.js',array(),'',false);

    wp_register_script('publicorder', plugin_dir_url(__FILE__) . 'public/js/publicorder.js',array('jquery'),'',true);
    wp_localize_script('publicorder', 'wpvalues', array('userid' => get_current_user_id(), 'baseurl' => get_site_url()));




}

//---------------------------------------------

function repair_admin_scripts(){
    // loading css
    wp_register_style( 'material-css', plugin_dir_url(__FILE__) . 'public/vendors/bootstrap.min.css', false, '1.0.0' );
    wp_register_style('adminstyle',plugin_dir_url(__FILE__).'public/style/adminstyle.css',array(),false,'all');

    // loading js
    wp_register_script( 'popper-js',  plugin_dir_url(__FILE__) . 'public/vendors/popper.js', array('jquery'), false, false );
    wp_register_script( 'material-js',  plugin_dir_url(__FILE__) . 'public/vendors/bootstrap.min.js', array('jquery'), '', false );
    wp_register_script('vue', plugin_dir_url(__FILE__) . 'public/vendors/vue.min.js',array(),'',false);
    wp_register_script('axios', plugin_dir_url(__FILE__) . 'public/vendors/axios.min.js',array(),'',false);

    wp_register_script('adminorder', plugin_dir_url(__FILE__) . 'public/js/adminorder.js',array(),'',true);
    wp_localize_script('adminorder', 'wpvalues', array('baseurl' => get_site_url(),'userId'=>get_current_user_id()));
}

add_action('wp_enqueue_scripts', 'repair_load_scripts');
add_action('admin_enqueue_scripts', 'repair_admin_scripts');


// // Handle Shortcodes--------------------------------------------------------------
function repair_shortcode()
{
    wp_enqueue_style( 'mainstyle');
    wp_enqueue_script('vue');
    wp_enqueue_script('axios');
    wp_enqueue_script('publicorder');
    return require plugin_dir_path(__FILE__) . 'public/views/orderview.php';
}
add_shortcode('apointmentmanagement', 'repair_shortcode');


//AdminPage-------------------------------------------------------------------------
function rapir_menu_page_view(){
    wp_enqueue_style( 'material-css' );
    wp_enqueue_style( 'mainstyle');

    wp_enqueue_script( 'popper-js' );
    wp_enqueue_script( 'material-js' );
    wp_enqueue_script('vue');
    wp_enqueue_script( 'axios');
    wp_enqueue_script( 'adminorder' );

    return require plugin_dir_path(__FILE__) . 'public/views/orderviewadmin.php';
}
function repair_menu_page() {

    // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page( 'Rapair Orders Management', 'Repair Orders', 'manage_options', 'repair-orders-admin','rapir_menu_page_view', 'dashicons-welcome-widgets-menus', 90 );
}
add_action( 'admin_menu', 'repair_menu_page' );



//Options Page-----------------------------------------------------------------------
function myplugin_register_options_page() {
    add_options_page('Repair Management Options', 'Repair Management Options', 'manage_options', 'repair-orders-option', 'myplugin_option_page');
}
add_action('admin_menu', 'myplugin_register_options_page');

function myplugin_option_page()
{
    return require plugin_dir_path(__FILE__) . 'public/views/optionsview.php';
}


// REST ROUTES

function prefix_register_my_rest_routes()
{
    require_once plugin_dir_path(__FILE__) . 'includes/RepairRestController.php';
    $controller = new RepairRestController();
    $controller->RegisterRoutes();
}

add_action('rest_api_init', 'prefix_register_my_rest_routes');

