<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Kumle
 */

get_header();


?>

	<div id="primary" class="content-area" style="width: 100%;" file="<?= basename(__FILE__); ?>">
		<main id="main" class="site-main single-moda" role="main">

<link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI . '/css/moda-page-style.css?ver='.filemtime(__DIR__.'/css/moda-page-style.css'); ?>">

<div class="prev-next-post row">
	<div class="col-xs-6"><?php previous_post_link(); ?></div>
	<div class="col-xs-6"><?php next_post_link(); ?></div>
</div>
		<?php

		the_post();

		// the_post_navigation();

		// get_template_part( 'template-parts/content', 'moda' );

		?>

		<!-- Moda fields -->
		<?php
			$moda_meta = get_post_custom();
			$moda_meta = array_map(function($value)
			{
				return $value[0];
			}, $moda_meta);

			// _sa_($moda_meta);

			unset($moda_meta['moda_id']);

			$PictureURL = explode(',', $moda_meta['PictureURL']);

			unset($moda_meta['PictureURL']);

		?>

<div class="moda-page-slider row">
	<div id="moda_page_carousel" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	  	<?php foreach ($PictureURL as $key => $hash): ?>
	    <li data-target="#moda_page_carousel" data-slide-to="<?= $key; ?>" class="<?= $key === 0 ? 'active' : ''; ?>"></li>
		<?php endforeach ?>
	  </ol>
	  <div class="carousel-inner">
	  	<?php foreach ($PictureURL as $key => $hash): ?>
	    <div class="carousel-item <?= $key === 0 ? 'active' : ''; ?>">
			<img class="-img" src="<?= get_ebay_pic_url_by_hash($hash, 600); ?>" alt="">
	    </div>
		<?php endforeach; ?>
	  </div>
	  <a class="carousel-control-prev" href="#moda_page_carousel" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#moda_page_carousel" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
</div>

<div class="info">
	<h1 class="-title"><?php the_title(); ?></h1>
	<div class="entry-content moda-block-bottom">
		<div class="moda-block-price">55.00 €</div>
		<div class="moda-block-readmore">
			<i class="star dashicons dashicons-star-empty">&nbsp;</i>
			<div class="sold">123</div>
		</div>
	</div>
</div>

<div class="inner-baner row">
	<img src="<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/elegance.jpg" alt="">
</div>

<article class="-content">
	<?= substr(get_the_content(), 0, 350) ?>
</article>


<!-- MODA META -->
<table>
	<tbody>
		<!-- <tr><th>name</th><th>value</th></tr> -->
<?php
// sa($moda_meta);
foreach ($moda_meta as $meta_key => $meta_value) {
	if ($meta_key === 'ItemSpecifics') {
		$ItemSpecifics = json_decode($meta_value, 1);
		continue;
	}
	if ($meta_key === 'Variations') {
		$Variations = json_decode($meta_value, 1);
		continue;
	}
	if ($meta_key === 'VariationsPics') {
		$VariationsPics = json_decode($meta_value, 1);
		continue;
	}
	if ($meta_key === 'Description') {
		$Description = $meta_value;
		continue;
	}
	// echo "<tr><td>$meta_key</td><td>$meta_value</td></tr>";
}
?>
	</tbody>
</table>

<ul class="name-value-list">
<?php
foreach ($ItemSpecifics as $key => $meta) : ?>
	<li class="row">
		<div class="-name col-xs-5 text-right"><?= $meta['Name'] ?>:</div>
		<div class="-value col-xs-7"><?= implode(',', $meta['Value']) ?></div>
	</li>
<?php endforeach ?>
</ul>
<?php 
// sa($Variations);
?>

<?php if($Variations): ?>
<h4>Variations</h4>
<table>
	<tbody>
		<tr><th>name</th><th>value</th></tr>
<?php
if($Variations) foreach ($Variations as $key => $Variation) {
	echo "<tr><td>$Variation[Name]</td><td>";
	foreach ($Variation['Value'] as $var) {
		echo $var.'<br>';
	}
	echo "</td></tr>";
}
?>
	</tbody>
</table>
<?php endif ?>

<?php
if($VariationsPics) foreach ($VariationsPics as $meta) {
	echo '<hr><h4>'.$meta['VariationSpecificName'].'</h4>';
	foreach ($meta['VariationSpecificPictureSet'] as $pic) {
		echo '<div class="row">';
		echo '<hr><h6>'.$pic['VariationSpecificValue'].'</h6>';
		foreach ($pic['PictureURL'] as $PictureURL) {
			echo '<div class="col-sm-2">';
			echo '<img src="'.$PictureURL.'" style="max-width:100px;max-height:100px;margin:auto;"><br><br>';
			echo '</div>';
		}
		echo '</div>';
	}
}
?>
<!-- /MODA META -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// do_action( 'kumle_action_sidebar' );
get_footer();
