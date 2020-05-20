<?php
/**
 * Kumle functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kumle
 */

define('KW_TEMPLATE_DIRECTORY', get_template_directory());
define('KW_TEMPLATE_DIRECTORY_URI', get_template_directory_uri());

function sa($array = [], $save = false){
	if ($save) return '<pre>' . print_r($array, true) . '</pre>';
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
function xa($array = [], $save = false){
	if ($save) return '<pre>' . print_r($array, true) . '</pre>';
	echo "<pre>";
	var_export($array);
	echo "</pre>";
}
function _sa_($array = [], $save = false, $pre_wrap = true){
	$ret = '';
	if($pre_wrap) $ret .= '<pre>';
	$ret .= str_replace(["Array\n(","\n)"], '', print_r($array,1));
	if($pre_wrap) $ret .= '</pre>';
	if ($save) return $ret;
	echo $ret;
}

if (defined('DEV_MODE')) {
	define( 'db_HOST', 'localhost' ); // set database host
	define( 'db_USER', 'root' ); // set database user
	define( 'db_PASS', '' ); // set database password
	define( 'db_NAME', 'gig_parser' ); // set database name
}else{
	define( 'db_HOST', '127.0.0.1' ); // set database host
	define( 'db_USER', 'U2213198' ); // set database user
	define( 'db_PASS', '12345' ); // set database password
	define( 'db_NAME', 'DB2213198' ); // set database name
}

$wpdb2 = new wpdb( db_USER, db_PASS, db_NAME, db_HOST );

function arrayDB($query='')
{
	$query = trim($query);

	if(!$query) return;

	global $wpdb2;

	return $wpdb2->get_results( $query, ARRAY_A );
}



function get_moda_meta($moda_id, $meta_key = false)
{
	if ($meta_key !== false) {
		$meta_key = _esc($meta_key);
		$res = arrayDB("SELECT * FROM moda_list_meta WHERE moda_id = '$moda_id' AND meta_key = '$meta_key' LIMIT 1");
		return $res ? $res[0]['meta_value'] : '';
	}else{
		$res = arrayDB("SELECT * FROM moda_list_meta WHERE moda_id = '$moda_id'");
		$ret = [];
		foreach ($res as $val) {
			$ret[$val['meta_key']] = $val['meta_value'];
		}
		return $ret;
	}
}


function set_moda_meta($moda_id, $key_value_list = [])
{
	if(!$moda_id || !$key_value_list) return 0;
	$meta_key_list = [];
	$insert_list = [];
	$moda_id = (int)$moda_id;
	foreach ($key_value_list as $meta_key => $meta_value) {
		$meta_key = _esc($meta_key);
		$meta_value = _esc($meta_value);
		$meta_key_list[] = "meta_key = '$meta_key'";
		$insert_list[] = "('$moda_id','".$meta_key . "','" . $meta_value . "')";
	}
	$meta_key_list = implode(' OR ', $meta_key_list);
	arrayDB("DELETE FROM moda_list_meta WHERE moda_id = '$moda_id' AND ($meta_key_list)");

	$insert_list = implode(',', $insert_list);
	arrayDB("INSERT INTO moda_list_meta (moda_id, meta_key, meta_value)	VALUES $insert_list");

	return arrayDB()->affected();
}


function get_ebay_pic_url_by_hash($hash='', $size = '250')
{
	if($hash) return 'https://i.ebayimg.com/images/g/'.$hash.'/s-l'.$size.'.jpg';
}


if ( ! function_exists( 'kumle_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kumle_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Kumle, use a find and replace
	 * to change 'kumle' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'kumle', KW_TEMPLATE_DIRECTORY . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Register navigation menu locations.
	register_nav_menus( array(
		'primary' 	=> esc_html__( 'Primary', 'kumle' ),
		'amp-menu' 	=> esc_html__( 'Amp-Menu', 'kumle' ),
		'social'  	=> esc_html__( 'Social', 'kumle' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'kumle_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add woocommerce support, gallery zoom, lightbox and thumbnail slider.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
endif;
add_action( 'after_setup_theme', 'kumle_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kumle_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kumle_content_width', 810 );
}
add_action( 'after_setup_theme', 'kumle_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kumle_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'kumle' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	for( $i = 1; $i <= 4; $i++ ) {
	    register_sidebar( array(
	        /* translators: 1: Widget number. */
	        'name'          => sprintf( esc_html__( 'Footer Sidebar %d', 'kumle' ), $i ),
	        'id'            => 'footer-'.$i,
	        'before_widget' => '<section id="%1$s" class="widget %2$s">',
	        'after_widget'  => '</section>',
	        'before_title'  => '<h2 class="widget-title">',
	        'after_title'   => '</h2>',
	    ) );
	}	
}
add_action( 'widgets_init', 'kumle_widgets_init' );

/**
* Enqueue scripts and styles.
*/
function moda_scripts() {

	// wp_enqueue_style( 'kumle-fonts', kumle_fonts_url(), array(), null );

	wp_enqueue_style('dashicons');

	wp_enqueue_style( 'jquery-meanmenu', KW_TEMPLATE_DIRECTORY_URI . '/assets/third-party/meanmenu/meanmenu.css' );

	wp_enqueue_style( 'bootstrap-grid', KW_TEMPLATE_DIRECTORY_URI . '/css/main-page-bootstrap-grid.css', '', filemtime(__DIR__.'/css/main-page-bootstrap-grid.css') );

	// wp_enqueue_style( 'jquery-slick', KW_TEMPLATE_DIRECTORY_URI . '/assets/third-party/slick/slick.css', '', '1.6.0' );

	wp_enqueue_style( 'font-awesome', KW_TEMPLATE_DIRECTORY_URI . '/assets/third-party/font-awesome/css/font-awesome.min.css', '', '4.7.0' );

	wp_enqueue_style( 'kumle-style', KW_TEMPLATE_DIRECTORY_URI . '/style.css', '', filemtime(__DIR__.'/style.css') );

	

	wp_enqueue_script( 'kumle-navigation', KW_TEMPLATE_DIRECTORY_URI . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'kumle-skip-link-focus-fix', KW_TEMPLATE_DIRECTORY_URI . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery-meanmenu', KW_TEMPLATE_DIRECTORY_URI . '/assets/third-party/meanmenu/jquery.meanmenu.js', array('jquery'), '2.0.7', true );

	// wp_enqueue_script( 'jquery-slick', KW_TEMPLATE_DIRECTORY_URI . '/assets/third-party/slick/slick.js', array('jquery'), '1.6.0', true );

	wp_enqueue_script( 'kumle-custom', KW_TEMPLATE_DIRECTORY_URI . '/assets/js/custom.js', array( 'jquery' ), '2.0.2', true );

	wp_enqueue_script( 'bootstrap.min', KW_TEMPLATE_DIRECTORY_URI . '/assets/js/bootstrap-4.4.1.min.js', array( 'jquery' ), '2.1.2', true );

	// wp_enqueue_script( 'jquery.bxslider.min', KW_TEMPLATE_DIRECTORY_URI . '/assets/js/jquery.bxslider.min.js', array( 'jquery' ), '2.0.2', true );

	wp_enqueue_script( 'main-page', KW_TEMPLATE_DIRECTORY_URI . '/assets/js/main-page.js', array( 'jquery' ), filemtime(__DIR__.'/assets/js/main-page.js'), true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'moda_scripts' );

function remove_array_value($array, $value_to_delete)
{
	$array = array_flip($array); //Меняем местами ключи и значения
	if (is_array($value_to_delete)) {
		foreach ($value_to_delete as $value) {
			unset ($array[$value]) ; //Удаляем элемент массива
		}
	}else{
		unset ($array[$value_to_delete]) ; //Удаляем элемент массива
	}
	return array_flip($array); //Меняем местами ключи и значения
}


function kw_optimize_db()
{
	global $wpdb;

	// $wpdb->query( "UPDATE $wpdb->posts SET post_parent = 7 WHERE ID = 15 AND post_status = 'static'" );

	// $wpdb->query( "SET sql_mode = 'NO_ENGINE_SUBSTITUTION'" );

	$res = $wpdb->get_row( "show variables like 'sql_mode'", ARRAY_A );

	if ($res['Value']) {

		$arr = explode(',', $res['Value']);
		$arr = remove_array_value($arr, ['NO_ZERO_DATE','NO_ZERO_IN_DATE']);
		$str = implode(',', $arr);
		$wpdb->query( "SET sql_mode = '$str'" );



		$is_index = $wpdb->get_var( "SELECT COUNT(1) IndexIsThere FROM INFORMATION_SCHEMA.STATISTICS
						WHERE table_schema=DATABASE() AND table_name='$wpdb->posts' AND index_name='post_type';" );

		if (!$is_index) $wpdb->query( "ALTER TABLE $wpdb->posts ADD INDEX `post_type` (`post_type`);" );


		$is_index = $wpdb->get_var( "SELECT COUNT(1) IndexIsThere FROM INFORMATION_SCHEMA.STATISTICS
						WHERE table_schema=DATABASE() AND table_name='$wpdb->posts' AND index_name='post_date';" );

		if (!$is_index) $wpdb->query( "ALTER TABLE $wpdb->posts ADD INDEX `post_date` (`post_date`);" );


		$is_index = $wpdb->get_var( "SELECT COUNT(1) IndexIsThere FROM INFORMATION_SCHEMA.STATISTICS
						WHERE table_schema=DATABASE() AND table_name='$wpdb->posts' AND index_name='post_status';" );

		if (!$is_index) $wpdb->query( "ALTER TABLE $wpdb->posts ADD INDEX `post_status` (`post_status`);" );


		$is_index = $wpdb->get_var( "SELECT COUNT(1) IndexIsThere FROM INFORMATION_SCHEMA.STATISTICS
						WHERE table_schema=DATABASE() AND table_name='$wpdb->posts' AND index_name='guid';" );

		if (!$is_index) $wpdb->query( "ALTER TABLE $wpdb->posts ADD INDEX `guid` (`guid`);" );


		$is_index = $wpdb->get_var( "SELECT COUNT(1) IndexIsThere FROM INFORMATION_SCHEMA.STATISTICS
						WHERE table_schema=DATABASE() AND table_name='$wpdb->term_taxonomy' AND index_name='term_id';" );

		if (!$is_index) $wpdb->query( "ALTER TABLE `$wpdb->term_taxonomy` ADD INDEX `term_id` (`term_id`);" );
	}

	// sa($res);

	return "<big>Done</big>";
}


// Load main file.
require_once trailingslashit( KW_TEMPLATE_DIRECTORY ) . '/includes/main.php';





add_action('admin_menu', function(){
	add_menu_page( 'Дополнительные настройки сайта', 'Пульт', 'manage_options', 'pult-page', 'init_pult_page', '', 33 );
	add_submenu_page( 'pult-page', 'insert cats', 'Insert cats', 'manage_options', 'insert-cats-page', 'init_insert_cat_page' ); 
});

function init_pult_page(){include_once KW_TEMPLATE_DIRECTORY . '/includes/admin-page-pult.php';}

function init_insert_cat_page() {include_once KW_TEMPLATE_DIRECTORY . '/includes/admin-page-insert-cats.php';}


add_action( 'init', 'register_moda_post_type' );
function register_moda_post_type(){
	register_post_type('fashion', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Moda pages', // основное название для типа записи
			'singular_name'      => 'Moda page', // название для одной записи этого типа
			'add_new'            => 'Добавить Moda page', // для добавления новой записи
			'add_new_item'       => 'Добавление moda page', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование Moda page', // для редактирования типа записи
			'new_item'           => 'Новое Moda page', // текст новой записи
			'view_item'          => 'Смотреть Moda page', // для просмотра записи этого типа.
			'search_items'       => 'Искать Moda page', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Moda pages', // название меню
		),
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null, 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'custom-fields', 'thumbnail', 'excerpt' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['fashion_category'],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	) );
}




// add_action( 'wp', 'unregister_genre_taxonomy' );
// function unregister_genre_taxonomy(){

// 	unregister_taxonomy('color');
// }
// хук для регистрации
add_action( 'init', 'create_fashion_category_taxonomy' );
function create_fashion_category_taxonomy(){

	// unregister_taxonomy('color');
	// return;
	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'fashion_category', [ 'fashion' ], [ 
		'label'                 => 'Categories', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Categories',
			'singular_name'     => 'Category',
			'search_items'      => 'Search Category',
			'all_items'         => 'All Categories',
			'view_item '        => 'View Category',
			'parent_item'       => 'Parent Category',
			'parent_item_colon' => 'Parent Category:',
			'edit_item'         => 'Edit Category',
			'update_item'       => 'Update Category',
			'add_new_item'      => 'Add New Category',
			'new_item_name'     => 'New Category Name',
			'menu_name'         => 'Categories',
		],
		'description'           => 'description of the Category taxonomy', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => true,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );
}



function kw_insert_post($opts = [])
{
	$opts = array_merge ( [
		'effect' => '',
		'limit' => '10',
		'insertByModaId' => false,
	], $opts );

	// if ($opts['effect'] === 'restart') arrayDB("UPDATE moda_list SET post_id = 0"); // отклбчил так как сложно удалить 100к+ товаров

	$errors = [];

	$post_ids = [];

	$cats = arrayDB("SELECT * from moda_cats where wp_cat_id <> 0");

	$cat_ids = array_column($cats, 'wp_cat_id', 'CategoryID');

	if($opts['insertByModaId']) $moda_list_arr = arrayDB("SELECT * FROM moda_list WHERE id = '{$opts['insertByModaId']}'");
	else $moda_list_arr = arrayDB("SELECT * FROM moda_list WHERE country = 'DE' AND flag = 'dataparsed1' AND ListingType = 'FixedPriceItem' AND post_id = 0  LIMIT $opts[limit]");

	foreach ($moda_list_arr as $moda_list) :

		$moda_meta = get_moda_meta($moda_list['id']);

		$moda_arr = array_merge($moda_list, $moda_meta);

		$moda_arr['moda_id'] = $moda_list['id'];

		unset($moda_arr['id']);
		unset($moda_arr['flag']);
		unset($moda_arr['flag2']);
		unset($moda_arr['post_id']);

		$Variations  = json_decode($moda_arr['Variations'],1);

		$Farbe_arr = [];
		if($Variations) foreach ($Variations as $key => $Variation) {
			if ($Variation['Name'] === 'Farbe') {
				foreach ($Variation['Value'] as $color) {
					$Farbe_arr[] = rtrim(trim($color),'.'); // удаляем точку вконце
					// $Farbe_arr[] = $color;
				}
			}
		}

		$post_excerpt = [
			'PictureURL' => $moda_arr['PictureURL'],
			'QuantitySold' => $moda_arr['QuantitySold'],
			'HitCount' => $moda_arr['HitCount'],
			'currentPrice' => $moda_arr['currentPrice'],
		];

		$post_data = array(
			'comment_status' => 'closed',                                             // 'closed' означает, что комментарии закрыты.
			'ping_status'    => 'closed',                                             // 'closed' означает, что пинги и уведомления выключены.
			'post_author'    => 1,                                                     // ID автора записи
			'post_content'   => $moda_arr['Description'],                                        // Полный текст записи.
			'post_excerpt'   => json_encode($post_excerpt),                                                  // Цитата (пояснительный текст) записи.
			'post_name'      => $moda_arr['title'],                             // Альтернативное название записи (slug) будет использовано в УРЛе.
			'post_status'    => 'publish',         // Статус создаваемой записи.
			'post_title'     => $moda_arr['title'],                                                   // Заголовок (название) записи.
			'post_type'      => 'fashion', // Тип записи.
			'meta_input'     => $moda_arr,                             // добавит указанные мета поля. По умолчанию: ''. с версии 4.4.
		);

		// Вставляем данные в БД
		$post_id = wp_insert_post( wp_slash($post_data) );
		if( is_wp_error($post_id) ){
			 $errors[] = $post_id->get_error_message();
		}
		else {
			$post_ids[] = $post_id;
			// sa($moda_arr['categoryId']);
			// sa($cat_ids);
			arrayDB("UPDATE moda_list SET post_id = '$post_id' WHERE id = '$moda_list[id]'");
			if($cat = @(int)$cat_ids[$moda_arr['categoryId']]) wp_set_post_terms( $post_id, [$cat], 'fashion_category' );
			// add_post_meta( $post_id, 'test_meta_key', 'test_meta_value', $unique = true );
			// update_post_meta( $post_id, 'key_1', 'Excited' );
			// теперь можно использовать $post_id, чтобы например добавить
			// произвольные поля записи с помощью add_post_meta() или update_post_meta()
		}

	endforeach;

	return [
		'keep_going' => count($moda_list_arr) ? 1 : 0,
		'post_ids' => $post_ids,
		'errors' => $errors,
	];
}


function kw_update_post($opts = [])
{
	$opts = array_merge ( [
		'effect' => '',
		'limit' => '10',
		'updateByModaId' => false,
	], $opts );

	if ($opts['effect'] === 'restart') arrayDB("UPDATE moda_list SET flag2 = ''");

	$errors = [];

	$post_ids = [];

	$flag_value = 'updated3';
	if($opts['updateByModaId']) $sql = "SELECT * FROM moda_list WHERE id = '{$opts['updateByModaId']}'";
	else $sql = "SELECT * FROM moda_list WHERE flag2 <> '$flag_value' AND post_id <> 0  LIMIT $opts[limit]"; // $flag_value = 'updated3';
	$moda_list_arr = arrayDB($sql);
// sa($moda_list_arr);
	foreach ($moda_list_arr as $moda_list) :

		$moda_meta = get_moda_meta($moda_list['id']);

		$moda_arr = array_merge($moda_list, $moda_meta);

		$moda_arr['moda_id'] = $moda_list['id'];
		unset($moda_arr['id']);
		unset($moda_arr['flag']);
		unset($moda_arr['flag2']);
		// unset($moda_arr['post_id']);

		$post_excerpt = [
			'PictureURL' => $moda_arr['PictureURL'],
			'QuantitySold' => $moda_arr['QuantitySold'],
			'HitCount' => $moda_arr['HitCount'],
			'currentPrice' => $moda_arr['currentPrice'],
		];

		$post_data = [
			'ID'             => $moda_arr['post_id'],
			'post_excerpt'   => json_encode($post_excerpt),
			// 'meta_input'     => $moda_arr, // или не нужно???
		];

		// Вставляем данные в БД
		$post_id = wp_update_post( wp_slash($post_data) );
		if( is_wp_error($post_id) ){
			 $errors[] = $post_id->get_error_message();
		}
		else {
			$post_ids[] = $post_id;
			arrayDB("UPDATE moda_list SET flag2 = '$flag_value' WHERE id = '$moda_list[id]'"); // $flag_value = 'updated3';
		}

	endforeach;

	$total = arrayDB("SELECT count(*) FROM moda_list WHERE post_id <> 0")[0]['count(*)'];
	$done = arrayDB("SELECT count(*) FROM moda_list WHERE flag2 = '$flag_value' AND post_id <> 0")[0]['count(*)'];

	$progress = "[ $done/$total ] (".round($done/$total*100, 1)."%)";

	return [
		'keep_going' => count($moda_list_arr) ? 1 : 0,
		'progress' => $progress,
		'post_ids' => $post_ids,
		'$moda_arr' => $moda_arr,
		'$sql' => $sql,
		'errors' => $errors,
	];
}


function kw_delete_expired($moda_id = '')
{
	if($moda_id) $post_id = arrayDB("SELECT id,post_id FROM moda_list WHERE id = '$moda_id'");
	else $post_id = arrayDB("SELECT id,post_id FROM moda_list WHERE post_id <> 0 AND endTime < NOW() limit 1");

	if ($post_id) {
		$post_id = $post_id[0]['post_id'];
		$res = wp_delete_post( $post_id );
		if ($res !== false) {
			$done = 'if';
			arrayDB("UPDATE moda_list SET post_id = '0' WHERE post_id = '$post_id'");
		}else{
			$done = 'else';
		}
	}

	$expired_count = arrayDB("SELECT count(*) FROM moda_list WHERE post_id <> 0 AND endTime < NOW()")[0]['count(*)'];
	
	return [
		'keep_going' => $post_id ? 1 : 0,
		'expired' => $expired_count,
		'$post_id' => $post_id,
		'$res' => $res,
		'$done' => $done,
		'deleted' => is_object($res),
		// 'errors' => $errors,
	];
}



add_action( 'wp_ajax_pult', 'ajax_pult_page' ); // wp_ajax_{ЗНАЧЕНИЕ ПАРАМЕТРА ACTION!!}
// add_action( 'wp_ajax_nopriv_misha', 'ajax_pult_page' );  // wp_ajax_nopriv_{ЗНАЧЕНИЕ ACTION!!}
// первый хук для авторизованных, второй для не авторизованных пользователей
 
function ajax_pult_page()
{
	$ret = '';

	if ($_POST['act'] === 'insert') {
		$ret = kw_insert_post([ 'effect' => $_POST['effect']]);
	}
	if ($_POST['act'] === 'update') {
		$ret = kw_update_post([ 'effect' => $_POST['effect']]);
	}
	if ($_POST['act'] === 'delete') {
		$ret = kw_delete_expired([ 'effect' => $_POST['effect']]);
	}

	echo json_encode($ret);
 
	die; // даём понять, что обработчик закончил выполнение
}


function kw_modablock_imgsrc($excerpt_data)
{
	if ($excerpt_data) {
		$hashes = $excerpt_data['PictureURL'];
	}else{
		return 'https://place-hold.it/300x200?text=No+Image&bold=true';
	}

	if ($hashes) {
		$picture_hash = explode(',', $hashes)[0];
		return get_ebay_pic_url_by_hash($picture_hash);
	}else{
		return 'https://place-hold.it/300x200?text=No+Image&bold=true';
	}
}

add_action('wp_ajax_myfilter', 'true_filter_function'); 
add_action('wp_ajax_nopriv_myfilter', 'true_filter_function');
function true_filter_function(){
	$args = array(
		'orderby' => 'date', // сортировка по дате у нас будет в любом случае (но вы можете изменить/доработать это)
		'order'	=> $_POST['date'] // ASC или DESC
	);
 
	// для таксономий
	if( isset( $_POST['categoryfilter'] ) )
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $_POST['categoryfilter']
			)
		);
 
	// создаём массив $args['meta_query'] если указана хотя бы одна цена или отмечен чекбокс
	if( isset( $_POST['cena_min'] ) || isset( $_POST['cena_max'] ) || ( isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' ) )
		$args['meta_query'] = array( 'relation'=>'AND' ); // AND значит все условия meta_query должны выполняться
 
	// условие 1: цена больше $_POST['cena_min']
	if( isset( $_POST['cena_min'] ) )
		$args['meta_query'][] = array(
			'key' => 'cena',
			'value' => $_POST['cena_min'],
			'type' => 'numeric',
			'compare' => '>'
		);
 
	// условие 2: цена меньше $_POST['cena_max']
	if( isset( $_POST['cena_max'] ) )
		$args['meta_query'][] = array(
			'key' => 'cena',
			'value' => $_POST['cena_max'],
			'type' => 'numeric',
			'compare' => '<'
		);
 
	// условие 3: миниатюра имеется
	if( isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' )
		$args['meta_query'][] = array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		);
 
	die();
}
 

function the_gtm_head()
{ ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-56X4FKW');</script>
    <!-- End Google Tag Manager -->
<?php }
 

function the_gtm_body()
{ ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-56X4FKW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php }

function kw_js_variables()
{
	if (is_archive()) {
		$menu_title = single_term_title('', 0);
		$menu_title = esc_html($menu_title);
	}else{
		$menu_title = '<div class="-mode">MODE</div><div class="-today">Today</div>';
	}
?>
<script>
	 var KW = {menuTitle:'<?= $menu_title;?>'};
</script>
<?php
}


function kw_page_banner($img_urls = '')
{
	if (function_exists('get_tax_image_urls')){
		$tax_obj = get_queried_object();
		$term_id = $tax_obj->term_id;
		$img_urls = get_tax_image_urls($term_id ,'full');
	}
	if ($img_urls) {
		$img_src = $img_urls[0];
	}else{
		$img_src = KW_TEMPLATE_DIRECTORY_URI . '/images/banner-2020.jpg';
	}
		$menu_title = single_term_title('', 0);
		$menu_title = esc_attr($menu_title);
?>
<div class="kw-page-banner-wrapper">
	<img class="kw-page-banner-image" src="<?= $img_src; ?>" alt="<?= $menu_title; ?>">
	<div class="kw-page-banner-text">
		<div class="-first-string">2020</div>
		<div class="-second-string">MODETODAY</div>
		<div class="-third-string">SPRING SUMMER</div>
	</div>
</div>
<?php }


function is_amp_page()
{
	return isset($_GET['amp']);
}



function msync_insert_moda_page($moda_id = '')
{
	if(!$moda_id) return false;
	$moda_id = trim($moda_id);
	$moda_id = (int)$moda_id;
	$res = kw_insert_post(['insertByModaId' => $moda_id]);
	return $res['post_ids'] ? 1 : 0;
}

function msync_update_moda_page($moda_id = '')
{
	if(!$moda_id) return false;
	$moda_id = trim($moda_id);
	$moda_id = (int)$moda_id;
	$res = kw_update_post(['updateByModaId' => $moda_id]);
	return $res['post_ids'] ? 1 : 0;
}

function msync_delete_moda_page($moda_id = '')
{
	if(!$moda_id) return false;
	$moda_id = trim($moda_id);
	$moda_id = (int)$moda_id;
	$res = kw_delete_expired($moda_id);
	return $res['deleted'] ? 1 : 0;
}