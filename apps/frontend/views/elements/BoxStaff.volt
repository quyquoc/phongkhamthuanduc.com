
{% if list_staff_1 is defined and list_staff_1 is not empty %}
	<div class="section box box-staff founder">
		<div class="container">
			<div class="box-header"><h1 class="box-title">Đội ngũ sáng lập</h1></div>
			<div class="container-wrapper">
				<div class="box-body">
					{% for item in list_staff_1 %}
					  <div class="item wow fadeInUp">
				      <div class="wrap">
					      <div class="wrap-inner">
					        <div class="image" style="background-image:url('{{ url(item.image) }}');"></div>
					        <div class="person_info">
				            <div class="name">{{ item.title }} </span><span>{{ item.fullname }}</span></div>
				            <div class="position">{{ item.staff_position }}</div>
				          </div>
				        </div>
			          <div class="subject">{{ item.subject }}</div>
			          {% if item.phone is not empty or item.email is not empty or item.facebook is not empty %}
				          <div class="staff-contact">
				          	{% if item.phone is not empty %}
				          		<a href="tel:{{ item.phone }}" class="item-contact phone"><i class="fa fa-mobile"></i></a>
				          	{% endif %}
				          	{% if item.email is not empty %}
				          		<a href="mailto:{{ item.email }}" class="item-contact email"><i class="fa fa-envelope"></i></a>
				          	{% endif %}
				          	{% if item.facebook is not empty %}
				          		<a href="{{ item.facebook }}" target="_blank" class="item-contact facebook"><i class="fa fa-facebook-square"></i></a>
				          	{% endif %}
				          </div>
			          {% endif %}
				      </div>
					  </div>
					{% endfor %}
				</div>
			</div>
		</div>
	</div>
{% endif %}

{% if list_staff_2 is defined and list_staff_2 is not empty %}
	<div class="section box box-staff staff">
		<div class="container">
			<div class="box-header"><h1 class="box-title">Đội ngũ cố vấn</h1></div>
			<div class="container-wrapper">
				<div class="box-body">
					{% for item in list_staff_2 %}
					  <div class="item wow fadeInUp">
				      <div class="wrap">
					      <div class="wrap-inner">
					        <div class="image" style="background-image:url('{{ url(item.image) }}');"></div>
					        <div class="person_info">
				            <div class="name">{{ item.title }} </span><span>{{ item.fullname }}</span></div>
				            <div class="position">{{ item.staff_position }}</div>
				          </div>
				        </div>
			          <div class="subject">{{ item.subject }}</div>
			          {% if item.phone is not empty or item.email is not empty or item.facebook is not empty %}
				          <div class="staff-contact">
				          	{% if item.phone is not empty %}
				          		<a href="tel:{{ item.phone }}" class="item-contact phone"><i class="fa fa-mobile"></i></a>
				          	{% endif %}
				          	{% if item.email is not empty %}
				          		<a href="mailto:{{ item.email }}" class="item-contact email"><i class="fa fa-envelope"></i></a>
				          	{% endif %}
				          	{% if item.facebook is not empty %}
				          		<a href="{{ item.facebook }}" target="_blank" class="item-contact facebook"><i class="fa fa-facebook-square"></i></a>
				          	{% endif %}
				          </div>
			          {% endif %}
				      </div>
					  </div>
					{% endfor %}
				</div>
			</div>
		</div>
	</div>
{% endif %}

{% if list_staff_3 is defined and list_staff_3 is not empty %}
	<div class="section box box-staff staff">
		<div class="container">
			<div class="box-header"><h1 class="box-title">Ban tư vấn</h1></div>
			<div class="container-wrapper">
				<div class="box-body">
					{% for item in list_staff_3 %}
					  <div class="item wow fadeInUp">
				      <div class="wrap">
					      <div class="wrap-inner">
					        <div class="image" style="background-image:url('{{ url(item.image) }}');"></div>
					        <div class="person_info">
				            <div class="name">{{ item.title }} </span><span>{{ item.fullname }}</span></div>
				            <div class="position">{{ item.staff_position }}</div>
				          </div>
				        </div>
			          <div class="subject">{{ item.subject }}</div>
			          {% if item.phone is not empty or item.email is not empty or item.facebook is not empty %}
				          <div class="staff-contact">
				          	{% if item.phone is not empty %}
				          		<a href="tel:{{ item.phone }}" class="item-contact phone"><i class="fa fa-mobile"></i></a>
				          	{% endif %}
				          	{% if item.email is not empty %}
				          		<a href="mailto:{{ item.email }}" class="item-contact email"><i class="fa fa-envelope"></i></a>
				          	{% endif %}
				          	{% if item.facebook is not empty %}
				          		<a href="{{ item.facebook }}" target="_blank" class="item-contact facebook"><i class="fa fa-facebook-square"></i></a>
				          	{% endif %}
				          </div>
			          {% endif %}
				      </div>
					  </div>
					{% endfor %}
				</div>
			</div>
		</div>
	</div>
{% endif %}