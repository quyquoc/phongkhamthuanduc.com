<div class="section box box-achievements">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-header wow fadeInUp">
				<h1 class="box-title text-color-page3">Thành tựu đạt được</h1>
			</div>
			<div class="box-body">
				<div class="item wow fadeInUp">
					<div class="inner">
						<span class="counterup" data-count="15">0</span>
						<h4><strong>Năm</strong><br>kinh nghiệm</h4>
					</div>
					
				</div>
				<div class="item wow fadeInUp">
					<div class="inner">
						<span>> <p class="counterup" data-count="10000">0</p></span> 
						<h4><strong>Lượt bệnh nhân</strong><br>hài lòng</h4>
					</div>
					
				</div>
				<div class="item wow fadeInUp">
					<div class="inner">
						<span class="counterup" data-count="12">0</span>
						<h4><strong>Phòng chức năng</strong><br>hiện đại</h4>
					</div>
					
				</div>
				<div class="item wow fadeInUp">
					<div class="inner">
						<span class="counterup" data-count="18">0</span>
						<h4><strong>Bác sĩ</strong><br>tay nghề cao</h4>
					</div>
					
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