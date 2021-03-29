<div class="section box box-achievements">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-header wow fadeInUp">
				<h1 class="box-title">Chúng tôi thực hiện</h1>
			</div>
			<div class="box-body">
				<div class="item wow fadeInUp">
					<div class="image"></div>
					+ <span class="counterup" data-count="50">0</span>
					<h4>Website được xây dựng</h4>
				</div>
				<div class="item wow fadeInUp">
					<div class="image"></div>
					+ <span class="counterup" data-count="20">0</span>
					<h4>Chiến dịch Marketing</h4>
				</div>
				<div class="item wow fadeInUp">
					<div class="image"></div>
					+ <span class="counterup" data-count="45">0</span>
					<h4>Khách hàng hài lòng</h4>
				</div>
				<div class="item wow fadeInUp">
					<div class="image"></div>
					+ <span class="counterup" data-count="3">0</span>
					<h4>Quốc gia</h4>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var a = 0;
	$(window).scroll(function() {
	  var oTop = $('.box-achievements').offset().top - window.innerHeight;
	  if (a == 0 && $(window).scrollTop() > oTop) {
	    $('.counterup').each(function() {
	      var $this = $(this),
	        	countTo = $this.attr('data-count');
	      $({
	        countNum: $this.text()
	      }).animate({countNum: countTo}, {
          duration: 2000,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
          }
        });
	    });
	    a = 1;
	  }
	});
</script>