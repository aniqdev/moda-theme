<?php






// ------------------------------------------------------------------
// Вешаем все блоки, поля и опции на хук admin_init
// ------------------------------------------------------------------
//
function eg_settings_api_init() {
	// Добавляем блок опций на базовую страницу "Чтение"
	add_settings_section(
		'eg_setting_section', // секция
		'Заголовок для секции настроек',
		'eg_setting_section_callback_function', // Текст описывающий блок настроек
		'site-options' // страница
	);

	// Добавляем поля опций. Указываем название, описание, 
	// функцию выводящую html код поля опции.
	add_settings_field(
		'eg_setting_name',
		'<label for="qwerty__">Описание поля опции</label>',
		'eg_setting_callback_function', // можно указать ''
		'site-options', // страница
		'eg_setting_section' // секция
	);
	add_settings_field(
		'eg_setting_name2',
		'Описание поля опции2',
		function(){ echo '<input name="eg_setting_name2" value="' . get_option( 'eg_setting_name2' ) . '" class="code2">'; },
		'site-options', // страница
		'eg_setting_section' // секция
	);

	// Регистрируем опции, чтобы они сохранялись при отправке 
	// $_POST параметров и чтобы callback функции опций выводили их значение.
	register_setting( 'site-options', 'eg_setting_name' );
	register_setting( 'site-options', 'eg_setting_name2', ['default' => 'defaulta'] );
}
add_action( 'admin_init', 'eg_settings_api_init' );

// ------------------------------------------------------------------
// Сallback функция для секции
// ------------------------------------------------------------------
//
// Функция срабатывает в начале секции, если не нужно выводить 
// никакой текст или делать что-то еще до того как выводить опции, 
// то функцию можно не использовать для этого укажите '' в третьем 
// параметре add_settings_section
//
function eg_setting_section_callback_function() {
	global $wp_settings_sections;
	global $wp_settings_fields;
	global $shortcode_tags;
	// echo '<p>Текст описывающий блок настроек</p>';
	// echo '<pre>';
	// print_r($wp_settings_sections);
	// print_r($wp_settings_fields);
	// print_r($shortcode_tags);
	// include __DIR__.'/test.php';
	// echo '</pre>';
}

// ------------------------------------------------------------------
// Callback функции выводящие HTML код опций
// ------------------------------------------------------------------
//
// Создаем checkbox и text input теги
//
function eg_setting_callback_function() {
	echo '<input 
		id="qwerty__"
		name="eg_setting_name" 
		type="checkbox" 
		' . checked( 1, get_option( 'eg_setting_name' ), false ) . ' 
		value="1" 
		class="code" 
	/>';
}
