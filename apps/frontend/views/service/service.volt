<div class="page-service  ">
    <div class="section main-content service service-list ">
          <div class="container">
                <div class="box-header"><div class="box-title">Dịch vụ của chúng tôi</div></div>
                  <div class="box-body">
                      {% if list_item is defined and list_item|length > 0 %}
                          {% for item in list_item %}
                                {% if loop.index is divisibleby(2) %}
                                <div class="item reverse wow">
                                    <div class="image" style="background-image: url('{{ url(item.image) }}'); align-items: initial;">
                                        <img src="{{ url(item.image) }}" />
                                    </div>
                                    <div class="contentWrapper">
                                        <div class="content">
                                            <div class="title">{{item.title}}</div>
                                            <div class="description">{{item.description}}</div>
                                            <a  onclick="getOption('{{item.title}}');popRegis()" href="javascript:void(0)" class="button">Liên hệ tư vấn</a>

                                        </div>
                                    </div>
                                </div>
                                   
                                {% else %}
                                <div class="item  wow fadeInLeft">
                                    <div class="contentWrapper ">
                                        <div class="content">
                                            <div class="title">{{item.title}}</div>
                                            <div class="description">{{item.description}}</div>
                                            <a  onclick="getOption('{{item.title}}');popRegis()" href="javascript:void(0)" class="button">Liên hệ tư vấn</a>

                                        </div>
                                    </div>
                                    <div class="image" style="background-image: url('{{ url(item.image) }}'); align-items: initial;">
                                        <img src="{{ url(item.image) }}" />
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

  