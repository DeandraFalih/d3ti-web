@extends('user.layout')
@section('content')


<head>
    <title>Pusat Layanan Terpadu</title>
    <link rel="stylesheet" href="{{ url ('user/css/box.css') }}">
</head>


<br>
<div class="container">
    <div class="container-sm">
        <div class="container">
            <div class="row">
                    <div class="col-lg-12">
                        <div><br/>
                            <h1 class="mb-3 text-primary font-weight-bold">Petunjuk Layanan</h1>
                            <div>
                                <div class="mb-4"><br/>
                                    <a class="text-body" href="">Beberapa hal yang perlu dipahami oleh pemohon layanan daring adalah sebagai berikut:<br>
                                        <br>
                                        1. Pahami formulir dengan teliti setiap pertanyaan dan isilah dengan data yang benar.<br>
                                        2. Lengkapi berkas persyaratan sesuai dengan jenis layanan.<br>
                                        3. Scan berkas Anda dengan kondisi rapi dan bisa terbaca.<br>
                                        4. Berilah Nama File berkas dengan benar sesuai dengan Jenis Layanan. contoh:<br>
                                            <br>
                                            - SUKET-Nim-NamaAnda.pdf = file berkas surat keterangan<br>
                                            - UJITA-Nim-NamaAnda.pdf = file berkas Pendaftaran Tugas Akhir<br>
                                            - SKMK-Nim-NamaAnda,pdf = file berkas permohonan Surat Keterangan Masih Kuliah<br>
                                        <br>
                                        5. Unggah (upload) file berkas Anda dengan jenis file PDF, yaitu satu file PDF yang memuat beberapa scan berkas, caranya adalah semua berkas yang diminta Anda susun menggunakan aplikasi ms word atau aplikasi lain, lalu save dengan jenis file PDF.<br>
                                        6. Cek ajuan Anda di menu Status Layanan atau konfirm ke nomer layanan yang tersedia.<br>
                                        Jika Berkas persyaratan lengkap, sah dan benar maka selanjutnya Petugas akan memproses ajuan Anda dan menerbitkan surat dalam bentuk file PDF lalu mengirimkan ke Nomer Whatsapp yang Anda isikan.
                                        
                                        Jika berkas persyaratan tidak lengkap, tidak sah, tidak benar maka petugas akan menampilkan keterangan di status layanan. Silahkan lengkapi berkas Anda jika ada yang salah/kurang.</a>
                                    <br/>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative mb-3"><br/>
                            <h1 class="mb-3 text-primary font-weight-bold">Alur Layanan</h1>
                            <div>
                                <div class="mb-4"><br/>
                                    <img class="card-img rounded-0" src="{{ url ('user/img/alurlayanan.png') }}" style="max-width: 800px;">
                                    <br/>
                                </div>
                                <div class="mb-4"><br/>
                                    <a class="text-body" href="">Tujuan yang ingin dicapai oleh Program Studi D3 Teknik Informatika Sekolah Vokasi UNS adalah menghasilkan lulusan yang:

                                        Menghasilkan lulusan yang memiliki keahlian terapan tertentu dengan menjunjung tinggi etika, mampu berinteraksi dengan lingkungan, dan siap bersaing di tingkat nasional dan internasional.
                                        Menghasilkan teknologi dan produk barang maupun jasa hasil penelitian terapan yang bermanfaat bagi masyarakat.
                                        Menghasilkan produk hasil pengabdian kepada masyarakat dan mengembangkan hubungan kerjasama dengan segenap lapisan masyarakat.</a>
                                    <br/>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="position-relative mb-3"><br/>
                            <h1 class="mb-3 text-primary font-weight-bold">Tujuan program studi</h1>
                            <div>
                                <div class="mb-4"><br/>
                                    <a class="text-body" href="">Tujuan yang ingin dicapai oleh Program Studi D3 Teknik Informatika Sekolah Vokasi UNS adalah menghasilkan lulusan yang:

                                        Menghasilkan lulusan yang memiliki keahlian terapan tertentu dengan menjunjung tinggi etika, mampu berinteraksi dengan lingkungan, dan siap bersaing di tingkat nasional dan internasional.
                                        Menghasilkan teknologi dan produk barang maupun jasa hasil penelitian terapan yang bermanfaat bagi masyarakat.
                                        Menghasilkan produk hasil pengabdian kepada masyarakat dan mengembangkan hubungan kerjasama dengan segenap lapisan masyarakat.</a>
                                    <br/>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection