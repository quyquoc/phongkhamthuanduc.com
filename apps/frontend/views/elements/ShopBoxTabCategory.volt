
{% if menu_service is defined and menu_service is not empty %}
	<ul class="level1">
		{% for item in menu_service %}
			<li class="{{ menu_lv1 is defined and menu_lv1 == item.code ? 'active' : '' }}"><a href="{{ url('/dich-vu/' ~ item.code) }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{item.title}}</a></li>
		{% endfor %}
	</ul>
{% endif %}

<div class="box box-shop-show">
  <ul class="tab-row">
    <li class="tab _1">Bao cao su</li>
    <li class="tab _2">Gel bôi trơn</li>
    <li class="tab _3">Trị xuất tinh sớm</li>
    <li class="tab _4">Sextoys</li>
  </ul>                
  
  <span class="tab-content">
  	{% if list_products is defined and list_products is not empty %}
  		{% for item in list_products %}
        <div class="group {{loop.index}}">
        	{% if item is not empty %}
        		{% for item_1 in item %}
							<div class="item">
								{% if item_1.image is not empty %}
									<div class="image">
										{{link_to('/shop/' ~ item_1.shop_category.code.'/' ~ item_1.code, '<img src="' ~ url() ~ item_1.image ~ '">')}}
									</div>
								{% endif %}
								<div class="title">
									<h3>{{link_to('/shop/' ~ item_1.shop_category.code.'/' ~ item_1.code, factory.getCutString(item_1.title, 100))}}</h3>
								</div>
								<div class="price">
									{% if item_1.saleoff is not empty and item_1.saleoff < item_1.price %}
										Giá: <span class="saleoff">{{number_format(item_1.saleoff)}} vnđ</span><span class="price_old">{{number_format(item_1.price)}} vnđ</span>
									{% else %}
										Giá: <span>{{number_format(item_1.price)}} vnđ</span>
									{% endif %}
								</div>
								<div class="cart">
									{{ link_to('/shop/mua-hang/' ~ item_1.id, 'Mua hàng') }}
								</div>
							</div>
            {% endfor %}
            <div class="clear"></div>
            <div class="readmore">{{link_to('/shop/' ~ arr_category_code[loop.index], '<< Xem thêm >>')}}</div>
          {% else %}
            <div style="text-align: center; padding:20px 0;">Đang cập nhật dữ liệu</div>
          {% endif %}
        </div>
      {% endfor %}
    {% endif %}
  </span>
</div>

<script type="text/javascript">
  $(document).ready(function (){
    $(".shop.shop-show ul li:first").addClass("active");
    $(".shop.shop-show div.group:gt(0)").hide();
    $(".shop.shop-show ul li").click(function(){
      $(".shop.shop-show ul li").removeClass('active');
      //var current_index = $(this).index(); // Sử dụng cho jQuery >= 1.4.x
      var current_index = $(".shop.shop-show ul li").index(this);
      $(".shop.shop-show ul li:eq("+current_index+")").addClass("active");
      $(".shop.shop-show div.group").hide();
      $(".shop.shop-show div.group:eq("+current_index+")").show();
    });
  });       
</script>

