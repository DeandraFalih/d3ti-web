@extends('user.layout')
@section('content')
@foreach($data_event as $data)
@php
   $event_comment = getEventComment($data->event_id);
   $count_event_comment = countEventComment($data->event_id);
   $count_event_comment = sprintf("%02d", $count_event_comment);
@endphp
<head>
   <title>{{ $data->event_title }}</title>
   <link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
   <meta name="description" content="{{ $data->event_meta }}">
   <script>
       @if(session('status'))
           alert("{{ session('status') }}");
       @endif
   </script>
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
    height: 40px;
    width: 100%;
    background-color: #4285F4;
    border: 2px;
    border-radius: 5px;
  }
  #countdown{
      margin-top: 5px;
  }
  @media (max-width: 767px) {
    #countdown {
      font-size: 16px;
      margin-top: 5px;
    }
    .square {
      height: 30px;
    }
  }
</style>
</head>
<section class="blog_area single-post-area mt-30">
   @php
       // Changing the date and time format
       $date_string = $data->event_date_of_event;
       $date = new DateTime($date_string);
       $formatted_date = $date->format('M j, Y h:i A');

       // Changing the view format
       $event_view = $data->event_view;

       if ($event_view >= 1000 && $event_view < 10000) {
           $formatted_event_view = number_format($event_view / 1000, 1) . 'K';
       } else if ($event_view >= 10000) {
           $formatted_event_view = number_format($event_view / 1000) . 'K';
       } else {
           $formatted_event_view = $event_view;
       }
   @endphp
   <div class="container">
      <div class="row">
         <div class="col-lg-12 posts-list">
            <div class="single-post">
               <h6><small><a href="{{ url('/') }}">Home</a> >  <a>Event</a> >  <a href="#">{{ $data->event_title }}</a></small></h6>
               <h1 class="mt-3">{{ $data->event_title }}</h1>
               <br>
               <div class="feature-img">
                  <img class="img-fluid w-100" src="{{ url('storage/featured_images/'.$data->event_featured_image) }}" style="object-fit: cover;">
               </div>
                 <div class="square mt-10">
                     <div class="text-countdown">
                        <h5 class="text-white" id="countdown" data-event-date="{{ $formatted_date }}"></h5>
                     </div>
                  </div>
               <div class="blog_details">
                  <ul class="blog-info-link mt-1 mb-4">
                     <li><i class="fa fa-user"></i> By <a href="#">{{ $data->event_author }}</a></li>
                     <li>
                         <i class="fa fa-calendar"></i> {{ $formatted_date }}
                            <span style="position: absolute; right: 0;">
                               <i class="fa fa-eye"></i> <span style="font-weight: normal;">{{ $formatted_event_view }}</span>
                            </span>
                      </li>
                  </ul>
                  {!! $data->event_content !!}
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
            @if ($count_event_comment == 0)
            @else
            <div class="comments-area">
               <h4>{{ $count_event_comment }} Comments</h4>
               @foreach($event_comment as $comment)
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
                              {{ $comment->event_comment_value }}
                           </p>
                           <div class="d-flex justify-content-between">
                              <div class="d-flex align-items-center">
                                 <h5>
                                    <a href="#">{{ $comment->event_comment_name }}</a>
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
               <form method="POST" action="{{ url('/e/comment/add_comment/process') }}">
                  @csrf
                  <div class="row">
                     <input class="form-control" name="event_id" type="hidden" value="{{ $data->event_id }}">
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
      </div>
   </div>
</section>
<script>
    var eventDate = new Date("{{ $formatted_date }}");
</script>
<script src="{{ url ('user/js/countdown.js') }}"></script>
@endforeach
@endsection
