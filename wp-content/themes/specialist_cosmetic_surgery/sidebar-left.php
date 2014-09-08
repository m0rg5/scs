<?php
/**
 * The Left Sidebar containing the main widget.
 *
 * @package SCS
 * @since SCS 0.1
 */
?>
<div id="secondary-left" class="widget-area" role="complementary">
	
  <div id="sidebar-left">
  		 <?php
		
				$pages_category = get_pages('child_of='.$post->ID.'&sort_column=menu_order&parent='.$post->ID);
		           if($pages_category){
		             $page_id=$post->ID;
		           } else {
		             $page_id=$post->post_parent;
		           } 
		 
		  if(($pages_category) ||($post->post_parent)){
				$pages_category = get_pages('child_of='.$page_id.'&sort_column=menu_order&parent='.$page_id);
				$sub_pages=count($pages_category);
				 if($sub_pages>0):?>
				 <div class="left-menu">
				 			            <h2><?php  echo get_the_title($page_id); ?></h2>
                      <ul class="left-submenu">
                       <?php foreach($pages_category as $sub_pages):?>
    
                          <li <?php if($post->ID==$sub_pages->ID){ echo'class="current-menu-items"'; } ?>><a href="<?php  echo get_page_link($sub_pages->ID);?>">
        <?php 
				      echo $sub_pages->post_title;?>
        </a></li>
      <?php
					  endforeach;?>
    </ul>
		 <a class="parent_link" href="<?php echo get_permalink($post->post_parent); ?>">&laquo; Back to <?php echo get_the_title($post->post_parent); ?> </a>
</div>
 
  <?php
 
					  endif;
				}
                ?>  
				
				  <?php if ( is_active_sidebar( 'sidebar-left' ) ) : ?>
                      <?php dynamic_sidebar( 'sidebar-left' ); ?>
				<?php endif; ?>
				</div>
  <!-- #tertiary .widget-area -->
  </div>