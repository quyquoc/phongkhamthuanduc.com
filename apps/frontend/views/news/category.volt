<div id="news-category" class="page-news category {{category.code}}">
	<div class="breadcrumbs brb-header">
	  <div class="container">
			<div class="container-wrapper">
				<div class="breadcrumbs-header">
					{{ category.title }}
				</div>
				<div class="breadcrumbs-nav">
					<span class="item"><a href="{{ url() }}" title="Trang chủ">Trang chủ</a></span>
					{% if category_parent is defined and category_parent is not empty %}
						<span class="item_sep"> / </span>
						<span class="item"><a href="{{ url('/' ~ category_parent.code) }}" title="{{category_parent.title}}">{{category_parent.title}}</a></span>
					{% endif %}
					{% if category is defined and category is not empty %}
						<span class="item_sep"> / </span>
						<span class="item">{{category.title}}</span>
					{% endif %}
				</div>
			</div>
		</div>
	</div>

  <div class="main-content news news-list {{category.code}}">
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
						<div class="readmore"><a href="javascript:void(0);" class="button">Xem thêm</a></div>
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

