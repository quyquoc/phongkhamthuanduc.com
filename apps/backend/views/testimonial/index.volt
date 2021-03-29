<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ language._('information') }}</h3>
		</div>
		{{ form('class': 'form-horizontal') }}
			<div class="box-body">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('fullname') }} <span class="required">*</span></label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('name',(['class':'form-control','data-validate-length-range':'2','placeholder':language._('fullname'),'required':'required'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="info">{{ language._('information') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('info',(['class':'form-control'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="avatar">{{ language._('avatar') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<div class="input-group">
							{{ form.render('avatar',(['class':'form-control','placeholder':language._('avatar'),'ondblclick':'imageManager($(this))'])) }}
							<div class="input-group-btn">
								<button type="button" class="btn btn-danger" onclick="imageManager($('input[name=avatar]'));" data-target="avatar" data-view="view-img">Chọn ảnh</button>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="description">{{ language._('description') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('description',(['class':'form-control'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('active') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('status',(['class':'form-control select2'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="position">{{ language._('order') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('position',(['class':'form-control'])) }}
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


