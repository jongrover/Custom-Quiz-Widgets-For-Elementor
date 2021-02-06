jQuery(function () {
  jQuery(document).on('click', '.playButton3', function () {
    var currentButton = jQuery(this),
        refParent = jQuery(this).parent(),
        audio = refParent.find('audio');
    currentButton.toggleClass('active');
    if (currentButton.hasClass('active')) {
        audio[0].addEventListener("ended", function(){
          audio.trigger('pause');
          audio[0].currentTime = 0;
          currentButton.text('Play');
        });
        audio.trigger('play');
        currentButton.text('Pause');
    } else {
        audio.trigger('pause');
        currentButton.text('Play');
    }
  });
});
