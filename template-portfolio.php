<?php
/**
 * Template Name: Portfolio
 */
// Code to display Page goes here...
$context = Timber::get_context();
$page = new TimberPost();
$context['page'] = $page;
$context['white_header'] = "white-header";



Timber::render('portfolio.twig', $context );
