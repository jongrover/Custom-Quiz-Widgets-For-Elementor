<div class="ekit-review-overview-trustpilot">
   <div class="d-flex justify-content-between">
      <div>
         <h5 class="ekit-review-overview-trustpilot--title">
            <?php echo esc_html__('Reviews from Trustpilot', 'elementskit')?>
         </h5>
         <div class='d-flex'>
            <!-- Start Rating stars -->
            <div class="ekit-review-overview-trustpilot--stars good">
            <?php for($i = 1; $i <= 5; $i++){
               echo "<span class='active'>
                  <i class='icon icon-star-1'></i>
               </span>";
            }?>
            </div>
            <!-- End Rating stars -->
            <p class="ekit-review-overview-trustpilot--rating mb-0">
               <?php echo esc_html__('4.95', 'elementskit')?>
            </p>
         </div>
      </div>
      <div>
         <div class='ekit-review-overview-trustpilot--thumbnails d-flex justify-content-end'>
            <div class='ekit-review-overview-trustpilot--thumbnail'>
               <img src="<?php echo $BASE_URL . 'assets/images/thumbnail1.png' ?>" alt="Thumbnail">
            </div>
            <div class='ekit-review-overview-trustpilot--thumbnail'>
               <img src="<?php echo $BASE_URL . 'assets/images/thumbnail2.png' ?>" alt="Thumbnail">
            </div>
            <div class='ekit-review-overview-trustpilot--thumbnail'>
               <img src="<?php echo $BASE_URL . 'assets/images/thumbnail13.png' ?>" alt="Thumbnail">
            </div>
            <div class='ekit-review-overview-trustpilot--thumbnail'>
               <img src="<?php echo $BASE_URL . 'assets/images/thumbnail14.png' ?>" alt="Thumbnail">
            </div>
         </div>
         <p class="ekit-review-overview-trustpilot--desc mb-0">
            <?php echo esc_html__('Recommended by 3542 people', 'elementskit')?>
         </p>
      </div>
   </div>
   <hr class='ekit-divider'>
   <div class='d-flex justify-content-center'>
      <h6 class="ekit-review-overview-trustpilot--qs">
         <?php echo esc_html__('Would you rate us on Trustpilot?', 'elementskit')?>
      </h6>
      <div class="ekit-review-overview-trustpilot--actions mb-0">
         <a href='#' class='ekit-icon-btn check'><i class='icon icon-check'></i></a>
         <a href='#' class='ekit-icon-btn close'><i class='icon icon-cross'></i></a>
      </div>
   </div>
</div>