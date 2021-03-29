
{% if list_item is defined and list_item|length > 0 %}
	{% for item in list_item %}

		{% set link 				= url('/' ~ item.category_code ~ '/' ~ item.code) %}
		{% set link_img 		= item.image is not empty ? url(item.image) : assets ~ '/images/no-image.jpg' %}

		{{ partial('news/item') }}
	{% endfor %}
{% endif %}
