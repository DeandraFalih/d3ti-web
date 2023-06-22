@extends('user.layout')
@section('content')

    <head>
        <link rel="stylesheet" href="{{ url('user/css/box.css') }}">
    </head>

    <section class="blog_area section-padding">
        <div class="container">
            <h1 class="mb-3 text-primary font-weight-bold">Penelitian Dosen</h1>
            <div class="row">


                {{-- bagian utamaa --}}
                {{-- 5 juni --}}
                <div class="col-lg-8 mb-5 mb-lg-0">

                    <div class="row g-5">
{{-- atur space gambar --}}
                        <div class="col-md-6 px-5">
                            <div class="trend-bottom-img mb-10" style="height: 225px;">
                                <img class="img-fluid w-100 h-100" src="{{ url('user/img/blog/single_blog_1.png') }}"
                                    style="object-fit: cover;">

                            </div>
                            <div class="">
                                <div class="mb-2">
                                    {{-- atur button --}}
                                    <button class="genric-btn danger">Business </button>
                                    <a class="h6 m-0 text-black text-uppercase font-weight-semi-bold"
                                        href=""><small>Jan 01, 2045</small></a>
                                </div>
                                <a class="h6 m-0 text-black text-uppercase font-weight-semi-bold" href="">Lorem Lorem
                                    ipsum ahbahabhba ddaadadd
                                    ipsum.</a>
                            </div>
                        </div>

                        <div class="col-md-6 px-5">
                            <div class="trend-bottom-img mb-10" style="height: 225px;">
                                <img class="img-fluid w-100 h-100" src="{{ url('user/img/blog/single_blog_1.png') }}"
                                    style="object-fit: cover;">

                            </div>
                            <div class="">
                                <div class="mb-2">
                                    <button class="genric-btn danger">Business </button>
                                    <a class="h6 m-0 text-black text-uppercase font-weight-semi-bold"
                                        href=""><small>Jan 01, 2045</small></a>
                                </div>
                                <a class="h6 m-0 text-black text-uppercase font-weight-semi-bold" href="">Lorem ipsum
                                    Lorem ipsum ahbahabhba ddaadadd
                                    .</a>
                            </div>
                        </div>

                        <div class="col-md-6 px-5 py-4">
                            <div class="trend-bottom-img mb-10" style="height: 225px;">
                                <img class="img-fluid w-100 h-100" src="{{ url('user/img/blog/single_blog_1.png') }}"
                                    style="object-fit: cover;">

                            </div>
                            <div class="">
                                <div class="mb-2">
                                    <button class="genric-btn danger">Business </button>
                                    <a class="h6 m-0 text-black text-uppercase font-weight-semi-bold"
                                        href=""><small>Jan 01, 2045</small></a>
                                </div>
                                <a class="h6 m-0 text-black text-uppercase font-weight-semi-bold" href="">Lorem
                                    Lorem ipsum ahbahabhba ddaadadd.</a>
                            </div>
                        </div>

                        <div class="col-md-6 px-5 py-4">
                            <div class="trend-bottom-img mb-10" style="height: 225px;">
                                <img class="img-fluid w-100 h-100" src="{{ url('user/img/blog/single_blog_1.png') }}"
                                    style="object-fit: cover;">

                            </div>
                            <div class="">
                                <div class="mb-2">
                                    <button class="genric-btn danger">Business </button>
                                    <a class="h6 m-0 text-black text-uppercase font-weight-semi-bold"
                                        href=""><small>Jan 01, 2045</small></a>
                                </div>
                                <a class="h6 m-0 tex-tblack text-uppercase font-weight-semi-bold" href="">Lorem ipsum
                                    ahbahabhba ddaadadd
                                    .</a>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- bagian sidebar --}}
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Resaurant food</p>
                                        <p>(37)</p>
                                    </a>
                                </li>
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>
                            <div class="media post_item">
                                <img src="{{ url('user/img/post/post_1.png') }}" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>From life was you fish...</h3>
                                    </a>
                                    <p>January 12, 2019</p>
                                </div>
                            </div>
                        </aside>

                    </div>
                </div </div>
            </div>

            


    </section>
@endsection
