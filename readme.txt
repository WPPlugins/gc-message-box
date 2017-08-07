=== GC Message Box ===
Contributors: GetConversion, vschwarz, skromesch
Donate link: http://getconversion.com/donate/?plugin=gc-message-box
Tags: call to action, cta, notification, conversion rate, woocommerce, wpml, getconversion, message box, gc message box
Requires at least: 3.4
Tested up to: 3.9.1
Stable tag: 2.3.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

GC Message Box is an easy to use plugin that allows you to increase conversion rates by adding a Call To Action button within articles and blog posts


== Description ==


= How GC Message Box helps your website =

Set up and start to use in minutes. With highly customizable options you can add a powerful Call To Action as a catchy notification box. Increase your conversion rates easily with this simple and smart CTA plugin inside your blog posts and articles.


= Designed for Call To Action =

* Driving traffic
* Highlighting key messages within a post
* Capturing leads
* Selling products
* Promoting blog posts
* Converting visitors into your funnel


= Other plugins by GetConversion =

* (FREE) [GC Message Bar](http://wordpress.org/plugins/gc-message-bar/)
* (FREE) [GC MailPoet EX](http://wordpress.org/plugins/gc-mailpoet-ex/)
* (Premium) [GC MailPoet EX PRO](http://getconversion.com/products/gc-mailpoet-ex-pro/)
* (Premium) [GC MailChimp EX PRO](http://getconversion.com/products/gc-mailchimp-ex-pro/)


= Compatibility =

* [Newsletters: MailPoet/Wysija with GC MailPoet EX](http://www.mailpoet.com)
* [e-Commerce: WooCommerce](http://www.woothemes.com/woocommerce/)
* [Multilingual Ready: WPML.org](http://wpml.org)
* [WP Super Cache](http://wordpress.org/plugins/wp-super-cache/)
* [W3 Total Cache](http://wordpress.org/plugins/w3-total-cache/)


= Message setting features =

* Action URL
* Message Text
* Action Button Text
* Character count
* URL Target
* No Follow
* Multi Language Support Via WPML
* Short Code Support


= General setting features =

* Message and Action Button layouts
* Appear on article pages between the article and the comments
* Appear on list type screens like home, category pages, search results etc.
* Can appear repeatedly
* Custom margin settings
* Enable animation
* Enable link cloaking
* Insert with short code
* **Insert as widget**
* Checkbox to activate the close button
* State cookie time - the GC Message Box will remember it's state


= Filters =

* Display filter (allow/deny on specified pages)
* Appear on selected type of screens like home, categories, tags, pages etc.
* Authentication filter (signed in / signed out)
* User Role filter (compatible with WooCommerce)
* User Group filter (compatible with WooCommerce)
* Disable on Mobile devices


= Styling features =

* Predefined color schemes
* Custom Font Family and Size For The Message
* Custom Font Family and Size For The Button
* Custom Background Color
* Custom Message Text Color
* Custom Action Button Color
* Custom Action Button Hover Color
* Custom Action Button Text Color
* Custom Border Radius
* Text Shadows

**Demo: [GC Message Box in action](getconversion.com/products/gc-message-box)**


= GetConversion Community =
* **Vote For Roadmap Features: [GC Message Box Roadmap](http://community.getconversion.net/roadmap/gc-message-box)**
* **Discuss Forum Topics: [GC Message Box Forum](http://community.getconversion.net/forum/gc-message-box)**
* **Suggest An Idea: [Feature Request](http://community.getconversion.net/idea)**
* **Report A Bug: [Bug Report](http://community.getconversion.net/bug)**
* **GetConversion Home: [GetConversion.com](http://getconversion.com)**


== Screenshots ==

1. GC Message Box screenshot
2. GC Message Box in action
3. GC Message Box admin interface


== Installation ==

You can use the built in installer and upgrader, or you can install the plugin manually.

1. You can either use the automatic plugin installer or your FTP program to upload it to your wp-content/plugins directory the top-level folder. Don't just upload all the php files and put them in `/wp-content/plugins/`.
1. Activate the plugin through the 'Plugins' menu in WordPress wp-admin
1. Visit your GC Message Box options (*Plugins - GC Message Box*) - required for plugin init
1. Configure any options as desired, and then enable the plugin
1. Done!


== Frequently Asked Questions ==

= Known issues =
WordPress Font Uploader - The Font Uploader's style is blocked. Read more about work around on GC Community.

= How can I connect my plugin directly to MY.GetConversion? =
Visit the plugin admin screen. Scroll down, and find the Show/hide engine setting link near the version number at the plugin footer. Open the Engine settings panel. Click on Connect to MY.GetConversion button and follow the instructions.

= How to use short code in the message text? =
You can add short code to the message text area or to the action button text field.

= How to insert GC Message Box with short code? =
Just use the following code:
`[gc-message-box]`
In case short code rendering the filters will be ignored.

= How to insert GC Message Box with PHP code? =
Just enter the following code where you want to put the GC Message Box:
`gc_message_box_show();`
In case the GC Message Box was added with PHP the filters will be ignored.

= Loop protection with PHP "tag" =
Protect the main loop with PHP function call. Add the following code line before the main loop (before while):
`<?php gc_message_box_mainloop_start(); ?>`
And add this one after the main loop (after endwhile):
`<?php gc_message_box_mainloop_stop(); ?>`


* **Have more questions?** [Contact Support](http://community.getconversion.net/contact)
* **Have an idea?** [Suggest An Idea](http://community.getconversion.net/idea)
* **Found a bug?** [Report A Bug](http://community.getconversion.net/bug)


== Changelog ==

= 2.3.9 =
* Fixed RSS feed and page renderer

= 2.3.8 =
* Allow/Deny page filter upgraded with Equals to/Begins with setting

= 2.3.7 =
* Style caching added (speed increased from ~1900ms to ~600ms)
* Dynamic / Inline / Cached CSS added
* Setting for CSS Cache directory added

= 2.3.6 =
* Small fixes

= 2.3.5 =
* Hotfix for WP 3.9

= 2.3.4 =
* Many CSS fixes
* Allow/Deny filter invalidates cache on page and post admin screens
* Widget view fix

= 2.3.3 =
* Cache plugins integration fix 

= 2.3.2 =
* Admin CSS collapse fix 

= 2.3.1 =
* Synergy with caching plugins - W3 Total Cache, WP Super Cache
* Null/empty value replaced with default - issue fixed

= 2.3.0 =
* Redesigned color presets
* Accepting GC extension plugins
* SSL fix
* Small fixes

= 2.2.3 =
* Maintenace updates for Wordpress 3.8
* Tracking issue fix
* Available to insert with PHP (Details in FAQ)

= 2.2.2 =
* Fantastic new XMAS DESIGN color presets
* Device filter: Desktop and Mobile / Desktop Only / Mobile Only

= 2.2.1 =
* Remember state issue fixed

= 2.2.0 =
* New Filters panel added
* Authentication filter added (signed in / signed out)
* User Role filter added (compatible with WooCommerce)
* User Group filter added (compatible with WooCommerce)
* Animation added
* Link cloaking added
* Insert with short code added
* Insert as widget added
* Close button added
* State cookie time added
* Lots of small fixes

= 2.1.5 =
* Update error fix - reinstall v2.1.4

= 2.1.4 =
* Allow/deny filter fix

= 2.1.3 =
* Small fixes

= 2.1.2 =
* Direct connect plugin to MY.GetConversion - compatible with security plugins (Read FAQ)
* Reconnect on lost connection

= 2.1.1 =
* Multi language support via WPML
* Enable/disable WPAdminBar Navigation
* Short Code support (Details in FAQ)
* Loop protection - protect with PHP "tag" (Details in FAQ)
* Infinite loop protection - limited number of appearance
* GetConversion Community integration

= 2.1.0 =
* New display filter added: Allow/Deny on specified pages
* Display filter switch added to Edit Page and Edit Post screens
* Apostrophes issue fixed
* Connection URL notification added
* Engine settings added

= 2.0.3 =
* Box Shadow on/off function added
* Small fixes concerning to connection process

= 2.0.2 =
* Font embedding fix

= 2.0.1 =
* Remote configuration fix on activation added

= 2.0.0 =
* New admin user interface
* No follow setting added
* Lots of small fixes
* MY.GetConversion support added

= 1.2.0 =
* Message text font family and size settings added
* Action button text font family and size settings added

= 1.1.1 =
* Main loop detection fix
* Main query reset fix

= 1.1.0 =
* Enable Plugin checkbox added
* Basic formatting options at content fields added

= 1.0.1 =
* Main plugin file duplication fix

= 1.0 =
* First release
