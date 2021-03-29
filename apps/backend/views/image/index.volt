
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
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="album_id">Album</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('album_id',(['class':'form-control select2'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="gallery">{{ language._('Hình ảnh') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<div class="panel-body">
							<div id="multi_upload_images" class="col-md-12 col-sm-12 col-xs-12 dropzone dz-clickable dz-started">
								{% if model is defined and model.imgs is not empty and model.imgs != '[]' %}
									{% set imgs = model.imgs | json_decode %}
									{% if imgs is iterable and imgs|length > 0 %}
										{% for i in imgs %}
											<div class="dz-preview dz-error">
												<input type="hidden" name="img[]" value="{{i.src}}" />
												<input class="radi" type="radio" {{ i.default == 1 ? 'checked' : '' }} value="{{i.src}}" name="is" >
												<div class="dz-image">
													<img data-dz-thumbnail="" alt="" src="{{i.src}}">
												</div>  
											</div>
										{% endfor %}
									{% endif %}
								{% endif %}
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="link">{{ language._('link') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
							{{ form.render('link',(['class':'form-control'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="url_target">{{ language._('url_target') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
							{{ form.render('url_target',(['class':'form-control'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="featured">{{ language._('featured') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
							{{ form.render('featured',(['class':'form-control'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="status">{{ language._('active') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('status',(['class':'form-control'])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="position">{{ language._('order') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('position',(['class':'form-control','placeholder': language._('input_number')])) }}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="content">{{ language._('content') }}</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						{{ form.render('content',(['class':'form-control col-md-12 col-xs-12','rows':'5'])) }}
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
		//multi_upload_images
		$('#multi_upload_images').click(function(event) {
			var _obj = $(this);
			var finder = new CKFinder();
			finder.selectActionFunction = function (fileUrl, data) {
				var item = '<div class="dz-preview dz-error"><input type="hidden" name="img[]" value="'+fileUrl+'" /><input class="radi" type="radio" value="'+fileUrl+'" name="is" ><div class="dz-image"><img data-dz-thumbnail="" alt="" src="'+fileUrl+'"></div>';
				_obj.append(item);
			}
			finder.popup();
		}); 

		$('#multi_upload_images').on('click', '.radi', function(event){ 

			event.stopPropagation();            
		});

		$('#multi_upload_images').on('click', '.dz-image', function(event){ 
			event.stopPropagation();
			$(this).parent('.dz-preview').remove();
		});

		CKEDITOR.replace('content',
		{
			filebrowserBrowseUrl        : "{{url('/library/ckfinder/ckfinder.html')}}",
			filebrowserUploadUrl        : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}",
			filebrowserImageUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}",
			filebrowserFlashUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}",
		});
	});
</script>


