

	<div id="primaryy" class="container content-area" style="width: 100%;" file="<?= basename(__FILE__); ?>" itemtype="http://schema.org/Product" itemscope>
		<main id="main" class="site-main single-moda" role="main">

<link rel="stylesheet" href="<?= KW_TEMPLATE_DIRECTORY_URI . '/css/moda-page-style.css?ver='.filemtime(__DIR__.'/css/moda-page-style.css'); ?>">

<div class="prev-next-post row">
	<div class="col-xs-6 -prev"><?php previous_post_link(); ?></div>
	<div class="col-xs-6 -next"><?php next_post_link(); ?></div>
</div>

<?php

	the_post();
	
	$the_title = esc_attr(get_the_title());
	
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
		    'numberposts' => 9,
		];

	    $myposts = get_posts( $args );
	endif;

?>
<div class="row">
	<div class="col-xs-12 col-sm-6">
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
					<img itemprop="image" class="-img" src="<?= get_ebay_pic_url_by_hash($hash, 600); ?>" alt="<?= $the_title; ?>">
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
	</div>

	<div class="col-xs-12 col-sm-6"><div class="info">
		<h1 class="-title" itemprop="name"><?= $the_title; ?></h1>
		<div class="info-more">
			<div class="entry-content moda-block-bottom" itemprop="offers" itemtype="http://schema.org/Offer" itemscope>
				<div class="moda-block-price"><span itemprop="price">55.00</span> €</div>
		        <link itemprop="url" href="<?= ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
		        <meta itemprop="priceValidUntil" content="<?= date('Y-m-d', time() + 60*60*24*30 ); ?>" />
		        <meta itemprop="availability" content="https://schema.org/InStock">
		        <meta itemprop="priceCurrency" content="EUR">
		        <meta itemprop="itemCondition" content="https://schema.org/UsedCondition">
				<div class="moda-block-readmore">
					<i class="star dashicons dashicons-star-empty">&nbsp;</i>
					<div class="sold">123</div>
				</div>
			</div>
			<meta itemprop="mpn" content="<?php the_ID(); ?>" />
			<?php if(isset($moda_meta['Marke']) && $moda_meta['Marke']): ?>
				<div itemprop="brand" itemtype="http://schema.org/Brand" itemscope>
					<meta itemprop="name" content="<?= $moda_meta['Marke'] ?>" />
				</div>
			<?php endif; ?>
			<a class="-readmore" href="https://www.ebay.de/itm/<?= $moda_meta['itemId']; ?>">mehr Informationen</a>
		</div>

		<div class="inner-baner row">
			<img src="<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/elegance.jpg" alt="<?= $the_title; ?>">
		</div>

		<article class="-content" itemprop="description">
			<?= substr(get_the_content(), 0, 350) . '<a href="https://www.ebay.de/itm/'.$moda_meta['itemId'].'">...</a>' ?>
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
				<div class="-name col-xs-5 col-sm-6 text-right"><?= $meta['Name'] ?>:</div>
				<div class="-value col-xs-7 col-sm-6 text-left"><?= implode(',', $meta['Value']) ?></div>
			</li>
		<?php endforeach ?>
		</ul>

	</div></div>
</div>


<div class="moda-middle-menu row">
	<div class="col-xs-12 col-sm-3"><a href="https://modetoday.de/moda_category/womens-bags-handbags/">Damentaschen</a></div>
	<div class="col-xs-12 col-sm-3"><a href="https://modetoday.de/moda_category/womens-clothing/">Damenmode</a></div>
	<div class="col-xs-12 col-sm-3"><a href="https://modetoday.de/moda_category/womens-shoes/">Damenschuhe</a></div>
	<div class="col-xs-12 col-sm-3"><a href="https://modetoday.de/moda_category/womens-accessories/">Damen-Accessoires</a></div>
</div>
    		
	      		
<div id="modablocks" class="moda-page-slider row">
	<div id="moda_page_carousel" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	  	<?php for ($key=0; $key < 3; $key++): ?>
	    <li data-target="#moda_page_carousel" data-slide-to="<?= $key; ?>" class="<?= $key === 0 ? 'active' : ''; ?>"></li>
		<?php endfor ?>
	  </ol>
	  <div class="carousel-inner">
		<div class="carousel-item active"><div class="row carousel-item-row">
			<?php
			    foreach ( $myposts as $key => $post ) : setup_postdata( $post ); 
			        get_template_part( 'template-parts/content', 'modablock' );
			        if ($key !== (count($myposts) - 1) && $key % 3 === 2) {
			        	echo '</div></div><div class="carousel-item"><div class="row carousel-item-row">';
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

<?php if($Variations = false): ?>
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
if($VariationsPics = false) foreach ($VariationsPics as $meta) {
	echo '<hr><h4>'.$meta['VariationSpecificName'].'</h4>';
	foreach ($meta['VariationSpecificPictureSet'] as $pic) {
		echo '<div class="row">';
		echo '<hr><h6>'.$pic['VariationSpecificValue'].'</h6>';
		foreach ($pic['PictureURL'] as $PictureURL) {
			echo '<div class="col-sm-2">';
			echo '<img alt="'.$the_title.'" src="'.$PictureURL.'" style="max-width:100px;max-height:100px;margin:auto;"><br><br>';
			echo '</div>';
		}
		echo '</div>';
	}
}
?>
<!-- /MODA META -->

		</main><!-- #main -->
	</div><!-- #primary -->

