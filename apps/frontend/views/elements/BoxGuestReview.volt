{% if list_review is defined and list_review | length > 0 %}
	<section class="section box box-testimonial">
		<div class="container">
			<div class="box-header">
				<h1 class="box-title">Khách hàng đánh giá</h1>
			</div>
			<div class="review-slide">
				{% for item in list_review %}
					<div class="item">
						{% set lnk_avatar = url(item.avatar ? item.avatar : '/favicon.png')  %}
					<div class="img"><div class="avatar" style="background-image: url('{{ lnk_avatar }}');"><img src="{{ lnk_avatar }}"></div></div>	
						<p class="description">{{ item.description }}</p>
						<p class="name">{{ item.name }} </p>
						<p class="pos">{{ item.info }} </p>
					</div>
				{% endfor %}
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$('.review-slide').slick({
		  dots: false,
		  infinite: true,
		  arrows: true,
		  autoplay: true,
		  slidesToShow: 1,
		  slidesToScroll: 1
		});
	</script>
{% endif %}