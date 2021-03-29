<div id="news-detail" class="page-news detail">	
	<div class="heading">
		<div class="container">
			<div class="content">
				<div class="title">FAQs</div>
				<div class="navigation">
					<span class="item"><a href="{{ url() }}" title="Trang chủ">Trang chủ</a></span>
					<span class="item_sep"> / </span>
					<span class="item"><a href="{{ url('/faqs') }}" title="FAQs">FAQs</a></span>
				</div>
			</div>
		</div>
	</div>

	<div class="main-content faqs faqs-detail">
		<div class="container">
			<div class="module">
				<h1 class="title">{{ faqs.question }}</h1>
				<div class="module-content">
					<div class="item">
						<div class="content-detail">
							<div class="content">{{ faqs.answer }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>
