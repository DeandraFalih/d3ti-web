@extends('admin.layout')

@section('content')
<head>
	<title>D3 Teknik Informatika - Add Product</title>
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
		<h2>Add Product</h2>
	
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
			<form method="post" novalidate="novalidate" action="{{ url('/d3ti-admin/add_product/process') }}" enctype="multipart/form-data" class="form-horizontal form-bordered">
				@csrf
				<input type="submit" name="submit" class="btn btn-primary" id="publish-button" value="Publish" onclick="return confirm('Are you sure you want to publish this post?');">
				<input type="submit" name="submit" class="btn btn-default" value="Draft" style="margin-left: 10px;">
			</ol>
			<a class="sidebar-right-toggle"></a>
		</div>
	</header>

		<div class="row">
			<div class="col-xs-12">
				<section class="panel">
					<div class="panel-body">
					<div class="form-group">
					</div>
						<input type="hidden" id="author" name="author" value="{{ Auth::user()->user_name }}">
						<div class="form-group">
							<label class="col-md-2 control-label">Title</label>
							<div class="col-md-9">
				                 @error('title')
				                   <div class="alert alert-danger">Title required.</div>
				                 @enderror
								<input type="text" id="title" name="title" class="col-md-12" value="{{ old('title') }}">
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
								<input type="file" id="inputImage" accept="image/png, image/jpg, image/jpeg">
								<input type="hidden" name="featured" id="featuredInput">
								<small class="text-muted">Recommended Image Size : 1280x720</small>
							</div>
						</div>


						<div class="form-group">
			                @error('content')
			                   <div class="alert alert-danger">Content required.</div>
			                @enderror
							<textarea name="content" id="content">{{ old('content') }}</textarea>
						</div>

						<div class="form-group" style="margin-top: 50px;">
							<label class="col-md-2 control-label">Product Owner</label>
							<div class="col-md-9">
				                @error('link')
				                   <div class="alert alert-danger">Product Owner required.</div>
				                @enderror
								<input type="text" id="owner" name="owner" class="col-md-12" value="{{ old('owner') }}">
							</div>
						</div>

						<div class="form-group">
						    <label class="col-md-2 control-label">Release Date</label>
						    <div class="col-md-9">
						        <input type="date" name="release_date" class="col-md-12 datepicker" value="{{ old('release_date') }}">
						    </div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Category</label>
							<div class="col-md-9">
				                @error('category')
				                   <div class="alert alert-danger">Category required.</div>
				                @enderror
								<select multiple data-plugin-selectTwo class="form-control populate" name="category[]">
				                  @foreach ($data_product_categories as $data)
				                    <option value="{{ $data->product_categories_id }}">{{ $data->product_categories_name }}</option>
				                  @endforeach
								</select>
								<p class="help-block">Please select one or more categories.</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Article Description</label>
							<div class="col-md-9">
				                @error('excerpt')
				                   <div class="alert alert-danger">Article Description required.</div>
				                @enderror
								<textarea name="excerpt" class="col-md-12" data-plugin-maxlength maxlength="120" style="height: 150px;">{{ old('excerpt') }}</textarea>
							</div>
						</div>

						<div class="form-group">
						    <label class="col-md-2 control-label">Date and Time</label>
						    <div class="col-md-9">
						        @php
						            $now = new DateTime('now', new DateTimeZone('GMT'));
						            $now->setTimezone(new DateTimeZone('Asia/Jakarta'));
						            $now_string = $now->format('Y-m-d\TH:i:s');
						        @endphp
						        <input type="datetime-local" name="date" class="col-md-12" value="{{ $now_string }}">
						    </div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Link</label>
							<div class="col-md-9">
				                @error('link')
				                   <div class="alert alert-danger">Link required.</div>
				                @enderror
								http://localhost/<input type="text" id="link" name="link" class="col-md-12" value="{{ old('link') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Tags</label>
							<div class="col-md-9">
				                @error('tags')
				                   <div class="alert alert-danger">Tags required.</div>
				                @enderror
								<select multiple data-plugin-selectTwo class="form-control populate" name="tags[]">
				                  @foreach ($data_tags as $data)
				                    <option value="{{ $data->tags_id }}">{{ $data->tags_name }}</option>
				                  @endforeach
								</select>
								<p class="help-block">Please select one or more Tags.</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Meta Description</label>
							<div class="col-md-9">
				                @error('meta')
				                   <div class="alert alert-danger">Meta Description required.</div>
				                @enderror
								<textarea name="meta" class="col-md-12" style="height: 150px;">{{ old('meta') }}</textarea>
							</div>
						</div>	
					</form>
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
	<script src="{{ url ('admin/assets/javascripts/additional/addpost.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
	<script src="{{ url ('admin/assets/javascripts/cropper.js') }}"></script>
	<script>
	$(document).ready(function() {
	    $('.datepicker').datepicker({
	        format: 'yyyy-mm-dd'
	    });
	});
	</script>
@endsection