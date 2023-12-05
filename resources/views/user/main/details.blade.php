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
                            <a href="{{ route('user#contactPage') }}" class="nav-item nav-link me-3">Contact</a>
                            <a href="{{ route('user#cartHistory') }}" class="nav-item nav-link me-3">History</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="#" class="btn px-0">
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

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="col-10 offset-1">
            <button class="btn btn-dark text-white ms-5 rounded" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i> back</button>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30 mt-3">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="image" style="height: 500px">
                            <img class="w-100 h-100 img-thumbnail object-fit-cover" src="{{ asset('storage/'.$pizza->image) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30 mt-3">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizza->name }}</h3>
                    <input type="hidden" name="" value="{{ Auth::user()->id }}" id="userId">
                    <input type="hidden" name="" value="{{ $pizza->id }}" id="pizzaId">
                    <input type="hidden" name="" value="1" id="ratingCount">
                    <div class="d-flex mb-3">
                        <small class="pt-1 fs-6"><i class="fa-solid fa-eye me-1"></i> {{ $pizza->view_count }}</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} kyats</h3>
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="orderCount">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="addBtn" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $p)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-thumbnail object-fit-cover w-100" src="{{ asset('storage/'.$p->image) }}" alt="" style="height: 250px"/>
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" title="detail" href="{{ route('user#pizzaList',$p->id) }}"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }} kyats</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

@endsection

@section('scriptSource')

    <script>
        $(document).ready(function(){

            // view count
            $data = {
                'productId' : $('#pizzaId').val()
            };
            $.ajax({
                type : 'get',
                url : '/user/ajax/view/count',
                dataType : 'json',
                data : $data,
            })

            // add to cart button
            $('#addBtn').click(function(){

                $source = {
                    'count' : $('#orderCount').val(),
                    'userId' : $('#userId').val(),
                    'pizzaId' : $('#pizzaId').val()
                };
                $.ajax({
                        type : 'get',
                        url : '/user/ajax/addToCart',
                        dataType : 'json',
                        data : $source,
                        success : function(response){
                            if(response.status == 'success'){
                                window.location.href = 'http://localhost:8000/user/homePage'
                            }
                        }
                    })
            })

        })
    </script>

@endsection
