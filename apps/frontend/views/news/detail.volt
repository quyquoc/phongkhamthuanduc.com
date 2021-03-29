<div id="news-detail" class="page-news detail">	
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

	<div class="main-content news news-detail">
		<div class="container">
			<div class="module">
				{#<div class="module-header">
					<h1 class="module-title"><span>{{category_title}}</span></h1>
				</div>#}
				<h1 class="title">{{ article.title }}</h1>
				<div class="social-date">
					<div class="fblike">
						<div class="fb-like" data-href="{{ url('/' ~ article.category_code ~ '/' ~ article.code) }}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
						<div class="fb-send" data-href="{{ url('/' ~ article.category_code ~ '/' ~ article.code) }}"></div>
					</div>
					<span class="published">{{ date('d-m-Y', strtotime(article.published)) }}</span>
				</div>
				
				<div class="module-content">
					<div class="item">
						<div class="content-detail">
							<div class="description">{{ article.description }}</div>
							<div class="content">{{ article.content }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>

	{% if list_relative is defined and list_relative is not empty %}
		<div class="box box-relative">
			<div class="container">	
				<div class="box-header left"><h1 class="box-title">Tin liên quan</h1></div>
				<div class="box-body news news-list">
					<div class="module-content">
						{% for item in list_relative %}
							{% if loop.index <= 12 %}
								{% if item.link is not empty %}
									{% set link = item.link %}
								{% else %}
									{% set link = url('/' ~ item.category_code ~ '/' ~ item.code) %}
								{% endif %}

								{% set link_img = item.image is not empty ? url(item.image) : assets ~ '/images/no-image.jpg' %}

								{{ partial('news/item') }}
							{% endif %}
						{% endfor %}
					</div>
					{% if list_relative is defined and list_relative|length >= 12 %}
						<div class="more">
							<div class="loading"><img src="{{ assets }}/images/loading.gif" ></div>
							<div class="readmore"><a href="javascript:void(0);" class="button">Xem thêm</a></div>
						</div>
					{% endif %}
				</div>
			</div>
		</div>

		<script>
			$('.box-relative .news-list .more a').click(function(){

				$('.more .loading').fadeIn('fast');
				$('.more .readmore').fadeOut('fast');

				var num_items 		= $('.box-relative .news-list .module-content .item').length;		
				var category_code = "{{ article.category_code is defined ? article.category_code : '' }}";       
				var uri 					= "{{ url('/news/addItem') }}";
		    var param = new Object();
		        param.offset    		= num_items;
		        param.category_code = category_code;

				$.get(uri, param).done(function(data){
					$('.more .loading').fadeOut('fast');
					$('.more .readmore').fadeIn('fast');
					$('.box-relative .news-list .module-content').append(data);

					var num_items_new = $('.box-relative .news-list .module-content .item').length;
					if((num_items + 12) != num_items_new){
						$('.box-relative .news-list .more').hide();
					}
				});
			});
		</script>
	{% endif %}
</div>
