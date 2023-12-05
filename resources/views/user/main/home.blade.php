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
                            <a href="{{ route('user#home') }}" class="nav-item nav-link me-3 @if(Request::url() == 'http://localhost:8000/user/homePage') active  @endif">Home</a>
                            <a href="{{ route('user#cartList') }}" class="nav-item nav-link position-relative me-3"> My Cart
                                <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($cart) }}
                                </span>
                            </a>
                            <a href="{{ route('user#contactPage') }}" class="nav-item nav-link me-3 ">Contact</a>
                            <a href="{{ route('user#cartHistory') }}" class="nav-item nav-link me-3 ">History</a>
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


    <div class="container-fluid">
        <div class="row px-5 ">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by categories</span></h5>
                <div class="bg-light mb-30">
                    <div class="">
                        <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical">
                            <h6 class="text-dark m-0 fs-6"><i class="fa fa-bars mr-2"></i>Categories <span class="badge fs-6 bg-dark text-white ms-3 ">{{ count($categories) }}</span></h6>
                            <i class="fa fa-angle-down text-dark"></i>
                        </a>
                        <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light " id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                            <div class="navbar-nav w-100 bg-dark ">
                                <div class="nav-item dropdown dropright">
                                        <a href="{{ route('user#home') }}" class="nav-item nav-link text-white">All</a>
                                    @foreach ($categories as $c)
                                        <a href="{{ route('user#filter',$c->id) }}" class="nav-item nav-link text-white">{{ $c->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Price End -->


                {{-- order --}}
                <div class="">
                    <button class="btn btn-warning w-100">Order</button>
                </div>

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="float-end me-5 mb-4">
                            <div class="ml-2">
                                <div class="form">
                                    <select name="sorting" id="sortingOption" class="form-select">
                                        <option class="form"  value="desc"> Latest</option>
                                        <option class="form" value="asc"> Default</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span class="row" id="dataList">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-thumbnail object-fit-cover w-100" src="{{ asset('storage/'.$p->image) }}" style="height: 275px">
                                            <div class="product-action" id="dataTable">
                                                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" title="detail" href="{{ route('user#pizzaList',$p->id) }}"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="#">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                                <h4 class="text-center col-6 offset-3  fs-5" style="height: 450px">Sorry! We don't service for these food right now! <i class="fa-solid fa-face-sad-tear"></i></h4>
                        @endif
                    </span>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection


@section('scriptSource')
    <script>
        $(document).ready(function(){


                $('#sortingOption').change(function(){
                    $eventOption = $('#sortingOption').val();

                    if($eventOption == 'asc'){
                        $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizzaList',
                        dataType : 'json',
                        data : { 'status' : 'asc' },
                        success : function(response){
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-thumbnail w-100 object-fit-cover" src="{{ asset('storage/${response[$i].image}') }}" style="height: 275px">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{ url('user/pizza/list/${response[$i].id}') }}"><i class="fa fa-search"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5>
                                            </div>
                                            {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                `
                            }
                            $('#dataList').html($list)
                        }
                    })
                    }else if($eventOption == 'desc'){
                        $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizzaList',
                        dataType : 'json',
                        data : { 'status' : 'desc' },
                        success : function(response){
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-thumbnail w-100 object-fit-cover" src="{{ asset('storage/${response[$i].image}') }}" style="height: 275px">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{ url('user/pizza/list/${response[$i].id}') }}"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5>
                                            </div>
                                            {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                `
                            }
                            $('#dataList').html($list)
                        }
                    })
                    }

                })

        });


    </script>
@endsection

