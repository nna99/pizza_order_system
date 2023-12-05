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
                            <a href="{{ route('user#cartHistory') }}" class="nav-item nav-link me-3 @if(Request::url() == 'http://localhost:8000/user/cart/history') active @endif">History</a>
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

    <!-- Cart Start -->
    @section('content')
    <div class="container-fluid" style="height: 550px">
        <div class="row px-xl-5 mt-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                        <tr>
                            <td class="align-middle">{{ $o->created_at->format('F-j-Y') }}</td>
                            <td class="align-middle">{{ $o->order_code }}</td>
                            <td class="align-middle">{{ $o->total_price }} kyats</td>
                            <td class="align-middle">
                                @if ($o->status == 0)
                                    <div class="btn bg-warning col-5" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm me-1 text-black" role="status" aria-hidden="true"></span>
                                        <span class="text-black">Pending...</span>
                                    </div>
                                @elseif ($o->status == 1)
                                    <div class="btn bg-success col-5" type="button" disabled>
                                        <span class="text-black"><i class="fa-solid fa-circle-check"></i> Confirm...</span>
                                    </div>
                                @elseif ($o->status == 2)
                                    <div class="btn bg-danger col-5" type="button" disabled>

                                        <span class="text-black"><i class="fa-solid fa-ban"></i> Cancel...</span>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
    <!-- Cart End -->


