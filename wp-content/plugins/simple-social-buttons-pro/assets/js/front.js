jQuery(window).load(function () {
	jQuery('.simplesocialbuttons__close').on('click', function () {
		var simplesocialbuttons_el = jQuery(this);
    jQuery(simplesocialbuttons_el).closest('.simplesocialbuttons-popup').removeClass('simplesocialbuttons--in simplesocialbuttons--open').addClass('simplesocialbuttons--out');
    
		setCookie("ssb_popup", 'hidden', ssb_settings.popup_time_interval);

		setTimeout(function () {
      jQuery(simplesocialbuttons_el).closest('.simplesocialbuttons-popup').removeClass('simplesocialbuttons--out').addClass('hidden').remove();
		}, 400);
	});
	function checkCookie() {
    var user = getCookie("ssb_popup");
		if (user.trim() == '') {
			jQuery('.simplesocialbuttons-popup').removeClass('ssb_hidden');
		}
	}
	checkCookie();
	jQuery('.simplesocialbuttons-popup').each(function () {
		if (jQuery(this).data('ssbscroll') == '') {
			jQuery(this).addClass('simplesocialbuttons--in simplesocialbuttons--open')
		}
	});
	jQuery('.simplesocialbuttons-flyin').addClass('simplesocialbuttons-flyin-in');

	jQuery('.ssb_social_media_wrapper>img').each(function () {
		var getWidth = jQuery(this).width();
		var el = jQuery(this);
		var getHeight = jQuery(this).height();
		var getClass = jQuery(this).attr('class');
		var getMargin = el.css('margin');
		var getPadding = el.css('padding');
		var image_position = jQuery(this).closest('.ssb_social_media_wrapper').position() - jQuery(this).position();
		image_position = image_position.left;
		jQuery(this).closest('.ssb_social_media_wrapper').find('.simplesocialbuttons').css('width', (parseInt(getWidth) - 40) + 'px');
		jQuery(this).closest('.ssb_social_media_wrapper').css({ 'margin': getMargin }).find('.simplesocialbuttons').css('max-height', (parseInt(getHeight) - 20) + 'px');
		if (getPadding !== '0px' || getMargin !== '0px') {
			jQuery(this).closest('.ssb_social_media_wrapper').addClass('has_ssb_spacing');
		}
		var image_left_offset = typeof image_position !== 'undefined' ? image_position : 0;
		if (0 !== image_left_offset) {
			jQuery(this).closest('.ssb_social_media_wrapper').find('.simplesocialbuttons').css({ 'top': getPadding, 'left': image_position + 20 });
		}
	});
});
jQuery(window).on('resize', function () {
	jQuery('.ssb_social_media_wrapper>img').each(function () {
		var getWidth = jQuery(this).width();
		var el = jQuery(this);
		var getHeight = jQuery(this).height();
		var getClass = jQuery(this).attr('class');
		var getMargin = el.css('margin');
		var getPadding = el.css('padding');
		var image_position = jQuery(this).closest('.ssb_social_media_wrapper').position() - jQuery(this).position();
		image_position = image_position.left;
		jQuery(this).closest('.ssb_social_media_wrapper').find('.simplesocialbuttons').css('width', (parseInt(getWidth) - 20) + 'px');
		jQuery(this).closest('.ssb_social_media_wrapper').css({ 'margin': getMargin }).find('.simplesocialbuttons').css('max-height', (parseInt(getHeight) - 20) + 'px');
		if (getPadding !== '0px' || getMargin !== '0px') {
			jQuery(this).closest('.ssb_social_media_wrapper').addClass('has_ssb_spacing');
		}
		var image_left_offset = typeof image_position !== 'undefined' ? image_position : 0;
		if (0 !== image_left_offset) {
			jQuery(this).closest('.ssb_social_media_wrapper').find('.simplesocialbuttons').css({ 'top': getPadding, 'left': image_position + 20 });
		}
	});
});
function setCookie(cname, cvalue, exMinutes) {
	var d = new Date();
	d.setTime(d.getTime() + (exMinutes * 60 * 1000));
	var expires = "expires=" + d.toGMTString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}
jQuery(document).ready(function ($) {
	$(document).on('click', '.simplesocialflyin__close', function () {
    var simplesocialbuttons_el = $(this);
    setCookie( 'flyin_time_interval', ssb_settings.flyin_time_interval ,ssb_settings.flyin_time_interval )
		$(simplesocialbuttons_el).closest('.simplesocialbuttons-flyin').removeClass('simplesocialbuttons-flyin-in');
  });

  if( ! getCookie( 'flyin_time_interval') ){
    
		$('.simplesocialbuttons-flyin').removeClass('simplesocialbuttons-flyin-hide');
  }

	if (ssb_settings.trigger_before_leaving == 1) {

		$(document).on('mouseleave', function () {
			$('.simplesocialbuttons-popup').addClass('simplesocialbuttons--in simplesocialbuttons--open');
		});
	}


	if (ssb_settings.trigger_after_scrolling == 1) {
		var lastScrollTop = 0;
		$(window).scroll(function (e) {
			var ssb_direction = 'direction';
			var ssb_scrollTop = $(window).scrollTop();
			var ssb_docHeight = $(document).height();
			var ssb_winHeight = $(window).height();
			var ssb_scrollPercent = (ssb_scrollTop) / (ssb_docHeight - ssb_winHeight);
			var ssb_scrollPercentRounded = Math.round(ssb_scrollPercent * 100);
			if (ssb_scrollTop > lastScrollTop) {
				ssb_direction = 'down';
			}
			lastScrollTop = ssb_scrollTop;
			// console.log($('.simplesocialbuttons-popup[data-ssbscroll]').length);
			$('.simplesocialbuttons-popup').each(function () {
				console.log($(this).data('ssbscroll'));
				console.log(ssb_scrollPercentRounded);
				console.log(ssb_direction);
				console.log(ssb_scrollPercentRounded >= $(this).data('ssbscroll') && ssb_direction == 'down');
				if ($(this).data('ssbscroll') > 1) {
					if (ssb_scrollPercentRounded >= $(this).data('ssbscroll') && ssb_direction == 'down') {
						$('.simplesocialbuttons-popup').addClass('simplesocialbuttons--in simplesocialbuttons--open');
					}
				}
			});
		});
	}
});

//use image alt attribute content used in media tweet button
if (ssb_settings.media_share == 'image-alt') {
	document.addEventListener('DOMContentLoaded', function () {

		var media = document.getElementsByClassName('ssb_social_media_wrapper');
		for (var i = 0; i < media.length; i++) {

			var img = media[i].querySelector('img'), alt = img.getAttribute('alt');
			var tweetButton = media[i].querySelector('.ssb_tweet-icon, .simplesocial-twt-share');
			var redditButton = media[i].querySelector('.ssb_reddit-icon, .simplesocial-reddit-share');
			if (alt !== '' && alt !== null) {
				if (tweetButton) {
					var dataHrefTwitter = tweetButton.getAttribute('data-href');
					var matchesTwitter = dataHrefTwitter.match(/text=([^&]*)/);
					var newDataHrefTwitter = dataHrefTwitter.replace(matchesTwitter[1], alt);
					tweetButton.setAttribute('data-href', newDataHrefTwitter);
				}
				if (redditButton) {
					var dataHrefReddit = redditButton.getAttribute('data-href');
					var matchesReddit = dataHrefReddit.match(/title=([^&]*)/);
					var newDataHrefReddit = dataHrefReddit.replace(matchesReddit[1], alt);
					redditButton.setAttribute('data-href', newDataHrefReddit);
				}
			}
		}
	});
}

//Fb media share change image on which user click.
if (ssb_settings.fb_id !== '') {
	window.fbAsyncInit = function () {
		FB.init({
			appId: ssb_settings.fb_id,
			autoLogAppEvents: true,
			xfbml: true,
			version: 'v3.2'
		});
		FB.AppEvents.logPageView();
	};

	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) { return; }
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));


	function shareOverrideOGMeta(overrideLink, overrideTitle, overrideDescription, overrideImage) {
		FB.ui({
			method: 'share_open_graph',
			action_type: 'og.shares',
			action_properties: JSON.stringify({
				object: {
					'og:url': overrideLink,
					'og:title': overrideTitle,
					'og:description': overrideDescription,
					'og:image:width': '600',
					'og:image:height': '314',
					'og:image': overrideImage,

				}
			})
		},
			function (response) {
				// Action after response
				console.log(response);
			});
	}
	window.onload = function () {

		// For media simple fb button.	
		document.querySelectorAll('.ssb_social_media_wrapper .simplesocial-fb-share').forEach(function (el) {
			el.removeAttribute("onclick");
			el.addEventListener('click', function () {
				var metaTitle = document.querySelector("meta[property='og:title']");
				var metaDescription = document.querySelector("meta[property='og:description']");
				var metaUrl = document.querySelector("meta[property='og:url']");
				var title = metaTitle ? metaTitle.getAttribute("content") : '';
				var description = metaDescription ?  metaDescription.getAttribute("content") : '';
				var url = metaUrl ? metaUrl.getAttribute("content") : '';

				if (ssb_settings.media_share == 'image-alt') {
					var alt = el.parentElement.parentElement.querySelector('img').getAttribute('alt');
					if (alt !== '' && alt !== null) {
						title = alt;
					}
				}

				shareOverrideOGMeta(url, title, description, this.parentElement.parentElement.getElementsByTagName('img')[0].getAttribute('src'));
			});
		});


		//For all medial fb share buttons.
		document.querySelectorAll('.ssb_social_media_wrapper .ssb_fbshare-icon').forEach(function (el) {
			el.removeAttribute("onclick");
			el.addEventListener('click', function () {
				var metaTitle = document.querySelector("meta[property='og:title']");
				var metaDescription = document.querySelector("meta[property='og:description']");
				var metaUrl = document.querySelector("meta[property='og:url']");
				var title = metaTitle ? metaTitle.getAttribute("content") : '';
				var description = metaDescription ?  metaDescription.getAttribute("content") : '';
				var url = metaUrl ? metaUrl.getAttribute("content") : '';
				shareOverrideOGMeta(url, title, description, this.parentElement.parentElement.getElementsByTagName('img')[0].getAttribute('src'));
			});
		});

	};// end on load function.

}