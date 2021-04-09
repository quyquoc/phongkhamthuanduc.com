<div id="news-category" class="page-news category {{category.code}}">

  <div class="section main-content news news-list {{category.code}}">
	<div class="box-header"><div class="box-title">{{ category.title }}</div></div>
		<div class="container">
			<div class="module">
				<div class="module-content">
					{% if list_item is defined and list_item|length > 0 %}
						{% for item in list_item %}
							{% set link 				= url('/' ~ category.code ~ '/' ~ item.code) %}
							{% set link_img 		= item.image is not empty ? url(item.image) : assets ~ '/images/no-image.jpg' %}
							{{ partial('news/item') }}
						{% endfor %}
					{% endif %}
				</div>
				{% if list_item is defined and list_item|length < count_item %}
					<div class="more">
						<div class="loading"><img src="{{ assets }}/images/loading.gif" ></div>
						<div class="readmore"><a href="javascript:void(0);" class="add">Xem thêm <img src="{{assets}}/images/icon-down-color.svg" alt=""></a></div>
					</div>
				{% endif %}
			</div>
		</div>
	</div>
</div>
<script>
	$('.news-list .more a').click(function(){
		var num_items 	= $('.news-list .module-content .item').length;		
		var category_id = "{{ category is defined ? category.id : '' }}";       
		var uri 		= "{{ url('/news/addItem') }}";
		$.ajax({
			url: uri ,
			data:{ offset: num_items ,category_id : category_id},
			success: resp => {
				if(resp && resp.toString().trim() !==''){
					$('.more .loading').fadeOut('fast');
					$('.more .readmore').fadeIn('fast');
					$('.news-list .module-content').append(resp);
					var num_items_new = $('.news-list .module-content .item').length; 
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
</div>
