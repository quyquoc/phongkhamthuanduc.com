
{% if list_article is defined and list_article|length > 0 %}
	<div class="section box box-news{{ options['type'] is defined ? ' ' ~ options['type'] : ''}}">
	  <div class="container">
		  <div class="container-wrapper">
		  	<div class="box-header"><h1 class="box-title">{{ title }}</h1></div>
				<div class="news news-list">
					<div class="module-content">
						{% for item in list_article %}

							{% set link 				= url('/' ~ item.category_code ~ '/' ~ item.code) %}
							{% set link_img 		= item.image is not empty ? url(item.image) : assets ~ '/images/no-image.jpg' %}
							{% set style 				= 'column' %}
							
							{{ partial('news/item') }}
						{% endfor %}
					</div>
				</div>
		  </div>
	  </div>
	</div>
{% endif %}
