<?php
/**
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/*variables*/
$container = 'container';
$sidebar_position = '';
$col_class = 'col-md-9 col-lg-9';

/*customize options*/
$sidebar = get_theme_mod('c_shop_sidebar', 'full');
$wide = get_theme_mod('c_shop_full', false);

if($wide == true){
    $container = 'shop-container-fluid';
}

$view_style = get_theme_mod('c_shop_view_style', 'grid');

/*category options*/
if(function_exists('fw_get_db_term_option')){
    $id = get_queried_object()->term_id;
    $tax_name = get_queried_object()->taxonomy;

    $cat_fullwidth = fw_get_db_term_option($id, $tax_name, 'fullwidth');
    $p_sidebar_position = fw_get_db_term_option($id, $tax_name, 'sidebar_data');
    $cat_view_style = fw_get_db_term_option($id, $tax_name, 'view_style');

    $container = $cat_fullwidth == 'yes' ? 'shop-container-fluid' : 'container';
    if(isset($p_sidebar_position['gadget']) && $p_sidebar_position['gadget'] != 'default'){
        $sidebar = $p_sidebar_position['gadget'];
    }
    if($cat_view_style != 'default'){
        $view_style = $cat_view_style;
    }
}

if($sidebar == 'right'){
    $sidebar_position = 'shop-right-sidebar';
}elseif($sidebar == 'left'){
    $sidebar_position = 'shop-left-sidebar';
}else{
    $sidebar_position = 'shop-not-sidebar';
    $col_class = 'col-md-12 col-lg-12';
}

get_header(); ?>

<main id="main" class="flw" role="main">

    <div class="<?php echo esc_attr($container); ?>">
        <div class="row woo-archive <?php echo esc_attr($sidebar_position); ?>">
            <div class="shop-archive-content theme-product-block shop-view-<?php echo esc_attr($view_style); ?> <?php echo esc_attr($col_class); ?>">
                <?php if ( have_posts() ) : ?>

                    <div class="woo-top-page flw">
                        <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                        <?php minera_shop_switcher($view_style); ?>
                    </div>

                    <?php woocommerce_product_loop_start();
                    woocommerce_product_subcategories();
                    
                    while ( have_posts() ) : the_post();
                        do_action( 'woocommerce_shop_loop' );
                        wc_get_template_part( 'content', 'product' );
                    endwhile;

                    woocommerce_product_loop_end();
                    do_action('mymentech_display_stored_product');
                    do_action( 'woocommerce_after_shop_loop' );
                    
                elseif ( ! woocommerce_product_subcategories(array(
                        'before' => woocommerce_product_loop_start( false ),
                        'after' => woocommerce_product_loop_end( false )))) :
                    do_action( 'woocommerce_no_products_found' );
                endif; ?>
            </div>
            <?php if($sidebar != 'full'):/*sidebar*/ ?>
                <div class="shop-archive-sidebar col-md-3 col-lg-3">
                    <?php get_sidebar('shop'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>