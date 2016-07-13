<?php
/**
 * Template Name: Service
 */
// Code to display Page goes here...
$context = Timber\Timber::get_context();
$page = new Timber\Post();
$context['service'] = $page;
$context['white_header'] = "white-header";
wp_enqueue_style( 'global', get_stylesheet_directory_uri() . '/static/less/global.less' );


Timber\Timber::render('service.twig', $context );