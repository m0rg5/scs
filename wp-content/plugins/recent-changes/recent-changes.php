<?php
/*
Plugin Name: Recent Changes
Plugin URI: http://titusbicknell.com/wp-recent-changes
Description: A widget and short code to show the most recently modified pages, posts or both allowing visitors to review recent changes as they would on a wiki. Options to select number of items returned and exclude items by ID. Shortcode [recentchanges] with options content, exclude and number e.g. [recentchanges content='pages' number='10' exlcude='5,8']
Version: 1.5
Author: Titus Bicknell
Author URI: http://www.titusbicknell.com
*/

function SC_RecentChanges($atts) {
extract(shortcode_atts( array(
	'content' => 'both',
    'number' => '5',
    'exclude' => ''
    ), $atts ) );
include 'recent-changes-inc.php';
return $rc_output;
}    

add_shortcode("recentchanges", "SC_RecentChanges");

function widget_RecentChanges($args) {
extract($args);

$rc_options = get_option('widget_RecentChanges');
$rc_title = empty($rc_options['title']) ? __('Recent Changes') : apply_filters('widget_title', $rc_options['title']);
$content = $rc_options['content'];	
$number = $rc_options['number'];
$exclude = $rc_options['exclude'];

include 'recent-changes-inc.php';
echo $rc_output;

}

function widget_RecentChanges_control() {
$rc_options = $rc_newoptions = get_option('widget_RecentChanges');
if ( isset($_POST["RecentChanges-submit"]) ) {
	$rc_newoptions['title'] = strip_tags(stripslashes($_POST["RecentChanges-title"]));
	$rc_newoptions['number'] = (int) $_POST["RecentChanges-number"];
	$rc_newoptions['content'] = strip_tags(stripslashes($_POST["RecentChanges-content"])); 
	$rc_newoptions['exclude'] = strip_tags(stripslashes($_POST["RecentChanges-exclude"])); 	
	}
if ( $rc_options != $rc_newoptions ) {
	$rc_options = $rc_newoptions;
	update_option('widget_RecentChanges', $rc_options);
	}
$rc_title = attribute_escape($rc_options['title']);
if ( !$rc_number = (int) $rc_options['number'] )
	$rc_number = 5;
$rc_content = attribute_escape($rc_options['content']);
if ($rc_content == 'pages') {
	$selectedpages = 'selected'; }
else if ($rc_content == 'posts') {
	$selectedposts = 'selected'; }
else {
	$selectedboth = 'selected'; }
$rc_exclude = attribute_escape($rc_options['exclude']);
$rc_exclude = preg_replace('/[^0-9,]/', '', $rc_exclude);
?>

<p><label for="RecentChanges-title"><?php _e('Title:'); ?> <input class="widefat" id="RecentChanges-title" name="RecentChanges-title" type="text" value="<?php echo $rc_title; ?>" /></label></p>
<p><label for="RecentChanges-content"><?php _e('Content:'); ?></label>
<select name="RecentChanges-content" id="RecentChanges-content" class="widefat">
<option value="pages"<?php echo $selectedpages; ?>>pages</option>
<option value="posts"<?php echo $selectedposts; ?>>posts</option>
<option value="both"<?php echo $selectedboth; ?>>both</option>
</select></p>
<p><label for="RecentChanges-number"><?php _e('Number of pages to show:'); ?> <input style="width: 25px; text-align: center;" id="RecentChanges-number" name="RecentChanges-number" type="text" value="<?php echo $rc_number; ?>" /></label><br />
<small><?php _e('(at most 15)'); ?></small></p>
<p><label for="RecentChanges-exclude"><?php _e('Exclude:'); ?> <input class="widefat" id="RecentChanges-exclude" name="RecentChanges-exclude" type="text" value="<?php echo $rc_exclude; ?>" /></label><br />
<small><?php _e('page/post IDs, separated by commas.'); ?></small></p>
<input type="hidden" id="RecentChanges-submit" name="RecentChanges-submit" value="1" />
<?php
}

function init_RecentChanges() {
register_sidebar_widget("Recent Changes", "widget_RecentChanges");
register_widget_control( 'Recent Changes', 'widget_RecentChanges_control');   
}

add_action("plugins_loaded", "init_RecentChanges");

?>