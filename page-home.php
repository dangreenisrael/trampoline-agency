<?php
/*
 * Template Name: Home Page
 * Description: This is for your home page.
 */


// Code to display Page goes here...

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page-home.twig' ), $context );