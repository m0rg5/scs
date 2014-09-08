<?php
/**
 * @package SCS
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
	    <?php $featured_img  = get_the_post_thumbnail($post->ID, 'featurd-image');
		 if($featured_img){ 
		echo $featured_img;
		}
		?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'squeeze' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">

		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
		    
		         <span class="date">
			<?php scs_posted_on(); ?>
		</span><!-- .entry-meta -->
		<span class="sep"> | </span>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'scs' ) );
				if ( $categories_list && scs_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Categories: %1$s', 'scs' ), $categories_list ); ?>
			</span>
			<span class="sep"> | </span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'scs' ) );
				if ( $tags_list ) :
			?>
			<span class="tag-links">
				<?php printf( __( 'Tags: %1$s', 'scs' ), $tags_list ); ?>
			</span>
			<span class="sep"> | </span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'scs' ), __( '1 Comment', 'scs' ), __( '% Comments', 'scs' ) ); ?></span>
		<span class="sep"> | </span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'scs' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- #entry-meta -->
	<div>
		 <?php
		//about the faceboo,twitter,sharebuttom like//
          $permalinks = get_permalink($post->ID);
		  $thetitle   = get_the_title($post->ID);
		  do_action('addthis_widget', $permalinks, $thetitle,'fb_tw_sc');
		  ?>
		  </div>
</article><!-- #post-<?php the_ID(); ?> -->
