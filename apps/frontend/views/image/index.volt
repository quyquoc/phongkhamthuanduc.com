<section id="gallery" class="section-gallery">
	{#<div class="breadcrumbs">
		<div class="container">
			<div class="content">
				<span class="item"><a href="{{ url() }}" title="Trang chủ">Trang chủ</a></span>
				<span class="item_sep"> / </span>
				<span class="item"><a href="{{ url('/thu-vien') }}" title="Thư viện">Thư viện</a></span>
			</div>
		</div>
	</div>#}

	<div class="gallery gallery-list">
		<div class="container">
			<div class="module">
        <div class="box-filter">
        	<div class="unit active" data-type="all">Tất cả</div>
        	<div class="unit" data-type="image">Hình ảnh</div>
        	<div class="unit" data-type="video">Video - Clip</div>
        </div>
				<div class="modulecontent">
					{% if gallery is defined and gallery is not empty %}
						<ul id="da-thumbs" class="da-thumbs">
							{% for item in gallery %}
								{% if item.album_id == 2 %}
									<li class="item wow zoomIn" data-type="image">
										<a class="read_more" data-fancybox="group-image-{{ item.id }}" href="{{ url(item.image) }}" style="background-image: url('{{url(item.image)}}')">
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
											<div class="overlay"><span>Xem thêm</span><span><?= !empty($item->imgs) ? count($imgs) : 1 ?> hình ảnh</span></div>
										</a>
										<div class="title">{{ item.title }}</div>
									</li>
								{% elseif item.album_id == 3 %}
									<li class="item" data-type="video">
										<a class="video-cover" data-fancybox href="{{ item.link }}" style="background-image: url('{{url(item.image)}}')">
											<span class="icon"></span>
											<div class="overlay"><span>Xem video</span></div>
										</a>
										<div class="title">{{ item.title }}</div>
									</li>
								{% endif %}
							{% endfor %}
						</ul>
					{% endif %}
				</div>
				{% if gallery is defined and gallery|length == 6 %}
					<div class="more">
						<div class="loading"><img src="{{ assets }}/images/loading.gif" /></div>
						<div class="readmore"><a href="javascript:void(0);">Xem thêm</a></div>
					</div>
				{% endif %}
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function(){
		$('[data-fancybox="group-image"]').fancybox({
			loop    : true,
			thumbs  : {
					autoStart : true
			},
			buttons : ['zoom', 'close']
		});

		$('.box-filter .unit').on('click', function() {

			$('.box-filter .unit').removeClass('active');
			$(this).addClass('active');

			var type = $(this).data('type');
			if (type == 'video') {
				$('.gallery-list .modulecontent .item').filter('[data-type="video"]').fadeIn();
				$('.gallery-list .modulecontent .item').filter('[data-type="image"]').fadeOut();
			}else if (type == 'image') {
				$('.gallery-list .modulecontent .item').filter('[data-type="image"]').fadeIn();
				$('.gallery-list .modulecontent .item').filter('[data-type="video"]').fadeOut();
			}else {
				$('.gallery-list .modulecontent .item').fadeIn();
			}
		});

		$(function() {
			$('#da-thumbs > li').each( function() { $(this).hoverdir(); } );
		});
	});

	$('.gallery-list .more a').click(function(){

		$(this).parent().prev().fadeIn('fast');
		$('.more .readmore').fadeOut('fast');

		var uri 					= "{{ url('/add_image') }}";
		var num_items 		= $('#gallery .gallery-list .modulecontent ul .item').length;
		$.get(uri, {num_items: num_items}, function(data){
			$('.loading').fadeOut('fast');
			$('#gallery .gallery-list .modulecontent ul').append(data);
			$('#da-thumbs > li').each( function(){$(this).hoverdir();});

			var num_items_new = $('#gallery .gallery-list .modulecontent ul .item').length;
			if((num_items + 6) == num_items_new){
				$('.more .readmore').fadeIn('fast');
			}else{
				$('#gallery .more').hide();
			}
		});
	});
</script>