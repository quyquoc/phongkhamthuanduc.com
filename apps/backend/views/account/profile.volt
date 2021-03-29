
<div class="col-sm-9 col-md-9 col-xs-12">
	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">{{ language._('profile') }} <small></small></h3>
		</div>

		<div class="box-body">
			<table class="table table-striped">
				<tbody>
					<tr>
						<td width="200px">{{ language._('fullname') }}:</td>
						<td>{{ member.item.fullname }}</td>
					</tr>
					<tr>
						<td>{{ language._('group_name') }}:</td>
						<td>{{ member.item.permission_group.name }}</td>
					</tr>
					<tr>
						<td>{{ language._('email') }}:</td>
						<td><a href="mailto:{{ member.item.email }}">{{ member.item.email }}</a></td>
					</tr>
					<tr>
						<td>{{ language._('birthday') }}:</td>
						<td>{{ member.item.birthday }}</td>
					</tr>
					<tr>
						<td>{{ language._('address') }}:</td>
						<td>{{ member.item.address }}</td>
					</tr>
					<tr>
						<td>{{ language._('phone') }}:</td>
						<td>{{ member.item.phone }}</td>
					</tr>
					<tr>
						<td>{{ language._('gender') }}</td>
						<td>{{ member.item.gender == 1 ? language._('male') : language._('famale') }}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="box-footer">
			<a href="{{ url(define.backend ~ '/account/editprofile') }}" data-toggle="tooltip" type="button" class="btn btn-danger pull-right">Cập nhật</a>
		</div>
	</div>
</div>
 