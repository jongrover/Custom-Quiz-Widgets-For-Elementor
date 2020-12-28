<?php
/**
 * Template Name: Speaker Template
 * File: speaker-template.php
 **/

/**
 * Create an audio version of your posts, with a selection of more than 235+ voices across more than 40 languages and variants.
 * Exclusively on Envato Market: https://1.envato.market/speaker
 *
 * @encoding        UTF-8
 * @version         3.1.0
 * @copyright       Copyright (C) 2018 - 2020 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Alexander Khmelnitskiy (info@alexander.khmelnitskiy.ua), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 **/

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

use Merkulove\Speaker\Settings;

get_header();

?><div class="mdp-speaker-content-start"></div><?php
if ( have_posts() ) {

    while ( have_posts() ) {

        the_post();

        /** Include title in audio version? */
        $options = Settings::get_instance()->options;
        if ( 'on' === $options['read_title'] ) {
            ?><h1><?php the_title(); ?></h1><break time="1s"></break><?php
        }

        the_content();

    }

}
?><div class="mdp-speaker-content-end"></div><?php

get_footer();
