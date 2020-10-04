@extends('layouts.app')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Product Page Section Beign -->
    <section class="product-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-slider owl-carousel">
                        <div class="product-img">
                            <figure>
                                <!-- asdasd image source --><img src="/storage/{{$item->image}}" alt="">
                                <?php
                            $now =  date("Y-m-d");
                            if($now < $item->duration){
                            ?>
                            <div class="p-status">LIVE</div>
                            <?php
                            }
                            else{ ?>
                                <div class="p-status"> EXPIRED </div>
                                <?php
                            } 
                            ?>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-content">
                        <!-- asdasd item name --><h2>{{$item->name}}</h2>
                        <div class="pc-meta">
                            <!-- asdasd harga bid sekarang --><h5> Current bid : Rp. <?php echo " ".number_format($item->price, 0);?></h5>
                            <?php
                                $bidder = DB::table('users')->where('id', $item->bidder_id)->pluck('username');
                                foreach($bidder as $name){
                                    $username = $name;
                                }
                            ?>
                            <h5> Highest bidder : {{$username ?? "N/A"}}</h5>
                            
                        </div>
                        <h5>
                            <b>Size : {{$item->size}}</b>
                        </h5>
                        <!-- asdasd damn btuh --><p>{{$item->description}}</p>
                        <ul class="tags">
                            <!-- asdasd kategori, samain aj sama yg gede(?) --><li><span>Category :</span> Men’s Wear</li>
                            <!-- asdasd tag tapi rame --><li><span>Tags :</span> {{$item->tags}}</li>
                        </ul>
                        <ul class="tags">
                            <!-- asdasd tag tapi rame --><li><span>Duration :</span> <p id="demo"></p></li>
                        </ul>
                        <?php
                            $now =  date("Y-m-d");
                            if($now < $item->duration){
                        ?>
                        <form method="post" action="/bid/{{$item->id}}" class="contact-form">
                            @csrf
                            <label for="price" class="col-md-4 col-form-label"><h5><b>BID</b></h5></label>
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Minimal Rp.<?php echo " ".number_format($item->price+50000, 2); ?>" name="price" value="{{ old('price') }}" autocomplete="price" autofocus>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror      
                            <button type="submit" class="btn btn-primary">Bid</button>
                        </form>
                        <?php
                            }
                            else{
                            }
                        ?>
                        <ul class="p-info">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Page Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <!-- asdasd ini aku copy persis dari home, lu kyknya perlu kasih filter jadi barang yg lagi diliat ga muncul -->
            <div class="row" id="product-list">
                <?php
                    $items = DB::table('items')->get();
                    foreach($items as $item_bottom){
                        if($item->id != $item_bottom->id){
                        $path = "/storage/" . $item_bottom->image
                ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-product-item">
                        <figure>
                            <a href="/item/{{$item_bottom->id}}"><img src="{{$path}}" alt=""></a>
                            <?php
                            $now =  date("Y-m-d");
                            if($now < $item->duration){
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
                            <h6><br>{{ $item_bottom->name}}</h6>
                        <p>Rp. <?php echo " ".number_format($item_bottom->price, 0); ?></p>    
                        </div>
                        </figure>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
    <p id="demo"></p>
<script>
// Mengatur waktu akhir perhitungan mundur
function timer(){
    var abc = "{{$item->duration." ". $item->time}}";
    var countDownDate = new Date(abc).getTime();

    // Memperbarui hitungan mundur setiap 1 detik
    var x = setInterval(function() {

    // Untuk mendapatkan tanggal dan waktu hari ini
    var now = new Date().getTime();
        
    // Temukan jarak antara sekarang dan tanggal hitung mundur
    var distance = countDownDate - now;
        
    // Perhitungan waktu untuk hari, jam, menit dan detik
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
    // Keluarkan hasil dalam elemen dengan id = "demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        
    // Jika hitungan mundur selesai, tulis beberapa teks 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
    }, 1000);
}
timer();
</script>
@endsection