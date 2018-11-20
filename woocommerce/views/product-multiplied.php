<?php
if (!defined('ABSPATH')) exit;

/*Ensure visibility*/
if (empty($product) || !$product->is_visible()) return;

/*product id*/
$pid = $product->get_id();

/*price*/
$p_price = $product->get_price_html();

/*description*/
$p_desc = get_the_excerpt($pid);

/*image*/
$img_id     = get_post_thumbnail_id($pid);
$img_src    = wp_get_attachment_image_src($img_id, 'shop_catalog');
$origin_src = $img_src;
$img_alt    = minera_img_alt($img_id, esc_html__('Product image', 'minera'));
/*add to Cart url*/
$atc_url = $product->add_to_cart_url();

/*sale*/
$sale          = $product->is_on_sale();
$sale_price    = $product->get_sale_price();
$regular_price = $product->get_regular_price();

/*variation product*/
$variation = $product->is_type('variable');
if ($variation) {
    $vars         = $product->get_available_variations();
    $default_attr = method_exists($product, 'get_default_attributes') ? $product->get_default_attributes() : array();
    $attr_type    = 'pa_product-color';/*swatches type*/

    foreach ($vars as $key) {
        $slug = isset($key['attributes']['attribute_' . $attr_type]) ? $key['attributes']['attribute_' . $attr_type] : '';
        if (isset($default_attr[$attr_type]) && $default_attr[$attr_type] === $slug) {
            $img_src = wp_get_attachment_image_src($key['image_id'], 'shop_catalog');
            break;
        }
    }
}

/*get hover img src*/
$hover_src        = '';
$_g_ids           = $product->get_gallery_image_ids();
$_g_count         = count($_g_ids);
$_generated_items = 0;

$_hover_id = 1;

foreach ($_g_ids as $_gid) {
    $_generated_items++;
    if (empty($_gid)) {
        continue;
    }

    if ($_generated_items > 5) {
        break;
    }

    $_hover_id = $_g_ids[$_g_count - $_generated_items];
    if ($_hover_id == $_gid) {
        $_hover_id = get_post_thumbnail_id($pid);
    }

    /*
    if(isset($_hover_id) && !empty($_hover_id)){
    $hover_src = wp_get_attachment_image_src($_hover_id, 'shop_catalog');
    }*/

    /*image*/

    /**
     * If Featured Image is need to display in the shop page.
     */

//    if(1 == $_generated_items){
//        $_src_id = get_post_thumbnail_id($pid);
//        $img_src = wp_get_attachment_image_src($_src_id, 'shop_catalog');
//        $origin_src = $img_src;
//        $img_alt = minera_img_alt($pid, esc_html__( 'Product image', 'minera' ));
//    }else{
//        $img_src = wp_get_attachment_image_src($_gid, 'shop_catalog');
//        $origin_src = $img_src;
//        $img_alt = minera_img_alt($_gid, esc_html__( 'Product image', 'minera' ));
//    }


    $img_src    = wp_get_attachment_image_src($_gid, 'shop_catalog');
    $origin_src = $img_src;
    $img_alt    = minera_img_alt($_gid, esc_html__('Product image', 'minera'));

    $_col_item_count = mt_calculate_wc_item_count();


    ob_start();
    require get_theme_file_path('/woocommerce/views/generated-product-item.php');
    $__contents = ob_get_contents();
    ob_end_clean();


    global $__WooCommerce_products;
    $__WooCommerce_products[$pid][] = $__contents;

}


?>
