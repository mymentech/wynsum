<?php
/**
 * Single Product Meta
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $product;


$url = get_permalink($product->get_id());
$title = get_the_title($product->get_id());
$tags = get_the_terms( $product->get_id(), 'product_tag' );
$tags_list = '';
if ( $tags && ! is_wp_error( $tags ) ) {
    foreach ($tags as $key) {
        if($key === end($tags)){
            $tags_list .= $key->name;
        }else{
            $tags_list .= $key->name . ',';
        }
    }
}
$img = wp_get_attachment_image_src($product->get_id(), 'full');
?>

<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>




	
    <span class="theme-social-icon p-shared"><strong><?php esc_html_e('Share', 'minera'); ?></strong>
        <a href="<?php echo esc_url_raw('//facebook.com/sharer.php?u=' . urlencode($url)); ?>" title="<?php echo esc_attr($title); ?>" target="_blank"></a>
        
        <a href="<?php echo esc_url_raw('//pinterest.com/pin/create/button/?url=' . urlencode($url) . '&image_url=' . urlencode($img[0]) . '&description=' . urlencode($title)); ?>" title="<?php echo esc_attr($title); ?>" target="_blank"></a>
        
        <a href="<?php echo esc_url_raw('//twitter.com/intent/tweet?url=' . urlencode($url) . '&text=' . urlencode($title) . '&hashtags=' . urlencode($tags_list)); ?>" title="<?php echo esc_attr($title); ?>" target="_blank"></a>
        
        <a href="mailto:?subject=Have a look at this Dress&amp;body=Check this out <?php the_current_url(); ?>" class="mail-share" target="_blank"
   title="Share by Email">
 
</a>

    </span>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
