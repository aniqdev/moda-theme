

	<div id="primaryy" class="container content-area" style="width: 100%;" itemtype="http://schema.org/Product" itemscope>
		<main id="main" class="site-main single-moda" role="main">

<div class="prev-next-post row">
	<div class="col-xs-6"><?php previous_post_link(); ?></div>
	<div class="col-xs-6"><?php next_post_link(); ?></div>
</div>

<?php

	the_post();
	
	$the_title = esc_attr(get_the_title());
	
	$moda_meta = get_post_custom();
	$moda_meta = array_map(function($value)
	{
		return $value[0];
	}, $moda_meta);
	
	$the_excerpt = get_the_excerpt();
	$the_excerpt = json_decode($the_excerpt, true);

	$moda_meta = array_merge($moda_meta, $the_excerpt);

	$PictureURL = explode(',', $moda_meta['PictureURL']);

	$term_id = wp_get_post_terms(get_the_ID(), 'fashion_category')[0]->term_id;

	if($term_id): 
		$args = [
		    'post_type' => 'moda',
		    'tax_query' => [
		        [
		            'taxonomy' => 'fashion_category',
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
	  <?php if(1): ?>
	  <amp-carousel width="1290" height="680" layout="responsive" type="slides" class="carousel-inner">
	  	<?php foreach ($PictureURL as $key => $hash): ?>
			<amp-img width="1290" height="680" layout="responsive" itemprop="image" class="-img" src="<?= get_ebay_pic_url_by_hash($hash, 600); ?>" alt="<?= $the_title; ?>"></amp-img>
		<?php endforeach; ?>
	  </amp-carousel>
	  <?php endif; ?>
	</div>
</div>

<div class="info">
	<h1 class="-title" itemprop="name"><?= $the_title; ?></h1>
	<div class="entry-content moda-block-bottom" itemprop="offers" itemtype="http://schema.org/Offer" itemscope>
		<div class="moda-block-price"><span itemprop="price">55.00</span> €</div>
        <link itemprop="url" href="<?= ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
        <meta itemprop="priceValidUntil" content="<?= date('Y-m-d', time() + 60*60*24*30 ); // 1m later ?>" />
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
	<amp-img width="1079" height="185" src="<?= KW_TEMPLATE_DIRECTORY_URI; ?>/images/elegance.jpg" alt="<?= $the_title; ?>"></amp-img>
</div>

<article class="-content" itemprop="description">
	<?= substr(get_the_content(), 0, 350) . '<a class="-readmore" href="https://www.ebay.de/itm/'.$moda_meta['itemId'].'">...</a>' ?>
</article>


<!-- MODA META -->
<?php

$ItemSpecifics = json_decode($moda_meta['ItemSpecifics'], 1);

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


<div id="modablocks" class="moda-page-slider">
	<div id="moda_page_carousel" class="">
	  <amp-carousel width="1290" height="1080" layout="responsive" type="slides" class="carousel-inner">
	  	<?php if(1): ?>
		<div>
 			<div class="row">
			<?php
			    foreach ( $myposts as $key => $post ) : setup_postdata( $post ); 
			        get_template_part( 'template-parts/content', 'modablock-amp' );
			        if ($key !== (count($myposts) - 1) && $key % 2 === 1) {
			        	echo '</div></div><div class=""><div class="row">';
			        }
			    endforeach; 
			    wp_reset_postdata();
			?>
			</div>
		</div>
		<?php endif; ?>
	  </amp-carousel>
	</div>
</div>

<!-- /MODA META -->

		</main><!-- #main -->
	</div><!-- #primary -->

