<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage SCS
 * @since SCS 0.1
 */
?>
<div id="secondary-right" class="widget-area" role="complementary">
  <?php if ( is_active_sidebar( 'social-media' ) ) : ?>
  <div id="social-media">
    <?php dynamic_sidebar( 'social-media' ); ?>
  </div>
  <!-- #tertiary .widget-area -->
  <?php endif; ?>
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
  <div id="sidebar-1">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </div>
  <!-- #tertiary .widget-area -->
  <?php endif; ?>
  <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
  <div id="sidebar-2">
    <?php dynamic_sidebar( 'sidebar-2' ); ?>
  </div>
  <!-- #tertiary .widget-area -->
  <?php endif; ?>
</div>
