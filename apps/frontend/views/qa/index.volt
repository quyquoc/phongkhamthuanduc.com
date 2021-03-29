<div id="faqs" class="page-faqs faqs">
  <div class="breadcrumbs brb-header">
    <div class="container">
      <div class="container-wrapper">
        <div class="breadcrumbs-header">
          FAQs
        </div>
        <div class="breadcrumbs-nav">
          <span class="item"><a href="{{ url() }}" title="Trang chủ">Trang chủ</a></span>
          <span class="item_sep"> / </span>
          <span class="item">FAQs</span>
        </div>
      </div>
    </div>
  </div>

	<div class="main-content faqs faqs-list">
		<div class="container">
			<div class="module">
				<div class="module-content">
					{% if list_item and list_item|length > 0 %}
						{% for item in list_item %}
							<div class="item wow fadeInUp">
								<div class="box-qa-question">
									{{item.question}}										
								</div>
								<div class="box-qa-datetime">
									<span><i class="fa fa-calendar" aria-hidden="true"></i></span>
									{{date('d - m -Y', strtotime(item.created))}}
								</div>
								<section class="box-qa-answer">{{item.answer}}</section>
								<a class="link" href="{{ url('/faqs/' ~ item.code) }}">Xem thêm</a>
							</div>
						{% endfor %}
					{% endif %}
				</div>
			</div>
		</div>
	</div>
</div>


{#<div class="box-nav-sidebar box-border">
	<div class="box-header">
		<div class="box-title">
			gửi câu hỏi
		</div>
	</div>
	<div class="box-content-sidebar">
		<div class="box-form">
			<form action="" class="frm-qa" method="post">
				<div class="group-input">
					<input id="name" type="text" class="form-control check-value" name="fullname" value="{{ fullname is defined ? fullname : '' }}" />
					<label for="name">Họ tên</label>
				</div>
				<div class="group-input">
					<input id="phone" type="text" class="form-control check-value" name="phone" value="{{ phone is defined ? phone : '' }}" />
					<label for="phone">Số điện thoại</label>
				</div>
				<div class="group-input">
					<input id="email" type="text" class="form-control check-value" name="email" value="{{ email is defined ? email : '' }}" />
					<label for="email">Email</label>
				</div>
				<div class="group-input">
					<textarea id="question-content" class="form-control check-value" rows="7" name="question" value="{{ question is defined ? question : '' }}"></textarea>
					<label for="question-content">Nội dung</label>
				</div>
				<div class="group-input">
					{{ flashSession.output() }}
				</div>
				<div class="group-input group-button">
					<input type="submit" class="btn btn-primary" value="Gửi" />
				</div>
			</form>
		</div>
	</div>
</div>#}