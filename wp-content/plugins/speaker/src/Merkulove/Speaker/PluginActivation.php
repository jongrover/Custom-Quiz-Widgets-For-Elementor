<?php
/**
 * Create an audio version of your posts, with a selection of more than 235+ voices across more than 40 languages and variants.
 * Exclusively on Envato Market: https://1.envato.market/speaker
 *
 * @encoding        UTF-8
 * @version         3.1.0
 * @copyright       Copyright (C) 2018 - 2020 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Alexander Khmelnitskiy (info@alexander.khmelnitskiy.ua), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 **/

namespace Merkulove\Speaker;

use Merkulove\Speaker;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class used to implement Activation tab on plugin settings page.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 */
final class PluginActivation {

	/**
	 * The one true PluginActivation.
	 *
	 * @var PluginActivation
	 * @since 1.0.0
	 **/
	private static $instance;

	/**
	 * Display Activation Status.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function display_status() {

		$activation_tab = admin_url( 'admin.php?page=mdp_speaker_settings&tab=activation' );
		?>

        <hr class="mdc-list-divider">
        <h6 class="mdc-list-group__subheader"><?php esc_html_e( 'CodeCanyon License', 'speaker' ); ?></h6>

		<?php if ( $this->is_activated() ) : ?>
            <a class="mdc-list-item mdc-activation-status activated" href="<?php echo esc_url( $activation_tab ); ?>">
                <i class='material-icons mdc-list-item__graphic' aria-hidden='true'>check_circle</i>
                <span class="mdc-list-item__text"><?php esc_html_e( 'Activated', 'speaker' ); ?></span>
            </a>
		<?php else : ?>
            <a class=" mdc-list-item mdc-activation-status not-activated" href="<?php echo esc_url( $activation_tab ); ?>">
                <i class='material-icons mdc-list-item__graphic' aria-hidden='true'>remove_circle</i>
                <span class="mdc-list-item__text"><?php esc_html_e( 'Not Activated', 'speaker' ); ?></span>
            </a>
		<?php endif;

	}

	/**
	 * Return Activation Status.
	 *
	 * @since 1.0.0
	 * @access public
     *
     * @return boolean true if activated.
	 **/
	public function is_activated() {

        /** Not activated if plugin don't have Envato ID. */
        if ( ! EnvatoItem::get_instance()->get_id() ) { return false; }

        $purchase_code = $this->get_purchase_code();

        /** Not activated if we don't have Purchase Code. */
		if ( false === $purchase_code ) { return false; }

        /** Do we have activation in cache? */
        $cache = new Cache();
        $key = 'activation_' . $purchase_code;
        $cached_activation = $cache->get( $key, true );

        /** Use activation from cache. */
        if ( ! empty( $cached_activation ) ) {

            $cached_activation = json_decode( $cached_activation, true );

            return (bool)$cached_activation[$key];

        }

		/** If no cached activation, go to remote check. */
        $activated = $this->remote_validation( $purchase_code );

        /** Store remote validation result for 12 h. */
        $cache->set( $key, [$key => $activated], false );

        return filter_var( $activated, FILTER_VALIDATE_BOOLEAN );

    }

    /**
     * Validate PID on our server.
     *
     * @param string $purchase_code - Envato Purchase Code for Item.
     *
     * @return bool
     **/
    private function remote_validation( $purchase_code ) {

        /** Prepare URL. */
        $url = $this->prepare_url( $purchase_code );

        /** Download JSON file with purchase code validation status true/false. */
        $json = wp_remote_get( $url, [
            'timeout' => 15,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ] );

        /** We’ll check whether the answer is correct. */
        if ( is_wp_error( $json ) ) { return false; }

        /** Have answer with wrong code. */
        if ( wp_remote_retrieve_response_code( $json ) !== 200 ) { return false; }

        $valid = json_decode( $json['body'], true );

        return true === $valid;

    }

    /**
     * Return Item Purchase Code.
     *
     * @since  3.0.4
     * @access public
     *
     * @return false|string
     **/
    private function get_purchase_code() {

        /** CodeCanyon Item ID. */
        $plugin_id = EnvatoItem::get_instance()->get_id();

        /** In this option we store purchase code. */
        $opt_purchase_code = 'envato_purchase_code_' . $plugin_id;

        /** Get fresh PID from settings form. */
        if ( isset( $_POST[$opt_purchase_code] ) ) {

            $purchase_code = filter_input( INPUT_POST, $opt_purchase_code );

        } else {

            /** Or get PID from option. */
            $purchase_code = get_option( $opt_purchase_code );

        }

        /** If we do not have $purchase_code then nothing to check. */
        if ( ! $purchase_code ) { return false; }

        /** Clean purchase code: remove extra spaces. */
        $purchase_code = trim( $purchase_code );

        /** Make sure the code is valid before sending it to Envato. */
        if ( ! preg_match( "/^(\w{8})-((\w{4})-){3}(\w{12})$/", $purchase_code ) ) {

            /** Wrong key format. Not activated. */
            return false;

        }

        return $purchase_code;

    }

    /**
     * Prepare URL.
     *
     * @param $purchase_code - Envato Purchase Code.
     *
     * @return string
     * @since 3.0.0
     * @access private
     **/
    private function prepare_url( $purchase_code ) {

        /** Prepare URL. */
        $url = 'https://merkulove.host/wp-content/plugins/mdp-purchase-validator/src/Merkulove/PurchaseValidator/Validate.php?';
        $url .= 'action=validate&'; // Action.
        $url .= 'plugin=' . Speaker::$slug . '&'; // Plugin Name.
        $url .= 'domain=' . parse_url( site_url(), PHP_URL_HOST ) . '&'; // Domain Name.
        $url .= 'version=' . Speaker::$version . '&'; // Plugin version.
        $url .= 'pid=' . $purchase_code . '&'; // Purchase Code.
        $url .= 'admin_e=' . base64_encode( get_option( 'admin_email' ) );

        return $url;

    }

	/**
	 * Generate Activation Tab.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function add_settings() {

		/** Not show if plugin don't have Envato ID. */
		if ( ! EnvatoItem::get_instance()->get_id() ) { return; }

		/** Activation Tab. */
		register_setting( 'SpeakerActivationOptionsGroup', 'envato_purchase_code_' . EnvatoItem::get_instance()->get_id() );
		add_settings_section( 'mdp_speaker_settings_page_activation_section', '', null, 'SpeakerActivationOptionsGroup' );

	}

	/**
	 * Render Purchase Code field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function render_activation() {

		/** Not show if plugin don't have Envato ID. */
		if ( ! EnvatoItem::get_instance()->get_id() ) { return; }

		/** In this option we store Envato purchase code. */
		$opt_envato_purchase_code = 'envato_purchase_code_' . EnvatoItem::get_instance()->get_id();

		/** Get activation settings. */
		$purchase_code = get_option( $opt_envato_purchase_code );

		?>

        <div class="mdp-activation-form">

            <h3><?php esc_html_e( 'Plugin Activation', 'speaker' ); ?></h3>

            <?php
            /** Render input. */
            UI::get_instance()->render_input(
                $purchase_code,
                esc_html__( 'CodeCanyon purchase code', 'speaker'),
                esc_html__( 'Enter your CodeCanyon purchase code. Allowed only one Purchase Code per website.', 'speaker' ),
                [
                    'name' => $opt_envato_purchase_code,
                    'id' => 'mdp_envato_purchase_code'
                ]
            );
            ?>

        </div>

        <div class="mdp-activation">

            <div class="mdp-activation-faq">
				<?php $this->render_FAQ(); // Render FAQ block. ?>
            </div>

            <div class="mdp-activation-faq">
                <?php $this->render_subscribe(); ?>
            </div>

        </div>

		<?php
	}

    /**
     * Render e-sputnik Subscription Form block.
     *
     * @since 1.0.0
     * @access public
     **/
    public function render_subscribe() {
        ?>
        <div class="mdp-activation-form">

            <h3><?php esc_html_e( 'Subscribe to news', 'speaker' ); ?></h3>
            <p><?php esc_html_e( 'Sign up for the newsletter to be the first to know about news and discounts on Speaker and other WordPress plugins.', 'speaker' ); ?></p>

            <?php
            /** Render Name. */
            UI::get_instance()->render_input(
                '',
                esc_html__( 'Your Name', 'speaker'),
                '',
                [
                    'name' => 'mdp-speaker-subscribe-name',
                    'id' => 'mdp-speaker-subscribe-name'
                ]
            );

            /** Render e-Mail. */
            UI::get_instance()->render_input(
                '',
                esc_html__( 'Your E-Mail', 'speaker'),
                '',
                [
                    'name'  => 'mdp-speaker-subscribe-mail',
                    'id'    => 'mdp-speaker-subscribe-mail',
                    'type'  => 'email',
                ]
            );

            /** Render button. */
            UI::get_instance()->render_button(
                esc_html__( 'Subscribe', 'speaker' ),
                '',
                [
                    "name"  => "mdp-speaker-subscribe",
                    "id"    => "mdp-speaker-subscribe",
                    "class" => "mdp-reset"
                ],
                ''
            );
            ?>

        </div>
        <?php
    }

	/**
	 * Render FAQ block.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function render_FAQ() {
		?>
        <div class="mdc-accordion" data-mdc-accordion="showfirst: true">

            <h3><?php esc_html_e( 'Activation FAQ\'S', 'speaker' ); ?></h3>

            <div class="mdc-accordion-title">
                <i class="material-icons">help</i>
                <span class="mdc-list-item__text"><?php esc_html_e( 'Where is my Purchase Code?', 'speaker' ); ?></span>
            </div>
            <div class="mdc-accordion-content">
                <p><?php esc_html_e( 'The purchase code is a unique combination of characters that confirms that you bought the plugin. You can find your purchase code in ', 'speaker' ); ?>
                    <a href="https://1.envato.market/cc-downloads" target="_blank"><?php esc_html_e( 'your account', 'speaker' );?></a>
					<?php esc_html_e( ' on the CodeCanyon. Learn more about ', 'speaker' ); ?>
                    <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'How to find your purchase code', 'speaker' );?></a>
					<?php esc_html_e( ' .', 'speaker');?>
                </p>
            </div>

            <div class="mdc-accordion-title">
                <i class="material-icons">help</i>
                <span class="mdc-list-item__text"><?php esc_html_e( 'Can I use one Purchase Code on multiple sites?', 'speaker' ); ?></span>
            </div>
            <div class="mdc-accordion-content">
                <p>
					<?php esc_html_e( 'No, this is prohibited by license terms. You can use the purchase code on only one website at a time. Learn more about ', 'speaker' ); ?>
                    <a href="https://1.envato.market/KYbje" target="_blank"><?php esc_html_e( 'Envato License', 'speaker' );?></a>
					<?php esc_html_e( ' terms. ', 'speaker' ); ?>
                </p>
            </div>

            <div class="mdc-accordion-title">
                <i class="material-icons">help</i>
                <span class="mdc-list-item__text"><?php esc_html_e( 'What are the benefits of plugin activation?', 'speaker' ); ?></span>
            </div>
            <div class="mdc-accordion-content">
                <p>
					<?php esc_html_e( 'Activation of the plugin allows you to use all the functionality of the plugin on your site. In addition, in some cases, activating the plugin allows you to access additional features and capabilities of the plugin. Also, using an authored version of the plugin, you can be sure that you will not violate the license.', 'speaker' ); ?>
                </p>
            </div>

            <div class="mdc-accordion-title">
                <i class="material-icons">help</i>
                <span class="mdc-list-item__text"><?php esc_html_e( 'What should I do if my Purchase Code does not work?', 'speaker' ); ?></span>
            </div>
            <div class="mdc-accordion-content">
                <p>
					<?php esc_html_e( 'There are several reasons why the purchase code may not work on your site. Learn more why your ', 'speaker' ); ?>
                    <a href="https://help.market.envato.com/hc/en-us/articles/204451834-My-Purchase-Code-is-Not-Working" target="_blank"><?php esc_html_e( 'Purchase Code is Not Working', 'speaker' );?></a>
					<?php esc_html_e( ' .', 'speaker');?>
                </p>
            </div>

        </div>
		<?php
	}

	/**
	 * Main PluginActivation Instance.
	 *
	 * Insures that only one instance of PluginActivation exists in memory at any one time.
	 *
	 * @static
	 * @return PluginActivation
	 * @since 1.0.0
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class PluginActivation.
