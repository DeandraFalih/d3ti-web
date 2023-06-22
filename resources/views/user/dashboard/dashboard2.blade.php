@extends('user.layout')
@section('content')

<head>
    <title>D3 Teknik Informatika</title>
    <link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
    <link rel="stylesheet" href="{{ url ('user/css/mobile.css') }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#header-carousel').carousel({
                interval: 5000,
                pause: false
            });
        });
    </script>

    <style>
        .slick-dots {
            display: none !important;
        }

        .slick-arrow {
            display: none !important;
        }

        @media (max-width: 767px) {
            .weekly2-more-btn {
                display: none;
            }
            #my-row {
                margin-top: 0px !important;
            }
          
            .facts {
                display: none !important;
            }

            .custom-tittle-size {
                font-size: 2.0rem !important; 
                margin-bottom: 10;
                padding-bottom: 9.25rem !important;
            }
          
          
            .carousel-item img{
                max-height: 200px !important;
            }
          
            #logo-mitra{
              height: 390px !important;
            }
        }

        @media (max-width: 1204px) {
            .facts {
                display: none !important;
            }

            .custom-tittle-size {
                font-size: 2.5rem !important; 
                margin-bottom: 10;
                padding-bottom: 9.25rem !important;
            }
        }

        .carousel-caption {
            z-index: 1;
        }
    </style>
<style>
  .text-countdown {
    text-align: center;
    color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }
  .square {
    height: 30px;
    width: 100%;
    background-color: #4285F4;
    border: 2px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    margin-top: 0px;
  }
  .countdown{
      margin-top: 5px;
      font-size: 14px;
  }
  @media (max-width: 767px) {
    .countdown {
      margin-top: 5px;
    }
    .square {
      height: 30px;
    }
  }
</style>
</head>
<main>
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ url ('user/img/slider/teknik informatika d3tius sekolah vokasi uns-1.jpg') }}" height="600" style="object-fit: cover;" alt="sekolah vokasi" >
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ url ('user/img/slider/teknik informatika d3tius sekolah vokasi uns-kampus-mesen1.jpg') }}" height="600" style="object-fit: cover;" alt="sekolah vokasi" >
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ url ('user/img/slider/teknik informatika d3tius sekolah vokasi uns-kampus-mesen2.jpg') }}" height="600" style="object-fit: cover;" alt="sekolah vokasi" >
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ url ('user/img/slider/teknik informatika d3tius sekolah vokasi uns-kampus-mesen3.jpg') }}" height="600" style="object-fit: cover;" alt="sekolah vokasi" >
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ url ('user/img/slider/teknik informatika d3tius sekolah vokasi uns-kampus-mesen4.jpg') }}" height="600" style="object-fit: cover;" alt="sekolah vokasi" >
                </div>
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center mb-5">
                            <div class="col-lg-9">
                                  {{-- <h1 class="display-4 text-light mb-8 animated slideInDown font-weight-bold custom-tittle-size">Selamat Datang di D3 Teknik Informatika UNS</h1> --}}
                            </div>
                        </div>
                        <div class="container-fluid facts py-9 pt-lg-0 text-worksans">
                            <div class="container py-9 pt-lg-0">
                                <div class="row gx-0">
                                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                                        <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                                            <div class="d-flex">
                                                <div class="btn-lg-square">
                                                  <img src="{{ url ('user/img/logo d3ti uns.png') }}" height="48px" weight="48px">
                                                </div>
                                                <div class="ps-4 text-white">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                                        <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                                            <div class="d-flex">
                                                <div class="btn-lg-square">
                                                  <img src="{{ url ('user/img/logo d3ti uns.png') }}" height="48px" weight="48px">
                                                </div>
                                                <div class="ps-4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                                        <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                                            <div class="d-flex">
                                                <div class="btn-lg-square">
                                                  <img src="{{ url ('user/img/logo d3ti uns.png') }}" height="48px" weight="48px">
                                                </div>
                                                <div class="ps-4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                                        <div class="bg-white d-flex align-items-center p-2" style="max-height: 2px; background-color: #FFFF00 !important;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="weekly2-news-area weekly2-pading gray-bg">
          <div class="container">
              <div class="weekly2-wrapper">
                  <div class="row" id="my-row" style="margin-top: -50px;">
                      <div class="col-lg-6">
                          <div class="section-tittle">
                              <h3>Berita Seputar D3TI</h3>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="weekly2-more-btn text-lg-right">
                              <p><a href="{{ url('/p/category/news') }}" class="view-more" style="color: #1A237E;"><b>View More</b></a></p>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                        <div class="col-12">
                            <div class="weekly2-news-active dot-style d-flex dot-style">
                                @foreach($data_post as $data)
                                @php
                                    $date_string = $data->post_date;
                                    $date = new DateTime($date_string);
                                    $formatted_date = $date->format('M j, Y');

                                    $categories = getPostCategories($data->post_id);

                                    $post_url = getSelectedPostUrl($data->post_id);
                                    $post_url = $post_url->first();
                                @endphp
                                <div class="weekly2-single">
                                    <div class="weekly2-img">
                                        <a href="{{ url('/'.$post_url->post_categories_url.'/'.$data->post_link) }}"><img src="{{ url ('storage/featured_images/'."(thumbnail)".$data->post_featured_image) }}" alt="featured-image" style="height: 170px; object-fit: cover;"></a>
                                    </div>
                                    <div class="weekly2-caption">
                                        <span class="color1">{{ $categories }}</span>
                                        <ul class="blog-info-link mt-1 mb-1">
                                            <li><i class="fa fa-user"></i><a href="#">{{ $data->post_author }}</a></li>
                                            <li><i class="fa fa-calendar"></i> {{ $formatted_date }}</li>
                                         </ul>
                                        <h4><a href="{{ url('/'.$post_url->post_categories_url.'/'.$data->post_link) }}">{{ $data->post_title }}</a></h4>
                                    </div>
                                </div> 
                                @endforeach
                            </div>
                        </div>
                  </div>
              </div>
          </div>
      </div>
      
      <div class="weekly2-news-area weekly2-pading">
          <div class="container">
              <div class="weekly2-wrapper">
                  <div class="row" id="my-row" style="margin-top: 20px;">
                      <div class="col-lg-6">
                          <div class="section-tittle">
                              <h3>Event D3TI</h3>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="weekly2-more-btn text-lg-right">
                              <p><a href="{{ url('/e/category/event') }}" class="view-more" style="color: #1A237E;"><b>View More</b></a></p>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                        <div class="col-12">
                            <div class="weekly2-news-active dot-style d-flex dot-style">
                                @foreach($data_event as $data)
                                @php
                                   $date_string = $data->event_date_of_event;
                                   $date = new DateTime($date_string);
                                   $formatted_date = $date->format('M j, Y h:i A');

                                   $countdown_id = 'countdown_' . $loop->iteration;
                                @endphp
                                <div class="weekly2-single">
                                    <div class="weekly2-img">
                                        <a href="{{ url('/e/event/'.$data->event_link) }}"><img src="{{ url('storage/featured_images/'.$data->event_featured_image) }}" alt="featured-image" style="height: 170px; object-fit: cover; border-bottom-left-radius: 0; border-bottom-right-radius: 0;"></a>
                                         <div class="square mt-10">
                                             <div class="text-countdown">
                                                <h5 class="text-white countdown" id="{{ $countdown_id }}" data-event-date="{{ $formatted_date }}"></h5>
                                             </div>
                                          </div>
                                    </div>
                                    <div class="weekly2-caption">
                                        <span></span>
                                        <ul class="blog-info-link mt-1 mb-1">
                                            <li><i class="fa fa-user"></i><a href="#">{{ $data->event_author }}</a></li>
                                            <li><i class="fa fa-calendar"></i> {{ $formatted_date }}</li>
                                         </ul>
                                        <h4><a href="{{ url('/e/event/'.$data->event_link) }}">{{ $data->event_title }}</a></h4>
                                    </div>
                                </div> 
                                @endforeach
                            </div>
                        </div>
                  </div>
              </div>
          </div>
  
      <div class="weekly2-news-area weekly2-pading">
            <div class="container">
                <div class="weekly2-wrapper">
                    <div class="row" id="my-row" style="margin-top: -50px;">
                        <div class="col-lg-6">
                            <div class="section-tittle mb-30">
                                <h3>Video Youtube Terbaru</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="weekly2-news-active dot-style d-flex dot-style">
                                @foreach($data_youtube as $video)
                                <div class="weekly2-single">
                                    <div class="weekly2-img">
                                        <a href="https://www.youtube.com/watch?v={{ $video->youtube_video_id }}" target="_blank">
                                            <img src="https://img.youtube.com/vi/{{ $video->youtube_video_id }}/hqdefault.jpg" style="height: 160px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="weekly2-caption">
                                        <span class="color3">Click to Watch the Video</span>
                                        <h4><a href="https://www.youtube.com/watch?v={{ $video->youtube_video_id }}" target="_blank">{{ $video->youtube_title }}</a></h4>
                                    </div>
                                </div> 
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
      {{--
        <div class="youtube-area video-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-tittle" style="margin-bottom: 20px;">
                            <h3>Video Youtube Terbaru</h3>
                        </div>
                            <div class="video-items text-center">
                                <iframe src="https://www.youtube.com/embed/{{ $data_youtube[0]->youtube_video_id }}" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                    </div>
                </div>
                <div class="video-info">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="video-caption">
                                <div class="bottom-caption" style="margin-top: 110px;">
                                    <h2>{{ $data_youtube[0]->youtube_title }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="margin-top: -100px;">
                            <div class="testmonial-nav text-center">
                                @foreach($data_youtube as $video)
                                    <div class="single-video">
                                    <iframe src="https://www.youtube.com/embed/{{ $video->youtube_video_id }}/hqdefault.jpg" frameborder="0"></iframe>
                                        <h6>{{ $video->youtube_title }}</h6>
                                    </a>
                                    </div>
                                @endforeach
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}

            <div class="weekly2-news-area weekly2-pading gray-bg">
                <div class="container">
                    <div class="weekly2-wrapper">
                        <div class="row" id="my-row" style="margin-top: -50px;">
                            <div class="col-lg-6">
                                <div class="section-tittle mb-30">
                                    <h3>Mitra Kerjasama D3 Teknik Informatika</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="weekly2-news-active dot-style d-flex dot-style" id="mitra-kerjasama-slider">
                                    <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/1-time.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                    <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/2-arutala.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                    <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/3-monter.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                    <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/4-koinfo.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                    <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/5-lifemedia.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                    <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/6-sukoharjo.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                    <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/7-karanganyar.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                    <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/8-wonogiri.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                   <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/9-pindad.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                   <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/10-redhat.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                   <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/11-omah-osi.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                   <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/12-oracle.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div>
                                   <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/13-mikrotik.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                   <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ url ('user/img/mitra/14-solo.jpg') }}" alt="featured-image" style="height: auto;" id="logo-mitra">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!--Gallery -->
            <div class="container box_1170">
                <div class="section-top-border">
                    <h3>Galeri D3 Teknik Informatika</h3>
                    <div class="row gallery-item">
                        <div class="col-md-4">
                            <a href="{{ url ('user/img/galeri/galeri1.jpg') }}" class="img-pop-up">
                                <div class="single-gallery-image" style="background: url('user/img/galeri/galeri1.jpg');"></div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url ('user/img/galeri/galeri2.jpg') }}" class="img-pop-up">
                                <div class="single-gallery-image" style="background: url('user/img/galeri/galeri2.jpg');"></div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url ('user/img/galeri/galeri3.jpg') }}" class="img-pop-up">
                                <div class="single-gallery-image" style="background: url('user/img/galeri/galeri3.jpg');"></div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url ('user/img/galeri/galeri4.jpg') }}" class="img-pop-up">
                                <div class="single-gallery-image" style="background: url('user/img/galeri/galeri4.jpg');"></div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url ('user/img/galeri/galeri5.jpg') }}" class="img-pop-up">
                                <div class="single-gallery-image" style="background: url('user/img/galeri/galeri5.jpg');"></div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url ('user/img/galeri/galeri6.jpg') }}" class="img-pop-up">
                                <div class="single-gallery-image" style="background: url('user/img/galeri/galeri6.jpg');"></div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url ('user/img/galeri/galeri7.jpg') }}" class="img-pop-up">
                                <div class="single-gallery-image" style="background: url('user/img/galeri/galeri7.jpg');"></div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url ('user/img/galeri/galeri8.jpg') }}" class="img-pop-up">
                                <div class="single-gallery-image" style="background: url('user/img/galeri/galeri8.jpg');"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    <!--Gallery -->

    <!--
    <div class="pagination-area pb-45 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                              <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                              <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                            </ul>
                          </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
</main>
<script>
    var countdownElements = document.querySelectorAll("[data-event-date]");

    countdownElements.forEach(function(element) {
        var eventDate = new Date(element.getAttribute("data-event-date"));
        var countdownId = element.id;

        // Compare the event date with the current date
        if (Date.now() < eventDate) {
            // Update the countdown every second
            var countdownInterval = setInterval(function() {
                // Calculate the remaining time
                var remainingTime = eventDate - Date.now();

                // Calculate the days, hours, minutes, and seconds
                var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                var hours = Math.floor((remainingTime / (1000 * 60 * 60)) % 24);
                var minutes = Math.floor((remainingTime / (1000 * 60)) % 60);
                var seconds = Math.floor((remainingTime / 1000) % 60);

                // Display the countdown
                element.textContent = ('0' + days).slice(-2) + " Days, " +
                    ('0' + hours).slice(-2) + " Hours, " + ('0' + minutes).slice(-2) + " Minutes, " + ('0' + seconds).slice(-2) + " Seconds ";

                // Check if the event has passed
                if (remainingTime < 0) {
                    // Display the event has passed message
                    element.textContent = "Event Has Passed";

                    // Clear the countdown interval
                    clearInterval(countdownInterval);
                }
            }, 1000);
        } else {
            // Display the event has passed message
            element.textContent = "Event has passed";
        }
    });
</script>
@endsection