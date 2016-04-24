<?php

// Code to display Page goes here...
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['isFrontPage'] = true;
Timber::render('front-page.twig', $context );
