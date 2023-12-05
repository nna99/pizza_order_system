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
                            <a href="{{ route('user#cartList') }}" class="nav-item nav-link position-relative me-3 @if(Request::url() == 'http://localhost:8000/user/cart/list') active @endif ">My Cart
                                <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($cart) }}
                                </span>
                            </a>
                            <a href="{{ route('user#contactPage') }}" class="nav-item nav-link me-3">Contact</a>
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

    <!-- Cart Start -->
    @section('content')
    <div class="container-fluid" style="height: 550px">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cart as $c)
                        <tr>
                            <td><img src="{{ asset('storage/'.$c->product_image) }}" alt="" style="width: 100px; height:75px"></td>
                            <td class="align-middle">
                                {{ $c->product_name }}
                                <input type="hidden" class="productId" value="{{ $c->product_id }}">
                                <input type="hidden" class="orderId" value="{{ $c->id }}">
                                <input type="hidden" class="userId" value="{{ $c->user_id }}">
                            </td>
                            <td class="align-middle" id="price">{{ $c->product_price }} kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $c->quantity }}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle col-2" id="total">{{ $c->product_price*$c->quantity }} kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">2500 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotalPrice">{{ $totalPrice + 2500 }} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-2" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-2 py-2 text-black" id="cancelBtn">Cancel Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <!-- Cart End -->

@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $('#orderBtn').click(function(){

            $orderList = [];
            $randomNumber = Math.floor(Math.random() * 10000000001);

            $('#dataTable tbody tr').each(function(index,row){
            $orderList.push({
                'product_id' : $(row).find('.productId').val(),
                'user_id' : $(row).find('.userId').val(),
                'quantity' : $(row).find('#qty').val(),
                'total' : $(row).find('#total').text().replace('kyats','')*1,
                'order_code' : 'P'+$randomNumber
            }) ;
        })

        $.ajax({
            type : 'get',
            url : '/user/ajax/order',
            dataType : 'json',
            data : Object.assign({}, $orderList),
            success : function(response){
                if(response.status == 'true'){
                    window.location.href = 'http://localhost:8000/user/homePage'
                    }
                }
            })

        })

        // cancel button
        $('#cancelBtn').click(function(){
            $("#dataTable tbody tr").remove();
            $('#subTotalPrice').html("0 kyats");
            $('#finalTotalPrice').html("2500 kyats");

            $.ajax({
            type : 'get',
            url : '/user/ajax/clear/cart',
            dataType : 'json',
        })
    })

        $('.btnRemove').click(function(){
            $parentNode = $(this).parents("tr");
            $parentNode.remove();

            $allTotalPrice = 0;
            $('#dataTable tbody tr').each(function(index,row){
                $allTotalPrice  += Number($(row).find('#total').text().replace("kyats",""));
            })
            $('#subTotalPrice').html(`${$allTotalPrice} kyats `)
            $('#finalTotalPrice').html(`${$allTotalPrice + 2500} kyats `)

            $.ajax({
            type : 'get',
            url : '/user/ajax/delete',
            dataType : 'json',
            data : {'productId' : $('.productId').val(),
                    'orderId' : $('.orderId').val(),
                    }
            })
        })
    </script>
@endsection
