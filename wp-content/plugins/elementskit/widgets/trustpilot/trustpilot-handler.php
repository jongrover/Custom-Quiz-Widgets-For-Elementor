<?php
namespace Elementor;

use ElementsKit_Lite\Core\Handler_Widget;
use ElementsKit_Lite\Libs\Framework\Attr;

class ElementsKit_Widget_Trustpilot_Handler extends Handler_Widget {

    static function get_name()
    {
        return 'elementskit-trustpilot';
    }

    static function get_title()
    {
        return esc_html__('Trustpilot','elementskit');
    }

    static function get_icon()
    {
        return 'ekit-widget-icon eicon-favorite' ;
    }

    static function get_categories()
    {
        return [ 'elementskit' ];
    }

    static function get_dir(){
        return \ElementsKit::widget_dir() . 'trustpilot/';
    }

    static function get_url()
    {
        return \ElementsKit::widget_url() . 'trustpilot/';
    }

    static function get_data() {

        $transient_name = 'ekit_trustpilot_feeds';
        $transient_value = get_transient($transient_name);

        $user_data = Attr::instance()->utils->get_option('user_data', []);
        $page = (!isset($user_data['trustpilot']['page'])) ? '' : ($user_data['trustpilot']['page']);
        $api = 'https://token.wpmet.com/providers/trustpilot.php?page=' . $page;
        $request = wp_remote_get($api);

        if (is_wp_error($request)) {
            return false;
        }

        $body = wp_remote_retrieve_body($request);
        $result = json_decode($body);
        $expiration_time = 86400;//in second
        set_transient($transient_name, $result, $expiration_time);

        return $result;
    }
}