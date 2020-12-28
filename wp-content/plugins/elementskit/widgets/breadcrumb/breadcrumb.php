<?php

namespace Elementor;

defined('ABSPATH') || exit;

use Elementor\ElementsKit_Widget_Breadcrumb_Handler as Handler;


class ElementsKit_Widget_Breadcrumb extends Widget_Base {

	public $base;


	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_style('ekit-breadcrumb-style-handle', Handler::get_url() . 'assets/css/style.css');
	}


	public function get_style_depends() {
		return ['ekit-breadcrumb-style-handle'];
	}


	public function get_name() {
		return Handler::get_name();
	}


	public function get_title() {
		return Handler::get_title();
	}


	public function get_icon() {
		return Handler::get_icon();
	}


	public function get_categories() {
		return Handler::get_categories();
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'ekit_lite_section_content',
			[
				'label' => __('Settings', 'elementskit-lite'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ekit_breadcrumb_len',
			[
				'label'   => __('Max Title word length', 'plugin-domain'),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 5,
				'max'     => 100,
				'step'    => 1,
				'default' => 15,
			]
		);

		$this->add_control(
			'ekit_breadcrumb_show_trail',
			[
				'label'        => __('Show category trail', 'plugin-domain'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'your-plugin'),
				'label_off'    => __('Hide', 'your-plugin'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);


		$this->end_controls_section();
	}


	protected function render() {
		echo '<div class="ekit-wid-con" >';
		$this->render_raw();
		echo '</div>';
	}


	protected function render_raw() {

		$settings = $this->get_settings_for_display();
		$pid      = get_the_ID();
		$max_len  = empty($settings['ekit_breadcrumb_len']) ? 15 : intval($settings['ekit_breadcrumb_len']);
		$trail    = !empty($settings['ekit_breadcrumb_show_trail']);


		echo $this->get_crumb($pid, $max_len, $trail);

	}


	private function get_crumb($post_id, $max_len, $trail = false, $sep = ' <li class="brd_sep"> &raquo; </li> ') {

		$ret = '<ol class="ekit-breadcrumb">';

		if(!is_home()) {

			$ret .= '<li><a href="' . get_home_url('/') . '">' . __('Home', 'elementskit') . '</a></li>';

			if(is_category() || is_single()) {

				$category = get_the_category();

				if(!empty($category)) {

					$cat         = $category[0];
					$term_parent = $cat->parent;
					$taxonomy    = $cat->taxonomy;
					$p_trail     = '';

					if($trail === true) {

						if(0 !== $term_parent) {

							while($term_parent) {

								$term        = get_term($term_parent, $taxonomy);
								$term_parent = $term->parent;

								$p_trail = $sep . '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>' . $p_trail;
							}
						}
					}

					$ret .= $p_trail . $sep . '<li><a href="' . get_category_link($cat->term_id) . '">' . $cat->cat_name . '</a></li>';

				} else {

					$p_type    = get_post_type($post_id);
					$post_type = get_post_type_object($p_type);

					if(!empty($post_type->labels->singular_name) && !in_array($post_type->name, ['post', 'page'])) {

						$ret .= $sep . '<li><a href="' . get_post_type_archive_link($p_type) . '">' . $post_type->labels->singular_name . '</a></li>';

					}
				}

				if(is_single()) {

					$ret .= $sep . '<li>' . wp_trim_words(get_the_title(), $max_len) . '</li>';
				}

			} elseif(is_page()) {

				$ret .= $sep . '<li>' . wp_trim_words(get_the_title(), $max_len) . '</li>';
			}
		}


		if(is_tag()) {

			$ret .= '<li>' . single_tag_title() . '</li>';

		} elseif(is_day()) {

			$ret .= '<li>' . esc_html__('Blogs for', 'elementskit') . ' ' . get_the_time('F jS, Y', $post_id) . '</li>';

		} elseif(is_month()) {

			$ret .= '<li>' . esc_html__('Blogs for', 'elementskit') . ' ' . get_the_time('F, Y', $post_id) . '</li>';

		} elseif(is_year()) {

			$ret .= '<li>' . esc_html__('Blogs for', 'elementskit') . ' ' . get_the_time('Y', $post_id) . '</li>';

		} elseif(is_author()) {

			$ret .= '<li>' . esc_html__('Author Blogs', 'elementskit') . '</li>';

		} elseif(isset($_GET['paged']) && !empty($_GET['paged'])) {

			$ret .= '<li>' . esc_html__('Blogs', 'elementskit') . '</li>';

		} elseif(is_search()) {

			//the_search_query()

			$ret .= '<li>' . esc_html__('Search Result', 'elementskit') . '</li>';

		} elseif(is_404()) {

			$ret .= '<li>' . esc_html__('404 Not Found', 'elementskit') . '</li>';
		}

		$ret .= '</ol>';

		return $ret;
	}


	public function get_clean_breadcrumb($post_id, $max_len, $sep = ' <li> &raquo; </li> ') {

		$ret = '<ol class="ekit-breadcrumb">';

		if(is_singular()) {

			echo 'I am single >> ';
		}


		if(is_archive()) {

			echo 'I am archive >> ';
		}

		if(is_search()) {

			echo 'I am is_search >> ';
		}

		//*******************************************************************
		//just for knowing......
		//*******************************************************************

		if(is_home()) {

			if(is_page()) {


			}

			if(is_single()) {

			}

			if(is_404()) {

			}

			if(is_search()) {

			}

			if(is_404()) {

			}

			if(is_paged()) {

			}

			return '';
		}

		//below is not home but something else

	}


	public function get_hansel_and_gretel_breadcrumbs() {

		// Set variables for later use
		$here_text        = __('You are currently here!');
		$home_link        = home_url('/');
		$home_text        = __('Home');
		$link_before      = '<span typeof="v:Breadcrumb">';
		$link_after       = '</span>';
		$link_attr        = ' rel="v:url" property="v:title"';
		$link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
		$delimiter        = ' &raquo; ';              // Delimiter between crumbs
		$before           = '<span class="current">'; // Tag before the current crumb
		$after            = '</span>';                // Tag after the current crumb
		$page_addon       = '';                       // Adds the page number if the query is paged
		$breadcrumb_trail = '';
		$category_links   = '';

		/**
		 * Set our own $wp_the_query variable. Do not use the global variable version due to
		 * reliability
		 */
		$wp_the_query   = $GLOBALS['wp_the_query'];
		$queried_object = $wp_the_query->get_queried_object();

		// Handle single post requests which includes single pages, posts and attatchments
		if(is_singular()) {
			/**
			 * Set our own $post variable. Do not use the global variable version due to
			 * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
			 */
			$post_object = sanitize_post($queried_object);

			// Set variables
			$title          = apply_filters('the_title', $post_object->post_title);
			$parent         = $post_object->post_parent;
			$post_type      = $post_object->post_type;
			$post_id        = $post_object->ID;
			$post_link      = $before . $title . $after;
			$parent_string  = '';
			$post_type_link = '';

			if('post' === $post_type) {
				// Get the post categories
				$categories = get_the_category($post_id);
				if($categories) {
					// Lets grab the first category
					$category = $categories[0];

					$category_links = get_category_parents($category, true, $delimiter);
					$category_links = str_replace('<a', $link_before . '<a' . $link_attr, $category_links);
					$category_links = str_replace('</a>', '</a>' . $link_after, $category_links);
				}
			}

			if(!in_array($post_type, ['post', 'page', 'attachment'])) {
				$post_type_object = get_post_type_object($post_type);
				$archive_link     = esc_url(get_post_type_archive_link($post_type));

				$post_type_link = sprintf($link, $archive_link, $post_type_object->labels->singular_name);
			}

			// Get post parents if $parent !== 0
			if(0 !== $parent) {
				$parent_links = [];
				while($parent) {
					$post_parent = get_post($parent);

					$parent_links[] = sprintf($link, esc_url(get_permalink($post_parent->ID)), get_the_title($post_parent->ID));

					$parent = $post_parent->post_parent;
				}

				$parent_links = array_reverse($parent_links);

				$parent_string = implode($delimiter, $parent_links);
			}

			// Lets build the breadcrumb trail
			if($parent_string) {
				$breadcrumb_trail = $parent_string . $delimiter . $post_link;
			} else {
				$breadcrumb_trail = $post_link;
			}

			if($post_type_link) {
				$breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;
			}

			if($category_links) {
				$breadcrumb_trail = $category_links . $breadcrumb_trail;
			}
		}

		// Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
		if(is_archive()) {
			if(is_category()
			   || is_tag()
			   || is_tax()
			) {
				// Set the variables for this section
				$term_object        = get_term($queried_object);
				$taxonomy           = $term_object->taxonomy;
				$term_id            = $term_object->term_id;
				$term_name          = $term_object->name;
				$term_parent        = $term_object->parent;
				$taxonomy_object    = get_taxonomy($taxonomy);
				$current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
				$parent_term_string = '';

				if(0 !== $term_parent) {

					// Get all the current term ancestors
					$parent_term_links = [];

					while($term_parent) {
						$term                = get_term($term_parent, $taxonomy);
						$parent_term_links[] = sprintf($link, esc_url(get_term_link($term)), $term->name);
						$term_parent         = $term->parent;
					}

					$parent_term_links  = array_reverse($parent_term_links);
					$parent_term_string = implode($delimiter, $parent_term_links);
				}

				if($parent_term_string) {
					$breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
				} else {
					$breadcrumb_trail = $current_term_link;
				}

			} elseif(is_author()) {

				$breadcrumb_trail = __('Author archive for ') . $before . $queried_object->data->display_name . $after;

			} elseif(is_date()) {
				// Set default variables
				$year     = $wp_the_query->query_vars['year'];
				$monthnum = $wp_the_query->query_vars['monthnum'];
				$day      = $wp_the_query->query_vars['day'];

				// Get the month name if $monthnum has a value
				if($monthnum) {
					$date_time  = DateTime::createFromFormat('!m', $monthnum);
					$month_name = $date_time->format('F');
				}

				if(is_year()) {

					$breadcrumb_trail = $before . $year . $after;

				} elseif(is_month()) {

					$year_link = sprintf($link, esc_url(get_year_link($year)), $year);

					$breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

				} elseif(is_day()) {

					$year_link  = sprintf($link, esc_url(get_year_link($year)), $year);
					$month_link = sprintf($link, esc_url(get_month_link($year, $monthnum)), $month_name);

					$breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
				}

			} elseif(is_post_type_archive()) {

				$post_type        = $wp_the_query->query_vars['post_type'];
				$post_type_object = get_post_type_object($post_type);

				$breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;

			}
		}

		// Handle the search page
		if(is_search()) {
			$breadcrumb_trail = __('Search query for: ') . $before . get_search_query() . $after;
		}

		// Handle 404's
		if(is_404()) {
			$breadcrumb_trail = $before . __('Error 404') . $after;
		}

		// Handle paged pages
		if(is_paged()) {
			$current_page = get_query_var('paged') ? get_query_var('paged') : get_query_var('page');
			$page_addon   = $before . sprintf(__(' ( Page %s )'), number_format_i18n($current_page)) . $after;
		}

		$breadcrumb_output_link = '';
		$breadcrumb_output_link .= '<div class="breadcrumb">';

		if(is_home() || is_front_page()) {
			// Do not show breadcrumbs on page one of home and frontpage
			if(is_paged()) {
				$breadcrumb_output_link .= $here_text . $delimiter;
				$breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
				$breadcrumb_output_link .= $page_addon;
			}
		} else {
			$breadcrumb_output_link .= $here_text . $delimiter;
			$breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
			$breadcrumb_output_link .= $delimiter;
			$breadcrumb_output_link .= $breadcrumb_trail;
			$breadcrumb_output_link .= $page_addon;
		}
		$breadcrumb_output_link .= '</div><!-- .breadcrumbs -->';

		return $breadcrumb_output_link;
	}


}
