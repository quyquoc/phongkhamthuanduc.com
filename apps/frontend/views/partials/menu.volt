<ul class="menunav">
	<li class="{{ menu is not defined or menu is empty ? 'active' : '' }}"><a href="{{ url() }}">Trang chủ</a></li>
	<li class="{{ menu is defined and menu == 'page' ? 'active' : '' }}"><a href="javascript:void(0);">Page</a>
		<ul class="level1">
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'gioi-thieu' ? 'active' : '' }}"><a href="{{ url('/gioi-thieu') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Giới thiệu</a></li>
		</ul>		
	</li>
	<li class="{{ menu is defined and menu == 'components' ? 'active' : '' }}"><a href="{{ url('/components') }}">Components</a></li>
	<li class="{{ menu is defined and menu == 'boxes' ? 'active' : '' }}"><a href="{{ url('/boxes') }}">Boxes</a></li>
	<li class="{{ menu is defined and menu == 'tin-tuc' ? 'active' : '' }}"><a href="{{ url('/tin-tuc') }}">Tin tức</a>
		<ul class="level1">
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'tin-hoat-dong' ? 'active' : '' }}"><a href="{{ url('/tin-hoat-dong') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Tin hoạt động</a></li>
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'thong-bao' ? 'active' : '' }}"><a href="{{ url('/thong-bao') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Thông báo</a></li>
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'tin-thi-truong' ? 'active' : '' }}"><a href="{{ url('/tin-thi-truong') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Tin thị trường</a></li>
		</ul>		
	</li>
	<li class="{{ menu is defined and menu == 'dao-tao' ? 'active' : '' }}"><a href="{{ url('/dao-tao') }}">Đào tạo</a></li>
	<li class="{{ menu is defined and menu == 'tuyen-dung' ? 'active' : '' }}"><a href="{{ url('/tuyen-dung') }}">Tuyển dụng</a></li>
	<li class="{{ menu is defined and menu == 'lien-he' ? 'active' : '' }}"><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
</ul>