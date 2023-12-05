@extends('admin.layouts.master')


@section('title','Order Info')

@section('search_bar')
    <form class="form-header" action="{{ route('category#list') }}" method="get">
        @csrf
        <input class="au-input au-input--xl" type="text" name="key" value="{{ request('key') }}" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection


@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid col-10 offset-1">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="mb-5">
                        <div class="text-center">
                            <div class="">
                                <h2 class="title-1">Order Info</h2>
                            </div>
                            <div class=" mb-3">
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('order#list') }}"><button class="btn btn-sm bg-dark text-white mb-4">Back</button></a>

                    <div class=" col-5 card">
                        <div class="card-header">
                            <h4>User Info</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-user me-2"></i>Username</div>
                                <div class="col">{{ ucwords($orderList[0]->user_name) }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-mobile me-2"></i>Phone Number</div>
                                <div class="col">{{ $orderList[0]->user_phone }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                <div class="col">{{ $orderList[0]->order_code }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-regular fa-calendar-days me-2"></i>Order Date</div>
                                <div class="col">{{ $orderList[0]->created_at->format('j-F-Y') }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-sack-dollar me-2"></i>Total Amount</div>
                                <div class="col">{{ $order[0]->total_price }} (Delivery charges include)</div>
                            </div>
                        </div>
                    </div>

                        <div class="table-responsive table-responsive-data2 ">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderList as $o)
                                    <tr>
                                        <td class="align-middle col-1">{{ $o->id }}</td>
                                        <td class="col-2">{{ $o->product_name }}</td>
                                        <td class="col-2">
                                            <img src="{{ asset('storage/'.$o->product_image) }}" class="img-thumbnail shadow-sm w-50 object-fit-cover" style="height: 100px">
                                        </td>
                                        <td class="col-1">{{ $o->quantity }}</td>
                                        <td class="col-2">{{ $o->total_price }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
