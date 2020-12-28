<?php
/**
 * Yoast SEO Video plugin file.
 *
 * @package Yoast\VideoSEO
 */

/**
 * Presenter for presenting the video's duration as an opengraph meta tag.
 */
class WPSEO_Video_Duration_Presenter extends WPSEO_Video_Abstract_Tag_Presenter {

	/**
	 * The tag format including placeholders.
	 *
	 * @var string
	 */
	protected $tag_format = '<meta property="og:video:duration" content="%s" />';

	/**
	 * @inheritDoc
	 */
	public function get() {
		if ( $this->video['duration'] === 0 ) {
			return '';
		}
		return (string) $this->video['duration'];
	}
}
