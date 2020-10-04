@extends('layouts.app')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Edit Profile<span>.</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Edit Profile Page Begin -->
    <!-- asdasd ini form nya, yg ga pake delete aj -->
    <section class="cart-total-page spad">
        <div class="container">
            <form action="/profile/update/<?php echo $user->id; ?>" method="POST" enctype="multipart/form-data" class="checkout-form">
                @csrf
                 @method('PATCH')
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h3>Your Information</h3>
                    </div>
                    <div class="col-lg-9">
                        <div class="row" style="align-bottom">
                            <div class="col-lg-2">
                                <p class="">Nama Lengkap</p>
                            </div>
                            <div class="col-lg-10">
                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" autocomplete="name" autofocus>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row" style="align-bottom">
                            <div class="col-lg-2">
                                <p class="">Alamat Lengkap</p>
                            </div>
                            <div class="col-lg-10">
                                <div class="col-md-10">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $user->address }}" autocomplete="address">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="align-bottom">
                            <div class="col-lg-2">
                                <p class="">Kota</p>
                            </div>
                            <div class="col-lg-10">
                                <div class="col-md-10">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') ?? $user->city}}" autocomplete="city">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="align-bottom">
                            <div class="col-lg-2">
                                <p class="">Kode Pos</p>
                            </div>
                            <div class="col-lg-10">
                                <div class="col-md-10">
                                    <input id="pos" type="text" class="form-control @error('pos') is-invalid @enderror" name="pos" value="{{ old('pos') ?? $user->pos}}" autocomplete="pos">
                                    @error('pos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="align-bottom">
                            <div class="col-lg-2">
                                <p class="">Nomor Telepon</p>
                            </div>
                            <div class="col-lg-10">
                                <div class="col-md-10">
                                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->phone}}" autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-method">
                                    <button type="submit">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Edit Profile Page End -->

<!-- <div class="container">
    <form action="/profile/<?php echo $user->id; ?>" method="POST" enctype="multipart/form-data">
         @csrf
         @method('PATCH')
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" autocomplete="name" autofocus>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
                </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Alamat Lengkap</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $user->address }}" autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Nomor Telepon</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->phone}}" autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
</div> -->
@endsection