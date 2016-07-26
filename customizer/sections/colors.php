<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 21/07/2016
 * Time: 18:15
 */



class DefaultColors
{
	protected $colors;
	function __construct(){
		$this->colors = array(
			'brand-primary'=>
				array(
					'slug'  => 'brand-primary',
					'label' => 'Brand Primary Colour',
					'value' => '#2c3e50',
					'tooltip' => ''
				),
			'contrast-color'=>
				array(
					'slug'  => 'contrast-color',
					'label' => 'Contrast Colour',
					'value' => '#fc4349',
					'tooltip' => ''
				),
			'background-primary-color' =>
				array(
					'slug'  => 'background-primary-color',
					'label' => 'Primary background colour',
					'value' => '#ffffff',
					'tooltip' => 'The is the main background color for your site, it should probably be white'
				),
			'background-secondary-color' =>
				array(
					'slug'  => 'background-secondary-color',
					'label' => 'Secondary background Colour',
					'value' => '#cecece',
					'tooltip' => "The mostly for the home page sections to be 'zebra striped'"
				)
		);
	}

	function get_colors(){
		return $this->colors;
	}
}
$defaults = new DefaultColors();

foreach ($defaults->get_colors() as $color){
    Kirki::add_field( CONFIG, array(
        'type'        => 'color',
        'settings'    => $color['slug'],
        'label'       => __( $color['label'], DOMAIN ),
        'section'     => 'colors',
        'default'     => $color['value'],
        'tooltip'     => $color['tooltip'],
        'priority'    => 10,
        'panel'       => 'trampoline'
    ) );
}


add_filter( 'scss_vars', 'scss_colors', 10, 2 );
// $handle is a reference to the handle used with wp_enqueue_style()
function scss_colors( $vars, $handle ) {
    $defaults = new DefaultColors();
    $colors = $defaults->get_colors();
    foreach ($defaults->get_colors() as $color){
        $slug = $color['slug'];
        $vars[$slug] = get_theme_mod($slug, $colors[$slug]['value']);
    }
    return $vars;
}
