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
                ),
            'primary-text-color' =>
                array(
                    'slug'  => 'primary-text-color',
                    'label' => 'Primary Text Colour',
                    'value' => '#000000',
                    'tooltip' => 'The colour used for text heading and regular paragraph text - this is usually near black'
                ),
            'secondary-text-color' =>
                array(
                    'slug'  => 'secondary-text-color',
                    'label' => 'Secondary Text Colour',
                    'value' => '#565656',
                    'tooltip' => 'The colour used for subheadings and other meta info - this is usually dark grey'
                ),
            'whitish-color' =>
                array(
                    'slug'  => 'whitish-color',
                    'label' => 'Inverted Text Colour',
                    'value' => '#ffffff',
                    'tooltip'  => "The color used for 'inverted' text such as the menu bar - this is usually off-white"
                ),
            'hero-color' =>
                array(
                    'slug'  => 'hero-color',
                    'label' => 'Hero Text Colour',
                    'value' => '#ffffff',
                    'tooltip' => ''
                ),
        );
    }

    function get_fonts(){
        return $this->fonts;
    }

    function get_colors(){
        return $this->colors;
    }
}