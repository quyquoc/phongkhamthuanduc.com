
<div class="col-sm-9 col-md-9 col-xs-12">
	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">{{ language._('change_password') }} <small></small></h3>
		</div>

		{{ form('class': 'form-horizontal form-label-left','novalidate':'') }}
			<div class="box-body">
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_current">{{ language._('password_current') }} <span class="required">*</span>
					</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						{{ form.render('password',(['class':'form-control','data-validate-length-range':'2','placeholder':language._('password'),'required':'required'])) }}
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_new">{{ language._('password_new') }} <span class="required">*</span>
					</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						{{ form.render('password_new',(['class':'form-control','data-validate-length-range':'2','placeholder':language._('password_new'),'required':'required'])) }}
					</div>
				</div>
			</div>

			<div class="box-footer">
				<div class="col-md-3 col-sm-3 col-xs-12"></div>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<button id="send" type="submit" class="btn btn-info">{{ language._('submit') }}</button>
					<button onclick="goBack()" class="btn btn-default pull-right">{{ language._('back') }}</button>
				</div>
			</div>
		</form>
	</div>
</div>