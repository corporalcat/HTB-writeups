@extends('layouts.app')

@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Selling Item<span>.</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Sell Section Begin -->
    <div class="contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="/listitem" method="post" enctype="multipart/form-data" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label">Item Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label">Item Image</label>
                                    <input type="file", class="form-control-file" id="image" name="image">
                                    @error('image')
                                        <strong>{{ $message }}</strong>
                                    @enderror 
                                </div>

                        
                                <div class="form-group row">
                                    <label for="price" class="col-md-4 col-form-label">Starting Price</label>
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" autocomplete="price" autofocus>

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                                </div>
                                <div class="form-group row">
                                    <label for="tags" class="col-md-4 col-form-label">Item Tags (Ex: Shirt, White, Cool)</label>
                                    <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ old('tags') }}" autocomplete="tags" autofocus>

                                    @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                                </div>
                                <div class="form-group row">
                                    <label for="category" class="col-md-4 col-form-label">Category</label>
                                    <select id="category" name="category" class="ui dropdown">
                                    <option value="">Categories</option>
                                    <option value="men">Men's wear</option>
                                    <option value="women">Women's wear</option>
                                    <option value="unisex">Unisex</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="size" class="col-md-4 col-form-label">Size</label>
                                    <select id="size" name="size" class="ui dropdown">
                                    <option value="">Size</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Auction End Date</label>
                                    <input id="duration" type="date" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}">
                                    @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Auction End Time</label>
                                    <input id="time" type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}">
                                    @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                                </div>
                                <br>
                                <br>
                                <div class="form-group row">
                                    <label for="description" class="col-md-4 col-form-label">Item description</label>
                                    <div class="form-group row">
                                        <textarea name="description" cols="100" rows="10" value="{{ old('description') }}" autocomplete="description" autofocus></textarea>
                                    </div>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">List Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sell Section End -->
@endsection