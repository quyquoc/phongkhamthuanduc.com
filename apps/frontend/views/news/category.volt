<div id="news-category" class="page-news category {{category.code}}">

  <div class="section main-content news news-list {{category.code}}">
	<div class="box-header"><div class="box-title">{{ category.title }}</div></div>
		<div class="container">
			<div class="module">
				{#<div class="module-header">
					<h1 class="module-title"><span>{{category.title}}</span></h1>
				</div>#}
				<div class="module-content">
					{% if list_item is defined and list_item|length > 0 %}
						{% for item in list_item %}
							{% if loop.index <= 12 %}

								{% set link 				= url('/' ~ category.code ~ '/' ~ item.code) %}
								{% set link_img 		= item.image is not empty ? url(item.image) : assets ~ '/images/no-image.jpg' %}
								{{ partial('news/item') }}
							{% endif %}
						{% endfor %}
					{% endif %}
				</div>

				{% if list_item is defined and list_item|length > 12 %}
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

		$('.more .loading').fadeIn('fast');
		$('.more .readmore').fadeOut('fast');

		var num_items 		= $('.news-list .module-content .item').length;		
		var category_code = "{{ category_code is defined ? category_code : '' }}";       
		var uri 					= "{{ url('/news/addItem') }}";
    var param = new Object();
        param.offset    		= num_items;
        param.category_code = category_code;

		$.get(uri, param).done(function(data){
			$('.more .loading').fadeOut('fast');
			$('.more .readmore').fadeIn('fast');
			$('.news-list .module-content').append(data);

			var num_items_new = $('.news-list .module-content .item').length;
			if((num_items + 12) != num_items_new){
				$('.news-list .more').hide();
			}
		});
	});
</script>
</div>
