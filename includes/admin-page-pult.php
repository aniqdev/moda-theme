<?php

$expired_count = arrayDB("SELECT count(*) FROM moda_list WHERE post_id <> 0 AND endTime < NOW()")[0]['count(*)'];

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
<div id="js_css_loader" class="lds-ellipsis-wr lds-ellipsis running"><div></div><div></div><div></div><div></div></div>
<form id="js_go_form1" class="go-form"><br><br>
	<fieldset><hr>
	    <legend><b>Add</b> new moda pages</legend>
	    <button name="insert" value="continue" type="button" class="js-pp-btn js-tobe-disabled"><i class="dashicons dashicons-controls-play"></i> Continue!</button>
	    <!-- <button name="insert" value="restart" type="button" class="js-pp-btn js-tobe-disabled"><i class="dashicons dashicons-controls-skipback"></i> Restart!</button> -->
	    <button name="pause" value="pause" type="button" class="js-pp-btn js-pause-btn"><i class="dashicons dashicons-controls-pause"></i> Pause!</button>
	</fieldset>
</form>
<form id="js_go_form2" class="go-form"><br><br>
	<fieldset><hr>
	    <legend><b>Update</b> moda pages</legend>
	    <button name="update" value="continue" type="button" class="js-pp-btn js-tobe-disabled"><i class="dashicons dashicons-controls-play"></i> Continue!</button>
	    <button name="update" value="restart" type="button" class="js-pp-btn js-tobe-disabled"><i class="dashicons dashicons-controls-repeat"></i> Restart!</button>
	    <button name="pause" value="pause" type="button" class="js-pp-btn js-pause-btn"><i class="dashicons dashicons-controls-pause"></i> Pause!</button>
	    <span id="update_progress"></span>
	</fieldset>
</form>
<form id="js_go_form3" class="go-form"><br><br>
	<fieldset><hr>
	    <legend><b>Delete expired</b> moda pages</legend>
	    <p>There is [ <b id="expired_count"><?= $expired_count; ?></b> ] expired moda pages</p>
	    <button name="delete" value="expired" type="button" class="js-pp-btn js-tobe-disabled"><i class="dashicons dashicons-trash"></i> Delete!</button>
	</fieldset>
</form>
<script>
jQuery(function($){
	var pause = false
	$('.js-pp-btn').click(function(e){
		if(this.value === 'restart' && !confirm("Restart?")) return false;
		if(this.name === 'delete' && !confirm("Delete?")) return false;
		$('.js-tobe-disabled').attr('disabled', true)
		pause = false
		var act = this.name
		var effect = this.value
		var send = {action:'pult', act:act, effect:effect}
		if (act === 'pause') {
			pause = true
			$('.js-tobe-disabled').attr('disabled', false)
		}else{
			do_ajax(send)
		}
	});
	function do_ajax(send) {
		$.post('/wp-admin/admin-ajax.php',	send, function(data){
			if(data.progress) $('#update_progress').html(data.progress);
			if(data.expired) $('#expired_count').html(data.expired);
				if ( !pause && data.keep_going ) {
					send.effect = 'continue'
					do_ajax(send)
				}
			}, 'json');
	}
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
.go-form button{
	width: 100px;
}
.go-form fieldset{
	border: 1px solid #aaa;
    padding: 8px 15px;
    margin: 0;
    width: 50%;
}
/* css loader animation */
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

<script>
jQuery(function($){
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

// sa($img_urls);