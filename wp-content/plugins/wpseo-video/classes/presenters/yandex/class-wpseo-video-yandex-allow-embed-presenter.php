<?php
/**
 * Yoast SEO Video plugin file.
 *
 * @package Yoast\VideoSEO
 */

/**
 * Presenter for presenting the `allow_embed` property, as a Yandex meta tag.
 */
class WPSEO_Video_Yandex_Allow_Embed_Presenter extends WPSEO_Video_Abstract_Tag_Presenter {

	/**
	 * The tag format including placeholders.
	 *
	 * @var string
	 */
	protected $tag_format = '<meta property="ya:ovs:allow_embed" content="%s" />';

	/**
	 * @inheritDoc
	 */
	public function get() {
		return 'true';
	}
}
