<div class="col-sm-3 col-md-3 col-xs-12">
	<!-- Profile Image -->
	<div class="box box-primary">
		<div class="box-body box-profile">
			<div class="profile_img">
				<!-- end of image cropping -->
				<div id="crop-avatar">
					<!-- Current avatar -->
					<div class="avatar-view" title="Change the avatar">
						<img class="profile-user-img img-responsive img-circle" src="{{ member.item.image != '' ? url(member.item.image) : url('/backend/template/images/default-avatar.png') }}" alt="Avatar">
					</div>
					{#
					<!-- Cropping modal -->
					<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								{{ form(define.backend ~ '/account/editAvatar','class': 'avatar-form form-horizontal form-label-left','novalidate':'','enctype':'multipart/form-data') }}
									<div class="modal-header">
										<button class="close" data-dismiss="modal" type="button">&times;</button>
										<h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
									</div>
									<div class="modal-body">
										<div class="avatar-body">

											<!-- Upload image and data -->
											<div class="avatar-upload">
												<input class="avatar-src" name="avatar_src" type="hidden">
												<input class="avatar-data" name="avatar_data" type="hidden">
												<label for="avatarInput">Local upload</label>
												<input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
											</div>

											<!-- Crop and preview -->
											<div class="row">
												<div class="col-md-9">
													<div class="avatar-wrapper"></div>
												</div>
												<div class="col-md-3">
													<div class="avatar-preview preview-lg"></div>
													<div class="avatar-preview preview-md"></div>
													<div class="avatar-preview preview-sm"></div>
												</div>
											</div>

											<div class="row avatar-btns">
												<div class="col-md-9">
													<div class="btn-group">
														<button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
														<button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
														<button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
														<button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
													</div>
													<div class="btn-group">
														<button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
														<button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
														<button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
														<button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
													</div>
												</div>
												<div class="col-md-3">
													<button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /.modal -->

					<!-- Loading state -->
					<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
					#}
				</div>
				<!-- end of image cropping -->
			</div>

			<h3 class="profile-username text-center">{{ member.item.fullname }}</h3>

			<ul class="list-group list-group-unbordered">
				<li class="list-group-item">
					{{ link_to(define.backend ~ '/account/profile',language._('profile')) }}
				</li>
				<li class="list-group-item">
					{{ link_to(define.backend ~ '/account/changepassword',language._('change_password')) }}
				</li>
			</ul>
		</div>
	</div>

	{#<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
					</span>Content</a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in">
				<div class="panel-body">
					<table class="table">
						<tr>
							<td>
								<span class="glyphicon glyphicon-pencil text-primary"></span><a href="http://www.jquery2dotnet.com">Articles</a>
							</td>
						</tr>
						<tr>
							<td>
								<span class="glyphicon glyphicon-flash text-success"></span><a href="http://www.jquery2dotnet.com">News</a>
							</td>
						</tr>
						<tr>
							<td>
								<span class="glyphicon glyphicon-file text-info"></span><a href="http://www.jquery2dotnet.com">Newsletters</a>
							</td>
						</tr>
						<tr>
							<td>
								<span class="glyphicon glyphicon-comment text-success"></span><a href="http://www.jquery2dotnet.com">Comments</a>
								<span class="badge">42</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th">
					</span>Modules</a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse">
				<div class="panel-body">
					<table class="table">
						<tr>
							<td>
								<a href="http://www.jquery2dotnet.com">Orders</a> <span class="label label-success">$ 320</span>
							</td>
						</tr>
						<tr>
							<td>
								<a href="http://www.jquery2dotnet.com">Invoices</a>
							</td>
						</tr>
						<tr>
							<td>
								<a href="http://www.jquery2dotnet.com">Shipments</a>
							</td>
						</tr>
						<tr>
							<td>
								<a href="http://www.jquery2dotnet.com">Tex</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
					</span>Reports</a>
				</h4>
			</div>
			<div id="collapseFour" class="panel-collapse collapse">
				<div class="panel-body">
					<table class="table">
						<tr>
							<td>
								<span class="glyphicon glyphicon-usd"></span><a href="http://www.jquery2dotnet.com">Sales</a>
							</td>
						</tr>
						<tr>
							<td>
								<span class="glyphicon glyphicon-user"></span><a href="http://www.jquery2dotnet.com">Customers</a>
							</td>
						</tr>
						<tr>
							<td>
								<span class="glyphicon glyphicon-tasks"></span><a href="http://www.jquery2dotnet.com">Products</a>
							</td>
						</tr>
						<tr>
							<td>
								<span class="glyphicon glyphicon-shopping-cart"></span><a href="http://www.jquery2dotnet.com">Shopping Cart</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>#}
</div>
