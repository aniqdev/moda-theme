<?php
/**
 * Template Name: Page Categories
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

$res = $wpdb->get_results( "SELECT * FROM wp_terms", ARRAY_A );

$res = array_column($res, 'slug', 'term_id');

// sa($res);

// CategoryID,CategoryLevel,CategoryName,CategoryName_DE,CategoryParentID
$res3 = arrayDB("SELECT * from moda_cats where CategoryParentID= '260010'"); // CategoryLevel = 3
echo "<ul>";
foreach ($res3 as $val3) {
	echo "<li><a href='/fashion_category/".$res[$val3['wp_cat_id']]."'>".$val3['CategoryName'].'</a>';
	$res4 = arrayDB("SELECT * from moda_cats where CategoryParentID= '{$val3['CategoryID']}'"); // CategoryLevel = 4
	if ($res4) {
		echo "<ul>";
		foreach ($res4 as $val4) {
			echo "<li><a href='/fashion_category/".$res[$val4['wp_cat_id']]."'>".$val4['CategoryName'].'</a>';
			$res5 = arrayDB("SELECT * from moda_cats where CategoryParentID= '{$val4['CategoryID']}'"); // CategoryLevel = 5
			if ($res5) {
				echo "<ul>";
				foreach ($res5 as $val5) {
					echo "<li><a href='/fashion_category/".$res[$val5['wp_cat_id']]."'>".$val5['CategoryName'].'</a>';
					$res6 = arrayDB("SELECT * from moda_cats where CategoryParentID= '{$val5['CategoryID']}'"); // CategoryLevel = 6
					if ($res6) {
						echo "<ul>";
						foreach ($res6 as $val6) {
							echo "<li><a href='/fashion_category/".$res[$val6['wp_cat_id']]."'>".$val6['CategoryName'].'</a></li>';
						}
						echo "</ul>";
					}
					echo "</li>";
				}
				echo "</ul>";
			}
			echo "</li>";
		}
		echo "</ul>";
	}
	echo "</li>";
}
echo "</ul>";
?>
		</div>
		<div class="col-sm-6">
<?php
$res3 = arrayDB("SELECT * from moda_cats where CategoryParentID= '260010'"); // CategoryLevel = 3
echo "<ul>";
foreach ($res3 as $val3) {
	echo "<li><a href='/fashion_category/".$res[$val3['wp_cat_id']]."'>".$val3['CategoryName_DE'].'</a>';
	$res4 = arrayDB("SELECT * from moda_cats where CategoryParentID= '{$val3['CategoryID']}'"); // CategoryLevel = 4
	if ($res4) {
		echo "<ul>";
		foreach ($res4 as $val4) {
			echo "<li><a href='/fashion_category/".$res[$val4['wp_cat_id']]."'>".$val4['CategoryName_DE'].'</a>';
			$res5 = arrayDB("SELECT * from moda_cats where CategoryParentID= '{$val4['CategoryID']}'"); // CategoryLevel = 5
			if ($res5) {
				echo "<ul>";
				foreach ($res5 as $val5) {
					echo "<li><a href='/fashion_category/".$res[$val5['wp_cat_id']]."'>".$val5['CategoryName_DE'].'</a>';
					$res6 = arrayDB("SELECT * from moda_cats where CategoryParentID= '{$val5['CategoryID']}'"); // CategoryLevel = 6
					if ($res6) {
						echo "<ul>";
						foreach ($res6 as $val6) {
							echo "<li><a href='/fashion_category/".$res[$val6['wp_cat_id']]."'>".$val6['CategoryName_DE'].'</a></li>';
						}
						echo "</ul>";
					}
					echo "</li>";
				}
				echo "</ul>";
			}
			echo "</li>";
		}
		echo "</ul>";
	}
	echo "</li>";
}
echo "</ul>";
?>
		</div>
	</div>
</div>

<?php
get_footer();
