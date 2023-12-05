@extends('user.layouts.master')



@section('nav_bar_categories')

    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block ">
                <div class="row align-items-center justify-content-between bg-light py-2  px-xl-5 d-none d-lg-flex"  style="height: 65px; padding: 0 30px;">
                    <div class="logo col-4">
                        <a href="#">
                            <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('user#home') }}" class="nav-item nav-link me-3">Home</a>
                            <a href="{{ route('user#cartList') }}" class="nav-item nav-link position-relative me-3">My Cart
                                <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($cart) }}
                                </span>
                            </a>
                            <a href="{{ route('user#contactPage') }}" class="nav-item nav-link me-3 @if(Request::url() == 'http://localhost:8000/user/contact/page') active @endif ">Contact</a>
                            <a href="{{ route('user#cartHistory') }}" class="nav-item nav-link me-3">History</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="{{ route('user#cartList') }}" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">{{ count($cart) }}</span>
                            </a>
                            <div class="btn-group">

                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm  dropdown-toggle" data-toggle="dropdown">
                                        <div class="image  dropdown-menu-left dropdonw-menu">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow-sm" style="height: 35px" >
                                                @else
                                                    <img src="{{ asset('images/default_female.jpg') }}" class="img-thumbnail shadow-sm" style="height: 35px" >
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm" style="height: 35px" >
                                            @endif
                                        </div>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="{{ route('user#profile') }}" method="get">
                                            <button class="dropdown-item btn bg-secondary my-3 col-10 offset-1 py-1 pe-5" type="submit"><i class="fa-solid fa-user"></i> Account</button>
                                        </form>
                                        <form action="{{ route('user#changePasswordPage') }}" method="get">
                                            <button class="btn bg-warning dropdown-item my-3 col-10 offset-1 py-1 pe-5" type="submit"> <i class="fa-solid fa-key"></i> Change password</button>
                                        </form>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="btn bg-black text-white dropdown-item my-3 col-10 offset-1 py-1 pe-5" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

@endsection



@section('content')

    <div class="main-content mt-5">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-end">
                                <a href="{{ route('user#home') }}"><button class="btn bg-dark text-white rounded"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                            </div>
                            <div class="col-4 offset-4 ">
                                @if (session('successMessage'))
                                <div class="text-center">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check"></i> {{ session('successMessage') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            </div>

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-8 col-lg-6">
                                    <!--Form with header-->
                                    <form action="{{ route('user#contactMessage') }}" method="post">
                                        @csrf
                                        <div class="card rounded-0 ">
                                            <div class="card-header p-0">
                                                <div class="bg-info text-white text-center py-2">
                                                    <h2 class="text-center"><i class="fa fa-envelope"></i>Contact Form</h2>
                                                    <p class="m-0">You can message us!</p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <!--Body-->
                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" name="name" placeholder="Username" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                                        </div>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="example@gmail.com" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                                        </div>
                                                        <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Enter your message"></textarea>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button class="btn btn-info btn-block rounded-0 py-2 fs-5">Send <i class="fa-solid fa-square-arrow-up-right"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    <!--Form with header-->
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
