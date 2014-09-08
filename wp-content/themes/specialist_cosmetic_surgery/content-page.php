<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package SCS
 * @since SCS 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
	 	
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'squeeze' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'squeeze' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
	<div>
		 <?php 
		//about the faceboo,twitter,sharebuttom like//
          $permalinks = get_permalink($post->ID);
		  $thetitle   = get_the_title($post->ID);
		  do_action('addthis_widget', $permalinks, $thetitle,'button');
		  ?>
		  </div>
</article><!-- #post-<?php the_ID(); ?> -->
