<?php
/**
 * Template Name: Portfolio
 */
// Code to display Page goes here...
$context = Timber\Timber::get_context();
$page = new Timber\Post();
$context['page'] = $page;
$context['white_header'] = "white-header";
wp_enqueue_style( 'global', get_stylesheet_directory_uri() . '/static/less/global.less' );
wp_enqueue_style( 'internal', get_stylesheet_directory_uri() . '/static/less/internal.less' );

Timber\Timber::render('portfolio.twig', $context );
