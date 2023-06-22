@extends('admin.layout')

@section('content')
@php
    $user = Auth::user();
    $user_name = $user->user_name;
    $permissions = getUserPermissions($user->user_role);

    //count event
    $all_event = countAllEvent();
    $user_event = countUserEvent($user->user_name);
    $draft_event = countEventByStatus("Draft");
    $published_event = countEventByStatus("Published");
    $pending_event = countEventByStatus("Pending");
    $trash_event = countEventByStatus("Trash");
@endphp
@if ($permissions->where('role_permission_name', 'access_event')->first()->role_permission_is_granted === '1')

<head>
	<title>D3 Teknik Informatika - All Event</title>
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
		<h2>All Event</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url ('/d3ti-admin') }}">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Event</span></li>
				<li><span>All Event</span></li>
			</ol>
			<a class="sidebar-right-toggle"></a>
		</div>
	</header>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li class="{{ Request::is('d3ti-admin/all_event') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_event') }}">All Events ({{$all_event}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_event/user_event*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_event/user_event') }}">User Events ({{$user_event}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_event/draft_event*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_event/draft_event') }}">Draft ({{$draft_event}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_event/published_event*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_event/published_event') }}">Published ({{$published_event}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_event/pending_event*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_event/pending_event') }}">Pending ({{$pending_event}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_event/trash_event*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_event/trash_event') }}">Trash ({{$trash_event}})</a></li>
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
						<th>Date of Event</th>
						<th>Tags</th>
						<th>Status</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
                    @foreach($data_event as $data)
	                    @php
	                    	$status = $data->event_status;
	                    	$formId = "delete-form-" . $data->event_id;
	                    @endphp
					<tr>
						<td>{{ $data->event_id }}</td>
						<td>{{ $data->event_title }}
							<br/>
							@if ($status == "Pending" && $permissions->where('role_permission_name', 'review_event')->first()->role_permission_is_granted === '1')
								<a href="{{ url ('d3ti-admin/review_event/'.$data->event_id) }}">Review</a> |
							@else
								@if (($permissions->where('role_permission_name', 'write_event')->first()->role_permission_is_granted === '1' && $data->event_author === $user_name) || $permissions->where('role_permission_name', 'review_event')->first()->role_permission_is_granted === '1')
								    <a href="{{ url ('d3ti-admin/edit_event/'.$data->event_id) }}">Edit</a> |
								@endif
							@endif

							@if ($data->event_status == "Trash")
							@if ($permissions->where('role_permission_name', 'delete_event')->first()->role_permission_is_granted === '1')
			                    <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to permanently delete the event??')){document.querySelector('#{{ $formId }}').submit();}">Delete</a>
			                      <form id="{{ $formId }}" method="post" action="{{ url ('d3ti-admin/delete_event') }}/{{ $data->event_id }}">
				                      @csrf
				                      @method('DELETE')
								  </form>
							@endif

							@else
							@if (($data->event_author === $user_name && !$permissions->where('role_permission_name', 'delete_event')->first()->role_permission_is_granted) || $permissions->where('role_permission_name', 'delete_event')->first()->role_permission_is_granted === '1')
							    <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to move this event to the trash?')){document.querySelector('#{{ $formId }}').submit();}">Delete</a>
							    <form id="{{ $formId }}" method="post" action="{{ url ('d3ti-admin/trash_event') }}/{{ $data->event_id }}">
							        @csrf
							        @method('PUT')
							    </form>
							@endif
							@endif

						</td>
						<td>{{ $data->event_author }}</td>
						<td>{{ $data->event_date_of_event }}</td>
						<td>
							@php
							    $tags = getEventTags($data->event_id);
							@endphp
			                {{ $tags }}
			            </td>
						<td>{{ $data->event_status }}</td>
						<td>{{ $data->event_date }}</td>
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