
{{ stylesheet_link("/library/bootstrap/css/bootstrap.min.css") }}
<!-- adminLTE -->
{{ stylesheet_link("/backend/template/css/AdminLTE.min.css") }}
{{ stylesheet_link("/backend/template/css/skins/_all-skins.min.css") }}
{{ stylesheet_link("/library/morris/morris.css") }}
{{ stylesheet_link("/library/jvectormap/jquery-jvectormap-1.2.2.css") }}
{{ stylesheet_link("/library/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}
{{ stylesheet_link("/library/select2/select2.min.css") }}
{{ assets.outputCss() }}
{{ stylesheet_link("/backend/template/css/style.css") }}

<script>
	var ROOT_URL 		= "{{ url() }}";
	var confirm     = JSON.parse('{{language._("confirm")}}');
	var js_message  = JSON.parse('{{language._("js_message")}}');
</script>
{{ javascript_include("/library/jQuery/jquery.min.js") }}
{{ javascript_include("/library/bootstrap/js/bootstrap.min.js") }}
{{ javascript_include("/backend/template/js/init.js") }}
{{ javascript_include("/library/ckeditor/ckeditor.js") }}
{{ javascript_include("/library/ckfinder/ckfinder.js") }}
{{ javascript_include("/backend/template/js/ckfinder_function.js") }}
{{ javascript_include("/library/select/select2.full.js") }}
{{ javascript_include("/library/icheck/icheck.min.js") }}
<!-- Confirm -->
{# javascript_include("/backend/template/js/confirm/jquery.confirm.min.js") #}
<!-- adminLTE -->
{{ javascript_include("/library/slimScroll/jquery.slimscroll.min.js") }}
{{ javascript_include("/library/fastclick/fastclick.js") }}
{{ javascript_include("/backend/template/js/admin-lte/adminlte.min.js") }}
<!-- form validation -->
{{ javascript_include("/backend/template/js/validator/validator.js") }}
{{ assets.outputJs() }}

<script>
	// initialize the validator function
	validator.message['invalid']            = "{{ language._('vali_invalid') }}";
	validator.message['empty']              = "{{ language._('vali_empty') }}";
	validator.message['min']                = "{{ language._('vali_min') }}";
	validator.message['max']                = "{{ language._('vali_max') }}";
	validator.message['number_min']         = "{{ language._('vali_number_min') }}";
	validator.message['number_max']         = "{{ language._('vali_number_min') }}";
	validator.message['url']                = "{{ language._('vali_url') }}";
	validator.message['number']             = "{{ language._('vali_number') }}";
	validator.message['email']              = "{{ language._('vali_email') }}";
	validator.message['email_repeat']       = "{{ language._('vali_email_repeat') }}";
	validator.message['password_repeat']    = "{{ language._('vali_password_repeat') }}";
	validator.message['repeat']             = "{{ language._('vali_repeat') }}";
	validator.message['complete']           = "{{ language._('vali_complete') }}";
	validator.message['select']             = "{{ language._('vali_select') }}";

	// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
	$('form')
		.on('blur', 'input[required], input.optional, select.required', validator.checkField)
		.on('change', 'select.required', validator.checkField)
		.on('keypress', 'input[required][pattern]', validator.keypress);

	$('.multi.required')
		.on('keyup blur', 'input', function () {
			validator.checkField.apply($(this).siblings().last()[0]);
		});

	// bind the validation to the form submit event
	//$('#send').click('submit');//.prop('disabled', true);

	$('form').submit(function (e) {
		e.preventDefault();
		var submit = true;
		// evaluate the form using generic validaing
		if (!validator.checkAll($(this))) {
			submit = false;
		}

		if (submit)
			this.submit();
		return false;
	});

	/* FOR DEMO ONLY */
	$('#vfields').change(function () {
		$('form').toggleClass('mode2');
	}).prop('checked', false);

	$('#alerts').change(function () {
		validator.defaults.alerts = (this.checked) ? false : true;
		if (this.checked)
			$('form .alert').remove();
	}).prop('checked', false);
	
	$(document).ready(function() {
		$(".select2").select2();
	});
</script>