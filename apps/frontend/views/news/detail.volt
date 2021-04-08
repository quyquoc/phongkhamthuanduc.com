<div id="news-detail" class="page-news detail">	
	<div class="section main-content news news-detail">
		<div class="container">
			<div class="module">
				<div class="box-header"><h1 class="box-title">{{ article.title }}</h1></div>
				{% if article.code != 'kham-bao-hiem-y-te' %}
				<div class="social-date">
					<div class="fblike">
						<div class="fb-like" data-href="{{ url('/' ~ article.category_code ~ '/' ~ article.code) }}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
						<div class="fb-send" data-href="{{ url('/' ~ article.category_code ~ '/' ~ article.code) }}"></div>
					</div>
					<span class="published">{{ date('d-m-Y', strtotime(article.published)) }}</span>
				</div>
				{% endif %}
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
	{% if article.code != 'kham-bao-hiem-y-te' %}
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
	{% endif %}
</div>
