<ul class="menunav">
	<li class="{{ menu is not defined or menu is empty ? 'active' : '' }}"><a href="{{ url() }}">Trang chủ</a></li>
	<li class="{{ menu is defined and menu == 'gioi-thieu' ? 'active' : '' }}"><a href="{{ url('/gioi-thieu') }}">Giới thiệu  <i class="fa fa-angle-down"></i></a> 
		<ul class="level1">
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'gioi-thieu' ? 'active' : '' }}"><a href="{{ url('/gioi-thieu/') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Giới thiệu phòng khám</a></li>
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'so-do-to-chuc' ? 'active' : '' }}"><a href="{{ url('/gioi-thieu/so-do-to-chuc') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Sơ đồ tổ chức</a></li>
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'nhan-luc-phong-kham' ? 'active' : '' }}"><a href="{{ url('/gioi-thieu/nhan-luc-phong-kham') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Nhân lực phòng khám </a></li>
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'quy-trinh-thuc-hien' ? 'active' : '' }}"><a href="{{ url('/gioi-thieu/quy-trinh-thuc-hien') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Quy trình thực hiện</a></li>
			<li class="{{ menu_lv1 is defined and menu_lv1 == 'co-so-vat-chat' ? 'active' : '' }}"><a href="{{ url('/gioi-thieu/co-so-vat-chat') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Cơ sở vật chất</a></li>
		</ul>
	</li>
	<li class="{{ menu is defined and menu == 'chuyen-khoa' ? 'active' : '' }}"><a href="{{ url('/chuyen-khoa') }}">Chuyên khoa  <i class="fa fa-angle-down"></i></a> 
		{{ element.LevelMenu('chuyen-khoa') }}
	</li>
	<li class="{{ menu is defined and menu == 'dich-vu' ? 'active' : '' }}"><a href="{{ url('/dich-vu') }}">Dịch vụ <i class="fa fa-angle-down"></i></a>
		{{ element.LevelMenu('dich-vu') }}
	</li>
	<li class="{{ menu is defined and menu == 'kham-bao-hiem-y-te' ? 'active' : '' }}"><a href="{{ url('/dich-vu/kham-bao-hiem-y-te') }}">Khám BHYT <i class="fa fa-angle-down"></i></a>
	
		{{ element.LevelMenu('huong-dan') }}
	</li>
	<li class="{{ menu is defined and menu == 'goc-yeu-thuong' ? 'active' : '' }}"><a href="{{ url('/goc-yeu-thuong') }}">Tin tức <i class="fa fa-angle-down"></i> </a>
		{{element.NewsMenuWithCategory('goc-yeu-thuong')}}	
	</li>
	<li class="{{ menu is defined and menu == 'tin-tuc' ? 'active' : '' }}"><a href="{{ url('/tin-tuc') }}">Tin tức <i class="fa fa-angle-down"></i> </a>
		{{element.NewsMenuWithCategory('tin-tuc')}}	
	</li>
	<li class="{{ menu is defined and menu == 'thu-vien' ? 'active' : '' }}"><a href="{{ url('/thu-vien') }}">Thư viện</a></li>
	<li class="{{ menu is defined and menu == 'lien-he' ? 'active' : '' }}"><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
</ul>