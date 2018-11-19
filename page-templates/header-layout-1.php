<header class="theme-header-layout header-layout-1 wynsum" itemscope itemtype="http://schema.org/WPHeader">
    <?php minera_edit_location('hd1');/*header edit location*/ ?>
    <div class="header-box">
        <div class="container">
            
            <div class="wrap-menu theme-menu-responsive" itemscope itemtype="http://schema.org/SiteNavigationElement">
                <span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'minera' ); ?></span>
                <?php if(has_nav_menu('primary')):
                    wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'theme-primary-menu', 'container' => '' ) );
                else: ?>
                    <a class="add-menu" href="<?php echo esc_url( get_admin_url() . 'nav-menus.php' ); ?>"><?php esc_html_e( 'Add Menu', 'minera' ); ?></a>
                <?php endif;
                /*mobile search form*/
                    minera_search_form_mobile(); ?>
            </div>
            <a href="<?php echo esc_url( home_url( '/' )); ?>" class="logo">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/wynsum-logo.svg" class="logo" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        </a>

           
            <div class="header-action hd1-action">
                
    <div id="header-widget-area" class="chw-widget-area widget-area hidden-sm hidden-xs" role="complementary">
    <?php dynamic_sidebar( 'custom-header-widget' ); ?>
    </div>
    
                
                <button class="theme-search-btn" id="ht-search-btn"><i class="ti-search"></i></button>
                <?php minera_account(); ?>
                <?php minera_shopping_cart();/*shopping cart*/ ?>
            </div>
        </div>
    </div>
    <?php get_template_part('page-templates/page', 'header');/* breadcrumbs */ ?>
</header>