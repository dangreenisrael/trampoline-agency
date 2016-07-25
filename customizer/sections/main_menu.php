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
    'settings'    	=> 'menu_services',
    'label'       	=> __( 'Services', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 1,
));
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'menu_services_text',
    'section'  => 'main_menu',
    'default'  => esc_attr__( 'Services', DOMAIN ),
    'priority' => 2,
    'sanitize_callback' => 'sanitize_text_field'
) );
Kirki::add_field( CONFIG, array(
    'type'        	=> 'toggle',
    'section'		=> 'main_menu',
    'settings'    	=> 'menu_team',
    'label'       	=> __( 'Team', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 3,
));
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'menu_team_text',
    'section'  => 'main_menu',
    'default'  => esc_attr__( 'Team', DOMAIN ),
    'priority' => 4,
    'sanitize_callback' => 'sanitize_text_field'
) );
Kirki::add_field( CONFIG, array(
    'type'        	=> 'toggle',
    'section'		=> 'main_menu',
    'settings'    	=> 'menu_portfolio',
    'label'       	=> __( 'Portfolio', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 5,
));
Kirki::add_field( CONFIG, array(
    'type'     => 'text',
    'settings' => 'menu_portfolio_text',
    'section'  => 'main_menu',
    'default'  => esc_attr__( 'Portfolio', DOMAIN ),
    'priority' => 6,
    'sanitize_callback' => 'sanitize_text_field'
) );
Kirki::add_field( CONFIG, array(
    'type'        	=> 'toggle',
    'section'		=> 'main_menu',
    'settings'    	=> 'menu_contact',
    'label'       	=> __( 'Contact', DOMAIN ),
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
Kirki::add_field( CONFIG, array(
    'type'        	=> 'toggle',
    'section'		=> 'main_menu',
    'settings'    	=> 'show_main_menu',
    'label'       	=> __( 'Show Site Menu', DOMAIN ),
    'default'     	=> '0',
    'priority'    	=> 9,
));
