
<section class="content">
	<div class="box">
		{{ form('class': 'form-horizontal') }}
			<div class="box-body">
				<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab">{{ language._('info_main') }}</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_1">
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="fullname">Họ Tên</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('fullname',(['class':'form-control','data-validate-length-range':'2','placeholder':'Họ Tên'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="username">{{ language._('accout') }} <span class="required">*</span></label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('username',(['class':'form-control','data-validate-length-range':'2','placeholder':language._('accout'),'required':'required'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="password">Mật khẩu<span class="required">*</span></label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('password',(['class':'form-control','data-validate-length-range':'2','placeholder':'Mật khẩu','required':'required'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">{{ language._('email') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('email',(['class':'form-control','placeholder':language._('email')])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="group_id">{{ language._('group_name') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('group_id',(['class':'form-control select2'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('active') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('status',(['class':'form-control select2'])) }}
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box-footer">
				<div class="col-md-2 col-sm-2 col-xs-12"></div>
				<div class="col-md-10 col-sm-10 col-xs-12">
					<button id="send" type="submit" class="btn btn-info">{{ language._('submit') }}</button>
					<a onclick="goBack()" class="btn btn-default pull-right">{{ language._('back') }}</a>
				</div>
			</div>
		{{ end_form() }}
	</div>
</section>

