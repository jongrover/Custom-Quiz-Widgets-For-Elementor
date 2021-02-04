jQuery(function () {
  jQuery(document).on('click', '.playButton2', function (event) {
    event.preventDefault();
    var currentPlayButton = jQuery(this),
        currentStopButton = jQuery(this).next(),
        refParent = jQuery(this).parent(),
        audio = refParent.find('audio');
    //console.log('playButton clicked');
    currentPlayButton.prop('disabled', true).hide();
    currentStopButton.prop('disabled', false).show();
    audio[0].addEventListener("ended", function(){
      //console.log('audio ended');
      audio[0].pause();
      audio[0].currentTime = 0;
      currentPlayButton.prop('disabled', false).show();
      currentStopButton.prop('disabled', true).hide();
    });
    audio[0].play();
  });
  jQuery(document).on('click', '.stpButton2', function (event) {
    event.preventDefault();
    var currentPlayButton = jQuery(this).prev(),
        currentStopButton = jQuery(this),
        refParent = jQuery(this).parent(),
        audio = refParent.find('audio');
    //console.log('stopButton clicked');
    audio[0].pause();
    audio[0].currentTime = 0;
    currentPlayButton.prop('disabled', false).show();
    currentStopButton.prop('disabled', true).hide();
  });
});
