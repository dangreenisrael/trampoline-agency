<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 21/07/2016
 * Time: 18:14
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
    'default'  => esc_attr__( '111.111.1111', DOMAIN ),
    'tooltip'  => esc_attr__( 'This is the number that people will see', DOMAIN),
    'priority' => 4

) );
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'public_phone_number_for_dialing',
    'label'    => __( 'Publicly Visible Actual Number (18001234567)', DOMAIN ),
    'section'  => 'contact',
    'default'  => esc_attr__( '', DOMAIN ),
    'tooltop'  => esc_attr__( 'This is the number that will dial if people tap with on their phones', DOMAIN),
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
