<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 21/07/2016
 * Time: 18:15
 */

include "typography/Typography_Sets.php";
global $typography_sets;
$typography_sets = new Typography_Sets();

include "typography/agency_front_page.php";
include "typography/site_wide.php";

add_filter( 'scss_vars', 'less_typography', 10, 2 );

// $handle is a reference to the handle used with wp_enqueue_style() - we need it
function less_typography( $vars, $handle ) {
	global $typography_sets;
	$kirki_vars = $typography_sets->get_typography_for_SCSS();
	foreach ($kirki_vars as $key=>$value){
		$vars[$key] = $value;
	}
    return $vars;
}