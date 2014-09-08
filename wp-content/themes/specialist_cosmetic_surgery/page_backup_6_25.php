<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
	
<div class="col2-right-layout">

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				
				<?php endwhile; // end of the loop. ?>
				

			</div><!-- #content -->
		</div><!-- #primary -->
	

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>