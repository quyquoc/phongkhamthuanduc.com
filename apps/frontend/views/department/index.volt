<div id="clinic" >
	<div class="container">
		<div class="section container-wrapper">
			<div class="box-header">
				<h1 class="box-title text-left"><span>Chuyên khoa</span> </h1>
				<p>Các khoa của bệnh viện chúng tôi</p>
			</div>
			<div class=" clinic clinic-list">
				<div class="modulecontent">
					{% if list_depart is defined and list_depart is not empty %}
						<ul id="da-thumbs" class="da-thumbs">
							{% for item in list_depart %}
								<li class="item wow zoomIn" data-type="image">
									<div class="image" style="background-image: url('{{url(item.image)}}')">
										<a class="overlay"href="{{ url('/chuyen-khoa/'~item.code) }}"> {{item.title}}
											
										</a>
									</div>
								</li>
							{% endfor %}
						</ul>
					{% endif %}
				</div>
			</div>
		</div>
	</div>
</div>