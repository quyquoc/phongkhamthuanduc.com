
<div class="box box-head page-home">
    <div class="inner-image">
        <div class="img">
            <div class="slide-banner" style="background-image: url('{{ url( Ohi.sysConfig('banner-lon',true ,'image'))}}');">
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
                            <a href="javasript:void(0);" onclick="popRegis()" class="button page-color">Đặt lịch tư vấn</a>
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
                <p class="left">{{ Ohi.sysConfig('weekdays',true, 'description')}}:</p>
                <div class="date">{{ Ohi.sysConfig('weekdays',false)}}</div>
                <p class="left">{{ Ohi.sysConfig('weekend',true, 'description')}}:</p>
                <div class="date">{{ Ohi.sysConfig('weekend',false)}}</div>
            </div>
            <div class="inner">
                <div class="box-header">
                    <h1 class="box-title">Trường hợp khẩn cấp</h1>
                </div>
               <a class="hot" href="tel:02343833888"> <img src="{{assets}}/images/telephone-handle-silhouette.svg"> 0234 3833 888</a>
               <p>{{ Ohi.sysConfig('truong-hop-khan-cap',true)}}</p>
            </div>
		</div>
	</div>
</div>
{{ element.NewsBoxArticle(null, ['type':'lastest'], ['limit':6]) }}
{# partial("partials/boxes/BoxColumn_1x4") #}
<div class="section box box-about">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-body">
				<div class="contentWrapper wow fadeInUp">
					<div class="box-header">
						<h1 class="box-title text-left"> {{ Ohi.sysConfig('introduction',true, 'description')}}</h1>
					</div>
					<div class="content pleft">
                        {{ Ohi.sysConfig('introduction',false)}}
                       
					</div>
                    <a href="{{url('/gioi-thieu')}}">Xem thêm</a>
				</div>
				<div class="image wow fadeInUp" style="background-image: url('{{ url(Ohi.sysConfig('introduction',true, 'image')) }}');">
					<img src=" {{ url(Ohi.sysConfig('introduction',true, 'image')) }} " />
				</div>
			</div>
		</div>
	</div>
</div>
{% if list_depart is defined and list_depart is not empty %}
    <div class="section box box-clinic">
        <div class="container">
            <div class="box-header wow fadeInUp">
                <h1 class="box-title">Chuyên khoa</h1>
                <p>{{Ohi.sysConfig('gioi-thieu-chuyen-khoa',true)}}</p>
            </div>
            <div class="box-body">
                <div class="inner">
                    {% for item in list_depart %}
                    <a href="{{url('/chuyen-khoa/'~item.code)}}" class="item wow fadeInUp">
                        <div class="image"><img src="{{ item.logo is not empty ?  url(item.logo) : url('/logo.svg') }}" /></div>
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
<div class="box-about reason" style="background-image: url('{{ url( Ohi.sysConfig('vi-sao-nen-chon-chung-toi',true, 'image')) }}');">
    <div class="overlay section ">
        <div class="container">
		<div class="container-wrapper">
			<div class="box-body">
				<div class="contentWrapper wow fadeInUp">
					<div class="box-header">
						<h1 class="box-title text-left text-color-page1">{{Ohi.sysConfig('vi-sao-nen-chon-chung-toi',true,"title")}}?</h1>
					</div>
					<div class="content ">
                        {{Ohi.sysConfig('vi-sao-nen-chon-chung-toi',false)}}
					</div>
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

