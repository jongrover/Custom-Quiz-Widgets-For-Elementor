<?php
/**
 * Template for Small Footer Layout 1
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */
$section_1 = astra_get_small_footer( 'footer-sml-section-1' );
$section_2 = astra_get_small_footer( 'footer-sml-section-2' );

$main_pages = array(
  "home" => 25706,
  "whylef" => 24981,
  "about" => 25120,
  "quotes" => 31379,
  "vocabulary" => 31343,
  "pastpresent" => 31358,
  "texting" => 31370,
  "quizzes" => 31327,
  "songs" => 31400,
  "karaoke" => 31406,
  "games" => 27094
);

$is_main_page = true;

global $wp_query;
$id = $wp_query->post->ID;

foreach ($main_pages as &$page_id) {
  if ($page_id == $id) {
    $is_main_page = true;
    break;
  } else {
    $is_main_page = false;
  }
}

?>

<?php if ($is_main_page) { ?>
  <div class="ast-small-footer footer-sml-layout-1">
  	<div class="ast-footer-overlay">
  		<div class="ast-container">
  			<div class="ast-small-footer-wrap" >
  				<?php if ( $section_1 ) : ?>
  					<div class="ast-small-footer-section ast-small-footer-section-1" >
  						<?php
  							echo $section_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  						?>
  					</div>
  				<?php endif; ?>

  				<?php if ( $section_2 ) : ?>
  					<div class="ast-small-footer-section ast-small-footer-section-2" >
  						<?php
  							echo $section_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  						?>
  					</div>
  				<?php endif; ?>

  			</div><!-- .ast-row .ast-small-footer-wrap -->
  		</div><!-- .ast-container -->
  	</div><!-- .ast-footer-overlay -->
  </div><!-- .ast-small-footer-->

<?php } else { ?>

<style>
  /* Footer */

  .site-content {
    margin-bottom: 123px;
  }

  footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 2;
  }

  footer p {
    margin-bottom: 10px;
  }

  .copyright {
    text-align: right;
  }

  .copyright p {
    width: 100%;
    margin-bottom: 0px;
  }

  .recorder-box.recorder-box-footer {
    padding: 0;
    min-width: 100%;
    width: 100%;
    text-align: left;
    margin: 0;
  }

  .recorder-box.recorder-box-footer button.dual {
    display: inline-block;
    min-width: 100px;
    width: 100px;
  }

  .recorder-box.recorder-box-footer button.dual.footerStop {
    display: none;
  }

  .recorder-box.recorder-box-footer button.dual.footerPlay {
    background: green;
  }

  .recorder-box.recorder-box-footer button.dual.footerPlay:hover {
    background: darkgreen;
  }

  .recorder-box.recorder-box-footer button.footerPlay:disabled {
    pointer-events: none;
    background: #d3d3d3
  }

  .recorder-box-footer .recordingsList {
    display: none;
  }

  .ast-footer-overlay {
    padding: 10px 40px 10px;
  }

  @media only screen and (max-width: 768px) {
    footer .elementor-column, footer p, .recorder-box.recorder-box-footer {
      width: 100%;
      text-align: center;
    }
    .recorder-box.recorder-box-footer {
      margin-bottom: 5px;
    }
    /* .hide-mobile {
      display: none;
    } */
    .copyright p {
      margin-bottom: 0;
    }
    .site-content {
      margin-bottom: 148px;
    }
  }
</style>

<div class="ast-small-footer footer-sml-layout-1">
	<div class="ast-footer-overlay">
		<div class="ast-container">
			<div class="ast-small-footer-wrap" >
        <div class="elementor-row hide-mobile">
          <div class="elementor-column elementor-col-50">
            <p>Hear yourself speaking English 🎤</p>
          </div><!-- .elementor-column -->
        </div><!-- .elementor-row -->
        <div class="elementor-row">
          <div class="elementor-column elementor-col-50">
            <div class='recorder-box recorder-box-footer'>
          	  <button class='recordButton footerRecord dual' disabled>Record</button>
          	  <button class='stopButton footerStop dual' disabled>Stop</button>
              <button class='playButton footerPlay dual' disabled>Play</button>
          	  <ol class='recordingsList'></ol>
            </div><!-- .recorder-box -->
          </div><!-- .elementor-column -->
          <div class="elementor-column elementor-col-50 copyright">
            <p><small>Copyright © 2021 Learn English Fast</small></p>
          </div><!-- .elementor-column -->
        </div><!-- .elementor-row -->
			</div><!-- .ast-row .ast-small-footer-wrap -->
		</div><!-- .ast-container -->
	</div><!-- .ast-footer-overlay -->
</div><!-- .ast-small-footer-->

<script>
  //webkitURL is deprecated but nevertheless
  URL = window.URL || window.webkitURL;

  var gumStream; 						//stream from getUserMedia()
  var rec; 							//Recorder.js object
  var input; 							//MediaStreamAudioSourceNode we'll be recording

  // shim for AudioContext when it's not avb.
  var AudioContext = window.AudioContext || window.webkitAudioContext;
  var audioContext; //audio context to help us record

  jQuery(function () {

    // var recordingsList = jQuery('.recordingsList');
    var footerRecordButton = jQuery('.footerRecord');
    var footerStopButton = jQuery('.footerStop');
    var footerPlayButton = jQuery('.footerPlay');
    var footerRecList = jQuery('.recorder-box-footer .recordingsList');

    footerRecordButton.prop('disabled', false);
    footerPlayButton.prop('disabled', true);

    footerRecordButton.click(function (event) {
      event.preventDefault();
      console.log('recordButton clicked');
      var constraints = { audio: true, video:false }
      footerRecordButton.prop('disabled', true).hide();
      footerStopButton.prop('disabled', false).show();
      footerPlayButton.prop('disabled', true);
      navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
      console.log('getUserMedia() success, stream created, initializing Recorder.js ...');
      audioContext = new AudioContext();
      gumStream = stream;
      input = audioContext.createMediaStreamSource(stream);
      rec = new Recorder(input,{numChannels:1});
      rec.record();
      console.log('Recording started');
      }).catch(function(err) {
      //enable the record button if getUserMedia() fails
      footerRecordButton.prop('disabled', false).show();
      footerStopButton.prop('disabled', true).hide();
      });
    });

    footerStopButton.click(function (event) {
      event.preventDefault();
      console.log('stopButton clicked');
      rec.stop();
      gumStream.getAudioTracks()[0].stop();
      rec.exportWAV(createDownloadLink);
      footerStopButton.prop('disabled', true).hide();
      footerRecordButton.prop('disabled', false).show();
      footerPlayButton.prop('disabled', false);
    });

    footerPlayButton.click(function (event) {
      event.preventDefault();
      console.log('playButton clicked');
      footerRecList.find(audio)[0].play();
      // rec.play();
      // gumStream.getAudioTracks()[0].play();
      footerStopButton.prop('disabled', false).show();
      footerRecordButton.prop('disabled', true).hide();
    });

    function createDownloadLink(blob) {
      var url = URL.createObjectURL(blob);
      var au = document.createElement('audio');
      var li = document.createElement('li');
      var link = document.createElement('a');
      au.controls = true;
      au.src = url;
      //remove recording link
      link.href = '#';
      // link.download = filename+'.wav'; //download forces the browser to donwload the file using the  filename
      link.innerHTML = '&times;';
      //add the new audio element to li
      li.appendChild(au);
      //add the remove recording to li
      li.appendChild(link);
      //replace the li element to the ol
      footerRecList.html(li);
    }

  });
</script>

<?php } ?>
