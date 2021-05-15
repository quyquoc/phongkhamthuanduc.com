<div class="popup-contact">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-body">
				<div class="popup-form contact-form">
				
					<div class="close"><i class="fa fa-times"></i></div>
					<div class="form" style="position: relative;">
						<div id="loading"><img src="{{ url('/frontend/home/images/loading.gif') }}" /></div>
						<div class="notice success">Thông tin đã gửi thành công!</div>
						<div class="notice error">Lỗi! Không gửi được thông tin!</div>
						<div class="box-header" data-aos="fade-up">
							<h1 class="box-title-2">Liên hệ tư vấn</h1>
						</div>
						<form name="appForm" id="appForm" method="post" action="" enctype="multipart/form-data">
							<input type="text"  class="colum-2" name="page_id" value="{{page_id is defined ? page_id: 1}}" hidden/>
							<input type="text"  class="colum-2" name="fullname"  placeholder="Họ tên"/>
							<input type="text"  class="colum-2" name="phone"  placeholder="Điện thoại">
							<input type="text"  class="colum-2" name="from_email"  placeholder="Email"/>
							<select name="service" id="service" class="form-control" class=" btn-filter"  placeholder="Dịch vụ cần tư vấn">
								{% if list_options is defined %}
									{% for item in list_options %}
										<option value="{{item.title}}">{{item.title}}</option>
									{% endfor %}
								{% endif %}
							</select>
							<textarea name="content" id="content" rows="5" placeholder="Nội dung"></textarea>
							<a class="button send" title="Gửi yêu cầu!" href="javascript:void(0)">Gửi</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script> 
		$(".contact-form a.send").click(function() {
			var param = new Object();
				form              = ".contact-form ";
				param.fullname    = $(form+' input[name="fullname"]').val();
				param.phone       = $(form+' input[name="phone"]').val();
				param.from_email  = $(form+' input[name="from_email"]').val();
				param.service  	  = $(form+ ' #service option:selected').val();
				param.content     = $(form+' textarea[name="content"]').val();
				send_contact(form, param);
		});
		$.fn.clickOff = function(callback, selfDestroy) {
			var clicked = false;
			var parent = this;
			var destroy = selfDestroy || true;

			parent.click(function() {
				clicked = true;
			});

			$(document).click(function(event) {
				if (!clicked) {
					callback(parent, event);
				}
				if (destroy) {
				}
				clicked = false;
			});
		};

		$(".popup-contact .form,  a.button-2,a.button-1 ").clickOff(function() { 
			$(".popup-contact").removeClass('active');
		});
	</script>
</div>