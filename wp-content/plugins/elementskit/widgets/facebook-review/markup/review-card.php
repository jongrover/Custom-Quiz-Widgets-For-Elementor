<?php 

    $user_thumbnail = !empty($item->reviewer->id)
        ? Elementor\ElementsKit_Widget_Facebook_Review_Handler::get_user_profile_image_url($item->reviewer->id, $pg_tok)
        : $handler_url . esc_html__('assets/images/profile-placeholder.jpg', 'elementskit');

?>

<!-- Start Review card -->
<div class="<?php echo $card_classes ?>"> <?php

	if($ekit_review_card_top_right_logo == 'yes') { ?>
        <!-- Top right logo -->
        <div class="ekit-review-card--top-right-logo">
            <?php
                $migrated = isset( $settings['__fa4_migrated']['controls_section_top_right_logo_icons'] );
                $is_new = empty( $controls_section_top_right_logo_icon );
                if ( $is_new || $migrated ) :
                    \Elementor\Icons_Manager::render_icon( $controls_section_top_right_logo_icons, [ 'aria-hidden' => 'true'] );
                else : ?>
                    <i class="<?php echo $controls_section_top_right_logo_icon; ?>" aria-hidden="true"></i>
                <?php endif;
            ?>
        </div> <?php
	} ?>

    <!-- Start Thumbnail -->
    <div class="ekit-review-card--thumbnail <?php echo($thumbnail_badge ? esc_html__('ekit-review-card--thumbnail-badge', 'elementskit') : '') ?>">
        <div>

            <img class="thumbnail" src="<?php echo $user_thumbnail ?>" />

            <?php if($thumbnail_badge) { ?>
                <div class="badge">
                    <img src="<?php echo $handler_url . esc_html__('assets/svg/fb-logo-f.svg', 'elementskit') ?>">
                </div> <?php
            } ?>
        </div>
    </div>
    <!-- End Thumbnail -->

    <h5 class="ekit-review-card--name">
		<?php echo empty($item->reviewer->name) ? esc_html__('Anonymous', 'elementskit') : $item->reviewer->name; ?>
    </h5>
    <p class='ekit-review-card--date small muted'><?php echo date('d M, Y'); ?></p>

    <!-- Start Rating stars -->
    <div class="ekit-review-card--stars">
        <span class='mr-1'><i class='icon icon-star-1'></i></span>
        <span class='mr-1'><i class='icon <?php echo $star_icon ?>'></i></span>
        <span class='mr-1'><i class='icon <?php echo $star_icon ?>'></i></span>
        <span class='mr-1'><i class='icon <?php echo $star_icon ?>'></i></span>
        <span class='mr-1'><i class='icon <?php echo $star_icon ?>'></i></span>
    </div>
    <!-- End Rating stars -->

    <p class="ekit-review-card--comment">
        <?php 
        
        $txt = empty($item->review_text) ? '' : esc_html__($item->review_text);

        echo $format_comment
            ? $this->get_formatted_text($txt, true)
            : $txt;
        ?>
    </p>

	<?php

    if($ekit_review_card_posted_on == 'yes') { ?>

        <div class="ekit-review-card--posted-on">
            <?php 
                $migrated = isset( $settings['__fa4_migrated']['ekit_fb_review_posted_on_icons'] );
                $is_new = empty( $ekit_fb_review_posted_on_icon );
                if ( $is_new || $migrated ) :
                    \Elementor\Icons_Manager::render_icon( $ekit_fb_review_posted_on_icons, [ 'aria-hidden' => 'true'] );
                else : ?>
                    <i class="<?php echo $ekit_fb_review_posted_on_icon; ?>" aria-hidden="true"></i>
                <?php endif;
            ?>
            <div>
                <p class="small muted"><?php echo esc_html__('Posted on', 'elementskit')?></p>
                <h5 class='text-bold'><?php echo esc_html__('Facebook', 'elementskit')?></h5>
            </div>
        </div> <?php

    } ?>

</div>
<!-- End Review card -->
