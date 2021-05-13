<div id="news-detail" class="detail-about">
	{{ partial("partials/boxes/BoxAbout") }}
	{{ partial('partials/boxes/BoxColumn_2x2') }}
	{% if certificate is defined and certificate | length > 0 %}
		<div class="section gallery gallery-list">
			<div class="container">
				<div class="box-header"><div class="box-title">Văn bằng và chứng chỉ</div></div>
				<div class="modulecontent">
					
						<ul id="da-thumbs" class="da-thumbs">
							{% for item in certificate %}
								<li class="item wow zoomIn" data-type="image">
									<a class="image" data-fancybox="group-image-{{ item.id }}" href="{{ url(item.image) }}" style="background-image: url('{{url(item.image)}}')">
									</a>
								</li>
							{% endfor %}
						</ul>
					
				</div>
			</div>
		</div>
	{% endif %}
	{{ element.BoxContact() }}
</div>
