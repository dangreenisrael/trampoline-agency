<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2 for parent theme Start Bootstrap - Agency - Timber for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/required-plugin-installer/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'startbootstrap_agency_timber_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function startbootstrap_agency_timber_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(


		// This adds Timber from the WordPress repository.
		array(
			'name'      		=> 'Timber',
			'slug'      		=> 'timber-library',
			'required'  		=> true,
			'force_activation' 	=> true
		)

//		// This adds Advanced Custom Fields from the WordPress repository.
//		array(
//			'name'      		=> 'Advanced Custom Fields',
//			'slug'      		=> 'advanced-custom-fields',
//			'required'  		=> true,
//			'force_activation' 	=> true
//		)

//		// This is an example of the use of 'is_callable' functionality. A user could - for instance -
//		// have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
//		// 'wordpress-seo-premium'.
//		// By setting 'is_callable' to either a function from that plugin or a class method
//		// `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
//		// recognize the plugin as being installed.
//		array(
//			'name'        => 'WordPress SEO by Yoast',
//			'slug'        => 'wordpress-seo',
//			'is_callable' => 'wpseo_init',
//		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'startbootstrap-agency-timber',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'startbootstrap-agency-timber' ),
			'menu_title'                      => __( 'Install Plugins', 'startbootstrap-agency-timber' ),
			'installing'                      => __( 'Installing Plugin: %s', 'startbootstrap-agency-timber' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'startbootstrap-agency-timber' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'startbootstrap-agency-timber'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'startbootstrap-agency-timber'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'startbootstrap-agency-timber'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'startbootstrap-agency-timber'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'startbootstrap-agency-timber'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'startbootstrap-agency-timber'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'startbootstrap-agency-timber'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'startbootstrap-agency-timber'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'startbootstrap-agency-timber'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'startbootstrap-agency-timber'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'startbootstrap-agency-timber'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'startbootstrap-agency-timber'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'startbootstrap-agency-timber' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'startbootstrap-agency-timber' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'startbootstrap-agency-timber' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'startbootstrap-agency-timber' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'startbootstrap-agency-timber' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'startbootstrap-agency-timber' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'startbootstrap-agency-timber' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
	);
	tgmpa( $plugins, $config );
}
