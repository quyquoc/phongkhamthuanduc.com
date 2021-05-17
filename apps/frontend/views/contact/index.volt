<div id="contact" class="page-contact">
  <div class="section main-content contact">
    <div class="container">
      <div class="module">
        <div class="module-content">
            <div class="box-header">
              <div class="box-title">Liên hệ với chúng tôi</div>
            </div>
          <div class="contact-form">
            <div class="form">
              <div class="contact-notice">
                <div class="notice success">Thông tin đã gửi thành công!</div>
                <div class="notice error">Lỗi! Không gửi được thông tin!</div>
              </div>
              <div id="loading"><img src="{{ assets }}/images/loading.gif" /></div>
              <input name="fullname" id="fullname" type="text" placeholder="Họ Tên">
              <input class="phone"name="phone" id="phone" type="phone" placeholder="Điện thoại">
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
  $("#contact .contact-form a.send").click(function() {
    var param = new Object();
        form_contact              = "#contact .form ";
        param.fullname    = $(form_contact+' input[name="fullname"]').val();
        param.phone       = $(form_contact+' input[name="phone"]').val();
        param.from_email  = $(form_contact+' input[name="from_email"]').val();
        param.content     = $(form_contact+' textarea[name="content"]').val();
        send(form_contact, param);
  });
</script> 
<div class="map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.337953228951!2d107.59270451434142!3d16.45841663326307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3141a13f7ff7ca3d%3A0x34924eeebfdb76a9!2zQ8O0bmcgVHkgVHLDoWNoIE5oaeG7h20gSOG7r3UgSOG6oW4gWSBLaG9hIFRodeG6rW4gxJDhu6lj!5e0!3m2!1svi!2s!4v1617939197749!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>