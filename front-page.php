<?php

// Code to display Page goes here...
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['isFrontPage'] = true;

wp_enqueue_style( 'global', get_stylesheet_directory_uri() . '/static/less/global.less' );
wp_enqueue_style( 'front-page', get_stylesheet_directory_uri() . '/static/less/front-page.less' );

Timber::render('front-page.twig', $context );
