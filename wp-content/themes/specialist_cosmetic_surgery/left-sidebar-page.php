<?php
/**
 * Template Name: Left sidebar
 * Description: A template with left sidebar
 *
 * @package SCS
 * @since SCS 0.1
 */

get_header(); ?>
<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		 <div id="search">
    <?php get_search_form(); ?>
  </div>
	</header><!-- .entry-header -->
	
<div class="col2-left-layout">

		<div id="primary" class="full-width">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'pageleft' ); ?>

				<?php //comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar('left'); ?>
</div>
<?php get_footer(); ?>