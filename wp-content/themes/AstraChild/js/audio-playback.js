jQuery(function () {
  jQuery(document).on('click', '.playButton', function (event) {
    event.preventDefault();
    var currentPlayButton = jQuery(this),
        currentStopButton = jQuery(this).next(),
        refParent = jQuery(this).parent(),
        audio = refParent.find('audio');
    //console.log('playButton clicked');
    currentPlayButton.prop('disabled', true);
    currentStopButton.prop('disabled', false);
    audio[0].addEventListener("ended", function(){
      //console.log('audio ended');
      audio[0].pause();
      audio[0].currentTime = 0;
      currentPlayButton.prop('disabled', false);
      currentStopButton.prop('disabled', true);
    });
    audio[0].play();
  });
  jQuery(document).on('click', '.stpButton', function (event) {
    event.preventDefault();
    var currentPlayButton = jQuery(this).prev(),
        currentStopButton = jQuery(this),
        refParent = jQuery(this).parent(),
        audio = refParent.find('audio');
    //console.log('stopButton clicked');
    audio[0].pause();
    audio[0].currentTime = 0;
    currentPlayButton.prop('disabled', false);
    currentStopButton.prop('disabled', true);
  });
});
