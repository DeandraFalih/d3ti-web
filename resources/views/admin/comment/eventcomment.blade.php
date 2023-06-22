@extends('admin.layout')

@section('content')
@if(auth()->user()->user_role == 1 || auth()->user()->user_role == 2)
@php
   $countAllComment = countAllComment();
   $countSeparatePendingComment = countSeparatePendingComment();
@endphp
<head>
	<title>D3 Teknik Informatika - Event Comment</title>
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
		<h2>Comment</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url ('/d3ti-admin') }}">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Comment</span></li>
				<li><span>Post Comment</span></li>
			</ol>
			<a class="sidebar-right-toggle"></a>
		</div>
	</header>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li class="{{ Request::is('d3ti-admin/all_comment/post_comment*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_comment/post_comment') }}">Post Comment ({{ $countAllComment['post'] }})<div style="color: #0088CC">({{ $countSeparatePendingComment['post'] }} Pending)</div></a></li>
				<li class="{{ Request::is('d3ti-admin/all_comment/event_comment*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_comment/event_comment') }}">Event Comment ({{ $countAllComment['event'] }})<div style="color: #0088CC">({{ $countSeparatePendingComment['event'] }} Pending)</div></a></li>
				<li class="{{ Request::is('d3ti-admin/all_comment/product_comment*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_comment/product_comment') }}">Product Comment ({{ $countAllComment['product'] }})<div style="color: #0088CC">({{ $countSeparatePendingComment['product'] }} Pending)</div></a></li>
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
	                    <th>Comment</th>
	                    <th>Title</th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Status</th>
                      	<th>IP Address</th>
	                    <th>Date</th>
	                </tr>
	            </thead>
	            <tbody>
	                @foreach($data_event_comment as $data)
	                    @php
	                        $status = $data->event_comment_status;

	                        $dateString = $data->created_at;
	                        $date = new DateTime($dateString);
	                        $formattedDate = $date->format('Y-m-d H:i:s');
	                        $formApproveId = "approve-form-" . $data->event_comment_id;
	                        $formRejectId = "reject-form-" . $data->event_comment_id;
	                    @endphp
	                <tr>
	                    <td>{{ $data->event_comment_id }}</td>
	                    <td>{{ $data->event_comment_value }}
	                        <br/>
	                        @if ($status == "Pending")
	                            <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to approve this comment?')){document.querySelector('#{{ $formApproveId }}').submit();}">Approve</a> |
	                            <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to reject this comment?')){document.querySelector('#{{ $formRejectId }}').submit();}">Reject</a>

	                            <form id="{{ $formApproveId }}" method="post" action="{{ url ('d3ti-admin/all_comment/event_comment/approve') }}/{{ $data->event_comment_id }}">
	                                @csrf
	                                @method('PUT')
	                            </form>

	                            <form id="{{ $formRejectId }}" method="post" action="{{ url ('d3ti-admin/all_comment/event_comment/reject') }}/{{ $data->event_comment_id }}">
	                                @csrf
	                                @method('PUT')
	                            </form>
	                        @else
	                        @endif
	                    </td>
	                    <td>{{ $data->event_title }}</td>
	                    <td>{{ $data->event_comment_name }}</td>
	                    <td>{{ $data->event_comment_email }}</td>
	                    <td>{{ $data->event_comment_status }}</td>
						<td><a href="https://whatismyipaddress.com/ip/{{ $data->event_comment_ip }}">{{ $data->event_comment_ip }}</a></td>
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
	<script>
		$(document).ready(function() {
		  $('#datatable-default thead th:first-child').click();
		});
	</script>
@else
<script>window.location = "/d3ti/public/d3ti-admin";</script>
@endif
@endsection
