<div class="item {{ style is defined ? style : ''}} wow fadeInUp">
	<div class="item-wrap">
		<div class="image-wrap">
			<div class="image">
				<a href="{{ link }}" title="{{ item.title }}" style="background-image: url('{{ link_img }}')"><img src="{{ link_img }}"></a>
			</div>
		</div>
		<div class="content">
			<div class="published">{{ date('d-m-Y', strtotime(item.published)) }}</div>
			<h4 class="title"><a href="{{ link }}" title="{{ item.title }}">{{ item.title }}</a></h4>
			{#<div class="description">{{ item.description }}</div>#}
		</div>
	</div>
</div>
