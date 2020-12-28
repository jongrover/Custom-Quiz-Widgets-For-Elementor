<?php 
namespace ElementsKit_Lite\Libs\Framework;
use ElementsKit_Lite\Libs\Framework\Classes\Utils;

defined( 'ABSPATH' ) || exit;

class Attr{

    use \ElementsKit_Lite\Traits\Singleton;
    
    public $utils;

    public static function get_dir(){
        return \ElementsKit_Lite::lib_dir() . 'framework/';
    }

    public static function get_url(){
        return \ElementsKit_Lite::lib_url() . 'framework/';
    }

    public static function key(){
        return 'elementskit';
    }

    public function __construct() {
        $this->utils = Classes\Utils::instance();
        new Classes\Ajax;

        

        // register admin menus
        add_action('admin_menu', [$this, 'register_settings_menus']);
        add_action('admin_menu', [$this, 'register_support_menu'], 999);

        // register js/ css
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );

        // whitelist styles
        add_filter('mailpoet_conflict_resolver_whitelist_style', [$this, 'whitelisted_styles']);
    }

    public function whitelisted_styles($styles) {
        $styles[] = 'admin-global.css';
        return $styles;
    }

    public function include_files(){

    }

    public function enqueue_scripts(){
        wp_register_style( 'elementskit-admin-global', \ElementsKit_Lite::lib_url() . 'framework/assets/css/admin-global.css', \ElementsKit_Lite::version() );
        wp_enqueue_style( 'elementskit-admin-global' );
    }

    public function register_settings_menus(){
        // add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )

        // dashboard, main menu
        add_menu_page(
            esc_html__( 'ElementsKit Settings', 'elementskit-lite' ),
            esc_html__( 'ElementsKit', 'elementskit-lite' ),
            'manage_options',
            self::key(),
            [$this, 'register_settings_contents__settings'],
            self::get_url() . 'assets/images/ekit_icon.svg',
            '58.6'
        );

        // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' )
        //add_submenu_page( self::key(), 'ElementsKit_Lite Help', 'Help', 'manage_options', self::key().'-help', [$this, 'register_settings_contents__help'], 11);
    }


    public function register_support_menu(){
        add_submenu_page( self::key(), esc_html__( 'Get Support', 'elementskit-lite' ), esc_html__( 'Get Support', 'elementskit-lite' ), 'manage_options', self::key().'-support', [$this, 'register_settings_contents__support'], 11);
    }

    public function register_settings_contents__settings(){
        include self::get_dir() . 'views/settings-init.php';
    }


    public function register_settings_contents__support(){
        echo esc_html__('Please wait..', 'elementskit-lite');
        echo '
            <script>
            window.location.href = "https://help.wpmet.com";
            </script>
        ';
    }
}
