<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 21/07/2016
 * Time: 18:15
 */

$defaults = new CustomizerDefaults();
foreach ($defaults->get_fonts() as $font){
    Kirki::add_field( CONFIG, array(
        'type'        => 'typography',
        'settings'    => $font['slug'],
        'label'       => esc_attr__( $font['label'], DOMAIN ),
        'section'     => 'typography',
        'default'     => array(
            'font-family'    => $font['font-family'],
            'variant'		 => $font['variant'],
            'subsets'        => array( 'latin-ext' ),
            'font-size'      => $font['font-size'],
            'line-height'    => $font['line-height'],
            'letter-spacing' => $font['letter-spacing'],
            'color'          => $font['color'],
            'text-transform' => $font['text-transform'],
            'text-align'     => $font['text-align']
        ),
        'priority'    => 10
    ) );
}


add_filter( 'scss_vars', 'less_typography', 10, 2 );

// $handle is a reference to the handle used with wp_enqueue_style() - we need it
function less_typography( $vars, $handle ) {
    $defaults = new CustomizerDefaults();
    $default_fonts = $defaults->get_fonts();
    foreach ($default_fonts as $default_font){
        $slug = $default_font['slug'];
        $active_font    = get_theme_mod( $slug, $default_fonts[$slug]);
        // Deal with the Google fonts variations (FML)
        $variants = preg_split('#(?<=\d)(?=[a-z])#i', $active_font['variant']);
        $font_weight = "400";
        $font_style = "normal";
        foreach ($variants as $variant){
            if(is_numeric($variant)){
                $font_weight = $variant;
            } else{
                if (strlen($variant) > 2){
                    $font_style = $variant;
                } else{
                    $font_style = "normal";
                }
            }
        }

        if (!isset($font_weight)) $font_weight = "normal";
        if (!isset($font_style)) $font_style = "normal";
        // Set $vars to go into LESS
        $vars[$slug] = array(
            "font-family" => $active_font['font-family'],
            "font-size" => $active_font['font-size'],
            "font-weight" => $font_weight,
            "font-style" => $font_style,
            "line-height" => $active_font['line-height'],
            "letter-spacing" => $active_font['letter-spacing'],
            "color" => $active_font['color'],
            "text-transform" => $active_font['text-transform'],
            "text-align" => $active_font['text-align']
        );
    }
    return $vars;
}