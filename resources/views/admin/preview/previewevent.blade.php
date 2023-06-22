<!doctype html>
<html class="no-js" lang="zxx">
    @foreach($data_event as $data)
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ $data->event_title }}</title>
        <meta name="description" content="{{ $data->event_meta }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

        <link rel="stylesheet" href="{{ url ('user/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/ticker-style.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/slicknav.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/themify-icon.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/slick.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/style.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/footer.css') }}">
        <link rel="stylesheet" href="{{ url ('user/css/mobile.css') }}">
   		<link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
   		<style>
   			.header-color {
			  background-color: #34495E;
			}

			.preview-text-post {
			    margin-top: 20px;
			    margin-bottom: 20px;
			    color: #fff;
			}

			.preview-header h4 {
			    color: #fff;
			    margin: 0;
			    font-size: 24px;
			    font-weight: bold;
			}

			.preview-back-button {
			    background-color: #fff;
			    color: #000;
			    border-radius: 5px;
			    padding: 17px 17px;
			    font-size: 14px;
			    text-decoration: none;
			    box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
			}

			.preview-back-button:hover {
			    background-color: #ddd;
			    color: #000;
			}

			.preview-publish-button {
			    background-color: #0088CC;
			    color: #fff;
			    border-radius: 5px;
			    padding: 17px 17px;
			    font-size: 14px;
			    text-decoration: none;
			    box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
			    margin-right: 10px;
			}

			.preview-publish-button:hover {
			    background-color: #0099E6;
			    color: #fff;
			}

			.post_item {
			    margin-bottom: 20px;
			}
		</style>

   </head>

   <body>

		<header>
		    <div class="header-area header-color" style="background-color: #34495E;">
		        <div class="main-header ">
		           <div class="border-top header-sticky header-line-height header-color">
		                <div class="container">
		                    <div class="row align-items-center">
		                        <div class="col-md-4 custom-navbar-size align-self-center">
		                            <h4 class="preview-text-post">Preview event</h4>
		                        </div>
		                        <div class="col-md-8 d-flex justify-content-end align-items-center">
									  <a href="#" class="preview-publish-button">Publish</a>
									  <a href="#" class="preview-back-button" onclick="window.history.back()">Back</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</header>


		<section class="blog_area single-post-area mt-30">
            @php
                //Changing the date and time format
                $dateString = $data->event_date;
                $date = new DateTime($dateString);
                $formattedDate = $date->format('F j, Y h:i A');
            @endphp
		      <div class="container">
		         <div class="row">
		            <div class="col-lg-8 posts-list">
		               <div class="single-post">
		                  <small><a class="">Home</a> >  <a class="">News</a> >  <a class="">{{ $data->event_title }}</a></small>
		                  <h1 class="mt-3">{{ $data->event_title }}</h1>
		                     <br>
		                  <div class="feature-img">
		                     <img class="img-fluid w-100" src="{{ url('storage/featured_images/'.$data->event_featured_image) }}" style="object-fit: cover;">
		                  </div>
		                  <div class="blog_details">
		                     <ul class="blog-info-link mt-1 mb-4">
		                        <li><i class="fa fa-user"></i> By <a href="#">{{ $data->event_author }}</a></li>
		                        <li><i class="fa fa-calendar"></i> {{ $formattedDate }}</li>
		                     </ul>
		                     {!! $data->event_content !!}
		                  </div>
		               </div>
		               <div class="navigation-top">
		               </div>
		            </div>
		            <div class="col-lg-4">
		               <div class="blog_right_sidebar">
		                  <aside class="single_sidebar_widget popular_post_widget">
		                     <h3 class="widget_title">Recent Post</h3>
		                     <a href="">
		                     <div class="media post_item">
		                        <img src="{{ url ('user/img/post/post_1.png') }}" alt="post">
		                        <div class="media-body">
		                              <h3>Dummy Post</h3>
		                           <p>April 1, 2023</p>
		                        </div>
		                     </div>
		                     </a>

		                     <a href="">
		                     <div class="media post_item">
		                        <img src="{{ url ('user/img/post/post_2.png') }}" alt="post">
		                        <div class="media-body">
		                              <h3>Dummy Post</h3>
		                           <p>April 1, 2023</p>
		                        </div>
		                     </div>
		                     </a>

		                     <a href="">
		                     <div class="media post_item">
		                        <img src="{{ url ('user/img/post/post_3.png') }}" alt="post">
		                        <div class="media-body">
		                              <h3>Dummy Post</h3>
		                           <p>April 1, 2023</p>
		                        </div>
		                     </div>
		                     </a>

		                     <a href="">
		                     <div class="media post_item">
		                        <img src="{{ url ('user/img/post/post_4.png') }}" alt="post">
		                        <div class="media-body">
		                              <h3>Dummy Post</h3>
		                           <p>April 1, 2023</p>
		                        </div>
		                     </div>
		                     </a>
		                  </aside>

						@php
						    $selectedTags = getSelectedEventTags($data->event_id);
						@endphp
		               <div class="blog_right_sidebar">
		                  <aside class="single_sidebar_widget tag_cloud_widget">
		                     <h4 class="widget_title">Tags</h4>
		                     <ul class="list">
								@foreach($selectedTags as $tag)
		                        <li>
		                           <a>{{ $tag->tags_name }}</a>
		                        </li>
		               			@endforeach
		                     </ul>
		                  </aside>
		               </div>
		            </div>
		         </div>
		      </div>
		   </section>
@endforeach
   
	<!-- JS here -->
	
    <script src="{{ url ('user/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ url ('user/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ url ('user/js/popper.min.js') }}"></script>
    <script src="{{ url ('user/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ url ('user/js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ url ('user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url ('user/js/slick.min.js') }}"></script>
    <!-- Date Picker -->
    <script src="{{ url ('user/js/gijgo.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ url ('user/js/wow.min.js') }}"></script>
    <script src="{{ url ('user/js/animated.headline.js') }}"></script>
    <script src="{{ url ('user/js/jquery.magnific-popup.js') }}"></script>

    <!-- Breaking New Pluging -->
    <script src="{{ url ('user/js/jquery.ticker.js') }}"></script>
    <script src="{{ url ('user/js/site.js') }}"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="{{ url ('user/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ url ('user/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ url ('user/js/jquery.sticky.js') }}"></script>

    <!-- contact js -->
    <script src="{{ url ('user/js/contact.js') }}"></script>
    <script src="{{ url ('user/js/jquery.form.js') }}"></script>
    <script src="{{ url ('user/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url ('user/js/mail-script.js') }}"></script>
    <script src="{{ url ('user/js/jquery.ajaxchimp.min.js') }}"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="{{ url ('user/js/plugins.js') }}"></script>
    <script src="{{ url ('user/js/main.js') }}"></script>
        
    </body>
</html>