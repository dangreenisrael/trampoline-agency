<?php
/**
 * Template Name: Front Page
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

// Code to display Page goes here...

$context = Timber::get_context();
$page = new TimberPost();

$context['page'] = $page;
$context['isFrontPage'] = true;
$context['team_members'] = get_field('team_members');

$context['heroImage'] = get_field("hero_image")['url'];
if (!$context['heroImage']){
    $context['heroImage'] = get_template_directory_uri()."/assets/img/header-bg.jpg";
}

foreach ($context['portfolio_items'] as $item){
    $featured_image = get_post_thumbnail_id($item->ID);
    $item->featured_image = new TimberImage($featured_image);
}

$cta_type = get_field('cta_links_to');
if ($cta_type == "cta_internal_link"){
    $context['hero_link'] = get_field('cta_internal_link');
    $context['hero_link_target'] = "_self";
}
elseif ($cta_type == "cta_external_link"){
    $context['hero_link'] = get_field('cta_external_link');
    $context['hero_link_target'] = "_blank";
}
else{
    $context['hero_link'] = "#".get_field('cta_home_section_link');
    $context['hero_link_target'] = "_self";
}

function agency_blog_load_front_page(){
    wp_enqueue_script( "front-page", get_template_directory_uri().'/assets/js/front-page.js', 'jQuery', null, true);
    wp_enqueue_style( 'front-page', get_template_directory_uri() . '/assets/scss/frontpage-agency/front-page.scss' );
}
add_action( 'wp_enqueue_scripts', 'agency_blog_load_front_page' );



Timber::render('front.twig', $context );
