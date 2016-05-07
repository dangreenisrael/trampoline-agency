<?php
require_once get_template_directory() . '/required-plugin-installer/install-plugins.php';



/* functions.php */
add_filter( 'timber_context', 'agency_timber_context'  );

function agency_timber_context( $context ) {
	$portfolio_items = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'template-portfolio.php'
	));

	$serviceLinks = false;
	foreach (get_fields('option')['services'] as $service){
		if ($service['page']) $serviceLinks = true;
		break;
	};
	
	$context['option'] = get_fields('option');
	$context['option']['service_links'] = $serviceLinks;
	$context['portfolio_items'] = $portfolio_items;
	return $context;
}


add_filter('get_twig', 'add_to_twig');

function add_to_twig($twig) {
	$filters[] = new Twig_SimpleFilter('noCrawlOpen', function ($bool) {
		if ($bool)return "\n<!--googleoff: all-->\n";
		return false;
	});

	$filters[] = new Twig_SimpleFilter('noCrawlClose', function ($bool) {
		if ($bool)return "\n<!--googleon: all-->\n";
		return false;
	});

	$filters[] = new Twig_SimpleFilter('permalink', function($page){
		return get_permalink($page);
	});

	$filters[] = new Twig_SimpleFilter('thumbnail', function($page){
		return get_the_post_thumbnail_url($page);
	});

	foreach ($filters as $filter){
		$twig->addFilter($filter);
	}

	return $twig;
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

/*
 *
 * Advanced Custom Fields
 *
 * */

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
	$path = get_stylesheet_directory() . '/acf/advanced-custom-fields-pro/';
	return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {
	$dir = get_stylesheet_directory_uri() . '/acf/advanced-custom-fields-pro/';
	return $dir;
}

// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once( get_stylesheet_directory() . '/acf/advanced-custom-fields-pro/acf.php' );
include_once(get_stylesheet_directory().'/acf/advanced-custom-fields-font-awesome-customized/acf-font-awesome.php');
include_once(get_stylesheet_directory() . '/acf/acf-image-crop-add-on-customized/acf-image-crop.php');

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
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Contact',
		'menu_title' 	=> 'Contact',
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
}

/* Add the column for our custom page templates */
function page_template_column_css() {
	echo '<style type="text/css">
		td.column-template { width: 150px; text-transform: capitalize;}
		th.column-template { width: 150px;}
		</style>';
}
function pages_template_columns( $columns ) {
	$myCustomColumns = array(
		'template' =>  __( 'Template')
	);
	$columns = array_merge( $columns, $myCustomColumns );
	return $columns;
}
function page_template_column_content( $column_name, $post_id ) {
	if ( $column_name == 'template' ) {
		$page_template = get_field( '_wp_page_template' );
		if ( $page_template) {
			$page_template = str_replace ( "default" , " " , $page_template );
			$page_template = str_replace ( "template-" , "" , $page_template );
			$page_template = str_replace ( ".php" , "" , $page_template );
			echo $page_template;
		}
	}
}
add_action('admin_head', 'page_template_column_css');
add_filter( 'manage_pages_columns', 'pages_template_columns' );
add_action( 'manage_pages_custom_column', 'page_template_column_content', 10, 2 );