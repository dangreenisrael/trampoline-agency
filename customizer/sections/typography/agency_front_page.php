<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 25/07/2016
 * Time: 15:21
 */

$front_page_typography = array(
	'agency-hero'=>
		array(
			'slug'			=> 'agency-hero',
			'label'		    => 'Main Hero',
			'font-family' 	=> 'Lato',
			'font-size'      => '80px',
			'line-height'    => '1.5em',
			'letter-spacing' => 'auto',
			'color'          => '#ffffff',
			'text-transform' => 'uppercase',
			'text-align'     => 'center',
			'variant'        => 'regular'
		),
	'agency-hero-sub'=>
		array(
			'slug'			=> 'agency-hero-sub',
			'label'		    => 'Above and Below Hero',
			'font-family' 	=> 'Lato',
			'font-size'      => '40px',
			'line-height'    => '1.5em',
			'letter-spacing' => 'auto',
			'color'          => '#ffffff',
			'text-transform' => 'none',
			'text-align'     => 'center',
			'variant'        => 'regular'
		),
	'agency-caption-heading'=>
		array(
			'slug'			=> 'agency-caption-heading',
			'label'		    => 'Caption Headings',
			'font-family'   => 'Lato',
			'font-size'      => '20pt',
			'line-height'    => '1.5',
			'letter-spacing' => 'auto',
			'color'          => '#333333',
			'text-transform' => 'none',
			'text-align'     => 'center',
			'variant'        => 'regular'
		),
	'agency-caption-text'=>
		array(
			'slug'			=> 'agency-caption-text',
			'label'		    => 'Caption Text',
			'font-family' 	=> 'Lato',
			'font-size'      => '15pt',
			'line-height'    => '1.5em',
			'letter-spacing' => '0.5px',
			'color'          => '#333333',
			'text-transform' => 'none',
			'text-align'     => 'center',
			'variant'        => 'regular'
		)
);
global $typography_sets;
$typography_sets->add_typography_set_to_kirki(
	$front_page_typography,
	"front-page",
	"Front Page",
	"Choose the typography for the home page"
);
