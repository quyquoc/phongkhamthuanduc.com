
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
    xfbml            : true,
    version          : 'v8.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
  attribution=setup_tool
  color="blue"
  theme_color="#0062C4"
  page_id="Pqt55g81hhebjw"
  greeting_dialog_display="hide"
  logged_in_greeting="Tôi có thể giúp gì cho bạn?"
  logged_out_greeting="Tôi có thể giúp gì cho bạn?">
</div>