<?
if ($number < 0 || $number > 15) { $rc_number = 15; } 
else { $rc_number = $number; }

if ( $content == 'pages' ) { $rc_content_sql = "post_type = 'page' AND post_status = 'publish'"; }
else if ($content == 'posts' ) { $rc_content_sql = "post_type = 'post' AND post_status = 'publish'"; }
else { $rc_content_sql = "post_type = 'page' AND post_status = 'publish' OR (post_type = 'post' AND post_status = 'publish')"; }


$rc_exclude = preg_replace('/[^0-9,]/', '', $exclude);
$rc_exclude_array = explode(',', $rc_exclude);
if ($exclude != '') {
$rc_number = $rc_number + count($rc_exclude_array);
}

global $wpdb;
$rc_sql = "SELECT post_title, ID FROM ".$wpdb->posts." WHERE ".$rc_content_sql." ORDER BY post_modified DESC LIMIT ".$rc_number;
$rc_output = $before_widget.$before_title.$rc_title.$after_title.'<ul>';
$RecentChanges = $wpdb->get_results($rc_sql);
foreach ($RecentChanges as $RecentChange) :
if (in_array($RecentChange->ID,$rc_exclude_array)) { } else {
$rc_url = get_permalink($RecentChange->ID);
$rc_output .= '<li><a href="'.$rc_url.'">'.$RecentChange->post_title.'</a></li>'."\n"; 
}
endforeach;
$rc_output .= '</ul>'.$after_widget;
$wpdb->flush();
?>