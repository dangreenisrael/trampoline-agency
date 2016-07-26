<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 21/07/2016
 * Time: 18:14
 */

Kirki::add_field( CONFIG, array(
	'type'        	=> 'toggle',
	'section'		=> 'main_menu',
	'settings'    	=> 'show_main_menu',
	'label'       	=> __( 'Show Wordpress "Main Menu"', DOMAIN ),
	'default'     	=> '0',
	'priority'    	=> 9,
));


Kirki::add_field( CONFIG, array(
    'type'        	=> 'toggle',
    'section'		=> 'main_menu',
    'settings'    	=> 'menu_contact',
    'label'       	=> __( 'Show Menu link for Contact', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 7,
));
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'menu_contact_text',
    'section'  => 'main_menu',
    'default'  => esc_attr__( 'Contact', DOMAIN ),
    'priority' => 8,
    'sanitize_callback' => 'sanitize_text_field'
) );
