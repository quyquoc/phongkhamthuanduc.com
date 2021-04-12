<div id="news-detail" class="detail-about">
	{{ partial("partials/boxes/BoxAbout") }}
	{{ partial('partials/boxes/BoxColumn_2x2') }}
	<div class="section gallery gallery-list">
		<div class="container">
			<div class="box-header"><div class="box-title text-left">Văn bằng và chứng chỉ</div></div>
			<div class="modulecontent">
				{% if certificate is defined and certificate is not empty %}
					<ul id="da-thumbs" class="da-thumbs">
						{% for item in certificate %}
							<li class="item wow zoomIn" data-type="image">
								<a class="image" data-fancybox="group-image-{{ item.id }}" href="{{ url(item.image) }}" style="background-image: url('{{url(item.image)}}')">
								</a>
							</li>
						{% endfor %}
					</ul>
				{% endif %}
			</div>
		</div>
	</div>
	{{ element.BoxContact() }}
</div>
