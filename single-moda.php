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

	<div id="primaryy" class="container content-area" style="width: 100%;" file="<?= basename(__FILE__); ?>">
		<main id="main" class="site-main single-moda" role="main">

<link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI . '/css/moda-page-style.css?ver='.filemtime(__DIR__.'/css/moda-page-style.css'); ?>">

<div class="prev-next-post row">
	<div class="col-xs-6"><?php previous_post_link(); ?></div>
	<div class="col-xs-6"><?php next_post_link(); ?></div>
</div>

<?php

	the_post();

	$moda_meta = get_post_custom();
	$moda_meta = array_map(function($value)
	{
		return $value[0];
	}, $moda_meta);

	unset($moda_meta['moda_id']);

	$PictureURL = explode(',', $moda_meta['PictureURL']);

	unset($moda_meta['PictureURL']);

	$term_id = wp_get_post_terms(get_the_ID(), 'moda_category')[0]->term_id;

	if($term_id): 
		$args = [
		    'post_type' => 'moda',
		    'tax_query' => [
		        [
		            'taxonomy' => 'moda_category',
		            'terms' => $term_id,
		        ],
		    ],
		    'numberposts' => 6,
		];

	    $myposts = get_posts( $args );
	endif;

?>

<div class="moda-page-slider row">
	<div id="moda_page_slider" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	  	<?php foreach ($PictureURL as $key => $hash): ?>
	    <li data-target="#moda_page_slider" data-slide-to="<?= $key; ?>" class="<?= $key === 0 ? 'active' : ''; ?>"></li>
		<?php endforeach ?>
	  </ol>
	  <div class="carousel-inner">
	  	<?php foreach ($PictureURL as $key => $hash): ?>
	    <div class="carousel-item <?= $key === 0 ? 'active' : ''; ?>">
			<img class="-img" src="<?= get_ebay_pic_url_by_hash($hash, 600); ?>" alt="">
	    </div>
		<?php endforeach; ?>
	  </div>
	  <a class="carousel-control-prev" href="#moda_page_slider" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#moda_page_slider" role="button" data-slide="next">
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
	<a class="-readmore" href="<?= $permalink = ''; ?>">Hinzufügen</a>
</div>

<div class="inner-baner row">
	<img src="<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/elegance.jpg" alt="">
</div>

<article class="-content">
	<?= substr(get_the_content(), 0, 350) ?>
</article>


<!-- MODA META -->
<?php

$ItemSpecifics = json_decode($moda_meta['ItemSpecifics'], 1);

$Variations = json_decode($moda_meta['Variations'], 1);

$VariationsPics = json_decode($moda_meta['VariationsPics'], 1);

$Description = $moda_meta['Description'];

?>

<ul class="name-value-list">
<?php
foreach ($ItemSpecifics as $key => $meta) : ?>
	<li class="row">
		<div class="-name col-xs-5 text-right"><?= $meta['Name'] ?>:</div>
		<div class="-value col-xs-7"><?= implode(',', $meta['Value']) ?></div>
	</li>
<?php endforeach ?>
</ul>


<div id="modablocks" class="moda-page-slider row">
	<div id="moda_page_carousel" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	  	<?php for ($key=0; $key < 3; $key++): ?>
	    <li data-target="#moda_page_carousel" data-slide-to="<?= $key; ?>" class="<?= $key === 0 ? 'active' : ''; ?>"></li>
		<?php endfor ?>
	  </ol>
	  <div class="carousel-inner">
	  	<?php if (0) foreach ($PictureURL as $key => $hash): ?>
	    <div class="carousel-item <?= $key === 0 ? 'active' : ''; ?>">
			<img class="-img" src="<?= get_ebay_pic_url_by_hash($hash, 600); ?>" alt="">
	    </div>
		<?php endforeach; ?>

		<div class="carousel-item active"><div class="row">
			<?php
			    foreach ( $myposts as $key => $post ) : setup_postdata( $post ); 
			        get_template_part( 'template-parts/content', 'modablock' );
			        if ($key !== (count($myposts) - 1) && $key % 2 === 1) {
			        	echo '</div></div><div class="carousel-item"><div class="row">';
			        }
			    endforeach; 
			    wp_reset_postdata();
			?>
		</div></div>
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
