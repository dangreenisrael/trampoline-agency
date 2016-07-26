<?php

/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 25/07/2016
 * Time: 15:13
 */

class Typography_Sets {

	/**
	 * @var array
	 */
	protected $typography_sets = array();

	/** Get all the typography sets
	 * @return mixed
	 */
	public function get_typography_for_SCSS(){
		$SCSS_vars = array();
		foreach ($this->typography_sets as $default_font_set){
			foreach ($default_font_set as $default_font){
				$slug = $default_font['slug'];
				$active_font    = get_theme_mod( $slug, $default_font_set[$slug]);
				// Deal with the Google fonts variations (FML)
				$variants = preg_split('#(?<=\d)(?=[a-z])#i', $active_font['variant']);
				$font_weight = "normal";
				$font_style = "normal";
				foreach ($variants as $variant){
					if ($variant == "regular"){
						break;
					}
					elseif(is_numeric($variant)){
						$font_weight = $variant;
					} else{
						if (strlen($variant) > 2){
							$font_style = $variant;
						}
					}
				}
				if (!isset($font_weight)) $font_weight = "normal";
				if (!isset($font_style)) $font_style = "normal";
				// Set $vars to go into LESS
				$SCSS_vars[$slug] = array(
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
		}
		return $SCSS_vars;
	}

	/**
	 * @param array $set
	 * @param string $set_slug
	 * @param string $set_name
	 * @param string $set_description
	 */
	public function add_typography_set_to_kirki($set, $set_slug, $set_name, $set_description){
		$this->typography_sets[$set_slug] = $set;
		Kirki::add_section( $set_slug, array(
			'title'          => __( "Typography ($set_name)", DOMAIN ),
			'description'    => __( $set_description, DOMAIN ),
			'priority'       => 5,
			'capability'     => 'edit_theme_options',
			'panel'          => 'trampoline'
		) );
		foreach ($set as $font){
			Kirki::add_field( CONFIG, array(
				'type'        => 'typography',
				'settings'    => $font['slug'],
				'label'       => esc_attr__( $font['label'], DOMAIN ),
				'section'     => $set_slug,
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
	}
}