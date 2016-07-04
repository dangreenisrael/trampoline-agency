<?php
/**
 * Template Name: Front Page
 */
// Code to display Page goes here...
$context = Timber::get_context();
$page = new TimberPost();
$context['page'] = $page;
$context['isFrontPage'] = true;

wp_enqueue_script( "front-page", get_stylesheet_directory_uri().'/static/js/front-page.js', 'jQuery', null, true);
wp_enqueue_style( 'global', get_stylesheet_directory_uri() . '/static/less/global.less' );
wp_enqueue_style( 'front-page', get_stylesheet_directory_uri() . '/static/less/front-page.less' );


Timber::render('front.twig', $context );
