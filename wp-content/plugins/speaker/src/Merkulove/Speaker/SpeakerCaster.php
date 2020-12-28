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

use DOMXPath;
use DOMDocument;
use Merkulove\Speaker;
use Google\ApiCore\ApiException;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class contain all Speaker logic.
 *
 * @since 3.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class SpeakerCaster {

	/**
	 * The one true SpeakerCaster.
	 *
	 * @var SpeakerCaster
	 * @since 3.0.0
	 **/
	private static $instance;

	/**
	 * Add Ajax handlers and before_delete_post action.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @return void
	 **/
	public function add_actions() {

		/** Ajax Create Audio on Backend. */
		add_action( 'wp_ajax_gspeak', [ $this, 'gspeak' ] );

		/** Ajax Remove Audio on Backend. */
		add_action( 'wp_ajax_remove_audio', [ $this, 'remove_audio' ] );

		/** Remove audio file on remove post record. */
		add_action( 'before_delete_post', [ $this, 'before_delete_post' ] );

        /** Process Speech Template Create/Update/Delete on Backend. */
        add_action( 'wp_ajax_process_st', [ $this, 'process_st' ] );

        /** Get Speech Template Data by ID. */
        add_action( 'wp_ajax_get_st', [ $this, 'get_st_ajax'] );

        /** Set Speech Template as Default. */
        add_action( 'wp_ajax_set_default_st', [ $this, 'set_default_st' ] );

    }

	/**
	 * Combine multiple audio files to one .mp3.
	 *
	 * @param $files - Audio files for gluing into one big.
	 * @param $post_id - ID of the Post/Page.
	 *
	 * @since 3.0.0
	 * @access public
     *
     * @return void
	 **/
	public function glue_audio( $files, $post_id ) {

		/** Get path to upload folder. */
		$upload_dir     = wp_get_upload_dir();
		$upload_basedir = $upload_dir['basedir'];

		/** Path to post audio file. */
		$audio_file = $upload_basedir . '/speaker/post-' . $post_id . '.mp3';

		/** Just in case, if it exist. */
		wp_delete_file( $audio_file );
		foreach ( $files as $audio ) {

			/** Add new audio part to file. */
			file_put_contents( $audio_file, file_get_contents( $audio ), FILE_APPEND );

			/** Remove temporary audio files. */
			wp_delete_file( $audio );

		}

	}

	/**
	 * Convert HTML to temporary audio file.
	 *
	 * @param $html - Content to be voiced.
	 * @param $post_id - ID of the Post/Page.
	 *
	 * @return string
	 * @throws ApiException
	 * @since 3.0.0
	 * @access public
	 **/
	public function part_speak( $html, $post_id ) {

		/**
		 * Filters html part before speak it.
		 *
		 * @since 3.0.0
		 *
		 * @param string    $html       Post content part.
		 * @param int       $post_id    Post ID.
		 **/
		$html = apply_filters( 'speaker_before_part_speak', $html, $post_id );

		/** Instantiates a client. */
		$client = new TextToSpeechClient();

		/** Strip all html tags, except SSML tags.  */
		$html = strip_tags( $html, '<p><break><say-as><sub><emphasis><prosody><voice>');

		/** Remove the white spaces from the left and right sides.  */
		$html = trim( $html );

		/** Convert HTML entities to their corresponding characters: &quot; => " */
		$html = html_entity_decode( $html );

        /**
         * Replace special characters with HTML Ampersand Character Codes.
         * These codes prevent the API from confusing text with SSML tags.
         * '&' --> '&amp;'
         **/
        $html = str_replace( '&', '&amp;', $html );

		/** Get language code and name from <voice> tag, or use default. */
		list( $lang_code, $lang_name ) = XMLHelper::get_instance()->get_lang_params_from_tag( $html );

		/** We don’t need <voice> tag anymore. */
		$html = strip_tags( $html, '<p><break><say-as><sub><emphasis><prosody>');

		/** Force to SSML. */
		$ssml = "<speak>";
		$ssml .= $html;
		$ssml .= "</speak>";
		
		/**
		 * Filters $ssml content before Google Synthesis it.
		 *
		 * @since 3.0.0
		 *
		 * @param string    $ssml       Post content part.
		 * @param int       $post_id    Post ID.
		 **/
		$ssml = apply_filters( 'speaker_before_synthesis', $ssml, $post_id );

		/** Sets text to be synthesised. */
		$synthesisInputText = ( new SynthesisInput() )->setSsml( $ssml );

		/** Build the voice request, select the language. */
		$voice = ( new VoiceSelectionParams() )
			->setLanguageCode( $lang_code )
			->setName( $lang_name );

		/** Get plugin settings. */
		$options = Settings::get_instance()->options;

		/** Select the type of audio file you want returned. */
		$audioConfig = ( new AudioConfig() )
			->setAudioEncoding( AudioEncoding::MP3 )
			->setEffectsProfileId( [ $options['audio-profile'] ] )
			->setSpeakingRate( $options['speaking-rate'] )
			->setPitch( $options['pitch'] )
            ->setSampleRateHertz( 24000 );
            //->setVolumeGainDb( $options['volume'] );

		/** Perform text-to-speech request on the text input with selected voice. */
		$response = $client->synthesizeSpeech( $synthesisInputText, $voice, $audioConfig );

		/** The response's audioContent is binary. */
		$audioContent = $response->getAudioContent();

		/** Get path to upload folder. */
		$upload_dir     = wp_get_upload_dir();
		$upload_basedir = $upload_dir['basedir'];

		/** Path to audio file. */
		$audio_file = $upload_basedir . '/speaker/tmp-' . uniqid( '', false ) . '-post-' . $post_id . '.mp3';
		file_put_contents( $audio_file, $audioContent );

		return $audio_file;

	}

	/**
	 * Prepare HTML for Google TTS.
	 *
	 * @param $html - Post/Page content to split.
	 * @param int $max
	 *
	 * @return array() HTML parts to speech.
	 * @since 3.0.0
	 * @access public
	 **/
	public function great_divider( $html, $max = 4500 ) {

		$parts = [];

        /** Divide HTML by closing tags '</' */
        $html_array = preg_split( '/(<\/)/', $html );
        $html_array = array_filter( $html_array );

        /** Fix broken tags, add '</' to all except first element. */
        $count = 0;
        foreach ( $html_array as $i => $el ) {
            $count ++;
            if ( $count === 1 ) {
                continue;
            } // Skip first element.

            $html_array[ $i ] = '</' . $el;
        }

        /** Fix broken html. */
        foreach ( $html_array as $i => $el ) {
            $html_array[ $i ] = XMLHelper::get_instance()->repair_html( $el );
        }

        /** Remove empty elements. */
        $html_array = array_filter( $html_array );

        /** Divide into parts. */
        $current   = "";
        foreach ( $html_array as $i => $el ) {
            $previous = $current;
            $current   .= $el;
            if ( strlen( $current ) >= $max ) {
                $parts[]  = $previous;
                $current   = $el;
            }
        }
        $parts[] = $current;

		return $parts;

	}

	/**
	 * Add custom text before/after audio.
	 *
	 * @param $parts - Content splitted to parts about 4000. Google have limits Total characters per request.
	 *
	 * @since 3.0.0
	 * @access public
     *
	 * @return array With text parts to speech.
	 **/
	public function add_watermark( $parts ) {

		/** Before Audio. */
		if ( Settings::get_instance()->options['before_audio'] ) {
			array_unshift( $parts, do_shortcode( Settings::get_instance()->options['before_audio'] ) );
		}

		/** After Audio. */
		if ( Settings::get_instance()->options['after_audio'] ) {
			$parts[] = do_shortcode( Settings::get_instance()->options['after_audio'] );
		}

		return $parts;
	}

	/**
	 * Divide parts by voice. One part voiced by one voice.
	 *
	 * @param array $parts HTML parts to be voiced.
	 *
	 * @return array() HTML parts to be voiced.
	 * @since 2.0.0
	 * @access public
	 */
	public function voice_divider( $parts ) {

		/** Array with parts splitted by voice. */
		$result = [];
		foreach ( $parts as $part ) {

			/** Mark location of the cut. */
            $part = str_replace( ["<voice", "</voice>"], ["{|mdp|}<voice", "</voice>{|mdp|}"], $part );

			/** Cut by marks. */
			$arr = explode( "{|mdp|}", $part );

			/** Clean the array. */
			$arr = array_filter( $arr );

			/** Combine results. */
            /** @noinspection SlowArrayOperationsInLoopInspection */
            $result = array_merge( $result, $arr );

		}

		/** Fix broken html of each part. */
		foreach ( $result as &$el ) {
			$el = XMLHelper::get_instance()->repair_html( $el );
		}
		unset( $el );

        /** Remove empty elements. */
        $result = array_filter( $result );

		return $result;

	}

    /**
     * Return array content of each ST element.
     *
     * @param $post_id - ID of the Post/Page content from which we will parse.
     * @param $stid - ID of Speech Template.
     *
     * @return array|mixed|object
     * @since 3.0.0
     * @access public
     **/
	private function parse_st_content( $post_id, $stid ) {

	    /** Get Speech Template data. */
	    $st = $this->get_st( $stid );

        /** On error. */
        if ( ! $st ) { return false; }

        /** Get ST elements. */
        $elements = $st['elements'];

        /** On error. */
        if ( ! is_array( $elements ) ) { return false; }

        /** Use internal libxml errors -- turn on in production, off for debugging. */
        libxml_use_internal_errors( true );

        /** Create a new DomDocument object. */
        $dom = new DomDocument;

        /** Get Current post Content. */
        $post_content = $this->parse_post_content( $post_id );

        /** Load the HTML. */
        $dom->loadHTML( $post_content );

        $parts = [];

        /** Collect content foreach element. */
        foreach ( $elements as $key => $element ) {

            /** Parse content for DOM Elements in ST. */
            if ( 'element' === $element['type'] ) {

                /** Create a new XPath object. */
                $xpath = new DomXPath( $dom );

                /** Query all elements with xPath */
                $nodes = $xpath->evaluate( $element['xpath'] );

                /** Skip element, if it's not found. */
                if ( ! $nodes->length ) { continue; }

                /** Get element content. */
                $content = XMLHelper::get_instance()->get_inner_html( $nodes->item( 0 ) );

                $content = $this->clean_content( $content );

                /** Apply SSML tags to content. */
                $content = $this->apply_ssml_settings( $element, $content );

                if ( strlen( $content ) > 4500 ) {

                    /**
                     * Split to parts about 4500. Google have limits Total characters per request.
                     * See: https://cloud.google.com/text-to-speech/quotas
                     **/
                    /** @noinspection SlowArrayOperationsInLoopInspection */
                    $parts = array_merge( $parts, $this->great_divider( $content, 4500 ) );

                } else {

                    /** Add first DomNode inner HTML. */
                    $parts[] = $content;

                }

            } elseif ( 'text' === $element['type'] ) {

                /** Get custom content. */
                $content = $element['content'];

                $content = $this->clean_content( $content );

                /** Apply SSML tags to content. */
                $content = $this->apply_ssml_settings( $element, $content );

                /** Add custom content. */
                $parts[] = $content;

                if ( strlen( $content ) > 4500 ) {

                    /**
                     * Split to parts about 4500. Google have limits Total characters per request.
                     * See: https://cloud.google.com/text-to-speech/quotas
                     **/
                    /** @noinspection SlowArrayOperationsInLoopInspection */
                    $parts = array_merge( $parts, $this->great_divider( $content, 4500 ) );

                }

            } elseif ( 'pause' === $element['type'] ) {

                /** Add pause element. */
                $parts[] = "<break time=\"{$element['time']}ms\" strength=\"{$element['strength']}\" />";

            }

        }

        return $parts;

    }

    /**
     * Apply SSML tags to content.
     *
     * @param array $element
     * @param string $content
     *
     * @since 3.0.0
     * @access public
     *
     * @return array|mixed|object
     **/
    private function apply_ssml_settings( $element, $content ) {

        /** Add 'Say As' if needed. */
        if ( ! in_array( $element['sayAs'], ['none', 'undefined'] ) ) {
            $content = "<say-as interpret-as=\"{$element['sayAs']}\">{$content}</say-as>";
        }

        /** Add 'Emphasis' if needed. */
        if ( ! in_array( $element['emphasis'], ['none', 'undefined'] ) ) {
            $content = "<emphasis level=\"{$element['emphasis']}\">{$content}</emphasis>";
        }

        /** If voice is different from default, change voice. */
        if (
            ! in_array($element['voice'], ['none', 'undefined']) &&
            $element['voice'] !== Settings::get_instance()->options['language']
        ) {

            $content = "<voice name=\"{$element['voice']}\">{$content}</voice>";

        }

        return $content;

    }

	/**
	 * Return post/page content by ID with executed shortcodes.
	 *
	 * @param $post_id - ID of the Post/Page content from which we will parse.
     * @param string $template
	 *
	 * @since 3.0.0
	 * @access public
     *
     * @return array|mixed|object
	 **/
	private function parse_post_content( $post_id, $template = null ) {

	    /** Frontend url with post content to parse. */
	    $url = $this->get_frontend_url( $post_id, $template );

	    /** Prepare curl request to parse content. */
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_URL, $url );
		curl_setopt( $curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13' );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $curl, CURLOPT_HEADER, false );

        /** Run curl request. */
		$html = curl_exec( $curl );

		/**
		 * Handle connection errors.
		 * Show users an appropriate message asking to try again later.
		 **/
		if ( curl_errno( $curl ) > 0 ) {

			$return = [
				'success' => false,
				'message' => 'Error connecting to: ' . $url . PHP_EOL . 'Please check your security plugins and add this url to white list. ' . 'Curl error: ' . curl_error( $curl ),
			];
			wp_send_json( $return );

		}

		/**
		 * If we reach this point, we have a proper response.
		 * Get the response code to check if the content was found.
		 **/
		$responseCode = curl_getinfo( $curl, CURLINFO_HTTP_CODE );

		/**
		 * Anything other than HTTP 200 indicates a request error.
		 * In this case, we again ask the user to try again later.
		 **/
		if ( $responseCode !== 200 ) {

			$return = [
				'success' => false,
				'message' => 'Failed to get content due to an error: HTTP ' . $responseCode . PHP_EOL . 'URL: ' . $url
			];
			wp_send_json( $return );

		}

		curl_close( $curl );

		return $html;

	}

    /**
     * Speaker use custom page template to parse content without garbage.
     *
     * @param string $template - The path of the template to include.
     *
     * @since 3.0.0
     * @access public
     *
     * @return string
     *
     * @noinspection PhpUnused
     **/
    public static function speaker_page_template( $template ) {

        /** Change template for correct parsing content. */
        if ( isset( $_GET['speaker-template'] ) && 'speaker' === $_GET['speaker-template'] ) {

            /** Disable admin bar. */
            show_admin_bar( false );

            $template = Speaker::$path . 'src/Merkulove/Speaker/speaker-template.php';

        }

        return $template;

    }

    /**
     * Hide admin bar for Speech Template Editor.
     *
     * @since 3.0.0
     * @access public
     *
     * @return void
     **/
    public static function hide_admin_bar() {

        if ( isset( $_GET['speaker_speech_template'] ) && '1' === $_GET['speaker_speech_template'] ) {

            /** Hide admin bar for Speech Template Editor. */
            show_admin_bar( false );

        }

    }

    /**
     * Return frontend url with post content to parse.
     *
     * @param int    $post_id - ID of the Post/Page content from which we will parse.
     * @param string $template
     *
     * @since  3.0.0
     * @access public
     *
     * @return string
     **/
	private function get_frontend_url( $post_id, $template = null ) {

        /** Get full permalink for the current post. */
        $url = get_permalink( $post_id );

        /** Returns a string if the URL has parameters or NULL if not. */
        $query = parse_url( $url, PHP_URL_QUERY );

        /** Add speaker-ssml param to URL. */
        if ( $query ) {

            $url .= '&speaker-ssml=1';

        } else {

            $url .= '?speaker-ssml=1';

        }

        /** Add template param to url. */
        if ( $template ) {

            $url .=  '&speaker-template=' . $template;

        }

        return $url;

    }

	/**
	 * Remove muted elements by class "speaker-mute" or attribute speaker-mute="".
	 *
	 * @param $post_content - Post/Page content.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return string
	 **/
	public function remove_muted_html( $post_content ) {

		/** Hide DOM parsing errors. */
		libxml_use_internal_errors( true );
		libxml_clear_errors();

		/** Load the possibly malformed HTML into a DOMDocument. */
		$dom          = new DOMDocument();
		$dom->recover = true;
		$dom->loadHTML( '<?xml encoding="UTF-8"><body id="repair">' . $post_content . '</body>' ); // input UTF-8.

		$selector = new DOMXPath( $dom );

		/** Remove all elements with speaker-mute="" attribute. */
		foreach( $selector->query( '//*[@speaker-mute]') as $e ) {
			$e->parentNode->removeChild( $e );
		}

		/** Remove all elements with class="speaker-mute". */
		foreach( $selector->query( '//*[contains(attribute::class, "speaker-mute")]' ) as $e ) {
			$e->parentNode->removeChild( $e );
		}

		/** HTML without muted tags. */
		$body = $dom->documentElement->lastChild;

		return trim( XMLHelper::get_instance()->get_inner_html( $body ) );

	}

	/**
	 * Return Player code.
	 *
	 * @param int $id - Post/Page id.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return false|string
	 **/
	public function get_player( $id = 0 ) {

		/** Show player if we have audio. */
		if ( ! $this->audio_exists( $id ) ) { return false; }

        /** Don't show player if we parse content. */
        if ( isset( $_GET['speaker-ssml'] )  ) { return false; }

        /** Don't show player if in Speech Template Editor. */
        if ( isset( $_GET['speaker_speech_template'] ) && '1' === $_GET['speaker_speech_template'] ) { return false; }

		/** URL to post audio file. */
		$audio_url = $this->get_audio_url( $id );

		ob_start();
		$classes = '';
		$classes .= ' ' . Settings::get_instance()->options['position'] . ' ';
		$classes .= ' ' . Settings::get_instance()->options['style'] . ' ';
		$classes = trim( $classes );
		?>
		<div class="mdp-speaker-wrapper">
			<div class="mdp-speaker-box <?php echo esc_attr( $classes ); ?>"
			     style="background: <?php echo Settings::get_instance()->options[ 'style' ] === "speaker-browser-default" ? 'none' : esc_attr( Settings::get_instance()->options['bgcolor'] ); ?>">
				<div>
					<?php echo do_shortcode( '[audio src="' . $audio_url . '"]' ); ?>
				</div>
			</div>

			<?php if ( in_array( Settings::get_instance()->options['link'], [ 'frontend', 'backend-and-frontend' ] ) ) : ?>
				<p class="mdp-speaker-download-box">
					<?php echo esc_html__( 'Download: ', 'speaker' ) ?>
					<a href="<?php echo esc_url( $audio_url ); ?>"
					   download="" title="<?php echo esc_attr__( 'Download: ', 'speaker' ) . htmlentities( get_the_title( $id ) ); ?>"><?php echo htmlentities( get_the_title( $id ) ); ?></a>
				</p>
			<?php endif; ?>
		</div>
		<?php

		return ob_get_clean();

	}

	/**
	 * Return URL to audio version of the post.
	 *
	 * @param int $id - Post/Page id.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @return bool|string
	 **/
	public function get_audio_url( $id = 0 ) {

		/** If audio file not exist. */
		$f_time = $this->audio_exists( $id );
		if ( ! $f_time ) { return false; }

		/** Current post ID. */
		if ( ! $id ) {

            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $id = get_the_ID();

			if ( ! $id ) { return false; }

		}

		/** Get path to upload folder. */
		$upload_dir     = wp_get_upload_dir();
		$upload_baseurl = $upload_dir['baseurl'];

		/** URL to post audio file. */
		$audio_url = $upload_baseurl . '/speaker/post-' . $id . '.mp3';

		/** Cache Busting. '.mp3' is needed. */
		$audio_url .= '?cb=' . $f_time . '.mp3';

		return $audio_url;
	}

	/**
	 * Checks if there is audio for the current post.
	 *
	 * @param int $id - Post/Page id.
	 *
	 * @return bool|false|int
	 * @since 3.0.0
	 * @access public
	 **/
	public function audio_exists( $id = 0 ) {

		/** Current post ID. */
		if ( ! $id ) {

            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $id = get_the_ID();

			if ( ! $id ) { return false; }

		}

		/** Get path to upload folder. */
		$upload_dir     = wp_get_upload_dir();
		$upload_basedir = $upload_dir['basedir'];

		/** Path to post audio file. */
		$audio_file = $upload_basedir . '/speaker/post-' . $id . '.mp3';

		/** True if we have audio. */
		if ( file_exists( $audio_file ) ) {
			return filemtime( $audio_file );
		}

        return false;
    }

	/**
	 * Add player code to page.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @return void
	 **/
	public function add_player() {

		/** Add player before/after Title. */
		$position = Settings::get_instance()->options['position'];
		if ( in_array( $position, [ 'before-title', 'after-title' ] ) ) {
			add_filter( 'the_title', [ $this, 'add_player_to_title' ] );
		}

		/** Add player before/after Content and Top/Bottom Fixed. */
		if ( in_array( $position, [
			'before-content',
			'after-content',
			'top-fixed',
			'bottom-fixed'
		] ) ) {
			add_filter( 'the_content', [ $this, 'add_player_to_content' ] );
		}

    }

	/**
	 * Add player before/after Title.
	 *
	 * @param $title  - Post/Page title.
	 *
	 * @since 3.0.0
	 * @access public
     *
	 * @return string
	 **/
	public function add_player_to_title( $title ) {

        /** Checks if plugin should work on this page. */
        if ( ! AssignmentsTab::get_instance()->display() ) { return $title; }

		/** Check if we are in the loop and work only with selected post types. */
		if (  in_the_loop() && ! ( is_singular( Settings::get_instance()->options['cpt_support'] ) ) ) { return $title; }

		/** Run only once. */
		static $already_run = false;
		if ( $already_run === true ) { return $title; }
		$already_run = true;

		$player = $this->get_player();
        if ( Settings::get_instance()->options['position'] === 'before-title' ) {

            return $player . $title;

        }

        if ( Settings::get_instance()->options['position'] === 'after-title' ) {

            return $title . $player;

        }

        return $title;

	}

	/**
	 * Add player before/after Content and Top/Bottom Fixed.
	 *
	 * @param $content - Post/Page content.
	 *
	 * @since 3.0.0
	 * @access public
     *
	 * @return string
	 **/
	public function add_player_to_content( $content ) {

        /** Checks if plugin should work on this page. */
        if ( ! AssignmentsTab::get_instance()->display() ) { return $content; }

		/** Check if we are in the loop and work only with selected post types. */
		if ( in_the_loop() && ! ( is_singular( Settings::get_instance()->options['cpt_support'] ) ) ) { return $content; }

		/** Run only Once. */
		static $already_run = false;
		if ( $already_run === true ) { return $content; }
		$already_run = true;

		$player = $this->get_player();
        if ( Settings::get_instance()->options['position'] === 'before-content' ) {

            return $player . $content;

        }

        if ( in_array( Settings::get_instance()->options['position'], [ 'after-content', 'top-fixed', 'bottom-fixed' ] ) ) {

            return $content . $player;

        }

        return $content;

	}

	/**
	 * Render Player code.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public function the_player() {

		/** Show player if we have audio. */
		$f_time = $this->audio_exists();
		if ( ! $f_time ) { return; }

		/** URL to post audio file. */
		$audio_url = $this->get_audio_url();

		?>
        <div class="mdp-speaker-box <?php echo esc_attr( Settings::get_instance()->options['position'] ); ?> <?php echo esc_attr( Settings::get_instance()->options['style'] ); ?>"
             style="background: <?php echo esc_attr( Settings::get_instance()->options['bgcolor'] ); ?>">
            <div>
				<?php echo do_shortcode( '[audio src="' . $audio_url . '"]' ); ?>
            </div>
        </div>
        <div class="mdp-speaker-audio-info">
			<?php if ( in_array( Settings::get_instance()->options['link'], [ 'backend', 'backend-and-frontend' ] ) ) : ?>
                <span class="dashicons dashicons-download" title="<?php esc_html_e( 'Download audio', 'speaker' ); ?>"></span>
                <a href="<?php echo esc_url( $audio_url ); ?>" download=""><?php esc_html_e( 'Download audio', 'speaker' ); ?></a><br>
			<?php endif; ?>
            <span class="dashicons dashicons-clock" title="<?php esc_html__( 'Date of creation', 'speaker' ) ?>"></span>
			<?php echo date( "F d Y H:i:s", $f_time ); ?>
        </div>
		<?php

	}

	/**
	 * Remove audio on remove post record.
	 *
	 * @param $post_id - The post id that is being deleted.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function before_delete_post( $post_id ) {

		/** If we don't have audio then nothing to delete. */
		if ( ! $this->audio_exists( $post_id ) ) { return; }

		$this->remove_audio_by_id( $post_id );

	}

	/**
	 * Remove Audio by ID.
	 *
	 * @param $id - The post id from which we delete audio.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function remove_audio_by_id( $id ) {

		/** Get path to upload folder. */
		$upload_dir     = wp_get_upload_dir();
		$upload_basedir = $upload_dir['basedir'];

		/** Path to post audio file. */
		$audio_file = $upload_basedir . '/speaker/post-' . $id . '.mp3';

		/** Remove audio file. */
		wp_delete_file( $audio_file );

	}

	/**
	 * Ajax Remove Audio action hook here.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function remove_audio() {

		/** Security Check. */
		check_ajax_referer( 'speaker-nonce', 'nonce' );

		/** Current post ID. */
		$post_id = (int)$_POST['post_id'];

		/** Get path to upload folder. */
		$upload_dir     = wp_get_upload_dir();
		$upload_basedir = $upload_dir['basedir'];

		/** Path to post audio file. */
		$audio_file = $upload_basedir . '/speaker/post-' . $post_id . '.mp3';

		/** Remove audio file. */
		wp_delete_file( $audio_file );

		echo 'ok';

		wp_die();

	}

    /**
     * Ajax set Speech template as default.
     *
     * @since  3.0.0
     * @access public
     *
     * @return void
     **/
	public function set_default_st() {

        /** Security Check. */
        check_ajax_referer( 'speaker-nonce', 'nonce' );

        /** Get Speech Template ID. */
        $stid = filter_input(INPUT_POST, 'stid' );

        /** Error, no Speech Template ID */
        if ( ! trim( $stid ) ) {

            $return = [
                'success' => false,
                'message' => esc_html__( 'Error: There are no Speech Template ID received.', 'speaker' ),
            ];

            wp_send_json( $return );

        }

        /** Get Post Type. */
        $post_type = filter_input(INPUT_POST, 'postType' );

        /** In this option we store all Speech Templates. */
        $st_opt_name = 'mdp_speaker_speech_templates';

        /** Get all Speech Templates. */
        $st = get_option( $st_opt_name, false );

        /** We haven't any ST. */
        if ( ! $st ) {

            $return = [
                'success' => false,
                'message' => 'Speech Templates not found.',
            ];

            wp_send_json( $return );

        }

        /** For each ST. */
        foreach ( $st as $key => $template ) {

            /** Get current Post Types for ST. */
            $post_types = $st[$key]['default'];

            /** Add post_type if we found same id. */
            if ( $template['id'] === $stid && 'content' !== $stid ) {

                /** Add new Post Type to post Types. */
                $post_types[] = $post_type;

            /** Remove post_type from all others ST. */
            } else if ( ( $p_key = array_search( $post_type, $post_types, true ) ) !== false ) {

                unset( $post_types[$p_key] );

            }

            /** Remove duplicates from an array. */
            $post_types = array_unique( $post_types );

            /** Set new post types for ST. */
            $st[$key]['default'] = $post_types;

        }

        /** Update Speech Templates in option. */
        $updated = update_option( $st_opt_name, $st, false );

        if ( ! $updated ) {

            $return = [
                'success' => false,
                'message' => esc_html__( 'Failed to install Speech Template as Default.', 'speaker' ),
            ];

            wp_send_json( $return );

        }

        $return = [
            'success' => true,
            'message' => esc_html__( 'Speech Template is installed as Default successfully.', 'speaker' ),
        ];

        wp_send_json( $return );

    }

    /**
     * Return Speech Template data by STID.
     *
     * @param $stid
     *
     * @since  3.0.0
     * @access public
     *
     * @return array|false
     **/
    private function get_st( $stid ) {

        /** In this option we store all Speech Templates. */
        $st_opt_name = 'mdp_speaker_speech_templates';

        /** Get all Speech Templates. */
        $st = get_option( $st_opt_name, false );

        /** We haven't any ST. */
        if ( ! $st ) { return false; }

        /** Search for existing st. */
        foreach ( $st as $key => $template ) {

            /** Update Speech template if we found same id. */
            if ( $template['id'] === $stid ) {

                return $st[$key];

            }

        }

        return false;

    }

    /**
     * Ajax get Speech template data.
     *
     * @since  3.0.0
     * @access public
     *
     * @return void
     **/
	public function get_st_ajax() {

        /** Security Check. */
        check_ajax_referer( 'speaker-nonce', 'nonce' );

        /** Get Speech Template ID. */
        $stid = filter_input(INPUT_POST, 'stid' );

        /** In this option we store all Speech Templates. */
        $st_opt_name = 'mdp_speaker_speech_templates';

        /** Get all Speech Templates. */
        $st = get_option( $st_opt_name, false );

        /** We haven't any ST. */
        if ( ! $st ) {

            $return = [
                'success' => false,
                'message' => 'Speech Templates not found.',
            ];

            wp_send_json( $return );

        }

        /** Search for existing st. */
        foreach ( $st as $key => $template ) {

            /** Update Speech template if we found same id. */
            if ( $template['id'] === $stid ) {

                $return = [
                    'success' => true,
                    'message' => $st[$key],
                ];

                wp_send_json( $return );

                break;

            }

        }

        /** Add new one if not found st with same id. */
        $return = [
            'success' => false,
            'message' => esc_html__( 'Speech Template not found.', 'speaker' )
        ];

        wp_send_json( $return );

    }

    /**
     * Ajax Create/Update/Delete Speech template.
     *
     * @since  3.0.0
     * @access public
     *
     * @return void
     **/
	public function process_st() {

        /** Security Check. */
        check_ajax_referer( 'speaker-nonce', 'nonce' );

        /** Get Speech Template data. */
        $st = filter_input(INPUT_POST, 'st' );

        /** Speech Template JSON to Object. */
        $st = json_decode( $st, true );

        /** Do we delete this Speech Template? */
        $delete = filter_input(INPUT_POST, 'delete', FILTER_VALIDATE_BOOLEAN );

        /** Remove Speech Template, */
        if ( $delete ) {

            if ( $this->delete_st( $st['id'] ) ) {

                $return = [
                    'success' => true,
                    'message' => esc_html__( 'Speech Template removed successfully.', 'speaker' )
                ];

            /** On fail. */
            } else {

                $return = [
                    'success' => false,
                    'message' => esc_html__( 'Failed to remove Speech Template', 'speaker' )
                ];

            }

            wp_send_json( $return );

        }

        /** Update or create Speech Template. */
        if ( ! $this->update_st( $st ) ) {

            $return = [
                'success' => false,
                'message' => esc_html__( 'Failed to update Speech Template.', 'speaker' )
            ];

            wp_send_json( $return );

        }

        $return = [
            'success' => true,
            'message' => esc_html__( 'Speech Template updated successfully.', 'speaker' )
        ];

        wp_send_json( $return );

    }

    /**
     * Update existing or create new Speech Template.
     *
     * @param $new_st
     *
     * @since  3.0.0
     * @access public
     *
     * @return boolean
     **/
    private function update_st( $new_st ) {

        /** In this option we store all Speech Templates. */
        $st_opt_name = 'mdp_speaker_speech_templates';

        /** Get all Speech Templates. */
        $st = get_option( $st_opt_name, false );

        /** We haven't any ST. */
        if ( ! $st ) {

            /** Add first one. */
            $st = [];
            $st[] = $new_st;

        /** Search for existing st. */
        } else {

            $found = false;
            foreach ( $st as $key => $template ) {

                /** Update Speech template if we found same id. */
                if ( $template['id'] === $new_st['id'] ) {

                    $found = true;
                    $st[$key] = $new_st;

                    break;

                }

            }

            /** Add new one if not found st with same id. */
            if ( ! $found ) {
                $st[] = $new_st;
            }

        }

        /** Save Speech Templates in option. */
        $updated = update_option( $st_opt_name, $st, false );
        if ( ! $updated ) { return false; }

        return true;

    }

    /**
     * Remove Speech Template by ID.
     *
     * @param string $id - Unique id of Speech Template.
     *
     * @since  3.0.0
     * @access public
     *
     * @return boolean
     **/
    private function delete_st( $id ) {

        /** In this option we store all Speech Templates. */
        $st_opt_name = 'mdp_speaker_speech_templates';

        /** Get all Speech Templates. */
        $st = get_option( $st_opt_name, false );

        /** We haven't any ST, nothing to remove. */
        if ( ! $st ) { return true; }

        /** Search for existing st. */
        foreach ( $st as $key => $template ) {

            /** Remove Speech template if we found same id. */
            if ( $template['id'] === $id ) {

                unset( $st[$key] ); // Remove ST.

                break;

            }

        }

        /** Save Speech Templates in option. */
        $updated = update_option( $st_opt_name, $st, false );
        if ( ! $updated ) { return false; }

        return true;

    }

	/**
	 * Ajax Create Audio action hook here.
	 *
	 * @since  3.0.0
	 * @access public
     *
     * @return void
	 **/
	public function gspeak() {

        /** Security Check. */
        check_ajax_referer( 'speaker-nonce', 'nonce' );

        /** Current post ID. */
        $post_id = (int)$_POST['post_id'];

        /** Get Speech Template ID. */
        $stid = filter_input(INPUT_POST, 'stid' );

        /** Create audio version of post. */
        if ( $this->voice_acting( $post_id, $stid ) ) {

	        $return = [
		        'success' => true,
		        'message' => esc_html__( 'Audio Generated Successfully', 'speaker' )
	        ];

        } else {

	        $return = [
		        'success' => false,
		        'message' => esc_html__( 'An error occurred while generating the audio.', 'speaker' )
	        ];

        }


        wp_send_json( $return );

	}

	/**
	 * Let me speak. Create audio version of post.
	 *
	 * @param int $post_id
     * @param string $stid
	 *
	 * @since  3.0.0
	 * @access public
	 *
	 * @return boolean
	 **/
	public function voice_acting( $post_id = 0, $stid = 'content' ) {

        if ( 'content' === $stid ) {

            /** Prepare parts for generate audio for whole post content. */
            $parts = $this->content_based_generation( $post_id );

        } else {

            /** Prepare parts for generate audio for post based on Speech Template. */
            $parts = $this->template_based_generation( $post_id, $stid );
            
            /** On error. */
            if ( ! $parts ) { return false; }

        }

		/** Create audio file for each part. */
		$audio_parts = [];
		foreach ( $parts as $part ) {

			try {

			    /** Convert HTML to temporary audio file. */
				$audio_parts[] = $this->part_speak( $part, $post_id );

			} catch ( ApiException $e ) {

			    /** Show error message. */
                echo esc_html__( 'Caught exception: ' ) . $e->getMessage() . "\n";

			}

		}

		/** Combine multiple files to one. */
		$this->glue_audio( $audio_parts, $post_id );

		return true;

    }

    private function clean_content($post_content ) {

        /** Remove <script>...</script>. */
        $post_content = preg_replace( '/<\s*script.+?<\s*\/\s*script.*?>/si', ' ', $post_content );

        /** Remove <style>...</style>. */
        $post_content = preg_replace( '/<\s*style.+?<\s*\/\s*style.*?>/si', ' ', $post_content );

        /** Trim, replace tabs and extra spaces with single space. */
        $post_content = preg_replace( '/[ ]{2,}|[\t]/', ' ', trim( $post_content ) );

        /** Remove muted elements by class "speaker-mute" or attribute speaker-mute="". */
        $post_content = $this->remove_muted_html( $post_content );

        /** Prepare HTML to splitting. */
        $post_content = XMLHelper::get_instance()->clean_html( $post_content );

        return $post_content;

    }

    /**
     * Prepare parts for generate audio for whole post content.
     *
     * @param int $post_id
     *
     * @since  3.0.0
     * @access public
     *
     * @return array
     **/
    private function content_based_generation( $post_id ) {

        /**
         * Get Current post Content.
         * Many shortcodes do not work in the admin area so we need this trick.
         * We open frontend page in custom template and parse content.
         **/
        $post_content = $this->parse_post_content( $post_id, 'speaker' );

        /** Get only content part from full page. */
        $post_content = Helper::get_instance()->get_string_between( $post_content, '<div class="mdp-speaker-content-start"></div>', '<div class="mdp-speaker-content-end"></div>' );

        /**
         * Filters the post content before any manipulation.
         *
         * @since 3.0.0
         *
         * @param string    $post_content   Post content.
         * @param int       $post_id        Post ID.
         **/
        $post_content = apply_filters( 'speaker_before_content_manipulations', $post_content, $post_id );

        $post_content = $this->clean_content( $post_content );

        /**
         * Filters the post content before split to parts by 4500 chars.
         *
         * @since 3.0.0
         *
         * @param string    $post_content   Post content.
         * @param int       $post_id        Post ID.
         **/
        $post_content = apply_filters( 'speaker_before_content_dividing', $post_content, $post_id );

        /** If all content is bigger than the quota. */
        $parts[] = $post_content;
        if ( strlen( $post_content ) > 4500 ) {

            /**
             * Split to parts about 4500. Google have limits Total characters per request.
             * See: https://cloud.google.com/text-to-speech/quotas
             **/
            $parts = $this->great_divider( $post_content, 4500 );

        }

        /**
         * Filters content parts before voice_divider.
         *
         * @since 3.0.0
         *
         * @param string    $parts          Post content parts.
         * @param int       $post_id        Post ID.
         **/
        $parts = apply_filters( 'speaker_before_voice_divider', $parts, $post_id );

        /** Divide parts by voice. One part voiced by one voice */
        $parts = $this->voice_divider( $parts );

        /**
         * Filters content parts before adding watermarks.
         *
         * @since 3.0.0
         *
         * @param string    $parts          Post content parts.
         * @param int       $post_id        Post ID.
         **/
        $parts = apply_filters( 'speaker_before_adding_watermarks', $parts, $post_id );

        /** Add custom text before/after audio. */
        $parts = $this->add_watermark( $parts );

        return $parts;

    }

    /**
     * Prepare parts for generate audio for post based on Speech Template.
     *
     * @param int $post_id
     * @param string $stid
     *
     * @since  3.0.0
     * @access public
     *
     * @return array|false
     **/
    private function template_based_generation( $post_id, $stid ) {

        /** Get content of each element. */
        $parts = $this->parse_st_content( $post_id, $stid );

        /** On error. */
        if ( ! $parts ) { return false; }

        return $parts;

    }

	/**
	 * Main SpeakerCaster Instance.
	 *
	 * Insures that only one instance of SpeakerCaster exists in memory at any one time.
	 *
	 * @static
	 * @return SpeakerCaster
	 * @since 3.0.0
	 **/
	public static function get_instance() {

        /** @noinspection SelfClassReferencingInspection */
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof SpeakerCaster ) ) {

            /** @noinspection SelfClassReferencingInspection */
            self::$instance = new SpeakerCaster;

		}

		return self::$instance;

	}

} // End Class SpeakerCaster.
