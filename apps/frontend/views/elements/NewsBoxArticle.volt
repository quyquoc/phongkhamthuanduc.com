
{% if list_article is defined and list_article|length > 0 %}
	<div class="section box box-news{{ options['type'] is defined ? ' ' ~ options['type'] : ''}}">
	  <div class="container">
		  <div class="container-wrapper">
		  	<div class="box-header"><h1 class="box-title">{{ title }}</h1></div>
				<div class="news news-list">
					<div class="module-content">
						{% for item in list_article %}

							{% set link 				= url('/' ~  item.news_category.code ~ '/' ~ item.code) %}
							{% set link_img 		= item.image is not empty ? url(item.image) : assets ~ '/images/no-image.jpg' %}
							{% set style 				= 'column' %}
							
							{{ partial('news/item') }}
						{% endfor %}
					</div>
				</div>
		  </div>
	  </div>
	  <script>
		  $('.box-news .module-content').slick({
			dot:false,
			arrows:false,
			autoplay: true,
			slidesToShow: 4,
			slidesToScroll: 2,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 2,
					}
				},
				{
					breakpoint: 700,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 400,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		  });
	  </script>
	</div>
{% endif %}
