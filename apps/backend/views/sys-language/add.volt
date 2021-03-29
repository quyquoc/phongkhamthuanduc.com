
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
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="code">{{ language._('code') }} <span class="required">*</span></label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('code',(['class':'form-control','placeholder':language._('code'),'required':'required'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="description">{{ language._('description') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('description',(['class':'form-control','placeholder':language._('description')])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="default">{{ language._('default') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('default',(['class':'form-control'])) }}
							</div>
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
		{{ end_form() }}
	</div>
</section>

