@extends('layouts.app')

@section('content')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>
 <style>
body, html, .main {
  height: 100%;
}

section {
  min-height: 100%;
}
</style>
</head>
    <!-- Hero Slider Begin -->
    <section class="hero-slider">
        <div class="hero-items owl-carousel">
            <div class="single-slider-item set-bg" data-setbg="img/slider-1.jpg" height="100px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 style="color:black">Hi, {{ Auth::user()->username ?? "Guest" }}</h1>
                            <h2 style="color:black">Get Hyped Now!</h2>
                            <!-- <a href="#Middle" class="primary-btn" style="color:black">See More</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Slider End -->

    <!-- asdasd ini kyk banner gitu(?) -->
    <!-- Features Section Begin -->
    <section class="features-section spad">
        <!-- Features Box -->
        <div class="features-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="single-box-item first-box">
                                    <img src="img/f-box-1.jpg" alt="">
                                    <div class="box-text">
                                        <span class="trend-year" style="color:black">2020 Party</span>
                                        <span class="trend-alert" style="color:black">Trend Alert</span>
                                        <!-- <a href="#" class="primary-btn">See More</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="single-box-item second-box">
                                    <img src="img/f-box-2.jpg" alt="">
                                    <div class="box-text">
                                        <span class="trend-year">2020 Trend</span>
                                        <h2 style="color:white">Footwear</h2>
                                        <!-- <span class="trend-alert">Bold & Black</span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-box-item large-box">
                            <img src="img/f-box-3.jpg" alt="">
                            <div class="box-text">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                                <span class="trend-year">2020 Party</span>
                                <h2>Look Book</h2>
                                <!-- <div class="trend-alert">Trend Alert</div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Section End -->

    <!-- Latest Product Begin -->
    <section class="latest-products spad">
        <div class="container">
            <div class="product-filter">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Latest Products</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- asdasd ini product list nya, sebaris horizontal ad 4 produk, kebawah ga ad batas -->
            <div class="row" id="product-list">
                <?php
                    $items = DB::table('items')->get();
                    foreach($items as $item_bottom){
                        $path = "/storage/" . $item_bottom->image;
                ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-product-item">
                        <figure>
                            <a href="/item/{{$item_bottom->id}}"><img src="{{$path}}" alt=""></a>
                            <?php
                            $now =  date("Y-m-d");
                            if($now < $item_bottom->duration){
                            ?>
                            <div class="p-status">LIVE</div>
                            <?php
                            }
                            else{ ?>
                                <div class="p-status"> EXPIRED </div>
                                <?php
                            } 
                            ?>
                        <div class="product-text">
                            <!-- asdasd nama produk --><h6><br>{{ $item_bottom->name}}</h6>
                        <p>Rp. <?php echo " ".number_format($item_bottom->price, 0); ?></p>    
                        </div>
                        </figure>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Latest Product End -->

    <!-- asdasd ini kyk slideshow logo supplier/partner -->
    <!-- Logo Section Begin -->
    <div class="logo-section spad">
        <div class="logo-items owl-carousel">
            <div class="logo-item">
                <a href="https://www.pixar.com/"><img src="img/logos/logo-1.png" alt=""></a>
            </div>
            <div class="logo-item">
                <a href="https://thepirates.co/"><img src="img/logos/logo-2.png" alt=""></a>
            </div>
            <div class="logo-item">
                <img src="img/logos/logo-3.png" alt="">
            </div>
            <div class="logo-item">
                <img src="img/logos/logo-4.png" alt="">
            </div>
            <div class="logo-item">
                <img src="img/logos/logo-5.png" alt="">
            </div>
        </div>
    </div>
    <!-- Logo Section End -->

@endsection
