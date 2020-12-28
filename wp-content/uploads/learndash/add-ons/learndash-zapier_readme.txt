=== Zapier for LearnDash ===
Author: LearnDash
Author URI: https://learndash.com 
Plugin URI: https://learndash.com/add-on/zapier-integration/
LD Requires at least: 3.0
Slug: learndash-zapier
Tags: integration, zapier,
Requires at least: 5.0
Tested up to: 5.4
Requires PHP: 7
Stable tag: 2.1.0

Integrate LearnDash LMS with Zapier.

== Description ==

Integrate LearnDash LMS with Zapier.


Zapier is a service that makes it easy for you to connect two applications without the need to know code, currently with a library of over 300 applications. Zapier calls these connections Zaps, and this integration lets you create Zaps that include LearnDash activities.

= Integration Features = 

* Perform actions in over 300 applications based on seven specific LearnDash activities
* Supports both global and specific LearnDash activity
* Easily connect LearnDash to the popular Zapier program without code

See the [Add-on](https://learndash.com/add-on/zapier/) page for more information.

== Installation ==

If the auto-update is not working, verify that you have a valid LearnDash LMS license via LEARNDASH LMS > SETTINGS > LMS LICENSE. 

Alternatively, you always have the option to update manually. Please note, a full backup of your site is always recommended prior to updating. 

1. Deactivate and delete your current version of the add-on.
1. Download the latest version of the add-on from our [support site](https://support.learndash.com/article-categories/free/).
1. Upload the zipped file via PLUGINS > ADD NEW, or to wp-content/plugins.
1. Activate the add-on plugin via the PLUGINS menu.

== Changelog ==

= 2.1.0 =

* Added first name and last name to user response
* Added create user param to toggle course access function
* Added create user param to get user and toggle group membership functions
* Added `add_to_group` and `remove_from_group` actions handler and add toggle membership helper
* Added `get_user helper` to automatically create user if it does not exist or return it if it exists
* Updated to return the last quiz result sample from the last user to get the latest quiz result possible
* Updated `get_trigger_sample` and `get_object_sample` to be more efficient
* Updated `get_response()` parser method and update respective sections accordingly
* Updated to make first and last name field not required
* Updated `get_group_field` action handler and its helpers
* Fixed add array wrapper for `get_sample` response because it is expected by Zapier
* Fixed get sample method returns wrapped response in array

View the full changelog [here](https://www.learndash.com/add-on/zapier/).