@if (!Auth::check())
    <script>
        window.location.href = '/d3ti-logout';
    </script>
@endif
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
		<meta name="author" content="JSOFT.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/morris/morris.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/select2/select2.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/dropzone/css/basic.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/dropzone/css/dropzone.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/summernote/summernote.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/summernote/summernote-bs3.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/codemirror/lib/codemirror.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/codemirror/theme/monokai.css') }}" />
		<link rel="stylesheet" href="{{ url ('admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ url ('admin/assets/stylesheets/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ url ('admin/assets/stylesheets/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ url ('admin/assets/stylesheets/theme-custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ url ('admin/assets/vendor/modernizr/modernizr.js') }}"></script>

		<!-- Other -->
  		<script src="https://cdn.tiny.cloud/1/y0ugpzhbdvp4uaa4v44pahtvm5ysxkxzmy626qlfwu4k3rdk/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

	</head>
<body>
    <section class="body">
        @php
            $user = Auth::user();
            $permissions = DB::table('d3ti_role_permission')
                ->join('d3ti_role', 'd3ti_role.role_id', '=', 'd3ti_role_permission.role_id')
                ->where('d3ti_role.role_id', '=', $user->user_role)
                ->select('d3ti_role_permission.role_permission_name', 'd3ti_role_permission.role_permission_is_granted')
                ->get();
        @endphp
        @include('admin.includes.header')
        @include('admin.includes.sidebar')
        @yield('content')
    </section>
</body>

</html>