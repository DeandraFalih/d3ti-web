@extends('user.layout')
@section('content')

<head>
    <title>Kurikulum</title>
    <link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
</head>

<div class="container">
    <div class="container-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative mb-3">
                        <h1 class="mt-5 text-primary font-weight-bold">Visi program studi</h1>
                        <div>
                            <div class="mb-4"><br/>
                                <a class="text-body" href="">Menjadi pusat pengembangan kualitas sumber daya manusia bidang teknologi informasi yang 
                                    berkelanjutan dan unggul di tingkat internasional pada tahun 2045 dengan berlandaskan pada nilai luhur budaya nasional.</a>  
                                <br/>
                            </div>
                            <img class="img-fluid w-100" style="max-width: 700px;" src="{{ url ('user/img/smt1.jpg') }}">
                            <br>
                            <img class="img-fluid w-100" style="max-width: 700px;" src="{{ url ('user/img/smt2.jpg') }}">
                            <br>
                            <img class="img-fluid w-100" style="max-width: 700px;" src="{{ url ('user/img/smt3.jpg') }}">
                            <br>
                            <img class="img-fluid w-100" style="max-width: 700px;" src="{{ url ('user/img/smt4.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

@endsection