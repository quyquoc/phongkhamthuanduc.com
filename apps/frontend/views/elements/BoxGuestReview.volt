{% if list_review is defined and list_review | length > 0 %}
	<section class="box box-quote bg-gray">
		<div class="container">
			<div class="box-header">
				<h1 class="box-title">Khách hàng đánh giá</h1>
			</div>
			<div class="quote-slide">
				{% for item in list_review %}
					<div class="item">
						<figure>
							{% set lnk_avatar = url(item.avatar ? item.avatar : '/favicon.png')  %}
							<div class="avatar" style="background-image:url('{{ lnk_avatar }}')"><img src="{{ lnk_avatar }}"></div>
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
	</section>

	<script type="text/javascript">
		$('.quote-slide').slick({
		  dots: true,
		  infinite: true,
		  arrows: false,
		  autoplay: true,
		  slidesToShow: 1,
		  slidesToScroll: 1
		});
	</script>
{% endif %}