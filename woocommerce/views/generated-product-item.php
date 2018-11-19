<li <?php post_class('p-col'); ?>>
    <div class="p-head-cont">
        <div class="p-head">
            <?php if ( $sale ) : ?><span class="onsale"><?php if($variation){
                esc_html_e('Sale!', 'minera');
            }else{
                $final_price = (($regular_price - $sale_price) / $regular_price) * 100;
                echo '-' . round($final_price, 2) . '%';
            } ?></span>
            <?php endif; ?>
            <div class="p-action">
                <?php /*add to wishlist button*/ ?>
                <?php echo class_exists('YITH_WCWL') ? do_shortcode('[yith_wcwl_add_to_wishlist product_id="'.$pid.'"]') : ''; ?>

                <?php /*quick view button*/ ?>
                <a href="<?php echo get_permalink($pid); ?>" data-id="<?php echo esc_attr($pid); ?>" class="quick-view-btn" aria-label="<?php esc_attr_e('Show in Quickview', 'minera'); ?>">
                    <span class="p-tooltip"><?php esc_html_e('Show in Quickview', 'minera'); ?></span>
                </a>

                <?php /*add to Cart button*/ ?>
                <span class="p-box-atc">
                    <?php if($variation): ?>
                        <a href="<?php echo get_permalink($pid); ?>" class="select-option-btn ht-ico-cart" aria-label="<?php esc_attr_e('Select Options', 'minera'); ?>">
                            <span class="p-tooltip"><?php esc_html_e('Select Options', 'minera'); ?></span>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo esc_url($atc_url); ?>" data-quantity="1" data-product_id="<?php echo esc_attr($pid); ?>" class="add_to_cart_button ajax_add_to_cart ht-ico-cart" aria-label="<?php esc_attr_e('Add to Cart', 'minera'); ?>">
                            <span class="p-tooltip"><?php esc_html_e('Add to Cart', 'minera'); ?></span>
                        </a>
                    <?php endif; ?>
                </span>
            </div>
            <?php /*product image*/ ?>
            <a href="<?php echo get_permalink($pid); ?>" class="p-image" aria-label="<?php esc_attr_e('Product image', 'minera'); ?>" data-ori_src="<?php echo esc_attr($origin_src[0]); ?>">
                <img src="<?php echo esc_url($img_src[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                <?php if(!empty($hover_src)): ?>
                    <span class="p-img-hover" style="background-image: url(<?php echo esc_url($hover_src[0]); ?>)"></span>
                <?php endif; ?>
            </a>
        </div>
        <div class="p-content">
            <a class="p-title" href="<?php echo get_permalink($pid); ?>" aria-label="<?php esc_attr_e('Product title', 'minera'); ?>"><?php echo get_the_title($pid); ?></a>
            <div class="price" aria-label="<?php esc_attr_e('Product price', 'minera'); ?>"><?php echo wp_kses_post($p_price); ?></div>
            <?php minera_swatches_list();/*swatches color*/ ?>

            <?php /*list style: add to Cart button*/ ?>
            <div class="atc-shop-list">
                <?php if($variation): ?>
                    <a href="<?php echo get_permalink($pid); ?>" class="atc-select-option-btn" aria-label="<?php esc_attr_e('Select Options', 'minera'); ?>"><?php esc_html_e('Select Options', 'minera'); ?></a>
                <?php else: ?>
                    <a href="<?php echo esc_url($atc_url); ?>" data-quantity="1" data-product_id="<?php echo esc_attr($pid); ?>" class="add_to_cart_button ajax_add_to_cart" aria-label="<?php esc_attr_e('Add to Cart', 'minera'); ?>"><?php esc_html_e('Add to Cart', 'minera'); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php minera_swatches_list();/*swatches color*/ ?>
    </div>
</li>

