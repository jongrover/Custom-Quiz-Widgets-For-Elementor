=== MemberPress for LearnDash ===
Author: LearnDash
Author URI: https://learndash.com 
Plugin URI: https://learndash.com/add-on/memberpress/
LD Requires at least: 2.5
Slug: learndash-memberpress
Tags: integration, membership, memberpress,
Requires at least: 5.0
Tested up to: 5.4
Requires PHP: 7.0
Stable tag: 2.1

Integrate LearnDash LMS with MemberPress.

== Description ==

Integrate LearnDash LMS with MemberPress.

MemberPress is a premium WordPress membership plugin that excels in memberships, grouping, coupons, reminders, reports, and more.

With this integration you can create membership levels in MemberPress and associate the access levels to LearnDash courses. Customers are then auto-enrolled into courses after signing-up for membership.

= Integration Features = 

* Associate membership levels to one or more courses
* Automatic removal upon membership cancellation
* Create trial membership levels with various payment gateways

See the [Add-on](https://learndash.com/add-on/memberpress/) page for more information.

== Installation ==

If the auto-update is not working, verify that you have a valid LearnDash LMS license via LEARNDASH LMS > SETTINGS > LMS LICENSE. 

Alternatively, you always have the option to update manually. Please note, a full backup of your site is always recommended prior to updating. 

1. Deactivate and delete your current version of the add-on.
1. Download the latest version of the add-on from our [support site](https://support.learndash.com/article-categories/free/).
1. Upload the zipped file via PLUGINS > ADD NEW, or to wp-content/plugins.
1. Activate the add-on plugin via the PLUGINS menu.

== Changelog ==

= 2.1.1 =
* Updated process course queue update 1 at a time
* Updated make sure the returned membership associated courses value is unique
* Fixed cron update course access run in batch for transactions and subscriptions to prevent timeout error
* Fixed missing cron schedules filter parameter

View the full changelog [here](https://www.learndash.com/add-on/memberpress/).