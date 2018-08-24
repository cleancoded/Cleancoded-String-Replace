<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Cleancoded_String_Replace {

    private static $_instance = null;

    public $settings = null;
    public $replacer = null;

    public $_version;
    public $_token;
    public $file;
    public $dir;

    public function __construct( $version, $file ) {

        $this->_version = $version;
        $this->_token = 'cleancoded_strrep';
        $this->file = $file;
        $this->dir = dirname( $this->file );
        
        register_activation_hook( $this->file, array( $this, 'install' ) );

        if( is_admin() ){
            $this->load_plugin_textdomain();
        }

    }

    public function install() {
        update_option( $this->_token . '_version', $this->_version );
        $this->upgrade();
    }

    public function upgrade() {

        $ccd_replace_from = get_option('ccd_from');
        $ccd_replace_to = get_option('ccd_to');

        if( $ccd_replace_from == false || $ccd_replace_to == false ) {
            return;
        }

        $ccd_replace_from = explode('||', $ccd_replace_from);

        if( ! is_array($ccd_replace_from) ){
            $ccd_replace_from = array($ccd_replace_from);
        }

        $value = array(array( $ccd_replace_from, $ccd_replace_to ));

        if( update_option($this->_token . '_settings_replacesets', serialize($value)) ){
            delete_option( 'ccd_from' );
            delete_option( 'ccd_to' );
            delete_option( 'ccd_workonadminpages' );
        }

    }

	/**
	 * Load plugin textdomain
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain () {
	    $domain = 'cleancoded-string-replace';
	    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	    load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
	    load_plugin_textdomain( $domain, false, dirname( plugin_basename( $this->file ) ) . '/lang/' );
	}

    public static function instance( $version, $file ) {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self( $version, $file );
        }
        return self::$_instance;
	}

}
