<?php
/**
 * The Left Sidebar containing the main widget.
 *
 * @package SCS
 * @since SCS 0.1
 */
?>
<div id="secondary-left" class="widget-area" role="complementary">
  <?php if ( is_active_sidebar( 'sidebar-left' ) ) : ?>
	
  <div id="sidebar-left"><a href="#" class="responsive-menu" id="pull-left"><span>LEFT MENU</span></a>
    <?php dynamic_sidebar( 'sidebar-left' ); ?>
		
  </div>
  <!-- #tertiary .widget-area -->
  <?php endif; ?>
</div>