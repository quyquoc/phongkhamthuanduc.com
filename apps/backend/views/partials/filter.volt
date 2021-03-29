<tfoot>
	{% if column is defined %}
		<tr>
			{% for key,value in column %}
				{% if value.search is defined %}
					{% if value.search.active is not defined or value.search.active is true  %}
						{% if value.search.type == 'text' %}
							<td style="{{ value.search.width is defined ? 'width:'~value.search.width:'' }}">
								<input type="text" data="{{ value.data }}" data-column="{{key}}" class="form-control search-input-{{value.search.type}}" placeholder="{{value.title}}">
							</td>
						{% elseif value.search.type == 'select' %}
							<td style="{{ value.search.width is defined ? 'width:'~value.search.width:'' }}">
								<select class="form-control search-input-select" data-column="{{key}}" data="{{ value.data }}">
									<option value="">{{ value.title }}</option>
									{% for ks,vs in value.search.value %}
										{% if vs is not null %}
											<option value="{{ ks }}">{{ vs }}</option>
										{% endif %}
									{% endfor %}
								</select>
							</td>
						{% elseif value.search.type == 'button' %}
							<td>
								<button id="{{ value.search.id is defined ? value.search.id : '' }}" class="{{ value.search.class is defined ? value.search.class : '' }}" >Delete</button></th>
							</td>
						{% elseif value.search.type == 'button-add' %}
							<td>
								{{ value.search.value }}
							</td>
						{% endif %}
					{% else %}
						<td></td>
					{% endif %}
				{% else %}
					<td></td>
				{% endif %}
			{% endfor %}
		</tr>
	{% endif %}
</tfoot>