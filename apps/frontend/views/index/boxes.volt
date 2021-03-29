<div id="boxes" class="boxes">
	<div class="breadcrumbs brb-header">
	  <div class="container">
			<div class="container-wrapper">
				<div class="breadcrumbs-header">
					Boxes
				</div>
				<div class="breadcrumbs-nav">
					<span class="item"><a href="{{ url() }}" title="Trang chủ">Trang chủ</a></span>
					<span class="item_sep"> / </span>
					<span class="item">Boxes</span>
				</div>
			</div>
		</div>
	</div>

	<div class="main-content">
		{{ partial('partials/boxes/BoxIntro') }}
		{{ partial('partials/boxes/BoxServices_1') }}
		{{ partial('partials/boxes/BoxServices_2') }}
		{{ partial('partials/boxes/BoxServices_3') }}
		{{ partial('partials/boxes/BoxAchievements') }}
		{{ partial('partials/boxes/BoxProcess_1') }}
		{{ partial('partials/boxes/BoxProcess_2') }}
		{{ partial('partials/boxes/BoxTestimonial') }}
	</div>

	{{ element.BoxSlideDAThumbs() }}
	{{ element.BoxPartner() }}
</div>

{{element.script(['slick'])}}
