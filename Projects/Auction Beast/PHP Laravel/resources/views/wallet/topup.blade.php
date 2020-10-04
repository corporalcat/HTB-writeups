@extends('layouts.app')

@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h3>Wallet Top Up<span></span></h3>
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
                    <form action="/walletupdate/{{$user->id}}" method="post" enctype="multipart/form-data" class="contact-form">
                        @csrf
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label for="wallet" class="col-md-4 col-form-label"><h3>Top up Amount</h3></label>
                                        <input id="wallet" type="number" class="form-control @error('wallet') is-invalid @enderror" name="wallet" value="{{ old('wallet')}}" placeholder="Rp. <?php echo(number_format($user->wallet, 0)); ?>" autocomplete="wallet" autofocus>
                                    @error('wallet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">Top up</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection