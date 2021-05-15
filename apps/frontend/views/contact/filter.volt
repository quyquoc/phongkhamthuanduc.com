{% if list_doctor and list_doctor|length > 0 %}
    <option value="">Chọn bác sĩ</option>
    {% for item in list_doctor %}
        <option value="{{ item.fullname }}">{{ item.fullname }}</option>
    {% endfor %}
{% endif %}
