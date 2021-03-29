<section class="content">
	{% if role=="full" or in_array('news-article', role) %}
		<div class="row">
		  <div class="col-xs-12 connectedSortable">
				<div class="box box-info">
					<div class="box-header with-border">
						<i class="fa fa-newspaper-o"></i>
						<h3 class="box-title">Bài viết mới nhất</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>

					<div class="box-body">
						<div class="table-responsive">
							<table class="table no-margin">
								<thead>
									<tr>
										<th>{{ language._('title')}}</th>
										<th>{{ language._('status') }}</th>
										<th>{{ language._('created') }}</th>
									</tr>
								</thead>
								<tbody>
									{% if latest_article %}
										{% for item in latest_article %}
											<tr>
												<td>{{ link_to('/admin/news-article/index/update/' ~ item.id, item.title) }}</td>
												<td>
													{{ item.status == 1 ? '<span class="label label-success">Hoạt động</span>' : '<span class="label label-danger">Tin đóng</span>' }}
												</td>
												<td>
													<?= date('Y-m-d', strtotime($item->created)) ?>
												</td>
											</tr>
										{% endfor %}
									{% endif %}
								</tbody>
							</table>
						</div>
					</div>

					<div class="box-footer clearfix">
						<a href="{{ url('/admin/news-article/index/add') }}" class="btn btn-sm btn-info btn-flat pull-left">{{ language._('add_new') }}</a>
						<a href="{{ url('/admin/news-article') }}" class="btn btn-sm btn-default btn-flat pull-right">{{ language._('more') }}</a>
					</div>
				</div>
		  </div>
			{#<div class="col-lg-6 col-xs-12">
				<div class="box box-success">
					<div class="box-header">
						<i class="fa fa-bar-chart-o"></i>
						<h3 class="box-title">Thống kê bài viết</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>

					<div class="box-body">	
						<div class="chart active" id="bar-chart" style="height: 300px;"></div>
					</div>
				</div>
			</div>#}
		</div>
	{% endif %}
</section>



