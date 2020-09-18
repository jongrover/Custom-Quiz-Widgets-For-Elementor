jQuery(function () {
  jQuery('.sentence').each(function (i, s) {
    var list_width = 0;
    jQuery(this).find('.supply-words').find('.word').each(function (i, w) {
      var item_width = jQuery(this).innerWidth();
      list_width += item_width;
    });
    jQuery(this).find('.place-words').width(list_width+11);
  });
  jQuery('.words').sortable({
    connectWith: '.place-words, .supply-words',
    beforeStop: function () {
      var answer = jQuery(this).parent().data('answer');
      if (jQuery(this).parent().find('.supply-words').text() === '') {
        jQuery(this).parent().find('.supply-words').css('height','0');
        var sentence_start = jQuery(this).parent().find('.sentence-start').text(),
            placed_words = jQuery(this).parent().find('.place-words').text(),
            sentence_end = jQuery(this).parent().find('.sentence-end').text(),
            solution = sentence_start+placed_words+sentence_end;
        if (solution === answer) {
          jQuery(this).parent().find('.place-words').css('{background: lime}');
          jQuery(this).parent().find('.response').html('<span style=\"background:lime;border:1px solid green;padding:3px 5px;\">Correct!</span>');
        } else {
          jQuery(this).parent().find('.place-words').css('{background: pink}');
          jQuery(this).parent().find('.response').html('<span style=\"background:pink;border:1px solid red;padding:3px 5px;\">Incorrect, try again!</span>');
        }
      }
    }
   });
  //jQuery('.words').disableSelection();
});
