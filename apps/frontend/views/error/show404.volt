
<div class="page-error 404">
	<div class="container-wrapper">
		<div class="image">
			<img src="{{ assets }}/images/error.png" />
		</div>
		<div class="content">
			<h1>404</h1>
	    <p>Địa chỉ này không tồn tại.</p>
	    <p><a class="back" href="{{url()}}"><i class="fa fa-angle-double-left"></i>&nbsp;Quay lại trang chủ.</a></p>
	    <p class="note">Chuyển về trang chủ trong <span id="countdown">05</span> giây</p>
		</div>
	</div>
</div>

<script>
	var _rd = "{{url()}}";
	var elm = document.getElementById('countdown');
	var num = 5;
	var cd = function(){
		num -= 1;
		elm.innerHTML = "0"+num;
		if(num>0){
			window.setTimeout('cd()',1000);
		} else {
			window.location.href = _rd;
		}			
	}
	cd();
</script>
