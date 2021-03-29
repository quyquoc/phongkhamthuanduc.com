<div id="contact" class="page-contact">
  <div class="breadcrumbs brb-header">
    <div class="container">
      <div class="container-wrapper">
        <div class="breadcrumbs-header">
          Liên hệ
        </div>
        <div class="breadcrumbs-nav">
          <span class="item"><a href="{{ url() }}" title="Trang chủ">Trang chủ</a></span>
          <span class="item_sep"> / </span>
          <span class="item">Liên hệ</span>
        </div>
      </div>
    </div>
  </div>

  <div class="main-content contact">
    <div class="container">
      <div class="module">
        {#<div class="module-header">
          <h1 class="module-title"><span>Liên hệ chúng tôi</span></h1>
        </div>#}
        <div class="module-content">
          <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.023167609827!2d106.63675201510218!3d11.03688855734923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d1f2396d5ead%3A0xc3b4483e0085bd02!2zNTYwIFFMMTMsIFTDom4gxJDhu4tuaCwgQuG6v24gQ8OhdCwgQsOsbmggRMawxqFuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2sus!4v1600923051131!5m2!1svi!2sus" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>       
          <div class="contact-form">
            <div class="form">
              <p>Vui lòng gửi thông tin. Chúng tôi sẽ phản hồi lại sớm cho bạn.</p>
              <div class="contact-notice">
                <div class="notice success">Thông tin đã gửi thành công!</div>
                <div class="notice error">Lỗi! Không gửi được thông tin!</div>
              </div>
              <div id="loading"><img src="{{ assets }}/images/loading.gif" /></div>
              <input class="fullname" name="fullname" id="fullname" type="text" placeholder="Họ Tên">
              <input class="phone" name="phone" id="phone" type="phone" placeholder="Điện thoại">
              <input class="mail" name="from_email" id="email" type="email" placeholder="Email">
              <textarea name="content" id="content" rows="5" placeholder="Nhập nội dung"></textarea>   
              <a href="javascript:void(0)" class="button send">Gửi</a>
            </div>
          </div>       
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(".contact .contact-form .send").click(function() {
    var param = new Object();
        param.fullname    = $('input[name="fullname"]').val();
        param.phone       = $('input[name="phone"]').val();
        param.from_email  = $('input[name="from_email"]').val();
        param.content     = $('textarea[name="content"]').val();
        form              = ".contact .contact-form";
    send(form, param);
  });

  function send(form, param) {
    var url     = "{{ url('/gui-lien-he') }}";
    var email_regex = /^([a-zA-Z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    var focus = '';

    if(param.fullname == "") {
      $(form + ' input[name="fullname"]').addClass('error');
      if (focus == '') {
        focus = form + ' input[name="fullname"]';
      }
    } else { $(form + ' input[name="fullname"]').removeClass('error'); }

    if(param.phone == "") {
      $(form + ' input[name="phone"]').addClass('error');
      if (focus == '') {
        focus = form + ' input[name="phone"]';
      }
    } else { $(form + ' input[name="fullname"]').removeClass('error'); }

    if(!email_regex.test(param.from_email) && param.from_email != "") {
      $(form + ' input[name="from_email"]').addClass('error');
      if (focus == '') {
        focus = form + ' input[name="from_email"]';
      }
    } else { $(form + ' input[name="from_email"]').removeClass('error'); }

    if(param.content == "") {
      $(form + ' textarea[name="content"]').addClass('error');
      if (focus == '') {
        focus = form + ' textarea[name="content"]';
      }
    } else { $(form + ' textarea[name="content"]').removeClass('error'); }

    if(focus !==  '') {
      $(focus).focus();
      return;
    }

    $(form + ' #loading').fadeIn('fast');
    $.post(url, param, function(data){
      if(data === "Send message sucessfull!") {
        $(form + ' #loading').fadeOut('fast');
        $(form + " .notice.success").html(data);
        $(form + " .notice.success").slideDown('slow').delay(3000).slideUp('slow');
        clear_form(form);
      }else {
        $(form + ' #loading').fadeOut('fast');
        $(form + " .notice.error").html(data);
        $(form + " .notice.error").slideDown('slow').delay(3000).slideUp('slow');
      }
    });
  }

  function clear_form(form = '') {
    $(form + ' input[name="fullname"]').val('');
    $(form + ' input[name="phone"]').val('');
    $(form + ' input[name="from_email"]').val('');
    $(form + ' textarea[name="content"]').val('');
  }
</script> 