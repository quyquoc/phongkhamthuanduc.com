<div id="news-detail" class="page-news detail">	
	<div class="section main-content news news-detail">
		<div class="container">
			<div class="module">
				<div class="box-header"><h1 class="box-title">{{ article.title }}</h1></div>
				{% if category.code != 'gioi-thieu' %}
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
	{% if category.code != 'gioi-thieu' %}
		{% if list_relative is defined and list_relative is not empty %}
			<div class="box box-relative">
				<div class="container">	
					<div class="box-header left"><h1 class="box-title">Tin liên quan</h1></div>
					<div class="box-body news news-list">
						<div class="module-content">
							{% for item in list_relative %}
								{% set link 				= url('/' ~ category.code ~ '/' ~ item.code) %}
								{% set link_img 		= item.image is not empty ? url(item.image) : assets ~ '/images/no-image.jpg' %}
								{{ partial('news/item') }}
							{% endfor %}
						</div>
						{% if list_relative is defined and list_relative|length < count_item %}
							<div class="more">
								<div class="loading"><img src="{{ assets }}/images/loading.gif" ></div>
								<div class="readmore"><a href="javascript:void(0);" class="add">Xem thêm <img src="{{assets}}/images/icon-down-color.svg" alt=""></a></div>
							</div>
						{% endif %}
					</div>
				</div>
			</div>
		{% endif %}
	{% endif %}
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
{% if arr_category is defined and arr_category | length > 0 %}
	<div class="section box box-column-1x3 page-staff">
		<div class="container">
			<div class="box-header wow fadeInUp">
				<h1 class="box-title">Đội ngũ bác sĩ</h1>
			</div>
				{% for item in arr_category %}
					<h1 class="box-title-2 text-left">{{item['title']}}</h1>
					<div class="box-body">
						<div class="inner">
						{% if item['list_staff'] and item['list_staff'] | length > 0 %}
							{% for item_p in item['list_staff'] %}
								<div class="item wow fadeInUp">
									<div class="content">
										<p>{{ item_p.title }}</p>
										<h3 class="title">{{ item_p.fullname }}</h3>
										{% if item_p.type_id == '1' %}
											<p classs="f-14">Giám đốc trung tâm</p>
										{% else %}
											<p classs="f-14">{{item_p.manager=='1'? 'Trưởng khoa': 'Chuyên khoa'}} {# item_p.depart.title #}</p>
										{% endif %}
										<div class="description"> 
											{% if item.phone is not empty %}
												<a href="tel:{{item_p.phone}}"><i class="fa fa-phone"></i></a>
											{% endif %}
											{% if item_p.email is not empty %}
											<a href="mailto:{{item_p.email}}"><i class="fa fa-envelope"></i></a>
											{% endif %}
										</div>
									</div>
								</div>
							{% endfor %}
						{% endif %}
						</div>
					</div>
				{% endfor %}
		</div>
	</div>
{% endif %}