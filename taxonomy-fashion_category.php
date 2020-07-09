<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kumle
 */

get_header();
set_moda_orderby();
?>
<style>
.entry-content p{
	max-height: 66px;
	overflow: hidden; 
/* 	white-space: nowrap;
	text-overflow: ellipsis; */
}
</style>

	<div id="modablocks" class="container content-area moda-category" style="width: 100%;" file="<?= basename(__FILE__); ?>">
		<main id="main" class="site-main row" role="main">
		
		<div class="col-xs-12 col-sm-8 col-md-10">
			<h1 class="category-title"><?= get_queried_object()->name; ?></h1>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-2">
			<select class="moda-cat-sort-select" onchange="location = this.value">
				<!-- <option value="">sort</option> -->
				<option value="?orderby=price&order=ASC" <?= orby_slctd('parent', 'ASC') ?>>niedrigster Preis</option>
				<option value="?orderby=price&order=DESC" <?= orby_slctd('parent', 'DESC') ?>>höchster Preis</option>
				<!-- <option value="?orderby=sold&order=ASC" <?= orby_slctd('menu_order', 'ASC') ?>>sold ⟱</option> -->
				<option value="?orderby=sold&order=DESC" <?= orby_slctd('menu_order', 'DESC') ?>>beliebteste Artikel</option>
			</select>
		</div>
		<?php
		// sa($_SESSION);
		parse_str($query_string, $query_arr);
		$query_arr['orderby'] = isset($_SESSION['orderby']) ? $_SESSION['orderby'] : 'menu_order'; // menu_order || parent
		$query_arr['order'] = isset($_SESSION['order']) ? $_SESSION['order'] : 'DESC';
		query_posts( $query_arr );

		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'modablock' );

			endwhile;

			the_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// do_action( 'kumle_action_sidebar' );
get_footer();
