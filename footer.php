<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 * @package minera
 */


/*page option*/
$pid = get_queried_object_id();

$p_footer = function_exists('fw_get_db_post_option') ? fw_get_db_post_option($pid, 'footer_layout') : 'default';

/*customize option*/
$c_footer = get_theme_mod('c_footer_layout', 'default');

$footer_id = $c_footer;

if(!empty($p_footer) && $p_footer != 'default'){
	$footer_id = $p_footer;
}

if($footer_id != 'disable'): ?>
	<footer class="theme-footer flw">
		            
            <div id="theme-footer-4v2" class="wynsum-footer vc_row wpb_row vc_row-fluid">
	            <div class="container">
                <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-4 vc_col-xs-12">
	            <div class="vc_column-inner ">
	            <h4> <a href="https://wynsumwardrobe.com/about-us/">ABOUT US</a></h4>
	            <h4>&</h4>
<h4> <a href="https://wynsumwardrobe.com/wynsum-empower/">WYNSUM EMPOWER PROJECT</a></h4>

	            
            </div>
            </div>
            
             <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-4 vc_col-xs-12">
	            <div class="vc_column-inner follow-us">
	            <h4>Follow Us</h4>
	            <a href="https://www.instagram.com/wynsumwardrobe/?hl=en" target="_blank"><i class="fa fa-instagram"></i></a>
	            <a href="https://www.facebook.com/wynsumwardrobe/" target="_blank"><i class="fa fa-facebook-f"></i></a>
	            <a href="https://www.pinterest.com.au/smanschuetz/wynsum-wardrobe/" target="_blank"><i class="fa fa-pinterest"></i></a>
            </div>
            </div>
            
             <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-4 vc_col-xs-12">
	            <div class="vc_column-inner ">
	           <h4>Signup</h4>
	            <!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup"><form id="mc-embedded-subscribe-form" class="validate" action="https://wynsumwardrobe.us17.list-manage.com/subscribe/post?u=f6d49cef84a13dd3b664a1cbf&amp;id=83199f3b59" method="post" name="mc-embedded-subscribe-form" novalidate="" target="_blank">
<div id="mc_embed_signup_scroll" class="ctf-fashion-4"><label>
<input id="mce-EMAIL" class="email" name="EMAIL" required="" type="email" value="" placeholder="Your Email   &#xf0e0;" style="font-family:Quattrocento Sans, FontAwesome; font-size: 13px; color: #000;" />
</label>
<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
<div style="position: absolute; left: -5000px;" aria-hidden="true"><input tabindex="-1" name="b_f6d49cef84a13dd3b664a1cbf_83199f3b59" type="text" value="" /></div>
<div class="clear"><input id="mc-embedded-subscribe" class="button" name="subscribe" type="submit" value="Subscribe" /></div>
</div>
</form></div>
<!--End mc_embed_signup-->
	            </div>
	            
            </div>
          <div class="clear-block">&nbsp;&nbsp;&nbsp;</div> 
<div class="wynsum-footer-bottom">  
           
            <ul class="ft-menu-custom-df text-center">
	<li><a href="/returns-policy">Shipping & Returns</a></li>
	<li><a href="/contact-us">Contact Us</a></li>
 	<li><a href="/fit-guide">Fit Guide</a></li>
 	<li><a href="/collaborations">Collaborations</a></li>

 	
 	
</ul>

<img class="alignnone size-full wp-image-3014 payment-options" src="https://wynsumwardrobe.com/wp-content/uploads/2018/10/payment-options.png" alt="Payment Options at Wynsum " width="247" height="34">
          </div>
            </div>
          
            </div>
            
            
		<span class="scroll-to-top ion-ios-arrow-up" aria-label="<?php esc_attr_e('Back to top', 'minera'); ?>" title="<?php esc_attr_e('Scroll To Top', 'minera'); ?>"></span>
	</footer>
<?php endif; ?>



<?php if(class_exists('Woocommerce' )):/*quick view content*/ ?>
	<div id="ht-quick-view-popup" class="c-ht-qvp" role="dialog">
		<div class="ht-qvo"></div>
		<div class="quick-view-box">
			<a href="#" id="ht-qvc" class="c-ht-qvc ion-ios-close-empty"></a>
		</div>
	</div>

	
	
	
    <div id="ht-cart-sidebar">
        <div class="cart-sidebar-head">
            <h3 class="cart-sidebar-title"><?php esc_html_e( 'Shopping cart', 'minera' ); ?></h3>
            <button class="cart-sidebar-close-btn ion-ios-close-outline" aria-label="<?php esc_attr_e('Close', 'minera'); ?>"></button>
        </div>
        <div class="cart-sidebar-content">
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
    <div class="ht-cart-overlay"></div>
<?php endif; ?>

<?php minera_header_layout_six($start = false);/*header-layout-6*/ ?>
<?php minera_page_content_boxed($start = false);/*page content boxed layout*/ ?>

</div>

<?php if(get_theme_mod('loading', false) == true):/*loading effect*/ ?>
    <span class="is-loading-effect"></span>
<?php endif; ?>

<?php wp_footer(); ?>


</body>
</html>
