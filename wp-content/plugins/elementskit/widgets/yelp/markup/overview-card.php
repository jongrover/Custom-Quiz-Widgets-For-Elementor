<?php

$rating   = intval($page_Info['rating']);
$page_url = esc_url('https://yelp.com/') . $page_Info['pgt'] . esc_html__('/reviews', 'elementskit' );

?>

<div class="ekit-review-overview ekit-review-overview-yelp">

    <!-- Start Overview Left -->
    <div>

        <div class="ekit-review-overview--title">
            <img src="<?php echo $handler_url . 'assets/svg/yelp-logo-full.svg' ?>">
            <h4><?php echo esc_html__( 'Rating', 'elementskit' ); ?></h4>
        </div>

        <!-- Start rating -->
        <div class='ekit-review-overview--rating'>
            
            <span class='rating-average'>
                <?php echo $page_Info['rating'] ?>
            </span>

            <!-- Start Rating stars -->
            <div class="ekit-review-overview--stars">
				<?php echo $this->get_stars_rating($rating); ?>
            </div>
            <!-- End Rating stars -->

            <p class='rating-text'>
				<?php echo intval($page_Info['count']) ?>
                <?php echo esc_html__(' reviews', 'elementskit')?>
            </p>

        </div>
        <!-- Start rating -->

    </div>
    <!-- End Overview Left -->

    <!-- Start Action Buttons -->
    <div class="ekit-review-overview--actions">
        <a href='<?php echo $page_url ?>' target='_' class='btn btn-primary btn-pill'>
            <?php echo esc_html__('Write a Review', 'elementskit')?>
        </a>
    </div>
    <!-- End Action Buttons -->

</div>