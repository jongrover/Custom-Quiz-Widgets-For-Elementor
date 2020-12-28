<?php
namespace ElementPack\Modules\CryptoCurrency\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CryptoCurrencyPriceMarquee extends Widget_Base {

	protected $_has_template_content = false;

	public function get_name() {
		return 'bdt-crypto-currency-price-marquee';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Crypto Currency Price Marquee', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-cryptocurrency-marquee';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'cryptocurrency', 'crypto', 'currency', 'table', 'price', 'marquee' ];
	}

	// public function get_script_depends() {
	// 	return [ 'crypto-currency-price-marquee' ];
	// }

	public function get_style_depends() {
		return ['bdt-crypto-currency'];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/TnSjwUKrw00';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content_cryptocurrency',
			[
				'label' => esc_html__( 'Crypto Currency', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'crypto_currency',
			[
				'label'       => __( 'Crypto Currency', 'bdthemes-element-pack' ),
				'description'       => __( 'If you want to show any selected crypto currency in your table so type those currency name here. For example: bitcoin,ethereum,litecoin', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'bitcoin,ethereum' , 'bdthemes-element-pack' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'currency',
			[
				'label'       => __( 'Currency', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'usd' , 'bdthemes-element-pack' ),
				'placeholder' => __( 'usd' , 'bdthemes-element-pack' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);


		$this->end_controls_section();

		
		//Style

		$this->start_controls_section(
			'section_cryptocurrency_card_style',
			[
				'label' => __( 'CryptoCurrency Marquee', 'bdthemes-element-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

		$this->add_control(
			'cryptocurrency_marquee_background_color',
			[
				'label' => __( 'Background Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-price-marquee' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render_coin_api() {
		$settings        = $this->get_settings_for_display();
		$id              = $this->get_id();
		$crypto_currency = ($settings['crypto_currency']) ? $settings['crypto_currency'] : false;

		$api_url = 'https://api.coingecko.com/api/v3/coins/markets';


		// Parameters as array of key => value pairs
		$final_query =  add_query_arg( 
		    array( 
		        'vs_currency' => strtolower($settings['currency']),
		        'order'       => false, //market_cap_desc
		        'per_page'    => 1, //limit
		        'page'        => 1,
		        'sparkline'   => 'false',
		        'ids'         => $crypto_currency,
		        
		    ), 
		    $api_url
		);

		$request = wp_remote_get($final_query, array('timeout' => 120));
		
		if (is_wp_error($request)) {
			return false; // Bail early
		}
		
		$body = wp_remote_retrieve_body($request);
		$coins = json_decode($body,true);
		
		$saved_coins = get_transient( 'element-pack-ccc' );

		if (false == $saved_coins) {
			set_transient( 'element-pack-ccc', $coins, 5 * MINUTE_IN_SECONDS );
			$coins = get_transient( 'element-pack-ccc' );
		}

		return $coins;

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id       = $this->get_id();
		$coins    = $this->render_coin_api();
		$currency = $settings['currency'];
		$currency_symbol = element_pack_currency_symbol($settings['currency']);
		$crypto_currency = ($settings['crypto_currency']) ? $settings['crypto_currency'] : false;
		$locale = explode('-', get_bloginfo('language'));
		$locale = $locale[0];

		if ($settings['crypto_currency']) {
			$this->add_render_attribute('cc-price-marquee', 'coin-ids', esc_attr( $settings['crypto_currency'] ) );
		}
		$this->add_render_attribute('cc-price-marquee', 'currency', esc_attr( $settings['currency'] ) );
		if ($settings['cryptocurrency_marquee_background_color']) {
			$this->add_render_attribute('cc-price-marquee', 'background-color', esc_attr( $settings['cryptocurrency_marquee_background_color'] ) );
		}
		$this->add_render_attribute('cc-price-marquee', 'locale', $locale );
	   	
		?>
		<div class="bdt-crypto-currency-price-marquee">
			
			<coingecko-coin-price-marquee-widget  <?php echo $this->get_render_attribute_string( 'cc-price-marquee' ); ?>></coingecko-coin-price-marquee-widget>

		</div>
     
		<?php
	}
}

