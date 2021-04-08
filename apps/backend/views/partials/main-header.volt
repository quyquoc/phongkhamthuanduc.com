
<header class="main-header">
	<!-- Logo -->
	<a class="logo" href="{{ url() }}" target="_blank">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>TĐ</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Thuận Đức</b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">

				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ member.item.image != '' ? url(member.item.image) : url('/backend/template/images/default-avatar.png') }}" class="user-image">
						<span class="hidden-xs">{{ member.item.fullname is not empty ? member.item.fullname : member.item.username }}</span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<img src="{{ member.item.image != '' ? url(member.item.image) : url('/backend/template/images/default-avatar.png') }}" class="img-circle" alt="User Image">
							<p>{{ member.item.fullname is not empty ? member.item.fullname : member.item.username }}</p>
						</li>

						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								{{ link_to(define.backend ~ '/account/profile','<span>' ~ language._('profile') ~ '</span></a>', 'class':'btn btn-default btn-flat') }}
							</div>
							<div class="pull-right">
								{{ link_to(define.backend ~ '/account/logout','<i class="fa fa-sign-out pull-right"></i> '~language._('logout'), 'class':'btn btn-default btn-flat') }}
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>