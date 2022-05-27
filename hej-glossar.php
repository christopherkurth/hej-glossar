<?php
/**
 * Hej Glossar
 * 
 * @package           hej-glossar
 * @author            Christopher Kurth
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Hej Glossar
 * Plugin URI: https://wordpress.org/plugins/hej-glossar/
 * Description: This Plugin help you to create a simple Glossar on your WordPress site.
 * Version: 22.5.2 beta
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Author: Christopher Kurth
 * Author URI: http://www.hejchris.de
 * License: GPL-2.0-or-later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: hej-glossar
*/

/**
 * Main Hej_Glossar Class
 */
class Hej_Glossar {

	/**
	 * Initialize plugin.
	 */
	public function __construct() {

		$this->includes();

	}

		/**
	 * Load plugin files.
	 */
	public function includes() {

		// Required files for registering the post type, taxonomies. settings and widget.
		require plugin_dir_path( __FILE__ ) . 'includes/register-cpt.php';
		require plugin_dir_path( __FILE__ ) . 'includes/register-settings.php';
		require plugin_dir_path( __FILE__ ) . 'includes/register-shortcode.php';

	}
}

$hej_glossar = new Hej_Glossar();