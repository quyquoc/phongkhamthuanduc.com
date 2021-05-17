
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
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">{{ language._('title') }} <span class="required">*</span></label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('title',(['class':'form-control','placeholder':language._('title'),'required':'required'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="code">{{ language._('code') }} <span class="required">*</span></label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('code',(['class':'form-control','placeholder':language._('code'),'required':'required'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="data">{{ language._('data') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('data',(['class':'form-control'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="data">{{ language._('description') }} </label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('description',(['class':'form-control'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('image') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								<div class="input-group">
									{{ form.render('image',(['class':'form-control','placeholder':language._('image'),'ondblclick':'imageManager($(this))'])) }}
									<div class="input-group-btn">
										<button type="button" class="btn btn-danger" onclick="imageManager($('input[name=image]'));" data-target="image" data-view="view-img">Chọn ảnh</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('link') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('link',(['class':'form-control'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('url_target') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('url_target',(['class':'form-control'])) }}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12">{{ language._('active') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								{{ form.render('status',(['class':'form-control select2','data-placeholder':language._('status')])) }}
							</div>
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



<script>
	CKEDITOR.replace('data',
	{
		filebrowserBrowseUrl        : "{{url('/library/ckfinder/ckfinder.html')}}",
		filebrowserUploadUrl        : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}",
		filebrowserImageUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}",
		filebrowserFlashUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}",
	});
</script>
