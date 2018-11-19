<?php
/**
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $product, $woocommerce;

$gallery_ids = $product->get_gallery_image_ids();
$gallery_count = count($gallery_ids);

if($gallery_count > 1 && ( is_shop() || is_product_category() ) ){
    require get_theme_file_path('/woocommerce/views/product-multiplied.php');
}else{
    require get_theme_file_path('/woocommerce/views/product-normal.php');
}

