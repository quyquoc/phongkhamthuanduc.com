{% if list_testimonial is defined and list_testimonial | length > 0 %}
	<div class="section box box-testimonial wow fadeInUp">
		<div class="container">
			<div class="container-wrapper">
				<div class="box-header"><h1 class="box-title">HỌ NÓI VỀ CHÚNG TÔI</h1></div>
				<div class="quote-slide">
					{% for item in list_testimonial %}
						<div class="item">
							<figure>
								<div class="avatar" style="background-image:url('{{ item.avatar }}')"><img src="{{ item.avatar }}"></div>
								<blockquote>
									<p class="quote">{{ item.description }}</p>
									<i class="fa fa-quote-right"></i>
									<p class="customer">
										<span class="name">{{ item.name }}</span>
										<span class="pos">{{ item.info }}</span>
									</p>
								</blockquote>
							</figure>
						</div>
					{% endfor %}
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('.quote-slide').slick({
		  dots: false,
		  infinite: true,
		  arrows: true,
		  autoplay: true,
		  slidesToShow: 1,
		  slidesToScroll: 1
		});
	</script>
{% endif %}