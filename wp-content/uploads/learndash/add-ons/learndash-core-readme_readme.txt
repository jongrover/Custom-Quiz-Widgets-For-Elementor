=== LearnDash LMS ===
Author: LearnDash
Author URI: https://learndash.com 
Plugin URI: https://learndash.com
Slug: learndash-core
Tags: learndash
Requires at least: 5.0
Tested up to: 5.5.1
Requires PHP: 7.0
Stable tag: 3.2.3.5
Last Update: 2020-10-14

LearnDash LMS Plugin - Turn your WordPress site into a learning management system.

== Description ==

Turn your WordPress site into a learning management system.

Easily create & sell courses, deliver quizzes, award certificates, manage users, download reports, and so much more! By using LearnDash you have access to the latest e-learning industry trends for creating robust learning experiences.

See the [Features](https://www.learndash.com/wordpress-course-plugin-features/) page for more information.

== Installation ==

If the auto-update is not working, you always have the option to update manually. Please note, a full backup of your site is always recommended prior to updating. 

1. Deactivate and delete your current version of LearnDash LMS.
2. Download the latest version of LearnDash from our [support site](https://support.learndash.com/articles/my-downloads/).
3. Upload the zipped file via PLUGINS > ADD NEW, or to wp-content/plugins.
4. Activate the LearnDash LMS plugin via the PLUGINS menu.

== Changelog ==

= 3.2.3.5 =

* Fixed Matrix sorting not respecting order in the builder
* Fixed Final quizzes always being associated with the first lesson in a course
* Fixed Quiz with prerequisites not able to be started by non-admins
* Fixed Translations causing URL redirects
* Fixed Button spacing on quiz legacy templates
* Fixed Syntax error on quiz cookie code

= 3.2.3.4 =

* Fixed Quiz prerequisites not saving
* Fixed typo in includes/course/ld-course-progress.php causing lesson quiz redirect to be negatively impacted
* Fixed Restrict Quiz Retake not respecting number of retries
* Fixed Section titles so they can be edited after creation
* Fixed assignment/essay course/lesson filtering not working
* Fixed [ld_course_list] shortcode Number of courses per page not applying
* Fixed LD30 Registration: users not being auto enrolled after registering for Free Course
* Fixed quiz statistics activation through actions row link or Actions menu
* Fixed Assignment approve link not updating status
* Fixed Incorrect/Correct Message box still visible for Essay Type question
* Fixed submitted Essays so they can be updated
* Fixed Quiz Statistics page 2 showing entries from page 1
* Fixed LearnDash Quiz Settings (legacy) metabox showing on Quiz Settings tab

= 3.2.3.3 = 

* Fixed issue with quiz leaderboard preventing quiz from starting

= 3.2.3 =

* Updated Focus mode CSS improvements for more consistent styling
* Updated Color coding for quiz summary table
* Updated `[learndash_login]` shortcode now works in Focus Mode lessons topics and quizzes
* Added autoplay mute parameter for browsers blocking video autoplay;
* Added the ability to protect posts and pages from one global setting rather than per page and post
* Added Admin notice if other LMS plugins are activated that may conflict

* Fixed Courses being marked complete when not all steps are being complete
* Fixed graded Essay points reverting to `0`
* Fixed no mark complete button at top when using timer
* Fixed Course with only a final quiz not updating course progress
* Fixed Group leader bypass not working
* Fixed Group permalinks
* Fixed missing translations on some strings
* Fixed Expand all button on Groups page causing JS error


View our full changelog [here](https://www.learndash.com/changelog/).

== Upgrade Notice ==

= 3.1.3 = 
Important security update: please update immediately.

== FAQ ==

= Do I need to update? =

It is always recommended to update. However given the nature of WordPress and the option to have many other plugins installed, custom code, etc. it is possible that a conflict would arise. This is why we always recommend testing the update on a development environment first. 

= Why am I getting an error notice when trying to update? =

If you are getting an error while trying to update your version of LearnDash LMS, verify that your license is still valid. 

Both your license key and email address should be entered via LEARNDASH LMS > SETTINGS > LMS LICENSE. You should then see a "Your license is valid" message appear. 

If not, you can find your correct information via our [Support Site](https://support.learndash.com/articles/my-downloads/).

If your license has expired, you can purchase a new one [here](https://www.learndash.com/pricing-and-purchase/).

= What will happen to my customizations when updating? =

As long as the customizations were not done directly in the core LearnDash plugin files, there should be no problem. We provide many template files and hooks for this purpose. 

