<?php
/**
 * Template Name: Filter
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kumle
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<!-- Filter -->
<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
	<?php
	if( $terms = get_terms( 'fashion_category', 'orderby=name' ) ) : // как я уже говорил, для простоты возьму рубрики category, но get_terms() позволяет работать с любой таксономией
		echo '<select name="categoryfilter"><option>Выберите категорию...</option>';
		foreach ($terms as $term) :
			echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // в качестве value я взял ID рубрики
		endforeach;
		echo '</select>';
	endif;
	?>
	<input type="text" name="cena_min" placeholder="Минимальная цена" />
	<input type="text" name="cena_max" placeholder="Максимальная цена" />
	<label><input type="radio" name="date" value="ASC" /> Дата: по возрастанию</label>
	<label><input type="radio" name="date" value="DESC" selected="selected" /> Дата: по убыванию</label>
	<label><input type="checkbox" name="featured_image" /> Только с миниатюрой</label>
	<button>Применить фильтр</button>
	<input type="hidden" name="action" value="myfilter">
</form>
<div id="response"></div>
<script>
jQuery(function($){
	$('#filter').submit(function(){
		var filter = $(this);
		$.ajax({
			url:ajaxurl, // обработчик
			data:filter.serialize(), // данные
			type:filter.attr('method'), // тип запроса
			beforeSend:function(xhr){
				filter.find('button').text('Загружаю...'); // изменяем текст кнопки
			},
			success:function(data){
				filter.find('button').text('Применить фильтр'); // возвращаеи текст кнопки
				$('#response').html(data);
			}
		});
		return false;
	});
});
</script>
<!-- /Filter -->

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'kumle_action_sidebar' );

get_footer();
