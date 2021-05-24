<header class="{{ page is defined ? page : '' }}">
	<div class="top-head">
		<div class="container">
			<p>Phòng khám đa khoa Thuận Đức</p>
			<p><img src="{{assets}}/images/phone.svg" alt=""><a href="tel:02343833888"> 0234 3833 888</a><span>-</span><a href="tel:02343818184">0234 3818 184</a></p>
		</div>
	</div>
	<div class="header">
		<div class="container">
			<div class="container-wrapper">
				<div class="logo">
					<a href="{{ url() }}"><img src="{{ url('/logo.svg') }}" /></a>
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
			<img src="{{ url() }}/logo.svg" />
			<img src="{{ url() }}/logo.svg" class="img_s"/>
		</a>
	</div>
</div>
