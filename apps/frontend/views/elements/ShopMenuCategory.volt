
{% if list_menu is defined and list_menu is not empty %}
	{% if parents is defined and parents == 0 %}
		<ul class="level1 submenu_inner">
			{% for item in list_menu %}
				<li class="submenu">
					<span class="mm-image">
						<img src="{{ url(item.image) }}" alt="">
					</span>
					<a href="{{ url('/san-pham/'~item.code) }}" class="{{item.title}}">{{item.title}}</a>
					{{ element.ShopMenuCategoryWithParents(item.id) }}
				</li>
			{% endfor %}
		</ul>
	{% else %}
		<ul class="submenu_level">
			{% for item in list_menu %}
				<li class="{{menu_level1 is defined and menu_level1 == item.code ? 'active' : ''}}">
					<a href="{{ url('/san-pham/'~item.code) }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{item.title}}</a>
				</li>
			{% endfor %}
		</ul>
	{% endif %}
{% endif %}
