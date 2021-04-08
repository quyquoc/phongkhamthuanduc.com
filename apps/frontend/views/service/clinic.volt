<div id="clinic" >
	<div class="container">
		<div class="section container-wrapper">
			<div class="box-header">
				<h1 class="box-title text-left"><span>Chuyên khoa</span> </h1>
				<p>{{category.description}}</p>
			</div>
			<div class=" clinic clinic-list">
				<div class="modulecontent">
					{% if clinic is defined and clinic is not empty %}
						<ul id="da-thumbs" class="da-thumbs">
							{% for item in clinic %}
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