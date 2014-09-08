<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage SCS
 * @since SCS 0.1
 */
?>
</div>
<!-- #main -->

<footer id="colophon" role="contentinfo">
 <div class="footer-top-wrapper"> <?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
  ?></div>
	
	<div class="footer-bottom-wrapper">
  	<div class="footer-content"><?php if ( is_active_sidebar( 'copyright-widget' ) ) : ?>
  
  <div id="copyright">
    <?php dynamic_sidebar( 'copyright-widget' ); ?>
  </div>
  <!-- #copyright .widget-area -->
  <?php endif; ?>
  <div id="site-generator">
    <div class="site-by">Site by <a href="http://squeezecreative.com.au" rel="external">Squeeze Creative</a></div>
  </div>  </div> </div>
</footer>
<!-- #colophon -->
</div>
<!-- #page -->


<script src="<?php bloginfo( 'template_url' );?>/plugins/uniform/js/jquery.uniform.min.js" type="text/javascript"></script>
<!--<script src="<?php bloginfo( 'template_url' );?>/plugins/uniform/js/jquery.multiselect.min.js" type="text/javascript"></script>-->

<script src="<?php bloginfo( 'template_url' );?>/plugins/responsive/js/modernizr.custom.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' );?>/plugins/responsive/js/jquery.dlmenu.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' );?>/js/init.js" type="text/javascript"></script>

<?php wp_footer(); ?>



</body>
</html>