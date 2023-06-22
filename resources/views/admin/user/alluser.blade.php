@extends('admin.layout')

@section('content')
@php
    $user = Auth::user();
    $user_name = $user->user_name;
    $permissions = getUserPermissions($user->user_role);
@endphp
@if ($permissions->where('role_permission_name', 'access_user')->first()->role_permission_is_granted === '1')
<head>
	<title>D3 Teknik Informatika - All User</title>
</head>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>All User</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url ('/d3ti-admin') }}">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>User</span></li>
			</ol>
			<a class="sidebar-right-toggle"></a>
		</div>
	</header>

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

	    <style>
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
	    </style>
	@endif


    <div id="addUser" class="modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Add User</h2>
            </header>
            <div class="panel-body">
                <form id="addUserForm" method="post" action="{{ url('d3ti-admin/add_user/process') }}" class="form-horizontal mb-lg" novalidate="novalidate">
                    @csrf
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" name="username" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" name="email" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Role</label>
                        <div class="col-sm-9">
                        	<select name="role" class="form-control">
                    			@foreach($data_role as $data)
                        			<option value="{{ $data->role_id }}">{{ $data->role_name }}</option>
                        		@endforeach
                        	</select>
                        </div>
                    </div>
                </form>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <input type="submit" form="addUserForm" class="btn btn-primary" value="Add User">
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>

	<section class="panel" style="margin-top: 10px;">
		<div class="panel-body">
        <a href="#addUser" class="btn btn-primary mb-3 modal-with-form" id="add-user-btn" style="margin-bottom: 20px;">
                <i class="fa fa-plus"></i> Add User
        </a>
			<table class="table table-bordered table-striped mb-none" id="datatable-default">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Date Created</th>
					</tr>
				</thead>
				<tbody>
                    @foreach($data_user as $data)
	                    @php
			                $dateString = $data->created_at;
			                $date = new DateTime($dateString);
			                $formattedDate = $date->format('Y-m-d');

					    	$getUserRole = getUserRole($data->user_role);
	                    @endphp
					<tr>
						<td>{{ $data->user_id }}</td>
						<td>{{ $data->user_name }}
							<br/>
							    <a href="{{ url ('d3ti-admin/user_profile/'.$data->user_id) }}">View Profile</a>
						</td>
						<td>{{ $data->user_username }}</td>
						<td>{{ $data->user_email }}</td>
						<td>{{ $getUserRole }}</td>
						<td>{{ $formattedDate }}</td>
					</tr>
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
	<script>
		$(document).ready(function() {
		  $('#datatable-default thead th:first-child').click();
		});
	</script>
@else
<script>window.location = "/d3ti/public/d3ti-admin";</script>
@endif
@endsection