{% if list_partner is defined and list_partner | length > 0 %}
	<div class="section box box-partner bg-gray">
		<div class="container">
			<div class="container-wrapper">
				<div class="box-header">
					<h1 class="box-title">Khách hàng</h1>
				</div>
				<div class="box-body">
					<div class="partner-slide">
						{% for item in list_partner %}
							{% if item.image is not empty %}
								<div class="item"><div class="image"><a href="{{ item.link ? item.link : '' }}" target="{{ item.url_target }}" title="{{ item.title }}"><img src="{{ url(item.image) }}"></a></div></div>
							{% endif %}
						{% endfor %}
					</div>
				</div>
			</div>
		</div>

		<script>
			$('.partner-slide').slick({
				dots: true,
				infinite: true,
				speed: 300,
				slidesToShow: 5,
				centerMode: true,
				variableWidth: true,
				arrows: false,
				autoplay: true
			});
		</script>
	</div>
{% endif %}
