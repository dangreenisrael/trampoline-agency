<?php
/**
 * Kirki customizer stuff.
 * User: Dan
 * Date: 07/07/2016
 * Time: 10:44
 */


if ( ! function_exists( 'my_theme_kirki_update_url' ) ) {
    function my_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_stylesheet_directory_uri() . '/vendor/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'my_theme_kirki_update_url' );


Kirki::add_config( DOMAIN , array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod',
) );

Kirki::add_section( 'typography', array(
    'title'          => __( 'Site Fonts' ),
    'description'    => __( 'Choose the fonts for this site' ),
    'priority'       => 15,
    'capability'     => 'edit_theme_options',
) );


$defaults = new CustomizerDefaults();

foreach ($defaults->get_fonts() as $font){
    Kirki::add_field( 'config', array(
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
    Kirki::add_field( 'config', array(
        'type'        => 'color',
        'settings'    => $color['slug'],
        'label'       => __( $color['label'], DOMAIN ),
        'section'     => 'colors',
        'default'     => $color['value'],
        'priority'    => 10
    ) );
}


/*
 * Menu stuff
 */

Kirki::add_section( 'home-sections', array(
    'title'          => __( 'Homepage Menu Links' ),
    'description'    => __( 'These links to homepage sections will show in the main menu' ),
    'priority'       => 200,
    'capability'     => 'edit_theme_options',
));

Kirki::add_field( 'config', array(
    'type'        	=> 'checkbox',
    'section'		=> 'home-sections',
    'settings'    	=> 'menu_services',
    'label'       	=> __( 'Services', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 10,
));

Kirki::add_field( 'config', array(
    'type'        	=> 'checkbox',
    'section'		=> 'home-sections',
    'settings'    	=> 'menu_team',
    'label'       	=> __( 'Team', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 11,
));

Kirki::add_field( 'config', array(
    'type'        	=> 'checkbox',
    'section'		=> 'home-sections',
    'settings'    	=> 'menu_portfolio',
    'label'       	=> __( 'Portfolio', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 12,
));

Kirki::add_field( 'config', array(
    'type'        	=> 'checkbox',
    'section'		=> 'home-sections',
    'settings'    	=> 'menu_contact',
    'label'       	=> __( 'Contact', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 13,
));


/*
 * Footer Stuff
 */

Kirki::add_section( 'footer', array(
    'title'          => __( 'Footer Menu' ),
    'description'    => __( 'The stuff that goes in the site footer' ),
    'priority'       => 16,
    'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'config', array(
    'type'        	=> 'repeater',
    'label'       	=> esc_attr__( 'Footer Links', DOMAIN ),
    'section'     	=> 'footer',
    'priority'    	=> 10,
    'settings'    	=> 'footer-links',
    'transport' 	=> "postMessage",
    'row_label'  	=> array (
        'value' => 'Link'
    ),
    'default'     => array(
        array(
            'text' => esc_attr__( 'Site 1', DOMAIN ),
            'url'  => 'https://kirki.org',
        ),
        array(
            'text' => esc_attr__( 'Site 2', DOMAIN ),
            'url'  => 'https://github.com/aristath/kirki',
        ),
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

Kirki::add_field( 'facebook', array(
    'type'     => 'text',
    'settings' => 'facebook',
    'label'    => __( 'Facebook Link', DOMAIN ),
    'section'  => 'footer',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 10,
) );

Kirki::add_field( 'twitter', array(
    'type'     => 'text',
    'settings' => 'twitter',
    'label'    => __( 'Twitter Link', DOMAIN ),
    'section'  => 'footer',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 10,
) );

Kirki::add_field( 'linkedin', array(
    'type'     => 'text',
    'settings' => 'linkedin',
    'label'    => __( 'Linkedin Link', DOMAIN ),
    'section'  => 'footer',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 10,
) );



Kirki::add_section( 'contact', array(
    'title'          => __( 'Contact Area' ),
    'description'    => __( 'Set the info for the contact area' ),
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'contact_title', array(
    'type'     => 'text',
    'settings' => 'contact_title',
    'label'    => __( 'Contact Area Title', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 5,
) );
Kirki::add_field( 'contact_blurb', array(
    'type'     => 'text',
    'settings' => 'contact_blurb',
    'label'    => __( 'Contact Area Blurb', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 5,
) );
Kirki::add_field( 'public_phone_number_display', array(
    'type'     => 'text',
    'settings' => 'public_phone_number_display',
    'label'    => __( 'Publicly Visible Display Number (1-800-123-4567)', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 5,
) );
Kirki::add_field( 'public_phone_number_for_dialing', array(
    'type'     => 'text',
    'settings' => 'public_phone_number_for_dialing',
    'label'    => __( 'Publicly Visible Actual Number (18001234567)', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 5,
) );

Kirki::add_field( 'public_email', array(
    'type'     => 'text',
    'settings' => 'public_email',
    'label'    => __( 'Publicly Visible Contact Email', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'priority' => 5,
) );

