<div id="clinic" >
	<div class="container">
		<div class="section container-wrapper">
			<div class="box-header">
				<h1 class="box-title"><span>Chuyên khoa</span> </h1>
				<p>{{Ohi.sysConfig('gioi-thieu-chuyen-khoa',true)}}</p>
			</div>
			<div class=" clinic clinic-list">
				<div class="modulecontent">
					{% if list_depart is defined and list_depart is not empty %}
						<ul id="da-thumbs" class="da-thumbs">
							{% for item in list_depart %}
								<li class="item wow zoomIn" data-type="image">
									<div class="img">
										<a class="image" href="{{ url('/chuyen-khoa/'~item.code) }}" style="background-image: url('{{ item.image is not empty ? url(item.image) : assets ~'/images/img-contact.jpg'}}')">
										</a>
									</div>
									<a class="overlay" href="{{ url('/chuyen-khoa/'~item.code) }}"> {{item.title}}
									</a>
								</li>
							{% endfor %}
						</ul>
					{% endif %}
				</div>
			</div>
		</div>
	</div>
</div>