@extends('layouts.ecommerce')

@section('title')
<title>Register - DW Ecommerce</title>
@endsection

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Register</h2>
                <div class="page_link">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('customer.register') }}">Register</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Login Box Area =================-->
<section class="login_box_area p_120">
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-lg-6">
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="login_form_inner">
                    <h3>Register in to enter</h3>
                    <form class="row login_form" action="{{ route('customer.post_register') }}" method="post"
                        id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="first" name="customer_name" placeholder="Username" required>
                            <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="customer_phone" placeholder="Phone Number" required>
                            <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email Address">
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add1" name="customer_address" placeholder="Address" required>
                            <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="btn submit_btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection