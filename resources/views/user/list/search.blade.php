@extends('user.layout')
@section('content')
<head>
    <title>{{ $search }}</title>
    <link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
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
            <h1 class="mb-3 text-primary font-weight-bold">Result for {{ $search }}</h1>
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach($data_post as $data)
                        @php
                            $countPostComment = countPostComment($data->post_id);
                            $countPostComment = sprintf("%02d", $countPostComment);
                      
                            $dateString = $data->post_date;

                            $date = new DateTime($dateString);
                            $date = $date->format('d');

                            $month = new DateTime($dateString);
                            $month = $month->format('M');

                            $postUrl = getSelectedPostUrl($data->post_id);
                            $postUrl = $postUrl->first();
                        @endphp
                        <article class="blog_item">
                            <div class="blog_item_img">

                                <a href="{{ url('/'.$postUrl->post_categories_url.'/'.$data->post_link) }}"><img class="card-img rounded-0" src="{{ url ('storage/featured_images/'.$data->post_featured_image) }}" alt="featured-image"></a>
                                <a class="blog_item_date">
                                    <h3>{{ $date }}</h3>
                                    <p>{{ $month }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{ url('/'.$postUrl->post_categories_url.'/'.$data->post_link) }}">
                                    <h2>{{ $data->post_title }}</h2>
                                </a>
                                <p>{{ $data->post_excerpt }}</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> {{ $data->post_author }}</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> {{ $countPostComment }} Comments</a></li>
                                </ul>
                            </div>
                        </article>
                        @endforeach
                        <nav class="blog-pagination justify-content-center d-flex">
                          <ul class="pagination">
                            @if ($data_post->currentPage() > 2)
                              <li class="page-item pagination-mobile-only">
                                <a class="page-link" href="{{ $data_post->url(1) }}">
                                    <i class="fa fa-angle-double-left"></i>
                                </a>
                              </li>
                            @endif

                            @if ($data_post->currentPage() > 1)
                              <li class="page-item">
                                <a class="page-link" href="{{ $data_post->previousPageUrl() }}" aria-label="Previous">
                                  <i class="fa fa-angle-left"></i>
                                </a>
                              </li>
                            @endif

                            @for ($i = max(1, $data_post->currentPage() - 1); $i <= min($data_post->lastPage(), $data_post->currentPage() + 2); $i++)
                              <li class="page-item {{ ($data_post->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $data_post->url($i) }}">{{ $i }}</a>
                              </li>
                            @endfor

                            @if ($data_post->hasMorePages())
                              <li class="page-item">
                                <a class="page-link" href="{{ $data_post->nextPageUrl() }}" aria-label="Next">
                                  <i class="fa fa-angle-right"></i>
                                </a>
                              </li>
                            @endif

                            @if ($data_post->currentPage() < $data_post->lastPage() - 2)
                              <li class="page-item pagination-mobile-only">
                                <a class="page-link" href="{{ $data_post->url($data_post->lastPage()) }}">
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                              </li>
                            @endif
                          </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        {{-- <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Resaurant food</p>
                                        <p>(37)</p>
                                    </a>
                                </li>
                            </ul>
                        </aside> --}}
                        
                      <aside class="single_sidebar_widget popular_post_widget">
                         <h3 class="widget_title">Recent Post</h3>
                         @foreach($recent_post as $recent)
                            @php
                                $dateString = $recent->post_date;
                                $date = new DateTime($dateString);
                                $formattedDate = $date->format('M j, Y');

                                $categories = getPostCategories($recent->post_id);

                                $postUrl = getSelectedPostUrl($recent->post_id);
                                $postUrl = $postUrl->first();
                            @endphp
                         <div class="media post_item">
                            <img src="{{ url('storage/featured_images/'."(thumbnail)".$recent->post_featured_image) }}" alt="featured-image" style="height: 60px; width: 107px; object-fit: cover;">

                            <div class="media-body">
                               <a href="{{ url('/'.$postUrl->post_categories_url.'/'.$recent->post_link) }}">
                                  <h3>{{ $recent->post_title }}</h3>
                               </a>
                               <p>{{ $formattedDate }}</p>
                            </div>
                         </div>
                         @endforeach
                      </aside>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection