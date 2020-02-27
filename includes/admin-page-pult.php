<?php



?>
<h1>Hallo World!!!</h1>
<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>

	<?php
	$report = '';
if (isset($_POST['optimize_db']) && $_POST['optimize_db'] === 'do-queries') {
	$report .= kw_optimize_db();
}
	?>

	<form method="POST">
		<p class="submit"><button type="submit" class="button button-primary" name="optimize_db" value="do-queries">Оптимизировать базу данных</button> <?= $report; ?></p>
	</form>
</div>
	<form id="js_go_form" class="go-form">
		<div id="js_css_loader" class="lds-ellipsis-wr lds-ellipsis running"><div></div><div></div><div></div><div></div></div>
	    <button name="aaa" value="update" type="button" class="js-go-btn js-tobe-disabled"><i class="dashicons dashicons-controls-repeat"></i> Update!</button> | 
	    <button name="aaa" value="continue" type="button" class="js-go-btn js-tobe-disabled"><i class="dashicons dashicons-controls-play"></i> Continue!</button>
	    <button name="aaa" value="restart" type="button" class="js-go-btn js-tobe-disabled"><i class="dashicons dashicons-controls-skipback"></i> Restart!</button>
	    <button name="aaa" value="pause" type="button" class="js-go-btn js-pause-btn"><i class="dashicons dashicons-controls-pause"></i> Pause!</button>
	</form>
<script>
jQuery(function($){
	var pause = false
	$('.js-go-btn').click(function(e){
		$('.js-tobe-disabled').attr('disabled', true)
		pause = false
		if (this.value === 'pause') {
			pause = true
			$('.js-tobe-disabled').attr('disabled', false)
		}else{
			do_ajax(this.value)
		}
	});
	function do_ajax(btn) {
		$.post(ajaxurl,
			{action:'pult', btn:btn},
			function(data){
				if ( !pause && data.keep_going ) {
					if(btn === 'update') do_ajax(btn)
					else do_ajax('continue')
				}
				// console.log(data);
			}, 'json');
	}

	// ajax loader
	var ajax_loader = $('#js_css_loader');
	var css_class = 'running'
	ajax_loader.removeClass(css_class);

	$( document ).ajaxSend(function() {
		ajax_loader.addClass(css_class);
	});

	$( document ).ajaxStop(function() {
		ajax_loader.removeClass(css_class);
	});
});
</script>
<?php

// $res = kw_insert_post([
// 		'btn' => '',
// 		'limit' => '10'
// 	]);

// sa($res);

?>

<style>
.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
#js_css_loader.lds-ellipsis div {
  position: absolute;
  top: 33px;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #ccc;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
	animation-play-state: paused;
}
#js_css_loader.lds-ellipsis.running div{
	animation-play-state: running;
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {    transform: scale(0);  }
  100% {    transform: scale(1);  }
}
@keyframes lds-ellipsis3 {
  0% {    transform: scale(1);  }
  100% {    transform: scale(0);  }
}
@keyframes lds-ellipsis2 {
  0% {    transform: translate(0, 0);  }
  100% {    transform: translate(24px, 0);  }
}

</style>

<?php

if (function_exists('get_wp_term_image'))
{
    $meta_image = get_wp_term_image($term_id = 60); 
    //It will give category/term image url 
}
// sa($meta_image);
// var_dump($term_id);

if (function_exists('get_tax_image_urls')){
	$img_urls = get_tax_image_urls($term_id = 60 ,'full');
}

sa($img_urls);