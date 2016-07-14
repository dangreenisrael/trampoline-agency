<?php
/**
 * Template Name: Portfolio
 */
// Code to display Page goes here...
$context = Timber\Timber::get_context();
$page = new Timber\Post();
$context['page'] = $page;
$context['white_header'] = "white-header";

Timber\Timber::render('portfolio.twig', $context );
