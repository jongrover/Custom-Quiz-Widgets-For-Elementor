<?php

namespace ElementsKit\Widgets\Instagram_Feed;

use ElementsKit_Lite\Core\Handler_Api;
use Elementor\ElementsKit_Widget_Instagram_Feed_Handler;

defined('ABSPATH') || exit;

class Instagram_Feed_Api extends Handler_Api
{
    public function config()
    {
        $this->prefix = 'widget/instagram-feed';
    }

    public function post_refresh_feed()
    {

        ElementsKit_Widget_Instagram_Feed_Handler::reset_cache();
        // ElementsKit_Widget_Instagram_Feed_Handler::set_instagram_feed($_POST['content']);
    }
}
