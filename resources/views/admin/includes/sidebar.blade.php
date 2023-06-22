@php
   $countPendingComment = countPendingComment();
@endphp
<div class="inner-wrapper">
<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

	<div class="sidebar-header">
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
				  <li class="nav{{ Request::is('d3ti-admin') ? ' nav-active' : '' }}">
				    <a href="{{ url('/d3ti-admin') }}">
				      <i class="fa fa-home" aria-hidden="true"></i>
				      <span>Dashboard</span>
				    </a>
				  </li>

						@if ($permissions->where('role_permission_name', 'access_post')->first()->role_permission_is_granted === '1')
						    <li class="nav-parent{{ Request::is('d3ti-admin/all_post*') || Request::is('d3ti-admin/edit_post*') || Request::is('d3ti-admin/add_post*') || Request::is('d3ti-admin/post_categories*') || Request::is('d3ti-admin/post_tags*') ? ' nav-active' : '' }}">
						        <a>
						            <i class="fa fa-edit" aria-hidden="true"></i>
						            <span>Post</span>
						        </a>
						        <ul class="nav nav-children" style="{{ Request::is('d3ti-admin/all_post*') || Request::is('d3ti-admin/post_categories*') || Request::is('d3ti-admin/post_tags*') ? 'display: block;' : '' }}">
						            <li>
										@if(auth()->user()->user_role == 1 || auth()->user()->user_role == 2)
						                <a href="{{ url('/d3ti-admin/all_post') }}" class="{{ Request::is('d3ti-admin/all_post*') ? 'text-primary' : '' }}">
						                @else
						                <a href="{{ url('/d3ti-admin/all_post/user_post') }}" class="{{ Request::is('d3ti-admin/all_post*') ? 'text-primary' : '' }}">
						                @endif
						                    All Posts
						                </a>
						            </li>
						            @if ($permissions->where('role_permission_name', 'write_post')->first()->role_permission_is_granted === '1')
						                <li>
						                    <a href="{{ url('/d3ti-admin/add_post') }}" class="{{ Request::is('d3ti-admin/add_post*') ? 'text-primary' : '' }}">
						                        Add Post
						                    </a>
						                </li>
									@if(auth()->user()->user_role == 1)
						                <li>
						                    <a href="{{ url('/d3ti-admin/post_categories') }}" class="{{ Request::is('d3ti-admin/post_categories*') ? 'text-primary' : '' }}">
						                        Categories
						                    </a>
						                </li>
						            @endif
						            @endif
						        </ul>
						    </li>
						@endif

						@if ($permissions->where('role_permission_name', 'access_event')->first()->role_permission_is_granted === '1')
						    <li class="nav-parent{{ Request::is('d3ti-admin/all_event*') || Request::is('d3ti-admin/edit_event*') || Request::is('d3ti-admin/add_event*') ? ' nav-active' : '' }}">
						        <a>
						            <i class="fa fa-bullhorn" aria-hidden="true"></i>
						            <span>Event</span>
						        </a>
						        <ul class="nav nav-children" style="{{ Request::is('d3ti-admin/all_event*') || Request::is('d3ti-admin/event_tags') ? 'display: block;' : '' }}">
						            <li>
										@if(auth()->user()->user_role == 1 || auth()->user()->user_role == 2)
						                <a href="{{ url('/d3ti-admin/all_event') }}" class="{{ Request::is('d3ti-admin/all_event*') ? 'text-primary' : '' }}">
						                @else
						                <a href="{{ url('/d3ti-admin/all_event/user_event') }}" class="{{ Request::is('d3ti-admin/all_event*') ? 'text-primary' : '' }}">
						                @endif
						                    All Posts
						                </a>
						            </li>
						            @if ($permissions->where('role_permission_name', 'write_event')->first()->role_permission_is_granted === '1')
						                <li>
						                    <a href="{{ url ('/d3ti-admin/add_event') }}" class="{{ Request::is('d3ti-admin/add_event') ? 'text-primary' : '' }}">
						                        Add Event
						                    </a>
						                </li>
						            @endif
						        </ul>
						    </li>
						@endif

						@if ($permissions->where('role_permission_name', 'access_product')->first()->role_permission_is_granted === '1')
						    <li class="nav-parent{{ Request::is('d3ti-admin/all_product*') || Request::is('d3ti-admin/edit_product*') || Request::is('d3ti-admin/add_product*') || Request::is('d3ti-admin/product_categories*') || Request::is('d3ti-admin/product_tags*') ? ' nav-active' : '' }}">
						        <a>
						            <i class="fa fa-briefcase" aria-hidden="true"></i>
						            <span>Product</span>
						        </a>
						        <ul class="nav nav-children" style="{{ Request::is('d3ti-admin/all_product*') || Request::is('d3ti-admin/product_categories*') || Request::is('d3ti-admin/product_tags*') ? 'display: block;' : '' }}">
						            <li>
										@if(auth()->user()->user_role == 1 || auth()->user()->user_role == 2)
						                <a href="{{ url('/d3ti-admin/all_product') }}" class="{{ Request::is('d3ti-admin/all_product*') ? 'text-primary' : '' }}">
						                @else
						                <a href="{{ url('/d3ti-admin/all_product/user_product') }}" class="{{ Request::is('d3ti-admin/all_product*') ? 'text-primary' : '' }}">
						                @endif
						                    All Products
						                </a>
						            </li>
						            @if ($permissions->where('role_permission_name', 'write_product')->first()->role_permission_is_granted === '1')
						                <li>
						                    <a href="{{ url('/d3ti-admin/add_product') }}" class="{{ Request::is('d3ti-admin/add_product*') ? 'text-primary' : '' }}">
						                        Add Product
						                    </a>
						                </li>
										@if(auth()->user()->user_role == 1)
						                <li>
						                    <a href="{{ url('/d3ti-admin/product_categories') }}" class="{{ Request::is('d3ti-admin/product_categories*') ? 'text-primary' : '' }}">
						                        Categories
						                    </a>
						                </li>
						                @endif
						            @endif
						        </ul>
						    </li>
						@endif

						<li class="nav{{ Request::is('d3ti-admin/tags') ? ' nav-active' : '' }}">
							<a href="{{ url('/d3ti-admin/tags') }}">
								<i class="fa fa-tags" aria-hidden="true"></i>
								<span>Tags</span>
							</a>
						</li>

					<hr class="separator" />
						@if(auth()->user()->user_role == 1 || auth()->user()->user_role == 2)
						<li class="nav{{ Request::is('d3ti-admin/all_comment*') ? ' nav-active' : '' }}">
							<a href="{{ url('/d3ti-admin/all_comment/post_comment') }}">
								<i class="fa fa-comments" aria-hidden="true"></i>
								<span class="pull-right label label-primary">{{ $countPendingComment }}</span>
								<span>Comment</span>
							</a>
						</li>
						@endif


					@if(auth()->user()->user_role == 1)
					<hr class="separator" />

						<li class="nav-parent">
							<a>
								<i class="fa fa-cog" aria-hidden="true"></i>
								<span>Options</span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a href="">
										 Homepage
									</a>
								</li>
								<li>
									<a href="">
										 Article
									</a>
								</li>
								<li>
									<a href="">
										 Gallery
									</a>
								</li>
							</ul>
						</li>
					@endif

						<li class="nav{{ Request::is('d3ti-admin/youtube') ? ' nav-active' : '' }}">
							<a href="{{ url('/d3ti-admin/youtube') }}">
								<i class="fa fa-youtube" aria-hidden="true"></i>
								<span>Youtube</span>
							</a>
						</li>

					<hr class="separator" />

						@if ($permissions->where('role_permission_name', 'access_user')->first()->role_permission_is_granted === '1')
						  <li class="nav{{ Request::is('d3ti-admin/all_user') ? ' nav-active' : '' }}">
						    <a href="{{ url('/d3ti-admin/all_user') }}">
						      <i class="fa fa-users" aria-hidden="true"></i>
						      <span>User</span>
						    </a>
						  </li>
						@endif

					@if(auth()->user()->user_role == 1)
					  <li class="nav{{ Request::is('d3ti-admin/role') ? ' nav-active' : '' }}">
					    <a href="{{ url('/d3ti-admin/role') }}">
					      <i class="fa fa-key" aria-hidden="true"></i>
					      <span>Role</span>
					    </a>
					  </li>

					<hr class="separator" />

						<li class="nav">
							<a href="https://cwp.d3tiuns.com:2087/pma/index.php?route=/database/structure&server=1&db=d3tisolo_website" target="_blank">
								<i class="fa fa-database" aria-hidden="true"></i>
								<span>Database</span>
							</a>
						</li>
					@endif

</aside>