<?php
/**
 * Template for Small Footer Layout 1
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */
$section_1 = astra_get_small_footer( 'footer-sml-section-1' );
$section_2 = astra_get_small_footer( 'footer-sml-section-2' );

$main_pages = array(
  "home" => 25706,
  "whylef" => 24981,
  "about" => 25120,
  "quotes" => 31379,
  "vocabulary" => 31343,
  "pastpresent" => 31358,
  "texting" => 31370,
  "quizzes" => 31327,
  "songs" => 31400,
  "karaoke" => 31406,
  "games" => 27094
);

$is_main_page = true;

global $wp_query;
$id = $wp_query->post->ID;

foreach ($main_pages as &$page_id) {
  if ($page_id == $id) {
    $is_main_page = true;
    break;
  } else {
    $is_main_page = false;
  }
}

?>

<?php if ($is_main_page) { ?>
  <div class="ast-small-footer footer-sml-layout-1">
  	<div class="ast-footer-overlay">
  		<div class="ast-container">
  			<div class="ast-small-footer-wrap" >
  				<?php if ( $section_1 ) : ?>
  					<div class="ast-small-footer-section ast-small-footer-section-1" >
  						<?php
  							echo $section_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  						?>
  					</div>
  				<?php endif; ?>

  				<?php if ( $section_2 ) : ?>
  					<div class="ast-small-footer-section ast-small-footer-section-2" >
  						<?php
  							echo $section_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  						?>
  					</div>
  				<?php endif; ?>

  			</div><!-- .ast-row .ast-small-footer-wrap -->
  		</div><!-- .ast-container -->
  	</div><!-- .ast-footer-overlay -->
  </div><!-- .ast-small-footer-->

<?php } else { ?>

<style>
  /* Footer */

  .site-content {
    margin-bottom: 115px;
  }

  footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 2;
  }

  .copyright {
    text-align: right;
  }

  .copyright small {
    width: 100%;
  }
</style>

<div class="ast-small-footer footer-sml-layout-1">
	<div class="ast-footer-overlay">
		<div class="ast-container">
			<div class="ast-small-footer-wrap" >

        <div class="elementor-row">
          <div class="elementor-column elementor-col-50">
            <!-- Rec/Playback Here -->
          </div>
          <div class="elementor-column elementor-col-50 copyright">
            <small>Copyright © 2021 Learn English Fast</small>
          </div>
        </div><!-- .elementor-row -->

			</div><!-- .ast-row .ast-small-footer-wrap -->
		</div><!-- .ast-container -->
	</div><!-- .ast-footer-overlay -->
</div><!-- .ast-small-footer-->

<?php } ?>