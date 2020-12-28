=== LearnDash Notifications ===
Author: LearnDash
Author URI: https://learndash.com 
Plugin URI: https://learndash.com/add-on/learndash-notifications/
LD Requires at least: 3.0
Slug: learndash-notifications
Tags: notifications, emails
Requires at least: 5.0
Tested up to: 5.4
Requires PHP: 7.0
Stable tag: 1.4.1

Send email notifications based on LearnDash actions.

== Description ==

Send email notifications based on LearnDash actions.

This add-on enables a new level of learner engagement within your LearnDash courses. Configure various notifications to be sent out automatically based on what learners do (and do not do) in a course.

This is a perfect tool for bolstering learner engagement, encouragement, promotions, and cross-selling.

= Add-on Features = 

* Automatically Send Notifications
* 13 Available Triggers
* 34 Dynamic Shortcodes
* Delay Notifications
* Choose Recipients

See the [Add-on](https://learndash.com/add-on/learndash-notifications/) page for more information.

== Installation ==

If the auto-update is not working, verify that you have a valid LearnDash LMS license via LEARNDASH LMS > SETTINGS > LMS LICENSE. 

Alternatively, you always have the option to update manually. Please note, a full backup of your site is always recommended prior to updating. 

1. Deactivate and delete your current version of the add-on.
1. Download the latest version of the add-on from our [support site](https://support.learndash.com/article-categories/free/).
1. Upload the zipped file via PLUGINS > ADD NEW, or to wp-content/plugins.
1. Activate the add-on plugin via the PLUGINS menu.

== Changelog ==

= 1.4.1 =
* Updated delay field unchangeable for edit to prevent issue with delayed emails
* Updated use of global delete function instead of create new queries in delete functions
* Updated remove `learndash_notifications_delete_delayed_emails_when_unenrolled` hooked function because it already exists in `includes/database.php`
* Updated use of `learndash_get_users_for_course()` to pull course users instead of access list meta only
* Fixed lesson available notification not queueing multiple notifications in DB if there are more than 1 notifications posts
* Fixed regex pattern for searching notifications by shortcode data key value pair


View the full changelog [here](https://www.learndash.com/add-on/learndash-notifications/).