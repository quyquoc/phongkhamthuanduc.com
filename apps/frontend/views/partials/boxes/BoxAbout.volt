<div class="section box box-about">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-body">
			
				<div class="contentWrapper wow fadeInUp">
					<div class="content pleft">
						<div class="box-header">
							<h1 class="box-title text-left"> {{ Ohi.sysConfig('lich-su-hinh-thanh',true,'title')}}</h1>
						</div>
						{{ Ohi.sysConfig('lich-su-hinh-thanh',false)}}
					</div>
				</div>
				<div class="image wow fadeInUp" style="background-image: url('{{ url(Ohi.sysConfig('lich-su-hinh-thanh',true, 'image')) }} ');">
					<img src="{{ url(Ohi.sysConfig('lich-su-hinh-thanh',true, 'image')) }}" />
				</div>
				<div class="image wow fadeInUp" style="background-image: url('{{ url(Ohi.sysConfig('ton-chi-phong-kham',true, 'image')) }} ');">
					<img src="{{ url(Ohi.sysConfig('ton-chi-phong-kham',true, 'image')) }}" />
				</div>
				<div class="contentWrapper wow fadeInUp">
					<div class="content pright">
						<div class="box-header">
							<h1 class="box-title text-left">{{ Ohi.sysConfig('ton-chi-phong-kham',true,'title')}}</h1>
						</div>
						{{ Ohi.sysConfig('lich-su-hinh-thanh',false)}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
