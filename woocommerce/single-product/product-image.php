<?php
/**
 * Single Product Image
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $post, $product;

if(!has_post_thumbnail()) return;

/*gallery layout list*/
$c_shop_layout = get_theme_mod('c_shop_layout', 'horizontal');
$type = $c_shop_layout;

$p_shop_layout = function_exists('fw_get_db_post_option') ? fw_get_db_post_option($post->ID, 'p_shop_layout') : 'default';
if(isset($p_shop_layout) && $p_shop_layout != 'default'){
    $type = $p_shop_layout;
}

$zoom = ($type != 'list') ? 'ez-zoom' : '';

/*sale*/
$sale = $product->is_on_sale();
$sale_price = $product->get_sale_price();
$regular_price = $product->get_regular_price();
/*variation product*/
$variation = $product->is_type( 'variable' );
/*img id*/
$img_id = get_post_thumbnail_id( $post->ID );
/*img alt*/
$img_alt = minera_img_alt($img_id, esc_html__('Product image', 'minera'));
/*img full size*/
$image = wp_get_attachment_image_src( $img_id, 'full' );
/*img view on main carousel*/
$slide_img = wp_get_attachment_image_src( $img_id, 'shop_single' );
/*img thumbnail*/
$slide_thumb = $type != 'list' ? wp_get_attachment_image_src( $img_id, 'thumbnail' ) : wp_get_attachment_image_src( $img_id, 'full' );
/*gallery ids*/
$gallery_ids = $product->get_gallery_image_ids(); ?>

<div class="w-images-box w-layout-<?php echo ($type != 'list') ? 'slider' : 'list'; ?>">
    <?php if ( $sale ) : ?><span class="onsale"><?php if($variation){
            esc_html_e('Sale!', 'minera');
        }else{
            $final_price = (($regular_price - $sale_price) / $regular_price) * 100;
            echo '-' . round($final_price, 2) . '%';
        } ?></span>
    <?php endif; ?>
    <div class="w-img-crs w-crs">
        <div data-zoom="<?php echo esc_url($image[0]); ?>" class="w-img-item <?php echo esc_attr($zoom); ?>">
            <img src="<?php echo esc_url($slide_img[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
        </div>
        <?php if($gallery_ids):
            foreach($gallery_ids as $key):
                $image = wp_get_attachment_image_src( $key, 'full' );
                if($image):
                    $slide_img = wp_get_attachment_image_src( $key, 'shop_single' );
                    $img_alt = minera_img_alt($key, 'Product image thumbnail'); ?>
                    <div data-zoom="<?php echo esc_url($image[0]); ?>" class="w-img-item <?php echo esc_attr($zoom); ?>">
                        <img src="<?php echo esc_url($slide_img[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                    </div> 
            <?php endif; ?>
        <?php endforeach; endif; ?>
      
    </div>
     <div class="zoom"> <i class="ht-ico-search"></i> Mouse over to Zoom </div> 
    <?php if($gallery_ids && $type != 'list'):/*gallery empty*/ ?>
        <div class="w-thumb-crs w-crs flex-control-nav flex-control-thumbs">
            <div class="w-thumb-item">
                <img src="<?php echo esc_url($slide_thumb[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
            </div>
            <?php foreach($gallery_ids as $key):
                $thumb = $type != 'list' ? wp_get_attachment_image_src( $key, 'thumbnail' ) : wp_get_attachment_image_src( $key, 'full' );
                if($thumb):
                    $img_alt = minera_img_alt($key, 'Product image thumbnail'); ?>
                    <div class="w-thumb-item">
                        <img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php /*product sticky*/

if($type == 'list'){
    $offet = get_theme_mod('sticky', false) == true ? 100 : 40;

    wp_enqueue_script('minera-product-sticky-content', get_template_directory_uri() . '/js/sticky.min.js', false, true);
    wp_add_inline_script(
        'minera-product-sticky-content',
        "$('.w-summary-box').stick_in_parent({
            parent: '.w-data-view',
            offset_top: {$offet}
        });",
        'after'
    );
}