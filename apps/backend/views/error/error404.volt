<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Hệ thống quản lý</title>
		{{- stylesheet_link(['/favicon.ico','rel':'shortcut icon']) -}}
		{{- stylesheet_link("/library/bootstrap/css/bootstrap.min.css") -}}
		{{- stylesheet_link("/backend/template/css/AdminLTE.min.css") -}}
		{{- stylesheet_link("/backend/template/css/login.css") -}}
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition login-page">
		<section class="content">
			<div class="col-md-12">
				<div class="col-middle">
					<div class="text-center text-center">
						<h1 class="error-number">404</h1>
						<h2>Trang không được tìm thấy!</h2>
						<div class="mid_center">
							<p>Quay lại <a href="{{ url(define.backend) }}">Trang chủ</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		{{- javascript_include("/library/jQuery/jquery-3.1.1.min.js") -}}
		{{- javascript_include("/library/bootstrap/js/bootstrap.min.js") -}}
	</body>
</html>