@extends('admin.layout')

@section('content')
@php
    $user = Auth::user();
    $user_name = $user->user_name;
    $permissions = getUserPermissions($user->user_role);

    //count post
    $all_post = countAllPost();
    $user_post = countUserPost($user->user_name);
    $draft_post = countPostByStatus("Draft");
    $published_post = countPostByStatus("Published");
    $pending_post = countPostByStatus("Pending");
    $trash_post = countPostByStatus("Trash");
@endphp
@if ($permissions->where('role_permission_name', 'access_post')->first()->role_permission_is_granted === '1')

<head>
	<title>D3 Teknik Informatika - All Post</title>
</head>
<style>
    .navbar {
        margin-bottom: 0;
    }
    .panel {
        margin-top: -0px;
    }
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>All Post</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url ('/d3ti-admin') }}">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Post</span></li>
				<li><span>All Post</span></li>
			</ol>
			<a class="sidebar-right-toggle"></a>
		</div>
	</header>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li class="{{ Request::is('d3ti-admin/all_post') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_post') }}">All Posts ({{$all_post}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_post/user_post*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_post/user_post') }}">User Posts ({{$user_post}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_post/draft_post*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_post/draft_post') }}">Draft ({{$draft_post}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_post/published_post*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_post/published_post') }}">Published ({{$published_post}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_post/pending_post*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_post/pending_post') }}">Pending ({{$pending_post}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_post/trash_post*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_post/trash_post') }}">Trash ({{$trash_post}})</a></li>
			</ul>
		</div>
	</nav>

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

	<section class="panel">
		<div class="panel-body">
			<table class="table table-bordered table-striped mb-none" id="datatable-default">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Tags</th>
						<th>Status</th>
						<th>View</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
                    @foreach($data_post as $data)
	                    @php
	                    	$status = $data->post_status;
	                    	$formId = "delete-form-" . $data->post_id;
	                    @endphp
					<tr>
						<td>{{ $data->post_id }}</td>
						<td>{{ $data->post_title }}
							<br/>
							@if ($status == "Pending" && $permissions->where('role_permission_name', 'review_post')->first()->role_permission_is_granted === '1')
							    <a href="{{ url ('d3ti-admin/review_post/'.$data->post_id) }}">Review</a> |
							@elseif (($permissions->where('role_permission_name', 'write_post')->first()->role_permission_is_granted === '1' && $data->post_author === $user_name) || $permissions->where('role_permission_name', 'review_post')->first()->role_permission_is_granted === '1')
							    <a href="{{ url ('d3ti-admin/edit_post/'.$data->post_id) }}">Edit</a> |
							@endif

							@if ($data->post_status == "Trash")
							@if ($permissions->where('role_permission_name', 'delete_post')->first()->role_permission_is_granted === '1')
			                    <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to permanently delete the post??')){document.querySelector('#{{ $formId }}').submit();}">Delete</a>
			                      <form id="{{ $formId }}" method="post" action="{{ url ('d3ti-admin/delete_post') }}/{{ $data->post_id }}">
				                      @csrf
				                      @method('DELETE')
								  </form>
							@endif

							@else
							@if (($data->post_author === $user_name && !$permissions->where('role_permission_name', 'delete_post')->first()->role_permission_is_granted) || $permissions->where('role_permission_name', 'delete_post')->first()->role_permission_is_granted === '1')
							    <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to move this post to the trash?')){document.querySelector('#{{ $formId }}').submit();}">Delete</a>
							    <form id="{{ $formId }}" method="post" action="{{ url ('d3ti-admin/trash_post') }}/{{ $data->post_id }}">
							        @csrf
							        @method('PUT')
							    </form>
							@endif
							@endif

						</td>
						<td>{{ $data->post_author }}</td>
						<td>
							@php
							    $categories = getPostCategories($data->post_id);
							@endphp
			                {{ $categories }}
			            </td>
						<td>
							@php
							    $tags = getPostTags($data->post_id);
							@endphp
			                {{ $tags }}
			            </td>
						<td>{{ $data->post_status }}</td>
						<td>{{ $data->post_view }}</td>
						<td>{{ $data->post_date }}</td>
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
	<script>
		$(document).ready(function() {
		  $('#datatable-default thead th:first-child').click();
		});
	</script>
@else
<script>window.location = "/d3ti/public/d3ti-admin";</script>
@endif
@endsection