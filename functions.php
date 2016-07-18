<?php

define('DOMAIN', 'agency-blog');


require_once(__DIR__ . "/acf/fields.php");
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/vendor/wp-less/wp-less.php' );
require_once(__DIR__ . '/vendor/kirki/kirki.php' );
require_once(__DIR__ . '/customizer-defaults.php');
require_once(__DIR__ . '/customizer.php');

$timber = new \Timber\Timber();

wp_scripts()->add_data( 'jquery', 'group', 1 );
wp_scripts()->add_data( 'jquery-core', 'group', 1 );
wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
function agency_blog_load_jquery(){
	wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'agency_blog_load_jquery' );

function agency_blog_load_styles(){
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'global', get_stylesheet_directory_uri() . '/assets/less/global.less' );
}
add_action( 'wp_enqueue_scripts', 'agency_blog_load_styles' );

function agency_blog_load_scripts(){
	wp_enqueue_script('bootstrap', get_stylesheet_directory_uri().'/assets/js/bootstrap.min.js', 'jQuery', null, true);
	wp_enqueue_script('jquery_easing', get_stylesheet_directory_uri().'/assets/js/jquery.easing.min.js', 'jQuery', null, true);
	wp_enqueue_script('classie', get_stylesheet_directory_uri().'/assets/js/classie.js', 'jQuery', null, true);
	wp_enqueue_script('animated_header', get_stylesheet_directory_uri().'/assets/js/cbpAnimatedHeader.js', 'jQuery', null, true);
	wp_enqueue_script('agency_scripts', get_stylesheet_directory_uri().'/assets/js/agency.js', 'jQuery', null, true);
}
add_action( 'wp_enqueue_scripts', 'agency_blog_load_scripts' );

add_image_size( 'front_page_feature', 360);

Timber::$dirname = array('templates', 'views');

class AgencySite extends TimberSite {
	function __construct() {
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
		$context['domain'] = DOMAIN;
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		$context['portfolio_items'] = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template-portfolio.php'
		));
		$context['service_items'] = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template-service.php'
		));

		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$filters[] = new Twig_SimpleFilter('bootstrapCol', function ($totalItems) {
			if ($totalItems === 1){
				return "col-md-12";
			} elseif ($totalItems === 2){
				return "col-md-6";
			} else{
				return "col-md-4";
			}
		});
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

		$filters[] = new Twig_SimpleFilter('front_page_featured_image', function($page, $class="", $alt=""){
			$originalImage = get_the_post_thumbnail($page->ID, 'front_page_feature', array(
				'class' => $class,
				'alt' => $alt
			));
			return $originalImage;
		});
		$filters[] = new Twig_SimpleFilter('full_image', function($page, $class="", $alt=""){
			$originalImage = get_the_post_thumbnail($page->ID, 'full', array(
				'class' => $class,
				'alt' => $alt
			));
			return $originalImage;
		});
		$twig->addExtension( new Twig_Extension_StringLoader() );
		foreach ($filters as $filter){
			$twig->addFilter($filter);
		}
		return $twig;
	}
}
new AgencySite();



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

// pass variables into all .less files
add_filter( 'less_vars', 'my_less_vars', 10, 2 );
// $handle is a reference to the handle used with wp_enqueue_style()
function my_less_vars( $vars, $handle ) {
	$defaults = new CustomizerDefaults();
	$fonts = $defaults->get_fonts();
	$colors = $defaults->get_colors();
	foreach ($defaults->get_fonts() as $font){
		$slug = $font['slug'];
		$vars[$slug] = "'".get_theme_mod( $slug, $fonts[$slug])['font-family'] ."'";
	}
	foreach ($defaults->get_colors() as $color){
		$slug = $color['slug'];
		$vars[$slug] 		= get_theme_mod($slug, $colors[$slug]['value']);
	}
	return $vars;
}