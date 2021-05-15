<div class="page-service  ">
    <div class="section main-content service service-list ">
          <div class="container">
                <div class="box-header"><div class="box-title">Dịch vụ của chúng tôi</div></div>
                  <div class="box-body">
                      {% if list_item is defined and list_item|length > 0 %}
                          {% for item in list_item %}
                                {% if loop.index is divisibleby(2) %}
                                <div class="item reverse wow">
                                    <div class="image" style="background-image: url('{{ item.image is not empty ?  url(item.image) : url(assets) ~ '/images/img-contact.jpg' }}'); align-items: initial;">
                                        <img src="{{ item.image is not empty ?  url(item.image) : url(assets) ~ '/images/img-contact.jpg' }}" />
                                    </div>
                                    <div class="contentWrapper">
                                        <div class="content">
                                            <a href="{{url('/dich-vu/'~item.code)}}" class="title">{{item.title}}</a>
                                            <div class="description">{{item.description}}</div>
                                            <a  href="{{url('/dich-vu/'~ item.code)}}" class="button">Xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                                   
                                {% else %}
                                <div class="item  wow fadeInLeft">
                                    <div class="contentWrapper ">
                                        <div class="content">
                                            <a  href="{{url('/dich-vu/'~item.code)}}"  class="title">{{item.title}}</a>
                                            <div class="description">{{item.description}}</div>
                                            <a  href="{{url('/dich-vu/'~item.code)}}" class="button">Xem thêm</a>
                                        </div>
                                    </div>
                                    <div class="image" style="background-image: url('{{ item.image is not empty ?  url(item.image) : url(assets) ~ '/images/img-contact.jpg' }}'); align-items: initial;">
                                        <img src="{{ item.image is not empty ?  url(item.image) : url(assets) ~ '/images/img-contact.jpg' }}" />
                                    </div>
                                </div>
                                {% endif %}
                          {% endfor %}
                      {% endif %}
                  </div>
              </div>
          </div>
      </div>
  </div>

  