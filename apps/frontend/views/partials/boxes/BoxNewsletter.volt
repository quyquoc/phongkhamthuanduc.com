<div class="section box box-newsletter">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-body">
				<div class="newsletter wow fadeInUp">
					<div class="box-header">
						<h1 class="box-title text-left">Đăng ký nhận tin</h1>
						<p>Để lại thông tin email để nhận những tin mới nhất từ chúng tôi</p>
					</div>
					<div class="form">
						<div id="loading"><img src="{{ assets }}/images/loading.gif" /></div>
						<div class="notice success">Đăng ký thành công!</div>
						<div class="notice error">Lỗi! Đăng ký thất bại!</div>
						<div class="form-inner">
							<div class="row-input">
								<input type="text" name="phone" placeholder="Nhập số điện thoại" />
								<input type="text" name="from_email" placeholder="Nhập email" />
							</div>
							<a class="button register"><i class="fa fa-paper-plane-o"></i></a>
						</div>
					</div>
				</div>
				<div class="social wow fadeInUp">
					<h3>Kết nối với chúng tôi</h3>
					<ul>
						<li><a href="https://www.facebook.com/datxanhbacmientrung" title="facebook" rel="nofollow" target="_blank"><i class="fa fa-facebook delay" aria-hidden="true"></i></a></li>
						<li><a href="https://www.youtube.com/c/datxanhbacmientrung" title="youtube" rel="nofollow" target="_blank"><i class="fa fa-youtube-play delay" aria-hidden="true"></i></a></li>
						<li><a href="https://shop.zalo.me/store?pageId=4198914429762321136&src=welcomemsg" title="Zalo" rel="nofollow" target="_blank"><img src="{{ assets }}/images/zalo.png"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(".box-newsletter a.register").click(function() {
	    var param = new Object();
	        param.phone 			= $(this).parent().find('input[name="phone"]').val();
	        param.from_email  = $(this).parent().find('input[name="from_email"]').val();
	        form 							= ".box-newsletter .form";
	        register(form, param);
		});

		function register(form, param) {
	    var url 				= "{{url('/newsletter/register')}}";
			var email_regex = /^([a-zA-Z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

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

			$('.box-newsletter #loading').fadeIn('fast');
	    $.post(url, param, function(data){
				$('.box-newsletter #loading').fadeOut('fast');
	    	if(data != "false") {
					if($('#tracking').html() == "") {
		   			$('#tracking').html(data);
					}
					$(".box-newsletter .notice.success").slideDown('slow').delay(3000).slideUp('slow');
					clear_form(form);
				}else {
					$(".box-newsletter .notice.error").slideDown('slow').delay(3000).slideUp('slow');
				}
	    });
		}

		function clear_form(form) {
			$(form + ' input[name="phone"]').val('');
			$(form + ' input[name="from_email"]').val('');
		}
	</script>

</div>
