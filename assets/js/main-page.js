jQuery(function($){

    //плавная прокрутка по якорям
    $(".kw-menu").on("click","a", function (event) {
        //отменяем стандартную обработку нажатия по ссылке
        event.preventDefault();

        //забираем идентификатор бока с атрибута href
        var id  = $(this).attr('href'),

        //узнаем высоту от начала страницы до блока на который ссылается якорь
            top = $(id).offset().top;
        
        //анимируем переход на расстояние - top за 1000 мс
        $('body,html').animate({scrollTop: top}, 1000);
    });


    //подсветка якоря
    $('body').scrollspy({ target: '.menu' });

    //паралак контакт формы
    var block5 = document.getElementById("block5");
	if(block5) window.onscroll = function(){
    	var ty, sy = window.scrollY;
    	if (sy > 2700 && sy <= 3700) {
    		ty = (sy - 2700)/10;
    		// console.log(ty);
    		block5.style.backgroundPositionY = ty + '%';
    	}
    	
    }

    /** goTop */
    $(function () {
        var timeoutID,
            $window = $(window),
            $goTop = $('#go-top');

        $window.off('.gotop').on('scroll.gotop', function () {
            clearTimeout(timeoutID);
            timeoutID = setTimeout(function () {
                if ($window.scrollTop() > 500) {
                    $goTop.fadeIn(100);
                } else {
                    $goTop.fadeOut(100);
                }
            }, 100);
        });

        $goTop.click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            $goTop.fadeOut(100);
            return false;
        });
    });
    /* goTop **/



    if (location.pathname === '/' && $(window).width() < 768) {

        $.post('/wp-content/themes/kw-theme/smalltable.html',function(data){
            $('.jbody').html(data);
            $('.k-slider').bxSlider({
                nextText: '&gt;',
                prevText: '&lt;',
                onSlideAfter: function(slideElement, oldIndex, newIndex){
                    var color = ['bgGrey','bgBlue','bgGreen','bgRed']
                    $('.bx-controls-direction a').addClass(color[newIndex]);
                    $('.bx-controls-direction a').removeClass(color[oldIndex]);
                }
    });
        });
    }

});//ready function

	//form
(function($) {	
	
	var app = {
		initialize : function () {
			this.setUpListeners();
		},

		setUpListeners: function () {
			$('.js-kw-form').on('submit', app.submitForm);
			$('.js-kw-form').on('keydown', 'input', app.removeError);
		},

		submitForm: function (e) {
			e.preventDefault();
			
			var form = $(this),
				submitBtn = form.find('button[type="submit"]');

			if( app.validateForm(form) === false ) return false;

			submitBtn.attr('disabled', 'disabled');

			var str = form.serialize();

			$.ajax({
                url: '/wp-content/themes/kw-theme/contactform.php',
                type: 'POST',
                data: str
            })
            .done(function(msg) {
                if(msg === "OK"){
                    var result = "<div class='bg-success'>Danke für Ihre Nachricht! Ich melde mich bei Ihnen in Kürze.</div>"
                    form.find('.modal-body').html(result);
                }else{
                    form.find('.modal-body').html(msg);
                }
            })
            .always(function() {
                submitBtn.removeAttr('disabled');
            });
		},

		validateForm: function (form){
            var inputs = form.find('input'),
                valid = true;
 
            inputs.tooltip('destroy');
 
            $.each(inputs, function(index, val) {
                var input = $(val),
                    val = input.val(),
                    formGroup = input.parents('.form-group'),
                    label = formGroup.find('label').text().toLowerCase(),
                    textError = 'Required ' + label;
 
                if(val.length === 0){
                    formGroup.addClass('has-error').removeClass('has-success');
                    input.tooltip({
                        trigger: 'manual',
                        placement: 'right',
                        title: textError
                    }).tooltip('show');
                    valid = false;
                }else{
                    formGroup.addClass('has-success').removeClass('has-error');
                }
            });
 
            return valid;
        },
 
        removeError: function () {
            $(this).tooltip('destroy').parents('.form-group').removeClass('has-error');
        }       
          
    }
  
    app.initialize();
  
}(jQuery));



jQuery(function($) {

    // var elems = $('kw-lazyload')
    var elems = document.querySelectorAll('.kw-lazyload')


    function kw_lazyload(elem) {
        
        var viewportHeight = window.innerHeight + 100; // plus limit

        elems.forEach(function(elem) {
            var elemY = elem.getBoundingClientRect().top;
            // console.log(elemY)
            if (viewportHeight > elemY) {
                elem.classList.add('lazy-loaded');
            }
        })

    }

    kw_lazyload();
    window.addEventListener('scroll', kw_lazyload);

})
