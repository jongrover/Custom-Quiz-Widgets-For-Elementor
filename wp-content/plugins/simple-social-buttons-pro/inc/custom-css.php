<?php global $_ssb_pr; ?>
<style media="screen">
  /*=============================================
  =            Code for Icons inline            =
  =============================================*/
	<?php if ( 'sm-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['inline'] ) && '1' == $_ssb_pr->inline_option['use_custom_color'] ) : ?>
	  /*----------  Style 1  ----------*/
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button:not(:hover){
		border-color: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
		background: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button:hover{
		border-color: <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>;
		background: <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-linkedin-share:not(:hover),
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-msng-share:not(:hover),
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-email-share:not(:hover),
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-tumblr-share:not(:hover){
		color: <?php echo $_ssb_pr->inline_option['icon_color']; ?> ;
	  }

	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-fb-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-twt-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-viber-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-linkedin-share:hover,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-msng-share:hover,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-email-share:hover,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-print-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-sm-round button.simplesocial-tumblr-share:hover{
		color: <?php echo $_ssb_pr->inline_option['hover_icon_color']; ?>  !important;
	  }
	  .simplesocialbuttons.simplesocial-sm-round.simplesocialbuttons_inline .ssb_counter{
		background: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
		color: <?php echo $_ssb_pr->inline_option['background_color']; ?> ;
	  }

	<?php endif; ?>

	<?php if ( 'simple-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['inline'] ) && '1' == $_ssb_pr->inline_option['use_custom_color'] ) : ?>
	  /*----------  Style 2  ----------*/
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button:not(:hover){
		color: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button:hover{
		color: <?php echo $_ssb_pr->inline_option['hover_icon_color']; ?>;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover){
		background:  <?php echo $_ssb_pr->inline_option['background_color']; ?>; /*#db4437*/
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-fb-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-twt-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-viber-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-msng-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-email-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-print-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-tumblr-share:hover{
		background:  <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>; /*#db4437*/
	  }
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):before ,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):before ,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):before{
			background:  <?php echo $_ssb_pr->inline_option['background_color']; ?>; /*#db4437*/
	}
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-fb-share:hover:after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-fb-share:hover:before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-twt-share:hover:after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-twt-share:hover:before ,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-viber-share:hover:after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-viber-share:hover:before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-reddit-share:hover:after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-reddit-share:hover:before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-linkedin-share:hover:after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-linkedin-share:hover:before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-pinterest-share:hover:after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-pinterest-share:hover:before,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-msng-share:hover:after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-msng-share:hover:before ,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-tumblr-share:hover:after,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-tumblr-share:hover:before{
			background:  <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>; /*#db4437*/
	}


	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-simple-round button.simplesocial-tumblr-share .ssb_counter{
		color: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
		background:  <?php echo $_ssb_pr->inline_option['icon_color']; ?>; /*#db4437*/;
	  }
	<?php endif; ?>

	<?php if ( 'round-txt' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['inline'] ) && '1' == $_ssb_pr->inline_option['use_custom_color'] ) : ?>
	  /*----------  Style 3  ----------*/
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-tumblr-share:not(:hover){
		background: <?php echo $_ssb_pr->inline_option['background_color']; ?>; /*#db4437*/
		border-color: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
		color: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-fb-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-twt-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-viber-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-msng-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-email-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-print-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-txt button.simplesocial-tumblr-share:hover{
		background: <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>; /*#333*/
		border-color: <?php echo $_ssb_pr->inline_option['hover_icon_color']; ?>;
		color: <?php echo $_ssb_pr->inline_option['hover_icon_color']; ?>;
	  }

	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
		color: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
	  }
	<?php endif; ?>


	<?php if ( 'round-btm-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['inline'] ) && '1' == $_ssb_pr->inline_option['use_custom_color'] ) : ?>
	  /*----------  Style 4  ----------*/
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-tumblr-share:not(:hover) {
		  box-shadow: inset 0px 0px 0px 0px <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		  background: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
		  color: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-fb-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-twt-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-viber-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-msng-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-email-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-print-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-tumblr-share:hover {
		  box-shadow: inset 0px -40px 0px 0px <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		  background: <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>;
		  color: <?php echo $_ssb_pr->inline_option['hover_icon_color']; ?> ;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter {
		  background: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
		  color: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-gplus-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-msng-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-email-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-print-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter:after,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter:after {
		  border-right-color: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
	  }
	<?php endif; ?>

	<?php if ( 'flat-button-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['inline'] ) && '1' == $_ssb_pr->inline_option['use_custom_color'] ) : ?>
	  /*----------  Style 5  ----------*/
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-tumblr-share:not(:hover){
		  background: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
		  box-shadow: inset 0px 0px 0px 0px <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>, 0px 3px 0px 0px <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>;
		  color: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-fb-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-twt-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-viber-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-msng-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-email-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-print-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-flat-button-border button.simplesocial-tumblr-share:hover{
		  background: <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>;
		  box-shadow: inset 0px -40px 0px 0px  <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>, 0px 3px 0px 0px  <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>;
		  color: <?php echo $_ssb_pr->inline_option['hover_icon_color']; ?>;
	  }

	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share .ssb_counter{
		  background: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
		  color: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
	  }
	<?php endif; ?>

	<?php

	if ( 'round-icon' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['inline'] ) && '1' == $_ssb_pr->inline_option['use_custom_color'] ) :
		?>
	  /*----------  Style 6  ----------*/
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-tumblr-share:not(:hover){
		  color: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
		  border-color: <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>;
		  background: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
	  }
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-fb-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-twt-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-viber-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-reddit-share:hover,
		.simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-msng-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-email-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-print-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons.simplesocialbuttons_inline.simplesocial-round-icon button.simplesocial-tumblr-share:hover{
		  color: <?php echo $_ssb_pr->inline_option['hover_icon_color']; ?>;
		  background: <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>;
		  border-color: <?php echo $_ssb_pr->inline_option['hover_background_color']; ?>;
	  }
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons_inline.simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $_ssb_pr->inline_option['icon_color']; ?>;
		color: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
		border-color: <?php echo $_ssb_pr->inline_option['background_color']; ?>;
	  }
	<?php endif; ?>



  /*=====  End of Code for Icons inline  ======*/
  /*=============================================
  =            Code for Icons Sidebar            =
  =============================================*/
	<?php
	if ( 'sm-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['sidebar'] ) && '1' == $_ssb_pr->sidebar_option['use_custom_color'] ) :
		?>
	  /*----------  Style 1  ----------*/
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button:not(:hover){
		border-color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
		background: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button:hover{
		border-color: <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>;
		background: <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-fb-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-twt-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-gplus-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-whatsapp-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-viber-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-reddit-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-linkedin-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-msng-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-email-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-print-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-pinterest-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-tumblr-share:not(:hover){
		color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-fb-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-twt-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-gplus-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-whatsapp-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-viber-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-reddit-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-linkedin-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-msng-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-email-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-print-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-pinterest-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-tumblr-share:hover{
		color: <?php echo $_ssb_pr->sidebar_option['hover_icon_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-fb-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-twt-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-gplus-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-whatsapp-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-viber-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-reddit-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-linkedin-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-email-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-print-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-pinterest-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-sm-round button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
		color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
		border-color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
	  }
	<?php endif; ?>

	<?php if ( 'simple-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['sidebar'] ) && '1' == $_ssb_pr->sidebar_option['use_custom_color'] ) : ?>
	  /*----------  Style 2  ----------*/
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button:not(:hover){
		color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button:hover{
		color: <?php echo $_ssb_pr->sidebar_option['hover_icon_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover){
		background: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover{
		background: <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share .ssb_counter{
		color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
		background: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
		border-color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
	  }


		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):before ,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):before ,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):before{
			background:  <?php echo $_ssb_pr->sidebar_option['background_color']; ?>; /*#db4437*/
	}
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover:before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover:before ,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover:before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover:before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover:before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover:before,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover:before ,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover:before{
			background:  <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>; /*#db4437*/
	}

	<?php endif; ?>


	<?php if ( 'round-txt' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['sidebar'] ) && '1' == $_ssb_pr->sidebar_option['use_custom_color'] ) : ?>
	  /*----------  Style 3  ----------*/
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share:not(:hover){
		background:  <?php echo $_ssb_pr->sidebar_option['background_color']; ?>; /*#db4437*/
		border-color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
		color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share:hover{
		background: <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>; /*#333*/
		border-color: <?php echo $_ssb_pr->sidebar_option['hover_icon_color']; ?>;
		color: <?php echo $_ssb_pr->sidebar_option['hover_icon_color']; ?> ;
	  }


	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
		color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
		border-color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
	  }
	<?php endif; ?>


	<?php if ( 'round-btm-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['sidebar'] ) && '1' == $_ssb_pr->sidebar_option['use_custom_color'] ) : ?>
	  /*----------  Style 4  ----------*/
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share:not(:hover) {
		  box-shadow: inset 0px 0px 0px 0px <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		  color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
			background: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share:hover {
		  box-shadow: inset 0px -40px 0px 0px <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		  color: <?php echo $_ssb_pr->sidebar_option['hover_icon_color']; ?> ;
	  }

	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter {
		  background: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
		  color:  <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
			border-color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
	  }
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter:after,
		div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter:after{
			border-right-color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
		}

	<?php endif; ?>

	<?php if ( 'flat-button-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['sidebar'] ) && '1' == $_ssb_pr->sidebar_option['use_custom_color'] ) : ?>
	  /*----------  Style 5  ----------*/
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button{
		  margin: <?php echo $_ssb_pr->sidebar_option['icon_space'] == '1' && $_ssb_pr->sidebar_option['icon_space_value'] != '' ? $_ssb_pr->sidebar_option['icon_space_value'] . 'px 0' : ''; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share:not(:hover){
		  background: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
		  box-shadow: inset 0px 0px 0px 0px <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>, 0px 3px 0px 0px <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>;
		  color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share:hover{
		  background: <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>;
		  box-shadow: inset 0px -40px 0px 0px <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>, 0px 3px 0px 0px <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>;
		  color: <?php echo $_ssb_pr->sidebar_option['hover_icon_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share .ssb_counter{
		  background: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
		  color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
			border-color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
	  }

	<?php endif; ?>

	<?php if ( 'round-icon' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['sidebar'] ) && '1' == $_ssb_pr->sidebar_option['use_custom_color'] ) : ?>
	  /*----------  Style 6  ----------*/
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share:not(:hover),
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share:not(:hover){
		color: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
		border-color: <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>;
		background: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share:hover,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share:hover{
		  color: <?php echo $_ssb_pr->sidebar_option['hover_icon_color']; ?>;
		  background: <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>;
		  border-color: <?php echo $_ssb_pr->sidebar_option['hover_background_color']; ?>;
	  }
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share .ssb_counter,
	  div[class*="simplesocialbuttons-float"].simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $_ssb_pr->sidebar_option['icon_color']; ?>;
		color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
		border-color: <?php echo $_ssb_pr->sidebar_option['background_color']; ?>;
	  }
	<?php endif; ?>




  /*=====  End of Code for Icons Sidebar  ======*/
  /*=============================================
  =            Code for Icons flyin            =
  =============================================*/

	<?php if ( 'sm-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['flyin'] ) && '1' == $this->flyin_option['use_custom_color'] ) : ?>
	  /*----------  Style 1  ----------*/
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button{
		margin: <?php echo $this->flyin_option['icon_space'] == '1' && $this->flyin_option['icon_space_value'] != '' ? $this->flyin_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button:not(:hover){
		border-color: <?php echo $this->flyin_option['background_color']; ?>;
		background: <?php echo $this->flyin_option['background_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button:hover{
		background: <?php echo $this->flyin_option['hover_background_color']; ?>;
		border-color: <?php echo $this->flyin_option['hover_background_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-tumblr-share:not(:hover){
		color: <?php echo $this->flyin_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-email-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-print-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round button.simplesocial-tumblr-share:hover{
		color: <?php echo $this->flyin_option['hover_icon_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-sm-round .ssb_counter{
		background: <?php echo $this->flyin_option['icon_color']; ?>;
		color: <?php echo $this->flyin_option['background_color']; ?>;
	  }
	<?php endif; ?>

	<?php if ( 'simple-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['flyin'] ) && '1' == $this->flyin_option['use_custom_color'] ) : ?>
	  /*----------  Style 2  ----------*/
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button{
		margin: <?php echo $this->flyin_option['icon_space'] == '1' && $this->flyin_option['icon_space_value'] != '' ? $this->flyin_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button:not(:hover){
		color: <?php echo $this->flyin_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button:hover{
		color: <?php echo $this->flyin_option['hover_icon_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover){
		background: <?php echo $this->flyin_option['background_color']; ?>; /*#db4437*/
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover{
		background: <?php echo $this->flyin_option['hover_background_color']; ?>; /*#db4437*/
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share .ssb_counter{
		color: <?php echo $this->flyin_option['background_color']; ?>;
		background: <?php echo $this->flyin_option['icon_color']; ?>;
	  }

		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):before ,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):before ,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):before{
			background:  <?php echo $this->flyin_option['background_color']; ?>; /*#db4437*/
	}
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover:after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover:before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover:after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover:before ,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover:after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover:before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover:after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover:before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover:after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover:before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover:after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover:before,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover:after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover:before ,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover:after,
		.simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover:before{
			background:  <?php echo $this->flyin_option['hover_background_color']; ?> /*#db4437*/
	}
	<?php endif; ?>

	<?php if ( 'round-txt' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['flyin'] ) && '1' == $this->flyin_option['use_custom_color'] ) : ?>
	  /*----------  Style 3  ----------*/
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button{
		margin: <?php echo $this->flyin_option['icon_space'] == '1' && $this->flyin_option['icon_space_value'] != '' ? $this->flyin_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share:not(:hover){
		background: <?php echo $this->flyin_option['background_color']; ?>; /*#db4437*/
		border-color: <?php echo $this->flyin_option['icon_color']; ?>;
		color: <?php echo $this->flyin_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share:hover{
		background: <?php echo $this->flyin_option['hover_background_color']; ?>; /*#333*/
		border-color: <?php echo $this->flyin_option['hover_icon_color']; ?>;
		color: <?php echo $this->flyin_option['hover_icon_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $this->flyin_option['icon_color']; ?>;
		color: <?php echo $this->flyin_option['background_color']; ?>;
	  }
	<?php endif; ?>

	<?php if ( 'round-btm-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['flyin'] ) && '1' == $this->flyin_option['use_custom_color'] ) : ?>
	  /*----------  Style 4  ----------*/
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button{
		margin: <?php echo $this->flyin_option['icon_space'] == '1' && $this->flyin_option['icon_space_value'] != '' ? $this->flyin_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share:not(:hover) {
		box-shadow: inset 0px 0px 0px 0px <?php echo $this->flyin_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $this->flyin_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		background: <?php echo $this->flyin_option['background_color']; ?>;
		color: <?php echo $this->flyin_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share:hover {
		  box-shadow: inset 0px -40px 0px 0px <?php echo $this->flyin_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $this->flyin_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		  background: <?php echo $this->flyin_option['hover_background_color']; ?>;
		  color: <?php echo $this->flyin_option['hover_icon_color']; ?>;
	  }

	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter {
		  background: <?php echo $this->flyin_option['icon_color']; ?>;
		  color: <?php echo $this->flyin_option['background_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter:after,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter:after {
		  border-right-color: <?php echo $this->flyin_option['icon_color']; ?>;
	  }
	<?php endif; ?>

	<?php if ( 'flat-button-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['flyin'] ) && '1' == $this->flyin_option['use_custom_color'] ) : ?>
	  /*----------  Style 5  ----------*/
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button{
		  margin: <?php echo $this->flyin_option['icon_space'] == '1' && $this->flyin_option['icon_space_value'] != '' ? $this->flyin_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share:not(:hover){
		  background: <?php echo $this->flyin_option['background_color']; ?>;
		  box-shadow: inset 0px 0px 0px 0px <?php echo $this->flyin_option['hover_background_color']; ?>, 0px 3px 0px 0px <?php echo $this->flyin_option['hover_background_color']; ?>;
		  color: <?php echo $this->flyin_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share:hover{
		  background: <?php echo $this->flyin_option['hover_background_color']; ?>;
		  box-shadow: inset 0px -40px 0px 0px <?php echo $this->flyin_option['hover_background_color']; ?>, 0px 3px 0px 0px <?php echo $this->flyin_option['hover_background_color']; ?>;
		  color: <?php echo $this->flyin_option['hover_icon_color']; ?>;
	  }


	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $this->flyin_option['icon_color']; ?>;
		border-color:<?php echo $this->flyin_option['icon_color']; ?> ;
		color:<?php echo $this->flyin_option['background_color']; ?> ;
	  }
	<?php endif; ?>


	<?php if ( 'round-icon' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['flyin'] ) && '1' == $this->flyin_option['use_custom_color'] ) : ?>
	  /*----------  Style 6  ----------*/
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button{
		  margin: <?php echo $this->flyin_option['icon_space'] == '1' && $this->flyin_option['icon_space_value'] != '' ? $this->flyin_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share:not(:hover){
		  color: <?php echo $this->flyin_option['icon_color']; ?>;
		  border-color: <?php echo $this->flyin_option['hover_background_color']; ?>;
		  background: <?php echo $this->flyin_option['background_color']; ?>;
		  margin: <?php echo $this->flyin_option['icon_space'] == '1' && $this->flyin_option['icon_space_value'] != '' ? $this->flyin_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share:hover{
		  color: <?php echo $this->flyin_option['hover_icon_color']; ?>;
		  background: <?php echo $this->flyin_option['hover_background_color']; ?>;
		  border-color: <?php echo $this->flyin_option['hover_background_color']; ?>;
	  }
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-flyin .simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $this->flyin_option['icon_color']; ?>;
		color: <?php echo $this->flyin_option['background_color']; ?>;
		border-color:<?php echo $this->flyin_option['background_color']; ?>
	  }
	<?php endif; ?>

  /*=====  End of Code for Icons flyin  ======*/

  /*=============================================
  =            Code for Icons popup            =
  =============================================*/
	<?php if ( 'sm-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['popup'] ) && '1' == $this->popup_option['use_custom_color'] ) : ?>
	  /*----------  Style 1  ----------*/
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button{
		margin: <?php echo $this->popup_option['icon_space'] == '1' && $this->popup_option['icon_space_value'] != '' ? $this->popup_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button:not(:hover){
		border-color: <?php echo $this->popup_option['background_color']; ?>;
		background: <?php echo $this->popup_option['background_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button:hover{
		border-color: <?php echo $this->popup_option['hover_background_color']; ?>;
		background: <?php echo $this->popup_option['hover_background_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-tumblr-share:not(:hover){
		color: <?php echo $this->popup_option['icon_color']; ?> ;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-print-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-email-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round button.simplesocial-tumblr-share:hover{
		color: <?php echo $this->popup_option['hover_icon_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-sm-round .ssb_counter{
		background: <?php echo $this->popup_option['icon_color']; ?>;
		color: <?php echo $this->popup_option['background_color']; ?>;
	  }
	<?php endif; ?>

	<?php if ( 'simple-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['popup'] ) && '1' == $this->popup_option['use_custom_color'] ) : ?>
	  /*----------  Style 2  ----------*/
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button{
		margin: <?php echo $this->popup_option['icon_space'] == '1' && $this->popup_option['icon_space_value'] != '' ? $this->popup_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button:not(:hover){
		color: <?php echo $this->popup_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button:hover{
	   color: <?php echo $this->popup_option['hover_icon_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover){
		background:<?php echo $this->popup_option['background_color']; ?> ; /*#db4437*/
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover{
		background: <?php echo $this->popup_option['hover_background_color']; ?>; /*#db4437*/
	  }

	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share .ssb_counter{
		color: <?php echo $this->popup_option['background_color']; ?>;
		background: <?php echo $this->popup_option['icon_color']; ?>;
	  }
		
		
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):before ,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):before ,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):before{
			background:  <?php echo $this->popup_option['background_color']; ?>; /*#db4437*/
	}
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover:after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover:before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover:after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover:before ,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover:after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover:before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover:after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover:before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover:after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover:before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover:after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover:before,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover:after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover:before ,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover:after,
		.simplesocialbuttons-popup .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover:before{
			background:  <?php echo $this->popup_option['hover_background_color']; ?> /*#db4437*/
	}
	<?php endif; ?>

	<?php if ( 'round-txt' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['popup'] ) && '1' == $this->popup_option['use_custom_color'] ) : ?>
	  /*----------  Style 3  ----------*/
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button{
		margin: <?php echo $this->popup_option['icon_space'] == '1' && $this->popup_option['icon_space_value'] != '' ? $this->popup_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share:not(:hover){
		background: <?php echo $this->popup_option['background_color']; ?>; /*#db4437*/
		border-color: <?php echo $this->popup_option['icon_color']; ?>;
		color: <?php echo $this->popup_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share:hover{
		background: <?php echo $this->popup_option['hover_background_color']; ?>; /*#333*/
		border-color: <?php echo $this->popup_option['hover_icon_color']; ?>;
		color: <?php echo $this->popup_option['hover_icon_color']; ?>;
	  }

	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share .ssb_counter{
		color: <?php echo $this->popup_option['background_color']; ?>;
		background: <?php echo $this->popup_option['icon_color']; ?>;
	  }

	<?php endif; ?>

	<?php if ( 'round-btm-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['popup'] ) && '1' == $this->popup_option['use_custom_color'] ) : ?>
	  /*----------  Style 4  ----------*/
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button{
		  margin: <?php echo $this->popup_option['icon_space'] == '1' && $this->popup_option['icon_space_value'] != '' ? $this->popup_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share:not(:hover){
		  box-shadow: inset 0px 0px 0px 0px <?php echo $this->popup_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $this->popup_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		  color: <?php echo $this->popup_option['icon_color']; ?>;
		  background:  <?php echo $this->popup_option['background_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share:hover {
		  box-shadow: inset 0px -40px 0px 0px <?php echo $this->popup_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $this->popup_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		  color: <?php echo $this->popup_option['hover_icon_color']; ?>;
		  background: <?php echo $this->popup_option['hover_background_color']; ?>;
	  }

	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter {
		  background: <?php echo $this->popup_option['icon_color']; ?>;
		  color: <?php echo $this->popup_option['background_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter:after,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter:after {
		  border-right-color: <?php echo $this->popup_option['icon_color']; ?>;
	  }
	<?php endif; ?>

	<?php if ( 'flat-button-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['popup'] ) && '1' == $this->popup_option['use_custom_color'] ) : ?>
	  /*----------  Style 5  ----------*/
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button{
		  margin: <?php echo $this->popup_option['icon_space'] == '1' && $this->popup_option['icon_space_value'] != '' ? $this->popup_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share:not(:hover){
		  background: <?php echo $this->popup_option['background_color']; ?>;
		  box-shadow: inset 0px 0px 0px 0px <?php echo $this->popup_option['hover_background_color']; ?>, 0px 3px 0px 0px <?php echo $this->popup_option['hover_background_color']; ?>;
		  color: <?php echo $this->popup_option['icon_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share:hover{
		  background: <?php echo $this->popup_option['hover_background_color']; ?>;
		  box-shadow: inset 0px -40px 0px 0px <?php echo $this->popup_option['hover_background_color']; ?>, 0px 3px 0px 0px <?php echo $this->popup_option['hover_background_color']; ?>;
		  color: <?php echo $this->popup_option['hover_icon_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $this->popup_option['icon_color']; ?>;
		border-color: <?php echo $this->popup_option['icon_color']; ?>;
		color: <?php echo $this->popup_option['background_color']; ?>;
	  }
	<?php endif; ?>

	<?php if ( 'round-icon' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['popup'] ) && '1' == $this->popup_option['use_custom_color'] ) : ?>
	  /*----------  Style 6  ----------*/
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button{
		  margin: <?php echo $this->popup_option['icon_space'] == '1' && $this->popup_option['icon_space_value'] != '' ? $this->popup_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share:not(:hover),
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share:not(:hover){
		  color: <?php echo $this->popup_option['icon_color']; ?>;
		  border-color: <?php echo $this->popup_option['hover_background_color']; ?>;
		  background: <?php echo $this->popup_option['background_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share:hover,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share:hover{
		  color: <?php echo $this->popup_option['hover_icon_color']; ?>;
		  background: <?php echo $this->popup_option['hover_background_color']; ?>;
		  border-color: <?php echo $this->popup_option['hover_background_color']; ?>;
	  }
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share .ssb_counter,
	  .simplesocialbuttons-popup .simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $this->popup_option['icon_color']; ?>;
		color: <?php echo $this->popup_option['background_color']; ?>;
		border-color: <?php echo $this->popup_option['background_color']; ?>;
	  }
	<?php endif; ?>

  /*=====  End of Code for Icons popup  ======*/

  /*=============================================
  =            Code for Icons Media            =
  =============================================*/
	<?php if ( 'sm-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['media'] ) && '1' == $this->media_option['use_custom_color'] ) : ?>
	  /*----------  Style 1  ----------*/
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button{
		margin: <?php echo $this->media_option['icon_space'] == '1' && $this->media_option['icon_space_value'] != '' ? $this->media_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button:not(:hover){
		border-color: <?php echo $this->media_option['background_color']; ?>;
		background: <?php echo $this->media_option['background_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button:hover{
		border-color: <?php echo $this->media_option['hover_background_color']; ?>;
		background: <?php echo $this->media_option['hover_background_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-fb-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-twt-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-gplus-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-whatsapp-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-viber-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-reddit-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-linkedin-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-msng-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-print-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-email-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-pinterest-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-tumblr-share:not(:hover){
		color: <?php echo $this->media_option['icon_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-fb-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-twt-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-gplus-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-whatsapp-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-viber-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-reddit-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-linkedin-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-msng-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-print-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-email-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-pinterest-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round button.simplesocial-tumblr-share:hover{
		color: <?php echo $this->media_option['hover_icon_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-sm-round .ssb_counter{
		background: <?php echo $this->media_option['icon_color']; ?>;
		color: <?php echo $this->media_option['background_color']; ?>;
	  }
	<?php endif; ?>
	<?php if ( 'simple-round' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['media'] ) && '1' == $this->media_option['use_custom_color'] ) : ?>
	  /*----------  Style 2  ----------*/
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button{
		margin: <?php echo $this->media_option['icon_space'] == '1' && $this->media_option['icon_space_value'] != '' ? $this->media_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button:not(:hover){
		color: <?php echo $this->media_option['background_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button:hover{
		color: <?php echo $this->media_option['hover_background_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover){
		background: <?php echo $this->media_option['background_color']; ?>; /*#db4437*/
		color: <?php echo $this->media_option['icon_color']; ?>; /*#db4437*/
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover{
		background: <?php echo $this->media_option['hover_background_color']; ?>; /*#db4437*/
		color: <?php echo $this->media_option['hover_icon_color']; ?>; /*#db4437*/
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-email-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-print-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-gplus-share .ssb_counter{
		color: <?php echo $this->media_option['background_color']; ?>;
		background: <?php echo $this->media_option['icon_color']; ?>;
	  }

		
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:not(:hover):before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:not(:hover):before ,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:not(:hover):before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:not(:hover):before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:not(:hover):before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:not(:hover):before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:not(:hover):before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:not(:hover):before ,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:not(:hover):before{
			background:  <?php echo $this->media_option['background_color']; ?>; /*#db4437*/
	}
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover:after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-fb-share:hover:before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover:after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-twt-share:hover:before ,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover:after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-viber-share:hover:before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-whatsapp-share:hover:before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover:after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-reddit-share:hover:before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover:after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-linkedin-share:hover:before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover:after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-pinterest-share:hover:before,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover:after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-msng-share:hover:before ,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover:after,
		.ssb_social_media_wrapper .simplesocialbuttons.simplesocial-simple-round button.simplesocial-tumblr-share:hover:before{
			background:  <?php echo $this->media_option['hover_background_color']; ?> /*#db4437*/
	}
	<?php endif; ?>
	<?php if ( 'round-txt' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['media'] ) && '1' == $this->media_option['use_custom_color'] ) : ?>
	  /*----------  Style 3  ----------*/
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button{
		margin: <?php echo $this->media_option['icon_space'] == '1' && $this->media_option['icon_space_value'] != '' ? $this->media_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share:not(:hover){
		background: <?php echo $this->media_option['background_color']; ?>; /*#db4437*/
		border-color: <?php echo $this->media_option['icon_color']; ?>;
		color: <?php echo $this->media_option['icon_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share:hover{
		background: <?php echo $this->media_option['hover_background_color']; ?>; /*#333*/
		border-color: <?php echo $this->media_option['hover_background_color']; ?>;
		color: <?php echo $this->media_option['hover_icon_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-fb-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-twt-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-whatsapp-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-viber-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-reddit-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-linkedin-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-msng-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-print-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-email-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-pinterest-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-gplus-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-txt button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $this->media_option['icon_color']; ?>;
		color: <?php echo $this->media_option['background_color']; ?>;
	  }
	<?php endif; ?>
	<?php if ( 'round-btm-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['media'] ) && '1' == $this->media_option['use_custom_color'] ) : ?>
	  /*----------  Style 4  ----------*/
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button{
		  margin: <?php echo $this->media_option['icon_space'] == '1' && $this->media_option['icon_space_value'] != '' ? $this->media_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share:not(:hover) {
		  box-shadow: inset 0px 0px 0px 0px <?php echo $this->media_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $this->media_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		  color: <?php echo $this->media_option['icon_color']; ?>;
		  background: <?php echo $this->media_option['background_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share:hover {
		  box-shadow: inset 0px -40px 0px 0px <?php echo $this->media_option['hover_background_color']; ?>, 0px 2px 0px 0px <?php echo $this->media_option['hover_background_color']; ?>, 0px 0px 5px 0px rgba(0, 0, 0, 0.13);
		  color: <?php echo $this->media_option['hover_icon_color']; ?>;
		  background: <?php echo $this->media_option['hover_background_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter {
		  background: <?php echo $this->media_option['icon_color']; ?>;
		  color: <?php echo $this->media_option['background_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-fb-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-twt-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-gplus-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-whatsapp-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-viber-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-reddit-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-linkedin-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-msng-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-email-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-print-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-pinterest-share .ssb_counter:after,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-btm-border button.simplesocial-tumblr-share .ssb_counter:after {
		  border-right-color: <?php echo $this->media_option['icon_color']; ?>;
	  }
	<?php endif; ?>
	<?php if ( 'flat-button-border' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['media'] ) && '1' == $this->media_option['use_custom_color'] ) : ?>
	  /*----------  Style 5  ----------*/
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button{
		  margin: <?php echo $this->media_option['icon_space'] == '1' && $this->media_option['icon_space_value'] != '' ? $this->media_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share:not(:hover){
		  background: <?php echo $this->media_option['background_color']; ?>;
		  box-shadow: inset 0px 0px 0px 0px <?php echo $this->media_option['hover_background_color']; ?>, 0px 3px 0px 0px <?php echo $this->media_option['hover_background_color']; ?>;
		  color: <?php echo $this->media_option['icon_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share:hover{
		  background: <?php echo $this->media_option['hover_background_color']; ?>;
		  box-shadow: inset 0px -40px 0px 0px <?php echo $this->media_option['hover_background_color']; ?>, 0px 3px 0px 0px <?php echo $this->media_option['hover_background_color']; ?>;
		  color: <?php echo $this->media_option['hover_icon_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-fb-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-twt-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-gplus-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-whatsapp-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-viber-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-reddit-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-linkedin-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-msng-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-print-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-email-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-pinterest-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-flat-button-border button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $this->media_option['icon_color']; ?>;
		border-color: <?php echo $this->media_option['icon_color']; ?>;
		color:<?php echo $this->media_option['background_color']; ?>;
	  }
	<?php endif; ?>
	<?php if ( 'round-icon' == $_ssb_pr->selected_theme && isset( $_ssb_pr->selected_position['media'] ) && '1' == $this->media_option['use_custom_color'] ) : ?>
	  /*----------  Style 6  ----------*/
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button{
		  margin: <?php echo $this->media_option['icon_space'] == '1' && $this->media_option['icon_space_value'] != '' ? $this->media_option['icon_space_value'] . 'px' : ''; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share:not(:hover),
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share:not(:hover){
		  color: <?php echo $this->media_option['icon_color']; ?>;
		  border-color: <?php echo $this->media_option['hover_background_color']; ?>;
		  background: <?php echo $this->media_option['background_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share:hover,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share:hover{
		  color: <?php echo $this->media_option['hover_icon_color']; ?>;
		  background: <?php echo $this->media_option['hover_background_color']; ?>;
		  border-color: <?php echo $this->media_option['hover_background_color']; ?>;
	  }
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-fb-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-twt-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-whatsapp-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-viber-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-reddit-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-linkedin-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-msng-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-email-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-print-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-pinterest-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-gplus-share .ssb_counter,
	  .ssb_social_media_wrapper .simplesocialbuttons.simplesocial-round-icon button.simplesocial-tumblr-share .ssb_counter{
		background: <?php echo $this->media_option['icon_color']; ?>;
		color: <?php echo $this->media_option['background_color']; ?>;
	  }
	<?php endif; ?>
	/*=====  End of Code for Icons Media  ======*/

	/*=====  Cutom style for flyin Box  ======*/
	<?php if ( isset( $_ssb_pr->selected_position['flyin'] ) && '1' == $this->flyin_option['use_custom_color'] ) : ?>
		.simplesocialbuttons-flyin{
			background: <?php echo $this->flyin_option['box_background_color']; ?>;
			color:      <?php echo $this->flyin_option['box_text_color']; ?>;
		}
	<?php endif; ?>
	/*=====  End of custom style for flyin Box  ======*/
	
	/*=====  Cutom style for popup Box  ======*/
	<?php if ( isset( $_ssb_pr->selected_position['popup'] ) && '1' == $this->popup_option['use_custom_color'] ) : ?>
		.simplesocialbuttons-popup .simplesocialbuttons__content{
			background: <?php echo $this->popup_option['box_background_color']; ?>;
			color:      <?php echo $this->popup_option['box_text_color']; ?>;
		}
	<?php endif; ?>
	/*=====  End of custom style for popup Box  ======*/

</style>
