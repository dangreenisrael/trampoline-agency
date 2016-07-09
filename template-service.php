<?php
/**
 * Template Name: Service
 */
// Code to display Page goes here...
$context = Timber::get_context();
$page = new TimberPost();
$context['service'] = $page;
$context['white_header'] = "white-header";
wp_enqueue_style( 'global', get_stylesheet_directory_uri() . '/static/less/global.less' );
wp_enqueue_style( 'internal', get_stylesheet_directory_uri() . '/static/less/internal.less' );


Timber::render('service.twig', $context );