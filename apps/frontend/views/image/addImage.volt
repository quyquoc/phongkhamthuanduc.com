
{% if gallery is defined and gallery|length > 0 %}
{% for item in gallery %}
	<li class="item wow zoomIn" data-type="image">
		<div class="image" style="background-image: url('{{url(item.image)}}')">
			{% if item.imgs is not empty and item.imgs != '[]' %}
			{% set images = item.imgs | json_decode %}
			{% set count_image = images|length - 1 %}
			<a class="overlay" data-fancybox="group-image-{{ item.id }}" href="{{ url(item.image) }}"> xem thêm {{count_image}} ảnh
				<div class="hidden">
					{% for item_1 in images %}
						{% if item_1.default != 1 %}
							<p class="fancybox" href="{{url(item_1.src)}}" data-fancybox="group-image-{{ item.id }}" data-fancybox 
							data-width="1500" data-height="1000"
							data-thumb="{{url(item_1.src)}}" >
							</p>
						{% endif %}
					{% endfor %}
				</div>
			</a>
			{% endif %}

		</div>
	</li>
{% endfor %}
{% endif %}