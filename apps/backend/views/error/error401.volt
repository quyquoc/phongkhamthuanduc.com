
<div class="content-wrapper">
	<section class="content-header">
		{% if flashSession.output() %}
			{{ flashSession.output() }}
		{% endif %}
	</section>
	<section class="content">
		<div class="col-md-12">
			<div class="col-middle">
				<div class="text-center text-center">
					<h1 class="error-number">401</h1>
					<h2>Bạn không được cấp quyền sử dụng chức năng này</h2>
					<div class="mid_center">
						<p>Vui lòng liên hệ Admin hệ thống để được cấp quyền sử dụng</p>
						<p>Quay lại <a href="{{ url(define.backend) }}">Trang chủ</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
