<?php
/**
 * Plugin Name: CantoFramework
 * Plugin URI: https://www.cantothemes.com
 * Description: A framework for wordpress theme and plugins
 * Version: 1.0-alpha-2
 * Author: CantoThemes
 * Author URI: https://www.cantothemes.com
 */

if ( ! defined( 'ABSPATH' ) || ! defined( 'CTF_PATH' ) || ! defined( 'CTF_URL' ) ){
	exit;
}

if (! defined( 'CTF_PATH' ) || ! defined( 'CTF_URL' )){
	return;
}

if ( ! class_exists( 'CTF_Init' ) ) :

class CTF_Init {

	/**
	 * @var CTF_Init The one true CTF_Init
	 * @since 1.0
	 */
	private static $instance;

	
	function __construct(){}
	
	/**
	 * Create this class instance if is not created or if already 
	 * created, return this class instance.
	 * 
	 * @since 1.0
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof CTF_Init ) ) {
			self::$instance = new CTF_Init;
			// self::$instance->setup_constants();

			// add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

			self::$instance->includes();
			// self::$instance->register_assets();

			add_action('admin_footer', array(self::$instance,'print_window_js_var'));
			add_action('wp_enqueue_scripts', array(self::$instance,'register_assets'));
			add_action('customize_controls_enqueue_scripts', array(self::$instance,'register_assets'));

		}
		return self::$instance;
	}

	private function includes() {
		require_once CTF_PATH .'core/fields/fields.class.php';
		require_once CTF_PATH .'core/helper_class/ctfhelp.class.php';
		require_once CTF_PATH .'core/helper_class/addon.class.php';
		require_once CTF_PATH .'core/helper_class/sanitize.php';
	}

	public function register_assets()
	{
		wp_register_style( 'ctf-selectize', CTF_URL.'assets/vendor/selectize/css/selectize.css' );
		wp_register_style( 'ctf-font-awesome', CTF_URL.'assets/vendor/font-awesome/css/font-awesome.min.css' );

		wp_register_script('ctf-selectize', CTF_URL.'assets/vendor/selectize/js/standalone/selectize.min.js', array('jquery'));
		wp_register_script('ctf-tinymce', includes_url( 'js/tinymce' ).'/tinymce.min.js', array('jquery'));
		wp_register_script('ctf-tinymce-compat3x', includes_url( 'js/tinymce' ).'/plugins/compat3x/plugin.min.js', array('jquery'));
	}
	


	private function include_customizer_class() {
		require_once CTF_PATH .'core/customizer/ctf_customizer.class.php';
	}

	
	public function print_window_js_var (){

		global $wp_version, $tinymce_version, $concatenate_scripts, $compress_scripts;

		/**
		 * Filter "tiny_mce_version" is deprecated
		 *
		 * The tiny_mce_version filter is not needed since external plugins are loaded directly by TinyMCE.
		 * These plugins can be refreshed by appending query string to the URL passed to "mce_external_plugins" filter.
		 * If the plugin has a popup dialog, a query string can be added to the button action that opens it (in the plugin's code).
		 */
		$version = 'ver=' . $tinymce_version;
		
		$ext_plugins = '';

		$mce_locale = get_locale();
		
		/**
		 * Filter the list of teenyMCE buttons (Text tab).
		 *
		 * @since 2.7.0
		 *
		 * @param array  $buttons   An array of teenyMCE buttons.
		 * @param string $editor_id Unique editor identifier, e.g. 'content'.
		 */
		$ctf_teeny_mce_buttons = apply_filters( 'teeny_mce_buttons', array('bold', 'italic', 'underline', 'blockquote', 'strikethrough', 'bullist', 'numlist', 'alignleft', 'aligncenter', 'alignright', 'undo', 'redo', 'link', 'unlink', 'fullscreen') );
		
		$mce_buttons = array( 'bold', 'italic', 'strikethrough', 'bullist', 'numlist', 'blockquote', 'hr', 'alignleft', 'aligncenter', 'alignright', 'link', 'unlink', 'wp_more', 'spellchecker' );
		
		if ( ! wp_is_mobile() ) {
			$mce_buttons[] = 'fullscreen';
		}

		$mce_buttons[] = 'wp_adv';
		
		
		/**
		 * Filter the first-row list of TinyMCE buttons (Visual tab).
		 *
		 * @since 2.0.0
		 *
		 * @param array  $buttons   First-row list of buttons.
		 * @param string $editor_id Unique editor identifier, e.g. 'content'.
		 */
		$mce_buttons = apply_filters( 'mce_buttons', $mce_buttons );
		
		$mce_buttons_2 = array( 'formatselect', 'underline', 'alignjustify', 'forecolor', 'pastetext', 'removeformat', 'charmap', 'outdent', 'indent', 'undo', 'redo' );

		if ( ! wp_is_mobile() ) {
			$mce_buttons_2[] = 'wp_help';
		}

		/**
		 * Filter the second-row list of TinyMCE buttons (Visual tab).
		 *
		 * @since 2.0.0
		 *
		 * @param array  $buttons   Second-row list of buttons.
		 * @param string $editor_id Unique editor identifier, e.g. 'content'.
		 */
		$mce_buttons_2 = apply_filters( 'mce_buttons_2', $mce_buttons_2 );

		/**
		 * Filter the third-row list of TinyMCE buttons (Visual tab).
		 *
		 * @since 2.0.0
		 *
		 * @param array  $buttons   Third-row list of buttons.
		 * @param string $editor_id Unique editor identifier, e.g. 'content'.
		 */
		$mce_buttons_3 = apply_filters( 'mce_buttons_3', array() );

		/**
		 * Filter the fourth-row list of TinyMCE buttons (Visual tab).
		 *
		 * @since 2.5.0
		 *
		 * @param array  $buttons   Fourth-row list of buttons.
		 * @param string $editor_id Unique editor identifier, e.g. 'content'.
		 */
		$mce_buttons_4 = apply_filters( 'mce_buttons_4', array() );
		
		
		
		
		
		
		
		$ctf_teeny_plugins = apply_filters( 'teeny_mce_plugins', array( 'colorpicker', 'lists', 'fullscreen', 'image', 'wordpress', 'wpeditimage', 'wplink' ) );
		
		
		/**
		 * Filter the list of TinyMCE external plugins.
		 *
		 * The filter takes an associative array of external plugins for
		 * TinyMCE in the form 'plugin_name' => 'url'.
		 *
		 * The url should be absolute, and should include the js filename
		 * to be loaded. For example:
		 * 'myplugin' => 'http://mysite.com/wp-content/plugins/myfolder/mce_plugin.js'.
		 *
		 * If the external plugin adds a button, it should be added with
		 * one of the 'mce_buttons' filters.
		 *
		 * @since 2.5.0
		 *
		 * @param array $external_plugins An array of external TinyMCE plugins.
		 */
		$mce_external_plugins = apply_filters( 'mce_external_plugins', array() );

		$plugins = array(
			'charmap',
			'colorpicker',
			'hr',
			'lists',
			'media',
			'paste',
			'tabfocus',
			'textcolor',
			'fullscreen',
			'wordpress',
			'wpautoresize',
			'wpeditimage',
			'wpemoji',
			'wpgallery',
			'wplink',
			'wpdialogs',
			'wptextpattern',
			'wpview',
			'wpembed',
		);

		$plugins[] = 'image';

		/**
		 * Filter the list of default TinyMCE plugins.
		 *
		 * The filter specifies which of the default plugins included
		 * in WordPress should be added to the TinyMCE instance.
		 *
		 * @since 3.3.0
		 *
		 * @param array $plugins An array of default TinyMCE plugins.
		 */
		$plugins = array_unique( apply_filters( 'tiny_mce_plugins', $plugins ) );

		if ( ( $key = array_search( 'spellchecker', $plugins ) ) !== false ) {
			// Remove 'spellchecker' from the internal plugins if added with 'tiny_mce_plugins' filter to prevent errors.
			// It can be added with 'mce_external_plugins'.
			unset( $plugins[$key] );
		}

		if ( ! empty( $mce_external_plugins ) ) {

			/**
			 * Filter the translations loaded for external TinyMCE 3.x plugins.
			 *
			 * The filter takes an associative array ('plugin_name' => 'path')
			 * where 'path' is the include path to the file.
			 *
			 * The language file should follow the same format as wp_mce_translation(),
			 * and should define a variable ($strings) that holds all translated strings.
			 *
			 * @since 2.5.0
			 *
			 * @param array $translations Translations for external TinyMCE plugins.
			 */
			$mce_external_languages = apply_filters( 'mce_external_languages', array() );

			$loaded_langs = array();
			$strings = '';

			if ( ! empty( $mce_external_languages ) ) {
				foreach ( $mce_external_languages as $name => $path ) {
					if ( @is_file( $path ) && @is_readable( $path ) ) {
						include_once( $path );
						$ext_plugins .= $strings . "\n";
						$loaded_langs[] = $name;
					}
				}
			}

			foreach ( $mce_external_plugins as $name => $url ) {
				if ( in_array( $name, $plugins, true ) ) {
					unset( $mce_external_plugins[ $name ] );
					continue;
				}

				$url = set_url_scheme( $url );
				$mce_external_plugins[ $name ] = $url;
				$plugurl = dirname( $url );
				$strings = '';

				// Try to load langs/[locale].js and langs/[locale]_dlg.js
				if ( ! in_array( $name, $loaded_langs, true ) ) {
					$path = str_replace( content_url(), '', $plugurl );
					$path = WP_CONTENT_DIR . $path . '/langs/';

					if ( function_exists('realpath') )
						$path = trailingslashit( realpath($path) );

					if ( @is_file( $path . $mce_locale . '.js' ) )
						$strings .= @file_get_contents( $path . $mce_locale . '.js' ) . "\n";

					if ( @is_file( $path . $mce_locale . '_dlg.js' ) )
						$strings .= @file_get_contents( $path . $mce_locale . '_dlg.js' ) . "\n";

					if ( 'en' != $mce_locale && empty( $strings ) ) {
						if ( @is_file( $path . 'en.js' ) ) {
							$str1 = @file_get_contents( $path . 'en.js' );
							$strings .= preg_replace( '/([\'"])en\./', '$1' . $mce_locale . '.', $str1, 1 ) . "\n";
						}

						if ( @is_file( $path . 'en_dlg.js' ) ) {
							$str2 = @file_get_contents( $path . 'en_dlg.js' );
							$strings .= preg_replace( '/([\'"])en\./', '$1' . $mce_locale . '.', $str2, 1 ) . "\n";
						}
					}

					if ( ! empty( $strings ) )
						$ext_plugins .= "\n" . $strings . "\n";
				}

				$ext_plugins .= 'tinymce.PluginManager.load("' . $name . '", "' . $url . '");' . "\n";
			}
		}


		// WordPress default stylesheet and dashicons
		$mce_css = array(
			includes_url( "css/dashicons.min.css" ),
			includes_url( 'js/tinymce' ) . '/skins/wordpress/wp-content.css?' . $version
		);

		$editor_styles = get_editor_stylesheets();
		if ( ! empty( $editor_styles ) ) {
			foreach ( $editor_styles as $style ) {
				$mce_css[] = $style;
			}
		}

		/**
		 * Filter the comma-delimited list of stylesheets to load in TinyMCE.
		 *
		 * @since 2.1.0
		 *
		 * @param string $stylesheets Comma-delimited list of stylesheets.
		 */
		$mce_css = trim( apply_filters( 'mce_css', implode( ',', $mce_css ) ), ' ,' );

		
        ?>
        <script type="text/javascript">
            window.ctf_teeny_mce_buttons = "<?php echo implode( ',', $ctf_teeny_mce_buttons ) ?>";
            window.ctf_mce_buttons = "<?php echo implode( ',', $mce_buttons ) ?>";
            window.ctf_mce_buttons_2 = "<?php echo implode( ',', $mce_buttons_2 ) ?>";
            window.ctf_mce_buttons_3 = "<?php echo implode( ',', $mce_buttons_3 ) ?>";
            window.ctf_mce_buttons_4 = "<?php echo implode( ',', $mce_buttons_4 ) ?>";
            window.ctf_plugins = "<?php echo implode( ',', $plugins ) ?>";
            window.ctf_mce_css = "<?php echo $mce_css; ?>";
            window.ctf_mce_external_plugins = <?php echo json_encode($mce_external_plugins); ?>;
    	</script>
        <?php
    }
}


endif; // End if class_exists check


function init_ctf()
{
	return CTF_Init::instance();
}


init_ctf();