@extends('admin.layout')

@section('content')
@if(auth()->user()->user_role == 1)
<head>
	<title>D3 Teknik Informatika - Categories</title>
</head>

	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Product Categories</h2>
		
			<div class="right-wrapper pull-right">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
							<i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Product</span></li>
					<li><span>Categories</span></li>
				</ol>
		

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
				<a class="sidebar-right-toggle"></a>
			</div>
		</header>

		<!-- start: page -->
			<div class="row">
				<div class="col-md-6">
					<section class="panel">
						<header class="panel-heading">
			
							<h2 class="panel-title">Add Category</h2>
						</header>
						<div class="panel-body">
							<div class="table-responsive">
  							<form method="post" novalidate="novalidate" action="{{ url('/d3ti-admin/product_categories/process') }}" enctype="multipart/form-data">
  								@csrf
								<div class="form-group">
									<label class="col-md-2 control-label">Name</label>
									<div class="col-md-9">
										<input type="text" name="name" class="col-md-12">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">Description</label>
									<div class="col-md-9">
										<textarea name="description" class="col-md-12" style="height: 100px;">-</textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">URL</label>
									<div class="col-md-9">
										<input type="text" name="url" id="url" class="col-md-12">
									</div>
								</div>
								<div class="col-md-9">
      								<input type="submit" name="submit" class="btn btn-primary" value="Submit">
								</div>

							</div>
						</div>
					</section>
				</div>
				<div class="col-md-6">
						<!-- start: page -->
						<section class="panel">
							<header class="panel-heading">
				
								<h2 class="panel-title">List Category</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Description</th>
											<th>URL</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data_product_categories as $data)
										    @php
										        $formId = "delete-form-" . $data->product_categories_id;
										    @endphp
										    <tr>
										        <td>{{ $data->product_categories_id }}</td>
										        <td>
										            {{ $data->product_categories_name }}
										            <br/>
										            <a class="modal-with-form" href="#editCategory{{ $data->product_categories_id }}">Edit</a> |
										            <a href="#" onclick="event.preventDefault(); if(confirm('Delete Category?')){document.querySelector('#{{ $formId }}').submit();}">Delete</a>
										            <form id="{{ $formId }}" method="post" action="{{ url ('d3ti-admin/delete_product_categories') }}/{{ $data->product_categories_id }}">
										                @csrf
										                @method('DELETE')
										            </form>
										        </td>
										        <td>{{ $data->product_categories_description }}</td>
										        <td>{{ $data->product_categories_url }}</td>
										    </tr>

										    <div id="editCategory{{ $data->product_categories_id }}" class="modal-block modal-block-primary mfp-hide">
										        <section class="panel">
										            <header class="panel-heading">
										                <h2 class="panel-title">Edit Category</h2>
										            </header>
										            <div class="panel-body">
										                <form id="editCategoryForm{{ $data->product_categories_id }}" method="post" action="{{ url('d3ti-admin/edit_product_categories/process/'.$data->product_categories_id) }}" class="form-horizontal mb-lg" novalidate="novalidate">
										                    @csrf
               												@method('PUT')
										                    <div class="form-group mt-lg">
										                        <label class="col-sm-3 control-label">Name</label>
										                        <div class="col-sm-9">
										                            <input type="text" name="name" class="form-control" value="{{ $data->product_categories_name }}" required/>
										                        </div>
										                    </div>
										                    <div class="form-group">
										                        <label class="col-sm-3 control-label">Description</label>
										                        <div class="col-sm-9">
										                            <input type="text" name="description" class="form-control" value="{{ $data->product_categories_description }}" required/>
										                        </div>
										                    </div>
										                    <div class="form-group">
										                        <label class="col-sm-3 control-label">URL</label>
										                        <div class="col-sm-9">
										                            <input type="text" name="url" id="editUrl{{ $data->product_categories_id }}" class="form-control" value="{{ $data->product_categories_url }}" required/>
										                        </div>
										                    </div>
										                </form>
										            </div>
										            <footer class="panel-footer">
										                <div class="row">
										                    <div class="col-md-12 text-right">
										                        <input type="submit" form="editCategoryForm{{ $data->product_categories_id }}" name="submit" class="btn btn-primary" value="Submit">
										                        <button class="btn btn-default modal-dismiss">Cancel</button>
										                    </div>
										                </div>
										            </footer>
										        </section>
										    </div>
										@endforeach

									</tbody>
								</table>
							</div>
						</section>
					</section>
				</div>
			</div>
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
	<script>
		$(document).on('click', '.modal-with-form', function() {
		    var id = $(this).data('id');
		    var name = $(this).data('name');
		    var description = $(this).data('description');
		    var url = $(this).data('url');
		    
		    $('#editCategory').find('input[name="id"]').val(id);
		    $('#editCategory').find('input[name="name"]').val(name);
		    $('#editCategory').find('input[name="description"]').val(description);
		    $('#editCategory').find('input[name="url"]').val(description);
		});

		const urlInput = document.getElementById('url');

		//Changing the url input space to "-" and make it lowercase
		urlInput.addEventListener('input', () => {
		    const urlValue = urlInput.value;
		    const formattedValue = urlValue.replace(/[^a-zA-Z0-9]/g, '-').toLowerCase();
		    urlInput.value = formattedValue;
		});
	</script>

@else
<script>window.location = "/d3ti/public/d3ti-admin";</script>
@endif
@endsection