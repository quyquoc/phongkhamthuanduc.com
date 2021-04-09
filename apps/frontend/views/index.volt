<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{{ (head['title'] is defined and head['title'] is not empty) ? head['title'] | striptags ~ ' | Phòng khám đa khoa Thuận Đức | phongkhamthuanduc.com' : 'Phòng khám đa khoa Thuận Đức | phongkhamthuanduc.com' }}</title>
	<meta name="description" content="{{ (head['description'] is defined and head['description'] is not empty) ? head['description']|striptags : 'Phòng khám đa khoa Thuận Đức' }}" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ seo_title is defined and seo_title is not empty ? seo_title|striptags : (head['title'] is defined and head['title'] is not empty ? head['title']|striptags : 'Phòng khám đa khoa Thuận Đức') }}" />
	<meta property="og:url" content="{{ (head['url'] is defined and head['url'] is not empty) ? head['url'] : url() }}" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image" content="{{ seo_image is defined and seo_image is not empty ? url(seo_image) : (head['image'] is defined and head['image'] is not empty ? url(head['image']) : assets ~ '/images/fb_share.png') }}" />
	<meta property="og:image:url" content="{{ seo_image is defined and seo_image is not empty ? url(seo_image) : (head['image'] is defined and head['image'] is not empty ? url(head['image']) : assets ~ '/images/fb_share.png') }}" />
	<meta property="og:image:alt" content="{{ seo_title is defined and seo_title is not empty ? seo_title|striptags : (head['title'] is defined and head['title'] is not empty ? head['title']|striptags : 'Phòng khám đa khoa Thuận Đức') }}" />
	<meta property="og:site_name" content="{{ seo_title is defined and seo_title is not empty ? seo_title|striptags : (head['title'] is defined and head['title'] is not empty ? head['title']|striptags : 'Phòng khám đa khoa Thuận Đức') }}" />
	<meta property="og:description" content="{{ seo_description is defined and seo_description is not empty ? seo_description|striptags : (head['description'] is defined and head['description'] is not empty ? head['description']|striptags : 'Phòng khám đa khoa Thuận Đức') }}" />
	<meta name="keywords" content="ohivn, ohi, ở huế, dich vu, dịch vụ, tiện tích, tien ich, tiện ích cuộc sống, tien ich cuoc song" />
	<meta name="robots" content="index,follow" />
	<meta name="alexa" content="100">
	<meta name="revisit" content="2 days">
	<meta name="revisit-after" content="2 days">
	<meta name="copyright" content="ohi.vn" />
	<meta name="author" content="ohi.vn" />
	<base target='_self'/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	{{ stylesheet_link(['/logo.svg','rel':'shortcut icon']) }}
	{{ assets.outputCss() }}
	{{ stylesheet_link("/library/font-awesome-4.7.0/css/font-awesome.min.css") }}
	{{ stylesheet_link("/library/fancybox-master/dist/jquery.fancybox.css") }}
	{{ stylesheet_link("/library/bootstrap-4.3.1/css/bootstrap.min.css") }}
	{{ stylesheet_link("/library/animate/animate.css") }}
	{{ stylesheet_link(assets_dir ~ "/css/style.css") }}
	<script type="text/javascript">var url = "{{ url() }}";</script>
	{{ javascript_include("/library/jQuery/jquery-3.4.1.min.js") }}
	{{ javascript_include("/library/datepicker/bootstrap-datepicker.js") }}
	{{ javascript_include("/library/timepicker/bootstrap-timepicker.js") }}
	{{ javascript_include("/library/fancybox-master/dist/jquery.fancybox.js") }}
	{{ javascript_include("/library/bootstrap-4.3.1/js/bootstrap.min.js") }}
	{{ javascript_include("/library/wow/wow.min.js") }}
	{{ assets.outputJs() }}
	{{ javascript_include(assets_dir ~ "/js/main.js") }}
</head>
<body>
	{{ content() }}
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
