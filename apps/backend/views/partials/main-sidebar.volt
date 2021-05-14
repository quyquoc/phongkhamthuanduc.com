
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
			{% if role=="full" or in_array('service', role) %}
				<li class="{{ (dispatcher.getControllerName() in ['service']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/service/index','<i class="fa fa-clipboard"></i>' ~ language._('Dich vụ')) }}</li>
			{% endif %}

			{% if role=="full" or in_array('department', role) or in_array('staff', role) %}
				<li class="treeview{{ (dispatcher.getControllerName() in [ 'department', 'staff']) ? ' active' : '' }}">
					<a href="#">
						<i class="fa fa-hospital-o"></i> <span>Phòng ban</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						{% if role=="full" or in_array('department', role) %}
							<li class="{{ (dispatcher.getControllerName() in ['department']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/department/index','<i class="fa fa-circle-o"></i>' ~ language._('Chuyên khoa')) }}</li>
						{% endif %}
						{% if role=="full" or in_array('staff', role) %}
							<li class="{{ (dispatcher.getControllerName() in ['staff']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/staff/index','<i class="fa fa-circle-o"></i>' ~ language._('staff')) }}</li>
						{% endif %}
					
					</ul>
				</li>
			{% endif %}
			
			{% if role=="full" or in_array('booking', role) %}
				<li class="{{ (dispatcher.getControllerName() in ['booking']) ? ' active' : '' }}">{{ link_to(define.backend ~ '/booking/index','<i class="fa fa-calendar"></i>' ~ language._('Đặt lịch khám')) }}</li>
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
			<!-- Contact -->
				{% if role=="full" or in_array('contact', role) %}
					<li class="{{ (dispatcher.getControllerName() in ['contact']) ? ' active' : '' }}">
						{{ link_to(define.backend ~ '/contact','<i class="fa fa-comments-o"></i><span>' ~ language._('contact')) ~ '</span>' }}
					</li>
				{% endif %}
				{% if role=="full" or in_array('testimonial', role) %}
					<li class="{{ (dispatcher.getControllerName() in ['testimonial']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/testimonial/index','<i class="fa fa-thumbs-o-up"></i>' ~ language._('Ý kiến đánh giá')) }}</li>
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
	
			{% if role=="full" or in_array('sys-config', role) %}
				<li class="{{ (dispatcher.getControllerName() in ['sys-config']) ? 'active' : '' }}">{{ link_to(define.backend ~ '/sys-config/index','<i class="fa fa-globe"></i>' ~ language._('Thông tin website')) }}</li>
			{% endif %}
			<!-- Data -->
			<li class="{{ (dispatcher.getControllerName() in ['data']) ? 'active' : '' }}"><a onclick="open_ckfinder();"><i class="fa fa-floppy-o"></i><span>{{ language._('resource') }}</a></span></li>

		</ul>
	</section>
</aside>