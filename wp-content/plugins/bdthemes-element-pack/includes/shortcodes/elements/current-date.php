<?php
    
    ep_add_shortcode([
        'id'       => 'current_date',
        'callback' => 'ep_shortcode_current_date',
        'name'     => __('Current Date', 'bdthemes-element-pack'),
        'type'     => 'single',
        'atts'     => [
            'class' => [
                'type'    => 'extra_css_class',
                'name'    => __('Extra CSS class', 'bdthemes-element-pack'),
                'desc'    => __('Additional CSS class name(s) separated by space(s)', 'bdthemes-element-pack'),
                'default' => '',
            ],
        ],
        'desc'     => __('Show Current Date', 'bdthemes-element-pack'),
    ]);
    
    function ep_shortcode_current_date($atts = null) {
        
        $atts = shortcode_atts(array('class' => ''), $atts, 'current-date');
        
        $output = '<span class="epsc-current-date' . Element_Pack_Shortcodes::ep_get_css_class($atts) . '">';
        $output .= date(get_option('date_format'));
        $output .= '</span>';
        
        return $output;
        
    }
