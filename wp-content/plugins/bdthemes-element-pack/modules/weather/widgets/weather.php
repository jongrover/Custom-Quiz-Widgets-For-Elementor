<?php
namespace ElementPack\Modules\Weather\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;

use ElementPack\Element_Pack_Loader;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Weather extends Widget_Base {

	public $weather_data = [];

	public $weather_api_current_url = 'http://api.weatherstack.com/current';

	public function get_name() {
		return 'bdt-weather';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Weather', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-weather';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'weather', 'cloudy', 'sunny', 'morning', 'evening' ];
	}

	public function get_style_depends() {
		return ['ep-weather'];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/Vjyl4AAAufg';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content_weather',
			[
				'label' => esc_html__( 'Weather', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => esc_html__( 'Layout', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'simple',
				'options' => [
					'simple'   => esc_html__( 'Simple', 'bdthemes-element-pack' ),
					'today'    => esc_html__( 'Today', 'bdthemes-element-pack' ),
					'tiny'     => esc_html__( 'Tiny', 'bdthemes-element-pack' ),
					//'forecast' => esc_html__( 'Forecast', 'bdthemes-element-pack' ),
					//'full'     => esc_html__( 'Full', 'bdthemes-element-pack' ),
				],
				'prefix_class' => 'bdt-weather-layout-',
				'render_type' => 'template',
			]
		);

		// $this->add_control(
		// 	'location_type',
		// 	[
		// 		'label'   => esc_html__( 'Location Type', 'bdthemes-element-pack' ),
		// 		'type'    => Controls_Manager::SELECT,
		// 		'default' => 'darksky',
		// 		'options' => [
		// 			'lat_long'        => esc_html__( 'Latitude Longitude', 'bdthemes-element-pack' ),
		// 			'location' => esc_html__( 'Location Name', 'bdthemes-element-pack' ),
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'latitude',
		// 	[
		// 		'label'       => esc_html__( 'Latitude', 'bdthemes-element-pack' ),
		// 		'description' => __( '<a href="https://www.latlong.net/">Look here</a> for your latitude.', 'bdthemes-element-pack' ),
		// 		'type'        => Controls_Manager::TEXT,
		// 		'dynamic'     => [ 'active' => true ],
		// 		'default'     => 24.823402,
		// 		'condition'   => [
		// 			'api_type' => ['darksky']
		// 		]
		// 	]
		// );

		// $this->add_control(
		// 	'longitude',
		// 	[
		// 		'label'       => esc_html__( 'Longitude', 'bdthemes-element-pack' ),
		// 		'description' => __( '<a href="https://www.latlong.net/">Look here</a> for your longitude.', 'bdthemes-element-pack' ),
		// 		'type'        => Controls_Manager::TEXT,
		// 		'dynamic'     => [ 'active' => true ],
		// 		'default'     => 89.384077,
		// 		'condition'   => [
		// 			'api_type' => ['darksky']
		// 		]
		// 	]
		// );

		$this->add_control(
			'location',
			[
				'label'   => esc_html__( 'Location', 'bdthemes-element-pack' ),
				'description'   => esc_html__( 'City and Region required, for example: Boston, MA', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [ 'active' => true ],
				'default' => 'Bogra, BD',
			]
		);

		$this->add_control(
			'country',
			[
				'label'   => esc_html__( 'Country (optional)', 'bdthemes-element-pack' ),
				'description'   => esc_html__( 'If you want to override country name, for example: USA', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'units',
			[
				'label'   => esc_html__( 'Units', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'metric',
				'options' => [
					'metric'   => esc_html__( 'Metric', 'bdthemes-element-pack' ),
					'imperial' => esc_html__( 'Imperial', 'bdthemes-element-pack' ),
				],
			]
		);

		// $this->add_control(
		// 	'timeformat',
		// 	[
		// 		'label'   => esc_html__( 'Time Format', 'bdthemes-element-pack' ),
		// 		'type'    => Controls_Manager::SELECT,
		// 		'default' => 12,
		// 		'options' => [
		// 			12 => esc_html__( '12', 'bdthemes-element-pack' ),
		// 			24 => esc_html__( '24', 'bdthemes-element-pack' ),
		// 		],
		// 		'condition' => [
		// 			'view!' => ['tiny']
		// 		]
		// 	]
		// );

		$this->add_control(
			'show_city',
			[
				'label'   => esc_html__( 'Show City Name', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				// 'condition' => [
				// 	'view!' => ['tiny', 'forecast']
				// ]
			]
		);

		$this->add_control(
			'show_country',
			[
				'label'   => esc_html__( 'Show Country Name', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'view!' => ['tiny']
				]
			]
		);

		$this->add_control(
			'show_temperature',
			[
				'label'   => esc_html__( 'Show Temperature', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				// 'condition' => [
				// 	'view!' => ['tiny']
				// ]
			]
		);

		$this->add_control(
			'show_weather_condition_name',
			[
				'label'   => esc_html__( 'Show Weather Condition Name', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				// 'condition' => [
				// 	'view!' => ['tiny']
				// ]
			]
		);

		$this->add_control(
			'show_weather_icon',
			[
				'label'   => esc_html__( 'Show Icon', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'view!' => ['forecast']
				]
			]
		);

		$this->add_control(
			'show_weather_desc',
			[
				'label'   => esc_html__( 'Show Description', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'view' => ['tiny']
				]
			]
		);

		$this->add_control(
			'show_today_name',
			[
				'label'   => esc_html__( 'Show Today Name', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'view!' => ['tiny', 'simple']
				]
			]
		);

		$this->add_control(
			'weather_details',
			[
				'label'   => esc_html__( 'Weather Details', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'view!' => ['tiny', 'simple']
				]
			]
		);

		$this->add_control(
			'forecast',
			[
				'label' => esc_html__( 'Forecast', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'default' => [
					'size' => 5,
				],
				'condition' => [
					'view' => ['full', 'forecast']
				]
			]
		);

		$this->add_control(
			'weather_value_round',
			[
				'label'   => esc_html__( 'Round Number', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_weather',
			[
				'label' => esc_html__( 'Weather', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-weather' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-weather [class*="bdtw-"]' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tiny_text_typography',
				'selector' => '{{WRAPPER}} .bdt-weather',
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

		

		$this->add_control(
			'forecast_border',
			[
				'label' => __( 'Border', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				// 'selectors' => [
				// 	'{{WRAPPER}} .bdt-weather .bdt-wf-divider>li:nth-child(n+2)' => 'border-style: solid',
				// ],
			]
		);

		$this->add_control(
			'forecast_border_style',
			[
				'label'   => esc_html__( 'Border Style', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'  => esc_html__( 'Solid', 'bdthemes-element-pack' ),
					'dotted' => esc_html__( 'Dotted', 'bdthemes-element-pack' ),
					'dashed' => esc_html__( 'Dashed', 'bdthemes-element-pack' ),
					'double' => esc_html__( 'Double', 'bdthemes-element-pack' ),
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-weather .bdt-wf-divider>li:nth-child(n+2)' => 'border-top-style: {{VALUE}}',
				],
				'condition' => [
					'forecast_border' => 'yes',
				],
			]
		);

		$this->add_control(
			'forecast_border_color',
			[
				'label' => __( 'Border Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-weather .bdt-wf-divider>li:nth-child(n+2)' => 'border-top-color: {{VALUE}}',
				],
				'condition' => [
					'forecast_border' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'forecast_border_width',
			[
				'label' => __( 'List Space', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-weather .bdt-wf-divider>li:nth-child(n+2)' => 'margin-top: {{SIZE}}{{UNIT}}; padding-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'forecast_border' => 'yes',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_location',
			[
				'label'     => esc_html__( 'Tiny Style', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'view' => 'tiny'
				]
			]
		);


		$this->add_control(
			'tiny_location_color',
			[
				'label'     => esc_html__( 'Location Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.bdt-weather-layout-tiny .bdt-weather .bdt-weather-city-name' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'tiny_temp_color',
			[
				'label'     => esc_html__( 'Tempareture Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.bdt-weather-layout-tiny .bdt-weather .bdt-weather-today-temp' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'tiny_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.bdt-weather-layout-tiny .bdt-weather .bdt-weather-today-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tiny_weather_desc',
			[
				'label'     => esc_html__( 'Description Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.bdt-weather-layout-tiny .bdt-weather .bdt-weather-today-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings           = $this->get_settings_for_display();

		$this->weather_data = $this->weather_data();		

		$this->add_render_attribute( 'weather', 'class', 'bdt-weather' );
		//$this->add_render_attribute( 'weather', 'class', 'bdt-weather-layout-' . $settings['view'] );

		?>

		<div <?php echo $this->get_render_attribute_string('weather'); ?>>
			<div class="bdt-weather-container">

				<?php if ( 'full' == $settings['view'] or 'simple' == $settings['view'] or 'today' == $settings['view'] ) : ?>
					<?php $this->render_weather_today(); ?>
				<?php elseif ( 'tiny' == $settings['view'] ) : ?>
					<?php $this->render_weather_tiny(); ?>
				<?php endif; ?>
				
				<?php //if ( 'full' == $settings['view'] or 'forecast' == $settings['view'] ) : ?>
					<?php //$this->render_weather_forecast(); ?>
				<?php //endif; ?>

			</div>
		</div>

		<?php
	}


	public function render_weather_today() {
		$settings   = $this->get_settings_for_display();
		$data       = $this->weather_data;
		$speed_unit = ( 'metric' === $settings['units'] ) ? esc_html_x( 'km/h', 'Weather String', 'bdthemes-element-pack' ) : esc_html_x( 'm/h', 'Weather String', 'bdthemes-element-pack' );
		$speed      = ( 'metric' === $settings['units'] ) ? $data['today']['wind_speed']['kph'] : $data['today']['wind_speed']['mph'];

		?>

		<div class="bdt-weather-today">
			<?php if ( 'yes' == $settings['show_city'] or 'yes' == $settings['show_country'] or 'yes' == $settings['show_temperature'] or 'yes' == $settings['show_today_name'] ) : ?>
			<div class="bdt-grid bdt-grid-collapse bdt-flex bdt-flex-middle">
				
				<div class="bdt-width-3-5">
						
					<?php $this->render_weather_title(); ?>
		
					<?php if ( 'yes' == $settings['show_temperature'] ) : ?>
						<div class="bdt-weather-today-temp"><?php echo $this->weather_temperature( $data['today']['temp'] ); ?></div>
					<?php endif; ?>
					
					<?php if ( 'yes' == $settings['show_today_name'] ) : ?>
						<div class="bdt-weather-today-name"><?php echo esc_html($data['today']['week_day']); ?></div>
					<?php endif; ?>
				</div>
				
				<?php if ( 'yes' == $settings['show_weather_icon'] ) : ?>
				<div class="bdt-width-2-5 bdt-text-center">
					<div class="bdt-width-1-1">
						<div class="bdt-weather-today-icon"><?php echo $this->weather_icon( $data['today']['code'] ); ?></div>
						
						<?php if ( 'yes' == $settings['show_weather_condition_name'] ) : ?>
							<div class="bdt-weather-today-desc"><?php echo $this->weather_desc( $data['today']['code'] ); ?></div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				
			</div>
			<?php else : ?>
				<div class="bdt-text-center">
					<div class="bdt-weather-today-icon"><?php echo $this->weather_icon( $data['today']['code'] ); ?></div>
					<?php if ( 'yes' == $settings['show_weather_condition_name'] ) : ?>
						<div class="bdt-weather-today-desc"><?php echo $this->weather_desc( $data['today']['code'] ); ?></div>
					<?php endif; ?>
					
				</div>
			<?php endif; ?>

		</div>
		<?php if ( 'yes' === $settings['weather_details'] ) : ?>
			<div class="bdt-weather-details bdt-grid bdt-grid-collapse">
				<div class="bdt-width-1-3">
					<div class="bdt-weather-today-humidity">
						<span class="bdtw-humidity"></span>
						<?php echo esc_html($data['today']['humidity']); ?>
					</div>
				</div>
				<div class="bdt-width-1-3">
					<div class="bdt-weather-today-pressure">
						<span class="bdtw-pressure"></span>
						<?php echo $this->get_weather_pressure( $data['today']['pressure'] ); ?>
					</div>
				</div>
				<div class="bdt-width-1-3">
					<div class="bdt-weather-today-wind">
						<span class="bdtw-<?php echo element_pack_wind_code( $data['today']['wind_deg'] ); ?>"></span>
						<?php echo esc_html($speed) .' '. esc_html($speed_unit); ?>
					</div>
				</div>
			</div>
		<?php endif;
	}

	public function render_weather_tiny() {
		$settings = $this->get_settings_for_display();
		$data     = $this->weather_data;
		?>
		
		<?php if ( 'yes' == $settings['show_city'] ) : ?>
			<span class="bdt-weather-city-name"><?php echo $this->weather_data['location']['city']; ?></span>
		<?php endif; ?>

		<?php if ( 'yes' == $settings['show_temperature'] ) : ?>
			<span class="bdt-weather-today-temp"><?php echo $this->weather_temperature( $data['today']['temp'] ); ?></span>
		<?php endif; ?>

		<?php if ( 'yes' == $settings['show_weather_icon'] ) : ?>
			<span class="bdt-weather-today-icon"><?php echo $this->weather_icon( $data['today']['code'] ); ?></span>
		<?php endif; ?>
		<?php if ( 'yes' == $settings['show_weather_desc'] ) : ?>
			<span class="bdt-weather-today-desc"><?php echo $this->weather_desc( $data['today']['code'] ); ?></span>
		<?php endif; ?>

		<?php
	}

	public function render_weather_title() {
		$settings = $this->get_settings_for_display();
		$data     = $this->weather_data;
		?>
		<?php if ( 'yes' == $settings['show_city'] or 'yes' == $settings['show_country'] ) : ?>
			<div class="bdt-weather-title">
				<?php if ( 'yes' == $settings['show_city'] ) : ?>
					<span class="bdt-weather-city-name"><?php echo $this->weather_data['location']['city']; ?></span>
				<?php endif; ?>

				<?php if ( 'yes' == $settings['show_country'] ) : ?>
					<span class="bdt-weather-country-name">
						
						<?php if ( $settings['country'] ) : ?>
							<?php echo esc_html($settings['country']); ?>
						<?php else : ?>
							<?php echo $this->weather_data['location']['country']; ?>
						<?php endif; ?>

					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php
	}

	public function render_weather_forecast() {
		$settings = $this->get_settings_for_display();
		$data     = $this->weather_data;

		$forecast_data = $data['forecast'];

		if ( 'forecast' === $settings['view'] ) {
			array_unshift( $forecast_data, array(
				'code'     => $data['today']['code'],
				'temp_min' => $data['today']['temp_min'],
				'temp_max' => $data['today']['temp_max'],
				'week_day' => $data['today']['week_day'],
			));
		}

		$forecast_days = intval($settings['forecast']['size']);
		$forecast_days = ( $forecast_days <= 5 ) ? $forecast_days : 5;


		?>
		
		<?php if ( 'forecast' == $settings['view'] ) : ?>
			<?php $this->render_weather_title(); ?>
		<?php endif; ?>

		<ul class="bdt-weather-forecast bdt-list bdt-wf-divider"><?php
			for ( $i = 0; $i < $forecast_days; $i ++ ) { ?>
				<li class="bdt-weather-forecast-item">
					<div class="bdt-grid bdt-grid-collapse">
						<div class="bdt-wf-day bdt-width-1-4">
							<?php echo esc_html($forecast_data[ $i ]['week_day']); ?>
						</div>
						<div class="bdt-wf-icon bdt-width-1-4 bdt-text-center" title="<?php echo esc_attr( $this->weather_desc( $forecast_data[ $i ]['code'] ) ); ?>">
							<?php echo $this->weather_icon( $forecast_data[ $i ]['code'], true ); ?>
						</div>
						<div class="bdt-wf-max-temp bdt-width-1-4 bdt-text-center">
							<?php echo $this->weather_temperature( $forecast_data[ $i ]['temp_max'] ); ?>
						</div>
						<div class="bdt-wf-min-temp bdt-width-1-4 bdt-text-right">
							<?php echo $this->weather_temperature( $forecast_data[ $i ]['temp_min'] ); ?>
						</div>
					</div>
				</li>
			<?php }
		?></ul>

		<?php
	}

	public function weather_data() {

		$ep_api_settings = get_option( 'element_pack_api_settings' );
		$api_key = !empty($ep_api_settings['weatherstack_api_key']) ? $ep_api_settings['weatherstack_api_key'] : '';


		// return error message when api key not found
		if ( ! $api_key ) {

			$message = esc_html__( 'Ops! I think you forget to set API key in Element Pack API settings.', 'bdthemes-element-pack' );

			$this->weather_error_notice($message);

			return false;
		}

		$settings = $this->get_settings_for_display();
		$location = $settings['location'];

		if ( empty( $location ) ) {
			return false;
		}

		$transient_key = sprintf( 'bdt-weather-data-%s', md5( $location ) );

		$data = get_transient( $transient_key );

		if ( ! $data ) {
			// Prepare request data
			$location = esc_attr( $location );
			$api_key  = esc_attr( $api_key );

			$request_args = array(
				'access_key'    => $api_key,
				'query'         => urlencode( $location ),
				'forecast_days' => 6,
				'hourly'        => 1,
				'units'         => ''
			);

			$request_url = add_query_arg(
				$request_args,
				$this->weather_api_current_url
			);

			$weather = $this->weather_remote_request( $request_url );

			if ( ! $weather ) {
				return false;
			}

			if ( isset( $weather['error'] ) ) {

				if ( isset( $weather['error']['message'] ) ) {
					$message = $weather['error']['message'];
				} else {
					$message = esc_html__( 'Weather data of this location not found.', 'bdthemes-element-pack' );
				}

				echo $this->weather_error_notice( $message );
				return false;
			}

			$data = $this->transient_weather( $weather );

			if ( empty( $data ) ) {
				return false;
			}

			set_transient( $transient_key, $data, apply_filters( 'element-pack/weather/cached-time', HOUR_IN_SECONDS ) );

			return $data;

		}

		return $data;
	}

	public function weather_remote_request( $url ) {

		$response = wp_remote_get( $url, array( 'timeout' => 30 ) );

		if ( ! $response || is_wp_error( $response ) ) {
			return false;
		}

		$remote_data = wp_remote_retrieve_body( $response );

		if ( ! $remote_data || is_wp_error( $remote_data ) ) {
			return false;
		}

		$remote_data = json_decode( $remote_data, true );

		if ( empty( $remote_data ) ) {
			return false;
		}

		return $remote_data;
	}

	public function transient_weather( $weather = [] ) {

		$data = array(
			'location' => array(
				'city'    => $weather['location']['name'],
				'country' => $weather['location']['country'],
			),
			'today' => array(
				'code'   => $weather['current']['weather_code'],
				//'is_day' => $weather['current']['is_day'],

				'temp' => $weather['current']['temperature'],
				// 'temp_min' => array(
				// 	'c' => round( $weather['forecast']['forecastday'][0]['day']['mintemp_c'] ),
				// 	'f' => round( $weather['forecast']['forecastday'][0]['day']['mintemp_f'] ),
				// ),
				// 'temp_max' => array(
				// 	'c' => round( $weather['forecast']['forecastday'][0]['day']['maxtemp_c'] ),
				// 	'f' => round( $weather['forecast']['forecastday'][0]['day']['maxtemp_f'] ),
				// ),
				'wind_speed' => array(
					'mph' => $weather['current']['wind_speed'],
					'kph' => $weather['current']['wind_speed'],
				),
				'wind_deg' => $weather['current']['wind_degree'],
				'wind_dir' => $weather['current']['wind_dir'],

				'humidity' => $weather['current']['humidity'] . '%',
				'pressure' => $weather['current']['pressure'],

				'week_day' => date_i18n( 'l' ),
			),
			'forecast' => [],
		);

//		for ( $i = 1; $i <= 5; $i ++ ) {
//			$data['forecast'][] = array(
//				'code'     => $weather['forecast']['forecastday'][ $i ]['day']['condition']['code'],
//				'week_day' => $this->readable_week( 'Y-m-d', $weather['forecast']['forecastday'][ $i ]['date'] ),
//				'temp_min' => array(
//					'c' => round( $weather['forecast']['forecastday'][ $i ]['day']['mintemp_c'] ),
//					'f' => round( $weather['forecast']['forecastday'][ $i ]['day']['mintemp_f'] ),
//				),
//				'temp_max' => array(
//					'c' => round( $weather['forecast']['forecastday'][ $i ]['day']['maxtemp_c'] ),
//					'f' => round( $weather['forecast']['forecastday'][ $i ]['day']['maxtemp_f'] ),
//				),
//			);
//		}

		return $data;
	}

	public function readable_week( $format = '', $date = '' ) {
		$date = date_create_from_format( $format, $date );
		return date_i18n( 'l', date_timestamp_get( $date ) );
	}

	public function weather_desc( $code, $is_day = true ) {
		$desc = element_pack_weather_code( $code, 'desc', $is_day );

		if ( empty( $desc ) ) { return []; }

		return $desc;
	}

	public function weather_temperature( $temp ) {
		$units     = $this->get_settings_for_display( 'units' );
		$temp_unit = ( 'metric' === $units ) ? '&#176;C' : '&#176;F';

		if ( is_array( $temp ) ) {
			$temp = ( 'metric' === $units ) ? $temp['c'] : $temp['f'];
		}
		$temp = ( 'metric' === $units ) ? $temp : (( $temp * 1.8 ) + 32 ); //°F = °C × 1,8 + 32
		
		$temp_format = apply_filters( 'element-pack/weather/temperature-format', '%1$s%2$s' );

		$settings           = $this->get_settings_for_display();
		($settings['weather_value_round']) == 'yes'  ? $temp = round($temp) :  $temp;
		
		return sprintf( $temp_format, $temp, $temp_unit );
	}

	public function get_weather_pressure( $pressure ) {
		$units = $this->get_settings_for_display( 'units' );

		if ( is_array( $pressure ) ) {
			$pressure = ( 'metric' === $units ) ? $pressure['mb'] : $pressure['in'];
		}

		$format = apply_filters( 'element-pack/weather/pressure-format', '%s' );

		return sprintf( $format, $pressure );
	}

	public function weather_icon( $icon, $is_day = true ) {

		$icon = element_pack_weather_code( $icon, 'icon' );
		$time = ($is_day) ? 'd' : 'n';

		$icon_class   = [];
		$icon_class[] = sprintf( 'bdtw-%s', esc_attr( $icon ) );

		return sprintf( '<span class="%1$s%2$s"></span>', implode(' ', $icon_class), $time );
	}

	public function weather_error_notice($message) {
		?>

		<div class="bdt-alert-warning" bdt-alert>
		    <a class="bdt-alert-close" bdt-close></a>
		    <p><?php echo esc_html($message); ?></p>
		</div>
		<?php
	}


}
