<?php
	$license = get_option( 'ssb_pro_license_key' );
?>

<div class="wrap">
	<h2><?php _e('Activate your License'); ?></h2>
	<form method="post" action="options.php">

		<?php settings_fields('ssb_pro_license'); ?>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row" valign="top">
						<?php _e('License Key'); ?>
					</th>
					<td>
						<input id="ssb_pro_license_key" placeholder="Enter your license key" name="ssb_pro_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
						<label class="description" for="ssb_pro_license_key"><?php _e('Validating license key is mandatory to use automatic updates and plugin support.'); ?></label>
					</td>
				</tr>

					<tr valign="top">
						<th scope="row" valign="top">
						</th>
						<td>
							<?php if( Simple_Social_Buttons_Pro::is_registered() ) { ?>
								
								<?php wp_nonce_field( 'ssb_pro_license_nonce', 'ssb_pro_license_nonce' ); ?>
								<input type="submit" class="button-secondary" name="ssb_pro_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
							<?php } else {
								wp_nonce_field( 'ssb_pro_license_nonce', 'ssb_pro_license_nonce' ); ?>
								<input type="submit" class="button-secondary" name="ssb_pro_license_activate" value="<?php _e('Activate License'); ?>"/>
						</td>
					</tr>
				<?php } ?>
				<tr><th></th><td>
						<?php
						if ( Simple_Social_Buttons_Pro::is_registered() ) {
							$expiration_date = Simple_Social_Buttons_Pro::get_expiration_date();

							if ( 'lifetime' == $expiration_date ) {
								$license_desc = esc_html__( 'You have a lifetime license, it will never expire.', 'simple-social-buttons' );
							}
							else {
								$license_desc = sprintf(
									esc_html__( 'Your license key is valid until %s.', 'simple-social-buttons' ),
									'<strong>' . date_i18n( get_option( 'date_format' ), strtotime( $expiration_date, current_time( 'timestamp' ) ) ) . '</strong>'
								);
							}

							$license_tooltip_desc  = sprintf(
									esc_html__( 'The license will automatically renew, if you have an active subscription to the Simple Social Buttons - at %s', 'simple-social-buttons' ),
									'<a href="https://wpbrigade.com/wordpress/plugins/simple-social-buttons/">WPBrigade.com</a>'
								);

							if ( Simple_Social_Buttons_Pro::has_license_expired() ) {
								$license_desc = sprintf(
									esc_html__( 'Your license key expired on %s. Please input a valid non-expired license key. If you think, that this license has not yet expired (was renewed already), then please save the settings, so that the license will verify again and get the up-to-date expiration date.', 'simple-social-buttons' ),
									'<strong>' . date_i18n( get_option( 'date_format' ), strtotime( $expiration_date, current_time( 'timestamp' ) ) ) . '</strong>'
								);
								$license_tooltip_title = '';
								$license_tooltip_desc  = '';

							}

							echo $license_desc .'<br /><i>' . $license_tooltip_desc .'</i>';
						}else{

							echo Simple_Social_Buttons_Pro::get_registered_license_status();
						}
						?>
					</td></tr>
			</tbody>
		</table>
	</form>		
</div>