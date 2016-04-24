<?php
require_once get_template_directory() . '/required-plugin-installer/install-plugins.php';

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Home Page',
		'menu_slug' 	=> 'home-page-options',
		'icon_url' 		=> 'dashicons-admin-home',
		'redirect'		=> true,
		'position'		=> "3.01"
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Hero',
		'menu_title' 	=> 'Hero',
		'parent_slug'	=> 'home-page-options',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Services',
		'menu_title' 	=> 'Services',
		'parent_slug'	=> 'home-page-options',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Portfolio',
		'menu_title' 	=> 'Portfolio',
		'parent_slug'	=> 'home-page-options',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Timeline',
		'menu_title' 	=> 'Timeline',
		'parent_slug'	=> 'home-page-options',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Team',
		'menu_title' 	=> 'Team',
		'parent_slug'	=> 'home-page-options',
	));


	acf_add_options_page(array(
		'page_title' 	=> 'Site Settings',
		'menu_slug' 	=> 'site-general-settings',
		'capability'	=> 'edit_posts',
		'icon_url'		=> 'dashicons-admin-customizer',
		'redirect'		=> false,
		'position'		=> "3.02"
	));


//	function my_register_fields()
//	{
//		include_once(get_template_directory().'/includes/acf-image-crop-add-on/acf-image-crop.php');
//	}
//	add_action('acf/register_fields', 'my_register_fields');

}

/* functions.php */
add_filter( 'timber_context', 'agency_timber_context'  );

function agency_timber_context( $context ) {
	$context['option'] = get_fields('option');
	return $context;
}


if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '
			<div class="error">
				<p>Timber not activated. Make sure you activate the plugin in 
				<a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a>
				</p>
				<p>
					Timber is what lets us use <a href="http://twig.sensiolabs.org"> TWIG</a> (and an MVC design pattern) for WordPress theming.
				</p>
			</div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		return $context;
	}

	function bootstrapCol( $totalItems ) {
		if ($totalItems === 1){
			return "col-md-12";
		} elseif ($totalItems === 2){
			return "col-md-6";
		} else{
			return "col-md-4";
		}
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('bootstrapCol', new Twig_SimpleFilter('bootstrapCol', array($this, 'bootstrapCol')));
		return $twig;
	}

}

new StarterSite();

function agency_load_jquery(){
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'agency_load_jquery' );
