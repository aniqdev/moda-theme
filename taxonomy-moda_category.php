<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kumle
 */

get_header(); ?>

<style>
.entry-content p{
	max-height: 66px;
	overflow: hidden; 
/* 	white-space: nowrap;
	text-overflow: ellipsis; */
}
</style>

	<div id="modablocks" class="container content-area" style="width: 100%;" file="<?= basename(__FILE__); ?>">
		<main id="main" class="site-main row" role="main">

		<?php
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
