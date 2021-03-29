
{% set limit = options['limit'] is defined and options['limit'] > 0 ? options['limit'] : (list_item|length + 1) %}

{% for item in list_item %}
	{% if loop.index <= limit %}
		<div class="item wow fadeInUp">
			<div class="item-wrap">
				<div class="image-wrap">
					<div class="image" style="background-image:url('{{ url(item.image) }}');">
						<a href="{{ url('/san-pham/' ~ item.shop_category.code ~ '/' ~ item.code) }}">
							<img src="{{ url(item.image) }}" />
						</a>
						{#<div class="overlay"><a class="add_cart btn-buy-product button" onclick="clickCart(this, 1, '');" code="{{item.id}}" ref="{{ url(item.image) }}"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>Mua hàng</a></div>#}
					</div>
				</div>
				<h4 class="title"><a href="{{ url('/san-pham/' ~ item.shop_category.code ~ '/' ~ item.code) }}">{{ item.title }}</a></h4>
				<div class="price-wrap">
					{% if item.saleoff > 0 and item.price > item.saleoff %}
						<span class="price">{{number_format(item.saleoff) }} <sup>đ</sup></span>
						<span class="price init">{{ number_format(item.price) }} <sup>đ</sup></span>
					{% else %}
						<span class="price">{{ item.price != 0 ? number_format(item.price) ~ ' <sup>đ</sup>' : 'Liên hệ lấy giá' }}</span>
					{% endif %}
				</div>
				<a class="add_cart btn-buy-product button" onclick="clickCart(this, 1, '');" code="{{item.id}}" ref="{{ url(item.image) }}" href="javascript:void(0);"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>Mua hàng</a>
			</div>
		</div>
	{% endif %}
{% endfor %}