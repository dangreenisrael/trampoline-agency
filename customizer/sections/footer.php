<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 21/07/2016
 * Time: 18:14
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
            'label'       => esc_attr__( 'Link Text', DOMAIN ),
            'description' => esc_attr__( 'This will be the label for your link', DOMAIN ),
            'default'     => '',
        ),
        'url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link URL', DOMAIN ),
            'description' => esc_attr__( 'This will be the link URL', DOMAIN ),
            'default'     => '',
        ),
    )
));
