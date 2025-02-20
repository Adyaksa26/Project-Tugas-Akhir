@extends('frond.layout.app')
@section('content')
<style>
   /* Ketika radio button "prev" tercentang, geser carousel ke kiri
#carousel-1:checked ~ .carousel-inner {
    transform: translateX(0%);
}

/* Ketika radio button "next" tercentang, geser carousel ke kanan
#carousel-2:checked ~ .carousel-inner {
    transform: translateX(-100%);
} */

/* Untuk mengaktifkan overflow-x: auto; pada perangkat mobile dan tablet */
@media screen and (max-width: 991px) {
    #coffee_items {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* Untuk efek scrolling yang lebih mulus pada perangkat iOS */
    }
}

/* Untuk mengatur tampilan flexbox pada perangkat mobile dan tablet */
@media screen and (max-width: 767px) {
    #coffee_items {
        flex-wrap: nowrap; /* Memastikan konten tetap dalam satu baris */
        justify-content: flex-start; /* Mengatur konten agar tidak terpusat */
    }

    .coffee_section_2 .carousel-inner .carousel-item .container-fluid .row {
        display: flex !important;
        flex-wrap: nowrap !important;
        justify-content: flex-start !important;
    }

    .coffee_section_2 .carousel-inner .carousel-item .container-fluid .row .col-lg-3 {
        flex: 0 0 auto !important;
    }

    .coffee_section_2 .carousel-inner .carousel-item .container-fluid .row .col-lg-3 .coffee_box {
        width: 100% !important;
    }

    .coffee_section_2 .carousel-inner .carousel-item .container-fluid .row .col-lg-3 .coffee_box .types_text,
    .coffee_section_2 .carousel-inner .carousel-item .container-fluid .row .col-lg-3 .coffee_box .looking_text,
    .coffee_section_2 .carousel-inner .carousel-item .container-fluid .row .col-lg-3 .coffee_box .read_bt {
        width: 100% !important;
    }
}

/* CSS Animation */
@keyframes swipe {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

.card {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: hidden; /* Hindari tampilan scroll */
    /* animation: swipe 5s ease-in-out infinite alternate; Animasi swipe otomatis */
}

.card {
    width: 250px; /* Atur lebar card sesuai kebutuhan */
    height: 100%; /* Atur tinggi card sesuai kebutuhan */
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden; /* Menghindari gambar keluar dari card */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-img {
    width: 100%; /* Gambar akan mengisi lebar card */
    height: 100%; /* Gambar akan mengisi tinggi card */
    object-fit: cover; /* Memastikan gambar tetap terlihat baik tanpa merusak aspek rasio */
}

.card-body {
   height: 2%;
    padding: 2em;
}

.card-title {
    font-size: 18px;
    margin-bottom: 10px;
}

.card-text {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
}


</style>

<!-- about section start -->
<div class="about_section layout_padding">
         <div class="container">
            <div class="about_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="about_taital_box">
                        <h1 class="about_taital">Tentang Viaaz Coffee</h1>
                        <h1 class="about_taital_1">Hello!</h1>
                        <p class=" about_text">Selamat datang di Viaaz Coffee, titik pertemuan antara kehangatan kopi yang segar
                            dan nuansa santai yang menginspirasi. Di sini, kami mempersembahkan pengalaman kopi yang tidak hanya 
                            memanjakan lidah Anda, tetapi juga merayakan kehidupan sehari-hari dengan cita rasa yang istimewa.
                             Temukan kembali arti dari secangkir kopi dengan kami di Viaaz Coffee.</p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="image_iman"><img src="{{asset('frond')}}/images/about.png" class="about_img"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->
      <!-- coffee section start -->
      <div class="coffee_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="coffee_taital">OUR COFFEE OFFER</h1>
               </div>
            </div>
         </div>

      <div class="coffee_section_2">
    <div id="main_slider" class="carousel slide" data-ride="carousel">
        <!-- <input type="radio" id="carousel-1" class="carousel-control-prev" name="carousel" hidden>
        <input type="radio" id="carousel-2" class="carousel-control-next" name="carousel" hidden> -->

        <div class="carousel-inner">
            <div class="carousel-item active" >
                <div class="container-fluid">
                    <div class="row" id="coffee_items" style="display: flex; /* Mengatur tampilan menjadi flexbox */
    flex-wrap: nowrap; /* Memastikan konten tetap dalam satu baris */
    overflow-x: auto;">
                        @foreach ($menu as $m)
                        <div class="col-lg-3 col-md-6">
                        <div class="card">
                            @empty($m->foto)
                            <div class="coffee_img"><img src="{{url('admin/img/nofoto.png')}}" alt="..."></div>
                            @else
                            <div class="coffee_img"><img src="{{url('admin/img')}}/{{$m->foto}}" alt="..."></div>
                            @endempty
                            <div class="coffee_box">
                                <h3 class="types_text">{{$m->nama}}</h3>
                                <p class="looking_text">Rp.{{number_format($m->harga,0,',',',')}}</p>
                                <div class="read_bt"><a class="btn btn-outline-dark mt-auto"
                                href="{{url('detail_cart/'.$m->id)}}">View Details</a></div>
                                @auth
                                <div class="read_bt"><a href="{{route('add.to.cart', $m->id)}}">Add To Cart</a></div>
                                @endauth
                            </div>
                           </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- <label for="carousel-1" class="carousel-control-prev">&lt;</label>
        <label for="carousel-2" class="carousel-control-next">&gt;</label> -->
    </div>
</div>


      <!-- coffee section end -->
      <!-- client section start -->
   <div class="client_section layout_padding">
    <div class="container">
         <div id="main_slider" class="carousel slide" data-ride="carousel">
        <!-- <div id="custom_slider" class="carousel slide" data-ride="carousel"> -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                <div class="row">
                        <div class="col-md-12">
                            <h1 class="about_taital">Bagaimana Penilaian Customer?</h1>
                        </div>
                    </div>
                    <div class="container-fluid">
                    <div class="row" id="coffee_items" style="display: flex; /* Mengatur tampilan menjadi flexbox */
    flex-wrap: nowrap; /* Memastikan konten tetap dalam satu baris */
    overflow-x: auto;">
                        @foreach($ulasanAll as $ulasan)
                        <div class="col-lg-3 col-md-6">
                            <div class="row text-center justify-content-center p-3 shadow-lg rounded bg-white">
                                <div class="d-flex justify-content-center mb-4 flex-column align-items-center">
                                    <img src="https://cdn.pixabay.com/photo/2018/11/13/21/43/avatar-3814049_1280.png"
                                        class="rounded-circle shadow-1-strong mb-2" width="120" height="120"><br>
                                    <h4 class="mb-3 font-weight-bold">Meja: {{ $ulasan->no_meja }}</h4>
                                    <p class="px-xl-4">
                                        <i class="fas fa-quote-left pe-2 text-primary"></i> {{ $ulasan->ulasan }}
                                    </p>
                                    <ul class="list-unstyled d-flex justify-content-center mb-0">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $ulasan->rating)
                                                <li><i class="fas fa-star fa-sm text-warning"></i></li>
                                            @else
                                                <li><i class="far fa-star fa-sm text-warning"></i></li>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                                <!-- <div class="card">
                                    <div class="card-body">
                                        <h5 class="moark_text">Meja: {{ $ulasan->no_meja }}</h5>
                                        <p class="client_text">{{ $ulasan->ulasan }}</p>
                                        <p class="client_right"><medium class="text-muted">Rating: {{ $ulasan->rating }}</medium></p>
                                    </div>
                                </div> -->
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- <a class="carousel-control-prev" href="#custom_slider" role="button" data-slide="prev">
                <i class="fa fa-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#custom_slider" role="button" data-slide="next">
                <i class="fa fa-arrow-right"></i>
            </a> -->
         </div>
      </div>
   </div>
      <!-- client section end -->
  <!-- blog section start -->
<div class="blog_section layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="about_taital">Our Blog</h1>
         </div>
      </div>
      <div class="blog_section_2">
         <div class="row">
            <div class="col-md-6">
               <div class="blog_box">
                  <div class="blog_img"><img src="{{asset('frond')}}/images/blog-img1.png"></div>
                  <h4 class="date_text">05 April</h4>
                  <h4 class="prep_text">Teknik Penyeduhan Kopi di Viaaz Coffee</h4>
                  <p class="lorem_text">Di Viaaz Coffee, kami menguasai berbagai teknik penyeduhan kopi untuk memastikan setiap cangkir kopi yang disajikan memiliki cita rasa yang sempurna. Mulai dari metode pour-over yang halus hingga espresso yang kuat, setiap teknik penyeduhan kami dilakukan dengan penuh ketelitian dan keahlian.</p>
                  <div class="more_text" style="display: none;">
                     <p>Kami juga menawarkan pelatihan bagi mereka yang ingin mempelajari seni menyeduh kopi. Setiap sesi pelatihan dipandu oleh barista berpengalaman yang siap membagikan ilmu dan keterampilan mereka.</p>
                  </div>
                  <div class="read_btn"><a href="#" class="read_more">Read More</a></div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="blog_box">
                  <div class="blog_img"><img src="{{asset('frond')}}/images/blog-img2.png"></div>
                  <h4 class="date_text">05 April</h4>
                  <h4 class="prep_text">Menikmati Kopi Terbaik di Viaaz Coffee</h4>
                  <p class="lorem_text">Menikmati kopi di Viaaz Coffee bukan hanya tentang rasa, tapi juga tentang pengalaman. Dari biji kopi pilihan hingga suasana kafe yang nyaman, kami berkomitmen untuk memberikan pengalaman menikmati kopi yang terbaik bagi setiap pengunjung. Datang dan nikmati secangkir kebahagiaan di Viaaz Coffee.</p>
                  <div class="more_text" style="display: none;">
                     <p>Setiap hari, kami menyajikan kopi segar yang diseduh dengan hati-hati untuk menjaga kualitas dan rasa yang konsisten. Anda juga dapat memilih dari berbagai pilihan makanan ringan yang sempurna untuk menemani secangkir kopi Anda.</p>
                  </div>
                  <div class="read_btn"><a href="#" class="read_more">Read More</a></div>
               </div>
            </div>
         </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- blog section end -->
      <!-- contact section start -->
      <div class="contact_section layout_padding">
         <div class="container-fluid">
            <div class="contact_section_2">
               <div class="row">
                  <div class="map_main">
                     <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6379337.404114858!2d95.8947986!3d-2.2231804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xbac1ddff6ed4ccf%3A0x29f7984da41c186f!2sNurul%20Fikri%20Training%20Center%20(NF%20Academy)!5e0!3m2!1sid!2sid!4v1622345678901!5m2!1sid!2sid" width="250" height="500" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section end -->
@endsection
