@extends('admin.layout')

@section('content')
@foreach($data_post as $data)
@php
	$selected_categories = getSelectedCategories($data['post_id']);
	$non_selected_categories = getNonSelectedCategories($data['post_id']);
	$selected_tags = getSelectedTags($data['post_id']);
	$non_selected_tags = getNonSelectedTags($data['post_id']);
	$status = $data['post_status']
@endphp
<head>
	@if($status == "Pending")
	<title>D3 Teknik Informatika - Review Post</title>
	@else
	<title>D3 Teknik Informatika - Edit Post</title>
	@endif
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
	</style>
</head>
<section role="main" class="content-body">
	<header class="page-header">
		@if($status == "Pending")
		<h2>Review Post</h2>
		@else
		<h2>Edit Post</h2>
		@endif
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
			<form method="post" novalidate="novalidate" action="{{ url ('/d3ti-admin/edit_post/process/'.$data['post_id']) }}" enctype="multipart/form-data" class="form-horizontal form-bordered">
				@csrf
               	@method('PUT')
               	@if($status == "Published")
				<input type="submit" name="submit" class="btn btn-primary" value="Update">
				@else
				<input type="submit" name="submit" class="btn btn-primary" value="Publish">
				@endif
				@if($status == "Pending")
				<a href="{{ url('/d3ti-admin/review_post/preview/'.$data['post_link']) }}" class="btn btn-default" style="margin-left: 10px; color: black;">Preview</a>
				@else
				<input type="submit" name="submit" class="btn btn-default" value="Draft" style="margin-left: 10px;">
				@endif
			</ol>
			<a class="sidebar-right-toggle" data-open="sidebar-right"></a>
		</div>
	</header>

		<div class="row">
			<div class="col-xs-12">
				<section class="panel">
					<div class="panel-body">
					<div class="form-group">
					</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Title</label>
							<div class="col-md-9">
								<input type="hidden" id="author" name="author" value="{{ Auth::user()->user_name }}">
								<input type="text" name="title" class="col-md-12" value="{{ $data['post_title'] }}">
						        <small class="text-muted">Recommended Length: Between 50-60 Characters</small>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Featured Image</label>
							<div class="col-md-9">
								@error('featured')
								<div class="alert alert-danger">Featured Image required.</div>
								@enderror
									<div id="preview"></div>
									<button id="cropButton" style="color: black; margin-top: 5px; margin-bottom: 5px;">Crop</button>
								<img id="croppedImage" class="img-fluid w-100" height="100px" style="border-radius: 5%; margin-bottom: 10px;">
						        <img class="img-fluid w-100" id="featured-image" src="{{ url('storage/featured_images/'.$data['post_featured_image']) }}" height="100px" style="border-radius: 5%; margin-bottom: 10px;">
								<input type="file" id="inputImage" accept="image/png, image/jpg, image/jpeg" onchange="handleFileUpload()">
								<input type="hidden" name="featured" id="featuredInput">
								<small class="text-muted">Recommended Image Size : 1280x720</small>
							</div>
						</div>

						<div class="form-group">
							<textarea name="content" id="content">{{ $data['post_content'] }}</textarea>
						</div>

						<div class="form-group" style="margin-top: 50px;">
							<label class="col-md-2 control-label">Category</label>
							<div class="col-md-9">
								<select multiple data-plugin-selectTwo class="form-control populate" name="category[]">
									@foreach ($selected_categories as $category)
									    <option value="{{ $category->post_categories_id }}" selected>{{ $category->post_categories_name }}</option>
									@endforeach

									@foreach($non_selected_categories as $category)
				                    	<option value="{{ $category->post_categories_id }}">{{ $category->post_categories_name }}</option>
				                  	@endforeach
								</select>
								<p class="help-block">Please select one or more categories.</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Article Description</label>
							<div class="col-md-9">
								<textarea name="excerpt" class="col-md-12" data-plugin-maxlength maxlength="120" style="height: 150px;">{{ $data['post_excerpt'] }}</textarea>
							</div>
						</div>

						<div class="form-group">
						    <label class="col-md-2 control-label">Date and Time</label>
						    <div class="col-md-9">
						        <input type="datetime-local" name="date" class="col-md-12" value="{{ $data['post_date'] }}">
						    </div>
						</div>


						<div class="form-group">
							<label class="col-md-2 control-label">Link</label>
							<div class="col-md-9">
								http://localhost/<input type="text" name="link" class="col-md-12" value="{{ $data['post_link'] }}" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Tags</label>
							<div class="col-md-9">
								<select multiple data-plugin-selectTwo class="form-control populate" name="tags[]">
									@foreach($selected_tags as $tag)
				                    	<option value="{{ $tag->tags_id }}" selected>{{ $tag->tags_name }}</option>
				                  	@endforeach

									@foreach($non_selected_tags as $tag)
				                    	<option value="{{ $tag->tags_id }}">{{ $tag->tags_name }}</option>
				                  	@endforeach
								</select>
								<p class="help-block">Please select one or more Tags.</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Meta Description</label>
							<div class="col-md-9">
								<textarea name="meta" class="col-md-12" style="height: 150px;">{{ $data['post_meta'] }}</textarea>
						        <small class="text-muted">Recommended Length: Between 150-160 Characters</small>
							</div>
						</div>
					</form>
					@endforeach
				</div>
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

	<!-- Other Script -->
	<script src="{{ url ('admin/assets/javascripts/tinymce.js') }}"></script>
	<script src="{{ url ('admin/assets/javascripts/additional/editpost.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
	<script src="{{ url ('admin/assets/javascripts/cropper.js') }}"></script>
    <script>
    function handleFileUpload() {
      var fileInput = document.getElementById('inputImage');
      var featuredImage = document.getElementById('featured-image');

      // Check if a file has been selected
      if (fileInput.files.length > 0) {
        // Hide the featured image element
        featuredImage.style.display = 'none';
      } else {
        // Show the featured image element
        featuredImage.style.display = 'block';
      }
    }
    </script>
@endsection