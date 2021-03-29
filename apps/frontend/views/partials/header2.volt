<header>
	<div class="header">
		<div class="container">
			<div class="container-wrapper">
				<div class="logo">
					<a href="{{ url() }}"><img src="{{url('/logo_h.png')}}"></a>
				</div>
				<div class="header_address">
					<div class="item_address">
						<div class="item_icon"><i class="fa fa-map-marker"></i></div>
						<div class="item_text">
							<h3>Địa chỉ</h3>
							<p>1/119 Hùng Vương, TP. Huế</p>
						</div>
					</div>
					<div class="item_address">
						<div class="item_icon"><i class="fa fa-mobile"></i></div>
						<div class="item_text">
							<h3>Hotline</h3>
							<p><a href="tel:0911067111">0911.067.111</a><span> - </span><a href="tel:08699882779">086.9988.279</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="main_menu">
	<div class="menu_inner">
		<div class="container">
			{{ partial('partials/menu') }}
			<div class="plugin-search">
				<form class="form_search" method="get" action="{{url('/san-pham/tim-kiem')}}">
					<label class="search_label">
						<input type="text" name="keyword" class="search_input" placeholder="Tìm nhanh sản phẩm" value="{{ keyword is defined ? keyword : '' }}">
						<input type="submit" class="button search_submit" value=""></input>
		    	</label>
				</form>
			</div>
			<a class="plugin-cart active" href="{{ url('/gio-hang') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
		</div>
	</div>
</div>

<div class="rd-menu">
	{{ partial('partials/sidemenu') }}
</div>

<div class="rd-panel">
	<button class="rd-panel_toggle"><span></span></button>
	<div class="logo">
		<a href="{{ url() }}">
			<img src="{{ url() }}/logo.png" />
			<img src="{{ url() }}/favicon.png" class="img_s"/>
		</a>
	</div>
	<div class="plugin-search">
		<form class="form_search" method="get" action="{{url('/san-pham/tim-kiem')}}">
			<label class="search_label">
				<input type="text" name="keyword" class="search_input" placeholder="Tìm nhanh sản phẩm" value="{{ keyword is defined ? keyword : '' }}">
				<input type="submit" class="button search_submit" value=""></input>
    	</label>
		</form>
	</div>
	<a class="plugin-cart" href="{{ url('/gio-hang') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
</div>
