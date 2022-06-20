{% if list_partner is defined and list_partner | length > 0 %}
	<div class="section box box-partner bg-gray">
		<div class="container">
			<div class="container-wrapper">
				<div class="box-header">
					<h1 class="box-title">Đối tác</h1>
				</div>
				<div class="box-body">
					<div class="partner-slide">
						{% for item in list_partner %}
							{% if item.image is not empty %}
								<div class="item"><div class="image"><a href="{{ item.link ? item.link : '#' }}" target="{{ item.url_target }}" title="{{ item.title }}"><img src="{{ url(item.image) }}"></a></div></div>
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
			  arrows: true,
			  autoplay: true,
			  slidesToShow: 4,
			  slidesToScroll: 2,
			  responsive:[
					{
						breakpoint: 900,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 700,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		</script>
	</div>
{% endif %}
