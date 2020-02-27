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
	  	<div class="impressum-btn close" data-toggle="modal" data-target="#datenschutz">datenschutz |&nbsp;</div>
	  	<div class="impressum-btn close" data-toggle="modal" data-target="#impressum">impressum</div>
	  </div>
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
	    <div class="carousel-item active" style="background-image: url('<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/slide-1.jpg')">
	      	<div class="carousel-menu">
	      		<a class="text-underline" href="#">Damentaschen</a>
	      		<a href="#">Damenmode</a>
	      		<a href="#">Damenschuhe</a>
	      		<a href="#">Damen-Accessoires</a>
	      	</div>
	  		<a href="#" class="category-link">VIEW</a>
	    </div>
	    <div class="carousel-item" style="background-image: url('<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/slide-2.jpg')">
	      	<div class="carousel-menu">
	      		<a href="#">Damentaschen</a>
	      		<a class="text-underline" href="#">Damenmode</a>
	      		<a href="#">Damenschuhe</a>
	      		<a href="#">Damen-Accessoires</a>
	      	</div>
	  		<a href="#" class="category-link">VIEW</a>
	    </div>
	    <div class="carousel-item" style="background-image: url('<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/slide-3.jpg')">
	      	<div class="carousel-menu">
	      		<a href="#">Damentaschen</a>
	      		<a href="#">Damenmode</a>
	      		<a class="text-underline" href="#">Damenschuhe</a>
	      		<a href="#">Damen-Accessoires</a>
	      	</div>
	  		<a href="#" class="category-link">VIEW</a>
	    </div>
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


<script>
jQuery(function($) {
	// $('.carousel').carousel()
})
</script>

<?php
get_footer();
