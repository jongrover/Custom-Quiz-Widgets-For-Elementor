<?php
/**
 * Yoast SEO Video plugin file.
 *
 * @package Yoast\VideoSEO
 */

/**
 * Presenter for presenting the video's width as an opengraph meta tag.
 */
class WPSEO_Video_Width_Presenter extends WPSEO_Video_Abstract_Tag_Presenter {

	/**
	 * The tag format including placeholders.
	 *
	 * @var string
	 */
	protected $tag_format = '<meta property="og:video:width" content="%s" />';

	/**
	 * @inheritDoc
	 */
	public function get() {
		if ( ! isset( $this->video['width'] ) ) {
			return '';
		}
		return (string) $this->video['width'];
	}
}
