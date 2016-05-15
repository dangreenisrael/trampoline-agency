<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 11/05/2016
 * Time: 15:36
 */

/*
 * Advanced Custom Fields
 * */

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    $path = get_stylesheet_directory() . '/acf/advanced-custom-fields-pro/';
    return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/acf/advanced-custom-fields-pro/';
    return $dir;
}

// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once( get_stylesheet_directory() . '/acf/advanced-custom-fields-pro/acf.php' );
include_once(get_stylesheet_directory().'/acf/advanced-custom-fields-font-awesome-customized/acf-font-awesome.php');
include_once(get_stylesheet_directory() . '/acf/acf-image-crop-add-on-customized/acf-image-crop.php');

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Home Page',
        'menu_slug' 	=> 'home-page-options',
        'icon_url' 		=> 'dashicons-admin-home',
        'redirect'		=> true,
        'position'		=> "3.01"
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Hero',
        'menu_title' 	=> 'Hero',
        'parent_slug'	=> 'home-page-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Services',
        'menu_title' 	=> 'Services',
        'parent_slug'	=> 'home-page-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Portfolio',
        'menu_title' 	=> 'Portfolio',
        'parent_slug'	=> 'home-page-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Timeline',
        'menu_title' 	=> 'Timeline',
        'parent_slug'	=> 'home-page-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Team',
        'menu_title' 	=> 'Team',
        'parent_slug'	=> 'home-page-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Contact',
        'menu_title' 	=> 'Contact',
        'parent_slug'	=> 'home-page-options',
    ));
    acf_add_options_page(array(
        'page_title' 	=> 'Site Settings',
        'menu_slug' 	=> 'site-general-settings',
        'capability'	=> 'edit_posts',
        'icon_url'		=> 'dashicons-admin-customizer',
        'redirect'		=> false,
        'position'		=> "3.02"
    ));
}
