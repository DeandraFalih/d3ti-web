@extends('user.layout')
@section('content')

<head>
    <title>Tentang D3 Teknik Informatika</title>
    <link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
	<style>
  	li {
    list-style: decimal;
    
}
      ol {
    margin: 15px;
    padding: 0px

}
  	</style>
</head>       
<br>
<div class="container">
    <div class="container-sm">
        <div class="container">
            <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <h1 class="mb-3 text-primary font-weight-bold">Visi program studi</h1>
                                <div class="mb-4">
                                    <a class="text-body" href="">Menjadi pusat pengembangan kualitas sumber daya manusia bidang teknologi informasi yang 
                                        berkelanjutan dan unggul di tingkat internasional pada tahun 2045 dengan berlandaskan pada nilai luhur budaya nasional.</a>
                                </div>
                        </div>
                        <div class="position-relative mb-3"><br/>
                            <h1 class="mb-3 text-primary font-weight-bold">Misi program studi</h1>
                            <div>
                                
                                  <ol>
        <li>Menyelenggarakan pendidikan vokasional yang mengedepankan pengembangan diri Dosen dan Kemandirian Mahasiswa agar menjadi lulusan yang kompeten dan berdaya saing dalam bidang teknologi                   informasi di tingkat Nasional dan Internasional</li>
        <li>Menyelenggarakan penelitian terapan dan pengembangan bidang teknologi informasi</li>
        <li>Menyelenggarakan pengabdian bagi masyarakat berupa kepelatihan dan penerapan teknologi informasi</li>
    </ol>          
                                    
                                
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <h1 class="mb-3 text-primary font-weight-bold">Tujuan program studi</h1>
                          <a class="text-body" href="">Tujuan yang ingin dicapai oleh Program Studi D3 Teknik Informatika Sekolah Vokasi UNS adalah menghasilkan lulusan yang:</a>
                                    
                            <div>
                                <div class="mb-4">
                                    <ol>
                                      <li>Menghasilkan lulusan yang memiliki keahlian terapan tertentu dengan menjunjung tinggi etika, mampu berinteraksi dengan lingkungan, dan siap bersaing di tingkat nasional dan internasional.</li>
                                      <li>Menghasilkan teknologi dan produk barang maupun jasa hasil penelitian terapan yang bermanfaat bagi masyarakat.</li>
                                      <li>Menghasilkan produk hasil pengabdian kepada masyarakat dan mengembangkan hubungan kerjasama dengan segenap lapisan masyarakat</li>
                                      </ol>    
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="position-relative mb-5">
                            <img class="card-img rounded-0" src="{{ url ('user/img/fasilitas/IMG_0927.JPG') }}" alt="">
                            <img class="card-img rounded-0 mt-20" src="{{ url ('user/img/vokasi.jpg') }}" alt="">
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
@endsection