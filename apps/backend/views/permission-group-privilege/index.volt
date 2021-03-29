
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ language._('list') }} <small></small></h3>
    </div>

    <div class="box-body">
    	<table class="table table-striped responsive-utilities jambo_table table-permission"> 
				<thead> 
					<tr> 
						<th>{{ language._('id') }}</th> 
						<th>{{ language._('name') }}</th> 
						<th>{{ language._('privilege') }}</th>
						{% for v in action %}
							<th><?= $v ?></th>
						{% endfor %} 
						<th>{{ '<a class="btn btn-success add-new" href="' ~ url(define.backend ~ '/' ~ router.getControllerName()) ~ '/add"><i class="fa fa-plus m-right-xs"></i> Thêm mới</a>' }}</th> 
					</tr> 
				</thead>
				<tbody> 
					{%  for key,value in role_view  %}
						<tr>
							{#<td rowspan="{{ value|length + 1 }}">{{ key }}</td>#}
							<td rowspan="{{ value|length + 1 }}">{{ link_to(define.backend ~ '/' ~ router.getControllerName()~'/edit/'~key,group_detail.getDetailGroup(key).name) }}</td>
						</tr>
						{% for k_1,v_1 in value %}
							<tr>
								<td>{{ k_1 }}</td>
								{% for k_action,v_action in action %}
									<td>
										{% if k_action in v_1|keys %}
											<span class="glyphicon glyphicon-check glyphicon-check-on"></span>
										{% else %}
											<span class="glyphicon glyphicon-ban-circle glyphicon-ban-circle-off"></span> 
										{% endif %}
									</td>
								{% endfor %}
								
								<td>{{ link_to(define.backend ~ '/' ~ router.getControllerName()~'/deleteRole/'~key~'/'~k_1,'<i class="fa fa-trash-o"></i> '~language._('delete'),'class':'btn btn-danger btn-xs btn-delete') }}
							</tr>
						{% endfor %}
					{% endfor %}
				</tbody> 
			</table>
    </div>
  </div>
</section>

