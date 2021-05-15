
<div class="page{{ page is defined ? ' ' ~ page : '' }}">
	{{ partial("partials/header1") }}
	<div class="main-body">{{ content() }}</div>
	{{ partial("partials/footer2") }}
</div>

<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>
{#
<div class="icon_zalo">
  <a href="https://oa.zalo.me/manage/dashboard?gidzl=aYNhElylga-MEEyu_JMeI9OzxplZCQySZMxfEEGrgK3PFUqmj66fHOrhkJ3ZDAv3YpplOsHRENH1-ooiIW" target="_blank">
    <img src="{{ assets }}/images/icon-zalo.svg" />
  </a>
</div>
#}
<div class="contact-fixed">
  <div class="inner">
    <a href="tel:02343833888" onclick="atag('send', 'conversion')">
      <div class="phone">
        <div class="ring"></div>
        <i class="fa fa-phone"></i>
      </div>
    </a>
  </div>
</div>
{{ element.PopupContact() }}
{{element.script(['slick']) }}
{{ partial("partials/support_online") }}
