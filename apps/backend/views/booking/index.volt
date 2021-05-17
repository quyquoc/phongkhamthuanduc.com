
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
								<label class="control-label col-md-2 col-sm-2 col-xs-12">{{ language._('fullname') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('fullname',(['class':'form-control','placeholder':language._('fullname')])) }}
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">{{ language._('phone') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('phone',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">{{ language._('email') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('email',(['class':'form-control','placeholder':language._('email')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">{{ language._('Khoa') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('department_title',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">{{ language._('Ngày hẹn') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('from_date',(['class':'form-control','placeholder':language._('Ngày hẹn')])) }}
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
	
	CKEDITOR.replace('content',
	{
		filebrowserBrowseUrl        : "{{url('/library/ckfinder/ckfinder.html')}}",
		filebrowserUploadUrl        : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}",
		filebrowserImageUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}",
		filebrowserFlashUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}",
	});
</script>