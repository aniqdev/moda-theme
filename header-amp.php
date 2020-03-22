<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kumle
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> ⚡>
<head>
    <title><?php wp_title(); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php //kw_js_variables(); ?>
    <?php //wp_head(); ?>
    <?php define('IS_FRONT_PAGE', is_front_page()); ?>
    <link rel="canonical" href="<?= ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . str_replace('?amp', '', $_SERVER['REQUEST_URI']); ?>">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

    <script async="" src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.2.js"></script>
    <!-- <link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI ?>/css/main-page-bootstrap-grid.css"> -->
    <!-- <link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI ?>/css/style-amp.css?ver=<?= filemtime(__DIR__.'/css/style-amp.css') ?>"> -->
    <!-- <link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI ?>/css/moda-page-style-amp.css?ver=<?= filemtime(__DIR__.'/css/moda-page-style-amp.css') ?>"> -->
    <!-- <link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI ?>/css/out.css?ver=<?= filemtime(__DIR__.'/css/out.css') ?>"> -->
     <style amp-custom>
      <?php include __DIR__.'/css/moda-amp.css'; ?>
      </style>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<div id="page" class="site <?= IS_FRONT_PAGE ? 'front-page' : ''?>">
	<header id="masthead" class="site-header" role="banner">
        <div class="head-wrap">
            <div class="container">


            </div>
        </div>

        <?php if(is_amp_page()): ?>
        <nav id="amp_navigation" class="amp-navigation">
            <a href="/" class="menu-title">
                <div class="-mode">MODE</div>
                <div class="-today">Today</div>
            </a>
            <div class="amp-menu-close">×</div>
            <button class="amp-menu-open"><i></i><i></i><i></i></button>
            <?php
            wp_nav_menu(
                array(
                'theme_location' => 'amp-menu',
                'menu_id'        => 'amp_menu',
                'menu_class'     => 'amp-menu'
                )
            );
            ?>
        </nav>
        <?php else: ?>
        <div class="navigation-wrap">
            <div class="container">
                <div id="main-nav" class="clear-fix">
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                        <div class="wrap-menu-content">
                            <?php
                            wp_nav_menu(
                                array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                )
                            );
                            ?>
                        </div><!-- .menu-content -->
                    </nav><!-- #site-navigation -->
                </div> <!-- #main-nav -->
            </div>
        </div>
    <?php endif; ?>
    </header><!-- #masthead -->

    <div class="container">
        <?php
            if(is_tax()) kw_page_banner();
        ?>
    </div>
	
	<div id="content" class="site-content">
        <?php  if( !is_page_template('elementor_header_footer') ): ?>
            <div class="container">
        <?php endif; ?>
        <?php  if( !IS_FRONT_PAGE ): // BreadCrumbs ?>
            <div class="beadcrubs-wrapper">
                <ul class="beadcrubs" role="navigation" itemscope itemtype="https://schema.org/BreadcrumbList">
                <?php
                    if(function_exists('bcn_display')){
                        bcn_display($return = false, $linked = true, $reverse = false, $force = false);
                    }
                ?>
                </ul>
            </div>
        <?php endif; ?>
            <div class="inner-wrapper">