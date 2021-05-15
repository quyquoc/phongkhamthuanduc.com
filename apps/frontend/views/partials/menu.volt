<ul class="menunav">
	<li class="{{ menu is not defined or menu is empty ? 'active' : '' }}"><a href="{{ url() }}">Trang chủ</a></li>
	<li class="{{ menu is defined and menu == 'gioi-thieu' ? 'active' : '' }}"><a href="{{ url('/gioi-thieu') }}">Giới thiệu </a> <img src="{{assets}}/images/icon-down.svg">
		{{ element.LevelMenu('gioi-thieu') }}
	</li>
	<li class="{{ menu is defined and menu == 'chuyen-khoa' ? 'active' : '' }}"><a href="{{ url('/chuyen-khoa') }}">Chuyên khoa </a> <img src="{{assets}}/images/icon-down.svg">
		{{ element.LevelMenu('chuyen-khoa') }}
	</li>
	<li class="{{ menu is defined and menu == 'dich-vu' ? 'active' : '' }}"><a href="{{ url('/dich-vu') }}">Dịch vụ</a> <img src="{{assets}}/images/icon-down.svg">
		{{ element.LevelMenu('dich-vu') }}
	</li>
	<li class="{{ menu is defined and menu == 'kham-bao-hiem-y-te' ? 'active' : '' }}"><a href="{{ url('/dich-vu/kham-bao-hiem-y-te') }}">Khám BHYT</a></li>
	<li class="{{ menu is defined and menu == 'tin-tuc' ? 'active' : '' }}"><a href="{{ url('/tin-tuc') }}">Tin tức </a> <img src="{{assets}}/images/icon-down.svg">
		{{element.NewsMenuWithCategory('tin-tuc')}}	
	</li>
	<li class="{{ menu is defined and menu == 'thu-vien' ? 'active' : '' }}"><a href="{{ url('/thu-vien') }}">Thư viện</a></li>
	<li class="{{ menu is defined and menu == 'lien-he' ? 'active' : '' }}"><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
</ul>