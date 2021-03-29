{% if gallery is defined %}
  <div class="section box box-slide-da-thumbs">
    <div class="container">
      <div class="container-wrapper">
        <div class="box-header">
          <h1 class="box-title">Hình ảnh</h1>
        </div>
        <div class="box-body">
          <ul id="da-thumbs" class="da-thumbs">
            {% if type is defined and type == 'album' %}
              {% if gallery.imgs is not empty and gallery.imgs != '[]' %}
                {% set imgs = gallery.imgs | json_decode %}
                {% if imgs is iterable and imgs|length > 0 %}
                  {% for item in imgs %}
                    <li style="background-image: url('{{url(item.src)}}')">
                      <a href="{{ url(item.src) }}" data-fancybox="group-image">
                        <img src="{{ url(item.src) }}" />
                        <div></div>
                      </a>
                    </li>
                  {% endfor %}
                {% endif %}
              {% endif %}
            {% else %}
              {% for item in gallery %}
                <li style="background-image: url('{{url(item.image)}}')">
                  <a href="{{ url(item.image) }}" data-fancybox="group-image">
                    <img src="{{ url(item.image) }}" />
                    <div><span>{{ item.title }}</span></div>
                  </a>
                </li>
              {% endfor %}
            {% endif %}
          </ul>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(function() {
        $('#da-thumbs > li').each( function() { $(this).hoverdir(); } );
      });
    </script>
  </div>
{% endif %}