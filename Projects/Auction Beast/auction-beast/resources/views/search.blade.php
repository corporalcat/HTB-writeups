@extends('layouts.app')

@section('content')
    <html>
        <body>
        <div class="contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
            <?php
            if(isset($res)){ ?>
                <div class="row" id="product-list">
                <?php
                    if($res == ""){
                        ?> Results Not Found! <?php
                    }
                    else{
                    $count = 0;
                    foreach($res as $item_bottom){
                        $count += 1;
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
                }
                    // if($count==0){
                    //     echo("No Results Found");
                    // }
                ?>
            </div>
            <?php
            }
            ?>
        </body>
    </html>
@endsection