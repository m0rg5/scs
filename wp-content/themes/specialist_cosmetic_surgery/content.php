<?php
/**
 * @package SCS
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!--<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'squeeze' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>-->
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'squeeze' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
	    <?php 
		 if ( !( is_search()) ) {
		$featured_img  = get_the_post_thumbnail($post->ID, 'featurd-image');
		 if($featured_img){ 
		echo $featured_img;
		}
		}
		?>
	<?php 
		if ( !empty( $post->post_excerpt ) )
		{
			the_excerpt();
	        echo '<p><a class="more-link" href="'. get_permalink($post->ID).'">Read More</a></p>';
		}
		else
		the_content( __( 'Read More', 'scs' ) ); 
		?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'scs' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
<?php if ( !( is_search() )) : ?>
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
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
