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
    $path = get_template_directory() . '/acf/advanced-custom-fields-pro/';
    return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {
    $dir = get_template_directory_uri() . '/acf/advanced-custom-fields-pro/';
    return $dir;
}

// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once(get_template_directory() . '/acf/advanced-custom-fields-pro/acf.php' );
include_once(get_template_directory().'/acf/advanced-custom-fields-font-awesome-customized/acf-font-awesome.php');
include_once(get_template_directory() . '/acf/acf-image-crop-add-on-customized/acf-image-crop.php');