<?php
/**
 * Uninstall plugin WHA crossword
 * Trigger Uninstall process only if WP_UNINSTALL_PLUGIN is defined
 */

if (!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;

$postmeta = $wpdb->prefix . 'postmeta';

// Delete data from table wp_postmeta
$wpdb->get_results("DELETE FROM $postmeta WHERE meta_key IN (
                                  'wha_crossword', 
                                  'whacw_option_bg_color', 
                                  'whacw_option_border_color',
                                  'whacw_option_text_color',
                                  'whacw_question_block_text_color',
                                  'whacw_counter_color',
                                  'whacw_highlight_correct_ansver',
                                  'whacw_highlight_incorrect_ansver',
                                  'whacw_align_question',
                                  'whacw_question_width',
                                  'whacw_use_global_options',
                                  'whacw_congratulations_message',
                                  'whacw_congratulations_individual')");

// Delete data from table wp_options
delete_option('whacw_option_bg_color');
delete_option('whacw_option_border_color');
delete_option('whacw_option_text_color');
delete_option('whacw_highlight_correct_ansver');
delete_option('whacw_highlight_incorrect_ansver');
delete_option('whacw_align_question');
delete_option('whacw_question_width');
delete_option('whacw_question_block_text_color');
delete_option('whacw_counter_color');
delete_option('whacw_congratulations_message');

if (is_multisite()) {
    delete_site_option('whacw_option_bg_color');
    delete_site_option('whacw_option_border_color');
    delete_site_option('whacw_option_text_color');
    delete_site_option('whacw_highlight_correct_ansver');
    delete_site_option('whacw_highlight_incorrect_ansver');
    delete_site_option('whacw_align_question');
    delete_option('whacw_question_width');
    delete_site_option('whacw_question_block_text_color');
    delete_site_option('whacw_counter_color');
    delete_site_option('whacw_congratulations_message');
}

// Delete data from table wp_posts
$wpdb->get_results('DELETE FROM ' . $wpdb->prefix . 'posts WHERE post_type IN ("wha_crossword")');
