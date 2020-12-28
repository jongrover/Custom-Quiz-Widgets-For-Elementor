<?php
namespace ElementPack\Modules\EventCalendar\Skins;

use Elementor\Skin_Base as Elementor_Skin_Base;

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Altra extends Elementor_Skin_Base {

	public function get_id() {
		return 'altra';
	}

	public function get_title() {
		return __( 'Altra', 'bdthemes-element-pack' );
	}


	public function render() {

		$settings = $this->parent->get_settings_for_display();

		global $post;

		$start_date = ( 'custom' == $settings['start_date'] ) ? $settings['custom_start_date'] : $settings['start_date'];
		$end_date   = ( 'custom' == $settings['end_date'] ) ? $settings['custom_end_date'] : $settings['end_date'];

		$query_args = array_filter( [
			'start_date'     => $start_date,
			'end_date'       => $end_date,
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'eventDisplay' 	 => ( 'custom' == $settings['start_date'] or 'custom' == $settings['end_date'] ) ? 'custom' : 'all',
			'posts_per_page' => $settings['limit'],
			//'tag'          => 'donor-program', // or whatever the tag name is
		] );


		if ( 'by_name' === $settings['source'] and !empty($settings['event_categories']) ) {
			$query_args['tax_query'][] = [
				'taxonomy' => 'tribe_events_cat',
				'field'    => 'slug',
				'terms'    => $settings['event_categories'],
			];
		}

		$query_args = tribe_get_events( $query_args );

		$this->render_header();

		foreach ( $query_args as $post ) {
			

			$this->render_loop_item( $post );
		}

		$this->render_footer();

		wp_reset_postdata();
	}

	public function render_image() {
		$settings = $this->parent->get_settings_for_display();

		if ( ! $this->parent->get_settings( 'show_image' ) ) {
			return;
		}

		$settings['image'] = [
			'id' => get_post_thumbnail_id(),
		];

		$image_html        = Group_Control_Image_Size::get_attachment_image_html( $settings, 'image' );
		$placeholder_image_src = Utils::get_placeholder_image_src();

		if ( ! $image_html ) {
			$image_html = '<img src="' . esc_url( $placeholder_image_src ) . '" alt="' . get_the_title() . '">';
		}

		?>

		<div class="bdt-event-image bdt-background-cover">
			<a href="<?php echo ($settings['anchor_link'] == 'yes') ? the_permalink() : 'javascript:void(0);'; ?>" title="<?php echo get_the_title(); ?>">
				<img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size']); ?>" alt="<?php echo get_the_title(); ?>">
			</a>
		</div>
		<?php
	}

	public function render_title() {
		$settings = $this->parent->get_settings_for_display();
		if ( ! $this->parent->get_settings( 'show_title' ) ) {
			return;
		}

		?>

		<h3 class="bdt-event-title-wrap">
			<a href="<?php echo ($settings['anchor_link'] == 'yes') ? get_permalink() : 'javascript:void(0);'; ?>" class="bdt-event-title">
				<?php the_title() ?>
			</a>
		</h3>
		<?php
	}

	public function render_date() {
		if ( ! $this->parent->get_settings( 'show_date' ) ) {
			return;
		}

		$start_datetime = tribe_get_start_date();
		$end_datetime = tribe_get_end_date();

		$event_day = tribe_get_start_date( null, false, 'j' );
		$event_month = tribe_get_start_date( null, false, 'M' );

		?>
		<span class="bdt-event-date">
			<a href="#" title="<?php esc_html_e('Start Date:', 'bdthemes-element-pack'); echo esc_html($start_datetime); ?>  - <?php esc_html_e('End Date:', 'bdthemes-element-pack'); echo esc_html($end_datetime); ?>"> 
				<span class="bdt-event-day">
					<?php echo esc_html( str_pad($event_day, 2, '0', STR_PAD_LEFT) ); ?>
				</span>
				<span>
					<?php echo esc_html($event_month); ?>
				</span>
			</a>
		</span> 
		<?php
	}

	public function render_excerpt( $post ) {
		if ( ! $this->parent->get_settings( 'show_excerpt' ) ) {
			return;
		}

		?>
		<div class="bdt-event-excerpt">
			<?php 
				
				echo strip_shortcodes( wp_trim_words( $post->post_content, $this->parent->get_settings( 'excerpt_length' ) ) );
				
			?>
		</div>
		<?php

	}

	public function render_price() {
		$settings = $this->parent->get_settings_for_display();

		$cost    = ($settings['show_meta_cost']) ? tribe_get_formatted_cost() : '';

		?>

		<?php if (!empty($cost)) : ?>
		    <div class="bdt-event-price">
		    	<a class="bdt-flex bdt-flex-middle" href="#">
			    	<span>
			    		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 481.08 481.08" style="" xml:space="preserve">
							<g><g><path d="M470.52,159.601l-35.977-35.688c-10.657,10.656-23.604,15.988-38.828,15.988c-15.229,0-28.168-5.332-38.824-15.988    c-10.664-10.66-15.988-23.601-15.988-38.83c0-15.23,5.331-28.171,15.988-38.832l-35.693-35.688    c-7.05-7.04-15.66-10.562-25.838-10.562c-10.184,0-18.794,3.523-25.837,10.562L10.566,269.233C3.521,276.279,0,284.896,0,295.07    c0,10.182,3.521,18.791,10.566,25.838l35.688,35.977c10.66-10.656,23.604-15.988,38.831-15.988    c15.226,0,28.167,5.325,38.826,15.988c10.657,10.657,15.987,23.6,15.987,38.828s-5.327,28.164-15.987,38.828l35.976,35.974    c7.044,7.043,15.658,10.564,25.841,10.564c10.184,0,18.798-3.521,25.837-10.564L470.52,211.275    c7.043-7.042,10.561-15.653,10.561-25.837C481.08,175.255,477.562,166.645,470.52,159.601z M393.145,216.701L216.702,393.139    c-3.422,3.433-7.705,5.144-12.847,5.144c-5.137,0-9.419-1.711-12.845-5.144L87.653,289.793c-3.617-3.621-5.424-7.902-5.424-12.847    c0-4.949,1.807-9.236,5.424-12.854L264.095,87.651c3.429-3.427,7.714-5.142,12.854-5.142c5.134,0,9.418,1.715,12.847,5.142    l103.35,103.353c3.621,3.619,5.428,7.902,5.428,12.85C398.572,208.801,396.766,213.083,393.145,216.701z"/>
							<path d="M276.955,113.639l90.223,90.218L203.87,367.165l-90.218-90.218L276.955,113.639z"/>
							</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
						</svg>
	    			</span>
			    	<span class="bdt-price-amount"><?php echo esc_html($cost); ?></span>
		    	</a>
		    </div>
		<?php endif; ?>

		<?php
	}

	public function render_website_address() {
		$settings = $this->parent->get_settings_for_display();

		$address = ($settings['show_meta_location']) ? tribe_address_exists() : '';
		$website = ($settings['show_meta_website']) ? tribe_get_event_website_url() : '';

		?>

		<?php if ( !empty($website) or $address ) : ?>
			<div class="bdt-address-website-icon">
				
				<?php if (!empty($website)) : ?>
					<a href="<?php echo esc_url($website); ?>" target="_blank" class="ep-earth" aria-hidden="true"></a>
				<?php endif; ?>

				<?php if ( $address ) : ?>
					<a href="#" bdt-tooltip="<?php echo esc_html( tribe_get_full_address() ); ?>" class="ep-location" aria-hidden="true"></a>
				<?php endif; ?>

			</div>
		<?php endif; ?>

		<?php

	}

    public function render_header() {
		$settings = $this->parent->get_settings_for_display();
		
		$id       = 'bdt-event-' . $this->parent->get_id();

		$elementor_vp_lg = get_option( 'elementor_viewport_lg' );
		$elementor_vp_md = get_option( 'elementor_viewport_md' );
		$viewport_lg     = ! empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1023;
		$viewport_md     = ! empty($elementor_vp_md) ? $elementor_vp_md - 1 : 767;

		$this->parent->add_render_attribute( 'carousel', 'id', $id );
		$this->parent->add_render_attribute( 'carousel', 'class', ['bdt-event-calendar', 'bdt-event-carousel-skin-altra'] );

		if ('arrows' == $settings['navigation']) {
			$this->parent->add_render_attribute( 'carousel', 'class', 'bdt-arrows-align-'. $settings['arrows_position'] );
			
		}
		if ('dots' == $settings['navigation']) {
			$this->parent->add_render_attribute( 'carousel', 'class', 'bdt-dots-align-'. $settings['dots_position'] );
		}
		if ('both' == $settings['navigation']) {
			$this->parent->add_render_attribute( 'carousel', 'class', 'bdt-arrows-dots-align-'. $settings['both_position'] );
		}

		$this->parent->add_render_attribute(
			[
				'carousel' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"autoplay"       => ( "yes" == $settings["autoplay"] ) ? [ "delay" => $settings["autoplay_speed"] ] : false,
							"loop"           => ($settings["loop"] == "yes") ? true : false,
							"speed"          => $settings["speed"]["size"],
							"pauseOnHover"   => ("yes" == $settings["pauseonhover"]) ? true : false,
							"slidesPerView"  => (int) $settings["columns_mobile"],
							"spaceBetween"   => $settings["item_gap"]["size"],
							"observer"       => ($settings["observer"]) ? true : false,
							"observeParents" => ($settings["observer"]) ? true : false,
							"breakpoints"    => [
								(int) $viewport_md => [
									"slidesPerView" => (int) $settings["columns_tablet"],
									"spaceBetween"  => $settings["item_gap"]["size"],
								],
								(int) $viewport_lg => [
                                    "slidesPerView" => (int) $settings["columns"],
                                    "spaceBetween"  => $settings["item_gap"]["size"],
                                ]
					      	],
			      	        "navigation" => [
			      				"nextEl" => "#" . $id . " .bdt-navigation-next",
			      				"prevEl" => "#" . $id . " .bdt-navigation-prev",
			      			],
			      			"pagination" => [
			      			  "el"         => "#" . $id . " .swiper-pagination",
			      			  "type"       => "bullets",
			      			  "clickable"  => true,
			      			],
				        ]))
					]
				]
			]
		);
		
		$this->parent->add_render_attribute( 'event-carousel', 'class', 'swiper-container' );

		$this->parent->add_render_attribute('event-carousel-wrapper', 'class', 'swiper-wrapper');

		?>
		<div <?php echo $this->parent->get_render_attribute_string( 'carousel' ); ?>>
			<div <?php echo $this->parent->get_render_attribute_string( 'event-carousel' ); ?>>
				<div <?php echo $this->parent->get_render_attribute_string( 'event-carousel-wrapper' ); ?>>
		<?php
    }
    
    public function render_footer() {
		$settings = $this->parent->get_settings_for_display();

				?>
				</div>
			</div>
			<?php if ('both' == $settings['navigation']) : ?>
				<?php $this->parent->render_both_navigation(); ?>
				<?php if ('center' === $settings['both_position']) : ?>
					<div class="bdt-dots-container">
						<div class="swiper-pagination"></div>
					</div>
				<?php endif; ?>
			<?php else : ?>			
				<?php $this->parent->render_pagination(); ?>
				<?php $this->parent->render_navigation(); ?>
			<?php endif; ?>
		</div>
		<?php
	}

	public function render_loop_item( $post ) {
		$settings = $this->parent->get_settings_for_display();		

		?> 
		<div class="bdt-event-grid-item swiper-slide">

			<div class="bdt-event-item-inner">
			    
			    <div class="bdt-event-image">
					<?php $this->render_image(); ?>
			        <?php $this->render_date(); ?>
			        <?php $this->render_price(); ?>
			    </div>

			    <div class="bdt-event-content">
			        <div class="bdt-event-intro bdt-flex bdt-flex-between bdt-flex-middle">

						<?php $this->render_title(); ?>
						<?php $this->render_website_address(); ?>

			        </div>

		            <?php $this->render_excerpt( $post ); ?>

			    </div>

			</div>
			
		</div>
		<?php
	}
}