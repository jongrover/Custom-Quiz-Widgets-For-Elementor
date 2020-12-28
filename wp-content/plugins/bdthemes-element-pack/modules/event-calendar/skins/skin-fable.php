<?php
namespace ElementPack\Modules\EventCalendar\Skins;

use Elementor\Skin_Base as Elementor_Skin_Base;

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Fable extends Elementor_Skin_Base {

	public function get_id() {
		return 'fable';
	}

	public function get_title() {
		return __( 'Fable', 'bdthemes-element-pack' );
	}

    public function render_header() {
		$settings = $this->parent->get_settings_for_display();
		
		$id       = 'bdt-event-' . $this->parent->get_id();

		$elementor_vp_lg = get_option( 'elementor_viewport_lg' );
		$elementor_vp_md = get_option( 'elementor_viewport_md' );
		$viewport_lg     = ! empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1023;
		$viewport_md     = ! empty($elementor_vp_md) ? $elementor_vp_md - 1 : 767;

		$this->parent->add_render_attribute( 'carousel', 'id', $id );
		$this->parent->add_render_attribute( 'carousel', 'class', ['bdt-event-calendar', 'bdt-event-carousel-skin-fable'] );

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

	public function render_date() {
		if ( ! $this->parent->get_settings( 'show_date' ) ) {
			return;
		}

		$start_datetime = tribe_get_start_date();
		$end_datetime = tribe_get_end_date();

		$event_date = tribe_get_start_date( null, false );

		?>
		<span class="bdt-event-date">
			<a href="#" title="<?php esc_html_e('Start Date:', 'bdthemes-element-pack'); echo esc_html($start_datetime); ?>  - <?php esc_html_e('End Date:', 'bdthemes-element-pack'); echo esc_html($end_datetime); ?>"> 
				<span class="bdt-event-day">
					<?php echo esc_html($event_date); ?>
				</span>
			</a>
		</span> 
		<?php
	}

	public function render_meta() {
		$settings = $this->parent->get_settings_for_display();
		if ( ! $this->parent->get_settings( 'show_meta' ) ) {
			return;
		}

		$cost         = ($settings['show_meta_cost']) ? tribe_get_formatted_cost() : '';	
		$more_icon    = ( 'yes' == ( $settings['show_meta_more_btn']) ) ;	

		?>

		<?php if ( !empty($cost) or $more_icon )  : ?>
		<div class="bdt-event-meta bdt-grid">

			<?php if (!empty($cost)) : ?>
			    <div class="bdt-width-auto bdt-padding-remove">
				    <div class="bdt-event-price">
				    	<a href="#"><?php esc_html_e('Cost:', 'bdthemes-element-pack'); ?></a>
				    	<a href="#"><?php echo esc_html($cost); ?></a>
				    </div>
			    </div>
			<?php endif; ?>

			<?php if (!empty($more_icon)) : ?>
		    <div class="bdt-width-expand bdt-text-right">
				<div class="bdt-more-icon">
					<a href="#" bdt-tooltip="<?php echo esc_html( 'Find out more', 'bdthemes-element-pack' ); ?>" class="ep-arrow-right-4" aria-hidden="true"></a>
				</div>
			</div>
			<?php endif; ?>

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

	public function render_loop_item( $post ) {
		$settings = $this->parent->get_settings_for_display();

		?>
		<div class="bdt-event-item swiper-slide">

			<div class="bdt-event-item-inner">
			
				<?php $this->render_website_address(); ?>

				<?php $this->render_image(); ?>

			    <div class="bdt-event-content">

			        <?php $this->render_date(); ?>

			        <?php $this->parent->render_title(); ?>

		            <?php $this->parent->render_excerpt( $post ); ?>

					<?php $this->render_meta(); ?>

			    </div>

			</div>
			
		</div>
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
}