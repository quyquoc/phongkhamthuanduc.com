
<div class="box box-head page-home">
    <div class="inner-image">
        <div class="img">
            <div class="slide-banner" style="background-image: url('{{ assets }}/images/bg-home.jpg');">
            </div>
        </div>
    
    </div>
    <div class="inner-content ">
        <div class="container">
            <div class="container-wrapper home">
                <div class="box-body" data-aos="fade-up">
                    <h2 class="title">Bảo vệ sức khỏe</h2>
                    <div class="content">
                        <p>cho cả gia đình</p>
                        <div class="bottom">
                            <a href="{{url('/chuyen-khoa')}}" class="button">Chuyên khoa</a>
                            <a href="javasript:void(0);" onclick="popRegis()" class="button transparent">Đặt lịch tư vấn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box box-about-2">
	<div class="container">
		<div class="box-body">
            <div class="inner">
                <div class="box-header">
                    <h1 class="box-title text-left">Giờ mở cửa</h1>
                </div>
                <div class="date"><p class="left">Thứ 2 - thứ 6</p><p class="right">7:00 - 18:00</p></div>
                <div class="date"><p class="left">Thứ 7</p><p class="right">7:00 - 17:30</p></div>
                <div class="date"><p class="left">Chủ nhật</p><p class="right">7:00 - 17:30</p></div>
            </div>
            <div class="inner">
                <div class="box-header">
                    <h1 class="box-title text-left">Trường hợp khẩn cấp</h1>
                </div>
               <a class="hot" href="tel:02343833888"> <img src="{{assets}}/images/telephone-handle-silhouette.svg"> 0234 3833 888</a>
               <p>Your treatment plan is designed for steady progress, with every phase promptly implemented.</p>
            </div>
		</div>
	</div>
</div>
{# partial("partials/boxes/BoxColumn_1x4") #}
<div class="section box box-about">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-body">
				<div class="contentWrapper wow fadeInUp">
					<div class="box-header">
						<h1 class="box-title text-left">Phòng khám Thuận Đức</h1>
					</div>
					<div class="content pleft">
						<p>Phòng khám Đa khoa Thuận Đức được Sở y tế Thừa Thiên Huế cấp giấy phép hoạt động số: 620/TTH_GPHĐ ngày 1/11/2016 và Giấy phép khám sức khỏe định kỳ cho cán bộ công nhân viên các cơ quan xí nghiệp theo Công văn số: 1685/SYT-NVY ngày 5/7/2019.</p>
						<p>Ngoài ra, Phòng khám Đa khoa Thuận Đức còn được Bảo Hiểm xã Hội tỉnh Thừa Thiên Huế cho phép khám Bảo hiểm y tế ban đầu theo hợp đồng số: 07/HĐKCB BHYT-2020 ngày 30 tháng 12 năm 2109 với các dịch vụ về Nội khoa, Ngoại khoa, Sản khoa, Nhi khoa, Răng Hàm Mặt, Tai Mũi Họng, Da Liễu, Mắt, Giải phẫu bệnh, Xét nghiệm, X-Quang, Siêu âm, Y học cổ truyền, KHHGĐ và dịch vụ Chăm sóc Mẹ và Bé tại nhà.</p>
					</div>
				</div>
				<div class="image wow fadeInUp" style="background-image: url('{{ assets }}/images/hospital.jpg');">
					<img src=" {{ assets }}/images/hospital.jpg" />
				</div>
			</div>
		</div>
	</div>
</div>
{% if list_depart is defined and list_depart is not empty %}
    <div class="section box box-clinic">
        <div class="container">
            <div class="box-header wow fadeInUp">
                <h1 class="box-title text-left ">Chuyên khoa</h1>
            </div>
            <div class="box-body">
                <div class="inner">
                    <div class="item wow fadeInUp">
                        <p>{{Ohi.sysConfig('introduction',true)}}</p>
                    </div>
                    {% for item in list_depart %}
                    <a href="{{url('/chuyen-khoa/'~item.code)}}" class="item wow fadeInUp">
                        <div class="image"><img src="{{ url(item.logo) }}" /></div>
                        <div class="content">
                            <h3 class="title">{{ item.title }}</h3>
                        </div>
                    </a>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
{% endif %}
<div class="section box box-about reason" style="background-image: url('{{ assets }}/images/bg-reason.jpg');">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-body">
				<div class="contentWrapper wow fadeInUp">
					<div class="box-header">
						<h1 class="box-title text-left text-color-page1">Vì sao nên chọn chúng tôi</h1>
					</div>
					<div class="content ">
						<p>5 lý do để bạn chọn Phòng Khám Đa Khoa Việt Nhật là điểm khám bệnh lý tưởng nhất tại Tp. Huế.</p>
                        <ul>
                            <li>Đội ngũ bác sĩ có chuyên môn cao, giàu kinh nghiệm</li>
                            <li>Quy trình tiếp nhận và khám bệnh nhanh, gọn, chính xác</li>
                            <li>Trang thiết bị hiện đại</li>
                            <li>Hệ thống nhà thuốc đầy đủ</li>
                            <li>Hoạt động dựa theo cơ sở pháp lý đã được Sở Y tế duyệt</li>
                        </ul>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

{{ element.BoxGuestReview() }}
{{ partial('partials/boxes/BoxAchievements') }}
{{ element.BoxContact() }}
{# if list_item is defined and list_item|length > 0 %}
    <div class="section main-content news news-list {{category.code}}">
            <div class="container">
            <div class="box-header"><div class="box-title text-left">Tin tức</div></div>
            <div class="module">
                <div class="module-content">
                    {% for item in list_item %}
                        {% set link 	= url('/' ~ item.news_category.code ~ '/' ~ item.code) %}
                        {% set link_img = item.image is not empty ? url(item.image) : assets ~ '/images/no-image.jpg' %}
                        {{ partial('news/item') }}
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
{% endif #}

{{element.script(['slick']) }}

