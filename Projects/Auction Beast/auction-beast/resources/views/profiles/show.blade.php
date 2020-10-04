@extends('layouts.app')

@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Profile<span>.</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- asdasd list nya semua disini, yg ga perlu buang aj -->
    <!-- Profile Page Begin -->
    <section class="cart-total-page spad">
        <div class="container">
            <div class="checkout-form">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h3>Your Information</h3>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Nama Lengkap</p>
                            </div>
                            <div class="col-lg-10">
                                <h4>{{$user->name}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Username</p>
                            </div>
                            <div class="col-lg-10">
                                <h4>{{$user->username}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">E-mail</p>
                            </div>
                            <div class="col-lg-10">
                                <h4>{{$user->email}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Alamat Lengkap</p>
                            </div>
                            <div class="col-lg-10">
                                <h4>{{$user->address}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Negara</p>
                            </div>
                            <div class="col-lg-10">
                                <h4>Indonesia</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Kota</p>
                            </div>
                            <div class="col-lg-10">
                                <h4>{{$user->city}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Kode Pos</p>
                            </div>
                            <div class="col-lg-10">
                                <h4>{{$user->pos}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Nomor Telepon</p>
                            </div>
                            <div class="col-lg-10">
                                <h4>{{$user->phone}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Profile Page End -->
@endsection