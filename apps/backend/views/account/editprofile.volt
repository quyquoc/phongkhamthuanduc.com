
<div class="col-sm-9 col-md-9 col-xs-12">
	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">{{ language._('edit') ~ ' ' ~ language._('profile') }} <small></small></h3>
		</div>

		{{ form('class': 'form-horizontal form-label-left','novalidate':'') }}
			<div class="box-body">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="fullname">{{ language._('fullname') }} <span class="required">*</span></label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('fullname',(['class':'form-control','data-validate-length-range':'2','placeholder':language._('fullname'),'required':'required'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="phone">{{ language._('phone') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('phone',(['class':'form-control','placeholder':language._('phone')])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="address">{{ language._('address') }} </label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('address',(['class':'form-control','placeholder':language._('address')])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="gender">{{ language._('gender') }} </label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('gender',(['class':'form-control','placeholder':language._('gender')])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="birthday">{{ language._('birthday') }} </label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" id="birthday" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?= $form->getValue('birthday') != '' ? date('d-m-Y', strtotime($form->getValue('birthday'))) : '' ?>">
						</div>
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
		{{ end_form }}
	</div>
</div>

<script type="text/javascript">
	$(function () {
		//Datemask dd/mm/yyyy
		$("#birthday").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
	});
</script>
 