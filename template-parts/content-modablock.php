<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kumle
 */
$excerpt = get_the_excerpt();
$excerpt_data = json_decode($excerpt,1);
// sa($excerpt);
// xa($excerpt_data);
// sa(get_the_title());
$currentPrice = $excerpt_data['currentPrice'];
$QuantitySold = $excerpt_data['QuantitySold'];
$permalink = esc_url( get_permalink() );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('modablock row col-xs-6 col-sm-12'); ?> file="<?= basename(__FILE__); ?>">
	
	<?php // kumle_post_thumbnail(); ?>
	<div class="col-xs-12 img-wrapper">
		<a class="img-wrapper" href="<?= $permalink; ?>" rel="bookmark">
			<span class="img-bg" style="background-image: url('<?= kw_modablock_imgsrc($excerpt_data); ?>')"></span>
			<img class="img-main" src="<?= kw_modablock_imgsrc($excerpt_data); ?>" alt="<?= esc_attr(get_the_title()); ?>">
		</a>
	</div>
	<div class="content-wrap col-xs-12">
		<div class="content-wrap-inner">
			<header class="entry-header">
				<h2 class="entry-title"><a href="<?= $permalink; ?>" rel="bookmark">
					<?php
					echo substr(trim(get_the_title()), 0, 32) . '...';
					?>
				</a></h2>
			</header><!-- .entry-header -->

			<div class="entry-content moda-block-bottom">
				<div class="moda-block-price"><?= $currentPrice; ?> €</div>
				<div class="moda-block-readmore">
					<i class="star dashicons dashicons-star-empty">&nbsp;</i>
					<div class="sold"><?= $QuantitySold; ?></div>
				</div>
<!-- 				<div class="moda-block-readmore">
					<a href="<?= $permalink; ?>">Hinzufügen</a>
					<div class="moda-block-readmore">
						<i class="star dashicons dashicons-star-empty">&nbsp;</i>
						<div class="sold"><?= $QuantitySold; ?></div>
					</dibv>
				</div> -->
			</div><!-- .entry-content -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
