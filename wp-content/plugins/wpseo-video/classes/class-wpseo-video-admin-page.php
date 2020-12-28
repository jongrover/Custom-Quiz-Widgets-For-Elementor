<?php
/**
 * Yoast SEO Video plugin file.
 *
 * @package    Internals
 * @since      1.6.0
 * @version    1.6.0
 */

// Avoid direct calls to this file.
if ( ! class_exists( 'WPSEO_Video_Sitemap' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * Class for rendering the admin page.
 *
 * @package WordPress SEO Video
 * @since   12.4
 */
class WPSEO_Video_Admin_Page {

	/**
	 * Renders the admin page.
	 *
	 * @param string $sitemap_url The url to the sitemap.
	 */
	public function display( $sitemap_url ) {
		if ( $this->is_video_page( filter_input( INPUT_GET, 'page' ) ) ) {
			add_action( 'wpseo_admin_footer', array( $this, 'reindex_videos_form' ) );
			$this->register_i18n_promo_class();
		}

		Yoast_Form::get_instance()->admin_header( true, 'wpseo_video' );

		if ( isset( $_POST['reindex'] ) ) {
			/*
			 * Load the reindex page, shows a progressbar and sents ajax calls to the server with
			 * small amounts of posts to reindex.
			 */
			require plugin_dir_path( WPSEO_VIDEO_FILE ) . 'views/reindex-page.php';
		}
		else {
			if ( WPSEO_Options::get( 'enable_xml_sitemap', false ) !== true ) {
				printf(
					'<p>%s</p>',
					sprintf(
					/* translators: 1: link open tag; 2: link close tag. */
						esc_html__( 'Please enable the XML sitemap under the SEO -> %1$sFeatures%2$s settings', 'yoast-video-seo' ),
						'<a href="' . esc_url( add_query_arg( array( 'page' => 'wpseo_dashboard' ), admin_url( 'admin.php' ) ) . '#top#features' ) . '">',
						'</a>'
					)
				);
			}
			else {
				echo '<h2>' . esc_html__( 'General Settings', 'yoast-video-seo' ) . '</h2>';
				if ( $sitemap_url !== null ) {
					echo '<p>' . esc_html__( 'Please find your video sitemap here:', 'yoast-video-seo' ) . ' <a target="_blank" href="' . esc_url( $sitemap_url ) . '">' . esc_html__( 'XML Video Sitemap', 'yoast-video-seo' ) . '</a></p>';
				}
				else {
					echo '<div class="notice notice-warning"><p>' . esc_html__( 'Select at least one post type to enable the video sitemap.', 'yoast-video-seo' ) . '</p></div>';
				}

				Yoast_Form::get_instance()->checkbox( 'video_cloak_sitemap', esc_html__( 'Hide the sitemap from normal visitors?', 'yoast-video-seo' ) );
				Yoast_Form::get_instance()->checkbox( 'video_disable_rss', esc_html__( 'Disable Media RSS Enhancement', 'yoast-video-seo' ) );
				echo '<br class="clear"/>';

				Yoast_Form::get_instance()->textinput( 'video_custom_fields', esc_html__( 'Custom fields', 'yoast-video-seo' ) );
				echo '<p class="clear description desc label">' . esc_html__( 'Custom fields the plugin should check for video content (comma separated)', 'yoast-video-seo' ) . '</p>';
				Yoast_Form::get_instance()->textinput( 'video_embedly_api_key', esc_html__( '(Optional) Embedly API Key', 'yoast-video-seo' ) );
				/* translators: 1,3: link open tag; 2: link close tag. */
				echo '<p class="clear description desc label">' . sprintf( esc_html__( 'The video SEO plugin provides where possible enriched information about your videos. A lot of %1$svideo services%2$s are supported by default. For those services which aren\'t supported, we can try to retrieve enriched video information using %3$sEmbedly%2$s. If you want to use this option, you\'ll need to sign up for a (free) %3$sEmbedly%2$s account and provide the API key you receive.', 'yoast-video-seo' ), '<a href="' . esc_url( WPSEO_Shortlinker::get( 'https://yoa.st/video-hosting' ) ) . '">', '</a>', '<a href="http://embed.ly/">' ) . '</p>';


				echo '<h2>' . esc_html__( 'Embed Settings', 'yoast-video-seo' ) . '</h2>';

				Yoast_Form::get_instance()->checkbox( 'video_facebook_embed', esc_html__( 'Allow videos to be played directly on other websites, such as Facebook or Twitter?', 'yoast-video-seo' ) );
				/* translators: 1: link open tag, 2: link close tag. */
				Yoast_Form::get_instance()->checkbox( 'video_fitvids', sprintf( esc_html__( 'Try to make videos responsive using %1$sFitVids.js%2$s?', 'yoast-video-seo' ), '<a href="http://fitvidsjs.com/">', '</a>' ) );
				echo '<br class="clear"/>';

				Yoast_Form::get_instance()->textinput( 'video_content_width', esc_html__( 'Content width', 'yoast-video-seo' ) );
				echo '<p class="clear description desc label">' . esc_html__( 'This defaults to your themes content width, but if it\'s empty, setting a value here will make sure videos are embedded in the right width.', 'yoast-video-seo' ) . '</p>';

				Yoast_Form::get_instance()->textinput( 'video_wistia_domain', esc_html__( 'Wistia domain', 'yoast-video-seo' ) );
				echo '<p class="clear description desc label">' . esc_html__( 'If you use Wistia in combination with a custom domain, set this to the domain name you use for your Wistia videos, no http: or slashes needed.', 'yoast-video-seo' ) . '</p>';


				echo '<h2>' . esc_html__( 'Post Types for which to enable the Video SEO plugin', 'yoast-video-seo' ) . '</h2>';
				echo '<p>' . esc_html__( 'Determine which post types on your site might contain video.', 'yoast-video-seo' ) . '</p>';


				$post_types      = get_post_types( array( 'public' => true ), 'objects' );
				$post_types_list = [];
				foreach ( $post_types as $post_type ) {
					$post_types_list[ $post_type->name ] = $post_type->labels->name;
				}

				Yoast_Form::get_instance()->checkbox_list( 'videositemap_posttypes', $post_types_list );

				echo '<h2>' . esc_html__( 'Taxonomies to include in XML Video Sitemap', 'yoast-video-seo' ) . '</h2>';
				echo '<p>' . esc_html__( 'You can also include your taxonomy archives, for instance, if you have videos on a category page.', 'yoast-video-seo' ) . '</p>';

				$taxonomies      = get_taxonomies( array( 'public' => true ), 'objects' );
				$taxonomies_list = [];
				foreach ( $taxonomies as $taxonomy ) {
					$taxonomies_list[ $taxonomy->name ] = $taxonomy->labels->name;
				}

				Yoast_Form::get_instance()->checkbox_list( 'videositemap_taxonomies', $taxonomies_list );
			}
		}
		// Add debug info.
		Yoast_Form::get_instance()->admin_footer( true, false );
	}

	/**
	 * Adds the reindexing form for videos.
	 */
	public function reindex_videos_form() {
		?>
		<h2><?php esc_html_e( 'Indexation of videos in your content', 'yoast-video-seo' ); ?></h2>

		<p style="max-width: 600px;"><?php esc_html_e( 'This process goes through all the post types specified by you, as well as the terms of each taxonomy, to check for videos in the content. If the plugin finds a video, it updates the metadata for that piece of content, so it can add that metadata and content to the XML Video Sitemap.', 'yoast-video-seo' ); ?></p>

		<p style="max-width: 600px;"><?php esc_html_e( 'By default the plugin only checks content that hasn\'t been checked yet. However, if you check \'Force Re-Index\', it will re-check all content. This is particularly interesting if you want to check for a video embed code that wasn\'t supported before, or if you want to update thumbnail images en masse.', 'yoast-video-seo' ); ?></p>

		<form method="post" action="">

			<input class="checkbox double" type="checkbox" name="force" id="force">
			<label class="checkbox"
				for="force"><?php esc_html_e( 'Force reindex of already indexed videos.', 'yoast-video-seo' ); ?></label><br/>
			<p class="submit">
				<input type="submit" class="button" name="reindex"
					value="<?php esc_html_e( 'Re-Index Videos', 'yoast-video-seo' ); ?>"/>
			</p>
		</form>
		<?php
	}

	/**
	 * Checks if the current page is a video seo plugin page.
	 *
	 * @param string $page The page to check for.
	 *
	 * @return bool
	 */
	private function is_video_page( $page ) {
		$video_pages = array( 'wpseo_video' );

		return in_array( $page, $video_pages, true );
	}

	/**
	 * Register the promotion class for our GlotPress instance
	 *
	 * @link https://github.com/Yoast/i18n-module
	 */
	private function register_i18n_promo_class() {
		new Yoast_I18n_v3(
			array(
				'textdomain'     => 'yoast-video-seo',
				'project_slug'   => 'yoast-video-seo',
				'plugin_name'    => 'Yoast SEO: Video',
				'hook'           => 'wpseo_admin_promo_footer',
				'glotpress_url'  => 'http://translate.yoast.com/gp/',
				'glotpress_name' => 'Yoast Translate',
				'glotpress_logo' => 'http://translate.yoast.com/gp-templates/images/Yoast_Translate.svg',
				'register_url'   => 'http://translate.yoast.com/gp/projects#utm_source=plugin&utm_medium=promo-box&utm_campaign=wpseo-video-i18n-promo',
			)
		);
	}
}
