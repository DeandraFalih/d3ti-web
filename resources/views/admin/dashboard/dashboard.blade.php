@extends('admin.layout')

@section('content')
@php
$total_comment = countTotalComment();
$pending_comment = countPendingComment();
@endphp
<head>
	<title>D3 Teknik Informatika - Admin Dashboard</title>
</head>
<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>
							</ol>
							<a class="sidebar-right-toggle"></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                          <section class="panel">
                            <div class="panel-body">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="chart-data-selector" id="salesSelectorWrapper">
                                    <h2>
                                      Views From The Last 14 Days:
                                    </h2>

                                    <div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
                                      <!-- Flot: Sales JSOFT Admin -->
                                      <div class="chart chart-sm" data-sales-rel="JSOFT Admin" id="flotDashSales1" style="height: 350px;"></div>
                                      <script>
                                        var flotDashSales1Data = [{
                                          data: @json($view_data),
                                          color: "#0088cc"
                                        }];
                                      </script>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </section>
                        </div>
                      
						<div class="col-lg-6 col-md-12">
							<section class="panel">
								<header class="panel-heading panel-heading-transparent">
									<h2 class="panel-title">Daily Views</h2>
								</header>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped mb-none">
											<thead>
												<tr>
													<th>#</th>
													<th>Title</th>
													<th>View</th>
                                                  	<th>Type</th>
													<th>Date</th>
												</tr>
											</thead>
											<tbody>
												@foreach($daily_data as $key => $data)
												<tr>
													@php
												       $date_string = $data->created_at;
												       $date = new DateTime($date_string);
												       $formatted_date = $date->format('F j, Y');
													@endphp
													<td>{{ $key + 1 }}</td>
													<td>{{ $data->daily_view_title }}</td>
													<td>{{ $data->daily_view_count }}</td>
													<td>{{ $data->daily_view_type }}</td>
													<td>{{ $formatted_date }}</td>
												</tr>
												@endforeach
												<tr>
											</tbody>
										</table>
									</div>
								</div>
							</section>
						</div>
						<div class="col-md-6 col-lg-12 col-xl-6">
							<div class="row" style="margin-top: 56px;">
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-comments"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Comments</h4>
														<div class="info">
															<strong class="amount">{{ $total_comment }}</strong>
															<span class="text-primary">({{ $pending_comment }} Pending)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="{{ url('d3ti-admin/all_comment/post_comment') }}">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-secondary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
														<i class="fa fa-usd"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Total Profit</h4>
														<div class="info">
															<strong class="amount">$ 14,890.30</strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase">(withdraw)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-tertiary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-tertiary">
														<i class="fa fa-shopping-cart"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Today's Orders</h4>
														<div class="info">
															<strong class="amount">38</strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase">(statement)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-quartenary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-quartenary">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Today's Visitors</h4>
														<div class="info">
															<strong class="amount">3765</strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase">(report)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</aside>
		
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
		<script src="{{ url ('admin/assets/vendor/jquery-appear/jquery.appear.j') }}s"></script>
		<script src="{{ url ('admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jquery-easypiechart/jquery.easypiechart.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/flot/jquery.flot.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/flot-tooltip/jquery.flot.tooltip.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/flot/jquery.flot.categories.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/flot/jquery.flot.resize.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/raphael/raphael.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/morris/morris.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/gauge/gauge.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/snap-svg/snap.svg.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/liquid-meter/liquid.meter.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jqvmap/jquery.vmap.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
		<script src="{{ url ('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{ url ('admin/assets/javascripts/theme.js') }}"></script>
		
		<!-- Theme Custom -->
		<script src="{{ url ('admin/assets/javascripts/theme.custom.js') }}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ url ('admin/assets/javascripts/theme.init.js') }}"></script>


		<!-- Examples -->
		<script src="{{ url ('admin/assets/javascripts/dashboard/examples.dashboard.js') }}"></script>

@endsection