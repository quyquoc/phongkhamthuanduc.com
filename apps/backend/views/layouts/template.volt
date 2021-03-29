
<div class="wrapper">
	{{ partial("partials/main-header") }}
	{{ partial("partials/main-sidebar") }}
		
	<div class="content-wrapper">
		<section class="content-header">
			{% if router.getControllerName() == 'index' %}     
				<h1>{{ title }}</h1>
			{% else %}
				<h1>
					<a href="{{ url(define.backend ~ '/' ~ router.getControllerName()) }}">{{ _controller is defined and _controller is not empty ? _controller : router.getControllerName() }}</a>
					<small>{{ _action is defined and _action is not empty ? _action : 'danh sách' }}</small>
				</h1>
				{#<ol class="breadcrumb">
					<li><a href="{{ url(define.backend) }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
					<li class="active">{{ _controller is defined and _controller is not empty ? _controller : router.getControllerName() }}</li>
				</ol>#}
			{% endif %}

			{% if flashSession.output() %}
				{{ flashSession.output() }}
			{% endif %}
		</section>

		{{ content() }}
	</div>

	{{ partial("partials/main-footer") }}
	{# partial("partials/control") #}

	{#<div id="custom_notifications" class="custom-notifications dsp_none">
		<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
		<div class="clearfix"></div>
		<div id="notif-group" class="tabbed_notifications"></div>
	</div>#}
</div>

<div class="modal fade" id="modal-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Xác nhận xóa</h4>
      </div>
      <form action="">
        <div class="modal-body">
          <p>Bạn chắc chắn muốn xóa: <b><span class="title"></span></b></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Chọn</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
