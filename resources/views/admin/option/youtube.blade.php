@extends('admin.layout')

@section('content')
<head>
	<title>D3 Teknik Informatika - Youtube</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Youtube</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url ('/d3ti-admin') }}">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Youtube</span></li>
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


	<section class="panel" style="margin-top: 10px;">
		<div class="panel-body">
		<a href="{{ url('/d3ti-admin/youtube/sync') }}" class="btn btn-primary mb-3" style="margin-bottom: 20px;">
				<i class="fa fa-refresh"></i> Sync Youtube
		</a>
			<table class="table table-bordered table-striped mb-none" id="datatable-default">
				<thead>
					<tr>
						<th>ID</th>
						<th>Thumbnail</th>
						<th>Title</th>
						<th>Show</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
                    @foreach($data_youtube as $data)
	                    @php
			                $dateString = $data->created_at;
			                $date = new DateTime($dateString);
			                $formattedDate = $date->format('Y-m-d');
	                    @endphp
					<tr>
						<td>{{ $data->youtube_id }}</td>
						<td><img src="https://img.youtube.com/vi/{{ $data->youtube_video_id }}/hqdefault.jpg" style="width: 150px; max-height: 84px; object-fit: cover;"></td>
						<td>{{ $data->youtube_title }}</td>
						<td>
						    <div class="switch switch-sm switch-primary">
						        <input type="checkbox" class="youtube-show-switch" data-plugin-ios-switch data-youtube-id="{{$data->youtube_id}}" value="{{$data->youtube_show}}" {{$data->youtube_show ? 'checked="checked"' : ''}}>
						    </div>
						</td>
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
	<script src="{{ url ('admin/assets/vendor/ios7-switch/ios7-switch.js') }}"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="{{ url ('admin/assets/javascripts/theme.js') }}"></script>

	<!-- Theme Custom -->
	<script src="{{ url ('admin/assets/javascripts/theme.custom.js') }}"></script>

	<!-- Theme Initialization Files -->
	<script src="{{ url ('admin/assets/javascripts/theme.init.js') }}"></script>


	<!-- Examples -->
	<script src="{{ url ('admin/assets/javascripts/forms/examples.advanced.form.js') }}" /></script>
	<script src="{{ url ('admin/assets/javascripts/tables/examples.datatables.default.js') }}"></script>
	<script src="{{ url ('admin/assets/javascripts/tables/examples.datatables.row.with.details.js') }}"></script>
	<script src="{{ url ('admin/assets/javascripts/tables/examples.datatables.tabletools.js') }}"></script>
	<script src="{{ url ('admin/assets/javascripts/ui-elements/examples.modals.js') }}"></script>
	<script src="{{ url ('admin/assets/javascripts/additional/youtube.js') }}"></script>
	<script>
		$(document).ready(function() {
		  $('#datatable-default thead th:first-child').click();
		});
	</script>
@endsection