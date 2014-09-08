<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package SCS
 * @since SCS 0.1
 */

get_header(); ?>
<header class="entry-header">
					<h1 class="entry-title"><?php
						printf( __( '%s', 'squeeze' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					?></h1>
 <div id="search">
    <?php get_search_form(); ?>
  </div>
					</header>

<div class="col2-right-layout">
		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				
				<?php rewind_posts(); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php scs_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'squeeze' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'squeeze' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>