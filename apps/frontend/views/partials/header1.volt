<header class="{{ page is defined ? page : '' }}">
	<div class="header">
		<div class="container">
			<div class="container-wrapper">
				<div class="logo">
					<a href="{{ url() }}"><img src="{{ url('/logo_v.svg') }}" /></a>
				</div>
				<div class="main_menu">
					{{ partial('partials/menu') }}
				</div>
			</div>
		</div>
	</div>
</header>

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
