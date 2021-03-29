
<section class="content">
	<div class="box">
		{{ form('class': 'form-horizontal') }}
			<div class="box-body">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
					  <li class="active"><a href="#tab_1" data-toggle="tab">{{ language._('info_main') }}</a></li>
					  <li><a href="#tab_2" data-toggle="tab">{{ language._('config') }}</a></li>
					  <li><a href="#tab_3" data-toggle="tab">SEO</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('title') }} <span class="required">*</span></label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('title',(['class':'form-control','data-validate-length-range':'2','placeholder':language._('title'),'required':'required'])) }}
								</div>
							</div>
						
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('category') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('category_id[]',(['class':'form-control select2','multiple':'multiple','data-placeholder':'Chọn danh mục'])) }}
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
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="description">{{ language._('description') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('description',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="content">{{ language._('content') }} <span class="required">*</span></label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('content',(['class':'form-control'])) }}
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_2">
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('code') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('code',(['class':'form-control','placeholder': language._('code')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('link') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('link',(['class':'form-control','placeholder': language._('link')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('url_target') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('url_target',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('active') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('status',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('featured') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('featured',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('order') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('position',(['class':'form-control','placeholder': language._('order')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('published') }}:</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									<div class='input-group date' id='datetimepicker'>
										{{ form.render('published',(['class':'form-control','placeholder': language._('published')])) }}
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
									<span class="add-on">
										<i data-time-icon="icon-time" data-date-icon="glyphicon glyphicon-calendar"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_3">
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('title') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('seo_title',(['class':'form-control','placeholder':language._('title')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('description') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('seo_description',(['class':'form-control','placeholder':language._('description')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('image') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									<div class="input-group">
										{{ form.render('seo_image',(['class':'form-control','placeholder':language._('image'),'ondblclick':'imageManager($(this))'])) }}
										<div class="input-group-btn">
											<button type="button" class="btn btn-danger" onclick="imageManager($('input[name=seo_image]'));" data-target="image" data-view="view-img">Chọn ảnh</button>
										</div>
									</div>
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
	$(document).ready(function() {

		var published = "<?php echo $form->getValue('published') != '' ? date('Y-m-d H:i:s', strtotime($form->getValue('published'))) : date('Y-m-d H:i:s') ?>";
		if(published !== ""){
			$('#datetimepicker').datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss',
				defaultDate: published,
			});  
		}
	});

	CKEDITOR.replace('description',
	{
		filebrowserBrowseUrl        : "{{url('/library/ckfinder/ckfinder.html')}}",
		filebrowserUploadUrl        : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}",
		filebrowserImageUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}",
		filebrowserFlashUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}",
	});

	CKEDITOR.replace('content',
	{
		filebrowserBrowseUrl        : "{{url('/library/ckfinder/ckfinder.html')}}",
		filebrowserUploadUrl        : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}",
		filebrowserImageUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}",
		filebrowserFlashUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}",
	});
</script>
