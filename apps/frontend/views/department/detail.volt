<div id="clinic-detail" class="page-clinic detail">	
		<div class="box box-head">
			<div class="inner-image">
				<div class="img">
					<div class="slide-banner" style="background-image: url('{{ url(assets)~'/images/bg-home.png' }}');">
					</div>
				</div>
			</div>
			<div class="inner-content">
				<div class="container">
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
							{% if list_depart is defined and list_depart is not empty %}
								{% for item in list_depart %}
									<li class="color-page {{ item.code == article.code  ? 'active':'' }}"><a href="{{ url('/chuyen-khoa/'~item.code)}}"><img src="{{ url(item.logo_white)}}"> {{ item.title }}</a></li>
								{% endfor %}
							{% endif %}
						</ul>
					</div>
					<div class="item">
						<div class="content-detail">
							<div class="description">{{ article.description }}</div>
							<div class="content">{{ article.content }}</div>
							
						</div>
						{% if article.imgs is not empty %}
							<section id="album" class="ablumn portfolio">
								<div class="main_content list_project">
									<ul class="grid effect-2" id="grid">
										{% set imgs = article.imgs | json_decode %}
										{% for item in imgs %}
											{% if item.src is not empty %}
												<li>
													<a class="project fancybox" href="{{ url(item.src) }}" rel="gallery" data-fancybox="group-image" data-fancybox 
													data-width="1500" data-height="1000"
													data-thumb="{{url(item.src) }}">
														<div class="image">
															<img src="{{ url(item.src) }}">
														</div>
													</a>
												</li>
											{% endif %}
										{% endfor %}
									</ul>
								</div>
							</section>
							{% endif %}
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>
<script type="text/javascript">
			
	$(document).ready(function() {
		new AnimOnScroll( document.getElementById('grid'), {
			minDuration : 0.4,
			maxDuration : 0.7,
			viewportFactor : 0.2
		});

		$(".fancybox").fancybox({
			padding     : 10,
			width       : '99%',
			height      : '99%',
			maxWidth    : '99%',
			maxHeight   : '99%',
			openEffect  : 'elastic',
			closeEffect : 'elastic',
			closeBtn    : false,
			loop        : true,

			helpers : {
				title   : {
					type : 'inside'
				},
				overlay : {
					closeClick : true,
					locked     : false
				}
			}
		});
	});

	
</script> 