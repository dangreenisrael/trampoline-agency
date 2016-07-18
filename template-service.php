<?php
/**
 * Template Name: Service
 */
// Code to display Page goes here...
$context = Timber::get_context();
$page = new TimberPost();
$context['service'] = $page;
$context['white_header'] = "white-header";

Timber::render('service.twig', $context );