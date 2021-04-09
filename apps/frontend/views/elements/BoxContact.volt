<div class="box box-contact">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-body">
				<div class="inner">
					<div class="section contact-form" data-aos="fade-left">
                        <div class="box-header" data-aos="fade-up">
                            <h1 class="box-title text-left">Đặt lịch hẹn khám</h1>
                        </div>
						<div class="form">
							<div id="loading"><img src="{{ url('/frontend/home/images/loading.gif') }}" /></div>
							<div class="notice success">Thông tin đã gửi thành công!</div>
							<div class="notice error">Lỗi! Không gửi được thông tin!</div>
							<form name="appForm" id="appForm" method="post" action="" enctype="multipart/form-data">
                                <select name="service" id="service" class="form-control" class=" btn-filter" >
									{% if list_option is defined and list_option|length > 0%}
										{% for item in list_option %}
											<option value="{{item.title}}">{{item.title}}</option>
										{% endfor %}
									{% endif %}
								</select>
								<input type="text"  class="colum-2" name="fullname"  placeholder="Họ tên"/>
								<input type="text"  class="colum-2" name="phone"  placeholder="Điện thoại">
								<input type="text"  class="colum-2" name="from_email"  placeholder="Email"/>
								<input type="text"  class="colum-2" name="date" data-provide="datepicker"  placeholder="Ngày hẹn"/>
								<input type="text"  class="colum-2" name="time"  data-provide="timepicker"   placeholder="Giờ hẹn"/>
								<a class="button send" title="Gửi yêu cầu!" href="javascript:void(0)">Đặt lịch tư vấn!</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(".contact-form .form a.send").click(function() {
			var param = new Object();
			
			form 			= ".contact-form .form";
			param.fullname  = $(form+ ' input[name="fullname"]').val();
			param.phone 	= $(form+ ' input[name="phone"]').val();
			param.date 	  = $(form+ ' input[name="date"]').val();
			param.time 	  = $(form+ ' input[name="time"]').val();
			param.from_email  = $(form+ ' input[name="from_email"]').val();
			param.department_title = $(form+ ' select option:selected').val();
			book(form, param);
		});
		
	</script>
</div>


