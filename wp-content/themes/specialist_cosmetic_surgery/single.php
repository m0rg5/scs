<?php
/**
 * The Template for displaying all single posts.
 *
 * @package SCS
 * @since SCS 0.1
 */

get_header(); ?>
<header class="entry-header sandeep">
		<h1 class="entry-title">
			<?php echo $our_title = get_the_title( get_option('page_for_posts', true)); ?> 
		</h1><div id="search">
    <?php get_search_form(); ?>
  </div>
	</header><!-- .entry-header -->
	 
<div class="col2-right-layout">
		<div id="primary">
			<div id="content" role="main">
             
			<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

				
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>
                <?php scs_content_nav( 'nav-below' ); ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>