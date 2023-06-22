@extends('user.layout')
@section('content')
<head>
    <title>Event</title>
    <link rel="stylesheet" href="{{ url('user/css/box.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .page-item.active .page-link {
            color: #fd7e14 !important;
        }

         @media (max-width: 767px) {
            .pagination-mobile-only {
              display: none;
            }
          }
    </style>
</head>

<section class="blog_area section-padding">
    <div class="container">
        <h1 class="mb-3 text-primary font-weight-bold">Event</h1>
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    @foreach($data_event as $data)
                    @php

                        $date_string = $data->event_date;

                        $date = new DateTime($date_string);
                        $date = $date->format('d');

                        $month = new DateTime($date_string);
                        $month = $month->format('M');
                    @endphp
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <a href="{{ url('/e/event/'.$data->event_link) }}"><img class="card-img rounded-0" src="{{ url ('storage/featured_images/'.$data->event_featured_image) }}" alt="featured-image"></a>
                            <a class="blog_item_date">
                                <h3>{{ $date }}</h3>
                                <p>{{ $month }}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="{{ url('/e/event/'.$data->event_link) }}">
                                <h2>{{ $data->event_title }}</h2>
                            </a>
                            <p>{{ $data->event_excerpt }}</p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-user"></i> {{ $data->event_author }}</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i>  Comments</a></li>
                            </ul>
                        </div>
                    </article>
                    @endforeach
                    <nav class="blog-pagination justify-content-center d-flex">
                      <ul class="pagination">
                        @if ($data_event->currentPage() > 2)
                          <li class="page-item pagination-mobile-only">
                            <a class="page-link" href="{{ $data_event->url(1) }}">
                                <i class="fa fa-angle-double-left"></i>
                            </a>
                          </li>
                        @endif

                        @if ($data_event->currentPage() > 1)
                          <li class="page-item">
                            <a class="page-link" href="{{ $data_event->previousPageUrl() }}" aria-label="Previous">
                              <i class="fa fa-angle-left"></i>
                            </a>
                          </li>
                        @endif

                        @for ($i = max(1, $data_event->currentPage() - 1); $i <= min($data_event->lastPage(), $data_event->currentPage() + 2); $i++)
                          <li class="page-item {{ ($data_event->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $data_event->url($i) }}">{{ $i }}</a>
                          </li>
                        @endfor

                        @if ($data_event->hasMorePages())
                          <li class="page-item">
                            <a class="page-link" href="{{ $data_event->nextPageUrl() }}" aria-label="Next">
                              <i class="fa fa-angle-right"></i>
                            </a>
                          </li>
                        @endif

                        @if ($data_event->currentPage() < $data_event->lastPage() - 2)
                          <li class="page-item pagination-mobile-only">
                            <a class="page-link" href="{{ $data_event->url($data_event->lastPage()) }}">
                                <i class="fa fa-angle-double-right"></i>
                            </a>
                          </li>
                        @endif
                      </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
