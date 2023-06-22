@extends('admin.layout')

@section('content')
@foreach($data_user as $data)
@php
    $user = Auth::user();
    $user_post = countUserPost($data->user_name);
    $user_post_view = countUserPostView($data->user_name);

    $role_name = DB::table('d3ti_role')
        ->where('role_id', Auth::user()->user_role)
        ->value('role_name');

    $permissions = getUserPermissions($user->user_role);
@endphp
<head>
	<title>D3 Teknik Informatika - Profile</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
	<style>
		#preview {
		  overflow: hidden;
		  width: 300px;
		  height: 300px;
		  display: none;
		}
		#cropButton {
		  display: none;
		}
		#croppedImage {
	      display: none;
	    }
	    #notification {
	        position: fixed;
	        top: 10%;
	        left: 50%;
	        transform: translateX(-50%);
	        background-color: #333;
	        color: #fff;
	        padding: 10px 20px;
	        border-radius: 5px;
	        z-index: 9999;
	        display: none;
	    }

	    #error {
	        position: fixed;
	        top: 10%;
	        left: 50%;
	        transform: translateX(-50%);
	        background-color: red;
	        color: #fff;
	        padding: 10px 20px;
	        border-radius: 5px;
	        z-index: 9999;
	        display: none;
	    }
	</style>
</head>

	@if (session('status'))
	    <div id="notification">
	        {{ session('status') }}
	    </div>

	    <script>
	        var notification = document.getElementById("notification");
	        notification.style.display = "block";

	        setTimeout(function() {
	            notification.style.display = "none";
	        }, 5000);
	    </script>
	@endif

	<section role="main" class="content-body">
		<header class="page-header">
			<h2>User Profile</h2>
		
			<div class="right-wrapper pull-right">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
							<i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>User</span></li>
					<li><span>Profile</span></li>
				</ol>
		
				<a class="sidebar-right-toggle"></a>
			</div>
		</header>

		<div class="row">
			<div class="col-md-4 col-lg-3">

				<section class="panel">
					<div class="panel-body">
						<div class="thumb-info mb-md">
							@if($data->user_picture == "")
							<img src="{{ url ('admin/assets/images/!logged-user.jpg') }}" class="rounded img-responsive" width="400">
							@else
							<img src="{{ url('storage/profile/'.$data->user_picture) }}" class="rounded img-responsive" width="400">
							@endif
							<div class="thumb-info-title" style="text-transform: none;">
							  <span class="thumb-info-inner">{{ $data->user_name }}</span>
							  <span class="thumb-info-type">{{ $role_name }}</span>
							</div>
						</div>


						<hr class="dotted short">

						<h6 class="text-muted">About</h6>
						<p>{{ $data->user_bio }}</p>

					</div>
				</section>

			</div>
			<div class="col-md-8 col-lg-6">
				<div class="tabs">
					<ul class="nav nav-tabs tabs-primary">
						<li class="active">
							<a>Edit Profile</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active">
							
							<form class="form-horizontal" method="POST" action="{{ url('/d3ti-admin/my_profile/edit_process') }}" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<fieldset>
								<h4 class="mb-xlg">Personal Information</h4>
									<input type="hidden" name="id" class="form-control" value="{{ $data->user_id }}" required>
									<div class="form-group">
										<label class="col-md-3 control-label">Full Name</label>
										<div class="col-md-8">
											<input type="text" name="name" class="form-control" value="{{ $data->user_name }}" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Username</label>
										<div class="col-md-8">
											@if ($permissions->where('role_permission_name', 'edit_user')->first()->role_permission_is_granted === '1')
												<input type="text" name="username" class="form-control" value="{{ $data->user_username }}">
											@else
												<input type="text" name="username" class="form-control" value="{{ $data->user_username }}" readonly>
											@endif
										</div>
									</div><div class="form-group">
									    <label class="col-md-3 control-label">Email</label>
									    <div class="col-md-8">
									        <input type="text" name="email" class="form-control" value="{{ $data->user_email }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address">
									    </div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Phone Number</label>
										<div class="col-md-8">
											<input type="text" name="phone" class="form-control" value="{{ $data->user_phone }}" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Role</label>
										<div class="col-md-8">
											@php
												$userRole = getUserRole($data->user_role);
												$nonUserRole = getNonUserRole($data->user_role);

												$userRoleId = $data->user_role;
											@endphp
											@if ($permissions->where('role_permission_name', 'edit_user')->first()->role_permission_is_granted === '1')
					                        	<select name="role" class="form-control">
					                        		<option value="{{ $userRoleId }}">{{ $userRole }}</option>
						                        		@foreach($nonUserRole as $nonUserRoles)
						                        			<option value="{{ $nonUserRoles->role_id }}">{{ $nonUserRoles->role_name }}</option>
						                        		@endforeach
					                        	</select>
											@else
												<input type="text" name="role" class="form-control" value="{{ $role_name }}" readonly>
											@endif
										</div>
									</div>
								@foreach($data_user as $data)
									<div class="form-group">
										<label class="col-md-3 control-label">Profile Picture</label>
										<div class="col-md-8">
											<div id="preview"></div>
											<button id="cropButton" style="color: black; margin-top: 5px; margin-bottom: 5px;">Crop</button>
											<img id="croppedImage" class="img-fluid w-100" height="100px" style="border-radius: 5%; margin-bottom: 10px;">
											<input type="file" id="inputImage" accept="image/png, image/jpg, image/jpeg">
											<input type="hidden" name="profile" id="profileInput">
											<small class="text-muted">Recommended Image Size : 600x600</small>
										</div>
									</div>
								</fieldset>
								<hr class="dotted tall">
								<h4 class="mb-xlg">About Yourself</h4>
								<fieldset>
									<div class="form-group">
										<label class="col-md-3 control-label">Biographical Info</label>
										<div class="col-md-8">
												<textarea class="form-control" name="bio" rows="3" required>{{ $data->user_bio }}</textarea>
										</div>
									</div>
								</fieldset>
								<hr class="dotted tall">
								<h4 class="mb-xlg">Change Password</h4>
								<fieldset class="mb-xl">
									@if ($permissions->where('role_permission_name', 'edit_user')->first()->role_permission_is_granted === '1')
										@if($data->user_role == 1)
											<div class="form-group">
												<label class="col-md-3 control-label">Old Password</label>
												<div class="col-md-8">
													<input type="password" id="old_password" name="old_password" class="form-control">
									                 @if(session('error'))
									                   <div class="alert alert-danger">{{ session('error') }}</div>
									                 @endif
												</div>
											</div>
										@else
											<input type="hidden" name="old_password" class="form-control">
										@endif
									@else
										<div class="form-group">
											<label class="col-md-3 control-label">Old Password</label>
											<div class="col-md-8">
												<input type="password" id="old_password" name="old_password" class="form-control">
								                 @if(session('error'))
								                   <div class="alert alert-danger">{{ session('error') }}</div>
								                 @endif
											</div>
										</div>
									@endif
									<div class="form-group">
										<label class="col-md-3 control-label">New Password</label>
										<div class="col-md-8">
											<input type="password" id="new_password" name="new_password" class="form-control" minlength="8">
										</div>
									</div>
								</fieldset>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-9 col-md-offset-3">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</div>
								</div>
								@endforeach
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-3">
				<h4 class="mb-md">Statistics</h4>
				<ul class="simple-card-list mb-xlg">
					<li class="primary">
						<h3>{{ $user_post }}</h3>
						<p>Articles Written</p>
					</li>
					<li class="primary">
						<h3>{{ $user_post_view }} x</h3>
						<p>Articles Viewed</p>
					</li>
				</ul>
			</div>
	</section>
</div>
@endforeach

	<!-- Vendor -->
	<script src="{{ url ('admin/assets/vendor/jquery/jquery.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
	
	<!-- Specific Page Vendor -->
	<script src="{{ url ('admin/assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/select2/select2.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/jquery-maskedinput/jquery.maskedinput.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/fuelux/js/spinner.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/dropzone/dropzone.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-markdown/js/markdown.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-markdown/js/to-markdown.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/codemirror/lib/codemirror.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/codemirror/addon/selection/active-line.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/codemirror/addon/edit/matchbrackets.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/codemirror/mode/javascript/javascript.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/codemirror/mode/xml/xml.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/codemirror/mode/css/css.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/summernote/summernote.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
	<script src="{{ url ('admin/assets/vendor/ios7-switch/ios7-switch.js') }}"></script>
	
	<!-- Theme Base, Components and Settings -->
	<script src="{{ url ('admin/assets/javascripts/theme.js') }}"></script>
	
	<!-- Theme Custom -->
	<script src="{{ url ('admin/assets/javascripts/theme.custom.js') }}"></script>
	
	<!-- Theme Initialization Files -->
	<script src="{{ url ('admin/assets/javascripts/theme.init.js') }}"></script>


	<!-- Examples -->
	<script src="{{ url ('admin/assets/javascripts/forms/examples.advanced.form.js') }}" /></script>

	<!-- Other -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
	<script src="{{ url ('admin/assets/javascripts/cropperprofile.js') }}"></script>
	<script>
	  document.addEventListener('DOMContentLoaded', function() {
	    var new_password = document.getElementById('new_password');
	    var old_password = document.getElementById('old_password');

	    new_password.addEventListener('input', function() {
	      if (new_password.value.length > 0) {
	        old_password.setAttribute('required', 'required');
	      } else {
	        old_password.removeAttribute('required');
	      }
	    });
	  });
	</script>
@endsection