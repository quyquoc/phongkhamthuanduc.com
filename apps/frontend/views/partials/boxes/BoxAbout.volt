<div class="section box box-about">
	<div class="container">
		<div class="container-wrapper">
			<div class="box-body">
			
				<div class="contentWrapper wow fadeInUp">
					<div class="content pleft">
						<div class="box-header">
							<h1 class="box-title text-left"> {{ lich_su.title}}</h1>
						</div>
						{{ lich_su.description }}
						{{ lich_su.content }}
					</div>
				</div>
				<div class="image wow fadeInUp" style="background-image: url('{{ url(lich_su.image) }} ');">
					<img src="{{ url(lich_su.image) }}" />
				</div>
			</div>
			<div class="box-body revire">
				<div class="image wow fadeInUp" style="background-image: url('{{ url(ton_chi.image) }} ');">
					<img src="{{ url(ton_chi.image) }}" />
				</div>
				<div class="contentWrapper wow fadeInUp">
					<div class="content pright">
						<div class="box-header">
							<h1 class="box-title text-left">{{ ton_chi.title}}</h1>
						</div>
						{{ ton_chi.description }}
						{{ ton_chi.content }}
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
