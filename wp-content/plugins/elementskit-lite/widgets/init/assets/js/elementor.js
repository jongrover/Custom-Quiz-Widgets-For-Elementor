(function ($, elementor) {
	"use strict";

	var ElementsKit = {

		init: function () {

			var widgets = {
				'elementskit-blog-posts.default': ElementsKit.BlogPosts,
				'elementskit-countdown-timer.default': ElementsKit.Countdown_Timer,
				'elementskit-client-logo.default': ElementsKit.Client_Logo,
				'elementskit-testimonial.default': ElementsKit.Testimonial_Slider,
				'elementskit-image-comparison.default': ElementsKit.Image_Comparison,
				'elementskit-progressbar.default': ElementsKit.Progressbar,
				'elementskit-piechart.default': ElementsKit.Piechart,
				'elementskit-funfact.default': ElementsKit.Funfact,
				'elementskit-gallery.default': ElementsKit.Gallery,
				'elementskit-motion-text.default': ElementsKit.MotionText,
				'elementskit-timeline.default': ElementsKit.TimeLine,
				'elementskit-post-tab.default': ElementsKit.PostTab,
				'elementskit-header-search.default': ElementsKit.Header_Search,
				'elementskit-header-offcanvas.default': ElementsKit.Header_Off_Canvas,
				'elementskit-table.default': ElementsKit.Table,
				'elementskit-creative-button.default': ElementsKit.Creative_Button,
				'ekit-nav-menu.default': ElementsKit.Nav_Menu,
				'elementskit-woo-mini-cart.default': ElementsKit.Mini_Cart,
				'elementskit-team.default': ElementsKit.Team,
				'elementskit-woo-product-carousel.default': ElementsKit.Woo_Product_slider,
				'elementskit-hotspot.default': ElementsKit.Hotspot,
				'ekit-vertical-menu.default': ElementsKit.Vertical_Menu,
				'elementskit-advanced-toggle.default': ElementsKit.Advanced_Toggle,
				'elementskit-video-gallery.default': ElementsKit.Video_Gallery,
				'elementskit-facebook-review.default': ElementsKit.Facebook_Review,
				'elementskit-yelp.default': ElementsKit.Yelp_Review,
				'elementskit-zoom.default': ElementsKit.Zoom,
				'elementskit-popup-modal.default': ElementsKit.PopupModal,
				'elementskit-zoom.default': ElementsKit.Zoom,
				'elementskit-unfold.default': ElementsKit.Unfold
			};
			$.each(widgets, function (widget, callback) {
				elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
			});
		},

        PopupModal: function ($scope){
            $($scope).find('#ekit-popup-modal-toggler').click(function() {
                $($scope).find('.ekit-popup-modal').addClass('show')
            })
            $($scope).find('.ekit-popup-modal__overlay').click(function() {
                $($scope).find('.ekit-popup-modal').removeClass('show')
            })
            $($scope).find('.ekit-popup-modal__close').click(function() {
                $($scope).find('.ekit-popup-modal').removeClass('show')
            })
        },

		Social_Review_Slider: function ($sliders) {
			$sliders.each(function () {
				let prevArrow = '<span type="button" class="slick-prev"></span>';
				let nextArrow = '<span type="button" class="slick-next"></span>';
				let arrow = $(this).data('showarrow') === 'yes' ? true : false;
				let dot = $(this).data('showdot') === 'yes' ? true : false;
				let autoplay = ($(this).data('autoplay') && $(this).data('autoplay') === 'yes') ? true : false;

				let config = {
					autoplay, prevArrow, nextArrow,
					slidesToShow: ($(this).data('slidestoshow') !== 'undefined') ? $(this).data('slidestoshow') : 1,
					slidesToScroll: ($(this).data('slidestoscroll') !== 'undefined') ? $(this).data('slidestoscroll') : 1,
					autoplaySpeed: ($(this).data('speed') !== 'undefined') ? $(this).data('speed') : 1000,
					arrows: ($(this).data('showarrow') !== 'undefined') ? arrow : true,
					dots: ($(this).data('showdot') !== 'undefined') ? dot : true,
					pauseOnHover: ($(this).data('pauseonhover') == 'yes') ? true : false,
					infinite: ($(this).data('autoplay') !== 'undefined') ? autoplay : true,
				}
				$(this).slick(config);
			})
		},
        
        Handle_Review_More: function ($scope) {
            $($scope).find('.more').each(function () {
				$(this).click(() => {
					let span = $($(this).parent().get(0)).find('span').first()
					if ($(this).data('collapsed') === true) {
						$(span).text($(this).data('text'))
						$(this).text('...Collapse')
					}
					else {
						$(span).text($(this).data('text').substr(0, 120))
						$(this).text('...More')
					}
					$(this).data('collapsed', !$(this).data('collapsed'))
				})
			})
        },

		Facebook_Review: function ($scope) {
			ElementsKit.Social_Review_Slider($scope.find('.ekit-review-slider-wrapper-facebook'))
			ElementsKit.Handle_Review_More($scope)
        },
    
		Yelp_Review: function ($scope) {
			ElementsKit.Social_Review_Slider($scope.find('.ekit-review-slider-wrapper-yelp'))
            ElementsKit.Handle_Review_More($scope)
		},
		
		Zoom: function( $scope ){
			var el = $scope.find('.ekit-zoom-counter'),
				custom_settings = $scope.find('.ekit-zoom-wrapper').data('settings');

			if(!el.length){ return false; }
			var dateText = el.data('date');
			// Set the date we're counting down to
			var countDownDate = new Date(dateText).getTime();
			if(!countDownDate){ countDownDate = 0; }

			// Update the count down every 1 second
			var x = setInterval(function() {

			// Get today's date and time
			var now = new Date().getTime();
				
			// Find the distance between now and the count down date
			var distance = countDownDate - now;
				
			// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
			var output = "<ul><li><span class='number'>"+ days +"</span><span class='text'>"+ custom_settings.days +"</span></li><li><span class='number'>"+ hours +"</span><span class='text'>"+ custom_settings.hours +"</span></li><li><span class='number'>"+ minutes +"</span><span class='text'>"+ custom_settings.minutes +"</span></li><li><span class='number'>"+ seconds +"</span><span class='text'>"+ custom_settings.seconds +"</span></li></ul>";
			// Output the result in an element with id="demo"
			el.html( output );
				
			// If the count down is over, write some text 
			if (distance < 0) {
				clearInterval(x);
				el.html( "EXPIRED" );
			}
			}, 1000);
		},

		Nav_Menu: function ($scope) {
			if($scope.find('.elementskit-menu-container').length > 0) {
				let icon_container = $scope.find('.ekit-wid-con'),
					icon = icon_container.data('hamburger-icon'),
					hamburger_type = icon_container.data('hamburger-icon-type');

				$scope.find('.elementskit-menu-container').each(function () {
					let menu_container = $(this);
					if(menu_container.attr('ekit-dom-added') == 'yes') {
						return;
					}
					let iconmarkup = [];
					if(icon === '' || icon === undefined) {
						iconmarkup += '<span class="elementskit-menu-hamburger-icon"></span><span class="elementskit-menu-hamburger-icon"></span><span class="elementskit-menu-hamburger-icon"></span>';
					} else {
						if(hamburger_type === 'url') {
							iconmarkup += '<img src="' + icon + '" alt="hamburger icon" />'
						} else {
							iconmarkup += '<div class="ekit-menu-icon ' + icon + '"></div>'
						}
					}
					menu_container
						.before(
							'<button class="elementskit-menu-hamburger elementskit-menu-toggler">' + iconmarkup + '</button>'
						)
						.after('<div class="elementskit-menu-overlay elementskit-menu-offcanvas-elements elementskit-menu-toggler"></div>')
						.attr('ekit-dom-added', 'yes');
				});
			}


			if($scope.find('.elementskit-megamenu-has').length > 0) {
				let date_breakpoint = $scope.find('.ekit-wid-con').data('responsive-breakpoint');
				let target = $scope.find('.elementskit-megamenu-has');
				let menu_height = $scope.find('.elementskit-menu-container').outerHeight();

				$(window).on('resize', function () {
					$scope.find('.elementskit-megamenu-panel').css({
						top: menu_height
					})
				}).trigger('resize');

				target.each(function () {
					let data_width = $(this).data('vertical-menu'),
						megamenu_panel = $(this).children('.elementskit-megamenu-panel');

					if($(this).hasClass('elementskit-dropdown-menu-full_width') && $(this).hasClass('top_position')) {
						let left_pos = Math.floor($(this).position().left - $(this).offset().left);
						let $this = $(this);
						$(window).on('resize', function () {
							$this.find('.elementskit-megamenu-panel').css({
								left: left_pos + 'px'
							})
						}).trigger('resize');
					}

					if (!$(this).hasClass('elementskit-dropdown-menu-full_width') && $(this).hasClass('top_position')) {
                        $(this).on({
                            mouseenter: function() {
                                if ($('.default_menu_position').length === 0) {
                                    $(this).parents('.elementor-section-wrap').addClass('default_menu_position');
                                }
                            },
                            mouseleave: function() {
                                if ($('.default_menu_position').length !== 0) {
                                    $(this).parents('.elementor-section-wrap').removeClass('default_menu_position');
                                }
                            }
                        })
                    }

					if(data_width && data_width !== undefined) {
						if(typeof data_width === 'string') {
							if(/^[0-9]/.test(data_width)) {
								$(window).on('resize', function () {
									megamenu_panel.css({
										width: data_width
									})
									if(!($(document).width() > Number(date_breakpoint))) {
										megamenu_panel.removeAttr('style');
									}
								}).trigger('resize');
							} else {
								$(window).on('resize', function () {
									megamenu_panel.css({
										width: data_width + 'px'
									})
									if(!($(document).width() > Number(date_breakpoint))) {
										megamenu_panel.removeAttr('style');
									}
								}).trigger('resize');
							}
						} else {
							megamenu_panel.css({
								width: data_width + 'px'
							})
						}
					} else {
						$(window).on('resize', function () {
							megamenu_panel.css({
								width: data_width + 'px'
							})
							if(!($(document).width() > Number(date_breakpoint))) {
								megamenu_panel.removeAttr('style');
							}
						}).trigger('resize');
					}
				})
			}
		},

		Mini_Cart: function ($scope) {
			$scope.find(".ekit-dropdown-back").on('click mouseenter mouseleave', function (e) {
				var self = $(this),
					enableClick = self.hasClass('ekit-mini-cart-visibility-click'),
					enableHover = self.hasClass('ekit-mini-cart-visibility-hover'),
					body = self.find('.ekit-mini-cart-container');


				if(e.type === 'click' && enableClick && !$(e.target).parents('div').hasClass('ekit-mini-cart-container')) {
					body.fadeToggle();
				} else if(e.type === 'mouseenter' && enableHover) {
					body.fadeIn();
				} else if(e.type === 'mouseleave' && enableHover) {
					body.fadeOut();
				}

			});
		},

		Progressbar: function ($scope) {
			var $skillBar = $scope.find('.single-skill-bar'),
				$track = $skillBar.find('.skill-track'),
				$number = $skillBar.find('.number-percentage'),
				value = $number.data('value'),
				duration = $number.data('animation-duration') || 300;

			$skillBar.elementorWaypoint(function () {
				$number.animateNumbers(value, true, duration);

				$track.animate({
					width: value + '%'
				}, 3500);
			}, { offset: '100%' });
		},

		Funfact: function ($scope) {
			var $funfact = $scope.find('.elementskit-funfact'),
				$number = $funfact.find(".number-percentage"),
				value = $number.data('value'),
				duration = $number.data('animation-duration') || 300;

			$funfact.elementorWaypoint(function () {
				$number.animateNumbers(value, true, duration);
			}, { offset: '100%' });
		},

		BlogPosts: function ($scope) {
			var $postItems = $scope.find('.post-items'),
				isMasonry = $postItems.data('masonry-config');

			if (isMasonry) {
				$postItems.imagesLoaded(function () {
					$postItems.masonry();
				});
			}
		},

		Countdown_Timer: function ($scope) {
			var $el = $scope.find('.ekit-countdown'),
				config = $el.data(),
				elClasses = {
					inner: 'elementskit-inner-container ekit-countdown-inner',
					inner2: 'elementskit-inner-container',
					timer: 'elementskit-timer-content ekit-countdown-inner',
				};
			
			if ($el.length) {
				switch ($el[0].classList[0]) {
					case 'elementskit-countdown-timer':
						config.markup = '<div class="elementskit-timer-container elementskit-days"><div class="'+ elClasses.inner +'"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%-D </span><span class="elementskit-timer-title">' + config.dateEkitDay + '</span></div></div></div>'
							+	'<div class="elementskit-timer-container elementskit-hours"><div class="'+ elClasses.inner +'"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%H </span><span class="elementskit-timer-title">' + config.dateEkitHour + '</span></div></div></div>'
							+	'<div class="elementskit-timer-container elementskit-minutes"><div class="'+ elClasses.inner +'"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%M </span><span class="elementskit-timer-title">' + config.dateEkitMinute + '</span></div></div></div>'
							+	'<div class="elementskit-timer-container elementskit-seconds"><div class="'+ elClasses.inner +'"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%S </span><span class="elementskit-timer-title">' + config.dateEkitSecond + '</span></div></div></div>';
						break;
				
					case 'elementskit-countdown-timer-3':
						config.markup = '<div class="elementskit-timer-container elementskit-days"><div class="'+ elClasses.timer +'"><div class="'+ elClasses.inner2 +'"><span class="elementskit-timer-count">%-D </span><span class="elementskit-timer-title">' + config.dateEkitDay + '</span></div></div></div>'
							+	'<div class="elementskit-timer-container elementskit-hours"><div class="'+ elClasses.timer +'"><div class="'+ elClasses.inner2 +'"><span class="elementskit-timer-count">%H </span><span class="elementskit-timer-title">' + config.dateEkitHour + '</span></div></div></div>'
							+	'<div class="elementskit-timer-container elementskit-minutes"><div class="'+ elClasses.timer +'"><div class="'+ elClasses.inner2 +'"><span class="elementskit-timer-count">%M </span><span class="elementskit-timer-title">' + config.dateEkitMinute + '</span></div></div></div>'
							+	'<div class="elementskit-timer-container elementskit-seconds"><div class="'+ elClasses.timer +'"><div class="'+ elClasses.inner2 +'"><span class="elementskit-timer-count">%S </span><span class="elementskit-timer-title">' + config.dateEkitSecond + '</span></div></div></div>';
						break;
				
					default:
						config.markup = '<div class="elementskit-timer-container elementskit-days"><div class="'+ elClasses.inner +'"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%-D </span><span class="elementskit-timer-title">' + config.dateEkitDay + '</span></div></div></div>'
							+	'<div class="elementskit-timer-container elementskit-hours"><div class="'+ elClasses.inner +'"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%H </span><span class="elementskit-timer-title">' + config.dateEkitHour + '</span></div></div></div>'
							+	'<div class="elementskit-timer-container elementskit-minutes"><div class="'+ elClasses.inner +'"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%M </span><span class="elementskit-timer-title">' + config.dateEkitMinute + '</span></div></div></div>'
							+	'<div class="elementskit-timer-container elementskit-seconds"><div class="'+ elClasses.inner +'"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%S </span><span class="elementskit-timer-title">' + config.dateEkitSecond + '</span></div></div></div>';
						break;
				}

				$el.theFinalCountdown(config.ekitCountdown, function (e) {
					this.innerHTML = e.strftime(config.markup);
				}).on('finish.countdown', function () {
					this.innerHTML = config.finishTitle + '<br />' + config.finishContent;

					if (this.classList[0] === 'elementskit-countdown-timer-4') {
						$(this).addClass('elementskit-coundown-finish');
					}
				});
			}

			var $flip = $scope.find('.elementskit-flip-clock'),
				flipConfig = $flip.data();

			if ($flip.length) {
				var labels = [flipConfig.dateEkitWeek, flipConfig.dateEkitDay, flipConfig.dateEkitHour, flipConfig.dateEkitMinute, flipConfig.dateEkitSecond],
					labelsClass = ['elementskit-wks', 'elementskit-days', 'elementskit-hrs', 'elementskit-mins', 'elementskit-secs'],
					markup = '';

				labels.forEach(function (label, i) {
					markup += '<div class="elementskit-time ' + labelsClass[i] + ' ekit-countdown-inner">'
						+ '<span class="elementskit-count elementskit-curr elementskit-top"></span>'
						+ '<span class="elementskit-count elementskit-next elementskit-top"></span>'
						+ '<span class="elementskit-count elementskit-next elementskit-bottom"></span>'
						+ '<span class="elementskit-count elementskit-curr elementskit-bottom"></span>'
						+ '<span class="elementskit-label">'+ label +'</span>'
						+ '</div>';
				});

				$flip.html(markup);
				
				var $min = $flip.children('.elementskit-mins'),
					$sec = $flip.children('.elementskit-secs'),
					$hrs = $flip.children('.elementskit-hrs'),
					$days = $flip.children('.elementskit-days'),
					$wks = $flip.children('.elementskit-wks'),
					timer = {
						s: '',
						m: '',
						h: '',
						d: '',
						w: ''
					};

				var updater = function (before, current, $target) {
					if (before === current) return;

					before = before.toString().length === 1 ? '0' + before : before;
					current = current.toString().length === 1 ? '0' + current : current;
					
					$target.removeClass('elementskit-flip');

					$target.children('.elementskit-curr').text(before);
					$target.children('.elementskit-next').text(current);

					setTimeout(function ($target) {
						$target.addClass('elementskit-flip');
					}, 50, $target);
				};

				$flip.theFinalCountdown(flipConfig.ekitCountdown, function (e) {
					updater(timer.s, e.offset.seconds, $sec);
					updater(timer.m, e.offset.minutes, $min);
					updater(timer.h, e.offset.hours, $hrs);
					updater(timer.d, e.offset.days, $days);
					updater(timer.w, e.offset.weeks, $wks);

					timer.s = e.offset.seconds;
					timer.m = e.offset.minutes;
					timer.h = e.offset.hours;
					timer.d = e.offset.days;
					timer.w = e.offset.weeks;
				}).on('finish.countdown', function () {
					this.innerHTML = flipConfig.finishTitle + '<br/>' + flipConfig.finishContent;
				});
			}
		},

		Client_Logo: function ($scope) {
			var $el = $scope.find('.elementskit-clients-slider'),
				config = $el.data('config');

			// Arrows
			config.prevArrow = '<button type="button" class="slick-prev"><i class="' + (config.prevArrow || 'icon icon-left-arrow2') + '"></i></button>';
			config.nextArrow = '<button type="button" class="slick-next"><i class="' + (config.nextArrow || 'icon icon-right-arrow2') + '"></i></button>';

			// Slick
			$el.slick(config);
		},

		Testimonial_Slider: function ($scope) {
			var $el = $scope.find('.elementskit-testimonial-slider'),
				config = $el.data('config');
			
			// Arrows
			config.prevArrow = '<button type="button" class="slick-prev"><i class="'+ (config.prevArrow || 'icon icon-left-arrow2') +'"></i></button>';
			config.nextArrow = '<button type="button" class="slick-next"><i class="'+ (config.nextArrow || 'icon icon-right-arrow2') +'"></i></button>';

			// Slick
			$el.slick(config);
		},

		Image_Comparison: function ($scope) {
			var $el = $scope.find('.elementskit-image-comparison');

			$el.imagesLoaded(function () {
				var config = {
					orientation: $el.hasClass('image-comparison-container-vertical') ? 'vertical' : 'horizontal',
					before_label: $el.data('label_before'),
					after_label: $el.data('label_after'),
					default_offset_pct: $el.data('offset'),
					no_overlay: $el.data('overlay'),
					move_slider_on_hover: $el.data('move_slider_on_hover'),
					click_to_move: $el.data('click_to_move')
				};

				$el.twentytwenty(config);
			});
		},

		Piechart: function ($scope) {
			var $el = $scope.find('.colorful-chart'),
				data = $el.data(),
				config = {
					barColor: data.color,
					lineWidth: data.linewidth,
					trackColor: data.barbg
				};
			
			if ('pie_color_style' in data) {
				config = {
					gradientChart: true,
					barColor: data.gradientcolor1,
					gradientColor1: data.gradientcolor2,
					gradientColor2: data.gradientcolor1,
					lineWidth: data.linewidth,
					trackColor: data.barbg
				};
			}

			$el.myChart(config);
		},

		Gallery: function ($scope) {
			var $galleryGrid = $scope.find('.ekit_gallery_grid'),
				masonryConfig = $galleryGrid.data('grid-config');
			
			$galleryGrid.imagesLoaded(function () {
				$galleryGrid.isotope(masonryConfig);
			});
			

			// Filter List
			var $filterList = $scope.find('.filter-button-wraper'),
				$filterLinks = $filterList.find('a');
			
			$filterLinks.on('click', function (e) {
				e.preventDefault();

				var $this = $(this);
				
				$this.parents('.option-set').find('.selected').removeClass('selected');
				$this.addClass('selected');
				
				$galleryGrid.isotope({
					filter: $this.data('option-value')
				});
			});
			

			// Tilt Effect
			var $tiltTargets = $scope.find('.ekit-gallery-portfolio-tilt'),
				tiltConfig = $galleryGrid.data('tilt-config');
			
			$tiltTargets.tilt(tiltConfig);
		},

		MotionText: function ($scope) {
			var $title = $scope.find('.ekit_motion_text_title');

			if ($title.hasClass('ekit_char_based')) {
				var $text = $title.children('.ekit_motion_text'),
					text = $text.text().split(''),
					delay = $title.data('ekit-animation-delay-s'),
					delayCache = delay,
					markup = '';

				$.each(text, function (i, char) {
					markup += (char === ' ') ? char : '<span class="ekit-letter" style="animation-delay: ' + delay + 'ms; -moz-animation-delay: ' + delay + 'ms; -webkit-animation-delay: ' + delay + 'ms;">' + char + '</span>';
					delay += delayCache;
				});

				$text.html(markup);
			}

			$title.elementorWaypoint(function () {
				var animateClass = this.adapter.$element.data('animate-class');

				this.adapter.$element.addClass(animateClass).css('opacity', 1);
				this.destroy();
			}, { offset: '100%' });
		},

		TimeLine: function ($scope) {
			var $el = $scope.find('.elementskit-invisible'),
				doAnimate = function () {
					if (this.adapter.$element.hasClass('animated')) {
						this.destroy();
						return;
					}

					var animationClass = 'animated ' + this.adapter.$element.data('settings')._animation;
					this.adapter.$element.removeClass('elementskit-invisible').addClass(animationClass);
				};

			$el.elementorWaypoint(doAnimate, { continuous: false });
			$el.elementorWaypoint(doAnimate, { offset: 'bottom-in-view', continuous: false });

			$scope.on('mouseenter', '.horizantal-timeline > .single-timeline', function () {
				$(this).addClass('hover').siblings().removeClass('hover');
			}).on('mouseleave', '.horizantal-timeline > .single-timeline', function () {
				$(this).removeClass('hover');
			});
		},

		PostTab: function ($scope) {
			var evt = $scope.hasClass('is-click-yes') ? 'click' : 'mouseenter',
				$listItem = $scope.find('.tab__list__item'),
				$tabItem = $scope.find('.tabItem');

			$scope.on(evt, '.tab__list__item', function () {
				var $el = $(this),
					$curTabItem = $tabItem.eq( $el.index() );

				$listItem.add($tabItem).removeClass('active');
				$el.add( $curTabItem ).addClass('active');
			});
		},

		Hotspot: function ($scope) {
			var $el = $scope.find('.ekit-location-on-click > .ekit-location_indicator');
			
			$el.on('click', function () {
				$(this).parent().toggleClass('active');
			});
		},

		Header_Search: function ($scope) {
			var $btn = $scope.find('.ekit_navsearch-button'),
				$body = $('body');
			
			$btn.magnificPopup({
				type: 'inline',
				fixedContentPos: true,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: false,
				prependTo: $btn.parent('.ekit-wid-con'),
				callbacks: {
					beforeOpen: function () {
						this.st.mainClass = "my-mfp-slide-bottom ekit-promo-popup";
					},
					open: function() {
						$body.css('overflow', 'hidden');
					},
					close: function() {
						$body.css('overflow', 'auto');
					}
				}
			});
		},

		Team: function ($scope) {
			var $el = $scope.find('.ekit-team-popup');

			$el.magnificPopup({
				type: 'inline',
				fixedContentPos: true,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				prependTo: $scope.find('.ekit-wid-con'),
				showCloseBtn: false,
				callbacks: {
					beforeOpen: function () {
						this.st.mainClass = 'my-mfp-slide-bottom ekit-promo-popup ekit-team-modal';
					}
				}
			});

			$scope.find('.ekit-team-modal-close').on('click', function () {
				$el.magnificPopup('close');
			});
		},

		Table: function ($scope) {
			if($scope.find('.ekit_table').length > 0) {
				var settings = $scope.find('.ekit_table').data('settings'),
					prevText = (settings.nav_style.trim() === 'text' || settings.nav_style.trim() === 'both') ? '<span class="ekit-tbl-pagi-nav ekit-tbl-pagi-prev">' + settings.prev_text + '</span>' : '',
					nextText = (settings.nav_style.trim() === 'text' || settings.nav_style.trim() === 'both') ? '<span class="ekit-tbl-pagi-nav ekit-tbl-pagi-next">' + settings.next_text + '</span>' : '',
					prevArrow = (settings.nav_style.trim() === 'arrow' || settings.nav_style.trim() === 'both') ? '<i class="ekit-tbl-pagi-nav-icon ekit-tbl-pagi-nav-prev-icon ' + settings.prev_arrow + '" aria-hidden="true"></i>' : '',
					nextArrow = (settings.nav_style.trim() === 'arrow' || settings.nav_style.trim() === 'both') ? '<i class="ekit-tbl-pagi-nav-icon ekit-tbl-pagi-nav-next-icon ' + settings.next_arrow + '" aria-hidden="true"></i>' : '';

				$(window).trigger('resize');

				var tableConfig = {
					buttons: settings.button === true ? ['copy', 'excel', 'csv'] : [],
					bFilter: settings.search,
					autoFill: true, //don't know
					pageLength: settings.item_per_page ? settings.item_per_page : 1,
					fixedHeader: settings.fixedHeader,
					responsive: settings.responsive,
					paging: settings.pagination,
					ordering: settings.ordering,
					info: settings.info,
					"language": {
						search: '<span class="ekit-table-search-label"><i class="fa fa-search" aria-hidden="true"></i></span>',
						searchPlaceholder: 'Type Here To Search...',
						paginate: {
							next: nextText + nextArrow,
							previous: prevArrow + prevText
						}
					}
				}

				if(settings.entries === false) {
					tableConfig.dom = 'Bfrtip';
				}

				$scope.find('.ekit_table table').DataTable(tableConfig);
			}
		},

		Header_Off_Canvas: function ($scope) {
			var $sidebar = $scope.find('.ekit-sidebar-group'),
				$btns = $scope.find('.ekit_offcanvas-sidebar, .ekit_close-side-widget, .ekit-overlay');

			$btns.on('click', function (e) {
				e.preventDefault();

				$sidebar.toggleClass('ekit_isActive');
			});
		},

		Creative_Button: function ($scope) {
			var $btnBg = $scope.find('.ekit_position_aware_bg');

			$scope.on('mouseenter mouseleave', '.ekit_position_aware', function (e) {
				var parentOffset = $(this).offset(),
					relX = e.pageX - parentOffset.left,
					relY = e.pageY - parentOffset.top;

				$btnBg.css({
					top: relY,
					left: relX
				});
			});
		},

		Woo_Product_slider: function ($scope) {
			let target = $scope.find('.ekit-swiper-container'),
				autoplay = target.data('autoplay'),
				loop = target.data('loop'),
				speed = target.data('speed'),
				spaceBetween = target.data('space-between'),
				respoonsive_seetings = target.data('responsive-settings');


			new Swiper(target, {
				navigation: {
					nextEl: $scope.find('.ekit-navigation-next'),
					prevEl: $scope.find('.ekit-navigation-prev'),
				},
				pagination: {
					el: $scope.find('.ekit-swiper-pagination'),
					type: 'bullets',
					clickable: true,
				},
				"autoplay": autoplay && autoplay,
				"loop": loop && Boolean(loop),
				"speed": speed && Number(speed),
				"slidesPerView": Number(respoonsive_seetings['ekit_columns_mobile']),
				"spaceBetween": spaceBetween && Number(spaceBetween),
				breakpointsInverse: true,
				"breakpoints": {
					640: {
						"slidesPerView": Number(respoonsive_seetings['ekit_columns_mobile']),
						"spaceBetween": spaceBetween && Number(spaceBetween),
					},
					768: {
						"slidesPerView": Number(respoonsive_seetings['ekit_columns_tablet']),
						"spaceBetween": spaceBetween && Number(spaceBetween),
					},
					1024: {
						"slidesPerView": Number(respoonsive_seetings['ekit_columns_desktop']),
						"spaceBetween": spaceBetween && Number(spaceBetween),
					},
				}
			});
		},

		Vertical_Menu: function ($scope) {
			if($scope.find('.ekit-vertical-main-menu-on-click').length > 0) {
				let menu_container = $scope.find('.ekit-vertical-main-menu-on-click'),
					target = $scope.find('.ekit-vertical-menu-tigger');

				target.on('click', function (e) {
					e.preventDefault();
					menu_container.toggleClass('vertical-menu-active');
				})
			}

			if($scope.find('.elementskit-megamenu-has').length > 0) {
				let target = $scope.find('.elementskit-megamenu-has'),
					parents_container = $scope.parents('.elementor-container'),
					vertical_menu_wraper = $scope.find('.ekit-vertical-main-menu-wraper'),
					final_width = Math.floor((parents_container.width() - vertical_menu_wraper.width())) + 'px';

				target.on('hover',function () {
					let data_width = $(this).data('vertical-menu'),
						megamenu_panel = $(this).children('.elementskit-megamenu-panel');

					if(data_width && data_width !== undefined && !(final_width <= data_width)) {
						if(typeof data_width === 'string') {
							if(/^[0-9]/.test(data_width)) {
								megamenu_panel.css({
									width: data_width
								})
							} else {
								$(window).bind('resize', function () {
									if($(document).width() > 1024) {
										megamenu_panel.css({
											width: Math.floor((parents_container.width() - vertical_menu_wraper.width()) - 10) + 'px'
										})
									} else {
										megamenu_panel.removeAttr('style');
									}
								}).trigger('resize');
							}
						} else {
							megamenu_panel.css({
								width: data_width + 'px'
							})
						}
					} else {
						$(window).bind('resize', function () {
							if($(document).width() > 1024) {
								megamenu_panel.css({
									width: Math.floor((parents_container.width() - vertical_menu_wraper.width()) - 10) + 'px'
								})
							} else {
								megamenu_panel.removeAttr('style');
							}
						}).trigger('resize');
					}
				})
			}
		},
		Advanced_Toggle: function ($scope) {
			if($scope.find('.elemenetskit-toggle-indicator').length > 0) {
				let target = $scope.find('.elemenetskit-toggle-indicator'),
					active_item = $scope.find('.elementskit-toggle-nav-link.active');

				function toggle_indicator(type, current) {
					let item_width = type === 'click' ? current.outerWidth() : active_item.outerWidth(),
						item_height = type === 'click' ? current.outerHeight() : active_item.outerHeight(),
						item_left = type === 'click' ? current.position().left : active_item.position().left,
						item_top = type === 'click' ? current.position().top : active_item.position().top,
						background_color = type === 'click' ? current.data('indicator-color') : active_item.data('indicator-color');

					target.css({
						width: item_width,
						height: item_height,
						left: item_left,
						top: item_top,
						backgroundColor: background_color
					})
				}

				toggle_indicator();

				$scope.find('.elementkit-tab-nav > li > a').on('click', function (event) {
					toggle_indicator(event.type, $(this));
				})
			}

			function toggleSwitch(type, current, checked) {
				if(type === 'click') {
					current.parents('.ekit-slide-toggle').find('input[type="checkbox"]').prop("checked", checked);
				}
				if(type === 'change') {
					let target_link = current.parents('.ekit-slide-toggle').find('.elementskit-switch-nav-link')
					$scope.find('.ekit-toggle-switch-content').removeClass('active show');
					$scope.find('.elementskit-switch-nav-link').removeClass('active');
					if(current.context.checked) {
						$(target_link[1].hash).addClass('active show')
						target_link.eq(1).addClass('active');
					} else {
						$(target_link[0].hash).addClass('active show')
						target_link.eq(0).addClass('active');
					}
				}
			}

			if($scope.find('.ekit-slide-toggle-wraper').length > 0) {
				$scope.find('.elementskit-switch-nav-link').eq(0).on('click', function (e) {
					toggleSwitch(e.type, $(this), false);
				})
				$scope.find('.elementskit-switch-nav-link').eq(1).on('click', function (e) {
					toggleSwitch(e.type, $(this), true);
				})
				$scope.find('input[type="checkbox"]').on('change', function (e) {
					toggleSwitch(e.type, $(this))
				});
				$scope.find('.ekit-cehckbox-forcefully-checked').parents('.ekit-slide-toggle').find('input[type="checkbox"]').prop("checked", true);
			}
		},
		Video_Gallery: function ($scope) {
			var popup = $scope.find('.video-link.popup'),
				inline = $scope.find('.video-link.inline'),
				isotopeEl = $scope.find('.ekit-video-gallery-wrapper.ekit-masonry'),
				filterEl = $scope.find('.elementskit-main-filter>li>a'),
				carouselEl = $scope.find('.ekit-video-gallery.ekit-carousel'),
				config = carouselEl.data('config');

			if(popup.length > 0) {
				popup.magnificPopup({
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: true,
					fixedContentPos: false,
					iframe: {
						markup: '<div class="mfp-iframe-scaler">' +
						'<div class="mfp-close"></div>' +
						'<iframe class="mfp-iframe" frameborder="0" allow="autoplay"></iframe>' +
						'</div>',
						patterns: {
							youtube: {
								index: 'youtube.com/',
								id: 'v=',
								src: 'https://www.youtube.com/embed/%id%?autoplay=1&rel=0'
							}
						}
					}
				});
			}

			inline.on('click', function (e) {
				e.preventDefault();
				var url = $(this).data('url');
				$(this).addClass('video-added').append('<iframe src="' + url + '" width="643" height="360" allow="autoplay" frameborder="0"></iframe>');
			});

			filterEl.on('click', function (e) {
				e.preventDefault();
				var slug = $(this).data('value') ? '.' + $(this).data('value') : '';
				$scope.find('a').removeClass('selected');
				$(this).addClass('selected');
				$scope.find('.ekit-video-item').hide();
				$scope.find('.ekit-video-item' + slug).fadeIn();
			});

			// Slick
			if(carouselEl.length) {
				config.prevArrow = '<button type="button" class="slick-prev"><i class="' + (config.prevArrow || 'icon icon-left-arrow2') + '"></i></button>';
				config.nextArrow = '<button type="button" class="slick-next"><i class="' + (config.nextArrow || 'icon icon-right-arrow2') + '"></i></button>';
				carouselEl.slick(config);
			}

			jQuery('.ekit-video-gallery.ekit-masonry').isotope({
				percentPosition: true,
				itemSelector: '.ekit-video-item ',
			});
		},
		Unfold: function($scope){
			var expand_btn = $scope.find('.ekit-unfold-btn'),
				content_wrapper = $scope.find('.ekit-unfold-wrapper'),
				content = $scope.find('.ekit-unfold-data'),
				inner_data = $scope.find('.ekit-unfold-data-inner'),
				config = content_wrapper.data('config');
			
			if(config.collapse_height >= inner_data.outerHeight()){
				expand_btn.hide();
				content.addClass('active');
			}

			expand_btn.on('click', function(){
				if(!content.hasClass('active')){
					content.animate({height:inner_data.outerHeight()},(parseInt(config.transition_duration) || 0));
					$(this).html(config.collapse_text);
				} else {
					content.animate({height: config.collapse_height},(parseInt(config.transition_duration) || 0));
					$(this).html(config.expand_text)
				}
				content.toggleClass('active');
			});
			

		}
	};
	$(window).on('elementor/frontend/init', ElementsKit.init);


}(jQuery, window.elementorFrontend));


(function ($) {
	"use strict";
	$.fn.animateNumbers = function (stop, commas, duration, ease) {
		return this.each(function () {
			var $this = $(this);
			var start = parseInt($this.text().replace(/,/g, ""), 10);
			commas = (commas === undefined) ? true : commas;
			$({
				value: start
			}).animate({
				value: stop
			}, {
				duration: duration == undefined ? 500 : duration,
				easing: ease == undefined ? "swing" : ease,
				step: function () {
					$this.text(Math.floor(this.value));
					if(commas) {
						$this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
					}
				},
				complete: function () {
					if(parseInt($this.text(), 10) !== stop) {
						$this.text(stop);
						if(commas) {
							$this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
						}
					}
				}
			});
		});
	};

	$.fn.myChart = function (options) {
		var settings = $.extend({
			barColor: '#666666',
			gradientColor1: '',
			gradientColor2: '',
			scaleColor: 'transparent',
			lineWidth: 20,
			size: 150,
			trackColor: '#f7f7f7',
			lineCap: 'round',
			gradientChart: false,
		}, options);

		return this.easyPieChart({
			barColor: settings.gradientChart === true ? function (percent) {
				var ctx = this.renderer.getCtx();
				var canvas = this.renderer.getCanvas();
				var gradient = ctx.createLinearGradient(0, 0, canvas.width, 0);
				gradient.addColorStop(0, settings.gradientColor1);
				gradient.addColorStop(1, settings.gradientColor2);
				return gradient;
			} : settings.barColor,
			scaleColor: settings.scaleColor,
			trackColor: settings.trackColor,
			lineCap: settings.lineCap,
			size: settings.size,
			lineWidth: settings.lineWidth
		});
	}


	$(document).ready(function () {
		if($('.ekit-video-popup').length > 0) {
			$('.ekit-video-popup').magnificPopup({
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: true,
				fixedContentPos: false,
			});
		}

		if($('#wp-admin-bar-elementor_edit_page-default').length > 0) {
			var elements = $('#wp-admin-bar-elementor_edit_page-default').children('li');
			$(elements).map(function (__, element) {
				var target = $(element).find(".elementor-edit-link-title");
				if(target.text().indexOf('dynamic-content-') !== -1) {
					target.parent().parent().remove();
				}
			});
		}

	}); // end ready function
}(jQuery));
