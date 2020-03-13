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
<html <?php language_attributes(); ?>>
<head>
    <title><?php wp_title(); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php kw_js_variables(); ?>
	<?php //wp_head(); ?>
    <?php define('IS_FRONT_PAGE', is_front_page()); ?>
    <link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI ?>/css/main-page-bootstrap-grid.css">
    <link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI ?>/style.css">
    <link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI ?>/css/main-page-style.css">
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<div id="page" class="site <?= IS_FRONT_PAGE ? 'front-page' : ''?>">
	<header id="masthead" class="site-header" role="banner">
        <div class="head-wrap">
            <div class="container">


            </div>
        </div>

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
                                'fallback_cb'    => 'kumle_primary_navigation_fallback',
                                )
                            );
                            ?>
                        </div><!-- .menu-content -->
                    </nav><!-- #site-navigation -->
                </div> <!-- #main-nav -->
            </div>
        </div>
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