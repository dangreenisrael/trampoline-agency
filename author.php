<?php
/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
global $wp_query;

$context = Timber\Timber::get_context();
$context['posts'] = Timber\Timber::get_posts();
wp_enqueue_style( 'global', get_stylesheet_directory_uri() . '/static/less/global.less' );

if ( isset( $wp_query->query_vars['author'] ) ) {
	$author = new Timber\User( $wp_query->query_vars['author'] );
	$context['author'] = $author;
	$context['title'] = 'Author Archives: ' . $author->name();
}
Timber\Timber::render( array( 'author.twig', 'archive.twig' ), $context );
