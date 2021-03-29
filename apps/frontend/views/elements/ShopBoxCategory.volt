{% if arr_category is defined and arr_category|length > 0 %}
	<div class="box box-shop-category">
		{% for item_category in arr_category %}
			<ul>
				<li class="{{ category_parent is defined and item_category['code'] == category_parent.code ? 'active' : '' }}">
					<a href="{{ url('/san-pham/' ~ item_category['code']) }}">{{ item_category['title'] }}</a>
					{% if item_category['sub_category'] is defined and item_category['sub_category']|length > 0 %}
						<ul class="">
						{% for item in item_category['sub_category'] %}
							<li class="{{ category is defined and item.code == category.code ? 'active' : '' }}">
								<a href="{{ url('/san-pham/' ~ item.code) }}">{{ item.title }}</a>
							</li>
						{% endfor %}
						</ul>
					{% endif %}
				</li>
			</ul>
		{% endfor %}
	</div>
{% endif %}
