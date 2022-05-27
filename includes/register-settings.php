<?php
/**
 * Create Permalink Setting.
 *
 * @package     hej-glossar
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Main Hej_Glossar_Permalink_Setting Class
 * @since 1.0.0
**/
class Hej_Glossar_Permalink_Setting {

	/**
	 * Initialize class.
	 */
	public function __construct() {
		$this->init();
		$this->settings_save();
	}

	/**
	 * Call register fields.
	 */
	public function init() {
		add_filter( 'admin_init', array( &$this, 'register_fields' ) );
	}

	/**
	 * Add setting to permalinks page.
	 */
	public function register_fields() {
		register_setting( 'permalink', 'includes_glossar_slug', 'esc_attr' );
		add_settings_field( 'hej_glossar_slug_setting', '<label for="hej_glossar_slug">' . __( 'Glossar-Basis', 'hej-glossar' ) . '</label>', array( &$this, 'fields_html' ), 'permalink', 'optional' );
	}

	/**
	 * HTML for permalink setting.
	 */
	public function fields_html() {
		$value = get_option( 'hej_glossar_slug' );
		wp_nonce_field( 'hej-glossar', 'hej_glossar_slug_nonce' );
		echo '<input type="text" class="regular-text code" id="hej_glossar_slug" name="hej_glossar_slug" placeholder="glossar" value="' . esc_attr( $value ) . '" />';
	}

	/**
	 * Save permalink settings.
	 */
	public function settings_save() {

		if ( ! is_admin() ) {
			return;
		}

		// We need to save the options ourselves; settings api does not trigger save for the permalinks page.
		if ( isset( $_POST['permalink_structure'] ) ||
			 isset( $_POST['category_base'] ) &&
			 isset( $_POST['hej_glossar_slug'] ) &&
			 wp_verify_nonce( wp_unslash( $_POST['hej_glossar_slug_nonce'] ), 'hej-glossar' ) ) { // WPCS: input var ok, sanitization ok.

			$hej_glossar_slug = sanitize_title( wp_unslash( $_POST['hej_glossar_slug'] ) );
			update_option( 'hej_glossar_slug', $hej_glossar_slug );
		}
	}
}

$hej_glossar_permalink_setting = new Hej_Glossar_Permalink_Setting();

add_filter( 'body_class', 'hej_glossar_body_class_for_pages' );
function hej_glossar_body_class_for_pages( $classes ) {

  if ( is_singular( 'page' ) ) {
    global $post;
    $classes[] = 'hej-glossar';
  }

  return $classes;
}

/**
 * Templates hej-glossar
 * @since 1.0.0
**/
add_filter( 'template_include', 'hej_glossar_templates' );
function hej_glossar_templates( $template ) {

    $post_type = 'hej_glossar'; // Change this to the name of your custom post type!

    if ( is_post_type_archive( $post_type ) && file_exists( plugin_dir_path(__DIR__) . "templates/archive-$post_type.php" ) ){
        $template = plugin_dir_path(__DIR__) . "templates/archive-$post_type.php";
    }

    /*if ( is_singular( $post_type ) && file_exists( plugin_dir_path(__DIR__) . "templates/single-$post_type.php" ) ){
        $template = plugin_dir_path(__DIR__) . "templates/single-$post_type.php";
    }*/

    return $template;
}