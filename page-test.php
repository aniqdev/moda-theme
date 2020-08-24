<?php
/**
 * Template Name: Test
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kumle
 */

get_header();
?>

<style>
.moda-cat-lists ul{
    padding-left: 60px;
    margin: 0;
}
.moda-cat-lists ul ul{
	 border-left: 1px dashed #888;
}
.moda-cat-lists ul a:hover{
	text-decoration: underline;
}
</style>
<div class="container moda-cat-lists">
	<h2 class="text-center">Fashion categories</h2><hr>
	<div class="row">
		<div class="col-sm-6">
<?php

draw_wp_cats(59);

?>
		</div>
	</div>
</div>

<?php
get_footer();
