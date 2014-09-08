<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage SCS
 * @since SCS 0.1
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--<meta name="viewport" content="width=device-width; initial-scale=1.0"/>-->
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'squeeze' ), max( $paged, $page ) );

	?>
</title>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/favicon.ico" />
<link rel="apple-touch-icon" href='<?php bloginfo( 'stylesheet_directory' ); ?>/iPad-Icon.png'/>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' );?>/plugins/superfish/css/superfish.css" />

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' );?>/plugins/responsive/css/responsive-menu.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' );?>/plugins/uniform/css/uniform.default.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' );?>/plugins/uniform/css/jquery.multiselect.css" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<!--<script src="<?php bloginfo( 'template_url' );?>/plugins/jquery/jquery.js" type="text/javascript"></script>-->
<?php wp_head(); ?>
<script src="<?php bloginfo( 'template_url' );?>/js/hoverIntent.minified.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' );?>/plugins/superfish/superfish.js"></script>



<link href="<?php bloginfo( 'template_url' );?>/plugins/photoswipe/css/swipebox.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' );?>/plugins/flexslider/flexslider.css" type="text/css"  />
<script src="<?php bloginfo( 'template_url' );?>/plugins/photoswipe/js/ios-orientationchange-fix.js"></script>
<script src="<?php bloginfo( 'template_url' );?>/plugins/photoswipe/js/jquery.swipebox.min.js"></script>

<?php if(is_front_page()){ ?>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' );?>/plugins/flexslider/flexslider.css" type="text/css"  />
<script src="<?php bloginfo( 'template_url' );?>/plugins/flexslider/jquery.flexslider-min.js"></script>

<script>
jQuery(window).load(function($) {
    jQuery('.flexslider').flexslider({
			controlNav: false,
		 	directionNav: true,
			 pauseOnAction: false   
			});
  });
</script>
<?php } ?>


<script type="text/javascript">

		jQuery(function($) {
			$(".lightbox").swipebox();
			jQuery( '#dl-menu' ).dlmenu();
		var windowWidth = $(window).width();
});
	</script> 
<a href="https://plus.google.com/111639910729937746394?rel=author" style="display: none; visibility: hidden;">Google</a>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
<header id="branding" role="banner">
		<div class="top-header-wrapper">
				<div class="top-header">
						<?php if ( is_active_sidebar( 'location-widget' ) ) : ?>
						<div class="header-widget-left">
								<?php dynamic_sidebar( 'location-widget' ); ?>
						</div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'location-widget' ) ) : ?>
						<div class="header-widget-middle"><?php dynamic_sidebar( 'contact-widget' ); ?></div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'social-widget' ) ) : ?>
						<div class="header-widget-right"><?php dynamic_sidebar( 'social-widget' ); ?></div>
						<?php endif; ?>
				</div>
		</div>
		<div class="logo-wrapper">
				<?php if ( is_active_sidebar( 'logo-widget' ) ) : ?>
				<div id="logo">
						<?php dynamic_sidebar( 'logo-widget' ); ?>
				</div>
				<!-- #logo .widget-area -->
				<?php endif; ?>
		</div>

</header>
<div class="navigation demo-2">	
			<div class="main">
<div  class="dl-menuwrapper" id="dl-menu">	<button class="dl-trigger"><span>MENU</span></button><nav role="navigation" id=access> 
		<?php wp_nav_menu( array( 'theme_location' => 'primary','menu_class' => 'menu sf-menu' ) ); ?>		
</nav>




</div>


</div>



</div>
<div id="main">
<div id="banner">
<?php if(is_front_page()){ ?>
<div class="flexslider">
 <?php   $args = array('post_type' => 'home-slides', 'posts_per_page' =>'-1');
         $loop = new WP_Query($args);
		   if($loop) { 
   ?>
   <ul class="slides">
   <?php while ($loop->have_posts()) : $loop->the_post();  ?>
              <?php  $banner_img_large=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'banner-image_large');
			  $target_url=get_post_meta($post->ID,'target_url',TRUE);
			
			   $target=get_post_meta($post->ID,'target',TRUE);
			          if($banner_img_large){ 
			   ?>
			    <li><img src="<?php echo $banner_img_large[0]; ?>">
				   <div class="text_content">
				     <h2><?php the_title(); ?></h2>
					 <?php the_content(); ?>
					  <?php if($target_url){ ?>
					  <a href="<?php if($target_url=='#'){echo 'javascript: void(0)';} else { echo $target_url; }?>" <?php if($target){ echo 'target="_balnk"'; } ?> class="readmore">Read More</a>
					  <?php } ?>
				    </div></li>
			        <?php } ?>
   <?php endwhile; ?>
    <!-- <li> <img src="<?php bloginfo( 'template_url' );?>/images/slider-1.jpg">
	        <div class="text_content">
			  <h2>Specialising in cosmetic procedures for women</h2>
			  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
			  <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takima.</p>
			  <a href="" class="readmore">Read More</a>
			</div>
	 </li>
	  <li> <img src="<?php bloginfo( 'template_url' );?>/images/slider-2.jpg">
	     <div class="text_content">
			  <h2>Specialising in cosmetic procedures for women</h2>
			  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
			  <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takima.</p>
			  <a href="" class="readmore">Read More</a>
			</div>
	  </li>
	  	  <li> <img src="<?php bloginfo( 'template_url' );?>/images/slider-3.jpg">
		     <div class="text_content">
			  <h2>Specialising in cosmetic procedures for women</h2>
			  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
			  <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takima.</p>
			  <a href="" class="readmore">Read More</a>
			</div>
		  </li>-->
   </ul>
   <?php } 
   wp_reset_query(); 
   ?>
</div>
<div class="homemenu">
  <?php wp_nav_menu( array( 'theme_location' => 'Home Graphic Menu') ); ?>
</div>
<?php } 
    else {
?>

		<?php if(is_active_sidebar( 'banner-widget-area' ) ) : ?>
		<?php dynamic_sidebar( 'banner-widget-area' ); ?>
		<?php endif;?>
		<?php } ?>
</div>
