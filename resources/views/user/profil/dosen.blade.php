@extends('user.layout')
@section('content')

<head>
    <title>Dosen Pengajar D3 Teknik Informatika SV UNS</title>
    <link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
  	  <style>
        .team-items {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

    </style>
</head>

<div class="container-xxl py-6">
    <div class="container mt-80 mb-80">
        <div class="text-center mx-auto mb-5 wow fadeInUp">
            <h1 class="text-dark mb-4">Kaprodi D3 Teknik Informatika</h1>
        </div>
        <div class="row g-0 team-items">
            @foreach($data_kaprodi as $data)
            <div class="col-lg-3 col-md-6 wow fadeInUp">
                <div class="team-item position-relative">
                    <div class="position-relative">
                        <img class="img-fluid" src="{{ url('storage/profile/'.$data->user_picture) }}" alt="">                    
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="text-dark mb-4" style="height: 25px;">{{ $data->user_name }}</h5>
                        <span>{{ $data->user_email }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="container-xxl py-6">
    <div class="container mt-80 mb-80">
        <div class="text-center mx-auto mb-5 wow fadeInUp">
            <h1 class="text-dark mb-4">Kepala Lab, Kurikulum dan GKM (Gugus Kendali Mutu)</h1>
        </div>
        <div class="row g-0 team-items">
            @foreach($data_kepala as $data)
            <div class="col-lg-3 col-md-6 wow fadeInUp">
                <div class="team-item position-relative">
                    <div class="position-relative">
                        <img class="img-fluid" src="{{ url('storage/profile/'.$data->user_picture) }}" alt="">                    
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="text-dark mb-4" style="height: 25px;">{{ $data->user_name }}</h5>
                        <span>{{ $data->user_email }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="container-xxl py-6">
    <div class="container mt-80 mb-80">
        <div class="text-center mx-auto mb-5 wow fadeInUp">
            <h1 class="text-dark mb-4">Divisi TA, Kemahasiswaan, Kerjasama dan Magang Industri</h1>
        </div>
        <div class="row g-0 team-items">
            @foreach($data_divisi as $data)
            <div class="col-lg-3 col-md-6 wow fadeInUp">
                <div class="team-item position-relative">
                    <div class="position-relative">
                        <img class="img-fluid" src="{{ url('storage/profile/'.$data->user_picture) }}" alt="">                    
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="text-dark mb-4" style="height: 25px;">{{ $data->user_name }}</h5>
                        <span>{{ $data->user_email }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="container-xxl py-6">
    <div class="container mt-80 mb-80">
        <div class="text-center mx-auto mb-5 wow fadeInUp">
            <h1 class="text-dark mb-4">Dosen Pengajar D3 Teknik Informatika</h1>
        </div>
        <div class="row g-0 team-items">
            @foreach($data_dosen as $data)
            <div class="col-lg-3 col-md-6 wow fadeInUp">
                <div class="team-item position-relative">
                    <div class="position-relative">
                        <img class="img-fluid" src="{{ url('storage/profile/'.$data->user_picture) }}" alt="">                    
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="text-dark mb-4" style="height: 25px;">{{ $data->user_name }}</h5>
                        <span>{{ $data->user_email }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="container-xxl py-6">
    <div class="container mt-80 mb-80">
        <div class="text-center mx-auto mb-5 wow fadeInUp">
            <h1 class="text-dark mb-4">Staff Admin D3 Teknik Informatika</h1>
        </div>
        <div class="row g-0 team-items">
            <div class="col-lg-3 col-md-6 wow fadeInUp">
                <div class="team-item position-relative">
                    <div class="position-relative">
                        <img class="img-fluid" src="{{ url ('user/img/dosen/sari.jpg') }}" alt="">                    
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="text-dark mb-4">Nurlaily Purnama Sari, S.Kom.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection