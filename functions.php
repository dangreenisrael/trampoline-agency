<?php
require_once(__DIR__ . "/acf/fields.php");
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/vendor/wp-less/wp-less.php' );
require_once(__DIR__ . '/vendor/kirki/kirki.php' );
require_once(__DIR__ . '/defaults.php');


Timber::$dirname = array('templates', 'views');

define('DOMAIN', 'agency-blog');
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
		if (@get_fields('option')['services']){
			foreach (get_fields('option')['services'] as $service){
				if ($service['page']) $serviceLinks = true;
				break;
			};
		}
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

function agency_blog_load_jquery(){
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'agency_blog_load_jquery' );


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



if ( ! function_exists( 'my_theme_kirki_update_url' ) ) {
function my_theme_kirki_update_url( $config ) {
	$config['url_path'] = get_stylesheet_directory_uri() . '/vendor/kirki/';
	return $config;
}
}
add_filter( 'kirki/config', 'my_theme_kirki_update_url' );


Kirki::add_config( DOMAIN , array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

Kirki::add_section( 'typography', array(
	'title'          => __( 'Site Fonts' ),
	'description'    => __( 'Choose the fonts for this site' ),
	'priority'       => 15,
	'capability'     => 'edit_theme_options',
) );

$defaults = new Defaults();

foreach ($defaults->get_fonts() as $font){
	Kirki::add_field( 'config', array(
		'type'        => 'typography',
		'settings'    => $font['slug'],
		'label'       => esc_attr__( $font['label'], DOMAIN ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => $font['font-family'],
			'variant'		 => 'regular',
			'subsets'        => array( 'latin-ext' )
		),
		'priority'    => 10
	) );
}

foreach ($defaults->get_colors() as $color){
	Kirki::add_field( 'config', array(
		'type'        => 'color',
		'settings'    => $color['slug'],
		'label'       => __( $color['label'], DOMAIN ),
		'section'     => 'colors',
		'default'     => $color['value'],
		'priority'    => 10
	) );
}


// pass variables into all .less files
add_filter( 'less_vars', 'my_less_vars', 10, 2 );
function my_less_vars( $vars, $handle ) {
	$defaults = new Defaults();
	// $handle is a reference to the handle used with wp_enqueue_style()
	$fonts = $defaults->get_fonts();
	$colors = $defaults->get_colors();
	$heading_font 	= get_theme_mod( 'heading-font', $fonts['heading-font'])['font-family'];
	$body_font 		= get_theme_mod( 'body-font', $fonts['body-font'])['font-family'];
	$serif_font 	= get_theme_mod( 'serif-font', $fonts['serif-font'])['font-family'];
	$script_font 	= get_theme_mod( 'script-font', $fonts['script-font'])['font-family'];

	$vars['brand-primary' ] 	= get_theme_mod('brand-primary', $colors['brand-primary']['value']);
	$vars['brand-accent'] 		= get_theme_mod('accent-color', $colors['accent-color']['value']);
	$vars['brand-contrast'] 	= get_theme_mod('contrast-color', $colors['contrast-color']['value']);
	$vars['brand-light-gray'] 	= get_theme_mod('light-gray-color', $colors['light-gray-color']['value']);
	$vars['brand-white'] 		= get_theme_mod('whitish-color', $colors['whitish-color']['value']);
	$vars['heading-font'] 		= "'$heading_font''";
	$vars['body-font'] 			= "'$body_font'";
	$vars['serif-font'] 		= "'$serif_font'";
	$vars['script-font'] 		= "'$script_font'";

	return $vars;
}



/*
 *  Footer Stuff
 */

Kirki::add_section( 'footer', array(
	'title'          => __( 'Footer Menu' ),
	'description'    => __( 'The stuff that goes in the site footer' ),
	'priority'       => 16,
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'config', array(
	'type'        	=> 'repeater',
	'label'       	=> esc_attr__( 'Footer Links', DOMAIN ),
	'section'     	=> 'footer',
	'priority'    	=> 10,
	'settings'    	=> 'footer-links',
	'transport' 	=> "postMessage",
	'row_label'  	=> array (
			'value' => 'Link'
	),
	'default'     => array(
		array(
			'text' => esc_attr__( 'Kirki Site', DOMAIN ),
			'url'  => 'https://kirki.org',
		),
		array(
			'text' => esc_attr__( 'Kirki Repository', DOMAIN ),
			'url'  => 'https://github.com/aristath/kirki',
		),
	),
	'fields' => array(
		'text' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Link Text', 'DOMAIN' ),
			'description' => esc_attr__( 'This will be the label for your link', DOMAIN ),
			'default'     => '',
		),
		'url' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Link URL', 'DOMAIN' ),
			'description' => esc_attr__( 'This will be the link URL', DOMAIN ),
			'default'     => '',
		),
	)
) );

Kirki::add_field( 'facebook', array(
	'type'     => 'text',
	'settings' => 'facebook',
	'label'    => __( 'Facebook Link', DOMAIN ),
	'section'  => 'footer',
	'default'  => esc_attr__( '', DOMAIN ),
	'priority' => 10,
) );

Kirki::add_field( 'twitter', array(
	'type'     => 'text',
	'settings' => 'twitter',
	'label'    => __( 'Twitter Link', DOMAIN ),
	'section'  => 'footer',
	'default'  => esc_attr__( '', DOMAIN ),
	'priority' => 10,
) );

Kirki::add_field( 'linkedin', array(
	'type'     => 'text',
	'settings' => 'linkedin',
	'label'    => __( 'Linkedin Link', DOMAIN ),
	'section'  => 'footer',
	'default'  => esc_attr__( '', DOMAIN ),
	'priority' => 10,
) );