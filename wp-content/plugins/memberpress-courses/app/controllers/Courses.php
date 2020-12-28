<?php
namespace memberpress\courses\controllers;

if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

use memberpress\courses as base;
use memberpress\courses\lib as lib;
use memberpress\courses\models as models;
use memberpress\courses\helpers as helpers;

class Courses extends lib\BaseCtrl {
  public function load_hooks() {
    add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 100);
    add_action('pre_get_posts', array($this, 'filter_courses_archive'));
    add_action('transition_post_status', array($this, 'delete_transients'), 10, 3 );
    add_filter('the_content', array($this, 'page_router'), 10);
    add_filter('template_include', array($this, 'override_template'));
    add_shortcode('mpcs-my-courses', array($this, 'my_courses_shortcode'));
    add_shortcode('mpcs-section-overview', array($this, 'section_overview_shortcode'));
    add_shortcode('mpcs-course-overview', array($this, 'course_overview_shortcode'));
    add_shortcode('mpcs-purchase-button', array($this, 'purchase_shortcode'));
  }

  /**
  * Override default template with the courses page template
  * @param string $template current template
  * @return string $template modified template
  */
  public static function override_template($template) {
    global $post;

    if(isset($post) && is_a($post, 'WP_Post') && $post->post_type == models\Course::$cpt) {
      if(is_single()) {
        $course = new models\Course($post->ID);
        $new_template = locate_template($course->page_template);
        if(helpers\App::is_classroom()){
          $template = base\VIEWS_PATH . '/classroom/single-course.php';
        }
        elseif(isset($new_template) && !empty($new_template)) {
          return $new_template;
        }
        else {
          $template = locate_template(
            array(
              'single-mpcs-course.php',
              'page.php',
              'custom_template.php',
              'single.php',
              'index.php'
            )
          );
        }
      }
    }

    if(is_post_type_archive( models\Course::$cpt ) && helpers\App::is_classroom()){
      $template = base\VIEWS_PATH . '/classroom/archive-course.php';
    }

    return $template;
  }

  /**
  * Render my courses list html for shortcode
  * @see load_hooks, add_shortcode('mpcs-my-courses')
  * @param array $attributes Shortcode attributes
  * @return string $content HTML string for shortcode
  */
  public static function my_courses_shortcode($attributes) {
    $content = '';

    \ob_start();
      Account::my_courses_list('courses', false);
    $content .= \ob_get_clean();

    return $content;
  }

  /**
  * Render lesson list html for shortcode
  * @see load_hooks, add_shortcode('mpcs-section-overview')
  * @param array $attributes Shortcode attributes
  * @return string $content HTML string for shortcode
  */
  public static function section_overview_shortcode($attributes) {
    global $post;

    $content = '';

    if(is_user_logged_in()) {
      $current_user = lib\Utils::get_currentuserinfo();
    }

    if(isset($attributes['section_id']) && is_numeric($attributes['section_id'])) {
      $section = new models\Section($attributes['section_id']);
    }
    else if(isset($attributes['lesson_id']) && is_numeric($attributes['lesson_id'])) {
      $lesson = new models\Lesson($attributes['lesson_id']);
      $section = $lesson->section();
    }
    else if(isset($post) && $post->post_type==models\Lesson::$cpt) {
      $lesson = new models\Lesson($post->ID);
      $section = $lesson->section();
    }

    if(isset($section) && $section !== false) {
      $course = $section->course();
      \ob_start();

        ?>
        <?php if(is_user_logged_in() && models\UserProgress::has_completed_section($current_user->ID, $section->id)): ?>
          <div class="mpcs-section-overview mpcs-section-complete">
        <?php else: ?>
          <div class="mpcs-section-overview mpcs-section-not-complete">
        <?php endif; ?>

            <?php if(isset($attributes['hide_title']) && ($attributes['hide_title']=='true' || $attributes['hide_title']==1)): ?>
            <?php else: ?>
              <h3><?php echo $section->title; ?></h3>
            <?php endif; ?>
            <ol class="mpcs-lessons">
      <?php foreach($section->lessons() as $lesson): ?>
          <?php if(is_user_logged_in() && models\UserProgress::has_completed_lesson($current_user->ID, $lesson->ID)): ?>
                  <li class="mpcs-lesson mpcs-lesson-complete"><a href="<?php echo get_permalink($lesson->ID); ?>"><?php echo $lesson->post_title; ?></a></li>
                <?php else: ?>
                  <li class="mpcs-lesson mpcs-lesson-not-complete"><a href="<?php echo get_permalink($lesson->ID); ?>"><?php echo $lesson->post_title; ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ol>

          </div>
        <?php

      $content = \ob_get_clean();
    }

    return $content;
  }

  /**
  * Render section and lesson list html for shortcode
  * @see load_hooks, add_shortcode('mpcs-course-overview')
  * @param array $attributes Shortcode attributes
  * @return string $content HTML string for shortcode
  */
  public static function course_overview_shortcode($attributes) {
    $content = '';

    if(isset($attributes['course_id']) && is_numeric($attributes['course_id'])) {
      $course = new models\Course($attributes['course_id']);
    }
    else if(isset($attributes['section_id']) && is_numeric($attributes['section_id'])) {
      $section = new models\Section($attributes['section_id']);
      $course = $section->course();
    }
    else if(isset($attributes['lesson_id']) && is_numeric($attributes['lesson_id'])) {
      $lesson = new models\Lesson($attributes['lesson_id']);
      $course = $lesson->course();
    }
    else if(isset($post) && $post->post_type==models\Course::$cpt) {
      $course = new models\Course($post->ID);
    }
    else if(isset($post) && $post->post_type==models\Lesson::$cpt) {
      $lesson = new models\Lesson($post->ID);
      $course = $lesson->course();
    }

    if(isset($course) && $course !== false) {
      \ob_start();

        ?>
          <div class="mpcs-course-overview">
        <?php

        if(isset($attributes['hide_title']) && ($attributes['hide_title']=='true' || $attributes['hide_title']==1)):
        else:
          ?>
            <h2 class="mpcs-course-title"><?php echo $course->post_title; ?></h2>
          <?php
        endif;

        foreach($course->sections() as $section) {
          // Don't pass hide_title as in this shortcode we'll always show the section titles
          echo self::section_overview_shortcode(array('section_id' => $section->id));
        }

        ?>
          </div>
        <?php

      $content = \ob_get_clean();
    }

    return $content;
  }

  public static function purchase_shortcode($attributes) {
    $content = '';

    if(isset($attributes['membership_id']) && is_numeric($attributes['membership_id'])) {
      $membership = new \MeprProduct($attributes['membership_id']);
      if($membership !== false) {
        $link_text = isset($attributes['text']) ? $attributes['text'] : __('Enroll', 'memberpress-courses');
        $content = '<form action="' . get_permalink($membership->ID) . '"><input type="submit" value="' . $link_text . '" /></form>';
      }
    }

    return $content;
  }

  /**
   * page_router
   *
   * @param  mixed $content
   * @return void
   */
  public function page_router($content){
    global $post;

    if( !isset($post) || !is_a($post, 'WP_Post') || $post->post_type !== models\Course::$cpt){
      return $content;
    }

    $action = self::get_param('action');

    if($action and $action == 'instructor') {
      $content = helpers\Courses::display_course_instructor();
    }
    else{
      $content .= helpers\Courses::display_course_overview();
    }

    return $content;
  }

  /**
   * Enqueue scripts
   *
   * @return void
   */
  public function enqueue_scripts() {
    global $post, $wp_styles;

    if(
      (is_a($post, 'WP_Post') && $post->post_type == models\Course::$cpt) || (is_single() ||
      helpers\Courses::is_course_archive())
    ){ // only if we're in course archive or course single
      if ( helpers\App::is_classroom() ) {
        foreach( $wp_styles->queue as $style ) :
          if('mpcs-fontello-styles' !== $style && 'wp-block-library' !== $style ){
            $handle = $wp_styles->registered[$style]->handle;
            \wp_deregister_style($handle);
            \wp_dequeue_style($handle);
          }
        endforeach;

        \wp_enqueue_style('mpcs-classroom', base\CSS_URL . '/classroom.css', array(), base\VERSION);
        \wp_enqueue_script('mpcs-classroom-js', base\JS_URL . '/classroom.js', array('jquery'), base\VERSION, true);
      }
      else{
        \wp_enqueue_style('mpcs-progress', base\CSS_URL . '/progress.css', array(), base\VERSION);
        \wp_enqueue_script('mpcs-progress-js', base\JS_URL . '/progress.js', array('jquery'), base\VERSION, true);
      }

      \wp_enqueue_style('mpcs-fontello-styles', base\FONTS_URL.'/fontello/css/mp-courses.css', array(), base\VERSION);
    }
  }

  /**
   * Filters Course archive posts
   *
   * @param  object $query
   * @return void
   */
  public static function filter_courses_archive($query) {
    global $wp_query, $wpdb;

    if ( is_admin() ) {
      return;
    }

    if ( ! $query->is_main_query() ) {
      return;
    }

    if ( ! is_post_type_archive( models\Course::$cpt ) ) {
      return;
    }

    $user_id = \get_current_user_id();
    $transients = \get_option('mpcs-transients', array());

    // Get all courses the user is allowed to view
    if ( false === ( $enrolled_courses_id = get_transient( 'mpmc_enrolled_courses_'.$user_id ) ) ) {
      $courses = get_posts(array('post_type' => models\Course::$cpt, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC'));

      // Remove courses users are not allowed to view but
      // get all courses if user is admin
      if(false == \MeprUtils::is_logged_in_and_an_admin()){
        $courses = array_filter($courses, function($id){
          return false == \MeprRule::is_locked($id);
        });
      }

      $enrolled_courses_id = array_column( $courses, 'ID' );
      set_transient( 'mpmc_enrolled_courses_'.$user_id, $enrolled_courses_id, 24 * HOUR_IN_SECONDS );
      $transients[] = 'mpmc_enrolled_courses_'.$user_id;
      \update_option('mpcs-transients', $transients);
    }

    // If 'My Courses' is clicked, return enrolled courses first
    if($type = self::get_param('type') && 'mycourses' === self::get_param('type')){
      if ( false == ( get_transient( 'mpmc_enrolled_mycourses_'.$user_id ) ) ) {
        $progress = models\UserProgress::find_all_by_user($user_id);
        $courses_started = array_unique( array_column($progress, 'course_id') );
        $enrolled_courses_id = \array_unique( \array_merge($courses_started, $enrolled_courses_id) );
        set_transient( 'mpmc_enrolled_mycourses_'.$user_id, $enrolled_courses_id, 24 * HOUR_IN_SECONDS );
        $transients[] = 'mpmc_enrolled_mycourses_'.$user_id;
        \update_option('mpcs-transients', $transients);
      }
      else{
        $enrolled_courses_id = get_transient( 'mpmc_enrolled_mycourses_'.$user_id );
      }
    }

    // Filter archive by allowed courses
    $query->set('post__in', $enrolled_courses_id);
    $query->set('orderby', 'post__in');

    // Display enabled courses in "My Courses" list
    if('mycourses' !== self::get_param('type')){
      $query->set('meta_query', array(
        array(
          'key' => '_mpcs_course_status',
          'value' => 'enabled',
        )
      ));
    }

    $query->set('order', 'ASC');
    $query->set('posts_per_page', 6);

    // Author filter
    if($author = self::get_param('author')){
      if( $user_id = username_exists( sanitize_text_field( $author ) ) ){
        $query->set( 'author', $user_id );
      }
    }

    // Category filter
    if($category = self::get_param('category')){
      $tax_query = array(
        array(
          'taxonomy' => 'mpcs-course-categories',
          'field'    => 'slug',
          'terms'    => $category,
        ),
      );
      $query->set( 'tax_query', $tax_query );
    }

    return $query;
  }


  /**
   * Delete Transients
   *
   * @param  mixed $new_status
   * @param  mixed $old_status
   * @param  mixed $post
   * @return void
   */
  function delete_transients( $new_status, $old_status, $post ){
    if ( 'publish' == $new_status || 'publish' === $old_status )
      return; // If user is updating post, exit

    if ( models\Course::$cpt !== $post->post_type )
      return; // restrict the filter to a specific post type

    // let's get and delete transients
    $transients = \get_option('mpcs-transients', array());
    foreach ($transients as $transient) {
      delete_transient( $transient );
    }
    \delete_option('mpcs-transients');
  }


  /**
   * Utility function to grab a parameter whether it's a get or post
   *
   * @param  mixed $param
   * @param  mixed $default
   * @return void
   */
  public static function get_param($param, $default = '') {
    return (isset($_REQUEST[$param])?$_REQUEST[$param]:$default);
  }

}
