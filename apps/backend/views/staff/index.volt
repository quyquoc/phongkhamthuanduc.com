
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
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('name') }} <span class="required">*</span></label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('fullname',(['class':'form-control','placeholder':'Tên','required':'required'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="code">{{ language._('code') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('code',(['class':'form-control','placeholder':'Mã','required':'required'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="staff_type_id">{{ language._('Vị trí') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('type_id',(['class':'form-control select2','data-placeholder':language._('Vị trí')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="staff_type_id">{{ language._('Chuyên khoa') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('department_id',(['class':'form-control select2','data-placeholder':language._('Chuyên khoa')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">{{ language._('Quản lý') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('manager',(['class':'form-control select2','data-placeholder':language._('Quản lý')])) }}
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
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="phone">{{ language._('phone') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('phone',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">{{ language._('email') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('email',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="facebook">{{ language._('facebook') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('facebook',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">{{ language._('active') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('status',(['class':'form-control select2','data-placeholder':language._('status')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('position') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('position',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="education">{{ language._('Nội dung') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('education',(['class':'form-control'])) }}
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
					<button onclick="goBack()" class="btn btn-default pull-right">{{ language._('back') }}</button>
				</div>
			</div>
		{{ end_form() }}
	</div>
</section>

<script>
	
	CKEDITOR.replace('education',
	{
		filebrowserBrowseUrl        : "{{url('/library/ckfinder/ckfinder.html')}}",
		filebrowserUploadUrl        : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}",
		filebrowserImageUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}",
		filebrowserFlashUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}",
	});
</script>

