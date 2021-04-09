<div class="box box-contact">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-body">
				<div class="inner">
					<div class="section contact-form" data-aos="fade-left">
                        <div class="box-header" data-aos="fade-up">
                            <h1 class="box-title text-left">Liên hệ tư vấn</h1>
                        </div>
						<div class="form">
							<div id="loading"><img src="{{ url('/frontend/home/images/loading.gif') }}" /></div>
							<div class="notice success">Thông tin đã gửi thành công!</div>
							<div class="notice error">Lỗi! Không gửi được thông tin!</div>
							<form name="appForm" id="appForm" method="post" action="" enctype="multipart/form-data">
                                <select name="service" id="service" class="form-control" class=" btn-filter"  placeholder="Dịch vụ cần tư vấn">
                                    <option value="Thiết kế Website">Thiết kế Website</option>
                                    <option value="Marketing Online">Marketing Online</option>
                                    <option value="Tìm kiếm phòng trọ">Tìm kiếm phòng trọ</option>
                                    <option value="Đăng tin bất động sản">Đăng tin bất động sản</option>
								</select>
								<input type="text"  class="colum-2" name="fullname"  placeholder="Họ tên"/>
								<input type="text"  class="colum-2" name="phone"  placeholder="Điện thoại">
								<input type="text"  class="colum-2" name="from_email"  placeholder="Email"/>
								<input type="text"  class="colum-2" name="day"  placeholder="Ngày hẹn"/>
								<input type="text"  class="colum-2" name="hour"  placeholder="Giờ hẹn"/>
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
			
			form 			  = ".contact-form .form";
			param.page_id    = $(form+ ' input[name="page_id"]').val();
			param.fullname    = $(form+ ' input[name="fullname"]').val();
			param.phone 	  = $(form+ ' input[name="phone"]').val();
			param.from_email  = $(form+ ' input[name="from_email"]').val();
			param.service  	  = $(form+ ' input[name="service"]').val();
			param.content  	  = $(form+ ' textarea[name="content"]').val();
			register(form, param);
		});
		
	</script>
</div>


