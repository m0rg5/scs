<?php
/**
 * SCS functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package SCS
 * @since SCS 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
 
 add_editor_style();

add_theme_support( 'post-thumbnails' );

function ilc_mce_buttons($buttons){
  array_push($buttons, "hr");
  return $buttons;
}
add_filter("mce_buttons", "ilc_mce_buttons");

if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'scs_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override scs_setup() in a child theme, add your own scs_setup to your child theme's
 * functions.php file.
 */
function scs_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on squeeze, use a find and replace
	 * to change 'squeeze' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'scs', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'scs' ),
		'Home Graphic Menu' => __( 'Graphic Menu', 'scs' ),
			) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );
}
endif; // scs_setup

/**
 * Tell WordPress to run scs_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'scs_setup' );

/**
 * Set a default theme color array for WP.com.
 */
$themecolors = array(
	'bg' => 'ffffff',
	'border' => 'eeeeee',
	'text' => '444444',
);

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function scs_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'scs_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function scs_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Logo Widget Area', 'squeeze' ),
		'id' => 'logo-widget',
		'description' => __( 'An optional widget area for your site logo', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Location Widget Area', 'squeeze' ),
		'id' => 'location-widget',
		'description' => __( 'An optional widget area for your site location', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	 
	 register_sidebar( array(
		'name' => __( 'Contact Widget Area', 'squeeze' ),
		'id' => 'contact-widget',
		'description' => __( 'An optional widget area for your site phone contact', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	 register_sidebar( array(
		'name' => __( 'Social Media Widget Area', 'squeeze' ),
		'id' => 'social-widget',
		'description' => __( 'An optional widget area for your site phone contact', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

  register_sidebar( array(
		'name' => __( 'Banner Widget Area', 'squeeze' ),
		'id' => 'banner-widget-area',
		'description' => __( 'An optional widget area for your site banner', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	/*register_sidebar( array(
		'name' => __( 'Social Media', 'squeeze' ),
		'id' => 'social-media',
		'description' => __( 'An optional widget area for your site specia widget', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );*/
	
	register_sidebar( array(
		'name' => __( 'Side Widget Area 1', 'squeeze' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Side Widget Area 2', 'squeeze' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'squeeze' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Sidebar Left', 'squeeze' ),
		'id' => 'sidebar-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget 1', 'squeeze' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget 2', 'squeeze' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget 3', 'squeeze' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'squeeze' ),
		'id' => 'copyright-widget',
		'description' => __( 'An optional widget area for your site copyright text', 'squeeze' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'init', 'scs_widgets_init' );

if ( ! function_exists( 'scs_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since SCS 1.2
 */
function scs_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>">
		<h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'squeeze' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php next_post_link( '<div class="nav-next">%link</div>','Next Post <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'toolbox' ) . '</span>' ); ?>
		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'toolbox' ) . '</span> Previous Post' ); ?>


	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-next"><?php next_posts_link( __( 'Next Page<span class="meta-nav">&raquo;</span>', 'squeeze' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-previous"><?php previous_posts_link( __( '<span class="meta-nav">&laquo; </span>Previous Page', 'squeeze' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // scs_content_nav


if ( ! function_exists( 'scs_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own scs_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since SCS 0.4
 */
function scs_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'squeeze' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'squeeze' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'squeeze' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'squeeze' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'squeeze' ), get_comment_date('F d, Y'), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'squeeze' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for scs_comment()

if ( ! function_exists( 'scs_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own scs_posted_on to override in a child theme
 *
 * @since SCS 1.2
 */
function scs_posted_on() {
	printf( __( '<span class="sep">Posted:  </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> </span>', 'squeeze' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('D d F  Y') ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'squeeze' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @since SCS 1.2
 */
function scs_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'scs_body_classes' );

/**
 * Returns true if a blog has more than 1 category
 *
 * @since SCS 1.2
 */
function scs_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so scs_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so scs_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in scs_categorized_blog
 *
 * @since SCS 1.2
 */
function scs_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'scs_category_transient_flusher' );
add_action( 'save_post', 'scs_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function scs_enhanced_image_navigation( $url ) {
	global $post, $wp_rewrite;

	$id = (int) $post->ID;
	$object = get_post( $id );
	if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'scs_enhanced_image_navigation' );


/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a SCS.
 */
 
 add_filter( 'wp_get_attachment_link' , 'add_lighbox_rel' );
function add_lighbox_rel( $attachment_link ) {

	if( strpos( $attachment_link , 'a href') != false && strpos( $attachment_link , 'img src') != false )
		global $post;
   $pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
    $replacement = '<a$1rel="lightbox[%LIGHTID%]" class="lightbox" href=$2$3.$4$5$6</a>';
  
    $attachment_link = preg_replace($pattern, $replacement,  $attachment_link);
    $attachment_link = str_replace("%LIGHTID%", $post->ID,  $attachment_link);
	return $attachment_link;
}

/*********************** ADD CUSTOM STYLE FOR ADMIN ************************************/
function addScript() {

    echo '<script language="javascript"></script>';
}

function new_excerpt_more($more) {
    global $post;
	return '[...]<a class="excerptreadmore" href="'. get_permalink($post->ID) . '">Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

wp_dequeue_script('jquery');

add_filter('widget_text', 'do_shortcode');

//adding image size for youtube widgets
add_image_size('youtube',273,158, true);

/*function parseYoutube($text) {
    $text = preg_replace('~
        # Match non-linked youtube URL in the wild. (Rev:20111012)
        https?://         # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)? # Optional subdomain.
        (?:               # Group host alternatives.
          youtu\.be/      # Either youtu.be,
        | youtube\.com    # or youtube.com followed by
          \S*             # Allow anything up to VIDEO_ID,
          [^\w\-\s]       # but char before ID is non-ID char.
        )                 # End host alternatives.
        ([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
        (?!               # Assert URL is not pre-linked.
          [?=&+%\w]*      # Allow URL (query) remainder.
          (?:             # Group pre-linked alternatives.
            [\'"][^<>]*>  # Either inside a start tag,
          | </a>          # or inside <a> element text contents.
          )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
        [?=&+%\w-]*        # Consume any URL (query) remainder.
        ~ix', 
        '$1',
        $text);
    return $text;
}*/
function load_scripts() {
	if(!is_admin()){
		
		wp_enqueue_style( 'site_default_style', get_bloginfo('stylesheet_url'), 'false','0.0', 'all' ) ;
	
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_bloginfo('template_url').'/plugins/jquery/jquery.js', false);
		wp_enqueue_script('jquery');
		
		
			
			
		}
	
}    

add_action('template_redirect', 'load_scripts'); // load_scripts in all pages if condition (like is_admin() ) in not used.

/* Custom CSS styles on WYSIWYG Editor ? Start
======================================= */
if ( ! function_exists( myCustomTinyMCE ) ) :
function myCustomTinyMCE($init) {
$init['theme_advanced_buttons2_add_before'] = 'styleselect'; // Adds the buttons at the begining. (theme_advanced_buttons2_add adds them at the end)
//$init['theme_advanced_styles'] = 'Float Left=fleft,Float Right=fright,Information PDF=information';
$init['theme_advanced_styles'] = 'PDF List Style=information';

return $init;
}
endif;
add_filter(tiny_mce_before_init, 'myCustomTinyMCE' );

add_theme_support( 'post-thumbnails' );
add_image_size( 'banner-image_small', 659, 320, true);
add_image_size( 'featurd-image', 240, 240, true);

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);


function custom_id()
{
global $post;
 if($post->post_parent)
  {
  $ancestors=get_post_ancestors($post->ID);
    $root=count($ancestors)-1;
    $parent = $ancestors[$root];
	}
	else {
	 $parent=$post->ID;
	 }
return $parent;
}




