
<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<a href="{{ url(define.backend ~ '/account/profile') }}"><img src="{{ member.item.avatar != '' ? url(member.item.avatar) : url('/backend/template/images/default-avatar.png') }}" class="img-circle"></a>
			</div>
			<div class="pull-left info">
				<p>{{ link_to(define.backend ~ '/account/profile', member.item.firstname is empty and  member.item.lastname is empty ? member.item.username : member.item.firstname ~ ' ' ~ member.item.lastname) }}</p>
				<a href="{{ url(define.backend ~ '/account/logout') }}"><i class="fa fa-sign-out"></i> Đăng xuất</a>
			</div>
		</div>

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			
			<!-- <li class="header">Liên kết</li> -->
			
			<li class="{{ (dispatcher.getControllerName() in ['index']) ? ' active' : '' }}">{{ link_to(define.backend,'<i class="fa fa-dashboard"></i><span>Trang chủ</span>') }}</li>		
			
			<!-- News -->
				{% if role=="full" or in_array('news-category', role) or in_array('news-article', role) %}
					<li class="treeview{{ (dispatcher.getControllerName() in ['news-article', 'news-category']) ? ' active' : '' }}">
						<a href="#">
							<i class="fa fa-newspaper-o"></i> <span>{{ language._('news') }}</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							{% if role=="full" or in_array('news-article', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['news-article']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/news-article/index','<i class="fa fa-circle-o"></i>' ~ language._('posts')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('news-category', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['news-category']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/news-category/index','<i class="fa fa-circle-o"></i>' ~ language._('category')) }}</li>
							{% endif %}
						</ul>
					</li>
				{% endif %}

			<!-- Shop -->
				{% if role=="full" or in_array('shop-category', role) or in_array('shop-product', role) or in_array('shop-brand', role) or in_array('shop-invoice', role) %}
					<li class="treeview{{ (dispatcher.getControllerName() in ['shop-category', 'shop-product', 'shop-brand', 'shop-invoice']) ? ' active' : '' }}">
						<a href="#">
							<i class="fa fa-opencart"></i> <span>{{ language._('shop') }}</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							{% if role=="full" or in_array('shop-invoice', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['shop-invoice']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/shop-invoice/index','<i class="fa fa-circle-o"></i>' ~ language._('invoice')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('shop-product', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['shop-product']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/shop-product/index','<i class="fa fa-circle-o"></i>' ~ language._('product')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('shop-category', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['shop-category']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/shop-category/index','<i class="fa fa-circle-o"></i>' ~ language._('category')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('shop-brand', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['shop-brand']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/shop-brand/index','<i class="fa fa-circle-o"></i>' ~ language._('brand')) }}</li>
							{% endif %}
						</ul>
					</li>
				{% endif %}

			<!-- Tour -->
				{% if role=="full" or in_array('tour', role) or in_array('tour-category', role) or in_array('tour-booking', role) %}
					<li class="treeview{{ (dispatcher.getControllerName() in ['tour', 'tour-category', 'tour-booking']) ? ' active' : '' }}">
						<a href="#">
							<i class="fa fa-motorcycle"></i> <span>{{ language._('Tour') }}</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							{% if role=="full" or in_array('tour-booking', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['tour-booking']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/tour-booking/index','<i class="fa fa-circle-o"></i>' ~ language._('Booking Tour')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('tour', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['tour']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/tour/index','<i class="fa fa-circle-o"></i>' ~ language._('Tour')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('tour-category', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['tour-category']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/tour-category/index','<i class="fa fa-circle-o"></i>' ~ language._('category')) }}</li>
							{% endif %}
						</ul>
					</li>
				{% endif %}

			<!-- Hotel -->
				{% if role=="full" or in_array('hotel-booking', role) or in_array('hotel-room', role) %}
					<li class="treeview{{ (dispatcher.getControllerName() in ['hotel-booking', 'hotel-room']) ? ' active' : '' }}">
						<a href="#">
							<i class="fa fa-bed"></i> <span>Phòng nghỉ</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							{% if role=="full" or in_array('hotel-booking', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['hotel-booking']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/hotel-booking/index','<i class="fa fa-circle-o"></i>' ~ language._('Đặt phòng')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('hotel-room', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['hotel-room']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/hotel-room/index','<i class="fa fa-circle-o"></i>' ~ language._('Phòng nghỉ')) }}</li>
							{% endif %}
						</ul>
					</li>
				{% endif %}
			
			<!-- Recruitment -->
				{% if role=="full" or in_array('recruitment-work', role) or in_array('recruitment', role) or in_array('recruitment-career', role) %}
					<li class="treeview{{ (dispatcher.getControllerName() in ['recruitment', 'recruitment-career', 'recruitment-work']) ? ' active' : '' }}">
						<a href="#">
							<i class="fa fa-briefcase"></i> <span>Tuyển dụng</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							{% if role=="full" or in_array('recruitment', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['recruitment']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/recruitment/index','<i class="fa fa-circle-o"></i>' ~ language._('Hồ sơ tuyển dụng')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('recruitment-work', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['recruitment-work']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/recruitment-work/index','<i class="fa fa-circle-o"></i>' ~ language._('Công việc')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('recruitment-career', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['recruitment-career']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/recruitment-career/index','<i class="fa fa-circle-o"></i>' ~ language._('Ngành nghề')) }}</li>
							{% endif %}
						</ul>
					</li>
				{% endif %}		

			<!-- Images -->
				{% if role=="full" or in_array('image', role) or in_array('image-album', role) or in_array('image-group', role) %}
					<li class="treeview{{ (dispatcher.getControllerName() in ['image', 'image-album', 'image-group']) ? ' active' : '' }}">
					  <a href="#">
							<i class="fa fa-file-image-o"></i> <span>{{ language._('multimedia') }}</span>
							<span class="pull-right-container">
							  <i class="fa fa-angle-left pull-right"></i>
							</span>
					  </a>
					  <ul class="treeview-menu">
						{% if role=="full" or in_array('image', role) %}
						  <li class="{{ (dispatcher.getControllerName() in ['image']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/image/index','<i class="fa fa-circle-o"></i>' ~ language._('image')) }}</li>
						{% endif %}
						{% if role=="full" or in_array('image-album', role) %}
						  <li class="{{ (dispatcher.getControllerName() in ['image-album']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/image-album/index','<i class="fa fa-circle-o"></i>' ~ language._('image_album')) }}</li>
						{% endif %}
						{% if role=="full" or in_array('image-group', role) %}
						  <li class="{{ (dispatcher.getControllerName() in ['image-group']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/image-group/index','<i class="fa fa-circle-o"></i>' ~ language._('image_group')) }}</li>
						{% endif %}
					  </ul>
					</li>
			  {% endif %}

			<!-- Question Answer -->
				{% if role=="full" or in_array('qa', role) %}
					<li class="{{ (dispatcher.getControllerName() in ['qa']) ? ' active' : '' }}">
						{{ link_to(define.backend ~ '/qa','<i class="fa fa-weixin"></i><span>' ~ language._('Tư vấn hỗ trợ KH-KT')) ~ '</span>' }}
					</li>
				{% endif %}

			<!-- Contact -->
				{% if role=="full" or in_array('contact', role) %}
					<li class="{{ (dispatcher.getControllerName() in ['contact']) ? ' active' : '' }}">
						{{ link_to(define.backend ~ '/contact','<i class="fa fa-comments-o"></i><span>' ~ language._('contact')) ~ '</span>' }}
					</li>
				{% endif %}

			<!-- Newsletter -->
				{% if role=="full" or in_array('newsletter', role) %}
					<li class="{{ (dispatcher.getControllerName() in ['newsletter']) ? ' active' : '' }}">
						{{ link_to(define.backend ~ '/newsletter','<i class="fa fa-envelope-o"></i><span>' ~ language._('newsletter')) ~ '</span>' }}
					</li>
				{% endif %}
				
		  <!-- Member -->
				{% if role=="full" or in_array('member', role) or in_array('permission-group', role) or in_array('permission-privilege', role) or in_array('permission-group-privilege', role) %}
					<li class="treeview{{ (dispatcher.getControllerName() in ['member', 'permission-group', 'permission-privilege', 'permission-group-privilege']) ? ' active' : '' }}">
						<a href="#">
						<i class="fa fa-user"></i> <span>{{ language._('member') }}</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
						</a>
						<ul class="treeview-menu">
						{% if role=="full" or in_array('member', role) %}
							<li class="{{ (dispatcher.getControllerName() in ['member']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/member/index', '<i class="fa fa-circle-o"></i>' ~ language._('member')) }}</li>
						{% endif %}
						{% if role=="full" or in_array('permission-group', role) %}
							<li class="{{ (dispatcher.getControllerName() in ['permission-group']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/permission-group/index', '<i class="fa fa-circle-o"></i> Nhóm quyền') }}</li>
						{% endif %}
						{% if role=="full" or in_array('permission-privilege', role) %}
							<li class="{{ (dispatcher.getControllerName() in ['permission-privilege']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/permission-privilege/index', '<i class="fa fa-circle-o"></i>' ~ language._('privilege')) }}</li>
						{% endif %}
						{% if role=="full" or in_array('permission-group-privilege', role) %}
							<li class="{{ (dispatcher.getControllerName() in ['permission-group-privilege']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/permission-group-privilege/index', '<i class="fa fa-circle-o"></i>' ~ language._('permission')) }}</li>
						{% endif %}
						</ul>
					</li>
				{% endif %}

			<!-- Config -->
				{% if role=="full" or in_array('sys-config', role) or in_array('testimonial', role) or in_array('staff', role) %}
					<li class="treeview{{ (dispatcher.getControllerName() in ['sys-config', 'testimonial', 'staff']) ? ' active' : '' }}">
						<a href="#">
							<i class="fa fa-globe"></i> <span>Cấu hình website</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							{% if role=="full" or in_array('staff', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['staff']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/staff/index','<i class="fa fa-circle-o"></i>' ~ language._('staff')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('testimonial', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['testimonial']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/testimonial/index','<i class="fa fa-circle-o"></i>' ~ language._('Ý kiến đánh giá')) }}</li>
							{% endif %}
							{% if role=="full" or in_array('sys-config', role) %}
								<li class="{{ (dispatcher.getControllerName() in ['sys-config']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/sys-config/index','<i class="fa fa-circle-o"></i>' ~ language._('Thông tin website')) }}</li>
							{% endif %}
						</ul>
					</li>
				{% endif %}

			<!-- Data -->
				<li class="{{ (dispatcher.getControllerName() in ['data']) ? 'active' : '' }}"><a onclick="open_ckfinder();"><i class="fa fa-floppy-o"></i><span>{{ language._('resource') }}</a></span></li>

		</ul>
	</section>
</aside>