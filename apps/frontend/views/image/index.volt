<div id="gallery" >
	<div class="container">
		<div class="section container-wrapper">
			<div class="box-header">
				<h1 class="box-title"><span>Thư viện</span> </h1>
			</div>
			<div class="gallery gallery-list">
				<div class="modulecontent">
					{% if gallery is defined and gallery is not empty %}
						<ul id="da-thumbs" class="da-thumbs">
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
						</ul>
					{% endif %}
				</div>
				{% if gallery is defined and gallery | length < gallery_count %}
				<div class="more">
					<div class="loading"><img src="{{ assets }}/images/loading.gif" ></div>
					<div class="readmore"><a href="javasceipt:void(0);" class="button">Xem thêm</a></div>
				</div>
				
				{% endif %}
			</div>
		</div>
	</div>
</div>
<script>
	$('#gallery a.button').click(function(){
		var num_items 	= $('#gallery #da-thumbs .item').length;		
		var album_id = "{{ album is defined ? album.id : '' }}";       
		var uri 		= "{{ url('/add_image') }}";
		$.ajax({
			url: uri ,
			data:{ offset: num_items ,album_id : album_id},
			success: resp => {
				if(resp && resp.toString().trim() !==''){
					$('.more .loading').fadeOut('fast');
					$('.more .readmore').fadeIn('fast');
					$('#gallery #da-thumbs ').append(resp);
					var num_items_new = $('#gallery #da-thumbs .item').length; 
					if( (num_items_new - num_items) < 6)  {
						$('.more').hide();
					}else{
						$('.more ').show();
					}
				} else {
					$('.more .loading').fadeOut('fast');
					$('.more ').hide();
				}				
			}
		})
	});
</script>