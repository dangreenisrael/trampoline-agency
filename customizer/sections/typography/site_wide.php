<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 25/07/2016
 * Time: 15:21
 */

$site_wide_pages_typography = array(
	'heading' =>
		array(
			'slug'			=> 'heading',
			'label'		    => 'Section Headings',
			'font-family' 	=> 'Lato',
			'font-size'      => '30pt',
			'line-height'    => '1.5',
			'letter-spacing' => '1px',
			'color'          => '#333333',
			'text-transform' => 'none',
			'text-align'     => 'center',
			'variant'        => 'regular'
		),
	'subheading'=>
		array(
			'slug'			=> 'subheading',
			'label'		    => 'Sub Headings',
			'font-family' 	=> 'Open Sans',
			'font-size'      => '20pt',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#333333',
			'text-transform' => 'none',
			'text-align'     => 'center',
			'variant'        => 'italic'
		),
	'body'=>
		array(
			'slug'			=> 'body',
			'label'		    => 'Body Font',
			'font-family' 	=> 'Lato',
			'font-size'      => '15pt',
			'line-height'    => '1.5',
			'letter-spacing' => 'auto',
			'color'          => '#333333',
			'text-transform' => 'none',
			'text-align'     => 'center',
			'variant'        => 'regular'
		),
	'nav-bar'=>
		array(
			'slug'			=> 'nav-bar',
			'label'		    => 'Nav Bar',
			'font-family' 	=> 'Lato',
			'font-size'      => '16px',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#333333',
			'text-transform' => 'none',
			'text-align'     => 'left',
			'variant'        => 'regular'
		),
	'footer'=>
		array(
			'slug'			=> 'footer',
			'label'		    => 'Footer',
			'font-family'	=> 'Open Sans',
			'font-size'      => '14px',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#333333',
			'text-transform' => 'none',
			'text-align'     => 'left',
			'variant'        => 'regular'
		)
);

global $typography_sets;
$typography_sets->add_typography_set_to_kirki(
	$site_wide_pages_typography,
	"site-wide",
	"Site Wide",
	"These are site-wide typographies (Nav-bar & footer)"
);
