<?php
/**
 * Theme functions file
 */

/**
 * Enqueue parent theme styles first
 * Replaces previous method using @import
 * <http://codex.wordpress.org/Child_Themes>
 */

add_action('wp_enqueue_scripts', 'minera_enqueue_parent_theme_style', 99);

function minera_enqueue_parent_theme_style() {
    wp_enqueue_style('minera-parent-style', get_template_directory_uri() . '/style.css');
}

wp_register_style('Themify_Icons', 'https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css');
wp_enqueue_style('Themify_Icons');


/**
 * Add your custom functions below
 */


function wpb_widgets_init() {

    register_sidebar(array(
        'name'          => 'Custom Header Widget Area',
        'id'            => 'custom-header-widget',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
    ));

}

add_action('widgets_init', 'wpb_widgets_init');


/**
 * Remove product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

function woo_remove_product_tabs($tabs) {

    unset($tabs['additional_information']);    // Remove the additional information tab

    return $tabs;
}


/**
 * Get rid of categories on posts.
 */
function minera_unregister_category() {
    unregister_taxonomy_for_object_type('category', 'post');
}

add_action('init', 'minera_unregister_category');


/*sticky menu*/

function minera_sticky_menu() {
    if (minera_check_header_layout() == 'layout-6') return;

    $sticky = get_theme_mod('sticky', false);

    if ($sticky) { ?>
        <div id="theme-sticky-menu" class="theme-header-layout" itemscope itemtype="http://schema.org/WPHeader">
            <?php minera_edit_location('sticky_menu');/*header edit location*/ ?>
            <div class="header-box">
                <div class="container">

                    <div class="wrap-menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
                        <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'minera'); ?></span>
                        <?php if (has_nav_menu('primary')):
                            wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'theme-primary-menu', 'container' => ''));
                        else: ?>
                            <a class="add-menu"
                               href="<?php echo esc_url(get_admin_url() . 'nav-menus.php'); ?>"><?php esc_html_e('Add Menu', 'minera'); ?></a>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/wynsum-logo.png" class="logo"
                             alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    </a>
                    <div class="header-action hd1-action">
                        <div id="header-widget-area" class="chw-widget-area widget-area hidden-sm hidden-xs"
                             role="complementary">
                            <?php dynamic_sidebar('custom-header-widget'); ?>
                        </div>
                        <button class="ht-ico-search theme-search-btn" id="sticky-search-btn"></button>
                        <?php minera_account(); ?>
                        <?php minera_shopping_cart();/*shopping cart*/ ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        wp_enqueue_script('minera-headroom-stick-menu', get_template_directory_uri() . '/js/headroom.min.js', array('jquery'), false, true);
        wp_add_inline_script(
            'minera-headroom-stick-menu',
            'var width = matchMedia("(min-width:992px)"),
                        el = document.getElementById("theme-sticky-menu"),
                        options = {
                            offset: 200,
                            classes : {
                                initial : "header-sticky",
                                pinned : "menu-scrolling-up",
                                unpinned : "menu-scrolling-down",
                                top : "menu-top",
                                notTop : "menu-not-top",
                                bottom : "menu-bottom",
                                notBottom : "menu-not-bottom"
                            }
                        },
                        headroom = new Headroom(el, options);

                    function minera_sticky_menu(data) {
                        if(data.matches){
                            headroom.init();
                        }else{
                            headroom.destroy();
                        }
                    }

                    minera_sticky_menu(width);
                    width.addListener(minera_sticky_menu);',
            'after'
        );
    }
}

// Begin Custom Scripting to Move JavaScript from the Head to the Footer

function remove_head_scripts() {
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);

    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}

add_action('wp_enqueue_scripts', 'remove_head_scripts');

// END Custom Scripting to Move JavaScript


/*woocommerce account header action*/
if (!function_exists('minera_account')):
    function minera_account() {
        if (class_exists('Woocommerce')) {
            $my_account_id = get_option('woocommerce_myaccount_page_id');
            $order_id      = get_option('woocommerce_view_order_page_id');

            $logout_url = wp_logout_url(get_permalink($my_account_id));
            if (get_option('woocommerce_force_ssl_checkout') == 'yes') $logout_url = str_replace('http:', 'https:', $logout_url);

            if ($my_account_id) { ?>
                <div class="w-head-box">
                    <a href="<?php echo get_permalink($my_account_id); ?>" class="ht-ico-user theme-login-btn"></a>
                    <ul class="w-head-action">
                        <?php if (!is_user_logged_in()) { ?>
                            <li>
                                <a href="<?php echo get_permalink($my_account_id); ?>"><?php esc_html_e('Login / Register', 'minera'); ?></a>
                            </li>

                        <?php } else { ?>
                            <li>
                                <a href="<?php echo get_permalink($my_account_id); ?>"><?php esc_html_e('Dashboard', 'minera'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/wishlist"><?php esc_html_e('Wishlist', 'minera'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url($logout_url); ?>"><?php esc_html_e('Logout', 'minera'); ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php }
        }
    }
endif;


// Change Sort by labels


add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');

function wc_customize_product_sorting($sorting_options) {
    $sorting_options = array(
        'menu_order' => __('Sorting', 'woocommerce'),
        'popularity' => __('Wynsum’s Hottest', 'woocommerce'),
        'rating'     => __('Top Rated', 'woocommerce'),
        'date'       => __('Newest Designs', 'woocommerce'),
        'price'      => __('Sort by price: low to high', 'woocommerce'),
        'price-desc' => __('Sort by price: high to low', 'woocommerce'),
    );

    return $sorting_options;
}

// Uncheck ship to different address by default

add_filter('woocommerce_ship_to_different_address_checked', '__return_false');

// Reorder Checkout Fields
add_filter('woocommerce_checkout_fields', 'reorder_woo_fields');

function reorder_woo_fields($fields) {
    $fields2['billing']['billing_email']      = $fields['billing']['billing_email'];
    $fields2['billing']['billing_phone']      = $fields['billing']['billing_phone'];
    $fields2['billing']['billing_first_name'] = $fields['billing']['billing_first_name'];
    $fields2['billing']['billing_last_name']  = $fields['billing']['billing_last_name'];
    $fields2['billing']['billing_country']    = $fields['billing']['billing_country'];
    $fields2['billing']['billing_address_1']  = $fields['billing']['billing_address_1'];
    $fields2['billing']['billing_address_2']  = $fields['billing']['billing_address_2'];
    $fields2['billing']['billing_city']       = $fields['billing']['billing_city'];
    $fields2['billing']['billing_postcode']   = $fields['billing']['billing_postcode'];
    $fields2['billing']['billing_state']      = $fields['billing']['billing_state'];

    $fields2['shipping']['shipping_first_name'] = $fields['shipping']['shipping_first_name'];
    $fields2['shipping']['shipping_last_name']  = $fields['shipping']['shipping_last_name'];
    $fields2['shipping']['shipping_country']    = $fields['shipping']['shipping_country'];
    $fields2['shipping']['shipping_address_1']  = $fields['shipping']['shipping_address_1'];
    $fields2['shipping']['shipping_address_2']  = $fields['shipping']['shipping_address_2'];
    $fields2['shipping']['shipping_city']       = $fields['shipping']['shipping_city'];
    $fields2['shipping']['shipping_postcode']   = $fields['shipping']['shipping_postcode'];
    $fields2['shipping']['shipping_state']      = $fields['shipping']['shipping_state'];

    $fields2['account']['account_username']   = $fields['account']['account_username'];
    $fields2['account']['account_password']   = $fields['account']['account_password'];
    $fields2['account']['account_password-2'] = $fields['account']['account_password-2'];


// Add full width Classes and Clears to Adjustments
    $fields2['billing']['billing_email']      = array(
        'label'    => __('Email', 'woocommerce'),
        'required' => true,
        'class'    => array('form-row-wide'),
        'clear'    => true
    );
    $fields2['billing']['billing_phone']      = array(
        'label'    => __('Phone', 'woocommerce'),
        'required' => false,
        'class'    => array('form-row-wide'),
        'clear'    => true
    );
    $fields2['account']['account_username']   = array(
        'label'    => __('Username', 'woocommerce'),
        'required' => true,
        'class'    => array('form-row-first'),
        'clear'    => true
    );
    $fields2['account']['account_password']   = array(
        'label'    => __('Password', 'woocommerce'),
        'required' => true,
        'class'    => array('form-row-first'),
        'clear'    => true
    );
    $fields2['account']['account_password-2'] = array(
        'label'    => __('Confirm Password', 'woocommerce'),
        'required' => true,
        'class'    => array('form-row-last'),
        'clear'    => true
    );

    return $fields2;
}


/**
 * woocommerce_single_product_summary hook
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 */

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 35);


add_action('wp_enqueue_scripts', 'frontend_scripts_include_lightbox');

function frontend_scripts_include_lightbox() {
    global $woocommerce;

    $suffix      = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $lightbox_en = get_option('woocommerce_enable_lightbox') == 'yes' ? true : false;

    if ($lightbox_en) {
        wp_enqueue_script('fancybox', $woocommerce->plugin_url() . '/assets/js/fancybox/fancybox' . $suffix . '.js', array('jquery'), '1.6', true);
        wp_enqueue_style('woocommerce_fancybox_styles', $woocommerce->plugin_url() . '/assets/css/fancybox.css');
    }
}


function the_current_url() {
    echo home_url(add_query_arg(array()));
}

/** Customization by Mozammel Started*/

function mt_calculate_wc_item_count() {
    static $count;
    $count < 1 ? $count = 1 : $count++;
    return $count;
}

function get_all_image_sizes($images) {
    if (isset($_GET['mt-image-id']) && !empty($_GET['mt-image-id'])) {
        $image_id = (int)$_GET['mt-image-id'];
    }

    if (!$image_id) {
        return $images;
    }

    $image_data_defaults = array(
        'large'        => null,
        'single'       => null,
        'thumb'        => null,
        'alt'          => null,
        'title'        => null,
        'caption'      => null,
        'srcset'       => null,
        'sizes'        => null,
        'thumb_srcset' => null,
        'thumb_sizes'  => null
    );

    $large        = wp_get_attachment_image_src($image_id, 'full');
    $single       = wp_get_attachment_image_src($image_id, 'shop_single');
    $thumb        = wp_get_attachment_image_src($image_id, 'shop_thumbnail');
    $sizes        = wp_get_attachment_image_sizes($image_id, 'shop_single');
    $thumb_srcset = wp_get_attachment_image_srcset($image_id, 'shop_thumbnail');
    $thumb_sizes  = wp_get_attachment_image_sizes($image_id, 'shop_thumbnail');

    if (empty($large)) return $images;

    $image_data = wp_parse_args(array(
        'large'        => $large,
        'single'       => $single,
        'thumb'        => $thumb,
        'alt'          => get_post_meta($image_id, '_wp_attachment_image_alt', true),
        'title'        => wp_get_attachment_caption($image_id),
        'caption'      => wp_get_attachment_caption($image_id),
        'sizes'        => $sizes ? $sizes : "",
        'thumb_srcset' => $thumb_srcset ? $thumb_srcset : "",
        'thumb_sizes'  => $thumb_sizes ? $thumb_sizes : "",
    ), $image_data_defaults);


    $image_data = apply_filters('iconic_woothumbs_single_image_data', $image_data, $image_id);

    foreach ($images as $key => $_image) {
        if ($_image['large'][0] == $image_data['large'][0]) {
            /** Removing Clicked image if already exists */
            unset($images[$key]);
            break;
        }
    }

    /** Prepend the clicked image at first place of the images Array */
    array_unshift($images, $image_data);
    return $images;

}

add_filter('iconic_woothumbs_all_images_data', 'get_all_image_sizes');

$__WooCommerce_products = array();



function mt_randomize_products($data){

    $data = array_values($data);
    array_multisort($data,SORT_DESC);

    $length = count($data[0]);
    $result = array();
    for ($i = 0; $i < $length; $i++) {
        $result = array_merge($result, array_column($data, $i));
    }

    return $result;
}


function function_mymentech_display_stored_product() {
    global $__WooCommerce_products;
    $products = $__WooCommerce_products;
    $products = mt_randomize_products($products);

    //shuffle($products);

    $_col_item_count = 1;

    foreach ($products as $product) {

        if ($_col_item_count <= 2 || $_col_item_count % 5 === 1 || $_col_item_count % 5 === 2) {
            printf('<div class="mt_two_columns_item item-number-%1$s">', $_col_item_count);
        } else {
            printf('<div class="mt_three_columns_item item-number-%1$s">', $_col_item_count);
        }

        echo $product;

        printf("</div>");

        $_col_item_count++;
    }


}



add_action('mymentech_display_stored_product', 'function_mymentech_display_stored_product', 10);

/** Customization by Mozammel Ended*/


