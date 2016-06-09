=== Conveyor ===
Contributors: mwtsn, mkjones
Donate link: 
Tags: content slider, slider, slideshow, carousel
Requires at least: 3.3
Tested up to: 3.8.1
Stable tag: 1.1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Custom Post Type to render a carousel, or use your own post types with optional 'featured' checkboxes.

== Description ==

Render a carousel using the 'slide' Custom Post Type, or add support for your existing post types.

Note: This plugin provides functions for you to use in your templates, it does not render content 'out of the box'.

= Features =

* Creates a 'Slide' Custom Post Type for you to use with your slider
* Use your own post types
* Use a 'featured' post option
* Associate your slide with a link, using the built in WordPress link chooser 
* Create your own carousel by just using the filter parameters
* Render a Bootstrap 3 carousel with customisable options

View the FAQ section for usage instructions.

== Installation ==

1. Backup your WordPress install
2. Upload the plugin folder 'Swerve' to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently asked questions ==

= What functions can I use? =

At the moment, two functions are provided, these are:

* conveyor_query_arguements()
* conveyor_render_boostrap()

Both of these functions accept arguments

= What does conveyor_query_arguements() do? =

This function provides arguments for you to filter a custom Loop, use it like so:

get_posts( conveyor_query_arguements() );

It accepts the following arguments as an array (or you can leave the $args empty to use the defaults):

* 'featured' - [ true | false ] - Set to true to return posts that have the featured post custom meta data set to true
* 'featured_post_meta_key' - The custom meta field that identifies the featured post, will also accept an array
* 'order' - [ ASC | DESC ]
* 'orderby'	- [ date | menu_order ]
* 'posts_per_page' - Set number of posts to return, -1 will return all
* 'post_type' - [ post | page | custom post type | array() ]
* 'taxonomy_filter'	- [ true | false ] - Set to true to filter by taxonomy
* 'taxonomy_key' - The key of the taxonomy we wish to filter by
* 'taxonomy_terms' - The terms (uses slug), will accept a string or array

Use the arguments like so:

$defaults = array(
	'featured' => false,
	'featured_post_meta_key' => '_conveyor_featured',
	'order'	=> 'ASC',
	'orderby' => 'date',
	'posts_per_page' => 5,
	'post_type'	=> 'conveyor_slides'
	'taxonomy_filter' => false,
	'taxonomy_key' => 'conveyor_group',
	'taxonomy_terms' => 'conveyor-group-1'
);

get_posts( conveyor_query_arguements( $defaults ) );

= What does conveyor_render_boostrap() do? =

This function will render a Bootstrap 3 carousel, use it like so: 

conveyor_render_boostrap();

It accepts all the same arguments as conveyor_query_arguements(), as well as the following arguments as an array (or you can leave the $args empty to use the defaults):

* 'id' -  If you want to have multiple carousels, you will want to change the id each time
* 'images_as_links'	- [ true | false ] - Set to true to wrap images with links (if _conveyor_link set on post)
* 'render_captions'	- [ true | false ] - Set to true to render captions when excerpt is not empty
* 'render_controls' - [ true | false ] - Show the slide left right controls
* 'render_indicators' - [ true | false ] - Show the slide indicators

Use the arguments like so:

$defaults = array(
	'featured' => false,
	'featured_post_meta_key' => '_conveyor_featured',
	'id' => 'conveyor_carousel',
	'images_as_links' => true,
	'order' => 'ASC',
	'orderby' => 'date',
	'posts_per_page' => 5,
	'post_type' => 'conveyor_slides',
	'taxonomy_filter' => false,
	'taxonomy_key' => 'conveyor_group',
	'taxonomy_terms' => 'conveyor-group-1'
	'render_captions' => true,
	'render_controls' => true,
	'render_indicators' => true
);

conveyor_render_boostrap( $defaults );

= The bootstrap carousel isnt working, what do I need to do? =

The plugin will only render the HTML and JavaScript configuration for the carousel, you will need to add Bootstrap CSS and JS to your theme.

= Can I contribute? =

Sure thing, the GitHub repository is right here: https://github.com/mwtsn/conveyor

== Changelog ==

= 1.1.3 =
* Fixed featured image issue

= 1.1.2 =
* Optimisations

= 1.1.1 =
* Added page-attributes to custom post type

= 1.1.0 =
* Added support for taxonomy queries to filter posts

= 1.0.3 =
* Future proofed the way Bootstrap renders by including $version argument

= 1.0.2 =
* Initial WordPress repository release

== Upgrade notice ==

There have been no breaking changes so far.