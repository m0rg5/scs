<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package SCS
 * @since SCS 0.1
 */

get_header(); ?>
	<?php if ( have_posts() ) : ?>
	<header class="entry-header">
					<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'squeeze' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<div id="search">
     <?php get_search_form(); ?>
  </div>
				</header>
				<?php else: ?>
				<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'squeeze' ); ?></h1>
						<div id="search">
    <?php get_search_form(); ?>
  </div>
					</header><!-- .entry-header -->

<?php endif; ?>

<div class="col2-right-layout">

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

			

				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php scs_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'squeeze' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>