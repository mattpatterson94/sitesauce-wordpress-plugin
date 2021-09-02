=== Sitesauce ===
Contributors: m1guelpf, mattpatterson94
Donate link: https://sitesauce.app/
Tags: sitesauce, static, jamstack, vercel, zeit
Requires at least: 4.6
Tested up to: 5.7.2
Stable tag: 4.3
Requires PHP: 5.5
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Connect your WordPress site with Sitesauce to keep your static site updated.

== Description ==

This plugin allows you to integrate your WordPress site with Sitesauce by pinging the Sitesauce build hook every time your content is updated. To use this plugin, you'll first need a [Sitesauce account](https://sitesauce.app).

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/sitesauce` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Add your Build Hook on the Settings -> Sitesauce screen


== Frequently Asked Questions ==

= Where can I get my Sitesauce build hook URL? =

You can copy your Sitesauce build URL from the settings page on your Sitesauce dashboard.

= How do I trigger Sitesauce when options are updated? =

Be sure you have enabled the "Trigger on Option Updates" setting in the Sitesauce settings in WordPress. 

You can use the `sitesauce_deployments_get_trigger_on_options_value` to add options to watch. For example, add the following to your `functions.php`

```php
function add_custom_options_to_trigger( $options ) {
    array_push($options, "some_option");

    return $options;
}

add_filter( 'sitesauce_deployments_get_trigger_on_options_value', 'add_custom_options_to_trigger' );
```


== Changelog ==

= 1.2 =
- Trigger on acf/save-post for custom options pages / pages / posts
- Only trigger once per save
- Using filters, Sitesauce can be triggered based on custom wp options
- Add new toggleable fields in the settings menu for new types of triggers

= 1.1 =
- Fix crash when saving or creating pages

= 1.0 =
- Initial Version
