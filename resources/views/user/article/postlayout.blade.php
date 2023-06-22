@extends('user.layout')
@section('content')
@foreach($data_post as $data)
@php
   $post_comment = getPostComment($data->post_id);
   $count_post_comment = countPostComment($data->post_id);
   $count_post_comment = sprintf("%02d", $count_post_comment);
@endphp
<head>
   <title>{{ $data->post_title }}</title>
   <link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
   <meta name="description" content="{{ $data->post_meta }}">
   <script>
       @if(session('status'))
           alert("{{ session('status') }}");
       @endif
   </script>
</head>
        <section class="blog_area single-post-area mt-30">
            @php
                //Changing the date and time format
                $date_string = $data->post_date;
                $date = new DateTime($date_string);
                $formatted_date = $date->format('M j, Y h:i A');

                //Changing the view format
                $post_view = $data->post_view;
          
          		//Getting the first category
          		$first_category = getFirstPostCategory($data->post_id);

                if ($post_view >= 1000 && $post_view < 10000) {
                    $formatted_post_view = number_format($post_view / 1000, 1) . 'K';
                } else if ($post_view >= 10000) {
                    $formatted_post_view = number_format($post_view / 1000) . 'K';
                } else {
                    $formatted_post_view = $post_view;
                }
            @endphp
              <div class="container">
                 <div class="row">
                    <div class="col-lg-8 posts-list">
                       <div class="single-post">
                          <h6><small><a href="{{ url('/') }}">Home</a> >  <a href="{{ url('/p/category/'.$first_category->post_categories_url) }}">{{ $first_category->post_categories_name }}</a> >  <a href="#">{{ $data->post_title }}</a></small></h6>
                          <h1 class="mt-3">{{ $data->post_title }}</h1>
                             <br>
                          <div class="feature-img">
                             <img class="img-fluid w-100" src="{{ url('storage/featured_images/'.$data->post_featured_image) }}" style="object-fit: cover;">
                          </div>
                          <div class="blog_details">
                             <ul class="blog-info-link mt-1 mb-4">
                                <li><i class="fa fa-user"></i> By <a href="#">{{ $data->post_author }}</a></li>
                                <li>
                                    <i class="fa fa-calendar"></i> {{ $formatted_date }}
                                       <span style="position: absolute; right: 0;">
                                          <i class="fa fa-eye"></i> <span style="font-weight: normal;">{{ $formatted_post_view }}</span>
                                       </span>
                                 </li>

                             </ul>
                             {!! $data->post_content !!}
                          </div>
                       </div>
               <div class="navigation-top">
                  <div class="d-sm-flex justify-content-between text-center">
                     <div class="col-sm-4 text-center my-2 my-sm-0">
                     </div>
                     <ul class="social-icons">
                        @php
                            $current_url = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            $facebook = "https://www.facebook.com/sharer/sharer.php?u=".$current_url; 
                            $twitter = "https://twitter.com/intent/tweet?&url=".$current_url;
                            $whatsapp = "https://wa.me/?text=".$current_url;
                        @endphp
                        <li><a href="{{ $facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ $twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{ $whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                     </ul>
                  </div>
               </div>
               @if ($count_post_comment == 0)
               @else
               <div class="comments-area">
                  <h4>{{ $count_post_comment }} Comments</h4>
                  @foreach($post_comment as $comment)
                  @php
                     $date_string = $comment->created_at;
                     $date = new DateTime($date_string);
                     $formatted_comment_date = $date->format('M j, Y \a\t g:i a');
                  @endphp
                  <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="{{ url ('user/img/comment/fg-avatar-anonymous-user-retina.png') }}" alt="" style="border-radius: 50%;" width="70px" height="70px">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                 {{ $comment->post_comment_value }}
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">{{ $comment->post_comment_name }}</a>
                                    </h5>
                                    <p class="date">{{ $formatted_comment_date }}</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
               @endif
               <div class="comment-form">
                  <h4>Leave a Reply</h4>
                  <form method="POST" action="{{ url('/p/comment/add_comment/process') }}">
                     @csrf
                     <div class="row">
                        <input class="form-control" name="post_id" type="hidden" value="{{ $data->post_id }}">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <input class="form-control" name="name" id="name" type="text" placeholder="Name" required>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group">
                              <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment" required></textarea>
                           </div>
                        </div>
                        <div class="col-sm-12">
                           <div class="form-group">
                              <input class="form-control" name="email" id="email" type="text" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
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
                  <aside class="single_sidebar_widget tag_cloud_widget">
                     @php
                         $selectedTags = getSelectedTags($data->post_id);
                     @endphp
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
@endsection
