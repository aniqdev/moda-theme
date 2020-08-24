<?php




$level3 = arrayDB("SELECT * from moda_cats where wp_cat_id <> 0");


// sa($level3);

$parents_of_L4 = array_column($level3, 'wp_cat_id', 'CategoryID');


sa($parents_of_L4 );

// $level4 = arrayDB("SELECT * from moda_cats
//    		where wp_cat_id = 0 AND moda_cats.CategoryParentID in (select CategoryID from moda_cats where moda_cats.CategoryParentID = '260010');");

// $level4 = arrayDB("SELECT * from moda_cats
//    		where wp_cat_id = 0 AND moda_cats.CategoryParentID in (select CategoryID from moda_cats
//    		where moda_cats.CategoryParentID in (select CategoryID from moda_cats where moda_cats.CategoryParentID = '260010'));");

$level4 = arrayDB("SELECT * from moda_cats
   		where wp_cat_id = 0 AND moda_cats.CategoryParentID in (select CategoryID from moda_cats
   		where moda_cats.CategoryParentID in (select CategoryID from moda_cats
   		where moda_cats.CategoryParentID in (select CategoryID from moda_cats where moda_cats.CategoryParentID = '260010')))");

sa($level4);

// return;
foreach ($level4 as $val) {
	$val['CategoryName_DE'] = $val['CategoryName_DE'] ? $val['CategoryName_DE'] : $val['CategoryName'];
	$val['CategoryName'] = $val['CategoryName'] ? $val['CategoryName'] : $val['CategoryName_DE'];

	$insert_data = wp_insert_term(
		$val['CategoryName_DE'],  // новый термин
		'fashion_category', // таксономия
		array(
			'description' => $val['CategoryName'],
			'slug'        => $val['CategoryName'],
			'parent'      => (int)$parents_of_L4[$val['CategoryParentID']]
		)
	);

	if( ! is_wp_error($insert_data) ){
		sa($insert_data);
		$term_id = $insert_data['term_id'];
		arrayDB("UPDATE moda_cats SET wp_cat_id = '$term_id' WHERE id = '$val[id]'");
	}else{
		echo "<hr>";
		echo $insert_data->get_error_message();
		echo "<hr>";
	}
}



return;
$level3 = arrayDB("SELECT * from moda_cats where moda_cats.CategoryParentID = '260010'");



$parent_term_id = defined('DEV_MODE') ? 60 : 149;

foreach ($level3 as $val) {
	$insert_data = wp_insert_term(
		$val['CategoryName_DE'],  // новый термин
		'fashion_category', // таксономия
		array(
			'description' => $val['CategoryName'],
			'slug'        => $val['CategoryName'],
			'parent'      => $parent_term_id
		)
	);
	if( ! is_wp_error($insert_data) ){
		sa($insert_data);
		$term_id = $insert_data['term_id'];
		arrayDB("UPDATE moda_cats SET wp_cat_id = '$term_id' WHERE id = '$val[id]'");
	}else{
		echo "<hr>";
		echo $insert_data->get_error_message();
		echo "<hr>";
	}
}

sa($insert_data);

sa($level3);
?>

