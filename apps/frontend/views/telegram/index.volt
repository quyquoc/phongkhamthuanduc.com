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

{% if data['room_name'] is defined and data['room_name'] is not empty %}
    <p>Phòng đặt: {{ data["room_name"] }}</p>
{% endif %} 

{% if data['numbers'] is defined and data['numbers'] is not empty %}
    <p>Số người đến: {{ data["numbers"] }}</p>
{% endif %} 

{% if data['adults'] is defined and data['adults'] is not empty %}
    <p>Số người lớn: {{ data["adults"] }}</p>
{% endif %} 

{% if data['children'] is defined and data['children'] is not empty %}
    <p>Số người trẻ nhỏ: {{ data["children"] }}</p>
{% endif %} 

{% if data['arrive'] is defined and data['arrive'] is not empty %}
    <p>Ngày nhận phòng: {{ data["arrive"] }}</p>
{% endif %} 

{% if data['depart'] is defined and data['depart'] is not empty %}
    <p>Ngày trả phòng: {{ data["depart"] }}</p>
{% endif %} 

{% if data['province'] is defined and data['province'] is not empty %}
    <p>Tỉnh/Thành phố: {{ data["province"] }}</p>
{% endif %} 

{% if data['address'] is defined and data['address'] is not empty %}
    <p>Địa chỉ cụ thể: {{ data["address"] }}</p>
{% endif %} 

{% if data['content'] is defined and data['content'] is not empty %}
    <p>Nội dung: {{ data["content"] }}</p>
{% endif %}