<?php

namespace Elementor;

//use ElementsKit\Libs\Framework\Attr;
use ElementsKit\Libs\Framework\Attr;

class ElementsKit_Widget_Instagram_Feed_Handler extends \ElementsKit_Lite\Core\Handler_Widget
{

    protected static $transient_name = 'ekit_instagram_cached_data';

    public function wp_init()
    {

        (new \ElementsKit\Widgets\Instagram_Feed\Instagram_Feed_Api())->post_refresh_feed();

        include(self::get_dir() . 'classes/settings.php');
    }

    static function get_name()
    {
        return 'elementskit-instagram-feed';
    }

    static function get_title()
    {
        return esc_html__('Instagram Feed', 'elementskit');
    }

    static function get_icon()
    {
        return 'ekit ekit-instagram ekit-widget-icon ';
    }

    static function get_categories()
    {
        return ['elementskit'];
    }

    static function get_dir()
    {
        return \ElementsKit::widget_dir() . 'instagram-feed/';
    }

    static function get_url()
    {
        return \ElementsKit::widget_url() . 'instagram-feed/';
    }


    static function get_data()
    {
        $data = Attr::instance()->utils->get_option('user_data', []);

        $user_id = (isset($data['instragram']) && !empty($data['instragram']['user_id'])) ? $data['instragram']['user_id'] : '';

        $token = (isset($data['instragram']) && !empty($data['instragram']['token'])) ? $data['instragram']['token'] : '';

        $username = (isset($data['instragram']) && !empty($data['instragram']['username'])) ? $data['instragram']['username'] : '';

        return [
            'user_id' => $user_id,
            'token' => $token,
            'username' => $username
        ];
    }

    static function get_instagram_feed()
    {
        $content = json_encode(get_option('ekit_instagram_feed'), true);
        $data = json_decode($content);
        $result = isset($data->graphql->user) ? $data->graphql->user : '';
        return $result;
    }

    static function get_instagram_feed_from_API()
    {
        return self::get_cached_data();
    }

    static function get_cached_data()
    {
        $data = Attr::instance()->utils->get_option('user_data', []);
        $username = (isset($data['instragram']) && !empty($data['instragram']['username'])) ? $data['instragram']['username'] : '';
        if (empty($username)) {
            return null;
        }
        $cache_data = get_transient(self::$transient_name);
        if (false === $cache_data) {
            $feed = self::call_api($username);
            set_transient(self::$transient_name, $feed, 86400); // set expire time to 24 hours
            return $feed;
        }
        return $cache_data;
    }

    static function call_api($username)
    {
        $apiUrl = 'http://token.wpmet.com/api/instagram/index.php?username=' . $username;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        ob_start();
        curl_exec($ch);
        $content = ob_get_clean();
        curl_close($ch);
        return $content;
    }

    static function set_instagram_feed($content)
    {
        update_option('ekit_instagram_feed', $content);
    }

    public static function reset_cache()
    {
        delete_transient(self::$transient_name);
        self::get_cached_data();
    }
}
