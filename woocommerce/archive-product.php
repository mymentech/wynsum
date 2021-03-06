<?php
/**
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

defined( 'ABSPATH' ) || exit;

/*sidebar on shop archive*/
$sidebar          = get_theme_mod( 'c_shop_sidebar', 'full' );
$wide             = get_theme_mod( 'c_shop_full', false );

$container        = 'container';
$sidebar_position = '';
$col_class        = 'col-md-9 col-lg-9';

if( true == $wide ){
    $container = 'shop-container-fluid';
}


if ( is_active_sidebar( 'shop-widget' ) ){
    if( 'right' == $sidebar ){
        $sidebar_position = 'shop-right-sidebar';
    }elseif( 'left' == $sidebar ){
        $sidebar_position = 'shop-left-sidebar';
    }else{
        $sidebar_position = 'shop-not-sidebar';
        $col_class        = 'col-md-12 col-lg-12';
    }
}else{
    $sidebar          = 'full';
    $sidebar_position = 'shop-not-sidebar';
    $col_class        = 'col-md-12 col-lg-12';
}

$view_style = get_theme_mod( 'c_shop_view_style', 'grid' );
get_header();
?>

<main id="main" class="flw">
	<div class="<?php echo esc_attr($container); ?>">
		<div class="row woo-archive <?php echo esc_attr($sidebar_position); ?>">
			<div class="shop-archive-content theme-product-block shop-view-<?php echo esc_attr($view_style); ?> <?php echo esc_attr($col_class); ?>">
				<?php if ( woocommerce_product_loop() ) : ?>
					<div class="woo-top-page flw">
						<?php do_action( 'woocommerce_before_shop_loop' ); ?>
                        <?php minera_shop_switcher($view_style); ?>
					</div>

					<?php
                        woocommerce_product_loop_start();

                        if ( wc_get_loop_prop( 'total' ) ) {
        					while ( have_posts() ):
                                the_post();
        						do_action( 'woocommerce_shop_loop' );
        						wc_get_template_part( 'content', 'product' );
        					endwhile;
                        }
                    woocommerce_product_loop_end();

                    do_action('mymentech_display_stored_product');

                    do_action( 'woocommerce_after_shop_loop' );

                else:
    					do_action( 'woocommerce_no_products_found' );
    				endif;
                ?>
			</div>
			<?php if( 'full' != $sidebar ): ?>
				<div class="shop-archive-sidebar col-md-3 col-lg-3">
					<?php get_sidebar( 'shop' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
