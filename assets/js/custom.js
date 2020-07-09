( function( $ ) {

	$(document).ready(function($){

		$('#main-nav').meanmenu({
			meanScreenWidth: "1050",
			meanMenuContainer: '.navigation-wrap'
		});

		// Go to top.
		var $scroll_obj = $( '#btn-scrollup' );
		
		$( window ).scroll(function(){
			if ( $( this ).scrollTop() > 100 ) {
				$scroll_obj.fadeIn();
			} else {
				$scroll_obj.fadeOut();
			}
		});

		$scroll_obj.click(function(){
			$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
			return false;
		});


		// breadcrumb category siblings
		$.post('/wp-admin/admin-ajax.php',
			{action:'getsiblingcats'},
			function(data){
				// console.log(data)
				jQuery('.bc-list-item').each(function(el){
					// console.log(this.dataset.href)
					if(data[this.dataset.href]){
						$(this).addClass('have-siblings')
						$(this).append(data[this.dataset.href].html_list)
						// console.log(data[this.dataset.href])
					}
				})
			}, 'json');

	});

} )( jQuery );

