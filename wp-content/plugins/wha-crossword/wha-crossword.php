<?php
/**
 *
 * Plugin Name:       WHA Crossword
 * Description:       The plugin creates an easy crossword from the words of any combination.
 * Version:           1.1.10
 * Author:            WHA
 * Author URI:        http://webhelpagency.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wha-crossword
 * Domain Path:       /languages
 *
 * WHA Crossword is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WHA Crossword is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WHA Crossword. If not, see http://www.gnu.org/licenses/gpl-2.0.txt.
 */


if (!defined('ABSPATH')) {
    exit;
}


// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('WHA_CROSSWORD_VERSION', '1.1.4');


function crossword_activation() {}

register_activation_hook(__FILE__, 'crossword_activation');

function crossword_deactivation() {}

register_deactivation_hook(__FILE__, 'crossword_deactivation');

function wha_crossword_load_plugin_textdomain() {
    load_plugin_textdomain('wha-crossword', FALSE, basename(dirname(__FILE__)) . 'res/languages');
}

add_action('plugins_loaded', 'wha_crossword_load_plugin_textdomain');


// Add scripts & styles
add_action('admin_enqueue_scripts', 'whacw_action_admin');
function whacw_action_admin($hook_suffix) {

    global $post;

    wp_enqueue_style('crossword-style-admin', plugins_url('res/admin/crossword-admin.css', __FILE__));

    wp_enqueue_script('crossword-script-admin', plugins_url('res/admin/crossword-admin.js', __FILE__), false, '1.0', true);

    wp_localize_script('crossword-script-admin', 'crossword_vars_admin', array(
        //'whacw_use_global_options' => get_post_meta($post->ID, 'whacw_use_global_options', true),
        'whacw_use_global_options' => 'no',
        'clue' => __('Clue','wha-crossword'),
        'word' => __('Word','wha-crossword'),
    ));


    wp_enqueue_script('color-piker', plugins_url('res/admin/jscolor.js', __FILE__), false, '1.0', true);

}


// Register scripts and styles
add_action('wp_enqueue_scripts', 'whacw_setup_wdscript');
function whacw_setup_wdscript() {

    global $post;

    wp_enqueue_media();

    wp_enqueue_style('crossword-style', plugins_url('res/crossword.css', __FILE__));
    if (is_rtl()) {
        wp_enqueue_style('crossword-style-rtl', plugins_url('res/rtl-crossword.css', __FILE__));
    }
    wp_enqueue_script('crossword-script', plugins_url('res/crossword.js', __FILE__), array('jquery'), false, '1.0', true);

    /* Adds additional data */
    wp_localize_script('crossword-script', 'crossword_vars', array(
        'whacw_bg_color' => get_option('whacw_option_bg_color'),
        'whacw_border_color' => get_option('whacw_option_border_color'),
        'whacw_txt_color' => get_option('whacw_option_text_color'),
        'whacw_align_question' => get_option('whacw_align_question'),
        'whacw_question_width' => get_option('whacw_question_width'),
        'whacw_ansver' => get_option('whacw_highlight_correct_ansver'),
        'whacw_ansver_incorect' => get_option('whacw_highlight_incorrect_ansver'),
        'whacw_question_txt_color' => get_option('whacw_question_block_text_color'),
        'whacw_counter_color' => get_option('whacw_counter_color'),
    ));

    wp_localize_script('ajax-script', 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

}


// Initialization post type
add_action('init', 'whacw_register_post_type');
function whacw_register_post_type() {

    $labels = array(
        'name' => __('Crossword', 'wha-crossword'),
        'menu_name' => __('Crossword', 'wha-crossword'),
        'singular_name' => __('Crossword', 'wha-crossword'),
        'name_admin_bar' => __('Crossword', 'name admin bar', 'wha-crossword'),
        'all_items' => __('All  Crosswords', 'wha-crossword'),
        'search_items' => __('Search  Crosswords', 'wha-crossword'),
        'add_new' => __('Add New', 'crossword', 'wha-crossword'),
        'add_new_item' => __('Add New Crossword', 'wha-crossword'),
        'new_item' => __('New  Crossword', 'wha-crossword'),
        'view_item' => __('View  Crossword', 'wha-crossword'),
        'edit_item' => __('Edit  Crossword', 'wha-crossword'),
        'not_found' => __('No  Crossword Found.', 'wha-crossword'),
        'not_found_in_trash' => __('Crossword not found in Trash.', 'wha-crossword'),
        'parent_item_colon' => __('Parent Crossword', 'wha-crossword'),
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Holds the crossword and their data.', 'wha-crossword'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-editor-help',
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => array('title', 'thumbnail'),
    );

    register_post_type('wha_crossword', $args);
}


// Create crossword page
add_filter('the_content', 'whacw_create_crossword_page');
function whacw_create_crossword_page($content) {

    global $post;

    if ('wha_crossword' !== $post->post_type) {
        return $content;
    }

    if (!is_single()) {
        return $content;
    }

    $crossword_html = whacw_whagamecrossword_func(array('id' => $post->ID));

    return $crossword_html . $content;
}


// Create shortcode crossword
function whacw_whagamecrossword_func($atts) {

    if (!isset($atts['id'])) {
        return false;
    }
    $id = $atts['id'];

    $html = '';
    $crossword = get_post_meta($id, 'wha_crossword', true);

    $rows = json_decode($crossword, true, 512, JSON_UNESCAPED_UNICODE);
    if ($rows) {
        $html .= '<div class="crossword_wrapper">';
        $html .= '<div class="wha-row wha-crossword-row"><div class="wha-crossword-container">';
        $html .= '<div class="wha-center wha-crossword" id="wha-crossword"></div><br/>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="wha-center wha-crossword-questions">';
        $i = 1;
        foreach ($rows as $row) {
            $html .= '<div class="wha-line">
                      <input class="wha-word" data-counter="' . $i . '" type="hidden" value="' . $row['word'] . '"/>
                      <div class="wha-clue" data-counter="' . $i . '">' . $i . '. ' . $row['clue'] . '</div>
                      </div>';
            $i++;
        }
        $html .= '</div>';
        $html .= '</div><div class="clearfix"></div>';
        $html .= '<style></style>';
        $html .= "<script></script>";
        $html .= "<script>
        /* <![CDATA[ */
        var optional_crossword_vars = {
            'whacw_optional_bg_color':'" . get_post_meta($id, 'whacw_option_bg_color', true) . "',
            'whacw_optional_border_color':'" . get_post_meta($id, 'whacw_option_border_color', true) . "',
            'whacw_optional_text_color':'" . get_post_meta($id, 'whacw_option_text_color', true) . "',
            'whacw_optional_question_color':'" . get_post_meta($id, 'whacw_question_block_text_color', true) . "',
            'whacw_optional_counter_color':'" . get_post_meta($id, 'whacw_counter_color', true) . "',
            'whacw_use_global_options':'" . get_post_meta($id, 'whacw_use_global_options', true) . "',
            'whacw_correct_ansver':'" . get_post_meta($id, 'whacw_highlight_correct_ansver', true) . "',
            'whacw_incorrect_ansver':'" . get_post_meta($id, 'whacw_highlight_incorrect_ansver', true) . "',
            'whacw_align_question':'" . get_post_meta($id, 'whacw_align_question', true) . "',            
            'whacw_question_width':'" . get_post_meta($id, 'whacw_question_width', true) . "'            
        };
        /* ]]> */
        </script>";

        if (get_post_meta($id, 'whacw_use_global_options', true) == "no") {
            $message = !empty(get_post_meta($id, 'whacw_congratulations_individual', true)) ?
                get_post_meta($id, 'whacw_congratulations_individual', true) : __('Congratulations!', 'wha-crossword');
        } else {
            $message = !empty(get_option("whacw_congratulations_message")) ?
                get_option("whacw_congratulations_message") : __('Congratulations!', 'wha-crossword');
        }

        $html .= '<div id="modal_form_crossword">
                    <span id="modal_close">X</span>
                    <div class="content">' . do_shortcode($message) . '</div>
                  </div>
                  <div id="overlay"></div>';
    }
    return $html;
}

add_shortcode('game-crossword', 'whacw_whagamecrossword_func');


// Add Crossword option box
add_action('add_meta_boxes', 'whacw_add_custom_box_shortcode', 10);
function whacw_add_custom_box_shortcode() {
    $screens = array('wha_crossword');
    add_meta_box('myplugin_sectionid_shortcode', __('CROSSWORD SHORTCODE:','wha-crossword'), 'whacw_meta_box_shortcode_callback', $screens, 'advanced', 'high');
}

function whacw_meta_box_shortcode_callback($post, $meta) {
    $screens = $meta['args'];

    wp_nonce_field(plugin_basename(__FILE__), 'myplugin_noncename');
    $crossword = get_post_meta($post->ID, 'wha_crossword', true);
    echo '<div class="shortcode">[game-crossword id="' . $post->ID . '" ]</div>';
}


// Add Crossword option box
add_action('add_meta_boxes', 'whacw_add_custom_box', 20);
function whacw_add_custom_box() {
    $screens = array('wha_crossword');
    add_meta_box('myplugin_sectionid', __('CROSSWORD: CLUE AND WORD','wha-crossword'), 'whacw_meta_box_callback', $screens, 'advanced', 'low');
}

function whacw_meta_box_callback($post, $meta) {

    $screens = $meta['args'];

    wp_nonce_field(plugin_basename(__FILE__), 'myplugin_noncename');
    $crossword = get_post_meta($post->ID, 'wha_crossword', true);

    $items = json_decode($crossword, true, 512, JSON_UNESCAPED_UNICODE);
    echo '<div class="wha-crossword-row-admin">';
    if ($items) {
        foreach ($items as $item) {
            echo '<div class="wha-crossword-item">';
            echo '<div class="wha-crossword-block">';
            echo '<div class="wha-crossword-inner"><label>' . __('Clue', 'wha-crossword') . '</label><input type="text"  name="wha-crossword-clue[]" value="' . $item['clue'] . '" required size="25" /></div>';
            echo '<div class="wha-crossword-inner"><label>' . __('Word', 'wha-crossword') . '</label><input type="text"  name="wha-crossword-word[]" value="' . $item['word'] . '" size="25" required /></div>';
            echo '</div>';
            echo '<a href="#" title="Delete item" class="wha-delete-crossword-item">X</a>';
            echo '</div>';
        }
    }

    echo '<div id="wha-crossword-action-add" class="wha-crossword-action-add"><a href="#" class="wha-add-crossword-item">' . __('Add new item for crossword', 'wha-crossword') . '</a></div>';
    echo '</div>';
}


// Add Crossword option box
add_action('add_meta_boxes', 'whacw_add_option_box', 30);
function whacw_add_option_box() {

    $screens = array('wha_crossword');
    add_meta_box('myplugin_optionid', __('INDIVIDUAL OPTIONS','wha-crossword'), 'whacw_option_box_callback', $screens, 'advanced', 'low');
}

function whacw_option_box_callback($post, $meta) {

    $screens = $meta['args'];

    wp_nonce_field(plugin_basename(__FILE__), 'myplugin_noncename');

    $whacw_color_background = get_post_meta($post->ID, 'whacw_option_bg_color', true);
    $whacw_color_border = get_post_meta($post->ID, 'whacw_option_border_color', true);
    $whacw_color_text = get_post_meta($post->ID, 'whacw_option_text_color', true);
    $whacw_color_question = get_post_meta($post->ID, 'whacw_question_block_text_color', true);
    $whacw_color_counter = get_post_meta($post->ID, 'whacw_counter_color', true);
    $whacw_use_global = get_post_meta($post->ID, 'whacw_use_global_options', true);
    $whacw_correct_ansver = get_post_meta($post->ID, 'whacw_highlight_correct_ansver', true);
    $whacw_incorrect_ansver = get_post_meta($post->ID, 'whacw_highlight_incorrect_ansver', true);
    $whacw_align_question = get_post_meta($post->ID, 'whacw_align_question', true);
    $whacw_question_width = get_post_meta($post->ID, 'whacw_question_width', true);

    $color_array = array(
        array(
            'title' => __("Background color:", 'wha-crossword') ,
            'name' => "whacw_option_bg_color",
            'value' => $whacw_color_background
        ),
        array(
            'title' => __("Border color:",'wha-crossword') ,
            'name' => "whacw_option_border_color",
            'value' => $whacw_color_border
        ),
        array(
            'title' => __("Text color:",'wha-crossword') ,
            'name' => "whacw_option_text_color",
            'value' => $whacw_color_text
        ),
        array(
            'title' => __("Question block color:",'wha-crossword') ,
            'name' => "whacw_question_block_text_color",
            'value' => $whacw_color_question
        ),
        array(
            'title' => __("Counter color:",'wha-crossword') ,
            'name' => "whacw_counter_color",
            'value' => $whacw_color_counter
        )
    );
    $radio_array = array(
        array(
            'title' => __("Highlight the CORRECT answers?",'wha-crossword') ,
            'name' => "whacw_highlight_correct_ansver",
            'value' => $whacw_correct_ansver
        ),
        array(
            'title' => __("Highlight the INCORRECT answers?",'wha-crossword') ,
            'name' => "whacw_highlight_incorrect_ansver",
            'value' => $whacw_incorrect_ansver
        )
    );
    $align_array = array(
        array(
            'title' => __("Align Question block",'wha-crossword') ,
            'name' => "whacw_align_question",
            'value' => $whacw_align_question
        )
    );
    $width_array = array(
        array(
            'title' => __("Question block width (px)",'wha-crossword'),
            'name' => "whacw_question_width",
            'value' => $whacw_question_width
        )
    );


    echo '<div class="wha-crossword-row-admin">';
    echo __('<h3>Use Global Options?</h3>', 'wha-crossword');
    echo '<label class="radio_btn global-options-yes"><input type="radio" value="yes" name="whacw_use_global_options" ' . ($whacw_use_global == "yes" ? "checked" : "") . '>' . __('Yes', 'wha-crossword') . '</label>';
    echo '<label class="radio_btn global-options-no"><input type="radio" value="no" name="whacw_use_global_options" ' . (empty($whacw_use_global) || $whacw_use_global == "no" ? "checked" : "") . '>' . __('No', 'wha-crossword') . '</label>';
    echo '<hr class="adm_divider">';

    echo '<div class="wha-crossword-row-admin_single_options">';

    if ($color_array) {

        foreach ($color_array as $item) {
            echo __('<h2>' . $item["title"] . '</h2>', 'wha-crossword');
            echo '<table>';
            echo '<tr valign="top">';
            if (empty($item["value"]) && $item["name"] != 'whacw_option_bg_color') {
                echo '<td><input class="jscolor" type="text" id="' . $item["name"] . '" name="' . $item["name"] . '" value="000000"/></td>';
            } elseif (!empty($item["value"]) || $item["name"] == 'whacw_option_bg_color') {
                echo '<td><input class="jscolor" type="text" id="' . $item["name"] . '" name="' . $item["name"] . '" value="' . $item["value"] . '"/></td>';
            }
            echo '</tr>';
            echo '</table>';
        }
    }

    /* Hightlight correct/incorect */
    foreach ($radio_array as $radio_arr) {
        echo __('<h2>' . $radio_arr["title"] . '</h2>', 'wha-crossword');
        echo '<table>';
        echo '<tr valign="top">';
        echo '<label class="radio_btn"><input type="radio" id="' . $radio_arr["name"] . '" name="' . $radio_arr["name"] . '" value="yes" ' . (empty($radio_arr["value"]) || $radio_arr["value"] == "yes" ? "checked" : "") . ' />' . __('Yes', 'wha-crossword') . '</label>';
        echo '<label class="radio_btn"><input type="radio" id="' . $radio_arr["name"] . '" name="' . $radio_arr["name"] . '" value="no" ' . ($radio_arr["value"] == "no" ? "checked" : "") . '/>' . __('No', 'wha-crossword') . '</label>';
        echo '</tr>';
        echo '</table>';
    }

    /* Align question*/
    foreach ($align_array as $align_arr) {
        echo __('<h2>' . $align_arr["title"] . '</h2>', 'wha-crossword');
        echo '<table>';
        echo '<tr valign="top">';
        echo '<label class="radio_btn"><input type="radio" id="' . $align_arr["name"] . '" name="' . $align_arr["name"] . '" value="left" ' . ($align_arr["value"] == "left" ? "checked" : "") . '/>' . __('Left', 'wha-crossword') . '</label>';
        echo '<label class="radio_btn"><input type="radio" id="' . $align_arr["name"] . '" name="' . $align_arr["name"] . '" value="right" ' . ($align_arr["value"] == "right" ? "checked" : "") . '/>' . __('Right', 'wha-crossword') . '</label>';
        echo '<label class="radio_btn"><input type="radio" id="' . $align_arr["name"] . '" name="' . $align_arr["name"] . '" value="bottom" ' . (empty($align_arr["value"]) || $align_arr["value"] == "bottom" ? "checked" : "") . '/>' . __('Bottom', 'wha-crossword') . '</label>';
        echo '</tr>';
        echo '</table>';
    }


    foreach ($width_array as $width_arr) {
        echo __('<h2>' . $width_arr["title"] . '</h2>', 'wha-crossword');
        echo '<table>';
        echo '<tr valign="top">';
        echo '<div class="range-slider">';
        echo '<input id="' . $width_arr["name"] . '" name="' . $width_arr["name"] . '" class="range-slider__range" type="range" value="' . ($width_arr['value'] ? $width_arr['value'] : '300') . '" min="1" max="2000" step="1">';
        echo '<span class="range-slider__value">' . $width_arr["value"] . '</span>';
        echo '</div>';
        echo '</tr>';
        echo '</table>';
    }


    echo '</div>';
    echo '</div>';

    echo '<div class="editor_individual_wrap"><h2>' . __('Congratulations text', 'wha-crossword') . '</h2>';
    $message = !empty(get_post_meta($post->ID, 'whacw_congratulations_individual', true)) ?
        get_post_meta($post->ID, 'whacw_congratulations_individual', true) : 'Congratulations individual!';
    /* Individual congratulations text */
    wp_editor($message, 'whacw_congratulations_individual', $settings = array(
        'wpautop' => true,
        'tinymce' => true,
        'textarea_rows' => 20,
        'textarea_name' => 'whacw_congratulations_individual',
    ));
    echo '</div>';
}


/**
 * Save data
 */
if( ! function_exists('whacw_save_postdata' ) ) {

    add_action('save_post', 'whacw_save_postdata', 10, 3);

    function whacw_save_postdata($post_id, $post, $update) {

        if( 'wha_crossword' === get_post_type($post_id) && $update === true && !in_array($post->post_status, ['trash','untrash']) ) {

            if (@!wp_verify_nonce($_POST['myplugin_noncename'], plugin_basename(__FILE__)))
                return;

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;

            if (!current_user_can('edit_post', $post_id))
                return;

            $array = array();
            $questions = $_POST['wha-crossword-clue'];
            $words = $_POST['wha-crossword-word'];

            $whacw_color_background = htmlspecialchars($_POST['whacw_option_bg_color']);
            $whacw_color_border = htmlspecialchars($_POST['whacw_option_border_color']);
            $whacw_color_text = htmlspecialchars($_POST['whacw_option_text_color']);
            $whacw_color_question = htmlspecialchars($_POST['whacw_question_block_text_color']);
            $whacw_color_counter = htmlspecialchars($_POST['whacw_counter_color']);
            $whacw_correct_ansver = htmlspecialchars($_POST['whacw_highlight_correct_ansver']);
            $whacw_incorrect_ansver = htmlspecialchars($_POST['whacw_highlight_incorrect_ansver']);
            $whacw_align_question = htmlspecialchars($_POST['whacw_align_question']);
            $whacw_question_width = htmlspecialchars($_POST['whacw_question_width']);
            $whacw_congratulations_individual = $_POST['whacw_congratulations_individual'];
            $whacw_congratulations = @$_POST['whacw_congratulations_message'];
            $whacw_use_global = htmlspecialchars($_POST['whacw_use_global_options']);

            $symbol = array("\\\"", "&", "!", "@", "#", "$", "^", "*", "\\", "(", ")", "-", "+", "%", "_", "|", "/", "(", ")", "=", ":", "[", "]");

            for ($i = 0; $i < count($questions); $i++) {

                $clue = str_replace($symbol, "", strip_tags($questions[$i]));
                $word = str_replace($symbol, "", strip_tags($words[$i]));

                $arr['clue'] = htmlspecialchars(str_replace(array("\\'"), "'", $clue), ENT_QUOTES);
                $arr['word'] = htmlspecialchars(str_replace(array("\\'"), "'", $word), ENT_QUOTES);
                $array[] = $arr;
            }
            $json = json_encode($array, JSON_UNESCAPED_UNICODE);

            update_post_meta($post_id, 'wha_crossword', $json);
            update_post_meta($post_id, 'whacw_option_bg_color', $whacw_color_background);
            update_post_meta($post_id, 'whacw_option_border_color', $whacw_color_border);
            update_post_meta($post_id, 'whacw_option_text_color', $whacw_color_text);
            update_post_meta($post_id, 'whacw_question_block_text_color', $whacw_color_question);
            update_post_meta($post_id, 'whacw_counter_color', $whacw_color_counter);
            update_post_meta($post_id, 'whacw_highlight_correct_ansver', $whacw_correct_ansver);
            update_post_meta($post_id, 'whacw_highlight_incorrect_ansver', $whacw_incorrect_ansver);
            update_post_meta($post_id, 'whacw_align_question', $whacw_align_question);
            update_post_meta($post_id, 'whacw_question_width', $whacw_question_width);
            update_post_meta($post_id, 'whacw_use_global_options', $whacw_use_global);
            update_post_meta($post_id, 'whacw_congratulations_message', $whacw_congratulations);
            update_post_meta($post_id, 'whacw_congratulations_individual', $whacw_congratulations_individual);

        }

    }

}




// Settings page
function whacw_register_settings() {

    add_option('whacw_option_bg_color', 'crossword backgroundg color');
    add_option('whacw_option_border_color', 'crossword border color');
    add_option('whacw_option_text_color', 'crossword text color');
    add_option('whacw_highlight_correct_ansver', 'crossword_highlight');
    add_option('whacw_highlight_incorrect_ansver', 'crossword_highlight');
    add_option('whacw_align_question', 'crossword_highlight');
    add_option('whacw_question_width', 'crossword_highlight');
    add_option('whacw_question_block_text_color', 'crossword_highlight');
    add_option('whacw_counter_color', 'crossword_highlight');
    add_option('whacw_congratulations_message', 'Congratulations');


    register_setting('whacw_crossword_options_group', 'whacw_option_bg_color', 'crossword_callback');
    register_setting('whacw_crossword_options_group', 'whacw_option_border_color', 'crossword_callback');
    register_setting('whacw_crossword_options_group', 'whacw_option_text_color', 'crossword_callback');
    register_setting('whacw_crossword_options_group', 'whacw_highlight_correct_ansver', 'crossword_callback');
    register_setting('whacw_crossword_options_group', 'whacw_highlight_incorrect_ansver', 'crossword_callback');
    register_setting('whacw_crossword_options_group', 'whacw_align_question', 'crossword_callback');
    register_setting('whacw_crossword_options_group', 'whacw_question_width', 'crossword_callback');
    register_setting('whacw_crossword_options_group', 'whacw_question_block_text_color', 'crossword_callback');
    register_setting('whacw_crossword_options_group', 'whacw_counter_color', 'crossword_callback');
    register_setting('whacw_crossword_options_group', 'whacw_congratulations_message', 'crossword_callback');

}

add_action('admin_init', 'whacw_register_settings');


// Create submenu in admin panel
function whacw_register_options_page() {

    add_submenu_page('edit.php?post_type=wha_crossword',
        __('Crossword Settings', 'wha-crossword'),
        __('Crossword Settings', 'wha-crossword'),
        'manage_options',
        'settings_crossword',
        'whacw_options_page');

}

add_action('admin_menu', 'whacw_register_options_page');

// Global options page
function whacw_options_page()
{

    /* Options array */
    $color_array = array(
        array(
            'title' => __('Background color:', 'wha-crossword'),
            'name' => "whacw_option_bg_color",
            'value' => get_option('whacw_option_bg_color')
        ),
        array(
            'title' => __('Border color:', 'wha-crossword'),
            'name' => 'whacw_option_border_color',
            'value' => get_option('whacw_option_border_color')
        ),
        array(
            'title' => __("Text color:", 'wha-crossword'),
            'name' => "whacw_option_text_color",
            'value' => get_option('whacw_option_text_color')
        ),
        array(
            'title' => __("Question block color:", 'wha-crossword'),
            'name' => "whacw_question_block_text_color",
            'value' => get_option('whacw_question_block_text_color')
        ),
        array(
            'title' => __("Counter color:", 'wha-crossword'),
            'name' => "whacw_counter_color",
            'value' => get_option('whacw_counter_color')
        )
    );
    $radio_array = array(
        array(
            'title' =>  __("Highlight the CORRECT answers?", 'wha-crossword'),
            'name' => "whacw_highlight_correct_ansver",
            'value' => get_option('whacw_highlight_correct_ansver')
        ),
        array(
            'title' =>  __("Highlight the INCORRECT answers?", 'wha-crossword'),
            'name' => "whacw_highlight_incorrect_ansver",
            'value' => get_option('whacw_highlight_incorrect_ansver')
        )
    );
    $align_array = array(
        array(
            'title' => __("Align Question block", 'wha-crossword'),
            'name' => "whacw_align_question",
            'value' => get_option('whacw_align_question')
        )
    );
    $width_array = array(
        array(
            'title' => __("Question block width (px)",'wha-crossword'),
            'name' => "whacw_question_width",
            'value' => get_option('whacw_question_width')
        )
    );

    ?>

    <div class="crossword_options_page">

        <?php if (isset($_GET['settings-updated']) == 'true') : ?>
            <br>
            <div class="notice notice-success is-dismissible">
                <p><?php _e('Settings saved!', 'wha-crossword'); ?></p>
            </div>
        <?php elseif (isset($_GET['settings-updated']) == 'false'): ?>
            <br>
            <div class="notice notice-error is-dismissible">
                <p><?php _e('Sorry. Something happened.', 'wha-crossword'); ?></p>
            </div>
        <?php endif; ?>

        <?php echo __('<h2>Global Crossword Settings</h2>', 'wha-crossword'); ?>

        <form method="post" action="options.php">

            <?php settings_fields('whacw_crossword_options_group'); ?>

            <div class="setting_wrapper">

                <?php
                /* Color items*/
                foreach ($color_array as $col_arr) {
                    echo __('<h2>' . $col_arr["title"] . '</h2>', 'wha-crossword');
                    echo '<table>';
                    echo '<tr valign="top">';

                    switch ($col_arr["value"]) {
                        case 'crossword border color':
                            $value = '000000';
                            break;
                        case 'crossword text color':
                            $value = '000000';
                            break;
                        case 'crossword_highlight':
                            $value = '000000';
                            break;
                        default:
                            $value = $col_arr["value"];
                    }

                    echo '<td><input class="jscolor" type="text" id="' . $col_arr["name"] . '" name="' . $col_arr["name"] . '" value="' . $value . '"/></td>';
                    echo '</tr>';
                    echo '</table>';
                }

                /* Hightlight correct/incorect */
                foreach ($radio_array as $radio_arr) {
                    echo __('<h2>' . $radio_arr["title"] . '</h2>', 'wha-crossword');
                    echo '<table>';
                    echo '<tr valign="top">';
                    echo '<label class="radio_btn"><input type="radio" id="' . $radio_arr["name"] . '" name="' . $radio_arr["name"] . '" value="yes" ' . ($radio_arr["value"] == "yes" || $radio_arr["value"] == 'crossword_highlight' ? "checked" : "") . '/>' . __('Yes', 'wha-crossword') . '</label>';
                    echo '<label class="radio_btn"><input type="radio" id="' . $radio_arr["name"] . '" name="' . $radio_arr["name"] . '" value="no" ' . ($radio_arr["value"] == "no" ? "checked" : "") . '/>' . __('No', 'wha-crossword') . '</label>';
                    echo '</tr>';
                    echo '</table>';
                }

                /* Align question*/
                foreach ($align_array as $align_arr) {
                    echo __('<h2>' . $align_arr["title"] . '</h2>', 'wha-crossword');
                    echo '<table>';
                    echo '<tr valign="top">';
                    echo '<label class="radio_btn"><input type="radio" id="' . $align_arr["name"] . '" name="' . $align_arr["name"] . '" value="left" ' . ($align_arr["value"] == "left" ? "checked" : "") . '/>' . __('Left', 'wha-crossword') . '</label>';
                    echo '<label class="radio_btn"><input type="radio" id="' . $align_arr["name"] . '" name="' . $align_arr["name"] . '" value="right" ' . ($align_arr["value"] == "right" ? "checked" : "") . '/>' . __('Right', 'wha-crossword') . '</label>';
                    echo '<label class="radio_btn"><input type="radio" id="' . $align_arr["name"] . '" name="' . $align_arr["name"] . '" value="bottom" ' . ($align_arr["value"] == "bottom" || $align_arr["value"] == 'crossword_highlight' ? "checked" : "") . '/>' . __('Bottom', 'wha-crossword') . '</label>';
                    echo '</tr>';
                    echo '</table>';
                }

                foreach ($width_array as $width_arr) {
                    echo __('<h2>' . $width_arr["title"] . '</h2>', 'wha-crossword');
                    echo '<table>';
                    echo '<tr valign="top">';
                    echo '<div class="range-slider">';
                    echo '<input id="' . $width_arr["name"] . '" name="' . $width_arr["name"] . '" class="range-slider__range" type="range" value="' . ($width_arr['value'] ? $width_arr['value'] : '300') . '" min="1" max="2000" step="1">';
                    echo '<span class="range-slider__value">' . $width_arr["value"] . '</span>';
                    echo '</div>';
                    echo '</tr>';
                    echo '</table>';
                }

                /* Global congratulations text */
                echo '<h2>' . __('Congratulations text', 'wha-crossword') . '</h2>';
                $whacw_congratulations = !empty(get_option('whacw_congratulations_message')) ? get_option('whacw_congratulations_message') : __('Congratulations global!', 'wha-crossword');
                wp_editor($whacw_congratulations, 'whacw_congratulations_message', $settings = array(
                    'wpautop' => true,
                    'tinymce' => true,
                    'textarea_rows' => 20,
                    'textarea_name' => 'whacw_congratulations_message',
                ));

                ?>
                <?php submit_button(); ?>
        </form>

    </div>

    <?php
}


function whacs_sidebar_meta_box()
{
    add_meta_box(
        'whacs_sidebar',
        __('&nbsp;', 'myplugin_textdomain'),
        'whacs_sidebar_meta_box_callback',
        'wha_crossword',
        'side'
    );
}

add_action('add_meta_boxes', 'whacs_sidebar_meta_box', 2);

// Call Areachart option fields and save
function whacs_sidebar_meta_box_callback($post, $meta) {
    $item = '';
    $item .= '<h1>Plugin Developed by</h1>';
    $item .= '<div class="whacs_logo_wrap"><img src="' . plugins_url("res/admin/images/wha-logo.svg", __FILE__) . '" width="10px" alt="wha_logo"></div>';
    $item .= '<h2><wha>WHA</wha> is team of  top-notch WordPress developers.</h2>';
    $item .= '<h4>Our advantages:</h4>';
    $item .= '
              <ul class="whacs_sidebar_list">
                <li><wha>—</wha> TOP 20 WordPress companies on Clutch;</li>
                <li><wha>—</wha> More than 4 years of experience;</li>
                <li><wha>—</wha> NDA for each project;</li>
                <li><wha>—</wha> Dedicate project manager for each project;</li>
                <li><wha>—</wha> Flexible working hours;</li>
                <li><wha>—</wha> Friendly management;</li>
                <li><wha>—</wha> Clear workflow;</li>
                <li><wha>—</wha> Based in Europe, you can easily reach us via any airlines;</li>
            </ul>';

    $item .= '<h3>Looking for dedicated team?</h3>';

    $item .= '  <a href="https://webhelpagency.com/say-hello/?title=wporg_free_consultation" class="btn btn-reverse btn-arrow"><span>Start a Project<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 36.1 25.8" enable-background="new 0 0 36.1 25.8" xml:space="preserve"><g><line fill="none" stroke="#FFFFFF" stroke-width="3" stroke-miterlimit="10" x1="0" y1="12.9" x2="34" y2="12.9"></line><polyline fill="none" stroke="#FFFFFF" stroke-width="3" stroke-miterlimit="10" points="22.2,1.1 34,12.9 22.2,24.7   "></polyline></g></svg></span></a>';

    echo $item;
}

