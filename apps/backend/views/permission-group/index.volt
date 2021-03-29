
<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ language._('information') }}</h3>
		</div>
		{{ form('class': 'form-horizontal') }}
			<div class="box-body">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('name') }} <span class="required">*</span></label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('name',(['class':'form-control','data-validate-length-range':'2','placeholder':language._('name'),'required':'required'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="permission">{{ language._('group_name') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('permission',(['class':'form-control select2_single'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('active') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('status',(['class':'form-control select2_single'])) }}
					</div>
				</div>
			</div>

			<div class="box-footer">
				<div class="col-md-2 col-sm-2 col-xs-12"></div>
				<div class="col-md-10 col-sm-10 col-xs-12">
					<button id="send" type="submit" class="btn btn-info">{{ language._('submit') }}</button>
					<button onclick="goBack()" class="btn btn-default pull-right">{{ language._('back') }}</button>
				</div>
			</div>
		{{ end_form() }}
	</div>
</section>

