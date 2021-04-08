
{% if list_staff is defined and list_staff is not empty %}
	<div class="section box box-column-1x3">
		<div class="container">
			<div class="box-header wow fadeInUp">
				<h1 class="box-title text-left">Đội ngũ của chúng tôi</h1>
			</div>
			<div class="box-body">
				<div class="inner">
					{% for item in list_staff %}
					<div class="item wow fadeInUp">
						<div class="content">
							<p>{{ item.title }}</p>
							<h3 class="title">{{ item.fullname }}</h3>
							<p classs="f-14">{{ item.staff_position }}</p>
							<div class="description"> 
								{% if item.phone is not empty %}
									<a href="tel:{{item.phone}}"><i class="fa fa-phone"></i></a>
								{% endif %}
								{% if item.email is not empty %}
								<a href="mailto:{{item.email}}"><i class="fa fa-envelope"></i></a>
								{% endif %}
							</div>
						</div>
					</div>
					{% endfor %}
				</div>
			</div>
		</div>
	</div>
{% endif %}

