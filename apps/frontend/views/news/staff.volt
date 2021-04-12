
	<div class="section box box-column-1x3 page-staff">
		<div class="container">
			<div class="box-header wow fadeInUp">
				<h1 class="box-title">Đội ngũ bác sĩ</h1>
			</div>
			{% if arr_category and arr_category | length > 0 %}
				{% for item in arr_category %}
					<h1 class="box-title-2 text-left">{{item['title']}}</h1>
					<div class="box-body">
						<div class="inner">
						{% if item['list_staff'] and item['list_staff'] | length > 0 %}
							{% for item_p in item['list_staff'] %}
								<div class="item wow fadeInUp">
									<div class="content">
										<p>{{ item_p.title }}</p>
										<h3 class="title">{{ item_p.fullname }}</h3>
										{% if item_p.type_id == '1' %}
											<p classs="f-14">Giám đốc trung tâm</p>
										{% else %}
											<p classs="f-14">{{item_p.manager=='1'? 'Trưởng khoa': 'Chuyên khoa'}} {# item_p.depart.title #}</p>
										{% endif %}
										<div class="description"> 
											{% if item.phone is not empty %}
												<a href="tel:{{item_p.phone}}"><i class="fa fa-phone"></i></a>
											{% endif %}
											{% if item_p.email is not empty %}
											<a href="mailto:{{item_p.email}}"><i class="fa fa-envelope"></i></a>
											{% endif %}
										</div>
									</div>
								</div>
							{% endfor %}
						{% endif %}
						</div>
					</div>
				{% endfor %}
			{% endif %}
		</div>
	</div>

