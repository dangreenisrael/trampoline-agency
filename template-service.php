<?php
/**
 * Template Name: Service
 */
// Code to display Page goes here...
$context = Timber\Timber::get_context();
$page = new Timber\Post();
$context['service'] = $page;
$context['white_header'] = "white-header";

Timber\Timber::render('service.twig', $context );