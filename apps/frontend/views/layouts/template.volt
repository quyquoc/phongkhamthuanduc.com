
<div class="page{{ page is defined ? ' ' ~ page : '' }}">
	{{ partial("partials/header1") }}

	<div class="main-body">{{ content() }}</div>

	{{ partial("partials/footer1") }}
	{{ partial("partials/footer2") }}
</div>

<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>

<div class="icon_zalo">
  <a href="https://oa.zalo.me/manage/dashboard?gidzl=aYNhElylga-MEEyu_JMeI9OzxplZCQySZMxfEEGrgK3PFUqmj66fHOrhkJ3ZDAv3YpplOsHRENH1-ooiIW" target="_blank">
    <img src="{{ assets }}/images/icon-zalo.svg" />
  </a>
</div>

<div class="contact-fixed">
  <div class="inner">
    <a href="tel:0903955515" onclick="atag('send', 'conversion')">
      <div class="phone">
        <div class="ring"></div>
        <i class="fa fa-phone"></i>
        {#<a href="tel:028 39979899" class="number">028 39.97.98.99</a>#}
      </div>
    </a>
    {#<a class="button" href="#register">Đăng ký</a>#}
  </div>
</div>

{{ partial("partials/support_online") }}
