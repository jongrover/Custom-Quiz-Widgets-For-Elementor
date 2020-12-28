<?php
/**
 * Yoast SEO Video plugin file.
 *
 * @package Yoast\VideoSEO
 */

/**
 * Presenter for presenting the video's location as an opengraph meta tag.
 */
class WPSEO_Video_Location_Presenter extends WPSEO_Video_Abstract_Tag_Presenter {

	/**
	 * The tag format including placeholders.
	 *
	 * @var string
	 */
	protected $tag_format = '<meta property="og:video" content="%s" />';

	/**
	 * @inheritDoc
	 */
	public function get() {
		return $this->video['player_loc'];
	}
}
