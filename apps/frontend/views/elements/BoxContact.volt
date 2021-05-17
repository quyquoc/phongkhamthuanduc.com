<div id ="element" class="box box-contact">
	<div class="container-wrapper">
		<div class="box-body">
			<div class="inner">
				<div class="section contact-form" data-aos="fade-left">
					<div class="box-header" data-aos="fade-up">
						<h1 class="box-title">Đặt lịch hẹn</h1>
					</div>
					<div class="form">
						<div id="loading"><img src="{{ url('/frontend/home/images/loading.gif') }}" /></div>
						<div class="notice success">Thông tin đã gửi thành công!</div>
						<div class="notice error">Lỗi! Không gửi được thông tin!</div>
						<form name="appForm" id="appForm" method="post" action="" enctype="multipart/form-data">
							<select name="depart" id="depart" class="form-control" class=" btn-filter" >
								<option value="">Chuyên khoa</option>
								{% if list_depart is defined and list_depart|length > 0%}
									{% for item in list_depart %}
										<option value="{{item.title}}">{{item.title}}</option>
									{% endfor %}
								{% endif %}
							</select>
							<select name="doctor" id="doctor" class="form-control" class=" btn-filter" >
								<option value="">Chọn bác sĩ</option>
								{% if list_doctor is defined and list_doctor|length > 0%}
									{% for item in list_doctor %}
										<option value="{{item.fullname}}">{{item.fullname}}</option>
									{% endfor %}
								{% endif %}
							</select>
							<input type="text"  class="colum-2" name="fullname"  placeholder="Họ tên"/>
							<input type="text"  class="colum-2" name="phone"  placeholder="Điện thoại">
							<input type="text"  class="colum-2" name="from_email"  placeholder="Email"/>
							<input type="text"  class="colum-2" name="date" data-provide="datepicker"  placeholder="Ngày hẹn"/>
							<!-- <input type="text"  class="colum-2" name="time"  data-provide="timepicker"   placeholder="Giờ hẹn"/> -->
							<a class="button sended" title="Gửi yêu cầu!" href="javascript:void(0)">Đặt lịch tư vấn!</a>
						</form>
					</div>
				</div>
			</div>
			<div class="box-video">
				<iframe src="{{ Ohi.sysConfig('video-youtube',true,'link')}}" frameborder="0" allow="encrypted-media" allowfullscreen=""></iframe>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('#depart').on('change', function(e){
		$.ajax({
			url: '{{url()}}/filter',
			data:{
				depart: $('#depart option:selected').val(),
			},
				success: resp => {
					if(resp && resp.toString().trim() !==''){
						$('#doctor').html(resp);
					} 
				}
			})
	});
		$("#element .form a.sended").click(function() {
			var param = new Object();
			
			form 			= "#element .form";
			param.fullname  = $(form+ ' input[name="fullname"]').val();
			param.phone 	= $(form+ ' input[name="phone"]').val();
			param.date 	  = $(form+ ' input[name="date"]').val();
			param.time 	  = $(form+ ' input[name="time"]').val();
			param.from_email  = $(form+ ' input[name="from_email"]').val();
			param.department_title = $(form+ ' #depart option:selected').val();
			param.doctor_name = $(form+ ' #doctor option:selected').val();
			book(form, param);
		});
		
	</script>
</div>


