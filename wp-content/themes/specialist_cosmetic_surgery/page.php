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
	<?php $children = get_pages('child_of='.$post->ID.'&parent='.$post->ID); ?>
<div class="<?php if(($post->post_parent) ||($children)){ echo 'col2-left-layout'; } else { echo'col2-right-layout' ; } ?>">

		<div id="primary" <?php if(($post->post_parent) ||($children)){ echo 'class="full-width"'; } ?>>
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
                         <?php if(($post->post_parent) ||($children)){ ?>
						 <?php get_template_part( 'content', 'pageleft' ); ?>
						 <?php } else { ?>
					<?php get_template_part( 'content', 'page' ); ?>
					<?php } ?>

				
				<?php endwhile; // end of the loop. ?>
				

			</div><!-- #content -->
		</div><!-- #primary -->
	
<?php if(($post->post_parent) ||($children)){ ?>
<?php get_sidebar('left'); ?>
<?php } else { ?>
<?php get_sidebar(); ?>
<?php } ?>
</div>
<?php get_footer(); ?>