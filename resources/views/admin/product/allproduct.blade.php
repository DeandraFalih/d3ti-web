@extends('admin.layout')

@section('content')
@php
    $user = Auth::user();
    $user_name = $user->user_name;
    $permissions = getUserPermissions($user->user_role);

    //count product
    $all_product = countAllProduct();
    $user_product = countUserProduct($user->user_name);
    $draft_product = countProductByStatus("Draft");
    $published_product = countProductByStatus("Published");
    $pending_product = countProductByStatus("Pending");
    $trash_product = countProductByStatus("Trash");
@endphp
@if ($permissions->where('role_permission_name', 'access_product')->first()->role_permission_is_granted === '1')

<head>
	<title>D3 Teknik Informatika - All Product</title>
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
		<h2>All Product</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url ('/d3ti-admin') }}">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Product</span></li>
				<li><span>All Product</span></li>
			</ol>
			<a class="sidebar-right-toggle"></a>
		</div>
	</header>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li class="{{ Request::is('d3ti-admin/all_product') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_product') }}">All Products ({{$all_product}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_product/user_product*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_product/user_product') }}">User Products ({{$user_product}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_product/draft_product*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_product/draft_product') }}">Draft ({{$draft_product}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_product/published_product*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_product/published_product') }}">Published ({{$published_product}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_product/pending_product*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_product/pending_product') }}">Pending ({{$pending_product}})</a></li>
				<li class="{{ Request::is('d3ti-admin/all_product/trash_product*') ? 'active' : '' }}"><a href="{{ url('d3ti-admin/all_product/trash_product') }}">Trash ({{$trash_product}})</a></li>
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
						<th>Owner</th>
						<th>Release Date</th>
						<th>Author</th>
						<th>Category</th>
						<th>Tags</th>
						<th>Status</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
                    @foreach($data_product as $data)
	                    @php
	                    	$status = $data->product_status;
	                    	$formId = "delete-form-" . $data->product_id;
	                    @endphp
					<tr>
						<td>{{ $data->product_id }}</td>
						<td>{{ $data->product_title }}
							<br/>
							@if ($status == "Pending" && $permissions->where('role_permission_name', 'review_product')->first()->role_permission_is_granted === '1')
							    <a href="{{ url ('d3ti-admin/review_product/'.$data->product_id) }}">Review</a> |
							@elseif (($permissions->where('role_permission_name', 'write_product')->first()->role_permission_is_granted === '1' && $data->product_author === $user_name) || $permissions->where('role_permission_name', 'review_product')->first()->role_permission_is_granted === '1')
							    <a href="{{ url ('d3ti-admin/edit_product/'.$data->product_id) }}">Edit</a> |
							@endif

							@if ($data->product_status == "Trash")
							@if ($permissions->where('role_permission_name', 'delete_product')->first()->role_permission_is_granted === '1')
			                    <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to permanently delete the product??')){document.querySelector('#{{ $formId }}').submit();}">Delete</a>
			                      <form id="{{ $formId }}" method="post" action="{{ url ('d3ti-admin/delete_product') }}/{{ $data->product_id }}">
				                      @csrf
				                      @method('DELETE')
								  </form>
							@endif

							@else
							@if (($data->product_author === $user_name && !$permissions->where('role_permission_name', 'delete_product')->first()->role_permission_is_granted) || $permissions->where('role_permission_name', 'delete_product')->first()->role_permission_is_granted === '1')
							    <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to move this product to the trash?')){document.querySelector('#{{ $formId }}').submit();}">Delete</a>
							    <form id="{{ $formId }}" method="post" action="{{ url ('d3ti-admin/trash_product') }}/{{ $data->product_id }}">
							        @csrf
							        @method('PUT')
							    </form>
							@endif
							@endif

						</td>
						<td>{{ $data->product_owner }}</td>
						<td>{{ $data->product_release_date }}</td>
						<td>{{ $data->product_author }}</td>
						<td>
							@php
							    $categories = getProductCategories($data->product_id);
							@endphp
			                {{ $categories }}
			            </td>
						<td>
							@php
							    $tags = getProductTags($data->product_id);
							@endphp
			                {{ $tags }}
			            </td>
						<td>{{ $data->product_status }}</td>
						<td>{{ $data->product_date }}</td>
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