<div class="box box-contact" id="box-contact">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-header" data-aos="fade-up">
				<h1 class="box-title">{{ title is not empty ? title : "Liên hệ với chúng tôi" }}</h1>
			</div>
			<div class="box-body">
				<div class="inner">
					<div class="contact-info" data-aos="fade-right">
						<ul class="contact-list">
							<li>
								<i class="fa fa-envelope-o" aria-hidden="true"></i>
								<a href="mailto:info@ohi.vn">info@ohi.vn</a>
							</li>
							<li>
								<i class="fa fa-mobile" aria-hidden="true"></i>
								<span><a href="tel:0911067111">0911 067 111</a></span>
							</li>
							<li>
								<dl class="social">
									<dt><a href="https://www.facebook.com/ohi.vn" title="facebook" rel="nofollow" target="_blank"><i class="fa fa-facebook delay" aria-hidden="true"></i></a></dt>
									<dt><a href="https://www.youtube.com/channel/UComOj715RYdHFar46faaYxw" title="youtube" rel="nofollow" target="_blank"><i class="fa fa-youtube-play delay" aria-hidden="true"></i></a></dt>
								</dl>
							</li>
						</ul>
						<div style="clear:both"></div>
					</div>
					<div class="contact-form" data-aos="fade-left">
						<div class="form">
							<div id="loading"><img src="{{ assets }}/images/loading.gif" /></div>
							<div class="notice success">Thông tin đã gửi thành công!</div>
							<div class="notice error">Lỗi! Không gửi được thông tin!</div>
							<form name="appForm" id="appForm" method="post" action="" enctype="multipart/form-data">
								<input type="text" name="fullname" id="fullname" placeholder="Họ tên"/>
								<input type="text" name="phone" id="phone" placeholder="Điện thoại">
								<input type="text" name="from_email" id="from_email" placeholder="Email"/>
								<textarea name="content" id="content" rows="5" placeholder="Nội dung"></textarea>
								<a class="button send" title="Gửi yêu cầu!">Gửi</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".contact-form .form a.send").click(function() {
    var param = new Object();
        param.fullname    = $(this).parent().find('input[name="fullname"]').val();
        param.phone 			= $(this).parent().find('input[name="phone"]').val();
        param.from_email  = $(this).parent().find('input[name="from_email"]').val();
        param.content  		= $(this).parent().find('textarea[name="content"]').val();
        form 							= ".contact-form .form";
        register(form, param);
	});
</script>
