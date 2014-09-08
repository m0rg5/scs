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
<!-- jet phone-analytics -->
<script type="text/javascript">
       _paq = window._paq || [];
       
       _paq.push({
              'name':'register tracker',
              'method': function() { _pa.getTracker('WT1794').trackPageView(); },
              'when':'now'});
       
       _paq.push({
       'name':'replace number',
       'method': function() { _pa.getTracker('WT1794').replaceByClass('dynamic-phone', 'Main.Number', '#### ### ###'); },
       'when':'poll'});

       (function() {
              var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;
              pa.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.phone-analytics.com/WebTracker/WT1794/pa.js?async=true';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(pa, s);
       })();
</script>
<!-- end jet phone-analytics -->
<?php if(is_page(2136)){ ?>
<!-- Google Code for Email Enquiry Conversion Page -->
 <script  type="text/javascript">
 /* <![CDATA[ */
 var google_conversion_id = 1009327486; var google_conversion_language 
 = "en"; var google_conversion_format = "2"; var 
 google_conversion_color = "ffffff"; var google_conversion_label = 
 "ztWGCLLarAQQ_rqk4QM"; var google_conversion_value = 0;
 /* ]]> */
 </script>
 <script type="text/javascript" 
 src="//www.googleadservices.com/pagead/conversion.js">
 </script>
 <noscript>
 <div style="display:inline;">
 <img height="1" width="1" style="border-style:none;" alt="" 
 src="//www.googleadservices.com/pagead/conversion/1009327486/?value=0&
 amp;label=ztWGCLLarAQQ_rqk4QM&amp;guid=ON&amp;script=0"/>
 </div>
 </noscript>
 <?php } ?>
 
  <!-- Google Code for Remarketing tag -->
 
<!-- Remarketing tags may not be associated with personally 
identifiable information or placed on pages related to sensitive 
 categories. For instructions on adding this tag and more information 
 on the above requirements, read the setup guide:
 google.com/ads/remarketingsetup [1] -->
 
 <script type="text/javascript">
 
 /* <![CDATA[ */
 
var google_conversion_id = 1009327486;
 
 var google_conversion_label = "3LsyCMKA1QQQ_rqk4QM";
 
 var google_custom_params = window.google_tag_params;
 
 var google_remarketing_only = true;
 
 /* ]]> */
 
 </script>
 
 <script type="text/javascript" 
 src="//www.googleadservices.com/pagead/conversion.js [2]">
 
 </script>
 
 <noscript>
 
 <div style="display:inline;">
 <img height="1" width="1" style="border-style:none;" alt="" 
 src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/100932
 7486/?value=0&amp;label=3LsyCMKA1QQQ_rqk4QM&amp;guid=ON&amp;script=0
 [3]"/>
 
 </div>
 
 </noscript>

</body>
</html>