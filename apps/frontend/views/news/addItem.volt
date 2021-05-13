
{% if appload is defined and appload|length > 0 %}
	{% for item in appload %}
		{% set link 				= url('/' ~ item.news_category.code ~ '/' ~ item.code) %}
		{% set link_img 		= item.image is not empty ? url(item.image) : assets ~ '/images/no-image.jpg' %}
		{{ partial('news/item') }}
	{% endfor %}
{% endif %}
