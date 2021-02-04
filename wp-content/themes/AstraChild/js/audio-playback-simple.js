jQuery(function () {
  jQuery(document).on('click', '.plyButton', function (event) {
    event.preventDefault();
    var currentPlayButton = jQuery(this),
        refParent = jQuery(this).parent(),
        audio = refParent.find('audio');
    currentPlayButton.text('Playing...');
    //console.log('playButton clicked');
    audio[0].addEventListener("ended", function(){
      //console.log('audio ended');
      audio[0].pause();
      audio[0].currentTime = 0;
      currentPlayButton.text('Play');
    });
    audio[0].play();
  });
});
