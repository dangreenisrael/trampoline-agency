<?php

/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 15/06/2016
 * Time: 14:13
 */
class CustomizerDefaults
{
    protected $fonts;
    protected $colors;

    function __construct(){

        $this->fonts = array(
            'heading-font'=>
                array(
                    'slug'			=> 'heading-font',
                    'label'		    => 'Heading Font',
                    'font-family' 	=> 'Open Sans'
                ),
            'hero-font'=>
                array(
                    'slug'			=> 'hero-font',
                    'label'		    => 'Hero Font',
                    'font-family' 	=> 'Open Sans'
                ),
            'body-font'=>
                array(
                    'slug'			=> 'body-font',
                    'label'		    => 'Body Font',
                    'font-family'	=> 'Open Sans'
                ),
            'serif-font' =>
                array(
                    'slug'			=> 'serif-font',
                    'label'		    => 'Serif Font',
                    'font-family'	=> 'Droid Serif'
                ),
            'script-font'=>
                array(
                    'slug'			=> 'script-font',
                    'label'		    => 'Script Font',
                    'font-family'	=> 'Lobster Two'
                )
        );

        $this->colors = array(
            'brand-primary'=>
                array(
                    'slug'  => 'brand-primary',
                    'label' => 'Brand Primary Colour',
                    'value' => '#2c3e50'
                ),
            'accent-color'=>
                array(
                    'slug'  => 'accent-color',
                    'label' => 'Accent Colour',
                    'value' => '#6dbcdb'
                ),
            'contrast-color'=>
                array(
                    'slug'  => 'contrast-color',
                    'label' => 'Contrast Colour',
                    'value' => '#fc4349'
                ),
            'whitish-color' =>
                array(
                    'slug'  => 'whitish-color',
                    'label' => 'Whitish Colour',
                    'value' => '#ffffff'
                ),
            'background-primary-color' =>
                array(
                    'slug'  => 'background-primary-color',
                    'label' => 'Primary background colour',
                    'value' => '#ffffff'
                ),
            'background-secondary-color' =>
                array(
                    'slug'  => 'background-secondary-color',
                    'label' => 'Secondary background Colour',
                    'value' => '#cecece'
                ),
            'hero-color' =>
                array(
                    'slug'  => 'hero-color',
                    'label' => 'Hero Colour',
                    'value' => '#ffffff'
                ),
            'menu-text-color' =>
                array(
                    'slug'  => 'menu-text-color',
                    'label' => 'Menu Text Colour',
                    'value' => '#ffffff'
                )
        );
    }

    function add_font($slug, $label, $fontFamily){
        $this->fonts[$slug] = array(
            'slug'          => $slug,
            'label'         => $label,
            'font-family'   => $fontFamily
        );
    }

    function get_fonts(){
        return $this->fonts;
    }

    function add_color($slug, $label, $value){
        $this->fonts[$slug] = array(
            'slug'          => $slug,
            'label'         => $label,
            'value'   => $value
        );
    }

    function get_colors(){
        return $this->colors;
    }
}