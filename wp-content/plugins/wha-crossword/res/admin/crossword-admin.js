jQuery(document).ready(function ($) {

    jQuery('#whacs_sidebar').removeClass('postbox');
    jQuery('#whacs_sidebar').find('.handlediv, .hndle.ui-sortable-handle').remove();

    var slider = $('.range-slider'),
        range = $('.range-slider__range'),
        value = $('.range-slider__value');

    slider.each(function(){

        value.each(function(){
            var value = $(this).prev().attr('value');
            $(this).html(value + 'px');
        });

        range.on('input', function(){
            $(this).next(value).html(this.value + 'px');
        });
    });

    jQuery("").click(function (event) {

    });
    jQuery(document).on('click', 'body .wha-crossword-row-admin .wha-add-crossword-item', function (event) {
        event.preventDefault();
        var data = '<div class="wha-crossword-item">' +
            '<div class="wha-crossword-block">' +
            '<div class="wha-crossword-inner"><label>' +crossword_vars_admin.clue +'</label><input type="text"  name="wha-crossword-clue[]" value="" required size="25" /></div>' +
            '<div class="wha-crossword-inner"><label>' +crossword_vars_admin.word +'</label><input type="text"  name="wha-crossword-word[]" value="" size="25" required /></div>' +
            '</div>' +
            '<a href="#" class="wha-delete-crossword-item">X</a>' +
            '</div>';
        jQuery(data).insertBefore("#wha-crossword-action-add");
        //jQuery('.crossword-row-admin > .crossword-item:last').append(data);
    });
    jQuery(document).on('click', 'body .wha-crossword-row-admin .wha-delete-crossword-item', function (event) {
        event.preventDefault();
        jQuery(this).parent().remove();

    });

    var useGlobalOptions = crossword_vars_admin.use_global_options;
    if (useGlobalOptions == 'yes') {
        jQuery('.wha-crossword-row-admin_single_options').css('display', 'none');
        jQuery('.editor_individual_wrap').css('display', 'none');
        jQuery('.adm_divider').css('display', 'none');
    } else {
        jQuery('.wha-crossword-row-admin_single_options').css('display', 'block');
        jQuery('.editor_individual_wrap').css('display', 'block');
        jQuery('.adm_divider').css('display', 'block');
    }

    //Hide or show block Use Global Options ---
    $('.global-options-yes').click(function (e) {
        $('.wha-crossword-row-admin_single_options,.editor_individual_wrap').fadeOut(500);
    });
    $('.global-options-no').click(function (e) {
        $('.wha-crossword-row-admin_single_options,.editor_individual_wrap').fadeIn(500);
    });



});