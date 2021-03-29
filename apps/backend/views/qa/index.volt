
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
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('fullname') }}  </label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('fullname',(['class':'form-control','data-validate-length-range':'2','placeholder':language._('fullname')])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('phone') }} </label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('phone',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('email') }} </label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('email',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="question">{{ language._('Câu hỏi') }}<span class="required">*</span></label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('question',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="answer">{{ language._('Hồi đáp') }} </label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('answer',(['class':'form-control'])) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">{{ language._('status') }}</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									{{ form.render('status',(['class':'form-control'])) }}
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

	CKEDITOR.replace('answer',
	{
		filebrowserBrowseUrl        : "{{url('/library/ckfinder/ckfinder.html')}}",
		filebrowserUploadUrl        : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}",
		filebrowserImageUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}",
		filebrowserFlashUploadUrl   : "{{url('/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}",
	});
	
</script>