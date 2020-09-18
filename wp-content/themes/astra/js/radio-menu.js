jQuery(function () {
  jQuery('.question-radio').find('input[name=answer-radio]').change(function () {
    var correct = jQuery(this).parent().data('correct');
    var answer = jQuery(this).parent().find('input[name=answer-radio]:checked').val();
    if (answer === correct) {
      jQuery(this).parent().next('.response').html('<span style=\"background:lime;border:1px solid green;padding:3px 5px;\">Correct!</span>');
    } else {
      jQuery(this).parent().next('.response').html('<span style=\"background:pink;border:1px solid red;padding:3px 5px;\">Incorrect, try again!</span>');
    }
  });
});
