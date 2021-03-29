
{% if list_item is defined and list_item|length > 0 %}
	<div class="section box box-product{{ options['type'] is defined ? ' ' ~ options['type'] : ''}}">
	  <div class="container">
		  <div class="container-wrapper">
		  	<div class="box-header"><h1 class="box-title">{{ title }}</h1></div>
				<div class="box-body shop shop-list">
					<div class="module-content">
            {% for item in list_item %}
              {{ partial('shop/item') }}
            {% endfor %}
					</div>
					<a class="button" href="{{ url('/san-pham') }}">Xem thêm sản phẩm</a>
				</div>
		  </div>
	  </div>
	</div>
{% endif %}