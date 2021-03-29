
<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ language._('information') }}</h3>
		</div>
		{{ form('class': 'form-horizontal') }}
			<div class="box-body">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">{{ language._('title') }} <span class="required">*</span></label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('title',(['class':'form-control','data-validate-length-range':'2','placeholder':language._('title'),'required':'required'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="code">{{ language._('code') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('code',(['class':'form-control','placeholder':language._('code')])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="image">{{ language._('image') }}</label>
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
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('active') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('status',(['class':'form-control select2_single'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="featured">{{ language._('featured') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('featured',(['class':'form-control'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="position">{{ language._('order') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('position',(['class':'form-control','required':'required','placeholder': language._('input_number')])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="content">{{ language._('content') }} <span class="required">*</span></label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('content',(['class':'form-control'])) }}
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
	CKEDITOR.replace('content',
	{
		filebrowserBrowseUrl        : "{{url('/library/ckfinder/ckfinder.html')}}",
		filebrowserUploadUrl        : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}",
		filebrowserImageUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}",
		filebrowserFlashUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}",
	});
</script>


