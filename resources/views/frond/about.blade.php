<!DOCTYPE html>
<html>
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Viaaz</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{asset('frond')}}/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{asset('frond')}}/css/style2.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{asset('frond')}}/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="{{asset('frond')}}/images/fevicon.png" type="image/gif" />
      <!-- font css -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{asset('frond')}}/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- Font Awesome Link/ buat ikon login dan regis -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
      <link rel="stylesheet" href="{{asset('frond')}}/css/style1.css">
   </head>
   <body>
   @include('sweetalert::alert')
   <div class="header_section">
   <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="/"><img src="{{ asset('frond/images/logofix.png') }}"></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="about">About</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="coffees">Coffees</a>
               </li>
               <!-- <li class="nav-item">
                  <a class="nav-link" href="shop.html">Shop</a>
               </li> -->
               <li class="nav-item">
                  <a class="nav-link" href="blog">Blog</a>
               </li>
               <!-- <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact</a>
               </li> -->
               @guest
                  @if (Route::has('login'))
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                           <span class="user_icon"><i class="fa fa-user" aria-hidden="true"></i></span> {{ __('Login') }}
                        </a>
                     </li>
                  @endif
                  @if (Route::has('register'))
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                           <span class="user_icon"><i class="fa fa-user" aria-hidden="true"></i></span> {{ __('Register') }}
                        </a>
                     </li>
                  @endif
               @else
                  <li class="nav-item dropdown">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                     </a>
                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                        </form>
                     </div>
                  </li>
                  <div class="dropdown"> 
                  <ul class="navbar-nav ml-auto">
                  <li class="nav-item side-menu dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="cartDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-shopping-bag"></i>
                        <span class="badge">
                           {{count((array) session('cart'))}}
                        </span>
                        <p class="d-inline m-0">Cart</p>
                        <div class="dropdown-menu">
                        <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true">
                            </i> 
                            <span class="badge badge-pill badge-danger">
                                {{ count((array) session('cart')) }}</span>
                            </div>
                            @php $total = 0 @endphp
                            @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['harga'] * $details['quantity'] @endphp
                            @endforeach
                            
                            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <span class="text-info">Rp. {{ $total }}</span></p>
                            </div>
                            </div>
                                @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                <div class="row cart-detail">
                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                @empty($details['foto'])
                                <img src="{{ url('admin/img/nofoto.png') }}" />
                                @else 
                                <img src="{{ url('admin/img') }}/{{$details['foto']}}" />
                                @endempty
                                </div>
                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                <p>{{ $details['nama'] }}</p>
                                <span class="price text-info"> Rp. {{$details['harga'] }}</span> 
                                <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                </div>
                                </div>
                                @endforeach
                                @endif
                                <!-- TEST -->
                                <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                <a href="{{url('shop_cart')}}" class="btn btn-primary btn-block">View all</a>
                                </div>
                                 <!-- test -->
                  </a>
               @endguest
               </div>
            </nav>
         </div>
     <!-- about section start -->
<div class="about_section layout_padding">
   <div class="container">
      <div class="about_section_2">
         <div class="row">
            <div class="col-md-6">
               <div class="about_taital_box">
                  <h1 class="about_taital">Tentang Viaaz Coffee</h1>
                  <h1 class="about_taital_1">Hello!</h1>
                  <p class="about_text">Selamat datang di Viaaz Coffee, titik pertemuan antara kehangatan kopi yang segar dan nuansa santai yang menginspirasi. Di sini, kami mempersembahkan pengalaman kopi yang tidak hanya memanjakan lidah Anda, tetapi juga merayakan kehidupan sehari-hari dengan cita rasa yang istimewa. Temukan kembali arti dari secangkir kopi dengan kami di Viaaz Coffee.</p>
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

<!-- additional content start -->
<style>
   .additional_img {
       width: 100%;
       height: auto;
       object-fit: cover;
       aspect-ratio: 16/9; /* Ensure landscape aspect ratio */
       margin-bottom: 20px; /* Add margin below each image */
   }
</style>
<div class="additional_content layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div class="additional_taital_box">
               <h2 class="additional_taital">Mengapa Memilih Viaaz Coffee?</h2>
               <p class="additional_text">Di Viaaz Coffee, setiap biji kopi dipilih dengan cermat dari kebun terbaik di Indonesia dan diproses dengan standar tertinggi untuk memastikan rasa yang maksimal. Kami percaya bahwa secangkir kopi yang sempurna dimulai dari biji yang berkualitas.</p>
               <div class="image_box"><img src="{{asset('frond')}}/images/beans.jpg" class="additional_img"></div>
               <h2 class="additional_taital">Pengalaman unik di Viaaz Coffee</h2>
               <p class="additional_text">Nikmati pengalaman unik di Viaaz Coffee dengan berbagai acara spesial seperti live music, pameran seni lokal, dan sesi cupping kopi. Kami juga menyediakan ruang untuk acara pribadi seperti pertemuan bisnis dan perayaan kecil. Setiap kunjungan ke Viaaz Coffee adalah kesempatan untuk menciptakan kenangan indah.</p>
               <div class="image_box"><img src="{{asset('frond')}}/images/pengalaman.jpg" class="additional_img"></div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="additional_taital_box">
               <h2 class="additional_taital">Ruang Inspirasi</h2>
               <p class="additional_text">Viaaz Coffee lebih dari sekadar tempat ngopi. Dengan suasana yang nyaman dan desain interior yang artistik, kami menyediakan ruang inspirasi bagi para pelaku kreatif dan profesional yang ingin bekerja, berdiskusi, atau sekadar bersantai menikmati kopi.</p>
               <div class="image_box"><img src="{{asset('frond')}}/images/interior.jpg" class="additional_img"></div>
               <h2 class="additional_taital">Komitmen Ramah Lingkungan</h2>
               <p class="additional_text">Kami berkomitmen untuk menjaga kelestarian lingkungan dengan menggunakan bahan-bahan yang ramah lingkungan, serta mendukung praktik berkelanjutan dalam setiap aspek operasional kami. Bergabunglah dengan kami dalam mendukung kopi yang lebih baik untuk bumi.</p>
               <div class="image_box"><img src="{{asset('frond')}}/images/eco_friendly.png" class="additional_img"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- additional content end -->



      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="footer_social_icon">
                     <ul>
                        <li><a href="#"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
                  <div class="location_text">
                     <ul>
                        <li>
                           <a href="#">
                           <i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left_10">+62 812-6894-1169</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <i class="fa fa-envelope" aria-hidden="true"></i><span class="padding_left_10">dpsyana@gmail.com</span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <p class="copyright_text">2024 All Rights Reserved. Design by Viaaz 
                     Distribution by Viaaz Coffe</p>
               </div>
            </div>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="{{asset('frond')}}/js/jquery.min.js"></script>
      <script src="{{asset('frond')}}/js/popper.min.js"></script>
      <script src="{{asset('frond')}}/js/bootstrap.bundle.min.js"></script>
      <script src="{{asset('frond')}}/js/jquery-3.0.0.min.js"></script>
      <script src="{{asset('frond')}}/js/plugin.js"></script>
      <!-- sidebar -->
      <script src="{{asset('frond')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="{{asset('frond')}}/js/custom.js"></script>
</body>
</html>