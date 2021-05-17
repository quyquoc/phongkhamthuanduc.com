<div id="news-detail" class="page-news detail">	
	<div class="section main-content news news-detail">
		<div class="container">
			<div class="module">
				<div class="box-header"><h1 class="box-title">{{ article.title }}</h1></div>
			
				<div class="module-content">
					<div class="item">
						<div class="content-detail">
							<div class="description">{{ article.description }}</div>
						</div>
					</div>
					<a  onclick="getOption('{{article.title}}');popRegis()" href="javascript:void(0)" class="button">Liên hệ tư vấn</a>
				</div>
			</div>
		</div>
	</div>
	
{% if list_relative is defined and list_relative is not empty %}
	<div class="section main-content service service-list line">
		<div class="container">
				<div class="box-header"><div class="box-title">Các dịch vụ khác</div></div>
				<div class="box-body">
						{% for item in list_relative %}
						{% if loop.index is divisibleby(2) %}
						<div class="item reverse wow">
							<div class="image" style="background-image: url('{{ item.image is not empty ?  url(item.image) : url(assets) ~ '/images/img-contact.jpg' }}'); align-items: initial;">
								<img src="{{ item.image is not empty ?  url(item.image) : url(assets) ~ '/images/img-contact.jpg' }}" />
							</div>
							<div class="contentWrapper">
								<div class="content">
									<a href="{{url('/dich-vu/'~item.code)}}" class="title">{{item.title}}</a>
									<div class="description">{{  item.description | striptags }}</div>
									<a  href="{{url('/dich-vu/'~ item.code)}}" class="button">Xem thêm</a>
								</div>
							</div>
						</div>
						   
						{% else %}
						<div class="item  wow fadeInLeft">
							<div class="contentWrapper ">
								<div class="content">
									<a href="{{url('/dich-vu/'~item.code)}}" class="title">{{item.title}}</a>
									<div class="description">{{  item.description | striptags }}</div>
									<a  href="{{url('/dich-vu/'~item.code)}}" class="button">Xem thêm</a>
								</div>
							</div>
							<div class="image" style="background-image: url('{{ item.image is not empty ?  url(item.image) : url(assets) ~ '/images/img-contact.jpg' }}'); align-items: initial;">
								<img src="{{ item.image is not empty ?  url(item.image) : url(assets) ~ '/images/img-contact.jpg' }}" />
							</div>
						</div>
						{% endif %}
						{% endfor %}
				</div>
			</div>
		</div>
	</div>
	{% endif %}
</div>
