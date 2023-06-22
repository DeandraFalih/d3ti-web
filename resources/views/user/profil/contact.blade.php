@extends('user.layout')
@section('content')

<head>
    <title>Contact</title>
    <link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
  <style>
        @media (min-width: 767px) {
            #map2 {
                display: none !important;
            }
          }        
        @media (max-width: 767px) {
            #map1 {
                display: none !important;
            }
          }
  </style>
</head>

<br>
  <div class="container">
    <div class="container-sm">
        <div class="container">
            <div class="row">
              <div class="container">
                  <h1 class="mb-3 text-primary font-weight-bold">Contact</h1><br>
                  <h3 class="mb-3 text-primary font-weight-bold">Google Maps</h3><br>
                   <div class="d-none d-sm-block mb-5 pb-4" id="map1">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.1098677734217!2d110.83377821554613!3d-7.562998876789651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a17bfca3568f1%3A0x52872ee12cf2fa57!2sKampus%20UNS%20Mesen!5e0!3m2!1sen!2sid!4v1681055365020!5m2!1sen!2sid" class="img-fluid w-100" style="border:0; height: 500px !important;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                          <script>
                              function initMap() {
                                  var uluru = {
                                      lat: -25.363,
                                      lng: 131.044
                                  };
                                  var grayStyles = [{
                                          featureType: "all",
                                          stylers: [{
                                                  saturation: -90
                                              },
                                              {
                                                  lightness: 50
                                              }
                                          ]
                                      },
                                      {
                                          elementType: 'labels.text.fill',
                                          stylers: [{
                                              color: '#ccdee9'
                                          }]
                                      }
                                  ];
                                  var map = new google.maps.Map(document.getElementById('map'), {
                                      center: {
                                          lat: -31.197,
                                          lng: 150.744
                                      },
                                      zoom: 9,
                                      styles: grayStyles,
                                      scrollwheel: false
                                  });
                              }
                          </script>
                          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&amp;callback=initMap">
                          </script>
                      </div>
                
                
                <div class="footer-tittle container-maps" id="map2">
                                    <div class="footer-pera ">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.1098677734217!2d110.83377821554613!3d-7.562998876789651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a17bfca3568f1%3A0x52872ee12cf2fa57!2sKampus%20UNS%20Mesen!5e0!3m2!1sen!2sid!4v1681055365020!5m2!1sen!2sid" class="img-fluid w-100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                
                
					<br>
                  <div class="row">
                      <div class="col-12">
                          <h3 class="mb-3 text-primary font-weight-bold">Kontak Kami</h3>
                      </div>
                      <div class="col-lg-8">
                          <div class="media contact-info">
                              <span class="contact-info__icon"><i class="ti-home"></i></span>
                              <div class="media-body">
                                  <h3>Alamat</h3>
                                  <p>Jl. Ir Sutami No.36, Kentingan, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126</p>
                              </div>
                          </div>
                          <div class="media contact-info">
                              <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                              <div class="media-body">
                                  <h3>Nomor Telepon</h3>
                                  <p>Telephone/Fax: (0271) 663450</p>
                              </div>
                          </div>
                          <div class="media contact-info">
                              <span class="contact-info__icon"><i class="ti-email"></i></span>
                              <div class="media-body">
                                  <h3>Instagram</h3>
                                  <p>@d3ti</p>
                              </div>
                          </div>
                          <div class="media contact-info">
                              <span class="contact-info__icon"><i class="ti-email"></i></span>
                              <div class="media-body">
                                  <h3>Facebook</h3>
                                  <p>d3tiuns</p>
                              </div>
                          </div>
                          <div class="media contact-info">
                              <span class="contact-info__icon"><i class="ti-email"></i></span>
                              <div class="media-body">
                                  <h3>Youtube</h3>
                                  <p>teknikinformatikauns</p>
                              </div>
                          </div>
                          <div class="media contact-info">
                              <span class="contact-info__icon"><i class="ti-email"></i></span>
                              <div class="media-body">
                                  <h3>Email</h3>
                                  <p>kontak@d3ti.vokasi.uns.ac.id</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
 		</div>                
     </div>
  </div>
</div>



@endsection