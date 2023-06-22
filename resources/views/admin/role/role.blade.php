@extends('admin.layout')

@section('content')
@if(auth()->user()->user_role == 1)
<head>
	<title>D3 Teknik Informatika - Role</title>
</head>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Role</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url ('/d3ti-admin') }}">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Role</span></li>
			</ol>
			<a class="sidebar-right-toggle"></a>
		</div>
	</header>

	<section class="panel">
		<div class="panel-body">
			<table class="table table-bordered table-striped mb-none" id="datatable-default">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data_role as $data)
					    @php
					        $formId = "delete-form-" . $data->role_id;
					    @endphp
					    <tr>
					        <td>{{ $data->role_id }}</td>
					        <td>
					            {{ $data->role_name }}
					            <br/>
					            @if($data->role_name == "Superadmin")
					            @else
					            <a class="modal-with-form" href="#editRole{{ $data->role_id }}">Manage Permissions</a>
					            @endif
					        </td>
					        <td>{{ $data->role_description }}</td>
					    </tr>

					    <div id="editRole{{ $data->role_id }}" class="modal-block modal-block-primary mfp-hide">
						<div class="row">
						  <div class="col-md-12">
						    <ul class="nav nav-tabs">
						      <li class="active"><a data-toggle="tab" href="#post">Post</a></li>
						      <li><a data-toggle="tab" href="#event">Event</a></li>
						      <li><a data-toggle="tab" href="#product">Product</a></li>
						      <li><a data-toggle="tab" href="#user">User</a></li>
						    </ul>
						    <div class="tab-content">
						      <div id="post" class="tab-pane fade in active">
				                <form id="editRoleForm{{ $data->role_id }}" method="post" action="{{ url('d3ti-admin/manage_role_permissions/process/'.$data->role_id) }}" class="form-horizontal mb-lg" novalidate="novalidate">
			                    @csrf
								@method('PUT')
						          <div class="panel panel-default">
									<div class="panel-body">
										@php
										    $permissions = getUsersPermissions($data->role_id, ['access_post', 'write_post', 'publish_post', 'delete_post', 'review_post', 'access_event', 'write_event', 'publish_event', 'delete_event', 'review_event', 'access_product', 'write_product', 'publish_product', 'delete_product', 'review_product', 'access_user', 'add_user']);
										@endphp
										<div class="form-group" style="margin-left: 20px; margin-top: -20px;">
											<div class="checkbox checkbox-primary">
												<input id="access_post" type="checkbox" name="access_post" {{ optional($permissions->where('role_permission_name', 'access_post')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="access_post"><b>Allow {{ $data->role_name }} to Access Post Management</b></label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="write_post" type="checkbox" name="post-child-write" {{ optional($permissions->where('role_permission_name', 'write_post')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="write_post">Write Post</label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="publish_post" type="checkbox" name="post-child-post" {{ optional($permissions->where('role_permission_name', 'publish_post')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="publish_post">Publish Post</label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="delete_post" type="checkbox" name="post-child-delete" {{ optional($permissions->where('role_permission_name', 'delete_post')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="delete_post">Delete Post</label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px; margin-bottom: -10px;">
											<div class="checkbox checkbox-primary">
												<input id="review_post" type="checkbox" name="post-child-review" {{ optional($permissions->where('role_permission_name', 'review_post')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="review_post">Review Post</label>
											</div>
										</div>
						            </div>
						          </div>
						      </div>

						      <div id="event" class="tab-pane fade">
						          <div class="panel panel-default">
									<div class="panel-body">
										<div class="form-group" style="margin-left: 20px;">
											<div class="checkbox checkbox-primary">
												<input id="access_event" type="checkbox" name="access_event" {{ optional($permissions->where('role_permission_name', 'access_event')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="access_event"><b>Allow {{ $data->role_name }} to Access Event Management</b></label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="write_event" type="checkbox" name="event-child-write" {{ optional($permissions->where('role_permission_name', 'write_event')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="write_event">Write Event</label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="publish_event" type="checkbox" name="event-child-publish" {{ optional($permissions->where('role_permission_name', 'publish_event')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="publish_event">Publish Event</label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="delete_event" type="checkbox" name="event-child-delete" {{ optional($permissions->where('role_permission_name', 'delete_event')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="delete_event">Delete Event</label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px; margin-bottom: -10px;">
											<div class="checkbox checkbox-primary">
												<input id="review_event" type="checkbox" name="event-child-review" {{ optional($permissions->where('role_permission_name', 'review_event')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="review_event">Review Event</label>
											</div>
										</div>
						            </div>
						          </div>
						      </div>

						      <div id="product" class="tab-pane fade">
						          <div class="panel panel-default">
									<div class="panel-body">
										<div class="form-group" style="margin-left: 20px;">
											<div class="checkbox checkbox-primary">
												<input id="access_product" type="checkbox" name="access_product" {{ optional($permissions->where('role_permission_name', 'access_product')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="access_product"><b>Allow {{ $data->role_name }} to Access Product Management</b></label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="write_product" type="checkbox" name="product-child-write" {{ optional($permissions->where('role_permission_name', 'write_product')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="write_product">Write Product</label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="publish_product" type="checkbox" name="product-child-publish" {{ optional($permissions->where('role_permission_name', 'publish_product')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="publish_product">Publish Product</label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="delete_product" type="checkbox" name="product-child-delete" {{ optional($permissions->where('role_permission_name', 'delete_product')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="delete_product">Delete Product</label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px; margin-bottom: -10px;">
											<div class="checkbox checkbox-primary">
												<input id="review_product" type="checkbox" name="product-child-review" {{ optional($permissions->where('role_permission_name', 'review_product')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="review_product">Review Product</label>
											</div>
										</div>
						            </div>
						          </div>
						      </div>

						  	  <div id="user" class="tab-pane fade">
						          <div class="panel panel-default">
									<div class="panel-body">
										<div class="form-group" style="margin-left: 20px;">
											<div class="checkbox checkbox-primary">
												<input id="access_user" type="checkbox" name="access_user" {{ optional($permissions->where('role_permission_name', 'access_user')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="access_user"><b>Allow {{ $data->role_name }} to Access User Management</b></label>
											</div>
										</div>
										<div class="form-group" style="margin-left: 60px;">
											<div class="checkbox checkbox-primary">
												<input id="add_user" type="checkbox" name="user-child-add" {{ optional($permissions->where('role_permission_name', 'add_user')->first())->role_permission_is_granted === '1' ? 'checked=true' : '' }}/>
												<label for="add_user">Add User</label>
											</div>
										</div>
						            </div>
						          </div>
						      </div>

				            <footer class="panel-footer">
				                <div class="row">
				                    <div class="col-md-12 text-right">
				                        <input type="submit" form="editRoleForm{{ $data->role_id }}" name="submit" class="btn btn-primary" value="Save">
				                        <button class="btn btn-default modal-dismiss">Cancel</button>
				                    </div>
				                </div>
				            </footer>
							</form>
					    </div>
					@endforeach

				</tbody>
			</table>
		</div>
	</section>
</section>

	<!-- Vendor -->
	<script src="{{ url ('admin/assets/vendor/jquery/jquery.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

	<!-- Specific Page Vendor -->
	<script src="{{ url ('admin/assets/vendor/select2/select2.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="{{ url ('admin/assets/javascripts/theme.js') }}"></script>

	<!-- Theme Custom -->
	<script src="{{ url ('admin/assets/javascripts/theme.custom.js') }}"></script>

	<!-- Theme Initialization Files -->
	<script src="{{ url ('admin/assets/javascripts/theme.init.js') }}"></script>


	<!-- Examples -->
	<script src="{{ url ('admin/assets/javascripts/tables/examples.datatables.default.js') }}"></script>
	<script src="{{ url ('admin/assets/javascripts/tables/examples.datatables.row.with.details.js') }}"></script>
	<script src="{{ url ('admin/assets/javascripts/tables/examples.datatables.tabletools.js') }}"></script>
	<script src="{{ url ('admin/assets/javascripts/ui-elements/examples.modals.js') }}"></script>

	<!-- Others -->
	<script src="{{ url ('admin/assets/javascripts/additional/role.js') }}"></script>


@else
<script>window.location = "/d3ti/public/d3ti-admin";</script>
@endif
@endsection