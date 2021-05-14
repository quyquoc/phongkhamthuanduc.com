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
	<div class="section main-content service service-list ">
		<div class="container">
				<div class="box-header"><div class="box-title text-left">Các dịch vụ khác</div></div>
				<div class="box-body">
						{% for item in list_relative %}
								{% if loop.index is divisibleby(2) %}
								<div class="item reverse wow">
									<div class="image" style="background-image: url('{{ url(item.image) }}'); align-items: initial;">
										<img src="{{ url(item.image) }}" />
									</div>
									<div class="contentWrapper">
										<div class="content">
											<div class="title">{{item.title}}</div>
											<div class="description">{{item.description}}</div>
											<a  href="{{url('/dich-vu/'~ item.code)}}" class="button">Xem thêm</a>
										</div>
									</div>
								</div>
									
								{% else %}
								<div class="item  wow fadeInLeft">
									<div class="contentWrapper ">
										<div class="content">
											<div class="title">{{item.title}}</div>
											<div class="description">{{item.description}}</div>
											<a  href="{{url('/dich-vu/'~item.code)}}" class="button">Xem thêm</a>
										</div>
									</div>
									<div class="image" style="background-image: url('{{ url(item.image) }}'); align-items: initial;">
										<img src="{{ url(item.image) }}" />
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
