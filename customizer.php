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
    'title'       => __( 'Trampoline Options', 'DOMAIN' ),
    'description' => __( 'All of the options for your trampoline site', DOMAIN ),
) );

Kirki::add_section( 'main_menu', array(
    'title'          => __( 'Main Menu' ),
    'description'    => __( 'Choose the sections you want visible in the main menu' ),
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'

));

Kirki::add_section( 'footer', array(
    'title'          => __( 'Footer Menu' ),
    'description'    => __( 'The stuff that goes in the site footer' ),
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'

) );

Kirki::add_section( 'contact', array(
    'title'          => __( 'Contact Area' ),
    'description'    => __( 'Set your public contact information' ),
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'

) );

Kirki::add_section( 'colors', array(
    'title'          => __( 'Colours' ),
    'description'    => __( 'These are all the colours for the site' ),
    'priority'       => 4,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'

));

Kirki::add_section( 'typography', array(
    'title'          => __( 'Fonts' ),
    'description'    => __( 'Choose the fonts for this site' ),
    'priority'       => 5,
    'capability'     => 'edit_theme_options',
    'panel'          => 'trampoline'
) );



/*
 * Menu
 */


Kirki::add_field( CONFIG, array(
    'type'        	=> 'checkbox',
    'section'		=> 'main_menu',
    'settings'    	=> 'menu_services',
    'label'       	=> __( 'Services', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 1,
));

Kirki::add_field( CONFIG, array(
    'type'        	=> 'checkbox',
    'section'		=> 'main_menu',
    'settings'    	=> 'menu_team',
    'label'       	=> __( 'Team', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 2,
));

Kirki::add_field( CONFIG, array(
    'type'        	=> 'checkbox',
    'section'		=> 'main_menu',
    'settings'    	=> 'menu_portfolio',
    'label'       	=> __( 'Portfolio', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 3,
));

Kirki::add_field( CONFIG, array(
    'type'        	=> 'checkbox',
    'section'		=> 'main_menu',
    'settings'    	=> 'menu_contact',
    'label'       	=> __( 'Contact', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 4,
));

Kirki::add_field( CONFIG, array(
    'type'        	=> 'checkbox',
    'section'		=> 'main_menu',
    'settings'    	=> 'show_main_menu',
    'label'       	=> __( 'Show Site Menu', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 5,
));


/*
 * Site Identity
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


/*
 * Footer Menu
 */

$originalCopyright = "Copyright © ". get_bloginfo('name') ." ". date("Y");

Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'copyright_text',
    'label'    => __( 'Copyright Text', DOMAIN ),
    'section'  => 'footer',
    'priority' => 0,
    'default'  => esc_attr__( $originalCopyright, DOMAIN ),
    'sanitize_callback' => 'sanitize_text_field'
) );
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'facebook',
    'label'    => __( 'Facebook Link', DOMAIN ),
    'section'  => 'footer',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 1,
) );

Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'twitter',
    'label'    => __( 'Twitter Link', DOMAIN ),
    'section'  => 'footer',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 2,
) );

Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'linkedin',
    'label'    => __( 'Linkedin Link', DOMAIN ),
    'section'  => 'footer',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 3,
) );

Kirki::add_field( CONFIG, array(
    'type'        	=> 'repeater',
    'label'       	=> esc_attr__( 'Footer Links', DOMAIN ),
    'section'     	=> 'footer',
    'priority'    	=> 4,
    'settings'    	=> 'footer-links',
    'transport' 	=> "postMessage",
    'row_label'  	=> array (
        'value' => 'Link'
    ),
    'fields' => array(
        'text' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link Text', 'DOMAIN' ),
            'description' => esc_attr__( 'This will be the label for your link', DOMAIN ),
            'default'     => '',
        ),
        'url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link URL', 'DOMAIN' ),
            'description' => esc_attr__( 'This will be the link URL', DOMAIN ),
            'default'     => '',
        ),
    )
) );


/*
 * Contact
 */

Kirki::add_field( CONFIG, array(
    'type'        	=> 'checkbox',
    'settings'    	=> 'show_contact',
    'label'       	=> __( 'Show Contact Area', DOMAIN ),
    'section'		=> 'contact',
    'default'     	=> '0',
    'priority'    	=> 1,
));
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'contact_title',
    'label'    => __( 'Contact Area Title', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( 'Contact Us', DOMAIN ),
    'priority' => 2,
    'sanitize_callback' => 'sanitize_text_field'
) );
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'contact_blurb',
    'label'    => __( 'Contact Area Blurb', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 3,
    'sanitize_callback' => 'sanitize_text_field'

) );
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'public_phone_number_display',
    'label'    => __( 'Publicly Visible Display Number (1-800-123-4567)', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 4

) );
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'public_phone_number_for_dialing',
    'label'    => __( 'Publicly Visible Actual Number (18001234567)', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 5
) );
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'public_email',
    'label'    => __( 'Publicly Visible Contact Email', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 6
) );
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'phone_mobile_text',
    'label'    => __( 'Text for "Phone Us" button on mobile', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( 'Call', DOMAIN ),
    'priority' => 7
) );
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'email_mobile_text',
    'label'    => __( 'Text for "Email Us" button on mobile', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( 'Email', DOMAIN ),
    'priority' => 7
) );


/*
 * Add Fonts and Colors
 */

$defaults = new CustomizerDefaults();
foreach ($defaults->get_fonts() as $font){
    Kirki::add_field( CONFIG, array(
        'type'        => 'typography',
        'settings'    => $font['slug'],
        'label'       => esc_attr__( $font['label'], DOMAIN ),
        'section'     => 'typography',
        'default'     => array(
            'font-family'    => $font['font-family'],
            'variant'		 => 'regular',
            'subsets'        => array( 'latin-ext' )
        ),
        'priority'    => 10
    ) );
}

foreach ($defaults->get_colors() as $color){
    Kirki::add_field( CONFIG, array(
        'type'        => 'color',
        'settings'    => $color['slug'],
        'label'       => __( $color['label'], DOMAIN ),
        'section'     => 'colors',
        'default'     => $color['value'],
        'tooltip'     => $color['tooltip'],
        'priority'    => 10,
        'panel'       => 'trampoline'
    ) );
}
