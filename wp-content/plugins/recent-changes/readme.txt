=== Plugin Name ===
Contributors: titusbicknell
Donate link: http://titusbicknell.com/wp-recent-changes
Tags: pages, posts, recent
Requires at least: 2.5
Tested up to: 3.0
Stable tag: trunk

== Description ==

A widget and short code to show the most recently modified pages, posts or both allowing visitors to review recent changes as they would on a wiki. Options to select number of items returned up to 15 and exclude items by ID. 

Use shortcode [recentchanges] with options content, exclude and number e.g. [recentchanges content='pages' number='10' exclude='5,8'] in post/pages.

content = 'pages', 'posts' or 'both'
number = '1' to '15'
exclude = any number of pages/post by ID separated by commas

NB this plugin supersedes Recent Pages

== Installation ==

1. Download <code>recent-changes.zip</code>
1. Upload and activate **Recent Changes** through the <code>Plugins</code> menu in **WordPress**
1. Add **Recent Changes** and set the widget preferences through the <code>Appearance -> Widgets</code> menu in **WordPress**

or

1. Download <code>recent-changes.zip</code>
1. Unzip <code>recent-changes.zip</code> and upload to the <code>/wp-content/plugins/</code> directory
1. Activate **Recent Changes** through the <code>Plugins</code> menu in **WordPress**
1. Add **Recent Changes** and set the widget preferences through the <code>Appearance -> Widgets</code> menu in **WordPress**

== Change Log ==

1.5:

* added shortcode structure with same variables as widget
* fixed error where searches with exclusions would return the wrong number of items

1.0:

* added exclude function to allow page/post to be excluded from list by ID

0.2:

* updated the SQL query to accept prefixed tables
* updated URL format to avoid W3C validator errors

0.1:

* designed query to return 1-15 most recently modified items with permalinks links
* added widget option to override default title in sidebar
* added widget option to allow 1-15 items to be displayed
* added widget option to allow selection of pages, posts or both
* tested up to 2.8-beta2-11509