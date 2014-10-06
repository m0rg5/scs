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
    </div> </div>
</footer>
<!-- #colophon -->
</div>
<!-- #page -->


<script src="<?php bloginfo( 'template_url' );?>/plugins/uniform/js/jquery.uniform.min.js" type="text/javascript"></script>
<!--<script src="<?php bloginfo( 'template_url' );?>/plugins/uniform/js/jquery.multiselect.min.js" type="text/javascript"></script>-->

<script src="<?php bloginfo( 'template_url' );?>/plugins/responsive/js/modernizr.custom.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' );?>/plugins/responsive/js/jquery.dlmenu.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' );?>/js/init.js" type="text/javascript"></script>
<!-- jet phone-analytics -->
<script type=3D"text/javascript">
       _paq =3D window._paq || [];
      =20
       _paq.push({
              'name':'register tracker',
              'method': function() { =
_pa.getTracker('WT1794').trackPageView(); },
              'when':'now'});
      =20
       _paq.push({
       'name':'replace number',
       'method': function() { =
_pa.getTracker('WT1794').replaceByClass('dynamic-phone', 'Main.Number', =
'#### ### ###'); },
       'when':'poll'});

       (function() {
              var pa =3D document.createElement('script'); pa.type =3D =
'text/javascript'; pa.async =3D true;
              pa.src =3D ('https:' =3D=3D document.location.protocol ? =
'https://' : 'http://') + =
'cdn.phone-analytics.com/WebTracker/WT1794/pa.js?async=3Dtrue';
              var s =3D document.getElementsByTagName('script')[0]; =
s.parentNode.insertBefore(pa, s);
       })();
</script>
<!-- end jet phone-analytics -->

<!--STICK MENU WITH ANIMATION-->
<script src="<?php echo includes_url('/js/jquery.sticky.js'); ?>"></script>
<script type="text/javascript">
var wrapperClass = '.navigation';
var oHeight = jQuery(wrapperClass).height();
var oLHeight = parseInt(jQuery('#menu-main-navigation > li').css('line-height'));
var maxReduce = 20;
jQuery(document).ready(function(){
    jQuery(wrapperClass).sticky({topSpacing:0});
});

jQuery(window).scroll(function(){
    jQuery(wrapperClass).find('#menu-main-navigation > li >  a').css('line-height','auto');
    if(jQuery('.sticky-wrapper').offset() && jQuery(window).scrollTop() > jQuery('.sticky-wrapper').offset().top)
    {
        var m = jQuery(window).scrollTop() - jQuery('.sticky-wrapper').offset().top;
        reduce = m > maxReduce ? maxReduce : m;
        var nHeight = oHeight - reduce;
        var nLHeight = oLHeight - reduce;
        jQuery(wrapperClass).css('height', nHeight+'px');
        jQuery('.sub-menu').css('top', nHeight+'px');
        jQuery(wrapperClass).find('#menu-main-navigation > li').css('height', nHeight+'px');
        jQuery(wrapperClass).find('#menu-main-navigation > li > a').css('line-height', nLHeight+'px');
        if (m > 8) {
            jQuery(wrapperClass).find('#menu-main-navigation > li >  a').css('font-size','15px');
        }
        if (m > 15) {
            jQuery(wrapperClass).find('#menu-main-navigation > li > a').css('font-size','14px');
        }
    }
    else {
        //restore to original state
        jQuery(wrapperClass).removeAttr('style');
        jQuery('.sub-menu').removeAttr('style');
        jQuery(wrapperClass).find('#menu-main-navigation > li').removeAttr('style');
        jQuery(wrapperClass).find('#menu-main-navigation > li > a').removeAttr('style');
    }
});
</script>
<!--END OF STICKY MENU-->

<!--GALLERY BUTTONS-->
<div id="gallery-overlay"></div>
<script>
showgallery = function() {
    if (jQuery('.ngg-galleryoverview')) {
        jQuery('#gallery-overlay').fadeIn();
        jQuery('.ngg-galleryoverview').fadeIn();
    }
}

hidegallery = function() {
    if (jQuery('.ngg-galleryoverview')) {
        jQuery('.ngg-galleryoverview').fadeOut();
        jQuery('#gallery-overlay').fadeOut();
    }
}

/*execute it gallery hide immediately*/
if (jQuery('.ngg-galleryoverview')) {
    jQuery('.ngg-galleryoverview').hide();
}

jQuery(document).ready(function(){
    /*append content to gallery */
    jQuery('<p class="gallery-title title">Image Gallery</p>').insertBefore('.slideshowlink');
    jQuery('.ngg-galleryoverview').wrap('<div id="gallery-wrapper"/>');

    jQuery('.bk-button').click(function(){
        showgallery();
        return false;
    });
    jQuery('#gallery-overlay').click(function(){
        hidegallery();
    });
});
</script>
<!--END OF BUTTONS-->

<!--FIX YOUTUBE OVERLAP-->
<script>
jQuery(document).ready(function() {
    jQuery("iframe").each(function(){
        var ifr_source = jQuery(this).attr('src');
        var wmode = "wmode=transparent";
        if(ifr_source) {
            if(ifr_source.indexOf('?') != -1)
            {
                jQuery(this).attr('src',ifr_source+'&'+wmode);
            }
            else
            {
                jQuery(this).attr('src',ifr_source+'?'+wmode);
            }
        }
    });
});
</script>
<!--END OF YOUTUBE-->

<!--ADD CSS3 SUPPORT FOR IE-->
<!--[if IE]>
<script type="text/javascript" src="path/to/PIE.js"></script>
<![endif]-->
<script>
jQuery(function() {
    if (window.PIE) {
        jQuery('.ngg-galleryoverview').each(function() {
            PIE.attach(this);
        });
    }
});
</script>

<?php wp_footer(); ?>
<!--delacon tracking code start-->
<script type="text/javascript">
var cids = "13522";
var refStr = escape(document.referrer);
var dd = document, ll = dd.createElement("script"), ss = dd.getElementsByTagName("script")[0];
ll.type = "text/javascript"; ll.async = true; ll.src = ("https:" == document.location.protocol ? "https://" : "http://") + "vxml4.delacon.com.au/sited/ref/phonenum.jsp?m_id=201&cids=" + cids + "&ref=" + refStr;
ss.parentNode.insertBefore(ll,ss);

function makePhoneCall(cid, defNum) {
	<!-- If only mobile browser is allowed to click, put the mobile browser detection code here. -->
	var numDivVar = document.getElementById("numdiv_" + cid + "_0");
	if (numDivVar) {
		var telno = numDivVar.innerHTML;
		var tsArray = telno.split(" ");
		telno = tsArray.join("");
		location.href = "tel:" + telno;
	}
	else {
		location.href = "tel:" + defNum;

	}
}

</script>
<!--delacon tracking code end-->
<?php if(is_page(3197)){ ?>
<!-- Google Code for Email Enquiry Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1009327486;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "ztWGCLLarAQQ_rqk4QM";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1009327486/?value=0&amp;label=ztWGCLLarAQQ_rqk4QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


<!--delacon tracking code end-->
<?php } ?>
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
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1009327486;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1009327486/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript> 


</body>
</html>
