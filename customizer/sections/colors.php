<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 21/07/2016
 * Time: 18:15
 */

$defaults = new CustomizerDefaults();

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
    $defaults = new CustomizerDefaults();
    $colors = $defaults->get_colors();
    foreach ($defaults->get_colors() as $color){
        $slug = $color['slug'];
        $vars[$slug] = get_theme_mod($slug, $colors[$slug]['value']);
    }
    return $vars;
}
