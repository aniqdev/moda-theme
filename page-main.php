<?php
/**
 * Template Name: Page Main
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kumle
 */

get_header();
?>

<!-- <link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI . '/css/main-page-bootstrap-grid.css'; ?>"> -->
<link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI . '/css/main-page-style.css?ver='.filemtime(__DIR__.'/css/main-page-style.css'); ?>">

<div class="main-page-slider">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <div class="inlineImp clerfix col-xs-12 col-sm-4">
	  	<a href="https://modetoday.de/datenschutz/" class="impressum-btn close">datenschutz |&nbsp;</a>
	  	<a href="https://modetoday.de/impressum/" class="impressum-btn close">impressum</a>
	  </div>
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
	    <?php if(iz_mobile()): ?>
	    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
	    <?php endif; ?>
	  </ol>
	  <div class="carousel-inner">
	    <div class="carousel-item active" style="background-image: url('<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/slide-1.jpg')">
	      	<div class="carousel-menu">
	      		<a class="text-underline" href="https://modetoday.de/fashion_category/womens-bags-handbags/">Damentaschen</a>
	      		<a href="https://modetoday.de/fashion_category/womens-clothing/">Damenmode</a>
	      		<a href="https://modetoday.de/fashion_category/womens-shoes/">Damenschuhe</a>
	      		<a href="https://modetoday.de/fashion_category/womens-accessories/">Damen-Accessoires</a>
	      	</div>
	  		<a href="https://modetoday.de/fashion_category/womens-bags-handbags/" class="category-link">VIEW</a>
	    </div>
	    <div class="carousel-item" style="background-image: url('<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/slide-2.jpg')">
	      	<div class="carousel-menu">
	      		<a href="https://modetoday.de/fashion_category/womens-bags-handbags/">Damentaschen</a>
	      		<a class="text-underline" href="https://modetoday.de/fashion_category/womens-clothing/">Damenmode</a>
	      		<a href="https://modetoday.de/fashion_category/womens-shoes/">Damenschuhe</a>
	      		<a href="https://modetoday.de/fashion_category/womens-accessories/">Damen-Accessoires</a>
	      	</div>
	  		<a href="https://modetoday.de/fashion_category/womens-clothing/" class="category-link">VIEW</a>
	    </div>
	    <div class="carousel-item" style="background-image: url('<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/slide-3.jpg')">
	      	<div class="carousel-menu">
	      		<a href="https://modetoday.de/fashion_category/womens-bags-handbags/">Damentaschen</a>
	      		<a href="https://modetoday.de/fashion_category/womens-clothing/">Damenmode</a>
	      		<a class="text-underline" href="https://modetoday.de/fashion_category/womens-shoes/">Damenschuhe</a>
	      		<a href="https://modetoday.de/fashion_category/womens-accessories/">Damen-Accessoires</a>
	      	</div>
	  		<a href="https://modetoday.de/fashion_category/womens-shoes/" class="category-link">VIEW</a>
	    </div>
	    <div class="carousel-item" style="background-image: url('<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/slide-4.jpg')">
	      	<div class="carousel-menu">
	      		<a href="https://modetoday.de/fashion_category/womens-bags-handbags/">Damentaschen</a>
	      		<a href="https://modetoday.de/fashion_category/womens-clothing/">Damenmode</a>
	      		<a href="https://modetoday.de/fashion_category/womens-shoes/">Damenschuhe</a>
	      		<a class="text-underline" href="https://modetoday.de/fashion_category/womens-accessories/">Damen-Accessoires</a>
	      	</div>
	  		<a href="https://modetoday.de/fashion_category/womens-accessories/" class="category-link">VIEW</a>
	    </div>
	    <?php if(iz_mobile()): ?>
	    <div class="carousel-item cat-list" style="overflow-y: auto;">
	      	<?php draw_wp_cats(60); ?>
	    </div>
	    <?php endif; ?>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
</div>

<?php
$myposts = get_posts( [
    'post_type' => 'fashion',
    'numberposts' => 6,
	'orderby'     => 'menu_order',
] );
?>
<div class="container desktop-only">
	<div class="row middle-block">
		<div class="col-xs-12 col-sm-5 -leftimg">
			<img src="https://modetoday.de/wp-content/themes/moda-theme/images/slide-2.jpg" alt="">
		</div>
		<div class="col-xs-12 col-sm-7 mp-product-list" id="modablocks">
			<div class="row">
			<?php
			    foreach ( $myposts as $key => $post ) : setup_postdata( $post ); 
					echo '<div class="col-xs-6 col-sm-4">';
			        get_template_part( 'template-parts/content', 'modablock' );
			        echo '</div>';
			    endforeach;
			    wp_reset_postdata();
			?>
			</div>
		</div>
	</div>
</div>


<?php
get_footer();
