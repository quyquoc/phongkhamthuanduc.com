
{% if list_menu is defined and list_menu is not empty %}
	<ul class="level1">
		{% if option is defined and option == 'huong-dan' %}
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'kham-bao-hiem-y-te' ? 'active' : '' }}"><a href="{{ url('/dich-vu/kham-bao-hiem-y-te') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Quy trình và thủ tục</a></li>
		{% endif %}
		{% for item in list_menu %}
			<li class="{{ menu_lv1 is defined and menu_lv1 == item.code ? 'active' : '' }}"><a href="{{ url('/'~ option ~ '/' ~ item.code) }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ item.title }}</a></li>
		{% endfor %}
  </ul> 
{% endif %}