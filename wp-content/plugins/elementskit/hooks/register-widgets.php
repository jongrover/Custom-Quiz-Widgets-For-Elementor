<?php
namespace ElementsKit\Hooks;

defined( 'ABSPATH' ) || exit;


class Register_Widgets{
    use \ElementsKit\Traits\Singleton;

    public function __construct(){
        add_filter( 'elementskit/widgets/list', [$this, 'get_list'] );
    }


    public function get_list($list){


        return array_merge($list, [
            'blog-posts' => [
                'slug'    => 'blog-posts',
                'title'   => 'Blog Posts',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'blog-posts/'
            ],
            'advanced-accordion' => [
                'slug'    => 'advanced-accordion',
                'title'   => 'Advanced Accordion',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'advanced-accordion/'
            ],
            'advanced-tab'       => [
                'slug'    => 'advanced-tab',
                'title'   => 'Advanced Tab',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'advanced-tab/'
            ],
            'hotspot'            => [
                'slug'    => 'hotspot',
                'title'   => 'Hotspot',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'hotspot/'
            ],
            'motion-text'        => [
                'slug'    => 'motion-text',
                'title'   => 'Motion Text',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'motion-text/'
            ],
            'twitter-feed'       => [
                'slug'    => 'twitter-feed',
                'title'   => 'Twitter Feed',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'twitter-feed/'
            ],
    
            'instagram-feed'       => [
                'slug'    => 'instagram-feed',
                'title'   => 'Instagram Feed',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'instagram-feed/'
            ],
            'gallery'              => [
                'slug'    => 'gallery',
                'title'   => 'Gallery',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'gallery/'
            ],
            'chart'                => [
                'slug'    => 'chart',
                'title'   => 'Chart',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'chart/'
            ],
            'woo-category-list'    => [
                'slug'    => 'woo-category-list',
                'title'   => 'Woo Category List',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'woo-category-list/'
            ],
            'woo-mini-cart'        => [
                'slug'    => 'woo-mini-cart',
                'title'   => 'Woo Mini Cart',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'woo-mini-cart/'
            ],
            'woo-product-carousel' => [
                'slug'    => 'woo-product-carousel',
                'title'   => 'Woo Product Carousel',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'woo-product-carousel/'
            ],
            'woo-product-list'     => [
                'slug'    => 'woo-product-list',
                'title'   => 'Woo Product List',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'woo-product-list/'
            ],
            'table'                => [
                'slug'    => 'table',
                'title'   => 'Table',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'table/'
            ],
            'timeline'             => [
                'slug'    => 'timeline',
                'title'   => 'Timeline',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'timeline/'
            ],
            'creative-button'      => [
                'slug'    => 'creative-button',
                'title'   => 'Creative Button',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'creative-button/'
            ],
            'vertical-menu'        => [
                'slug'    => 'vertical-menu',
                'title'   => 'Vertical Menu',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'vertical-menu/'
            ],
            'advanced-toggle'      => [
                'slug'    => 'advanced-toggle',
                'title'   => 'Advanced Toggle',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'advanced-toggle/'
            ],
            'video-gallery'        => [
                'slug'    => 'video-gallery',
                'title'   => 'Video Gallery',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'video-gallery/'
            ],
            'zoom'                 => [
                'slug'    => 'zoom',
                'title'   => 'Zoom',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'zoom/'
            ],
            'behance-feed'         => [
                'slug'    => 'behance-feed',
                'title'   => 'Behance Feed',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'behance-feed/'
            ],
    
            'breadcrumb' => [
                'slug'    => 'breadcrumb',
                'title'   => 'Breadcrumb',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'breadcrumb/'
            ],
    
            'dribble-feed' => [
                'slug'    => 'dribble-feed',
                'title'   => 'Dribble Feed',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'dribble-feed/'
            ],
    
            'facebook-feed' => [
                'slug'    => 'facebook-feed',
                'title'   => 'Facebook feed',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'facebook-feed/'
            ],
    
            'facebook-review' => [
                'slug'    => 'facebook-review',
                'title'   => 'Facebook review',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'facebook-review/'
            ],
    
            'trustpilot' => [
                'slug'    => 'trustpilot',
                'title'   => 'Trustpilot',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'trustpilot/'
            ],
    
            'yelp' => [
                'slug'    => 'yelp',
                'title'   => 'Yelp',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'yelp/'
            ],
            'popup-modal' => [
                'slug'    => 'popup-modal',
                'title'   => 'Popup Modal',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'popup-modal/'
            ],
            'google-map' => [
                'slug'    => 'google-map',
                'title'   => 'Google Map',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'google-map/'
            ],
            'unfold' => [
                'slug'    => 'unfold',
                'title'   => 'Unfold',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'unfold/'
            ],
    
            'pinterest-feed' => [
                'slug'    => 'pinterest-feed',
                'title'   => 'Pinterest Feed',
                'package' => 'pro',
                'path'    => \ElementsKit::widget_dir() . 'pinterest-feed/'
            ],
        ]);
    }
}