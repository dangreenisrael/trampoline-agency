<?php
/**
 * Kirki customizer stuff.
 * User: Dan
 * Date: 07/07/2016
 * Time: 10:44
 */

if ( ! function_exists( 'my_theme_kirki_update_url' ) ) {
    function my_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_template_directory_uri() . '/vendor/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'my_theme_kirki_update_url' );

define('CONFIG', 'trampoline-agency-config');
Kirki::add_config( CONFIG , array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod',
) );

/*
 * Add Sections
 */
Kirki::add_panel( 'trampoline', array(
    'priority'    => 1,
    'title'       => __( 'Trampoline Options', DOMAIN ),
    'description' => __( 'All of the options for your trampoline site', DOMAIN ),
) );
Kirki::add_section( 'main_menu', array(
    'title'          => __( 'Main Menu', DOMAIN ),
    'description'    => __( 'Choose the sections and text you want visible in the main menu', DOMAIN ),
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'

));
Kirki::add_section( 'footer', array(
    'title'          => __( 'Footer Menu', DOMAIN ),
    'description'    => __( 'The stuff that goes in the site footer', DOMAIN ),
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'

) );
Kirki::add_section( 'contact', array(
    'title'          => __( 'Contact Area', DOMAIN ),
    'description'    => __( 'Set your public contact information', DOMAIN ),
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'

) );
Kirki::add_section( 'colors', array(
    'title'          => __( 'Colours', DOMAIN ),
    'description'    => __( 'These are all the colours for the site', DOMAIN ),
    'priority'       => 4,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'

));
Kirki::add_section( 'typography', array(
    'title'          => __( 'Fonts', DOMAIN ),
    'description'    => __( 'Choose the fonts for this site', DOMAIN ),
    'priority'       => 5,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'
) );



include_once ('sections/colors.php');
include_once ('sections/contact.php');
include_once ('sections/footer.php');
include_once ('sections/main_menu.php');
include_once ('sections/typography.php');

/*
 * Default Sections
 */

Kirki::add_field( CONFIG, array(
    'type'        => 'image',
    'settings'    => 'header_logo',
    'label'       => __( 'Header Logo', DOMAIN ),
    'description' => __( 'This is the Logo in the header', DOMAIN ),
    'section'     => 'title_tagline',
    'default'     => '',
    'priority'    => 10,
) );

Kirki::add_field( CONFIG, array(
    'type'        => 'image',
    'settings'    => 'archive_image',
    'label'       => __( 'Blog Image', DOMAIN ),
    'description' => __( 'This is header image for blog archive pages', DOMAIN ),
    'section'     => 'static_front_page',
    'default'     => '',
    'priority'    => 10,
) );


/*
 * Pass in LESS variables
 */
//
//add_filter( 'less_vars', 'my_less_vars', 10, 2 );
//// $handle is a reference to the handle used with wp_enqueue_style()
//
//function my_less_vars( $vars, $handle ) {
//    $defaults = new CustomizerDefaults();
//    $fonts = $defaults->get_fonts();
//    $colors = $defaults->get_colors();
//    foreach ($defaults->get_fonts() as $font){
//        $slug = $font['slug'];
//        $vars[$slug] = "'".get_theme_mod( $slug, $fonts[$slug])['font-family'] ."'";
//        $value = get_theme_mod( $slug, $fonts[$slug]);
//            echo '<pre> '.$slug;
//            $keywords = preg_split('#(?<=\d)(?=[a-z])#i', $value['variant']);
//            var_dump($keywords);
//            foreach ($keywords as $keyword){
//                if(is_numeric().
//            }
//            echo '</pre>';
//
//    }
//    foreach ($defaults->get_colors() as $color){
//        $slug = $color['slug'];
//        $vars[$slug] = get_theme_mod($slug, $colors[$slug]['value']);
//    }
//    return $vars;
//}