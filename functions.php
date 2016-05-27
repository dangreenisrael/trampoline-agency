<?php
require_once(__DIR__ . "/acf/fields.php");
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/vendor/wp-less/wp-less.php' );

Timber::$dirname = array('templates', 'views');

class AgencySite extends TimberSite {
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
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
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

		if ($context['option']['cta_section_link'] != "other"){
			$context['option']['hero_link'] = "#".$context['option']['cta_section_link'];
		}
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
		$filters[] = new Twig_SimpleFilter('thumbnail', function($page){
			return get_the_post_thumbnail_url($page);
		});
		$twig->addExtension( new Twig_Extension_StringLoader() );
		foreach ($filters as $filter){
			$twig->addFilter($filter);
		}
		return $twig;
	}
}
new AgencySite();

function agency_load_jquery(){
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'agency_load_jquery' );


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
function my_less_vars( $vars, $handle ) {
	// $handle is a reference to the handle used with wp_enqueue_style()
	$vars['brand-primary' ] = get_field('brand_primary', 'option');
	$vars['brand-accent'] = get_field('accent_color', 'option');
	$vars['brand-contrast'] = get_field('contrast_color', 'option');
	$vars['brand-light-gray'] 	= get_field('light_gray_color', 'option');
	$vars['brand-white'] 	= get_field('whitish_color', 'option');
	$vars['heading-font'] 	= '"'.get_field('heading_font', 'option')['font'].'"';
	$vars['body-font'] 		= '"'.get_field('body_font', 	'option')['font'].'"';
	$vars['serif-font'] 	= '"'.get_field('serif_font', 	'option')['font'].'"';
	$vars['script-font'] 	= '"'.get_field('script_font', 	'option')['font'].'"';

	return $vars;
}