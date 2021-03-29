
<!-- <div class="content-wrapper"> -->
	{#<section class="content-header">
		<h1>
			<a href="{{ url(define.backend ~ '/' ~ router.getControllerName()) }}">{{ _controller is defined and _controller is not empty ? _controller : router.getControllerName() }}</a>
			<small>{{ _action is defined and _action is not empty ? _action : 'Thông tin' }}</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url(define.backend) }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
			<li class="active">{{ _controller is defined and _controller is not empty ? _controller : router.getControllerName() }}</li>
		</ol>

		{% if flashSession.output() %}
			{{ flashSession.output() }}
		{% endif %}
	</section>#}
	
	<section class="content">
		<div class="row">
			{{ partial("account/sidebar") }}
			{{ content() }}
		</div>
	</section>
<!-- </div> -->
