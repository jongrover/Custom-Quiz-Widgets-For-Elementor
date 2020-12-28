<?php
/**
 * Yoast SEO Video plugin file.
 *
 * @package Yoast\VideoSEO
 */

/**
 * Presenter for presenting the video's type as an opengraph meta tag.
 */
class WPSEO_Video_Type_Presenter extends WPSEO_Video_Abstract_Tag_Presenter {

	/**
	 * The tag format including placeholders.
	 *
	 * @var string
	 */
	protected $tag_format = '<meta property="og:video:type" content="%s" />';

	/**
	 * @inheritDoc
	 */
	public function get() {
		return 'text/html';
	}
}
