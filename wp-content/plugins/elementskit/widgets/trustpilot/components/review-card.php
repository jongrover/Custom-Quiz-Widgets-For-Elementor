<!-- Start Review card -->
<div class="<?php echo $card_classes ?>">

    <!-- Start Thumbnail -->
    <div class="ekit-review-card--thumbnail <?php if($badge) {echo 'ekit-review-card--thumbnail-badge' ;} ?>">
        <div><img class="thumbnail" src="<?php echo $item->reviewer->avatar_url ?>"></div>
    </div>
    <!-- End Thumbnail -->

    <?php if(!empty($item->max) && $ekit_review_card_style == 'default') { ?>
        <p class="ekit-review-card-trustpilot--max-reviewed">
            <?php echo esc_html__('Max ', 'elementskit')?>
            <span>
                <?php echo esc_html__('Reviewed', 'elementskit')?>
            </span>
            <?php echo esc_html__(' Beer52', 'elementskit')?>
            
        </p>
    <?php } ?>
   
    <?php if($ekit_review_card_style != 'default') { ?>
        <h5 class="ekit-review-card--name">
            <?php echo $item->reviewer->name ?>
        </h5>
        <p class="ekit-review-card--date small muted"><?php echo date('d M, Y', strtotime($item->created_at)); ?></p>
    <?php } ?>

    <!-- Start Rating stars -->
    <div class="ekit-review-card-trustpilot--stars <?php echo $this->get_rating_type($item->rating) ?>">
    <?php for($i = 0; $i < 5; $i++){
        $active = '';
        if($i <= $item->rating){ $active .= 'active'; }
        echo "<span class='$active'>
            <i class='icon icon-star-1'></i>
        </span>";
    }?>
    </div>
    <!-- End Rating stars -->

    <?php if(!empty($item->title) && ($ekit_review_card_style == 'style-2' || $ekit_review_card_style == 'style-4')) { ?>
        <h4 class="ekit-review-card-trustpilot--title">
            <?php echo esc_html__('Able through out to get help or to do tracking on next', 'elementskit')?>
        </h4>
    <?php } ?>

    <p class="ekit-review-card--comment">
        <?php echo $format_comment
            ? $this->get_formatted_text($item->text, true)
            : $item->text;
        ?>
    </p>

</div>
<!-- End Review card -->