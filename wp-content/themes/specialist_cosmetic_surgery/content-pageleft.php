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
	<?php $featured_img  = get_the_post_thumbnail($post->ID, 'featurd-image');
		 if($featured_img){ 
		echo $featured_img;
		}
		?>
		<?php the_content(); ?>
		
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'squeeze' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'squeeze' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
