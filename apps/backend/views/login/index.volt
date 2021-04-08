<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Hệ thống quản lý</title>
		{{ stylesheet_link(['/favicon.png','rel':'shortcut icon']) }}
		{{ stylesheet_link("/library/bootstrap/css/bootstrap.min.css") }}
		{{ stylesheet_link("/library/icheck/square/blue.css") }}
		{{ stylesheet_link("/backend/template/css/AdminLTE.min.css") }}
		{{ stylesheet_link("/backend/template/css/style.css") }}

		{{ javascript_include("/library/jQuery/jquery-3.4.1.min.js") }}
		{{ javascript_include("/library/bootstrap/js/bootstrap.min.js") }}
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="{{ url() }}" target="_blank">Phòng khám<b>Thuận Đức</b></a>
			</div>
			<div class="login-box-body">
				<p class="login-box-msg">Đăng nhập hệ thống</p>
				
				{{ form() }}
					<div class="form-group has-feedback">
						{{ form.render('username',(['class':'form-control','placeholder':language._('username'),'required':'required'])) }}
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						{{ form.render('password',(['class':'form-control','placeholder':language._('password'),'required':'required'])) }}
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-12 text-center">
							<button type="submit" class="btn btn-primary btn-flat"> {{ language._('login') }}</button>
						</div>
					</div>
				{{ end_form() }}
			</div>
		</div>
		
		<div class="notice text-center">
			<div class="inner text-center">
				{% if flashSession.output() %}
					{{ flashSession.output() }}
				{% endif %}
			</div>
		</div>

		<script>$('#username').focus();</script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</body>
</html>
