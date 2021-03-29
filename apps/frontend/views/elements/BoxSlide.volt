
{% if slide is defined %}
  <div class="box-slider">
    <div class="slideshow-container">
      {% if type is defined and type == 'album' %}
        {% if slide.imgs is not empty and slide.imgs != '[]' %}
          {% set imgs = slide.imgs | json_decode %}
          {% if imgs is iterable and imgs|length > 0 %}
            {% for item in imgs %}
              <div class="item">
               <a href="javascript:void(0);" style="background-image:url('{{url(item.src)}}');"><img src="{{ url(item.src) }}" /></a>
              </div>
            {% endfor %}
          {% endif %}
        {% endif %}
      {% else %}
        {% for item in slide %}
          <div class="item">
            <a href="{{item.link}}" style="background-image: url('{{ url(item.image) }}');"><img src="{{ url(item.image) }}"></a>
          </div>
        {% endfor %}
      {% endif %}
    </div>
    <script>
      $(document).ready(function(){
        $('.slideshow-container').slick({
          dots: true,
          infinite: true,
          speed: 500,
          fade: true,
          autoplay: true,
          cssEase: 'linear'
        });
      });
    </script>
  </div>
{% endif %}
