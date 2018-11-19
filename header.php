<?php 
/**
* The header for our theme.
* Displays all of the <head> section
* @package minera
*/ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php 
/**

<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us17.list-manage.com","uuid":"f6d49cef84a13dd3b664a1cbf","lid":"83199f3b59","uniqueMethods":true}) })</script>
*/ ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <?php minera_loading_effect();/*loading effect*/ ?>
    <?php minera_sticky_menu();/*sticky menu*/ ?>
    <?php minera_search_form();/*search form*/ ?>
    <div id="theme-container" class="flw">
    <?php minera_page_content_boxed();/*page content boxed layout*/ ?>
	<?php minera_header_layout();/*header-layout*/ ?>
    