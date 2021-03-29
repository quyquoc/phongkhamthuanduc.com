$(document).ready(function(){
	
	new WOW().init();	

	action_page();

	$(window).scroll(function() {
		action_page();
	});

	$("a").on("click",function(e){
		if(""!==this.hash){
			e.preventDefault();
			var i=this.hash;
			$("html, body").animate({scrollTop:$(i).offset().top - 80},1e3,function(){})
		}
	});

	$('button.rd-panel_toggle').click(function(event) {
		$(this).toggleClass("active");
		$( ".rd-menu" ).toggleClass('active', $(this).hasClass('active'));
	});

	$(".scroll-to-target").on('click', function() {
		var target = $(this).attr('data-target');
		$('html, body').animate({
			scrollTop: $(target).offset().top
		}, 1500);
	});
});

function action_page() {
	// $top_height = $('header').height();
	$top_height = 0;
	if($(window).scrollTop() > $top_height){
		$('header').addClass('stick');
		$('.main_menu').addClass('stick');
	}else{
		$('header').removeClass('stick');
		$('.main_menu').removeClass('stick');
	}

	if($(this).scrollTop() >= 200){
		$('.scroll-to-target').addClass('active');
	}else{
		$('.scroll-to-target').removeClass('active');
	}
}

function register(form, param) {

	var uri = url + "/gui-lien-he";
	var email_regex = /^([a-zA-Z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

	if(param.fullname == "") {
		$(form + ' input[name="fullname"]').addClass('error');
		$(form + ' input[name="fullname"]').focus();
		return false;
	}else{
		$(form + ' input[name="fullname"]').removeClass('error');
	}
	if(param.phone == "") {
		$(form + ' input[name="phone"]').addClass('error');
		$(form + ' input[name="phone"]').focus();
		return false;
	}else{
		$(form + ' input[name="phone"]').removeClass('error');
	}
	if(!email_regex.test(param.from_email) && param.from_email != "") {
		$(form + ' input[name="from_email"]').addClass('error');
		$(form + ' input[name="from_email"]').focus();
		return false;
	}else{
		$(form + ' input[name="from_email"]').removeClass('error');
	}

	$(form + ' #loading').fadeIn('fast');
	$.post(uri, param, function(data){
			$(form + ' #loading').fadeOut('fast');
			if(data == "true") {
				$(form + " .notice.success").slideDown('slow').delay(3000).slideUp('slow');
				clear_form();
			} else {
				$(form + " .notice.error").slideDown('slow').delay(3000).slideUp('slow');
			}
			clear_form(form);
	});
}

function clear_form(form = '') {
	$(form + ' input[name="fullname"]').val('');
	$(form + ' input[name="phone"]').val('');
	$(form + ' input[name="from_email"]').val('');
	$(form + ' textarea[name="content"]').val('');
}

// click cart
function clickCart(_obj, qty, _s){
  var self = $(_obj);
  if( self.hasClass('disable') ){
    return false;
  }

  $('.btn-buy-product').addClass('disable');
  var parent  = $(_obj);
  var code    = $(_obj).attr('code'); 
  var img     = $(_obj).attr('ref'); 
  
  if ($(window).width() > 1000)
  	var cart = $('.main_menu .plugin-cart');
  else 
  	var cart = $('.rd-panel .plugin-cart');

  $("<img/>", {
    class: "item-fly-product",
    src: img
  }).appendTo("body").css({
    'top':parent.offset().top,
    'left':parent.offset().left+parent.width() - 50
  });

  setTimeout(function(){
    $(document).find('.item-fly-product').css({
      'top': cart.offset().top,
      'left': cart.offset().left
    });
    setTimeout(function(){
      $(document).find('.item-fly-product').remove();
          
      $('.btn-buy-product').removeClass('disable');
      
      $.ajax({
        url: 			url + "/cap-nhat-gio-hang",
        type: 		"post",
        dataType: "html",
        data: {
          itemAction:'add', itemQuantity: qty, itemID:code, itemProduct: _s
        },
        success: function (result){
          $.post(url + "/xem-gio-hang", null, function(cart){
            $('.cart-total-items').html(cart.cart_total_items);
          }, "json");
        }
      });
    },1200)
  }, 500);

  return false;
}