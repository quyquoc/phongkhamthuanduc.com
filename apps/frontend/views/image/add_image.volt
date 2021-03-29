
{% if list is defined and list|length > 0 %}
	{% for item in list %}
		<div class="item" data-aos="fade-up">
			<a class="read_more frm-product" data-fancybox="group-image-{{ item.id }}" href="{{ url(item.image) }}">
				<div class="image" style="background-image:url('{{ url(item.image) }}')">
					<div class="overlay">
						<div class="detail">
							<p class="title">Xem thêm</p>
						</div>
					</div>
				</div>
				{% if item.imgs is defined and item.imgs is not empty and item.imgs != '[]' %}
					<div class="hidden">
						<?php 
							$imgs = json_decode($item->imgs);
							if (count($imgs)>0){
								foreach ($imgs as $key => $value) {
									if ($value->default != 1) {
										echo '<p class="fancybox" data-fancybox="group-image-'.$item->id.'" href="'.$this->url->get($value->src).'" title="'.$item->title.'"></p>';
									}
								}
							}
						?>
					</div>
				{% endif %}
				<p class="title"><span>{{ item.title }}</span><i>(<?= !empty($item->imgs) ? count($imgs) : 1 ?> hình)</i></p>
			</a>
		</div>
	{% endfor %}
	
	<script>is_load = 'load';</script>
{% endif %}