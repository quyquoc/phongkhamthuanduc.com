<div id="clinic-detail" class="page-clinic detail">	
	<div class="container">
		<div class="box box-head">
			<div class="inner-image">
				<div class="img">
					<div class="slide-banner" style="background-image: url('{{ assets }}/images/bg_clinic.jpg');">
					</div>
				</div>
			
			</div>
			<div class="inner-content">
					<div class="container-wrapper">
						<div class="box-body" data-aos="fade-up">
							<h2 class="title">{{ article.title }}</h2>
						</div>
					</div>
				</div>
		</div>
	</div> 

	<div class="clinic clinic-detail">
		<div class="module">
			<div class="module-content">
				<div class="container">
					<div class="list-item">
						<ul>
							<li class="color-page-3">Chuyên khoa</li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-noi.svg"> Nội khoa</a></li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-ngoai.svg"> Ngoại khoa</a></li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-nhi.svg"> Nhi khoa</a></li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-dongy.svg"> Khoa đông y</a></li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-san.svg"> Phụ khoa</a></li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-rang-ham-mat.svg"> Răng-hàm-mặt</a></li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-tai-mui-hong.svg" alt=""> Tai-mũi-họng</a></li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-sieu-am.svg"> Phòng siêu âm</a></li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-xet-nghiem.svg"> Phòng xét nghiệm</a></li>
							<li class="color-page {{article.code == 'khoa-dong-y' ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/khoa-dong-y')}}"><img src="{{assets}}/images/w-x-quang.svg"> Phòng X-quang</a></li>
						</ul>
					</div>
					<div class="item">
						<div class="content-detail">
							<div class="description">{{ article.description }}</div>
							<div class="content">{{ article.content }}</div>
							{% if article.imgs is not empty %}
							<div class="ablumn">
								<div class="name">Hình ảnh về phòng khám</div>
								<div class="modulecontent">
									<div class="slide-for">
										{% set imgs = article.imgs | json_decode %}
										{% for item_1 in imgs %}
											<div class="item"  >
												<a class="item-wrap" style="background-image:url('{{url(item_1.src)}}')" href="{{ url(item_1.src) }}"data-fancybox="group-image"  >
													<div class="img">
														<div class="image">
															<img src="{{ url(item_1.src) }}">
														</div>
													</div>
												</a>
											</div>
										{% endfor %}
									</div>
									<div class="slide-nav">
										{% for item_1 in imgs %}
										<div class="item" >
											<a class="item-wrap" >
												<div class="image" style="background-image:url('{{url(item_1.src)}}')" >
													<img src="{{ url(item_1.src) }}">
												</div>
											</a>
										</div>
										{% endfor %}
									</div>
								</div>
							</div>
							{% endif %}
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
								$('[data-fancybox="group-image"]').fancybox({
									loop    : true,
									thumbs  : {
											autoStart : true
									},
									buttons : ['zoom', 'close']
								});
								$(' .slide-for').slick({
									slidesToShow: 1,
									slidesToScroll: 1,
									arrows: false,
									autoplay: true,
									fade: true,
									asNavFor: '.slide-nav'
								});
								$('.slide-nav').slick({
									asNavFor: '.slide-for',
									arrows: true,
									slidesToShow: 3,
									slidesToScroll: 2,
									vertical:true,
									centerMode: true,
									verticalSwiping: true,
									focusOnSelect: true,
									responsive: [
									{
										breakpoint: 1000,
										settings: {
											slidesToShow: 2,
											slidesToScroll: 1,
										}
									},
									{
										breakpoint: 500,
										settings: {
											vertical:false,
											centerMode: false,
											verticalSwiping: false,
											slidesToShow: 2,
											slidesToScroll: 1,
										}
									},
								]
								});
							});
						</script>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>
