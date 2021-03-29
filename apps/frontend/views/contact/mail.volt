<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title></title>
		<link rel="stylesheet" href="" />
	</head>
	<body>
		<p style="font-size:16pt;">{{ data["subject"] }}</p>
		<p>&nbsp;</p>
		<p style="font-size:14pt;">Thông tin của khách hàng:</p>
		
		{% if data['fullname'] is defined and data['fullname'] is not empty %}
			<p>Họ tên: {{ data["fullname"] }}</p>
		{% endif %} 

		{% if data['phone'] is defined and data['phone'] is not empty %}
			<p>Số điện thoại: {{ data["phone"] }}</p>
		{% endif %} 

		{% if data['from_email'] is defined and data['from_email'] is not empty %}
			<p>Email: {{ data["from_email"] }}</p>
		{% endif %} 

		{% if data['content'] is defined and data['content'] is not empty %}
			<p>Nội dung: {{ data["content"] }}</p>
		{% endif %}
	</body>
</html>
