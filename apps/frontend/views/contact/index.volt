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
  $(".contact .contact-form a.send").click(function() {
    var param = new Object();
        form              = ".contact .contact-form ";
        param.fullname    = $(form+' input[name="fullname"]').val();
        param.phone       = $(form+' input[name="phone"]').val();
        param.from_email  = $(form+' input[name="from_email"]').val();
        param.content     = $(form+' textarea[name="content"]').val();
        send_contact(form, param);
  });
</script> 